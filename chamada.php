<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gerrenciador de Senhas</title>
		<script type="text/javascript" src="ṕublic/js/jquery.min.js"></script>
		<!-- <script type="text/javascript" src="js/main.js"></script> -->
		<link rel="stylesheet" type="text/css" href="public/css/bootstrap.css">
		<link rel="stylesheet" href="public/css/main.css">
	</head>
	<body>
		<div class="container">
			<div class="grid col-12">
				<h1 class="text-info displa-4 mt-5 mb-2 text-center">Sistema Senhas</h1>
				<div class="row mt-5">
					<aside class="col-3">
						<nav>
							<ul class="list-group">
								<li class="list-group-item">
									<a href="./">Home</a>
								</li>
								<li class="list-group-item">
									<a href="chamada.php">Chamada</a>
								</li>
							</ul>
						</nav>
					</aside>
					<div class="col-9 bg-light pb-5">
						<h2 class="h4 pt-3 text-info text-center">Dash Board</h2>
						<?php if(isset($_GET['resp'])) : ?>
							<p class="lead alert alert-success content-4 mt-4">
								<?php echo $_GET['resp'] != "exit" ? "Senha {$_GET['resp']} chamada com sucesso!" : "Painel parado com sucesso!"; ?>
							</p>
						<?php elseif(isset($_GET['erro'])): ?>
							<p class="lead alert alert-danger content-4 mt-5"> <?php echo $_GET['erro'] ?></p>
						<?php else: ?>
							<p class="content-4 mt-5"></p>
						<?php endif; ?>
						<form method="post" class="jumbotron content-4 mt-2" action="controllers/ChamadaController.php">
							<?php isset($_GET['senha']) ? $senha = (int)$_GET['senha'] : $senha = 1 ?>
							<legend>Pr&oacute;xima Senha: <?php echo $senha?></legend>
							<input type="hidden" name="senha" id="senha" value="<?php echo $senha ?>">
							<button type="submit" class="btn btn-primary btn-lg" id="call">Chamar</button>
						</form>
					</div>
				</div>
				<div class="grid col-12">
					<div class="row mt-5">
						<div class="col-10"></div>
						<div class="col-1 float-right">
							<form method="post" action="controllers/ChamadaController.php"> 
								<input type="hidden" name="senha" value="exit">
								<input type="submit" class="btn btn-danger btn-lg" id="call" value="Stop">
							</form>
						</div>
						<div class="col-1 float-right">
							<form method="post" action="painel.php" target="_blank">
								<input type="submit"  class="btn btn-success btn-lg" name="start" value="Start">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

