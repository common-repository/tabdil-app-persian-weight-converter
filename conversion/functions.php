<?php
namespace TabdilApp;

if (!function_exists('tabdil_app_jafar_get_res')) {
    function tabdil_app_jafar_get_res( $atts ){
        $amount = (int)$_POST['t1'];
        $from = (int)$_POST['t2'];
        $to = (int)$_POST['t3'];
        $decimals = (int)$_POST['t4'];
        $title = str_replace('-',' ',$atts[0]);
        ?>
        <div class="box1 striped">
            <div id="title">
                <div id="res">
                    Convert units of weight.
                </div>
            </div>

            <span id="resList">
                <div id="line">
                    <div id="desc">
                    Please fill the form and press 'Calculate' button.
                    </div>
                </div>
            </span>

        </div>
        <?php
    }
}


if (!function_exists('tabdil_app_jafar_makeForm')) {
    function tabdil_app_jafar_makeForm( $atts, $module ){
        $title = str_replace('-',' ',$atts[0]);
        ?>

        <script>
            <?php echo tabdil_app_jafar_jscript( $module ) ?>
        </script>

        <div class="box1">
        <form data-changed="true">
            <div id="title">
                Online converter for units of weight
            </div>
            <div id="line">
                <div id='field'>
                    <label>Amount</label>
                    <input type="text" id="t1" value="" placeholder="example: 1" maxlength="12" size="3" dir="ltr">
                </div>
                <div id='field'>
                    <label>From</label>
                    <select id='t2'>
                        
                    
                    </select>
                </div>
                <div id='field'>
                    <label>To</label>
                    <select id='t3'>
                        
                    
                    </select>
                </div>
                <div id='field'>
                    <label>Decimals</label>
                    <select id='t4'>
                        <?php for($i=1;$i<21;$i++){?>
                            <option value="<?php echo (int)$i ?>" <?php echo ($i==1) ? "selected" : "" ?>>
                                <?php echo (int)$i ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div id="line">
                <input type="submit" id="go" value="Calculate">
            </div>
        </form>
        </div>
        <?php    
    }
}

if (!function_exists('tabdil_app_jafar_jscript')) {
    function tabdil_app_jafar_jscript( $module ){
        GLOBAL $wp;
        return "var equalsText = \"is equal to\";
        var convertFromSelectValue = 0;
        var convertToSelectValue = 1;
        var basicUrl = '". home_url( $wp->request ) ."';
        var titleTag = 'convert from {title1} to {title2}';
        var formHeaderText = '{title}';
        var h2Text = 'converting from {title1} to {title2} and vise versa.';
        var title1ToTitle2 = 'Converting units from <u>{title1}</u> to <u>{title2}</u>';
        var data = ". tabdil_app_jafar_rdata( $module ) ;
    }
}

if (!function_exists('tabdil_app_jafar_rdata')) {
    function tabdil_app_jafar_rdata( $module ){
        $id = $module['index'];

        $list = [

            //وزن
            0 => '[["Kilogram (کیلوگرم)",1,"kilogram"],["Gram (گرم)",1000,"gram"],["Pound (پوند)",2.204622619999999866280404603458009660243988037109375,"pound"],["Pound-troy (پوند تِرُی)",2.6792288807000002037739250226877629756927490234375,"pound-troy"],["Carat (قیراط)",5000,"carat"],["Ounce (اونس)",35.2739619000000033111064112745225429534912109375,"ounce"],["Ounce-troy (اونس تِرُی)",32.15074659999999795445546624250710010528564453125,"ounce-troy"],["Ton (تُن)",0.001000000000000000020816681711721685132943093776702880859375,"ton"],["Dram (درام)",564.3833909999999605133780278265476226806640625,"dram"],["Dyne (دین)",980665.002860000007785856723785400390625,"dyne"],["Grain (گرین)",15432.35835299999962444417178630828857421875,"grain"],["Slug (اسلاگ)",0.06852176556196100387641223505852394737303256988525390625,"slug"],["Stone (استون)",0.1574730444200000134546968411086709238588809967041015625,"stone"],["Newton (نیوتن)",9.8066499999999994230392985627986490726470947265625,"newton"],["Kilonewton (کیلو نیوتن)",0.00980665200000000077118489372196563635952770709991455078125,"kilonewton"],["Milligram (میلی گرم)",1000000,"milligram"],["Centigram (سانتی گرم)",100000,"centigram"],["Decigram (دسی گرم)",10000,"decigram"],["Dekagram (دکا گرم)",100,"dekagram"],["Megagram (مگا گرم)",0.001000000000000000020816681711721685132943093776702880859375,"megagram"],["Megatonne (مگا تن)",1.0000000000000000622815914577798564188970686927859787829220294952392578125e-9,"megatonne"],["Ton UK (تن انگلیس)",0.00098420652799999989827905988448719654115848243236541748046875,"ton-uk"],["Ton US (تن آمریکا)",0.0011023113099999999782430126771259892848320305347442626953125,"ton-us"],["Kiloton (کیلو تن)",9.99999999999999954748111825886258685613938723690807819366455078125e-7,"kiloton"],["Kiloton UK (کیلو تن انگلیس)",9.8420652760999998643807150366935587726402445696294307708740234375e-7,"kiloton-uk"],["Kiloton US (کیلو تن آمریکا)",1.102311310899999998024899501569695559055617195554077625274658203125e-6,"kiloton-us"],["Pennyweight-troy (پنی ویت تِرُی)",643.0149310000000468789949081838130950927734375,"pennyweight-troy"],["Quarter UK (کوارتر انگلیس)",0.07873652220900000109349292642946238629519939422607421875,"quarter-uk"],["Quarter US (کوارتر آمریکا)",0.08818490487400000577000724888421245850622653961181640625,"quarter-us"],["Microgram (میکرو گرم)",1000000000,"microgram"],["Mithqal (مثقال)",217.01389000000000351064954884350299835205078125,"mesghal"],["Charak (چارک)",1.3333333300000000942731048780842684209346771240234375,"charak"],["Sir (سیر)",13.3333333300000003163177098031155765056610107421875,"sir"],["Gandom (گندم)",20833.33333332999973208643496036529541015625,"gandom"],["Sout (سوت)",1000000,"soot"],["Kharvar (خروار)",0.003333329999999999800064376387354059261269867420196533203125,"kharvar"],["Nokhod (نخود)",5208.33333332999973208643496036529541015625,"nokhod"],["Man-Rey (من ری)",0.08333332999999999712859022338307113386690616607666015625,"man-rey"],["Man-Tabriz (من تبریز)",0.33333332999999998325080241556861437857151031494140625,"man-tabriz"],["Man-Isfahan (من اصفهان)",0.1666666699999999889936219688024721108376979827880859375,"man-esfahan"],["Man-Lorestan (من لرستان)",0.1000000000000000055511151231257827021181583404541015625,"man-lorestan"]];',

            ];

        return $list[ $id ];
    }
}
