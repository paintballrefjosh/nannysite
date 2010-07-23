<?
require_once("config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>The Little Explorers</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="css/default.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="images/favicon.ico" >

	<!-- Javascript Calendar -->
	<script src="js/jscal2.js"></script>
        <script src="js/jscal2_en.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jscal2.css" />
        <link rel="stylesheet" type="text/css" href="css/border-radius.css" />
        <link rel="stylesheet" type="text/css" href="css/steel.css" />
</head>

<body>

<div id="wrapper">
<img src="images/img10.gif" alt="" width="260" height="160" class="image1"/>
<img src="images/img9.gif" alt="" width="260" height="160" class="image2"/>

<div id="header">
	<h1>The Little Explorers</h1>
	<h2>An adventure around every corner</h2>

	<div id="menu">
		<ul>
			<li class="first"><a href="index.php" accesskey="1" title="" style="padding-right:15px;">Home</a></li>
			<li><a href="about.php" accesskey="2" title="" style="padding-right:15px; padding-left:15px;">About Us</a></li>
			<li><a href="schedule.php" accesskey="3" title="" style="padding-right:15px; padding-left:15px;">Schedule</a></li>
			<li><a href="account.php" accesskey="3" title="" style="padding-right:15px; padding-left:15px;">My Account</a></li>
			<li><a href="contact.php" style="padding-right:15px; padding-left:15px;">Contact Us</a></li>
		</ul>
	</div>
</div>

</div>

<div id="content">
        <div id="colOne">
<?
if(is_admin())
{
	if(isset($admin_sub_menu))
	{
		echo $admin_sub_menu."<br><br>";
	}
?>
		<h3>Administration</h3>
		<ul>
			<li class="first"><a href="family.php">Families</a></li>
			<li><a href="schedule.php">Schedule</a></li>
			<li><a href="financial.php">Financial</a></li>
			<li><a href="logout.php">Logout</a></li>
<?
if(is_super_admin())
{
?>
			<li><a href="users.php">Users</a></li>
<?
}
?>
		</ul>
<?
}
?>
<!--                <h3>Sip & Safari has:</h3>
                <ul>
                        <li class="first">A nursing area</li>
                        <li>A change table & potty</li>
                        <li>A kids menu</li>
                        <li>Healthy food choices</li>
                        <li>Caffeine-free choices</li>
                        <li>A fun atmosphere</li>
                        <li>A large play area</li>
                        <li>Seating within the play area</li>
                        <li>Cafe seating for parents</li>
                </ul>
-->        </div>
	<div id="colTwo">
