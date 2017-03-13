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
				
				$sql = 'INSERT INTO tb_mistura (idCandidatos) VALUES (?)';
				$stm = $pdo->prepare($sql);
				$stm->bindParam(1, $val);
				$res = $stm->execute();	
				
			}

		?>
