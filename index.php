<?php
	session_start();
	$error = ''; //IF LOGIN.PHP RETRUNS A LOGIN ERROR, THIS IT WILL DISPLAY AN MESSAGE
	if (isset($_POST['submit1'])) {
		include("login.php");
	}

?>


<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Home - Property Shark</title>
	<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" >
	<link href="css/stylesheet.css" type="text/css" rel="stylesheet">
	<link rel="shortcut icon" href="logo_icon.png">
</head>

<body>
	<div class="navbar-default">
		<div class="container">
			<div class="navbar-header nabar-left">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bar-links"> <span class="sr-only">Toggle navigation</span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" href="">
					<img src="logo.png" width="140" style="margin-top:-10px">
				</a> 
			</div>

			<div class="collapse navbar-collapse" id="nav-bar-links">
				<?php
					if(isset($_SESSION['login_MEMBERID'])){
						print '
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Welcome! Signed in as '.$_SESSION['login_FIRSTNAME'].' '.$_SESSION['login_LASTNAME'].'<span class="caret"></span> </a>
									<ul class="dropdown-menu" role="menu">
						';

						if ($_SESSION['login_USERTYPE'] == 'owner')
							print'
										<li><a href="users/ownerpost">Your Postings</a></li>
										<li><a href="users/ownerpost/newpost">Post an Ad</a></li>
										<li><a href="users/ownersearch">Search Tenant</a></li>
										<li><a href="users/owneraccount">Account Settings</a></li>
										<li class="divider"></li>
							';
						if ($_SESSION['login_USERTYPE'] == 'tenant')
							print'
										<li><a href="users/tenantprofile">Tenant Profile</a></li>
										<li><a href="users/tenantsearch">Search Listings</a></li>
										<li class="divider"></li>
							';

						print '
										<li><a href="logout.php">Sign Out</a></li>
									</ul>
								</li>
							</ul>
						';
					}
					else {

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
								<li><a href="registration/">Register</a></li>
							</ul>
						';
					}
				?>
			</div>
		</div>
	</div>
	<div class="jumbotron">
		<div class="container">
			<div class="transbox">
				<h1><?php if(isset($_SESSION['login_MEMBERID'])) print 'Welcome '.$_SESSION['login_FIRSTNAME'].". ";?>Spring Into Savings in Atlanta!</</h1>
				<p >GREAT HOUSES. GREAT DEALS.Rethink What Luxury Means!</p>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-6">
				<h3>Hola!</h3>
				<p style="opacity:">Locate the ideal residence for you and your family. Meet property owners who are looking for you or who are looking for you. With millions of customers using our service, we at Property Shark are doing everything we can to make everyone happy.</p>
			</div>
			<div class="col-md-4 col-sm-6">
				<?php
				if(isset($_SESSION['login_MEMBERID'])){
					print '
						<h3>Get Started!</h3>
						<ul style="list-style-type:square">
					';

					if ($_SESSION['login_USERTYPE'] == 'owner')
						print'
							<li><a href="users/ownerpost">Your Postings</a></li>
							<li><a href="users/ownerpost/newpost">Post an Ad</a></li>
							<li><a href="users/ownersearch">Search Tenant</a></li>
							<li><a href="users/owneraccount">Account Settings</a></li>
						';
					if ($_SESSION['login_USERTYPE'] == 'tenant')
						print'
							<li><a href="users/tenantprofile">Click here to update your profile!</a></li>
							<li><a href="users/tenantsearch">Or start searching listings.</a></li>
						';

					print '
						</ul>
					';
				}
				else{
					print '
					<h3>Work with the best suite of property management tools on the market.</h3>
					<p>Connect with more than 75 million renters looking for new homes using our comprehensive marketing platform.Accept applications, process rent payments online, and sign digital leases all powered on a single platform.</p>
					';
				}
				?>
			</div>
			<div class="col-md-4 col-sm-12" >
				<h3>Our site is for both Owners and Tenants!</</h3>
				
					
					<p>Rental properties are advertised by owners, who then wait for inquiries from potential renters. Or look for a tenant who is looking for a place to live.</p>
					
					<dd>Tenants only need to quickly create a profile, then wait for a property owner to discover them. Alternately, look for houses that suit your preferences</dd>
				
			</div>
		</div>
		<hr>
	</div>

		<script src="script/validateform.js"></script>
		<script src="script/jquery-1.11.2.min.js"></script>
		<script src="script/bootstrap.min.js"></script>
	</body>
	</html>
