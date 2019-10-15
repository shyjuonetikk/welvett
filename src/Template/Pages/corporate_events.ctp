<?php ?>
<section class="content-wrapper header_bg">
    <div class="container">
        <div class="row" id="profile_header">
            <div class="col-md-5 col-lg-5 pos_relative">
                <h1 class="profile_text_color pos_absolute">Corporative member</h1>
            </div>
            <div class="col-md-2 col-lg-2 text-center">
                <div>
                    <img class="profile_image" src="<?php echo $this->request->webroot;?>img/users/cyber1550500683.png" alt="">
                    <br>
                    <span class="white_color"><strong>Smith</strong></span>
                    <br>
                    <span class="profile_text_color">London, UK</span>
                </div>
            </div>
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="pos_absolute" style="right: 10%;">
                    <a href="" class="review_button"><i class="fa fa-star"></i></a>
                    <span class="white_color">My Reviews</span>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<section class="content-wrapper content_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-4 border_right" style="padding-bottom: 20px;">
                <div class="text-center" id="basic_info">
                    <div>
                        <h6><i class="fa fa-users"></i> Info</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 text-right">
                            <span>Full Name</span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">

                            <input type="text" class="" readonly value="John Smith">
                        </div>
                        <div class="col-md-6 col-lg-6 text-right">
                            <span>Link Your Social Media</span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <a class="icon_box instagram" href=""><i class="fa fa-instagram"></i></a>
                            <a class="icon_box facebook" href=""><i class="fa fa-facebook"></i></a>
                            <a class="icon_box twitter" href=""><i class="fa fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div>
                        <h6><i class="fa fa-user"></i> Account Settings</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 text-right">
                            <span>Email</span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input type="text" class="" readonly value="johnsmith@gmail.com">

                        </div>
                        <div class="col-md-6 col-lg-6 text-right">
                            <span>Change Your Password</span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input type="text" class="" readonly value="******">

                        </div>
                        <div class="col-md-6 col-lg-6 text-right">
                            <span>Phone Number</span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input type="text" class="" readonly value="">
                        </div>
                        <div class="col-md-6 col-lg-6 text-right">
                            <span>Change Your Category</span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input type="text" class="" readonly value="">
                        </div>
                        <div class="col-md-6 col-lg-6 text-right">
                            <span>Description</span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <textarea readonly name="" id="" rows="3" ></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-5 col-lg-5 col-xl-5 offset-xl-1">
                <div id="my_events">
                    <div>
                        <div>
                            <h6 class="text-center"><i class="fa fa-calendar"></i> My Events</h6>
                        </div>
                        <div>
                            <img class="event_image" src="<?php echo $this->request->webroot;?>img/users/cyber1550500683.png" alt="">
                            <strong>John Smith</strong>
                            <span class="pull-right">18h</span>
                            <br>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error aspernatur totam non laudantium placeat veniam sint libero inventore unde eum.</p>
                            <button class="event_button pull-right">Release Money</button>
                            <button class="event_button pull-right" style="margin-right: 20px;">Disputes</button>
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <img class="event_image" src="<?php echo $this->request->webroot;?>img/users/cyber1550500683.png" alt="">
                            <strong>John Smith</strong>
                            <span class="pull-right">18h</span>
                            <br>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error aspernatur totam non laudantium placeat veniam sint libero inventore unde eum.</p>
                            <button class="event_button pull-right">Release Money</button>
                            <button class="event_button pull-right" style="margin-right: 20px;">Disputes</button>
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <img class="event_image" src="<?php echo $this->request->webroot;?>img/users/cyber1550500683.png" alt="">
                            <strong>John Smith</strong>
                            <span class="pull-right">18h</span>
                            <br>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error aspernatur totam non laudantium placeat veniam sint libero inventore unde eum.</p>
                            <button class="event_button pull-right">Release Money</button>
                            <button class="event_button pull-right" style="margin-right: 20px;">Disputes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 text-center">
                <h1 style="transform: rotate(270deg); margin-top: 100px;">Reviews</h1>
            </div>
        </div>
    </div>
</section>

