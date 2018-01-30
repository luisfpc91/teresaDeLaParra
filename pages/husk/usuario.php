<?php
	if(local != 'p3isFPP1jVUqn' || $user->isRepresentante())
		exit();
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="active"><b>Usuarios >></b></li>
			</ol>
		</div>
	</div>		
	<div class="row">	
		<div class="col-md-6">
			<form id="form_usuario" name="form_usuario">
				<h3 class="text-center titulo_lista">Agregar Usuario</h3>
				<div class="form-group">
					<label for="name_user">Nombre real de la persona:</label>
					<input id="name_user" name="name_user" class="form-control" type="text" placeholder="Nombre real" required/>
				</div>
				<div class="form-group">
					<label for="user_user">Nombre de usuario para el sistema:</label>
					<input id="user_user" name="user_user" class="form-control" type="text" placeholder="Nombre de usuario" required/>
				</div>
				<div class="form-group">
					<label for="pass_user">Contraseña:</label>
					<input id="pass_user" name="pass_user" class="form-control" type="password" placeholder="Contraseña" required/>
				</div>
				<div class="form-group">
					<label for="confiPass_user">Confirmar contraseña:</label>
					<input id="confiPass_user" name="confiPass_user" class="form-control" type="password" placeholder="Confirmar contraseña" required/>
				</div>
				<div class="form-group">
					<label for="pri_user">Privilegio:</label>
					<select id="pri_user" name="pri_user" class="form-control" required>
						<option selected="selected"></option>
						<?php
							if($user->isAdmin()){
								echo '<option value="1">Administrador</option>';
							}
						?>
						<option value="2">Empleado</option>
						<option value="3">Representante</option>
					</select>	
				</div>
				<div class="form-group">
					<center>
						<input id="btn_lim_user" name="btn_lim_user" class="btn btn-primary" value="Limpiar" title="Limpiar" type="reset"/>
						<input id="btn_env_user" name="btn_env_user" class="btn btn-success" value="Enviar" title="Enviar" type="submit"/>
					</center>
				</div>
			</form> 
		</div>
		<div class="col-md-6">
			<h3 class="text-center titulo_lista">Lista de Usuarios</h3>
			<table class="table table-bordered table-hover">
				<thead>
					<tr class="success"> 
						<th class="text-center">#</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Usuario</th>
						<th class="text-center">Privilegio</th>
						<th class="text-center">Editar</th>
						<th class="text-center">Eliminar</th>
					</tr>
				</thead>
				<tbody id="list_users" class="text-center list">
				</tbody>				
			</table>
		</div>
	</div>
</div>	
<footer class="footer" >Servicios LFP - 2016</footer>		
	<div id="modal_edit_user" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form_edit_user" name="form_edit_user">
					<div class="modal-header">
						<h2 class="text-center">Editar Usuario?</h2>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="modal_name_user">Nombre:</label>
							<input id="modal_name_user" name="modal_name_user" class="form-control" type="text" placeholder="Nombre" required/>
						</div>
						<div class="form-group">
							<label for="modal_user_user">Usuario:</label>
							<input id="modal_user_user" name="modal_user_user" class="form-control" type="text" placeholder="Usuario" required/>
						</div>
						<div class="form-group">
							<label for="modal_pass_user">Contraseña:</label>
							<input id="modal_pass_user" name="modal_pass_user" class="form-control" type="password" placeholder="Contraseña" required/>
						</div>
						<div class="form-group">
							<label for="modal_confiPass_user">Confirmar Contraseña:</label>
							<input id="modal_confiPass_user" name="modal_confiPass_user" class="form-control" type="password" placeholder="Confirmar Contraseña" required/>
						</div>
						<div class="form-group">
							<label for="modal_pri_user">Privilegio:</label>
							<select id="modal_pri_user" name="modal_pri_user" class="form-control" required>
								<option selected="selected"></option>
								<?php
									if($user->isAdmin()){
										echo '<option value="1">Administrador</option>';
									}
								?>
								<option value="2">Empleado</option>
								<option value="3">Representante</option>
							</select>	
						</div>
					</div>
					<div class="modal-footer">
						<input id="btn_editUser_can" name="btn_editUser_can" class="btn btn-danger" type="button" value="Cancelar" title="Cancelar" data-dismiss="modal"/>
						<input id="btn_editUser_lim" name="btn_editUser_lim" class="btn btn-primary" type="reset" value="Limpiar" title="Limpiar"/>
						<input id="btn_editUser_env" name="btn_editUser_env" class="btn btn-success" type="submit" value="Enviar" title="Enviar"/>
					</div>
				</form>	
			</div>
		</div>
	</div>
	<div id="modal_remove_user" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form_remove_user" name="form_remove_user">
					<div class="modal-header">
						<h2 class="text-center">¿Desea Eliminar este Usuario?</h2>
					</div>
					<div class="modal-body">
						<table class="table table-bordered">
							<tr>
								<td class="text-center"><b id="modal_nameUser_remove"></b></td>
								<td class="text-center"><b id="modal_userUser_remove"></b></td>
								<td class="text-center"><b id="modal_priUser_remove"></b></td>
							</tr>
						</table>
					</div>
					<div class="modal-footer">
						<input id="btn_removeUser_no" name="btn_removeUser_no" class="btn btn-danger" type="button" value="No" title="No" data-dismiss="modal"/>
						<input id="btn_removeUser_si" name="btn_removeUser_si" class="btn btn-success" type="submit" value="Si" title="Si"/>
					</div>
				</form>
			</div>
		</div>
	</div>		