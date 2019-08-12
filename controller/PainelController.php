<?php

require_once "functions.php";

class PainelController{

	private $host; 
	private $port;

	public function __construct($host, $port){

		$this->host = $host; 
		$this->port = $port;
		
	}

	function getMessage(){

		try{

			if(!($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)))
				throw new Exception("Não foi possível criar o socket", 1);

			if(!socket_bind($socket, $this->host, $this->port))
				throw new Exception("Não foi possível associar o endereço ao socket", 1);
		
			if(!socket_listen($socket, 1))
				throw new Exception("Não foi possível listar as conecções com o socket", 1);

			if(!($conn = socket_accept($socket)))
				throw new Exception("Não foi possível aceitar a conecção com o socket", 1);

			if(!$request = socket_read($conn, 1024))
				throw new Exception("Não foi possível ler a requisição", 1);

			$reply = "Senha {$request} chamada com sucesso!"; 

			if(!socket_write($conn, $reply, strlen($reply)))
				throw new Exception("Não foi possível enviar uma resposta", 1);

			socket_close($socket);

		}catch(Exception $e){
			dd($e->getMessage());
			//dd(socket_strerror(socket_last_error()));
		}

		return $request;
	}

	function reload(){
		echo "<script>setTimeout(function(){document.location.reload(true);}, 100);</script>";
	}
}