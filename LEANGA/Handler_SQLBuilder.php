<?php

	namespace LEANGA;
	use LEANGA\LEANGAException;
	use LEANGA\Handler_Database;
	
	class Handler_SQLBuilder
	{
		private $sql;
		private $values;
		private $db;
		private $type;
		
		const ALL=-1;
		
		//table familia
		const TABLE_FAMILIA=1;
		const TABLE_FAMILIA_ID_FAMILIA=2;
		const TABLE_FAMILIA_ID_ESTUDIANTE=3;
		const TABLE_FAMILIA_ID_MADRE=4;
		const TABLE_FAMILIA_ID_PADRE=5;
		const TABLE_FAMILIA_ID_RL=6;
		const TABLE_FAMILIA_ID_SALUD=7;
		const TABLE_FAMILIA_REPRE_PERMISO_CEPNA=8;
		const TABLE_FAMILIA_REPRE_PQ_OTRA_PERSONA=9;
		const TABLE_FAMILIA_REPRE_PARENTESCO=10;
		const TABLE_FAMILIA_REPRE_LLAMAR_EMERGENCIA=11;
		const TABLE_FAMILIA_REPRE_TELEFONO_EMERGENCIA=12;


		//table registro_estudiante
		const TABLE_REGISTRO_ESTUDIANTE=13;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_ID=14;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_APELLIDO=15;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_NOMBRE=16;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_NACIONALIDAD=17;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_PESO=18;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_TALLA=19;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_SEXO=20;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_CEDULA_ESCOLAR=21;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_DIRECCION=22;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_TELEFONO=23;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_ESTADO=24;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_MUNICIPIO=25;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_CIUDAD=26;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_ANHO=27;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_MES=28;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_DIA=29;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_NIVEL=30;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_GRUPO=31;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_TURNO=32;
		const TABLE_REGISTRO_ESTUDIANTE_HIJO_STATUS=33;


		//table registro_representantes
		const TABLE_REGISTRO_REPRESENTANTES=34;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_ID=35;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_CI=36;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_APELLIDO=37;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_NOMBRE=38;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_NACIONALIDAD=39;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_ESTADO=40;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_MUNICIPIO=41;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_CIUDAD=42;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_FECHAN=43;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_ESTADO_CIVIL=44;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_DIRECCION=45;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_TELEFONO_CASA=46;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_CELULAR=47;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_VIVECON_HIJO=48;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_NIVEL_EDUCACION=49;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_TITULO=50;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_TRABAJO=51;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_DIRECCION_TRABAJO=52;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_TELEFONO_TRABAJO=53;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_INGRESO_MENSUAL=54;
		const TABLE_REGISTRO_REPRESENTANTES_REPRE_STATUS=55;


		//table registro_salud
		const TABLE_REGISTRO_SALUD=56;
		const TABLE_REGISTRO_SALUD_SALUD_ID=57;
		const TABLE_REGISTRO_SALUD_SALUD_VACUNAS_ANTIVARIOLICA=58;
		const TABLE_REGISTRO_SALUD_SALUD_VACUNAS_SARAMPION=59;
		const TABLE_REGISTRO_SALUD_SALUD_VACUNAS_POLIO=60;
		const TABLE_REGISTRO_SALUD_SALUD_VACUNAS_TRIPLE=61;
		const TABLE_REGISTRO_SALUD_SALUD_VACUNAS_BCG=62;
		const TABLE_REGISTRO_SALUD_SALUD_VACUNAS_ANTITETANICA=63;
		const TABLE_REGISTRO_SALUD_SALUD_VACUNAS_NEUMOCOCO=64;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDAD_PADECE=65;
		const TABLE_REGISTRO_SALUD_SALUD_ALERGICO=66;
		const TABLE_REGISTRO_SALUD_SALUD_ALERGICO_AQUE=67;
		const TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR=68;
		const TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_PIEPLANO=69;
		const TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_COLUMNA=70;
		const TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_ARTICULACIONES=71;
		const TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_OTROS=72;
		const TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_ESPECIALISTA=73;
		const TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_TIPO=74;
		const TABLE_REGISTRO_SALUD_SALUD_N_HABITACIONES=75;
		const TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_UBICACION=76;
		const TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_TENENCIA=77;
		const TABLE_REGISTRO_SALUD_SALUD_N_HERMANOS=78;
		const TABLE_REGISTRO_SALUD_SALUD_HERMANOS_POSICION=79;
		const TABLE_REGISTRO_SALUD_SALUD_N_PERSONAS_VIVE_NINO=80;
		const TABLE_REGISTRO_SALUD_SALUD_GRUPO_SANGUINEO=81;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_BRONQUITIS=82;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_ALERGIAS=83;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_HEPATITIS=84;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_RESFRIADOS=85;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_PAPERAS=86;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_INTOXICACION=87;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_ASMA=88;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_VARICELA=89;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_NINGUNA=90;
		const TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_OTRAS=91;
		const TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_DESEADO=92;
		const TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_CONTROLADO=93;
		const TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_ENFERMEDAD=94;
		const TABLE_REGISTRO_SALUD_SALUD_PARTO=95;
		const TABLE_REGISTRO_SALUD_SALUD_PARTO_PROBLEMA=96;
		const TABLE_REGISTRO_SALUD_SALUD_PESO_NACER=97;
		const TABLE_REGISTRO_SALUD_SALUD_TALLA_NACER=98;
		const TABLE_REGISTRO_SALUD_SALUD_LACTANCIA=99;
		const TABLE_REGISTRO_SALUD_SALUD_LACTANCIA_TIEMPO=100;
		const TABLE_REGISTRO_SALUD_SALUD_ALIMENTO_ALERGICO=101;
		const TABLE_REGISTRO_SALUD_SALUD_ALIMENTO_CUAL=102;
		const TABLE_REGISTRO_SALUD_SALUD_CHUPA_DEDO=103;
		const TABLE_REGISTRO_SALUD_SALUD_DORMIR_BIEN=104;
		const TABLE_REGISTRO_SALUD_SALUD_DORMIR_LUZ=105;
		const TABLE_REGISTRO_SALUD_SALUD_DORMIR_JUGUETE=106;
		const TABLE_REGISTRO_SALUD_SALUD_BANA_SOLO_AYUDA=107;
		const TABLE_REGISTRO_SALUD_SALUD_CONVULSIONADO=108;
		const TABLE_REGISTRO_SALUD_SALUD_ACCIDENTE=109;
		const TABLE_REGISTRO_SALUD_SALUD_CAMINA_BIEN=110;
		const TABLE_REGISTRO_SALUD_SALUD_PSICOLOGO=111;
		const TABLE_REGISTRO_SALUD_SALUD_PSICOLOGO_PORQUE=112;
		const TABLE_REGISTRO_SALUD_SALUD_NEUROLOGO=113;
		const TABLE_REGISTRO_SALUD_SALUD_NEUROLOGO_PORQUE=114;
		const TABLE_REGISTRO_SALUD_SALUD_MEDICADO=115;
		const TABLE_REGISTRO_SALUD_SALUD_TRATAMIENTO_PROLONGADO=116;
		const TABLE_REGISTRO_SALUD_SALUD_ESCUCHA_BIEN=117;
		const TABLE_REGISTRO_SALUD_SALUD_INTOXICADO=118;
		const TABLE_REGISTRO_SALUD_SALUD_INTOXICADO_CONQUE=119;
		const TABLE_REGISTRO_SALUD_SALUD_AYUDA_BANO=120;
		const TABLE_REGISTRO_SALUD_SALUD_OPERADO=121;
		const TABLE_REGISTRO_SALUD_SALUD_OPERADO_DEQUE=122;
		const TABLE_REGISTRO_SALUD_SALUD_MEDICAMENTO_ALERGICO=123;
		const TABLE_REGISTRO_SALUD_SALUD_MEDICAMENTO_CUAL=124;
		const TABLE_REGISTRO_SALUD_SALUD_VE_BIEN=125;
		const TABLE_REGISTRO_SALUD_SALUD_ANTEOJOS=126;
		const TABLE_REGISTRO_SALUD_SALUD_JUEGOS_GUSTAN=127;
		const TABLE_REGISTRO_SALUD_SALUD_JUEGOS_CON_QUIEN=128;
		const TABLE_REGISTRO_SALUD_SALUD_JUEGOS_ACTITUD=129;
		const TABLE_REGISTRO_SALUD_SALUD_MIEDOS=130;
		const TABLE_REGISTRO_SALUD_SALUD_MIEDOS_CAUSA=131;
		const TABLE_REGISTRO_SALUD_SALUD_PEDIATRA_NOMBRE=132;
		const TABLE_REGISTRO_SALUD_SALUD_ACTIVIDAD_COMPLEMENTARIA=133;
		const TABLE_REGISTRO_SALUD_SALUD_ACTIVIDAD_CUAL=134;
		const TABLE_REGISTRO_SALUD_SALUD_MASCOTA=135;
		const TABLE_REGISTRO_SALUD_SALUD_MASCOTA_CUAL=136;
		const TABLE_REGISTRO_SALUD_SALUD_ACTITUD_TRAVESURAS_PADRE=137;
		const TABLE_REGISTRO_SALUD_SALUD_ACTITUD_TRAVESURAS_MADRE=138;
		const TABLE_REGISTRO_SALUD_SALUD_MUSICA=139;
		const TABLE_REGISTRO_SALUD_SALUD_MUSICA_INFANTIL=140;
		const TABLE_REGISTRO_SALUD_SALUD_MUSICA_REGGAETON=141;
		const TABLE_REGISTRO_SALUD_SALUD_MUSICA_OTRA=142;
		const TABLE_REGISTRO_SALUD_SALUD_TV=143;
		const TABLE_REGISTRO_SALUD_SALUD_PROGRAMAS=144;
		const TABLE_REGISTRO_SALUD_SALUD_HORAS_DIARIAS=145;
		const TABLE_REGISTRO_SALUD_SALUD_RELIGION_FAMILIA=146;
		const TABLE_REGISTRO_SALUD_SALUD_RELACIONA_OTROS_NINOS=147;
		const TABLE_REGISTRO_SALUD_SALUD_BUSCA_NINO_GRANDES=148;
		const TABLE_REGISTRO_SALUD_SALUD_MOLESTA_NINO_HAGA=149;
		const TABLE_REGISTRO_SALUD_SALUD_REPRENDE=150;
		const TABLE_REGISTRO_SALUD_SALUD_MANERA_REPRENDER=151;
		const TABLE_REGISTRO_SALUD_SALUD_COMUNICA_QUE_SIENTE=152;
		const TABLE_REGISTRO_SALUD_SALUD_CONVERSA_FAMILIA=153;
		const TABLE_REGISTRO_SALUD_SALUD_TEMA_CONVERSA=154;
		const TABLE_REGISTRO_SALUD_SALUD_TIEMPO_SOLO=155;
		const TABLE_REGISTRO_SALUD_SALUD_CUANDO_NINO_SOLO=156;
		const TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_PADRE=157;
		const TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_MADRE=158;
		const TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_HERMANO=159;
		const TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_FAMILIAR=160;
		const TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_EMPLEADA=161;
		const TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_OTRO=162;
		const TABLE_REGISTRO_SALUD_SALUD_PRIMERA_VEZ_PREESCOLAR=163;
		const TABLE_REGISTRO_SALUD_SALUD_ASISTIO_MATERNAL=164;
		const TABLE_REGISTRO_SALUD_SALUD_NOMBRE_MATERNAL=165;
		const TABLE_REGISTRO_SALUD_SALUD_PRIMERA_VEZ_MATERNAL=166;
		const TABLE_REGISTRO_SALUD_SALUD_MOTIVO_ELECCION=167;
		const TABLE_REGISTRO_SALUD_SALUD_ESPERA_DE_TERESA=168;
		const TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_APELL=169;
		const TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_NAME=170;
		const TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_CI=171;
		const TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_PARENT=172;
		const TABLE_REGISTRO_SALUD_SALUD_FECHA_INSC=173;


		//table users
		const TABLE_USERS=174;
		const TABLE_USERS_ID=175;
		const TABLE_USERS_USER=176;
		const TABLE_USERS_NOMBRE=177;
		const TABLE_USERS_PASSWORD=178;
		const TABLE_USERS_TIPO=179;
		const TABLE_USERS_TOKEN=180;
		const TABLE_USERS_LAST_ONLINE=181;
		
		const OPERATOR_EQUAL 							=	0;
		const OPERATOR_LESS_THAN						=	1;
		const OPERATOR_MORE_THAN						=	2;
		const OPERATOR_DIFFERENT_THAN					=	3;
		const OPERATOR_LIKE								=	4;
		const OPERATOR_ASC								=	5;
		const OPERATOR_DESC								=	6;
		const OPERATOR_MORE_EQUAL_THAN					=	7;
		const OPERATOR_LESS_EQUAL_THAN					=	8;
		const OPERATOR_EXISTS							=	9;
		const OPERATOR_NOT_EXISTS						=	10;
		const OPERATOR_IN								=	11;
		const OPERATOR_NOT_IN							=	12;
		const OPERATOR_IS_NULL							=	13;
		const OPERATOR_NOT_NULL							=	14;
		
		
		public function getSQL(){
			return $this->sql;
		}
		
		public function getValues(){
			return $this->values;
		}
		
		public function __construct(Handler_Database $db) {
			$this->db=$db;
			$this->sql="";
		}
		
		protected function getOperator($operator){
			switch($operator){
				case self::OPERATOR_EQUAL:
					return '=';
				case self::OPERATOR_LESS_THAN:
					return '<';
				case self::OPERATOR_MORE_THAN:
					return '>';
				case self::OPERATOR_DIFFERENT_THAN:
					return '!=';
				case self::OPERATOR_LIKE:
					return 'LIKE';
				case self::OPERATOR_ASC:
					return 'ASC';
				case self::OPERATOR_DESC:
					return 'DESC';
				case self::OPERATOR_MORE_EQUAL_THAN:
					return '>=';
				case self::OPERATOR_LESS_EQUAL_THAN:
					return '<=';
				case self::OPERATOR_EXISTS:
					return 'EXISTS';
				case self::OPERATOR_NOT_EXISTS:
					return 'NOT EXISTS';
				case self::OPERATOR_IN:
					return 'IN';
				case self::OPERATOR_NOT_IN:
					return 'NOT IN';
				case self::OPERATOR_IS_NULL:
					return 'IS NULL';
				case self::OPERATOR_NOT_NULL:
					return 'IS NOT NULL';
				default:
					throw new LEANGAException('Unknown operator'); 
					break;
			}
		
		}
		
		protected function getFieldName($table_index){
			switch($table_index){
			case self::TABLE_FAMILIA:
			return 'familia';
			case self::TABLE_FAMILIA_ID_FAMILIA:
			return 'id_familia';
			case self::TABLE_FAMILIA_ID_ESTUDIANTE:
			return 'id_estudiante';
			case self::TABLE_FAMILIA_ID_MADRE:
			return 'id_madre';
			case self::TABLE_FAMILIA_ID_PADRE:
			return 'id_padre';
			case self::TABLE_FAMILIA_ID_RL:
			return 'id_rl';
			case self::TABLE_FAMILIA_ID_SALUD:
			return 'id_salud';
			case self::TABLE_FAMILIA_REPRE_PERMISO_CEPNA:
			return 'repre_permiso_cepna';
			case self::TABLE_FAMILIA_REPRE_PQ_OTRA_PERSONA:
			return 'repre_pq_otra_persona';
			case self::TABLE_FAMILIA_REPRE_PARENTESCO:
			return 'repre_parentesco';
			case self::TABLE_FAMILIA_REPRE_LLAMAR_EMERGENCIA:
			return 'repre_llamar_emergencia';
			case self::TABLE_FAMILIA_REPRE_TELEFONO_EMERGENCIA:
			return 'repre_telefono_emergencia';
			case self::TABLE_REGISTRO_ESTUDIANTE:
			return 'registro_estudiante';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_ID:
			return 'hijo_id';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_APELLIDO:
			return 'hijo_apellido';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_NOMBRE:
			return 'hijo_nombre';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_NACIONALIDAD:
			return 'hijo_nacionalidad';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_PESO:
			return 'hijo_peso';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_TALLA:
			return 'hijo_talla';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_SEXO:
			return 'hijo_sexo';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_CEDULA_ESCOLAR:
			return 'hijo_cedula_escolar';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_DIRECCION:
			return 'hijo_direccion';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_TELEFONO:
			return 'hijo_telefono';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_ESTADO:
			return 'hijo_estado';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_MUNICIPIO:
			return 'hijo_municipio';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_CIUDAD:
			return 'hijo_ciudad';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_ANHO:
			return 'hijo_anho';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_MES:
			return 'hijo_mes';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_DIA:
			return 'hijo_dia';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_NIVEL:
			return 'hijo_nivel';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_GRUPO:
			return 'hijo_grupo';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_TURNO:
			return 'hijo_turno';
			case self::TABLE_REGISTRO_ESTUDIANTE_HIJO_STATUS:
			return 'hijo_status';
			case self::TABLE_REGISTRO_REPRESENTANTES:
			return 'registro_representantes';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_ID:
			return 'repre_id';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_CI:
			return 'repre_ci';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_APELLIDO:
			return 'repre_apellido';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_NOMBRE:
			return 'repre_nombre';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_NACIONALIDAD:
			return 'repre_nacionalidad';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_ESTADO:
			return 'repre_estado';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_MUNICIPIO:
			return 'repre_municipio';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_CIUDAD:
			return 'repre_ciudad';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_FECHAN:
			return 'repre_fechaN';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_ESTADO_CIVIL:
			return 'repre_estado_civil';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_DIRECCION:
			return 'repre_direccion';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_TELEFONO_CASA:
			return 'repre_telefono_casa';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_CELULAR:
			return 'repre_celular';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_VIVECON_HIJO:
			return 'repre_viveCon_hijo';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_NIVEL_EDUCACION:
			return 'repre_nivel_educacion';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_TITULO:
			return 'repre_titulo';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_TRABAJO:
			return 'repre_trabajo';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_DIRECCION_TRABAJO:
			return 'repre_direccion_trabajo';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_TELEFONO_TRABAJO:
			return 'repre_telefono_trabajo';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_INGRESO_MENSUAL:
			return 'repre_ingreso_mensual';
			case self::TABLE_REGISTRO_REPRESENTANTES_REPRE_STATUS:
			return 'repre_status';
			case self::TABLE_REGISTRO_SALUD:
			return 'registro_salud';
			case self::TABLE_REGISTRO_SALUD_SALUD_ID:
			return 'salud_id';
			case self::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_ANTIVARIOLICA:
			return 'salud_vacunas_antivariolica';
			case self::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_SARAMPION:
			return 'salud_vacunas_sarampion';
			case self::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_POLIO:
			return 'salud_vacunas_polio';
			case self::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_TRIPLE:
			return 'salud_vacunas_triple';
			case self::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_BCG:
			return 'salud_vacunas_bcg';
			case self::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_ANTITETANICA:
			return 'salud_vacunas_antitetanica';
			case self::TABLE_REGISTRO_SALUD_SALUD_VACUNAS_NEUMOCOCO:
			return 'salud_vacunas_neumococo';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDAD_PADECE:
			return 'salud_enfermedad_padece';
			case self::TABLE_REGISTRO_SALUD_SALUD_ALERGICO:
			return 'salud_alergico';
			case self::TABLE_REGISTRO_SALUD_SALUD_ALERGICO_AQUE:
			return 'salud_alergico_aque';
			case self::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR:
			return 'salud_impedimento_motor';
			case self::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_PIEPLANO:
			return 'salud_impedimento_motor_pieplano';
			case self::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_COLUMNA:
			return 'salud_impedimento_motor_columna';
			case self::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_ARTICULACIONES:
			return 'salud_impedimento_motor_articulaciones';
			case self::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_OTROS:
			return 'salud_impedimento_motor_otros';
			case self::TABLE_REGISTRO_SALUD_SALUD_IMPEDIMENTO_MOTOR_ESPECIALISTA:
			return 'salud_impedimento_motor_especialista';
			case self::TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_TIPO:
			return 'salud_vivienda_tipo';
			case self::TABLE_REGISTRO_SALUD_SALUD_N_HABITACIONES:
			return 'salud_n_habitaciones';
			case self::TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_UBICACION:
			return 'salud_vivienda_ubicacion';
			case self::TABLE_REGISTRO_SALUD_SALUD_VIVIENDA_TENENCIA:
			return 'salud_vivienda_tenencia';
			case self::TABLE_REGISTRO_SALUD_SALUD_N_HERMANOS:
			return 'salud_n_hermanos';
			case self::TABLE_REGISTRO_SALUD_SALUD_HERMANOS_POSICION:
			return 'salud_hermanos_posicion';
			case self::TABLE_REGISTRO_SALUD_SALUD_N_PERSONAS_VIVE_NINO:
			return 'salud_n_personas_vive_nino';
			case self::TABLE_REGISTRO_SALUD_SALUD_GRUPO_SANGUINEO:
			return 'salud_grupo_sanguineo';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_BRONQUITIS:
			return 'salud_enfermedades_bronquitis';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_ALERGIAS:
			return 'salud_enfermedades_alergias';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_HEPATITIS:
			return 'salud_enfermedades_hepatitis';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_RESFRIADOS:
			return 'salud_enfermedades_resfriados';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_PAPERAS:
			return 'salud_enfermedades_paperas';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_INTOXICACION:
			return 'salud_enfermedades_intoxicacion';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_ASMA:
			return 'salud_enfermedades_asma';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_VARICELA:
			return 'salud_enfermedades_varicela';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_NINGUNA:
			return 'salud_enfermedades_ninguna';
			case self::TABLE_REGISTRO_SALUD_SALUD_ENFERMEDADES_OTRAS:
			return 'salud_enfermedades_otras';
			case self::TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_DESEADO:
			return 'salud_embarazo_deseado';
			case self::TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_CONTROLADO:
			return 'salud_embarazo_controlado';
			case self::TABLE_REGISTRO_SALUD_SALUD_EMBARAZO_ENFERMEDAD:
			return 'salud_embarazo_enfermedad';
			case self::TABLE_REGISTRO_SALUD_SALUD_PARTO:
			return 'salud_parto';
			case self::TABLE_REGISTRO_SALUD_SALUD_PARTO_PROBLEMA:
			return 'salud_parto_problema';
			case self::TABLE_REGISTRO_SALUD_SALUD_PESO_NACER:
			return 'salud_peso_nacer';
			case self::TABLE_REGISTRO_SALUD_SALUD_TALLA_NACER:
			return 'salud_talla_nacer';
			case self::TABLE_REGISTRO_SALUD_SALUD_LACTANCIA:
			return 'salud_lactancia';
			case self::TABLE_REGISTRO_SALUD_SALUD_LACTANCIA_TIEMPO:
			return 'salud_lactancia_tiempo';
			case self::TABLE_REGISTRO_SALUD_SALUD_ALIMENTO_ALERGICO:
			return 'salud_alimento_alergico';
			case self::TABLE_REGISTRO_SALUD_SALUD_ALIMENTO_CUAL:
			return 'salud_alimento_cual';
			case self::TABLE_REGISTRO_SALUD_SALUD_CHUPA_DEDO:
			return 'salud_chupa_dedo';
			case self::TABLE_REGISTRO_SALUD_SALUD_DORMIR_BIEN:
			return 'salud_dormir_bien';
			case self::TABLE_REGISTRO_SALUD_SALUD_DORMIR_LUZ:
			return 'salud_dormir_luz';
			case self::TABLE_REGISTRO_SALUD_SALUD_DORMIR_JUGUETE:
			return 'salud_dormir_juguete';
			case self::TABLE_REGISTRO_SALUD_SALUD_BANA_SOLO_AYUDA:
			return 'salud_bana_solo_ayuda';
			case self::TABLE_REGISTRO_SALUD_SALUD_CONVULSIONADO:
			return 'salud_convulsionado';
			case self::TABLE_REGISTRO_SALUD_SALUD_ACCIDENTE:
			return 'salud_accidente';
			case self::TABLE_REGISTRO_SALUD_SALUD_CAMINA_BIEN:
			return 'salud_camina_bien';
			case self::TABLE_REGISTRO_SALUD_SALUD_PSICOLOGO:
			return 'salud_psicologo';
			case self::TABLE_REGISTRO_SALUD_SALUD_PSICOLOGO_PORQUE:
			return 'salud_psicologo_porque';
			case self::TABLE_REGISTRO_SALUD_SALUD_NEUROLOGO:
			return 'salud_neurologo';
			case self::TABLE_REGISTRO_SALUD_SALUD_NEUROLOGO_PORQUE:
			return 'salud_neurologo_porque';
			case self::TABLE_REGISTRO_SALUD_SALUD_MEDICADO:
			return 'salud_medicado';
			case self::TABLE_REGISTRO_SALUD_SALUD_TRATAMIENTO_PROLONGADO:
			return 'salud_tratamiento_prolongado';
			case self::TABLE_REGISTRO_SALUD_SALUD_ESCUCHA_BIEN:
			return 'salud_escucha_bien';
			case self::TABLE_REGISTRO_SALUD_SALUD_INTOXICADO:
			return 'salud_intoxicado';
			case self::TABLE_REGISTRO_SALUD_SALUD_INTOXICADO_CONQUE:
			return 'salud_intoxicado_conque';
			case self::TABLE_REGISTRO_SALUD_SALUD_AYUDA_BANO:
			return 'salud_ayuda_bano';
			case self::TABLE_REGISTRO_SALUD_SALUD_OPERADO:
			return 'salud_operado';
			case self::TABLE_REGISTRO_SALUD_SALUD_OPERADO_DEQUE:
			return 'salud_operado_deque';
			case self::TABLE_REGISTRO_SALUD_SALUD_MEDICAMENTO_ALERGICO:
			return 'salud_medicamento_alergico';
			case self::TABLE_REGISTRO_SALUD_SALUD_MEDICAMENTO_CUAL:
			return 'salud_medicamento_cual';
			case self::TABLE_REGISTRO_SALUD_SALUD_VE_BIEN:
			return 'salud_ve_bien';
			case self::TABLE_REGISTRO_SALUD_SALUD_ANTEOJOS:
			return 'salud_anteojos';
			case self::TABLE_REGISTRO_SALUD_SALUD_JUEGOS_GUSTAN:
			return 'salud_juegos_gustan';
			case self::TABLE_REGISTRO_SALUD_SALUD_JUEGOS_CON_QUIEN:
			return 'salud_juegos_con_quien';
			case self::TABLE_REGISTRO_SALUD_SALUD_JUEGOS_ACTITUD:
			return 'salud_juegos_actitud';
			case self::TABLE_REGISTRO_SALUD_SALUD_MIEDOS:
			return 'salud_miedos';
			case self::TABLE_REGISTRO_SALUD_SALUD_MIEDOS_CAUSA:
			return 'salud_miedos_causa';
			case self::TABLE_REGISTRO_SALUD_SALUD_PEDIATRA_NOMBRE:
			return 'salud_pediatra_nombre';
			case self::TABLE_REGISTRO_SALUD_SALUD_ACTIVIDAD_COMPLEMENTARIA:
			return 'salud_actividad_complementaria';
			case self::TABLE_REGISTRO_SALUD_SALUD_ACTIVIDAD_CUAL:
			return 'salud_actividad_cual';
			case self::TABLE_REGISTRO_SALUD_SALUD_MASCOTA:
			return 'salud_mascota';
			case self::TABLE_REGISTRO_SALUD_SALUD_MASCOTA_CUAL:
			return 'salud_mascota_cual';
			case self::TABLE_REGISTRO_SALUD_SALUD_ACTITUD_TRAVESURAS_PADRE:
			return 'salud_actitud_travesuras_padre';
			case self::TABLE_REGISTRO_SALUD_SALUD_ACTITUD_TRAVESURAS_MADRE:
			return 'salud_actitud_travesuras_madre';
			case self::TABLE_REGISTRO_SALUD_SALUD_MUSICA:
			return 'salud_musica';
			case self::TABLE_REGISTRO_SALUD_SALUD_MUSICA_INFANTIL:
			return 'salud_musica_infantil';
			case self::TABLE_REGISTRO_SALUD_SALUD_MUSICA_REGGAETON:
			return 'salud_musica_reggaeton';
			case self::TABLE_REGISTRO_SALUD_SALUD_MUSICA_OTRA:
			return 'salud_musica_otra';
			case self::TABLE_REGISTRO_SALUD_SALUD_TV:
			return 'salud_tv';
			case self::TABLE_REGISTRO_SALUD_SALUD_PROGRAMAS:
			return 'salud_programas';
			case self::TABLE_REGISTRO_SALUD_SALUD_HORAS_DIARIAS:
			return 'salud_horas_diarias';
			case self::TABLE_REGISTRO_SALUD_SALUD_RELIGION_FAMILIA:
			return 'salud_religion_familia';
			case self::TABLE_REGISTRO_SALUD_SALUD_RELACIONA_OTROS_NINOS:
			return 'salud_relaciona_otros_ninos';
			case self::TABLE_REGISTRO_SALUD_SALUD_BUSCA_NINO_GRANDES:
			return 'salud_busca_nino_grandes';
			case self::TABLE_REGISTRO_SALUD_SALUD_MOLESTA_NINO_HAGA:
			return 'salud_molesta_nino_haga';
			case self::TABLE_REGISTRO_SALUD_SALUD_REPRENDE:
			return 'salud_reprende';
			case self::TABLE_REGISTRO_SALUD_SALUD_MANERA_REPRENDER:
			return 'salud_manera_reprender';
			case self::TABLE_REGISTRO_SALUD_SALUD_COMUNICA_QUE_SIENTE:
			return 'salud_comunica_que_siente';
			case self::TABLE_REGISTRO_SALUD_SALUD_CONVERSA_FAMILIA:
			return 'salud_conversa_familia';
			case self::TABLE_REGISTRO_SALUD_SALUD_TEMA_CONVERSA:
			return 'salud_tema_conversa';
			case self::TABLE_REGISTRO_SALUD_SALUD_TIEMPO_SOLO:
			return 'salud_tiempo_solo';
			case self::TABLE_REGISTRO_SALUD_SALUD_CUANDO_NINO_SOLO:
			return 'salud_cuando_nino_solo';
			case self::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_PADRE:
			return 'salud_queda_nino_padre';
			case self::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_MADRE:
			return 'salud_queda_nino_madre';
			case self::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_HERMANO:
			return 'salud_queda_nino_hermano';
			case self::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_FAMILIAR:
			return 'salud_queda_nino_familiar';
			case self::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_EMPLEADA:
			return 'salud_queda_nino_empleada';
			case self::TABLE_REGISTRO_SALUD_SALUD_QUEDA_NINO_OTRO:
			return 'salud_queda_nino_otro';
			case self::TABLE_REGISTRO_SALUD_SALUD_PRIMERA_VEZ_PREESCOLAR:
			return 'salud_primera_vez_preescolar';
			case self::TABLE_REGISTRO_SALUD_SALUD_ASISTIO_MATERNAL:
			return 'salud_asistio_maternal';
			case self::TABLE_REGISTRO_SALUD_SALUD_NOMBRE_MATERNAL:
			return 'salud_nombre_maternal';
			case self::TABLE_REGISTRO_SALUD_SALUD_PRIMERA_VEZ_MATERNAL:
			return 'salud_primera_vez_maternal';
			case self::TABLE_REGISTRO_SALUD_SALUD_MOTIVO_ELECCION:
			return 'salud_motivo_eleccion';
			case self::TABLE_REGISTRO_SALUD_SALUD_ESPERA_DE_TERESA:
			return 'salud_espera_de_teresa';
			case self::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_APELL:
			return 'salud_perso_autori_reti_ninho_apell';
			case self::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_NAME:
			return 'salud_perso_autori_reti_ninho_name';
			case self::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_CI:
			return 'salud_perso_autori_reti_ninho_ci';
			case self::TABLE_REGISTRO_SALUD_SALUD_PERSO_AUTORI_RETI_NINHO_PARENT:
			return 'salud_perso_autori_reti_ninho_parent';
			case self::TABLE_REGISTRO_SALUD_SALUD_FECHA_INSC:
			return 'salud_fecha_insc';
			case self::TABLE_USERS:
			return 'users';
			case self::TABLE_USERS_ID:
			return 'id';
			case self::TABLE_USERS_USER:
			return 'user';
			case self::TABLE_USERS_NOMBRE:
			return 'nombre';
			case self::TABLE_USERS_PASSWORD:
			return 'password';
			case self::TABLE_USERS_TIPO:
			return 'tipo';
			case self::TABLE_USERS_TOKEN:
			return 'token';
			case self::TABLE_USERS_LAST_ONLINE:
			return 'last_online';
				case self::ALL:
				return '*';
				default:
					throw new LEANGAException("Unknown field index");
			}
		}
		
		
		public function addOr($clauses, $as = ''){
			$this->sql.=' OR ';
			$steps=Array();
			if($as)
				$as.=".";
			
			foreach($clauses as $type=>$clause)
				foreach($clause as $column=>$value){
					$step = "$as{$this->getFieldName($column)} {$this->getOperator($type)} ";
					if($value instanceof Handler_SQLBuilder)
						$step .= "({$value->getSQL()})";
					else
						$step .= "{$this->db->quote($value)}";
					$steps[]=$step;
				}
			$this->sql.=implode(' OR ',$steps);
		}

		public function where($clauses, $as = ''){
			$this->sql.=' WHERE ';
			$steps=Array();
			if($as)
				$as.=".";
			
			foreach($clauses as $type=>$clause)
				foreach($clause as $column=>$value){
					$step = "$as{$this->getFieldName($column)} {$this->getOperator($type)} ";
					if($value instanceof Handler_SQLBuilder)
						$step .= "({$value->getSQL()})";
					else{
						if($value)
							$value = $this->db->quote($value);
						$step .= "$value";}
					$steps[]=$step;
				}
			$this->sql.=implode(' AND ',$steps);
		}
		
		public function order(array $order, $as = ''){
			if($as)
				$as.=".";
			$this->sql.=" ORDER BY $as{$this->getFieldName($order[0])} {$this->getOperator($order[1])}";
		}	
		
		public function limit(array $limit){
			if(is_numeric($limit[0]) && is_numeric($limit[1]))
				$this->sql.=" LIMIT {$limit[0]}, {$limit[1]}";
		}
		
		public function rightJoin($table_index, $on, $target, $as = 'b'){
			$table=$this->getFieldName($table_index);
			$this->sql.=" RIGHT JOIN $table AS $as ON ";
			$steps=Array();
			foreach($on as $type=>$clause)
				foreach($clause as $column=>$value){
					$steps[] = "$as.{$this->getFieldName($column)} {$this->getOperator($type)} $target.{$this->getFieldName($value)}";
				}
			$this->sql.=implode(' AND ',$steps);
		}
		
		public function leftJoin($table_index, $on, $target, $as = 'c'){
			$table=$this->getFieldName($table_index);
			$this->sql.=" LEFT JOIN $table AS $as ON ";
			$steps=Array();
			foreach($on as $type=>$clause)
				foreach($clause as $column=>$value){
					$steps[] = "$as.{$this->getFieldName($column)} {$this->getOperator($type)} $target.{$this->getFieldName($value)}";
				}
			$this->sql.=implode(' AND ',$steps);
		}
		  
		public function count($table_index){
			$this->type = 0;
			$table=$this->getFieldName($table_index);
			$this->sql.="SELECT COUNT(*) as count FROM $table";
		}  
		  
		public function select($table_index, $columns = '*', $as = 'a'){
			$this->type = 0;
			$table=$this->getFieldName($table_index);
			$this->sql.='SELECT ';
			if(is_array($columns)){
				$cols = array();
				foreach($columns as $key=>$col){
					$key = !is_numeric($key) ? $key : $as;
					if(is_array($col)){
						foreach($col as $cokey => $co){
							if(is_numeric($co))
								$cols[]	= $key . '.' . $this->getFieldName($co);
							else
								$cols[]	= $key . '.' . $this->getFieldName($cokey) . ' AS $co' . $this->getFieldName($cokey);
						}
					}else
						$cols[]	= $key .'.'. $this->getFieldName($col);
				}
				$this->sql.=implode(',',$cols);
			}else
				$this->sql.="$as.$columns";
			$this->sql.=" FROM $table AS $as";
		}
		
		public function update($table_index,array $fields){
			$this->type = 2;
			$table=$this->getFieldName($table_index);
			$field=array();
			$values=array();
			$valuep=array();
			foreach($fields as $key=>$val){
				$field[]=$this->getFieldName($key).' = ? ';
				$values[]=$val;
			}
			unset($key);unset($val);
			$field=implode(',',$field);
			$this->sql.="UPDATE $table SET $field";
			$this->values = array_values($values);
		}
		
		public function delete($table_index){
			$this->type = 3;
			$table=$this->getFieldName($table_index);
			$this->sql.="DELETE FROM $table";
		}
		
		public function insert($table_index,$fields=array(),$return_id=false){
			$this->type = 1;
			$table=$this->getFieldName($table_index);
			$field=array();
			$values=array();
			$valuep=array();
			foreach($fields as $key=>$val){
				$field[]=$this->getFieldName($key);
				$values[]=$val;
				$valuep[]=' ? ';
			}
			unset($key);unset($val);
			$field=implode(',',$field);
			$valuep=implode(',',$valuep);
			$this->sql="INSERT INTO $table ($field) VALUES ($valuep)";
			$this->values = array_values($values);
		}
		
		public function commit(){
			switch($this->type){
				case 0:
					return $this->db->selectTable($this);
					break;
				case 1:
					return $this->db->insertTable($this);
					break;
				case 2:
					return $this->db->updateTable($this);
					break;
				case 3:
					return $this->db->deleteTable($this);
					break;
			}
		
		}

	}
?>