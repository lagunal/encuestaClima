<?php
header('content-type: text/html; charset: utf-8');
//extract($_REQUEST);

include_once ("../clases/jpgraph/jpgraph.php");
include_once ("../clases/jpgraph/jpgraph_pie.php");
include_once ("../clases/jpgraph/jpgraph_pie3d.php");
include_once "../config.php";
include_once "../clases/clad.php";


	$clad = new clad();
    $conf = new config();
    //$numTrabajadoresIntevep = $conf->numTrabajadoresIntevep;	
	
$totalEncuestas = $clad->obtenerTotalEncuestas();

$datosPorOrganizacion = $clad->obtenerPorOrganizacion();

print_r ($datosPorOrganizacion[count]);		

//	if ($totalRows_opciones > 0){
	    $data = $datosPorOrganizacion[count"];
		//$data[1] = $datosPorOrganizacion[1];
//    }


// Create the Pie Graph.
$graph = new PieGraph(450,300,"auto");
$graph->SetShadow();
$graph->img->SetAntiAliasing();
//$theme_class= new VividTheme;
//$graph->SetTheme($theme_class);

// Set A title for the plot
$graph->title->Set("ENCUESTAS POR ORGANIZACION");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Create plots
$size=0.4;
$p1 = new PiePlot3D($data);
//$p1->ExplodeSlice($max);
//$p1->SetLegends(array($data["tx_organizacion"]));
$p1->SetSize($size);
$p1->SetCenter(0.5,0.6);
$p1->SetColor('black');
$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));
//$p1->SetSliceColors(array('#1E90FF','#DC143C','#BA55D3'));
$p1->value->SetFont(FF_FONT0);
//$p1->SetValueType(PIE_LABEL_ABS);
//$p1->SetLabelType(PIE_LABEL_ABS);

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
//$graph->Stroke();
//$graph->Add($p3);
//$graph->Add($p4);




?>
