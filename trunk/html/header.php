<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>The Scarbrough's Site</title>	
	<!-- Styles -->
	<link href="css/main.css" rel="stylesheet" type="text/css" />
	<link href="css/menu_dropdown.css" rel="stylesheet" type="text/css" />
	<link href="css/homepage.css" rel="stylesheet" type="text/css" />

	<script src="js/menu.js"></script>
	<script src="js/menu1.js"></script>
	<script src="js/menu2.js"></script>
	<script src="js/jscal2.js"></script>
        <script src="js/jscal2_en.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jscal2.css" />
        <link rel="stylesheet" type="text/css" href="css/border-radius.css" />
        <link rel="stylesheet" type="text/css" href="css/steel.css" />
</head>

<body>
<div id="bg_top"></div>
<div id="wrapper">

<ol id="mainNav">

<?
if(isset($_SESSION['user_id']))
{
?>

	<li>
		<a href="index.php">Home</a> 
	</li>

	<li>
		<a href="family.php">Nanny Site</a> 
		<ol>
			<li><a href="family.php">Families</a></li>
			<li><a href="schedule.php">Schedule</a></li>
			<li class="lastChild"><a href="financial.php">Financial</a></li>
		</ol> 
	</li>

	<li>
		<a href="budget.php">Budget</a>
		<ol>
			<li class="lastChild"><a href="budget.php">Current Budget</a></li>
		</ol>
	</li>

	<li>
		<a href="calendar.php">Calendar</a>
		<ol>
			<li class="lastChild"><a href="calendar.php">View Calendar</a></li>
		</ol>
	</li>		

	<li>
		<a href="admin.php">Administration</a>
		<ol>
			<li class="lastChild"><a href="admin.php">User Admin</a></li>
		</ol>
	</li>	

	<li>
		<a href="logout.php">Logout</a>

	</li>	
<?
}
else
{
?>
	<li>
		<a href="login.php">Login</a>

	</li>	
<?
}
?>

</ol>

<!-- end header -->

<!--<div id="homePCI"></div>-->
	
<!-- Content -->
<div id="content" class="cover">
<div id="colLeft" style="padding-top:11px;">

		
		
