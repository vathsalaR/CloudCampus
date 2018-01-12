<?php
session_start(); // Starting Session // Variable To Store Error Message
error_reporting(E_ERROR);
include_once('connect-db.php');
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter

// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($mysqli,$username);
$password = mysqli_real_escape_string($mysqli,$password);
// Selecting Database
$db = mysqli_select_db($mysqli,"cloudcampus");
// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($mysqli,"select * from login where Password='$password' AND Username='$username'");
$rows = mysqli_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: homepage.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($mysqli); // Closing Connection
}
}
?>
<?php

if(isset($_SESSION['login_user'])){
header("location: homepage.php");
}
?>
<?php
	require('connect-db.php');
    // If the values are posted, insert them into the database.
	if (isset($_POST['register-submit'])){
    if (isset($_POST['username']) && isset($_POST['password'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
		$email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $query = "INSERT INTO login(Name, Username, Password, Email, Role) VALUES ('$name','$username', '$password', '$email', '$role')";
        $result = mysqli_query($mysqli, $query);
        echo '<script language="javascript">';
        echo 'alert($result)';
        echo '</script>';
        if($result){
            $smsg = "User Created Successfully.";
            $user = $mysqli->query("select * from login where Email='$email'");
            $user_row = $user->fetch_object();
            $query = "INSERT INTO notifications(UserId) VALUES ('$user_row->Id' )";
            $result = mysqli_query($mysqli, $query);
        }else{
            $fmsg = "Username or Email Id already taken. User Registration Failed";
        }
    }
	}
?>

<html>
<head>
<title>Cloud Campus</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script type="text/javascript">

 $(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});
	
	function validateloginform(){  
	var name=document.myform.username.value;  
	var password=document.myform.password.value;  
	if(password.length<5){  
	alert("Password must be at least 5 characters long!");  
	return false;  
		}  
	}

	function validatesignupform(){  
	var name=document.signupform.username.value; 
	var email=document.signupform.email.value;  
	var firstpassword=document.signupform.password.value; 
	var secondpassword=document.signupform.confirm-password.value;  

	if(firstpassword.length<5){
	alert("Password must be at least 5 characters long!");  
	return false;
	}	
	}
  </script>
  
</head>
<body id="hello">
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
					
					<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
					<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
					<?php if(isset($error)){ ?><div class="alert alert-danger" role="alert"> <?php echo $error; ?> </div><?php } ?>
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">LOGIN</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">SIGN UP</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form name="myform" id="login-form" role="form" action="login.php" method="post" onsubmit="return validateloginform()" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>

								</form>
								<form name="signupform" id="register-form" role="form" action="login.php" method="post" onsubmit="return validatesignupform()" style="display: none;">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Enter Your Name" value="" required>
                                    </div>
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required>
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
                                    <div class="form-group"  class="form-control" required>
                                        <select class="form-control" name="role" id="role">
                                            <option>Student</option>
                                            <option>Professor</option>
                                        </select>
                                    </div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Sign Up">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

