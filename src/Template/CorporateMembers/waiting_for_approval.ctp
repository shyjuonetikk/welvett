<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title; ?></title>
        <!-- plugins:css -->
        <!-- endinject -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="<?php echo $this->request->webroot; ?>css/bus_login/font-awesome.min.css" />
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link href="<?php echo $this->request->webroot ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $this->request->webroot; ?>css/bus_login/style.css">
        <!-- endinject -->
        <!-- Custom styling -->

        <link href="<?php echo $this->request->webroot ?>assets/css/saif.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $this->request->webroot; ?>css/bus_login/custom.css">
        <link href="<?php echo $this->request->webroot ?>assets/jquery_confirm/jquery-confirm.css" rel="stylesheet">

        <!-- End Custom Styling -->
        <style>
            .verify::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
                color: gray !important;
                opacity: 1; /* Firefox */
            }
            #resend{
                background: none;
                border: none;
                color: #0056b3;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <div class="container-scroller login-bg">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth" style="background-image: url('<?php echo $this->request->webroot; ?>img/bg.png') !important; background-position: center; ">
                    <div class=""></div>
                    <div class="row w-100">
                        <div class="col-lg-8 mx-auto">
                            <div class="row">
                                <div class="col-lg-6 bg-white mx-auto">
                                    <div class="auth-form-light text-left p-5">
                                        <img src="<?php echo $this->request->webroot ?>img/logo.png" class="login-logo" />	
                                        <h2 class="text-center">Registration Completed</h2>

                                        <?= $this->Flash->render() ?>
                                        <div class="mt-3 text-center">
                                            <p>Your profile is under reivew, once your account have been approved, you will get a notification email.</p>
                                        </div> 

                                        <div class="mt-3 text-center">

                                            <span>Back to </span><a href="<?php echo $this->request->webroot ?>" id="display_reg_form">Home</a>
                                        </div> 

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo $this->request->webroot ?>assets/jquery_confirm/jquery-confirm.js"></script>
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
        $(function () {
            $('#resend').click(function () {
                $('#resend').prop('disabled', true);
                var value = "<?php echo $this->request->params['pass'][0] ?>";
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->request->webroot ?>Users/resend_code',
                    data: 'value=' + value,
                    success: function (data)
                    {
                        $('#resend').prop('disabled', false);
                        data = JSON.parse(data);
                        show_custom_message(data.message);

                    }
                });

            });
        });
    </script>

    <!-- Mirrored from www.urbanui.com/pearl-admin/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Jun 2018 18:02:30 GMT -->
</html>

