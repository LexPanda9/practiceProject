<?php
require_once("../controller/controller.php");

if (isset($_SESSION["logged_admin"]) && !empty($_SESSION["logged_admin"])) {
    session_destroy();
    header("location:admin-login.php");
}