<?php

session_start();
require "header.php";
require_once "Config.php";
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






<div style="margin:190px;margin-left:210px;text-align:center;">
<label><u>OTP sent to your Email id </u>: <span><i><?php echo $email; ?></i></span><br><br>
<form method="POST">
<input type="text" name="getotp" placeholder="Enter OTP here"><br><br>
<input type="submit" name="vemail" id="email" class="a" value="Verify" >
<input type="submit" name="resende" id="resnde" class="btn-success a" value="Resend" >

</form>
</div>


<?php

    if(isset($_POST['vemail'])) {
        $getotp=$_POST['getotp'];
        if(isset($_SESSION['otp'])) {
            $otp=$_SESSION['otp'];
            if($otp==$getotp) {

                
                $vp=new User();
                $vp->verifyEmail($connn, $email);
                echo '<script>alert("otp matched");</script>';
                echo '<script>window.location="login.php";</script>';


            } else {
                echo '<script>alert("otp mis-matched");
                
                </script>';

            }

                

        }
    }

    if(isset($_POST['resende'])) {
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


?>

<script>

    $("#resnde").hide();

    setTimeout(function(){ $("#resnde").show(); }, 11000);


</script>

<?php

    require "footer.php";

?>