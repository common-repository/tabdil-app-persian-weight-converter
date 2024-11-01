
jQuery(document).ready(function($) {

    var loading = false;
    var main_box = $(".box1").eq(0);
    var res_box = $(".box1").eq(1);

    main_box.find("form :input")
    .on('change',function() {
        $(this).closest('form').find('input#go').attr('disabled', false);
    });

    var options = '';
    data.forEach(function(value,index) {
        options += "<option value='" + index + "'>"+ value[0] + '</option>';
    });
    main_box.find('select#t2').html(options).val(convertFromSelectValue);
    main_box.find('select#t3').html(options).val(convertToSelectValue);

    main_box.find('form').on('submit',function(event) {
        if( $('#t1').val().length == '' ){
            event.preventDefault();
            window.location.hash = '#t1';
            $('#t1').focus();
        } else {
            convert();
            event.preventDefault();
        }
    });
    
    main_box.find('#t2,#t3').on('change', function(event) {
        changeUrl();
    });
    
    function convert() {
        if( loading ) return false;
        loading = true;
        main_box.addClass("loading");
        res_box.addClass("loading");
        main_box.find('input#go').attr('disabled', true);
        changeUrl();
        setTimeout( make_convert, 1000 );
    }

    function make_convert(){
        main_box.removeClass("loading");
        res_box.removeClass("loading");
        window.location.hash = '#res';
        res_box.find('#resList').html('');
        //res_box.find('#res').slideDown();
        var value = $('#t1').val().trim();
        if( value.length > 0 ){
            var textResult = [];
            var convertFrom = $('#t2').val();
            var convertTo = $('#t3').val();
            res_box.find("#title").html( value +' '+ data[convertFrom][0] +' '+ equalsText +' <u>'+ setPrecisionA(value * data[convertTo][1] / data[convertFrom][1], Number.parseInt($("#t4").val())) +'</u> '+ data[convertTo][0] );
            data.forEach( function( item, index ){
                var tik = cls = '';
                if( convertTo == index ){
                    tik =  '✅ ';
                    cls = 'active';
                }
                if( convertFrom != index ){
                    textResult.push(
                    '<div id="line" class="'+cls+'"><div id="desc" class="right">'+ tik + value +' '+ data[convertFrom][0] +' '+ equalsText +' <u>'+ 
                    setPrecisionA(value * item[1] / data[convertFrom][1], Number.parseInt($("#t4").val())) +'</u> '+ item[0] +'</div></div>');
                }
            });
            res_box.find('#resList').html(textResult.join(''));
            loading = false;
        }
    }

    function setPrecisionA( number, decimal) {
        var oldNumber = number;
        if ( number % 1 !== 0 ) {
            number = number.toFixed(decimal);
            if(Number.parseFloat(number) === 0){
                return oldNumber;
            }
            var array = number.split(".");
            if( array.length > 0 ){
                number = Number.parseInt(array[1]) === 0 ? array[0] : number;
            }
        }
        return Number(number);
    }

    function changeUrl() {
        var indexFrom = $('#t2').val();
        var indexTo = $('#t3').val();
        var from = data[indexFrom][2];
        var to = data[indexTo][2];
        var fromTitleText;
        var toTitleText;
        var splitFrom;
        var splitTo;
    
        if(  (splitFrom = data[indexFrom][0].split('(')).length > 2 ){
            splitFrom.pop();
            fromTitleText = splitFrom.join('(');
        } else {
            fromTitleText = strstr(data[indexFrom][0],'(',true);
        }
    
        if(  (splitTo = data[indexTo][0].split('(')).length > 2 ){
            splitTo.pop();
            toTitleText = splitTo.join('(');
        } else {
            toTitleText = strstr(data[indexTo][0],'(',true);
        }
    
        fromTitleText = fromTitleText ? fromTitleText : data[indexFrom][0];
        toTitleText = toTitleText ? toTitleText : data[indexTo][0];
        
            var titleTagText = localTranslate(titleTag,['{title1}', '{title2}'], [fromTitleText, toTitleText] );

        document.title = titleTagText + '🔄';
        main_box.find("#title").html(localTranslate(formHeaderText, ['{title}'], [localTranslate(title1ToTitle2,['{title1}', '{title2}'], [fromTitleText, toTitleText])]));

    }
    
    function localTranslate( message, paramKey , paramValue ) {
        for (i=0; i < paramKey.length; i++){
            message = message.split(paramKey[i]).join(paramValue[i].trim());
        }
        return message;
    }
    function strstr(haystack, needle, bool) {
        var pos = 0;
        haystack += "";
        pos = haystack.indexOf(needle); if (pos == -1) {
          return false;
        } else {
          if (bool) {
            return haystack.substr(0, pos);
          } else {
            return haystack.slice(pos);
          }
        }
      }

});


