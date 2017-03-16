<?php
	include_once 'conn.php';


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
											round(AVG( p.pontos),2) as media		
											FROM tb_duplas d
											INNER JOIN tb_pontuacao p
											INNER JOIN tb_candidatos c
											on d.idCandidatos = p.idCandidatos AND c.idCandidatos = p.idCandidatos
											WHERE p.idFases = 2
											group by p.idCandidatos	
											order by d.idDuplas		
									") OR die(implode('', $pdo->errorInfo()));
									
			$totalfinal = $gerafinal->rowCount();	
			/*	
			while ($row = $gerafinal->fetch(PDO::FETCH_ASSOC)) {
				echo $row['media']. " media de ". $row['nome'] . " id eh ". $row['nomes']. " e grupo ". $row['grupo'] ."<br />" ;
			}
			*/

			$row = $gerafinal->fetchAll(PDO::FETCH_ASSOC);
			/*
			$meuarray = array();
			
			for($i = 0; $i < $totalfinal; $i++){
			

					$dados = $row[$i]['idCandidatos']." ";
					array_push($meuarray, $dados);


			}
			
			print_r($meuarray);
			*/
echo "<pre>";
			

print_r(array_chunk($row, 2, false));
			
$teste = array_chunk($row, 2, false);		
$valor1 = $teste[0][0]['media'];	
$valor2 = $teste[0][1]['media'];
$valor3 = $teste[1][0]['media'];
$valor4 = $teste[1][1]['media'];
echo $valor1 ." e " . $valor2 ." e " .$valor3 ." e " .$valor4;			

if($valor1 > $valor2){
		echo 'Weder passou';
	}else{
		echo 'Maxwell passou';
}



			
?>
	
	
	