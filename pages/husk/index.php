<?php
	if(local != 'qweYZP1jVUqn')
		exit();
?>	
<div class="container">  
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb margin">
				<li class="active"><b>Inicio >></b></li>
			</ol>
			<div  class="row">
				<div class="col-md-12">
					<div id="instruciones">
						<h4>
							<p class="text">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bienvenido al sistema de Registro de la Escuela Educación Inicial Colegio Teresa de la Parra. 
								En este sistema debe agregar los datos, del alumno, de los representantes (la madre, el padre y el representante legal), 
								llenar el  registro de salud e imprimir el reporte, el cual debe llevarse a la institución para formalizar la inscripción del niño.
							</p>
						</h4>
						<h3>Instrucciones:</h3>
						<ul>
							<li>
								<center>
									<a target="_blank" href="../../pdf/manual_usuario.pdf" class="btn btn-warning">Descargar manual del sistema</a>
								</center>
							</li>
							<?php
							if($user->isRepresentante()){
								echo " ";
							}else{
								echo '<li id="ins_user">
										<h4><p class="text"><span class="text-danger text">*</span><b>Usuarios:</b> En este modulo se registran los ususarios del sistema, 
										tanto los empleados de la escuela como los representantes. Es muy importante crearle un usuario a los representantes,
										y darles los datos para que ellos puedan entrar al sistema y puedan llenar los registro e imprimir el reporte de inscripción.</p></h4>
									</li>';
							}	
							?>
							<li>
								<h4><p class="text"><span class="text-danger">*</span><b>Representantes:</b> En este modulo se registran los datos de los padres del alumno y del representante legal, 
								que puede ser tanto uno de sus padres como otra persona.</p></h4>
							</li>
							<li>
								<h4><p class="text"><span class="text-danger">*</span><b>Estudiante:</b> Se registran los datos del alumno, pero antes se debe colocar las cédula de los padres y del representante legal.</p></h4>
							</li>
							<li>
								<h4><p class="text"><span class="text-danger">*</span><b>Salud:</b> Este registro es por mucho el más largo, pero es muy importante que sea llenado, ya que brinda información importante sobre el niño, 
								que ayudara a nuestras profesoras a conocer y poder tratar de la mejor manera a los alumnos.</p></h4>
							</li>
							<li>
								<h4><p class="text"><span class="text-danger">*</span><b>Reportes:</b> Aquí se debe imprimir el reporte de inscripción(el que hemos estadollenando), támbien esta la opcion de imprimir, las constancias de inscripción y de estudios si las llegase a necesitar(necesitan la firma y sello para ser válida).</p></h4>
							</li>
						</ul>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div> 
<footer class="footer3" >Servicios LFP - 2016</footer>