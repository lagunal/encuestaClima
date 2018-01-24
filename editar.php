<?php
header('Content-Type: text/html; charset=utf-8'); 

$conn = pg_connect("dbname=santp user=santp password=santp1234 host=129.90.60.41 port=5433");
if(!$conn){
	echo "Error al Conectar.\n";
	exit;
}

//ACTUALIZAR
if(isset($_POST["btnEnviar"])){
	$actu="UPDATE prueba_santp SET tx_fecha = '" . $_POST["tx_fecha"] . "', tx_nombre = '" . $_POST["tx_nombre"] . "', tx_codigo='" . $_POST["tx_codigo"] . "', fecha = '" . $_POST["fecha"] . "', revision='" . $_POST["revision"] . "' WHERE codigo_norma=" . $_POST["codigo"];

	echo $actu . "<br>";
	pg_query($actu);
}

//MOSTRAR
$ini = "select * from prueba_santp WHERE NOT (tx_codigo like '%-%') 
		AND NOT tx_ruta like 'http://www.intevep.pdv.com/santp/pquimicos/productos/%' 
		AND NOT tx_ruta like 'http://www.intevep.pdv.com/santp/previsualizacion/%' AND visible=1
		AND NOT tx_ruta like 'http://www.intevep.pdv.com/santp/iyp/suc/anexp/%' 
		AND NOT tx_ruta like 'http://www.intevep.pdv.com/santp/mid/pip/%' 
		AND NOT tx_ruta like 'http://www.intevep.pdv.com/santp/petygas_old/%' 
		AND NOT tx_ruta like 'http://www.intevep.pdv.com/santp/iyp/suc/anexosi/%'
		AND NOT (tx_codigo like '%-%')
		AND tx_codigo <> 'CONTE' AND tx_codigo <>'SUSTITU'  
		order by 1 limit 50";

/*
$ini = "select tx_ruta, tx_fecha, tx_codigo, tx_nombre, codigo_norma, fecha, revision FROM prueba_santp 
		WHERE NOT revision in ('0', '1', '2', '3', '4', '5', '6', '7', '8', '9')
		ORDER BY revision DESC LIMIT 100";
*/
/*
$ini = "select length(tx_nombre), tx_ruta, tx_fecha, tx_codigo, tx_nombre, codigo_norma, fecha, revision 
		FROM prueba_santp ORDER BY 1 DESC LIMIT 250";
*/
/*
$ini = "select tx_ruta, tx_fecha, tx_codigo, tx_nombre, codigo_norma, fecha, revision FROM prueba_santp 
		WHERE NOT (tx_fecha like 'Rev. 0%' OR tx_fecha like 'Rev. 1%' OR tx_fecha like 'Rev. 2%' OR  tx_fecha like 'Rev. 3%' OR  tx_fecha like 'Rev. 4%' OR  tx_fecha like 'Rev. 5%' OR  tx_fecha like 'Rev. 6%' OR  tx_fecha like 'Rev. 7%' OR  tx_fecha like 'Rev. 8%' OR  tx_fecha like 'Rev. 9%' OR tx_fecha like 'Rev. -%') 
		ORDER BY tx_fecha DESC";
*/
/*
$ini = "select tx_ruta, tx_fecha, tx_codigo, tx_nombre, codigo_norma, fecha, revision 
		FROM prueba_santp 
		WHERE 
		NOT (fecha like 'ENE%' OR fecha like 'JAN%' OR fecha like 'FEB%' OR fecha like 'MAR%' OR fecha like 'ABR%' OR fecha like 'APR%' OR fecha like 'MAY%' OR fecha like 'JUN%' OR fecha like 'JUL%' OR fecha like 'AGO%' OR fecha like 'AG0%' OR fecha like 'AUG%' OR fecha like 'SEP%' OR fecha like 'OCT%' OR fecha like 'NOV%' OR fecha like 'DIC%' OR fecha like 'DEC%')
		ORDER BY fecha DESC LIMIT 50";
*/	
/*
$ini = "select tx_ruta, tx_fecha, tx_codigo, tx_nombre, codigo_norma, fecha, revision FROM prueba_santp 
		WHERE tx_fecha<>'' AND
		length(fecha)<2 AND NOT(tx_ruta like '%http://www.intevep.pdv.com/santp/crp/%') AND 
		tx_nombre <> 'IMAGEN' AND NOT(tx_ruta like '%/santp/pquimicos/productos%')
		ORDER BY tx_ruta";
*/	

//$ini = "select tx_ruta from prueba_santp order by 1";
/*
$ini = "select tx_ruta, tx_fecha, fecha, revision from prueba_santp where visible=1 AND (revision='' OR revision ='-')";
*/

$ret = pg_query($ini);

$filas = pg_num_rows($ret);
$res = array();

for($i=0; $i<$filas; $i++)
	$res[] = pg_fetch_array($ret, $i, PGSQL_ASSOC);

$c = count($res);

/*
echo $c . "<br>";

$datos = array();

for($i=0; $i<$c; $i++){
  $datos []= str_replace(basename($res[$i]["tx_ruta"]), "", $res[$i]["tx_ruta"]);
}

$datos = array_keys(array_count_values($datos));

for($i=0; $i<count($datos); $i++){
  echo $datos[$i];
  echo "<br>";
}


exit;
*/


/*
$rutas = array();
for($i=0; $i<$c; $i++){
	$rutas []= str_replace(array("http://www.intevep.pdv.com/", basename($res[$i]["tx_ruta"])), "", $res[$i]["tx_ruta"]);
}

$rutas = array_keys(array_count_values($rutas));
print_r($rutas);

exit;
*/

//print_r($_POST);

echo "<table border='1'><tr><td>número</td><td>codigo</td><td>url</td><td>codigo</td><td>titulo</td><td>fecha rev</td><td>fecha</td><td>revision</td></tr>";

for($i=0; $i<$c; $i++){
	echo "<form method=post>";

	echo "<tr>";
	echo "<td>$i</td>";
	
	echo "<td><input name='codigo' value=" . $res[$i]["codigo_norma"] . " size=4></td>";
	echo "<td><a href=" . $res[$i]["tx_ruta"] . ">" . $res[$i]["tx_ruta"] . "</a></td>";
	echo "<td><input name='tx_codigo' value='" . $res[$i]["tx_codigo"] . "'></td>";
	echo "<td><input name='tx_nombre' value='" . $res[$i]["tx_nombre"] . "' size=50></td>";
	echo "<td><input name='tx_fecha' value='" . $res[$i]["tx_fecha"] . "' size=10></td>";
	echo "<td><input name='fecha' value='" . $res[$i]["fecha"] . "' size=2></td>";
	echo "<td><input name='revision' value='" . $res[$i]["revision"] . "' size=2></td>";
	echo "<td><input type=submit name=btnEnviar value=enviar></td>";
		
	echo "</tr>";
	
	echo "</form>";
}

echo "</table>";

pg_close($conn);
?>
