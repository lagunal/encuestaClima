<?php
header('Content-Type: text/html; charset=utf-8'); 

$conn = pg_connect("dbname=santp user=santp password=santp1234 host=129.90.60.41 port=5433");
if(!$conn){
	echo "Error al Conectar.\n";
	exit;
}

$ini = "SELECT codigo_norma, tx_ruta, tx_body FROM prueba_santp WHERE tx_ruta like '%/santp/mid/pip/%' ORDER BY tx_ruta";
//$ini = "SELECT codigo_norma, tx_ruta, tx_body FROM prueba_santp WHERE codigo_norma=86098 ORDER BY tx_ruta";
//$ini = "SELECT codigo_norma, tx_ruta, tx_body FROM prueba_santp ORDER BY codigo_norma LIMIT 3000";
//$ini = "SELECT codigo_norma, tx_ruta, tx_body FROM prueba_santp where tx_ruta='http://www.intevep.pdv.com/santp/petygas_old/msds_ingles/gasolinas/regular_unlead_.pdf'";
		
$ret = pg_query($ini);

$filas = pg_num_rows($ret);
$res = array();

$fechas = array('ENE', 'JAN', 'FEB', 'MAR', 'ABR', 'APR', 'MAY', 'JUN', 'JUL', 'AGO', 'AG0', 'AUG', 'SEP', 'OCT', 'NOV', 'DIC', 'DEC');
$c3 = count($fechas);

for($i = 0; $i < $filas; $i++)
	$res[] = pg_fetch_array($ret, $i, PGSQL_ASSOC);

$c = count($res);
$flagFecha = false;
$flagTitulo = false;
$flagRevision = false;
$flagCRP = false;
$codigo = "";
$titulo = "";
$fecha = "";
$revision = "";
$datos = array();

echo "<table border='1'><tr><td>número</td><td>url</td><td>codigo</td><td>titulo</td><td>fecha</td><td>revision</td></tr>";

