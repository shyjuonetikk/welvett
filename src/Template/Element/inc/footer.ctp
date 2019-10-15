<?php ?>
<!-- Footer -->
<div id="footer" class="customtemp-footer">
         <div class="container">
            <div class="row">
            	<div class="col-lg-3 col-md-6 col-sm-12">
                  <div id="nav_menu-4" class="boxr boxr_nav_menu">
                     <h4 class="boxr-title">Welvet.com</h4>
                     <div class="menu-customtemp-footer-container">
                        <ul id="menu-customtemp-main-2" class="customtemp-mobile-menu">
                           <li>
		                     <a href="index.html">Home</a>
		                  </li>
		                   <li>
		                     <a href="#">About Us</a>
		                  </li>
		                    <li>
		                     <a  href="#">FAQ</a>
		                  </li>
		                    <li>
		                     <a href="#">Welvett for IOS</a>
		                  </li>
		                    <li>
		                     <a  href="#">Welvett for Android</a>
		                  </li>
		                  
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6 col-sm-12">
                  <div id="text-5" class="boxr boxr_text">
                     <h4 class="boxr-title">Help</h4>
                     <div class="textboxr">
                        <div class="menu-customtemp-footer-container">
	                        <ul id="menu-customtemp-main-2" class="customtemp-mobile-menu">
	                           <li>
			                     <a href="<?php echo $this->request->webroot?>Pages/contact">Contact</a>
			                  </li>
			              	</ul>
		              	</div>
                        <!--End mc_embed_signup-->
                     </div>
                     <br />
                     <h4 class="boxr-title">Follow Us</h4>
                     <div id="mks_social_boxr-5" class="boxr mks_social_boxr">
                     <ul class="mks_social_boxr_ul">
                        <li>
                           <a href="#" title="Facebook" class="facebook_ico soc_circle" target="_blank" style="width: 34px; height: 34px; font-size: 16px;">
                           <i class="fa fa-facebook"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#" title="Twitter" class="twitter_ico soc_circle" target="_blank" style="width: 34px; height: 34px; font-size: 16px;">
                           <i class="fa fa-twitter"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#" title="Youtube" class="youtube_ico soc_circle" target="_blank" style="width: 34px; height: 34px; font-size: 16px;">
                           <i class="fa fa-youtube"></i>
                           </a>
                        </li>
                     </ul>
                  </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6 col-sm-12">
                  <div id="text-4" class="boxr boxr_text">
                  	<h4 class="boxr-title">About</h4>
                     <div class="textboxr">
                     	<div id="mc_embed_signup">
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mihi enim erit isdem istis fortasse iam utendum. Aliter enim nosmet ipsos nosse non possumus. Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant.</p>
                    </div>
                     </div>
                  </div>
                  
               </div>
               <div class="col-lg-3 col-md-6 col-sm-12">
                  <div id="nav_menu-4" class="boxr boxr_nav_menu">
                     <h4 class="boxr-title">Legal</h4>
                     <div class="menu-customtemp-footer-container">
                        <ul id="menu-customtemp-main-2" class="customtemp-mobile-menu">
                           <li>
		                     <a href="index.html">Privacy Policy</a>
		                  </li>
		                   <li>
		                     <a href="#">Website Term of Use</a>
		                  </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="customtemp-copyright">
            <div class="container">
               <p style="text-align: center">&copy; <?php echo date('Y'); ?> Welvett, LLC. All rights reserved</p>
            </div>
         </div>
      </div>
            <!-- End Of Footer -->

<!-- Bootstrap core JavaScript -->
      <script src="assets/js/jquery.js"></script>
      <script src="assets/js/owl.carousel.js"></script>
      <script>
         $(document).ready(function(){
         $(window).scroll(function(){
            //alert($("body").scrollTop().offset().top);
            /*if($(window).scrollTop() > $(".topnav").height()-5){
               $(".topnav").addClass("upnav");
               $(".topnav .container").addClass("miniheight");
            } else {
                  $(".topnav").removeClass("upnav");
                  $(".topnav .container").removeClass("miniheight");
            }
            if($(window).scrollTop() > $(".topnav").height()){
               
               $("body").addClass("customtemp-header-sticky-on");
               
            } else {
               $("body").removeClass("customtemp-header-sticky-on");
            
            }*/
         });
         $(".reg-choose-form ul li").on("click",function(){
            $('.choose-form-option').attr('value','');
            $(".reg-choose-form ul li").removeClass('active-reg-option');
            $(this).addClass('active-reg-option');
            $(this).find('.choose-form-option').attr('value',1);
         });
         
            $(".top-search span").click(function(){
               $(".top-search").toggleClass("active");
               $(".top-search span i").toggleClass("fa-times");
            });
            $(".sidemenubtn").click(function(){
               $("body").toggleClass("customtemp-sidebar-action-open").toggleClass("customtemp-lock");
            });
            $(".customtemp-action-close , .customtemp-sidebar-action-overlay").click(function(){
               $("body").toggleClass("customtemp-sidebar-action-open").toggleClass("customtemp-lock");
            });
            $('.owl-carousel').owlCarousel({
            loop:true,
            margin:0,
            autoplay:true,
            autoplayTimeout: 2000,
            navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
            responsiveClass:true,
            responsive:{
               0:{
                  items:1,
                  nav:true
               },
               600:{
                  items:3,
                  nav:true
               },
               1000:{
                  items:4,
                  nav:true,
                  loop:true
               }
            }
         });

/* Code for radio buttons used in registration forms */
      $(".special-radio").on("click",function(){
         $('.special-radio').removeClass('active-yes');
         $('.special-radio').removeClass('active-no');
        if($(this).hasClass('yes')) {
          $(this).addClass('active-yes');
        } else if($(this).hasClass('no')) {
          $(this).addClass('active-no');
        }



    });

      if($(".special-radio.yes").find('input[type=radio]').prop('checked') == true) {
           $(".special-radio.yes").addClass('active-yes');     
      } else if($(".special-radio.no").find('input[type=radio]').prop('checked') == true) {
          $(".special-radio.no").addClass('active-no');     
      }
/* END OF Code for radio buttons used in registration forms */

         });
         
      </script>