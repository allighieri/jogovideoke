<?php
header("Content-type: text/html; charset=utf-8");
include_once 'conn.php';

$contar = $pdo->query("SELECT COUNT(*) AS 'canditatos' FROM tb_duplas");
if(count($contar)){
	foreach ($contar as $row) {
		$total = $row["canditatos"]; 
	}
};
	

	$geravencedor  = $pdo->query("
			SELECT 
				f.idFinal,
				f.idFases,
				f.idCandidatos,
				f.grupo,
				c.idCandidatos as cand,
				c.nome,
				round(AVG(p.pontos),2) as media
				FROM tb_final f
				INNER JOIN tb_pontuacao p
				INNER JOIN tb_candidatos c
				on f.idCandidatos = p.idCandidatos AND c.idCandidatos = p.idCandidatos
				WHERE p.pontos != 0 AND p.idFases = 3
				group by p.idCandidatos
				order by media DESC
				LIMIT 3
		") OR die(implode('', $pdo->errorInfo()));
	

		
	$totalGeraVencedor = $geravencedor->rowCount();		
	$row = $geravencedor->fetchAll(PDO::FETCH_ASSOC);

	$contador = $totalGeraVencedor;

	for($i = 0; $i < $contador; $i++){
		$dados = array_shift($row);
		$idCandidatos = $dados['idCandidatos']." ";
		$grupos = $dados['grupo'];	
		
		$sql = 'INSERT INTO tb_vencedores (idCandidatos, grupo) VALUES (?,?)';
		$stm = $pdo->prepare($sql);
		$stm->bindParam(1, $idCandidatos);
		$stm->bindParam(2, $grupos);
		$res = $stm->execute();			
		
	}		
		
		
		
		
		

			
?>
	
	
	