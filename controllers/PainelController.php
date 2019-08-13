<?php

require_once "config/app.php";
require_once "includes/WebSocket.php";

class PainelController extends WebSocket {

	public function reload() {
		echo "<script>setTimeout(function(){document.location.reload(true);}, 10);</script>";
	}

}