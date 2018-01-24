<?php
header('content-type: text/html; charset: utf-8');
//extract($_REQUEST);

//require_once('../Connections/conex.php'); 
//require_once('../logica/funciones.php'); 
include_once ("../clases/jpgraph/jpgraph.php");
include_once ("../clases/jpgraph/jpgraph_pie.php");
include_once ("../clases/jpgraph/jpgraph_pie3d.php");
include_once "../config.php";
include_once "../clases/clad.php";


	$clad = new clad();
    $conf = new config();
    $numTrabajadoresIntevep = $conf->numTrabajadoresIntevep;	
	
//$query_opciones = "SELECT count(*) cantidad FROM resp_item r where r.id_encuesta = 10 and r.id_titulo = 20 and r.id_item_encuesta = 2 and r.tx_resp_item = 2";

$totalEncuestas = $clad->obtenerTotalEncuestas();


		
//	if ($totalRows_opciones > 0){
	    $data[0] = $totalEncuestas;
		$data[1] = $numTrabajadoresIntevep - $totalEncuestas;
//    }

//mysql_free_result($opciones);

// Create the Pie Graph.
$graph = new PieGraph(450,300,"auto");
$graph->SetShadow();
$graph->img->SetAntiAliasing();

// Set A title for the plot
$graph->title->Set("ENCUESTAS RESPONDIDAS");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Create plots
$size=0.4;

$p1 = new PiePlot3D($data);
//$p1->ExplodeSlice($max);
$p1->SetLegends(array("Total encuestas respondidas","Trabajadores que no respondieron"));
$p1->SetSize($size);
$p1->SetCenter(0.5,0.6);
$p1->value->SetFont(FF_FONT0);
$p1->SetLabelPos(0.2); 

// Explode all slices
$p1->ExplodeAll(); 

//$p2 = new PiePlot3D($arreglocons);
//$p2->ExplodeSlice($maxc);
//$p2->SetSize($size);
//$p2->SetCenter(0.2,0.6);
//$p2->value->SetFont(FF_FONT0);
//$p2->title->Set("Consolidado");    

/*
$p3 = new PiePlot3D($data);
$p3->SetSize($size);
$p3->SetCenter(0.25,0.75);
$p3->value->SetFont(FF_FONT0);
$p3->title->Set("2003");

$p4 = new PiePlot3D($data);
$p4->SetSize($size);
$p4->SetCenter(0.65,0.75);
$p4->value->SetFont(FF_FONT0);
$p4->title->Set("2004");
*/

//$graph->Add($p2);
$graph->Add($p1);
//$graph->Add($p3);
//$graph->Add($p4);

$graph->Stroke();


?>
