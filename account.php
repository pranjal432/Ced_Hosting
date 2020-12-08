<?php

require "header.php";
require "User.php";
require "Config.php";

?>
		<!---login--->
			<div class="content">
				<!-- registration -->
	<div class="main-1">
		<div class="container">
			<div class="register">
		  	  <form method="POST"> 
				
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
						 <span>Mobile No. :</span>
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
								<input type="password" id="pass" minlength="8" name="password" required>
							 </div>
							 <div>
								<span>Confirm Password<label>*</label></span>
								<input type="password" id="cpass" name="confirmpassword" minlength="8" required>
							 </div>
							 <div>
								<span>Add a security question:</span>
								<input type="text" name="securityquestion" style="width:524px;height:37px;">
							 </div>
							 <div>
								<span>Security answer</span>
								<input type="text" id="sans" name="securityanswer" style="width:524px;height:37px;">
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

		if($password==$confirmpassword) {
			$connn=new Dbcon();
		    $signup=new User();
		    $signup->signup($connn,$name,$email,$mobile,$password,$securityquestion,$securityanswer);

		} else {
			echo "<script>alert('password mis-match!!');</script>";
		}

		
		



	}

    require "footer.php";

?>

<script>

var count_mob=0;
var count_pass=0;
var count_cpass=0;
//var mobile_no='';
var c=0;

$("#email").bind("keypress", function (e) {

	
    var keyCode = e.which ? e.which : e.keyCode
    if (!(keyCode==46) && !(keyCode >= 48 && keyCode <= 57) && !(keyCode >= 64 && keyCode <= 90) && !(keyCode >= 97 && keyCode <= 122)) {
        //console.log(keycode);
        return false;
    }

	
	
});

$("#mobile").bind("keypress", function (e) {

	
	var keyCode = e.which ? e.which : e.keyCode
	if (!(keyCode >= 48 && keyCode <= 57)) {
		//console.log(keycode);
		return false;
	}
	
});

$("#mobile").bind("keyup", function (e) {

	mobile_no=$("#mobile").val();

	var fchar=$("#mobile").val().substr(0, 1);
	var schar=$("#mobile").val().substr(1,1);
	var tchar=$("#mobile").val().substr(2, 1);
	var fochar=$("#mobile").val().substr(3, 1);
	var fifchar=$("#mobile").val().substr(4, 1);
	var sixchar=$("#mobile").val().substr(5, 1);
	var sevchar=$("#mobile").val().substr(6, 1);
	var eigchar=$("#mobile").val().substr(7, 1);
	var ninchar=$("#mobile").val().substr(8, 1);
	var tenchar=$("#mobile").val().substr(9, 1);

	if(fchar==schar && schar==tchar && tchar==fochar && fochar==fifchar && fifchar==sixchar && sixchar==sevchar && sevchar==eigchar && eigchar==ninchar && ninchar==tenchar) {
		$("#mobile").val("");
	}
	console.log(schar);

	

	if(fchar==0) {
		$('#mobile').attr('maxlength','11');
		$('#mobile').attr('minlength','11');
		if(schar==0)
		{
			$("#mobile").val(0);
			if(fchar=="")
		{
			$("#mobile").val("");
		}
			
		}
	} else {
		$('#mobile').attr('maxlength','10');
		$('#mobile').attr('minlength','10');
	}
});

$("#pass").bind("keypress", function (e) {

	
var keyCode = e.which ? e.which : e.keyCode
if (keyCode==32) {
	//console.log(keycode);
	return false;
}

count_pass+=$("#pass").length;

if(count_pass>16) {
	return false;
}





});

$("#cpass").bind("keypress", function (e) {

	
var keyCode = e.which ? e.which : e.keyCode
if (keyCode==32) {
	//console.log(keycode);
	return false;
}

count_cpass+=$("#pass").length;

if(count_cpass>16) {
	return false;
}





});


$("#sans").bind("keypress", function (e) {

	
var keyCode = e.which ? e.which : e.keyCode
if (keyCode==32) {
	//console.log(keycode);
	return false;
}


});





</script>
</body>
</html>




<!-- pattern="[0][0-9]{10}" -->