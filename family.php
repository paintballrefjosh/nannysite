<?

include("config.php");


if($_GET['op'] == 'view')
{
	include("header.php");
	$family = mysql_fetch_array(mysql_query("SELECT * FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<h1>The <?= $family['family_name'];?> Family - $<?= $family['weekly_rate'];?> / week</h1><div class="ruleHorizontal"></div><p>
<?
	$result = mysql_query("SELECT parent_id, first_name, last_name FROM nanny_parent WHERE deleted = '0' AND family_id = '".$_GET['family_id']."' ORDER BY first_name ASC", $db);
	while($row = mysql_fetch_array($result))
	{
?>
 	       [Parent] <a href="parent.php?op=view&amp;family_id=<?= $_GET['family_id'];?>&amp;parent_id=<?= $row['parent_id'];?>"><?= $row['first_name']." ".$row['last_name'];?></a><br>
<?
	}
	
	$result = mysql_query("SELECT child_id, first_name, last_name FROM nanny_child WHERE deleted = '0' AND family_id = '".$_GET['family_id']."' ORDER BY first_name ASC", $db);
	while($row = mysql_fetch_array($result))
	{
?>
 	       [Child] <a href="child.php?op=view&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $row['child_id'];?>"><?= $row['first_name']." ".$row['last_name'];?></a><br>
<?
	}
?>
	</div>

	<!--  Rt Column -->
	<div id="rtColumn" class="cover">
		<h5>Actions</h5>
		<ul>
		        <li><a href="parent.php?op=add&amp;family_id=<?= $_GET['family_id'];?>">Add Parent</a></li>
		        <li><a href="child.php?op=add&amp;family_id=<?= $_GET['family_id'];?>">Add Child</a></li>
		        <li><a href="family.php?op=edit&amp;family_id=<?= $_GET['family_id'];?>">Edit Family</a></li>
		        <li><a href="family.php?op=delete&amp;family_id=<?= $_GET['family_id'];?>">Delete Family</a></li>
		</ul>
	</div>
<?
}
elseif($_GET['op'] == 'edit')
{
	if(isset($_POST['submit']))
	{
		mysql_query("UPDATE nanny_family SET 
			family_name	= '".$_POST['family_name']."',
			weekly_rate 	= '".$_POST['weekly_rate']."'
			WHERE family_id = '".$_GET['family_id']."'", $db);

		header("Location: family.php?op=view&family_id=".$_GET['family_id']);
	}

	include("header.php");

	$family = mysql_fetch_array(mysql_query("SELECT * FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
	<form method="post">
	<h1>The <?= $family['family_name'];?> Family - $<?= $family['weekly_rate'];?> / week</h1><div class="ruleHorizontal"></div><p>

	<div class="formquestion"><label>Family Name (Last Only)</label></div>
	<div class="formanswer">
		<input type="text" name="family_name" alt="Family Name" maxlength="50" value="<?= $family['family_name'];?>" />
	</div>

	<BR clear="all" />

	<div class="formquestion"><label>Weekly Rate</label></div>
	<div class="formanswer">
		<input type="text" name="weekly_rate" alt="Weekly Rate" maxlength="50" value="<?= $family['weekly_rate'];?>" />
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
                mysql_query("INSERT INTO nanny_family SET
                        family_name     = '".$_POST['family_name']."',
                        weekly_rate     = '".$_POST['weekly_rate']."'", $db);

                #header("Location: family.php?op=view&family_id=".$_GET['family_id']);
                header("Location: family.php");
        }

        include("header.php");

?>
        <form method="post">
        <h1>Add New Family</h1><div class="ruleHorizontal"></div><p>

        <div class="formquestion"><label>Family Name (Last Only)</label></div>
        <div class="formanswer">
                <input type="text" name="family_name" alt="Family Name" maxlength="50" value="" />
        </div>

        <BR clear="all" />

        <div class="formquestion"><label>Weekly Rate</label></div>
        <div class="formanswer">
                <input type="text" name="weekly_rate" alt="Weekly Rate" maxlength="50" value="" />
        </div>
        <BR clear="all" />

        <div align="right">
                <input id="button" type="reset" name="reset" value="Reset" />
                <input id="button" type="submit" name="submit" value="Save" />
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
                mysql_query("UPDATE nanny_family SET deleted = '1' WHERE family_id = '".$_GET['family_id']."'");
                header("Location: family.php");
        }

        include("header.php");

        $family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
        <h1>Delete the <?= $family['family_name'];?> Family</h1><div class="ruleHorizontal"></div><p>
        Are you sure you want to delete this family? [<a href="family.php?op=delete&amp;family_id=<?= $_GET['family_id'];?>&amp;confirm=1">Yes</a> | <a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>">No</a>]

        </div>
        <div id="rtColumn" class="cover">

                <h5>Actions</h5>
                <ul>
                        <li><a href="parent.php?op=view&amp;family_id=<?= $_GET['family_id'];?>">Cancel</a></li>
                </ul>

        </div>
<?
}
else
{
	include("header.php");
?>
	<h1>Current Families</h1><div class="ruleHorizontal"></div><p>
	<ul>
<?
	$result = mysql_query("SELECT family_id, family_name, weekly_rate FROM nanny_family WHERE deleted = '0' ORDER BY family_name ASC", $db);

	while($row = mysql_fetch_array($result))
	{
?>
		<li><a href="family.php?op=view&amp;family_id=<?= $row['family_id'];?>">The <?= $row['family_name'];?> Family</a> - $<?= $row['weekly_rate'];?> / week</li>
<?
	}
?>
	</ul>
	</div>

	<!--  Rt Column -->
	<div id="rtColumn" class="cover">

		<h5>Actions</h5>
		<ul>
			<li><a href="family.php?op=add">Add Family</a></li>
		</ul>

	</div>

<?
}

include("footer.php");
?>
