<?php echo $this->element('inc/header'); ?>
<!-- Page Content -->
<section class="content-wrapper very-centered">
    <div class="container">
        <div class="module-header">
            <div class="module-title half-underlined">
                <h2>Individual Account</h2>
            </div>
            <p class="section-tagline">Easy registration of your email and phone number will get you to the world of celebrities!</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <img src="<?php echo $this->request->webroot ?>assets/images/individual.png" class="section-iconimage"/>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="short-content">This platform gives you access to book celebrities and professionals famous in their fields instantly. Celebrities for events such as private parties, weddings, photoshoots will be available through Individual Account portal.</div>
                <div class="clearfix">&nbsp;</div>
                <p class="pull-right"><a href="<?php echo $this->request->weboot ?>pages/registerindividual">Begin Your Registration &nbsp; <i style="margin-top:5px;" class="fa fa-long-arrow-right"></i></a> </p>
            </div> 
        </div>
    </div>
</section>
<div class="clearfix"></div>
<!-- Slider 02-->
<div id="cover02" class="customtemp-cover-area customtemp-cover-1 customtemp-cover-slider owl-carousel remove-mb-padding">
    <?php
    foreach ($categories as $c):
        ?>
        <div class="item">
            <div class="customtemp-cover-item">
                <div class="image-holder">
                    <img  src="<?php echo $this->request->webroot . 'img/event/' . $c->image_icon ?>"  alt="">
                </div>
                <p class="carousel-item-title"><?php echo ucfirst($c->title); ?></p>
            </div>
        </div>
    <?php endforeach; ?>


</div>


<section class="content-wrapper very-centered">
    <div class="container">
        <div class="module-header">
            <div class="module-title half-underlined">
                <h2>Corporate Account</h2>
            </div>
            <p class="section-tagline">Sign-up, Get Verified and Welcome your first Celebrity!</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <img src="<?php echo $this->request->webroot ?>assets/images/corporate.png" width="100%"/>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="short-content">Through Corporate Account portal, you will have an unlimited access to celebrities to attend or host your company events. Enlighten your employees with motivational Public Speakers, entertain your co-workers with master Photographers, Djs, singers and make your special occasion a truly memorable one.</div>
                <div class="clearfix">&nbsp;</div>
                <p class="pull-right"><a href="<?php echo $this->request->weboot ?>pages/registercorporate">Begin Your Registration &nbsp; <i style="margin-top:5px;" class="fa fa-long-arrow-right"></i></a> </p>
            </div> 
        </div>
    </div>
</section>

<section class="content-wrapper very-centered">
    <div class="container">
        <div class="module-header">
            <div class="module-title half-underlined">
                <h2>Talent Account</h2>
            </div>
            <p class="section-tagline">Join us and expand your audience</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <img src="<?php echo $this->request->webroot ?>assets/images/employee.png" class="section-iconimage-mid" width="100%"/>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="short-content">Apply to become a member of Welvett community and maximize your profit. Direct communication with clients! Access instant messaging and avoid the middle man!</div>
                <div class="clearfix">&nbsp;</div>
                <p class="pull-right"><a href="<?php echo $this->request->weboot ?>pages/registeremployee">Begin Your Registration &nbsp; <i style="margin-top:5px;" class="fa fa-long-arrow-right"></i></a> </p>
            </div> 
        </div>
    </div>
</section>

<!-- End Slider 02 -->	
<div class="clearfix"></div>

