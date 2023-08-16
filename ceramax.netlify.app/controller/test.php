<?php

function getgDate() {
    date_default_timezone_set("Africa/Lagos");
    $date = date("F - j D - Y g:ia");
    return $date;
}
function hashpassword($pass) {
    $hashp = password_hash($pass, PASSWORD_DEFAULT);
    return $hashp;
}

$heda = getgDate();
echo $heda . "<br>";
echo hashpassword(30002000) . "<br>";





class moreFunctions {

    public function updateUserDetails($firstname, $username, $country, $phone, $bio, $profession,$birthday)
    {  
        $update = $this->query("UPDATE $this->user SET `fullname`='" . $firstname . "',`username`='" . $username . "',
        `country`='" . $country . "',`phone`='" . $phone . "',`bio`='" . $bio . "',`profession`='" . $profession .  "',
        `birthday`='" . $birthday ."' WHERE `email`='" . $_SESSION['logged_in'] . "' ");
        if ($update) {
            return "updated successfully";
        } else {
            return "system error: please contact admin";
        }
    }
    public function getUserDetails($value)
        {
            $select = $this->query("SELECT * FROM $this->user WHERE `email`='" . $_SESSION['logged_in'] . "' ");
            $row = mysqli_fetch_assoc($select);
            return $row[$value];
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
                $update = $this->query("UPDATE $this->user SET `password`='" . $hashPassword . "' WHERE 
                `email`='" . $_SESSION['logged_in'] . "' ");
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
        $update = $this->query("UPDATE $this->user SET `image`='" . $newname . "' WHERE 
        `email`='" . $_SESSION['logged_in'] . "' ");
        if ($update) {
            return "Your image upload was successful";
        } else {
            return "system error: please contact admin";
        }
    }

    // public function creatPost($title,$content,$newname)
    // {
    //     $date = $this->getDate();
    //     $create = $this->query("INSERT INTO $this->post VALUE(null,'".$_SESSION['logged_in']."',
    //     '" . $title."','".$content."','".$newname."','".$date."')");
    // }
}

$call = new moreFunctions();
echo $call->imageName();