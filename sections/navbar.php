<?php
if(null===$user)
	exit();
	
?>
<nav class="navbar navbar-inverse navbar-static-top"> 
	<div class="container-fluid">  
		<div class="navbar-header"> 
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false"> 
				<span class="sr-only">Toggle navigation</span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span>  
			</button> 
			<a class="navbar-brand" style="padding:5px;">
				<img id="nombre" src="teresadelaparra/../files/images/nombre2.png"> 
			</a>
		</div>  
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9"> 
			<ul class="nav navbar-nav">
				<?php
					if($user->isLogged()){
				?>
					<?php
						if($user->isAdmin() || $user->isEmpleado() || $user->isRepresentante()){
					?>
					<li <?php echo $page == 'inicio' ? 'class="active"' : ""; ?> >
						<a id="inicio" href="/inicio">Inicio</a>
					</li>
					<?php
						}
						if($user->isAdmin() || $user->isEmpleado() || $user->isRepresentante()){
					?>
					<li <?php echo $page == 'registro_representantes' ? 'class="active"' : ""; ?> >
						<a id="registro_representantes" href="/registro_representantes">Representantes</a>
					</li>
					<?php
						}
						if($user->isAdmin() || $user->isEmpleado() || $user->isRepresentante()){
					?>
					<li <?php echo $page == 'registro_estudiante' ? 'class="active"' : ""; ?> >
						<a id="registro_estudiante" href="/registro_estudiante">Estudiante</a>
					</li>
					<?php
						}
						if($user->isAdmin() || $user->isEmpleado() || $user->isRepresentante()){
					?>
					<li <?php echo $page == 'registro_salud' ? 'class="active"' : ""; ?> >
						<a id="registro_salud" href="/registro_salud">Salud</a>
					</li>
					<?php
						}
						if($user->isAdmin() || $user->isEmpleado() || $user->isRepresentante()){
					?>		
					<li <?php echo $page == 'reportes' ? 'class="active"' : ""; ?> >
						<a id="reportes" href="/reportes">Reportes</a>
					</li>
					<?php
						}
						if($user->isAdmin() || $user->isEmpleado()){
					?>
					<li <?php echo $page == 'usuario' ? 'class="active"' : ""; ?> >
						<a id="usuario" href="/usuario">Usuarios</a>
					</li>
					<?php
						}
					?>
				<?php	
					}else{
				?>	
					<li <?php echo $page == 'index' ? 'class="active"' : ""; ?> >
						<a id="index" href="/index">Inicio</a>
					</li>
					<li <?php echo $page == 'quienes_somos' ? 'class="active"' : ""; ?> >
						<a id="quienes_somos" href="/quienes_somos">¿Quienes Somos?</a>
					</li>
					<li <?php echo $page == 'resena_historica' ? 'class="active"' : ""; ?> >
						<a id="resena_historica" href="/resena_historica">Reseña Historica</a>
					</li>
					<li <?php echo $page == 'contacto' ? 'class="active"' : ""; ?> >
						<a id="contacto" href="/contacto">Contacto</a>
					</li>
				<?php
					}
				?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php
					if($user->isLogged()){
				?>
					<li>
						<a><?php echo $user->getName();?></a>
					</li>
					<li>
						<a id="exit" href="/logout">Salir</a>
					</li>
				<?php	
					}else{
				?>	
					<li>
						<a data-toggle="modal" data-target="#login_modal">Iniciar Sesión</a>
					</li>
				<?php
					}
					
				?>
			</ul>
		</div> 
	</div>
</nav>
<div id="general_progress"><div class="myprogress"><div class="determinate"></div></div></div>
