<?php
	include "../controles/header.php";

	//include_once "../clases/cargarLog.php";
	//$log = new Log();
	
	include_once "../clases/clad.php";
	$clad = new clad();
	
	if (!isset($_SESSION["id"])){header("location:../paginas/login.php");}
	 //$datos = $clad->obtenerProfesion();
	
	//$datos_encuesta = $clad->obtenerDatosEncuesta($_SESSION["id"]);
	//$datos_usuario = $clad->obtenerDatosUsuario($_SESSION["cedula"]);
	
	//echo "id ".$_SESSION["id"];

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
			    if(confirm("Va a proceder a enviar definitivamente sus respuestas (NO PODRÁ VOLVER A MODIFICARLAS) ¿Esta seguro?.")){
					document.encuesta.in_enviar.value = 1;
					document.encuesta.submit();
				}				
				//form = document.getElementById("encuesta");
				//form.submit();
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
						                            <input type="radio" name="radioOrganizacion" value="Ex" tabindex="16">Exploración y Estudios de Yacimientos								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio"  name="radioOrganizacion" value="Pr" tabindex="17">Producción
												</div>										  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioOrganizacion" value="Fa" tabindex="18">Faja Petrolífera del Orinoco					
												</div>
										  </td>
										</tr>
										<tr>
										  <td height="23">										  </td>
										  <td class="Detalle">
						                        <div align="left">
						                            <input type="radio"  name="radioOrganizacion" value="Re" tabindex="20">Refinación e Industrialización 					
												</div>
										  </td>
										  <td class="Detalle">
						                        <div align="left">
						                            <input type="radio"  name="radioOrganizacion" value="So" tabindex="21">Soporte Tecnológico						                        
												</div>
										  </td>
										  <td class="Detalle">
						                        <div align="left">
						                            <input type="radio"   name="radioOrganizacion" value="Fu" tabindex="22">Funcionales						                        
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
						                            <input type="radio"   name="radioServicio" value="1" tabindex="16">0 – 5 años 								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio"  name="radioServicio" value="2" tabindex="17">Más de 5 años 
												</div>										  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioServicio" value="3" tabindex="18">Igual ó mayor a 10 años 					
												</div>
										  </td>
										</tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												&nbsp;									  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioServicio" value="4" tabindex="18">Igual ó mayor a 20 años  					
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
						                            <input type="radio"   name="radioEdad" value="1" tabindex="16">Menor de 21 años 								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio"  name="radioEdad" value="2" tabindex="17">21 – 30 años   
												</div>										  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioEdad" value="3" tabindex="18">31 – 40 años 					
												</div>
										  </td>
										</tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												&nbsp;									  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioEdad" value="4" tabindex="18">41 - 50 años  					
												</div>
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioEdad" value="5" tabindex="18">51 o más  					
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
						                            <input type="radio"   name="radioNivel" value="Ba" tabindex="16">Bachiller								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio"  name="radioNivel" value="Te" tabindex="17">Técnico /Tecnólogo    
												</div>										  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioNivel" value="In" tabindex="18">Ingeniero o Licenciado 					
												</div>
										  </td>
										</tr>
										<tr>
				                          <td class="Detalle" width="20%" height="28">
												&nbsp;									  
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioNivel" value="Es" tabindex="18">Especialización  					
												</div>
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioNivel" value="Ma" tabindex="18">Maestría ó Magíster  					
												</div>
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioNivel" value="Do" tabindex="18">Doctorado ó PhD   					
												</div>
										  </td>
										  <td class="Detalle" width="20%">
										        <div align="left">
						                            <input type="radio"  name="radioNivel" value="Ot" tabindex="18">Otro   					
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
						                            <input type="radio"   name="radioSexo" value="F" tabindex="16">Femenino  								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio"  name="radioSexo" value="M" tabindex="17">Masculino    
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
						                            <input type="radio"   name="radioLugar" value="Te" tabindex="16">Los Teques   								
												</div>
										  </td>
													
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio"  name="radioLugar" value="Ce" tabindex="17">CEPRO    
												</div>										  
										  </td>
										  <td class="Detalle" width="20%">
												<div align="left">
						                            <input type="radio"  name="radioLugar" value="Ot" tabindex="17">Otro    
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
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												1. Conozco, entiendo y comparto la nueva visión,misión y de Intevep,SA.

										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio1" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio1" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio1" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio1" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio1" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												2. Mi nivel supervisorio me mantiene bien informado.

										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio2" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio2" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio2" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio2" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio2" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												3. 	Comprendo y comparto el proceso de cambio que vive mi país para consolidar nuestra soberanía, así como el rol
													protagónico que tienen todos los trabajadores de PDVSA en reafirmarla, y el cual ejerzo desde mi trabajo.


										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio3" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio3" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio3" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio3" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio3" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												4. Me siento estimulado a compartir mi conocimiento/experiencias con los demás.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio4" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio4" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio4" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio4" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio4" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												5. Cuento con todas las herramientas, equipos y material  necesarios para llevar a cabo mi trabajo.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio5" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio5" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio5" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio5" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio5" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
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
										<tr>
										  <td>&nbsp;</td>
									    </tr>										
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												6. Recibo la formación adecuada para desarrollar mi trabajo.



										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio6" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio6" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio6" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio6" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio6" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												7. El equipo gerencial y supervisorio modela  y practica los valores de  la nueva PDVSA.



										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio7" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio7" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio7" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio7" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio7" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												8. Soy tratado(a) con respeto y consideración, siendo mi talento valorado(por mis compañeros, 
												   supervisores y la gerencia).


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio8" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio8" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio8" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio8" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio8" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												9. Entiendo como el trabajo que desarrollo se relaciona con los objetivos de la organización.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio9" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio9" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio9" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio9" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio9" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												10. Los medios  oficiales de comunicación de la empresa (Notas de Interés,Buenas Noticias,  Carteleras etc) 
													son una buena fuente de información.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio10" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio10" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio10" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio10" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio10" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
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
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												11. Puedo contar con mis compañeros de trabajo cuando los necesito.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio11" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio11" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio11" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio11" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio11" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												12. Cuento con espacio suficiente y cómodo para hacer mi trabajo en  forma adecuada.



										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio12" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio12" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio12" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio12" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio12" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>						
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												13. Los programas de inducción para nuevos empleados son efectivos y oportunos.




										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio13" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio13" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio13" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio13" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio13" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>						
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												14. He sido víctima de acoso o maltrato laboral por parte de mi linea supervisoria 


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio14" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio14" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio14" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio14" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio14" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>						
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												15. Recibo una compensación salarial acorde con mis habilidades y experiencia.
 


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio15" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio15" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio15" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio15" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio15" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>						
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
										<tr>
										  <td>&nbsp;</td>
									    </tr>										
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												16. Estoy satisfecho y comprometido con las directrices estratégicas de mi organización.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio16" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio16" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio16" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio16" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio16" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												17. Mis compañeros de trabajo son abiertos y comunicativos.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio17" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio17" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio17" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio17" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio17" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												18. Estoy comprometido e involucrado con las actividades que demanda la empresa en lo social,comunal y cultural
													para alcanzar el socialismo bolivariano.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio18" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio18" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio18" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio18" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio18" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>										
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												19. En mi equipo, trabajamos juntos para resolver los problemas que estan a nuestro alcance.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio19" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio19" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio19" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio19" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio19" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>										
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												20. El ambiente físico de trabajo es adecuado (limpieza, orden, ruido, iluminación, etc.)

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio20" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio20" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio20" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio20" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio20" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
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
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												21. Los programas de formación y desarrollo disponibles en mi organización son efectivos y pertinentes.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio21" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio21" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio21" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio21" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio21" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												22. Conozco claramente lo que mi supervisor(a) espera de mi.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio22" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio22" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio22" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio22" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio22" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												23. Estoy satisfecho(a) con los beneficios de la empresa (Sicoprosa, IFA, vacaciones, plan de vivienda, etc.).


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio23" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio23" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio23" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio23" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio23" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>										
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												24. Conozco los objetivos organizacionales de la empresa, y de mi organización.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio24" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio24" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio24" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio24" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio24" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>										
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												25. Las reuniones  de trabajo con mi equipo son productivas.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio25" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio25" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio25" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio25" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio25" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>										
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
										<tr>
										  <td>&nbsp;</td>
									    </tr>										
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												26. Mi organización permite  balance entre la vida laboral y  personal.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio26" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio26" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio26" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio26" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio26" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												27. Quisiera tener mas y mejores oportunidades de adquirir nuevos conocimientos y habilidades.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio27" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio27" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio27" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio27" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio27" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												28. Recibo feedback adecuado por parte de mi supervisor(a) sobre la calidad de trabajo que realizo.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio28" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio28" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio28" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio28" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio28" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												29. Recibo mi pago a tiempo y en forma precisa.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio29" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio29" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio29" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio29" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio29" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												30. En mi equipo, yo participo en la toma de decisiones.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio30" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio30" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio30" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio30" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio30" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
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
										<tr>
										  <td>&nbsp;</td>
									    </tr>										
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												31. En mi equipo, se  aprecian las ideas, contribuciones o sugerencias.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio31" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio31" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio31" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio31" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio31" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												32. Cuento con la información documentada de los procesos que manejo y con  una descripción de mi cargo actualizada.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio32" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio32" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio32" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio32" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio32" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												33. Existen suficientes oportunidades de carrera/mejoramiento profesional en mi organización.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio33" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio33" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio33" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio33" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio33" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												34. Cada (año, semestre, trimestre) recibo una evaluación de mi desempeño.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio34" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio34" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio34" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio34" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio34" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												35. Los empleados de la organización que tienen ideas innovadoras son reconocidos.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio35" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio35" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio35" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio35" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio35" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
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
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												36. En mi equipo, puedo expresar mi punto de vista, aún cuando  contradiga el de los demás miembros.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio36" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio36" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio36" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio36" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio36" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												37. Mi organización cumple con las normativas de seguridad Industrial, higiene ocupacional y ambiente. 

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio37" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio37" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio37" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio37" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio37" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												38. Mi supervisor(a) me alienta a participar en programas de adiestramiento.
 

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio38" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio38" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio38" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio38" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio38" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												39. Es fácil acceder a mi supervisor(a) cuando lo (la) necesito.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio39" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio39" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio39" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio39" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio39" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												40. Mi trabajo es evaluado en forma justa.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio40" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio40" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio40" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio40" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio40" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
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
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												41. Mi supervisor me escucha con atención y empatía. 

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio41" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio41" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio41" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio41" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio41" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												42. Mi supervisor(a) es justo y respetuoso en el trato con sus supervisados(as).
 

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio42" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio42" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio42" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio42" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio42" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												43. Los reconocimientos, recompensas y beneficios son distribuidos  en forma justa y equitativa.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio43" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio43" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio43" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio43" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio43" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												44. Mi supervisor(a) conoce mis fortalezas y limitaciones.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio44" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio44" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio44" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio44" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio44" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>

										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												45. La empresa valora mi contribución personal en todos los retos y actividades que me son asignadas.

										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio45" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio45" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio45" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio45" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio45" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>
										<tr>
										  <td>&nbsp;</td>
									    </tr>
										<tr>
				                          <td class="Detalle" width="40%" height="28" >
												46. Mi gerencia refleja compromiso  con el proceso de cambio y es solidaria con sus acciones hacia las comunidades aledañas.


										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio46" value="1" tabindex="16">1   								
												</div>
										  </td>
													
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio46" value="2" tabindex="17">2
												</div>										  
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio46" value="3" tabindex="17">3    
												</div>										  
										  </td>
										  <td class="Detalle" >
						                        <div align="center">
						                            <input type="radio"   name="radio46" value="4" tabindex="16">4   								
												</div>
										  </td>
										  <td class="Detalle" >
												<div align="center">
						                            <input type="radio"  name="radio46" value="5" tabindex="17">5
												</div>										  
										  </td>
										</tr>





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
												<tr>
													<td >&nbsp;									</td>
													<td align="center" ><?php echo $pres->crearBoton("btnGuardar", "Guardar", "submit", ""); ?></td>

													<td>&nbsp;									</td>
											  </tr>
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
