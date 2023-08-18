<?php

  if (!session_id()) {
     ob_start();
     session_start();
  }
  
  $localhost = "";
  $username = "root";
  $password = "";
  $database = "project";
  $user = "newuser";
  $post = "posts";
  $admin = "myadmin";

    class Project
    {
        private $localhost = "";
        private $username = "root";
        private $password = "";
        private $database = "project";
        private $user = "newuser";
        private $post = "posts";
        private $admin = "myadmin";

        public function connect()
        {
            $link = mysqli_connect($this->localhost, $this->username, $this->password, $this->database);
            if (mysqli_select_db($link, $this->database)) {
                return ($link);
            } else {
                print 'Not Connected' . mysqli_connect_error();
            }
        }
        public function query($sql)
        {
            $result = $this->connect();
            $query = mysqli_query($result, $sql);
            if ($query) {
                return ($query);
            } else {
                print 'Database Error' . mysqli_error($result);
            }
        }
        public function validatePassword($pass, $cpass)
        {
            if ($pass == $cpass) {
                return 1; 
            } else {
                return 0;
            }
        }

        public function getDate()
        {
            date_default_timezone_set("Africa/Lagos");
            $date = date("F - j D - Y g:ia");
            return ($date);
        }

        public function hashpassword($pass)
        {
            $hashp = password_hash($pass,PASSWORD_DEFAULT);
            return ($hashp);
        }

        public function userRegister($fullname, $username, $email, $phone, $country, $password, $cpassword)
        {
            $status = 'ACTIVE';
            $date = $this->getDate();
            $hashPassword = $this->hashpassword($password);
            $checkUsername = $this->query("SELECT * FROM $this->user WHERE `username`='" . $username . "' ");
            $checkEmail = $this->query("SELECT * FROM $this->user WHERE `email`='" . $email . "' ");
            $checkPass = $this->validatePassword($password, $cpassword);
            if ($checkPass) {
                if (mysqli_num_rows($checkUsername) > 0) {
                    return "Username Already in our database, pick another one";
                } else {
                    if(mysqli_num_rows( $checkEmail)> 0){
                        return "Email Already in our database, pick another one";
                    }else{
                    if (strlen($password) > 8 && strlen($password) < 36) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $insert = $this->query("INSERT INTO $this->user VALUE(null,'" . $fullname . "','" . $username . "','" .
                         $email . "','" . $phone . "','" . $country . "','" . $hashPassword . "','" . $status .
                          "',null,null,null,null,'" . $date . "') ");
                        if ($insert) {
                            header("location: login.php");
                        } else {
                            return "System error: please contact admin";
                        }
                    } else {
                        return "Enter a valid email address";
                    }
                    } else {
                        return "Password should be b/w 8 and 36 characters";
                    }
                }
            }
            } else {
                return "Passwords are not the same";
            }
        }
        public function userLogin($user,$password){
        $checkUser = $this->query("SELECT * FROM $this->user WHERE `email`='" .
        $user . "' OR `username`='" .$user ."' ");
        if (mysqli_num_rows($checkUser) > 0) {
            $row = mysqli_fetch_assoc($checkUser);
            $passwordDb = $row['password'];
            $passwordHash = $this->hashpassword($password);
            if ($passwordHash == password_verify($password,$passwordDb)) {
                if ($row['status'] == 'ACTIVE') {
                    $_SESSION["user_logged"] = $row['email'];
                    header("location: blog.php");
                }else {
                    return"You have been blocked, please contact support";
                }
            }else{
                return"Incorrect Username/Email or password333";
            }
        }else {
            return"Incorrect Username/Email or password222";
        }
        }
        public function setUserLogin()
        {
            if (isset($_SESSION['user_logged']) && !empty($_SESSION['user_logged'])) {
                $_SESSION['logged_in'] = $_SESSION['user_logged'];
            }
        }
        public function checkUserLogged()
        {
            if (isset($_SESSION['logged_in']) &&!empty($_SESSION['logged_in'])) {
            }else{
                header("location: login.php");
            }
        }
        public function getUserDetails($value)
        {
            $select = $this->query("SELECT * FROM $this->user WHERE `email`='" . $_SESSION['logged_in'] . "' ");
            $row = mysqli_fetch_assoc($select);
            return $row[$value];
        }
        public function updateUserDetails($firstname, $username, $country, $phone, $bio, $profession,$birthday)
        {  
            $update = $this->query("UPDATE $this->user SET `fullname`='" . $firstname . "',`username`='" . $username . "',`country`='" . $country . "',`phone`='" . $phone . "',`bio`='" . $bio . "',`profession`='" . $profession .  "',`birthday`='" . $birthday ."' WHERE `email`='" . $_SESSION['logged_in'] . "' ");
            if ($update) {
                return "updated successfully";
            } else {
                return "system error: please contact admin";
            }
        }

        public function updateUserPassword($oldpassword, $npassword, $cpassword)
        {
            //check oldpassword exit 
            //check cpassword and npa are dsame
            //hashpassword
            //update User 
            $checkPass = $this->validatePassword($npassword, $cpassword);
            $hashPassword = $this->hashpassword($npassword);
            $dbpassword = $this->getUserDetails('password');
            $passwordHash = $this->hashpassword($oldpassword);
            if ($passwordHash == password_verify($oldpassword, $dbpassword)) {
                if ($checkPass) {
                    $update = $this->query("UPDATE $this->user SET `password`='" . $hashPassword . "' WHERE `email`='" . $_SESSION['logged_in'] . "' ");
                    if ($update) {
                        return "password changed successfully";
                    } else {
                        return "system error: please contact admin";
                    }
                } else {
                    return "Password are not the same";
                }
            } else {
                return "Incorrect Old Password";
            }
        }
        public function extensionName($filename)
        {
            $extension = explode(".", $filename);
            $new = end($extension);
            if ($new == 'jpg' || $new == 'png' || $new = 'gif' || $new == 'jpeg') {
                return $new;
            } else {
                return (0);
            }
        }

        public function imageName()
        {
            $prefix = 'IMAGE';
            $suffix = uniqid();
            return ($prefix . $suffix);
        }

        public function uploadUserImage($newname)
        {
            $update = $this->query("UPDATE $this->user SET `image`='" . $newname . "' WHERE `email`='" . $_SESSION['logged_in'] . "' ");
            if ($update) {
                return "Your image upload was successful";
            } else {
                return "system error: please contact admin";
            }
        }

        public function creatPost($title,$content,$newname){
            $date = $this->getDate();
            $create = $this->query("INSERT INTO $this->post VALUE(null,'".$_SESSION['logged_in']."','" . $title."','".$content."','".$newname."','".$date."')");
            if ($create) {
                return "Post Created successful";
            } else {
                return "system error: please contact admin";
            }

        }
        public function getPostDetails($id,$value)
        {
            $select = $this->query("SELECT * FROM $this->post WHERE `id`='" . $id . "' AND `creator`='".$_SESSION['logged_in'] . "' ");
            $row = mysqli_fetch_assoc($select);
            return $row[$value];
        }
        public function getUserDetailsEmail($email,$value)
        {
            $select = $this->query("SELECT * FROM $this->user WHERE `email`='" . $email . "'  ");
            $row = mysqli_fetch_assoc($select);
            return $row[$value];
        }
        public function editPost($title,$content,$newname,$date,$id){
            $update = $this->query("UPDATE $this->post SET `title`='" . $title."',`content`='".$content."',`image`='".$newname."',`date`='".$date."' WHERE `id`='".$id."'  ");
            if($update){
                return 1;
            }else{
                return "system error: please contact admin";
            }
        }
        //ADMIN FUNCTIONS
    public function adminLogin($user, $password)
    {
        // check if the email and username are in our db
        // check if the password is same as in our db
        // create a login section
        // remember to echo your error msg in the login.php

        $checkAdmin = $this->query("SELECT * FROM $this->admin WHERE `email`= '" . $user . "'  ");

        if (mysqli_num_rows($checkAdmin) > 0) {
            $row = mysqli_fetch_assoc($checkAdmin);
            $passwordDB = $row['password'];
            $passwordHash = $this->hashpassword($password);
            if ($passwordHash == password_verify($password, $passwordDB)) {
                $_SESSION["admin_logged"] = $row['email'];
                header("location: index-admin.php");
        } else {
            return "incorrect username/email or password";}
    } else {
       return "incorrect username/email or password";
    }
}

  public function setAdminLogin()
  {

      if (isset($_SESSION['admin_logged']) && !empty($_SESSION['admin_logged'])) {

          $_SESSION['logged_admin'] = $_SESSION['admin_logged'];
      }
  }

  public function checkAdminLogged()
  {
      if (isset($_SESSION['logged_admin']) && !empty($_SESSION['logged_admin'])) {
      } else {
          header("location: login-myadmin.php");
      }
  }

  public function getAdminDetails($value)
    {
        $select = $this->query("select * from $this->admin WHERE `email`='" . $_SESSION['logged_admin'] . "'");
        $row = mysqli_fetch_assoc($select);
        return $row[$value];
    }

    public function editAdminProfile($fullname, $username){
        $update = $this->query("UPDATE $this->admin SET `name`='".$fullname."' , `username`='".$username."' WHERE `email`='".$_SESSION['logged_admin'] . "'");
        if($update){
            session_destroy();
            header("location: login-myadmin.php");
        }else{
            return "system error: please contact admin";
        }
    
       }
    
       
       public function getUserDetailsAdmin($value,$id)
       {
           $select = $this->query("select * from $this->admin WHERE `id`='" . $id . "'");
           $row = mysqli_fetch_assoc($select);
           return $row[$value];
       }

    //    admin Register
    public function adminRegister($fullname, $username, $email,  $password, $cpassword)
    {
       
        $date = $this->getDate();
        $hashPassword = $this->hashpassword($password);
        $checkUsername = $this->query("SELECT * FROM $this->admin WHERE `username`='" . $username . "' ");
        $checkEmail = $this->query("SELECT * FROM $this->admin WHERE `email`='" . $email . "' ");
        $checkPass = $this->validatePassword($password, $cpassword);
        if ($checkPass) {
            if (mysqli_num_rows($checkUsername) > 0) {
                return "Username Already in our database, pick another one";
            } else {
                if(mysqli_num_rows( $checkEmail)> 0){
                    return "Email Already in our database, pick another one";
                }else{
                if (strlen($password) > 8 && strlen($password) < 36) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $insert = $this->query("INSERT INTO $this->admin VALUE(null,'" . $fullname . "','" . $username . "','" . $email . "','" . $hashPassword . "','" . $date . "') ");
                    if ($insert) {
                        header("location: login-myadmin.php");
                    } else {
                        return "System error: please contact admin";
                    }
                } else {
                    return "Enter a valid email address";
                }
                } else {
                    return "Password should be b/w 8 and 36 characters";
                }
            }
        }
        } else {
            return "Passwords are not the same";
        }
    }
public function deletePost($delete){
    $sql = $this->query("DELETE FROM $this->post WHERE `id`='".$delete."' ");
    if($sql){
        return 1;
    }else{
        return "System eror";
    }
}
}
   
    $call = new Project();
    $call -> setUserLogin();
    $call->setAdminLogin();
?>