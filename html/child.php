<?

include("config.php");
include("include/functions.php");

if($_GET['op'] == 'edit')
{
	if(isset($_POST['submit']))
	{
		$sql = "UPDATE nanny_child SET 
			family_id		= '".$_GET['family_id']."',
			first_name 		= '".$_POST['first_name']."',
			last_name 		= '".$_POST['last_name']."',
			pickup_address		= '".$_POST['pickup_address']."',
			dropoff_address 	= '".$_POST['dropoff_address']."',
			pickup_address		= '".$_POST['pickup_address']."'
			WHERE child_id 		= '".$_GET['child_id']."'";

		mysql_query($sql, $db);

		header("Location: child.php?op=view&family_id=".$_GET['family_id']."&child_id=".$_GET['child_id']);
	}

	include("header.php");
	$child = mysql_fetch_array(mysql_query("SELECT * FROM nanny_child WHERE child_id = '".$_GET['child_id']."'"));
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="child_form">
	<h1>Child Info</h1><div class="ruleHorizontal"></div><p>

	<div class="formquestion"><label>Family</label></div>
	<div class="formanswer">
		<select name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $child['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	<br clear="all" />
	
	<div class="formquestion"><label>First Name</label></div>
	<div class="formanswer">
		<input type="text" name="first_name" alt="First Name" maxlength="50" value="<?= $child['first_name'];?>" />
	</div>
	<br clear="all" />

	<div class="formquestion"><label>Last Name</label></div>
	<div class="formanswer">
		<input type="text" name="last_name" alt="First Name" maxlength="50" value="<?= $child['last_name'];?>" />
	</div>
	<br clear="all" />
	
	<div class="formquestion"><label>Drop Off Address</label></div>
	<div class="formanswer">
		<input type="text" name="dropoff_address" alt="Drop Off Address" maxlength="50" value="<?= $child['dropoff_address'];?>" />
	</div>
	<br clear="all" />		

	<div class="formquestion"><label>Pick Up Address</label></div>
	<div class="formanswer">
		<input type="text" name="pickup_address" alt="Pick Up Address" maxlength="50" value="<?= $child['pickup_address'];?>" />
	</div>
	<br clear="all" />	

	<br />
	<div align="right">
		<input id="button" type="button" name="cancel" value="Cancel" onclick="window.location.href='child.php?op=view&family_id=<?= $_GET['family_id'];?>&child_id=<?= $_GET['child_id'];?>'"> 
		<input id="button" type="submit" name="submit" value="Save">
	</div>

        <h1>Schedule</h1><div class="ruleHorizontal"></div><p>
	<script type="text/javascript" language="JavaScript1.2">var dmWorkPath='js/';</script>
	<script type="text/javascript" src="menu/dmenu.js"></script>

<?
	if(!$_GET['time'])
	{
		$_GET['time'] = time();
	}

	$year = date('Y',$_GET['time']);
	$month = date('n',$_GET['time']);
	$day = date('j',$_GET['time']);

	$num_days = date("t",$_GET['time']);
	$start_day = date("w",mktime(0,0,0,$month,1,$year));
	$num_weeks = ceil(($num_days + $start_day) / 7);

	for($x = 1; $x <= 7 * $num_weeks; $x++)
	{
		if($x - $start_day > $num_days || $x - $start_day < 1)
			$data[$x] = null;
		else
			$data[$x] = $x - $start_day;
	}

	$prev_time = $_GET['time'] - ($day * 24 * 60 * 60) - (15 * 24 * 60 * 60);
	$next_time = $_GET['time'] + (($num_days - $day) * 24 * 60 * 60) + (15 * 24 * 60 * 60);
	
	?> 
	
	<table width="100%" border="1" style="border-collapse: collapse;" cellpadding="2" cellspacing="2">
		<tr>
			<th><a href="?op=edit&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>&amp;time=<?= $prev_time;?>"><<</a></th>
			<th colspan="5"><?= date('M', mktime(0,0,0,$month,1,$year)).' '.$year; ?></th>
			<th><a href="?op=edit&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>&amp;time=<?= $next_time;?>">>></a></th>
		</tr>
		<tr>
			<th width="15%">Sun</th>
			<th width="14%">Mon</th>
			<th width="14%">Tue</th>
			<th width="14%">Wed</th>
			<th width="14%">Thur</th>
			<th width="14%">Fri</th>
			<th>Sat</th>
		</tr>
	
	<?
	
	for($x = 1; $x <= 7 * $num_weeks; $x++)
	{
		$today = null;
		$isdata = false;
		$cal_day = $data[$x];

		if($data[$x] == $day && $_GET['time'] == time())
			$today = "bgcolor=\"lightgreen\"";

		$result = mysql_query("SELECT * FROM nanny_payment WHERE payment_date = '".mktime(0,0,0,$month,$data[$x],$year)."'");
		while($payment = mysql_fetch_array($result))
		{
			$isdata = true;
			// bold the number in the upper left
			// $data[$x] = "<div id=cd_".$data[$x]." class=calendar_date>".$data[$x]."</div><div id=calendar_add>[Add]</div>";
			$data[$x] = "<div id=calendar_date>".$cal_day."</div><div id=cd_".$cal_day." class=calendar_add>[Add]</div>";

			$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$payment['family_id']."'"));
			$data[$x] .= "<div style='float: top;font-size: 9px;'>".$family['family_name']."($".round($payment['amount']).")</div>";
		}

		if(!$isdata && $data[$x])
		{
			$data[$x] = "<div id=calendar_date>".$data[$x]."</div><div id=cd_".$cal_day." class=calendar_add>[Add]</div>";
		}
?>
		<td height="70" align="left" valign="top" onmouseover="document.getElementById('cd_<?= $cal_day;?>').style.visibility='visible';" onmouseout="document.getElementById('cd_<?= $cal_day;?>').style.visibility='hidden';" <?= $today;?>><?= $data[$x];?></td>
<?
		
		if($x % 7 == 0)
		{
			echo "</tr><tr>";
		}
	}
	
	?>
	
	</tr></table>

	<br />
	<div align="right">
		<input id="button" type="button" name="cancel" value="Cancel" onclick="window.location.href='child.php?op=view&family_id=<?= $_GET['family_id'];?>&child_id=<?= $_GET['child_id'];?>'">
		<input id="button" type="submit" name="submit" value="Save">
	</div>

	<!--  Rt Column -->
	</div><div id="rtColumn" class="cover">
		<h5>Actions</h5>
		<ul>
			<li><a href="child.php?op=view&amp;family_id=<?=$_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>">Cancel</a></li>
			<li><a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>">Back to Family</a></li>
		</ul>
	</div>

	</form>
