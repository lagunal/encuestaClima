
/* no deja escribir caracteres que no sean numeros */
function ValidarNumero(obj, e) {
	var ch = obj.value;
	var tmp = "";
	var code;
	ch.toString();

	if(document.all) code = event.keyCode;
	else code = e.keyCode;
	if (code!=8 && code != 9 && code != 16) 
	{ 
		for (i=0; i<ch.length; i++) 
		{
			if (!isNaN(ch.charAt(i)) && ch.charAt(i) != " ") { tmp += ch.charAt(i) }
		}
    obj.value = tmp;
	}
} 
function SumarEgresos(obj){
	var total=0;
	var alimentacion;
	var vivienda;
	var educacion;
	var gastos;
	var transporte;
	var servicios;
	var recreacion;
	var pension;
	var otros;
	
	alimentacion = parseInt(document.getElementById("txtAlimentacion").value);
	vivienda = parseInt(document.getElementById("txtVivienda").value);
	educacion = parseInt(document.getElementById("txtEducacion").value);
	gastos = parseInt(document.getElementById("txtGastos").value);
	transporte = parseInt(document.getElementById("txtTransporte").value);
	servicios = parseInt(document.getElementById("txtServicios").value);
	recreacion = parseInt(document.getElementById("txtRecreacion").value);
	pension = parseInt(document.getElementById("txtPension").value);
	otros = parseInt(document.getElementById("txtOtrosEgresos").value);
	
	if (!isNaN(alimentacion)) {total = total + alimentacion;}
	if (!isNaN(vivienda)) {total = total + vivienda;}
	if (!isNaN(educacion)) {total = total + educacion;}
	if (!isNaN(gastos)) {total = total + gastos;}
	if (!isNaN(transporte)){ total = total + transporte;}
	if (!isNaN(servicios )) {total = total + servicios;}
	if (!isNaN(recreacion )) {total = total +recreacion;}
	if (!isNaN(pension )) {total = total + pension;}
	if (!isNaN(otros)) {total = total + otros;}


	 document.getElementById("txtTotalEgresos").value = total;

	
}