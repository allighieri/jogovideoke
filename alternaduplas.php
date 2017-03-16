<?php
include_once "conn.php";

	$geraduplas  = $pdo->query("SELECT 
								d.idFormaDuplas,
								d.idFases,
								d.idCandidatos,
								d.grupo,
								c.idCandidatos,
								c.nome
								FROM tb_forma_duplas d 
								INNER JOIN tb_candidatos c
								on d.idCandidatos = c.idCandidatos
								GROUP BY c.idCandidatos
								ORDER BY idFormaDuplas ASC
								") OR die(implode('', $pdo->errorInfo()));
							
	$totalGeraDuplas = $geraduplas->rowCount();
	$row = $geraduplas->fetchAll(PDO::FETCH_ASSOC);

	$contador = $totalGeraDuplas;

	for($i = 0; $i < $contador; $i++){
		if(($i % 2) != 0){
			$dados = array_pop($row);
		}else{
			$dados = array_shift($row);
		}	
		$idCandidatos = $dados['idCandidatos'];
		$grupos = $dados['grupo'];	
		
		
		$fases = 2;
		$sql = 'INSERT INTO tb_duplas (idFases, idCandidatos, grupo) VALUES (?,?,?)';
		$stm = $pdo->prepare($sql);
		$stm->bindParam(1, $fases);
		$stm->bindParam(2, $idCandidatos);
		$stm->bindParam(3, $grupos);
		$res = $stm->execute();	
	}
	
	
	
?>