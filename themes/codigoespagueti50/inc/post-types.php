<?php

// POST TYPES /////////////////////////////////////////////////////////////////////////

	function post_types_espagueti(){

		// VIDEOS
		$args = array(
			'label'         => 'Videos',
			'public'        => true,
			'rewrite'       => array('slug' => 'videos'),
			'has_archive'   => true,
			'taxonomies'    => array('category'),
			'supports'      => array('title','thumbnail','editor', 'author'),
			'menu_position' => 5,
		);
		register_post_type( 'videos', $args );

		// RESEÑAS
		$args = array(
			'label'         => 'Reseñas',
			'public'        => true,
			'rewrite'       => array('slug' => 'resenas'),
			'has_archive'   => true,
			'taxonomies'    => array('category'),
			'supports'      => array('title','thumbnail','editor', 'author'),
			'menu_position' => 6,
		);
		register_post_type( 'resenas', $args );

		// ESTAMOS LEYENDO
		$args = array(
			'label'         => 'Estamos leyendo',
			'public'        => true,
			'rewrite'       => array('slug' => 'leyendo'),
			'has_archive'   => true,
			'supports'      => array('title','thumbnail','editor', 'author'),
			'menu_position' => 7,
		);
		register_post_type( 'leyendo', $args );
	}
	add_action( 'init', 'post_types_espagueti' );

/*
	---------------------
		TAXONOMIES
	---------------------
*/

	function espagueti_tax(){
		//Reseñas //Consolas
		$argumentos = array(
			'labels' => array(
				'name'			=> 'Consolas',
				'add_new_item'	=> 'Nueva Consola',
				'parent_item'	=> 'Consola madre'
			),
			'hierarchical' => true
		);

		register_taxonomy(
			'consolas',
			'resenas',
			$argumentos
		);
	}
	add_action( 'init', 'espagueti_tax' );


/*
	---------------------
		    PAGES
	---------------------
*/

	add_action('init', function(){

		// PAGE HOME
		if( ! get_page_by_path('destacado') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Destacado',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}



	});