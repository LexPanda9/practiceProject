<?php
require_once("../controller/controller.php");

if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])) {
    header("location:index.php");
}

if(isset($_POST["submit"]) && !empty($_POST["submit"])) {
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $country = $_POST["country"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    if(!empty($fullname) && !empty($username) && !empty($email) && !empty($phone) && !empty($country) && 
    !empty($password) && !empty($cpassword)) {
        $msg = $call->userRegister($fullname, $username, $email, $phone, $country, $password, $cpassword);
    } else {
        $msg = "*please fill in all field";
    }

}


?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from ceramax.netlify.app/dashboard/ui-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Sep 2022 03:07:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- 
        * @Package: Ceramax - Bitcoin & Cryptocurrency trading Dashboard
        * @Version: 1.0.0
    -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ceramax : Bitcoin & Cryptocurrency trading Dashboard</title>
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon" />
    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" href="../assets/images/apple-touch-icon-57-precomposed.png">
    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/images/apple-touch-icon-114-precomposed.png">
    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/images/apple-touch-icon-72-precomposed.png">
    <!-- For iPad Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/images/apple-touch-icon-144-precomposed.png">

    <!-- CORE CSS FRAMEWORK - START -->
    <link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
    <!-- CORE CSS FRAMEWORK - END -->

    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - START -->

    <link href="../assets/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" media="screen" />

    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - END -->

    <!-- CORE CSS TEMPLATE - START -->
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <!-- CORE CSS TEMPLATE - END -->

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class=" login_page">

    <div class="container-fluid">
        <div class="login-wrapper row">
            <div id="login" class="login loginpage col-lg-offset-2 col-md-offset-3 col-sm-offset-3 col-xs-offset-0 col-xs-12 col-sm-6 col-lg-8">    
                <div class="login-form-header">
                     <img src="../data/icons/signup.png" alt="login-icon" style="max-width:64px">
                     <div class="login-header">
                     <?php if(isset($msg) && !empty($msg)) {
                         if($msg == 1) { ?>
                        <p style="color: greeen;">    <?php echo "success"; ?> </p>
                        <?php } else { ?>
                            <p style="color: red;">    <?php echo $msg; ?> </p>
                        <?php }
                     } else {?>
                     <h4 class="bold color-white">Signup Now!</h4>
                     <h4><small>Please enter your data to register.</small></h4>
                     <?php } ?>   
                         
                     </div>
                </div>
               
                <div class="box login">

                    <div class="content-body" style="padding-top:30px">

                        <form id="msg_validate" method="post" class="no-mb no-mt">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="col-lg-12 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">FullName</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="fullname" placeholder="enter full name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">User name</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="username" placeholder="enter username">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="phone" placeholder="enter phone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Country</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="country" placeholder="enter country">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 no-pr">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="email" placeholder="enter email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <div class="controls">
                                                <input type="password" class="form-control" name="password" placeholder="enter password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 no-pr">
                                        <div class="form-group">
                                            <label class="form-label">Repeat Password</label>
                                            <div class="controls">
                                                <input type="password" class="form-control" name="cpassword" placeholder="repeat password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pull-left">
                                        <input type="submit" value="Submit" name="submit" class="btn btn-primary mt-10 btn-corner right-15">
                                        <a href="login.php" class="btn mt-10 btn-corner signup">Login</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <p id="nav">
                    <a class="pull-left" href="#" title="Password Lost and Found">Forgot password?</a>
                    <a class="pull-right" href="ui-login.html" title="Sign Up">Login</a>
                </p>

            </div>
        </div>
    </div>

    <!-- MAIN CONTENT AREA ENDS -->
    <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

    <!-- CORE JS FRAMEWORK - START -->
    <script src="../assets/js/jquery-1.11.2.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/plugins/viewport/viewportchecker.js"></script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/jquery-1.11.2.min.js"><\/script>');
    </script>
    <!-- CORE JS FRAMEWORK - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->

    <script src="../assets/plugins/icheck/icheck.min.js"></script>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

    <!-- CORE TEMPLATE JS - START -->
    <script src="../assets/js/scripts.js"></script>
    <!-- END CORE TEMPLATE JS - END -->

</body>


<!-- Mirrored from ceramax.netlify.app/dashboard/ui-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Sep 2022 03:07:35 GMT -->
</html>