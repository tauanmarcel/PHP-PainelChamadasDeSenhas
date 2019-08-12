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

			if(!socket_bind($socket, $this->host, $this->port)){
				socket_close($socket);
				throw new Exception("Não foi possível associar o endereço ao socket", 1);
			}
		
			if(!socket_listen($socket, 1)){
				socket_close($socket);
				throw new Exception("Não foi possível listar as conexões com o socket", 1);
			}

			if(!($conn = socket_accept($socket))){
				socket_close($socket);
				throw new Exception("Não foi possível aceitar a conexão com o socket", 1);
			}

			if(!$reply = socket_read($conn, 1024)){
				socket_close($socket);
				throw new Exception("Não foi possível ler a requisição", 1);
			}

			if(!socket_write($conn, $reply, strlen($reply))){
				socket_close($socket);
				throw new Exception("Não foi possível enviar uma resposta", 1);
			}

			socket_close($socket);

			return $reply;

		}catch(Exception $e){
			dd($e->getMessage());
			//dd(socket_strerror(socket_last_error()));
		}
	}

	function reload(){
		echo "<script>setTimeout(function(){document.location.reload(true);}, 10);</script>";
	}
}