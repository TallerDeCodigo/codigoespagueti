<?php get_header(); $objeto = get_queried_object();

	if( have_posts() ): while( have_posts() ): the_post(); ?>
		<div class="content-single">
			<h2><?php the_title(); ?></h2>
			<span class="date">
				<?php the_date('d.m.y', '', ' | '); the_author_posts_link(); ?> <?php print_post_terms($post->ID); ?>
			</span>

			<?php if(get_post_meta($post->ID, 'id_vimeo', true)):?>

				<div class="imagenes-single">
					<iframe src="https://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'id_vimeo', true); ?>?color=00a6ce" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</div><!-- end .imagenes-single -->

			<?php elseif (get_post_meta($post->ID, 'id_youtube', true)): ?>

				<div class="imagenes-single">
					<iframe width="640" height="360" src="https://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'id_youtube', true); ?>" frameborder="0" allowfullscreen></iframe>
				</div><!-- end .imagenes-single -->

			<?php elseif (get_post_meta($post->ID, 'embed_generico', true)): ?>
					
				<div class="imagenes-single">
					<?php echo get_post_meta($post->ID, 'embed_generico', true); ?>
				</div>
				

			<?php endif;

			the_content();

			 ?>

			<ul class="social-post">
				<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-via="somosespagueti">Tweet</a></li>
				<li><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div></li>
				<li><div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="125" data-show-faces="false"></div></li>
			</ul>

			<div class="caja-autor">
				<div class="info-autor">
					<a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php echo get_avatar( get_the_author_meta('ID'), 150 ); ?></a>
					<h4><?php the_author_posts_link(); ?></h4>
					<span class="date"><a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php echo get_the_author_meta('nombre_columna'); ?></a></span>
					<p><?php echo get_the_author_meta('bio'); ?></p>
				</div><!-- end .info-autor-->

				

				<h5>Más artículos del autor</h5>
				<div class="relacionados">
					<?php $relacionadosAutor = new WP_Query( array(
							'author'         => $post->post_author,
							'posts_per_page' => 5,
							'exclude'        => $post->ID
					));

					if ( $relacionadosAutor->have_posts() ) : while ( $relacionadosAutor->have_posts() ) : $relacionadosAutor->the_post();  ?>

						<div class="post-relacionado">
							<span class="date"><?php echo get_the_date('d.m.y'); ?><?php print_post_terms($post->ID); ?></span>
							<h6><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h6>
						</div><!-- end .post-relacionado -->

					<?php endwhile; endif; wp_reset_postdata(); ?>

				</div><!-- .relacionados -->

			</div><!-- .caja-autor -->
			<?php echo get_the_tag_list('<p> ',', ','</p>'); ?>

			<div class="post-nav">
				<?php previous_post_link('%link', '&raquo Anterior'); ?>
				<span class="siguiente-post">
					<?php next_post_link('%link', 'Siguiente &laquo'); ?>
				</span>
			</div><!-- end .post-nav -->

			<?php $prev_post = get_previous_post();
			$next_post = get_next_post();

			if(!empty($prev_post)) : $previous = get_post($prev_post->ID); ?>

				<div class="nav-post prev">
					<a href="<?php echo get_permalink( $previous->ID ); ?>"><?php echo get_the_post_thumbnail($previous->ID, 'thumbnail'); ?></a>
					<h4><a href="<?php echo get_permalink( $previous->ID ); ?>"><?php echo $previous->post_title; ?></a></h4>
					<span class="date"><?php print_post_terms_caja($previous->ID); ?></span>
				</div><!-- end .nav-post -->

			<?php endif;

			if(!empty($next_post)) : $next = get_post($next_post->ID); ?>

			<div class="nav-post next">
				<a href="<?php echo get_permalink( $next->ID ); ?>"><?php echo get_the_post_thumbnail($next->ID, 'thumbnail'); ?></a>
				<h4><a href="<?php echo get_permalink( $next->ID ); ?>"><?php echo $next->post_title; ?></a></h4>
				<span class="date"><?php print_post_terms_caja($next->ID); ?></span>
			</div><!-- end .nav-post -->

			<?php endif; ?>

		</div><!-- end .content-single -->

		<?php include_once('side-general.php');

	endwhile; endif; wp_reset_query();

get_footer(); ?>