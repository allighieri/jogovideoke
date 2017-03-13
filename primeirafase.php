<!DOCTYPE html>
<?php include 'conn.php'; ?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>QUEM SERÁ O VENCEDOR?</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	<div class="container">
	

		<header>
			<h1>QUEM SERÁ O VENCEDOR?</h1>
			<h2>Primeira Fase</h2>
			<p>Na Primeira Fase, os candidatos serão aleatoriamente dividos em dois grupos: Grupo A e Grupo B. Metade dos candidatos de cada grupo que somarem as maiores pontuações passarão para a Segunda Fase.</p>
		</header>
		
		<?php
			$grupoA  = $pdo->query('SELECT g.idGrupos, g.idCandidatos, g.grupo, c.idCandidatos, c.nome, c.imagem FROM 
										tb_grupos g INNER JOIN tb_candidatos c ON g.idCandidatos = c.idCandidatos WHERE grupo = \'A\' ORDER BY c.nome ASC LIMIT 10') OR die(implode('', $pdo->errorInfo()));
			
			$grupoB  = $pdo->query('SELECT g.idGrupos, g.idCandidatos, g.grupo, c.idCandidatos, c.nome, c.imagem FROM 
										tb_grupos g INNER JOIN tb_candidatos c ON g.idCandidatos = c.idCandidatos WHERE grupo = \'B\' ORDER BY c.nome ASC LIMIT 10') OR die(implode('', $pdo->errorInfo()));
		?>
		
		<section id="grupos">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 grupo-a">
					<h4>GRUPO A</h4>
					<ul>
					<?php while ($row = $grupoA->fetch(PDO::FETCH_ASSOC)) {	?>
						<li>
							<span class=""><img src="img/<?php echo $row['imagem']?>" width="100%"></span>
							<span class="titulog"><?php echo $row['nome']?></span>
						</li>
					<?php } ?>
					</ul>
				</div>

			
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 grupo-b">
					<h4>GRUPO B</h4>
					<ul>
					<?php while ($row = $grupoB->fetch(PDO::FETCH_ASSOC)) {	?>
						<li>
							<span class=""><img src="img/<?php echo $row['imagem']?>" width="100%"></span>
							<span class="titulog"><?php echo $row['nome']?></span>
						</li>
					<?php } ?>

					</ul>
				</div>			
			
			</div>	
			
			
		</section>
	</div>

	<footer>
		<div class="container">
			<a href="#" class="grupo-a-show">Grupo A</a> &nbsp;
			<a href="#" class="grupo-b-show">Grupo B</a>
		</div>
		
		<?php include_once 'inc/menu.php';?>	
	</footer>



	<!-- Modal -->
	<section class="musicas">
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				
				<div id="resultado"></div>

			  </div>
			  <div class="modal-footer">
			  </div>
			</div>
		  </div>
		</div>	
	</section>	

	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	
		<script>


		
		$(document).on("click", ".grupo-b-show", function () {
			$('.grupo-a').hide('slow');
			$('.grupo-b').show('slow');
		});

		$(document).on("click", ".grupo-a-show", function () {
			$('.grupo-b').hide('slow');
			$('.grupo-a').show('slow');
		});				

		</script>

		
  </body>
</html>
