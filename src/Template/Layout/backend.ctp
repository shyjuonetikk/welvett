<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>

            <?= $this->fetch('title') ?>

        </title>

        <link rel="icon" href="<?php echo $this->request->webroot; ?>favicon.ico" type="image/gif" sizes="16x16"> 
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>bower_components/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>bower_components/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>bower_components/Ionicons/css/ionicons.min.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>dist/css/AdminLTE.min.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>dist/css/skins/_all-skins.min.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>bower_components/morris.js/morris.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>bower_components/jvectormap/jquery-jvectormap.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>bower_components/bootstrap-daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>bower_components/bootstrap-timepicker/css/timepicker.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>css/custom.css" />
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>css/bootstrap-datetimepicker.min.css" />
        <link property="stylesheet" rel='stylesheet' id='travesia-icons-css'  href='<?php echo $this->request->webroot; ?>bus_front/bus_front/css/fontello-embedded.css' type='text/css' media='all' />
        <link property="stylesheet" rel='stylesheet' id='travesia-icons-css'  href='<?php echo $this->request->webroot; ?>bower_components/jquery.timepicker.css' type='text/css' media='all' />
        <link property="stylesheet" rel='stylesheet' id='travesia-icons-css'  href='<?php echo $this->request->webroot; ?>bower_components/jquery_confirm/jquery-confirm.css' type='text/css' media='all' />
        <link href="<?php echo $this->request->webroot ?>jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $this->request->webroot; ?>multiselect/example-styles.css" />
        <!--        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
        <script src="<?php echo $this->request->webroot ?>bower_components/jquery/dist/jquery.min.js"></script>

        <style>
            .multi-select-container {
                display: inline-block;
                position: relative;
            }

            .multi-select-menu {
                position: absolute;
                left: 0;
                top: 0.8em;
                float: left;
                min-width: 100%;
                background: #fff;
                margin: 1em 0;
                padding: 0.4em 0;
                border: 1px solid #aaa;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
                display: none;
            }

            .multi-select-menu input {
                margin-right: 0.3em;
                vertical-align: 0.1em;
            }

            .multi-select-button {
                display: inline-block;
                font-size: 0.875em;
                padding: 0.2em 0.6em;
                max-width: 20em;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                vertical-align: -0.5em;
                background-color: #fff;
                border: 1px solid #aaa;
                border-radius: 4px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
                cursor: default;
            }

            .multi-select-button:after {
                content: "";
                display: inline-block;
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 0.4em 0.4em 0 0.4em;
                border-color: #999 transparent transparent transparent;
                margin-left: 0.4em;
                vertical-align: 0.1em;
            }

            .multi-select-container--open .multi-select-menu { display: block; }

            .multi-select-container--open .multi-select-button:after {
                border-width: 0 0.4em 0.4em 0.4em;
                border-color: transparent transparent #999 transparent;
            }
            .multi-select-menu {
                width: 100%;

                max-height: 200px;

                overflow: hidden !important;

                z-index: 1;

            }
            label.multi-select-menuitem{
                display: block;
            }
            .content-pane{
                height: 38px !important;
            }
            .content-pane>.content{
                min-height: 100% !important;
            }

        </style>

        <style>
            .content-wrapper{
                padding:0px 20px !important;
            }
            .content-container{
                width:100%;
                max-width: unset ;
            }
            .content-header {
                position: relative;
                padding: 15px 15px 0 0px;
            }
            th a{
                color:black !important;
                white-space: nowrap;
            }
            th{
                color:black !important;
                white-space: nowrap;
            }
            th:last-child{
                text-align: center !important;
            }
            td:last-child{
                white-space: nowrap !important;
                text-align: center !important;
            }


        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <?php
        $companyId = $this->request->session()->read('Auth.User.usercompanies');
        $roleId = $this->request->session()->read('Auth.User.role_id');
        if (isset($companyId[0]['company_id'])) {
            $companyId = $companyId[0]['company_id'];
        } else {
            $companyId = '';
        }
        ?>

        <div class="wrapper">

            <header class="main-header">

                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->

                            <li class="dropdown user user-menu">
                                <?php
                                $userid = $this->request->session()->read('Auth.User.id');
                                $photo = $this->request->session()->read('Auth.User.profile_image');
                                $firstname = $this->request->session()->read('Auth.User.first_name');
                                $lastname = $this->request->session()->read('Auth.User.last_name');
                                ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo $this->request->webroot ?>img/users/<?php echo $photo; ?>" class="user-image"  alt="User Image">
                                    <span class="hidden-xs"><?php echo $firstname; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo $this->request->webroot; ?>img/users/<?php echo $photo; ?>" class="img-circle" alt="<?php echo $lastname; ?>">

                                        <p>
                                            <?php
                                            echo $firstname . ' ' . $lastname;
                                            ?>
                                            <small>Member since <?php echo date('m,Y', strtotime($this->request->session()->read('Auth.User.modified'))); ?></small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo $this->request->webroot ?>users/personal_profile/<?php echo $userid; ?>" class="btn btn-blue-custom btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo $this->request->webroot ?>users/logout" class="btn btn-blue-custom btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel" style="background-color: #7B1B2D;height: 60px;">
                        <div class="text-center image">
                            <img src="<?php echo $this->request->webroot ?>img/logo.png"  alt="User Image">
                        </div>
                    </div>

                    <?php
                    // THESE TWO LINES ARE COMMON FOR PERMISSION, FIRST LINE APPCONTROLLER OBJ
                    $appController = new \App\Controller\AppController;
                    $roleId = $this->request->session()->read('Auth.User.role_id');
                    ?>

                    <ul class="sidebar-menu" data-widget="tree">

                        <?php
                        // ADD PERMISSION ON USER
                        $actionPermission = 0;
                        $controller = '';
                        $controller = 'USERS';
                        $actionPermission = $appController->permissionsList($roleId, $controller);
                        if ($actionPermission == 1 || $actionPermission == 2) {
                            ?>
                            <li class="treeview <?php if (($this->request->params['controller'] == 'Users' && ($this->request->params['action'] == 'usersList' || $this->request->params['action'] == 'addAdmin')) || ($this->request->params['controller'] == 'Roles')) echo 'active'; ?>">
                                <a href="#">
                                    <i class="fa fa-user"></i> <span>Users</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    if ($actionPermission == 1 || $actionPermission == 2) {
                                        ?>
                                        <li class="<?php if ($this->request->params['action'] == 'users_list') echo 'active'; ?>"><a href="<?php echo $this->request->webroot ?>Users/users_list"><i class="fa fa-circle-o"></i>List</a></li>
                                        <?php
                                    }
                                    if ($actionPermission == 2) {
                                        ?>
                                        <li><a href="<?php echo $this->request->webroot ?>Users/add_admin"><i class="fa fa-circle-o"></i> Add New</a></li>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    // ADD PERMISSION ON STATE
                                    $actionPermission = 0;
                                    $controller = '';
                                    $controller = 'ROLES';
                                    $actionPermission = $appController->permissionsList($roleId, $controller);

                                    if ($actionPermission == 1 || $actionPermission == 2) {
                                        ?>
                                        <li class="<?php if ($this->request->params['controller'] == 'Roles') echo 'active'; ?> treeview">
                                            <a href="#">
                                                <i class="fa fa-list"></i> <span>Roles</span>
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu" style="padding-left:0;">
                                                <?php
                                                if ($actionPermission == 1 || $actionPermission == 2) {
                                                    ?>
                                                    <li class="<?php if ($this->request->params['action'] == 'index') echo 'active'; ?>"><a href="<?php echo $this->request->webroot ?>roles"><i class="fa fa-circle-o"></i>List</a></li>
                                                    <?php
                                                }
                                                if ($actionPermission == 2) {
                                                    ?>
                                                    <li><a href="<?php echo $this->request->webroot ?>roles/add"><i class="fa fa-circle-o"></i> Add New</a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </li>


                            <li class="<?php if ($this->request->params['controller'] == 'Users' && ($this->request->params['action'] == 'individuals' || $this->request->params['action'] == 'corporate')) echo 'active'; ?> treeview">
                                <a href="#">
                                    <i class="fa fa-users"></i> <span>Client Menu</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php if ($actionPermission == 1 || $actionPermission == 2) { ?>
                                        <li class=""><a href="<?php echo $this->request->webroot ?>Users/individuals"><i class="fa fa-circle-o"></i>Individual Members</a></li>
                                    <?php } ?>
                                    <?php if ($actionPermission == 1 || $actionPermission == 2) { ?>
                                        <li class=""><a href="<?php echo $this->request->webroot ?>Users/corporate"><i class="fa fa-circle-o"></i>Corporate Members</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php if ($actionPermission == 1 || $actionPermission == 2) {
                                ?> 
                                <?php
                                if ($actionPermission == 1 || $actionPermission == 2) {
                                    ?>                                
                                    <li class="<?php if ($this->request->params['action'] == 'all_bookings') echo 'active'; ?>"><a href="<?php echo $this->request->webroot ?>TalentEvents/all_bookings"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>All Bookings</a></li>
                                    <li class="<?php if ($this->request->params['action'] == 'reports') echo 'active'; ?>"><a href="<?php echo $this->request->webroot ?>TalentEvents/reports"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Reports</a></li>
                                    <?php
                                }
                            }
                            ?>
                            <li class="<?php if (($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'employee') || ($this->request->params['controller'] == 'Memberships' && $this->request->params['action'] == 'index')) echo 'active'; ?> treeview">
                                <a href="#">
                                    <i class="fa fa-users"></i> <span>Talents</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php if ($actionPermission == 1 || $actionPermission == 2) { ?>
                                        <li class=""><a href="<?php echo $this->request->webroot ?>Users/employee"><i class="fa fa-circle-o"></i>Employee Members</a></li>
                                    <?php } ?>
                                    <?php
                                    // ADD PERMISSION ON ROLES
                                    $actionPermission = 0;
                                    $controller = '';
                                    $controller = 'MEMBERSHIPS';
                                    $actionPermission = $appController->permissionsList($roleId, $controller);
                                    if ($actionPermission == 1 || $actionPermission == 2) {
                                        ?> 
                                        <?php
                                        if ($actionPermission == 1 || $actionPermission == 2) {
                                            ?>                                
                                            <li class="<?php if ($this->request->params['action'] == 'index') echo 'active'; ?>"><a href="<?php echo $this->request->webroot ?>memberships"><i class="fa fa-circle-o"></i>List Memberships</a></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php
                        // ADD PERMISSION ON STATE
                        $actionPermission = 0;
                        $controller = '';
                        $controller = 'EVENTCATEGORIES';
                        $actionPermission = $appController->permissionsList($roleId, $controller);
                        if ($actionPermission == 1 || $actionPermission == 2) {
                            ?>
                            <li class="<?php if ($this->request->params['controller'] == 'Eventcategories') echo 'active'; ?> treeview">
                                <a href="#">
                                    <i class="fa fa-list"></i> <span>Service Categories</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    if ($actionPermission == 1 || $actionPermission == 2) {
                                        ?>
                                        <li class="<?php if ($this->request->params['action'] == 'index') echo 'active'; ?>"><a href="<?php echo $this->request->webroot ?>Eventcategories"><i class="fa fa-circle-o"></i>List</a></li>
                                        <?php
                                    }
                                    if ($actionPermission == 2) {
                                        ?>
                                        <li><a href="<?php echo $this->request->webroot ?>Eventcategories/add"><i class="fa fa-circle-o"></i> Add New</a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php
                        // ADD PERMISSION ON BUSES
                        $actionPermission = 0;
                        $controller = '';
                        $controller = 'SLIDERS';
                        $actionPermission = $appController->permissionsList($roleId, $controller);
                        if ($actionPermission == 1 || $actionPermission == 2) {
                            ?>  
                            <li class="<?php if ($this->request->params['controller'] == 'sliders') echo 'active'; ?> treeview">
                                <a href="#">
                                    <i class="fa fa-sliders"></i> <span>Slider</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    if ($actionPermission == 1 || $actionPermission == 2) {
                                        ?>
                                        <li class="<?php if ($this->request->params['action'] == 'sliderlist') echo 'active'; ?>"><a href="<?php echo $this->request->webroot ?>sliders/sliderlist"><i class="fa fa-circle-o"></i>List</a></li>
                                        <?php
                                    }
                                    if ($actionPermission == 2) {
                                        ?>
                                        <li><a href="<?php echo $this->request->webroot ?>sliders/add"><i class="fa fa-circle-o"></i> Add New</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <!-- <img src="<?php //echo $this->request->webroot                                                                 ?>img/logo.png" alt="" width="150"> -->
                    <h2>
                        <?php
                        if (isset($content_title)) {

                            echo $content_title;
                        } else {
                            ?>

                            <?= $this->fetch('title') ?>

                        <?php } ?>
                        <small>Administrative Section</small>
                    </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $this->request->webroot; ?>Users"><i class="fa fa-dashboard"></i> Home</a>
                        </li>
                        <?php if ($this->request->params['controller'] != "" && $this->request->params['action'] != "") { ?>
                            &nbsp;
                            <i class="fa fa-angle-right"></i>
                            <?php if ($this->request->params['controller'] == 'Tours') { ?>

                                <li>
                                    <a href="<?php echo $this->request->webroot; ?><?php echo strtolower($this->request->params['controller']); ?>">Sightseeing</a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="<?php echo $this->request->webroot; ?><?php echo strtolower($this->request->params['controller']); ?>"><?php echo $this->request->params['controller']; ?></a>
                                </li>
                            <?php } ?>

                            &nbsp;
                            <i class="fa fa-angle-right"></i>
                            <li class="active"><?php
                                if ($this->request->params['action'] == 'index') {
                                    echo 'Listing';
                                } else {
                                    echo $this->request->params['action'];
                                }
                                ?>
                            </li>
                        <?php } ?>


                    </ol>
                </section>

                <?php $flashRender = $this->Flash->render(); ?>
                <?php if (!empty($flashRender)) : ?>
                    <script>
                        $(document).ready(function () {
                            show_custom_message('<?= $flashRender; ?>');
                            if ($('.success_message').length) {
                                $('span[class=title]').css('color', 'green');
                            }
                            if ($('.error_message').length) {
                                $('span[class=title]').css('color', 'red');
                            }
                        });


                    </script>
                <?php endif; ?>

                <?php echo $this->fetch('content'); ?>

            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0 | 
                    <span>Powered & Developed By <a href="http://www.cyberclouds.com">Cyber Clouds</a></span>
                </div>
                <strong>Copyright &copy; <?php echo date("Y", time()); ?> <a href="http://www.cyberclouds.com/welvett">Welvett</a>.</strong> All rights
                reserved.
            </footer>


            <div class="control-sidebar-bg"></div>
        </div>



        <script src="<?php echo $this->request->webroot ?>bower_components/jquery-ui/jquery-ui.min.js"></script>

        <script>
                        $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="<?php echo $this->request->webroot ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="<?php echo $this->request->webroot; ?>bower_components/jquery_confirm/jquery-confirm.js"></script>
        <script src="<?php echo $this->request->webroot ?>bower_components/raphael/raphael.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>bower_components/morris.js/morris.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="<?php echo $this->request->webroot ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo $this->request->webroot ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script src="<?php echo $this->request->webroot ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>bower_components/fastclick/lib/fastclick.js"></script>
        <script src="<?php echo $this->request->webroot ?>dist/js/adminlte.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>dist/js/demo.js"></script>
        <script src="<?php echo $this->request->webroot ?>js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>bower_components/jquery.timepicker.js"></script>
        <script src="<?php echo $this->request->webroot; ?>jquery-datatable/jquery.dataTables.js"></script>
        <script src="<?php echo $this->request->webroot; ?>jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="<?php echo $this->request->webroot; ?>jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="<?php echo $this->request->webroot; ?>jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>jquery-datatable/jquery-datatable.js"></script>           
        <script src="<?php echo $this->request->webroot; ?>multiselect/jquery.multi-select.js"></script>
        <script>
                        function show_custom_message(message) {
                            $.alert({
                                confirmButton: 'Ok',
                                title: 'Information!',
                                content: message
                            });
                        }

        </script>

        <script>

            function messages(event_id) {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->request->webroot . 'TalentEvents/fetch_messages' ?>',
                    data: 'id=' + event_id,
                    contentType: 'json',
                    success: function (data)
                    {
                        $('#empty_modal').html(data);
                        $('#myModal1').modal('show');

                    }, error: function (error) {
                        // alert(JSON.stringify(error));
                    }


                });

            }
            function fetch_category(category_id) {

                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->request->webroot . 'TalentEvents/fetch_category' ?>',
                    data: 'id=' + category_id,
                    contentType: 'json',
                    success: function (data)
                    {
                        $('#empty_modal').html(data);
                        $('#myModal1').modal('show');

                    }, error: function (error) {
                        // alert(JSON.stringify(error));
                    }


                });

            }
            function edit_city(city_id) {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->request->webroot . 'TalentEvents/fetch_city' ?>',
                    data: 'city_id=' + city_id,
                    contentType: 'json',
                    success: function (data)
                    {
                        data = JSON.parse(data);
                        $('#city_id').val(data.id);
                        $('#city').val(data.city);
                        $('#accommodation_price').val(data.accommodation_price);
                        $('#myModal').modal('show');
                    }, error: function (error) {
                        // alert(JSON.stringify(error));
                    }


                });

            }
            $('#edit_city_form').submit(function () {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->request->webroot . 'TalentEvents/edit_city' ?>',
                    data: $("#edit_city_form").serialize(),
                    contentType: 'json',
                    success: function (data)
                    {
                        data = JSON.parse(data);
                        $('#city_' + data.id).text(data.city);
                        $('#accommodation_' + data.id).text(data.accommodation_price);
                        $('#myModal').modal('hide');



                    }, error: function (error) {
                        // alert(JSON.stringify(error));
                    }



                });
                return false;
            });
            jQuery(document).ready(function () {
                $('.integeronly').keypress(function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                        return false;
                    }

                });

                $('.time_picker').timepicker({
                    'timeFormat': 'h:i A',
                    'step': 5
                });

                jQuery(function () {
                    jQuery('.datepicker').datepicker({
                        'format': 'mm-dd-yyyy'
                    }).on('changeDate', function (e) {
                        jQuery(this).datepicker('hide');
                    });

                });

                jQuery('.timepicker').timepicker({
                    'minTime': '12:00am',
                    'maxTime': '11:59pm',
                    'step': 15
                            //'showDuration': true
                });

                $('#amenities').multiSelect();

            });
        </script>
    </body>
</html>
