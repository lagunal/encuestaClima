<?php
	include "../controles/header.php";

	include_once "../clases/cargarLog.php";
	$log = new Log();
	
	include_once "../clases/clad.php";
	$clad = new clad();
	
	if (!isset($_SESSION["id"])){header("location:../paginas/login.php");}
	 //$datos = $clad->obtenerProfesion();
	
	//$datos_encuesta = $clad->obtenerDatosEncuesta($_SESSION["id"]);
	//$datos_usuario = $clad->obtenerDatosUsuario($_SESSION["cedula"]);
	
	$id_usuario = $_SESSION["id"];

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title><?php echo $config->nombreAplicacion; ?></title>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
	<link type="text/css" rel="stylesheet" href="../css/calendar.css?random=20051112" media="screen"></LINK>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>   
	<script language="JavaScript" type="text/javascript" src="../js/injectionJS.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/noticias.js"></script>
	<SCRIPT language="JavaScript" type="text/javascript" src="../js/calendar.js?random=20060118"></script>
    <script language="JavaScript" type="text/javascript" src="../js/validaciones.js"></script>
	<script language="JavaScript">
			function enviar(){
			    form = document.forms[0];
				totalPreguntas = form.totalPreguntas.value;				
				//alert(totalPreguntas);
				if(form){
							alerta = false;
							aviso = false;
							for (j=0;j < form.radioOrganizacion.length;j++){
												if (form.radioOrganizacion[j].checked == true){
												    aviso = true;}
							}
							if (aviso == false){
							   alerta = true;
							}
							alerta = false;
							aviso = false;
							for (j=0;j < form.radioServicio.length;j++){
												if (form.radioServicio[j].checked == true){
												    aviso = true;}
							}
							if (aviso == false){
							   alerta = true;
							}	
							alerta = false;
							aviso = false;
							for (j=0;j < form.radioEdad.length;j++){
												if (form.radioEdad[j].checked == true){
												    aviso = true;}
							}
							if (aviso == false){
							   alerta = true;
							}							
							alerta = false;
							aviso = false;
							for (j=0;j < form.radioNivel.length;j++){
												if (form.radioNivel[j].checked == true){
												    aviso = true;}
							}
							if (aviso == false){
							   alerta = true;
							}
							alerta = false;
							aviso = false;
							for (j=0;j < form.radioSexo.length;j++){
												if (form.radioSexo[j].checked == true){
												    aviso = true;}
							}
							if (aviso == false){
							   alerta = true;
							}
							alerta = false;
							aviso = false;
							for (j=0;j < form.radioLugar.length;j++){
												if (form.radioLugar[j].checked == true){
												    aviso = true;}
							}
							if (aviso == false){
							   alerta = true;
							}
							alerta = false;
							for	(var i = 1; i <= totalPreguntas; i++) {
									aviso = false;
									eval( "radio = form." + "radio" + i );
									for (j=0;j < radio.length;j++){
														if (radio[j].checked == true){
															aviso = true;}
									}
									if (aviso == false){
									   alerta = true;
									   break;
									}
									
							}  
					if (alerta == true){
								alert("Por favor debe responder todas las preguntas.");
					}else{
						if(confirm("Va a proceder a enviar definitivamente sus respuestas (NO PODRÃ VOLVER A MODIFICARLAS) Â¿Esta seguro?.")){
							document.encuesta.submit();
						}						
					
					}
			
				}			
			}	
	
	</script>
