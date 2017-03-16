<!DOCTYPE html>
<?php include_once 'conn.php'; ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Octoberfest Videokê</title>
	<link rel="icon" href="favicon.png" type="image/png">
	<link rel="shortcut icon" href="favicon.ico" type="img/x-icon">
	

	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600' rel='stylesheet' type='text/css'>	
	
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
	
	<script src="js/bootstrap.min.js"></script>
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>

<div class="container">
	
	<?php include_once'misturargrupos.php'; ?>
	
	
	<!-- Tabela de preencher grupo A e B -->
	<h4>Tabela de candidatos por grupos</h4>
	
	<?php
	//fazemos um select na tabela que iremos utilizar para saber quantos registros ela possui
	$strCount = $pdo->query("SELECT COUNT(*) AS 'canditatos' FROM tb_candidatos WHERE situacao = 1");
	//iniciamos uma var que será usada para armazenar a qtde de registros da tabela  
	$total = 0;
	if(count($strCount)){
		foreach ($strCount as $row) {
			//armazeno o total de registros da tabela para fazer a paginação
			$total = $row["canditatos"];
			$misturaa = $total / 2; 
			$misturab = $misturaa + 1;
		}
	}


	?>
	
	
	
	
	<ul>
		<li>
		<?php 
		

			$inserirGruposA  = $pdo->query("SELECT idCandidatos FROM tb_mistura WHERE idMistura <= $misturaa") OR die(implode('', $pdo->errorInfo()));
			$totalInserirGruposA = $inserirGruposA->rowCount();
			
			$inserirGruposB  = $pdo->query("SELECT idCandidatos FROM tb_mistura WHERE idMistura >= $misturab") OR die(implode('', $pdo->errorInfo()));
			$totalInserirGruposB = $inserirGruposB->rowCount();
			
			while ($row = $inserirGruposA->fetch(PDO::FETCH_ASSOC)) {
					$idCandidatos = $row['idCandidatos']." ";
					$grupo = "A";
					
					$sql = 'INSERT INTO tb_grupos (idCandidatos, grupo) VALUES (?,?)';
					$stm = $pdo->prepare($sql);
					$stm->bindParam(1, $idCandidatos);
					$stm->bindParam(2, $grupo);
					$res = $stm->execute();	
					
			}
			while ($row = $inserirGruposB->fetch(PDO::FETCH_ASSOC)) {
					$idCandidatos =  $row['idCandidatos']." ";
					$grupo = "B";
					
					$sql = 'INSERT INTO tb_grupos (idCandidatos, grupo) VALUES (?,?)';
					$stm = $pdo->prepare($sql);
					$stm->bindParam(1, $idCandidatos);
					$stm->bindParam(2, $grupo);
					$res = $stm->execute();	
					
			}			
			
			
			$grupoA  = $pdo->query('SELECT g.idGrupos, g.idCandidatos, g.grupo, c.idCandidatos, c.nome FROM 
										tb_grupos g INNER JOIN tb_candidatos c ON g.idCandidatos = c.idCandidatos WHERE grupo = \'A\' ORDER BY c.nome ASC') OR die(implode('', $pdo->errorInfo()));
			$totalGrupoA = $grupoA->rowCount();	
			echo "Candidatos do Grupo A: ";		
			while ($row = $grupoA->fetch(PDO::FETCH_ASSOC)) {
				echo $row['nome'].", ";
			}
			
			$grupoB  = $pdo->query('SELECT g.idGrupos, g.idCandidatos, g.grupo, c.idCandidatos, c.nome FROM 
										tb_grupos g INNER JOIN tb_candidatos c ON g.idCandidatos = c.idCandidatos WHERE grupo = \'B\' ORDER BY c.nome ASC') OR die(implode('', $pdo->errorInfo()));
			$totalGrupoA = $grupoA->rowCount();	
			echo "<br />Candidatos do Grupo B: ";		
			while ($row = $grupoB->fetch(PDO::FETCH_ASSOC)) {
				echo $row['nome'].", ";
			}
			
			
			
			
		?>
		</li>
	</ul>



	

	




</div>	
	



	
  </body>
</html>