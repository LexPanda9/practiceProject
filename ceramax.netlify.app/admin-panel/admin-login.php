<?php
require_once("../controller/controller.php");

if (isset($_POST["submit"]) && !empty($_POST["submit"])) {
    $user = mysqli_real_escape_string($call->connect(), $_POST["email"]);
    $password = mysqli_real_escape_string($call->connect(), $_POST["password"]);
    if (!empty($user) && !empty($password)) {
        $msg = $call->adminLogin($user, $password);
    } else {
        $msg = "please fill in fields";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <!--custom style-->
  <style type="text/css">
   .registration-form{
      background: #f7f7f7;
      padding: 20px;
     
      margin: 100px 0px;
    }
    .err-msg{
      color:red;
    }
    .registration-form form{
      border: 1px solid #e8e8e8;
      padding: 10px;
      background: #f3f3f3;
    }
  </style>
</head>
<body>
<div class="container-fluid">
 <div class="row">
   <div class="col-sm-4">
   </div>
   <div class="col-sm-4">
    
    <!--====registration form====-->
    <div class="registration-form">
      <h4 class="text-center">Admin Panel</h4>
      <p class="text-success text-center"><?php if (isset($msg) && !empty($msg)) {
          echo $msg;
      } ?></p>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
       
        
        <!--// Email//-->
        <div class="form-group">
            <label>Email:</label>
            <input type="text" class="form-control"  placeholder="Enter Email" name="email" >
            <p class="err-msg">
            <?php //if($emailErr!=1){ echo $emailErr; } ?>
            </p>
        </div>
        
        <!--//Password//-->
        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control"  placeholder="Enter Password" name="password">
            <p class="err-msg">
            <?php //if($passErr!=1){ echo $passErr; } ?>
            </p>
        </div>

        
        <input type="submit" class="btn btn-secondary" name="submit" value="Login">
      </form>
    </div>
   </div>
   <div class="col-sm-4">
   </div>
 </div>
  
</div>
</body>
</html>