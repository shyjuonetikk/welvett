<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<style>
    small span{
        margin: 0 10px;
    }
</style>
<?php

use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

$userId = $this->request->session()->read('Auth.User.id');

$conn = ConnectionManager::get('default');
$query = $conn->execute("SELECT `u`.*, `r`.* FROM `users` AS `u` 
INNER JOIN `roles` AS `r` ON `u`.`role_id` = `r`.`id`
WHERE `u`.`id` = '$userId'");

$row = $query->fetch('assoc');
$roleId = $row['role_id'];
$role = $row['name'];
$img = 'cyber1550500683.png';

$userImagePath = '';
$loginWithSocial = $row['loginwithsocial'];
$userImagePath = $row['profile_image'];
if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

    $userImagePath = $row['profile_image'];
} else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
    if ($row['profile_image'] == '') {

        $userImagePath = $this->request->webroot . 'img/users/' . $img;
    } else {
        $userImagePath = $this->request->webroot . 'img/users/' . $userImagePath;
    }
} else {
    $userImagePath = $this->request->webroot . 'img/users/' . $img;
}
?>
<section class="content-wrapper content_bg">
    <div class="container">
        <div class="clearfix">&nbsp;</div>
        <div class="col-md-12 col-lg-12 col-xl-12" style="padding-bottom: 10px;text-align:right;">
            <a onclick="window.history.back()"><i class="fa fa-angle-left"></i>&nbsp;Go back</a>
        </div>
        <div class="row">
            <!--messages start-->
            <div class="col-md-4 col-lg-3 col-xl-3">
                <div class="bg-white pd_lr_20 box_shadow" style="min-height: 500px; position: relative; padding-bottom: 20px;">
                    <div class="text-center heading_color" style="padding-top: 10px;">
                        <h3><strong>Messages</strong></h3>
                    </div>

                    <button class="show_xs_message">Start Conversation</button>
                    <div class="user_chat_list">
                        <div id="user_list_height" class="pd_top_20 custom_scroll sb-container">
                            <?php
                            foreach ($talentDiscussion as $talent) {
                                //debug($talent);
                                $path = '';
                                $loginWithSocial = $talent->talent['loginwithsocial'];
                                $path = $talent->talent['profile_image'];
                                $image = 'cyber1550500683.png';
                                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                                    $path = $talent->talent['profile_image'];
                                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                    if ($talent->talent['profile_image'] == '') {

                                        $path = $this->request->webroot . 'img/users/' . $image;
                                    } else {
                                        $path = $this->request->webroot . 'img/users/' . $path;
                                    }
                                } else {
                                    $path = $this->request->webroot . 'img/users/' . $image;
                                }
                                ?>
                                <a href="<?php echo $this->request->webroot; ?>Users/messages/<?php echo $talent->id; ?>">
                                    <div data-booking="<?php echo $talent->id; ?>" class="row load_messages">
                                        <div class="col-md-4">
                                            <div class="user_images_parent">
                                                <div class="user_images" style="background-image: url('<?php echo $path; ?>');">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 font_12 pd_0">
                                            <strong><?php echo $talent->talent->full_name; ?></strong><br>
                                            <span class="paragraph_color">
                                                <?= $talent->title; ?>
                                            </span>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                                <div class="clearfix">&nbsp;</div>

                            <?php } ?>


                        </div>

                        <div class="search_user">
                            <span style="position: relative;">
                                <input type="text" class="form-control custom_input_search" placeholder="Search">
                                <i style="" class="search_icon fa fa-search"></i>
                            </span>
                        </div>
                    </div>

                </div>

            </div>
            <!--messages end-->
            <div class="clearfix show_xs">&nbsp;</div>
            <!--conversation start-->
            <div class="col-md-8 col-lg-9 col-xl-9">
                <div class="bg-white" style="min-height: 500px; position: relative;">
                    <?php
                    if (isset($bookingId)) {
                        // debug($talentInfo);
                        $path = '';
                        $loginWithSocial = $talentInfo[0]->talent->loginwithsocial;
                        $path = $talentInfo[0]->talent->profile_image;
                        $image = 'cyber1550500683.png';
                        if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                            $path = $talentInfo[0]->talent->profile_image;
                        } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                            if ($talentInfo[0]->talent->profile_image == '') {

                                $path = $this->request->webroot . 'img/users/' . $image;
                            } else {
                                $path = $this->request->webroot . 'img/users/' . $path;
                            }
                        } else {
                            $path = $this->request->webroot . 'img/users/' . $image;
                        }
                        ?>
                        <!--header start-->
                        <div class="" style="border-bottom: 1px solid #eaeaea;">
                            <div class="row" id="profile_header">
                                <div class="col-md-12" style="border-right: 1px solid #eaeaea; padding: 7px 30px;">
                                    <div class="user_images" style="background-image: url('<?php echo $path; ?>'); display: inline-block; float: left; margin-right: 15px;">
                                    </div>
                                    <div style="display: inline-block; padding-top: 10px;">
                                        <strong>
                                            <?php echo $talentInfo[0]->talent->full_name; ?>
                                            <small data-toggle="tooltip" data-original-title="Booking Title" title="">

                                                <?= ($booking_detail->title) ? '<span> - </span>' . $booking_detail->title : ''; ?>
                                            </small>
                                        </strong>

                                    </div>
                                </div>

                                <!--                                <div class="col-md-2 text-center" style="border-right: 1px solid #eaeaea; padding-top: 15px;">
                                                                    <a href="" style="color: #cdcdcd">
                                                                        <img style="height: 30px;" src="<?php // echo $this->request->webroot                                                                                      ?>img/event/<?php echo $talentInfo[0]->talent->employee_member->eventcategory->image_icon; ?>" alt=""> 
                                <?php
