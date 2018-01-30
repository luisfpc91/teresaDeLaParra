<?php
	if(local != 'p3isvwP1jVUqn')
		exit();
?>	
<div class="container">  
	<div class="row">
		<div class="col-md-12">
				<ol class="breadcrumb margin">
					<li class="active"><b>Registro del estudiante >></b></li>
				</ol>
					<h1 class="text-center">Formulario de inscripción</h1>
						<h3 class="text-center">Registro del estudiante</h3>
					<br/>
						<div id="instruciones">
							<h4>Pasos a seguir:</h4>
							<ul>
								<li>
									<h4><span class="text-danger">1)</span>Coloque la cédula de la madre. <small class="text-danger">Presione Buscar..</small></h4>
								</li>
								<li>
									<h4><span class="text-danger">2)</span>Coloque la cédula de la padre. <small class="text-danger">Presione Buscar.</small></h4>
								</li>
								<li>
									<h4><span class="text-danger">3)</span>Coloque la cédula del representante legal. <small class="text-danger">Obligatorio.</small></h4>
								</li>
								<li>
									<h4><span class="text-danger">4)</span>Registre los datos del alumno. <small class="text-danger">Guarde.</small></h4></h4>
								</li>
							</ul>
						</div>
						<hr/>
						<div id="estudiante">
							<div class="row"> 
								<div class="col-md-4">
									<form id="form_madre" name="form_madre">
										<div class="form-group">
											<label for="madre_ci">Cédula de la madre:</label>
											<div class="input-group">
												<input id="madre_ci" name="madre_ci" class="form-control" type="number" placeholder="Cédula" required/>
												<span class="input-group-btn">
													<input id="madre_buscar" name="madre_buscar" type="submit" class="btn btn-warning" value="Buscar" title="Buscar">
												</span> 
											</div>
										</div>
									</form>	
								</div>
								<div class="col-md-4">
									<form id="form_padre" name="form_padre" >
										<div class="form-group">
											<label for="padre_ci">Cédula del padre:</label>
											<div class="input-group">
												<input id="padre_ci" name="padre_ci" class="form-control" type="number" placeholder="Cédula" required/>
												<span class="input-group-btn">
													<input id="padre_buscar" name="padre_buscar" type="submit" class="btn btn-info" value="Buscar" title="Buscar">
												</span> 
											</div>
										</div>
									</form>	
								</div>
								<div class="col-md-4">
									<form id="form_rl" name="form_rl">
										<div class="form-group">
											<label for="rl_ci">Cédula del representante legal:</label>
											<div class="input-group">
												<input id="rl_ci" name="rl_ci" type="number" class="form-control" placeholder="Cédula" required/>
												<span class="input-group-btn">
													<input id="rl_buscar" name="rl_buscar" type="submit" class="btn btn-danger" value="Buscar" title="Buscar">
												</span> 
											</div>
											<span class="help-block text-danger">En caso de no ser el padre o la madre, llene los campos nuevos.</span>
										</div>
									</form>	
								</div>
							</div>
							<div class="row con">
								<div class="col-md-4">
									<p id="madre_name" class="adultos text-center"></p>
								</div>
								<div class="col-md-4">
									<p id="padre_name" class="adultos text-center"></p>
								</div>
								<div class="col-md-4">
									<p id="rl_name" class="adultos text-center"></p>
								</div>
							</div>
				<form name="form_registro_alumno" id="form_registro_alumno">
								<div id="repre_legal">
									<div class="row">
											<div class="col-md-4">
												<div class="form-group">
												<label>¿Presenta el permiso del CEPNA que lo(a) autorice para que sea su representante?:</label>
												<div class="radio">
													<label>
														<input id="repre_permiso_cepna" name="repre_permiso_cepna" type="radio" value="Si"/>Si
													</label>
													<label>
														<input id="repre_permiso_cepna" name="repre_permiso_cepna" type="radio" value="No"/>No
													</label>
												</div>
											</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="repre_pq_otra_persona">En caso de no ser la Madre o el Padre, ¿Por qué lo representa otra persona?:</label>
													<input id="repre_pq_otra_persona" name="repre_pq_otra_persona" type="text" class="form-control" placeholder="¿Por qué lo representa otra persona?"/>
												</div>
											</div>
									</div>
									<div class="row con">
										<div class="col-md-4">
											<div class="form-group">
													<label for="repre_parentesco">Parentesco con el estudiante:</label>
														<input id="repre_parentesco" name="repre_parentesco" type="text" class="form-control" placeholder="Parentesco"/>
												</div>
											
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="repre_llamar_emergencia">¿A quien llamar en caso de emergencia?:</label>
													<input id="repre_llamar_emergencia" name="repre_llamar_emergencia" type="text" class="form-control" placeholder="Nombre Completo"/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="repre_telefono_emergencia">Teléfono de la persona a llamar:</label>
												<input id="repre_telefono_emergencia" name="repre_telefono_emergencia" class="form-control" placeholder="Teléfono" type="number"/>
												<span class="help-block">Escribir el número sin guión(-), ni espacios.</span>
											</div>
										</div>
									</div>
								</div>
								<hr class="negro"/>
								<div class="row">
									<h3 class="text-center con">Datos del estudiante</h3>
									<div class="col-md-4">
										<div class="form-group">
											<label>Apellidos:</label>
												<input name="hijo_apellido" class="form-control" type="text" placeholder="Apellidos" required/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Nombres:</label>
												<input name="hijo_nombre" class="form-control" type="text" placeholder="Nombres" required/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group nacionalidad">
											<label>Nacionalidad:</label><br/>
											<div class="radio">	
												<label>
													<input id="hijo_nacionalidad" name="hijo_nacionalidad" value="V" type="radio" required/>Venezolano
												</label>
												<label>
													<input id="hijo_nacionalidad" name="hijo_nacionalidad" value="E" type="radio"/>Extranjero
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<h5 class="text-center" style="margin-bottom:0px;"><b>Lugar de nacimiento</b></h5>
									<div class="col-md-4">
										<div class="form-group">
											<label for="hijo_estado">Estado:</label>
												<input id="hijo_estado" name="hijo_estado" class="form-control" placeholder="Estado" required/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="hijo_municipio">Municipio:</label>
												<input id="hijo_municipio" name="hijo_municipio" class="form-control" placeholder="Municipio" required/> 
										</div>	
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="hijo_ciudad">Ciudad:</label>
												<input id="hijo_ciudad" name="hijo_ciudad" class="form-control" placeholder="Ciudad" required/>  
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Fecha de nacimiento:</label>
												<input id="hijo_fechaN" name="hijo_fechaN" class="form-control" placeholder="Fecha de Nacimiento" type="text" required/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group sexo">
											<label>Sexo:</label><br/>
											<div class="radio">	
												<label>
													<input id="hijo_sexo" name="hijo_sexo" value="M" type="radio" required/>Masculino
												</label>
												<label>
													<input id="hijo_sexo" name="hijo_sexo" value="F" type="radio"/>Femenino
												</label>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Cédula escolar:</label>
												<input name="hijo_cedula_escolar" class="form-control" type="number" placeholder="Cédula Escolar" required/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="hijo_peso">Peso:</label>
												<input id="hijo_peso" name="hijo_peso" placeholder="Peso" class="form-control" type="text"/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="hijo_talla">Estatura:</label>
												<input id="hijo_talla" name="hijo_talla" placeholder="Estatura" class="form-control" type="text"/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="hijo_direccion">Dirección de habitación:</label>
												<input id="hijo_direccion" name="hijo_direccion" placeholder="Dirección de Habitación" class="form-control" type="text" required/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="hijo_telefono">Teléfono de habitación:</label>
											<input id="hijo_telefono" name="hijo_telefono" placeholder="Teléfono de Habitación" class="form-control" type="number" required/>
											<span class="help-block">Escribir el número sin guión(-), ni espacios.</span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="hijo_nivel">Nivel del niño:</label>
												<select id="hijo_nivel" name="hijo_nivel" class="form-control" required>
													<option selected="selected"></option>
													<option value="M">Maternal</option>
													<option value="P">Pre-escolar</option>
												</select>
										</div>
									</div>
									<div class="col-md-4">									
									</div>
								</div>	
						</div>	
						<div class="clearfix"></div>
					<br/>
					<div class="form-group">
						<center>
							<input id="btn_registroAlumno_lim" name="btn_registroAlumno_lim" class="btn btn-primary" type="reset" value="Limpiar"/>
							<input id="btn_registroAlumno_env" name="btn_registroAlumno_env" class="btn btn-success" type="submit" value="Guardar"/>
						</center>
					</div>
				</form>	
		</div>
	</div>
</div> 
<footer class="footer" >Servicios LFP - 2016</footer>