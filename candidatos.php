<!DOCTYPE html>
<?php include 'conn.php'; ?>

<?php
	/* Informações dos candidatos e músicas */
	//$candidatos  = $pdo->query('SELECT * FROM tb_candidatos c WHERE situacao = 1') OR die(implode('', $pdo->errorInfo()));
	//$totalCandidatos = $candidatos->rowCount();

	/*Quantidade de registro (candidato)por página*/
	$maximo = 2;
	//pega o valor da pagina atual
	$pagina = isset($_GET['pagina']) ? ($_GET['pagina']) : '1'; 
	
	//subtraimos 1, porque os registros sempre começam do 0 (zero), como num array
	$inicio = $pagina - 1;
	//multiplicamos a quantidade de registros da pagina pelo valor da pagina atual 
	$inicio = $maximo * $inicio; 
	//fazemos um select na tabela que iremos utilizar para saber quantos registros ela possui
	$strCount = $pdo->query("SELECT COUNT(*) AS 'canditatos' FROM tb_candidatos WHERE situacao = 1");
	//iniciamos uma var que será usada para armazenar a qtde de registros da tabela  
	$total = 0;
	if(count($strCount)){
		foreach ($strCount as $row) {
			//armazeno o total de registros da tabela para fazer a paginação
			$total = $row["canditatos"]; 
		}
	}
	//guardo o resultado na variavel pra exibir os dados na pagina		
	$resultado = $pdo->query("SELECT * FROM tb_candidatos WHERE situacao = 1 ORDER BY idCandidatos ASC LIMIT $inicio,$maximo");


	
	
	
?>


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

  <body id="pgcandidatos">
	<div class="container">
	


	
		<header>
			<h1>QUEM SERÁ O VENCEDOR?</h1>
			<h2>Candidatos</h2>
			<p>Clique na foto do candidato para ver as músicas que ele poderá cantar</p>
		</header>
		<section id="candidatos">
			<div class="row">
				<?php 
					$i=1;
					if(count($resultado)){
					while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) { ?>
								
								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
								<h2> Nº <?php echo ($row['idCandidatos'] < 10) ? "00".$row['idCandidatos'] : "0".$row['idCandidatos'] ;?> </h2>
									<a href="" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row['idCandidatos'];?>" class="parametro"><img src="img/<?php echo $row['imagem'];?>" width="70%" class="img-responsive" /></a>
									<ul>
										<li class="candidato"><?php echo $row['nome'];?>  </li>
										<li class="idade"><?php echo $row['idade'];?> anos</li>
									</ul>
								</div>
								<?php if($i % 3 == 0 && $i != 0){ ?> </div><div class="row"> <?php } $i++; ?>			
					<?php }
					}; 
					?>
			</div>
		</section>
	</div>

	<footer>
		<div class="container">
			<nav class="paginar">
				<div class="row">
					<div class="col-md-12">
						<ul>
			<?php
			$max_links = $total;
			$previous = $pagina - 1; 
			$next = $pagina + 1; 
			$pgs = ceil($total / $maximo); 
			if($pgs > 1 ){  ?>
			<li>
			  <a href="<?php echo $_SERVER['PHP_SELF'].'?pagina=1' ?>" title="Primeiro registro">&laquo; </a>
			</li>
			<?php 
				if($previous > 0){ ?>
					<li><a href="<?php echo $_SERVER['PHP_SELF'].'?pagina='.$previous ?>" title="Registro anterior"> &lsaquo; </a></li>
				<?php
				} else{ ?>
					<li>&lsaquo;</li>
				<?php	
				}	
				

				for($i=$pagina-$max_links; $i <= $pgs; $i++) {
					if ($i <= 0){
					}else{
						if($i != $pagina){
							if($i == $pgs){ //se for o final da pagina, coloca tres pontinhos ?>
								<li><a href="<?php echo $_SERVER['PHP_SELF'].'?pagina='.($i); ?>"><?php echo $i;?> <!-- ... --></a></li>
							<?php
							}else{ ?>
								<li><a href="<?php echo $_SERVER['PHP_SELF'].'?pagina='.($i); ?>"><?php echo $i;?></a></li>
							<?php 
							}
						} else{
							if($i == $pgs){ //se for o final da pagina, coloca tres pontinhos ?>
								<li class="active"><a href="<?php echo $_SERVER['PHP_SELF'].'?pagina='.($i); ?>"><span class="atual"><?php echo $i;?></span></a></li>
							<?php
							}else{ ?>
								<li class="active"><a href="<?php echo $_SERVER['PHP_SELF'].'?pagina='.($i); ?>"><span class="atual"><?php echo $i;?> </span> </a></li>
							<?php
							}
						} 
					}
				}
					
				$pgs = $pgs;
				if($next <= $pgs){ ?>
					<li><a href="<?php echo $_SERVER['PHP_SELF'].'?pagina='.$next ?>" title="Próximo registro"> &rsaquo; </a></li>
				<?php
				}else{ ?>
					<li>&rsaquo;</li>		
				<?php
				}
				 ?>
				<li>
				  <a href="<?php echo $_SERVER['PHP_SELF'].'?pagina='.$pgs ?>" title="Último registro">
					<span aria-hidden="true">&raquo;</span>
				  </a>
				</li>				
				<?php
							
			}
						
			?>	
						</ul>	
					</div>
				</div>
			</nav>	
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

		//busca as musicas na pagina musicas.php enviando o idCandidatos para a janela modal
		$(document).on("click", ".parametro", function () {
			 var parametro = $(this).data('id');
				$.ajax({
					url : 'musicas.php',
					type : 'POST',
					data : 'idCandidatos=' + parametro,
					success: function(data){
						$('#resultado').html(data);
					}
				});
		});	

	
		</script>

		
  </body>
</html>
