<html xmlns="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" xml:lang="es" lang="es">
    <head>
        <meta name="generator" content="HTML Tidy, see www.w3.org" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script language="JavaScript">
			function regresar(resultado){
				form = document.getElementById("forma1");
				if (resultado == 1) {
					alert("Se guardo satisfactoriamente");
				}else{
					alert("Error al guardar la información. Intente más tarde.");
					form.action="../paginas/login.php";
				}
				form.submit();
			}		
		</script>
	</head>
<body>
<form id="forma1" method="post" action="../paginas/principal.php" >
<?php
	session_start();

	
	if (!isset($_SESSION["id"])){header("location:../paginas/login.php");}
	$id = $_SESSION["id"];
	
	//include_once("Login.php");
	include_once("../modelo/utilitarios/Utilitarios.php");
	include_once("../modelo/clasesBD/includeBD.php");
	include_once("../modelo/clases/includeClases.php");
	include "../controles/header.php";

	//include_once "../clases/cargarLog.php";
	//$log = new Log();
	
	include_once "../clases/clad.php";
	$clad = new clad();

	//variable oculta que verifica si el usuario selecciono el boton enviar
	//$in_enviar = $_POST['in_enviar']; 	

 	 //asignacion de las variables seccion I encuesta
    if ($_POST['radioOrganizacion']==''){$Organizacion=0;}else{$Organizacion = $_POST['radioOrganizacion'];} 
	if ($_POST['radioServicio']==''){$Servicio=0;}else{$Servicio = $_POST['radioServicio'];} 
	if ($_POST['radioEdad']==''){$Edad=0;}else{$Edad = $_POST['radioEdad'];} 
	if ($_POST['radioNivel']==''){$Nivel=0;}else{$Nivel = $_POST['radioNivel'];} 
	if ($_POST['radioSexo']==''){$Sexo=0;}else{$Sexo = $_POST['radioSexo'];} 
	if ($_POST['radioLugar']==''){$Lugar=0;}else{$Lugar = $_POST['radioLugar'];} 
	
	//asignacion de las variables seccion II encuesta
	$datos = $clad->obtenerPreguntas();										
	
	for($i = 1;$i <= count($datos);$i++){

			$radio[$i] = $_POST['radio'.$i]; 

	}
	


    $datos = $clad->actualizarEncuesta($id,$Organizacion, $Servicio,$Edad,$Nivel,$Sexo,$Lugar,$radio);




	if ($datos!=false){
	  echo "<script>regresar(1);</script>";
	}else{
	  echo "<script>regresar(2);</script>";
	}
	
?>
</form>
</body>
</html>