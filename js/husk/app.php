$(document).ready(function(){
	
	
	function prXHR(){
		var xhr = new window.XMLHttpRequest();
		xhr.upload.addEventListener('progress', function(evt){
			if(evt.lengthComputable){
				var percentComplete = evt.loaded / evt.total;
				$('#general_progress').find('.determinate').width(Math.round(percentComplete * 100)+'%');
			}
		},false);
		xhr.addEventListener('progress', function(evt){
			if (evt.lengthComputable){
				var percentComplete = evt.loaded / evt.total;
				$('#general_progress').find('.determinate').width(Math.round(percentComplete * 100)+'%');
			}
		},false);
		return xhr;
	}
				
	function nfXHR(){return new window.XMLHttpRequest();}
				
	function hideProgressBar(){
		$('#general_progress').hide();
		$('#general_progress').find('.determinate').width('0%');
	}
	
	
	function makeAjax(url,method,dat,type,callback,x,extra){
		if(x){ $('#general_progress').show();}
		
		var processData=true;
		if(method != "GET" || null === dat)
			processData=false;
		else
			processData=true;
		
		return $.ajax({
			xhr:x?prXHR:nfXHR,
			url: url,
			method: method,
			cache:false,
			data:dat,
			processData: processData,
			contentType: false,
			dataType: type
		}).done(function(d){
			if(x) hideProgressBar();
			if(extra)
				callback(d,extra);
			else
				callback(d);
		}).fail(function(a,b,d){
			if(x) hideProgressBar();
			toastr.error('Error al establecer conexión','', {progressBar:true});
			if(extra)
				callback(false,extra);
			else
				callback(false);
		});
	}
	
		$('.carousel').carousel({
			interval: 3000 //changes the speed
		});
		
		
	<?php
		if($user->isLogged()){
			switch($subpage){
				case 'usuario':
	?>
				//Inicio Usuario	
				function addUsuario(d,r){
					add_user = false;
					editar_user = false;
					if(d){
						switch(d.e){
							case 0:
								r.id = d.id;
								if(edit_user){
									toastr.success('Usuario Editado exitosamente',{progressBar:true});
									$('#list_users_li_'+d.id).replaceWith(makeUsuario(r));
									$('#btn_editUser_lim').click();	
									$('#btn_editUser_can').click();
									edit_user = false;	 
								}else{
									toastr.success('Usuario Agregado exitosamente',{progressBar:true});
									$('#list_users').append(makeUsuario(r));
									$('#btn_lim_user').click();	
								}
								
								break;
							default:
								if(edit_user){
									$('#btn_editUser_lim').click();	
									$('#btn_editUser_can').click();	
									toastr.error('Error, no se puedo Editar el Usuario',{progressBar:true});
								}else{
									toastr.error('Error, no se puedo Agregar el Usuario',{progressBar:true});
								}
								
								break;
						}
					}
				}
				
				var add_user = false;
				$('body').on('submit','#form_usuario',function(){
					if(add_user)
						return false;
					add_user = true;
					
				name_user = document.form_usuario.name_user.value;
				user_user = document.form_usuario.user_user.value;
				pass_user = document.form_usuario.pass_user.value;
				confiPass_user = document.form_usuario.confiPass_user.value;
				pri_user = document.form_usuario.pri_user.value;
				
				if(pass_user == confiPass_user){
					var formData = new FormData();
					formData.append('nombre',name_user);
					formData.append('user',user_user);
					formData.append('password',pass_user);
					formData.append('tipo',pri_user);
					
					var r = {
						nombre:name_user,
						user:user_user,
						tipo:pri_user
					}; 
					makeAjax('api/usuarios','POST',formData,'json',addUsuario,true,r);
					
				}else{
					toastr.error('Error, Las contraseñas no son iguales',{progressBar:true});
				}
					return false;
				});
				
				function makeUsuario(d){
					var item = [],i = 0,privilegio = "",t = parseInt(d.tipo);
					
					switch(t){
						case 1:
							privilegio = "Administrador";
							break;
						case 2:
							privilegio = "Empleado";
							break;
						case 3:
							privilegio = "Representante";
							break;
					}
					
					item[i++]='<tr id="list_users_li_'+d.id+'" i="'+d.id+'" nombre="'+d.nombre+'" user="'+d.user+'" tipo="'+d.tipo+'" >';
					item[i++]='<td class="celda">'+d.id+'</td>';
					item[i++]='<td class="celda">'+d.nombre+'</td>';
					item[i++]='<td class="celda">'+d.user+'</td>'; 
					item[i++]='<td class="celda">'+privilegio+'</td>';
					if(t == 1){
						item[i++]='<td class="celda"></td>';
						item[i++]='<td class="celda"></tr>';
					}else{
						item[i++]='<td class="celda"><a href="#modal_edit_user" data-toggle="modal"><span class="edit_user edit glyphicon glyphicon-pencil"></span></a></td>';
						item[i++]='<td class="celda"><a href="#modal_remove_user" data-toggle="modal"><span class="remove_user remove glyphicon glyphicon-trash"></span></a></td></tr>';	
					}
					
					return item.join("");
				}
				
				function getUsuario(d){
					if(d){
						switch(d.e){
							case 0:
								var l = d.usuarios.length,
								item,
								items=[],
								i=0;
								
								for(;i<l;i++){
									item = d.usuarios[i];
									items[i] = makeUsuario(item);
								}
								$('#list_users').html(items.join(""));
								break;
							default:
							toastr.error('No hay Usuarios para listar',{progressBar:true});
								break;
						}
					}
				}

				function get_users(){
					makeAjax('api/usuarios','GET',null,'json',getUsuario,true);
				}	
				get_users();
				
				
				
				var edit_user = false;
				$('body').on('click','.edit_user',function(){
					edit_user = $(this).parents('tr').attr('i');
					name_user = $(this).parents('tr').attr('nombre');
					user_user = $(this).parents('tr').attr('user');
					pri_user = $(this).parents('tr').attr('tipo');
					$('#modal_name_user').val(name_user);
					$('#modal_user_user').val(user_user);
					$('#modal_pri_user').val(pri_user);
				})
				
				var editar_user = false;
				$('body').on('submit','#form_edit_user',function(){
					if(editar_user)
						return false;
					editar_user = true;
					
				modal_name_user = document.form_edit_user.modal_name_user.value;
				modal_user_user = document.form_edit_user.modal_user_user.value;
				modal_pass_user = document.form_edit_user.modal_pass_user.value;
				modal_confiPass_user = document.form_edit_user.modal_confiPass_user.value;
				modal_pri_user = document.form_edit_user.modal_pri_user.value;
				
				if(modal_pass_user == modal_confiPass_user){
					var formData = new FormData();
					formData.append('id',edit_user);
					formData.append('nombre',modal_name_user);
					formData.append('user',modal_user_user);
					formData.append('password',modal_pass_user);
					formData.append('tipo',modal_pri_user);
					
					var r = {
						nombre:modal_name_user,
						user:modal_user_user,
						tipo:modal_pri_user
					};
					makeAjax('api/usuarios','PUT',formData,'json',addUsuario,true,r);
					
				}else{
					toastr.error('Error, Las contraseñas no son iguales',{progressBar:true});
				}
					return false;
				});
				
				function deleteUser(d){
					if(d){
						switch(d.e){
							case 0:
								toastr.success('Usuario Eliminado exitosamente',{progressBar:true});
								$('#list_users_li_'+d.id).remove();
								$('#btn_modalUser_no').click();
								break;
							default:
								toastr.error('Error, no se puedo Eliminar el Usuario',{progressBar:true});
								break;
						}
					}
				}
				
				var delete_user = false;
				$('body').on('click','.remove_user',function(){
					delete_user = $(this).parents('tr').attr('i');
					nombre = $(this).parents('tr').attr('nombre')
					user = $(this).parents('tr').attr('user')
					tipo = $(this).parents('tr').attr('tipo')
					var privilegio = "", t = parseInt(tipo);
						switch(t){
							case 1:
								privilegio = "Administrador";
								break;
							case 2:
								privilegio = "Empleado";
								break;
							case 3:
								privilegio = "Representante";
								break;
						}
					$('#modal_nameUser_remove').text(nombre);
					$('#modal_userUser_remove').text(user);
					$('#modal_priUser_remove').text(privilegio);
				})
				
				$('body').on('submit','#form_remove_user',function(){
					var formData = new FormData();
					formData.append('id',delete_user);
					
					makeAjax('api/usuarios','DELETE',formData,'json',deleteUser,true);
					return false;
				});
	<?php
					break;
					//Fin Usuario
					
					//Inicio Registro Representante
				case 'registro_representantes':
	?>	
				$('#repre_fechaN').pickadate({
					format: 'dd-mm-yyyy',
					container : '.container',
					min: new Date(Date.now()-3153600000000),
					max: new Date(Date.now()-567648000000),
					selectYears: 99,
					selectMonths: true
				});	
				
				function addRepre(d){
						add_repre = false;
					if(d){
						switch(d.e){
							case 0:
								toastr.success('Representante Registrado Exitosamente',{progressBar:true});
								$('#btn_registroRepre_lim').click();
								break;
							case 1:
								toastr.error('Error al registrar el Representante',{progressBar:true});
								break;
							case 2:
								toastr.error('Error, esa cédula ya existe en el sistema',{progressBar:true});
								break;	
						}
					}
				}
				
				var add_repre = false;
					$('body').on('submit','#form_registro_repre',function(){
						if(add_repre)
							return false;	
						add_repre = true;
						
					repre_apellido = document.form_registro_repre.repre_apellido.value;
					repre_nombre = document.form_registro_repre.repre_nombre.value;
					repre_nacionalidad = document.form_registro_repre.repre_nacionalidad.value;
					repre_ci = document.form_registro_repre.repre_ci.value;
					repre_estado = document.form_registro_repre.repre_estado.value;
					repre_municipio = document.form_registro_repre.repre_municipio.value;
					repre_ciudad = document.form_registro_repre.repre_ciudad.value;
					repre_fechaN = document.form_registro_repre.repre_fechaN.value;
					repre_estado_civil = document.form_registro_repre.repre_estado_civil.value;
					repre_direccion = document.form_registro_repre.repre_direccion.value;
					repre_telefono_casa = document.form_registro_repre.repre_telefono_casa.value;
					repre_celular = document.form_registro_repre.repre_celular.value;
					repre_viveCon_hijo = document.form_registro_repre.repre_viveCon_hijo.value;
					repre_nivel_educacion = document.form_registro_repre.repre_nivel_educacion.value;
					repre_titulo = document.form_registro_repre.repre_titulo.value;
					repre_trabajo = document.form_registro_repre.repre_trabajo.value;
					repre_direccion_trabajo = document.form_registro_repre.repre_direccion_trabajo.value;
					repre_telefono_trabajo = document.form_registro_repre.repre_telefono_trabajo.value;
					repre_ingreso_mensual = document.form_registro_repre.repre_ingreso_mensual.value;
					repre_status = 1;
					
					formData = new FormData();
					formData.append('repre_apellido',repre_apellido);
					formData.append('repre_nombre',repre_nombre);
					formData.append('repre_nacionalidad',repre_nacionalidad);
					formData.append('repre_ci',repre_ci);
					formData.append('repre_estado',repre_estado);
					formData.append('repre_municipio',repre_municipio);
					formData.append('repre_ciudad',repre_ciudad);
					formData.append('repre_fechaN',repre_fechaN);
					formData.append('repre_estado_civil',repre_estado_civil);
					formData.append('repre_direccion',repre_direccion);
					formData.append('repre_telefono_casa',repre_telefono_casa);
					formData.append('repre_celular',repre_celular);
					formData.append('repre_viveCon_hijo',repre_viveCon_hijo);
					formData.append('repre_nivel_educacion',repre_nivel_educacion);
					formData.append('repre_titulo',repre_titulo);
					formData.append('repre_trabajo',repre_trabajo);
					formData.append('repre_direccion_trabajo',repre_direccion_trabajo);
					formData.append('repre_telefono_trabajo',repre_telefono_trabajo);
					formData.append('repre_ingreso_mensual',repre_ingreso_mensual);
					formData.append('repre_status',repre_status);
					
					makeAjax('api/representante','POST',formData,'json',addRepre,true);
					return false;
					});	
			
	<?php
					break;
					//Fin Registro Representante
					
					//Inicio Registro Estudiante
				case 'registro_estudiante':
	?>
					
					$('#hijo_fechaN').pickadate({
						format: 'dd-mm-yyyy',
						container : '.container',
						min: new Date(Date.now()-157680000000),
						max: new Date(Date.now()-31536000000),
						selectYears: 99,
						selectMonths: true
					});	

					$('#repre_legal').hide();	

					var idMadre = "";
					function getMadre(d){
						add_madre = false;
						if(d){
							switch(d.e){
								case 0:
										
								if(madre_ci == padre_ci){
									toastr.error('Error, no puede colocar la misma cédula en ambos padres',{progressBar:true});
									$('#madre_name').text('');
									idMadre = '';
								}else{
									idMadre = d.representante.repre_id;
									var nameMadre = d.representante.repre_nombre;
									var apeMadre = d.representante.repre_apellido; 
									
									$('#madre_name').text(nameMadre+' '+apeMadre);
								}
									break;
								default:
									toastr.error('Error, esa cédula no esta registrada',{progressBar:true});
									break;
							}
						}
					}
						
						var add_madre = false, madre_ci = "";
					$('body').on('submit', '#form_madre', function(){
						if(add_madre)
							return false;
						add_madre = true;
						
							madre_ci = document.form_madre.madre_ci.value;
					
							var data = {
								filter:"c",
								term:madre_ci
							};
							makeAjax('api/repreSingle','GET',data,'json',getMadre,true);
						return false;
					});
					
					
						var idPadre = "";
					function getPadre(d){
						add_padre = false;
						if(d){
							switch(d.e){
								case 0:
									if(madre_ci == padre_ci){
										toastr.error('Error, no puede colocar la misma cédula en ambos padres',{progressBar:true});
										$('#padre_name').text('');
										idPadre = '';
									}else{
										idPadre = d.representante.repre_id;
										var namePadre = d.representante.repre_nombre;
										var apePadre = d.representante.repre_apellido; 
										
										$('#padre_name').text(namePadre+' '+apePadre);
									}
									break;
								default:
									toastr.error('Error, esa cédula no esta registrada',{progressBar:true});
									break;
							}
						}
					} 
						var add_padre = false, padre_ci = "";
					$('body').on('submit', '#form_padre', function(){
						if(add_padre)
							return false;
						add_padre = true;
							
						padre_ci = document.form_padre.padre_ci.value;
				
						var data = {
							filter:"c",
							term:padre_ci
						};
						makeAjax('api/repreSingle','GET',data,'json',getPadre,true);
						return false;
					});
					
					
						var idRl = "";
					function getRl(d){
						add_rl = false;
						if(d){
							switch(d.e){
								case 0:
									if(padre_ci == "" || madre_ci == ""){
										toastr.error("Debe colocar primero las cédulas de los padres",{progressBar:true});
									}else{
										if(rl_ci == padre_ci || rl_ci == madre_ci ){
											$('#repre_legal').hide();
											
											idRl = d.representante.repre_id;
											var nameRl = d.representante.repre_nombre;
											var apeRl = d.representante.repre_apellido; 
										
											$('#rl_name').text(nameRl+' '+apeRl);									
										}else{
											$('#repre_legal').show();
											
											idRl = d.representante.repre_id;
											var nameRl = d.representante.repre_nombre;
											var apeRl = d.representante.repre_apellido; 
									
											$('#rl_name').text(nameRl+' '+apeRl);
										}
									}
									break;
								default:
									toastr.error('Error, esa cédula no esta registrada',{progressBar:true});
									break;
							}
						}
					} 
						var add_rl = false, rl_ci = "";
					$('body').on('submit', '#form_rl', function(){
						if(add_rl)
							return false;
						add_rl = true;					
						
						rl_ci = document.form_rl.rl_ci.value;
						var data = {
							filter:"c",
							term:rl_ci
						};
						
						makeAjax('api/repreSingle','GET',data,'json',getRl,true);
						return false;
					});
										
					function addRepre_legal(d){
						add_estudiante = false;
						if(d){
							switch(d.e){
								case 0:
									
									break;
								default:
									toastr.error('Error al registrar el Representante Legal',{progressBar:true});
									break;
							}
						}
					}
					idFamilia = "";
					function addFamilia(d){
						add_estudiante = false;
						if(d){
							switch(d.e){
								case 0:
									if(rl_ci == padre_ci || rl_ci == madre_ci){
									
									}else{
										idFamilia = d.id_familia;
										formData2.append('id_familia',idFamilia);
										makeAjax('api/rl_update','PUT',formData2,'json',addRepre_legal,true);
									
									}	
									break;
								default:
									toastr.error('Error al registrar la familia',{progressBar:true});
									break;
							}
						}
					}
					var idEstudiante;
					function addEstudiante(d){
							add_estudiante = false;
						if(d){
							switch(d.e){
								case 0:
										idEstudiante = d.hijo_id;
										var formData3 = new FormData();
										formData3.append('id_estudiante',idEstudiante);
										formData3.append('id_madre',idMadre);
										formData3.append('id_padre',idPadre);
										formData3.append('id_rl',idRl);
										makeAjax('api/familia','POST',formData3,'json',addFamilia,true);
										$('#btn_registroAlumno_lim').click();
										
										toastr.success('Estudiante Registrado Exitosamente',{progressBar:true});
									break;
								case 1:
									toastr.error('Error al registrar el Estudiante',{progressBar:true});
									break;
								case 2:
									toastr.error('Error, la cédula escolar ya fue asignada a otro estudiante',{progressBar:true});
									break;
							}
						}
					}
						var add_estudiante = false, formData2;
					$('body').on('submit','#form_registro_alumno',function(){
						if(add_estudiante)
							return false;	
						add_estudiante = true;
						
						repre_permiso_cepna = document.form_registro_alumno.repre_permiso_cepna.value;
						repre_pq_otra_persona = document.form_registro_alumno.repre_pq_otra_persona.value;
						repre_parentesco = document.form_registro_alumno.repre_parentesco.value;
						repre_llamar_emergencia = document.form_registro_alumno.repre_llamar_emergencia.value;
						repre_telefono_emergencia = document.form_registro_alumno.repre_telefono_emergencia.value;
						
						hijo_apellido = document.form_registro_alumno.hijo_apellido.value;
						hijo_nombre = document.form_registro_alumno.hijo_nombre.value;
						hijo_nacionalidad = document.form_registro_alumno.hijo_nacionalidad.value;
						hijo_sexo = document.form_registro_alumno.hijo_sexo.value;
						hijo_peso = document.form_registro_alumno.hijo_peso.value;
						hijo_talla = document.form_registro_alumno.hijo_talla.value;
						hijo_cedula_escolar = document.form_registro_alumno.hijo_cedula_escolar.value;
						hijo_direccion = document.form_registro_alumno.hijo_direccion.value;
						hijo_telefono = document.form_registro_alumno.hijo_telefono.value;
						hijo_estado = document.form_registro_alumno.hijo_estado.value;
						hijo_municipio = document.form_registro_alumno.hijo_municipio.value;
						hijo_ciudad = document.form_registro_alumno.hijo_ciudad.value;
						hijo_fechaN = document.form_registro_alumno.hijo_fechaN.value;
						hijo_nivel = document.form_registro_alumno.hijo_nivel.value;
						hijo_status = 1;
						
						
						formData2 = new FormData();
						formData2.append('repre_permiso_cepna',repre_permiso_cepna);
						formData2.append('repre_pq_otra_persona',repre_pq_otra_persona);
						formData2.append('repre_parentesco',repre_parentesco);
						formData2.append('repre_llamar_emergencia',repre_llamar_emergencia);
						formData2.append('repre_telefono_emergencia',repre_telefono_emergencia);
						
						formData = new FormData();
						formData.append('hijo_apellido',hijo_apellido);
						formData.append('hijo_nombre',hijo_nombre);
						formData.append('hijo_nacionalidad',hijo_nacionalidad);
						formData.append('hijo_peso',hijo_peso);
						formData.append('hijo_talla',hijo_talla);
						formData.append('hijo_sexo',hijo_sexo);
						formData.append('hijo_cedula_escolar',hijo_cedula_escolar);
						formData.append('hijo_direccion',hijo_direccion);
						formData.append('hijo_telefono',hijo_telefono);
						formData.append('hijo_estado',hijo_estado);
						formData.append('hijo_municipio',hijo_municipio);
						formData.append('hijo_ciudad',hijo_ciudad);
						formData.append('hijo_fechaN',hijo_fechaN);
						formData.append('hijo_nivel',hijo_nivel);
						formData.append('hijo_status',hijo_status);
						
						makeAjax('api/estudiante','POST',formData,'json',addEstudiante,true);
						return false;
					});
				//Fin Registro Estudiante
	<?php
				break;
				
				//Inicio Registro Salud
			case 'registro_salud':
	?>			
	
					$('#fecha_insc').pickadate({
						format: 'dd-mm-yyyy',
						container : '.container',
						min: [2000,1,1],
						max: new Date(Date.now()),
						selectYears: 99,
						selectMonths: true
					});
					
					
					function addFamilia(d){
							add_salud = false;
						if(d){
							switch(d.e){
								case 0:
									
									break;
								default:
									toastr.error('Error, fallo el registro de la fámilia',{progressBar:true});
									break;
							}
						}
					}
					
					var idFamilia, falta = "";
					function getFamilia(d){
						if(d){
							switch(d.e){
								case 0:
									ide_Salud = d.familia.id_salud;
									if(ide_Salud == 0){
										idFamilia = d.familia.id_familia;
										$('#estudiante_name').text(nameHijo+' '+apehijo);
									}else{
										falta = 1;
										toastr.error('El estudiante ya tiene un registro de salud asignado',{progressBar:true});
									}	
									break;
								default:
									toastr.error('Error, no se encontro la fámilia',{progressBar:true});
									break;
							}
						}	
					}
					
					function addSalud(d){
							add_salud = false;
						if(d){
							switch(d.e){
								case 0:
									if(falta != ""){
										toastr.error('El estudiante ya tiene un registro de salud asignado',{progressBar:true});
									}else{
										var idSalud = d.salud_id;
									
										var formData = new FormData();
										formData.append('id_familia',idFamilia);
										formData.append('id_salud',idSalud);
										
										toastr.success('Registro de Salud guardado exitosamente',{progressBar:true});
										makeAjax('api/familia','PUT',formData,'json',addFamilia,true);
									}
									break;
								default:
									toastr.error('Error, fallo el registro de salud',{progressBar:true});
									break;
							}
						}
					}
					
					var idEstudiante = "", nameHijo = "", apehijo = "";
					function getEstudiante(d){
						add_estudiante = false;
						if(d){
							switch(d.e){
								case 0:
									$('#btn_registroSalud_lim').click();
									idEstudiante = d.estudiante.hijo_id;
									nameHijo = d.estudiante.hijo_nombre;
									apehijo = d.estudiante.hijo_apellido; 
									
									data = {
										filter:"e",
										term:idEstudiante
									}
									makeAjax('api/familiaSingle','GET',data,'json',getFamilia,true);
									break;
								default:
									toastr.error('Error, la cédula no esta registrada',{progressBar:true});
									break;
							}
						}
					}
						var add_estudiante = false;
					$('body').on('submit', '#form_estudiante', function(){
						if(add_estudiante)
							return false;
						add_estudiante = true;
 
						estudiante_ci = document.form_estudiante.ci_escolar.value;
						var data = {
							filter:"c",
							term:estudiante_ci
						};
						makeAjax('api/hijoSingle','GET',data,'json',getEstudiante,true);
						return false;
					});
					
						var add_salud = false;
					$('body').on('submit','#form_registro_salud',function(){
						if(add_salud)
							return false;	
						add_salud = true;
						
						salud_vacunas_antivariolica = document.form_registro_salud.vacunas_antivariolica.checked ? "Si" : "No";
						salud_vacunas_sarampion = document.form_registro_salud.vacunas_sarampion.checked ? "Si" : "No";
						salud_vacunas_polio = document.form_registro_salud.vacunas_polio.checked ? "Si" : "No";
						salud_vacunas_triple = document.form_registro_salud.vacunas_triple.checked ? "Si" : "No";
						salud_vacunas_antitetanica = document.form_registro_salud.vacunas_antitetanica.checked ? "Si" : "No";
						salud_vacunas_neumococo = document.form_registro_salud.vacunas_neumococo.checked ? "Si" : "No";
						salud_vacunas_bcg = document.form_registro_salud.vacunas_bcg.checked ? "Si" : "No";
						
						salud_enfermedad_padece = document.form_registro_salud.enfermedad_padece.value;
						salud_alergico = document.form_registro_salud.alergico.value;
						salud_alergico_aque = document.form_registro_salud.alergico_aque.value;
						salud_impedimento_motor = document.form_registro_salud.impedimento_motor.value;
						
						salud_impedimento_motor_pieplano = document.form_registro_salud.impedimento_motor_pieplano.checked ? "Si" : "No";
						salud_impedimento_motor_columna = document.form_registro_salud.impedimento_motor_columna.checked ? "Si" : "No";
						salud_impedimento_motor_articulaciones = document.form_registro_salud.impedimento_motor_articulaciones.checked ? "Si" : "No";
						
						salud_impedimento_motor_otros = document.form_registro_salud.impedimento_motor_otros.value;
						salud_impedimento_motor_especialista = document.form_registro_salud.impedimento_motor_especialista.value;
						salud_vivienda_tipo = document.form_registro_salud.vivienda_tipo.value;
						salud_n_habitaciones = document.form_registro_salud.n_habitaciones.value;
						salud_vivienda_ubicacion = document.form_registro_salud.vivienda_ubicacion.value;
						salud_vivienda_tenencia = document.form_registro_salud.vivienda_tenencia.value;
						salud_n_hermanos = document.form_registro_salud.n_hermanos.value;
						salud_hermanos_posicion = document.form_registro_salud.hermanos_posicion.value;
						salud_n_personas_vive_nino = document.form_registro_salud.n_personas_vive_nino.value;
						salud_grupo_sanguineo = document.form_registro_salud.grupo_sanguineo.value;
						
						salud_enfermedades_bronquitis = document.form_registro_salud.enfermedades_bronquitis.checked ? "Si" : "No";
						salud_enfermedades_alergias = document.form_registro_salud.enfermedades_alergias.checked ? "Si" : "No";
						salud_enfermedades_hepatitis = document.form_registro_salud.enfermedades_hepatitis.checked ? "Si" : "No";
						salud_enfermedades_resfriados = document.form_registro_salud.enfermedades_resfriados.checked ? "Si" : "No";
						salud_enfermedades_paperas = document.form_registro_salud.enfermedades_paperas.checked ? "Si" : "No";
						salud_enfermedades_intoxicacion = document.form_registro_salud.enfermedades_intoxicacion.checked ? "Si" : "No";
						salud_enfermedades_asma = document.form_registro_salud.enfermedades_asma.checked ? "Si" : "No";
						salud_enfermedades_varicela = document.form_registro_salud.enfermedades_varicela.checked ? "Si" : "No";
						salud_enfermedades_ninguna = document.form_registro_salud.enfermedades_ninguna.checked ? "Si" : "No";
						
						salud_enfermedades_otras = document.form_registro_salud.enfermedades_otras.value;
						salud_embarazo_deseado = document.form_registro_salud.embarazo_deseado.value;
						salud_embarazo_controlado = document.form_registro_salud.embarazo_controlado.value;
						salud_embarazo_enfermedad = document.form_registro_salud.embarazo_enfermedad.value;
						salud_parto = document.form_registro_salud.parto.value;
						salud_parto_problema = document.form_registro_salud.parto_problema.value;
						salud_peso_nacer = document.form_registro_salud.peso_nacer.value;
						salud_talla_nacer = document.form_registro_salud.talla_nacer.value;
						salud_lactancia = document.form_registro_salud.lactancia.value;
						salud_lactancia_tiempo = document.form_registro_salud.lactancia_tiempo.value;
						salud_alimento_alergico = document.form_registro_salud.alimento_alergico.value;
						salud_alimento_cual = document.form_registro_salud.alimento_cual.value;
						salud_chupa_dedo = document.form_registro_salud.chupa_dedo.value;
						salud_dormir_bien = document.form_registro_salud.dormir_bien.value;
						salud_dormir_luz = document.form_registro_salud.dormir_luz.value;
						salud_dormir_juguete = document.form_registro_salud.dormir_juguete.value;
						salud_bana_solo_ayuda = document.form_registro_salud.bana_solo_ayuda.value;
						salud_convulsionado = document.form_registro_salud.convulsionado.value;
						salud_accidente = document.form_registro_salud.accidente.value;
						salud_camina_bien = document.form_registro_salud.camina_bien.value;
						salud_psicologo = document.form_registro_salud.psicologo.value;
						salud_psicologo_porque = document.form_registro_salud.psicologo_porque.value;
						salud_neurologo = document.form_registro_salud.neurologo.value;
						salud_neurologo_porque = document.form_registro_salud.neurologo_porque.value;
						salud_medicado = document.form_registro_salud.medicado.value;
						salud_tratamiento_prolongado = document.form_registro_salud.tratamiento_prolongado.value;
						salud_escucha_bien = document.form_registro_salud.escucha_bien.value;
						salud_intoxicado = document.form_registro_salud.intoxicado.value;
						salud_intoxicado_conque = document.form_registro_salud.intoxicado_conque.value;
						salud_ayuda_bano = document.form_registro_salud.ayuda_bano.value;
						salud_operado = document.form_registro_salud.operado.value;
						salud_operado_deque = document.form_registro_salud.operado_deque.value;
						salud_medicamento_alergico = document.form_registro_salud.medicamento_alergico.value;
						salud_medicamento_cual = document.form_registro_salud.medicamento_cual.value;
						salud_ve_bien = document.form_registro_salud.ve_bien.value;
						salud_anteojos = document.form_registro_salud.anteojos.value;
						salud_juegos_gustan = document.form_registro_salud.juegos_gustan.value;
						salud_juegos_con_quien = document.form_registro_salud.juegos_con_quien.value;
						salud_juegos_actitud = document.form_registro_salud.juegos_actitud.value;
						salud_miedos = document.form_registro_salud.miedos.value;
						salud_miedos_causa = document.form_registro_salud.miedos_causa.value;
						salud_pediatra_nombre = document.form_registro_salud.pediatra_nombre.value;
						salud_actividad_complementaria = document.form_registro_salud.actividad_complementaria.value;
						salud_actividad_cual = document.form_registro_salud.actividad_cual.value;
						salud_mascota = document.form_registro_salud.mascota.value;
						salud_mascota_cual = document.form_registro_salud.mascota_cual.value;
						salud_actitud_travesuras_padre = document.form_registro_salud.actitud_travesuras_padre.value;
						salud_actitud_travesuras_madre = document.form_registro_salud.actitud_travesuras_madre.value;
						salud_musica = document.form_registro_salud.musica.value;
						
						salud_musica_infantil = document.form_registro_salud.musica_infantil.checked ? "Si" : "No";
						salud_musica_reggaeton = document.form_registro_salud.musica_reggaeton.checked ? "Si" : "No";
						
						salud_musica_otra = document.form_registro_salud.musica_otra.value;
						salud_tv = document.form_registro_salud.tv.value;
						salud_programas = document.form_registro_salud.programas.value;
						salud_horas_diarias = document.form_registro_salud.horas_diarias.value;
						salud_religion_familia = document.form_registro_salud.religion_familia.value;
						salud_relaciona_otros_ninos = document.form_registro_salud.relaciona_otros_ninos.value;
						salud_busca_nino_grandes = document.form_registro_salud.busca_nino_grandes.value;
						salud_molesta_nino_haga = document.form_registro_salud.molesta_nino_haga.value;
						salud_reprende = document.form_registro_salud.reprende.value;
						salud_manera_reprender = document.form_registro_salud.manera_reprender.value;
						salud_comunica_que_siente = document.form_registro_salud.comunica_que_siente.value;
						salud_conversa_familia = document.form_registro_salud.conversa_familia.value;
						salud_tema_conversa = document.form_registro_salud.tema_conversa.value;
						salud_tiempo_solo = document.form_registro_salud.tiempo_solo.value;
						salud_cuando_nino_solo = document.form_registro_salud.cuando_nino_solo.value;
						
						salud_queda_nino_padre = document.form_registro_salud.queda_nino_padre.checked ? "Si" : "No";
						salud_queda_nino_madre = document.form_registro_salud.queda_nino_madre.checked ? "Si" : "No";
						
						salud_queda_nino_hermano = document.form_registro_salud.queda_nino_hermano.value;
						salud_queda_nino_familiar = document.form_registro_salud.queda_nino_familiar.value;
						salud_queda_nino_empleada = document.form_registro_salud.queda_nino_empleada.value;
						salud_queda_nino_otro = document.form_registro_salud.queda_nino_otro.value;
						salud_primera_vez_preescolar = document.form_registro_salud.primera_vez_preescolar.value;
						salud_asistio_maternal = document.form_registro_salud.asistio_maternal.value;
						salud_nombre_maternal = document.form_registro_salud.nombre_maternal.value;
						salud_primera_vez_maternal = document.form_registro_salud.primera_vez_maternal.value;
						salud_motivo_eleccion = document.form_registro_salud.motivo_eleccion.value;
						salud_espera_de_teresa = document.form_registro_salud.espera_de_teresa.value;
						salud_perso_autori_reti_ninho_apell = document.form_registro_salud.perso_autori_reti_ninho_apell.value;
						salud_perso_autori_reti_ninho_name = document.form_registro_salud.perso_autori_reti_ninho_name.value;
						salud_perso_autori_reti_ninho_ci = document.form_registro_salud.perso_autori_reti_ninho_ci.value;
						salud_perso_autori_reti_ninho_parent = document.form_registro_salud.perso_autori_reti_ninho_parent.value;
						salud_fecha_insc = document.form_registro_salud.fecha_insc.value;
						
						var formData = new FormData();
						formData.append('salud_vacunas_antivariolica',salud_vacunas_antivariolica);
						formData.append('salud_vacunas_sarampion',salud_vacunas_sarampion);
						formData.append('salud_vacunas_polio',salud_vacunas_polio);
						formData.append('salud_vacunas_triple',salud_vacunas_triple);
						formData.append('salud_vacunas_bcg',salud_vacunas_bcg);
						formData.append('salud_vacunas_antitetanica',salud_vacunas_antitetanica);
						formData.append('salud_vacunas_neumococo',salud_vacunas_neumococo);
						formData.append('salud_enfermedad_padece',salud_enfermedad_padece);
						formData.append('salud_alergico',salud_alergico);
						formData.append('salud_alergico_aque',salud_alergico_aque);
						formData.append('salud_impedimento_motor',salud_impedimento_motor);
						formData.append('salud_impedimento_motor_pieplano',salud_impedimento_motor_pieplano);
						formData.append('salud_impedimento_motor_columna',salud_impedimento_motor_columna);
						formData.append('salud_impedimento_motor_articulaciones',salud_impedimento_motor_articulaciones);
						formData.append('salud_impedimento_motor_otros',salud_impedimento_motor_otros);
						formData.append('salud_impedimento_motor_especialista',salud_impedimento_motor_especialista);
						formData.append('salud_vivienda_tipo',salud_vivienda_tipo);
						formData.append('salud_n_habitaciones',salud_n_habitaciones);
						formData.append('salud_vivienda_ubicacion',salud_vivienda_ubicacion);
						formData.append('salud_vivienda_tenencia',salud_vivienda_tenencia);
						formData.append('salud_n_hermanos',salud_n_hermanos);
						formData.append('salud_hermanos_posicion',salud_hermanos_posicion);
						formData.append('salud_n_personas_vive_nino',salud_n_personas_vive_nino);
						formData.append('salud_grupo_sanguineo',salud_grupo_sanguineo);
						formData.append('salud_enfermedades_bronquitis',salud_enfermedades_bronquitis);
						formData.append('salud_enfermedades_alergias',salud_enfermedades_alergias);
						formData.append('salud_enfermedades_hepatitis',salud_enfermedades_hepatitis);
						formData.append('salud_enfermedades_resfriados',salud_enfermedades_resfriados);
						formData.append('salud_enfermedades_paperas',salud_enfermedades_paperas);
						formData.append('salud_enfermedades_intoxicacion',salud_enfermedades_intoxicacion);
						formData.append('salud_enfermedades_asma',salud_enfermedades_asma);
						formData.append('salud_enfermedades_varicela',salud_enfermedades_varicela);
						formData.append('salud_enfermedades_ninguna',salud_enfermedades_ninguna);
						formData.append('salud_enfermedades_otras',salud_enfermedades_otras);
						formData.append('salud_embarazo_deseado',salud_embarazo_deseado);
						formData.append('salud_embarazo_controlado',salud_embarazo_controlado);
						formData.append('salud_embarazo_enfermedad',salud_embarazo_enfermedad);
						formData.append('salud_parto',salud_parto);
						formData.append('salud_parto_problema',salud_parto_problema);
						formData.append('salud_peso_nacer',salud_peso_nacer);
						formData.append('salud_talla_nacer',salud_talla_nacer);
						formData.append('salud_lactancia',salud_lactancia);
						formData.append('salud_lactancia_tiempo',salud_lactancia_tiempo);
						formData.append('salud_alimento_alergico',salud_alimento_alergico);
						formData.append('salud_alimento_cual',salud_alimento_cual);
						formData.append('salud_chupa_dedo',salud_chupa_dedo);
						formData.append('salud_dormir_bien',salud_dormir_bien);
						formData.append('salud_dormir_luz',salud_dormir_luz);
						formData.append('salud_dormir_juguete',salud_dormir_juguete);
						formData.append('salud_bana_solo_ayuda',salud_bana_solo_ayuda);
						formData.append('salud_convulsionado',salud_convulsionado);
						formData.append('salud_accidente',salud_accidente);
						formData.append('salud_camina_bien',salud_camina_bien);
						formData.append('salud_psicologo',salud_psicologo);
						formData.append('salud_psicologo_porque',salud_psicologo_porque);
						formData.append('salud_neurologo',salud_neurologo);
						formData.append('salud_neurologo_porque',salud_neurologo_porque);
						formData.append('salud_medicado',salud_medicado);
						formData.append('salud_tratamiento_prolongado',salud_tratamiento_prolongado);
						formData.append('salud_escucha_bien',salud_escucha_bien);
						formData.append('salud_intoxicado',salud_intoxicado);
						formData.append('salud_intoxicado_conque',salud_intoxicado_conque);
						formData.append('salud_ayuda_bano',salud_ayuda_bano);
						formData.append('salud_operado',salud_operado);
						formData.append('salud_operado_deque',salud_operado_deque);
						formData.append('salud_medicamento_alergico',salud_medicamento_alergico);
						formData.append('salud_medicamento_cual',salud_medicamento_cual);
						formData.append('salud_ve_bien',salud_ve_bien);
						formData.append('salud_anteojos',salud_anteojos);
						formData.append('salud_juegos_gustan',salud_juegos_gustan);
						formData.append('salud_juegos_con_quien',salud_juegos_con_quien);
						formData.append('salud_juegos_actitud',salud_juegos_actitud);
						formData.append('salud_miedos',salud_miedos);
						formData.append('salud_miedos_causa',salud_miedos_causa);
						formData.append('salud_pediatra_nombre',salud_pediatra_nombre);
						formData.append('salud_actividad_complementaria',salud_actividad_complementaria);
						formData.append('salud_actividad_cual',salud_actividad_cual);
						formData.append('salud_mascota',salud_mascota);
						formData.append('salud_mascota_cual',salud_mascota_cual);
						formData.append('salud_actitud_travesuras_padre',salud_actitud_travesuras_padre);
						formData.append('salud_actitud_travesuras_madre',salud_actitud_travesuras_madre);
						formData.append('salud_musica',salud_musica);
						formData.append('salud_musica_infantil',salud_musica_infantil);
						formData.append('salud_musica_reggaeton',salud_musica_reggaeton);
						formData.append('salud_musica_otra',salud_musica_otra);
						formData.append('salud_tv',salud_tv);
						formData.append('salud_programas',salud_programas);
						formData.append('salud_horas_diarias',salud_horas_diarias);
						formData.append('salud_religion_familia',salud_religion_familia);
						formData.append('salud_relaciona_otros_ninos',salud_relaciona_otros_ninos);
						formData.append('salud_busca_nino_grandes',salud_busca_nino_grandes);
						formData.append('salud_molesta_nino_haga',salud_molesta_nino_haga);
						formData.append('salud_reprende',salud_reprende);
						formData.append('salud_manera_reprender',salud_manera_reprender);
						formData.append('salud_comunica_que_siente',salud_comunica_que_siente);
						formData.append('salud_conversa_familia',salud_conversa_familia);
						formData.append('salud_tema_conversa',salud_tema_conversa);
						formData.append('salud_tiempo_solo',salud_tiempo_solo);
						formData.append('salud_cuando_nino_solo',salud_cuando_nino_solo);
						formData.append('salud_queda_nino_padre',salud_queda_nino_padre);
						formData.append('salud_queda_nino_madre',salud_queda_nino_madre);
						formData.append('salud_queda_nino_hermano',salud_queda_nino_hermano);
						formData.append('salud_queda_nino_familiar',salud_queda_nino_familiar);
						formData.append('salud_queda_nino_empleada',salud_queda_nino_empleada);
						formData.append('salud_queda_nino_otro',salud_queda_nino_otro);
						formData.append('salud_primera_vez_preescolar',salud_primera_vez_preescolar);
						formData.append('salud_asistio_maternal',salud_asistio_maternal);
						formData.append('salud_nombre_maternal',salud_nombre_maternal);
						formData.append('salud_primera_vez_maternal',salud_primera_vez_maternal);
						formData.append('salud_motivo_eleccion',salud_motivo_eleccion);
						formData.append('salud_espera_de_teresa',salud_espera_de_teresa);
						formData.append('salud_perso_autori_reti_ninho_apell',salud_perso_autori_reti_ninho_apell);
						formData.append('salud_perso_autori_reti_ninho_name',salud_perso_autori_reti_ninho_name);
						formData.append('salud_perso_autori_reti_ninho_ci',salud_perso_autori_reti_ninho_ci);
						formData.append('salud_perso_autori_reti_ninho_parent',salud_perso_autori_reti_ninho_parent);
						formData.append('salud_fecha_insc',salud_fecha_insc);
						
						makeAjax('api/salud','POST',formData,'json',addSalud,true);				
						return false;
					});	
					
					//FIN Registro Salud
	<?php
				break;
				
				
			case 'reportes':	
	?>			
		//Inicio reporte
	
			//Inicio Inscripcion
			
			var idFamilia = "";
			function getFamilia(d){  
				if(d){
					switch(d.e){
						case 0: 
							idFamilia = d.familia.id_familia;
							var win = window.open('http://teresadelaparra.prestados.xyz/pdf/?id='+idFamilia, '_blank');
							win.focus();
							break;
						default:
							toastr.error('Error, no se encontro la fámilia',{progressBar:true});
							break;
					}
				}	
			}
			
				var idEstudiante = "";
			function getEstudiante(d){
				get_estudiante = false;
				if(d){
					switch(d.e){
						case 0:
							idEstudiante = d.estudiante.hijo_id;
							data = {
								filter:"e",
								term:idEstudiante
							}
							makeAjax('api/familiaSingle','GET',data,'json',getFamilia,true);
						
							break;
						default:
							toastr.error('Error, la cédula no esta registrada',{progressBar:true});
							break;
					}
				}
			}
			
				var get_estudiante = false;
			$('body').on('submit','#form_inscripcion',function(){
				if(get_estudiante)
					return false;
				get_estudiante = true;
				 
				ci_escolar = document.form_inscripcion.ci_escolar.value;
				var data={
					filter:"c",
					term:ci_escolar  
				};
				makeAjax('api/hijoSingle','GET',data,'json',getEstudiante,true);
				return false;
			});
			//Fin Inscripcion
			
			//constancias
				
					var get_estudiante = false;
				$('body').on('click','#btn_pdf_const',function(){
					 
					tipo_const = document.form_constancias.tipo_const.value;
					
					if(tipo_const == 1){
						var inscripcion =  window.open('http://teresadelaparra.prestados.xyz/pdf/constancia_inscripcion.odt');
						inscripcion.focus();
					}else if(tipo_const == 2){
						var estudio = window.open('http://teresadelaparra.prestados.xyz/pdf/constancia_estudio.odt'); 
						estudio.focus();
					}
				});
					
			
		//Fin reporte
	<?php	
			break;
				
			}
		}else{
	?>
		var log=false;
		
		
		function loginCallback(d){
			$('#closeLoginModal').click();
			log=false;
			if(d){
				switch(d.e){
					case 0:
						toastr.success('Bienvenido!', {progressBar:true});
						window.location.href = '/inicio'; 
						break;
					case 1:
						toastr.error('Usuario incorrecto', {progressBar:true});
						break;
					case 2:
						toastr.error('Contraseña incorrecta', {progressBar:true});
						break;
				}
			}
		}
		
		$("body").on("submit","#login_form",function(){
			if(log)
				return false;
			log=true;
			
			var formData = new FormData();
			formData.append('name',document.login_form.name.value);
			formData.append('password',document.login_form.password.value);
			
			makeAjax("api/login","POST",formData,"json",loginCallback,true);
			return false;
		});
		
		
		function mensaje(d){
			addmensaje = false;
			if(d){
				switch(d.e){
					case 0:
						toastr.success('Su mensaje se envio exitosamente',{progressBar:true});
						break;
					case 1:
						toastr.error('¡Error!, no se pudo enviar su mensaje',{progressBar:true});
						break;
				}
			}
		}
			var addmensaje = false;
		$('body').on('submit','#form_contacto',function(){
			if(addmensaje)
				return false;
			addmensaje = true;
			
			nombre_contacto = document.form_contacto.nombre_contacto.value;
			email_contacto = document.form_contacto.email_contacto.value;
			asunto_contacto = document.form_contacto.asunto_contacto.value;
			mensaje_contacto = document.form_contacto.mensaje_contacto.value;
			
			var formData = new FormData();
			formData.append('nombre_contacto',nombre_contacto);
			formData.append('email_contacto',email_contacto);
			formData.append('asunto_contacto',asunto_contacto);
			formData.append('mensaje_contacto',mensaje_contacto);
			
			makeAjax('api/contacto','POST',formData,'json',mensaje,true);
			return false;
		});
	<?php
		}
	?>

});

