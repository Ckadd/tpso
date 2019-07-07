<?php
session_start();
?>
<?php include("library/jpgraph-4.2.6/jpgraph.php"); ?>
<?php include("library/jpgraph-4.2.6/jpgraph_line.php"); ?>
<?php

if(isset($_SESSION['data']) && isset($_SESSION['listgraph'])) {
    $data = $_SESSION['data'];
    $listgraph = $_SESSION['listgraph'];
}

if(!empty($data) && !empty($listgraph)) {
    
    $ticklabels = explode(',', $listgraph[0]['ticklabel']);
    $colors = explode(',', $listgraph[0]['color']);
    $fillGradient = explode(',', $listgraph[0]['fill_gradient']);
    
    $integercharts=[];
    foreach($data as $key => $val) {
        $integercharts[] = array_map('intval', explode(',', $val));
    }    
    
// Setup the graph
$graph = new Graph(350,250);
$graph->SetScale("intlin",0,$aYMax=50);

$graph->SetMargin(40,40,50,40);

$graph->title->Set('Inverted Y-axis');
$graph->SetBox(false);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// For background to be gradient, setfill is needed first.
$graph->ygrid->SetFill(true,'#FFFFFF@0.5','#FFFFFF@0.5');
$graph->SetBackgroundGradient('#FFFFFF', '#00FF7F', GRAD_HOR, BGRAD_PLOT);

$graph->xaxis->SetTickLabels($ticklabels);
$graph->xaxis->SetLabelMargin(20);
$graph->yaxis->SetLabelMargin(20);

$graph->SetAxisStyle(AXSTYLE_BOXOUT);
$graph->img->SetAngle(180); 

// Create the line

foreach($integercharts as $keyint => $valint) {
    $p1 = new LinePlot($valint);
    $graph->Add($p1);
    $p1->SetColor($colors[$keyint] ?? "#6495ED");
    $p1->SetFillGradient($fillGradient[$keyint] ?? "#FFFFFF",'#F0F8FF');
}

// Output line
$graph->Stroke();

// destroy the session 
session_destroy(); 
}
 
?>

