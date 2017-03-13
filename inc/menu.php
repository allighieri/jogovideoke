
		
	<?php echo $paginaCorrente = basename($_SERVER['SCRIPT_NAME']);?>
		
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-default navbar-fixed-bottom">
				  <div class="container">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="#">Menu</a>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					  <ul class="nav navbar-nav">
						<li <?php if($paginaCorrente == 'incricao.php') {echo 'class="active"';} ?> ><a href="inscricao.php"  >Inscrição</a></li>
						<li <?php if($paginaCorrente == 'candidatos.php') {echo 'class="active"';} ?> ><a href="candidatos.php" >Candidatos</a></li>
						<li <?php if($paginaCorrente == 'primeirafase.php') {echo 'class="active"';} ?> ><a href="primeirafase.php">Primeira Fase</a></li>
						<li <?php if($paginaCorrente == 'segundafase.php') {echo 'class="active"';} ?> ><a href="segundafase.php">Segunda Fase</a></li>
						<li <?php if($paginaCorrente == 'final.php') {echo 'class="active"';} ?> ><a href="final.php">Final</a></li>
					  </ul>
					</div>
				  </div>
				</nav>	
			</div>
		</div>
		
		
