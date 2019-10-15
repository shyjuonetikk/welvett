<?php ?>  
<!-- ######## START OF NAVIGATION ############### -->
<nav class="navbar navbar-default navbar-expand-xl navbar-light custom-navbar">
    <div class="navbar-header d-flex col">
        <div class="branding">
            <a class="navbar-brand" href="#">
                <img src="<?php echo $this->request->webroot ?>assets/images/logo.png" class="image-responsive mini-logo"  />
            </a>
        </div>     
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
            <span class="navbar-toggler-icon"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <form class="navbar-form form-inline search-form">
            <div class="input-group search-box">
                <a href="javascript:" class="filter-icon"><i class="fa fa-filter"></i></a>                         
                <input type="text" id="search" class="form-control">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div>
            <div class="search-result">
                <ul>
                    <li>
                        <img src='https://www.tutorialrepublic.com/examples/images/avatar/2.jpg' class="avatar pull-left" />
                        <p class="pull-left left-10">John Smith</p>
                        <img src='<?php echo $this->request->webroot ?>assets/images/icon-darker.png' width="30" class="pull-right icon-image" />
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <img src='https://www.tutorialrepublic.com/examples/images/avatar/2.jpg' class="avatar pull-left" />
                        <p class="pull-left left-10">John Smith</p>
                        <img src='<?php echo $this->request->webroot ?>assets/images/icon-darker.png' width="30" class="pull-right icon-image"/>
                        <div class="clearfix"></div>
                    </li> 
                    <li class="text-center viewmore-list"><a href="#" class="color-black">See all results for John Smith</a></li>
                </ul>
                <div class="clearfix"></div>

            </div>
        </form>
        <ul class="nav navbar-nav navbar-right ml-auto">
            <li class="nav-item dropdown notifydd">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-envelope"></i><span class="badge">3</span></a>
                <ul class="dropdown-menu notify-drop">
                    <div class="notify-drop-title">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">Messages</div>
                        </div>
                    </div>
                    <!-- end notify title -->
                    <!-- notify content -->
                    <div class="drop-content">
                        <li>
                            <div class="col-md-3 pull-left">
                                <div class="notify-img">
                                    <img src="http://placehold.it/45x45" alt="">
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <p>Message one will be displayed.Message one will be displayed.</p>
                            </div>
                        </li>
                        <li>
                            <div class="col-md-3 pull-left">
                                <div class="notify-img">
                                    <img src="http://placehold.it/45x45" alt="">
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <p>Message one will be displayed.Message one will be displayed.</p>
                            </div>
                        </li>
                        <li>
                            <div class="col-md-3 pull-left">
                                <div class="notify-img">
                                    <img src="http://placehold.it/45x45" alt="">
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <p>Message one will be displayed.Message one will be displayed.</p>
                            </div>
                        </li>
                    </div>
                    <div class="notify-drop-footer text-center">
                        <a href="">View All Messages</a>
                    </div>
                </ul>  

            </li>
            <li class="nav-item dropdown notifydd">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i><span class="badge">1</span></a>
                <ul class="dropdown-menu notify-drop">
                    <div class="notify-drop-title">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">Notifications</div>
                        </div>
                    </div>
                    <!-- end notify title -->
                    <!-- notify content -->
                    <div class="drop-content">
                        <li>
                            <div class="col-md-9 pull-left">
                                <p>Notification will be displayed here.</p>
                            </div>
                            <div class="col-md-3 pull-right">
                                <p>1 min</p>
                            </div>
                        </li>
                        <li>
                            <div class="col-md-9 pull-left">
                                <p>Notification will be displayed here.</p>
                            </div>
                            <div class="col-md-3 pull-right">
                                <p>2 min</p>
                            </div>
                        </li>
                        <li>
                            <div class="col-md-9 pull-left">
                                <p>Notification will be displayed here.</p>
                            </div>
                            <div class="col-md-3 pull-right">
                                <p>4 min</p>
                            </div>
                        </li>
                    </div>
                </ul>  

            </li>
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link  user-action">
                    <img src="https://www.tutorialrepublic.com/examples/images/avatar/2.jpg" class="avatar" alt="Avatar"> Paula Wilson <i class="fa fa-chevron-down" style="font-size:12px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="#" class="dropdown-item"><i class="fa fa-search"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div class="filters">
    <div class='row'>
        <div class='col-lg-2'>
            <h1>Filters <i class="fa fa-filter"></i></h1>
        </div>
        <div class='col-lg-10'>
            <form class="form-inline">
                <div class="form-group">
                    <select class="form-control" name="category">
                        <option>Category</option>
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control" name="subcategory">
                        <option>Sub Category</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="min-price" class="form-control" placeholder="Min Price" />
                </div>
                <div class="form-group">
                    <input type="text" name="max-price" class="form-control" placeholder="Max Price" />
                </div>
                <div class="form-group">
                    <input type="text" name="date" class="form-control datepicker" placeholder="Date" />
                </div>
                <div class="form-group">
                    <button type='submit'><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ######## END OF NAVIGATION ############### -->