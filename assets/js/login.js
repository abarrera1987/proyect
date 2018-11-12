$(document).ready(function(){

	$('#btnLogin').click(function(event){

		event.preventDefault();

		login();

	});

	$("#formLogin").keypress(function(e) {
	    if(e.which == 13) {

	        login();

	    }

	});

});

function login() {

	$('#errorForm').html("");

	if (!$('#email').val()) {

		$('#email').focus();
		$('#errorForm').html("Ingresa tu correo");

	} else if (!validarEmail($('#email').val())) {

		$('#email').focus();
		$('#errorForm').html("Ingresa un correo válido");

	} else if (!$('#pass').val()) {

		$('#pass').focus();
		$('#errorForm').html("Ingresa tu contraseña");

	} else {

		var formData = $('#formLogin').serialize();

		$.ajax({

			type: "POST",
			url: base_url+"login",
			cache: false,
			data: formData,
			beforeSend: showPopup("#loading"),
			success: function(response){

				if(response.trim() == 'true'){

					window.location.href = base_url+"lista_procesos";

				}else {

					closePopup("#loading");
					
					$.toast({

						heading: 'Error',
						text: 'Correo o contraseña invalidos',
						showHideTransition: 'fade',
						position: 'top-right',
						hideAfter: 2000,
						loaderBg: '#c60000',
						stack: false,
						icon: 'error'

					})

				}
			}

		})

	}

}