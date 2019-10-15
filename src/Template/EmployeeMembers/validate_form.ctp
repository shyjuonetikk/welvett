<?php
if ($talent_events->event_types[0]['event_type'] == 1) {
    $time1 = strtotime($data['from_time']);
    $time2 = strtotime($data['to_time']);
    $total_hours = round(abs($time2 - $time1) / 3600, 2);
}
?>
<style>
    @media only screen and (min-width: 800px){
        .hide_in_lg{
            display: none !important;
        }
    }
    /****NO MORE TABLE CSS START****/
    @media only screen and (max-width: 800px) {

        /* Force table to not be like tables anymore */
        #no-more-tables table, 
        #no-more-tables thead, 
        #no-more-tables tbody, 
        #no-more-tables th, 
        #no-more-tables td, 
        #no-more-tables tr { 
            display: block; 
        }
        #totalExpenses{
            display: none;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        #no-more-tables thead tr { 
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        #no-more-tables tr { border: 1px solid #ccc; }

        #no-more-tables td { 
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee; 
            position: relative;
            padding-left: 50%; 
            white-space: normal;
            text-align:left;
        }

        #no-more-tables td:before { 
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%; 
            padding-right: 10px; 
            white-space: nowrap;
            text-align:left;
            font-weight: bold;
        }

        /*
        Label the data
        */
        #no-more-tables td:before { content: attr(data-title); }
        #no-more-tables th {
            display: none;
        }
        #expense_total_lg{
            display: none !important;
        }

    }


    #no-more-tables table{
        width: 100%;
    }

    #no-more-tables th{
        font-size: 14px;
    }
    .summaryheading{
        text-decoration: underline;
        margin: 5px 0;
        color:#511723;
    }
    table.cf{
        box-shadow: 1px 1px 3px #ccc;

    }
    table.cf th,table.cf td{
        padding: 0;

    }
</style>

<div id="no-more-tables">
    <h5 class="summaryheading">Booking Details:</h5>

    <table id="summary_booking_modal" class="table-bordered table-striped table-condensed cf">
        <tr>
            <th>Talent</th>
            <td data-title="Talent"><?= ucwords($talent_events->user->first_name . ' ' . $talent_events->user->last_name); ?></td>
            <th>Service</th>
            <td data-title="Service"><?php echo ucfirst($talent_events->Eventcategories['title']); ?></td>
        </tr>
        <?php
        if ($talent_events->event_types[0]['event_type'] == 1) {
            ?>
            <tr class="hide_in_lg">
                <th>Per hour</th>
                <td data-title="Per hour">
                    $ <?php
                    echo $talent_events->event_types[0]->amount;
                    ?>
                </td>
            </tr>
            <tr class="hide_in_lg">
                <th>Total Hours</th>
                <td data-title="Total Hours">
                    <?php
                    echo $total_hours;
                    $total_fee = $talent_events->event_types[0]->amount * $total_hours;
                    ?>
                </td>
            </tr>
        <?php } else { ?>
            <tr class="hide_in_lg">
                <th>Whole event</th>
                <td data-title="Whole event">
                    $ <?php
                    echo $talent_events->event_types[0]->amount;
                    $total_fee = $talent_events->event_types[0]->amount;
                    ?>
                </td>
            </tr>
            <?php
        }
        if ($get_talent_cities['city'] != 'N/A') {
            ?>
            <tr class="hide_in_lg">
                <th>

                    Acc for <?=
                    ucfirst($get_talent_cities['city']);
                    ?></th>
                <td data-title="Acc for <?=
                ucfirst($get_talent_cities['city']);
                ?>">
                    $ <?php
                    echo $get_talent_cities['accommodation_price'];
                    ?>
                </td>
            </tr>
        <?php } ?>
        <tr class="hide_in_lg">
            <th>Total</th>
            <td data-title="Total">
                $ <?php
                $total = $total_fee + $get_talent_cities['accommodation_price'];
                echo $total;
                ?>
            </td>
        </tr>


        <tr>
            <th>Start date</th>
            <td data-title="Start date"><?= date('M d, Y', strtotime($data['from_date'])) ?></td>
            <th>End date</th>
            <td data-title="End date"><?= date('M d, Y', strtotime($data['to_date'])) ?></td>
        </tr>

        <tr>
            <th>Hour</th>
            <td data-title="Hour"><?= $data['hour']; ?></td>
            <th>Location</th>
            <td data-title="Location"><?= $get_talent_cities['city'] ?></td>
        </tr>
        <?php if ($data['modal_event_type'] == 1) { ?>
            <tr>
                <th>From Time</th>
                <td data-title="From Time"><?php echo $data['from_time']; ?></td>
                <th>To Time</th>
                <td data-title="To Time"><?php echo $data['to_time']; ?></td>

            </tr>
        <?php } ?>
        <tr>
            <th>Address</th>
            <td data-title="Address"><?= $data['street_address']; ?></td>
            <th>Address 2</th>
            <td data-title="Address 2"><?= $data['street_address2']; ?></td>
        </tr>
        <tr>
            <th>City</th>
            <td data-title="City"><?= $data['city']; ?></td>
            <th>State</th>
            <td data-title="State"><?= $states[$data['state_id']]; ?></td>
        </tr>

        <tr>
            <th>Zip code</th>
            <td data-title="Zip code"><?= $data['zip']; ?></td>
            <th>Direction</th>
            <td data-title="Direction"><?= $data['special_direction']; ?></td>
        </tr>

        <tr>
            <th>Purpose</th>
            <td data-title="Purpose"><?= $data['booking_purpose']; ?></td>
            <th>Message</th>
            <td data-title="Message"><?= $data['personal_message']; ?></td>
        </tr>

        <tr>
            <th colspan="2">Description </th>
            <td data-title="Description" colspan="2"><?= $data['describe_event']; ?></td>
        </tr>
    </table>
    <div id="totalExpenses">
        <h5 class="summaryheading">Expenses:</h5>

        <table class="table-bordered table-striped table-condensed cf">
            <tr>
                <th>Booking Type</th>
                <td data-title="Booking Type">
                    <?php
                    if ($data['modal_event_type'] == 1) {
                        echo 'Hourly';
                    }
                    if ($data['modal_event_type'] == 2) {
                        echo 'Whole Event';
                    }
                    ?>
                </td>

            </tr>
            <?php
            if ($talent_events->event_types[0]['event_type'] == 1) {
                ?>
                <tr>
                    <th>Fee per hour</th>
                    <td data-title="Fee per hour">
                        $ <?php
                        echo $talent_events->event_types[0]->amount;
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Total Hours</th>
                    <td>
                        <?php
                        echo $total_hours;
                        $total_fee = $talent_events->event_types[0]->amount * $total_hours;
                        ?>
                    </td>
                </tr>
            <?php } else { ?>
                <tr>
                    <th>Fee for whole event</th>
                    <td>
                        $ <?php
                        echo $talent_events->event_types[0]->amount;
                        $total_fee = $talent_events->event_types[0]->amount;
                        ?>
                    </td>
                </tr>
                <?php
            }
            if ($get_talent_cities['city'] != 'N/A') {
                ?>
                <tr>
                    <th>

                        Acc Price for <?=
                        ucfirst($get_talent_cities['city']);
                        ?></th>
                    <td>
                        $ <?php
                        echo $get_talent_cities['accommodation_price'];
                        ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <th>Total</th>
                <td style="font-size: 16px;font-weight: bold;">
                    $ <?php
                    $total = $total_fee + $get_talent_cities['accommodation_price'];
                    echo $total;
                    ?>
                </td>
            </tr>

        </table>
    </div>


</div>