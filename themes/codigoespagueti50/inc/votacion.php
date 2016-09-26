<?php

	/**
	 * Crear tabla en la base de datos
	 */
	add_action('init', function(){
		global $wpdb;
		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}votes (
				vote_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				post_id BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
				vote_value INT(20) UNSIGNED NOT NULL DEFAULT '0',
				user_ip varchar(40) DEFAULT NULL,
				vote_date timestamp DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (vote_id),
				KEY post_id (post_id)
			)DEFAULT CHARSET=utf8;"
		);
	});


	/**
	 * Valida que el numero sea un entero del 0 al 10
	 * @return boolean
	 */
	function is_vote_valid($value){
		$value = intval($value, 10);
		return ( $value <= 10 and $value >= 0 );
	}


	/**
	 * Ajax que guarda el voto del usuario en la base de datos
	 * @param  value:   $_POST['value']
	 * @param  post_id: $_POST['post_id']
	 * @return post_id or false
	 */
	function mq_save_vote_data(){

		$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : '';
		$value   = isset($_POST['value']) ? $_POST['value'] : '';

		// validar data
		if ( !$post_id and !is_vote_valid($value) ) {
			echo json_encode(false); exit;
		}

		// validar cookie
		if( !isset($_COOKIE['valueFor_'.$post_id]) ){
			setcookie('valueFor_'.$post_id, 1, time()+3600, '/', $_SERVER['HTTP_HOST']);
			$result = add_new_vote($post_id, $value); // guardar datos
			echo json_encode($result);
		}else{
			echo json_encode(false);
		}
		exit;

	}
	add_action('wp_ajax_mq_save_vote_data', 'mq_save_vote_data');
	add_action('wp_ajax_nopriv_mq_save_vote_data', 'mq_save_vote_data');


	/**
	 * Regresa el promedio de todos los votos
	 * @param  post_id
	 * @return rating: Promedio de todos los votos |  NULL si no encuentra resultados
	 */
	function get_vote_data($post_id){
		global $wpdb;
		$data = get_transient( 'vote_data' );

		if($data !== false) return $data;

		$data = $wpdb->get_var($wpdb->prepare(
			"SELECT ROUND(AVG(vote_value), 1) AS rating FROM {$wpdb->prefix}votes WHERE post_id = %d;",
			esc_sql($post_id)
		));

		set_transient( 'vote_data', $data, 600 );

		return $data;
	}


	/**
	 * Insertar en la base de datos
	 * @param $post_id
	 * @param $value
	 * @return
	 */
	function add_new_vote($post_id, $value){
		global $wpdb;
		$user_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		return $wpdb->query(
			$wpdb->prepare(
				"INSERT INTO {$wpdb->prefix}votes ( post_id, vote_value, user_ip )
					VALUES ( %d, %d, %s )",
						$wpdb->escape($post_id),
						$wpdb->escape($value),
						$wpdb->escape($user_ip)
			)
		);
	}