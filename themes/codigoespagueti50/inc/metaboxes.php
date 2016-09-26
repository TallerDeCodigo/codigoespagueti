<?php

// USER META BOXES ///////////////////////////////////////////////////////////////////

	add_action( 'show_user_profile', 'extra_user_options' );
	add_action( 'edit_user_profile', 'extra_user_options' );

	function extra_user_options( $user ) { ?>

		<h3>Información extra</h3>

		<table class="form-table">
			<tr>
				<th><label for="colaborador">Colaborador</label></th>
				<td>
					<input type="checkbox" name="colaborador" id="colaborador" value="1" <?php checked( get_the_author_meta( 'colaborador', $user->ID ), 1 ); ?> />
					<span class="description">El usuario es un colaborador</span>
				</td>
			</tr>
			<tr>
				<th><label for="bio">Biografía corta</label></th>
				<td>
					<textarea rows="4" cols="50" name="bio" id="bio" class="regular-text" /><?php echo esc_attr( get_the_author_meta( 'bio', $user->ID ) ); ?></textarea><br />
					<span class="description">Extracto de biografía</span>
				</td>
			</tr>
			<tr>
				<th><label for="nombre_columna">Columna</label></th>
				<td>
					<input type="text" name="nombre_columna" id="nombre_columna" value="<?php echo esc_attr( get_the_author_meta( 'nombre_columna', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">Nombre de la columna</span>
				</td>
			</tr>
			<tr>
				<th><label for="twitter">Twitter</label></th>
				<td>
					<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">Twitter username</span>
				</td>
			</tr>
			<tr>
				<th><label for="facebook">Facebook</label></th>
				<td>
					<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">URL de Facebook</span>
				</td>
			</tr>
			<tr>
				<th><label for="pinterest">Pinterest</label></th>
				<td>
					<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">Usuario de pinterest</span>
				</td>
			</tr>
			<tr>
				<th><label for="instagram">Instagram</label></th>
				<td>
					<input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">Usuario de instagram</span>
				</td>
			</tr>
			<tr>
				<th><label for="tumblr">Tumblr</label></th>
				<td>
					<input type="text" name="tumblr" id="tumblr" value="<?php echo esc_attr( get_the_author_meta( 'tumblr', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">URL de tumblr</span>
				</td>
			</tr>
			<tr>
				<th><label for="flickr">Flickr</label></th>
				<td>
					<input type="text" name="flickr" id="flickr" value="<?php echo esc_attr( get_the_author_meta( 'flickr', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">URL de flickr</span>
				</td>
			</tr>
			<tr>
				<th><label for="quote">Quote</label></th>
				<td>
					<input type="text" name="quote" id="quote" value="<?php echo esc_attr( get_the_author_meta( 'quote', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">Quote personal</span>
				</td>
			</tr>
			<tr>
				<th><label for="imagen">Imagen de portada</label></th>
				<td>
					<input type="text" name="imagen" id="imagen" value="<?php echo esc_attr( get_the_author_meta( 'imagen', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">url de la imagen</span>
				</td>
			</tr>

		</table><?php
	}


	add_action( 'personal_options_update', 'save_extra_profile_fields' );
	add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );

	function save_extra_profile_fields( $user_id ) {
		if ( !current_user_can( 'edit_user', $user_id ) )
			return false;

		if ( isset($_POST['colaborador']) ){
			update_user_meta( $user_id, 'colaborador', $_POST['colaborador'] );
		}else{
			delete_user_meta( $user_id, 'colaborador' );
		}
		update_user_meta( $user_id, 'bio', $_POST['bio'] );
		update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
		update_user_meta( $user_id, 'nombre_columna', $_POST['nombre_columna'] );
		update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
		update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
		update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
		update_user_meta( $user_id, 'tumblr', $_POST['tumblr'] );
		update_user_meta( $user_id, 'flickr', $_POST['flickr'] );
		update_user_meta( $user_id, 'quote', $_POST['quote'] );
		update_user_meta( $user_id, 'imagen', $_POST['imagen'] );
	}


