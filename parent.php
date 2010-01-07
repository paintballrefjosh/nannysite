<?

include("config.php");

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

	include("header.php");
	$parent = mysql_fetch_array(mysql_query("SELECT * FROM nanny_parent WHERE parent_id = '".$_GET['parent_id']."'"));
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="parent_form">
	<h1>Parent Info</h1><div class="ruleHorizontal"></div><p>

	<div class="formquestion"><label>Family</label></div>
	<div class="formanswer">
		<select name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $parent['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	<BR clear="all" />
	
	<div class="formquestion"><label>First Name</label></div>
	<div class="formanswer">
		<input type="text" name="first_name" alt="First Name" maxlength="50" value="<?= $parent['first_name'];?>" />
	</div>
	<BR clear="all" />

	<div class="formquestion"><label>Last Name</label></div>
	<div class="formanswer">
		<input type="text" name="last_name" alt="First Name" maxlength="50" value="<?= $parent['last_name'];?>" />
	</div>
	<BR clear="all" />
	
	<div class="formquestion"><label>Phone Number</label></div>
	<div class="formanswer">
		<input type="text" name="phone_number" alt="Last Name" maxlength="50" value="<?= $parent['phone_number'];?>" />
	</div>
	<BR clear="all" />	
	
	<div class="formquestion"><label>Email Address</label></div>
	<div class="formanswer">
		<input type="text" name="email_address" alt="Email Address" maxlength="50" value="<?= $parent['email_address'];?>" />
	</div>
	<BR clear="all" />		

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
		mysql_query("INSERT INTO nanny_parent SET 
			family_id	= '".$_GET['family_id']."',
			first_name 	= '".$_POST['first_name']."',
			last_name 	= '".$_POST['last_name']."',
			phone_number 	= '".$_POST['phone_number']."',
			email_address 	= '".$_POST['email_address']."'", $db);

		header("Location: family.php?op=view&family_id=".$_GET['family_id']);
	}

	include("header.php");
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="parent_form">
	<h1>Parent Info</h1><div class="ruleHorizontal"></div><p>

	<div class="formquestion"><label>Family</label></div>
	<div class="formanswer">
		<select name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $parent['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	
	<div class="formquestion"><label>First Name</label></div>
	<div class="formanswer">
		<input type="text" name="first_name" alt="First Name" maxlength="50" />
	</div>
	<BR clear="all" />

	<div class="formquestion"><label>Last Name</label></div>
	<div class="formanswer">
		<input type="text" name="last_name" alt="First Name" maxlength="50" />
	</div>
	<BR clear="all" />
	
	<div class="formquestion"><label>Phone Number</label></div>
	<div class="formanswer">
		<input type="text" name="phone_number" alt="Last Name" maxlength="50" />
	</div>
	<BR clear="all" />	
	
	<div class="formquestion"><label>Email Address</label></div>
	<div class="formanswer">
		<input type="text" name="email_address" alt="Email Address" maxlength="50" />
	</div>
	<BR clear="all" />		

	<div align="right">
<!--
		<a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>"><img border="0" src="images/icon/cancel.png" width="50" height="50"></a>
		<input type="image" name="submit" value="Submit" src="images/icon/submit.png" width="50" height="50">
-->

		<input id="button" type="reset" name="reset" value="reset"> 
		<input id="button" type="submit" name="submit" value="Add Parent">
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

}
else
{
	//view

	include("header.php");
	$parent = mysql_fetch_array(mysql_query("SELECT * FROM nanny_parent WHERE parent_id = '".$_GET['parent_id']."'"));
	$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post" name="parent_form">
	<h1>Parent Info</h1><div class="ruleHorizontal"></div><p>

	<div class="formquestion"><label>Family</label></div>
	<div class="formanswer">
		<select name="family_id" alt="Family" disabled="disabled">
			<option value="<?= $parent['family_id'];?>">The <?= $family['family_name'];?> Family</option>
		</select>
	</div>
	<BR clear="all" />

	<div class="formquestion"><label>First Name</label></div>
	<div class="formanswer">
		<input type="text" name="first_name" alt="First Name" maxlength="50" value="<?= $parent['first_name'];?>" disabled="disabled" />
	</div>
	<BR clear="all" />

	<div class="formquestion"><label>Last Name</label></div>
	<div class="formanswer">
		<input type="text" name="last_name" alt="First Name" maxlength="50" value="<?= $parent['last_name'];?>" disabled="disabled" />
	</div>
	<BR clear="all" />
	
	<div class="formquestion"><label>Phone Number</label></div>
	<div class="formanswer">
		<input type="text" name="phone_number" alt="Last Name" maxlength="50" value="<?= $parent['phone_number'];?>" disabled="disabled" />
	</div>
	<BR clear="all" />	
	
	<div class="formquestion"><label>Email Address</label></div>
	<div class="formanswer">
		<input type="text" name="email_address" alt="Email Address" maxlength="50" value="<?= $parent['email_address'];?>" disabled="disabled" />
	</div>
	<BR clear="all" />		

	<div align="right">
<!--
		<a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>"><img border="0" src="images/icon/cancel.png" width="50" height="50"></a>
		<input type="image" name="submit" value="Submit" src="images/icon/submit.png" width="50" height="50">
-->

		<input id="button" onclick="window.location.href='family.php?op=view&family_id=<?= $_GET['family_id'];?>'" type="button" name="edit" value="Back to Family">
		<input id="button" onclick="window.location.href='parent.php?op=edit&family_id=<?= $_GET['family_id'];?>&parent_id=<?= $_GET['parent_id'];?>'" type="button" name="edit" value="Edit" /> 
<!--		<input type="submit" name="submit" value="Submit">-->

	</div>

	<!--  Rt Column -->
	</div><div id="rtColumn" class="cover">
		<h5>Actions</h5>
		<ul>
			<li><a href="parent.php?op=edit&amp;family_id=<?= $_GET['family_id'];?>&amp;parent_id=<?= $_GET['parent_id'];?>">Edit Parent</a></li>
			<li><a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>">Back to Family</a></li>
		</ul>
	</div>

	</form>
<?
}

include("footer.php");
?>
