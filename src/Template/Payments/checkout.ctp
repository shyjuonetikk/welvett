<?php 
$rand1 = str_pad(rand(1, 9999999), 7, STR_PAD_LEFT);
$rand2 = str_pad(rand(1, 999999), 6, STR_PAD_LEFT);
$oneWayBookingNumber = $rand1.$rand2;


$rand3 = str_pad(rand(1, 9999999), 7, STR_PAD_LEFT);
$rand4 = str_pad(rand(1, 999999), 6, STR_PAD_LEFT);
$returnBookingNumber = $rand3.$rand4;
$isTour = $this->request->session()->read('is_tour');
$tourId = $this->request->session()->read('tour_id');
?>
<style>
    /*
    * {
    color: #7F7F7F;
    font-family: Arial, sans-serif;
    font-size: 12px;
    font-weight: normal;
    }
    */
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
<div class="col-md-12 text-center">
    <input type="hidden" id="barcodeValue" value="<?php echo $oneWayBookingNumber;?>">

    <!--<p id="barcodeTarget" class="barcodeTarget" style="margin-left:400px;"></p>-->

</div>

<?php
// prefilled first and last name
$firstName = ucwords(strtolower($this->request->session()->read('Auth.User.first_name')));
$lastName = ucwords(strtolower($this->request->session()->read('Auth.User.last_name')));
$email = $this->request->session()->read('Auth.User.email');
$phone = $this->request->session()->read('Auth.User.phone1');
$children = $this->request->session()->read('children');
$adults = $this->request->session()->read('adults');

$departureDate = date('m/d/Y', strtotime($this->request->session()->read('departure_date')));
$returnDate = $this->request->session()->read('return_date');

if($children == ""){
    $childrenCount = 0;
} else{
    $childrenCount = $children;
}
if($adults == ""){
    $adultCount = 0;
} else{
    $adultCount = $adults;
}

$returnTotalAmount = 0;
$totalAmount = 0;

?>
<!--header start-->
<div class="bg" style="background: url('<?php echo $this->request->webroot;?>bus_front/assets/images/header_bg.jpg') center center no-repeat !important;">
    <div>
        <h1 style="margin-top: 100px !important;">Payment</h1>
        <p><a href="">Home</a> / Lorem .</p>
    </div>
</div>