// METABOXES /////////////////////////////////////////////////////////////////////////

	add_action('admin_menu', function(){


	//META BOX PARA MÚLTIPLES POST-TYPES
		$posttypes = array( 'post', 'videos', 'resenas' );
		foreach( $posttypes as $posttype ) {
	      add_meta_box( 'meta-box-post-video', 'Video', 'show_metabox_post_video', $posttype, 'side', 'high' );
	      add_meta_box( 'meta-box-post', 'Opciones del artículo', 'show_metabox_post', $posttype, 'side', 'high' );
	      add_meta_box( 'meta-box-post-quote', 'Quote', 'show_metabox_post_quote', 'resenas', 'side', 'high' );
		  add_meta_box( 'meta-box-post-source', 'Fuente', 'show_metabox_post_source', $posttype, 'normal', 'high' );
		  add_meta_box( 'meta-box-home-position', 'Posición en Home', 'show_metabox_home_position', $posttype, 'side', 'high' );
		  //add_meta_box( 'meta-box-post-sopitas', 'Mandar a Sopitas', 'show_metabox_post_sopitas', 'post', 'side', 'high' );
		}

	//META BOX SLIDER

		add_meta_box( 'meta-box-post-slider', 'Fotogalería single', 'show_metabox_post_slider', 'post', 'side', 'high' );

	//META BOX SCORE
		 add_meta_box( 'meta-box-resena', 'Score', 'show_metabox_resena', 'resenas', 'side', 'high' );

	//META BOX FICHA TÉCNICA

		add_meta_box( 'meta-box-ficha', 'Ficha técnica', 'show_metabox_ficha', 'resenas', 'normal', 'high' );

	//META BOX LINK ESTAMOS LEYENDO

		add_meta_box( 'meta-box-leyendo', 'Link externo', 'show_metabox_link_externo', 'leyendo', 'side', 'default' );

	});



