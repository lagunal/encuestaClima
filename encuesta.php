<?php 
session_start();
require_once('../Connections/conex.php'); 
require_once('../logica/funciones.php'); 
?>
<?php

extract($_REQUEST);

mysql_select_db($database_conex, $conex);
$query_encuesta = sprintf("SELECT * FROM encuesta WHERE id_encuesta = %s", GetSQLValueString($id_encuesta, "int"));
$encuesta = mysql_query($query_encuesta, $conex) or die(mysql_error());
$row_encuesta = mysql_fetch_assoc($encuesta);
$totalRows_encuesta = mysql_num_rows($encuesta);

//mysql_select_db($database_conex, $conex);
$query_titulo = sprintf("SELECT * FROM titulo_grupo WHERE id_encuesta = %s and in_estado = 'A' AND in_padre = 0 ORDER BY in_orden ASC", GetSQLValueString($id_encuesta, "int"));
$titulo = mysql_query($query_titulo, $conex) or die(mysql_error());
$row_titulo = mysql_fetch_assoc($titulo);
$totalRows_titulo = mysql_num_rows($titulo);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../logica/genint.js"></script>
<title><?php echo saltodelinea($row_encuesta['tx_titulo_encuesta']); ?></title>
<link href="../css/encuesta.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {
	color: #FF0000;
	font-size: 12px;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <tr>
    <td width="13" height="35" valign="top" background="css/imagenes/v_back_izq.gif"><img src="css/imagenes/v_esq_izq_sup.gif" width="13" height="32" /></td>
    <td height="35" valign="middle" background="css/imagenes/v_back_sup.jpeg"><div align="center" class="tituloazul"><strong>DATOS DE LA ENCUESTA</strong></div></td>
    <td width="13" height="35" valign="top" background="css/imagenes/v_back_der.gif"><img src="css/imagenes/v_esq_der_sup.gif" width="13" height="32" /></td>
  </tr>
  </tr>
  <tr>
    <td width="13" height="10" background="css/imagenes/v_back_izq.gif">&nbsp;</td>
        <td height="10">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div align="center"></div></td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center" class="tituloencuesta"><?php echo saltodelinea($row_encuesta['tx_titulo_encuesta']); ?></div></td>
                      </tr>
                      <tr>
                        <td class="textonegro"><div align="justify"><?php echo  saltodelinea($row_encuesta['tx_desc_encuesta']); ?></div></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center" class="tituloencuesta">INSTRUCCIONES</div></td>
                      </tr>
                      <tr>
                        <td class="textonegro"><?php echo saltodelinea($row_encuesta['tx_instruc_encuesta']); ?></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>
                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td bgcolor="#EEEEEE"><div align="center" class="tituloencuesta">RENGLONES</div></td>
                              </tr>
                              <?php do { ?>
                              <tr>
<!--********************DETALLE DE LA ENCUESTA*******************************************************************-->
<?php
//extract($_REQUEST);
$id_titulo = $row_titulo['id_titulo'];
$id_encuesta = $id_encuesta;
$tx_titulo = $row_titulo['tx_titulo'];


//mysql_select_db($database_conex, $conex);
$query_hijos = sprintf("SELECT * FROM titulo_grupo a, tipo_item b WHERE a.id_tipo_item = b.id_tipo_item AND a.id_encuesta = %s AND a.in_padre = %s AND a.in_estado = 'A' AND b.in_estado = 'A' ORDER BY in_orden", GetSQLValueString($id_encuesta, "int"), GetSQLValueString($id_titulo, "int"));
//$query_hijos = sprintf("SELECT * FROM titulo_grupo a, tipo_item b, item_encuesta c WHERE a.id_encuesta = c.id_encuesta AND a.id_titulo = c.id_titulo AND b.id_tipo_item = c.id_tipo_item AND a.id_encuesta = %s AND a.in_padre = %s AND a.in_estado = 'A' AND b.in_estado = 'A' ORDER BY a.in_orden", GetSQLValueString($id_encuesta, "int"), GetSQLValueString($id_titulo, "int"));

$hijos = mysql_query($query_hijos, $conex) or die(mysql_error());
$row_hijos = mysql_fetch_assoc($hijos);
$totalRows_hijos = mysql_num_rows($hijos);



//echo $query_hijos;
/*
$query_items = sprintf("SELECT * FROM item_encuesta a, tipo_item b WHERE a.id_tipo_item = b.id_tipo_item AND a.in_estado = 'A' AND b.in_estado = 'A' AND id_encuesta = %s AND id_titulo = %s ORDER BY in_orden", GetSQLValueString($id_encuesta, "int"), GetSQLValueString($id_titulo, "int"));
$items = mysql_query($query_items, $conex) or die(mysql_error());
$row_items = mysql_fetch_assoc($items);
$totalRows_items = mysql_num_rows($items);
*/

$fondo = array('#FFFFFF','#EEEEEE');
$j=1;
?>
    
<?php do {
	$query_items = sprintf("SELECT * FROM item_encuesta WHERE in_estado = 'A' AND id_encuesta = %s AND id_titulo = %s ORDER BY in_orden", GetSQLValueString($id_encuesta, "int"), GetSQLValueString($row_hijos['id_titulo'], "int"));
	$items = mysql_query($query_items, $conex) or die(mysql_error());
	$row_items = mysql_fetch_assoc($items);
	$totalRows_items = mysql_num_rows($items);
	
	if ($totalRows_items > 0){
	?>
    	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class='tituloazul'>
            <tr>
                <?php
                if ($row_hijos['in_orientacion'] == 'H') {
                    echo "<td width='80%' align='RIGHT'>".$row_hijos['tx_desc_campos']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                    for ($i = 1; $i <= $row_hijos['nu_opciones']; $i++) {
                        //echo "<td>".$i."</td>";
						//echo "<td></td>";
                    }
                }elseif(($row_hijos['in_orientacion'] == 'V')&&(strtoupper($row_hijos['tx_nom_tipo_item']) == 'CERRADA')) {
                    echo "<td width='100%'>Marque &uacute;nicamente una respuesta por cada pregunta</td>";
                }else{
					echo "<td width='100%'>Seleccione las opciones de su preferencia</td>";
				}
                ?>
            </tr>
        </table>
        <br>
        <?php
		if(strtoupper($row_hijos['tx_nom_tipo_item']) == 'MULTIPLE') {
			echo "<form id='".$id_encuesta.$row_hijos['id_titulo']."' method='post'>";
		}
		?>
        <fieldset>
        <legend class="titulogrupo"><?php echo $row_hijos['tx_titulo']?></legend>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            <?php do {?>
            
            <tr bgcolor="<?php echo $fondo[$j];?>">
            	<?php 
				if ($row_hijos['in_orientacion'] == 'H') {
				?>
                	<td width="80%"><span class="textonegro"><?php echo $row_items['tx_item_encuesta']?></span></td>
                <?php 
				}
				?>
                <td><span class="tituloazul"> <?php crearopciones($conex, $id_encuesta,$row_hijos['id_titulo'],$row_items['id_item_encuesta'],$row_hijos['tx_nom_tipo_item'], $row_hijos['in_orientacion'], $row_hijos['nu_opciones'],$row_hijos['tx_titulo']);?></span></td>
            </tr>
            <?php 
				if ($j==0){	$j=1; }else{ $j=0; }
			} while ($row_items = mysql_fetch_assoc($items));?>
        </table>
        </fieldset>
        <?php
        if(strtoupper($row_hijos['tx_nom_tipo_item']) == 'MULTIPLE') {
			echo "</form>";
		}
		?>
        <br>
<?php
	} 
} while ($row_hijos = mysql_fetch_assoc($hijos));

mysql_free_result($hijos);
?>

<!--*********************FIN DEL DETALLE DE LA ENCUESTA*************************************************************-->

                              </tr>
                              
                              <?php } while ($row_titulo = mysql_fetch_assoc($titulo)); ?>
                            </table><br>
                            <div id='detalleencuesta'></div>                         </td>
                      </tr>
                    </table></td>
                  </tr>
				  
