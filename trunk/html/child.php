<?

include("config.php");

if(!is_admin())
{
	header("Location: index.php");
}

if($_GET['op'] == 'edit')
{
	if(isset($_POST['submit']))
	{
		$sql = "UPDATE nanny_child SET 
			family_id		= '".$_GET['family_id']."',
			first_name 		= '".$_POST['first_name']."',
			last_name 		= '".$_POST['last_name']."',
			notes			= '".$_POST['notes']."'
			WHERE child_id 		= '".$_GET['child_id']."'";

		mysql_query($sql, $db);

		header("Location: child.php?op=view&family_id=".$_GET['family_id']."&child_id=".$_GET['child_id']);
	}

	$admin_sub_menu = '<h3>Child Admin</h3><ul>
		<li><a href="child.php?op=view&amp;family_id='.$_GET['family_id'].'&amp;child_id='.$_GET['child_id'].'">Cancel</a></li>
		<li><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Back to Family</a></li>
	</ul>';

	include("header.php");
	$child = mysql_fetch_array(mysql_query("SELECT * FROM nanny_child WHERE child_id = '".$_GET['child_id']."'"));
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="child_form">
	<h2>Child Info</h2>

	<div><label>Family</label></div>
	<div>
		<select class="tf" name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $child['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	<br clear="all" />
	
	<div><label>First Name</label></div>
	<div><input class="tf" type="text" name="first_name" alt="First Name" maxlength="50" value="<?= $child['first_name'];?>" /></div>
	<br clear="all" />

	<div><label>Last Name</label></div>
	<div><input class="tf" type="text" name="last_name" alt="First Name" maxlength="50" value="<?= $child['last_name'];?>" /></div>
	<br clear="all" />
	
	<div><label>Notes</label></div>
	<div><textarea name="notes"><?= $child['notes'];?></textarea></div>
	<br clear="all" />		

	<br />
	<div align="right"><input id="button" type="submit" name="submit" value="Save"></div>

        <h2><?= $child['first_name'];?>'s Schedule</h2>
<?
	draw_graph($_GET['child_id']);
?>
	</form>
<?
}
elseif($_GET['op'] == 'add')
{
	if(isset($_POST['submit']))
	{
		mysql_query("INSERT INTO nanny_child SET 
                        family_id	= '".$_GET['family_id']."',
                        first_name	= '".$_POST['first_name']."',
                        last_name	= '".$_POST['last_name']."',
                        notes		= '".$_POST['notes']."'", $db);

		header("Location: family.php?op=view&family_id=".$_GET['family_id']);
	}

	$admin_sub_menu = '<h3>Child Admin</h3><ul>
		<li><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Back to Family</a></li>
	</ul>';

	include("header.php");
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="child_form">
	<h2>Child Info</h2>

	<div><label>Family</label></div>
	<div>
		<select class="tf" name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $child['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	
	<div><label>First Name</label></div>
	<div><input class="tf" type="text" name="first_name" alt="First Name" maxlength="50" /></div>
	<br clear="all" />

	<div><label>Last Name</label></div>
	<div><input class="tf" type="text" name="last_name" alt="First Name" maxlength="50" /></div>
	<br clear="all" />
	
        <div><label>Notes</label></div>
        <div><textarea name="notes"><?= $child['notes'];?></textarea></div>
        <br clear="all" />

	<div align="right"><input id="button" type="submit" name="submit" value="Add Child"></div>

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

	$admin_sub_menu = '<h3>Child Admin</h3><ul>
		<li><a href="child.php?op=view&amp;family_id='.$_GET['family_id'].'&amp;child_id='.$_GET['child_id'].'">Cancel</a></li>
		<li><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Back to Family</a></li>
	</ul>';

	include("header.php");

	$child = mysql_fetch_array(mysql_query("SELECT first_name, last_name FROM nanny_child WHERE child_id = '".$_GET['child_id']."'"));
?>
	<h2>Delete <?= $child['first_name']." ".$child['last_name'];?></h2>
	Are you sure you want to delete this child? [<a href="child.php?op=delete&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>&amp;confirm=1">Yes</a> | <a href="child.php?op=view&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>">No</a>]

	</div>
<?
}
else
{
	// view child

	$admin_sub_menu = '<h3>Child Admin</h3><ul>
		<li><a href="child.php?op=edit&amp;family_id='.$_GET['family_id'].'&amp;child_id='.$_GET['child_id'].'">Edit Child</a></li>
		<li><a href="schedule.php?op=edit&amp;family_id='.$_GET['family_id'].'&amp;child_id='.$_GET['child_id'].'">Edit Schedule</a></li>
		<li><a href="child.php?op=delete&amp;family_id='.$_GET['family_id'].'&amp;child_id='.$_GET['child_id'].'">Delete Child</a></li>
		<li><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Back to Family</a></li>
	</ul>';

	include("header.php");
	$child = mysql_fetch_array(mysql_query("SELECT * FROM nanny_child WHERE child_id = '".$_GET['child_id']."'"));
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="child_form">
	<h2><?= $child['first_name'];?>'s Info</h2>

	<div><label>Family</label></div>
	<div>
		<select class="tf" name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $child['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	<br clear="all" />

	<div><label>First Name</label></div>
	<div><input class="tf" type="text" name="first_name" alt="First Name" maxlength="50" value="<?= $child['first_name'];?>" disabled="disabled" /></div>
	<br clear="all" />

	<div><label>Last Name</label></div>
	<div><input class="tf" type="text" name="last_name" alt="First Name" maxlength="50" value="<?= $child['last_name'];?>" disabled="disabled" /></div>
	<br clear="all" />
	
	<div><label>Notes</label></div>
	<div><textarea name="notes" disabled="disabled"><?= $child['notes'];?></textarea></div>
	<br clear="all" />		

        <h2><?= $child['first_name'];?>'s Schedule</h2>

<?
//	draw_calendar($_GET['child_id']);
	draw_graph($_GET['child_id']);
?>
	</form>
<?

}

include("footer.php");
?>
