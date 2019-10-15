<style>
    .mytablestyle{
        width: 100%;
    }
    .mytablestyle tr td{
        padding: 5px;
    }
    h5.contentheading{
        font-weight: bold;
        text-decoration: underline;
        margin-left: 12px;
    }
</style>
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <?php if ($_GET['fetchWhat'] == 'reviews') { ?>
            <div>
                <h5 class="contentheading">Customer Reviews:</h5>
            </div>
            <div>
                <?php
                if (count($reviews) > 0) {

                    foreach ($reviews as $review):

                        $path = '';
                        $loginWithSocial = $review->talent_user->loginwithsocial;
                        $path = $review->talent_user->profile_image;
                        $image = 'cyber1550500683.png';
                        if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                            $path = $review->talent_user->profile_image;
                        } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                            if ($review->talent_user->profile_image == '') {

                                $path = $this->request->webroot . 'img/users/' . $image;
                            } else {
                                $path = $this->request->webroot . 'img/users/' . $path;
                            }
                        } else {
                            $path = $this->request->webroot . 'img/users/' . $image;
                        }
                        ?>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="event_image" style="width:40px;height:40px !important;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>'); position: relative;">
                                </div>
                                <strong style="font-size:14px">
                                    <?php echo ucwords($review->talent_user->first_name . ' ' . $review->talent_user->last_name); ?>
                                </strong>
                                <span class="pull-right" style="font-size:14px">
                                    <?php
                                    $date = date('M d, Y', strtotime($review->created));
                                    echo $date;
                                    ?>
                                </span>
                                <br>
                                <p style="font-size:12px">
                                    <?php echo strlen($review->review) > 200 ? substr($review->review, 0, 200) . "..." : $review->review; ?>
                                </p> 
                            </div>


                        </div>
                        <hr>
                        <?php
                    endforeach;
                } else {
                    ?>
                    <h6 class="text-center">No reviews found</h6>
                    <?php
                }
                ?>
            </div>
        <?php } else { ?>
            <div>
                <h5 class="contentheading">Customer Details:</h5>
            </div>
            <table class="mytablestyle table-bordered table-striped">
                <tr>
                    <td>Name</td>
                    <td><?php echo ucwords($customer_details->first_name . ' ' . $customer_details->last_name); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $customer_details->email; ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><?php echo $customer_details->phone1; ?></td>
                </tr>
            </table>

        <?php } ?>
    </div>
</div>