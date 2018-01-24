function verNoticias(tipo){
	frame = document.getElementById('frmNormas');
    ruta = "";
	
	switch(tipo) {
		case 0:
			ruta = "../controles/indiceNormas.php?rec=0";
		break;
		case 1:
			ruta = "../controles/indiceNormas.php?noti=1";
		break;
		case 2:
			ruta = "../controles/indiceNormas.php?rec=1";
		break;
	}

	frame.src = ruta;
}

function verNoticiasOtro(){
	window.location = "principal.php?noti=1";
}

function verUltimasOtro(){
	window.location = "principal.php?rec=1";
}

