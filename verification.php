<?php

    session_start();
    require "header.php";
    require "Config.php";
    require "User.php";
    $connn=new Dbcon();
    

    if(isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['mobile'])) {
        $email=$_SESSION['email'];
        $name=$_SESSION['name'];
        $mobile=$_SESSION['mobile'];
    } else if(!(isset($_SESSION['email'])) && !(isset($_SESSION['name'])) && !(isset($_SESSION['mobile']))) {
        echo '<script>window.location="index.php";</script>';
    }

?>

<div style="text-align:center;margin-top:40px;">
<h3><u>User Name :</u><span style="margin-left:20px;"><i><?php  echo $name; ?></i></span></h3>
<h3><u>Mail id :</u><span style="margin-left:20px;"><i><?php  echo $email; ?></i></span></h3>
<h3><u>Mobile no. :</u><span style="margin-left:20px;"><i><?php  echo $mobile; ?></i></span></h3>
</div>

<form method="POST">
<input type="submit" name="vbyemail" class="a" style="margin:190px;margin-left:310px;" value="Verification By Email">
<input type="submit" name="vbyphone" class="a" value="Verification By Phone No.">
</form>





<?php

    if(isset($_POST['vbyemail'])) {

        if(isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['mobile'])) {
            $email=$_SESSION['email'];
            $name=$_SESSION['name'];
            $mobile=$_SESSION['mobile'];

            $sendmail=new User();
            $sendmail->sendEmail($connn, $email, $name, $mobile);
            
        } else {
            echo '<script>alert("Session Destroyed, Cant verify now!! First you have to Register yourself as a new user.");</script>';
        }

    }

    if(isset($_POST['vbyphone'])) {
        

        if(isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['mobile'])) {
            $email=$_SESSION['email'];
            $name=$_SESSION['name'];
            $mobile=$_SESSION['mobile'];
            
            $sendmobile=new User();
            $sendmobile->sendMobile($connn, $email, $name, $mobile);

        } else {
            echo '<script>alert("Session Destroyed, Cant verify now!! First you have to Register yourself as a new user.");</script>';
        }

    }

    

    require "footer.php";


?>