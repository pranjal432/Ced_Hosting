<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "/opt/lampp/htdocs/training/CedHosting/vendor/autoload.php";

    class User {

        function signup($connn,$name,$email,$mobile,$password,$securityquestion,$securityanswer) {

            $errors=array();
            strtolower($email);
            $password=md5($password);
            

            $sql1="SELECT * from `tbl_user` WHERE `email`='".$email."' AND `mobile`='".$mobile."'";
            

            $result=$connn->con->query($sql1);

            
            if ($result->num_rows > 0) {
                $errors[]=array("input"=>"form","msg"=>"Username already present");
                echo "error";

            }
            if (count($errors)==0) {

                
                

                setcookie("username", $email, time() + (60*60*24), "/");
                $sql="INSERT INTO tbl_user (`email`,`name`,`mobile`,`email_approved`,`phone_approved`,`active`,`is_admin`,`password`,`security_question`,`security_answer`)
                VALUES ('".$email."','".$name."','".$mobile."',0,0,0,0,'".$password."','".$securityquestion."','".$securityanswer."')";
                
                if ($connn->con->query($sql)==true) {
                    echo "New record created successfully";
                    // echo "<script>window.location='verification.php';</script>";
                    $_SESSION['useremail']=$email;
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
                        echo "<script>window.location='admin/index.php';</script>";
                    } else {
                        echo "<script>alert('invalid email/password!!');</script>";
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

        function sendEmail($connn, $email, $name, $mobile) {

            $otp = rand(1000, 9999);
            $_SESSION['otp']=$otp;
            $mail = new PHPMailer();
            try {
                $mail->isSMTP(true);
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'princeshukla4321@gmail.com';
                $mail->Password = 'Password123$@';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setfrom('princeshukla4321@gmail.com', 'CedHosting');
                $mail->addAddress($email);
                $mail->addAddress($email, $name);

                $mail->isHTML(true);
                $mail->Subject = 'Account Verification';
                $mail->Body = 'Hi User,Here is your otp for account verification-'.$otp;
                $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                $mail->send();
                echo '<script>window.location="verificationbyemail.php?email='.$email.'";</script>';
            }
            catch (Exception $e) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
            }
        }

        function sendMobile($connn, $email, $name, $mobile) {

            $otp1 = rand(1000, 9999);
            $_SESSION['otp1']=$otp1;

            $fields = array(
                "sender_id" => "FSTSMS",
                "message" => "This is Test message from Pranjal Shukla ".$name." OTP is :".$otp1,
                "language" => "english",
                "route" => "p",
                "numbers" => $mobile,
            );
            
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_SSL_VERIFYHOST => 0,
              CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => json_encode($fields),
              CURLOPT_HTTPHEADER => array(
                "authorization: 2XA04wai3uNM7fYTlbHvFdG165mtLOjrxgZEIJRBzkyPWoscSprBcqPHjZysFTCuX8w5YRQl2gWU0VLI",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              echo $response;
              echo '<script>window.location="verificationbyphone.php?mobile='.$mobile.'";</script>';
            }

        }

        function verifyEmail($connn,$email) {

            $sql="UPDATE tbl_user SET `email_approved`=1 , `active`=1 WHERE `email`='".$email."'";
            if($connn->con->query($sql)==true) {

               unset($_SESSION['email']);
               unset($_SESSION['name']);
               unset($_SESSION['mobile']);
               unset($_SESSION['otp']);

            }

        }

        function verifyMobile($connn,$mobile) {

            $sql="UPDATE tbl_user SET `phone_approved`=1 , `active`=1 WHERE `mobile`='".$mobile."'";
            if($connn->con->query($sql)==true) {

                unset($_SESSION['email']);
                unset($_SESSION['name']);
                unset($_SESSION['mobile']);
                unset($_SESSION['otp1']);

            }



        }

        function catDetails($connn, $id) {

            $arr=array();
            $sql="SELECT * from tbl_product WHERE `id`='".$id."'";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {
                    array_push($arr, $row);

                }
                return $arr;
            }
        }

        function fetchChildId($connn, $id) {
            $arr=array();
            $sql="SELECT * from tbl_product WHERE `prod_parent_id`='".$id."'";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {
                    array_push($arr, $row);
                }
                return $arr;
            }
        }

        function fetchProductDetails($connn, $id1) {

            $arr=array();
            $sql="SELECT * from tbl_product INNER JOIN tbl_product_description ON tbl_product.id=tbl_product_description.prod_id WHERE `prod_id`='".$id1."'";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {
                    array_push($arr, $row);
                }
                return $arr;
            }
        }


    }

?>