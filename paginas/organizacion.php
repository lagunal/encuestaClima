<?php
	include "../controles/header.php";

	include_once "../clases/cargarLog.php";
	$log = new Log();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title><?php echo $config->nombreAplicacion; ?></title>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>   
	<script language="JavaScript" type="text/javascript" src="../js/injectionJS.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/noticias.js"></script>
</head>
<body>
<table width="760px" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<?php echo $pres->crearEncabezado($config->nombreAplicacion); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				$texto = "<a href='principal.php' class='link_blanco'>Inicio</a>&nbsp;-&nbsp;" .
						 "<a href='organizacion.php' class='link_blanco'>Organización</a>&nbsp;-&nbsp;" .
						 "<a href='servicios.php' class='link_blanco'>Servicios</a>&nbsp;-&nbsp;" .
						 "<a href='javascript:verNoticiasOtro()' class='link_blanco'>Noticias</a>&nbsp;-&nbsp;" .
						 "<a href='javascript:verUltimasOtro()' class='link_blanco'>Últimas Normas</a>";
				
				echo $pres->crearVentanaInicioSinMenu($texto);
				echo $pres->crearVentanaIntermedia();
			?>
			<table cellpadding="0" cellspacing="0" border="0" width="760px" height="100%">
				<tr>
					<td valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td width="460px" valign="top">
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
											<tr>
												<td height="5px"></td>
											</tr>
										
										<tr>
											<td valign="top">
												<table cellpadding="0" cellspacing="0" border="0" width="460px">
													<tr>
														<td class="Titulo" colspan="2">
															MISIÓN
														</td>
													</tr>
													<tr>
														<td height="5px"></td>
													</tr>
													<tr>
														<td class="Detalle" valign="top" height="30px">
							“Promover y coordinar el proceso de desarrollo, revisión y actualización de Normas Técnicas 															
							PDVSA para contribuir con la continuidad operacional, independencia y desarrollo técnico de la 
							corporación”.
														</td>
														<tr>
														<td class="Detalle" align = "right" valign="top" height="40px">
																						Rev. 01, Nov. 08
														</td>
														</tr>
													</tr>
											<TR>
											<td class="Titulo">
												VISIÓN
											</td>
											</TR>
											<tr>
												<td height="5px"></td>
											</tr>
													<tr>
														<td class="Detalle" valign="top" height="30px">
							 “Ser el proceso especializado en Normalización Técnica, reconocido a nivel nacional e 
							  internacional por su contribución al desarrollo de la Industria Petrolera y la Sociedad, con alta
							  capacidad para brindar servicios y productos de excelencia a sus clientes, con un personal 
							  especializado, altamente motivado y comprometido con la mejora continua de la eficacia y 
							  eficiencia de su proceso y su Sistema de Gestión de la Calidad, para satisfacer las necesidades de la 
   							  corporación”.
														</td>
														<tr>
														<td class="Detalle" align = "right" valign="top" height="40px">
																						Rev. 01, Nov. 08
														</td>
														</tr>
													</tr>
											
											
												</table>
											</td>
										</tr>
										<tr>
											<td class="Titulo">
												POLÍTICA Y OBJETIVOS DE CALIDAD DEL PROCESO NOR
											</td>
										</tr>
										<tr>
											<td height="5px"></td>
										</tr>
										<tr>
											<td class="Detalle" valign="top" height="50px">
							La Alta Dirección y el personal de Proceso NOR pertenecientes a la Gerencia Técnica del Centro de 
							Información Técnica (SGCIT), se compromete a cumplir con los requisitos para satisfacer las 
							necesidades y expectativas de sus clientes, ofreciendo su servicio en el área de Normalización 
							Técnica Corporativa, realizado por un equipo humano competente, motivado y comprometido con 
							la mejora continua y eficacia del proceso y del Sistema de Gestión de la Calidad (SGC), para ello 
							nos hemos propuesto los siguientes Objetivos de la Calidad:
											</td>
											<tr>
												<td height="5px"></td>
											</tr>
												<tr>
													<td class="Detalle" align = "left" valign="top" height="40px">
														<img src='../imagenes/flechita.gif'>&nbsp&nbsp Cumplir con los planes de elaboración o revisión de Normas Técnicas PDVSA.<br>
														<img src='../imagenes/flechita.gif'>&nbsp&nbsp Mantener actualizado el Sistema Automatizado de Normas Técnicas PDVSA (SANTP®) en la Intranet.<br>
														<img src='../imagenes/flechita.gif'>&nbsp&nbsp Atender eficientemente las solicitudes de elaboración o revisión de Normas Técnicas PDVSA.<br>
														<img src='../imagenes/flechita.gif'>&nbsp&nbsp Cumplir con los programas de formación para el Personal del Proceso NOR.<br>
														<img src='../imagenes/flechita.gif'>&nbsp&nbsp Satisfacer las necesidades de los clientes.<br>
														<img src='../imagenes/flechita.gif'>&nbsp&nbsp Mejorar continuamente el SGC y el Proceso NOR.<br>
													</td>
														<tr>
														<td class="Detalle" align = "right" valign="top" height="40px">
																						Rev. 01, Nov. 08
														</td>
														</tr>

												</tr>
										</tr>
									</table>
								</td>
								<td width="5px" class="Fondo-puntoVe-2"></td>
								<td width="285px" valign="top">
									

									<table cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td height="25px"></td>
											</tr>
										<tr>
											<td  class="Titulo" align="right">
												ENLACES DE INTERÉS
											</td>
										</tr>
										<tr>
											<td height="10px"></td>
										</tr>
										<tr>
											<td align="right">
												<a href='http://www.gobiernoenlinea.ve/legislacion-view/view/ver_legislacion.pag' class='TextoLink' target="_blank">Leyes Venezolanas</a>  
											</td>
										</tr>
										<tr>
											<td height="15px"></td>
										</tr>
										<tr>
											<td  class="Titulo" align="right">
												MAPA DE PROCESOS NOR
											</td>
										</tr>
										<tr>
											<td height="10px"></td>
										</tr>
										<tr>
											<td align="right">
												<a href='../imagenes/Mapa_NOR.png' class='TextoLink' target="_blank">Mapa de Procesos</a>  
											</td>
										</tr>
										<tr>
											<td height="10px"></td>
										</tr>
										<tr>
											<td colspan="3" align="right">
												<table class="Fondonorma" border="0" width="85px" height="110px">
													<tr>
														<td></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="3" align="right">
												<OBJECT HEIGHT="77">
													<PARAM NAME="MOVIE" VALUE="banner_SANTP.swf">
													<param name="quality" value="high">
													<EMBED SRC="../imagenes/banner_SANTP.swf" WIDTH="280" HEIGHT="320"></EMBED>
												</OBJECT>
											</td>
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
		<td>
			<?php echo $pres->crearPie(); ?>
		</td>
	</tr>
</table>
</body>
</html>