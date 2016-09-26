<?php

	add_action('wp', function(){
		define('SAVEQUERIES', true);
	});

	// Definir el paths a los directorios de javascript y css
	define( 'JSPATH', get_template_directory_uri() . '/js/' );
	define( 'CSSPATH', get_template_directory_uri() . '/css/' );
	define( 'THEMEPATH', get_template_directory_uri() . '/' );
	$ids_post = array();

// IMAGE SUPPORT /////////////////////////////////////////////////////////////////////

	add_theme_support( 'post-thumbnails' );
	add_image_size('featured', 640, 360, true);
	add_image_size('featured_post', 300, 250, true);
	add_image_size('slide', 980, 360, true);
	add_image_size('ficha_imagen', 136, 250, true);
	add_image_size('poster-post', 135, 165);

// POST TYPES, PAGES  && METABOXES ///////////////////////////////////////////////////////////

	require_once('inc/metaboxes.php');

	require_once('inc/post-types.php');

	require_once('inc/pages.php');

// SISTEMA DE VOTACION ////////////////////////////////////////////////////////////////

	require_once('inc/votacion.php');

// SISTEMA FAVORITOS //////////////////////////////////////////////////////////////////

	require_once('inc/favoritos.php');

// ENQUEUE FRONT END JAVASCRIPT AND CSS //////////////////////////////////////////////



	add_action( 'wp_enqueue_scripts', function(){

		// scripts
		wp_enqueue_script('jquery-ui-slider'); // Default wordpress jQuery-ui-slider
		// wp_enqueue_script('cycle', JSPATH.'cycle.js', array('jquery'), false, true );
		wp_enqueue_script('plugins', JSPATH.'plugins.js', array('jquery', 'jquery-ui-slider'), false, true );
		wp_enqueue_script('functions', JSPATH.'functions.js', array('plugins'), false, true );
		wp_enqueue_script('lastest', JSPATH.'jquery-latest.js', array('jquery'), false, true );
		if(is_single()){
			wp_localize_script('functions', 'postUploads', postUploads() );
		}

		// styles
		wp_enqueue_style('jquery-ui-css', CSSPATH.'jquery-ui.css');
		wp_enqueue_style('style', get_stylesheet_uri());


		// localize scripts
		wp_localize_script( 'functions', 'ajax_url', admin_url('admin-ajax.php') );
		//wp_localize_script( 'functions', 'is_single', is_single() );

	});


// ADMIN SCRIPTS AND STYLES //////////////////////////////////////////////////////////



	// Admin scripts and styles
	add_action( 'admin_enqueue_scripts', function(){

		// scripts
		wp_enqueue_script('media-upload');
		wp_enqueue_script('admin-js', get_template_directory_uri().'/js/admin.js',  array('jquery'), '1.0', true );

		wp_enqueue_style('admin', CSSPATH.'admin.css');

		// localize scripts
		wp_localize_script('admin-js', 'ajax_url', get_bloginfo('wpurl').'/wp-admin/admin-ajax.php');

		wp_enqueue_media(); // Enqueues all scripts, styles, settings, and templates necessary to use all media JavaScript APIs.

	});



// CONTEO DE PALABRAS EN EL EXCERPT //////////////////////////////////////////////////



	function custom_excerpt_length( $length ) {
		return 20;
	}

	add_filter( 'excerpt_length', 'custom_excerpt_length', 10 );


	add_filter('the_excerpt', function($excerpt){
		return strip_tags($excerpt);
	});


	add_filter('excerpt_more', function($more){
		return '... &raquo;';
	});



// CAMBIAR EL CONTENIDO DEL FOOTER EN EL DASHBOARD ///////////////////////////////////



	add_filter('notadmin_footer_text', function() {
		echo 'Creado por <a href="http://hacemoscodigo.com">Los Maquiladores</a>. ';
		echo 'Powered by <a href="http://www.wordpress.org">WordPress</a>';
	});



// RSS FEED IMAGES ///////////////////////////////////////////////////////////////////


/*
	add_theme_support( 'automatic-feed-links' );


	add_action('rss2_ns', function (){
		echo "xmlns:media='http://search.yahoo.com/mrss/'";
	});


	add_filter('rss2_item', function() use (&$post) {

		$thumbnail_id = get_post_thumbnail_id($post->ID);

		if ($thumbnail_id ) {
			$attachment_url = wp_get_attachment_url($thumbnail_id);
			$attributes     = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );
			$attachment_url = isset($attributes[0]) ? $attributes[0] : '';
			echo "<media:content url='$attachment_url' medium='image' />";
		}

	});*/



