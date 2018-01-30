<?php
if(null===$user)
	exit();
	
	
	
if($user->isLogged()){	
?>


<?php
}else{
?>

	<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
		<div class="modal-dialog" role="document">
			<form id="login_form" name="login_form" class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalLabel">Inicia Sesión</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="login-name" class="control-label">Usuario:</label>
						<input type="text" required name="name" class="form-control" id="login-name">
					</div>
					<div class="form-group">
						<label for="login-password" class="control-label">Contraseña:</label>
						<input type="password" required name="password" class="form-control" id="login-password">
					</div>
				</div>
				<div class="modal-footer">
					<button id="closeLoginModal" type="reset" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Iniciar Sesión</button>
				</div>
			</form>
		</div>
	</div>
	
	

<?php
}
?>
