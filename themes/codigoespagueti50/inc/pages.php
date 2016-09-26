<?php


// CUSTOM PAGES //////////////////////////////////////////////////////////////////////


	add_action('init', function(){


		// COLABORADORES
		if( ! get_page_by_path('colaboradores') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Colaboradores',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}




	});