</head>
<body>
<form name="encuesta" action="controlador_encuesta.php" method="post">
<input type="hidden" id="in_enviar" name="in_enviar" value=2>
<table width="760px" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<?php echo $pres->crearEncabezado($config->nombreAplicacion); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
			/*	$texto = "<a href='principal.php' class='link_blanco'>Inicio</a>&nbsp;-&nbsp;" .
						 "<a href='organizacion.php' class='link_blanco'>Organización</a>&nbsp;-&nbsp;" .
						 "<a href='servicios.php' class='link_blanco'>Servicios</a>&nbsp;-&nbsp;" .
						 "<a href='javascript:verNoticias(1)' class='link_blanco'>Noticias</a>&nbsp;-&nbsp;" .
						 "<a href='javascript:verNoticias(2)' class='link_blanco' title='ÚLTIMAS NORMAS ACTUALIZADAS O DESARROLLADAS'>Últimas Normas</a>";   */
						 
				/*$datos_rol = $clad->buscarRolUsuario($_SESSION["id"]);				
				if ( $datos_rol == '2') 
					$texto = "Administrar";
				else
					$texto = "";*/
				echo $pres->crearVentanaInicioSinMenu($texto);
				echo $pres->crearVentanaIntermedia();
			?>
			<table cellpadding="0" cellspacing="0" border="0" width="760px" height="100%">
				<tr>
					<td  >
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td width="510px"  >
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
										<tr>
											<td   align="center" class="Titulo">
												ENCUESTA OPINIÓN DE LOS TRABAJADORES - AÑO 2010
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td width="510px"  >
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
										<tr>
											<td   align="left"  class="Detalle">
											La  presente encuesta tiene como propósito brindar, a cada uno de los trabajadores y trabajadoras de la empresa, la oportunidad de expresar su opinión<br>
												respecto a diversos aspectos de la dinámica de la   organización con el fin de evaluar el desempeño de la misma y estimular su mejoramiento continuo,<br>
												 así como participar en forma conjunta a tomar correctivos para fortalecerla y asegurar su permanencia en el tiempo. Es fundamental mantener el diálogo<br>
												 continuo con todos los miembros de nuestra comunidad institucional, mediante la  repetición de  la encuesta en forma periódica con el fin de analizar<br>
												 tendencias de opinión y monitorear el nivel de percepción de los participantes sobre el desempeño de la organización y su entorno.<br>
											<p>	
												Los resultados de esta encuesta propulsarán los cambios que la empresa demanda para el fortalecimiento del potencial creador de los trabajadores <br>
												y trabajadoras en aras  del  beneficio colectivo dentro de las líneas de construcción del modelo socialista de organización.<br>
											<p>
												Esta encuesta esta estructurada en dos (2 secciones):<br>
											<p>
												I.	DATOS PERSONALES<br>
													La información que usted proporcione serán utilizados para fines estadísticos .Se manejara con estricta  confidencialidad y anonimato.<br>
											<p>
												II.	OPINION DE LOS PARTICIPANTES<br>
													En esta sección se le pide que exprese sus opiniones respecto algunos tópicos de la dinámica del trabajo en la organización donde <br>
													se desempeña así como de la totalidad de la empresa. No existen respuestas correctas o incorrectas.<br>
											<p>		
												De antemano, Muchas gracias por su entusiasta colaboración<br> 
											</td>
										</tr>
										<tr><td>&nbsp;</td></tr>
										<tr>
										   <td align="center"  class="Titulo">
												¡Nuestro dialogo  es la clave del  mejoramiento! <br>
										   </td>	
										</tr>   
									</table>
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td width="710px"  >
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
										<tr>
											<td   align="left" class="Titulo" colspan=4>
											I. DATOS PERSONALES<br>
											</td>
										</tr>
										<tr><td>&nbsp;</td></tr>
										<tr>
											<td   align="left"  class="Detalle" colspan=4>
														<!--Sección # 1<br>-->
														<p>	
														<b>INSTRUCCIONES:<br></b>
														<p>
															•	Por favor seleccione una de las casillas que aparecen en el presente instrumento. <br>
														<p>
															•	Marque  únicamente una respuesta por cada pregunta. En caso de cambiar de opinión, seleccione la nueva casilla.<br>
														<p>
											</td>							
										</tr>
										<tr><td>&nbsp;</td></tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												Organización donde trabaja:										  </td>
										  <td class="Detalle" width="30%">
						                        <div align="left">
						                            <input type="radio" id="radioOrganizacion" name="radioOrganizacion" value="Ex" tabindex="16">Exploración y Estudios de Yacimientos								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio"  id="radioOrganizacion" name="radioOrganizacion" value="Pr" tabindex="17">Producción
												</div>										  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  id="radioOrganizacion" name="radioOrganizacion" value="Fa" tabindex="18">Faja Petrolífera del Orinoco					
												</div>
										  </td>
										</tr>
										<tr>
										  <td height="23">										  </td>
										  <td class="Detalle">
						                        <div align="left">
						                            <input type="radio"  id="radioOrganizacion" name="radioOrganizacion" value="Re" tabindex="20">Refinación e Industrialización 					
												</div>
										  </td>
										  <td class="Detalle">
						                        <div align="left">
						                            <input type="radio"  id="radioOrganizacion" name="radioOrganizacion" value="So" tabindex="21">Soporte Tecnológico						                        
												</div>
										  </td>
										  <td class="Detalle">
						                        <div align="left">
						                            <input type="radio"   id="radioOrganizacion" name="radioOrganizacion" value="Fu" tabindex="22">Funcionales						                        
												</div>
										  </td>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												Rangos  de Años de Servicio:										  
										  </td>
										  <td class="Detalle" width="20%">
						                        <div align="left">
						                            <input type="radio" id="radioServicio"  name="radioServicio" value="1" tabindex="16">0 – 5 años 								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio" id="radioServicio" name="radioServicio" value="2" tabindex="17">Más de 5 años 
												</div>										  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio" id="radioServicio" name="radioServicio" value="3" tabindex="18">Igual ó mayor a 10 años 					
												</div>
										  </td>
										</tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												&nbsp;									  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio" id="radioServicio" name="radioServicio" value="4" tabindex="18">Igual ó mayor a 20 años  					
												</div>
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												¿Qué edad tiene?										  
										  </td>
										  <td class="Detalle" width="20%">
						                        <div align="left">
						                            <input type="radio" id="radioEdad"  name="radioEdad" value="1" tabindex="16">Menor de 21 años 								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio" id="radioEdad" name="radioEdad" value="2" tabindex="17">21 – 30 años   
												</div>										  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio" id="radioEdad" name="radioEdad" value="3" tabindex="18">31 – 40 años 					
												</div>
										  </td>
										</tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												&nbsp;									  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio" id="radioEdad" name="radioEdad" value="4" tabindex="18">41 - 50 años  					
												</div>
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio" id="radioEdad" name="radioEdad" value="5" tabindex="18">51 o más  					
												</div>
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												Nivel académico:										  
										  </td>
										  <td class="Detalle" width="20%">
						                        <div align="left">
						                            <input type="radio" id="radioNivel"  name="radioNivel" value="Ba" tabindex="16">Bachiller								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio" id="radioNivel" name="radioNivel" value="Te" tabindex="17">Técnico /Tecnólogo    
												</div>										  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio" id="radioNivel" name="radioNivel" value="In" tabindex="18">Ingeniero o Licenciado 					
												</div>
										  </td>
										</tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												&nbsp;									  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio" id="radioNivel" name="radioNivel" value="Es" tabindex="18">Especialización  					
												</div>
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio" id="radioNivel" name="radioNivel" value="Ma" tabindex="18">Maestría ó Magíster  					
												</div>
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio" id="radioNivel" name="radioNivel" value="Do" tabindex="18">Doctorado ó PhD   					
												</div>
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio" id="radioNivel" name="radioNivel" value="Ot" tabindex="18">Otro   					
												</div>
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												Sexo:										  
										  </td>
										  <td class="Detalle" width="20%">
						                        <div align="left">
						                            <input type="radio" id="radioSexo"  name="radioSexo" value="F" tabindex="16">Femenino  								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio" id="radioSexo" name="radioSexo" value="M" tabindex="17">Masculino    
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												Lugar de Trabajo:										  
										  </td>
										  <td class="Detalle" width="20%">
						                        <div align="left">
						                            <input type="radio"  id="radioLugar" name="radioLugar" value="Te" tabindex="16">Los Teques   								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio" id="radioLugar" name="radioLugar" value="Ce" tabindex="17">CEPRO    
												</div>										  
										  </td>
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio" id="radioLugar" name="radioLugar" value="Ot" tabindex="17">Otro    
												</div>										  
										  </td>
										</tr>





										
									</table>
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
										<tr>
											<td height="34" align="left"   class="Titulo">
											II. SUS OPINIONES<br>
											</td>
										</tr>
							<tr>
								<td   align="left"  class="Detalle">
											<b>DEFINICIONES<br></b>
											<p>	
											Por favor refiérase a las definiciones a continuación al contestar la encuesta:<br>
											<p>
												•	“LA EMPRESA ”:  se refiere a la totalidad del grupo de gerencias generales y funcionales que conforman la  comunidad de PDVSA-Intevep.<br>
											<p>
												•	"ORGANIZACIÓN": la organización se refiere en la gerencia general,  técnica o funcional  al cual usted pertenece.<br>
											<p>
											    •	“EQUIPO GERENCIAL”: se refiere al equipo de la alta dirección de su organización.<br>
											<p>
											    •	“EQUIPO DE TRABAJO”: se refiere a las personas que participan junto con usted en algún proyecto o programa en que usted trabaja actualmente.<br>
											<p>
											    •	“LÍDER DEL EQUIPO”: se refiere a la persona  ( gerente, supervisor, etc.) que dirige al equipo en su organización, proyecto, pericia , laboratorio o procesos de trabajo.<br>
											<p>	
											<b>INSTRUCCIONES:<br></b>
											<p>												
											Favor completar esta sección seleccionando la opción que mejor describa su opinión.<br>												
											<p>												