for($i=0; $i<$c; $i++){
	$codigo = "-";
	$titulo = "-";
	$fecha = "-";
	$revision = "-";
	$indiceFecha = 0;

	$url = $res[$i]["tx_ruta"];
	$archivo = basename($res[$i]["tx_ruta"]);
	$codigo = strtoupper(substr($archivo, 0, strlen($archivo)-4));

	$cont = split("\n", $res[$i]["tx_body"], 400);
	$c2 = count($cont);


	//CASO PIP
	$ini = 0;
	if(strpos($cont[$ini], "TECHNICAL")!==false) $ini++;

	$fecha = explode(" ", $cont[$ini]);
	$fecha = strtoupper(substr($fecha[0], 0, 3) . "." . substr($fecha[1], 2,2));
	$revision = '-';
	$titulo = strtoupper($cont[$ini+4]);
	$datos[] = array("codigo" => $res[$i]["codigo_norma"], "tx_fecha" => "Rev. " . $revision . " / Fecha " . $fecha, "fecha" => $fecha, "revision" => $revision, "tx_codigo" => $codigo, "tx_nombre" => $titulo);

	if($c==1) print_r($cont);
	continue;




	for($k=0; $k<$c2; $k++){

		$posCrp = strpos($cont[$k], "No. CRP:");
		if(!$flagCRP && $posCrp!==false){
			$codigo = trim(substr($cont[$k], $posCrp + 9, 30));
			if($codigo=="") $codigo = $cont[$k+1];
			
			$pos = strpos($codigo, " Inc");
			if($pos!==false){
				$codigo = substr($codigo, 0, $pos);
			}
			
			$codigo = trim($codigo);
			
			$flagCRP = true;
			$k=0;
		}
		
		if($flagCRP){
			$posCrp = strpos($cont[$k], "Producto:");
			
			if($posCrp!==false){
				$titulo = substr($cont[$k], 9);
			}
		}

		if(!$flagFecha && (strpos($cont[$k], "FECHA")!==false || strpos($cont[$k], "DATE")!==false)){
			$pos = strpos($cont[$k], "FECHA");
			if($pos==false) $pos = strpos($cont[$k], "DATE");

			for($j=$k-1; $j<$c2-1 && !$flagFecha; $j++){
				for($l=0; $l<$c3; $l++){
					if(strpos($cont[$j], $fechas[$l])!==false){
						$fecha = substr(str_replace(array("..", " "), array(".", ""), $cont[$j]), 0, 6);
						$flagFecha = true;
						$indiceFecha = $j;
						break;
					}
				}
				
				if($flagFecha){
					$k=0;
					break;
				}
			}
			
			if(!$flagFecha){
				$pos = strpos($cont[$k], "DATE:");
				if($pos===false){
					$pos = strpos($cont[$k], "FECHA:");
				}

				if($pos!==false){
					if(strlen($cont[$k])<=6){
						$fecha = $cont[$k+2];
					}else{
						$fecha = substr($cont[$k], $pos + 6);
					}
					
					$fecha = str_replace(array(" ", ","), array("", "."), $fecha);
					$fecha = explode(".", $fecha);
					$fecha = substr($fecha[0], 0, 3) . "." . substr($fecha[1], 2, 2);
	
					$flagFecha = true;
				}
			}
		}
	}
	
	for($k=0; $k<$c2; $k++){
		if((strpos($cont[$k], "TITLE")!==false || strpos($cont[$k], "TITULO")!==false || strpos($cont[$k], "TíTlO")!==false || strpos($cont[$k], "TÍTULO")!==false)  || strpos($cont[$k], "TíTULO")!==false){
			if(strlen($cont[$k])<=7){
				$titulo = $cont[$k+4];
			}else{
				$titulo = $cont[$k];
			}

			if(!trim($titulo)=="") break;
		}
	}

	if(trim($titulo)=="" || trim($titulo)=="-"){
		for($k=0; $k<$c2; $k++){
			if(strpos($cont[$k], "NOMBRE COMERCIAL:")!==false || strpos($cont[$k], "TRADE NAME:")!==false || strpos($cont[$k], "TRADE NAME:")!==false || strpos($cont[$k], "IDENTIFICACION DEL PRODUCTO")!==false){
				
				$pos = strpos($cont[$k], "TRADE NAME:");
				if($pos===false) $pos = strpos($cont[$k], "NOMBRE COMERCIAL:");

				if($pos!==false){
					$pos = strpos($cont[$k], "NOMBRE COMERCIAL:");
					if($pos!==false){
						if(strlen($cont[$k])<=18){
							$titulo = $cont[$k+2];
						}else{
							$titulo = substr($cont[$k], 17);
						}
					}else{
						if(strlen($cont[$k])<=12 || strpos($cont[$k], "COMPANY NAME")!==false){
							$titulo = $cont[$k+2];
						}else{
							$pos = strpos($cont[$k], "TRADE NAME: SYNONYMS:");
							if($pos===false) $pos = strpos($cont[$k], "TRADE NAME:");
							
							$titulo = substr($cont[$k], $pos + 11);
						}
					}
				}else{

					if(strpos($cont[$k], "IDENTIFICACION DEL PRODUCTO")!==false){
						if(strlen($cont[$k])>27){
							$titulo = substr($cont[$k], 27);
						}else{
							if(strpos($cont[$k], "1. PRODUCTO ")!==false){
								$titulo = $cont[$k-1];
							}else{
								$titulo = $cont[$k-3];
								
								$pos = strrpos($titulo, ".");
								
								$titulo = substr($titulo, $pos + 2);
							}
							
						}
						
					}

					if(strpos($titulo, "GIENE INDUSTRIAL ")===0) $titulo = "";
				}
				
				$titulo = str_replace("IDENTIFICACION DEL PRODUCTO ", "", $titulo);
				
				$pos = strpos($titulo, "CONTACTO ");
				if($pos===false) $pos = strpos($titulo, "COMPANY ");
				if($pos===false) $pos = strpos($titulo, "FECHA");
				if($pos===false) $pos = strpos($titulo, "NOMBRE DE ");
				if($pos===false) $pos = strpos($titulo, "SKIN ");
				if($pos===false) $pos = strpos($titulo, "EYE ");
				if($pos===false) $pos = strpos($titulo, "INHALATION");
				if($pos===false) $pos = strpos($titulo, "SYNONYMS");
				if($pos===false) $pos = strpos($titulo, "SYNONYMS:");
								
				if($pos!==false){
					$titulo = substr($titulo, 0, $pos);
				}
				
				//echo $titulo . "<br>";
				if(trim($titulo)!="") break;
			}
		}
	}

	for($k=0; $k<$c2; $k++){
		if(strpos($cont[$k], "REV.")!==false || strpos($cont[$k], "REVISION")!==false || strpos($cont[$k], "REV. #")!==false || strpos($cont[$k], "Rev.")!==false){
			$pos = strpos($cont[$k], "Rev.");

			if($pos!==false){
				$revision = substr(str_replace(" ", "", substr($cont[$k], $pos + 4)), 0, 1);
			}else{
				
				$posicionRev = strpos($cont[$k], "REV.");
				
				if($posicionRev==0){
					$revision = $cont[$k-1];
				}else{
					$revision = $cont[$k];
				}
	
				if(trim($revision)!=""){
					$flagRevision = true;
					break;
				}
				
			}
		}
	}
		
	if(!$flagRevision){
		for($r=$indiceFecha-2; $r>0; --$r){
			$valor = substr($cont[$r],0,1);
			if(is_numeric($valor)){
				$revision = $valor;
				
				if(trim($titulo)=="" || trim($titulo)=="-"){
					if(strlen($cont[$r-2]) > strlen($cont[$r-3]) && strpos($cont[$r-2], "Indice manual")===false)
						$titulo = $cont[$r-2];
					else
						$titulo = $cont[$r-3];
				}
				
				break;
			}
		}
	}

	if($titulo=="" || $titulo=="-") $titulo = $codigo;

	if(strlen($cont[0])<2 && strlen($cont[1])<2){
		$revision = "-";
		$titulo = "IMAGEN";
		$flagFecha = true;
		$flagTitulo = true;
		$flagRevision = true;
	}
		
		//if($flagFecha && $flagTitulo && $flagRevision) break;
	//}
	
	$revision = substr($revision, 0, 1);
	$fecha = strtoupper(substr($fecha, 0, 13));

	$titulo = substr($titulo, 0, 500);
	if($titulo==$codigo) $titulo = str_replace("_", "-", strtoupper($titulo));

	$codigo = str_replace("_", "-", strtoupper($codigo));
	
	for($ii=0;$ii<2;$ii++){
		$pos = strpos($titulo, "TITULO");
		if($pos===0) $titulo = substr($titulo, 7);
	}
	
	$titulo = strtoupper($titulo);
	
	$datos[] = array("codigo" => $res[$i]["codigo_norma"], "tx_fecha" => "Rev. " . $revision . " / Fecha " . $fecha, "fecha" => $fecha, "revision" => $revision, "tx_codigo" => $codigo, "tx_nombre" => $titulo);
	
	//echo "<tr><td>$i</td><td><a href=$url>$url</a></td><td>$codigo</td><td>$titulo</td><td>$fecha</td><td>$revision</td></tr>";
	
	$flagFecha = false;
	$flagTitulo = false;
	$flagRevision = false;
	$flagCRP = false;
	
	if($c==1) print_r($cont);
}

