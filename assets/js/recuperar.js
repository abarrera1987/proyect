$(document).ready(function(){

	$('#btn_recuperar').click(function(event){

		event.preventDefault();
		$('#form_error').html();
	
		if ($('#correo').val() == '')
		{	
			$('#correo').focus();
			$('#form_error').html("Ingresa tu correo");
		}
		else if (!validarEmail($('#correo').val()))
		{	
			$('#correo').focus();
			$('#form_error').html("Ingresa un correo válido");
		}
		else
		{
			$("#form_recuperar").submit();
		}
	});

});