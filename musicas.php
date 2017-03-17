<?php 
	include 'conn.php';
	
	$idCandidatos = $_POST['idCandidatos'];
	
	$candidatoMusica  = $pdo->query("SELECT * FROM tb_candidatos WHERE idCandidatos = $idCandidatos") OR die(implode('', $pdo->errorInfo()));
	$totalCandidatoMusica = $candidatoMusica->rowCount();
	$linhaCandidatoMusica = $candidatoMusica->fetch(PDO::FETCH_ASSOC);
	
	$mus= $pdo->query("
						SELECT 
						m.idMusicas,
						m.idCandidatos,
						m.idListaPrincipal,
						l.idListaPrincipal as listaMusica,
						l.interprete,
						l.titulo,
						l.inicio,
						c.idCandidatos as idcandidato,
						c.nome
						FROM tb_musicas m
						INNER JOIN tb_lista_principal l
						INNER JOIN tb_candidatos c
						ON m.idListaPrincipal = l.idListaPrincipal
						WHERE m.idCandidatos = $idCandidatos
						GROUP BY m.idMusicas
					") OR die(implode("", $pdo->errorInfo()));
	$totalMus = $mus->rowCount();						

	?>
	
	
		<h4 class="modal-title" id="myModalLabel" style="text-transform:uppercase; font-size:26px; color:#c0392b;">Musicas escolhidas</h4>
    </div>
	<div class="modal-body">	
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<img src="img/<?php echo $linhaCandidatoMusica['imagem']?>" width="100%">
			</div>		
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<h4 style="text-transform:uppercase; font-size:30px;"><?php echo $linhaCandidatoMusica['nome'] ?></h4>
					<p style="font-size:15px;"><?php echo $linhaCandidatoMusica['idade'] ?> anos | Nº <?php echo ($linhaCandidatoMusica['idCandidatos'] < 10) ? "00".$linhaCandidatoMusica['idCandidatos'] : "0".$linhaCandidatoMusica['idCandidatos']; ?></p>

	<?php
	
	while ($row = $mus->fetch(PDO::FETCH_ASSOC)) {
		echo '<p><span style="color:#c0392b;">'.$row['titulo'].'</span><span style="display:block"> Interprete: '. $row['interprete'].'</span></p>';
		
	}
					
	?>
			</div>
		</div>
		