echo "</table>";

//print_r($datos);

pg_close($conn);


	$conn = pg_connect("dbname=santp user=santp password=santp1234 host=129.90.60.41 port=5433");

	for($i=0; $i<count($datos); $i++){
		$actu="UPDATE prueba_santp SET tx_fecha = '" . $datos[$i]["tx_fecha"] . "', tx_nombre = '" . $datos[$i]["tx_nombre"] . "', tx_codigo='" . $datos [$i]["tx_codigo"] . "', fecha = '" . $datos[$i]["fecha"] . "', revision='" . $datos[$i]["revision"] . "' WHERE codigo_norma=" . $datos[$i]["codigo"];
		echo $actu . "<br>";

		pg_query($actu);
	}

	pg_close($conn);

	
		/*
		if($flagFecha && ($indiceFecha > 11 && $indiceFecha <30) && strpos($res[$i]["tx_body"], "REV.")!==false && $c2>250){
			if(!$flagTitulo && (strpos($cont[$k], "TITLE")!==false || strpos($cont[$k], "TITULO")!==false || strpos($cont[$k], "TÍTULO")!==false)){
				if(strlen($cont[$k])<=7){
					$titulo = $cont[$k+4];
				}else{
					$titulo = $cont[$k];
				}
					
				if($titulo!="TÍTULO"){
					$flagTitulo = true;
				}
			}

			$posicionRev = strpos($cont[$k], "REV.");
			
			if(!$flagRevision &&  $posicionRev!==false){
				if($posicionRev==0)
					$revision = $cont[$k-1];
				else
					$revision = $cont[$k];
					
				$flagRevision = true;
			}
			
		}else{
			
			if($flagFecha){
				for($r=$indiceFecha-2; $r>0; --$r){
					$valor = substr($cont[$r],0,1);
					if(is_numeric($valor)){
						$revision = $valor;
						break;
					}
				}

				if(strlen($cont[$indiceFecha-4])>strlen($cont[$indiceFecha-5])){
					$titulo = $cont[$indiceFecha-4];
				}else{
					$titulo = $cont[$indiceFecha-5];
				}
				
				$flagRevision = true;
			}

			$posTitulo = -1;
			$titulos = array("TITLE", "TITULO", "TÍTULO");
			
			for($l=0; $l<count($tiulos); $l++){
				$pos = strpos($cont[$k], $titulos);

				if($pos!==false){
					$posTitulo = $pos;
				}
			}
			
			if($titulos!==false){
				if(strlen($cont[$k])<=7){
					$titulo = $cont[$k+4];
				}else{
					$titulo = $cont[$k];
				}
				
				if($titulo!="TÍTULO"){
					$flagTitulo = true;
				}
			}

			$flagTitulo = true;
		}
		*/


?>