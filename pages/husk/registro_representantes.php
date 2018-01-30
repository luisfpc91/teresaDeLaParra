<?php
	if(local != 'p3isYZP1jVUqn')
		exit();
?>	
<div class="container">  
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="active"><b>Registro de los representantes >></b></li>
			</ol>	
			<form name="form_registro_repre" id="form_registro_repre">
				<h1 class="text-center">Formulario de inscripción</h1>
				<h3 class="text-center">Registro de los representantes</h3>
				<br/>
				<div id="instruciones">
					<h4>Pasos a seguir:</h4>
					<ul>
						<li>
							<h4><span class="text-danger">1)</span>Registre los datos de la madre. <small class="text-danger">Guarde.</small></</h4>
						</li>
						<li>
							<h4><span class="text-danger">2)</span>Registre los datos del padre. <small class="text-danger">Guarde.</small></</h4>
						</li>
						<li>
							<h4><span class="text-danger">3)</span>Registre los datos del representante legal. <small class="text-danger">¡Ojo!, solo si el representante legal "no" es el padre o la madre.</small></h4>
						</li>
					</ul>
				</div>
				<div id="representantes">
					<hr/>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_apellido">Apellidos:</label>
								<input id="repre_apellido" name="repre_apellido" class="form-control" placeholder="Apellidos" type="text" required/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_nombre">Nombres:</label>
								<input id="repre_nombre" name="repre_nombre" class="form-control" placeholder="Nombres" type="text" required/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group nacionalidad">
								<label>Nacionalidad:</label><br/>
								<div class="radio">	
									<label>
										<input id="repre_nacionalidad" name="repre_nacionalidad" value="V" type="radio" required/>Venezolano(a)
									</label>
									<label>
										<input id="repre_nacionalidad" name="repre_nacionalidad" value="E" type="radio"/>Extranjero(a)
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_ci">Cédula:</label>
								<input id="repre_ci" name="repre_ci" class="form-control" type="number" placeholder="Cédula" required/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_fechaN">Fecha de nacimiento:</label>
								<input id="repre_fechaN" name="repre_fechaN" class="form-control" placeholder="Fecha de Nacimiento" required/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_estado_civil">Estado civil:</label>
								<select id="repre_estado_civil" name="repre_estado_civil" class="form-control" required>
									<option selected="selected"> </option>
									<option value="S">Soltero(a)</option>
									<option value="C">Casado(a)</option>
									<option value="D">Divorciado(a)</option>
									<option value="V">Viudo(a)</option>
								</select>
							</div>
						</div>
					</div>	
					<div class="row">
						<h5 class="text-center" style="margin-bottom:0px;"><b>Lugar de nacimiento</b></h5>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_estado">Estado:</label>
								<input id="repre_estado" name="repre_estado" class="form-control" placeholder="Estado" required/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_municipio">Municipio:</label>
								<input id="repre_municipio" name="repre_municipio" class="form-control" placeholder="Municipio" required/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_ciudad">Ciudad:</label>
								<input id="repre_ciudad" name="repre_ciudad" class="form-control" placeholder="Ciudad" required/> 
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_celular">Teléfono personal:</label>
								<input id="repre_celular" name="repre_celular" class="form-control" type="number" placeholder="Teléfono Personal" required/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_direccion">Dirección de habitación:</label>
								<input id="repre_direccion" name="repre_direccion" class="form-control" type="text" placeholder="Dirección de Habitación" required/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_telefono_casa">Teléfono de habitación:</label>
								<input id="repre_telefono_casa" name="repre_telefono_casa" class="form-control" type="number" placeholder="Teléfono de Habitación" required/>
								<span class="help-block">Escribir el número sin guión(-), ni espacios.</span>
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_nivel_educacion">Nivel de instrucción:</label>
								<select id="repre_nivel_educacion" name="repre_nivel_educacion" class="form-control">
									<option selected="selected"> </option>
									<option value="P">Primaria</option>
									<option value="S">Secundaria</option>
									<option value="T">Técnica</option>
									<option value="U">Universitaria</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_titulo">Profesión:</label>
								<input id="repre_titulo" name="repre_titulo" class="form-control" type="text" placeholder="Profesión"/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_trabajo">Trabajo que desempeña:</label>
								<input id="repre_trabajo" name="repre_trabajo" class="form-control" type="text" placeholder="Trabajo que desempeña" required/>
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_direccion_trabajo">Dirección de trabajo:</label>
								<input id="repre_direccion_trabajo" name="repre_direccion_trabajo" class="form-control" type="text" placeholder="Dirección de Trabajo" required/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_telefono_trabajo">Teléfono del trabajo:</label>
								<input id="repre_telefono_trabajo" name="repre_telefono_trabajo" class="form-control" type="number" placeholder="Teléfono del Trabajo" required/>
								<span class="help-block">Escribir el número sin guión(-), ni espacios.</span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_ingreso_mensual">Ingreso mensual:</label>
								<input id="repre_ingreso_mensual" name="repre_ingreso_mensual" class="form-control" type="text" placeholder="Ingreso Mensual" required/>
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="repre_viveCon_hijo">Vive con el(la) estudiante:</label>
								<select id="repre_viveCon_hijo" name="repre_viveCon_hijo" class="form-control" required>
									<option selected="selected"> </option>
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
						</div>
						<div class="col-md-4">
						</div>
					</div>	
				</div>							
				<div class="clearfix"></div>
				<br/>
				<div class="form-group">
					<center>
						<input id="btn_registroRepre_lim" name="btn_registroRepre_lim" class="btn btn-primary" type="reset" value="Limpiar"/>
						<input id="btn_registroRepre_env" name="btn_registroRepre_env" class="btn btn-success" type="submit" value="Guardar"/>
					</center>
				</div>
			</form>	
		</div>		
	</div>
</div>
<footer class="footer" >Servicios LFP - 2016</footer>