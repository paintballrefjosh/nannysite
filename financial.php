<?
include("config.php");
include("header.php");

$year = date('Y');
$month = date('n');
$day = date('j');

$num_days = date("t",mktime(0,0,0,$month,1,$year));
$start_day = date("w", mktime(0,0,0,$month,1,$year));
$num_weeks = ceil(($num_days + $start_day) / 7);

for($x = 1; $x <= 7 * $num_weeks; $x++)
{
	if($x - $start_day > $num_days || $x - $start_day < 1)
		$data[$x] = null;
	else
		$data[$x] = $x - $start_day;
}

?> 

<div align="center">
<table width="100%" border="1" cellpadding="2" cellspacing="2">
	<tr>
		<th colspan='7'><?= date('M', mktime(0,0,0,$month,1,$year)).' '.$year; ?></th>
	</tr>
	<tr>
		<th>Sun</th>
		<th>Mon</th>
		<th>Tue</th>
		<th>Wed</th>
		<th>Thur</th>
		<th>Fri</th>
		<th>Sat</th>
	</tr>

<?

for($x = 1; $x <= 7 * $num_weeks; $x++)
{
	echo "<td height=\"40\" align=\"left\" valign=\"top\">".$data[$x]."</td>\n";
	
	if($x % 7 == 0)
	{
		echo "</tr><tr>";
	}
}

?>

</tr></table>
</div>

<!--  Rt Column -->
</div><div id="rtColumn" class="cover">
	<h5>Actions</h5>
	<ul>
		<li><a href="financial.php?op=family">View by Family</a></li>
		<li><a href="financial.php?op=calendar">View by Calendar</a></li>
	</ul>
</div>

<?
include("footer.php");
?>
