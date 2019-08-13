<?php

require_once "../config/app.php";
require_once "../includes/WebSocket.php";
require_once "../includes/functions.php";

$chamada = new WebSocket(_HOST_, _PORT_);

$goback = "../chamada.php";

if(isset($_POST['senha']) && !empty($_POST['senha'])){

	$response = $chamada->send($_POST['senha']);

	if($response['error'] == 1){
		$novaSenha = (int)$_POST['senha'];
		header("location:{$goback}?senha={$novaSenha}&erro={$response['message']}");
	}else{
		$novaSenha = (int)$_POST['senha'] + 1;
		header("location:{$goback}?senha={$novaSenha}&resp={$response['reply']}");	
	}

}else{
	header("location:{$goback}");
}

?>