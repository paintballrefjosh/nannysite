<?

include("config.php");

if(isset($_POST['submit']))
{
	// build the sql statement to verify login credentials
	$sql = "SELECT * FROM user WHERE 
		email_address = '".$_POST['email_address']."' 
		AND password = '".$_POST['password']."'";

	// execute the sql
	$user = mysql_fetch_array(mysql_query($sql));

	// test the results from mysql
	if($user['user_id'])
	{
		// "log the user in"
		$_SESSION['user_id'] = $user['user_id'];

		// redirect the user to where they tried to go originally
		if(isset($_SESSION['redirect']))
		{
			// set a tmp variable
			$redirect = $_SESSION['redirect'];

			// unset $_SESSION['redirect'] to prevent an infinite loop
			unset($_SESSION['redirect']);

			// execute the redirect
			header("Location: ".$_SESSION['redirect']);
		}
	}
}

// user is already logged in
if(isset($_SESSION['user_id']))
{
	header("Location: index.php");
}

include("header.php");

?>

	<h1>Please Login</h1>
	<div class="ruleHorizontal"></div><p>

	<form method="post">

	<div class="formquestion"><label>Email Address</label></div>
	<div class="formanswer">
		<input type="text" name="email_address" alt="Email Address" maxlength="50" />
	</div><br clear="all" />	
	
	<div class="formquestion"><label>Password</label></div>
	<div class="formanswer">
		<input type="password" name="password" alt="Password" maxlength="50" />
	</div><br clear="all" />

	<div align="right">
		<input id="button" type="reset" name="reset" value="Reset"> 
		<input id="button" type="submit" name="submit" value="Login">
	</div>

	</form>

	<!--  Rt Column -->
	</div><div id="rtColumn" class="cover">
		<h5>Contact</h5>
		<ul>
			<li><a href="javascript:this.parent_form.submit();">Save Changes</a></li>
			<li><a href="family.php?op=add">Cancel</a></li>
		</ul>
	</div>
<?

include("footer.php");

?>
