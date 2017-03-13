<!DOCTYPE html>
<?php include 'conn.php'; ?>
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

<?php
	/* Lista todas as músicas por id */
	$listaPrincipal   = $pdo->query('SELECT * FROM tb_lista_principal ORDER BY idListaPrincipal ASC') OR die(implode('', $pdo->errorInfo()));
	$totalListaPrincipal = $listaPrincipal->rowCount();

	/* Informações dos candidatos e músicas */
	$candidatos  = $pdo->query('
						SELECT 
						c.idCandidatos,
						c.nome,
						c.idade,
						c.bloco,
						c.apartamento,
						c.data,
						c.situacao,
						m.idMusicas,
						m.idCandidatos,
						m.idListaPrincipal,
						l.idListaPrincipal,
						l.interprete,
						l.codigo,
						l.titulo,
						l.inicio,
						l.idioma
						FROM tb_musicas m
						INNER JOIN tb_candidatos c
						INNER JOIN tb_lista_principal l
						ON c.idCandidatos = m.idCandidatos
						AND m.idListaPrincipal = l.idListaPrincipal
						WHERE c.situacao = 1
						GROUP BY m.idMusicas
					') OR die(implode('', $pdo->errorInfo()));
	$totalCandidatos = $candidatos->rowCount();
	
	
	/* Media de pontuação por fase */
	$pontuacao  = $pdo->query('
						SELECT 
						p.idPontuacao,
						p.idCandidatos,
						p.idFases,
						p.idCriterios,
						p.pontos,
						c.idCandidatos,
						c.nome as nomeCandidato,
						c.idade,
						c.bloco,
						f.idFases,
						f.nome as nomeFase,
						cr.idCriterios,
						cr.criterio,
						g.idGrupos,
						g.grupo,
						avg(p.pontos) as total
						FROM tb_pontuacao p
						INNER JOIN tb_candidatos c
						INNER JOIN tb_fases f
						INNER JOIN tb_criterios cr
						INNER JOIN tb_grupos g
						ON p.idCandidatos = c.idCandidatos
						AND f.idFases = p.idFases
						AND cr.idCriterios = p.idCriterios
						AND g.idCandidatos = c.idCandidatos
						WHERE p.idFases = 1 AND pontos != 0
						GROUP BY p.idCandidatos
						ORDER BY total DESC 
					') OR die(implode('', $pdo->errorInfo()));
	$totalPontuacao = $pontuacao->rowCount();	
	



	
?>	

<div class="container">

	<!-- Tabela de preencher grupo A e B -->
	<h4>Tabela de candidatos por grupos</h4>
	<ul>
		<li>
		<?php 

			$inserirGruposA  = $pdo->query('SELECT idCandidatos FROM tb_mistura WHERE idMistura <= 10') OR die(implode('', $pdo->errorInfo()));
			$totalInserirGruposA = $inserirGruposA->rowCount();
			
			$inserirGruposB  = $pdo->query('SELECT idCandidatos FROM tb_mistura WHERE idMistura >= 11') OR die(implode('', $pdo->errorInfo()));
			$totalInserirGruposB = $inserirGruposB->rowCount();
			
			while ($row = $inserirGruposA->fetch(PDO::FETCH_ASSOC)) {
					$idCandidatos = $row['idCandidatos']." ";
					$grupo = "A";
				/*	
					$sql = 'INSERT INTO tb_grupos (idCandidatos, grupo) VALUES (?,?)';
					$stm = $pdo->prepare($sql);
					$stm->bindParam(1, $idCandidatos);
					$stm->bindParam(2, $grupo);
					$res = $stm->execute();	
				*/	
			}
			while ($row = $inserirGruposB->fetch(PDO::FETCH_ASSOC)) {
					$idCandidatos =  $row['idCandidatos']." ";
					$grupo = "B";
				/*	
					$sql = 'INSERT INTO tb_grupos (idCandidatos, grupo) VALUES (?,?)';
					$stm = $pdo->prepare($sql);
					$stm->bindParam(1, $idCandidatos);
					$stm->bindParam(2, $grupo);
					$res = $stm->execute();	
				*/	
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

	
	
	
	
	<!-- Tabela de candidatos por grupos -->
	<h4>Tabela de candidatos misturados</h4>
	<ul>
		<li>
		<?php 
		
			/* Inserir candidatos nos grupos */
			$misturar  = $pdo->query('SELECT idCandidatos FROM tb_candidatos WHERE situacao = 1') OR die(implode('', $pdo->errorInfo()));
			$totalMisturar = $misturar->rowCount();
			$cand = $misturar->fetchAll(PDO::FETCH_ASSOC) ;
			$sessaoArray = array();
			foreach($cand as $nume){
				$key = $nume['idCandidatos'];
				$sessaoArray[$key] = $nume['idCandidatos'];
			}
			$numbers = $sessaoArray;
	
			$mistura = shuffle($numbers);
				
			foreach ($numbers as $number) {
				//echo "$number ";
				$val = $number;
			/*	
				$sql = 'INSERT INTO tb_mistura (idCandidatos) VALUES (?)';
				$stm = $pdo->prepare($sql);
				$stm->bindParam(1, $val);
				$res = $stm->execute();	
			*/	
			}

			$tb_mistura  = $pdo->query('SELECT * FROM tb_mistura ORDER BY idMistura ASC' ) OR die(implode('', $pdo->errorInfo()));
			$totalTb_mistura = $tb_mistura->rowCount();
			while ($rows = $tb_mistura->fetch(PDO::FETCH_ASSOC)) {
				echo $rows['idCandidatos']." ";
			}
			
			
		?>
		</li>
	</ul>	



	<!-- tabela de pontuação por fase -->
	<h4>Tabela de pontuação por fase</h4>
	<ul>
	<?php	
		$var = ""; 
		while ($row = $pontuacao->fetch(PDO::FETCH_ASSOC)) { 
			if($var==$row['nomeCandidato']) { echo ""; } else { ?>
			<li>&nbsp;</li>
			<li>Nome: <?php echo $row['nomeCandidato'];?> </li>
			<li>Fase: <?php echo $row['nomeFase'];?> </li>
			<li>Grupo: <?php echo $row['grupo'];?> </li>
			<li>Total: <?php $total = $row['total']; echo number_format($total, 2, '.', '');?> </li>
			<li>Pontuação</li>
			<?php } ?>
			<li><?php echo $row['criterio'].' = '. $row['pontos'] ; ?></li>
			<?php $var = $row['nomeCandidato'];	
		}?> 	
	</ul>

	<!-- tabelas de candidatos e musicas -->
	<h4>Tabela de candidatos e escolha de músicas</h4>
	<ul>
	<?php	
		$var = ""; 
		while ($row = $candidatos->fetch(PDO::FETCH_ASSOC)) { 
			if($var==$row['nome']) { echo ""; } else { ?>
			<li>&nbsp;</li>
			<li>Nome: <?php echo $row['nome'];?> </li>
			<li>Idade: <?php echo $row['idade'];?> </li>
			<li>Bloco: <?php echo $row['bloco'];?> </li>
			<li>Apto: <?php echo $row['apartamento'];?> </li>
			<li>Data: <?php echo $row['data'];?> </li>
			<li>Inscrição: <?php echo $row['situacao'];?> </li>
			<li>Canções escolhidas</li>
			<?php } ?>
			<li><?php echo $row['titulo'].' | '. $row['interprete'] ; ?></li>
			<?php $var = $row['nome'];	
		}?> 	
	</ul>

	




	<table>
		<legend>Lista de Músicas Principal | Total <?php echo $totalListaPrincipal; ?> músicas</legend>
		<thead>
			<tr>
				<th>*</th>
				<th>Intérprete</th>
				<th>Código</th>
				<th>Título</th>
				<th>Início</th>
				<th>Idioma</th>
			</tr>
		</thead>
		<tbody>
		<?php while ($row = $listaPrincipal->fetch(PDO::FETCH_ASSOC)) : ?>
		<tr>
			<td><?php echo $row['idListaPrincipal']; ?></td>
			<td><?php echo $row['interprete']; ?></td>
			<td><?php echo $row['codigo']; ?></td>
			<td><?php echo $row['titulo']; ?></td>
			<td><?php echo $row['inicio']; ?></td>
			<td><?php echo $row['idioma']; ?></td>
		</tr>
		</tbody>
		<?php endwhile; ?>
	</table>
</div>	
	



	
  </body>
</html>