<?php
session_start();
?>
<?php include("library/jpgraph-4.2.6/jpgraph.php"); ?>
<?php include("library/jpgraph-4.2.6/jpgraph_pie.php"); ?>
<?php include("library/jpgraph-4.2.6/jpgraph_pie3d.php"); ?>
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
    
// Create the Pie Graph. 
$graph = new PieGraph(350,250);

// Set A title for the plot
$graph->title->Set("A Simple 3D Pie Plot");

// Create
foreach($integercharts as $keyint => $valint) {
    $p1 = new PiePlot3D($valint);
    $graph->Add($p1);
    $p1->ShowBorder();
    $p1->SetColor('black');
    $p1->ExplodeSlice(1);
}


$graph->Stroke();

// destroy the session 
session_destroy(); 
}
 
?>

