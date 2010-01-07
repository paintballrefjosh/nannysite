<?

include("config.php");
include("include/functions.php");

//view

include("header.php");
$child = mysql_fetch_array(mysql_query("SELECT * FROM nanny_child WHERE child_id = '".$_GET['child_id']."'"));
$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$_GET['family_id']."'"));
?>
<form method="post" name="child_form">
<h1>Weekly Schedule</h1><div class="ruleHorizontal"></div><p>

<img src="http://<?= $_SERVER['HTTP_HOST'];?>/nanny/graph_schedule.php?day=monday" />

<img src="http://<?= $_SERVER['HTTP_HOST'];?>/nanny/graph_schedule.php?day=tuesday" />

<img src="http://<?= $_SERVER['HTTP_HOST'];?>/nanny/graph_schedule.php?day=wednesday" />

<img src="http://<?= $_SERVER['HTTP_HOST'];?>/nanny/graph_schedule.php?day=thursday" />

<img src="http://<?= $_SERVER['HTTP_HOST'];?>/nanny/graph_schedule.php?day=friday" />

<img src="http://<?= $_SERVER['HTTP_HOST'];?>/nanny/graph_schedule.php?day=saturday" />

<img src="http://<?= $_SERVER['HTTP_HOST'];?>/nanny/graph_schedule.php?day=sunday" />

<!--  Rt Column -->
</div><div id="rtColumn" class="cover">
	<h5>Actions</h5>
	<ul>
		<li><a href="child.php?op=edit&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>">Edit Child</a></li>
		<li><a href="family.php?op=view&amp;family_id=<?= $_GET['family_id'];?>">Back to Family</a></li>
	</ul>
</div>

</form>
<?

include("footer.php");
?>
