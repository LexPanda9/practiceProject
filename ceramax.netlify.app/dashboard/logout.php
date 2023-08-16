<?php
require_once("../controller/controller.php");

if (isset($_SESSION["logged_in"])) {
    session_destroy();
    header("location:login.php");
}
?>