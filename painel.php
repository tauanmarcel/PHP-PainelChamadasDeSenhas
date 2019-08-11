<?php

require_once "config.php";
require_once "functions.php";
require_once "controller/PainelController.php";

$painel = new PainelController(_HOST_, _PORT_);

if(isset($_REQUEST['start'])){
	$senha = $painel->getMessage();
}

?>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/main.css">
<div class="jumbotron content-4 mt-2">
	<p class="display-4"><?php if(isset($senha) && $senha != "exit"){ echo "Senha " . $senha; $painel->reload(); } else { echo "Sem senha!"; unset($_REQUEST);} ?></p>
	<?php if(!isset($_REQUEST['start'])) : ?>
		<form method="post" >
			<p><input type="submit"  class="btn btn-primary btn-lg" name="start" value="Start"></p>
		</form>
	<?php endif; ?>
</div>


