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
		mysql_query("UPDATE nanny_parent SET 
			family_id	= '".$_GET['family_id']."',
			first_name 	= '".$_POST['first_name']."',
			last_name 	= '".$_POST['last_name']."',
			phone_number 	= '".$_POST['phone_number']."',
			email_address 	= '".$_POST['email_address']."'
			WHERE parent_id = '".$_GET['parent_id']."'", $db);

		header("Location: parent.php?op=view&family_id=".$_GET['family_id']."&parent_id=".$_GET['parent_id']);
	}

	$admin_sub_menu = '<h3>Family Admin</h3><ul>
		<li class="first"><a href="parent.php?op=view&amp;parent_id='.$_GET['parent_id'].'&amp;family_id='.$_GET['family_id'].'">Cancel</a></li>
		<li><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Back to Family</a></li>
	</ul>';

	include("header.php");
	$parent = mysql_fetch_array(mysql_query("SELECT * FROM nanny_parent WHERE parent_id = '".$_GET['parent_id']."'"));
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="parent_form">
	<h2>Parent Info</h2><div class="ruleHorizontal"></div><p>

	<div><label>Family</label></div>
	<div>
		<select class="tf" name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $parent['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	<br clear="all" />
	
	<div><label>First Name</label></div>
	<div><input class="tf" type="text" name="first_name" alt="First Name" maxlength="50" value="<?= $parent['first_name'];?>" /></div>
	<br clear="all" />

	<div><label>Last Name</label></div>
	<div><input class="tf" type="text" name="last_name" alt="First Name" maxlength="50" value="<?= $parent['last_name'];?>" /></div>
	<br clear="all" />
	
	<div><label>Phone Number</label></div>
	<div><input class="tf" type="text" name="phone_number" alt="Last Name" maxlength="50" value="<?= $parent['phone_number'];?>" /></div>
	<br clear="all" />	
	
	<div><label>Email Address</label></div>
	<div><input class="tf" type="text" name="email_address" alt="Email Address" maxlength="50" value="<?= $parent['email_address'];?>" /></div>
	<br clear="all" />		

	<div align="right">
		<input id="button" type="submit" name="submit" value="Save">
	</div>
	</form>
<?
}
elseif($_GET['op'] == 'add')
{
	if(isset($_POST['submit']))
	{
		mysql_query("INSERT INTO nanny_parent SET 
			family_id	= '".$_GET['family_id']."',
			first_name 	= '".$_POST['first_name']."',
			last_name 	= '".$_POST['last_name']."',
			phone_number 	= '".$_POST['phone_number']."',
			email_address 	= '".$_POST['email_address']."'", $db);

		header("Location: family.php?op=view&family_id=".$_GET['family_id']);
	}

        $admin_sub_menu = '<h3>Family Admin</h3><ul>
		<li class="first"><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Cancel</a></li>
		<li><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Back to Family</a></li>
	</ul>';

	include("header.php");
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="parent_form">
	<h2>Parent Info</h2><div class="ruleHorizontal"></div><p>

	<div><label>Family</label></div>
	<div>
		<select class="tf" name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $parent['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	<br clear="all" />
	
	<div><label>First Name</label></div>
	<div><input class="tf" type="text" name="first_name" alt="First Name" maxlength="50" /></div>
	<br clear="all" />

	<div><label>Last Name</label></div>
	<div><input class="tf" type="text" name="last_name" alt="First Name" maxlength="50" /></div>
	<br clear="all" />
	
	<div><label>Phone Number</label></div>
	<div><input class="tf" type="text" name="phone_number" alt="Last Name" maxlength="50" /></div>
	<br clear="all" />	
	
	<div><label>Email Address</label></div>
	<div><input class="tf" type="text" name="email_address" alt="Email Address" maxlength="50" /></div>
	<br clear="all" />		

	<div align="right"><input id="button" type="submit" name="submit" value="Add Parent"></div>

	</form><br>
<?
}
elseif($_GET['op'] == 'delete')
{
        if($_GET['confirm'] == 1)
        {
                mysql_query("UPDATE nanny_parent SET deleted = '1' WHERE parent_id = '".$_GET['parent_id']."'");
                header("Location: family.php?op=view&family_id=".$_GET['family_id']);
        }

	$admin_sub_menu = '<h3>Family Admin</h3><ul>
		<li class="first"><a href="parent.php?op=edit&amp;family_id='.$_GET['family_id'].'&amp;parent_id='.$_GET['parent_id'].'">Edit Parent</a></li>
		<li><a href="parent.php?op=delete&amp;family_id='.$_GET['family_id'].'&amp;parent_id='.$_GET['parent_id'].'">Delete Parent</a></li>
		<li><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Back to Family</a></li>
	</ul>';

	include("header.php");

        $parent = mysql_fetch_array(mysql_query("SELECT first_name, last_name FROM nanny_parent WHERE parent_id = '".$_GET['parent_id']."'"));
?>
        <h2>Delete <?= $parent['first_name']." ".$parent['last_name'];?></h2>
        Are you sure you want to delete this parent? [<a href="parent.php?op=delete&amp;family_id=<?= $_GET['family_id'];?>&amp;parent_id=<?= $_GET['parent_id'];?>&amp;confirm=1">Yes</a> | <a href="parent.php?op=view&amp;family_id=<?= $_GET['family_id'];?>&amp;parent_id=<?= $_GET['parent_id'];?>">No</a>]

        </div>
<?
}
else
{
	//view

	$admin_sub_menu = '<h3>Family Admin</h3><ul>
		<li class="first"><a href="parent.php?op=edit&amp;family_id='.$_GET['family_id'].'&amp;parent_id='.$_GET['parent_id'].'">Edit Parent</a></li>
		<li><a href="parent.php?op=delete&amp;family_id='.$_GET['family_id'].'&amp;parent_id='.$_GET['parent_id'].'">Delete Parent</a></li>
		<li><a href="family.php?op=view&amp;family_id='.$_GET['family_id'].'">Back to Family</a></li>
	</ul>';

	include("header.php");
	$parent = mysql_fetch_array(mysql_query("SELECT * FROM nanny_parent WHERE parent_id = '".$_GET['parent_id']."'"));
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="parent_form">
	<h2>Parent Info</h2>

	<div><label>Family</label></div>
	<div>
		<select class="tf" name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $parent['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	<br clear="all" />

	<div><label>First Name</label></div>
	<div><input class="tf" type="text" name="first_name" alt="First Name" maxlength="50" value="<?= $parent['first_name'];?>" disabled="disabled" /></div>
	<br clear="all" />

	<div><label>Last Name</label></div>
	<div><input class="tf" type="text" name="last_name" alt="First Name" maxlength="50" value="<?= $parent['last_name'];?>" disabled="disabled" /></div>
	<br clear="all" />
	
	<div><label>Phone Number</label></div>
	<div><input class="tf" type="text" name="phone_number" alt="Last Name" maxlength="50" value="<?= $parent['phone_number'];?>" disabled="disabled" /></div>
	<br clear="all" />	
	
	<div><label>Email Address</label></div>
	<div><input class="tf" type="text" name="email_address" alt="Email Address" maxlength="50" value="<?= $parent['email_address'];?>" disabled="disabled" /></div>
	<br clear="all" />		

	</form>
<?
}

include("footer.php");
?>