// METABOXES CALLBACK FUNCTIONS //////////////////////////////////////////////////////




	// Callback function to show fields in meta box Opciones del artículo
	function show_metabox_post($post) {
		$top_home       = (get_post_meta($post->ID, 'top_home', true)) ? 'checked' : '';
		$noticiero      = (get_post_meta($post->ID, 'noticiero', true)) ? 'checked' : '';
		$grid_home      = (get_post_meta($post->ID, 'grid_home', true)) ? 'checked' : '';
		$cat_top_home   = (get_post_meta($post->ID, 'cat_top_home', true)) ? 'checked' : '';
		$post_destacado = (get_post_meta($post->ID, 'post_destacado', true)) ? 'checked' : '';
		$checked = get_post_meta($post->ID, '_rss_sopitas_meta', true);
		$checked = $checked ? 'checked' : '';

		wp_nonce_field(__FILE__, '_articulo_featured_nonce'); // Use nonce for verification
		echo <<< HTML
			<input type="checkbox" name="noticiero" id="noticiero" value="true" $noticiero>&nbsp;&nbsp;&nbsp;<label for="noticiero">Aparecer en el "noticiero de la cabecera"</label>
			<br />
			<input type="checkbox" name="top_home" id="top_home" value="true" $top_home>&nbsp;&nbsp;&nbsp;<label for="top_home">Destacado en el "top_home"</label>
			<br />
			<input type="checkbox" name="grid_home" id="grid_home" value="true" $grid_home>&nbsp;&nbsp;&nbsp;<label for="grid_home">Destacado en el bottom_home</label>
			<br />
			<input type="checkbox" name="cat_top_home" id="cat_top_home" value="true" $cat_top_home>&nbsp;&nbsp;&nbsp;<label for="cat_top_home">Destacado en el home de categoría</label>
			<br /><br />
			<label for="post_destacado" style="font-weight: bold;">Artículo especial</label>
			<br /><br />
			<input type="checkbox" name="post_destacado" id="post_destacado" value="true" $post_destacado>&nbsp;&nbsp;&nbsp;<label for="noticiero">Artículo especial</label>
			<br /><br />
			<label for='_rss_sopitas_meta' style="font-weight: bold;">Compartir en el feed de sopitas.</label>
			<br /><br />
			<input type='checkbox' id='_rss_sopitas_meta' name='_rss_sopitas_meta' value='true' $checked>&nbsp;&nbsp;&nbsp;<label for="noticiero">RSS feed de sopitas.</label>

HTML;
	}



	// Callback function to show fields in meta box Opciones de video

	function show_metabox_post_video($post) {
		$id_vimeo   = get_post_meta($post->ID, 'id_vimeo', true);
		$id_youtube = get_post_meta($post->ID, 'id_youtube', true);
		$embed_generico = get_post_meta($post->ID, 'embed_generico', true);
		wp_nonce_field(__FILE__, '_articulo_videos_nonce');
		echo <<< HTML

			<label for="id_vimeo">ID de Vimeo</label>
			<input type="text" name="id_vimeo" id="id_vimeo" value="$id_vimeo" class="widefat">
			<p class="howto" style="font-size:11px; margin: 0.2em 0 1.5em 0;">https://vimeo.com/<strong>45118430</strong></p>

			<label for="id_youtube">ID de Youtube</label>
			<input type="text" name="id_youtube" id="id_youtube" value="$id_youtube" class="widefat">
			<p class="howto" style="font-size:11px; margin: 0.2em 0 1.5em 0;">https://www.youtube.com/watch?v=<strong>rT_OmTMwvZI</strong></p>

			<label for='embed_generico'>Embed (otra fuente)</label>
			<input type='text' name='embed_generico' id='embed_generico' value='$embed_generico' class='widefat'>
			<p class='howto' style='font-size:11px; margin: 0.2em 0 1.5em 0;'>< iframe src='//player...</p>

HTML;
	}


	// Callback function to show fields in meta box Opciones del slider

	function show_metabox_post_slider($post) {
		$slider = (get_post_meta($post->ID, 'slider', true)) ? 'checked' : '';
		wp_nonce_field(__FILE__, '_articulo_slider_nonce');
		echo "<input type='checkbox' name='slider' id='slider' value='true' $slider>&nbsp;&nbsp;&nbsp;<label for='slider'>Mostrar las fotos del artículo en fotogalería.</label>";
	}


	// Callback function to show fields in meta box Score de la reseña

	function show_metabox_resena($post) {
		$score   = get_post_meta($post->ID, 'score', true);
		wp_nonce_field(__FILE__, '_articulo_resena_nonce');
		echo "<label for='score'>Score de la reseña</label>";
		echo "<input type='text' name='score' id='score' value='$score' class='widefat'>";
	}


	// Callback function to show fields in meta box Quote del artículo

	function show_metabox_post_quote($post) {
			$post_quote   = get_post_meta($post->ID, 'post_quote', true);

			wp_nonce_field(__FILE__, '_articulo_quotes_nonce');
			echo <<< HTML

				<label for="post_quote">Quote</label>
				<input type="text" name="post_quote" id="post_quote" value="$post_quote" class="widefat">
				<p class="howto" style="font-size:11px; margin: 0.2em 0 1.5em 0;">Cita del artículo</strong></p>
HTML;
	}



	// Callback function to show fields in meta box Via-Fuente



	function show_metabox_post_source($post) {
		$post_via   = get_post_meta($post->ID, 'post_via', true);
		$post_fuente = get_post_meta($post->ID, 'post_fuente', true);
		$link_fuente = get_post_meta($post->ID, 'link_fuente', true);
		$link_via = get_post_meta($post->ID, 'link_via', true);
		wp_nonce_field(__FILE__, 'via-meta-nonce');
		wp_nonce_field(__FILE__, 'fuente-meta-nonce');
		echo <<< HTML

			<label for="post_via">Via</label>
			<input type="text" name="post_via" value="$post_via" class="widefat">
			<p class="howto" style="font-size:11px; margin: 0.2em 0 1.5em 0;">Articulo posteado via:</p>

			<label for="link_via">Link via</label>
			<input type="text" name="link_via" value="$link_via" class="widefat">
			<p class="howto" style="font-size:11px; margin: 0.2em 0 1.5em 0;">Link via del articulo</p>

			<label for="post_fuente">Fuente del articulo</label>
			<input type="text" name="post_fuente" value="$post_fuente" class="widefat">
			<p class="howto" style="font-size:11px; margin: 0.2em 0 1.5em 0;">Fuente original del articulo</p>

			<label for="link_fuente">Link de la fuente</label>
			<input type="text" name="link_fuente" value="$link_fuente" class="widefat">
			<p class="howto" style="font-size:11px; margin: 0.2em 0 1.5em 0;">Link de la fuente del articulo</p>
HTML;
	}


	// Callback function to show fields in meta box Fica técnica de la reseña

	function show_metabox_ficha($post) {
		$ficha   = get_post_meta($post->ID, 'ficha', true);
		$imagen  = get_post_meta($post->ID, 'imagen-resena', true);
		$imagen  = $imagen ? $imagen : '';
		$button  = $imagen ? '<button class="button" id="borrar-imagen-ficha-tecnica">Borrar Imagen</button>' : '';

		wp_nonce_field(__FILE__, '_articulo_ficha_nonce');
		echo <<< HTML

			<label for="ficha">Ficha técnica</label>
			<textarea name="ficha" id="ficha" class="widefat">$ficha</textarea>
			<p class="howto" style="font-size:11px; margin: 0.2em 0 1.5em 0;">Ficha técnica de la reseña</strong></p>

			<label for="contenedor-imagen-ficha-tecnica">Agregar imagen Ficha técnica</label>


			<div class="wp-media-buttons upload_image_button" style="margin:5px 0 5px 0;">
				<a href="#" class="button add_media" data-editor="content" title="Agregar Imagen">
					<span class="wp-media-buttons-icon"></span>
					Agregar Imagen
				</a>
			</div>

			<input type="hidden" id="current-post-id" value="$post->ID">
			<div id="contenedor-imagen-ficha-tecnica">
				$imagen
			</div>

			$button

HTML;
	}



	//Callback function to show metabox link_externo



	function show_metabox_link_externo($post) {
		$link = get_post_meta($post->ID, 'link_externo', true);
		wp_nonce_field(__FILE__, 'link_externo_nonce');
		echo "<input type='url' name='link_externo' class='widefat' value='$link'>";
	}


	//Callback function to show home position metabox

	function show_metabox_home_position($post){

		$position_number = get_position($post->ID);

			echo "
			<div class='meta-container cf'>
				<div class='position_mini'>izquierda</div>
				<div class='position_mini'>centro</div>
				<div class='position_mini'>derecha</div>

				<input class='position_checkbox' type='radio' name='position_meta' value='1' ";
				echo ( $position_number == 1 ) ? 'checked>' : '>' ;
				echo "
				<input class='position_checkbox' type='radio' name='position_meta' value='2' ";
				echo ( $position_number == 2 ) ? 'checked>' : '>' ;
				echo "<input class='position_checkbox' type='radio' name='position_meta' value='3' ";
				echo ( $position_number == 3 ) ? 'checked>' : '>' ;
	   echo "</div>";


	}


