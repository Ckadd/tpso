<?php
session_start();
?>
<?php include("library/jpgraph-4.2.6/jpgraph.php"); ?>
<?php include("library/jpgraph-4.2.6/jpgraph_bar.php"); ?>
<?php

if(isset($_SESSION['data']) && isset($_SESSION['listgraph'])) {
    $data = $_SESSION['data'];
    $listgraph = $_SESSION['listgraph'];
}

if(!empty($data) && !empty($listgraph)) {
    
    $ticklabels = explode(',', $listgraph[0]['ticklabel']);
    $colors = explode(',', $listgraph[0]['color']);
    
    $integercharts=[];
    foreach($data as $key => $val) {
        $integercharts[] = array_map('intval', explode(',', $val));
    }   
    $sortData = $integercharts[0];
    
    rsort($sortData);
    $persen = ($sortData[0] / 10);
    $tickPosition = range(0,$sortData[0],$persen);
    
    $removeFirstTickPosition = $tickPosition;
    array_shift($removeFirstTickPosition);
    $halfTickPosition = [];
    
    foreach($removeFirstTickPosition as $keyremove => $valremove) {
        $wanting = $removeFirstTickPosition[0] / 2;
        $halfTickPosition[] = $valremove - $wanting;
        
    }
    
// Create the graph. These two calls are always required
$graph = new Graph(1400,950,'auto');
$graph->SetScale("textlin");

$graph->yaxis->SetTickPositions($tickPosition, $halfTickPosition);
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($ticklabels);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
$graph->xaxis->SetLabelAngle(90);

// Create the bar plots
$databar = [];
foreach($integercharts as $keyint => $valint) {
    $databar[] = new BarPlot($valint);
    
    $databar[$keyint]->SetColor("white");
    $databar[$keyint]->SetFillColor($colors[$keyint] ?? "#FFFFFF");
}

// Create the grouped bar plot
$gbplot = new GroupBarPlot($databar);

// ...and add it to the graPH
$graph->Add($gbplot);

$graph->title->Set("Bar Plots");

// Display the graph
$graph->Stroke();

// destroy the session 
session_destroy(); 
}
 
?>

