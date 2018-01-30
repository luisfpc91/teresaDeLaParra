<?php
	if(local != 'D3isLPP1jVUqn')
		exit();
?>
<div class="container">  
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb margin">
				<li class="active"><b>Reportes >></b></li>
			</ol>
				<h1 class="text-center">Reportes a imprimir</h2>
			<div id="instruciones">
				<h4>Pasos a seguir:</h4>
				<ul>
					<li>
						<h4><span class="text-danger">*</span>Imprimir el fomurlario de inscripción:</h4>
						<ul>
							<li>
								<h4><span class="text-danger">1)</span>Coloque la cédula escolar del estudiante.<small class="text-danger">Presione Generar PDF.</small></h4>
							</li>
						</ul>
					</li> 
					<li>
						<h4><span class="text-danger">*</span>Imprimir constancias escolares:</h4>	
						<ul>
							<li>
								<h4><span class="text-danger">1)</span>Escoja el tipo de constancia que desea imprimir.<small class="text-danger">Presione Generar PDF.</small></h4>
							</li>
							<li>
								<h4><span class="text-danger">2)</span>Coloque la cédula escolar del estudiante.<small class="text-danger">Presione Generar PDF.</small></h4>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>	
	<div class="row">
		<hr/>
		<div class="col-md-6">
			<form id="form_inscripcion" name="form_inscripcion">
			
				<h2 class="text-center">Formulario de inscripción</h2>
					<br/>
				<div class="form-group">
					<label for="ci_escolar">Cédula escolar del estudiante:</label>
					<input id="ci_escolar" name="ci_escolar" class="form-control" placeholder="Buscar" required/>
				</div>
				<div class="form-group">
					<center>
						<input id="btn_pdf_insc" name="btn_pdf_insc" type="submit" class="btn btn-warning" value="Generar PDF"/>
						<a target="_blank" id="genera_reporte" name="genera_reporte" type="hidden" ></a>
					</center>	
				</div>
			</form>
		</div>
		<div class="col-md-6"> 
			<form id="form_constancias" name="form_constancias">
				<h2 class="text-center">Constancias escolares</h2>
					<br/>
				<div class="form-group">
					<label for="tipo_const">Tipo de constancia:</label>
					<select id="tipo_const" name="tipo_const" class="form-control" required>
						<option selected="selected"></option>
						<option value="1">Inscripción</option>
						<option value="2">Estudio</option>
					</select>
				</div>
				<div class="form-group">
					<center>
						<input id="btn_pdf_const" name="btn_pdf_const" type="submit" class="btn btn-info" value="Descargar"/>
					</center>	
				</div>
			</form>
		</div>
	</div>
</div> 
<footer class="footer" >Servicios LFP - 2016</footer>
