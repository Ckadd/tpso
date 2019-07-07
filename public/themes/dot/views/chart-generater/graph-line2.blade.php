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
    $legands = explode(',',$listgraph[0]['legend']);

    $integercharts=[];
    foreach($data as $key => $val) {
        $integercharts[] = array_map('intval', explode(',', $val));
    }    

// Setup the graph
$graph = new Graph(350,230);
$graph->SetScale("textlin");

$graph->SetMargin(40,20,33,58);

$graph->title->Set('Background Image');
$graph->SetBox(false);

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xaxis->SetTickLabels($ticklabels);
$graph->ygrid->SetFill(false);
// $graph->SetBackgroundImage("tiger_bkg.png",BGIMG_FILLFRAME);

foreach($integercharts as $keyint => $valint) {
    
    $p1 = new LinePlot($valint);
    $graph->Add($p1);
    $p1->SetColor($colors[$keyint] ?? "#6495ED");
    $p1->SetLegend($legands[$keyint] ?? "nolegan");

    if($keyint % 2 == 0){
        $p1->mark->SetType(MARK_UTRIANGLE,'',1.0);
        $p1->mark->SetColor('#aaaaaa');
        $p1->mark->SetFillColor('#aaaaaa');
        $p1->value->SetMargin(50);
        
    }else {
        $p1->mark->SetType(MARK_FILLEDCIRCLE,'',1.0);
        $p1->mark->SetColor('#55bbdd');
        $p1->mark->SetFillColor('#55bbdd');
    }
    $p1->SetCenter();
}

$graph->legend->SetFrameWeight(1);
$graph->legend->SetColor('#4E4E4E','#00A78A');
$graph->legend->SetMarkAbsSize(8);


// Output line
$graph->Stroke();

// destroy the session 
session_destroy(); 
}
 
?>

