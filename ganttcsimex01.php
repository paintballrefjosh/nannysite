<? 
require_once ("jpgraph/jpgraph.php");
require_once ("jpgraph/jpgraph_gantt.php");
 
// Some sample Gantt data
$data = array(
    array(0, " Bryce", "2009-08-28 11:00","2009-08-28 15:30"),
    array(1, " Kyla", "2009-08-28 08:00","2009-08-28 15:30"),
    array(2, " Nathan", "2009-08-28 08:00","2009-08-28 17:00")
);

// Basic graph parameters
$graph = new GanttGraph();
$graph->SetMarginColor('darkgreen@0.8');
$graph->SetColor('white');
$graph->title->Set("The Scarbrough's Nanny Schedule");
$graph->title->SetColor('darkgray');

// We want to display day, hour and minute scales
#$graph->ShowHeaders(GANTT_HDAY | GANTT_HHOUR);
$graph->ShowHeaders(GANTT_HHOUR);

// Setup day format
$graph->scale->day->SetBackgroundColor('lightyellow:1.5');
$graph->scale->day->SetStyle(DAYSTYLE_SHORTDAYDATE1);
$graph->scale->day->SetFont(FF_FONT1,FS_NORMAL,16);

// Setup hour format
$graph->scale->hour->SetIntervall(1);
$graph->scale->hour->SetBackgroundColor('lightyellow:1.5');
$graph->scale->hour->SetStyle(HOURSTYLE_HAMPM);
$graph->scale->hour->grid->SetColor('gray:0.8');
$graph->scale->hour->SetFont(FF_FONT1,FS_NORMAL,13);

for($i = 0; $i < count($data); ++$i)
{
    $bar = new GanttBar($data[$i][0],$data[$i][1],$data[$i][2],$data[$i][3]);
    $bar->SetPattern(BAND_RDIAG,"yellow");
    $bar->SetFillColor("gray");
    $graph->Add($bar);
}

// Draw graph
$graph->Stroke();

?>
