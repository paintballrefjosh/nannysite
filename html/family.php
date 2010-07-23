<?

include("config.php");

if(!is_admin())
{
	header("Location: index.php");
}

if($_GET['op'] == 'view')
{
	$admin_sub_menu = '<h3>Family Admin</h3><ul>
		<li class="first"><a href="parent.php?op=add&amp;family_id='.$_GET['family_id'].'">Add Parent</a></li>
		<li><a href="child.php?op=add&amp;family_id='.$_GET['family_id'].'">Add Child</a></li>
		<li><a href="family.php?op=edit&amp;family_id='.$_GET['family_id'].'">Edit Family</a></li>
		<li><a href="family.php?op=delete&amp;family_id='.$_GET['family_id'].'">Delete Family</a></li>
	</ul>';

	include("header.php");
	$family = mysql_fetch_array(mysql_query("SELECT * FROM nanny_family WHERE family_id = '" . $_GET['family_id'] . "'"));
?>
	<h2>The <?= $family['family_name'];?> Family - $<?= $family['payment_amount'] . " / " . $family['payment_rate'];?></h2>
<?
	$result = mysql_query("SELECT parent_id, first_name, last_name FROM nanny_parent WHERE deleted = '0' AND family_id = '".$_GET['family_id']."' ORDER BY first_name ASC", $db);
	while($row = mysql_fetch_array($result))
	{
?>
 	       [Parent] <b><?= $row['first_name'] . " " . $row['last_name'];?></b> </a> [<a href="parent.php?op=view&amp;family_id=<?= $_GET['family_id'];?>&amp;parent_id=<?= $row['parent_id'];?>">View</a>]<br>
<?
	}
	
	$result = mysql_query("SELECT child_id, first_name, last_name FROM nanny_child WHERE deleted = '0' AND family_id = '".$_GET['family_id']."' ORDER BY first_name ASC", $db);
	while($row = mysql_fetch_array($result))
	{
?>
 	       [Child] <b><?= $row['first_name']." ".$row['last_name'];?></b> [<a href="child.php?op=view&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $row['child_id'];?>">View</a>]<br>
<?
	}
?>
	<br clear="all" />
	<br clear="all" />
	<h2>The <?= $family['family_name'];?>'s Schedule</h2>
<?
	draw_graph(0, $_GET['family_id']);
#        draw_calendar(0,$_GET['family_id']);
}
elseif($_GET['op'] == 'edit')
{
	if(isset($_POST['submit']))
	{
		$sql = "UPDATE nanny_family SET 
			family_name	= '".$_POST['family_name']."',
			payment_rate	= '".$_POST['payment_rate']."',
			payment_amount 	= '".$_POST['payment_amount']."'
			WHERE family_id = '".$_GET['family_id']."'";

		if(!mysql_query($sql, $db))
		{
			do_error($sql, $db);
		}

		header("Location: family.php?op=view&family_id=".$_GET['family_id']);
	}

        $admin_sub_menu = '<h3>Family Admin</h3><ul>
		<li class="first"><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Cancel</a></li>
		<li><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Back to Family</a></li>
        </ul>';

	include("header.php");

	$family = mysql_fetch_array(mysql_query("SELECT * FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post">
	<h2>The <?= $family['family_name'];?> Family - $<?= $family['payment_amount']." / ".$family['payment_rate'];?></h2>

	<div><label>Family Name (Last Only)</label></div>
	<div><input type="text" name="family_name" alt="Family Name" maxlength="50" value="<?= $family['family_name'];?>" /></div>
	<br clear="all" />

	<div><label>Payment Rate</label></div>
        <div>
                <input id="radio" type="radio" name="payment_rate" alt="Payment Rate" value="day" <? if($family['payment_rate'] == "day") echo 'checked="checked" ';?>/> Daily<br>
		<input id="radio" type="radio" name="payment_rate" alt="Payment Rate" value="week" <? if($family['payment_rate'] == "week") echo 'checked="checked" ';?>/> Weekly
        </div>
        <br clear="all" />

	<div><label>Payment Amount</label></div>
	<div><input type="text" name="payment_amount" maxlength="50" value="<?= $family['payment_amount'];?>" /></div>
	<br clear="all" />

	<div align="right"><input id="button" type="submit" name="submit" value="Save"></div>
	</form>
<?
}
elseif($_GET['op'] == 'add')
{
	if(isset($_POST['submit']))
        {
                $sql = "INSERT INTO nanny_family SET 
                        family_name     = '".$_POST['family_name']."',
                        payment_rate    = '".$_POST['payment_rate']."',
                        payment_amount  = '".$_POST['payment_amount']."'";

                if(!mysql_query($sql, $db))
                {
                        do_error($sql, $db);
                }

                header("Location: family.php");
        }

	$admin_sub_menu = '<h3>Family Admin</h3><ul><li><a href="family.php">Cancel</a></li></ul>';

        include("header.php");
?>
        <form method="post">
        <h2>Add New Family</h2>

        <div><label>Family Name (Last Only)</label></div>
        <div><input type="text" name="family_name" alt="Family Name" maxlength="50" /></div>

        <br clear="all" />

        <div><label>Payment Rate</label></div>
        <div>
		<input id="radio" type="radio" name="payment_rate" alt="Payment Rate" value="day" checked="checked" /> Daily<br>
		<input id="radio" type="radio" name="payment_rate" alt="Payment Rate" value="week" /> Weekly 
        </div>
        <br clear="all" />

        <div><label>Payment Amount</label></div>
        <div><input type="text" name="payment_amount" maxlength="50" /></div>
        <br clear="all" />

        <div align="right"><input id="button" type="submit" name="submit" value="Save"></div>

        </form>
<?
}
elseif($_GET['op'] == 'delete')
{
        if($_GET['confirm'] == 1)
        {
                mysql_query("UPDATE nanny_family SET deleted = '1' WHERE family_id = '".$_GET['family_id']."'");
                header("Location: family.php");
        }

	$admin_sub_menu = '<h3>Family Admin</h3><ul><li class="first"><a href="parent.php?op=view&amp;family_id='.$_GET['family_id'].'">Cancel</a></li></ul>';

        include("header.php");

        $family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
        <h2>Delete the <?= $family['family_name'];?> Family</h2>
        Are you sure you want to delete this family? [<a href="family.php?op=delete&amp;family_id=<?= $_GET['family_id'];?>&amp;confirm=1">Yes</a> | <a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>">No</a>]
        </div>
<?
}
else
{
	$admin_sub_menu = '<h3>Family Admin</h3><ul><li class="first"><a href="family.php?op=add">Add Family</a></li></ul>';

	include("header.php");
?>
	<h2>Current Families</h2>
	<ul>
<?
	$result = mysql_query("SELECT * FROM nanny_family WHERE deleted = '0' ORDER BY family_name ASC", $db);

	while($row = mysql_fetch_array($result))
	{
?>
		<li><a href="family.php?op=view&amp;family_id=<?= $row['family_id'];?>">The <?= $row['family_name'];?> Family</a> - $<?= $row['payment_amount'];?> / <?= $row['payment_rate'];?></li>
<?
	}
?>
	</ul>
	</div>
<?
}

include("footer.php");
?>
