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

	public function send($str){
		try{

			if(!$socket = socket_create(AF_INET, SOCK_STREAM, 0))
				throw new Exception("Não foi possível criar o socket.", 1);

			if(!socket_connect($socket, $this->host, $this->port)){
				throw new Exception("Não foi possível conectar ao socket.", 1);
				socket_close($socket);
			}

			if(!socket_write($socket, $str, strlen($str))){
				socket_close($socket);
				throw new Exception("Não foi possível enviar uma resposta.", 1);
			}

			if(!($reply = socket_read($socket, $this->byte))){
				socket_close($socket);
				throw new Exception("Não foi possível ler a mensagem enviada.", 1);
			}

			return array(
				"error" => 0,
				"reply" => $reply
			);
		
		}catch(Exception $e){
			return array(
				"error" => 1,
				"message" => $e->getMessage()
			);
		}
	}
}
?>