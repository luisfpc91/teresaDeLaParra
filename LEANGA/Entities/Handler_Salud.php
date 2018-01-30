<?php

	namespace LEANGA\Entities;

	use LEANGA\Handler_HTTP;
	use LEANGA\Handler_Database;
	use LEANGA\Handler_SQLBuilder;
	use LEANGA\Handler_User;
	use LEANGA\LEANGAException;
	use PDO;
	
	class Handler_Salud extends Handler_HTTP
	{
		private $hdb;
		private $user;
		
		
		
		public function __construct(Handler_User $user, Handler_Database $hdb)
		{
			parent::__construct();
			$this->user = $user;
			$this->hdb = $hdb;
		}
		
		public function getSingle(array $params = null){
			if(!$params)
				if($this->method == 'GET')
					$params = $this->get;
				else
					throw new LEANGAException("No parameters found to match this action"); 
			
			$query = new Handler_SQLBuilder($this->hdb);
			$query->select(Handler_SQLBuilder::TABLE_REGISTRO_SALUD);
			$filter = array_key_exists('filter',$params) ? $params['filter'] : '';
			
			switch($filter){
				case 'i':
					$query->where(array(
						Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
							Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ID	=>	$params['term']
						)			   
					));
					break;
				default:
					throw new LEANGAException("You need to apply a filther to use this endpoint"); 
					break;
			}
			
			if($res = $query->commit()){
				$re = $res->fetch(PDO::FETCH_ASSOC);
				$return = array('e'=>0,
					'salud'=>array(
						'salud_id'	=>	$re['salud_id'],
						'salud_vacunas_antivariolica'	=>	$re['salud_vacunas_antivariolica'],
						'salud_vacunas_sarampion'	=>	$re['salud_vacunas_sarampion'],
						'salud_vacunas_polio'	=>	$re['salud_vacunas_polio'],
						'salud_vacunas_triple'	=>	$re['salud_vacunas_triple'],
						'salud_vacunas_bcg'	=>	$re['salud_vacunas_bcg'],
						'salud_vacunas_antitetanica'	=>	$re['salud_vacunas_antitetanica'],
						'salud_vacunas_neumococo'	=>	$re['salud_vacunas_neumococo'],
						'salud_enfermedad_padece'	=>	$re['salud_enfermedad_padece'],
						'salud_alergico'	=>	$re['salud_alergico'],
						'salud_alergico_aque'	=>	$re['salud_alergico_aque'],
						'salud_impedimento_motor'	=>	$re['salud_impedimento_motor'],
						'salud_impedimento_motor_pieplano'	=>	$re['salud_impedimento_motor_pieplano'],
						'salud_impedimento_motor_columna'	=>	$re['salud_impedimento_motor_columna'],
						'salud_impedimento_motor_articulaciones'	=>	$re['salud_impedimento_motor_articulaciones'],
						'salud_impedimento_motor_otros'	=>	$re['salud_impedimento_motor_otros'],
						'salud_impedimento_motor_especialista'	=>	$re['salud_impedimento_motor_especialista'],
						'salud_vivienda_tipo'	=>	$re['salud_vivienda_tipo'],
						'salud_n_habitaciones'	=>	$re['salud_n_habitaciones'],
						'salud_vivienda_ubicacion'	=>	$re['salud_vivienda_ubicacion'],
						'salud_vivienda_tenencia'	=>	$re['salud_vivienda_tenencia'],
						'salud_n_hermanos'	=>	$re['salud_n_hermanos'],
						'salud_hermanos_posicion'	=>	$re['salud_hermanos_posicion'],
						'salud_n_personas_vive_nino'	=>	$re['salud_n_personas_vive_nino'],
						'salud_grupo_sanguineo'	=>	$re['salud_grupo_sanguineo'],
						'salud_enfermedades_bronquitis'	=>	$re['salud_enfermedades_bronquitis'],
						'salud_enfermedades_alergias'	=>	$re['salud_enfermedades_alergias'],
						'salud_enfermedades_hepatitis'	=>	$re['salud_enfermedades_hepatitis'],
						'salud_enfermedades_resfriados'	=>	$re['salud_enfermedades_resfriados'],
						'salud_enfermedades_paperas'	=>	$re['salud_enfermedades_paperas'],
						'salud_enfermedades_intoxicacion'	=>	$re['salud_enfermedades_intoxicacion'],
						'salud_enfermedades_asma'	=>	$re['salud_enfermedades_asma'],
						'salud_enfermedades_varicela'	=>	$re['salud_enfermedades_varicela'],
						'salud_enfermedades_ninguna'	=>	$re['salud_enfermedades_ninguna'],
						'salud_enfermedades_otras'	=>	$re['salud_enfermedades_otras'],
						'salud_embarazo_deseado'	=>	$re['salud_embarazo_deseado'],
						'salud_embarazo_controlado'	=>	$re['salud_embarazo_controlado'],
						'salud_embarazo_enfermedad'	=>	$re['salud_embarazo_enfermedad'],
						'salud_parto'	=>	$re['salud_parto'],
						'salud_parto_problema'	=>	$re['salud_parto_problema'],
						'salud_peso_nacer'	=>	$re['salud_peso_nacer'],
						'salud_talla_nacer'	=>	$re['salud_talla_nacer'],
						'salud_lactancia'	=>	$re['salud_lactancia'],
						'salud_lactancia_tiempo'	=>	$re['salud_lactancia_tiempo'],
						'salud_alimento_alergico'	=>	$re['salud_alimento_alergico'],
						'salud_alimento_cual'	=>	$re['salud_alimento_cual'],
						'salud_chupa_dedo'	=>	$re['salud_chupa_dedo'],
						'salud_dormir_bien'	=>	$re['salud_dormir_bien'],
						'salud_dormir_luz'	=>	$re['salud_dormir_luz'],
						'salud_dormir_juguete'	=>	$re['salud_dormir_juguete'],
						'salud_bana_solo_ayuda'	=>	$re['salud_bana_solo_ayuda'],
						'salud_convulsionado'	=>	$re['salud_convulsionado'],
						'salud_accidente'	=>	$re['salud_accidente'],
						'salud_camina_bien'	=>	$re['salud_camina_bien'],
						'salud_psicologo'	=>	$re['salud_psicologo'],
						'salud_psicologo_porque'	=>	$re['salud_psicologo_porque'],
						'salud_neurologo'	=>	$re['salud_neurologo'],
						'salud_neurologo_porque'	=>	$re['salud_neurologo_porque'],
						'salud_medicado'	=>	$re['salud_medicado'],
						'salud_tratamiento_prolongado'	=>	$re['salud_tratamiento_prolongado'],
						'salud_escucha_bien'	=>	$re['salud_escucha_bien'],
						'salud_intoxicado'	=>	$re['salud_intoxicado'],
						'salud_intoxicado_conque'	=>	$re['salud_intoxicado_conque'],
						'salud_ayuda_bano'	=>	$re['salud_ayuda_bano'],
						'salud_operado'	=>	$re['salud_operado'],
						'salud_operado_deque'	=>	$re['salud_operado_deque'],
						'salud_medicamento_alergico'	=>	$re['salud_medicamento_alergico'],
						'salud_medicamento_cual'	=>	$re['salud_medicamento_cual'],
						'salud_ve_bien'	=>	$re['salud_ve_bien'],
						'salud_anteojos'	=>	$re['salud_anteojos'],
						'salud_juegos_gustan'	=>	$re['salud_juegos_gustan'],
						'salud_juegos_con_quien'	=>	$re['salud_juegos_con_quien'],
						'salud_juegos_actitud'	=>	$re['salud_juegos_actitud'],
						'salud_miedos'	=>	$re['salud_miedos'],
						'salud_miedos_causa'	=>	$re['salud_miedos_causa'],
						'salud_pediatra_nombre'	=>	$re['salud_pediatra_nombre'],
						'salud_actividad_complementaria'	=>	$re['salud_actividad_complementaria'],
						'salud_actividad_cual'	=>	$re['salud_actividad_cual'],
						'salud_mascota'	=>	$re['salud_mascota'],
						'salud_mascota_cual'	=>	$re['salud_mascota_cual'],
						'salud_actitud_travesuras_padre'	=>	$re['salud_actitud_travesuras_padre'],
						'salud_actitud_travesuras_madre'	=>	$re['salud_actitud_travesuras_madre'],
						'salud_musica'	=>	$re['salud_musica'],
						'salud_musica_infantil'	=>	$re['salud_musica_infantil'],
						'salud_musica_reggaeton'	=>	$re['salud_musica_reggaeton'],
						'salud_musica_otra'	=>	$re['salud_musica_otra'],
						'salud_tv'	=>	$re['salud_tv'],
						'salud_programas'	=>	$re['salud_programas'],
						'salud_horas_diarias'	=>	$re['salud_horas_diarias'],
						'salud_religion_familia'	=>	$re['salud_religion_familia'],
						'salud_relaciona_otros_ninos'	=>	$re['salud_relaciona_otros_ninos'],
						'salud_busca_nino_grandes'	=>	$re['salud_busca_nino_grandes'],
						'salud_molesta_nino_haga'	=>	$re['salud_molesta_nino_haga'],
						'salud_reprende'	=>	$re['salud_reprende'],
						'salud_manera_reprender'	=>	$re['salud_manera_reprender'],
						'salud_comunica_que_siente'	=>	$re['salud_comunica_que_siente'],
						'salud_conversa_familia'	=>	$re['salud_conversa_familia'],
						'salud_tema_conversa'	=>	$re['salud_tema_conversa'],
						'salud_tiempo_solo'	=>	$re['salud_tiempo_solo'],
						'salud_cuando_nino_solo'	=>	$re['salud_cuando_nino_solo'],
						'salud_queda_nino_padre'	=>	$re['salud_queda_nino_padre'],
						'salud_queda_nino_madre'	=>	$re['salud_queda_nino_madre'],
						'salud_queda_nino_hermano'	=>	$re['salud_queda_nino_hermano'],
						'salud_queda_nino_familiar'	=>	$re['salud_queda_nino_familiar'],
						'salud_queda_nino_empleada'	=>	$re['salud_queda_nino_empleada'],
						'salud_queda_nino_otro'	=>	$re['salud_queda_nino_otro'],
						'salud_primera_vez_preescolar'	=>	$re['salud_primera_vez_preescolar'],
						'salud_asistio_maternal'	=>	$re['salud_asistio_maternal'],
						'salud_nombre_maternal'	=>	$re['salud_nombre_maternal'],
						'salud_primera_vez_maternal'	=>	$re['salud_primera_vez_maternal'],
						'salud_motivo_eleccion'	=>	$re['salud_motivo_eleccion'],
						'salud_espera_de_teresa'	=>	$re['salud_espera_de_teresa'],
						'salud_perso_autori_reti_ninho_apell'	=>	$re['salud_perso_autori_reti_ninho_apell'],
						'salud_perso_autori_reti_ninho_name'	=>	$re['salud_perso_autori_reti_ninho_name'],
						'salud_perso_autori_reti_ninho_ci'	=>	$re['salud_perso_autori_reti_ninho_ci'],
						'salud_perso_autori_reti_ninho_parent'	=>	$re['salud_perso_autori_reti_ninho_parent'],
						'salud_fecha_insc'	=>	$re['salud_fecha_insc']
					)
				);
				return $return;
			}else
				return false;
		}
		
		public function insert(array $params = null){
			if(!$params)
				if($this->method == 'POST')
					$params = $this->post;
				else
					throw new LEANGAException("No parameters found to match this action");
				
			if(!$this->user->isLogged())	
				throw new LEANGAException("You don't have the needed permissions to perform this action");	
			
			$fields = array(
	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_ANTIVARIOLICA		=>	$params['salud_vacunas_antivariolica'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_SARAMPION		=>	$params['salud_vacunas_sarampion'],
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_POLIO	=>	$params['salud_vacunas_polio'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_TRIPLE		=>	$params['salud_vacunas_triple'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_BCG	=>	$params['salud_vacunas_bcg'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_ANTITETANICA		=>	$params['salud_vacunas_antitetanica'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_NEUMOCOCO	=>	$params['salud_vacunas_neumococo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDAD_PADECE	=>	$params['salud_enfermedad_padece'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ALERGICO		=>	$params['salud_alergico'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ALERGICO_AQUE		=>	$params['salud_alergico_aque'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR	=>	$params['salud_impedimento_motor'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_PIEPLANO		=>	$params['salud_impedimento_motor_pieplano'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_COLUMNA		=>	$params['salud_impedimento_motor_columna'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_ARTICULACIONES		=>	$params['salud_impedimento_motor_articulaciones'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_OTROS		=>	$params['salud_impedimento_motor_otros'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_ESPECIALISTA	=>	$params['salud_impedimento_motor_especialista'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_TIPO	=>	$params['salud_vivienda_tipo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_N_HABITACIONES	=>	$params['salud_n_habitaciones'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_UBICACION	=>	$params['salud_vivienda_ubicacion'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_TENENCIA	=>	$params['salud_vivienda_tenencia'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_N_HERMANOS	=>	$params['salud_n_hermanos'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_HERMANOS_POSICION	=>	$params['salud_hermanos_posicion'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_N_PERSONAS_VIVE_NINO	=>	$params['salud_n_personas_vive_nino'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_GRUPO_SANGUINEO	=>	$params['salud_grupo_sanguineo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_BRONQUITIS	=>	$params['salud_enfermedades_bronquitis'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_ALERGIAS	=>	$params['salud_enfermedades_alergias'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_HEPATITIS	=>	$params['salud_enfermedades_hepatitis'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_RESFRIADOS	=>	$params['salud_enfermedades_resfriados'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_PAPERAS	=>	$params['salud_enfermedades_paperas'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_INTOXICACION	=>	$params['salud_enfermedades_intoxicacion'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_ASMA	=>	$params['salud_enfermedades_asma'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_VARICELA	=>	$params['salud_enfermedades_varicela'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_NINGUNA	=>	$params['salud_enfermedades_ninguna'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_OTRAS	=>	$params['salud_enfermedades_otras'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_DESEADO	=>	$params['salud_embarazo_deseado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_CONTROLADO	=>	$params['salud_embarazo_controlado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_ENFERMEDAD	=>	$params['salud_embarazo_enfermedad'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PARTO	=>	$params['salud_parto'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PARTO_PROBLEMA	=>	$params['salud_parto_problema'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PESO_NACER	=>	$params['salud_peso_nacer'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_TALLA_NACER	=>	$params['salud_talla_nacer'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_LACTANCIA	=>	$params['salud_lactancia'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_LACTANCIA_TIEMPO	=>	$params['salud_lactancia_tiempo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ALIMENTO_ALERGICO	=>	$params['salud_alimento_alergico'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ALIMENTO_CUAL	=>	$params['salud_alimento_cual'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_CHUPA_DEDO	=>	$params['salud_chupa_dedo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_DORMIR_BIEN	=>	$params['salud_dormir_bien'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_DORMIR_LUZ	=>	$params['salud_dormir_luz'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_DORMIR_JUGUETE	=>	$params['salud_dormir_juguete'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_BANA_SOLO_AYUDA	=>	$params['salud_bana_solo_ayuda'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_CONVULSIONADO	=>	$params['salud_convulsionado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ACCIDENTE	=>	$params['salud_accidente'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_CAMINA_BIEN	=>	$params['salud_camina_bien'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PSICOLOGO	=>	$params['salud_psicologo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PSICOLOGO_PORQUE	=>	$params['salud_psicologo_porque'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_NEUROLOGO	=>	$params['salud_neurologo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_NEUROLOGO_PORQUE	=>	$params['salud_neurologo_porque'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MEDICADO	=>	$params['salud_medicado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_TRATAMIENTO_PROLONGADO	=>	$params['salud_tratamiento_prolongado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ESCUCHA_BIEN	=>	$params['salud_escucha_bien'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_INTOXICADO	=>	$params['salud_intoxicado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_INTOXICADO_CONQUE	=>	$params['salud_intoxicado_conque'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_AYUDA_BANO	=>	$params['salud_ayuda_bano'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_OPERADO	=>	$params['salud_operado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_OPERADO_DEQUE	=>	$params['salud_operado_deque'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MEDICAMENTO_ALERGICO	=>	$params['salud_medicamento_alergico'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MEDICAMENTO_CUAL	=>	$params['salud_medicamento_cual'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VE_BIEN	=>	$params['salud_ve_bien'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ANTEOJOS	=>	$params['salud_anteojos'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_JUEGOS_GUSTAN	=>	$params['salud_juegos_gustan'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_JUEGOS_CON_QUIEN	=>	$params['salud_juegos_con_quien'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_JUEGOS_ACTITUD	=>	$params['salud_juegos_actitud'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MIEDOS	=>	$params['salud_miedos'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MIEDOS_CAUSA	=>	$params['salud_miedos_causa'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PEDIATRA_NOMBRE	=>	$params['salud_pediatra_nombre'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ACTIVIDAD_COMPLEMENTARIA	=>	$params['salud_actividad_complementaria'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ACTIVIDAD_CUAL	=>	$params['salud_actividad_cual'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MASCOTA	=>	$params['salud_mascota'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MASCOTA_CUAL	=>	$params['salud_mascota_cual'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ACTITUD_TRAVESURAS_PADRE	=>	$params['salud_actitud_travesuras_padre'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ACTITUD_TRAVESURAS_MADRE	=>	$params['salud_actitud_travesuras_madre'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MUSICA	=>	$params['salud_musica'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MUSICA_INFANTIL	=>	$params['salud_musica_infantil'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MUSICA_REGGAETON	=>	$params['salud_musica_reggaeton'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MUSICA_OTRA	=>	$params['salud_musica_otra'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_TV	=>	$params['salud_tv'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PROGRAMAS	=>	$params['salud_programas'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_HORAS_DIARIAS	=>	$params['salud_horas_diarias'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_RELIGION_FAMILIA	=>	$params['salud_religion_familia'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_RELACIONA_OTROS_NINOS	=>	$params['salud_relaciona_otros_ninos'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_BUSCA_NINO_GRANDES	=>	$params['salud_busca_nino_grandes'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MOLESTA_NINO_HAGA	=>	$params['salud_molesta_nino_haga'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_REPRENDE	=>	$params['salud_reprende'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MANERA_REPRENDER	=>	$params['salud_manera_reprender'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_COMUNICA_QUE_SIENTE	=>	$params['salud_comunica_que_siente'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_CONVERSA_FAMILIA	=>	$params['salud_conversa_familia'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_TEMA_CONVERSA	=>	$params['salud_tema_conversa'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_TIEMPO_SOLO	=>	$params['salud_tiempo_solo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_CUANDO_NINO_SOLO	=>	$params['salud_cuando_nino_solo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_PADRE	=>	$params['salud_queda_nino_padre'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_MADRE	=>	$params['salud_queda_nino_madre'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_HERMANO	=>	$params['salud_queda_nino_hermano'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_FAMILIAR	=>	$params['salud_queda_nino_familiar'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_EMPLEADA	=>	$params['salud_queda_nino_empleada'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_OTRO	=>	$params['salud_queda_nino_otro'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PRIMERA_VEZ_PREESCOLAR	=>	$params['salud_primera_vez_preescolar'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ASISTIO_MATERNAL	=>	$params['salud_asistio_maternal'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_NOMBRE_MATERNAL	=>	$params['salud_nombre_maternal'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PRIMERA_VEZ_MATERNAL	=>	$params['salud_primera_vez_maternal'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MOTIVO_ELECCION	=>	$params['salud_motivo_eleccion'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ESPERA_DE_TERESA	=>	$params['salud_espera_de_teresa'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_APELL	=>	$params['salud_perso_autori_reti_ninho_apell'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_NAME	=>	$params['salud_perso_autori_reti_ninho_name'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_CI	=>	$params['salud_perso_autori_reti_ninho_ci'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_PARENT	=>	$params['salud_perso_autori_reti_ninho_parent'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_FECHA_INSC	=>	$params['salud_fecha_insc'],		
			);
			
			$query = new Handler_SQLBuilder($this->hdb);
			$query->insert(Handler_SQLBuilder::TABLE_REGISTRO_SALUD,$fields);
			if($id = $query->commit())
				return array('e'=>0,'salud_id'=>$id);
			else
				return false;
			
		}
		
		public function get(array $params = null){
			if(!$params)
				if($this->method == 'GET')
					$params = $this->get;
				else
					throw new LEANGAException("No parameters found to match this action"); 
			
			if(!$this->user->isLogged())
				throw new LEANGAException("You don't have the needed permissions to perform this action");
			
			$query = new Handler_SQLBuilder($this->hdb);
			$query->select(Handler_SQLBuilder::TABLE_REGISTRO_SALUD);
			$filter = array_key_exists('filter',$params) ? $params['filter'] : '';
			$where = false;
			switch($filter){
				case 'i':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ID	=>	"{$params['term']}%"
						)			   
					);
					break;
				default:
					break;
			} 
			if(is_array($where))
				$query->where($where);
			$query->limit(array($params['start'],$params['max']));
			if($res = $query->commit()){
				$query = new Handler_SQLBuilder($this->hdb);
				$query->count(Handler_SQLBuilder::TABLE_REGISTRO_SALUD);
				if(is_array($where))
					$query->where($where);
				$count = $query->commit();
				$count = $count->fetch(PDO::FETCH_ASSOC);
				$count = $count['count'];
				$return = array('e'=>0,'saluds'=>array(),'total'=>$count);
				while($re = $res->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
					$return['saluds'][]=array(		
						'salud_id'	=>	$re['salud_id'],
						'salud_vacunas_antivariolica'	=>	$re['salud_vacunas_antivariolica'],
						'salud_vacunas_sarampion'		=>	$re['salud_vacunas_sarampion'],
						'salud_vacunas_polio'			=>	$re['salud_vacunas_polio'],
						'salud_vacunas_triple'			=>	$re['salud_vacunas_triple'],
						'salud_vacunas_bcg'				=>	$re['salud_vacunas_bcg'],
						'salud_vacunas_antitetanica'	=>	$re['salud_vacunas_antitetanica'],
						'salud_vacunas_neumococo'		=>	$re['salud_vacunas_neumococo'],
						'salud_enfermedad_padece'		=>	$re['salud_enfermedad_padece'],
						'salud_alergico'				=>	$re['salud_alergico'],
						'salud_alergico_aque'			=>	$re['salud_alergico_aque'],
						'salud_impedimento_motor'		=>	$re['salud_impedimento_motor'],
						'salud_impedimento_motor_pieplano'			=>	$re['salud_impedimento_motor_pieplano'],
						'salud_impedimento_motor_columna'			=>	$re['salud_impedimento_motor_columna'],
						'salud_impedimento_motor_articulaciones'	=>	$re['salud_impedimento_motor_articulaciones'],
						'salud_impedimento_motor_otros'				=>	$re['salud_impedimento_motor_otros'],
						'salud_impedimento_motor_especialista'		=>	$re['salud_impedimento_motor_especialista'],
						'salud_vivienda_tipo'			=>	$re['salud_vivienda_tipo'],
						'salud_n_habitaciones'			=>	$re['salud_n_habitaciones'],
						'salud_vivienda_ubicacion'		=>	$re['salud_vivienda_ubicacion'],
						'salud_vivienda_tenencia'		=>	$re['salud_vivienda_tenencia'],
						'salud_n_hermanos'				=>	$re['salud_n_hermanos'],
						'salud_hermanos_posicion'		=>	$re['salud_hermanos_posicion'],
						'salud_n_personas_vive_nino'	=>	$re['salud_n_personas_vive_nino'],
						'salud_grupo_sanguineo'			=>	$re['salud_grupo_sanguineo'],
						'salud_enfermedades_bronquitis'	=>	$re['salud_enfermedades_bronquitis'],
						'salud_enfermedades_alergias'	=>	$re['salud_enfermedades_alergias'],
						'salud_enfermedades_hepatitis'	=>	$re['salud_enfermedades_hepatitis'],
						'salud_enfermedades_resfriados'	=>	$re['salud_enfermedades_resfriados'],
						'salud_enfermedades_paperas'	=>	$re['salud_enfermedades_paperas'],
						'salud_enfermedades_intoxicacion'			=>	$re['salud_enfermedades_intoxicacion'],
						'salud_enfermedades_asma'		=>	$re['salud_enfermedades_asma'],
						'salud_enfermedades_varicela'	=>	$re['salud_enfermedades_varicela'],
						'salud_enfermedades_ninguna'	=>	$re['salud_enfermedades_ninguna'],
						'salud_enfermedades_otras'		=>	$re['salud_enfermedades_otras'],
						'salud_embarazo_deseado'		=>	$re['salud_embarazo_deseado'],
						'salud_embarazo_controlado'		=>	$re['salud_embarazo_controlado'],
						'salud_embarazo_enfermedad'		=>	$re['salud_embarazo_enfermedad'],
						'salud_parto'					=>	$re['salud_parto'],
						'salud_parto_problema'			=>	$re['salud_parto_problema'],
						'salud_peso_nacer'				=>	$re['salud_peso_nacer'],
						'salud_talla_nacer'				=>	$re['salud_talla_nacer'],
						'salud_lactancia'				=>	$re['salud_lactancia'],
						'salud_lactancia_tiempo'		=>	$re['salud_lactancia_tiempo'],
						'salud_alimento_alergico'		=>	$re['salud_alimento_alergico'],
						'salud_alimento_cual'			=>	$re['salud_alimento_cual'],
						'salud_chupa_dedo'				=>	$re['salud_chupa_dedo'],
						'salud_dormir_bien'				=>	$re['salud_dormir_bien'],
						'salud_dormir_luz'				=>	$re['salud_dormir_luz'],
						'salud_dormir_juguete'			=>	$re['salud_dormir_juguete'],
						'salud_bana_solo_ayuda'			=>	$re['salud_bana_solo_ayuda'],
						'salud_convulsionado'			=>	$re['salud_convulsionado'],
						'salud_accidente'				=>	$re['salud_accidente'],
						'salud_camina_bien'				=>	$re['salud_camina_bien'],
						'salud_psicologo'				=>	$re['salud_psicologo'],
						'salud_psicologo_porque'		=>	$re['salud_psicologo_porque'],
						'salud_neurologo'				=>	$re['salud_neurologo'],
						'salud_neurologo_porque'		=>	$re['salud_neurologo_porque'],
						'salud_medicado'				=>	$re['salud_medicado'],
						'salud_tratamiento_prolongado'	=>	$re['salud_tratamiento_prolongado'],
						'salud_escucha_bien'			=>	$re['salud_escucha_bien'],
						'salud_intoxicado'				=>	$re['salud_intoxicado'],
						'salud_intoxicado_conque'		=>	$re['salud_intoxicado_conque'],
						'salud_ayuda_bano'				=>	$re['salud_ayuda_bano'],
						'salud_operado'					=>	$re['salud_operado'],
						'salud_operado_deque'			=>	$re['salud_operado_deque'],
						'salud_medicamento_alergico'	=>	$re['salud_medicamento_alergico'],
						'salud_medicamento_cual'		=>	$re['salud_medicamento_cual'],
						'salud_ve_bien'					=>	$re['salud_ve_bien'],
						'salud_anteojos'				=>	$re['salud_anteojos'],
						'salud_juegos_gustan'			=>	$re['salud_juegos_gustan'],
						'salud_juegos_con_quien'		=>	$re['salud_juegos_con_quien'],
						'salud_juegos_actitud'			=>	$re['salud_juegos_actitud'],
						'salud_miedos'					=>	$re['salud_miedos'],
						'salud_miedos_causa'			=>	$re['salud_miedos_causa'],
						'salud_pediatra_nombre'			=>	$re['salud_pediatra_nombre'],
						'salud_actividad_complementaria'	=>	$re['salud_actividad_complementaria'],
						'salud_actividad_cual'			=>	$re['salud_actividad_cual'],
						'salud_mascota'					=>	$re['salud_mascota'],
						'salud_mascota_cual'			=>	$re['salud_mascota_cual'],
						'salud_actitud_travesuras_padre'	=>	$re['salud_actitud_travesuras_padre'],
						'salud_actitud_travesuras_madre'	=>	$re['salud_actitud_travesuras_madre'],
						'salud_musica'					=>	$re['salud_musica'],
						'salud_musica_infantil'			=>	$re['salud_musica_infantil'],
						'salud_musica_reggaeton'		=>	$re['salud_musica_reggaeton'],
						'salud_musica_otra'				=>	$re['salud_musica_otra'],
						'salud_tv'						=>	$re['salud_tv'],
						'salud_programas'				=>	$re['salud_programas'],
						'salud_horas_diarias'			=>	$re['salud_horas_diarias'],
						'salud_religion_familia'		=>	$re['salud_religion_familia'],
						'salud_relaciona_otros_ninos'	=>	$re['salud_relaciona_otros_ninos'],
						'salud_busca_nino_grandes'		=>	$re['salud_busca_nino_grandes'],
						'salud_molesta_nino_haga'		=>	$re['salud_molesta_nino_haga'],
						'salud_reprende'				=>	$re['salud_reprende'],
						'salud_manera_reprender'		=>	$re['salud_manera_reprender'],
						'salud_comunica_que_siente'		=>	$re['salud_comunica_que_siente'],
						'salud_conversa_familia'		=>	$re['salud_conversa_familia'],
						'salud_tema_conversa'			=>	$re['salud_tema_conversa'],
						'salud_tiempo_solo'				=>	$re['salud_tiempo_solo'],
						'salud_cuando_nino_solo'		=>	$re['salud_cuando_nino_solo'],
						'salud_queda_nino_padre'		=>	$re['salud_queda_nino_padre'],
						'salud_queda_nino_madre'		=>	$re['salud_queda_nino_madre'],
						'salud_queda_nino_hermano'		=>	$re['salud_queda_nino_hermano'],
						'salud_queda_nino_familiar'		=>	$re['salud_queda_nino_familiar'],
						'salud_queda_nino_empleada'		=>	$re['salud_queda_nino_empleada'],
						'salud_queda_nino_otro'			=>	$re['salud_queda_nino_otro'],
						'salud_primera_vez_preescolar'	=>	$re['salud_primera_vez_preescolar'],
						'salud_asistio_maternal'		=>	$re['salud_asistio_maternal'],
						'salud_nombre_maternal'			=>	$re['salud_nombre_maternal'],
						'salud_primera_vez_maternal'	=>	$re['salud_primera_vez_maternal'],
						'salud_motivo_eleccion'			=>	$re['salud_motivo_eleccion'],
						'salud_espera_de_teresa'		=>	$re['salud_espera_de_teresa'],
						'salud_perso_autori_reti_ninho_apell'	=>	$re['salud_perso_autori_reti_ninho_apell'],
						'salud_perso_autori_reti_ninho_name'	=>	$re['salud_perso_autori_reti_ninho_name'],
						'salud_perso_autori_reti_ninho_ci'		=>	$re['salud_perso_autori_reti_ninho_ci'],
						'salud_perso_autori_reti_ninho_parent'	=>	$re['salud_perso_autori_reti_ninho_parent'],
						'salud_fecha_insc'				=>	$re['salud_fecha_insc']
					);
				}
				return $return;
			}else
				return false;
		}
		
		public function update(array $params = null){
			if(!$params)
				if($this->method == 'PUT')
					$params = $this->put;
				else
					throw new LEANGAException("No parameters found to match this action");

			
			if(!$this->user->isLogged())
				throw new LEANGAException("You don't have the needed permissions to perform this action");
				
			if($client = $this->getSingle(array('filter'=>'i','term'=>$params['salud_id']))){
				
				$fields = array(
				
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_ANTIVARIOLICA		=>	$params['salud_vacunas_antivariolica'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_SARAMPION		=>	$params['salud_vacunas_sarampion'],
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_POLIO	=>	$params['salud_vacunas_polio'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_TRIPLE		=>	$params['salud_vacunas_triple'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_BCG	=>	$params['salud_vacunas_bcg'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_ANTITETANICA		=>	$params['salud_vacunas_antitetanica'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_NEUMOCOCO	=>	$params['salud_vacunas_neumococo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDAD_PADECE	=>	$params['salud_enfermedad_padece'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ALERGICO		=>	$params['salud_alergico'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ALERGICO_AQUE		=>	$params['salud_alergico_aque'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR	=>	$params['salud_impedimento_motor'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_PIEPLANO		=>	$params['hijo_ciudad'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_COLUMNA		=>	$params['salud_impedimento_motor_columna'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_ARTICULACIONES		=>	$params['salud_impedimento_motor_articulaciones'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_OTROS		=>	$params['salud_impedimento_motor_otros'],	
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_ESPECIALISTA	=>	$params['salud_impedimento_motor_especialista'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_TIPO	=>	$params['salud_vivienda_tipo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_N_HABITACIONES	=>	$params['salud_n_habitaciones'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_UBICACION	=>	$params['salud_vivienda_ubicacion'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_TENENCIA	=>	$params['salud_vivienda_tenencia'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_N_HERMANOS	=>	$params['salud_n_hermanos'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_HERMANOS_POSICION	=>	$params['salud_hermanos_posicion'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_N_PERSONAS_VIVE_NINO	=>	$params['salud_n_personas_vive_nino'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_GRUPO_SANGUINEO	=>	$params['salud_grupo_sanguineo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_BRONQUITIS	=>	$params['salud_enfermedades_bronquitis'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_ALERGIAS	=>	$params['salud_enfermedades_alergias'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_HEPATITIS	=>	$params['salud_enfermedades_hepatitis'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_RESFRIADOS	=>	$params['salud_enfermedades_resfriados'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_PAPERAS	=>	$params['salud_enfermedades_paperas'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_INTOXICACION	=>	$params['salud_enfermedades_intoxicacion'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_ASMA	=>	$params['salud_enfermedades_asma'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_VARICELA	=>	$params['salud_enfermedades_varicela'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_NINGUNA	=>	$params['salud_enfermedades_ninguna'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_OTRAS	=>	$params['salud_enfermedades_otras'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_DESEADO	=>	$params['salud_embarazo_deseado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_CONTROLADO	=>	$params['salud_embarazo_controlado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_ENFERMEDAD	=>	$params['salud_embarazo_enfermedad'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PARTO	=>	$params['salud_parto'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PARTO_PROBLEMA	=>	$params['salud_parto_problema'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PESO_NACER	=>	$params['salud_peso_nacer'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_TALLA_NACER	=>	$params['salud_talla_nacer'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_LACTANCIA	=>	$params['salud_lactancia'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_LACTANCIA_TIEMPO	=>	$params['salud_lactancia_tiempo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ALIMENTO_ALERGICO	=>	$params['salud_alimento_alergico'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ALIMENTO_CUAL	=>	$params['salud_alimento_cual'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_CHUPA_DEDO	=>	$params['salud_chupa_dedo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_DORMIR_BIEN	=>	$params['salud_dormir_bien'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_DORMIR_LUZ	=>	$params['salud_dormir_luz'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_DORMIR_JUGUETE	=>	$params['salud_dormir_juguete'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_BANA_SOLO_AYUDA	=>	$params['salud_bana_solo_ayuda'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_CONVULSIONADO	=>	$params['salud_convulsionado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ACCIDENTE	=>	$params['salud_accidente'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_CAMINA_BIEN	=>	$params['salud_camina_bien'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PSICOLOGO	=>	$params['salud_psicologo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PSICOLOGO_PORQUE	=>	$params['salud_psicologo_porque'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_NEUROLOGO	=>	$params['salud_neurologo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_NEUROLOGO_PORQUE	=>	$params['salud_neurologo_porque'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MEDICADO	=>	$params['salud_medicado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_TRATAMIENTO_PROLONGADO	=>	$params['salud_tratamiento_prolongado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ESCUCHA_BIEN	=>	$params['salud_escucha_bien'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_INTOXICADO	=>	$params['salud_intoxicado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_INTOXICADO_CONQUE	=>	$params['salud_intoxicado_conque'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_AYUDA_BANO	=>	$params['salud_ayuda_bano'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_OPERADO	=>	$params['salud_operado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_OPERADO_DEQUE	=>	$params['salud_operado_deque'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MEDICAMENTO_ALERGICO	=>	$params['salud_medicamento_alergico'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MEDICAMENTO_CUAL	=>	$params['salud_medicamento_cual'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_VE_BIEN	=>	$params['salud_ve_bien'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ANTEOJOS	=>	$params['salud_anteojos'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_JUEGOS_GUSTAN	=>	$params['salud_juegos_gustan'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_JUEGOS_CON_QUIEN	=>	$params['salud_juegos_con_quien'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_JUEGOS_ACTITUD	=>	$params['salud_juegos_actitud'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MIEDOS	=>	$params['salud_miedos'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MIEDOS_CAUSA	=>	$params['salud_miedos_causa'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PEDIATRA_NOMBRE	=>	$params['salud_pediatra_nombre'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ACTIVIDAD_COMPLEMENTARIA	=>	$params['salud_actividad_complementaria'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ACTIVIDAD_CUAL	=>	$params['salud_actividad_cual'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MASCOTA	=>	$params['salud_mascota'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MASCOTA_CUAL	=>	$params['salud_mascota_cual'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ACTITUD_TRAVESURAS_PADRE	=>	$params['salud_actitud_travesuras_padre'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ACTITUD_TRAVESURAS_MADRE	=>	$params['salud_actitud_travesuras_madre'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MUSICA	=>	$params['salud_musica'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MUSICA_INFANTIL	=>	$params['salud_musica_infantil'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MUSICA_REGGAETON	=>	$params['salud_musica_reggaeton'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MUSICA_OTRA	=>	$params['salud_musica_otra'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_TV	=>	$params['salud_tv'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PROGRAMAS	=>	$params['salud_programas'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_HORAS_DIARIAS	=>	$params['salud_horas_diarias'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_RELIGION_FAMILIA	=>	$params['salud_religion_familia'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_RELACIONA_OTROS_NINOS	=>	$params['salud_relaciona_otros_ninos'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_BUSCA_NINO_GRANDES	=>	$params['salud_busca_nino_grandes'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MOLESTA_NINO_HAGA	=>	$params['salud_molesta_nino_haga'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_REPRENDE	=>	$params['salud_reprende'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MANERA_REPRENDER	=>	$params['salud_manera_reprender'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_COMUNICA_QUE_SIENTE	=>	$params['salud_comunica_que_siente'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_CONVERSA_FAMILIA	=>	$params['salud_conversa_familia'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_TEMA_CONVERSA	=>	$params['salud_tema_conversa'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_TIEMPO_SOLO	=>	$params['salud_tiempo_solo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_CUANDO_NINO_SOLO	=>	$params['salud_cuando_nino_solo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_PADRE	=>	$params['salud_queda_nino_padre'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_MADRE	=>	$params['salud_queda_nino_madre'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_HERMANO	=>	$params['salud_queda_nino_hermano'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_FAMILIAR	=>	$params['salud_queda_nino_familiar'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_EMPLEADA	=>	$params['salud_queda_nino_empleada'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_OTRO	=>	$params['salud_queda_nino_otro'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PRIMERA_VEZ_PREESCOLAR	=>	$params['salud_primera_vez_preescolar'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ASISTIO_MATERNAL	=>	$params['salud_asistio_maternal'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_NOMBRE_MATERNAL	=>	$params['salud_nombre_maternal'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PRIMERA_VEZ_MATERNAL	=>	$params['salud_primera_vez_maternal'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_MOTIVO_ELECCION	=>	$params['salud_motivo_eleccion'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ESPERA_DE_TERESA	=>	$params['salud_espera_de_teresa'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_APELL	=>	$params['salud_perso_autori_reti_ninho_apell'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_NAME	=>	$params['salud_perso_autori_reti_ninho_name'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_CI	=>	$params['salud_perso_autori_reti_ninho_ci'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_PARENT	=>	$params['salud_perso_autori_reti_ninho_parent'],		
				Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_FECHA_INSC	=>	$params['salud_fecha_insc'],	
				);
				
				$query = new Handler_SQLBuilder($this->hdb);
				$query->update(Handler_SQLBuilder::TABLE_REGISTRO_SALUD,$fields);
				$query->where(array(
					Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
						Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ID =>	$params['salud_id']
					)
				));
				if($query->commit())
					return array('e'=>0,'salud_id'=>$params['salud_id']);
				else return false;
			}
			return false;
		}
		
		public function delete(array $params = null){
			if(!$params)
				if($this->method == 'DELETE')
					$params = $this->delete;
				else
					throw new LEANGAException("No parameters found to match this action");
			
			if(!$this->user->isAdmin())
				throw new LEANGAException("You don't have the needed permissions to perform this action");	
				
			$query = new Handler_SQLBuilder($this->hdb);
			$query->delete(Handler_SQLBuilder::TABLE_REGISTRO_SALUD);
			$query->where(array(
				Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
					Handler_SQLBuilder::TABLE_REGISTRO_SALUD_SALUD_ID =>	$params['salud_id']
				)
			));
			$query->commit();
			
			return array('e'=>0, 'salud_id'=>$params['salud_id']);
		}
		
		public function autoRun(){
			switch($this->method){
				case 'DELETE':
					return $this->delete();
				case 'GET':
					return $this->get();
				case 'POST':
					return $this->insert();
				case 'PUT':
					return $this->update();
			}
		}
		
	}
?>