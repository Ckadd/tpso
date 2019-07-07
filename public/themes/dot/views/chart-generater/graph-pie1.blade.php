<?php
session_start();
?>
<?php include("library/jpgraph-4.2.6/jpgraph.php"); ?>
<?php include("library/jpgraph-4.2.6/jpgraph_pie.php"); ?>
<?php

if(isset($_SESSION['data']) && isset($_SESSION['listgraph'])) {
    $data = $_SESSION['data'];
    $listgraph = $_SESSION['listgraph'];
}

if(!empty($data) && !empty($listgraph)) {
    
    $ticklabels = explode(',', $listgraph[0]['ticklabel']);
    $colors = explode(',', $listgraph[0]['color']);
    if(!empty($listgraph[0]['legend'])){
        $legends = explode(',', $listgraph[0]['legend']);
    }else{
        $legends = [];
    }
    
    $integercharts=[];
    foreach($data as $key => $val) {
        $integercharts[] = array_map('intval', explode(',', $val));
    }    
    

// Create the graph. These two calls are always required
$data = array(40,21,17,14,23);

// Create the Pie Graph. 
$graph = new PieGraph(350,250);

$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// Set A title for the plot
$graph->title->Set("");
$graph->SetBox(true);

// Create
foreach($integercharts as $keyint => $valint) {
    $p1 = new PiePlot($valint);
    $graph->Add($p1);
    $p1->ShowBorder();
    $p1->SetColor('black');
    $p1->SetSliceColors($colors ?? "#1E90FF");
}
if(!empty($legends)){
    $p1->SetLegends($legends);
}else{
    $p1->SetLegends(array(''));
}

$graph->legend->SetPos(0.5,0.97,'center','bottom');
$graph->legend->SetColumns(3);
$graph->Stroke();

// destroy the session 
session_destroy(); 
}
 
?>