//                                        echo $talentInfo[0]->talent->employee_member->eventcategory->title;
                                ?>
                                                                    </a>
                                                                </div>-->
                                <!--                                <div class="col-md-2 text-center" style="border-right: 1px solid #eaeaea; padding-top: 15px;">
    <i style="color: #8a8a92" class="fa fa-star"></i>
    </div>
    <div class="col-md-2 text-center" style="padding-top: 15px;">
    <i style="color: #8a8a92" class="fa fa-ellipsis-v"></i>
    </div>-->
                            </div>
                        </div>
                        <!--header end-->

                        <div id="conversation_height" class="sb-container custom_scroll" style="padding: 15px; max-height: 420px;overflow-y: auto;">
                            <?php
                            foreach ($talentCustomerMsgs as $msg) {

                                if ($msg->user->role_id == 4) {
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

                                if ($msg->user->role_id == $this->request->session()->read('Auth.User.role_id')) {
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
                                }
                            }
                            ?>

                        </div>

                        <div class="clearfix">&nbsp;</div>
                        <!--send message-->
                        <div class="" style="border-top: 1px solid #eaeaea; position: absolute; width: 100%; bottom: 0;">
                            <form id="chatForm" method="post">
                                <div class="row send_msg_row">
                                    <div class="col-md-9 offset-md-1">
                                        <input autocomplete="off" required="required" type="text" name="message" style="border: none !important;height: 45px;" placeholder="Type your message...">
                                        <input type="hidden" name="talent_event_id" value="<?php echo $talentInfo[0]->talent_event_id; ?>">
                                        <input type="hidden" name="booking_id" value="<?php echo $bookingId; ?>">
                                    </div>
                                    <div class="col-md-1 send_msg_div">
                                        <button class="pull-right" type="submit" style="background-color: transparent; border: none;"><i class="fa fa-send send_message"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                    } else {
                        ?>
                        <h3 style="padding: 30px; text-align: center;">Please start conversation</h3>
                        <?php
                    }
                    ?>
                </div>

            </div>
            <!--conversation end-->
        </div>
        <div class="clearfix">&nbsp;</div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('div[data-booking]').click(function () {
        });
        $('input[name="message"]').focus();

        function loadMessages() {
            var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request

            var booking_id = $('input[name=booking_id]').val();
            var post_data = {
                'id': booking_id
            };
            var lmsg = "";
            var divExist = $("#conversation_height").children('.sb-content').length;
            if (divExist == 0) {
                var chatBox = $("#conversation_height");
            } else {
                var chatBox = $("#conversation_height").children('.sb-content');
            }
            if (booking_id != "") {
                $.post("<?php echo $this->request->webroot ?>Users/loadLatestMessages", post_data, function (response) {
                    chatBox.html(response); //Insert chat log into the #chatbox div	
                    //Auto-scroll			
                    chatBox.scrollTop(chatBox[0].scrollHeight);
                });
            }
        }
        setInterval(loadMessages, 5000);

        $('#chatForm').submit(function () {
            var msg = $.trim($("#chatForm input[name=message]").val());

            var d = new Date();
            var time = d.getHours() + ":" + d.getMinutes();
            var month = d.getMonth() + 1;
            var day = d.getDate();
            var booking_id = $('input[name=booking_id]').val();
            var completeDate = (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day + '-' + d.getFullYear() + ' ' + time;
            $("#chatForm input[name=message]").val("");
            var avatar = "<?php echo $userImagePath; ?>";
            var divExist = $("#conversation_height").children('.sb-content').length;
            if (divExist == 0) {
                var chatBox = $("#conversation_height");
            } else {
                var chatBox = $("#conversation_height").children('.sb-content');
            }
            var listing = '<div style="margin-bottom: 15px;">\n\
                                        <div style="float: right; text-align: right;">\n\
                                            <div class="customer_profile_for_message" style="background-image: url(' + avatar + '); margin-left: 25px;">\n\
                                            </div>\n\
                                            <span style="font-size: 9px;">'
                    + completeDate +
                    '</span>\n\
                                        </div>\n\
                                        <div class="customer_message" style="max-width: 42%; float: right; position: relative;">\n\
                                            <span class="font_12">'
                    + msg +
                    '</span>\n\
                                            <i style="position: absolute; right: -5px; top: 10px; color: #7c1b2e;" class="fa fa-caret-right"></i>\n\
                                        </div>\n\
                                        <div class="clearfix"></div>\n\
                                    </div>';
            chatBox.append(listing);
            chatBox.scrollTop(chatBox[0].scrollHeight);

            $.post("<?php echo $this->request->webroot ?>Users/saveMessage", {message: msg, id: booking_id}, function (response) {
                response = JSON.parse(response);
                if (response.flag == "success") {
                    chatBox.scrollTop(chatBox[0].scrollHeight);
                } else {
                    show_custom_message(response.message);
                }
                //setInterval (loadMessages, 2500);
            });

            return false;
        });

    });
</script>