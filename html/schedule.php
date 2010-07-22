<?

include("config.php");
include("include/functions.php");

if($_GET['op'] == "edit")
{

	if(isset($_POST['submit']))
        {
                $schedule_date = explode("-", $_POST['schedule_date']);

                mysql_query("INSERT INTO nanny_schedule SET 
                        child_id	= '".$_GET['child_id']."',
                        start_time	= '".mktime($_POST['start_time_hour'],$_POST['start_time_minute'],0,$schedule_date[1],$schedule_date[2],$schedule_date[0])."',
                        end_time	= '".mktime($_POST['end_time_hour'],$_POST['end_time_minute'],0,$schedule_date[1],$schedule_date[2],$schedule_date[0])."',
                        fee		= '".$_POST['fee']."'",$db);

                header("Location: child.php?op=view&family_id=".$_GET['family_id']."&child_id=".$_GET['child_id']);
        }

        include("header.php");

	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));

?>
        <form method="post" name="child_form">
        <h1>Edit Child Schedule</h1><div class="ruleHorizontal"></div><p>

        <div class="formquestion"><label>Family</label></div>
        <div class="formanswer">
                <select name="family_id" alt="Family" disabled="disabled">
                        <option value="<?= $_GET['family_id'];?>" selected="selected">The <?= $family['family_name'];?> Family</option>
                </select>
        </div>

        <div class="formquestion"><label>Schedule Date</label></div>
        <div class="formanswer">
                <input id="schedule_date" name="schedule_date" value="<?= date("Y-m-d");?>" />
                [<a href="javascript:void(0);" id="schedule_date_btn">Select Date</a>]
                <!--<button id="f_clearRangeStart" onclick="clearRangeStart()">clear</button>-->
                <script type="text/javascript">
                        var cal = Calendar.setup({onSelect: function(cal) { cal.hide() }});
                        cal.manageFields("schedule_date_btn", "schedule_date", "%Y-%m-%d");
                </script>

        </div>
        <br clear="all" />

        <div class="formquestion"><label>Start Time</label></div>
        <div class="formanswer">
        	<select name="start_time_hour">
<?
		for($x=0;$x<24;$x++)
		{
?>
			<option value="<?= $x;?>"><?= sprintf("%02s", $x);?></option>
<?
		}
?>
		</select> : 
		<select name="start_time_minute">
			<option value="0">00</option>
			<option value="15">15</option>
			<option value="30">30</option>
			<option value="45">45</option>
		</select>
	</div>
        <br clear="all" />

        <div class="formquestion"><label>End Time</label></div>
        <div class="formanswer">
	        <select name="end_time_hour">
<?
                for($x=0;$x<24;$x++)
                {
?>
                        <option value="<?= $x;?>"><?= sprintf("%02s", $x);?></option>
<?
                }
?>
                </select> : 
                <select name="end_time_minute">
                        <option value="0">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                </select>

	</div>
        <br clear="all" />

        <div class="formquestion"><label>Additional Fee</label></div>
        <div class="formanswer">
                <input type="text" name="fee" alt="Additional Fee" maxlength="5" />
        </div>
        <br clear="all" />

        <div align="right">
                <input id="button" type="submit" name="submit" value="Submit" />
        </div>


        <h1>Existing Schedule</h1><div class="ruleHorizontal"></div><p>
	<ul>
<?
	$result = mysql_query("SELECT * FROM nanny_schedule WHERE child_id = '".$_GET['child_id']."' AND start_time > '".(time() - 24*60*60*7)."'");
	while($schedule = mysql_fetch_array($result))
	{
?>
		<li><?= date("l F jS -- H:i - " ,$schedule['start_time']) . date("H:i", $schedule['end_time']);?> [<a href="schedule.php?op=delete&amp;child_id=<?= $_GET['child_id'];?>&amp;family_id=<?= $_GET['family_id'];?>&amp;start_time=<?= $schedule['start_time'];?>&amp;end_time=<?= $schedule['end_time'];?>">Delete</a>]</li>
<?
	}
?>
        <!--  Rt Column -->
        </div><div id="rtColumn" class="cover">
                <h5>Actions</h5>
                <ul>
                        <li><a href="child.php?op=view&amp;child_id=<?= $_GET['child_id'];?>&amp;family_id=<?= $_GET['family_id'];?>">Back to Child</a></li>
                </ul>
        </div>

        </form>
<?

}
elseif($_GET['op'] == "delete")
{
	mysql_query("DELETE FROM nanny_schedule WHERE child_id = '".$_GET['child_id']."' AND start_time = '".$_GET['start_time']."' AND end_time = '".$_GET['end_time']."'");
	header("Location: schedule.php?op=edit&family_id=".$_GET['family_id']."&child_id=".$_GET['child_id']);
}
else
{

//view
include("config.php");
include("header.php");

//draw_calendar();

$child = mysql_fetch_array(mysql_query("SELECT * FROM nanny_child WHERE child_id = '".$_GET['child_id']."'"));
$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));



?>
<form method="post" name="child_form">
<h1>Weekly Schedule</h1><div class="ruleHorizontal"></div><p>

<?
for($x = -7; $x < 7; $x++)
{
	$time = ($x * 60 * 60 * 24) + time();
?>
	<img src="graph_schedule.php?time=<?= $time;?>">
<?

}

?>

<!--  Rt Column -->
</div><div id="rtColumn" class="cover">
	<h5>Actions</h5>
	<ul>
		<li><a href="family.php">View Families</a></li>
		<li><a href="financial.php">View Payments</li>
	</ul>
</div>

</form>
<?

}

include("footer.php");
?>
