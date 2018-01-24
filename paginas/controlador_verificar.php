<?php
session_start();

//if ($_SESSION["usuarioValido"]!=1){header("location:../acceso.php");}
//include_once("Login.php");
//include_once("../modelo/utilitarios/Utilitarios.php");
include_once("../clases/directorioActivo.php");
include_once("../modelo/clasesBD/includeBD.php");
include_once("../modelo/clases/includeClases.php");

 	$solicitud=new Solicitud();
  	if(isset($_GET['texta4'])) $solicitud->setTx1($_GET['texta4']);

	if(isset($_GET["documento"])){
   		if ($_GET["documento"]=="Existente") $solicitud->setTx2($_GET["text2"]);
   		else $solicitud->setTx2($_GET["documento"]);
	}

	if(isset($_GET["prioridad"])) $solicitud->setTx3($_GET["prioridad"]);
  
  	if(isset($_GET["manual"])){
	   	if ($_GET["manual"]=="otro") $solicitud->setTx4($_GET["text4"]);
		else $solicitud->setTx4($_GET["manual"]);
  	}
   
  	if(isset($_GET['arre5'])){
	   	$pr=",";
	   	$pr5="";

		foreach($_GET['arre5'] as $val){
			if ($val=='otro'){
				$pr5=$pr5.$pr.'otro';
				$pr5=$pr5.$pr.$_GET['text5'];
			}else{
				$pr5=$pr5.$pr.$val;
			}
		}
		
	  	$solicitud->setTx5($pr5);
   	}
   
	if (isset($_GET['arre6'])){ 
	   	$pr=",";
	   	$pr6="";
		
		foreach($_GET['arre6'] as $val){
			if ($val=='otro'){
				$pr6=$pr6.$pr.'otro';
				$pr6=$pr6.$pr.$_GET['text6'];
			}else{
				$pr6=$pr6.$pr.$val;
			}
		}
		
		$solicitud->setTx6($pr6);
	}
 
	if (isset($_GET['arre7'])){ 
		$pr=",";
	   	$pr7="";
		
		foreach($_GET['arre7'] as $val){
			if ($val=='otro'){
				$pr7=$pr7.$pr.'otro';
				$pr7=$pr7.$pr.$_GET['text7'];
			}else{
				$pr7=$pr7.$pr.$val;
			}
		 }
		 
		$solicitud->setTx7($pr7);
	}
 
   	if (isset($_GET['txObser2'])) $solicitud->setTx8($_GET['txObser2']);
   
   	if (isset($_GET['fecha'])) $solicitud->setFecha($_GET['fecha']);
   
   	if (isset($_GET['lugar'])) $solicitud->setTx_lugar($_GET['lugar']);
  
    if (isset($_GET['filial'])) $solicitud->setUnidad($_GET['filial']);
	
	$solicitud->setVerificado(0);
  
   	$_SESSION["resultadoSolicitud"]=serialize($solicitud);	

	if(isset($_GET["accionUsuario"])) $_SESSION['accionUsuario']=$_GET["accionUsuario"];

 	$Usuario=new Solicitante(); 
	
	if(isset($_GET['nombre'])) $Usuario->setNombre($_GET['nombre']);

	if(isset($_GET['indicador'])) $Usuario->setIndicador($_GET['indicador']);

	if(isset($_GET['telefono'])) $Usuario->setTelefono($_GET['telefono']);
	
	if(isset($_GET['celular'])) $Usuario->setCelular($_GET['celular']);

	if(isset($_GET['nombre2'])) $Usuario->setNombre_sup($_GET['nombre2']);
   
   	if(isset($_GET['indicador2'])) $Usuario->setIndicador_sup($_GET['indicador2']);

   	if(isset($_GET['telefono2'])) $Usuario->setTelefono_sup($_GET['telefono2']);
	
	switch ($_SESSION['accionUsuario']){
   		case 'verificar':
   			$idi = "";
   			$Res=0;
   			$R = array();
   			$nombreSupervisor = "";
			$extensionSupervisor = "";
			
   			if(isset($_GET["indicador"])) $idi=$_GET["indicador"];

			if($idi!=""){
			   $da = new directorioActivo();
			   $R = $da->obtenerUsuarioID($idi);
			   
			   $Res=sizeof($R);
 			}

			if($Res>1){
		   		$_SESSION['vane']=$R[0]["displayname"][0];

		   		$usuario=new Solicitante();

				$usuario->setIndicador(strtolower($_GET["indicador"]));
				$usuario->setNombre($R[0]["displayname"][0]);
				$usuario->setTelefono($R[0]["ipphone"][0]);
				$usuario->setCorreo(strtolower($_GET["indicador"]).'@pdvsa.com');

				$usuario->setCelular($R[0]["mobile"][0]);
				$usuario->setSupervisor($R[0]["pdvsacom-ad-functionalsupervisor"][0]);

				if(isset($R[0]["pdvsacom-ad-functionalsupervisor"][0]) && $R[0]["pdvsacom-ad-functionalsupervisor"][0]!=""){
					$res = $da->obtenerUsuarioID($R[0]["pdvsacom-ad-functionalsupervisor"][0]);
					$nombreSupervisor = $res[0]["displayname"][0];
					$extensionSupervisor = $res[0]["ipphone"][0];
				}
				
				$usuario->setNombreSupervisor($nombreSupervisor);
				$usuario->setTelefonoSupervisor($extensionSupervisor);

				$_SESSION["resultadoVerificar"]=serialize($usuario);	

				header("location:formatoSolicitud.php?VAL=1");
			}else{
			   	$_SESSION['vane']="NO EXISTE EN DIRECTORIO ACTIVO";
			   	echo "<script> alert(\"NO EXISTE EN DIRECTORIO ACTIVO\")</script>";
			   	echo "<script>location.href=\"formatoSolicitud.php?VAL=2\"</script>";
			}
    	break;
    	
   		case 'guardar':
   			$objeto=new SolicitudBD();
   			$solicitantebd=new SolicitanteBD();
   			$ids=$solicitantebd->consultarXIndicador($_GET['indicador']);
   			
   			if($ids==NULL) $solicitantebd->InsertarUsuario($Usuario);

   			$id=$solicitantebd->consultarXIndicador($_GET['indicador']);
    		$vari=$objeto->InsertarDatos($solicitud,$id[0]->getIdUsuario());

   			if ($vari!=false){
     			echo "<script> alert(\" Se guardo satisfactoriamente\")</script>";
   			}else{
      			echo "<script> alert(\"Error al guardar la información\")</script>";
   			}

			echo "<script>location.href=\"formatoSolicitud.php\"</script>";
		break;
	}
?>