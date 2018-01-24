<?php
include "clases/class.ConfigMagik.php";

class config{
    public $queryString;
    public $nombreAplicacion;
	public $ruta;
    public $rutaAccesos;
    public $rutaQuery;
    public $numTrabajadoresIntevep;
	
    function config(){
    	$path = '../configEncuesta.ini';
    	
		$Config = new ConfigMagik(true, true, $path);

	    $this->queryString = $Config->get('queryString', 'configuracion');
	    $this->nombreAplicacion = $Config->get( 'nombreAplicacion', 'configuracion');
		$this->ruta = $Config->get( 'ruta', 'configuracion');
	    $this->rutaAccesos = $Config->get( 'rutaAccesos', 'configuracion');
	    $this->rutaQuery = $Config->get( 'rutaQuery', 'configuracion');
	    $this->rutaError = $Config->get( 'rutaError', 'configuracion');
		$this->numTrabajadoresIntevep = $Config->get( 'numTrabajadoresIntevep', 'configuracion');
		 
	}
}
?>