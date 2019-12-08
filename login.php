<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Mehta Garments | Log in</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url(); ?>assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="<?php echo base_url();?>">
                <img src="<?php echo base_url(); ?>assets/img/mg_fornt.png" alt="" /> </a>

        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->

            <form action="" method="post" id="idForm">
                <h3 class="form-title font-green">Sign In</h3>
                <div class="flashdata">
                    <div class="col-md-12">
                        <?php
                        if ($this->session->flashdata('flashError')) {
                            echo $this->session->flashdata('flashError');
                        }

                        if ($this->session->flashdata('flashSuccess')) {
                            echo $this->session->flashdata('flashSuccess');
                        }
                        ?>
                    </div>
                </div>
				
				<div id="flashSuccess"></div>
                <div id="flashError"></div>
               

                <!--success message print-->
                <!-- <?php echo $this->session->flashdata('success'); ?>  -->
                <!--success message print--> 
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any Email and password. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="vEmail" id="vEmail" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="vPassword" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">Login</button>

                    <a href="<?php echo base_url(); ?>forget-password" id="forget-password" class="forget-password">Forgot Password?</a>
                </div>

            </form>
            <!-- END LOGIN FORM -->


        </div>
        <div class="copyright"> <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="javascript:void(0);">Mehta Garments</a>.</strong> All rights</div>
        <!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
			$('#vEmail').focus();
            $(document).ready(function () {
                $("#msg").delay(3000).fadeOut("slow");
                jQuery.validator.addMethod("email_custome", function (value, element) {
                    if (/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value)) {
                        return true;
                    } else {
                        return false;
                    }
                    ;
                }, "wrong nic number");
                $("#idForm").validate({
                    rules: {
                        vEmail: {
                            email: true,
                            required: true,
                            email_custome: true
                        },
                        password: {
                            required: true,
                        },
                    },
                    messages: {
                        vEmail: {
                            email: "Email Should be in Proper Format!",
                            required: "Please Enter Email!",
                            email_custome: "Email shouild be in Proper Format!"
                        },
                        vPassword: {
                            required: "Please Enter Password!",
                        },
                    },
                    submitHandler: function (form) {
                        // form.submit();
                        var url = "<?php echo base_url(); ?>login/dologin"; // the script where you handle the form input.
                        var formData = new FormData($(form)[0]);
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: formData, // serializes the form's elements.
                            async: false,
							dataType: 'json',
                            success: function (data)
                            {

                                $("#flashError").html('');
                                $("#flashSuccess").html('');
                                if (data.response == 'fail') {
                                    $("#flashError").html('<div class="alert alert-danger" ><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' + data.responseMsg + '</div>').delay(3000).fadeOut("slow");
                                } else {
                                    
                                    window.location = "<?php echo base_url(); ?>dashboard";
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                });

            });
            function getText() {
                $("#vPassword").removeAttr("type");
                $("#vPassword").attr("type", "text");
            }
            function getPassword() {
                $("#vPassword").removeAttr("type");
                $("#vPassword").attr("type", "password");
            }
        });



    </script>

    <style type="text/css">
        .error{
            color: red;
        }
    </style>
</body>

</html>