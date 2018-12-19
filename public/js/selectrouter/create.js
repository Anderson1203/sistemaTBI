$(document).on(function() {

	$('.selec-router').on('change',onSelectClientChange);
alert('enrre');
});


function onSelectClientChange(){

	var client_id = $('.selec-router').find(':selected').val();
  console.log(client_id);
	//alert(client_id);
	//ajax
  	$.get('/api/proyecto/'+client_id+'/niveles', function (data) {
		var html_select = '<option value="">Seleccione Zona</option>';
		for (var i=0; i<data.length; ++i)
			html_select = '<option value="'+data[i].IdZona+'">'+data[i].Nombre+'</option>';
		$('#selec-zon').html(html_select);
		// console.log(html_select)
	});

}
