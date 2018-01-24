<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../styles/pdvsastyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
	include_once "../config.php";
	
	$config = new config();
	
	// -------------------------------------- cadena de conexion ------------------------------------ //
	// Conexion, seleccion de base de datos
	$conn = pg_connect($config->queryString);
	  if (!$conn) {
	    echo "Error al Conectar.\n";
	    exit;
	  }
	 
	// -------------------------------------- Recupero la información del formulario ------------------------------------//
	$nombre=$_POST['nomb'];
	$ruta=$_POST['ruta'];
	$mes=$_POST['mes'];
	$year=$_POST['year'];
	$revision=$_POST['revi'];
	$codigo=$_POST['codi'];
	$archivo_name=$_POST['archivo_name'];
	$fechaS = $mes . "." . substr($year, 2, 2);
	$fechaS = strtoupper($fechaS);
	$fecha="Rev. "."$revision"." / "."Fecha "."$mes. ". substr($year, 2, 2);
	$ruta_archivo="http://www.intevep.pdv.com/santp/"."$ruta";
	//-------------------------------------------------------------------------------------------------------------------// 

	$archivo = basename($ruta_archivo);
	
	// ------ Transformo de .pdf a .txt ------------------------------//
	//$cmd= "/usr/bin/pdftotext 'document/$cont[$i]' -enc UTF-8 -"; //transformo el archivo a .txt
	
	$cmd= "wget -q $ruta && /usr/bin/pdftotext '$archivo' -enc UTF-8 - && rm $archivo";
	$salida = shell_exec("$cmd");
	$salida = pg_escape_string ($salida);

	// ---------------------------Guardo en base de datos------------------------------------ //

	$ini = "INSERT INTO prueba_santp (tx_ruta, tx_fecha, tx_codigo, tx_nombre, tx_body, fecha, revision) 
			VALUES ('$ruta', '$fecha', '$codigo', '$nombre', '$salida', '$fechaS', '$revision')";
	pg_query($ini);
		
	$actu="UPDATE prueba_santp SET prue_col_idx = setweight (to_tsvector(coalesce(tx_nombre, '')),'A') ||
			setweight (to_tsvector(coalesce(tx_body, '')),'B') WHERE tx_ruta='$ruta';";
	pg_query($actu);
	
	echo  "<script>alert('La Carga se realizo satisfactoriamente.');</script>";
	echo "<script>document.location.href='../paginas/actualizacionIndexado.php';</script>";

?>
</body>
</html>