/*
				function addEmp(d,r){
					if(d){
						switch(d.e){
							case 0:
								r.id = d.id;
								if(edit_emp){
									toastr.success('Empleado Editado exitosamente',{progressBar:true});
									$('.list_emp_li_'+d.id).replaceWith(makeEmp(r));
									$('#btn_editEmp_lim').click();	
									$('#btn_editEmp_can').click();
									edit_emp = false;	
								}else{
									toastr.success('Empleado Agregado exitosamente',{progressBar:true});
									$('#btn_lim_emp').click();
									$('#list_emp').append(makeEmp(r));									
								}				
								break;
							default:
								if(edit_emp){
									toastr('Error, no se pudo Editar el empleado',{progressBar:true});
									$('#btn_editEmp_lim').click();	
									$('#btn_editEmp_can').click();	
								}else{
									toastr('Error, no se pudo Agregar el empleado',{progressBar:true});
								}
								
								break;
						}
					}
				}
				
				$('body').on('click','#modal_email_can', function(){
				email_edit=false;
				('#form_email')[0].reset();
				$('#titulo_correo').text('Agregar E-mail');
				})
							
				$('body').on('reset','#form_email', function(){	
				email_edit=false;
				$('#form_email')[0].reset();
				$('#titulo_correo').text('Agregar E-mail');
				});
							
				$('body').on('click','#btn_modal_email_cli', function(){
				email_edit=false;
				$('#form_email')[0].reset();
				$('#titulo_correo').text('Agregar E-mail');
				});

						
				var add_emp = false;
				$('body').on('submit','#alta_emp',function(){
					if(add_emp)
						return false;
					add_emp = true;
					
					name_emp = document.alta_emp.name_emp.value;
					ape_emp = document.alta_emp.ape_emp.value;
					nombre_emp = name_emp +" "+ape_emp; 
					user_emp = document.alta_emp.user_emp.value;	 
					pass_emp = document.alta_emp.pass_emp.value;
					fun_emp = document.alta_emp.fun_emp.value;	
					
					var formData = new FormData();
					formData.append('nombre',nombre_emp);
					formData.append('user',user_emp);
					formData.append('password',pass_emp);
					formData.append('tipo',fun_emp);
					
					var r = {
						nombre:nombre_emp,
						user:user_emp,
						password:pass_emp,
						tipo:fun_emp,
						lastOnline:"nunca"
					}
					makeAjax('api/empleados','POST',formData,'json',addEmp,true,r);	
				
					return false;
				});
						
				function makeEmp(d){		
					
						var item=[],i=0, funcion = '';	
						var t = parseInt(d.tipo);
						switch(t){ 
								case 1:
									funcion = 'Administrador';
									break;
								case 2:
									funcion = 'Caja';
									break;
								case 3:
									funcion = 'Barra';
									break;
								case 4:
									funcion = 'Operador';
									break;	
							}
							
						item[i++]='<tr class="list_emp_li_'+d.id+'" id="'+d.id+'" time="'+d.lastOnline+'" name="'+d.nombre+'" user="'+d.user+'" tipo="'+d.tipo+'">';
						item[i++]='<td class="celda">'+d.id+'</td>';
						item[i++]='<td class="celda">'+d.nombre+'</td>';
						item[i++]='<td class="celda">'+d.user+'</td>';
						item[i++]='<td class="celda">'+funcion+'</td>'; 
						item[i++]='<td class="celda">'+d.lastOnline+'</td>';
						item[i++]='<td class="celda"><a href="#modal_editEmp" data-toggle="modal"><span class="edit_emp edit glyphicon glyphicon-pencil"></span></a></td>';
						item[i++]='<td class="celda"><a href="#modal_removeEmp" data-toggle="modal"><span class="remove_emp remove glyphicon glyphicon-remove"></span></a></td>';
						item[i++]='</tr>'; 
						return item.join("");
				}
				
				function getEmp(d){
					if(d){
						switch(d.e){
							case 0:
								var l = d.users.length,
								item,
								items=[],
								i=0;
								for(;i<l;i++){
									item = d.users[i];
									items[i] = makeEmp(item);
								}
								$('#list_emp').html(items.join(""));
								break;
							case 1:
								toastr.error("No hay empleados",{progressBar:true});
								break;
						}
					}
				}
				
				function get_emp(){
					var data = {
						start:0,
						max:9999
					};
					makeAjax("api/empleados","GET",data,"json",getEmp,true);
				}
				get_emp();
				
				var edit_emp = false;
				
				$('body').on('submit','#form_edit_emp',function(){
						
					modal_name_emp = document.form_edit_emp.modal_name_emp.value;
					modal_ape_emp = document.form_edit_emp.modal_ape_emp.value;
					modal_nombre_emp = modal_name_emp +" "+modal_ape_emp; 
					modal_user_emp = document.form_edit_emp.modal_user_emp.value;	 
					modal_pass_emp = document.form_edit_emp.modal_pass_emp.value;
					modal_fun_emp = document.form_edit_emp.modal_fun_emp.value;	
					
					var formData = new FormData();
					formData.append('nombre',modal_nombre_emp);
					formData.append('user',modal_user_emp);
					formData.append('password',modal_pass_emp);
					formData.append('tipo',modal_fun_emp);
					
					var r={
						nombre:modal_nombre_emp,
						user:modal_user_emp,
						tipo:modal_fun_emp,
						lastOnline:oldtime
					};
					
					formData.append('id',edit_emp);
					makeAjax('api/empleados','PUT',formData,'json',addEmp,true,r);
					return false;
				});
				var oldTime;
				$('body').on('click','.edit_emp',function(){
					edit_emp = $(this).parents('tr').attr('id');
					oldtime = $(this).parents('tr').attr('time');
					
					
					var nombre="", nombre2="", name="", apellido="", funcion=""; 
					nombre = $(this).parents('tr').attr('name');
					nombre2 = nombre.split(" ");
					
					name = nombre2[0];
					apellido = nombre2[1];	
					
					$('#modal_name_emp').val(name);
					$('#modal_ape_emp').val(apellido);
					document.form_edit_emp.modal_fun_emp.value = $(this).parents('tr').attr('tipo');
					$('#modal_user_emp').val($(this).parents('tr').attr('user'));
				});
				
				function remove_emp(d){
					if(d){
						switch(d.e){
							case 0:
								$('.list_emp_li_'+d.id).remove();
								$('#btn_removeEmp_no').click();
								toastr.success('Empleado eliminado exitosamente',{progressBar:true});
								break;
							case 1:
								toastr.error('Error, no se pudo eliminar el empleado',{progressBar:true});
								break;
						}
					}
				}
	
				var delete_emp = false;
				$('body').on('click','.remove_emp',function(){
					delete_emp = $(this).parents('tr').attr('id');
				});
				
				$('body').on('submit','#form_remove_emp',function(){
					var formData = new FormData();
					formData.append('id',delete_emp);
					makeAjax('api/empleados','DELETE',formData,'json',remove_emp,true);
					return false;
				});*/