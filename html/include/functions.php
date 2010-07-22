<?

function draw_graph($child_id = 0, $family_id = 0)
{
	for($x = -7; $x < 7; $x++)
	{
		$time = ($x * 60 * 60 * 24) + time();
?>
		<img src="include/draw_graph.php?time=<?= $time;?>&child_id=<?= $child_id;?>&family_id=<?= $family_id;?>">
<?

	}

}

function draw_calendar($child_id = 0, $family_id = 0)
{
	if($child_id != 0)
	{
		$sql = "SELECT * FROM nanny_schedule WHERE child_id = '".$_GET['child_id']."' AND";
	}
	elseif($family_id != 0)
	{
		$sql = "SELECT * FROM nanny_schedule WHERE (";

		$result = mysql_query("SELECT child_id FROM nanny_child WHERE family_id = '".$family_id."'");
		while($child = mysql_fetch_array($result))
		{
			$sql .= "child_id = '".$child['child_id']."' OR ";
		}
		
		$sql = substr($sql, 0, -4);
		$sql .= ") AND";

	}
	else
	{
		// show all schedules on one graph
		$sql = "SELECT * FROM nanny_schedule WHERE";
	}

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
                        <th><a href="<?= $_SERVER['PHP_SELF'];?>?op=view&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>&amp;time=<?= $prev_time;?>"><<</a></th>
                        <th colspan="5"><?= date('M', mktime(0,0,0,$month,1,$year)).' '.$year; ?></th>
                        <th><a href="<?= $_SERVER['PHP_SELF'];?>?op=view&amp;family_id=<?= $_GET['family_id'];?>&amp;child_id=<?= $_GET['child_id'];?>&amp;time=<?= $next_time;?>">>></a></th>
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

                if($cal_day == date('j', time()) && $month == date('n', time()) && $year = date('Y', time()))
                        $today = "bgcolor=\"lightgreen\"";

                $result = mysql_query($sql . " start_time > '".mktime(0,0,0,$month,$cal_day,$year)."' AND start_time < '".mktime(0,0,0,$month,$cal_day+1,$year)."'");
                while($schedule = mysql_fetch_array($result))
                {
                        $isdata = true;

                        $child = mysql_fetch_array(mysql_query("SELECT first_name FROM nanny_child WHERE child_id = '".$schedule['child_id']."'"));
                        $data[$x] = "<div style='float: top left; font-size: 9px;'>".$child['first_name']." ".date("G:i", $schedule['start_time'])." - ".date("G:i", $schedule['end_time'])."</div>";
                }

                if($cal_day > 0)
		{
			$data_out = "<div id=calendar_date>".$cal_day."</div>";
		}

                if($isdata || ($data[$x] != $cal_day))
                {
                        $data_out .= $data[$x];
                }

?>

<!-- popup menu on right click <td height="80" align="left" valign="top" onContextMenu="Tip('Test!', FOLLOWMOUSE, false); return false;" onClick="UnTip();" <?= $today;?>><?= $data_out;?></td> -->
		<td height="80" align="left" valign="top" <?= $today;?>><?= $data_out;?></td>

<?

                if($x % 7 == 0)
                {
                        echo "</tr><tr>";
                }
        }

        ?>

        </tr></table>

<?	

}



//new function

$to = "paintballrefjosh@gmail.com";
$nameto = "Who To";
$from = "josh@moahosting.com";
$namefrom = "Who From";
$subject = "Hello World Again!";
$message = "World, Hello!";
// echo authSendEmail($from, $namefrom, $to, $nameto, $subject, $message);


/* * * * * * * * * * * * * * SEND EMAIL FUNCTIONS * * * * * * * * * * * * * */

//Authenticate Send - 21st March 2005
//This will send an email using auth smtp and output a log array
//logArray - connection,

