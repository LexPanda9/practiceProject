<?php

if (!session_id()) {
    ob_start();
    session_start();
}

class myfproject{
    private $localhost = "localhost"; //or the online hostname
    private $username = "root";
    private $password = "";
    private $database = "projectdb";
    
    private $user_table = "user";
    private $admin_table = "myadmin";



    public function connect() {
        $link = mysqli_connect($this->localhost, $this->username, $this->password, $this->database);
        if(mysqli_select_db($link, $this->database)) {
            return ($link);
        } else {
            echo "Not connected" . mysqli_connect_error();
        }
    }

    public function query($sql) {
        $result = $this->connect();
        $query = mysqli_query($result, $sql);
        if ($query) {
            return ($query);
        } else {
            echo "Database Error" . mysqli_error($result);
        }
    }

    public function validatePassword($pass, $cpass) {
        if ($pass == $cpass) {
            return 1;
        } else{
            return 0;
        }
    }

    public function getDate() {
        date_default_timezone_set("Africa/Lagos");
        $date = date("F - j D - Y g:ia");
        return $date;
    }

    public function hashpassword($pass) {
        $hashp = password_hash($pass, PASSWORD_DEFAULT);
        return $hashp;
    }


    //main function
    public function userRegister($fullname, $username, $email, $phone, $country, $password, $cpassword) {
        $status = "ACTIVE";
        $date = $this->getDate();

        $hashpassword = $this->hashpassword($password);
        $checkUserName = $this->query("SELECT * FROM $this->user_table WHERE `username` = '" . $username . "' ");
        $checkEmail = $this->query("SELECT * FROM $this->user_table WHERE `email` = '" . $email . "' ");
        $checkPass = $this->validatePassword($password, $cpassword);

        if ($checkPass) {
            if (mysqli_num_rows($checkUserName) > 0) {
                echo "Username already exists";
            } else {
                if (mysqli_num_rows($checkEmail) > 0) {
                    echo "Email already exists";
                } else {
                    if (strlen($password) > 7 && strlen($password) < 35) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $insert = $this->query("INSERT INTO $this->user_table VALUE(null, '".$fullname."','".$username."',
                            '".$email."','".$phone."','".$country."','".$hashpassword."','".$status."','".$date."', '".$status."') ");
                            if ($insert) {
                                header("location:login.php");
                            } else {
                                return "unknown error contact admin";
                            }
                        } else {
                            return "Enter valid email";
                        }
                    } else {
                        return "Minimum of 8 letters and maximum of 35 letters required";
                    }
                }
            }
        } else {
            return "Input same password";
        }
    }










    //2nd main function
    public function user_login($user, $password) {
        $checkUser = $this->query("SELECT * FROM $this->user_table WHERE `email`= '" .
         $user . "' OR `username`='" .$user ."' ");
         if(mysqli_num_rows($checkUser) > 0) {
            $row = mysqli_fetch_assoc($checkUser);
            $passwordDB = $row["password"];
            $passwordHash = $this->hashpassword($password);
            if ($passwordHash == password_verify($password, $passwordDB)) {
                $_SESSION["user_logged"] = $row["email"];
                header("location:index.php");
            } else{
                return "Incorrect Username/Email or password333";
            }
         } else {
             return "Incorrect Username/Email or password222";
         }
    }

    public function setUserLogged() {
        if (isset($_SESSION["user_logged"]) && !empty($_SESSION["user_logged"])) {
            $_SESSION["logged_in"] = $_SESSION["user_logged"];
        }
    }

    public function checkUserLogged() {
        if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])) {
            
        } else{
            header("location:login.php");
        }
    }



    public function imageName() {
        $prefix = 'IMAGE';
        $suffix = uniqid();
        return ($prefix . $suffix);
    }
    public function Acomparison($data) {
        $mdata = ["name" => NULL, "full_path" => NULL, "type" => NULL, "tmp_name" => NULL, "error" => 4, "size" => 0];
        $result = array_diff($data, $mdata);
        return $result;
    }

    //3rd main function
    public function uploading_file($file) {
    $fileName = $file["name"];
    $fileFullName = $file["full_path"];
    $fileType = $file["type"];
    $fileTmpName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

        $extAllowed = ["jpg", "jpeg", "png", "gif", "img"];
        $fileScatter = explode(".", $fileName);
        $extLower = strtolower(end($fileScatter));
        // $fileNewName = uniqid("", true) . "." . $extLower;
        $fileNewName = $this->imageName() . "." . $extLower;

        if (empty($this->Acomparison($file))) {
            $gg = "empty, select file";
        } else {
            if ($fileError !== 0) {
                $gg = "file is corrupt";
            } else {
                if ($fileSize > 1000000) {
                    $gg = "file is too big";
                } else {
                    if (!in_array($extLower, $extAllowed)) {
                        $gg = "file extension not supported yet";
                    } else{
                        $update = $this->query("UPDATE $this->user_table SET `filename`='" . $fileNewName . "' WHERE 
                        `email`='" . $_SESSION['logged_in'] . "' ");
                        $fileDestination = "pf/" . $fileNewName;
                        $pf = move_uploaded_file($fileTmpName, $fileDestination);
                        if ($update && $pf) {
                            echo "Upload successful";
                            sleep(1);
                            header("location:settings.php?success");
                        } else {
                            $gg = "Error uploading image";
                        }
                    }
                }
            }
        }

    }





    public function getUserDetails($value) {
        $select = $this->query("SELECT * FROM $this->user_table WHERE `email`='" . $_SESSION['logged_in'] . "' ");
        $row = mysqli_fetch_assoc($select);
        return $row[$value];
    }









// ....................................ADMIN SPACE...........................................................




    // public function adminRegister($fullname, $username, $email,  $password, $cpassword) {
        
    //         $date = $this->getDate();
    //         $hashPassword = $this->hashpassword($password);
    //         $checkUsername = $this->query("SELECT * FROM $this->admin WHERE `username`='" . $username . "' ");
    //         $checkEmail = $this->query("SELECT * FROM $this->admin WHERE `email`='" . $email . "' ");
    //         $checkPass = $this->validatePassword($password, $cpassword);
    //         if ($checkPass) {
    //             if (mysqli_num_rows($checkUsername) > 0) {
    //                 return "Username Already in our database, pick another one";
    //             } else {
    //                 if(mysqli_num_rows( $checkEmail)> 0){
    //                     return "Email Already in our database, pick another one";
    //                 }else{
    //                 if (strlen($password) > 8 && strlen($password) < 36) {
    //                     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //                     $insert = $this->query("INSERT INTO $this->admin VALUE(null,'" . $fullname . "','" . $username . "','" . $email . "','" . $hashPassword . "','" . $date . "') ");
    //                     if ($insert) {
    //                         header("location: login-myadmin.php");
    //                     } else {
    //                         return "System error: please contact admin";
    //                     }
    //                     } else {
    //                     return "Enter a valid email address";
    //                 }
    //                 } else {
    //                     return "Password should be b/w 8 and 36 characters";
    //                 }
    //                 }
    //             }
    //         } else {
    //             return "Passwords are not the same";
    //         }
    // }


    public function adminLogin($user, $password) {
            // check if the email and username are in our db
            // check if the password is same as in our db
            // create a login section
            // remember to echo your error msg in the login.php

            $checkAdmin = $this->query("SELECT * FROM $this->admin_table WHERE `email`= '" . $user . "'  ");

            if (mysqli_num_rows($checkAdmin) > 0) {
                $row = mysqli_fetch_assoc($checkAdmin);
                $passwordDB = $row['password'];
                //$passwordHash = $this->hashpassword($password);
                $passwordHash = $password;
                //if ($passwordHash == password_verify($password, $passwordDB)) {
                if ($passwordHash == $passwordDB) {
                    $_SESSION["admin_logged"] = $row['email'];
                    header("location:index-admin.php");
                } else {
                    return "incorrect username/email or password2";
                }
            } else {
                return "incorrect username/email or password1";
            }
    }

    public function setAdminLogin() {

      if (isset($_SESSION['admin_logged']) && !empty($_SESSION['admin_logged'])) {

          $_SESSION['logged_admin'] = $_SESSION['admin_logged'];
      }
    }

    public function checkAdminLogged() {
      if (isset($_SESSION['logged_admin']) && !empty($_SESSION['logged_admin'])) {
      } else {
          header("location: login-myadmin.php");
      }
    }


}

$call = new myfproject();
$call->setUserLogged();
$call->setAdminLogin();
?>