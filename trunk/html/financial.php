<?
include("config.php");

if($_GET['op'] == "payment")
{
	if(isset($_POST['submit']))
	{
		$payment_date = explode("-", $_POST['payment_date']);

		mysql_query("INSERT INTO nanny_payment SET 
                        family_id	= '".$_POST['family_id']."',
                        payment_date	= '".mktime(0,0,0,$payment_date[1],$payment_date[2],$payment_date[0])."',
                        amount		= '".$_POST['amount']."',
                        method		= '".$_POST['method']."',
                        notes		= '".$_POST['notes']."'", $db);

		header("Location: financial.php?op=view");
	}

	include("header.php");
	$result = mysql_query("SELECT family_id,family_name FROM nanny_family WHERE deleted = '0'");
?>
	<form method="post" name="child_form">
	<h1>Child Info</h1><div class="ruleHorizontal"></div><p>

	<div class="formquestion"><label>Family</label></div>
	<div class="formanswer">
		<select name="family_id" alt="Family">
<?
		while($family = mysql_fetch_array($result))
		{
?>
			<option value="<?= $family['family_id'];?>">The <?= $family['family_name'];?> Family</option>
<?
		}
?>
		</select>
	</div>
	
	<div class="formquestion"><label>Payment Date</label></div>
	<div class="formanswer">
		<input id="payment_date" name="payment_date" value="<?= date("Y-m-d");?>" />
		[<a href="javascript:void(0);" id="payment_date_btn">Select Date</a>]
		<!--<button id="f_clearRangeStart" onclick="clearRangeStart()">clear</button>-->
		<script type="text/javascript">
			var cal = Calendar.setup({onSelect: function(cal) { cal.hide() }});
			cal.manageFields("payment_date_btn", "payment_date", "%Y-%m-%d");
		</script>

	</div>
	<br clear="all" />

	<div class="formquestion"><label>Amount Paid</label></div>
	<div class="formanswer">
		<input type="text" name="amount" alt="Amount Paid" maxlength="50" />
	</div>
	<br clear="all" />
	
        <div class="formquestion"><label>Payment Method</label></div>
        <div class="formanswer">
                <select name="method" alt="Payment Method" maxlength="50">
			<option value="check">Check</option>
			<option value="cash">Cash</option>
		</select>
        </div>
        <br clear="all" />

        <div class="formquestion"><label>Additional Notes</label></div>
        <div class="formanswer">
                <input type="text" name="notes" alt="Additional Notes" maxlength="50" />
        </div>
        <br clear="all" />

	<div align="right">
		<input id="button" type="reset" name="reset" value="Reset"> 
		<input id="button" type="submit" name="submit" value="Add Payment">
	</div>

	<!--  Rt Column -->
	</div><div id="rtColumn" class="cover">
		<h5>Actions</h5>
		<ul>
			<li><a href="financial.php?op=view">Back to Financial</a></li>
		</ul>
	</div>

	</form>
<?
}
elseif($_GET['op'] == "delete")
{
	mysql_query("DELETE FROM nanny_payment WHERE payment_id = '".$_GET['payment_id']."'");
	header("Location: financial.php?op=view&view_days=".$_GET['view_days']);

}
else
{
	include("header.php");

?>
        <h1>
		Payments for the previous 
		<select onChange="location.href='financial.php?op=view&view_days='+(this.value);">
			<option value="7" <? if($_GET['view_days'] == 7) echo 'selected="selected"';?>>7 days</option>
			<option value="30" <? if($_GET['view_days'] == 30) echo 'selected="selected"';?>>30 days</option>
			<option value="90" <? if($_GET['view_days'] == 90) echo 'selected="selected"';?>>90 days</option>
			<option value="3650" <? if($_GET['view_days'] == "3650") echo 'selected="selected"';?>>All Payments</option>
		</select>

	</h1>
	<div class="ruleHorizontal"></div><p>
	<ul>

<?
	if(!$_GET['view_days'])
	{
		$_GET['view_days'] = 7;
	}

	$result = mysql_query("SELECT * FROM nanny_payment WHERE payment_date > '".(time() - $_GET['view_days']*24*60*60)."'");
	while($payment = mysql_fetch_array($result))
	{
		$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$payment['family_id']."'"));
?>
		<li><?= date("l F jS", $payment['payment_date']);?> - The <?= $family['family_name'];?> Family - $<?= $payment['amount'];?> [<a href="financial.php?op=delete&amp;payment_id=<?= $payment['payment_id'];?>&amp;view_days=<?= $_GET['view_days'];?>">Delete</a>]</li>
<?		
	}
?>

	<!--  Rt Column -->
	</div><div id="rtColumn" class="cover">
		<h5>Actions</h5>
		<ul>
			<li><a href="financial.php?op=payment">Add Payment</a></li>
			<li><a href="financial.php?op=view&amp;by=family">View by Family</a></li>
			<li><a href="financial.php?op=view&amp;by=calendar">View by Calendar</a></li>
		</ul>
	</div>
<?
}
include("footer.php");
?>
