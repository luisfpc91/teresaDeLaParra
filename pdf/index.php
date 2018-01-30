<?php
	require_once("../LEANGA/autoload.php");
	
	use LEANGA\Handler_Database;
	use LEANGA\Handler_User;
	use LEANGA\Handler_Session;
	use LEANGA\Handler_SQLBuilder;
    use LEANGA\Handler_PDF;
    use LEANGA\Handler_Familia;
    use LEANGA\Handler_Estudiante;
    use LEANGA\Handler_Representante;
    use LEANGA\Handler_Salud;
 
    if(true){
        $id = $_GET['id'];
        if(is_numeric($id)){
			session_start();
            $hdb = Handler_Database::getInstance();
            $hs = new Handler_Session();
            $user = $hs->returnUser();
           
		   if($user->isLogged()){
                
                $where = array(
                    Handler_SQLBuilder::OPERATOR_EQUAL => Array(
                        Handler_SQLBuilder::TABLE_FAMILIA_ID_FAMILIA => $id
                    )
                );
                
                $query = new Handler_SQLBuilder($hdb);
                $query->select(Handler_SQLBuilder::TABLE_FAMILIA);
                $query->where($where);
                if($familia = $hdb->selectTable($query)){
                    $familia = $familia->fetch(PDO::FETCH_ASSOC);
                    
                    $familia_estudiante = $familia['id_estudiante'];
                    $familia_madre = $familia['id_madre'];
                    $familia_padre = $familia['id_padre'];
                    $familia_rl = $familia['id_rl'];
                    $familia_salud = $familia['id_salud'];
					$rl_permiso_cepna = $familia['repre_permiso_cepna'];
					$rl_pq_otra_persona = $familia['repre_pq_otra_persona'];
					$rl_parentesco = $familia['repre_parentesco'];
					$rl_llamar_emergencia = $familia['repre_llamar_emergencia'];
					$rl_telefono_emergencia = $familia['repre_telefono_emergencia'];
					
                    $where = array(
                        Handler_SQLBuilder::OPERATOR_EQUAL => Array(
                            Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_ID => $familia_estudiante
                        )
                    );
					
					$query = new Handler_SQLBuilder($hdb);
                    $query->select(Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE);
                    $query->where($where);
				   //hijo
					if($hijo = $hdb->selectTable($query)){
						$hijo = $hijo->fetch(PDO::FETCH_ASSOC);
                        $hijo_apellido = $hijo['hijo_apellido'];
                        $hijo_nombre = $hijo['hijo_nombre'];
                        $hijo_cedula_escolar = $hijo['hijo_cedula_escolar'];
                        $hijo_estado = $hijo['hijo_estado'];
                        $hijo_municipio = $hijo['hijo_municipio'];
                        $hijo_ciudad = $hijo['hijo_ciudad'];
                        $hijo_nacionalidad = $hijo['hijo_nacionalidad'];
                        $hijo_sexo = $hijo['hijo_sexo'];
                        $hijo_peso = $hijo['hijo_peso'];
                        $hijo_talla = $hijo['hijo_talla'];
                        $hijo_direccion = $hijo['hijo_direccion'];
                        $hijo_telefono = $hijo['hijo_telefono'];
                        $hijo_nivel = $hijo['hijo_nivel'];
                    }else{
                        $hijo_apellido = "no encontrado";
                        $hijo_nombre = "no encontrado";
                        $hijo_cedula_escolar = "no encontrado";
                        $hijo_estado = "no encontrado";
                        $hijo_municipio = "no encontrado";
                        $hijo_ciudad = "no encontrado";
						$hijo_fechaN = "no encontrado";
                        $hijo_nacionalidad = "no encontrado";
                        $hijo_sexo = "no encontrado";
                        $hijo_peso = "no encontrado";
                        $hijo_talla = "no encontrado";
                        $hijo_direccion = "no encontrado";
                        $hijo_telefono = "no encontrado";
                        $hijo_nivel = "no encontrado";
                    }
					$hijo_fechaN = $hijo['hijo_dia']."-".$hijo['hijo_mes']."-".$hijo['hijo_anho'];
					
					$hijo_timestamp = strtotime($hijo_fechaN);
					$hijo_ya = time();
					$hijo_diferencia = $hijo_ya - $hijo_timestamp;
					$hijo_edad = round($hijo_diferencia/31536000);
					
					$where = array(
                        Handler_SQLBuilder::OPERATOR_EQUAL => Array(
                            Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ID =>   $familia_madre
                        )
                    );
					
					$query = new Handler_SQLBuilder($hdb);
                    $query->select(Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES);
                    $query->where($where);
					//Madre
					  if($madre = $hdb->selectTable($query)){
						$madre = $madre->fetch(PDO::FETCH_ASSOC);
						$madre_ci = $madre['repre_ci'];
                        $madre_apellido = $madre['repre_apellido'];
                        $madre_nombre = $madre['repre_nombre'];
                        $madre_nacionalidad = $madre['repre_nacionalidad'];
                        $madre_estado = $madre['repre_estado'];
                        $madre_municipio = $madre['repre_municipio'];
                        $madre_ciudad = $madre['repre_ciudad'];
                        $madre_fechaN = $madre['repre_fechaN'];
                        $madre_estado_civil = $madre['repre_estado_civil'];
                        $madre_direccion = $madre['repre_direccion'];
                        $madre_telefono_casa = $madre['repre_telefono_casa'];
                        $madre_celular = $madre['repre_celular'];
                        $madre_viveCon_hijo = $madre['repre_viveCon_hijo'];
                        $madre_nivel_educacion = $madre['repre_nivel_educacion'];
                        $madre_titulo = $madre['repre_titulo'];
						$madre_trabajo = $madre['repre_trabajo'];
                        $madre_direccion_trabajo = $madre['repre_direccion_trabajo'];
                        $madre_telefono_trabajo = $madre['repre_telefono_trabajo'];
                        $madre_ingreso_mensual = $madre['repre_ingreso_mensual'];
                    }else{
                        $madre_ci = "no encontrado";
                        $madre_apellido = "no encontrado";
                        $madre_nombre = "no encontrado";
                        $madre_nacionalidad = "no encontrado";
                        $madre_estado = "no encontrado";
                        $madre_municipio = "no encontrado";
                        $madre_ciudad = "no encontrado";
                        $madre_fechaN = "no encontrado";
                        $madre_estado_civil = "no encontrado";
                        $madre_direccion = "no encontrado";
                        $madre_telefono_casa = "no encontrado";
                        $madre_celular = "no encontrado";
                        $madre_viveCon_hijo = "no encontrado";
                        $madre_nivel_educacion = "no encontrado";
                        $madre_titulo = "no encontrado";
						$madre_trabajo = "no encontrado";
                        $madre_direccion_trabajo = "no encontrado";
                        $madre_telefono_trabajo = "no encontrado";
                        $madre_ingreso_mensual = "no encontrado";
                    }
					$madre_timestamp = strtotime($madre_fechaN);
					$madre_ya = time();
					$madre_diferencia = $madre_ya - $madre_timestamp;
					$madre_edad = round($madre_diferencia/31536000);
					
					$where = array(
                        Handler_SQLBuilder::OPERATOR_EQUAL => Array(
                            Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ID =>  $familia_padre
                        )
                    );
					
					$query = new Handler_SQLBuilder($hdb);
                    $query->select(Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES);
                    $query->where($where);
					//Padre
					 if($padre = $hdb->selectTable($query)){
						$padre = $padre->fetch(PDO::FETCH_ASSOC);
						$padre_ci = $padre['repre_ci'];
                        $padre_apellido = $padre['repre_apellido'];
                        $padre_nombre = $padre['repre_nombre'];
                        $padre_nacionalidad = $padre['repre_nacionalidad'];
                        $padre_estado = $padre['repre_estado'];
                        $padre_municipio = $padre['repre_municipio'];
                        $padre_ciudad = $padre['repre_ciudad'];
                        $padre_fechaN = $padre['repre_fechaN'];
                        $padre_estado_civil = $padre['repre_estado_civil'];
                        $padre_direccion = $padre['repre_direccion'];
                        $padre_telefono_casa = $padre['repre_telefono_casa'];
                        $padre_celular = $padre['repre_celular'];
                        $padre_viveCon_hijo = $padre['repre_viveCon_hijo'];
                        $padre_nivel_educacion = $padre['repre_nivel_educacion'];
                        $padre_titulo = $padre['repre_titulo'];
						$padre_trabajo = $padre['repre_trabajo'];
                        $padre_direccion_trabajo = $padre['repre_direccion_trabajo'];
                        $padre_telefono_trabajo = $padre['repre_telefono_trabajo'];
                        $padre_ingreso_mensual = $padre['repre_ingreso_mensual'];
                    }else{
                        $padre_ci = "no encontrado";
                        $padre_apellido = "no encontrado";
                        $padre_nombre = "no encontrado";
                        $padre_nacionalidad = "no encontrado";
                        $padre_estado = "no encontrado";
                        $padre_municipio = "no encontrado";
                        $padre_ciudad = "no encontrado";
                        $padre_fechaN = "no encontrado";
                        $padre_estado_civil = "no encontrado";
                        $padre_direccion = "no encontrado";
                        $padre_telefono_casa = "no encontrado";
                        $padre_celular = "no encontrado";
                        $padre_viveCon_hijo = "no encontrado";
                        $padre_nivel_educacion = "no encontrado";
                        $padre_titulo = "no encontrado";
						$padre_trabajo = "no encontrado";
                        $padre_direccion_trabajo = "no encontrado";
                        $padre_telefono_trabajo = "no encontrado";
                        $padre_ingreso_mensual = "no encontrado";
                    }
					$padre_timestamp = strtotime($padre_fechaN);
					$padre_ya = time();
					$padre_diferencia = $padre_ya - $padre_timestamp;
					$padre_edad = round($padre_diferencia/31536000);
					
					
					$where = array(
                        Handler_SQLBuilder::OPERATOR_EQUAL => Array(
                            Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ID =>  $familia_rl
                        )
                    );
					
					$query = new Handler_SQLBuilder($hdb);
                    $query->select(Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES);
                    $query->where($where);
					//RL
					 if($rl = $hdb->selectTable($query)){
						$rl = $rl->fetch(PDO::FETCH_ASSOC);
						$rl_ci = $rl['repre_ci'];
                        $rl_apellido = $rl['repre_apellido'];
                        $rl_nombre = $rl['repre_nombre'];
                        $rl_nacionalidad = $rl['repre_nacionalidad'];
                        $rl_estado = $rl['repre_estado'];
                        $rl_municipio = $rl['repre_municipio'];
                        $rl_ciudad = $rl['repre_ciudad'];
                        $rl_fechaN = $rl['repre_fechaN'];
                        $rl_estado_civil = $rl['repre_estado_civil'];
                        $rl_direccion = $rl['repre_direccion'];
                        $rl_telefono_casa = $rl['repre_telefono_casa'];
                        $rl_celular = $rl['repre_celular'];
                        $rl_viveCon_hijo = $rl['repre_viveCon_hijo'];
                        $rl_nivel_educacion = $rl['repre_nivel_educacion'];
                        $rl_titulo = $rl['repre_titulo'];
						$rl_trabajo = $rl['repre_trabajo'];
                        $rl_direccion_trabajo = $rl['repre_direccion_trabajo'];
                        $rl_telefono_trabajo = $rl['repre_telefono_trabajo'];
                        $rl_ingreso_mensual = $rl['repre_ingreso_mensual'];
                    }else{
                        $rl_ci = "no encontrado";
                        $rl_apellido = "no encontrado";
                        $rl_nombre = "no encontrado";
                        $rl_nacionalidad = "no encontrado";
                        $rl_estado = "no encontrado";
                        $rl_municipio = "no encontrado";
                        $rl_ciudad = "no encontrado";
                        $rl_fechaN = "no encontrado";
                        $rl_estado_civil = "no encontrado";
                        $rl_direccion = "no encontrado";
                        $rl_telefono_casa = "no encontrado";
                        $rl_celular = "no encontrado";
                        $rl_viveCon_hijo = "no encontrado";
                        $rl_nivel_educacion = "no encontrado";
                        $rl_titulo = "no encontrado";
						$rl_trabajo = "no encontrado";
                        $rl_direccion_trabajo = "no encontrado";
                        $rl_telefono_trabajo = "no encontrado";
                        $rl_ingreso_mensual = "no encontrado";
                    }
					$rl_timestamp = strtotime($rl_fechaN);
					$rl_ya = time();
					$rl_diferencia = $rl_ya - $rl_timestamp;
					$rl_edad = round($rl_diferencia/31536000);
					
					
					$where = array(
                        Handler_SQLBuilder::OPERATOR_EQUAL => Array(
                            Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ID => $familia_salud
                        )
                    );
					
					$query = new Handler_SQLBuilder($hdb);
                    $query->select(Handler_SQLBuilder::TABLE_REGISTRO_SALUD);
                    $query->where($where);
					//Salud
					 if($salud = $hdb->selectTable($query)){
						$salud = $salud->fetch(PDO::FETCH_ASSOC);
                        $salud_vacunas_antivariolica = $salud['salud_vacunas_antivariolica'];
                        $salud_vacunas_sarampion = $salud['salud_vacunas_sarampion'];
                        $salud_vacunas_polio = $salud['salud_vacunas_polio'];
                        $salud_vacunas_triple = $salud['salud_vacunas_triple'];
                        $salud_vacunas_bcg = $salud['salud_vacunas_bcg'];
                        $salud_vacunas_antitetanica = $salud['salud_vacunas_antitetanica'];
                        $salud_vacunas_neumococo = $salud['salud_vacunas_neumococo'];
                        $salud_enfermedad_padece = $salud['salud_enfermedad_padece'];
                        $salud_alergico = $salud['salud_alergico'];
                        $salud_alergico_aque = $salud['salud_alergico_aque'];
                        $salud_impedimento_motor = $salud['salud_impedimento_motor'];
                        $salud_impedimento_motor_pieplano = $salud['salud_impedimento_motor_pieplano'];
                        $salud_impedimento_motor_columna = $salud['salud_impedimento_motor_columna'];
                        $salud_impedimento_motor_articulaciones = $salud['salud_impedimento_motor_articulaciones'];
                        $salud_impedimento_motor_otros = $salud['salud_impedimento_motor_otros'];
                        $salud_impedimento_motor_especialista = $salud['salud_impedimento_motor_especialista'];
                        $salud_vivienda_tipo = $salud['salud_vivienda_tipo'];
                        $salud_n_habitaciones = $salud['salud_n_habitaciones'];
                        $salud_vivienda_ubicacion = $salud['salud_vivienda_ubicacion'];
                        $salud_vivienda_tenencia = $salud['salud_vivienda_tenencia'];
                        $salud_n_hermanos = $salud['salud_n_hermanos'];
                        $salud_hermanos_posicion = $salud['salud_hermanos_posicion'];
                        $salud_n_personas_vive_nino = $salud['salud_n_personas_vive_nino'];
                        $salud_grupo_sanguineo = $salud['salud_grupo_sanguineo'];
                        $salud_enfermedades_bronquitis = $salud['salud_enfermedades_bronquitis'];
                        $salud_enfermedades_alergias = $salud['salud_enfermedades_alergias'];
                        $salud_enfermedades_hepatitis = $salud['salud_enfermedades_hepatitis'];
                        $salud_enfermedades_resfriados = $salud['salud_enfermedades_resfriados'];
                        $salud_enfermedades_paperas = $salud['salud_enfermedades_paperas'];
                        $salud_enfermedades_intoxicacion = $salud['salud_enfermedades_intoxicacion'];
                        $salud_enfermedades_asma = $salud['salud_enfermedades_asma'];
                        $salud_enfermedades_varicela = $salud['salud_enfermedades_varicela'];
                        $salud_enfermedades_ninguna = $salud['salud_enfermedades_ninguna'];
                        $salud_enfermedades_otras = $salud['salud_enfermedades_otras'];
                        $salud_embarazo_deseado = $salud['salud_embarazo_deseado'];
                        $salud_embarazo_controlado = $salud['salud_embarazo_controlado'];
                        $salud_embarazo_enfermedad = $salud['salud_embarazo_enfermedad'];
                        $salud_parto = $salud['salud_parto'];
                        $salud_parto_problema = $salud['salud_parto_problema'];
                        $salud_peso_nacer = $salud['salud_peso_nacer'];
                        $salud_talla_nacer = $salud['salud_talla_nacer'];
                        $salud_lactancia = $salud['salud_lactancia'];
                        $salud_lactancia_tiempo = $salud['salud_lactancia_tiempo'];
                        $salud_alimento_alergico = $salud['salud_alimento_alergico'];
                        $salud_alimento_cual = $salud['salud_alimento_cual'];
                        $salud_chupa_dedo = $salud['salud_chupa_dedo'];
                        $salud_dormir_bien = $salud['salud_dormir_bien'];
                        $salud_dormir_luz = $salud['salud_dormir_luz'];
                        $salud_dormir_juguete = $salud['salud_dormir_juguete'];
                        $salud_bana_solo_ayuda = $salud['salud_bana_solo_ayuda'];
                        $salud_convulsionado = $salud['salud_convulsionado'];
                        $salud_accidente = $salud['salud_accidente'];
                        $salud_camina_bien = $salud['salud_camina_bien'];
                        $salud_psicologo = $salud['salud_psicologo'];
                        $salud_psicologo_porque = $salud['salud_psicologo_porque'];
                        $salud_neurologo = $salud['salud_neurologo'];
                        $salud_neurologo_porque = $salud['salud_neurologo_porque'];
                        $salud_medicado = $salud['salud_medicado'];
                        $salud_tratamiento_prolongado = $salud['salud_tratamiento_prolongado'];
                        $salud_escucha_bien = $salud['salud_escucha_bien'];
                        $salud_intoxicado = $salud['salud_intoxicado'];
                        $salud_intoxicado_conque = $salud['salud_intoxicado_conque'];
                        $salud_ayuda_bano = $salud['salud_ayuda_bano'];
                        $salud_operado = $salud['salud_operado'];
                        $salud_operado_deque = $salud['salud_operado_deque'];
                        $salud_medicamento_alergico = $salud['salud_medicamento_alergico'];
                        $salud_medicamento_cual = $salud['salud_medicamento_cual'];
                        $salud_ve_bien = $salud['salud_ve_bien'];
                        $salud_anteojos = $salud['salud_anteojos'];
                        $salud_juegos_gustan = $salud['salud_juegos_gustan'];
                        $salud_juegos_con_quien = $salud['salud_juegos_con_quien'];
                        $salud_juegos_actitud = $salud['salud_juegos_actitud'];
                        $salud_miedos = $salud['salud_miedos'];
                        $salud_miedos_causa = $salud['salud_miedos_causa'];
                        $salud_pediatra_nombre = $salud['salud_pediatra_nombre'];
                        $salud_actividad_complementaria = $salud['salud_actividad_complementaria'];
                        $salud_actividad_cual = $salud['salud_actividad_cual'];
                        $salud_mascota = $salud['salud_mascota'];
                        $salud_mascota_cual = $salud['salud_mascota_cual'];
                        $salud_actitud_travesuras_padre = $salud['salud_actitud_travesuras_padre'];
                        $salud_actitud_travesuras_madre = $salud['salud_actitud_travesuras_madre'];
                        $salud_musica = $salud['salud_musica'];
                        $salud_musica_infantil = $salud['salud_musica_infantil'];
                        $salud_musica_reggaeton = $salud['salud_musica_reggaeton'];
                        $salud_musica_otra = $salud['salud_musica_otra'];
                        $salud_tv = $salud['salud_tv'];
                        $salud_programas = $salud['salud_programas'];
                        $salud_horas_diarias = $salud['salud_horas_diarias'];
                        $salud_religion_familia = $salud['salud_religion_familia'];
                        $salud_relaciona_otros_ninos = $salud['salud_relaciona_otros_ninos'];
                        $salud_busca_nino_grandes = $salud['salud_busca_nino_grandes'];
                        $salud_molesta_nino_haga = $salud['salud_molesta_nino_haga'];
                        $salud_reprende = $salud['salud_reprende'];
                        $salud_manera_reprender = $salud['salud_manera_reprender'];
                        $salud_comunica_que_siente = $salud['salud_comunica_que_siente'];
                        $salud_conversa_familia = $salud['salud_conversa_familia'];
                        $salud_tema_conversa = $salud['salud_tema_conversa'];
                        $salud_tiempo_solo = $salud['salud_tiempo_solo'];
                        $salud_cuando_nino_solo = $salud['salud_cuando_nino_solo'];
                        $salud_queda_nino_padre = $salud['salud_queda_nino_padre'];
                        $salud_queda_nino_madre = $salud['salud_queda_nino_madre'];
                        $salud_queda_nino_hermano = $salud['salud_queda_nino_hermano'];
                        $salud_queda_nino_familiar = $salud['salud_queda_nino_familiar'];
                        $salud_queda_nino_empleada = $salud['salud_queda_nino_empleada'];
                        $salud_queda_nino_otro = $salud['salud_queda_nino_otro'];
                        $salud_primera_vez_preescolar = $salud['salud_primera_vez_preescolar'];
						$salud_asistio_maternal = $salud['salud_asistio_maternal'];
                        $salud_nombre_maternal = $salud['salud_nombre_maternal'];
                        $salud_primera_vez_maternal = $salud['salud_primera_vez_maternal'];
                        $salud_motivo_eleccion = $salud['salud_motivo_eleccion'];
                        $salud_espera_de_teresa = $salud['salud_espera_de_teresa'];
                        $salud_perso_autori_reti_ninho_apell = $salud['salud_perso_autori_reti_ninho_apell'];
                        $salud_perso_autori_reti_ninho_name = $salud['salud_perso_autori_reti_ninho_name'];
                        $salud_perso_autori_reti_ninho_ci = $salud['salud_perso_autori_reti_ninho_ci'];
                        $salud_perso_autori_reti_ninho_parent = $salud['salud_perso_autori_reti_ninho_parent'];
                        $salud_fecha_insc = $salud['salud_fecha_insc'];
                    }else{
                        $salud_vacunas_antivariolica = "no encontrado";
                        $salud_vacunas_sarampion = "no encontrado";
                        $salud_vacunas_polio = "no encontrado";
                        $salud_vacunas_triple = "no encontrado";
                        $salud_vacunas_bcg = "no encontrado";
                        $salud_vacunas_antitetanica = "no encontrado";
                        $salud_vacunas_neumococo = "no encontrado";
                        $salud_enfermedad_padece = "no encontrado";
                        $salud_alergico = "no encontrado";
                        $salud_alergico_aque = "no encontrado";
                        $salud_impedimento_motor = "no encontrado";
                        $salud_impedimento_motor_pieplano = "no encontrado";
                        $salud_impedimento_motor_columna = "no encontrado";
                        $salud_impedimento_motor_articulaciones = "no encontrado";
                        $salud_impedimento_motor_otros = "no encontrado";
                        $salud_impedimento_motor_especialista = "no encontrado";
                        $salud_vivienda_tipo = "no encontrado";
                        $salud_n_habitaciones = "no encontrado";
                        $salud_vivienda_ubicacion = "no encontrado";
                        $salud_vivienda_tenencia = "no encontrado";
                        $salud_n_hermanos = "no encontrado";
                        $salud_hermanos_posicion = "no encontrado";
                        $salud_n_personas_vive_nino = "no encontrado";
                        $salud_grupo_sanguineo = "no encontrado";
                        $salud_enfermedades_bronquitis = "no encontrado";
                        $salud_enfermedades_alergias = "no encontrado";
                        $salud_enfermedades_hepatitis = "no encontrado";
                        $salud_enfermedades_resfriados = "no encontrado";
                        $salud_enfermedades_paperas = "no encontrado";
                        $salud_enfermedades_intoxicacion = "no encontrado";
                        $salud_enfermedades_asma = "no encontrado";
                        $salud_enfermedades_asma = "no encontrado";
                        $salud_enfermedades_varicela = "no encontrado";
                        $salud_enfermedades_ninguna = "no encontrado";
                        $salud_enfermedades_otras = "no encontrado";
                        $salud_embarazo_deseado = "no encontrado";
                        $salud_embarazo_controlado = "no encontrado";
                        $salud_embarazo_enfermedad = "no encontrado";
                        $salud_parto = "no encontrado";
                        $salud_parto_problema = "no encontrado";
                        $salud_peso_nacer = "no encontrado";
                        $salud_talla_nacer = "no encontrado";
                        $salud_lactancia = "no encontrado";
                        $salud_lactancia_tiempo = "no encontrado";
                        $salud_alimento_alergico = "no encontrado";
                        $salud_alimento_cual = "no encontrado";
                        $salud_chupa_dedo = "no encontrado";
                        $salud_dormir_bien = "no encontrado";
                        $salud_dormir_luz = "no encontrado";
                        $salud_dormir_juguete = "no encontrado";
                        $salud_bana_solo_ayuda = "no encontrado";
                        $salud_convulsionado = "no encontrado";
                        $salud_accidente = "no encontrado";
                        $salud_camina_bien = "no encontrado";
                        $salud_psicologo = "no encontrado";
                        $salud_psicologo_porque = "no encontrado";
                        $salud_neurologo = "no encontrado";
                        $salud_neurologo_porque = "no encontrado";
                        $salud_medicado = "no encontrado";
                        $salud_tratamiento_prolongado = "no encontrado";
                        $salud_escucha_bien = "no encontrado";
                        $salud_intoxicado = "no encontrado";
                        $salud_intoxicado_conque = "no encontrado";
                        $salud_ayuda_bano = "no encontrado";
                        $salud_operado = "no encontrado";
                        $salud_operado_deque = "no encontrado";
                        $salud_medicamento_alergico = "no encontrado";
                        $salud_medicamento_cual = "no encontrado";
                        $salud_ve_bien = "no encontrado";
                        $salud_anteojos = "no encontrado";
                        $salud_juegos_gustan = "no encontrado";
                        $salud_juegos_con_quien = "no encontrado";
                        $salud_juegos_actitud = "no encontrado";
                        $salud_miedos = "no encontrado";
                        $salud_miedos_causa = "no encontrado";
                        $salud_pediatra_nombre = "no encontrado";
                        $salud_actividad_complementaria = "no encontrado";
                        $salud_actividad_cual = "no encontrado";
                        $salud_mascota = "no encontrado";
                        $salud_mascota_cual = "no encontrado";
                        $salud_actitud_travesuras_padre = "no encontrado";
                        $salud_actitud_travesuras_madre = "no encontrado";
                        $salud_musica = "no encontrado";
                        $salud_musica_infantil = "no encontrado";
                        $salud_musica_reggaeton = "no encontrado";
                        $salud_musica_otra = "no encontrado";
                        $salud_tv = "no encontrado";
                        $salud_programas = "no encontrado";
                        $salud_horas_diarias = "no encontrado";
						$salud_religion_familia = "no encontrado";
                        $salud_relaciona_otros_ninos = "no encontrado";
                        $salud_busca_nino_grandes = "no encontrado";
                        $salud_molesta_nino_haga = "no encontrado";
                        $salud_reprende = "no encontrado";
                        $salud_manera_reprender = "no encontrado";
                        $salud_comunica_que_siente = "no encontrado";
                        $salud_conversa_familia = "no encontrado";
                        $salud_tema_conversa = "no encontrado";
                        $salud_tiempo_solo = "no encontrado";
                        $salud_cuando_nino_solo = "no encontrado";
                        $salud_queda_nino_padre = "no encontrado";
                        $salud_queda_nino_madre = "no encontrado";
                        $salud_queda_nino_hermano = "no encontrado";
                        $salud_queda_nino_familiar = "no encontrado";
                        $salud_queda_nino_empleada = "no encontrado";
                        $salud_queda_nino_otro = "no encontrado";
                        $salud_primera_vez_preescolar = "no encontrado";
						$salud_asistio_maternal = "no encontrado";
                        $salud_nombre_maternal = "no encontrado";
                        $salud_primera_vez_maternal = "no encontrado";
                        $salud_motivo_eleccion = "no encontrado";
                        $salud_espera_de_teresa = "no encontrado";
                        $salud_perso_autori_reti_ninho_apell = "no encontrado";
                        $salud_perso_autori_reti_ninho_name = "no encontrado";
                        $salud_perso_autori_reti_ninho_ci = "no encontrado";
                        $salud_perso_autori_reti_ninho_parent = "no encontrado";
                        $salud_fecha_insc = "no encontrado";
                    }
                    $html='
						<div id="contenedor" style="margin:5%;">	
							<table id="encabezado" style="width:100%;"> 
								<tr> 
									<td align="right">
										<b>Fecha:</b> '.date('d-m-Y').'
									</td>
								</tr>
								<tr align="left">
									<td colspan="7">
										<img src="../files/images/logo.png"/ width="120" height="100">
									</td>	
								</tr>
								<tr>
									<td colspan="7"> 
										<h1 style="text-align:center;">E.E.I. Colegio Teresa de la Parra</h1>
									</td>
								</tr>
								<tr>
									<td colspan="7">
										<p style="text-align:center;"><b>R.I.F:</b> J-40246810-0</p>
									</td>
								</tr>
								<tr>
									<td colspan="7">
										<p style="text-align:center;">Calle 6, esquina con carrera 3, N° 3-10, Táriba</p>
									</td>
								</tr>
							</table>
							<table id="madre" border="1" style="width:100%;">
									<tr>
										<td  colspan="7" rowspan="1">
											<h1 id="titulo" style="text-align:center;">Identificación</h1>
										</td>
									</tr>			
									<tr>
										<td  colspan="7">
											<h2 style="text-align:center;">Datos del niño(a)</h2>
										</td>
									</tr>	
									<tr>
										<td  colspan="2">
											<p><b>Apellido:</b> '.$hijo_apellido.'</p>
										</td>
										<td  colspan="3">
											<p><b>Nombre:</b> '.$hijo_nombre.'</p>
										</td>
										<td  colspan="2">
											<p><b>Cédula escolar:</b> '.$hijo_cedula_escolar.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="1">	
											<p><b>Lugar de nacimiento:</b></P>
										</td>	
										<td  colspan="2">	
											<p><b>Estado:</b> '.$hijo_estado.'</p>
										</td>	
										<td  colspan="2">
											<p><b>Municipio:</b> '.$hijo_municipio.'</p>
										</td>	
										<td  colspan="2">	
											<p><b>Ciudad:</b> '.$hijo_ciudad.'</p>
										</td>
									</tr>	
									<tr>
										<td  colspan="3">
											<p><b>Fecha de nacimiento:</b> '.$hijo_dia.'/'.$hijo_mes.'/'.$hijo_anho.'</p>
										</td>
										<td  colspan="2">
											<p><b>Nacionalidad:</b> '.$hijo_nacionalidad.'</p>
										</td>
										<td  colspan="2">
											<p><b>Sexo:</b> '.$hijo_sexo.'</p>
										</td>
									</tr>	
									<tr>
										<td  colspan="2">
											<p><b>Edad:</b> '.$hijo_edad.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Peso:</b> '.$hijo_peso.'</p>
										</td>
										<td  colspan="3">	
											<p><b>Talla:</b> '.$hijo_talla.'</p>
										</td>
									</tr>	
									<tr>
										<td  colspan="4">
											<p><b>Dirección de habitación:</b> '.$hijo_direccion.'</p>
										</td>
										<td  colspan="3">	
											<p><b>Teléfono de habitación:</b> '.$hijo_telefono.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="3">	
											<p><b>Nivel:</b> '.$hijo_nivel.'</p>
										</td>
										<td  colspan="2">
											<p><b>Turno:</b> </p>
										</td>
										<td  colspan="2">	
											<p><b>Grupo:</b> </p>
										</td>
									</tr>
								</table>
								<table id="hijo" border="1" style="width:100%;">
									<tr>
										<td  colspan="7">
											<h2 id="titulo" style="text-align:center;">Datos de la madre</h2>
										</td>
									</tr>
									<tr>
										<td  colspan="2">	
											<p><b>Apellido:</b> '.$madre_apellido.'</p>
										</td>
										<td  colspan="3">
											<p><b>Nombre:</b> '.$madre_nombre.'</p>
										</td>
										<td  colspan="2">
											<p><b>Cédula de identidad:</b> '.$madre_ci.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">	
											<p><b>Nacionalidad:</b> '.$madre_nacionalidad.'</p>
										</td>
										<td  colspan="3">	
											<p><b>Fecha de nacimiento:</b> '.$madre_fechaN.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Edad:</b> '.$madre_edad.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="1">	
											<p ><b>Lugar de nacimiento:</b></p>
										</td>
										<td  colspan="2">	
											<p><b>Estado:</b> '.$madre_estado.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Municipio:</b> '.$madre_municipio.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Ciudad:</b> '.$madre_ciudad.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="4">	
											<p><b>Dirección de habitación:</b> '.$madre_direccion.'</p>
										</td>
										<td  colspan="3">
											<p><b>Teléfono de habitación:</b> '.$madre_telefono_casa.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">	
											<p><b>Estado civil:</b> '.$madre_estado_civil.'</p>
										</td>
										<td  colspan="2">
											<p><b>Celular:</b> '.$madre_celular.'</p>
										</td>
										<td  colspan="3">
											<p><b>Nivel de instrucción:</b> '.$madre_nivel_educacion.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="3">	
											<p><b>Profesión:</b> '.$madre_titulo.'</p>
										</td>
										<td  colspan="4">
											<p><b>Trabajo que desempeña:</b> '.$madre_trabajo.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="4">	
											<p><b>Dirección del trabajo:</b> '.$madre_direccion_trabajo.'</p>
										</td>
										<td  colspan="3">	
											<p><b>Teléfono del trabajo:</b> '.$madre_telefono_trabajo.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="4">	
											<p><b>Ingreso mensual:</b> '.$madre_ingreso_mensual.'</p>
										</td>
										<td  colspan="3">
											<p><b>Vive con el estudiante:</b> '.$madre_viveCon_hijo.'</p>
										</td>
									</tr>
								</table>	
								<table id="padre" border="1" style="width:100%;">
									<tr>
										<td  colspan="7">		
											<h2 id="titulo" style="text-align:center;">Datos del padre</h2>
										</td>
									</tr>	
									<tr>
										<td  colspan="2">	
											<p><b>Apellido:</b> '.$padre_apellido.'</p>
										</td>
										<td  colspan="3">
											<p><b>Nombre:</b> '.$padre_nombre.'</p>
										</td>
										<td  colspan="2">
											<p><b>Cédula de identidad:</b> '.$padre_ci.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">	
											<p><b>Nacionalidad:</b> '.$padre_nacionalidad.'</p>
										</td>
										<td  colspan="3">	
											<p><b>Fecha de nacimiento:</b> '.$padre_fechaN.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Edad:</b> '.$padre_edad.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="1">	
											<p ><b>Lugar de nacimiento:</b></p>
										</td>
										<td  colspan="2">	
											<p><b>Estado:</b> '.$padre_estado.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Municipio:</b> '.$padre_municipio.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Ciudad:</b> '.$padre_ciudad.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="4">	
											<p><b>Dirección de habitación:</b> '.$padre_direccion.'</p>
										</td>
										<td  colspan="3">
											<p><b>Teléfono de habitación:</b> '.$padre_telefono_casa.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">	
											<p><b>Estado civil:</b> '.$padre_estado_civil.'</p>
										</td>
										<td  colspan="2">
											<p><b>Celular:</b> '.$padre_celular.'</p>
										</td>
										<td  colspan="3">
											<p><b>Nivel de instrucción:</b> '.$padre_nivel_educacion.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="3">	
											<p><b>Profesión:</b> '.$padre_titulo.'</p>
										</td>
										<td  colspan="4">
											<p><b>Trabajo que desempeña:</b> '.$padre_trabajo.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="4">	
											<p><b>Dirección del trabajo:</b> '.$padre_direccion_trabajo.'</p>
										</td>
										<td  colspan="3">	
											<p><b>Teléfono del trabajo:</b> '.$padre_telefono_trabajo.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="4">	
											<p><b>Ingreso mensual:</b> '.$padre_ingreso_mensual.'</p>
										</td>
										<td  colspan="3">
											<p><b>Vive con el estudiante:</b> '.$padre_viveCon_hijo.'</p>
										</td>
									</tr>
								</table>
								<table id="rl" border="1" style="width:100%;">
									<tr>
										<td  colspan="7">	
											<h2 id="titulo" style="text-align:center;">Datos del representante legal</h2>
										</td>
									</tr>
										<tr>
										<td  colspan="2">	
											<p><b>Apellido:</b> '.$rl_apellido.'</p>
										</td>
										<td  colspan="3">
											<p><b>Nombre:</b> '.$rl_nombre.'</p>
										</td>
										<td  colspan="2">
											<p><b>Cédula de identidad:</b> '.$rl_ci.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">	
											<p><b>Nacionalidad:</b> '.$rl_nacionalidad.'</p>
										</td>
										<td  colspan="3">	
											<p><b>Fecha de nacimiento:</b> '.$rl_fechaN.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Edad:</b> '.$rl_edad.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="1">	
											<p ><b>Lugar de nacimiento:</b></p>
										</td>
										<td  colspan="2">	
											<p><b>Estado:</b> '.$rl_estado.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Municipio:</b> '.$rl_municipio.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Ciudad:</b> '.$rl_ciudad.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="4">	
											<p><b>Dirección de habitación:</b> '.$rl_direccion.'</p>
										</td>
										<td  colspan="3">
											<p><b>Teléfono de habitación:</b> '.$rl_telefono_casa.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">	
											<p><b>Estado civil:</b> '.$rl_estado_civil.'</p>
										</td>
										<td  colspan="2">
											<p><b>Celular:</b> '.$rl_celular.'</p>
										</td>
										<td  colspan="3">
											<p><b>Nivel de instrucción:</b> '.$rl_nivel_educacion.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="3">	
											<p><b>Profesión:</b> '.$rl_titulo.'</p>
										</td>
										<td  colspan="4">
											<p><b>Trabajo que desempeña:</b> '.$rl_trabajo.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="4">	
											<p><b>Dirección del trabajo:</b> '.$rl_direccion_trabajo.'</p>
										</td>
										<td  colspan="3">	
											<p><b>Teléfono del trabajo:</b> '.$rl_telefono_trabajo.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">	
											<p><b>Ingreso mensual:</b> '.$rl_ingreso_mensual.'</p>
										</td>
										<td  colspan="2">
											<p><b>Vive con el estudiante:</b> '.$rl_viveCon_hijo.'</p>
										</td>
										<td  colspan="3">	
											<p><b>Número de representados en la institución:</b> OJO</p>
										</td>
									</tr>
									<tr>
										<td  colspan="7">	
											<p><b>En caso de no ser la madre o el padre. ¿Por qué lo representa otra persona?:</b> '.$rl_pq_otra_persona.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="7">	
											<p><b>¿Presenta el permiso del CEPNA que lo(a) autorice para que sea su representante?:</b> '.$rl_permiso_cepna.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="5">	
											<p><b>¿A quien llamar en caso de emergencia?:</b> '.$rl_parentesco.'</p>
										</td>
										<td  colspan="2">	
											<p><b>Teléfono:</b> '.$rl_llamar_emergencia.'</p>
										</td>
									</tr>
								</table>
									';
								$salud_html_1='
								<table id="salud_1" border="1" style="width:100%;">
									<tr>
										<td  colspan="7">
											<h2 style="text-align:center;">Registro de salud</h2>
										</td>
									</tr>
									<tr>
										<td  colspan="7">
											<h3 style="text-align:center;">Vacunas</h3>
										</td>
									</tr>		
									<tr>
										<td >
											<p><b>Antivariolica:</b> '.$salud_vacunas_antivariolica.'</p>
										</td>
										<td >
											<p><b>Sarampion:</b> '.$salud_vacunas_sarampion.'</p>
										</td>
										<td >
											<p><b>Polio:</b> '.$salud_vacunas_polio.'</p>
										</td>
										<td >
											<p><b>Triple:</b> '.$salud_vacunas_triple.'</p>
										</td>
										<td >
											<p><b>BCG:</b> '.$salud_vacunas_bcg.'</p>
										</td>
										<td >
											<p><b>Antitetánica:</b> '.$salud_vacunas_antitetanica.'</p>
										</td>
										<td >
											<p><b>Neumococo:</b> '.$salud_vacunas_neumococo.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>Enfermedad(es) que padece:</b> '.$salud_enfermedad_padece.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Es alérgico?:</b> '.$salud_alergico.'</p>
										</td>	
										<td  colspan="3">
											<p><b>¿A qué?:</b> '.$salud_alergico_aque.'</p>
										</td>
									</tr>	
									<tr>
										<td  colspan="2">
											<p><b>¿Posee algún impedimento motor?:</b> '.$salud_impedimento_motor.'</p>
											
										</td>
										<td  colspan="1">
											<p><b>¿Cuál?:</b></p>
										</td>	
										<td  colspan="1">
											<p><b>Pie plano:</b> '.$salud_impedimento_motor_pieplano.'</p>
										</td>	
										<td  colspan="1">
											<p><b>Columna:</b> '.$salud_impedimento_motor_columna.'</p>
										</td>
										<td  colspan="1">
											<p><b>Articulaciones:</b> '.$salud_impedimento_motor_articulaciones.'</p>
										</td>
										<td  colspan="1">
											<p><b>Otros:</b> '.$salud_impedimento_motor_otros.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="7">	
											<p><b>En caso de ser positivo ¿es asistido por el especialista? nombre:</b> '.$salud_impedimento_motor_especialista.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>Enfermedades que a padecido:</b> </p>
										</td>
										<td  colspan="1">
											<p><b>Bronquitis:</b> '.$salud_enfermedades_bronquitis.'</p>
										</td>
										<td  colspan="1">
											<p><b>Alergias:</b> '.$salud_enfermedades_alergias.'</p>
										</td>
										<td  colspan="1">	
											<p><b>Hepatitis:</b> '.$salud_enfermedades_hepatitis.'</p>
										</td>
										<td  colspan="1">
											<p><b>Resfriados comunes:</b> '.$salud_enfermedades_resfriados.'</p>
										</td>	
										<td  colspan="1">	
											<p><b>Paperas:</b> '.$salud_enfermedades_paperas.'</p>
										</td>
									</tr>	
									<tr>
										<td  colspan="1">	
											<p><b>Intoxicación:</b> '.$salud_enfermedades_intoxicacion.'</p>
										</td>
										<td  colspan="1">
											<p><b>Asma:</b> '.$salud_enfermedades_asma.'</p>
										</td> 
										<td  colspan="1">
											<p><b>Varicela:</b> '.$salud_enfermedades_varicela.'</p>
										</td>
										<td  colspan="2">
											<p><b>Otras:</b> '.$salud_enfermedades_otras.'</p>
										</td>
										<td  colspan="2">
											<p><b>Ninguna:</b> '.$salud_enfermedades_ninguna.'</p>
										</td>
									</tr>	
									<tr>
										<td  colspan="2">
											<p><b>El niño vive en:</b> '.$salud_vivienda_tipo.'</p>
										</td>
										<td  colspan="2">
											<p><b>Ubicación de la vivienda:</b> '.$salud_vivienda_ubicacion.'</p>
										</td>
										<td  colspan="3">
											<p><b>Tenencia de la vivienda:</b> '.$salud_vivienda_tenencia.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="1">
											<p><b>Nº de habitantes:</b> '.$salud_n_habitaciones.'</p>
										</td>
										<td  colspan="1">
											<p><b>Nº de hermanos:</b> '.$salud_n_hermanos.'</p>
										</td>
										<td  colspan="2">
											<p><b>Posición que ocupa entre hermanos:</b> '.$salud_hermanos_posicion.'</p>
										</td>
										<td colspan="3">
											<p><b>Nº de persons que viven con el niño:</b> '.$salud_n_personas_vive_nino.'</p>
										</td>
									</tr>	
									<tr>
										<td  colspan="4">	
											<p><b>¿Fue un embarazo deseado y planificado?:</b> '.$salud_embarazo_deseado.'</p>
										</td>
										<td  colspan="3">
											<p><b>¿El enbarazo fue controlado?:</b> '.$salud_embarazo_controlado.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="3">	
											<p><b>¿Sufrio alguna enfermedad durante le embarazo?:</b> '.$salud_embarazo_enfermedad.'</p>
										</td>
										<td  colspan="4">
											<p><b>Tipo de parto:</b> '.$salud_parto.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">	
											<p><b>¿Tuvo algun problema durante el parto?:</b> '.$salud_parto_problema.'</p>
										</td>
										<td  colspan="2">
											<p><b>Peso al nacer:</b> '.$salud_peso_nacer.'</p>
										</td>
										<td  colspan="2">
											<p><b>Talla al nacer:</b> '.$salud_talla_nacer.'</p>
										</td>
										<td  colspan="1">
											<p><b>Grupo Sanguineo:</b> '.$salud_grupo_sanguineo.'</p>
										</td>
									</tr>	
									<tr>
										<td  colspan="2">	
											<p><b>¿Hubo lactancia materna?:</b> '.$salud_lactancia.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Durante cuanto tiempo?:</b> '.$salud_lactancia_tiempo.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Es alérgico a algún alimento?:</b> '.$salud_alimento_alergico.'</p>
										</td>
										<td  colspan="1">
											<p><b>¿Cuál?:</b> '.$salud_alimento_cual.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">	
											<p><b>¿Se chupa los dedos?:</b> '.$salud_chupa_dedo.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Duerme bien?:</b> '.$salud_dormir_bien.'</p>
										</td>
										<td  colspan="3">
											<p><b>¿Necesita lúz para dormir?:</b> '.$salud_dormir_luz.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="3">	
											<p><b>¿Algún elemento o juguete para dormir?:</b> '.$salud_dormir_juguete.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Se baña solo o con ayuda?:</b> '.$salud_bana_solo_ayuda.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Ha convulsionado?:</b> '.$salud_convulsionado.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>Con que frecuencia ha asistido el niño a consulta con:</b> </p>
										</td>
										<td  colspan="1">
											<p><b>Psicólogo:</b> '.$salud_psicologo.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Por qué?:</b> '.$salud_psicologo_porque.'</p>
										</td>
										<td  colspan="1">
											<p><b>Neurólogo:</b> '.$salud_neurologo.'</p>
										</td>
										<td  colspan="1">
											<p><b>¿Por qué?:</b> '.$salud_neurologo_porque.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="1">
											<p><b>¿Esta medicado?:</b> '.$salud_medicado.'</p>
										</td>
										<td  colspan="3">
											<p><b>Tratamiento prolongado:</b> '.$salud_tratamiento_prolongado.'</p>
										</td>
										<td  colspan="3">
											<p><b>¿Presenta alguna dificulta respiratoria y/o cardiaca?:</b> </p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>¿Ha sufrido algún accidente?:</b> '.$salud_accidente.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Ha estado intoxicado?:</b> '.$salud_intoxicado.'</p>
										</td>
										<td  colspan="3">
											<p><b>¿Con qué?:</b> '.$salud_intoxicado_conque.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>¿Ha sido operado?:</b> '.$salud_operado.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿De qué?:</b> '.$salud_operado_deque.'</p>
										</td>
										<td  colspan="1">
											<p><b>¿Es alérgico a algún medicamento?:</b> '.$salud_medicamento_alergico.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿A cual?:</b> '.$salud_medicamento_cual.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="1">
											<p><b>¿Ve bien?:</b> '.$salud_ve_bien.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Utiliza anteojos?:</b> '.$salud_anteojos.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Escucha bien?:</b> '.$salud_escucha_bien.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Camina bien?:</b> '.$salud_camina_bien.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>¿Necesita ayuda para ir al baño?:</b> '.$salud_ayuda_bano.'</p>
										</td>
										<td  colspan="3">
											<p><b>Nombre del Pediatra que lo atiende:</b> '.$salud_pediatra_nombre.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Qué juegos le gustán?:</b> '.$salud_juegos_gustan.'</p>
										</td>	
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>¿Con quien juega?:</b> '.$salud_juegos_con_quien.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Comó es su actitud ante los juegos?:</b> '.$salud_juegos_actitud.'</p>
										</td>
										<td  colspan="1">
											<p><b>¿Manifiesta miedos?:</b> '.$salud_miedos.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Conoce usted la causa?:</b> '.$salud_miedos_causa.'</p>
										</td>
									</tr>
								</table>';
								$salud_html_2='
								<table id="salud_2" border="1" style="width:100%;">
									<tr>
										<td  colspan="2">
											<p><b>¿Practica alguna actividad complementaria?:</b> '.$salud_actividad_complementaria.'</p>
										</td>
										<td   colspan="2">
											<p><b>¿Cuál?:</b> '.$salud_actividad_cual.'</p>
										</td>
										<td  colspan="1">
											<p><b>¿Tiene alguna mascota?:</b> '.$salud_mascota.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Cuál?:</b> '.$salud_mascota_cual.'</p>
										</td>	
									</tr>
									<tr>
										<td  colspan="3">
											<p><b>¿Qué actitud toma ante una travesura de su niño(a)?</b> </p>
										</td>
										<td  colspan="2">
											<p><b>Madre:</b> '.$salud_actitud_travesuras_madre.'</p>
										</td>
										<td  colspan="2">
											<p><b>Padre:</b> '.$salud_actitud_travesuras_padre.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="1">
											<p style="display:inline; margin-right:10%;" ><b>¿Escucha música?</b> '.$salud_musica.'</p>
										</td>
										<td  colspan="1">
											<p style="display:inline; margin-right:3%;" ><b>¿Qué tipo?:</b> </p>
										</td>
										<td  colspan="1">
											<p style="display:inline; margin-right:5%;" ><b>Infantil:</b> '.$salud_musica_infantil.'</p>	
										</td>
										<td  colspan="1">
											<p style="display:inline; margin-right:5%;"><b>Reggaeton:</b> '.$salud_musica_reggaeton.'</p>	
										</td>
										<td  colspan="3">
											<p style="display:inline; " ><b>Otro generos:</b> '.$salud_musica_otra.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>¿Ve Televisión?:</b> '.$salud_tv.'</p>
										</td>
										<td  colspan="3">
											<p><b>¿Qué programas?:</b> '.$salud_programas.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Cuántas horas diarias?:</b> '.$salud_horas_diarias.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>¿Que religión profesa la familia?:</b> '.$salud_religion_familia.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Se relaciona facilmente con otrs niños?:</b> '.$salud_relaciona_otros_ninos.'</p>
										</td>
										<td  colspan="3">
											<p><b>¿Busca la compáñia de otros niños más grandes que él(ella)?:</b> '.$salud_busca_nino_grandes.'</p>	
										</td>
									</tr>
									<tr>
										<td  colspan="3">
											<p><b>¿Que cosa le disgustan a usted que el(ella) haga?:</b> '.$salud_molesta_nino_haga.'</p>
										</td>
										<td  colspan="1">
											<p><b>¿Lo reprende?:</b> '.$salud_reprende.'</p>
										</td>
										<td  colspan="3" >
											<p><b>¿De que manera?:</b> '.$salud_manera_reprender.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>El niño ¿Comunica lo que siente?:</b> '.$salud_comunica_que_siente.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Conversan los integrantes de la familia con él?:</b>  '.$salud_conversa_familia.'</p>
										</td>
										<td  colspan="3">
											<p><b>¿Sobre que temas?:</b> '.$salud_tema_conversa.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="3">
											<p><b>¿EL niño pasa algún tiempo solo?:</b> '.$salud_tiempo_solo.'</p>
										</td>
										<td  colspan="4">
											<p><b>¿Cuando?:</b> '.$salud_cuando_nino_solo.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>¿Con quien se queda el niño(a)?</b> </p>
										</td>
										<td  colspan="1">
											<p><b>Padre:</b> '.$salud_queda_nino_padre.'</p>
										</td>
										<td  colspan="1">
											<p><b>Madre:</b> '.$salud_queda_nino_madre.'</p>
										</td>
										<td  colspan="3">
											<p><b>Hermano:</b> '.$salud_queda_nino_hermano.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="3">		
											<p><b>Familiar:</b> '.$salud_queda_nino_familiar.'</p>
										</td>
										<td  colspan="2">
											<p><b>Empleada:</b> '.$salud_queda_nino_empleada.'</p>
										</td>
										<td  colspan="2">
											<p><b>Otros:</b> '.$salud_queda_nino_otro.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="7">	
											<p><b>¿Es 1era vez que el niño(a) asiste al preescolar?:</b> '.$salud_primera_vez_preescolar.'</p>
										</td>
									</tr>
									<tr>
										<td  colspan="2">
											<p><b>¿El niño(a) asistio al maternal?:</b> '.$salud_asistio_maternal.'</p>
										</td>
										<td  colspan="3">	
											<p><b>Nombre del maternal:</b> '.$salud_nombre_maternal.'</p>
										</td>
										<td  colspan="2">
											<p><b>¿Asiste al maternal por 1era vez?:</b> '.$salud_primera_vez_maternal.'</p>
										</td>
									</tr>
									<tr style="border:1px solid;">
										<td  colspan="7">	
											<p><b>¿Cuál fue el motivo de su elección con respecto a la E.E.I. Colegio Teresa de la Parra?:</b> '.$salud_motivo_eleccion.'</p>
										</td>
									</tr>
									<tr style="border:1px solid;">
										<td  colspan="7">
											<p><b>¿Qué espera usted de la E.E.I. Colegio Teresa de la Parra?:</b> '.$salud_espera_de_teresa.'</p>
										</td>
									</tr>	
							</table>
							<br/>
							<table id="rl" style="width:100%;">
								<tr style="border:1px solid;">
									<td  colspan="7">
										<p align="center"><b>Apellidos y nombres de la persona autorizada para retirar el niño(a) de la institución</b></p>
									</td>
								</tr>
								<br/>
								<tr style="border:1px solid;">
									<td  colspan="3">
										<p style="display:inline; margin-right:30%;"><b>Apellidos:</b> '.$salud_perso_autori_reti_ninho_apell.'</p>
									</td>
									<td  colspan="2">
										<p style="display:inline; margin-right:30%;"><b>Nombres:</b> '.$salud_perso_autori_reti_ninho_name.'</p>
									</td>
									<td  colspan="2">
										<p style="display:inline;" class="dato"><b>Cédula:</b> '.$salud_perso_autori_reti_ninho_ci.'</p>
									</td>
								</tr>
								<br/>
								<tr style="border:1px solid;">
									<td  colspan="4">
										<p style="display:inline; margin-right:30%;"><b>Parentesco:</b> '.$salud_perso_autori_reti_ninho_parent.'</p>
									</td>
									<td  colspan="3">
										<p style="display:inline; margin-right:30%;"><b>Fecha de inscripción:</b> '.$salud_fecha_insc.'</p>
									</td>	
								</tr>
								<br/>
								<tr style="border:1px solid;">
									<td colspan="1"></td>
									<td  colspan="2">
										<p style="display:inline;" >Firma del representante</p> 
										<p style="display:inline; margin-right:20%;" >________________________</p>
									</td>
									<td colspan="1"></td>
									<td  colspan="2">
										<p style="display:inline;" >Firma del docente</p>
										<p style="display:inline;" >________________________</p>
									</td>
									<td colspan="1"></td>
								</tr>
							</table>	
						</div>';  
					//echo $html." ".$salud_html;
					$pdf = new Handler_PDF();
					$pdf->AddPage();
					$pdf->writeHTML($html, true, false, true, false, '');
					
					$pdf->AddPage();
					$pdf->writeHTML($salud_html_1, true, false, true, false, '');
					
					$pdf->AddPage();
					$pdf->writeHTML($salud_html_2, true, false, true, false, '');
					$pdf->Output($id.'.pdf', 'I');	
				
                }else{
                    exit('Factura no encontrada');
                }
            }else{
                exit('Acceso no autorizado');
            }
        }else{
            exit('Archivo invalido');
        }
    }else{
        exit('Formato invalido');
    }
?>