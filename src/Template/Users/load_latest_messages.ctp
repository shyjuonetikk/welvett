<?php
foreach ($talentCustomerMsgs as $msg) {
    $path = '';
    $loginWithSocial = $msg->user->loginwithsocial;

    $path = $msg->user->profile_image;
    $image = 'cyber1550500683.png';
    if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

        $path = $msg->user->profile_image;
    } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
        if ($msg->user->profile_image == '') {

            $path = $this->request->webroot . 'img/users/' . $image;
        } else {
            $path = $this->request->webroot . 'img/users/' . $path;
        }
    } else {
        $path = $this->request->webroot . 'img/users/' . $image;
    }

    if ($msg->user->role_id == $this->request->session()->read('Auth.User.role_id')) {
        ?>

        <!--customer start-->
        <div style="margin-bottom: 15px;">
            <div style="float: right; text-align: right;">
                <div class="customer_profile_for_message" style="background-image: url('<?php echo $path; ?>'); margin-left: 25px;">

                </div>
                <span style="font-size: 9px;">
                    <?php echo date('m-d-Y H:i', strtotime($msg->created)); ?>
                </span>
            </div>
            <div class="customer_message" style="max-width: 42%; float: right; position: relative;">
                <span class="font_12">
                    <?php echo $msg->message; ?>
                </span>
                <i style="position: absolute; right: -5px; top: 10px; color: #7c1b2e;" class="fa fa-caret-right"></i>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--customer end-->
        <?php
    } else {
        ?>
        <!--talent start-->
        <div style="margin-bottom: 15px;">
            <div style="float: left;">
                <div class="talent_profile_for_message" style="background-image: url('<?php echo $path; ?>'); margin-right: 25px;">

                </div>
                <span style="font-size: 9px;">
                    <?php echo date('m-d-Y H:i', strtotime($msg->created)); ?>
                </span>
            </div>
            <div class="talent_message" style="max-width: 42%; float: left; position: relative;">
                <span class="font_12">
                    <?php echo $msg->message; ?>
                </span>
                <i style="position: absolute; left: -6px; top: 10px; color: #f8f8f8;" class="fa fa-caret-left"></i>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--talent end-->
        <?php
    }
}
?>

