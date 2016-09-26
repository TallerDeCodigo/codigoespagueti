<div id="colaboradores-home">

	<h5>Opinión</h5>

	<div id="content-colaboradores">
			<?php
			$args = array(
				'post_type'      	=> 'post',
				'posts_per_page'    => 1,
				'category__in'      => 9,
				'posts_per_page'    => 9
				//'author__in' => array( 124, 116, 183, 125)
			);
			$n_P = 0;
			$u_Post = new WP_Query( $args );
			
			
			if ( $u_Post->have_posts() ) : while ( $u_Post->have_posts() ) : $u_Post->the_post();
				$author_id=$post->post_author;
				$data    = get_user_meta($author_id);
				$first   = isset($data['first_name'][0])     ? $data['first_name'][0]     : '';
				$last    = isset($data['last_name'][0])      ? $data['last_name'][0]      : '';
				$columna = isset($data['nombre_columna'][0]) ? $data['nombre_columna'][0] : '';
				$content = isset($data['bio'][0])            ? $data['bio'][0]            : '';
				$imagen  = get_avatar($author_id, 80 );
				$titulo 	= $post->post_title;
				$url_post 	= get_permalink( $post->ID );
				$texto 		= wp_trim_words(get_the_excerpt(), 10, '...');;
				$n_P++;

			?>	
					 

				<div class="colaborador">
					<a href="index.php?author=<?php the_author_ID(); ?>"><?php echo $imagen; ?></a>
					<a href="index.php?author=<?php the_author_ID(); ?>"><h6><?php echo $first . ' ' .  $last ?></h6></a>
					<a href="<?php echo $url_post; ?>"><?php echo $titulo; ?></a>
					<div class="col_right">
						<p><?php echo $texto; ?></p>
					</div>	
				</div>
				<?php   if($n_P == 3) echo '<div style="clear:both"></div>'; ?>

	
			<?php
			endwhile; endif; wp_reset_query();
			?>
	</div><!-- end #content-colaboradores -->
	<a href="<?php echo bloginfo('url'); ?>/colaboradores" class="ver_noticias">Ver más &gt;</a>
</div><!-- end #colaboradores-home -->