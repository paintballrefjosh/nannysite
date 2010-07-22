<?
include("../config.php");
include("functions.php");

unset($data);

if($_GET['child_id'] != 0)
{
	$sql = "SELECT * FROM nanny_schedule WHERE child_id = '".$_GET['child_id']."' AND";
}
elseif($_GET['family_id'] != 0)
{
	$sql = "SELECT * FROM nanny_schedule WHERE (";

       	$result = mysql_query("SELECT child_id FROM nanny_child WHERE family_id = '".$_GET['family_id']."'");
       	while($child = mysql_fetch_array($result))
       	{
		$sql .= "child_id = '".$child['child_id']."' OR ";
       	}

       	$sql = substr($sql, 0, -4);
       	$sql .= ") AND";

}
else
{
                // show all schedules on one graph
	$sql = "SELECT * FROM nanny_schedule WHERE";
}

if(!$_GET['time'])
{
	$_GET['time'] = time();
}

$year = date('Y',$_GET['time']);
$month = date('n',$_GET['time']);
$day = date('j',$_GET['time']);

$y = 0;
$result = mysql_query($sql . " start_time > '".mktime(0,0,0,$month,$day,$year)."' AND start_time < '".mktime(0,0,0,$month,$day+1,$year)."'");
while($schedule = mysql_fetch_array($result))
{
	$child = mysql_fetch_array(mysql_query("SELECT first_name FROM nanny_child WHERE child_id = '".$schedule['child_id']."'"));
	$data[] = array($y, $child['first_name'], date("Y-m-d H:i", $schedule['start_time']), date("Y-m-d H:i", $schedule['end_time']));
	$y++;
}

if($data)
{
	graph_schedule($data, date("l F jS", $_GET['time']), 1);
}
