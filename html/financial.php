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
		<input id="payment_date" name="payment_date" />
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
else
{
	include("header.php");

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
			<th><a href="financial.php?op=view&amp;time=<?= $prev_time;?>"><<</a></th>
			<th colspan="5"><?= date('M', mktime(0,0,0,$month,1,$year)).' '.$year; ?></th>
			<th><a href="financial.php?op=view&amp;time=<?= $next_time;?>">>></a></th>
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
	
		if($data[$x] == $day && $_GET['time'] == time())
			$today = "bgcolor=\"lightgreen\"";

		$result = mysql_query("SELECT * FROM nanny_payment WHERE payment_date = '".mktime(0,0,0,$month,$data[$x],$year)."'");
		while($payment = mysql_fetch_array($result))
		{
			$family = mysql_fetch_array(mysql_query("SELECT family_name FROM nanny_family WHERE family_id = '".$payment['family_id']."'"));
			$data[$x] .= "<div style='font-size: 9px;'>".$family['family_name']."($".round($payment['amount']).")</div>";
		}
	
		echo "<td height=\"70\" align=\"left\" valign=\"top\" $today>".$data[$x]."</td>\n";
		
		if($x % 7 == 0)
		{
			echo "</tr><tr>";
		}
	}
	
	?>
	
	</tr></table>
	
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
