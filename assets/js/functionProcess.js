$(document).ready(function(){

	$('#dateFilter').datepicker({

		format: "yyyy-mm-dd"

	});

	$('#btnCleanFilter').on("click", function(event){

		event.preventDefault();

		window.location.href = base_url+"lista_procesos";

	})

	

	// $("#btnCreateProcess").on("click", function(){

		// $("#descriptionProcess").val("");
		// $("#headquartersProcess").val("");
		// $("#budgetProcess").val("");
		// $("#newProcessNumber").val("");

	// 	$.ajax({

	// 		type: "POST",
	// 		url: base_url+"newProcessModal",
	// 		cache: false,
	// 		success:function(response){

	// 			if(response.trim() != "false"){

	// 				var data = response.split("@");

	// 				$("#newProcessNumber").val("");
	// 				$("#newProcessNumber").val(data[0]);
	// 				$("#numProcessLabel").text("");
	// 				$("#numProcessLabel").text(data[1]);
	// 				$('#newProcessModal').modal('show');

	// 			}
	// 		}
	// 	})
	// })

})

function updateContadorTa(textPush) {

	var max = 200;

	var contador = $("#countText");

	var ta = textPush;

	contador.html("0/"+max);

	contador.html(ta.length+"/"+max);

	if(parseInt(ta.length)>max) {

		ta.val(ta.substring(0,max-1));

		contador.html(max+"/"+max);

	}

}

function createProcess() {
	
	if(!$("#descriptionProcess").val()){

		$("#descriptionProcess").focus();
		$("#errorForm").text("Debe ingresar una descrición");
		return false;

	}else if($("#headquartersProcess").val() == 0){

		$("#headquartersProcess").focus();
		$("#errorForm").text("Debe seleccionar una sede");
		return false;

	}else if(!$("#budgetProcess").val()){

		$("#budgetProcess").focus();
		$("#errorForm").text("Debe ingresar un presupuesto");
		return false;

	}else {

		$('#newProcessModal').modal('hide');

		parameters = {

			'descriptionProcess': $("#descriptionProcess").val(),
			'headquartersProcess': $("#headquartersProcess").val(),
			'budgetProcess': $("#budgetProcess").val()

		}
		
		$.ajax({

			type: "POST",
			url: base_url+"createProcess",
			cache: false,
			data: parameters,
			beforeSend: showPopup("#loading"),
			success: function(response){

				closePopup("#loading");

				if(response.trim() != "false"){

					$.toast({

						heading: 'Gracias',
						text: 'Proceso No. '+response+' generado con exito',
						showHideTransition: 'fade',
						position: 'top-right',
						hideAfter: 2100,
						loaderBg: '#08590c',
						stack: false,
						icon: 'success'

					})

					setTimeout(function() {
						location.reload();
					}, 2100);

				}else {

					$.toast({

						heading: 'Error',
						text: 'Algo paso intentelo más tarde',
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

function editProcess(idProcess){

	$("#descriptionProcess").val("");
	$("#headquartersProcess").val("");
	$("#budgetProcess").val("");
	$("#idProcessNumber").val("");

	parameters = {

		"idProcess": idProcess

	}

	$.ajax({

		type: "POST",
		dataType: "json",
		url: base_url+"getProcessData",
		cache: false,
		data: parameters,
		beforeSend: showPopup("#cargando"),
		success: function(response) {

			closePopup("#loading");

			for (var i = 0; i < response.length; i++) {

				num = response[i]['budget'].toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
				num = num.split('').reverse().join('').replace(/^[\.]/,'');
				// input.value = num;

				$("#descriptionProcessEdit").val(response[i]['description'])
				$("#headquartersProcessEdit").val(response[i]['id_hq'])
				$("#budgetProcessEdit").val(num)
				$("#numProcessLabelEdit").text("");
				$("#numProcessLabelEdit").text(response[i]['process_number']);
				$("#idProcessNumberEdit").val(response[i]['id']);
				$('#editProcessModal').modal('show');
				
			}
		}
	})
}


function validateForm() {

	if(!$("#descriptionProcessEdit").val()){

		$("#descriptionProcessEdit").focus();
		$("#errorForm").text("Debe ingresar una descrición");
		return false;

	}else if($("#headquartersProcessEdit").val() == 0){

		$("#headquartersProcessEdit").focus();
		$("#errorForm").text("Debe seleccionar una sede");
		return false;

	}else if(!$("#budgetProcessEdit").val()){

		$("#budgetProcessEdit").focus();
		$("#errorForm").text("Debe ingresar un presupuesto");
		return false;

	}else {

		return true

	}

}


function updateProcess() {
	
	if(validateForm()) {

		$('#editProcessModal').modal('hide');

		parameters = {

			'descriptionProcessEdit': $("#descriptionProcessEdit").val(),
			'headquartersProcessEdit': $("#headquartersProcessEdit").val(),
			'budgetProcessEdit': $("#budgetProcessEdit").val(),
			'idProcessNumberEdit': $("#idProcessNumberEdit").val()

		}
		
		$.ajax({

			type: "POST",
			url: base_url+"updateProcess",
			cache: false,
			data: parameters,
			beforeSend: showPopup("#loading"),
			success: function(response){

				closePopup("#loading");

				if(response.trim() != "false"){

					$.toast({

						heading: 'Gracias',
						text: 'Proceso actualizado con exito',
						showHideTransition: 'fade',
						position: 'top-right',
						hideAfter: 2100,
						loaderBg: '#08590c',
						stack: false,
						icon: 'success'

					})

					setTimeout(function() {
						location.reload();
					}, 2100);

				}else {

					$.toast({

						heading: 'Error',
						text: 'Algo paso intentelo más tarde',
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
