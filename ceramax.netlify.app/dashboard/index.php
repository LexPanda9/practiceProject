<?php
require_once("../controller/controller.php");
if (isset($_POST["upload"])){

    // print_r ($_FILES["filer"]);
    // echo "<br>";
    $file = $_FILES["filer"];
    
    

    if (!empty($call->Acomparison($file))) {
        $call->uploading_file($file);
    } else {
        $gg = "empty!";
    }
}

if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])) {
    $user_detail = $call->getUserDetails("username");
}





require_once("head.php");

?>

<!-- BEGIN BODY -->

<body class=" ">
    <!-- START TOPBAR -->
    <div class='page-topbar '>
        <div class='logo-area'>

        </div>
        <div class='quick-area'>
            <div class='pull-left'>
                <ul class="info-menu left-links list-inline list-unstyled">
                    <li class="sidebar-toggle-wrap">
                        <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                    
                    <!-- <li class="hidden-sm hidden-xs searchform">
                        <form method="post" action="#">
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                                <input type="text" class="form-control animated fadeIn" placeholder="Search & Enter">
                            </div>
                            <input type='submit' value="">
                        </form>
                    </li> -->
                </ul>
            </div>
            <div class='pull-right'>
                <ul class="info-menu right-links list-inline list-unstyled">
                <?php if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])) { ?>
                    <li class="profile">
                    <a href="#" data-toggle="dropdown" class="toggle">
                            <?php 
                            $result = $call->query("SELECT * FROM user WHERE `email`='".$_SESSION["logged_in"]."' ");
                            if ($data = mysqli_fetch_assoc($result)) { ?>
                            <img src="pf/<?php echo $data["filename"]; ?>" alt="user-image" class="img-circle img-inline">
                            <?php } ?>
                            <span><?php echo $user_detail; ?> <i class="fa fa-angle-down"></i></span>
                        </a>
                        <ul class="dropdown-menu profile animated fadeIn">
                            <li>
                                <a href="account-confirmation.html">
                                    <i class="fa fa-wrench"></i> Settings
                                </a>
                            </li>
                            <li>
                                <a href="ui-profile.html">
                                    <i class="fa fa-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="ui-support.html">
                                    <i class="fa fa-info"></i> Help
                                </a>
                            </li>
                            <li class="last">
                                <a href="logout.php">
                                    <i class="fa fa-lock"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>
                <span><i class="fa"><?php echo "GUEST"; ?></i></span>
                <?php } ?>
                    <li class="chat-toggle-wrapper">
                        <a href="#" data-toggle="chatbar" class="toggle_chat">
                            <i class="fa fa-comments"></i>
                            <span class="badge badge-accent">9</span>
                            <i class="fa fa-times"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <!-- END TOPBAR -->
    <!-- START CONTAINER -->
    <div class="page-container row-fluid container-fluid">

        <!-- SIDEBAR - START -->

        <div class="page-sidebar fixedscroll">

            <!-- MAIN MENU - START -->
            <div class="page-sidebar-wrapper" id="main-menu-wrapper">


                <ul class='wraplist'>
                    <li class='menusection'>Main</li>
                    <li class="open">
                        <a href="index.php">
                            <i class="fa fa-th-large"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <?php if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])) { ?>
                    <li class="">
                        <a href="javascript:;">
                            <i class="fa fa-gear"></i>
                            <span class="title">Settings</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="" href="settings.php">General Settings</a>
                            </li>
                            <li>
                                <a class="" href="account-confirmation.html">Account Confirmation</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if (!isset($_SESSION["logged_in"]) && empty($_SESSION["logged_in"])) { ?>
                    <li class="">
                        <a href="javascript:;">
                            <i class="fa fa-lock"></i>
                            <span class="title">Access Pages</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="" href="login.php">Login</a>
                            </li>
                            <li>
                                <a class="" href="register.php">Registration</a>
                            </li>
                            
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="">
                        <a href="javascript:;">
                            <i class="fa fa-question-circle"></i>
                            <span class="title">Support</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="" href="ui-faq.html">FAQ</a>
                            </li>
                            <li>
                                <a class="" href="ui-support.html">Help center</a>
                            </li>
                        </ul>
                    </li>
                        <?php if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])) { ?>
                    <li class="menusection"><a href="logout.php">LOG OUT</a></li>
                        <?php } ?>
                    
                    
                    
                    
                    
                </ul>

            </div>
            <!-- MAIN MENU - END -->

        </div>
        <!--  SIDEBAR - END -->

        <!-- START CONTENT -->
        <section id="main-content" class=" ">
            <div class="wrapper main-wrapper row" style=''>

                <div class='col-xs-12'>
                    <div class="page-title">

                        <div class="pull-left">
                            <!-- PAGE HEADING TAG - START -->
                            <h1 class="title">Dashboard</h1>
                            <!-- PAGE HEADING TAG - END -->
                        </div>

                    </div>
                </div>
                <div class="col-lg-12">
                    <section class="box nobox marginBottom0">
                        <div class="content-body">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="r4_counter db_box has-gradient-to-right-bottom">
                                        <div class="icon-after cc BTC-alt"></div>
                                        <i class='pull-left cc BTC-alt icon-md icon-white mt-10'></i>
                                        <div class="stats">
                                            <h3 class="color-white mb-5">1.003747 BTC</h3>
                                            <span>Wallet BTC balance</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="r4_counter db_box">
                                        <div class="icon-after cc DASH-alt"></div>
                                        <i class='pull-left cc DASH-alt icon-md icon-primary mt-10'></i>
                                        <div class="stats">
                                            <h3 class="mb-5">5.19034 DASH</h3>
                                            <span>Wallet DASH balance</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="r4_counter db_box">
                                        <div class="icon-after cc LTC-alt"></div>
                                        <i class='pull-left cc LTC-alt icon-md icon-primary mt-10'></i>
                                        <div class="stats">
                                            <h3 class="mb-5">12.60349 LTC</h3>
                                            <span>Unconfiremed balance</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- End .row -->
                        </div>
                    </section>
                </div>

                <div class="clearfix"></div>
                <!-- MAIN CONTENT AREA STARTS -->
                
               

                <!-- MAIN CONTENT AREA ENDS -->
                </div>
        </section>
        <!-- END CONTENT -->
        

        <div class="chatapi-windows ">

        </div>
    </div>
    <!-- END CONTAINER -->
    <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


            <?php
            
            require_once("footer.php");
            
            ?>