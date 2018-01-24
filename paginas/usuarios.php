<?php
include "../controles/header.php";
?>
<html>
<head>
	<link rel="shortcut icon" href="../favicon.ico">    
	<meta name="generator" content="HTML Tidy, see www.w3.org" />
    <title><?php echo $config->nombreAplicacion; ?></title>
    <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
	<link href="../css/auxi.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../css/ajax-tooltip.css" media="screen" type="text/css"> 
	<script language="JavaScript" type="text/javascript" src="../js/injectionJS.js"></script>
		<script language="JavaScript">
			function desbloquear(){
					
					document.usuario.submit();

			   }	
	</script>


</head>


<body>
    <table width="760px" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td><?php echo $pres->crearEncabezado($config->nombreAplicacion); ?></td>
        </tr>

        <tr>
            <td>
                <?php 
                    echo  $pres->crearVentanaInicioSinMenu("");
                    
                    echo $pres->crearVentanaIntermedia();
                ?>
                <form id="usuario"  name="usuario" method="post" style="margin:0px">
                 <div id="desbloquear">
				 </br>
					<table width="100%">
					  <!--DWLayoutTable-->
						<tr>
							<td colspan="4" class="Titulo">Desbloquear Usuarios</td>
						</tr>
						<tr><td class="Sub-Titulo">Seleccione el usuario a desbloquear</td></tr>
						<tr><td></td></tr>
						<tr>
							<td width="43%"></td>
							<td width="25%" class="Detalle-Claro">Id Usuario							</td>
							<td width="25%">.
								<?php
								$clad->desbloquearUsuario( $_POST['cmbusuarios']);
								
								?>
								<select id="cmbusuarios" name="cmbusuarios" class="Detalle" style="WIDTH: 150px">
								<?php
									$bloqueo = $_POST['bloqueo'];
									
									
									$datos = $clad->obtenerIdUsuario(); 
					                echo $pres->crearCombo($datos, "id_usuario", "id_usuario");
									
								?>
								</select>							
							</td>
							<td></td>
								
						</tr>
					</table>
					<table width="100%">
						<tr><td height="25"></td></tr>
    					<tr><td width="43%"></td>
     					<td height="26" colspan="2" align="center" valign="top">
      					<div class="Principio-Boton"></div>
      					<input  type="button" name="Desbloquear" value="Dresbloquear" class="Boton"  onClick="desbloquear()">
      					<div class="Final-Boton"></div></td>
      					<td colspan="4"  align="center" valign="top">
      					<div class="Principio-Boton"></div>
      					<input type="reset" name="limpiar" value="Limpiar" class="Boton">
     					 <div class="Final-Boton"></div></td>
    					</tr>
   					</table>
				 </div>
		    	 <div id= "detalle">

				  </div>
				  <br/>
				  <div id="entrada">
                 

				  </div>
                </form>
                <?php echo $pres->crearVentanaFin(); ?>
            </td>
        </tr>

        <tr>
            <td><?php echo $pres->crearPie(); ?></td>
        </tr>
    </table>
</body>
</html>


