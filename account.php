<?php

session_start();
require "header.php";
require "User.php";
//require "Config.php";
$connn=new Dbcon();



?>
		<!---login--->
			<div class="content">
				<!-- registration -->
	<div class="main-1">
		<div class="container">
			<div class="register">
			<center><div class="register-top-grid">
					<h3 style="font-size:35px;"><u>Sign Up</u> </h3>
			</div></center>
			<center><strong><u>Note :</u></strong><span> * means required</span></center>
		  	  <form method="POST" onsubmit="return validate()" style="margin-top:10px;"> 
				
				 <div class="register-top-grid">
					<h3>personal information</h3>
					 <div>
						<span>First Name<label>*</label></span>
						<input type="text" name="fname" pattern="^[a-zA-Z_]+( [a-zA-Z_]+)*$" required> 
					 </div>
					 <div>
						<span>Last Name<label>*</label></span>
						<input type="text" name="lname" pattern="^[a-zA-Z_]+( [a-zA-Z_]+)*$" required> 
					 </div>
					 <div>
						 <span>Email Address<label>*</label></span>
						 <input type="email" id="email" name="email" style="width:524px;height:37px;" required> 
					 </div>
					 <div>
						 <span>Mobile No. :<label>*</label></span>
						 <input type="text" id="mobile" name="mobile" style="width:524px;height:37px;margin-top:4px;" required> 
					 </div>
					 <div class="clearfix"> </div>
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
					   </a>
					 </div>
				     <div class="register-bottom-grid">
						    <h3>login information</h3>
							 <div>
								<span>Password<label>*</label></span>
								<input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" id="pass" maxlength="16" minlength="8" name="password" required>
							 </div>
							 <div>
								<span>Confirm Password<label>*</label></span>
								<input type="password" id="cpass" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" name="confirmpassword" maxlength="16" minlength="8" required>
							 </div>
							 
							 <div>
								<span>Add a security question:<label>*</label></span>
								<select name="securityquestion" id="squestion" style="width:524px;height:37px" required>
                                        
									<option value="" selected disabled hidden>--Select Security Question--</option>
									<option value="nickname" >What was your childhood nickname?</option>
									<option value="friend" >What is the name of your favourite childhood friend?</option>
									<option value="place" >What was your favourite place to visit as a child?</option>
									<option value="dreamjob" >What was your dream job as a child?</option>
									<option value="teachername" >What is your favourite teacher's nickname?</option>
                                        
                                </select>
							 </div>
							 <div>
								<span>Security answer<label>*</label></span>
								<input type="text" id="sans" name="securityanswer" pattern="^[a-zA-Z0-9]+( [a-zA-Z0-9]+)*$" style="width:524px;height:37px;" required>
							 </div>
					</div>
				
				<div class="clearfix"> </div>

				<div class="register-but">
				   
					   <input type="submit" value="Register" name="signup" class="a">
					   <div class="clearfix"> </div>
				   </form>
				</div>
		   </div>
		 </div>
	</div>
<!-- registration -->

			</div>
<!-- login -->
<?php

    if(isset($_POST['signup'])) {

		$firstname=$_POST['fname'];
		$lastname=$_POST['lname'];
		$name=$firstname." ".$lastname;
		$email=$_POST['email'];
		$password=$_POST['password'];
		$mobile=$_POST['mobile'];
		$confirmpassword=$_POST['confirmpassword'];
		$securityquestion=isset($_POST['securityquestion'])?$_POST['securityquestion']:'';
		$securityanswer=isset($_POST['securityanswer'])?$_POST['securityanswer']:'';
		$_SESSION['email']=$email;
		$_SESSION['name']=$name;
		$_SESSION['mobile']=$mobile;

		

		if($password==$confirmpassword) {
			$connn=new Dbcon();
		    $signup=new User();
			$signup->signup($connn,$name,$email,$mobile,$password,$securityquestion,$securityanswer);
			echo '<script>window.location="verification.php";</script>';
			

		} else {
			echo "<script>alert('password mis-match!!');</script>";
		}

		
		



	}

    require "footer.php";

?>

<script>

var count_mob=0;
var count_mob2=0;
var count_pass=0;
var count_cpass=0;
//var mobile_no='';
var c=0;
var v=0;
// var z=0;
// var y=0;