<!--customer form start-->
<div class="container pd_30">
    <div class="row black_color">
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-2">
            <p>Enter your Credit Card Information, we wont be saving your card information in our database. </p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <div class="row">
                <form method="post" class="label_margin">

                    <input type="hidden" id="tex" value="" name="one_way_booking_number">

                    <input type="hidden" value="<?php echo $oneWayRouteId;?>" name="one_way_route_id">

                    <input type="hidden" value="<?php echo $searchedRoute->id;?>" name="one_way_route_terminal_id">

                    <input type="hidden" value="<?php echo $oneWayAmount;?>" name="one_way_amount">

                    <input type="hidden" name="one_way_departure_time" value="<?php echo date('H:i:s', strtotime($searchedRoute->departure_time));?>">

                    <?php
                    if($returnDate != null){
                    ?>
                    <input type="hidden" value="<?php echo $roundRouteId;?>" name="round_route_id">

                    <input type="hidden" value="<?php echo $roundRouteTerminalId;?>" name="round_route_terminal_id">

                    <input type="hidden" value="<?php echo $roundAmount;?>" name="round_amount">


                    <input type="hidden" name="round_departure_time" value="<?php echo date('H:i:s', strtotime($returnRoute->departure_time));?>">

                    <input type="hidden" value="<?php echo $roundBookingNumber;?>" name="round_booking_number">

                    <?php
                    }
                    ?>

                    <input type="hidden" name="is_booking" value="0">                    

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3 class="text-center">One Side</h3>
                        <div id="no-more-tables">
                            <table class="table-bordered table-striped table-condensed cf">
                                <thead>
                                    <tr>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Date</th>
                                        <th>Origin Time</th>
                                        <th>Destination Time</th>
                                        <th>Adults</th>
                                        <th>Children</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-title="Origin">
                                            <?php echo $searchedRoute->departure_city->names.' / '.$searchedRoute->departure_terminal->name;?>
                                        </td>
                                        <td data-title="Destination">
                                            <?php echo $searchedRoute->arrival_city->names.' / '.$searchedRoute->arrival_terminal->name;;?>
                                        </td>
                                        <td data-title="Date">
                                            <?php echo $departureDate;?>
                                        </td>
                                        <td data-title="Origin Time">
                                            <?php echo date('h:i A', strtotime($searchedRoute->departure_time));?>
                                        </td>
                                        <td data-title="Destination Time">
                                            <?php echo date('h:i A', strtotime($searchedRoute->arrival_time));?>
                                        </td>
                                        <td data-title="Adults">
                                            <?php 
                                            if($adults != ""){
                                                echo $adults;
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                        <td data-title="Children">
                                            <?php 
                                            if($children != ""){
                                                echo $children;
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                        <td data-title="Amount">
                                            <?php echo $searchedRoute->price; ?>
                                        </td>
                                        <td data-title="Total">
                                            <?php 
                                            $perHeadPrice = $searchedRoute->price;
                                            $adultAmount = $perHeadPrice * $adultCount;
                                            $childrenAmount = $perHeadPrice * $childrenCount;
                                            $totalAmount = $adultAmount + $childrenAmount; 
                                            echo $totalAmount;
                                            ?>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php
                    if($returnDate != ""){
                    ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3 class="text-center">Return</h3>
                        <div id="no-more-tables">
                            <table class="table-bordered table-striped table-condensed cf">
                                <thead>
                                    <tr>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Date</th>
                                        <th>Origin Time</th>
                                        <th>Destination Time</th>
                                        <th>Adults</th>
                                        <th>Children</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-title="Origin">
                                            <?php echo $returnRoute->departure_city->names.' / '.$returnRoute->departure_terminal->name;?>
                                        </td>
                                        <td data-title="Destination">
                                            <?php echo $returnRoute->arrival_city->names.' / '.$returnRoute->arrival_terminal->name;?>
                                        </td>
                                        <td data-title="Date">
                                            <?php echo $returnDate;?>
                                        </td>
                                        <td data-title="Origin Time">
                                            <?php echo date('h:i A', strtotime($returnRoute->departure_time));?>
                                        </td>
                                        <td data-title="Destination Time">
                                            <?php echo date('h:i A', strtotime($returnRoute->arrival_time));?>
                                        </td>
                                        <td data-title="Adults">
                                            <?php 
                        if($adults != ""){
                            echo $adults;
                        } else {
                            echo "-";
                        }
                                            ?>
                                        </td>
                                        <td data-title="Children">
                                            <?php 
                        if($children != ""){
                            echo $children;
                        } else {
                            echo "-";
                        }
                                            ?>
                                        </td>
                                        <td data-title="Amount">
                                            <?php echo $returnRoute->price; ?>
                                        </td>
                                        <td data-title="Total">
                                            <?php 

                        $perHeadPrice = $returnRoute->price;
                        $adultAmount = $perHeadPrice * $adultCount;
                        $childrenAmount = $perHeadPrice * $childrenCount;
                        $returnTotalAmount = $adultAmount + $childrenAmount; 
                        echo $returnTotalAmount;
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="clearfix">&nbsp;</div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label for="first_name">First Name</label>
                        <?php echo $this->Form->control('first_name',array('div'=>false,'label'=>false, 'class'=>'form-control input_new_style','required', 'value'=>$firstName)); ?>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label for="last_name">Last Name</label>
                        <?php echo $this->Form->control('last_name',array('div'=>false,'label'=>false,  'class'=>'form-control input_new_style','required', 'value'=>$lastName)); ?>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label for="email">Email</label>
                        <?php echo $this->Form->input('email', array('type'=> 'email','id'=>'email', 'class' => 'form-control input_new_style', 'required', 'div' => false, 'label' => false, 'value'=>$email)) ?> 
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label for="phone1">Phone</label>
                        <?php echo $this->Form->input('phone1', array('type'=> 'text','id'=>'email', 'class' => 'form-control input_new_style', 'required', 'div' => false, 'label' => false, 'value'=>$phone)) ?> 
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label for="cardno">Card Number</label>
                        <?php echo $this->Form->input('cardno', array('id'=>'paymentcredit', 'class' => 'form-control input_new_style', 'required', 'div' => false, 'label' => false)) ?>  
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label for="cardcvc">CVC Number</label>
                        <?php echo $this->Form->input('cardcvc', array('id'=>'paymentcvc', 'class' => 'form-control input_new_style', 'required', 'div' => false, 'label' => false)) ?>   
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label for="cardmonth">Card Expiry Month</label>
                        <?php echo $this->Form->month('cardmonth', array('id'=>'paymentmonth', 'class' => 'form-control input_new_style', 'required', 'div' => false, 'label' => false,'empty'=>'Select Month')) ?> 
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label for="cardyear">Card Expiry Year</label>
                        <?php echo $this->Form->year('cardyear', array('id'=>'paymentyear', 'class' => 'form-control input_new_style', 'required', 'div' => false, 'label' => false,'empty'=>'SELECT YEAR','minYear' => date('Y'), 'maxYear' => date('Y') + 10 )); ?> 
                    </div>

                    <div class="clearfix">&nbsp;</div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <strong>Grand Total: $<?php echo $totalAmount + $returnTotalAmount;?></strong>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <div class="clearfix">&nbsp;</div>
                        <button class="btn btn-search btn-lg input_new_style" type="submit" style="position: relative; width: 120px;"> 
                            <span style="position: absolute; top: -10px; left: 18%;">&nbsp;&nbsp; Pay Now</span>
                        </button>
                        <button class="btn btn-search btn-lg input_new_style" type="submit" style="position: relative; width: 120px;"> 
                            <span style="position: absolute; top: -10px; left: 18%;">&nbsp;&nbsp; Cancel</span>
                        </button>

                    </div>

                </form>
            </div>
        </div>        
    </div>
</div>
