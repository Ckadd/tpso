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
    
    $datay=array(62,105,85,50);


    // Create the graph. These two calls are always required
    $graph = new Graph(350,220,'auto');
    $graph->SetScale("textlin");
    
    //$theme_class="DefaultTheme";
    //$graph->SetTheme(new $theme_class());
    
    // set major and minor tick positions manually
    $graph->yaxis->SetTickPositions(array(0,30,60,90,120,150), array(15,45,75,105,135));
    $graph->SetBox(false);
    
    //$graph->ygrid->SetColor('gray');
    $graph->ygrid->SetFill(false);
    $graph->xaxis->SetTickLabels($ticklabels);
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);
    
    // Create the bar plots

    foreach($integercharts as $keyint => $valint) {
        
        $b1plot = new BarPlot($valint);
        
        $graph->Add($b1plot);
        $b1plot->SetColor("white");
        $b1plot->SetFillGradient($colors[$keyint] ?? "#FFFFFF","white",GRAD_LEFT_REFLECTION);
        $b1plot->SetWidth(45);
        // dd($b1plot);
    }
   
    
    // ...and add it to the graPH
    

    
    $graph->title->Set("Bar Gradient(Left reflection)");
    
    // Display the graph
    $graph->Stroke();
// destroy the session 
session_destroy(); 
}
 
?>

