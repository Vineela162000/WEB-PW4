﻿<?php
	$error = '';
	$duplicateUSERNAME = false;
	session_start();
	//IF USER IS ALREADY SIGNED IN GOES TO HOME PAGE
	if (isset($_SESSION['login_MEMBERID']))
		header("location: ../");
	//NAVBAR LOGIN
	if (isset($_POST['submit1'])) {
		include("../login.php");
		//IF LOGING IS SUCCESS GOES TO HOMEPAGE
		if (isset($_SESSION['login_MEMBERID']))
			header("location: ../");
	}
	
	$FIRST_NAME = '';
	$LAST_NAME = '';
	$USERTYPE = '';
	$PHONE_NUMBER = '';
	$EMAIL = '';
	$USERNAME = '';
	
	//REGISTRATION FORM
	if(isset($_POST['submit2'])){
		include("../db_configlogin.php");

		if (mysqli_connect_errno()) {
			print "Connect failed:". mysqli_connect_error();
			exit();
		}
		
		$FIRST_NAME = trim(htmlspecialchars($_POST['FIRST_NAME']));
		$LAST_NAME = trim(htmlspecialchars($_POST['LAST_NAME']));
		$USERTYPE = htmlspecialchars($_POST['USERTYPE']);
		$PHONE_NUMBER = htmlspecialchars($_POST['PHONE_NUMBER']);
		$EMAIL = htmlspecialchars(trim($_POST['EMAIL']));
		$USERNAME = htmlspecialchars($_POST['USERNAME']);
		$PASSWORD = htmlspecialchars($_POST['PASSWORD']);
		
		$SQL = "SELECT * FROM user WHERE uname = '$USERNAME'";
		$result = mysqli_query($conn, $SQL);
		
		$num_rows = mysqli_num_rows($result);
		//IF USERNAME IS NOT UNIQUE, RETURNS TO FORM FOR NEW USERNAME OR LOGS THE USER IN IF SUCCESFUL REGISTRATION
		if($num_rows > 0){
			$duplicateUSERNAME = true;
		}
		else {
			$SQL = "INSERT INTO user (fname, lname, usertype, phonenum, email, uname, pword) VALUES ('$FIRST_NAME','$LAST_NAME','$USERTYPE','$PHONE_NUMBER','$EMAIL','$USERNAME', md5('$PASSWORD'))";
			mysqli_query($conn, $SQL);
			
			$result = mysqli_query($conn, "SELECT * FROM user WHERE BINARY uname = '$USERNAME'");
			$row = mysqli_fetch_assoc($result);

			$_SESSION['login_MEMBERID'] = $row['MemberID'];
			$_SESSION['login_FIRSTNAME'] = $row['fname'];
			$_SESSION['login_LASTNAME'] = $row['lname'];
			$_SESSION['login_USERTYPE'] = $row['usertype'];
			
			header("location: ../");
			
		}
		mysqli_close($conn);
	}	
	

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Register - Property Shark</title>
	<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet" >
	<link href="../css/stylesheet.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="registration.css">
	<link rel="shortcut icon" href="../logo_icon.ico">
</head>

