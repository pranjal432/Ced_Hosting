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
<label><u>OTP sent to your Mobile No. </u>: <span><i><?php echo $mobile; ?></i></span><br><br>
<form method="POST">
<input type="text" name="getotp1" placeholder="Enter OTP here"><br><br>
<input type="submit" name="vphone" id="phone" class="a" value="Verify" >
<input type="submit" name="resendp" id="resndp" class="btn-success a" value="Resend" >

</form>
</div>


<?php

    if(isset($_POST['vphone'])) {
        $getotp1=$_POST['getotp1'];
        if(isset($_SESSION['otp1'])) {
            $otp1=$_SESSION['otp1'];
            if($otp1==$getotp1) {

               
                $vp=new User();
                $vp->verifyMobile($connn, $mobile);
                echo '<script>alert("otp matched");</script>';
                echo '<script>window.location="login.php";</script>';


            } else {
                echo '<script>alert("otp mis-matched");
                
                </script>';

            }

                

        }
    }

    if(isset($_POST['resendp'])) {
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


?>

<script>

    $("#resndp").hide();

    setTimeout(function(){ $("#resndp").show(); }, 11000);


</script>

<?php

    require "footer.php";

?>