<?php
$isEdit = 1;
//debug($user);
?>
<style>
    .dynamic_cities{
        padding: 0;
        width:100%;
        margin-bottom: 0; 
    }
    .dynamic_cities li{
        padding-left:10px;
        border-bottom: 1px solid #eee;
    }
    .dynamic_cities li:hover{
        background-color: #eeeeee4d;
    }
    .search-result{
        background-color: white;
        min-height: 0;
        max-height: 200px;
        overflow: auto;
        border: 2px solid #ddd;
        border-top: none;
        position: absolute;
        z-index: 1;
        top: 30px;
        width: 94%;
    }
    .searched_user p{
        margin:0;
    }
    .searched_user{
        cursor: pointer;
    }
    .search-box{
        width: 100%;
    }
    #subt{
        border: none;
        color:gray;
        padding: 3px 8px;
        background-color: white;
        border-radius: 3px; 
    }
    .filter-icon{
        background-color: unset;
        color: white;
        padding: 0;
        border-right: none !important;
        margin-left: 10px;
    }
    .filter-icon:hover{
        color:white !important;
    }
    .search-result ul{
        margin: 0;
    }
    .unread{
        color:black !important;
    }
    #basic_info div.row > div {
        padding-top: 0;
    }
</style>
<style>
    .custom_table td{
        border-bottom: 1px solid #7B1B2D;
    }
    .custom_table >thead > tr td{
        color:#7B1B2D;
        font-size: 13px !important;
    }
</style>
<style>
    #basic_info span, #basic_info input, #basic_info textarea, #basic_info select {
        color:#ccc !important;
    }
    .clientele_style{
        padding: 3px;
    }
    .my_checkbox{
        color:#ccc !important;
        font-size: 13px;
    }
    .refLink{
        color:#ccc;
        white-space: nowrap;
    }
    .refLink:hover{
        color:#ccc !important;
        text-decoration: underline;
    }
</style>
<header>
    <div class="container-fluid top-member-area colored-maroon">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-header-section">
                    <!--                    <div class="branding">