<!--											<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.  Totalmente de acuerdo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   2.De acuerdo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   3.Neutro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   4. En desacuerdo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  5.Total desacuerdo<br>												-->
								</td>							
							</tr>
							

						</table>
					</td>
				</tr>
				<tr><td>
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
										  <td>&nbsp;</td>
										  <td class="Detalle" width="12%" align="center">1.Totalmente de acuerdo</td>
										  <td class="Detalle" width="12%" align="center" valign="top">2.De acuerdo</td>
										  <td class="Detalle" width="13%" align="center" valign="top">3.Neutro</td>
										  <td class="Detalle" width="10%" align="center" valign="top">4.En desacuerdo</td>
										  <td class="Detalle" width="20%" align="center" valign="top">5.Total desacuerdo</td>
  									    </tr>
										<?php
										$contador = 0;
										$datos = $clad->obtenerPreguntas();
										?>
										<input type="hidden" id="totalPreguntas" name="totalPreguntas" value="<?php echo count($datos);?>">					
										<?php
										for($i = 0;$i < count($datos);$i++){
										?>
												<tr>
												  <td>&nbsp;</td>
												</tr>
												<tr>
												  <td class="Detalle" width="40%" height="28" >
													   <?php
														echo $datos[$i]['cod_pregunta'].". ".$datos[$i]['tx_pregunta'];
														$contador = $contador + 1;
														?>
												  </td>
												  <td class="Detalle" >
														<div align="center">
															<input type="radio"  id="radio<?php echo $i+1;?>" name="radio<?php echo $i+1;?>" value="1" tabindex="16">1   								
														</div>
												  </td>
															
												  <td class="Detalle" >
														<div align="center">
															<input type="radio" id="radio<?php echo $i+1;?>" name="radio<?php echo $i+1;?>" value="2" tabindex="17">2
														</div>										  
												  </td>
												  <td class="Detalle" >
														<div align="center">
															<input type="radio" id="radio<?php echo $i+1;?>" name="radio<?php echo $i+1;?>" value="3" tabindex="17">3    
														</div>										  
												  </td>
												  <td class="Detalle" >
														<div align="center">
															<input type="radio" id="radio<?php echo $i+1;?>"  name="radio<?php echo $i+1;?>" value="4" tabindex="16">4   								
														</div>
												  </td>
												  <td class="Detalle" >
														<div align="center">
															<input type="radio" id="radio<?php echo $i+1;?>" name="radio<?php echo $i+1;?>" value="5" tabindex="17">5
														</div>										  
												  </td>
												</tr>
												<tr>
												  <td>&nbsp;</td>
												</tr>
										<?php
										if ($contador == 5){
										?>
												<tr>
												  <td>&nbsp;</td>
												</tr>
												<tr>
												  <td>&nbsp;</td>
												  <td class="Detalle" width="12%" align="center">1.Totalmente de acuerdo</td>
												  <td class="Detalle" width="12%" align="center" valign="top">2.De acuerdo</td>
												  <td class="Detalle" width="13%" align="center" valign="top">3.Neutro</td>
												  <td class="Detalle" width="10%" align="center" valign="top">4.En desacuerdo</td>
												  <td class="Detalle" width="20%" align="center" valign="top">5.Total desacuerdo</td>
												</tr>										
										<?php
										$contador = 0;
										}
										}
										?>
										
					</table>
				</td></tr>
				
							<tr>
								<td width="710px"  >
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
										<tr><br><br>
										  <td height="15" align="center"   class="Titulo">MUCHAS GRACIAS POR SU PARTICIPACIÓN</td>
									  </tr>
				
										<tr>
										<td height="99" align="center" class="Titulo">
								
										    <table cellpadding="0" cellspacing="0" border="0" width="100%">
												<tr>
													<td align="center" width="45%">&nbsp;</td>
													
													
												</tr>
												<?php
												$no_usuario = $clad->buscarUsuarioEncuesta($id_usuario);	
												if ($no_usuario == 1){ 
												?>
													<tr>
														<td align="center" colspan=3 class="Titulo">Usted ya guardo su encuesta. Gracias.</td>
													</tr>
												<?php
												}else{
												?>
														<tr>
															<td >&nbsp;									</td>
															<td align="center" ><?php echo $pres->crearBoton("btnGuardar", "Guardar", "button", "onclick=javascript:enviar();"); ?></td>
															<td>&nbsp;									</td>
														</tr>
												
												
												
												<?php
												}
												?>
											</table>													
										</td>
										</tr>		
									</table>	
								</td>
							</tr>				
				
				
				
				
				
				
			</table>
			<?php echo $pres->crearVentanaFin(); ?>
		</td>
	</tr>
	<tr>
		<td >
			<?php echo $pres->crearPie(); ?>
		</td>
	</tr>
</table>
</form>
</body>
</html>