function validate() {
    
	
	if (Number.isInteger(parseInt($('#sans').val()))) {
		alert('Enter Security Answer in Correct Fornat');
		$('#sans').val("");
		return false;
	}
	else {
		return true;
	}

}

$('#email').bind("keypress keyup keydown", function (e){

var email = $('#email').val();
var regtwodots = /^(?!.*?\.\.).*?$/;
var lemail = email.length;
if ((email.indexOf(".") == 0) || !(regtwodots.test(email))) {
	alert("invalid email address");
	$('#email').val("");
	return;
}
});

$("#mobile").bind("keypress", function (e) {

	// count_mob2+=$("#mobile").length;

	// if(count_mob2==10) {
	// 	for(i=0;i<9;i++) {
	// 		var a=$("#mobile").val().substr(i,1);
	// 		var b=$("#mobile").val().substr(i+1,1);
	// 		if(a==b) {
	// 			$("#mobile").val("");
				
	// 			count_mob2=0;
	// 		}
	// 	 }
	// }

	// z+=$("#mobile").length;

	// if(z==10) {
	// 	for(i=0;i<10;i++) {
	// 		var g=$("#mobile").val().substr(i,1);
	// 		var h=$("#mobile").val().substr(i+1,1);
	// 		if(g==h) {
	// 			y++;
				
				
	// 		}
	// 		if(y==9) {
				
	// 			$("#mobile").val("");
	// 			z=0;
	// 			y=0;
				

	// 		}
	// 	}
	// }

	
	
	var keyCode = e.which ? e.which : e.keyCode
	if (!(keyCode >= 48 && keyCode <= 57)) {
		//console.log(keycode);
		return false;
	}
	
});



$('#mobile').on("cut copy paste drag drop",function(e) {
    e.preventDefault();
});

$("#mobile").bind("keyup", function (e) {

	// if(y!=9) {
	// 	//$("#mobile").val("");
		
	// 	z=0;
	// 	y=0;

	// }

	mobile_no=$("#mobile").val();
	count_mob+=$("#mobile").length;
	console.log(count_mob);

	var fchar=$("#mobile").val().substr(0, 1);
	var schar=$("#mobile").val().substr(1,1);

	if(fchar==0) {
		$('#mobile').attr('maxlength','11');
		$('#mobile').attr('minlength','11');
		if(count_mob==10) {
			for(i=1;i<11;i++) {
				var a=$("#mobile").val().substr(i,1);
				var b=$("#mobile").val().substr(i+1,1);
				if(a==b) {
					v++;
					
				}
				if(v==9) {
				$("#mobile").val("");
				count_mob=0;
				v=0;

			    }
			}
	    }
		if(schar==0)
		{
			$("#mobile").val(0);
			count_mob=0;
			
			if(fchar=="")
			{
				$("#mobile").val("");
				count_mob=0;
			}
			
		}
	} else {
		$('#mobile').attr('maxlength','10');
		$('#mobile').attr('minlength','10');
        //console.log(count_mob2);
		//console.log(count_mob);
		if(count_mob==10) {
		for(i=0;i<10;i++) {
			var a=$("#mobile").val().substr(i,1);
			var b=$("#mobile").val().substr(i+1,1);
			if(a==b) {
				v++;
				console.log(v);
				
				
			}
			if(v==9) {
				$("#mobile").val("");
				count_mob=0;
				v=0;

			}
		}
	}
	}
});

// $("#pass").bind("keypress", function (e) {

	
// var keyCode = e.which ? e.which : e.keyCode
// if (keyCode==32) {
// 	//console.log(keycode);
// 	return false;
// }

// count_pass+=$("#pass").length;

// if(count_pass>16) {
// 	return false;
// }





// });

// $("#cpass").bind("keypress", function (e) {

	
// var keyCode = e.which ? e.which : e.keyCode
// if (keyCode==32) {
// 	//console.log(keycode);
// 	return false;
// }

// count_cpass+=$("#pass").length;

// if(count_cpass>16) {
// 	return false;
// }





// });


// $("#sans").bind("keypress", function (e) {

    
	

	
// var keyCode = e.which ? e.which : e.keyCode
// if (!(keyCode>=48 && keyCode<=57) && !(keyCode>=65 && keyCode<=90) && !(keyCode>=97 && keyCode<=122)) {
// 	//console.log(keycode);
// 	return false;
// }


// });





</script>
</body>
</html>




<!-- pattern="[0][0-9]{10}" -->