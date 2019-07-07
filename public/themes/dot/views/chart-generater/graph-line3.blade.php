<?php
session_start();
?>
<?php include("library/jpgraph-4.2.6/jpgraph.php"); ?>
<?php include("library/jpgraph-4.2.6/jpgraph_line.php"); ?>
<?php require_once('library/jpgraph-4.2.6/jpgraph_scatter.php'); ?>
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


    
    // Setup the graph
    $graph = new Graph(300,250);
    
    $graph->SetMargin(40,20,36,62.5);
    
    $graph->SetScale("textlin",0,50);
    
    $graph->title->Set("Filled Area");
    
    $graph->SetBox(false);
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);
    $graph->yaxis->HideZeroLabel();
    
    $graph->xaxis->SetTickLabels($ticklabels);
    
    foreach($integercharts as $keyint => $valint) {
        $p1 = new LinePlot($valint);
        $graph->Add($p1);
        $p1->SetColor($colors[$keyint] ?? "#6495ED");
        
    }

    // Create the plot
    
    
    // **** !!!! ****
    // Use an image of favourite car as marker
    // $p1->mark->SetType(MARK_IMG,'rose.gif',1.0);
    // $p1->SetLegend('rose');
    
    
    // $p2->mark->SetType(MARK_IMG,'sunflower.gif',1.0);
    // $p2->SetLegend('sunflower');
   
    
    $graph->Stroke();

// destroy the session 
session_destroy(); 
}
 
?>

