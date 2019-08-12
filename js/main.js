$(document).ready(function(){
	$("#call").click(function(e){
		e.preventDefault();
		senha = $("#senha").val();

		$.ajax({
			type: "post",
			url: "controller/ChamadaController.php",
			data: {senha: senha},

			success: function(data){
				data = JSON.parse(data);

				if(data != "" && data.error == 0){
					$(".alert-success").text(`Senha ${data.senha} chamada com sucesso!`);
					$("#senha").val(data.senha);
				}else if(data.error == 1){
					$(".alert-success").text(data.message);
					$("#senha").val(data.senha);
				}
			},
			error: function(error){
				console.log(error);
			}
		});
	});
});