<?php
	if(local != 'p3isvwQ1jVUqn')
		exit();
?>	 
<div class="container">  
	<div class="row">
		<div class="col-md-12">
				<ol class="breadcrumb margin">
					<li class="active"><b>Registro de salud >></b></li>
				</ol>
				<div class="row con">
					<h1 class="text-center">Formulario de inscripción</h1>
						<h3 class="text-center">Registro de salud</h3>
					<br/>
					<div id="instruciones">
						<h4>Pasos a seguir:</h4>
						<ul>
							<li>
								<h4><span class="text-danger">1)</span>Coloque la cédula escolar del estudiante. <small class="text-danger">Presione Buscar.</small></h4>
							</li>
							<li>
								<h4><span class="text-danger">2)</span>Registre los datos de salud. <small class="text-danger">Guarde.</small></</h4>
							</li>
						</ul>
					</div>
						<hr/>
					<div class="col-md-12">
						<div class="col-md-2"></div>	
						<div class="col-md-4">
							<form id="form_estudiante" name="form_estudiante" >
								<div class="form-group">
									<label for="ci_escolar">Cédula escolar del estudiante:</label>
									<div class="input-group">
										<input id="ci_escolar" name="ci_escolar" class="form-control" type="number" placeholder="Cédula escolar"/>
										<span class="input-group-btn">
											<input id="padre_buscar" name="padre_buscar" type="submit" class="btn btn-info" value="Buscar" title="Buscar" required>
										</span> 
									</div>
								</div>
							</form>	
						</div>
						<div class="col-md-4">
							<p id="estudiante_name" class="hijo text-center"></p>
						</div>
						<div class="col-md-2"></div>
					</div>	
				</div>
					<hr/>
				<div id="registro_salud">
					<h3 id="titulo_salud" class="text-center">Registro de salud</h3>
						<br/>
					<form name="form_registro_salud" id="form_registro_salud">
						<div class="row con">
							<div class="col-md-12">
								<label class="vacu">Vacunas que el niño posee:</label>
								<div class="form-group">
									<div class="checkbox vacunas">
										<label>
											<input type="checkbox" id="vacunas_antivariolica" name="vacunas_antivariolica" value="Antivariolica"/>Antivariolica
										</label>
									</div>
									<div class="checkbox vacunas">
										<label>
											<input type="checkbox" id="" name="vacunas_sarampion" value="Sarampion"/>Sarampion
										</label>
									</div>
									<div class="checkbox vacunas">
										<label>
											<input type="checkbox" id="vacunas_polio" name="vacunas_polio" value="Polio"/>Polio
										</label>
									</div>
									<div class="checkbox vacunas">
										<label>
											<input type="checkbox" name="vacunas_triple" value="Triple"/>Triple
										</label>
									</div>
									<div class="checkbox vacunas">
										<label> 
											<input type="checkbox" id="vacunas_bcg" name="vacunas_bcg" value="BCG"/>BCG
										</label>
									</div>
									<div class="checkbox vacunas">
										<label>
											<input type="checkbox" id="vacunas_antitetanica" name="vacunas_antitetanica" value="Antitetanica"/>Antitetánica
										</label>
									</div>
									<div class="checkbox vacunas">
										<label>
											<input type="checkbox" id="vacunas_neumococo" name="vacunas_neumococo" value="Neumococo"/>Neumococo	
										</label>
									</div>
								</div>
							</div>
						</div>
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="enfermedad_padece">Enfermedad(es) que padece:</label>
										<input id="enfermedad_padece" name="enfermedad_padece" placeholder="¿Qué padece?" class="form-control" type="text" required/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
									<div class="form-group">
										<label>¿Es alérgico?:</label>
										<div class="radio">	
											<label>
												<input id="alergico" name="alergico" value="Si" type="radio" required/>Si
											</label>
											<label class="dos">
												<input id="alergico" name="alergico" value="No" type="radio"/>No
											</label>
										</div>
									</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group alergico">
										<label for="alergico_aque">Si la respuesta es positiva, ¿a qué?:</label>
										<input type="text" id="alergico_aque" name="alergico_aque" class="form-control" placeholder="¿A qué?"/>
									</div>
								</div>
								
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
										<label>¿Posee algún impedimento motor?:</label>
												<div class="radio">	
													<label>
														<input id="impedimento_motor" name="impedimento_motor" value="Si" type="radio" required/>Si
													</label>
													<label class="dos">
														<input id="impedimento_motor" name="impedimento_motor" value="No" type="radio"/>No
													</label>
												</div>		
										</div>
									</center>	
								</div>	
								<div class="col-md-4">
									<center>
										<label class="center-block">¿Cuál?:</label>
									</center>	
										<div class="form-group">
											<div class="checkbox imp_motor">
												<label>
													<input type="checkbox" id="impedimento_motor_pieplano" name="impedimento_motor_pieplano" value="Pie Plano"/>Pie plano
												</label>
											</div>
											<div class="checkbox imp_motor imp_motor2"> 
												<label>
													<input type="checkbox" id="impedimento_motor_columna" name="impedimento_motor_columna" value="Columna"/>Columna	
												</label>
											</div>
											<div class="checkbox imp_motor imp_motor2">
												<label>
													<input type="checkbox" id="impedimento_motor_articulaciones" name="impedimento_motor_articulaciones" value="Articulaciones"/>Articulaciones
												</label>
											</div>
										</div>
								</div>	
								<div class="col-md-4">
									<div class="form-group motor">
										<label for="impedimento_motor_otros">¿Otros?:</label>
										<input type="text" class="form-control" id="impedimento_motor_otros" name="impedimento_motor_otros" placeholder="¿Otros?"/>
									</div>
								</div>	
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="impedimento_motor_especialista">¿Es asistido por especialistas?, nombre:</label>
										<input type="text" id="impedimento_motor_especialista" name="impedimento_motor_especialista" class="form-control" placeholder="Nombre:"/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group"> 
											<label>El niño vive en:</label>	
											<div class="radio">	 
												<label>
													<input id="vivienda_tipo" name="vivienda_tipo" value="Casa" type="radio" required/>Casa
												</label>
												<label class="dos">
													<input id="vivienda_tipo" name="vivienda_tipo" value="Apartamento" type="radio"/>Apartamento
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>N° de habitantes:</label>	
										<input type="number" id="n_habitaciones" name="n_habitaciones" class="form-control" />
									</div>
								</div>
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group ubica">
											<label>Tenencia de la vivienda:</label>
											<div class="radio">	
												<label>
													<input id="vivienda_tenencia" name="vivienda_tenencia" value="Propia" type="radio" required/>Propia
												</label>
												<label class="dos">
													<input id="vivienda_tenencia" name="vivienda_tenencia" value="Alquilada" type="radio"/>Alquilada
												</label>
												<label class="dos">
													<input id="vivienda_tenencia" name="vivienda_tenencia" value="Familiar" type="radio"/>Familiar
												</label>
											</div>	
										</div>
									</center>	
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>Ubicación:</label>
											<div class="radio">	
												<label>
													<input id="vivienda_ubicacion" name="vivienda_ubicacion" value="Rural" type="radio" required/>Rural
												</label>
												<label class="dos">
													<input id="vivienda_ubicacion" name="vivienda_ubicacion" value="Urbana" type="radio"/>Urbana
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group ubica">
										<label for="n_hermanos">N° de hermanos que tiene el niño(a):</label>
										<input id="n_hermanos" type="number" name="n_hermanos" class="form-control" required/>
									</div>
								</div>
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="hermanos_posicion">Posición que ocupa entre hermanos:</label>
										<input type="text" id="hermanos_posicion" name="hermanos_posicion" class="form-control" placeholder="Posición" required/>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group sanguineo">
										<label for="n_personas_vive_nino">N° de personas que viven con el niño(a):</label>
										<input type="number" id="n_personas_vive_nino" name="n_personas_vive_nino" class="form-control" required/>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group sanguineo">
										<label for="grupo_sanguineo">Grupo sanguineo:</label>
										<input type="text" id="grupo_sanguineo" name="grupo_sanguineo" class="form-control" placeholder="Grupo sanguineo" required/>
									</div>
								</div>
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<label class="enfermedades">Enfermedades que a padecido:</label>
								<div class="form-group">
									<div class="checkbox enfermedades"> 
										<label>
											<input type="checkbox" id="enfermedades_bronquitis" name="enfermedades_bronquitis" value="Bronquitis"/>Bonquitis
										</label>
									</div>
									<div class="checkbox enfermedades"> 
										<label>
											<input type="checkbox" id="enfermedades_alergias" name="enfermedades_alergias" value="Alergias"/>Alergias
										</label>
									</div>
									<div class="checkbox enfermedades"> 
										<label>
											<input type="checkbox" id="enfermedades_hepatitis" name="enfermedades_hepatitis" value="Hepatitis"/>Hepatitis
										</label>
									</div>
									<div class="checkbox enfermedades"> 
										<label>
											<input type="checkbox" id="enfermedades_resfriados" name="enfermedades_resfriados" value="Resfriado Común"/>Resfriado común
										</label>
									</div>
									<div class="checkbox enfermedades"> 
										<label>
											<input type="checkbox" id="enfermedades_paperas" name="enfermedad_paperas" value="Paperas"/>Paperas
										</label>
									</div> 
									<div class="checkbox enfermedades"> 
										<label>
											<input type="checkbox" id="enfermedades_intoxicacion" name="enfermedades_intoxicacion" value="Intoxicación"/>Intoxicación
										</label>
									</div>
									<div class="checkbox enfermedades"> 
										<label>
											<input type="checkbox" id="enfermedades_asma" name="enfermedades_asma" value="Asma"/>Asma
										</label>
									</div>
									<div class="checkbox enfermedades"> 
										<label>
											<input type="checkbox" id="enfermedades_varicela" name="enfermedades_varicela" value="Varicela"/>Varicela
										</label>
									</div>
									<div class="checkbox enfermedades"> 
										<label>
											<input type="checkbox" id="enfermedades_ninguna" name="enfermedades_ninguna" value="Ninguna"/>Ninguna
										</label>
									</div>
									<div class="checkbox enfermedades">
										<label for="enfermedades_otras">¿Otras?:</label>
										<input type="text" id="enfermedades_otras" name="enfermedades_otras" class="form-control otras" placeholder="¿Otras?" size="6"/>
									</div>
								</div>
							</div>
						</div>
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label id="emb_lab3">¿Sufrió alguna enfermadad durante el embarazo?:</label>	
											<div id="emb_lab_div2" class="radio">	
												<label>
													<input id="embarazo_enfermedad" name="embarazo_enfermedad" value="Si" type="radio" required/>Si
												</label>
												<label class="dos">
													<input id="embarazo_enfermedad" name="embarazo_enfermedad" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label id="emb_lab2">¿El embarazo fue controlado?:</label>	
												<div id="emb_lab_div" class="radio">	
													<label>
														<input id="embarazo_controlado" name="embarazo_controlado" value="Si" type="radio" required/>Si
													</label>
													<label class="dos">
														<input id="embarazo_controlado" name="embarazo_controlado" value="No" type="radio"/>No
													</label>
												</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label id="emb_lab" for="embarazo_deseado">¿Fue un embarazo deseado y planificado?:</label>
										<input type="text" id="embarazo_deseado" name="embarazo_deseado" class="form-control" placeholder="¿Deseado y planificado?"/>
									</div>
								</div>
							</div>
						</div>    							
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Tuvo algun problema dureante el parto?:</label>	
											<div class="radio">	
												<label>
													<input id="parto_problema" name="parto_problema" value="Si" type="radio" required/>Si
												</label>
												<label class="dos">
													<input id="parto_problema" name="parto_problema" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<center>
											<label>¿Cómo fue el parto?:</label>
											<div class="radio">	
												<label class="parto">
													<input id="parto" name="parto" value="Normal" type="radio" required/>Parto normal
												</label>
												<label class="parto">
													<input id="parto" name="parto" value="Cesarea" type="radio"/>Cesárea
												</label>
												<label class="parto">
													<input id="parto" name="parto" value="Prematuro" type="radio"/>Prematuro
												</label>
												<label class="parto">
													<input id="parto" name="parto" value="A termino" type="radio"/>A termino
												</label>
											</div>
										</center>
									</div>
								</div>
								
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="peso_nacer">¿Peso al nacer?:</label> 
										<input type="text" id="peso_nacer" name="peso_nacer" class="form-control" placeholder="¿Peso al nacer?"/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Se chupa los dedos?: </label>	
											<div class="radio">	
												<label>
													<input id="chupa_dedo" name="chupa_dedo" value="Si" type="radio"/>Si
												</label>
												<label class="dos">
													<input id="chupa_dedo" name="chupa_dedo" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>	
								</div>
								<div class="col-md-4">	
									<div class="form-group">
										<label for="talla_nacer">¿Talla al nacer?:</label>
										<input type="text" id="talla_nacer" name="talla_nacer" class="form-control" placeholder="¿Talla al nacer?"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="convulsionado">¿Ha convulsionado?:</label>
										<input type="text" id="convulsionado" name="convulsionado" class="form-control" placeholder="¿Ha convulsionado?" required/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Hubo lactancia materna?:</label>	
											<div class="radio">	
												<label>
													<input id="lactancia" name="lactancia" value="Si" type="radio" required/>Si
												</label>
												<label class="dos">
													<input id="lactancia" name="lactancia" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="lactancia_tiempo">¿Durante cuanto tiempo?:</label>
										<input type="text" id="lactancia_tiempo" name="lactancia_tiempo" class="form-control" placeholder="¿Durante cuanto tiempo?"/>	
									</div>
								</div>
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="accidente">¿Ha sufrido algún accidente?:</label>
										<input id="accidente" name="accidente" class="form-control" placeholder="¿Ha sufrido algún accidente?:" type="text" required/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Es alérgico a algún alimento?:</label>	
											<div class="radio">	
												<label>
													<input id="alimento_alergico" name="alimento_alergico" value="Si" type="radio" required/>Si
												</label>
												<label class="dos">
													<input id="alimento_alergico" name="alimento_alergico" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="alimento_cual">¿Cuál?:</label>
										<input type="text" id="alimento_cual" name="alimento_cual" class="form-control" placeholder="¿Cuál?"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="dormir_bien">¿Duerme bien?:</label>
										<input type="text" id="dormir_bien" name="dormir_bien" class="form-control" placeholder="¿Duerme bien?" required/>							
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Necesita luz para dormir?:</label>	
											<div class="radio">	
												<label>
													<input id="dormir_luz" name="dormir_luz" value="Si" type="radio"/>Si
												</label>
												<label class="dos">
													<input id="dormir_luz" name="dormir_luz" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="dormir_juguete">¿Algún elemento o juguete para dormir?:</label>
										<input type="text" id="dormir_juguete" name="dormir_juguete" class="form-control" placeholder="¿Cuál?"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Se baña solo o con ayuda?:</label>	
											<div class="radio">	
												<label>
													<input id="bana_solo_ayuda" name="bana_solo_ayuda" value="Solo" type="radio" required/>Solo
												</label>
												<label class="dos">
													<input id="bana_solo_ayuda" name="bana_solo_ayuda" value="Con ayuda" type="radio"/>Con ayuda
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<center>
									<div class="form-group">
										<label>¿Necesita ayuda para ir al baño?:</label>	
										<div class="radio">	
											<label>
												<input id="ayuda_bano" name="ayuda_bano" value="Si" type="radio" required/>Si
											</label>
											<label class="dos">
												<input id="ayuda_bano" name="ayuda_bano" value="No" type="radio"/>No
											</label>
										</div>
									</div>
									</center>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Camina bien?:</label>	
											<div class="radio">	
												<label>
													<input id="camina_bien" name="camina_bien" value="Si" type="radio" required/>Si
												</label>
												<label class="dos">
													<input id="camina_bien" name="camina_bien" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>	
								</div>	
							</div>
						</div>	
                        <div class="row con">
							<div class="col-md-12">
								<center>
									<label>¿Con qué frecuencia ha asitido el escolar a consultas con?:</label>
								</center>
								<div class="col-md-3">
									<div class="form-group">
										<label for="psicologo">Psicólgo:</label>
											<input id="psicologo" name="psicologo" type="number" class="form-control" size="5" required/>											
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="psicologo_porque">¿Por qué?:</label>
											<input type="text" id="psicologo_porque" name="psicologo_porque" class="form-control" placeholder="¿Por qué?"/>
									</div>
								</div>	
								<div class="col-md-3">
									<div class="form-group">
										<label for="neurologo">Neurólogo:</label>
											<input id="neurologo" name="neurologo" type="number" class="form-control" size="5" required/>											
									</div>
								</div>	
								<div class="col-md-3">
									<div class="form-group">
										<label for="neurologo_porque">¿Por qué?:</label>
											<input type="text" id="neurologo_porque" name="neurologo_porque" class="form-control" placeholder="¿Por qué?"/>
									</div>
								</div>	
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group cual">
											<label>¿Esta medicado?:</label>	
											<div class="radio">	
												<label>
													<input id="medicado" name="medicado" value="Si" type="radio" required/>Si
												</label>
												<label class="dos">
													<input id="medicado" name="medicado" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="tratamiento_prolongado">¿Tratamiento prolongado?:</label>
										<input type="text" id="tratamiento_prolongado" name="tratamiento_prolongado" class="form-control" placeholder="Especifique"/>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="dificulta_respiratoria_cardiaca" class="respira_lab">¿Presenta alguna dificultad respiratoria o cardíaca?:</label>
										<input id="dificulta_respiratoria_cardiaca" name="dificulta_respiratoria_cardiaca" class="form-control" type="text" placeholder="Especifique" required/>
									</div>
								</div>
							</div>
						</div>	
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Escucha bien?:</label>	
											<div class="radio">	
												<label>
													<input id="escucha_bien" name="escucha_bien" value="Si" type="radio" required/>Si
												</label>
												<label class="dos">
													<input id="escucha_bien" name="escucha_bien" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>	
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Ha estado intoxicado?:</label>	
											<div class="radio">	
												<label>
													<input id="intoxicado" name="intoxicado" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="intoxicado" name="intoxicado" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="intoxicado_conque">¿Con qué?:</label>
										<input id="intoxicado_conque" name="intoxicado_conque" class="form-control" placeholder="¿Con qué?" type="text"/>
									</div>
								</div>
								
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Ve bien?:</label>	
											<div class="radio">	
												<label>
													<input id="ve_bien" name="ve_bien" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="ve_bien" name="ve_bien" value="No" type="radio"/>No
												</label>
											</div>
										</div>	
									</center>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Ha sido operado?:</label>	
											<div class="radio">	
												<label>
													<input id="operado" name="operado" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="operado" name="operado" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="operado_deque">¿De qué?:</label>
										<input id="operado_deque" name="operado_deque" class="form-control" type="text" placeholder="¿De qué?"/>
									</div>
								</div>
							</div>
						</div>	
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Utiliza anteojos?:</label>	
											<div class="radio">	
												<label>
													<input id="anteojos" name="anteojos" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="anteojos" name="anteojos" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Es alérgico a algún medicamento?:</label>	
											<div class="radio dedos">	
												<label>
													<input id="medicamento_alergico" name="medicamento_alergico" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="medicamento_alergico" name="medicamento_alergico" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="medicamento_cual">¿A cual?:</label>
										<input id="medicamento_cual" name="medicamento_cual" class="form-control" type="text" placeholder="¿A cual?"/>
									</div>
								</div>
							</div>
						</div>
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="juegos_gustan">¿Qué juegos le gustán?:</label>
										<input id="juegos_gustan" name="juegos_gustan" class="form-control" type="text" placeholder="¿Qué juegos le gustán?" required/>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="juegos_con_quien">¿Cón quien juega?:</label>
										<input id="juegos_con_quien" name="juegos_con_quien" type="text" class="form-control" placeholder="¿Cón quien juega?"/>
									</div>	
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="juegos_actitud">¿Comó es su actitud ante el juego?:</label>
										<input type="text" id="juegos_actitud" name="juegos_actitud" class="form-control" placeholder="¿Comó es su actitud ante el juego?" required/>
									</div>
								</div>
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="pediatra_nombre">Pediatra que lo(a) atiende:</label>
										<input type="text" id="pediatra_nombre" name="pediatra_nombre" class="form-control" placeholder="Nombre" required/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Manifiesta miedos?:</label>	
											<div class="radio">	
												<label>
													<input id="miedos" name="miedos" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="miedos" name="miedos" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="miedos_causa">¿Conoce ud la causa?:</label>
										<input id="miedos_causa" name="miedos_causa" class="form-control" type="text" placeholder="¿Conoce ud la causa?"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Practica alguna actividad complementaria?:</label>	
											<div class="radio veces">	
												<label>
													<input id="actividad_complementaria" name="actividad_complementaria" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="actividad_complementaria" name="actividad_complementaria" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="actividad_cual">¿Cuál?:</label>
										<input type="text" id="actividad_cual" name="actividad_cual" class="form-control" placeholder="¿Cuál?"/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Tiene alguna mascota?:</label>	
											<div class="radio">	
												<label>
													<input id="mascota" name="mascota" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="mascota" name="mascota" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="mascota_cual">¿Cuál mascota?:</label>
										<input type="text" id="mascota_cual" name="mascota_cual" class="form-control" placeholder="¿Cuál?"/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Escucha música?:</label>	
											<div class="radio">	
												<label>
													<input id="musica" name="musica" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="musica" name="musica" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<center>
										<label>¿Qué tipo?:</label>
										<div class="form-group tipo_musica">
											<div class="checkbox vacunas"> 
												<label>
													<input type="checkbox" id="musica_infantil" name="musica_infantil" value="Infantial"/>Infantil
												</label>
											</div>
											<div class="checkbox vacunas"> 
												<label>
													<input type="checkbox" id="musica_reggaeton" name="musica_reggaeton" value="Reggaeton"/>Reggaeton
												</label>
											</div>
										</div>
									</center>
								</div>
							</div>
						</div>
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group"> 
										<label>¿Otros generos?:</label>
										<input type="text" id="musica_otra" name="musica_otra" class="form-control" placeholder="¿Otros generos?"/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group"> 
											<label>¿Ve televisión - internet?:</label>	
											<div class="radio">	
												<label>
													<input id="tv" name="tv" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="tv" name="tv" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="programas">¿Qué programas?:</label>
										<input type="text" id="programas" name="programas" class="form-control" placeholder="¿Qué programas?" required/>
									</div>
								</div>
							</div>
						</div>    
                        <div class="row con">
							<div class="col-md-12">
									<div class="col-md-4">
									<div class="form-group">
										<label for="horas_diarias">¿Cuántas horas diarias?:</label>
										<input type="number" id="horas_diarias" name="horas_diarias" class="form-control" placeholder="¿Cuántas horas diarias?" required/>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="relaciona_otros_ninos">¿Se relaciona facilmente con otros niños?:</label>
										<input type="text" id="relaciona_otros_ninos" name="relaciona_otros_ninos" class="form-control" placeholder="¿Se relaciona facilmente con otros niños?" required/>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="busca_nino_grandes">¿Busca la compañia de otros niños mayores?:</label>
										<input type="text" id="busca_nino_grandes" name="busca_nino_grandes" class="form-control" placeholder="" required/>
									</div>
								</div>
							</div>
						</div>  
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="religion_familia">¿Qué religión profesa su familia?:</label>
										<input type="text" id="religion_familia" name="religion_familia" class="form-control" placeholder="¿Qué religión profesa su familia?" required/>
									</div>
								</div>
								<div class="col-md-8">
									<center><label>¿Que actitud toma ante una travesura de su niño(a)?:</label></center>
									<div class="col-md-6">
										<div class="form-group">
											<label for="actitud_travesuras_padre" class="actitud_label">¿El padre?:</label>
											<input type="text" id="actitud_travesuras_padre" name="actitud_travesuras_padre" class="form-control actitud" placeholder="Padre" required/>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="actitud_travesuras_madre" class="actitud_label">¿La madre?:</label>
											<input type="text" id="actitud_travesuras_madre" name="actitud_travesuras_madre" class="form-control actitud" placeholder="Madre" required/>
										</div>
									</div>
								</div>
							</div>
						</div> 
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="molesta_nino_haga">¿Qué cosa le disgusta a ud que el(ella) haga?:</label>
										<input type="text" id="molesta_nino_haga" name="molesta_nino_haga" class="form-control" placeholder="¿Qué cosa le disgusta a ud que el(ella) haga?" required/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Lo reprende?:</label>	
											<div class="radio">	
												<label>
													<input id="reprende" name="reprende" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="reprende" name="reprende" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="manera_reprender">¿De que manera?:</label>
										<input type="text" id="manera_reprender" name="manera_reprender" class="form-control" placeholder="¿De que manera?"/>
									</div>
								</div>
							</div>
						</div>    
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="comunica_que_siente">¿El niño(a) comunica lo que siente?:</label>
										<input type="text" id="comunica_que_siente" name="comunica_que_siente" class="form-control" placeholder="¿El niño(a) comunica lo que siente?" required/>
									</div>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Conversan con él niño(a)?:</label>	
											<div class="radio">	
												<label>
													<input id="conversa_familia" name="conversa_familia" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="conversa_familia" name="conversa_familia" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="tema_conversa">¿Sobre que temas?:</label>
										<input type="text" id="tema_conversa" name="tema_conversa" class="form-control" placeholder="¿Sobre que temas?"/>
									</div>
								</div>
							</div>
						</div>   
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿El(la) niño(a) pasa algún tiempo solo?:</label>	
											<div class="radio">	
												<label>
													<input id="tiempo_solo" name="tiempo_solo" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="tiempo_solo" name="tiempo_solo" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>	
								<div class="col-md-4">
									<div class="form-group">
										<label for="cuando_nino_solo">¿Cuándo?:</label>
										<input type="text" id="cuando_nino_solo" name="cuando_nino_solo" class="form-control" placeholder="¿Cuándo?"/>
									</div>
								</div>
							</div>
						</div>
                         <div class="row con">
							<div class="col-md-12">
								<center><label>¿Con quien se queda el niño(a)?:</label></center> 
								<div class="form-group">
									<div class="col-md-2">
										<div class="checkbox"> 
											<label style="margin-left:50%;">
												<input type="checkbox" id="queda_nino_padre" name="queda_nino_padre" value="Padre"/>Padre
											</label>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="checkbox"> 
											<label>
												<input type="checkbox" id="queda_nino_madre" name="queda_nino_madre" value="Madre"/>Madre
											</label>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
												<label for="queda_nino_hermano">Hermano(a):</label>
													<input type="text" id="queda_nino_hermano" name="queda_nino_hermano" class="form-control" placeholder="Nombre"/>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<label for="queda_nino_familiar">Familiar:</label>
												<input type="text" id="queda_nino_familiar" name="queda_nino_familiar" class="form-control" placeholder="Nombre"/>
										</div>
									</div>
									<div class="col-md-2">	
										<div class="form-group">
											<label for="queda_nino_empleada">Empleada:</label>
												<input type="text" id="queda_nino_empleada" name="queda_nino_empleada" class="form-control" placeholder="Nombre"/>
										</div>
									</div>	
									<div class="col-md-2">	
										<div class="form-group">
											<label for="queda_nino_otro">Otros:</label>
												<input type="text" id="queda_nino_otro" name="queda_nino_otro" class="form-control" placeholder="Nombre"/>
										</div>
									</div>	
								</div>	
							</div>
						</div>
						<div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Es primera vez que el niño(a) asiste al preescolar?:</label>	
											<div class="radio">	
												<label>
													<input id="primera_vez_preescolar" name="primera_vez_preescolar" value="Si" type="radio"/>Si
												</label>
												<label>
													<input id="primera_vez_preescolar" name="primera_vez_preescolar" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿El niño(a) asistio al maternal?:</label>	
											<div class="radio">	
												<label>
													<input id="asistio_maternal" name="asistio_maternal" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="asistio_maternal" name="asistio_maternal" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>	
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="nombre_maternal">Nombre del maternal:</label>
										<input type="text" id="nombre_maternal" name="nombre_maternal" class="form-control" placeholder="Nombre del maternal"/>
									</div>
								</div>
							</div>
						</div> 
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<center>
										<div class="form-group">
											<label>¿Asiste al maternal por primera vez?:</label>	
											<div class="radio">	
												<label>
													<input id="primera_vez_maternal" name="primera_vez_maternal" value="Si" type="radio" required/>Si
												</label>
												<label>
													<input id="primera_vez_maternal" name="primera_vez_maternal" value="No" type="radio"/>No
												</label>
											</div>
										</div>
									</center>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="motivo_eleccion">¿Cuál fue el motivo de su elección sobre la E.E.I. Colegio Teresa de la Parra?:</label>
										<input type="text" id="motivo_eleccion" name="motivo_eleccion" class="form-control" placeholder="¿Cuál fue el motivo de su elección?" required/>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="espera_de_teresa">¿Qué espera usted de la E.E.I. Colegio Teresa de la Parra?:</label>
										<input type="text" id="espera_de_teresa" name="espera_de_teresa" class="form-control" placeholder="¿Qué espera?" required/>
									</div>
								</div>
							</div>
						</div>    
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-8">
									<center><label>Apellidos y nombres de la persona autorizada para retirar el niño(a) de la institución:</label></center>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" id="perso_autori_reti_ninho_apell" name="perso_autori_reti_ninho_apell" class="form-control" placeholder="Apellidos" required/>
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" id="perso_autori_reti_ninho_name" name="perso_autori_reti_ninho_name" class="form-control" placeholder="Nombres" required/>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="perso_autori_reti_ninho_ci">Cédula de la persona:</label>
										<input type="number" id="perso_autori_reti_ninho_ci" name="perso_autori_reti_ninho_ci" class="form-control" placeholder="Cédula" required/>
									</div>
								</div>
							</div>
						</div>    
                        <div class="row con">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label for="perso_autori_reti_ninho_parent">Parentesco:</label>
										<input type="text" id="perso_autori_reti_ninho_parent" name="perso_autori_reti_ninho_parent" class="form-control" placeholder="Parentesco" required/>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="fecha_insc">Fecha de inscripción:</label>	
										<input type="text" id="fecha_insc" name="fecha_insc" class="form-control" required/>
									</div>
								</div>
							</div>	
						</div> 
						<div class="clearfix"></div>
						<br/>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<center>
										<input id="btn_registroSalud_lim" name="btn_registroSalud_lim" class="btn btn-primary" type="reset" value="Limpiar"/>
										<input id="btn_registroSalud_env" name="btn_registroSalud_env" class="btn btn-success" type="submit" value="Guardar"/>
									</center>
								</div>
							</div>	 
						</div>
					</form>	
				</div>	
		</div>
	</div>
</div>
<footer class="footer" >Servicios LFP - 2016</footer>