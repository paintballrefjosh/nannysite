<?
include("config.php");
include("include/functions.php");

unset($data);

if(isset($_GET['child_id']))
{
	$child = mysql_fetch_array(mysql_query("SELECT * FROM nanny_child WHERE child_id = '".$_GET['child_id']."'"));

	$x = 0;

	foreach(array("monday","tuesday","wednesday","thursday","friday","saturday","sunday") as $day)
	{
		if($child[$day."_enable"])
		{
			$data[$x++] = array($x, " ".$day, generate_date("monday")." ".$child['start_time_'.$day], generate_date("monday")." ".$child['end_time_'.$day], $child['end_time_'.$day]);
		}
	}

	if($data)
		graph_schedule($data, $child['first_name']." ".$child['last_name'], false);
}
elseif(isset($_GET['day']))
{
	$x = 0;

	$result = mysql_query("SELECT * FROM nanny_child WHERE ".$_GET['day']."_enable = '1'");

	while($child = mysql_fetch_array($result))
	{
		$data[$x++] = array($x, $child['first_name']." ".$child['last_name'], generate_date($_GET['day'])." ".$child['start_time_'.$_GET['day']], generate_date($_GET['day'])." ".$child['end_time_'.$_GET['day']], $child['end_time_'.$_GET['day']]);

	}

	if($data)
		graph_schedule($data, $_GET['day'], true);
}

/*$data = array(
    array(0, " Bryce", "2009-08-28 11:00","2009-08-28 15:30","15:30"),
    array(1, " Kyla", "2009-08-28 08:00","2009-08-28 15:30"),
    array(2, " Nathan", "2009-08-28 08:00","2009-08-28 17:00")
);*/



?>