<?
}
elseif($_GET['op'] == 'add')
{
	if(isset($_POST['submit']))
	{
		mysql_query("INSERT INTO nanny_child SET 
                        family_id               = '".$_GET['family_id']."',
                        first_name              = '".$_POST['first_name']."',
                        last_name               = '".$_POST['last_name']."',
                        pickup_address          = '".$_POST['pickup_address']."',
                        dropoff_address         = '".$_POST['dropoff_address']."'", $db);

		header("Location: family.php?op=view&family_id=".$_GET['family_id']);
	}

	include("header.php");
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="child_form">
	<h1>Child Info</h1><div class="ruleHorizontal"></div><p>

	<div class="formquestion"><label>Family</label></div>
	<div class="formanswer">
		<select name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $child['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	
	<div class="formquestion"><label>First Name</label></div>
	<div class="formanswer">
		<input type="text" name="first_name" alt="First Name" maxlength="50" />
	</div>
	<br clear="all" />

	<div class="formquestion"><label>Last Name</label></div>
	<div class="formanswer">
		<input type="text" name="last_name" alt="First Name" maxlength="50" />
	</div>
	<br clear="all" />
	
        <div class="formquestion"><label>Drop Off Address</label></div>
        <div class="formanswer">
                <input type="text" name="dropoff_address" alt="Drop Off Address" maxlength="50" />
        </div>
        <br clear="all" />

        <div class="formquestion"><label>Pick Up Address</label></div>
        <div class="formanswer">
                <input type="text" name="pickup_address" alt="Pick Up Address" maxlength="50" />
        </div>
        <br clear="all" />

	<div align="right">
<!--
		<a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>"><img border="0" src="images/icon/cancel.png" width="50" height="50"></a>
		<input type="image" name="submit" value="Submit" src="images/icon/submit.png" width="50" height="50">
-->

		<input id="button" type="reset" name="reset" value="reset"> 
		<input id="button" type="submit" name="submit" value="Add Child">
	</div>

	<!--  Rt Column -->
	</div><div id="rtColumn" class="cover">
		<h5>Actions</h5>
		<ul>
			<li><a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>">Back to Family</a></li>
		</ul>
	</div>

	</form>
<?
}
elseif($_GET['op'] == 'delete')
{
	if($_GET['confirm'] == 1)
	{
		mysql_query("UPDATE nanny_child SET deleted = '1' WHERE child_id = '".$_GET['child_id']."'");
		header("Location: family.php?op=view&family_id=".$_GET['family_id']);
	}

	include("header.php");

	$child = mysql_fetch_array(mysql_query("SELECT first_name, last_name FROM nanny_child WHERE child_id = '".$_GET['child_id']."'"));
?>
	<h1>Delete <?= $child['first_name']." ".$child['last_name'];?></h1><div class="ruleHorizontal"></div><p>
	Are you sure you want to delete this child? [<a href="child.php?op=delete&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>&amp;confirm=1">Yes</a> | <a href="child.php?op=view&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>">No</a>]

	</div>
	<div id="rtColumn" class="cover">

		<h5>Actions</h5>
		<ul>
			<li><a href="child.php?op=view&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>">Cancel</a></li>
                        <li><a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>">Back to Family</a></li>
		</ul>

	</div>
<?
}
else
{
	//view

	include("header.php");
	$child = mysql_fetch_array(mysql_query("SELECT * FROM nanny_child WHERE child_id = '".$_GET['child_id']."'"));
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="child_form">
	<h1>Child Info</h1><div class="ruleHorizontal"></div><p>

	<div class="formquestion"><label>Family</label></div>
	<div class="formanswer">
		<select name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $child['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	<br clear="all" />

	<div class="formquestion"><label>First Name</label></div>
	<div class="formanswer">
		<input type="text" name="first_name" alt="First Name" maxlength="50" value="<?= $child['first_name'];?>" disabled="disabled" />
	</div>
	<br clear="all" />

	<div class="formquestion"><label>Last Name</label></div>
	<div class="formanswer">
		<input type="text" name="last_name" alt="First Name" maxlength="50" value="<?= $child['last_name'];?>" disabled="disabled" />
	</div>
	<br clear="all" />
	
	<div class="formquestion"><label>Drop Off Address</label></div>
	<div class="formanswer">
		<input type="text" name="dropoff_address" alt="Drop Off Address" maxlength="50" value="<?= $child['dropoff_address'];?>" disabled="disabled" />
	</div>
	<br clear="all" />	
	
	<div class="formquestion"><label>Pick Up Address</label></div>
	<div class="formanswer">
		<input type="text" name="pickup_address" alt="Pick Up Address" maxlength="50" value="<?= $child['pickup_address'];?>" disabled="disabled" />
	</div>
	<br clear="all" />		

	<div align="right">
<!--
		<a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>"><img border="0" src="images/icon/cancel.png" width="50" height="50"></a>
		<input type="image" name="submit" value="Submit" src="images/icon/submit.png" width="50" height="50">
-->

		<input id="button" onclick="window.location.href='family.php?op=view&family_id=<?= $_GET['family_id'];?>'" type="button" name="edit" value="Back to Family">
		<input id="button" onclick="window.location.href='child.php?op=edit&family_id=<?= $_GET['family_id'];?>&child_id=<?= $_GET['child_id'];?>'" type="button" name="edit" value="Edit" /> 
<!--		<input type="submit" name="submit" value="Submit">-->

	</div>

        <h1>Weekly Schedule</h1><div class="ruleHorizontal"></div><p>

	<img src="http://<?= $_SERVER['HTTP_HOST'];?>/nanny/graph_schedule.php?child_id=<?= $_GET['child_id'];?>" />

	<!--  Rt Column -->
	</div><div id="rtColumn" class="cover">
		<h5>Actions</h5>
		<ul>
			<li><a href="child.php?op=edit&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>">Edit Child</a></li>
			<li><a href="child.php?op=delete&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>">Delete Child</a></li>
			<li><a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>">Back to Family</a></li>
		</ul>
	</div>

	</form>
<?
}

include("footer.php");
?>
