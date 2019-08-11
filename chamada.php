<html>
	<head>
		<meta charset="utf-8">
		<title>Gerrenciador de Senhas</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<?php if(isset($_GET['resp'])) : ?>
		<p class="lead alert alert-success content-4 mt-5"> <?php echo $_GET['resp'] ?></p>
		<?php elseif(isset($_GET['erro'])): ?>
		<p class="lead alert alert-danger content-4 mt-5"> <?php echo $_GET['erro'] ?></p>
		<?php else: ?>
		<p class="content-4 mt-5"></p>
		<?php endif; ?>
		<form method="post" class="jumbotron content-4 mt-2" action="controller/ChamadaController.php">
			<?php isset($_GET['senha']) ? $senha = (int)$_GET['senha'] : $senha = 1 ?>
			<legend>Próxima Senha: <?php echo $senha?></legend>
			<input type="hidden" name="senha" value="<?php echo $senha ?>">
			<button type="submit" class="btn btn-primary btn-lg" id="call">Chamar</button>
		</form>
	</body>
</html>