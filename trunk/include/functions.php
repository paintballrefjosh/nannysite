<?

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