<a class="navbar-brand" href="<?php echo $this->request->webroot; ?>">
<img src="<?php echo $this->request->webroot ?>assets/images/logo.png" class="image-responsive"  />
</a>
</div>-->
                    <div class="top-member-menu">
                        <div class="text-center" id="basic_info">
                            <form id="dashboard_service">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <?php
                                        $image = $user->profile_image;
                                        if ($user->profile_image && file_exists(WWW_ROOT . 'img/users/' . $user->profile_image)) {
                                            $image = $this->request->webroot . 'img/users/' . $user->profile_image;
                                        }
                                        ?>
                                        <div id='' class="event_image unique_pic" style="float: right; width:120px;height:120px;background-position: center;background-size:cover;border: 1px solid #511723;background-image: url('<?php echo $image; ?>'); position: relative;">
                                            <i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#image_modal" style="top: 90px;right: 15%;bottom: unset;"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="p_img_text" style=" text-align:right; margin-right: 15%;">
                                            <span style="font-size:14px;border-bottom: none !important;">Profile Image</span>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-lg-8">

                                        <div class="row user_profile_info">
                                            <div class="col-md-6 col-lg-6 text-right" style="margin-bottom:8px;">
                                                <span style="position: relative;">
                                                    <?php
                                                    if ($isEdit == 1) {
                                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                                    }
                                                    ?>
                                                    First Name
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-left" >

                                                <input name="first_name" id="first_name" type="text" class="" readonly value="<?= $user->first_name ?>" onchange="update_field()">
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-right" style="margin-bottom:8px;">
                                                <span style="position: relative;">
                                                    <?php
                                                    if ($isEdit == 1) {
                                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                                    }
                                                    ?>
                                                    Last Name
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-left">
                                                <input name="last_name" id="last_name" type="text" class="" readonly value="<?= $user->last_name ?>">
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-right" style="margin-bottom:8px;">
                                                <span style="position: relative;">
                                                    <?php
                                                    if ($isEdit == 1) {
                                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                                    }
                                                    ?>
                                                    Email
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-left">
                                                <input name="email" id="email" type="text" class="" readonly value="<?php echo $user->email; ?>">
                                            </div>


                                            <div class="col-md-6 col-lg-6 text-right" style="margin-bottom:8px;">
                                                <span style="position: relative;">
                                                    <?php
                                                    if ($isEdit == 1) {
                                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                                    }
                                                    ?>
                                                    Phone Number
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-left">
                                                <input id="phone1" name="phone" type="text" class="" readonly value="<?= $user->phone1 ?>">
                                            </div>

                                            <div class="col-md-6 col-lg-6 text-right" style="margin-bottom:8px;">
                                                <span style="position: relative;">
                                                    <?php
                                                    if ($isEdit == 1) {
                                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                                    }
                                                    ?>
                                                    Street Address
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-left">
                                                <input name="address1" type="text" class="" readonly value="<?= $user->address1 ?>">
                                            </div>

                                            <div class="col-md-6 col-lg-6 text-right" style="margin-bottom:8px;">
                                                <span style="position: relative;">
                                                    <?php
                                                    if ($isEdit == 1) {
                                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                                    }
                                                    ?>
                                                    Street Address2
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-left">
                                                <input name="appartment" type="text" class="" readonly value="<?= $user->appartment ?>">
                                            </div>

                                            <div class="col-md-12 col-lg-12 text-left">
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-6 text-right" style="margin-bottom:8px;">
                                                        <span style="position: relative;">
                                                            <?php
                                                            if ($isEdit == 1) {
                                                                echo '<i class="fa fa-pencil edit_service"></i>';
                                                            }
                                                            ?>
                                                            Service
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 text-left">
                                                        <input type="hidden" name="service_id" value="<?= $user->talent_events[0]->id ?>">
                                                        <select id="event_categories" name="event_categories" disabled>
                                                            <?php foreach ($services as $k => $s): ?>
                                                                <option value="<?= $k ?>" <?= ($user->talent_events[0]->eventcategory_id == $k) ? 'selected' : '' ?> ><?= $s ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 text-right edit_sub_cat" style="margin-bottom:8px;display: none;">
                                                        <span style="position: relative;">
                                                            <?php
                                                            //                                                        if ($isEdit == 1) {
                                                            //                                                            echo '<i class="fa fa-pencil edit_info"></i>';
                                                            //                                                        }
                                                            ?>
                                                            Sub Services
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 text-right edit_sub_cat" style="margin-bottom:8px;display: none;">    
                                                        <div class="row" id="show_sub_categories" >
                                                            <?php
                                                            foreach ($sub as $sub_k => $s):
                                                                $checked = '';
                                                                if (in_array($sub_k, $mysub)) {
                                                                    $checked = 'checked';
                                                                }
                                                                ?>
                                                                <div class="col-md-12 text-left my_checkbox">
                                                                    <input value="<?= $sub_k; ?>" name="sub_categories[]" type="checkbox" <?= $checked; ?> > <?= $s; ?>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>  
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                    </div>
                                    <div class="col-xl-1"></div>
                                </div>
                                <hr style="border-top:1px solid #ccc;width: 80%;">
                                <div class="row">

                                    <div class="col-md-6 col-lg-4" style="text-align:right;">
                                        <span style="position: relative;">
                                            <?php
                                            if ($isEdit == 1) {
                                                echo '<i class="fa fa-pencil edit_info"></i>';
                                            }
                                            ?>Description
                                        </span>
                                    </div>
                                    <div class="col-md-6 col-lg-8 text-left">
                                        <textarea id="description" readonly name="description" style="background-color:unset !important;border-bottom: none !important;"><?= $user->employee_member->description ?></textarea>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 col-lg-4" style="text-align:right;">
                                        <span style="position: relative;">
                                            <?php
                                            if ($isEdit == 1) {
                                                echo '<i class="fa fa-pencil edit_info"></i>';
                                            }
                                            ?>
                                            Booking Requirement
                                        </span>
                                    </div>
                                    <div class="col-md-6 col-lg-8 text-left">
                                        <textarea id="booking_requirement" readonly name="booking_requirement" style="background-color:unset !important;border-bottom: none !important; min-height:50px"><?= $user->talent_events[0]->booking_requirement ?></textarea>
                                    </div>
                                    <!--<div class="clearfix">&nbsp;</div>-->

                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-lg-4" style="text-align:right;">
                                        <span style="position: relative;">
                                            Social media
                                        </span>
                                    </div>
                                    <div class="col-md-6 col-lg-8 text-left">
                                        <?php
                                        if ($user->howtologin == 'login with google') {
                                            ?>
                                            <span class="fa fa-google-plus-square" style="font-size:24px;border-bottom: none !important;"></span>
                                        <?php } ?>
                                        <?php
                                        if ($user->howtologin == 'login with twitter') {
                                            ?>
                                            <span class="fa fa-twitter twitter" style="font-size:24px;border-bottom: none !important;"></span>
                                        <?php } ?>
                                        <?php
                                        if ($user->howtologin == 'login with instagram') {
                                            ?>
                                            <span class="fa fa-instagram" style="font-size:24px;border-bottom: none !important;"></span>
                                        <?php } ?>
                                        <?php
                                        if ($user->howtologin == 'login with facebook done') {
                                            ?>
                                            <span class="fa fa-facebook" style="font-size:24px;border-bottom: none !important;"></span>
                                        <?php } ?>
                                    </div>

                                    <!--<div class="clearfix">&nbsp;</div>-->
                                </div>
                            </form> 
                            <hr style="border-top:1px solid #ccc;width: 80%;">
                            <div class="row">
                                <div class="col-md-6 col-lg-4" style="text-align:right;">
                                    <span  data-toggle="modal" data-target="#referenceModal" style="position:relative;cursor: pointer"> 
                                        Add Reference link
                                    </span>
                                </div>
                                <div class="col-md-6 col-lg-8" style="text-align:left;">
                                    <div class="row">
                                        <?php foreach ($referenceLinks as $rl): ?>
                                            <div class="col-md-12" style="padding:0;">
                                                <a href="<?= $rl->link ?>" class="refLink" target="_blank"><?= $rl->title ?></a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 text-right" style="margin-bottom:8px;">    
                                <button type="button" id="submit_dashboard_service" style="display:none;border:none; color:black; background:#white; border-radius: 3px; font-size: 12px; padding: 2px 15px;cursor: pointer;">Save</button> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="col-lg-6">
                <div class="right-header-section colored-light-grey" style="padding-top:20px">
                    <div class="row">
                        <div class="col-md-12" style="text-align:center;">
                            <img style="max-width: 100%;" src="<?php echo $this->request->webroot; ?>img/map.png">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="text-align:center;">
                            <span style="color:#7B1B2D;font-size: 22px;">Choose your Customer</span>
                            <br/>
                        </div>
                    </div>
                    <form id="client_type_form">
                        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12 col-xs-12 offset-md-2 offset-lg-2 box_bg" style="background-color: #7B1B2D !important;margin-top:20px;padding: 0;box-shadow: 3px 3px 10px #ccc;">
                            <div class="row" style="padding: 7px 15px;">
                                <?php
                                $both = '';
                                if ($user->talent_events[0]->client_type == null) {
                                    $both = 'checked';
                                }
                                ?>
                                <div class="col-md-12 col-lg-12 col-xl-6">
                                    <label class="clientele_style" style="width: 100%;margin: 5px 0;box-shadow: unset;" for="individual"> Individual Member
                                        <input type="hidden" name="event_id" value="<?php echo $user->talent_events[0]->id; ?>" >
                                        <input class="pull-right" type="checkbox" name="client_type[]" value="2" id="individual" <?= (isset($user->talent_events[0]->client_type) && $user->talent_events[0]->client_type == 2) ? 'checked' : ''; ?> <?= $both ?> >
                                    </label> 
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-6">

                                    <label class="clientele_style" style="width: 100%;margin: 5px 0;box-shadow: unset;" for="corporate"> Corporate Member 
                                        <input class="pull-right" type="checkbox" name="client_type[]" value="3" id="corporate" <?= (isset($user->talent_events[0]->client_type) && $user->talent_events[0]->client_type == 3) ? 'checked' : ''; ?> <?= $both; ?> >
                                    </label>
                                </div>

                            </div>
                            <div class="row" style="padding: 5px 10px;">

                                <div class="col-md-12" style="text-align: center;margin-bottom:10px;">
                                    <button type="button" type="button"  id="clienttype" style="border:none; color:black; background:#white; border-radius: 3px; font-size: 12px; padding: 2px 15px;cursor: pointer;">Save</button>
                                </div>  
                            </div>  


                            <!--<div class="col-md-4 col-lg-4 col-xl-4 col-sm-0 col-xs-0"></div>-->
                        </div>               
                    </form>

                    <div class="row">
                        <div class="col-md-12" style="margin: 15px 0;text-align:center;">
                            <span style="color:#7B1B2D;font-size: 22px;">Which cities would you like to attend an event in?</span>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row" style="padding: 20px 10px;box-shadow: 3px 3px 10px #ccc;">
                            <div class="col-lg-12" style="text-align:center;margin-bottom: 10px;">
                                <span style="color:#7B1B2D">Add cities and accommodation</span>
                            </div>
                            <div class="col-lg-12" style="max-height:130px;overflow: auto;">

                                <table class="table custom_table" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <td>City</td>
                                            <td>State</td>
                                            <td>Price</td>
                                            <td>Action</td>
                                        </tr>

                                    </thead>
                                    <tbody id="accomodation_cities">
                                        <?php
                                        foreach ($cities as $city_events):
                                            ?>
                                            <tr style="">
                                                <td style="width:60px;"><?= h($city_events['city']) ?></td>
                                                <td style="width:60px;"><?= h($states[$city_events['state_id']]) ?></td>
                                                <td style="width:60px;"><?= h($city_events['accommodation_price']) ?></td>
                                                <td style="width:60px;">
                                                    <input type="hidden" class="event_city_id" value="<?php echo $city_events['id']; ?>">
                                                    <i class="fa fa-trash-o delete_acco_city cities_links" style="margin-bottom: 2px;"></i>
                                                    <i class="fa fa-edit cities_links" onclick='edit_city(<?= $city_events['id'] ?>)'></i>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <a class="" href=""  data-toggle="modal" data-target="#myModal2" style="border:none;color:#7b1b2d; background: none;font-size: 12px; width: 70px;height: 25px; margin-left: 5px; padding-left: 15px;"> <span class="plus_bg"><i class="fa fa-plus plus_color"></i></span> Add cities</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="text-align:center;margin:15px 0;">
                            <span style="color:#7B1B2D;font-size: 22px;"><?= $user->employee_member->eventcategory->title; ?>&nbsp; Booking price</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <form action="" id="set_amount">
                            <div class="row">
                                <div class="col-md-3 col-lg-1"></div>
                                <div class="col-md-6 col-lg-10">
                                    <div class="row" style="padding: 20px;box-shadow: 3px 3px 10px #ccc;">
                                        <div class="col-md-2"></div>
                                        <div class="booking_price booking_price_responsive col-md-8"  style="margin:10px auto;padding: 10px;">
                                            <div class="row booking_box_responsive">
                                                <div class="col-md-3">
                                                    <span class="input-group-btn">
                                                        <button style="padding: 3px 8px;" type="button" class="inc_dec btn-number" disabled="disabled" data-type="minus" data-field="set_amount">
                                                            <span class="fa fa-minus"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="col-md-6" style="padding:0;">
                                                    <span id="bookingamount" style="">
                                                        <?php
                                                        $amount = 0;
                                                        if (!empty($user->talent_events[0]->event_types)) {
                                                            $amount = $user->talent_events[0]->event_types[0]->amount;
                                                        }
                                                        ?>
                                                        <input type="hidden" name="service_id"  value="<?php echo $user->talent_events[0]->id; ?>">
                                                        <span style="margin:0 5px;">$</span><input style="background: transparent;width: 50%!important" type="text" name="set_amount" class="inc_dec_field input-number"  value="<?php echo $amount; ?>" min="1" max="10000" >
                                                    </span>
                                                </div>
                                                <div class="col-md-3">

                                                    <span class="input-group-btn">
                                                        <button style="padding: 3px 8px;" type="button" class="inc_dec btn-number" data-type="plus" data-field="set_amount">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </span> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>


                                        <div class="col-md-12" style="padding:0;text-align: left;color:#7B1B2D;">
                                            <?php
                                            $c = '';
                                            if (empty($user->talent_events[0]->event_types)) {
                                                $c = 'checked';
                                            }
                                            ?>
                                            <div class="row event_type_responsive">
                                                <!--<div class="col-md-2"></div>-->
                                                <div class="col-md-6" style="text-align: right">
                                                    <label class="font_12" for="event_type_hourly" style="margin:0;">
                                                        <input id="event_type_hourly" type="radio" name="event_type" value="1" <?= (isset($user->talent_events[0]->event_types[0]) && $user->talent_events[0]->event_types[0]->event_type == 1) ? 'checked' : ''; ?> <?= $c; ?> >
                                                        Hourly
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="font_12" for="event_type_whole" style="margin:0">
                                                        <input id="event_type_whole" type="radio" value="2" name="event_type" <?= (isset($user->talent_events[0]->event_types[0]) && $user->talent_events[0]->event_types[0]->event_type == 2) ? 'checked' : ''; ?> > 
                                                        Whole Event 
                                                    </label>
                                                </div>
                                                <!--<div class="col-md-2"></div>-->

                                            </div>
                                        </div>

                                        <div class="col-md-12" style="text-align:center;padding: 0;">
                                            <button  class="first_dashboard_save" type="submit" >Save</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-1"></div>
                            </div>

                        </form>  

                    </div>
                    <div class="col-md-12" style="text-align:center;margin:15px auto;">
                        <a href="<?php echo $this->request->webroot; ?>EmployeeMembers/services" style="color:#7B1B2D;font-size: 18;">Go to my services</a>
                    </div>

                </div>
            </div>
            <div class="modal fade" id="image_modal" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                            <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                            <h5 class="modal-title">Change Image</h5>
                        </div>
                        <?php echo $this->Form->create('message_edit_form', array('id' => 'edit_image', 'type' => 'file')); ?>

                        <div class="modal-body">
                            <div class="row">
                                <label for="message" class="col-md-3 control-label">Select Image</label>
                                <div class="col-md-9">
                                    <?php echo $this->Form->control('image', array('id' => 'sectionImage', 'type' => 'file', 'div' => false, 'label' => false, 'required', 'style' => 'border-bottom:unset !important;', 'onchange' => "readURL(this)")); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <img id="show_section_uploaded_image" width="200" src=""  class="section-up-image" alt=""/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="text-align:right">
                            <?php
                            echo $this->Form->button('Update Image', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-default btn-sm', 'id' => 'register'));
                            ?>
                            <button type="button"  class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit_city_modal" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                            <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                            <h5 class="modal-title">Edit City</h5>
                        </div>


                        <div class="modal-body">
                            <form id="edit_city_form" method="post" action="<?php echo $this->request->webroot ?>EmployeeMembers/edit_cities">

                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="pro_dashboard" value="1">
                                        <input type="hidden" name="city_id"  value="" placeholder=""  class=""  style=" "/>
                                        <input type="text" name="city_name"   placeholder="city"  class="custom_field"  required  style="height: 35px;" data-original-title="This Field is required" title="">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="city_amount"  placeholder="amount"  class="custom_field" required  style="height: 35px;">
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-md-12" style="text-align: right;margin-top: 15px;">
                                    <button type="button" class="btn btn-default btn-sm" type="submit"  id="editcities">Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal fade" id="myModal2" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                            <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                            <h5 class="modal-title">Add Cities and Accommodation</h5>
                        </div>


                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <form action="<?php echo $this->request->webroot ?>EmployeeMembers/addcities/pro_dashboard" id="add_name" method="post">
                                        <input type="hidden" name="talent"  value="<?php echo $user->talent_events[0]->id; ?>" placeholder=""  class=""  style=" "/>
                                        <table class="table table-bordered" id="dynamic_field" style="">
                                            <thead>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Acco &#36;</th>
                                            <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="position:relative;">
                                            <!--<input type="text" name="name[]" style="height: 25px;" placeholder="city" class="custom_field" data-original-title="This Field is required" title="" />-->
                                                        <div class="search-box" style="background:unset;">
                                                            <input name="name[]" class="custom_field searching" autocomplete="off" placeholder="City" required="required" id="city" type="text">
                                                            <?= $this->Form->hidden('check_city'); ?>
                                                        </div> 
                                                        <div class="search-result" id="search-result" style="border:none;">
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select name="state_id[]" class="minimal" required="required" id="state" style="border:none;">
                                                            <option value="">- State -</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="amount[]"  placeholder="amount" class="custom_field" required style="height: 25px;" />
                                                    </td>
                                                    <td>
                                                        <span style="padding: 4px; margin-left: 10px;" id="" onclick="btn_remove()" class="fa fa-trash-o btn_remove"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>


                            </div>

                        </div>
                        <div class="modal-footer" style="text-align:right">

                            <button type="button" class="btn btn-default btn-sm"  name="add" id="add">Add More</button>
                            <button type="button" class="btn btn-default btn-sm" type="submit"  id="addcities">Save</button>

                            <button type="button" class="btn btn-default btn-sm" id='close' data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal fade" id="referenceModal" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                            <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                            <h5 class="modal-title">Add Any reference link if you have</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="referenceLinkForm" action="<?php echo $this->request->webroot ?>EmployeeMembers/addReference/pro_dashboard" method="post">
                                        <div class="row">
                                            <label for="title" class="col-md-12">
                                                Title   
                                            </label>
                                            <div class="col-md-12">
                                                <input type="hidden" name="talent_event_id" value="<?php echo $user->talent_events[0]->id; ?>">
                                                <input class="custom_field" name="title" style="width:100%" required>   
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="title" class="col-md-12">
                                                Reference link   
                                            </label>
                                            <div class="col-md-12">
                                                <input class="custom_field" name="link" style="width:100%" required>   
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-12" style="text-align:right">
                                                <button class="btn btn-default">Submit</button>   
                                            </div>                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
</header>

<script>
    function isUrlValid(url) {
        return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
    }
    function edit_city(c_id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->request->webroot ?>EmployeeMembers/get_city',
            data: 'id=' + c_id,
            success: function (data)
            {
                data = JSON.parse(data);
                if (data != 'error') {
                    $('#edit_city_form input[name=city_id]').val(data.id);
                    $('#edit_city_form input[name=city_name]').val(data.city);
                    $('#edit_city_form input[name=city_amount]').val(data.accommodation_price);
                    $('#edit_city_modal').modal('show');
                } else {
                    show_custom_message('Record not found');

                }

            }
        });
    }
    function readURL(input, showId = null) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(input.files[0]);   
            reader.onload = function (e) {
                if (input.id == "sectionImage") {
                    $('#show_section_uploaded_image').attr('src', e.target.result);
                }
            };
            reader.readAsDataURL(input.files[0]);
    }
    }
    function btn_remove(btn) {
        $('#row' + btn).remove();
    }
    function put_value(value, dynamic_val) {
        if (typeof dynamic_val == 'undefined') {
            dynamic_val = '';
        }
        $('#city' + dynamic_val).val(value);
        $('input[name=check_city' + dynamic_val + ']').val(1);
        $('#search-result' + dynamic_val).hide();
        $('#search-result' + dynamic_val).css({'border': 'none'});

    }
    $(document).ready(function (e) {
        $('#referenceLinkForm').submit(function () {
            var url = $('#referenceLinkForm input[name=link]').val();
            if (isUrlValid(url)) {
            } else {
                show_custom_message('Invalid url');
                return false;
            }
        });
        $('#editcities').click(function () {
            if (!$('#edit_city_form input[name=city_name]').val()) {
                $('input[name=city_name]').tooltip("show");
                return false;
            }
            $('#edit_city_form').submit();
        });

        $('.edit_service').click(function () {
            $('#event_categories').removeAttr("disabled");
            $('.edit_sub_cat').show();

        });
        var phone_pat = /^\(?(\d{3})\)?[-\. ]?(\d{3})[-\. ]?(\d{4})$/;
        $('#submit_dashboard_service').click(function () {
            var phone = $("#phone1").val();

            if (!phone_pat.test(phone)) {

                show_custom_message('Invalid phone format.');
            } else {
                $.ajax({
                    url: "<?php echo $this->request->webroot . 'EmployeeMembers/update_services_dashboard' ?>",
                    type: "GET",
                    data: $('#dashboard_service').serialize(),
                    success: function (data)
                    {
                        data = JSON.parse(data);
                        if (data.flag == 1) {

                            show_custom_message(data.message);

                            $('#description, #booking_requirement').css({
                                'min-height': '0px'
                            });

                            $('#event_categories').prop("disabled", true);
                            $('.edit_sub_cat').hide();
                            $('#submit_dashboard_service').hide();
                            $('#dashboard_service input,select,textarea').css({
                                'outline': 'unset',
                            });
                        } else {
                            show_custom_message(data.message);
                        }
                    }

                });
            }
        });


        $('.edit_service, .edit_info').click(function () {
            $('#submit_dashboard_service').show();
            $('#basic_info input, #basic_info select, #basic_info textarea').attr('readonly', false);
            $('#basic_info input:not(:checkbox), #basic_info select').css({
                "outline": "1px solid #ccc",
                'height': '20px',
                'padding': '0px 10px'
            });
        });

        $('select[name=event_categories]').change(function () {

            $.ajax({
                url: "<?php echo $this->request->webroot . 'EmployeeMembers/findSubServices/dashboard' ?>",
                type: "POST",
                data: {'service_id': $(this).val()},
                success: function (data)
                {
                    var data = JSON.parse(data);


                    $('#show_sub_categories').html(data);
                }

            });
        });

        $(document).on('click', '.delete_acco_city', function () {
            var eventCityId = $(this).siblings().val();

            if (eventCityId !== "") {

                $.ajax({
                    url: "<?php echo $this->request->webroot . 'EmployeeMembers/deleteAccoCity' ?>",
                    type: "POST",
                    data: {
                        'id': eventCityId
                    },
                    cache: false,
                    async: false,
                    success: function (data)
                    {
                        data = JSON.parse(data);
                        console.log(data);
                        if (data[0] === 'success') {
                            $('#accomodation_cities').html(data[1]);
                            show_custom_message('City has been deleted.');
                        } else if (data[0] === 'error') {
                            show_custom_message('At least one city required for service.');
                        }

                    }

                });

            }
        });
        $('#clienttype').click(function () {

            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/clienttype/pro_dashboard',
                data: $('#client_type_form').serialize(),
                contentType: 'json',
                success: function (data)
                {
                    var data = JSON.parse(data);
                    if (data.flag == 1) {
                        show_custom_message(data.message);
                    } else {
                        show_custom_message(data.message);
                    }
                }
            });
        });

        $('#add').click(function () {
            var i = $('#add_name input[name="name[]"]').length;
            var row = '<tr id="row' + i + '">';
            row = row + '<td style="position:relative;">'
                    + '<div class="search-box" style="background:unset;">'
                    + '<input name="name[]" dynamic_val="' + i + '" class="custom_field searching" autocomplete="off" placeholder="City" required="required" id="city' + i + '" type="text">'
                    + '<input name="check_city' + i + '" type="hidden"></div>'
                    + '<div class="search-result" id="search-result' + i + '" style="border: medium none;"></div>'
                    + '</td><td>'
                    + '<select name="state_id[]" class="minimal" required="required" id="state' + i + '" style="border:none;">'
                    + ' <option value="">- State -</option>'
                    + '</select>'
                    + ' </td>'
                    + '<td>'
                    + '<input name="amount[]" placeholder="amount" class="custom_field" required="" style="height: 25px;" type="text">'
                    + '</td>'
                    + ' <td>'
                    + '<span style="padding: 4px; margin-left: 10px;" id = "' + i + '" onclick = "btn_remove(' + i + ')" class="fa fa-trash-o btn_remove"></span>'
                    + '</td>'
                    + '</tr>';

            $('#dynamic_field').append(row);
        });
        $('#addcities').click(function () {
            var check = 0;
            $('#add_name input[name="name[]"]').each(function () {
                if (!$(this).val())
                {
                    check = 1;
                    $(this).tooltip("show");
                    $(this).focus();
                    return false;
                }

            });
            if (check == 0) {
                $('#add_name').submit();
            }
        });
        $('input[name=event_type]').change(function () {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/booktype',
                data: $('#set_amount').serialize() + '&fetch_amount=1',
                contentType: 'json',
                success: function (data)
                {
                    //                    alert($('input[name=event_type]:checked').val());
                    //                    if (data != 0) {
                    $('input[name=set_amount]').val(data);
                    //                    }
                }
            });

        });

        $('#set_amount').submit(function () {

            if (typeof $('input[name=event_type]:checked').val() == 'undefined') {
                show_custom_message('Please select Event Type');
                return false;
            }
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/booktype',
                data: $('#set_amount').serialize(),
                contentType: 'json',
                success: function (data)
                {
                    var msg = '';
                    if ($('input[name=event_type]:checked').val() == 1) {
                        msg = 'Hourly booking price hasbeen saved';
                    }
                    if ($('input[name=event_type]:checked').val() == 2) {
                        msg = 'Booking price for whole event is saved';
                    }
                    if (data == 1) {
                        show_custom_message(msg);
                    }
                }
            });
            return false;
        });
        //plugin bootstrap minus and plus
        //http://jsfiddle.net/laelitenetwork/puJ6G/
        $('.btn-number').click(function (e) {
            e.preventDefault();
            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {
                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {

                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function () {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                $(this).val($(this).data('oldValue'));
            }


        });
        $("#edit_image").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo $this->request->webroot . 'CorporateMembers/editImage' ?>",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    data = JSON.parse(data);
                    if (data[0] == 'success') {
                        $('#profile_image_div').css('background-image', "url('" + data[1] + "')");
                        $('#myModal').modal('hide');
                        show_custom_message('Profile image changed.');
                    } else {

                    }
                },
                error: function (e)
                {

                }
            });
            return false;
        }));

        $('.edit_info').click(function () {
            $('#basic_info input, #basic_info select, #basic_info textarea').attr('readonly', false);
            $('#event_categories').removeAttr("disabled");
            $('.edit_sub_cat').show();

            var reference = $(this).parent().parent().next().children();
            $(reference).attr('readonly', false);
            var field = $(reference).attr('id');
            $(reference).focus();


            $('#description, #booking_requirement').css({
                "outline": "1px solid #ccc",
                'min-height': '100px',
                'padding': '3px',
                'margin-bottom': '5px'
            });


            $('#basic_info input:not(:checkbox), #basic_info select').css({
                "outline": "1px solid #ccc",
                'height': '20px',
                'padding': '0px 10px'
            });

        });

    });
    $(document).ready(function () {
//                $('.searching').focusout(function () {
        $(document).on('focusout', '.searching', function () {
            var searching = $(this);
            var dynamic_val = searching.attr('dynamic_val');
            if (typeof searching.attr('dynamic_val') == 'undefined') {
                dynamic_val = '';
            }

            setTimeout(function () {
                $('#search-result' + dynamic_val).hide();
                $('#search-result' + dynamic_val).css({'border': 'none'});

                if ($('input[name=check_city' + dynamic_val + ']').val() == 0) {
                    searching.val('');
                } else {
                    $.ajax({
                        type: 'GET',
                        url: '<?php echo $this->request->webroot ?>Users/search_states',
                        data: 'field=' + searching.val(),
                        contentType: 'json',
                        success: function (data)
                        {
                            data = JSON.parse(data);
//alert(dynamic_val);
//                                    if ($('select[name="state_id[]"]').length != 0) {
                            $('#state' + dynamic_val).empty();
                            $('#state' + dynamic_val).append($("<option></option>").attr("value", '').text('- State -'));
                            $.each(data, function (key, value) {
                                $('#state' + dynamic_val)
                                        .append($("<option></option>")
                                                .attr("value", value.id)
                                                .text(value.statename));
                            });
//                                    } else {
//                                        $('select[name=state_id]').empty();
//                                        $('select[name=state_id]').append($("<option></option>").attr("value", '').text('- State -'));
//                                        $.each(data, function (key, value) {
//                                            $('select[name=state_id]')
//                                                    .append($("<option></option>")
//                                                            .attr("value", value.id)
//                                                            .text(value.statename));
//                                        });
//                                    }

                        }
                    });
                }
            }, 300);
        });
        $(document).on('keyup', '.searching', function () {
//                $('.searching').keyup(function () {
            var value = $(this).val();
            var dynamic_val = '';
            if (typeof $(this).attr('dynamic_val') != 'undefined') {
                dynamic_val = $(this).attr('dynamic_val');
            }
            $('#search-result' + dynamic_val).show();
            $('#search-result' + dynamic_val).css({'border': '1px solid #ccc'});
            $('input[name=check_city' + dynamic_val + ']').val(0);
            if (value != '')
            {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->request->webroot ?>Users/fetch_cities',
                    data: 'field=' + value,
                    contentType: 'json',
                    success: function (data)
                    {
                        var data = JSON.parse(data);
                        if ($.isEmptyObject(data))
                        {

                            var divsearch = $('#search-result' + dynamic_val).empty();
                            var app = "<ul class='dynamic_cities'><li class='searched_user'><p>No city found</p></li></ul>"
                            $('#search-result' + dynamic_val).append(app);

                        } else
                        {

                            $('#search-result' + dynamic_val).empty();
                            var icon;
                            var loginWithSocial;
                            var path = '';
                            var app = "<ul class='dynamic_cities'>";
                            $.each(data, function (key, value) {
                                icon = value.profile_image;
                                loginWithSocial = value.loginwithsocial;

                                $('#search-result' + dynamic_val).empty();
                                app += "<li class='searched_user'>"
                                        + "<p onclick='put_value(" + '"' + value + '"' + "," + dynamic_val + ")'>" + value + "</p>"
                                        + "</li>";
                            });
                            app += "</ul>";

                            $('#search-result' + dynamic_val).append(app);

                        }

                    }
                });
                //end
            } else {
                $('#search-result' + dynamic_val).hide();

            }

        });



        $(document).on('focus', '.searching', function () {
            var searching = $(this);
            var dynamic_val = searching.attr('dynamic_val');
            if (typeof dynamic_val == 'undefined') {
                dynamic_val = '';
            }
            $('#search-result' + dynamic_val).show();
            $('#search-result' + dynamic_val).css({'border': '1px solid #ccc'});

        });
    });
</script>