<?php

    class User {

        function signup($connn,$name,$email,$mobile,$password,$securityquestion,$securityanswer) {

            $errors=array();
            strtolower($email);
            $password=md5($password);
            

            $sql1="SELECT * from `tbl_user` WHERE `email`='".$email."'";

            $result=$connn->con->query($sql1);


            


            if ($result->num_rows > 0) {
                $errors[]=array("input"=>"form","msg"=>"Username already present");
                echo "error";

            }
            if (count($errors)==0) {

                echo "hello";
                

                setcookie("username", $email, time() + (60*60*24), "/");
                $sql="INSERT INTO tbl_user (`email`,`name`,`mobile`,`email_approved`,`phone_approved`,`active`,`is_admin`,`password`,`security_question`,`security_answer`)
                VALUES ('".$email."','".$name."','".$mobile."',0,0,0,0,'".$password."','".$securityquestion."','".$securityanswer."')";
                
                if ($connn->con->query($sql)==true) {
                    echo "New record created successfully";
                    echo "<script>window.location='login.php';</script>";
                } else {
                    $errors[]=array("input"=>"form","msg"=>"New record not created.");
                }

            } else {
                foreach ($errors as $error) {
                    echo "*".$error['msg']."<br>";
                }
            }

            $connn->con->close();

        }

        function login($email,$password,$connn) {

            strtolower($email);
            $password=md5($password);
        
        
            $errors=array();
            $sql1="SELECT * from tbl_user WHERE `email`='".$email."'
            AND `password`='".$password."'";
            $result=$connn->con->query($sql1);
            if ($result->num_rows > 0) {
                while ($row= $result->fetch_assoc()) {
                    if ($row['is_admin']==0 && $row['active']==1) {
                        $_SESSION['userdata']=array("username"=>$row['name'],
                        "user_id"=>$row['id']);
                        echo "<script>window.location='index.php';</script>";
                    } elseif ($row['is_admin']==1 && $row['active']==1) {
                        $_SESSION['admindata']=array("adminname"=>$row['name'],
                        "admin_id"=>$row['id']);
                        echo "<script>window.location='index.php';</script>";
                    }
            
                }
        
            } else {
                $errors[]=array("input"=>"form","msg"=>"Invalid Login credentials!!");
            }
            if (count($errors)!=0 ) {
                foreach ($errors as $error) {
                    echo "*".$error['msg']."<br>";
                }
            }
        
            $connn->con->close();
        
        
        }


    }

?>