function authSendEmail($from, $namefrom, $to, $nameto, $subject, $message)
{
	//SMTP + SERVER DETAILS
	/* * * * CONFIGURATION START * * * */
	$smtpServer = "fmailhost.isp.att.net";
	$port = "465";
	$timeout = "30";
	$username = "josh@moahosting.com";
	$password = "sxwfksre";
	$localhost = "moahosting.com";
	$newLine = "\r\n";
	/* * * * CONFIGURATION END * * * * */
	
	//Connect to the host on the specified port
	$smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
	echo "C	onnected successfully";
	$smtpResponse = fgets($smtpConnect, 515);
	if(empty($smtpConnect))
	{
	$output = "Failed to connect: $smtpResponse";
	return $output;
	}
	else
	{
	$logArray['connection'] = "Connected: $smtpResponse";
	}
	
	//Request Auth Login
	fputs($smtpConnect,"AUTH LOGIN" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$logArray['authrequest'] = "$smtpResponse";
	
	//Send username
	fputs($smtpConnect, base64_encode($username) . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$logArray['authusername'] = "$smtpResponse";
	
	//Send password
	fputs($smtpConnect, base64_encode($password) . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$logArray['authpassword'] = "$smtpResponse";
	
	//Say Hello to SMTP
	fputs($smtpConnect, "HELO $localhost" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$logArray['heloresponse'] = "$smtpResponse";
	
	//Email From
	fputs($smtpConnect, "MAIL FROM: $from" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$logArray['mailfromresponse'] = "$smtpResponse";
	
	//Email To
	fputs($smtpConnect, "RCPT TO: $to" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$logArray['mailtoresponse'] = "$smtpResponse";
	
	//The Email
	fputs($smtpConnect, "DATA" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$logArray['data1response'] = "$smtpResponse";
	
	//Construct Headers
	$headers = "MIME-Version: 1.0" . $newLine;
	$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;
	$headers .= "To: $nameto <$to>" . $newLine;
	$headers .= "From: $namefrom <$from>" . $newLine;
	
	fputs($smtpConnect, "To: $to\nFrom: $from\nSubject: $subject\n$headers\n\n$message\n.\n");
	$smtpResponse = fgets($smtpConnect, 515);
	$logArray['data2response'] = "$smtpResponse";
	
	// Say Bye to SMTP
	fputs($smtpConnect,"QUIT" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$logArray['quitresponse'] = "$smtpResponse";
}

function do_error($sql = "", $db = "")
{
	$msg = "An error has occured on the site. See details below for debugging.\n";
	$msg .= "Client IP: ".$_SERVER['REMOTE_ADDR']."\n";

	if($sql != "")
	{
		$msg .= "SQL: $sql\nMySQL Error #".mysql_errno($db).": ".mysql_error($db)."\n";
	}

	$get_data = "?";
	foreach($_GET as $key => $val)
	{
		$get_data .= "$key=$val&";
	}

	$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$get_data;

	$msg .= "URL: $url\n";
	$msg .= "POST data: $post_data\n";
	
	$headers = "From: support@moahosting.com\n";

	mail("paintballrefjosh@gmail.com", "Error on the Nanny Site!", $msg, $headers);
}
/*
function generate_date($day)
{
	switch($day)
	{
		case "monday" : return "2009-08-24";
		case "tuesday" : return "2009-08-25";
		case "wednesday" : return "2009-08-26";
		case "thursday" : return "2009-08-27";
		case "friday" : return "2009-08-28";
		case "saturday" : return "2009-08-29";
		case "sunday" : return "2009-08-30";
	}
}
*/
function graph_schedule($data, $title, $show_day)
{
	require_once("jpgraph.php");
	require_once("jpgraph_gantt.php");

	// Some sample Gantt data
/*
	$data = array(
		array(0, " Bryce", "2009-08-28 11:00","2009-08-28 15:30"),
		array(1, " Kyla", "2009-08-28 08:00","2009-08-28 15:30"),
		array(2, " Nathan", "2009-08-28 08:00","2009-08-28 17:00")
	);
*/
	
	// Basic graph parameters
	$graph = new GanttGraph(700);
	$graph->SetMarginColor('darkgreen@0.8');
	$graph->SetColor('white');
	$graph->title->Set("$title's Schedule");
	$graph->title->SetColor('darkgray');

	// We want to display day, hour and minute scales
	if($show_day)
		$graph->ShowHeaders(GANTT_HDAY | GANTT_HHOUR);
	else
		$graph->ShowHeaders(GANTT_HHOUR);

	#$graph->ShowHeaders(GANTT_HDAY | GANTT_HHOUR);
	#$graph->ShowHeaders(GANTT_HHOUR);
	
	// Setup day format
	$graph->scale->day->SetBackgroundColor('lightyellow:1.5');
	$graph->scale->day->SetStyle(DAYSTYLE_LONG);
	$graph->scale->day->SetFont(FF_FONT1,FS_NORMAL,16);
	
	// Setup hour format
	$graph->scale->hour->SetIntervall(1);
	$graph->scale->hour->SetBackgroundColor('lightyellow:1.5');
	$graph->scale->hour->SetStyle(HOURSTYLE_HAMPM);
	$graph->scale->hour->grid->SetColor('gray:0.8');
	$graph->scale->hour->SetFont(FF_FONT1,FS_NORMAL,13);

	for($i = 0; $i < count($data); ++$i)
	{
		$bar = new GanttBar($data[$i][0],$data[$i][1],$data[$i][2],$data[$i][3],$data[$i][4]);
		$bar->SetPattern(BAND_RDIAG,"yellow");
		$bar->SetFillColor("gray");
		$graph->Add($bar);
	}

	// Draw graph
	$graph->Stroke();
}
