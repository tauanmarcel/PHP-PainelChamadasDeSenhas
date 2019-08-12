<?php
	
	require_once "../config.php";
	require_once "../classes/Chamada.php";
	require_once "../functions.php";

	$chamada = new Chamada(_HOST_, _PORT_);

	$goback = "../chamada.php";

	if(isset($_POST['senha']) && !empty($_POST['senha'])){

		$response = $chamada->send($_POST['senha']);

		if($response['error'] == 1){
			$novaSenha = (int)$_POST['senha'];
			header("location:{$goback}?senha={$novaSenha}&erro={$response['message']}");
		}else{
			$novaSenha = (int)$_POST['senha'] + 1;
			header("location:{$goback}?senha={$novaSenha}&resp={$response['message']}");	
		}

		// echo json_encode(
		// 	array(
		// 		"error"   => $response['error'],
		// 		"senha"   => $novaSenha,
		// 		"message" => $response['message']
		// 	)
		// );

		exit;

	}else{
		header("location:{$goback}");
	}

?>