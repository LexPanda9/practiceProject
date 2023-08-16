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
                    <li class="">
                        <a href="index.php">
                            <i class="fa fa-th-large"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="open">
                        <a href="javascript:;">
                            <i class="fa fa-gear"></i>
                            <span class="title">Settings</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="active" href="settings.php">General Settings</a>
                            </li>
                            <li>
                                <a class="" href="account-confirmation.html">Account Confirmation</a>
                            </li>
                        </ul>
                    </li>
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
        <div id="main-content" class=" ">
            <section class="wrapper main-wrapper row" style=''>

                <div class='col-xs-12'>
                    <div class="page-title">

                        <div class="pull-left">
                            <!-- PAGE HEADING TAG - START -->
                            <h1 class="title">Settings</h1>
                            <!-- PAGE HEADING TAG - END -->
                        </div>


                    </div>
                </div>



                <div class="clearfix"></div>

                <div class="col-lg-12">
                    <section class="box has-border-left-3">
                            <header class="panel_header">
                                <h2 class="title pull-left">Personal Information</h2>
                            </header>
                            <div class="content-body">    
                                <div class="row">
                                    <div class="form-container">
                                        <form method="POST" enctype="multipart/form-data">

                                            <div class="row">
                                                <div class="col-xs-12 mb-20">
                                                    
                                                    <div class="col-sm-12 avatar-img ">
                                                        <div class="avatar-img-wrapper">
                                                            <img src="../data/icons/default-avatar.png" style="max-width:100px" alt="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label" for="formfield10">Upload File</label>
                                                            <span class="desc">"JPG, JPEG, IMG, GIF or PNG Max size of 800K"</span>
                                                            <div class="controls">
                                                                <input type="file" class="" id="formfield10" name="filer" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                    <div class="pull-left">
                                                        <h4><i class="fa fa-info-circle color-primary complete f-s-14"></i><small><?php if (isset($gg) && !empty($gg)) {
                                                            echo $gg;
                                                        } ?></small></h4>
                                                    </div>
                                                
                                                
                                                    <div class="pull-right">
                                                        <i class="fa fa-check"><input type="submit" name="upload" value="UPLOAD" class="btn btn-primary btn-corner right15"></i>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>


                <!-- MAIN CONTENT AREA ENDS -->
            </section>
        </div>
        <!-- END CONTENT -->
        

        <div class="chatapi-windows ">

        </div>
    </div>
    <!-- END CONTAINER -->
    <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


            <?php
            
            require_once("footer.php");
            
            ?>