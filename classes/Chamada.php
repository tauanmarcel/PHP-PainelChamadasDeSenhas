<?php

class Chamada{

	private $host;
	private $port;
	private $byte;

	function __construct($host, $port, $byte = 1024){
		$this->host = $host;
		$this->port = $port;
		$this->byte = $byte;
	}

	public function chamar($senha){

		try{

			if(!$socket = socket_create(AF_INET, SOCK_STREAM, 0))
				throw new Exception("Não foi possível criar o socket.", 1);

			if(!socket_connect($socket, $this->host, $this->port))
				throw new Exception("Não foi possível conectar o socket.", 1);

			if(!socket_write($socket, $senha, strlen($senha)))
				throw new Exception("Não foi possível enviar uma resposta.", 1);

			if(!($reply = socket_read($socket, $this->byte)))
				throw new Exception("Não foi possível ler a mensagem enviada.", 1);
		
		}catch(Exception $e){
			return array(
				"erro" => 1,
				"mensagem" => $e->getMessage()
			);
		}

		return $reply;
	}
}
?>