// TWITTER //////////////////////////////////////////////////////////////////////////



	require_once('inc/twitter/twitteroauth.php');


	define('CONSUMER_KEY', 'MNcYnXlaV9bdqVe7yBGKA');
	define('CONSUMER_SECRET', 'pCLBPDRdlDH9fmEcocmnKWQA6Ftu4gGPUKgikG0');
	define('OAUTH_CALLBACK', 'https://codigoespagueti.com');


	/**
	 * Twitter User Timeline
	 */
	function get_transient_tweet(){
		$result = get_transient('tweet_content');

		if( !$result ){
			$connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, '1362435139-4xBJPalvmW1UNIJ9ksbjQGfZHLAefncFZDjXKqt', 'rn9q4SJT5aHiBx51LbZkzHfJmelmNznaHsaqgjr1kM' );
			$result = $connection->get( 'statuses/user_timeline', array('count'=>10) );
			set_transient( 'tweet_content', $result, 900 );
			return $result;
		}else{
			return $result;
		}
	}



	/**
	 * Twitter Mentions
	 */
	function get_tweet_mentions(){
		$result = get_transient('tweet_mentions_footer');

		if( !$result ){
			$connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, '1362435139-4xBJPalvmW1UNIJ9ksbjQGfZHLAefncFZDjXKqt', 'rn9q4SJT5aHiBx51LbZkzHfJmelmNznaHsaqgjr1kM' );
			$tweets = $connection->get( 'statuses/mentions_timeline', array('count'=>5) );
			set_transient( 'tweet_mentions_footer', $tweets, 900 );
			return $tweets;
		}else{
			return $result;
		}
	}


	function get_featured_post(){
		global $page, $wpdb;

		if ( $page == 1 AND $post = get_post($wpdb->featured_post) )
			return $post;
		else
			return false;
	}

	function get_featured_post_resenas(){
		global $page, $wpdb;

		if ( $page == 1 AND $post = get_post($wpdb->featured_post_type) )
			return $post;
		else
			return false;
	}


// MODIFICAR EL MAIN QUERY ///////////////////////////////////////////////////////////



	add_action( 'pre_get_posts', function($query){

		if ( $query->is_main_query() and ! is_admin() ) {

			// ...
			if ( is_category() ){
				$objeto = get_queried_object();
				$featured = get_featured_category_post($objeto->slug);
				if ( $featured ) $query->set( 'post__not_in', array($featured) );
			}

			// ...
			if ( is_post_type_archive('resenas') ){
				$featured_type = get_featured_posttype_post('resenas');
				if ( $featured_type ) $query->set( 'post__not_in', array($featured_type) );
			}

			if (is_home()) {

				// // setHomePosts();

				// global $featured_posts;

				// $query->set( 'post_type', 'post' );
				// $query->set( 'posts_per_page', 7 );
				// $query->set( 'meta_key', 'grid_home' );
				// $query->set( 'meta_value', 'true' );
				// $query->set( 'post__not_in', $featured_posts );

			}

			// ...
			/*if ( $query->is_feed )
				set_query_rss_sopitas($query);*/

		}

		return $query;

	});






	/**
	 * [$exlude_from_sidebar description]
	 * @var array
	 */
	$exlude_from_sidebar = array();

	add_action('wp', function(){
		global $wp_query, $exlude_from_sidebar;
		$exlude_from_sidebar = @wp_list_pluck($wp_query->posts, 'ID');
	});






	/**
	 * Toma los posts que tengan el meta_key: '_rss_sopitas_meta'
	 * @param $query
	 */
	function set_query_rss_sopitas( & $query){
		$meta_query = array(array(
			'key'     => '_rss_sopitas_meta',
			'value'   => 'true',
			'compare' => '='
		));

		$query->set( 'meta_query', $meta_query );
		$query->set( 'meta_key', '_rss_sopitas_meta' );
		$query->set( 'post_type', array('post', 'resenas', 'videos', 'leyendo') );
	}





