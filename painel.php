<?php

require_once "config/app.php";
require_once "includes/functions.php";
require_once "controllers/PainelController.php";

$painel = new PainelController(_HOST_, _PORT_);

if(isset($_REQUEST['start'])){
	$response = $painel->get();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Painel de Chamadas</title>
		<link rel="stylesheet" href="public/css/bootstrap.css">
		<link rel="stylesheet" href="public/css/main.css">
	</head>
	<body>
		<center><h1 class="display-4 mt-5 mb-4 text-info">Painel de Chamada</h1></center>
		<div class="jumbotron content-4 mt-2">
			<p class="display-4 text-danger">
				<?php 
					if(isset($response) && $response['reply'] != "exit" && $response['error'] != 1){ 
						echo "Senha " . $response['reply'];
						$painel->reload(); 
					} else { 
						echo "Sem senha!"; 
						unset($_REQUEST);
					} 
				?>
			</p>
		</div>
	</body>
</html>