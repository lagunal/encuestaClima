<?php
include "postgresqlHelper.php";
include_once "../config.php";
  
class clad{
	private $pgHelper;

	private $ruta;
	
	function clad($conString=""){
		$this->ruta = "http://www.intevep.pdv.com/";
		
        if($conString==""){
            $conf = new config();
            $conString = $conf->queryString;
        }
        
        $this->pgHelper = new postgresqlHelper($conString);
    }

    public function setConectionString($conString){
        $this->conectionString=$conString;
    }

//BUSCADOR
	private function crearAND($patron, $datos, $and=false){
		$cadena = "";
		
		$datos = strtolower($datos);
		$trozos = explode(" ", $datos);

		foreach($trozos as $llave=>$valor){
			if($valor!=""){
				if($and) $cadena .= " AND ";

				$cadena .= str_replace("$", $valor, $patron);
			
				$and = true;
			}
		}
		
		return $cadena;
	}
	
	public function obtenerNormas($tipo, $palabras){
		$query = "SELECT tx_nombre, tx_ruta, tx_codigo FROM prueba_santp WHERE visible=1 AND ";
		$condicion = false;

		$palabra = trim($palabras);

		foreach($tipo as $llave=>$valor){
			switch ($valor){
				case "codigo":
					$query .= $this->crearAND(" (LOWER(tx_codigo) LIKE '%$%' OR tx_ruta LIKE ('%$%')) ", $palabra, $condicion);
					$condicion = true;
				break;
				case "titulo":
					//$query .= $this->crearAND(" LOWER(tx_nombre) LIKE '%$%' ", $palabra, $condicion);
					$query .= $this->crearAND(" prue_col_idx @@@ to_tsquery ('$:A') ", $palabra, $condicion);
					$condicion = true;
				break;
				case "contenido":
					$query .= $this->crearAND(" prue_col_idx @@@ to_tsquery ('$:B') ", $palabra, $condicion);
					$condicion = true;
				break;
			}
		}
		
		$query .= "ORDER BY tx_nombre DESC;";
		
		return $this->pgHelper->obtenerDatos($query);
	}


//PÁGINA PRINCIPAL
    public function obtenerPadre($ruta){
		$query = "SELECT codigo_padre FROM t_estructura WHERE codigo_estructura = '$ruta'";

        return $this->pgHelper->obtenerEscalar($query);
    }
	
