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
	
	
	
	<!-- Tabela de preencher grupo A e B -->
	<h4>Tabela de gera duplas</h4>
	
	
	<?php
	$strCount = $pdo->query("SELECT COUNT(*) AS 'grupo' FROM tb_grupos WHERE grupo = 'A'");
	//iniciamos uma var que será usada para armazenar a qtde de registros da tabela  
	$total = 0;
	if(count($strCount)){
		foreach ($strCount as $row) {
			$total = $row["grupo"] / 2;
		}
	}
			

	
			$geraduplasA  = $pdo->query("SELECT p.idPontuacao, c.idCandidatos, c.nome, g.idGrupos, g.grupo, round(AVG( p.pontos),2) as media 
										FROM tb_pontuacao p INNER JOIN tb_candidatos c INNER JOIN tb_grupos g
										on p.idCandidatos = c.idCandidatos AND c.idCandidatos = g.idCandidatos
										WHERE p.pontos != 0 AND g.grupo = 'A'
										Group by c.idCandidatos
										Order by g.grupo, media Desc
										Limit $total
									") OR die(implode('', $pdo->errorInfo()));
									
			$totalGeraDuplasA = $geraduplasA->rowCount();	
			
			$geraduplasB  = $pdo->query("SELECT p.idPontuacao, c.idCandidatos, c.nome, g.idGrupos, g.grupo, round(AVG( p.pontos),2) as media 
										FROM tb_pontuacao p INNER JOIN tb_candidatos c INNER JOIN tb_grupos g
										on p.idCandidatos = c.idCandidatos AND c.idCandidatos = g.idCandidatos
										WHERE p.pontos != 0 AND g.grupo = 'B'
										Group by c.idCandidatos
										Order by g.grupo, media Desc
										Limit $total
									") OR die(implode('', $pdo->errorInfo()));
									
			$totalGeraDuplasB = $geraduplasB->rowCount();			
			
			while ($row = $geraduplasA->fetch(PDO::FETCH_ASSOC)) {
					$idFases 		= 2;
					$idCandidatos 	= $row['idCandidatos'];
					$grupo			= $row['grupo'];
					
					$sql = 'INSERT INTO tb_duplas (idFases, idCandidatos, grupo) VALUES (?,?,?)';
					$stm = $pdo->prepare($sql);
					$stm->bindParam(1, $idFases);
					$stm->bindParam(2, $idCandidatos);
					$stm->bindParam(3, $grupo);
					$res = $stm->execute();	
			}
			
					while ($row = $geraduplasB->fetch(PDO::FETCH_ASSOC)) {
							$idFases 		= 2;
							$idCandidatos 	= $row['idCandidatos'];
							$grupo			= $row['grupo'];
							
							$sql = 'INSERT INTO tb_duplas (idFases, idCandidatos, grupo) VALUES (?,?,?)';
							$stm = $pdo->prepare($sql);
							$stm->bindParam(1, $idFases);
							$stm->bindParam(2, $idCandidatos);
							$stm->bindParam(3, $grupo);
							$res = $stm->execute();	
							
					}
			
			
	?>
	
	
	

	

</div>	
	



	
  </body>
</html>