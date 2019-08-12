<html>
	<head>
		<meta charset="utf-8">
		<title>Gerrenciador de Senhas</title>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<!-- <script type="text/javascript" src="js/main.js"></script> -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<?php if(isset($_GET['resp'])) : ?>
		<p class="lead alert alert-success content-4 mt-5">
			<?php echo $_GET['resp'] != "exit" ? "Senha {$_GET['resp']} chamada com sucesso!" : "Painel parado com sucesso!"; ?>
		</p>
		<?php elseif(isset($_GET['erro'])): ?>
		<p class="lead alert alert-danger content-4 mt-5"> <?php echo $_GET['erro'] ?></p>
		<?php else: ?>
		<p class="content-4 mt-5"></p>
		<?php endif; ?>
		<form method="post" class="jumbotron content-4 mt-2" action="controller/ChamadaController.php">
			<?php isset($_GET['senha']) ? $senha = (int)$_GET['senha'] : $senha = 1 ?>
			<legend>Pr&oacute;xima Senha: <?php echo $senha?></legend>
			<input type="hidden" name="senha" id="senha" value="<?php echo $senha ?>">
			<button type="submit" class="btn btn-primary btn-lg" id="call">Chamar</button>
		</form>
		<form method="post" action="controller/ChamadaController.php" class="content-4"> 
			<input type="hidden" name="senha" value="exit">
			<button type="submit" class="btn text-primary float-right" id="call">Stop</button>
		</form>
	</body>
</html>