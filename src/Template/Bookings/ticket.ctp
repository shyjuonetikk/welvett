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
<script type="text/javascript" src="<?php echo $this->request->webroot ?>js/jquery-barcode.js"></script>
<script type="text/javascript">

    function generateBarcode(){
        var value = $("#barcodeValue").val();


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
<div class="bg" style="background: url('<?php echo $this->request->webroot;?>bus_front/assets/images/header_bg.jpg') center center no-repeat !important;">
    <div>
        <h1 style="margin-top: 100px !important;">Booking Information</h1>
        <p><a href="">Home</a> / Lorem .</p>
    </div>
</div>

<div class="container pd_top_40">
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="black_color icon_bar" style="font-weight: normal">Ticket Information</h1>
        </div>
        <div class="col-md-12 text-center">
            <input type="hidden" id="barcodeValue" value="<?php echo $ticketDetail['booking_number'];?>">
            <input type="hidden" id="tex" value="">
            <p id="barcodeTarget" class="barcodeTarget" style="margin-left:400px;"></p>

        </div>

    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="" id="no-more-tables">
                <table class="table-bordered table-striped table-condensed cf">
                    <tr>
                        <td data-title="Route">
                            <?php echo $ticketDetail->routeterminal->departure_city->names.' 
                            ('.$ticketDetail->routeterminal->departure_terminal->name.') - '.
    $ticketDetail->routeterminal->arrival_city->names.' ('.$ticketDetail->routeterminal->arrival_terminal->name.')';?>
                        </td>
                        <td data-title="Time">
                            <?php echo date('h:i A', strtotime($ticketDetail->routeterminal->departure_time)).' - '.date('h:i A', strtotime($ticketDetail->routeterminal->arrival_time))?>
                        </td>
                    </tr>
                    <tr>
                        <td data-title="Bus">
                            <?php echo $ticketDetail->routeterminal->route->bus->bus_number;?>
                        </td>
                        <td data-title="Passenger">
                            <?php echo $ticketDetail->adults.' Adults,'.$ticketDetail->children.' Children';?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;" colspan="2" data-title="Amount">
                            <?php echo 'Amount Paid: $'.$ticketDetail->amount;?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <?php
        $currentDateTime = date('Y-m-d H:i:s');
        $bookingDateTime = date('Y-m-d H:i:s', strtotime($ticketDetail->date_time));

        $time1 = StrToTime ( $bookingDateTime );
        $time2 = StrToTime ( $currentDateTime );
        $diff = $time1 - $time2;
        $hours = round( $diff / ( 60 * 60 ) );

        if($hours > 0 && $hours <= 24){
            if($ticketDetail->checkin == 0 && $ticketDetail->verification == 0){
        ?>
        <div class="col-md-12 text-center">
            <form method="post">
                <input type="hidden" value="<?php echo $ticketDetail->id;?>" name="booking_id">
                <button formaction="" type="submit" class="btn btn-search btn-lg input_new_style" style="position: relative; width: 200px;"> 
                    <span style="position: absolute; top: -10px; left: 20%;">Check In</span>
                </button>
            </form>
        </div>
        <?php 
            }
        } ?>
    </div>

    <div class="clearfix">&nbsp;</div>
</div>
