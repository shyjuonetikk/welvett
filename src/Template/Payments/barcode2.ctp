<?php 


?>
<style>
    * {
        color: #7F7F7F;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-weight: normal;
    }
    #config {
        overflow: auto;
        margin-bottom: 10px;
    }
    .config {
        float: left;
        width: 200px;
        height: 250px;
        border: 1px solid #000;
        margin-left: 10px;
    }
    .config .title {
        font-weight: bold;
        text-align: center;
    }
    .config .barcode2D,  #miscCanvas {
        display: none;
    }
    #submit {
        clear: both;
    }
    #barcodeTarget,  #canvasTarget {
        margin-top: 20px;
    }
</style>

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot ?>js/jquery-barcode2.js"></script>
<script type="text/javascript">

    function generateBarcode(){
        var value = <?php echo $barcode ?>;
        alert(value );


        var btype = 'ean13';


        var renderer ='css';

        var quietZone = false;
        if ($("#quietzone").is(':checked') || $("#quietzone").attr('checked')){
            quietZone = true;
        }

        var settings = {
            output:renderer,
            bgColor: '#FFFFFF',
            color: '#000000',
            barWidth: '3',
            barHeight: '80',
            moduleSize: $("#moduleSize").val(),
            posX: $("#posX").val(),
            posY: $("#posY").val(),
            addQuietZone: $("#quietZoneSize").val()
        };
        if ($("#rectangular").is(':checked') || $("#rectangular").attr('checked')){
            value = {code:value, rect: true};
            //alert( value);
        }
        if (renderer == 'canvas'){
            clearCanvas();
            $("#barcodeTarget").hide();
            alert($("#canvasTarget").show().barcode(value, btype, settings));

        } else {
            $("#canvasTarget").hide();
            $("#barcodeTarget").html("").show().barcode(value, btype, settings);
        }
    }

    function showConfig1D(){
        $('.config .barcode1D').show();
        $('.config .barcode2D').hide();
    }

    function showConfig2D(){
        $('.config .barcode1D').hide();
        $('.config .barcode2D').show();
    }

    function clearCanvas(){
        var canvas = $('#canvasTarget').get(0);
        var ctx = canvas.getContext('2d');
        ctx.lineWidth = 1;
        ctx.lineCap = 'butt';
        ctx.fillStyle = '#FFFFFF';
        ctx.strokeStyle  = '#000000';
        ctx.clearRect (0, 0, canvas.width, canvas.height);
        ctx.strokeRect (0, 0, canvas.width, canvas.height);
    }

    $(function(){
        $('input[name=btype]').click(function(){
            if ($(this).attr('id') == 'datamatrix') showConfig2D(); else showConfig1D();
        });
        $('input[name=renderer]').click(function(){
            if ($(this).attr('id') == 'canvas') $('#miscCanvas').show(); else $('#miscCanvas').hide();
        });
        generateBarcode();
    });

</script>