    public function obtenerRutas($ruta, $tipo){
		$query = "SELECT * FROM t_estructura WHERE codigo_padre like '$ruta' AND tipo = $tipo ORDER BY orden, nombre";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerRutasRecientes($ruta){
		$query = "SELECT DISTINCT est.* FROM t_estructura est, prueba_santp ps
					WHERE visible=1 AND 
					codigo_padre like '$ruta' AND tipo<>1 AND ps.tx_ruta like '%' || est.codigo_estructura || '%'
					AND (position(substring(to_char(date_part('year', now())-1, '9999') from 4 for 2) IN tx_fecha)>0 OR 
				    position(substring(to_char(date_part('year', now()), '9999') from 4 for 2) IN tx_fecha)>0)
					ORDER BY orden, codigo_estructura";

		//echo $query;
        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerRutasPrincipales(){
        $query = "SELECT * FROM t_estructura WHERE principal=1 ORDER BY codigo_estructura";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerArchivos($ruta){
    	$ruta = $this->ruta . $ruta;
		
        //$query = "SELECT tx_ruta, tx_nombre, tx_codigo FROM prueba_santp WHERE tx_ruta<>'' ORDER BY 1";
		$query = "SELECT tx_ruta, tx_nombre, tx_codigo, fecha, revision FROM prueba_santp 
				  WHERE visible=1 AND upper(tx_ruta) like upper('$ruta%') ORDER BY 3,2";

		//echo $query;
        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerArchivosRecientes($ruta){
        //$query = "SELECT tx_ruta, tx_nombre, tx_codigo FROM prueba_santp WHERE (date_part('year', now()) - date_part('year', fecha))=1";
		/*$query = "SELECT tx_ruta, tx_nombre, tx_codigo FROM prueba_santp WHERE 
					position(substring(to_char(date_part('year', now())-1, '9999') from 4 for 2) IN tx_fecha)>0 OR 
					position(substring(to_char(date_part('year', now()), '9999') from 4 for 2) IN tx_fecha)>0";*/

    	$ruta = $this->ruta . $ruta;
		
        //$query = "SELECT tx_ruta, tx_nombre, tx_codigo FROM prueba_santp WHERE tx_ruta<>'' ORDER BY 1";
		$query = "SELECT tx_ruta, tx_nombre, tx_codigo, fecha, revision FROM prueba_santp 
					WHERE visible=1 AND tx_ruta like '$ruta%' AND
					(position(substring(to_char(date_part('year', now())-1, '9999') from 4 for 2) IN tx_fecha)>0 OR 
					position(substring(to_char(date_part('year', now()), '9999') from 4 for 2) IN tx_fecha)>0)
					ORDER BY 1";

		//echo $query;
        return $this->pgHelper->obtenerDatos($query);
    }


//SESIONES
    public function consultarBloqueoUsuario($id){
    	return $this->pgHelper->obtenerEscalar("SELECT count(*) FROM t_usuarios SET WHERE id='$id' AND bloqueado=1;");
    }

    public function bloquearUsuario($id, $bloqueo){
    	return $this->pgHelper->actualizarDatos("UPDATE t_usuarios SET bloqueado=$bloqueo WHERE id='$id';");
    }
	
	public function desbloquearUsuario($id){
    	return $this->pgHelper->actualizarDatos("UPDATE t_encuesta SET in_enviar='2' WHERE id_usuario='$id';");
    }

    public function crearSesion($id, $nombre){
    	if($this->consultarSesion($id)!=0){
    		$this->pgHelper->actualizarDatos("DELETE FROM t_sesion WHERE id='$id';");
    	}

       	return $this->pgHelper->actualizarDatos("INSERT INTO t_sesion (id, nombre_sesion) VALUES ('$id', '$nombre');");
    }

    public function consultarSesion($id){
        $query = "SELECT count(*) FROM t_sesion WHERE id='$id';";

        return $this->pgHelper->obtenerEscalar($query);
    }
	
    public function consultarSesionNombre($id, $nombre){
        $query = "SELECT count(*) FROM t_sesion WHERE id='$id' AND nombre_sesion='$nombre';";

        return $this->pgHelper->obtenerEscalar($query);
    }

//Logging de errores
    public function agregarError($num_err, $cadena_err, $archivo_err, $linea_err, $errcontext){
        return $this->pgHelper->actualizarDatos("SELECT func_insert_error($1, $2, $3, $4, $5);", array($num_err, $cadena_err, $archivo_err, $linea_err, $errcontext));
    }

    
//Opciones
    public function obtenerConfiguracion($id){
        $query = "SELECT DISTINCT cp.codigo_usuario, cp.actualizar, cp.rangografico, ce.codigo_equipo, mostrar FROM t_configuracion_personal cp, t_configuracion_equipos ce WHERE UPPER(cp.codigo_usuario)=UPPER(ce.codigo_usuario) AND UPPER(cp.codigo_usuario)=UPPER('$id');";

        return $this->pgHelper->obtenerDatos($query);
    }
    
    
//Acceso
    public function obtenerAcceso($id){
        $query = "SELECT acceso FROM t_lista_acceso WHERE codigo_usuario = '$id';";
        
        return $this->pgHelper->obtenerEscalar($query);
    }

//USUARIO
    public function obtenerRoles(){
        $query = "SELECT * FROM t_rol";

        return $this->pgHelper->obtenerDatos($query);
    }

	private function obtenerArreglo($datos){
		$res = array();
		
		foreach($datos as $llave=>$valor){
			foreach($valor as $llave2=>$valor2){
				$res[]= $valor2;
			}
		}
		
		return $res;
	}

   	public function buscarUsuariosAdministradores(){
    	$query = "SELECT count(id) FROM t_usuarios WHERE codigo_rol=1;";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function buscarRolUsuario($id){
    	$query = "SELECT t_usuario.id_rol FROM t_usuario WHERE id_usuario= LOWER('$id');";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }
	
 	public function obtenerIdUsuario(){
    	$query = "SELECT id_usuario FROM t_encuesta WHERE in_enviar = '1' order by id_usuario;";
    	
    	return $this->pgHelper->obtenerDatos($query);
    }
	
    public function buscarRecursosUsuario($id){
    	$query = "SELECT re.nombre_recurso FROM t_usuarios us, t_rol ro, t_recurso re, t_rol_recurso rr WHERE us.id = LOWER('$id') AND us.codigo_rol = ro.codigo_rol AND ro.codigo_rol = rr.codigo_rol AND rr.codigo_recurso = re.codigo_recurso;";
    	
    	return $this->obtenerArreglo($this->pgHelper->obtenerDatos($query));
    }

    public function obtenerUsuariosRoles(){
        $query = "select * from t_usuarios us, t_rol ro WHERE us.codigo_rol = ro.codigo_rol;";

        return $this->pgHelper->obtenerDatos($query);
    }
    
    public function buscarUsuario($id){
    	$query = "SELECT count(id_usuario) FROM t_usuario WHERE id_usuario=LOWER('$id');";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function eliminarUsuarioRol($id){
    	$query = "DELETE FROM t_usuarios WHERE id=LOWER('$id');";
    	
        return $this->pgHelper->actualizarDatos($query);
    }

    public function actualizarUsuarioRol($id, $rol){
    	$id = strtolower($id);

    	$query = "";
    	
    	if($this->buscarUsuario($id)==0){
    		$query = "INSERT INTO t_usuarios (id, codigo_rol) VALUES ('$id', $rol);";
    	}else{
    		$query = "UPDATE t_usuarios SET codigo_rol=$rol WHERE id=LOWER('$id')";
    	}
    	 
        return $this->pgHelper->actualizarDatos($query);
    }
//DATOS COMBOS ENCUESTA RHG
    public function obtenerProfesion(){
        $query = "SELECT * FROM t_profesion";

        return $this->pgHelper->obtenerDatos($query);
    }
    public function obtenerNivel(){
        $query = "SELECT * FROM t_instruccion";

        return $this->pgHelper->obtenerDatos($query);
    }
    public function obtenerEstado(){
        $query = "SELECT * FROM t_estado";

        return $this->pgHelper->obtenerDatos($query);
    }
    public function obtenerTipoVivienda(){
        $query = "SELECT * FROM t_tipo_vivienda";

        return $this->pgHelper->obtenerDatos($query);
    }
    public function obtenerBanco(){
        $query = "SELECT * FROM t_banco";

        return $this->pgHelper->obtenerDatos($query);
    }
    public function obtenerTenencia(){
        $query = "SELECT * FROM t_tenencia";

        return $this->pgHelper->obtenerDatos($query);
    }
	//OBTENER LOS DATOS DEL USUARIO	
    public function obtenerDatosUsuario($cedula){
        $query = "SELECT * FROM t_usuarioprofesion WHERE nu_cedula='$cedula';";

        return $this->pgHelper->obtenerDatos($query);
    }
//OBTENER LOS DATOS DE LA ENCUESTA RHG	
    public function obtenerDatosEncuesta($id){
        $query = "SELECT * FROM t_encuesta WHERE id_usuario=LOWER('$id');";

        return $this->pgHelper->obtenerDatos($query);
    }
	// Actualizar Usuario
 
	public function actualizarUsuario($id, $organization, $cedula, $nombre, $nomina, $fechaingreso) {
		$id = strtolower($id);
    	$query = "";
		if($this->buscarUsuario($id)==0){
			$query = "INSERT INTO t_usuario (id_usuario, tx_organizacion, id_rol, tx_cedula, tx_nom_usuario, tx_nomina, fe_ingreso) VALUES ('$id', '$organization', '1', '$cedula', '$nombre', '$nomina', to_date('$fechaingreso','dd/mm/yyyy'));";
			return $this->pgHelper->actualizarDatos($query);
		}
	}
//********************ENCUESTA CLIMA ORGANIZACIONAL 2010**************************************************//	
    public function obtenerPreguntas(){
        $query = "SELECT * FROM tc_pregunta order by cod_pregunta";

        return $this->pgHelper->obtenerDatos($query);
    }
	
	public function buscarUsuarioEncuesta($id){
    	$query = "SELECT count(id_usuario) FROM ts_encuesta WHERE id_usuario= '$id';";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }
	
// ACTUALIZAR RESPUESTAS  
	public function buscarCodEncuesta(){
    	$query = "SELECT nextval('seq_cod_encuesta');";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }
	
	public function buscarCodEncuestaActual(){

    	$query = "SELECT last_value FROM seq_cod_encuesta;";
		
    	return $this->pgHelper->obtenerEscalar($query);
    }
	
    public function actualizarEncuesta($id,$Organizacion, $Servicio,$Edad,$Nivel,$Sexo,$Lugar,
                                       	$radio){
    	$cod_encuesta = $this->buscarCodEncuesta();
		
		$query = "";
    	$query = "INSERT INTO 	ts_encuesta (cod_encuesta,tx_organizacion,tx_anos_servicio,tx_edad,tx_nivel,tx_sexo,tx_lugar,id_usuario)
											 VALUES ('$cod_encuesta', '$Organizacion','$Servicio','$Edad','$Nivel','$Sexo','$Lugar','$id');";
        $this->pgHelper->actualizarDatos($query);

		$cod_encuesta_actual = $this->buscarCodEncuestaActual();		
		$i=1; 
		foreach ($radio as $valor){	
		            if (strlen($i)==1){$cod_pregunta = "0".$i;}else{$cod_pregunta = $i;}
					$query = "";
					$query = "INSERT INTO 	ts_encuesta_detalle (cod_encuesta,cod_pregunta,tx_respuesta)
														 VALUES ('$cod_encuesta_actual','$cod_pregunta','$valor');";
					
					if ($i < count($radio)){
							$this->pgHelper->actualizarDatos($query);
					}else{
							return $this->pgHelper->actualizarDatos($query);
					}
					
		   $i++;
		}
	}

// REPORTES Y GRAFICOS 
    public function obtenerPorOrganizacion(){
        $query = "select count (*), tx_organizacion from ts_encuesta group by tx_organizacion";

        return $this->pgHelper->obtenerDatos($query);
    }
	
	public function obtenerTotalEncuestas(){
    	$query = "select count (*) from ts_encuesta";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }
	public function obtenerEncuestasOficina(){
    	$query = "select count (*) from ts_encuesta where id_usuario <> ''";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }	

	
}
?>