$(document).ready(inicio)
function inicio(){
	$(".botoncompra").click(anade);
	$("#carrito").load("productos/poncarrito.php");
}

function anade(){
	//alert("Estamos en JS");
    var idnumero = $(this).val();
	var cantidad = $("#num"+idnumero).val();
	//alert(cantidad);
	$("#carrito").load("productos/poncarrito.php?p="+$(this).val()+"&cant="+cantidad);
}
