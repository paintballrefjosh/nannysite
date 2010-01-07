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
			start_time_monday	= '".$_POST['start_time_monday_h'].":".$_POST['start_time_monday_m']."',
			end_time_monday		= '".$_POST['end_time_monday_h'].":".$_POST['end_time_monday_m']."',
			start_time_tuesday	= '".$_POST['start_time_tuesday_h'].":".$_POST['start_time_tuesday_m']."',
			end_time_tuesday	= '".$_POST['end_time_tuesday_h'].":".$_POST['end_time_tuesday_m']."',
			start_time_wednesday	= '".$_POST['start_time_wednesday_h'].":".$_POST['start_time_wednesday_m']."',
			end_time_wednesday	= '".$_POST['end_time_wednesday_h'].":".$_POST['end_time_wednesday_m']."',
			start_time_thursday	= '".$_POST['start_time_thursday_h'].":".$_POST['start_time_thursday_m']."',
			end_time_thursday	= '".$_POST['end_time_thursday_h'].":".$_POST['end_time_thursday_m']."',
			start_time_friday	= '".$_POST['start_time_friday_h'].":".$_POST['start_time_friday_m']."',
			end_time_friday		= '".$_POST['end_time_friday_h'].":".$_POST['end_time_friday_m']."',
			start_time_saturday	= '".$_POST['start_time_saturday_h'].":".$_POST['start_time_saturday_m']."',
			end_time_saturday	= '".$_POST['end_time_saturday_h'].":".$_POST['end_time_saturday_m']."',
			start_time_sunday	= '".$_POST['start_time_sunday_h'].":".$_POST['start_time_sunday_m']."',
			end_time_sunday		= '".$_POST['end_time_sunday_h'].":".$_POST['end_time_sunday_m']."',
			dropoff_address 	= '".$_POST['dropoff_address']."',
			pickup_address		= '".$_POST['pickup_address']."'
			WHERE child_id 		= '".$_GET['child_id']."'";

		mysql_query($sql, $db);

		header("Location: child.php?op=view&family_id=".$_GET['family_id']."&child_id=".$_GET['child_id']);
	}

	foreach(array("monday","tuesday","wednesday","thursday","friday","saturday","sunday") as $day)
	{
		if(isset($_POST[$day."_enable"]))
		{
			if($_POST[$day."_enable"] == "Enable")
				$enable = 1;
			else
				$enable = 0;
echo "UPDATE nanny_child SET $day"."_enable = '$enable' WHERE child_id = '".$_GET['child_id']."'";
			mysql_query("UPDATE nanny_child SET $day"."_enable = '$enable' WHERE child_id = '".$_GET['child_id']."'", $db);
			header("Location: child.php?op=edit&family_id=".$_GET['family_id']."&child_id=".$_GET['child_id']);
		}
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
		<input id="button" type="reset" name="reset" value="Reset"> 
		<input id="button" type="submit" name="submit" value="Save">
	</div>

        <h1>Weekly Schedule</h1><div class="ruleHorizontal"></div><p>

<?
foreach(array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday") as $day)
{
	$tmp = explode(":", $child["start_time_".strtolower($day)]);
	$start_hour = $tmp[0];
	$start_min = $tmp[1];

	$tmp = explode(":", $child["end_time_".strtolower($day)]);
	$end_hour = $tmp[0];
	$end_min = $tmp[1];
?>
	<div class="formquestion"><label><?= $day;?></label></div>
	<div class="formanswer">
		<select name="start_time_<?= strtolower($day);?>_h" alt="Start Time <?= $day;?> Hour" maxlength="2" <? if(!$child[strtolower($day)."_enable"]){echo 'disabled="disabled"';}?> />
			<option value="00" <? if($start_hour == "00"){echo 'selected="selected"';}?>>00</option>
			<option value="01" <? if($start_hour == "01"){echo 'selected="selected"';}?>>01</option>
			<option value="02" <? if($start_hour == "02"){echo 'selected="selected"';}?>>02</option>
			<option value="03" <? if($start_hour == "03"){echo 'selected="selected"';}?>>03</option>
			<option value="04" <? if($start_hour == "04"){echo 'selected="selected"';}?>>04</option>
			<option value="05" <? if($start_hour == "05"){echo 'selected="selected"';}?>>05</option>
			<option value="06" <? if($start_hour == "06"){echo 'selected="selected"';}?>>06</option>
			<option value="07" <? if($start_hour == "07"){echo 'selected="selected"';}?>>07</option>
			<option value="08" <? if($start_hour == "08"){echo 'selected="selected"';}?>>08</option>
			<option value="09" <? if($start_hour == "09"){echo 'selected="selected"';}?>>09</option>
			<option value="10" <? if($start_hour == "10"){echo 'selected="selected"';}?>>10</option>
			<option value="11" <? if($start_hour == "11"){echo 'selected="selected"';}?>>11</option>
			<option value="12" <? if($start_hour == "12"){echo 'selected="selected"';}?>>12</option>
			<option value="13" <? if($start_hour == "13"){echo 'selected="selected"';}?>>13</option>
			<option value="14" <? if($start_hour == "14"){echo 'selected="selected"';}?>>14</option>
			<option value="15" <? if($start_hour == "15"){echo 'selected="selected"';}?>>15</option>
			<option value="16" <? if($start_hour == "16"){echo 'selected="selected"';}?>>16</option>
			<option value="17" <? if($start_hour == "17"){echo 'selected="selected"';}?>>17</option>
			<option value="18" <? if($start_hour == "18"){echo 'selected="selected"';}?>>18</option>
			<option value="19" <? if($start_hour == "19"){echo 'selected="selected"';}?>>19</option>
			<option value="20" <? if($start_hour == "20"){echo 'selected="selected"';}?>>20</option>
			<option value="21" <? if($start_hour == "21"){echo 'selected="selected"';}?>>21</option>
			<option value="22" <? if($start_hour == "22"){echo 'selected="selected"';}?>>22</option>
			<option value="23" <? if($start_hour == "23"){echo 'selected="selected"';}?>>23</option>
		</select> : 
		
		<select name="start_time_<?= strtolower($day);?>_m" alt="Start Time <?= $day;?> Minute" maxlength="2"  <? if(!$child[strtolower($day)."_enable"]){echo 'disabled="disabled"';}?> />
			<option value="00" <? if($start_min == "00"){echo 'selected="selected"';}?>>00</option>
			<option value="15" <? if($start_min == "15"){echo 'selected="selected"';}?>>15</option>
			<option value="30" <? if($start_min == "30"){echo 'selected="selected"';}?>>30</option>
			<option value="45" <? if($start_min == "45"){echo 'selected="selected"';}?>>45</option>
		</select>

		&nbsp;&nbsp;&nbsp;&nbsp;thru&nbsp;&nbsp;&nbsp;&nbsp; 

		<select name="end_time_<?= strtolower($day);?>_h" alt="End Time <?= $day;?> Hour" maxlength="2" <? if(!$child[strtolower($day)."_enable"]){echo 'disabled="disabled"';}?> />
			<option value="00" <? if($end_hour == "00"){echo 'selected="selected"';}?>>00</option>
			<option value="01" <? if($end_hour == "01"){echo 'selected="selected"';}?>>01</option>
			<option value="02" <? if($end_hour == "02"){echo 'selected="selected"';}?>>02</option>
			<option value="03" <? if($end_hour == "03"){echo 'selected="selected"';}?>>03</option>
			<option value="04" <? if($end_hour == "04"){echo 'selected="selected"';}?>>04</option>
			<option value="05" <? if($end_hour == "05"){echo 'selected="selected"';}?>>05</option>
			<option value="06" <? if($end_hour == "06"){echo 'selected="selected"';}?>>06</option>
			<option value="07" <? if($end_hour == "07"){echo 'selected="selected"';}?>>07</option>
			<option value="08" <? if($end_hour == "08"){echo 'selected="selected"';}?>>08</option>
			<option value="09" <? if($end_hour == "09"){echo 'selected="selected"';}?>>09</option>
			<option value="10" <? if($end_hour == "10"){echo 'selected="selected"';}?>>10</option>
			<option value="11" <? if($end_hour == "11"){echo 'selected="selected"';}?>>11</option>
			<option value="12" <? if($end_hour == "12"){echo 'selected="selected"';}?>>12</option>
			<option value="13" <? if($end_hour == "13"){echo 'selected="selected"';}?>>13</option>
			<option value="14" <? if($end_hour == "14"){echo 'selected="selected"';}?>>14</option>
			<option value="15" <? if($end_hour == "15"){echo 'selected="selected"';}?>>15</option>
			<option value="16" <? if($end_hour == "16"){echo 'selected="selected"';}?>>16</option>
			<option value="17" <? if($end_hour == "17"){echo 'selected="selected"';}?>>17</option>
			<option value="18" <? if($end_hour == "18"){echo 'selected="selected"';}?>>18</option>
			<option value="19" <? if($end_hour == "19"){echo 'selected="selected"';}?>>19</option>
			<option value="20" <? if($end_hour == "20"){echo 'selected="selected"';}?>>20</option>
			<option value="21" <? if($end_hour == "21"){echo 'selected="selected"';}?>>21</option>
			<option value="22" <? if($end_hour == "22"){echo 'selected="selected"';}?>>22</option>
			<option value="23" <? if($end_hour == "23"){echo 'selected="selected"';}?>>23</option>
                </select> : 

		<select name="end_time_<?= strtolower($day);?>_m" alt="End Time <?= $day;?> Minute" maxlength="2" <? if(!$child[strtolower($day)."_enable"]){echo 'disabled="disabled"';}?> />
                        <option value="00" <? if($end_min == "00"){echo 'selected="selected"';}?>>00</option>
                        <option value="15" <? if($end_min == "15"){echo 'selected="selected"';}?>>15</option>
                        <option value="30" <? if($end_min == "30"){echo 'selected="selected"';}?>>30</option>
                        <option value="45" <? if($end_min == "45"){echo 'selected="selected"';}?>>45</option>
                </select>

		<input id="button" type="submit" name="<?= strtolower($day);?>_enable" <? if(!$child[strtolower($day).'_enable']){echo 'value="Enable"';}else{echo 'value="Disable"';}?> />
	</div>
	<br clear="all" />	
	
<?
}
?>
	<br />
	<div align="right">
		<input id="button" type="reset" name="reset" value="Reset"> 
		<input id="button" type="submit" name="submit" value="Save">
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