<tr>
	<td align="center">
		<input name='opcion' type='button' class='textonegro' id='opcion' value='Enviar' onclick= "<?php echo $_SESSION['enviarTodo'];?>alert('Su encuesta fue enviada. Muchas Gracias por su tiempo.!');cargarContenido('encuesta','paginas/blanca.php','get');" ></td>

</tr>				  
<br>
				  <tr>
				  	<td><div align="center" class="textonegro"><?php echo $row_encuesta['id_calidad']; ?></div><br></td></tr>
                  <tr>																										
                    <td><div align="center" class="tituloazul">El díalogo continúa, gracias por su participación</div><br></td>
                  </tr>
<!--                  <tr>
                    <td><div align="center" class="tituloazul style2">Su encuesta ES GUARDADA de manera automática</div>
                    <br></td>
                  </tr>-->
                  <tr>
                    <td><div align="center" class="tituloazul style2">RECUERDE QUE SU OPINIÓN ES TOTALMENTE CONFIDENCIAL</div>
                      <br></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </td>
    <td width="13" height="10" background="css/imagenes/v_back_der.gif">&nbsp;</td>
  </tr>
  <tr>
    <td width="13" height="12" valign="top"><img src="css/imagenes/v_esq_izq_inf.gif" width="13" height="12" /></td>
    <td valign="top" height="12" background="css/imagenes/v_back_inf.gif" style="background-repeat:repeat-x"></td>
    <td width="13" height="12" valign="top"><img src="css/imagenes/v_esq_der_inf.gif" width="13" height="12" /></td>
  </tr>
</table>


<div id='guarda'></div>
</body>
</html>
<?php
mysql_free_result($titulo);

mysql_free_result($encuesta);
?>
