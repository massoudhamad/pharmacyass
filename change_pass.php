<?php
//session_start();
include_once "DB.php";
$user = new DBHelper();
$db = new DBHelper();
?>


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Forgot Password</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->



    </script>
</head>
<style>
#login-form label.error {
    color: red;
    font-weight: bold;
}

.main {
    width: 600px;
    margin: 0 auto;
}
</style>
<!-- END: Head-->

<!-- BEGIN: Body-->
<?php
$hospitals= $db->getRows('hospital',array('order_by'=>'hospitalID ASC'));
if(!empty($hospitals)){
    foreach($hospitals as $hospitals){
            $email = $hospitals['email'];
            $hospital_name = $hospitals['hospitalName'];
            $hospital_code = $hospitals['hospitalCode'];
            $profile=$hospitals['hospital_logo'];
            $firstname=$hospitals['firstname'];
            $middlename=$hospitals['middlename'];
            $lastname=$hospitals['lastname'];
            $phone=$hospitals['telephoneNumber'];
    }   
}
?>

<body class="vertical-layout vertical-menu 1-column  bg-full-screen-image blank-page" data-open="click"
    data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <?php
                                    if(!empty($profile)){?>
                                        <img alt="Hospital Logo" src="<?php echo 'profile_img/'. $profile?>"
                                            style="height:130px;">
                                        <?php
                                    }else{?>
                                        <img alt="Hospital Logo" src="logo.png" style="height:130px;">
                                    </div>
                                    <?php
                                    }if(!empty($hospital_name)){?>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-10">
                                        <span><?php echo $db->decrypt($hospital_name); ?></span>
                                    </h6>
                                    <?php
                                    }else{?>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-10">
                                        <span>[Name of Hospital]</span>
                                    </h6>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="card-content">
                                    <h1 style="text-align:center">Electronic Medical Records</h1><br />
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                        <span>CHANGE PASSWORD</span>
                                    </p>
                                    <div style='color:red'>
                                        <center><b><?php echo $error;  ?></b></center>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal" method="post" action="action_achange_pass.php"
                                            id="login-form">
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="username" name="password"
                                                    placeholder="Enter New Password">
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="username"
                                                    name="confirm_password" placeholder="Conform New Password">
                                                <input type="hidden" class="form-control" id="username" name="email"
                                                    value="<?php echo $_SESSION['forgot_email']?>">
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">

                                                <div class="col-sm-12 col-12 float-sm-left text-center text-sm-right"><a
                                                        href="index.php" class="card-link">Back To
                                                        Login?</a></div>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info btn-block"
                                                name="updatePassword" id="login-submit" value="Log In"><i
                                                    class="ft-unlock"></i>
                                                Change Password</button>
                                            <br>
                                            <center><span> Powered by <a href="https://hmytechnologies.com"
                                                        target="_blank">HM&Y Technologies</a></span></center>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>

        </div>
    </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script> -->
    <script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="app-assets/js/scripts/forms/form-login-register.js"></script> -->
    <!-- END: Page JS-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- Download the latest jquery.validate minfied version -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script>
    $().ready(function() {
        $("#login-form").validate({
            rules: {
                usr: {
                    required: true,
                },
                pwd: {
                    required: true,
                },
            },
            messages: {
                pwd: {
                    required: "This Field is Required",

                },
                usr: "This Field is Required"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    </script>

</body>
<!-- END: Body-->

</html>