<body>
	<div class="navbar-default">
		<div class="container">
			<div class="navbar-header nabar-left">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bar-links"> <span class="sr-only">Toggle navigation</span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" href="../">
					<img src="../logo.png" width="140" style="margin-top:-10px">
				</a> 
			</div>

			<div class="collapse navbar-collapse" id="nav-bar-links">
				<?php
					print '
						<form class="navbar-form navbar-right" style="border: none" onSubmit="return Validate()" method="post" action="">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="User Name" name="username" maxlength="20">
								<input type="password" class="form-control" placeholder="Password" name="password" maxlength="20">
								<input type="submit" class="btn btn-default" value="Sign In" name="submit1">
							</div>
						</form>
					';
					if ($error != '') print '<div class="navbar-text navbar-right" style="color: #FF5858"><small>'.$error.'</small></div>';
					print '
						<ul class="nav navbar-nav navbar-right">
							<li><a href="">Register</a></li>
						</ul>
					';
				?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="well">
				<div class="row">
					<div class="col-md-8">
						<h3>Register Here</h3>
						<form class="form-horizontal" method="post" onSubmit="return validateRegistration()" action="https://codd.cs.gsu.edu/~nkalaga1/WP/PW/4/index.php">
	                    	<div name="form-validate" class="form-group">
	                        	<label for="FIRST_NAME" class="col-md-3 control-label">First Name:</label>
	                            <div class="col-md-9">
	                            	<input type="text" class="form-control" id="FIRST_NAME" name="FIRST_NAME" placeholder="Ex. John-Young" maxlength="20" value="<?php print $FIRST_NAME;?>">
	                            </div>
	                        </div>
	                        <div name="form-validate" class="form-group">
	                        	<label for="LAST_NAME" class="col-md-3 control-label">Last Name:</label>
	                            <div class="col-md-9">
	                            	<input type="text" class="form-control" id="LAST_NAME" name="LAST_NAME" placeholder="Ex. Smith-Leblanc" maxlength="20" value="<?php print $LAST_NAME;?>">
	                            </div>
	                        </div>
	                      <div name="form-validate" class="form-group">
	                        	<label for="USER_TYPE" class="col-md-3 control-label">Registration Type</label>
	                                  <div id="USER_TYPE" class="col-md-9">
	                                      <label class="radio-inline">
	                                        <input type="radio" name="USERTYPE" id="TENANT" value="tenant" <?php if($USERTYPE == 'tenant') print 'checked';?> >Tenant
	                                      </label>
	                                      <label class="radio-inline">
	                                        <input type="radio" name="USERTYPE" id="OWNER" value="owner" <?php if($USERTYPE == 'owner') print 'checked';?>>Owner
	                                      </label>
	                                </div>
	                        </div>
	                        <div name="form-validate" class="form-group">
	                        	<label for="PHONE_NUMBER" class="col-md-3 control-label">Mobile:</label>
	                            <div class="col-md-9">
	                            	<input type="text" class="form-control" id="PHONE_NUMBER" name="PHONE_NUMBER" placeholder="Ex. (514)555-5555" value="<?php print $PHONE_NUMBER;?>">
	                            </div>
	                        </div>
	                        <div name="form-validate" class="form-group">
	                        	<label for="EMAIL" class="col-md-3 control-label">Email:</label>
	                            <div class="col-md-9">
	                            	<input type="email" class="form-control" id="EMAIL" name="EMAIL" placeholder="Ex. john-smith@example.com" maxlength="40" value="<?php print $EMAIL;?>">
	                            </div>
	                        </div>
	                        <div name="form-validate" class="form-group">
	                        	<label for="USERNAME" class="col-md-3 control-label">Username:</label>
	                            <div class="col-md-9">
	                            	<input type="text" class="form-control" id="USERNAME" name="USERNAME" placeholder="At least 6 characters with letters or digits." maxlength="20">
	                            	<?php if($duplicateUSERNAME) print'<span style="color:#F94747" id="DUPLICATEUSER" class="help-block">Sorry this username has already been taken.</span>' ?>
	                            </div>
	                        </div>
	                        <div name="form-validate" class="form-group">
	                        	<label for="PASSWORD" class="col-md-3 control-label">Password:</label>
	                            <div class="col-md-9">
	                            	<input type="password" class="form-control" id="PASSWORD" name="PASSWORD" placeholder="At least 6 characters, with capital letters & digits." maxlength="20">
	                            </div>
	                        </div>
	                        <div name="form-validate" class="form-group">
	                        	<label for="CONFIRM_PASS" class="col-md-3 control-label">Confirm:</label>
	                            <div class="col-md-9">
	                            	<input type="password" class="form-control" id="CONFIRM_PASS" name="CONFIRM_PASS" placeholder="Confirm Password" maxlength="20">
	                            </div>
	                        </div>
	                        <div class="form-group">
	                        	<div class="col-md-offset-3 col-md-9">
	                            	<button type="submit" class="btn btn-primary" name="submit2">Register to Login</button>
	                            </div>
	                        </div>
	                    </form>
					</div>
					<div class="col-md-4">
						<h3>Registration Rules <span class="glyphicon glyphicon-asterisk"></span></h3>
						<ol>
						<li>Names can only use characters and hyphens. No other symbols are allowed.</li>
                            <li>You will only have to choose either of Tenant or Owner.</li>
                            <li>Your mobile number has to be in the exact format: (123)456-7890</li>
                            <li>Username should have minimum 6 characters. No special characters are allowed.</li>
                            <li>Password must contain at least one number, an uppercase and a lowercase letter.</li>
                            </ol>
					</div>
				</div>
				<hr>
			
		</div>
	</div>
	<script src="registration.js"></script>
	<script src="../script/validateform.js"></script>
	<script src="../script/jquery-1.11.2.min.js"></script>
	<script src="../script/bootstrap.min.js"></script>
</body>
</html>
