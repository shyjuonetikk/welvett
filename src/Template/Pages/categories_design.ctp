<?php 
$image = 'cyber1550500683.png';
$imageicon = 'Bands1552054047.png';
?>

<style>

    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        color: #495057;
        background-color: transparent;
        border-color: #dee2e6 #dee2e6 #fff;
    }
    .nav-tabs {
        border-bottom: 1px solid grey;
    }
    .active{
        background-color: '';

    }
    .nav-tabs .nav-link {
        border: 0px solid transparent;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }
    .li-setting{
        float:left; 
    }
    .user_service{
        padding-bottom: 20px;
    }
</style>
<div class="container-fluid content-section">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="twisted_title">Categories</h1>
            <div class="aside-categories">
                <a class="drawer-opener open-drawer"><i class="fa fa-list"></i></a>
                <h1 class="cat-aside-heading"><i class="fa fa-list"></i> Categories</h1>  
                <ul id="category_list_height" class="custom_scroll sb-container">
                    <?php foreach ($eventcategories as $eventcategories): ?>
                    <li><a href="<?php echo $this->request->webroot; ?>Pages/categories?category_id=<?php echo $eventcategories['id'] ?>"><img src="<?php echo $this->request->webroot; ?>img/event/<?php echo $eventcategories['image_icon'] ?>" class="caticon-image"><span><?php echo $eventcategories['title'] ?></span></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="">
                <ul class="nav nav-tabs" role="tablist" style="width: 60%">
                    <li class="nav-item">Football</li>
                    <li class="nav-item">Football</li>
                    <li class="nav-item">Football</li>
                    <li class="nav-item">Football</li>
                </ul>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>

                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>
                
                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>
                
                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>
                
                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>
                
                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>
                
                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>
                
                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>
                
                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>
                
                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>
                
                <div class="col-md-6 col-lg-4 col-xl-4 user_service">
                    <a href="">

                        <div id='profile_image_div' class="profile_image" style="display: block; width:130px; background-position: center; background-size:cover; background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>'); float: left;">

                        </div>

                        <div style="margin-top: 3rem;">
                            <span class="" style="color: #b8a2a4 !important; padding-left: 25px;">
                                St. John Smith
                            </span>
                        </div>
                        <br>
                        <div style="margin-top: -10px;">

                            <span style="">

                                <img style="width: 22px; margin-right: 20px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">

                                <img src="<?php echo $this->request->webroot; ?>img/rate.jpg" class="caticon-image">
                            </span>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                    </a> 
                </div>
                
            </div>

        </div>

    </div>
</div>
<!-- End of Page Content -->

<script type="text/javascript">
    $('#services').change(function () {
        var service = $(this).val();


        $("#subservices").html("<option value=''>Select Sevice</option>");

        if (service !== "") {
            $.ajax({
                url: '<?php echo $this->request->webroot ?>Pages/Subservice',
                data: {
                    'eventcategory_id': service
                },
                type: 'POST',
                cache: false,
                success: function (responce) {

                    if (responce !== "") {
                        $("#subservices").html(responce);
                    } else {
                        $("#subservices").html("<option value=''>Select Sub Service</option>");
                    }

                }


            });
        }
    });
    var opened = 0;
    $(".open-drawer").on("click", function () {
        if (opened == 0) {
            $(this).removeClass("open-drawer");
            $(".aside-categories").stop().animate({
                left: '0'
            }, 800);
            opened = 1;
        } else {
            $(this).addClass("open-drawer");
            $(".aside-categories").stop().animate({
                left: '-260'
            }, 800);
            opened = 0;
        }

    });

    $(".open-drawer").on("dblclick", function () {
        if (opened == 0) {
            $(this).removeClass("open-drawer");
            $(".aside-categories").stop().animate({
                left: '0'
            }, 800);
            opened = 1;
        } else {
            $(this).addClass("open-drawer");
            $(".aside-categories").stop().animate({
                left: '-260'
            }, 800);
            opened = 0;
        }

    });
</script>
<script>
</script>