// HELPER FUNCTIONS //////////////////////////////////////////////////////////////////


	function print_post_terms($id_post){
		$categories = get_the_category($id_post);
		$separator = ' - ';
		$output = '';
		$count = 1;
		if( $categories ){
			foreach( $categories as $category ) {
				if ($category->cat_name != 'Noticias') {
					if ($count == 1) {
						echo ' | ';
						$count++;
					}
					$output .= '<a href="'.get_category_link( $category->term_id ).'" target="_parent" >'.$category->cat_name.'</a>'.$separator;
				}



			}
		echo trim($output, $separator);
		}
	}


	function print_post_terms_caja($id_post){
		$categories = get_the_category($id_post);
		$separator = ' - ';
		$output = '';
		$count = 1;
		if( $categories ){
			foreach( $categories as $category ) {
				if ($category->cat_name != 'Noticias') {
					$output .= $category->cat_name .' '.$separator;
				}



			}
		echo trim($output, $separator);
		}
	}

	function get_category_block($id_post){
		$categories = get_the_category($id_post);
		$separator = ' - ';
		$output = '';
		$count = 1;
		if( $categories ){
			foreach( $categories as $category ) {
				if ($category->cat_name != 'Noticias') {
					$output .= $category->cat_name .' '.$separator;
				}



			}

		
		echo trim($output, $separator);
		}
	}


	/**
	 * Regresa el featured posts o false si no existe
	 *
	 * @return Mixed Featured post ID or false
	 */
	function get_featured_category_post($slug){
		global $wpdb;
		$wpdb->featured_post = $wpdb->get_var(
			"SELECT p.ID FROM $wpdb->posts AS p
				INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id
				INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id
				INNER JOIN $wpdb->term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
				INNER JOIN $wpdb->terms AS t ON t.term_id = tt.term_id
					WHERE p.post_status = 'publish' AND t.slug = '$slug'
						AND pm.meta_key = 'cat_top_home' AND pm.meta_value = 'true'
							ORDER BY p.post_date DESC LIMIT 1;"
		);
		return $wpdb->featured_post;
	}

	/**
	 * Regresa el featured posts o false si no existe POST-TYPE RESEÑAS
	 *
	 * @return Mixed Featured post ID or false
	 */
	function get_featured_posttype_post($type){
		global $wpdb;
		$wpdb->featured_post_type = $wpdb->get_var(
			"SELECT p.ID FROM $wpdb->posts AS p
					INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id
						WHERE p.post_status = 'publish' AND p.post_type = '$type'
							AND pm.meta_key = 'cat_top_home' AND pm.meta_value = 'true'
								ORDER BY p.post_date DESC LIMIT 1;"
		);
		return $wpdb->featured_post_type;
	}


	/**
	 * paginacion archives
	 * @return [string]
	 */
	function print_pagination(){
		global $wp_query;
		$big  = 999999999; // need an unlikely integer
		$args = array(
			'base'      => str_replace( $big, '%#%', esc_url(get_pagenum_link($big)) ),
			'format'    => '?page=%#%',
			'total'     => $wp_query->max_num_pages,
			'current'   => max( 1, get_query_var('paged') ),
			'show_all'  => false,
			'end_size'  => 5,
			'mid_size'  => 2,
			'type'      => 'list',
			'prev_next' => true,
			'prev_text' => __('&raquo; Anterior |'),
			'next_text' => __('| &laquo; Siguiente'),
		);
		echo paginate_links($args);
	}


	/**
	 * Convierte las url's y @ mentions en links
	 */
	function parseLinks($text) {
		$pattern = "/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i";
		$replace = "<a href='$1' target='_blank' rel='nofollow'>$1</a>";
		$links   = preg_replace($pattern, $replace, $text);

		$pattern = '/@([a-zA-Z0-9_]+)/';
		$replace = '<a href="http://twitter.com/$1">@$1</a>';
		$result  = preg_replace($pattern, $replace, $links);

		return $result;
	}



	/**
	 * Regresa el tiempo desde que se creo el tweet
	 */
	function parseTweetDate($fecha){
		$segundos = time() - strtotime($fecha);
		$transcurrido = $segundos/60;

		if($transcurrido <= 59){
			return round($transcurrido).'min';
		}else if($transcurrido >= 60 and $transcurrido <= 2599){
			return round($transcurrido/60).'hr';
		}else if($transcurrido >= 3600){
			return round($transcurrido/3600).'días';
		}
	}



	function format_twitter_mention_data($mention) {

		$tweet = new stdClass;
		$tweet->user = parseLinks( '@'.$mention->user->screen_name );
		$tweet->name = $mention->user->name;
		$tweet->time = parseTweetDate($mention->created_at);
		$tweet->text = parseLinks($mention->text);

		return $tweet;
	}

	/**
	 * Crea metadata 'imagen-resena'
	 *
	 * @param attachment
	 * @return imagen
	 */
	function save_imagen_ficha_tecnica(){
		$attachment = ( isset($_POST['attachment']) ) ? $_POST['attachment'] : false;
		$post_id    = ( isset($_POST['post_id']) ) ? $_POST['post_id'] : false;

		if( !$attachment or !$post_id ){
			echo json_encode('error');
			exit;
		}

		// guardar la url como metadata del post
		$imagen = wp_get_attachment_image( $attachment['id'], 'ficha_imagen' );
		update_post_meta($post_id, 'imagen-resena', $imagen);

		echo json_encode($imagen);
		exit;
	}
	add_action('wp_ajax_save_imagen_ficha_tecnica', 'save_imagen_ficha_tecnica');
	add_action('wp_ajax_nopriv_save_imagen_ficha_tecnica', 'save_imagen_ficha_tecnica');



	/**
	 * BORRA metadata 'imagen-resena'
	 * @param post_id
	 * @return BOOLEAN False for failure. True for success.
	 */
	function delete_imagen_ficha_tecnica(){

		$post_id  = ( isset($_POST['post_id']) ) ? $_POST['post_id'] : false;

		if( !$post_id ){
			echo json_encode('error');
			exit;
		}

		$result = delete_post_meta($post_id, 'imagen-resena');
		echo json_encode($result);
		exit;
	}
	add_action('wp_ajax_delete_imagen_ficha_tecnica', 'delete_imagen_ficha_tecnica');
	add_action('wp_ajax_nopriv_delete_imagen_ficha_tecnica', 'delete_imagen_ficha_tecnica');


	/**
	 * Guarda la metadata del RSS de sopitas
	 */
	function ajax_update_post_meta(){
		$post_id  = ( isset($_POST['post_id']) ) ? $_POST['post_id'] : false;
		$checked  = ( isset($_POST['checked']) ) ? $_POST['checked'] : false;

		if ( $checked == 'true' ){
			update_post_meta($post_id, '_rss_sopitas_meta', 'true');
		}else{
			delete_post_meta($post_id, '_rss_sopitas_meta');
		}
	}
	add_action('wp_ajax_ajax_update_post_meta', 'ajax_update_post_meta');
	add_action('wp_ajax_nopriv_ajax_update_post_meta', 'ajax_update_post_meta');


	/*
	---------------------
		LIMIT WORDS
	---------------------
	*/

	function string_limit_words($string, $word_limit){
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  array_pop($words);
	  return implode(' ', $words);
	}



