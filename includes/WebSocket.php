<?php

class WebSocket{

	private $host;
	private $port;
	private $byte;

	/**
	* Construtor da classe.
	* Inicializa os parâmetros necessários para manipular o WebSocket
	*/
	function __construct($host, $port, $byte = 1024){
		$this->host = $host;
		$this->port = $port;
		$this->byte = $byte;
	}

	/**
	* Cria um socket e associa a um endereço especificado no construtor.
	* Retorna um array com informações da conexão.
	*/
	function get(){
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
				throw new Exception("Não foi possível receber uma mensagem", 1);
			}

			if(!socket_write($conn, $reply, strlen($reply))){
				socket_close($socket);
				throw new Exception("Não foi possível enviar uma resposta", 1);
			}

			socket_close($socket);

			return array(
				"error"   => 0,
				"reply"   => $reply,
				"message" => "Successfull execution!"
			);

		}catch(Exception $e){
			return array(
				"error"   => 1,
				"reply"   => null,
				"message" => $e->getMessage(),
				"ws_error"=> socket_strerror(socket_last_error())
			);
		}
	}

	/**
	* Conecta  e envia uma mensagem para um socket existente. 
	* Retorna um array com informações da conexão.
	*/
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
				throw new Exception("Não foi possível obter uma resposta.", 1);
			}

			return array(
				"error"   => 0,
				"reply"   => $reply,
				"message" => "Successfull execution!"
			);

		}catch(Exception $e){
			return array(
				"error"   => 1,
				"reply"   => $reply,
				"message" => $e->getMessage(),
				"ws_error"=> socket_strerror(socket_last_error())
			);
		}
	}
}
?>