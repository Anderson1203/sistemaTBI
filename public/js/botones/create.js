
$("#boton").click(function(){

  $(this).toggleClass("btn-danger btn-success");
  composer dump-autoload

});

function onSelectClientChange(){
	var client_id = $(this).val();
	//alert(client_id);
	//ajax
  	$.get('/api/sistema/'+client_id+'/mantener', function (data) {
		var html_select = '<option value="">Seleccione Zona</option>';
		for (var i=0; i<data.length; ++i)
			html_select = '<option value="'+data[i].IdZona+'">'+data[i].Nombre+'</option>';
		$('#selec-zon').html(html_select);
		// console.log(html_select)
	});

}
