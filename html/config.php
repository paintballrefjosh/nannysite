<?

// provide some global variables
static $dbhost = "localhost";
static $dbuser = "scarbrough";
static $dbpass = "jscarbrough";
static $dbname = "scarbrough";

// setup db connection
$db = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname);

// start session for user authentication
session_start();

// check to see if user has been authenticated
if(!isset($_SESSION['user_id']) && !eregi("login.php", $_SERVER['PHP_SELF']))
{
	header("Location: login.php");
}

?>
