
<?php
	//DATABASE LOGIN INFORMATION
	$conn = mysqli_connect("localhost", "root", "password", "rentalmtl");
	
	$sql = "CREATE TABLE IF NOT EXISTS `mtlborough` (
  `BoroughID` smallint(6) NOT NULL,
  `bname` tinytext NOT NULL,
  `longitude` tinyint(3) unsigned NOT NULL,
  `latitude` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`BoroughID`))";
  if ($conn->query($sql) === TRUE) {
      }


  $sql = "CREATE TABLE IF NOT EXISTS `ownersearch` (
  `MemberID` smallint(5) unsigned NOT NULL,
  `agemin` tinyint(3) unsigned NOT NULL,
  `agemax` tinyint(3) unsigned NOT NULL,
  `occupation` tinyint(3) NOT NULL,
  `income` tinyint(3) NOT NULL,
  `pet` varchar(3) NOT NULL,
  `smoke` varchar(3) NOT NULL,
  PRIMARY KEY (`MemberID`))";
  if ($conn->query($sql) === TRUE) {
      }


  $sql = "CREATE TABLE IF NOT EXISTS `rentalspace` (
  `MemberID` smallint(5) unsigned NOT NULL,
  `PostID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `borough` tinyint(3) unsigned NOT NULL,
  `address` varchar(40) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`PostID`))";
  if ($conn->query($sql) === TRUE) {
      }

  $sql = "CREATE TABLE IF NOT EXISTS `tenantprofiles` (
  `MemberID` smallint(5) unsigned NOT NULL,
  `age` tinyint(4) NOT NULL,
  `occupation` tinyint(4) NOT NULL,
  `income` tinyint(4) NOT NULL,
  `pet` varchar(3) NOT NULL,
  `smoker` varchar(3) NOT NULL,
  PRIMARY KEY (`MemberID`))";
  if ($conn->query($sql) === TRUE) {
      }




   $sql = "CREATE TABLE IF NOT EXISTS `tenantsearch` (
  `MemberID` smallint(5) unsigned NOT NULL,
  `borough` tinyint(4) NOT NULL,
  `price` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`MemberID`))";
      if ($conn->query($sql) === TRUE) {
      }


    $sql = "CREATE TABLE IF NOT EXISTS `user` (
  `MemberID` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) NOT NULL,
  `pword` varchar(32) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `email` tinytext NOT NULL,
  `phonenum` varchar(15) NOT NULL,
  PRIMARY KEY (`MemberID`))";
      if ($conn->query($sql) === TRUE) {
      }

	//include("../db_configlogin.php");

?>

