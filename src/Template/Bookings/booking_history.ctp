
<!--header start-->
<div class="bg" style="background: url('<?php echo $this->request->webroot;?>bus_front/assets/images/header_bg.jpg') center center no-repeat !important;">
    <div>
        <h1 style="margin-top: 100px !important;">Quick Booking</h1>
        <p><a href="">Home</a> / Lorem .</p>
    </div>
</div>

<!--display result start-->
<div class="container light_gray_bg pd_top_40">
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="black_color icon_bar" style="font-weight: normal">Booking History</h1>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <!--booking history start-->
    <?php
    $currentDateTime = date('Y-m-d H:i:s');
    //debug($bookings);
    foreach ($bookings as $booking){
        $adults = 0;
        $children = 0;
        $isVerified = 0;
        $amount = 0;
        $status = 0;
        $isCancelled = 0;
        $statusFlag = "";
        $bookingDateTime = date('Y-m-d H:i:s', strtotime($booking->date_time));
        $adults = $booking->adults;
        $children = $booking->children;
        $amount = $booking->amount;
        $isVerified = $booking->verification;
        $isCancelled = $booking->is_cancelled;
        $dTime = date('h:i A', strtotime($booking->routeterminal->departure_time));
        $aTime = date('h:i A', strtotime($booking->routeterminal->arrival_time));
        $dTerminal = $booking->routeterminal->departure_terminal->name;
        $aTerminal = $booking->routeterminal->arrival_terminal->name;
        $aCity = $booking->routeterminal->arrival_city->names;
        $dCity = $booking->routeterminal->departure_city->names;
        $bus = $booking->routeterminal->route->bus->bus_number;

        if ($isVerified == 0 && $currentDateTime >= $bookingDateTime){
            $statusFlag = 'Expired'; // expired
            $status = 0;
        } else if ($isVerified == 0 && $currentDateTime < $bookingDateTime){
            $statusFlag = 'In Progress'; // inprogress
            $status = 1;
        } else if ($isVerified == 1){
            $statusFlag = 'Completed'; // completed
            $status = 2;
        }
        
        if($isCancelled == 1){
            $statusFlag = "Cancelled";
        }

        $t1 = StrToTime ( $bookingDateTime );
        $t2 = StrToTime ( $currentDateTime );
        $diff = $t1 - $t2;
        $remainingHours = round( $diff / ( 60 * 60 ) );

    ?>
    <div class="row mg_bottom_30" style="">
        <div style="padding-left: 0px;" class="col-xs-12 col-sm-6 col-md-6 col-sm-offset-1 col-md-offset-1 bg_white">
            <div style="padding: 0px 30px; margin: 15px 0px; border-right: 2px solid #6d6d6d;">
                <table class="table-bordered table-striped table-condensed cf">
                   <tr>
                       <td>Booking# <?php echo $booking->booking_number;?></td>
                       <td><?php echo date('d M Y', strtotime($booking->date_time));?></td>
                   </tr>
                    <tr>
                        <td>
                            <?php echo $dCity.' ('.$dTerminal.') - '.$aCity.' ('.$aTerminal.')';?>
                        </td>
                        <td>
                            <?php echo $dTime.' - '.$aTime;?>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-bus"></i> <?php echo $bus;?></td>
                        <td>
                            <?php echo $adults.' Adults, '.$children.' Children';?>
                        </td>
                    </tr>
                    <tr>
                        <td>$ <?php echo $amount;?></td>
                        <td><?php echo $statusFlag;?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 bg_white">
            <div class="text-center" style="margin: 15px 0px;">

                <div style="margin-top: 10px;">
                    <?php
        if($remainingHours > 48 && $status == 1 && $isCancelled == 0){
                    ?>
                    <button id="<?php echo $booking->id;?>" data-toggle="modal" data-target="#myModal" class="btn btn-search btn-lg input_new_style canceL_booking" style="position: relative; width: 120px;"> 
                        <span style="position: absolute; top: -10px; left: 7%;">Cancel Booking</span>
                    </button>
                    <?php } ?>
                    
                    <a href="<?php echo $this->request->webroot;?>Bookings/quickBooking/<?php echo $booking->id;?>" class="btn btn-search btn-lg input_new_style" style="position: relative; width: 120px;"> 
                        <span style="position: absolute; top: -10px; left: 11%;">Quick Booking</span>
                    </a>


                    <?php 
        if($status == 1 || $status == 2){
            if($isCancelled == 0){
                    ?>
                    <a href="<?php echo $this->request->webroot;?>bookings/ticket/<?php echo $booking->id;?>" class="btn btn-search btn-lg input_new_style" style="position: relative; width: 120px;"> 
                        <span style="position: absolute; top: -10px; left: 20%;">View Ticket</span>
                    </a>
                    <?php } }?>
                </div>
            </div>
        </div>
    </div>

    <?php 

    } 
    ?>
    <!--display single route start-->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" style="margin-top: 15px;">Cancel Booking</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" id="myForm" action="<?php echo $this->request->webroot;?>bookings/cancelBooking">
                        <div class="row">
                            <input type="hidden" id="booking_id" name="booking_id" required="required">
                            <div class="col-sm-12" id="display_booking">

                                <table class="table-bordered table-striped table-condensed cf">
                                    <tr>
                                        <td id="route" data-title="Route">

                                        </td>
                                        <td id="time" data-title="Time">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="bus" data-title="Bus">

                                        </td>
                                        <td id="passenger" data-title="Passenger">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="amount" style="text-align: right;" colspan="2" data-title="Amount">

                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!--                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                <button data-toggle="confirmation" data-placement="top" type="submit" id="search" class="btn btn-custom input_new_style pull-right">Cancel Booking</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>


    <div class="clearfix">&nbsp;</div>
</div>
<!--display result end-->
<script>
    $(document).ready(function(){
        $('button.canceL_booking').click(function(){
            var bookingId = $(this).attr('id');
            $('#booking_id').val(bookingId);

            if(bookingId != ""){
                $.ajax({
                    url: '<?php echo $this->request->webroot ?>bookings/getBookingData',
                    data: {
                        'booking_id' : bookingId
                    },
                    type: 'POST',
                    cache: false,
                    success:function(responce){
                        var dataArray = responce.split('_');
                        var stop = dataArray[0];
                        var time = dataArray[1];
                        var bus = dataArray[2];
                        var passenger = dataArray[3];
                        var amount = dataArray[4];
                        $('#route').text(stop);
                        $('#time').text(time);
                        $('#bus').text(bus);
                        $('#passenger').text(passenger);
                        $('#amount').text(amount);
                    }

                });
            }
        });
    });
</script>