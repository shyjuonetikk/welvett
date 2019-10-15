<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login :: Welvet </title>
        <!-- plugins:css -->
        <!-- endinject -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="<?php echo $this->request->webroot;?>css/bus_login/font-awesome.min.css" />
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link href="<?php echo $this->request->webroot ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $this->request->webroot;?>css/bus_login/style.css">
        <!-- endinject -->
        <!-- Custom styling -->

        <link href="<?php echo $this->request->webroot ?>assets/css/saif.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $this->request->webroot;?>css/bus_login/custom.css">
        <!-- End Custom Styling -->

    </head>

    <body>
        <div class="container-scroller login-bg">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth" style="background-image: url('<?php echo $this->request->webroot;?>img/bg.png') !important; background-position: center; ">
                    <div class=""></div>
                    <div class="row w-100">
                        <div class="col-lg-8 mx-auto">
                            <div class="row">
                                <div class="col-lg-6 bg-white mx-auto">
                                    <div class="auth-form-light text-left p-5">
                                        <img src="<?php echo $this->request->webroot ?>img/logo.png" class="login-logo" />	
                                        <h2 class="text-center">Authentication Area</h2>
                                        <h6 class="font-weight-light text-center">Provide your credentials to login</h6>

                                        <?= $this->Flash->render() ?>
                                        <?php echo $this->fetch('content');?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <!-- endinject -->
        <!-- Custom js for this page-->
        <!-- endinject -->
    </body>


    <!-- Mirrored from www.urbanui.com/pearl-admin/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Jun 2018 18:02:30 GMT -->
</html>
