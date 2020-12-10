<?php    
    session_start();
   
    //require "Config.php";
    



    if(isset($_SESSION['admindata'])) {

        //echo '<center><h1 style="margin-top:80px;color:yellow;">Welcome <u><b><span style="font-size:50px;">'.$_SESSION['userdata']['username'].'</span></b></u> to the Logout Section</h1></center>';
        session_unset();
        session_destroy();
        echo '<script>window.location="../index.php";</script>';
    }


?>


</body>
</html>

