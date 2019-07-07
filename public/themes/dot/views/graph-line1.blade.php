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
    // dd($listgraph);
    
    $valueData  = [];
    $integerIDs = [];
    $ticklabels = explode(',', $listgraph[0]['ticklabel']);
    
    $colors = explode(',', $listgraph[0]['color']);
    
    foreach($data as $key => $val) {
        $integerIDs[] = array_map('intval', explode(',', $val));
    }
    foreach($integerIDs as $keyint => $valint) {
        array_push($valueData,$valint);
    }

// Setup the graph
$graph = new Graph(300,250);
$graph->SetScale("textlin");

// $theme_class=new UniversalTheme;

// $graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Filled Y-grid');
$graph->SetBox(false);

$graph->SetMargin(40,20,36,63);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($ticklabels);
$graph->xgrid->SetColor('#E3E3E3');



// Create the first line
foreach($integerIDs as $keyint => $valint) {
    
    $p1 = new LinePlot($valint);
    $graph->Add($p1);
    $p1->SetColor($colors[$keyint] ?? "#6495ED");
    $p1->SetLegend('Line '.($keyint+1));
}


$graph->legend->SetFrameWeight(1);

// Output line
$graph->Stroke();

// destroy the session 
session_destroy(); 

}

 
?>

