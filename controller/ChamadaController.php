<?php
	
	require_once "../config.php";
	require_once "../classes/Chamada.php";
	require_once "../functions.php";

	$chamada = new Chamada(_HOST_, _PORT_);

	$goback = "../chamada.php";

	if(isset($_POST['senha']) && !empty($_POST['senha'])){

		$response = $chamada->chamar($_POST['senha']);

		if($response['erro'] == 1){
			$novaSenha = (int)$_POST['senha'];
			header("location:{$goback}?senha={$novaSenha}&erro=" . $response['mensagem']);
		}else{
			$novaSenha = (int)$_POST['senha'] + 1;
			header("location:{$goback}?senha={$novaSenha}&resp={$response}");	
		}

		
	}else{
		header("location:{$goback}");
	}

?>