/// REWRITE AUTHOR BASE URL  //////////////////////////////////////////////////////



	function custom_author_base(){
		global $wp_rewrite;
		$wp_rewrite->author_base = 'colaborador';
	}

	add_action('init', 'custom_author_base', 0 );




// PAGINACIÓN ////////////////////////////////////////////////////////////////////



	function remove_page_from_query_string($query_string) {
		if ( isset($query_string['name']) && $query_string['name'] == 'page' && isset($query_string['page'])) {
			unset($query_string['name']);
			// 'page' in the query_string looks like '/2', so split it out
			list($delim, $page_index) = explode('/', $query_string['page']);
			$query_string['paged'] = $page_index;
		}
		return $query_string;
	}
	add_filter('request', 'remove_page_from_query_string');



	/**
	 * Imprime una lista separada por commas de todos los terms asociados al post id especificado
	 * los terms pertenecen a la taxonomia especificada. Default: Category
	 *
	 * @param  int     $post_id
	 * @param  string  $taxonomy
	 * @return string
	 */
	function print_the_terms($post_id, $taxonomy = 'category', $delimiter = ', '){
		$terms = get_the_terms( $post_id, $taxonomy );

		if ( $terms and ! is_wp_error($terms) ){
			$names = wp_list_pluck($terms ,'slug');
			echo implode($delimiter, $names);
		}
	}



	function ultimos_colaboradores_q_publicaron(){
		global $wpdb;

		$colaboradores = get_transient('ultimos_colaboradores_que_publicaron');

		if ( $colaboradores != '' )
				return $colaboradores;

		$colaboradores = $wpdb->get_results("SELECT DISTINCT us.ID, us.user_nicename FROM {$wpdb->base_prefix}users AS us
							INNER JOIN (
								SELECT meta_key, meta_value, user_id FROM {$wpdb->base_prefix}usermeta WHERE meta_key = 'colaborador'
							) AS um ON us.ID = um.user_id
							INNER JOIN (
								SELECT post_author FROM {$wpdb->prefix}posts WHERE post_status = 'publish' ORDER BY post_date DESC
							) AS p ON us.ID = p.post_author
									WHERE meta_key = 'colaborador' AND meta_value = 1 LIMIT 6;");

		set_transient( 'ultimos_colaboradores_que_publicaron', $colaboradores, 86400 );

		return $colaboradores;

	}

/// REMOVE WP-CAPTION PRESET STYLES

	add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
	add_shortcode('caption', 'fixed_img_caption_shortcode');
	function fixed_img_caption_shortcode($attr, $content = null) {
		// New-style shortcode with the caption inside the shortcode with the link and image tags.
		if ( ! isset( $attr['caption'] ) ) {
			if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
				$content = $matches[1];
				$attr['caption'] = trim( $matches[2] );
			}
		}

		// Allow plugins/themes to override the default caption template.
		$output = apply_filters('img_caption_shortcode', '', $attr, $content);
		if ( $output != '' )
			return $output;

		extract(shortcode_atts(array(
			'id'	=> '',
			'align'	=> 'alignnone',
			'width'	=> '',
			'caption' => ''
		), $attr));

		if ( 1 > (int) $width || empty($caption) )
			return $content;

		if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

		return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . $width . 'px">'
		. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
	}

	/////////////
	///
	///
	///		POSITIONS
	///
	///
	///
	///// CREATE TABLE FOR HOME POSITIONS

	add_action('init', function(){
		global $wpdb;

		$last = wp_get_recent_posts(array(
									    'numberposts' => 3,
									    'post_status' => 'publish'
									));

		$last_id = $last[0]['ID'];
		$second_to_last_id = $last[1]['ID'];
		$antepenultimate = $last[2]['ID'];

		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$wpdb->base_prefix}positions (
				position_id BIGINT(20) UNSIGNED NOT NULL,
				post_id VARCHAR(40) NOT NULL DEFAULT '',
				PRIMARY KEY (position_id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);
		$wpdb->query(


			"INSERT IGNORE INTO {$wpdb->base_prefix}positions
				(position_id, post_id)
				VALUES	(1, {$last_id}),(2, {$second_to_last_id}), (3, {$antepenultimate});"
		);

	});

	/**
	 * Get position of this post if set
	 */
	function get_position($post_id){

		global $wpdb;
		return $wpdb->get_var("SELECT position_id FROM {$wpdb->base_prefix}positions
			WHERE post_id = '$post_id' LIMIT 1; "
		);

	}

	/**
	 * Update positions
	 */
	function update_home_position($post_id, $position){

		global $wpdb;

		$wpdb->query("UPDATE {$wpdb->base_prefix}positions

						SET post_id = '$post_id'
						WHERE position_id = '$position';"
		);
	}

	/**
	 * Get positioned posts
	 */
	function get_positioned_posts(){

		global $wpdb;
		return $wpdb->get_results("SELECT * FROM {$wpdb->base_prefix}positions
			ORDER BY position_id ASC
			LIMIT 3; "
		);

	}

	/**
	 * Get positioned posts six
	 */
	function get_positioned_posts_six(){

		global $wpdb;
		return $wpdb->get_results("SELECT * FROM {$wpdb->base_prefix}positions
			ORDER BY position_id ASC
			LIMIT 6; "
		);

	}


	function postUploads(){
		global $post;

		$post_ID = $post->ID;

		$args = array(
		   'post_type' => 'attachment',
		   'numberposts' => -1,
		   'post_parent' => $post_ID
		);

		$images = array();
		$attachments = get_posts( $args );
		    if ( $attachments ) {
		        foreach ( $attachments as $attachment ) {
		           	$img_url = wp_get_attachment_image_src($attachment->ID, 'featured');
					$images[] = "<img src='$img_url[0]' />";
		    }
		}
		return $images;
	}

	function short_title($after = '', $length) {
		$mytitle = explode(' ', get_the_title(), $length);
		if (count($mytitle)>=$length) {
			array_pop($mytitle);
			$mytitle = implode(" ",$mytitle). $after;
		} else {
			$mytitle = implode(" ",$mytitle);
		}
		return $mytitle;
	}


