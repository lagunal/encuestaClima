<?php
	header('Content-Type: text/html; charset=utf-8'); 

	$archivo = "pdf-santp.txt";
	$file = fopen($archivo, "r");
	
	$datos = fread($file, filesize($archivo));
	
	$datos = split("\n", $datos);
	
	$fs = fopen("salida2.txt", "w+");
	
	$conn = pg_connect("dbname=santp user=santp password=santp1234 host=129.90.60.41 port=5433");
	if(!$conn){
		echo "Error al Conectar.\n";
		exit;
	}

	//$datos = array("http://www.intevep.pdv.com/santp/petygas_old/msds_espanol/asfaltos/asfalto_ind_roofer_flux.pdf");
	
	$c = count($datos);
	
	for($i=0; $i<$c; $i++){
		$cargado = false;
		$ruta = $datos[$i];
		$archivo = basename($ruta);

		echo "$ruta \n";
		
		$cmd= "wget -q $ruta && /usr/bin/pdftotext '$archivo' -enc UTF-8 - && rm $archivo";
		$salida = shell_exec("$cmd");
		$salida = pg_escape_string ($salida);
		
		//sleep(2);
		//$contenido = split("\n", $salida,50);
		//$filas = count($contenido);
	
		$fecha = "";
		$revision = "";
		$codigo = "";
		$titulo = "";
		
		/*
		if($filas>40){
			$fec = $contenido[15];
			if($fec=="" || $fec=="FECHA" || $fec=="DATE") $fec = $contenido[14];
			if($fec=="REV.") $fec = $contenido[17];
			
			$fec = str_replace(" ", "", $fec);

			$fecha = "Fecha " . substr($fec, 0, 6);
			$revision = trim(substr($contenido[12], 0, 2));

			if(!is_numeric($revision)){
				if(is_numeric(str_replace(" ", "", $contenido[14]))){
					$revision = substr($contenido[14], 0, 2);
				}else{
					if(is_numeric(str_replace(" ", "", $contenido[11]))){
						$revision = substr($contenido[11], 0, 2);
					}else{
						$revision = substr($contenido[13], 0, 2);
					}
				}
			}
			
			$revision = "Rev. $revision";

			if($contenido[8]=="TITULO"){
				$codigo = $contenido[10];
				$titulo = $contenido[12];
			}else{
				if(stripos($contenido[8], "–")>0 || stripos($contenido[8], "-")>0 ||  strlen($contenido[8]) < strlen($contenido[10])){
					$codigo = $contenido[8];
					$titulo = $contenido[10];
				}else{
					if($contenido[8]==""){
						if(stripos($contenido[7], "–")>0 || stripos($contenido[7], "-")>0){
							$codigo = $contenido[7];
							$titulo = $contenido[9];
						}else{
							$codigo = $contenido[9];
							$titulo = $contenido[11];
						}
					}else{
						if(stripos($contenido[8], "–")>0){
							$codigo = $contenido[8];
							$titulo = $contenido[10];
						}else{
							if(stripos($contenido[10], "–")>0){
								$codigo = $contenido[10];
							}else{
								$codigo = $contenido[6];
							}
							$titulo = $contenido[8];
						}
					}
				}
			}
			
			if($codigo=="" || $titulo==""){
				$fecha = "";
				$revision = "";
				$nombre = substr($contenido[6], 28);
				$codigo = $nombre;
				$titulo = $nombre;
			}
			
			$cargado = true;
		}

		//fwrite($fs, $str)
		$resultado = "";

		if(!$cargado || $codigo==""){
			$revision = "";
			$fecha = "";
			$codigo = "NO CARGADO";
			$titulo = $contenido[6];
			//$salida = "";
		}

		if(strlen($codigo)>40 || strlen($titulo)>500){
			$codigo = "NO CARGADO DESBORDADO";
			$titulo = "";
		}
*/

	/*
		print_r($contenido);
	
		echo "fec $fecha" . "\n";
		echo "rev $revision" . "\n";
		echo "cod $codigo" . "\n";
		echo "tit $titulo" . "\n\n\n";
	*/
	
	
		//$ini = "Insert Into prueba_santp Values('$ruta', '$revision / $fecha', '$codigo', '$titulo', '$salida')";
		$ini = "Insert Into prueba_santp Values('$ruta', '', '', '', '$salida')";
		pg_query($ini);
			
		$actu="UPDATE prueba_santp SET prue_col_idx = setweight (to_tsvector(coalesce(tx_nombre, '')),'A') ||
				setweight (to_tsvector(coalesce(tx_body, '')),'B') WHERE tx_ruta='$ruta';";
		pg_query($actu);

	}

	pg_close($conn);
	
	fclose($fs);
	fclose($file);
?>