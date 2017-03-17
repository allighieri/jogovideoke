<?php
header("Content-type: text/html; charset=utf-8");
include_once 'conn.php';

$contar = $pdo->query("SELECT COUNT(*) AS 'canditatos' FROM tb_duplas");
if(count($contar)){
	foreach ($contar as $row) {
		$total = $row["canditatos"]; 
	}
}
	
$maximo = 2;
for($i=0;$i<$total;$i += 2){
$inicio = $i;
	$gerafinal  = $pdo->query("
			SELECT 
				d.idDuplas, 
				d.idCandidatos as nomes, 
				d.grupo,
				p.idPontuacao,
				p.idCandidatos,
				p.idFases as fase,
				c.idCandidatos as cand,
				c.nome,
				round(AVG(p.pontos),2) as media
				FROM tb_duplas d
				INNER JOIN tb_pontuacao p
				INNER JOIN tb_candidatos c
				on d.idCandidatos = p.idCandidatos AND c.idCandidatos = p.idCandidatos
				WHERE p.pontos != 0 AND p.idFases = 2
				group by p.idCandidatos	
				order by d.idDuplas	
				LIMIT $inicio, $maximo		
		") OR die(implode('', $pdo->errorInfo()));
		
		
	
		$row = $gerafinal->fetchAll(PDO::FETCH_ASSOC);

		
		if($row[0]['media'] > $row[1]['media']){
			echo $row[0]['nome']. " ".$row[0]['idCandidatos']." ".$row[0]['grupo'].'<br />';
				$fases = 3;
				$idCandidatos = $row[0]['idCandidatos'];
				$grupos = $row[0]['grupo'];
				$sql = 'INSERT INTO tb_final (idFases, idCandidatos, grupo) VALUES (?,?,?)';
				$stm = $pdo->prepare($sql);
				$stm->bindParam(1, $fases);
				$stm->bindParam(2, $idCandidatos);
				$stm->bindParam(3, $grupos);
				$res = $stm->execute();				
		}else{
			echo $row[1]['nome']. " ".$row[1]['idCandidatos']." ".$row[1]['grupo'].'<br />';
				$fases = 3;
				$idCandidatos = $row[1]['idCandidatos'];
				$grupos = $row[1]['grupo'];
				$sql = 'INSERT INTO tb_final (idFases, idCandidatos, grupo) VALUES (?,?,?)';
				$stm = $pdo->prepare($sql);
				$stm->bindParam(1, $fases);
				$stm->bindParam(2, $idCandidatos);
				$stm->bindParam(3, $grupos);
				$res = $stm->execute();				
		};
}


			
?>
	
	
	