// SAVE METABOXES DATA ///////////////////////////////////////////////////////////////



	add_action('save_post', function ($post_id){

		if( !current_user_can('edit_page', $post_id)){
			return $post_id;
		}

		if(defined('DOING_AUTOSAVE') and DOING_AUTOSAVE){
			return $post_id;
		}


		if(isset($_POST['_rss_sopitas_meta']) ){
			update_post_meta($post_id, '_rss_sopitas_meta', 'true');
		}else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, '_rss_sopitas_meta');
		}


		if( !defined( 'DOING_AJAX' ) and isset($_POST['post_via']) and check_admin_referer(__FILE__, 'via-meta-nonce') ){
			update_post_meta($post_id, 'post_via', $_POST['post_via']);
		}

		if( !defined( 'DOING_AJAX' ) and isset($_POST['post_fuente']) and check_admin_referer(__FILE__, 'fuente-meta-nonce') ){
			update_post_meta($post_id, 'link_fuente', $_POST['link_fuente']);
			update_post_meta($post_id, 'post_fuente', $_POST['post_fuente']);
			update_post_meta($post_id, 'link_via', $_POST['link_via']);
		}

		if(!defined( 'DOING_AJAX' ) and isset($_POST['link_externo']) and check_admin_referer(__FILE__, 'link_externo_nonce') ){
			update_post_meta($post_id, 'link_externo', $_POST['link_externo']);
		}


	// DESTACADOS


		if ( !defined( 'DOING_AJAX' ) and isset($_POST['noticiero']) ) {
			update_post_meta($post_id, 'noticiero', $_POST['noticiero']);
		} else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, 'noticiero');
		}

		if ( !defined( 'DOING_AJAX' ) and isset($_POST['top_home']) ) {
			update_post_meta($post_id, 'top_home', $_POST['top_home']);
		} else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, 'top_home');
		}

		if ( !defined( 'DOING_AJAX' ) and isset($_POST['grid_home']) ) {
			update_post_meta($post_id, 'grid_home', $_POST['grid_home']);
		} else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, 'grid_home');
		}

		if ( !defined( 'DOING_AJAX' ) and isset($_POST['cat_top_home']) ) {
			update_post_meta($post_id, 'cat_top_home', $_POST['cat_top_home']);
		} else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, 'cat_top_home');
		}



	// POST DESTACADOS


		if ( !defined( 'DOING_AJAX' ) and isset($_POST['post_destacado']) ) {
			update_post_meta($post_id, 'post_destacado', $_POST['post_destacado']);
		} else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, 'post_destacado');
		}


	// VIDEOS


		if( !defined( 'DOING_AJAX' ) and isset($_POST['id_vimeo']) and check_admin_referer( __FILE__, '_articulo_videos_nonce' ) ){

			if (isset($_POST['id_vimeo']) ) {
				update_post_meta($post_id, 'id_vimeo', $_POST['id_vimeo']);
			}

			if (isset($_POST['id_youtube']) ) {
					update_post_meta($post_id, 'id_youtube', $_POST['id_youtube']);
			}
			if (isset($_POST['embed_generico']) ) {
					update_post_meta($post_id, 'embed_generico', $_POST['embed_generico']);
			}
		}


	/// SLIDER SINGLE


		if ( !defined( 'DOING_AJAX' ) and isset($_POST['slider']) ) {
			update_post_meta($post_id, 'slider', $_POST['slider']);
		}else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, 'slider');
		}


	/// RESEÑA


		if( isset($_POST['score']) and check_admin_referer( __FILE__, '_articulo_resena_nonce' ) ){


			if (isset($_POST['score']) ) {
					update_post_meta($post_id, 'score', $_POST['score']);
			}
		}


	/// QUOTE


		if( isset($_POST['post_quote']) and check_admin_referer( __FILE__, '_articulo_quotes_nonce' ) ){

			if (isset($_POST['post_quote']) ) {
				update_post_meta($post_id, 'post_quote', $_POST['post_quote']);
			}
		}

	/// FICHA TÉCNICA


		if( isset($_POST['ficha']) and check_admin_referer( __FILE__, '_articulo_ficha_nonce' ) ){

			if (isset($_POST['ficha']) ) {
				update_post_meta($post_id, 'ficha', $_POST['ficha']);
			}
		}

	// Position Home
	
		if( isset( $_POST[ 'position_meta' ] ) ) {

			if ($_POST[ 'position_meta' ] != 0) {
				update_home_position($post_id, $_POST['position_meta']);
			}
		}

	});



 // COLUMNAS EXTRA POSTS
/*

	add_filter( 'manage_posts_columns', function($columns){

		return array (
			'cb'         => '<input type="checkbox" />',
			'title'      => 'Título',
			'sopitas'    => 'Sopitas RSS',
			'author'     => 'Autor',
			'categories' => 'Categorías',
			'tags'       => 'Etiquetas',
			'comments'   => '<span class="vers"><div title="Comentarios" class="comment-grey-bubble"></div></span>',
			'date'       => 'Fecha'
		);

	});


	
	add_action( 'manage_posts_custom_column', 'custom_noticias_columns', 10, 2 );

	function custom_noticias_columns( $column, $post_id ) {
		$checked = get_post_meta($post_id, '_rss_sopitas_meta', TRUE);
		$checked = $checked ? 'checked' : '';

		if ( $column == 'sopitas' ){
			echo <<< HTML
				<br /><p class='description'>
					<input type='checkbox' class='mandar_a_sopitas_checkbox' data-post_id='$post_id' $checked>
					&nbsp; RSS feed de sopitas.
				</p>
HTML;

		}
	}

*/


