<?php
use Cake\Datasource\ConnectionManager;

$conn = ConnectionManager::get('default');
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
</style>

<?php
//if(!empty($eventsubcategories1)){
//    echo '1';$eventsubcategories=$eventsubcategories1;
//   
//}
//
//if(!empty($eventsubcategories2)){
//    $eventsubcategories='';
//    $eventsubcategories=$eventsubcategories2;
//    echo '2'; debug($eventsubcategories);
//   
//}
//if(!empty($eventsubcategories3)){
//    $eventsubcategories='';
//    $eventsubcategories=$eventsubcategories3;
//   echo '3'; debug($eventsubcategories);
//   
//}
?>
<div class="container-fluid content-section">
    <div class="row">
        <?php if($this->request->is('post')): ?>
        <div class="">
            <div class="aside-categories">
                <a class="drawer-opener open-drawer"><i class="fa fa-search"></i></a>
                <h1 class="cat-aside-heading"><i class="fa fa-list"></i> Categories</h1>  
                <ul id="" class="">
                    <?php foreach ($eventcategories as $eventcategories): ?>
                    <li><a href="<?php echo $this->request->webroot; ?>Pages/categories?category_id=<?php echo $eventcategories['id'] ?>"><img src="<?php echo $this->request->webroot; ?>img/event/<?php echo $eventcategories['image_icon'] ?>" class="caticon-image"><span><?php echo $eventcategories['title'] ?></span></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-lg-1">
        </div>

        <div class="col-lg-11">
            <?php if (!empty($eventsubcategories)) { ?>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" style="width: 100%">
                <?php
                $i = 0;
                $k = 0;

                foreach ($eventsubcategories as $eventsubcategory):
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($i == 0) echo 'active'; ?>"  style="background-color:none; color: #70454c; font-weight: normal;" data-toggle="tab" href="#hom<?php echo $k; ?>"><?php echo $eventsubcategory['title'] ?></a>
                </li>
                <?php
                $i++;
                $k++;
                endforeach;
                ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <?php
                $i = 0;
                $k = 0;

                foreach ($eventsubcategories as $events):
                $event_employee = $k;
                ?>
                <div id="hom<?php echo $k; ?>"  class="tab-pane <?php if ($i == 0) echo 'active'; ?> <?php if ($i != 0) echo 'fade'; ?>"><br>
                    <div class="row">
                        <?php
                        foreach ($event_employees as $event_employee):

                        $query = $conn->execute('SELECT t.talent_id,SUM(t.rate) as ratings,COUNT(t.booking_id) as total_booking FROM talent_ratings as t WHERE talent_id=' . $event_employee['user_id'] . ' GROUP BY t.talent_id');

                        $ratings = $query->fetchAll('assoc');
                        $calculateRatings = 0;
                        if (isset($ratings[0])) {
                        $calculateRatings = round(($ratings[0]['ratings'] / $ratings[0]['total_booking']) * 2) / 2;
                        }
                        ?>
                        <?php
                        if ($events['title'] == $event_employee['sub']) {
                        $path = '';
                        $path = $event_employee['profile_image'];
                        $loginWithSocial = $event_employee['loginwithsocial'];

                        $image = 'cyber1550500683.png';
                        if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                        $path = $event_employee['profile_image'];
                        } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                        if ($event_employee['profile_image'] == '') {

                        $path = $this->request->webroot . 'img/users/"' . $image . '"';
                        } else {
                        $path = $this->request->webroot . 'img/users/"' . $path . '"';
                        }
                        } else {
                        $path = $this->request->webroot . 'img/users/"' . $image . '"';
                        }
                        ?>
                        <div class="li-setting col-sm-6 col-md-6 col-lg-3" style="height: 50%">
                            <a href="<?php echo $this->request->webroot . 'EmployeeMembers/view_employee/' . $event_employee['event_id']; ?>">

                                <div id='profile_image_div' class="profile_image" style="float: left !important; display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>');"></div>


                                <div class="profile_name" style="">
                                    <span class="" >
                                        <?php
                                        echo $event_employee['first_name'] . ' ' . $event_employee['last_name'];
                                        ?>
                                    </span>
                                </div>
                                <?php
                                if (!empty($event_employee['image_icon'])) {

                                $imageicon = $event_employee['image_icon'];
                                } else {
                                $imageicon = 'cyber1550500683.png';
                                }
                                ?>


                                <span class="category_icon_block">

                                    <img style="width: 22px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">
                                    <?php if ($calculateRatings != 0) { ?>
                                    <span class="profile_font_color"><?php echo $calculateRatings; ?>/5 <i class="fa fa-star gotted_stars" style=""></i></span>
                                    <?php } else { ?>
                                    <span style="color: #f9d857 !important;" class="">Not Rated</span>
                                    <?php } ?>
                                </span>


                                <div class="clearfix">&nbsp;</div>
                            </a> 
                        </div>



                        <?php
                        //echo $event_employee['image_icon'];
                        //echo $event_employee['review'];
                        }
                        ?>
                        <?php endforeach; ?>

                    </div>
                    <?php if (empty($event_employees)) { ?>
                    <div class="col-sm-12 text-center">
                        <span style="color:#efefef !important; font-size: 40px;">Sorry No Talent Found</span>
                    </div>
                    <?php }
                    ?>
                </div>
                <?php
                $k++;
                $i++;
                endforeach;
                ?>


            </div>
            <!-- End If Condition  for Categories tags-->
            <?php } else { ?>
            <div class="profile_wrapper" style="margin-top:40px;">
                <div class="row">
                    <?php
                    $conn = ConnectionManager::get('default');

                    foreach ($event_employees as $event_employee):

                    $query = $conn->execute('SELECT t.talent_id,SUM(t.rate) as ratings,COUNT(t.booking_id) as total_booking FROM talent_ratings as t WHERE talent_id=' . $event_employee['user_id'] . ' GROUP BY t.talent_id');
                    $ratings = $query->fetchAll('assoc');
                    $calculateRatings = 0;
                    if (isset($ratings[0])) {
                    $calculateRatings = round(($ratings[0]['ratings'] / $ratings[0]['total_booking']) * 2) / 2;
                    }

                    $loginWithSocial = $event_employee['loginwithsocial'];

                    $image = 'cyber1550500683.png';
                    $path = $event_employee['profile_image'];
                    if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                    $path = $event_employee['profile_image'];
                    } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                    if ($event_employee['profile_image'] == '') {

                    $path = $this->request->webroot . 'img/users/"' . $image . '"';
                    } else {
                    $path = $this->request->webroot . 'img/users/"' . $path . '"';
                    }
                    } else {
                    $path = $this->request->webroot . 'img/users/"' . $image . '"';
                    }
                    ?>
                    <div class="talent_category col-sm-6 col-md-6 col-lg-3" style="padding-top: 10px; ">
                        <a href="<?php echo $this->request->webroot . 'EmployeeMembers/view_employee/' . $event_employee['event_id']; ?>">

                            <div id='profile_image_div' class="profile_image" style="float: left !important; display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>');"></div>


                            <div class="profile_name">
                                <span class="profile_font_color" style="margin-left: 20px;">
                                    <?php
                                    echo $event_employee['first_name'] . ' ' . $event_employee['last_name'];
                                    ?>
                                </span>
                            </div>
                            <?php
                            if (!empty($event_employee['image_icon'])) {

                            $imageicon = $event_employee['image_icon'];
                            } else {
                            $imageicon = 'cyber1550500683.png';
                            }
                            ?>


                            <span class="category_icon_block" style="">

                                <img style="width: 22px;" src="<?php echo $this->request->webroot; ?>img/event/<?php echo $imageicon ?>" class="caticon-image" alt="">
                                <?php if ($calculateRatings != 0) { ?>
                                <span class="profile_font_color"><?php echo $calculateRatings; ?>/5 <i class="fa fa-star gotted_stars" style=""></i></span>
                                <?php } else { ?>
                                <span style="color: #f9d857;" class="">Not Rated</span>
                                <?php } ?>
                            </span>



                        </a> 
                    </div>



                    <?php
                    endforeach;
                    ?>

                    <?php if (empty($event_employees)) { ?>
                    <div class="col-sm-12 text-center">
                        <span style="color:#efefef; font-size: 40px;">Sorry No Record Found</span>
                    </div>
                    <?php }
                    ?>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</div>
<!-- End of Page Content -->


<script type="text/javascript">
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
                left: '-220'
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
                left: '-220'
            }, 800);
            opened = 0;
        }

    });
</script>
<script>
</script>
