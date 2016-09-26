<?php  $objeto = get_queried_object();

	$postcat = get_the_category($post->ID);
	$catID = $postcat->term_id; ?>

	<div class="resenas-single">
		<div class="splash">
			<?php the_post_thumbnail('full'); ?>
		</div><!-- end .splash -->
		<div class="contenido-resena destacados">

			<div class="info-resena cf">

				<div class="info-resena-izq">
					<h2><?php the_title(); ?></h2>
					<span class="date"><?php the_date('d.m.y'); ?> | <?php the_author_posts_link(); ?> <?php print_post_terms($post->ID); ?></span>
				</div><!-- end .info-resena-izq-->

			</div><!-- end .info-resena -->

			<div class="single-resena-izq">
				<div class="texto-resena"><?php the_content(); ?></div><!-- end .texto-resena -->

				<?php 
					if(get_post_meta($post->ID, 'embed_generico', true)){
						echo '<div class="imagenes-single">'.get_post_meta($post->ID, 'embed_generico', true).'</div>';
					}
				?>

				<?php if(get_post_meta($post->ID, 'id_vimeo', true)){ ?>

					<div class="imagenes-single">
						<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'id_vimeo', true); ?>?color=00a6ce" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					</div><!-- end .imagenes-single -->

				<?php } elseif (get_post_meta($post->ID, 'id_youtube', true)) { ?>

					<div class="imagenes-single">
						<iframe width="640" height="360" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'id_youtube', true); ?>" frameborder="0" allowfullscreen></iframe>
					</div><!-- end .imagenes-single -->

				<?php }

				echo "<p class = 'source'>";
					if( get_post_meta($post->ID, 'post_via', true) ){
						echo "<a class='title'>vía</a>
								<a class='gap' target = ".'_blank'." href=".get_post_meta($post->ID, 'link_via', true)." >" . get_post_meta($post->ID, 'post_via', true) .
								"</a>";
					}
					if( get_post_meta($post->ID, 'post_fuente', true) ){
						echo "<a class='title'>fuente</a>
								<a target = ".'_blank'." href=".get_post_meta($post->ID, 'link_fuente', true).">" . get_post_meta($post->ID, 'post_fuente', true) .
								"</a>";
					}
				echo "</p>";
				echo get_the_tag_list('<p class = "tagwrap"> <a class = "title">etiquetas</a> ',' ','</p>'); ?>

				<ul class="social-post">
						<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>">Tweet</a></li>
						<li><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div></li>
						<li><div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="125" data-show-faces="false"></div></li>
					</ul>

					<div class="extra-resenas">
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


						<div class="post-nav">
							<?php previous_post_link('%link', '&raquo Anterior'); ?>
							<span class="siguiente-post">
								<?php next_post_link('%link', 'Siguiente &laquo'); ?>
							</span>
						</div><!-- end .post-nav -->

						<?php $prev_post = get_previous_post();
						$next_post = get_next_post();

						if(!empty($prev_post)) { $previous = get_post($prev_post->ID); ?>

							<div class="nav-post prev">
								<a href="<?php echo get_permalink( $previous->ID ); ?>"><?php echo get_the_post_thumbnail($previous->ID, 'thumbnail'); ?></a>
								<h4><a href="<?php echo get_permalink( $previous->ID ); ?>"><?php echo $previous->post_title; ?></a></h4>
								<span class="date"><?php print_post_terms_caja($previous->ID); ?></span>
							</div><!-- end .nav-post -->
						<?php }

						if(!empty($next_post)) { $next = get_post($next_post->ID); ?>
							<div class="nav-post next">
								<a href="<?php echo get_permalink( $next->ID ); ?>"><?php echo get_the_post_thumbnail($next->ID, 'thumbnail'); ?></a>
								<h4><a href="<?php echo get_permalink( $next->ID ); ?>"><?php echo $next->post_title; ?></a></h4>
								<span class="date"><?php print_post_terms_caja($next->ID); ?></span>
							</div><!-- end .nav-post -->
						<?php } ?>

				<section class="top_curados clearfix relacionados-nuevo">
					
					

						<h5>Relacionados</h5>
						
						<?php 

							$args = array(
									'post_type' => 'post',
									'posts_per_page' => 6,
									'category' => $catID,
									'exclude'	=> $objeto->ID,
									'orderby'	=> 'rand'
								);

							$relacionados = get_posts($args);
							foreach($relacionados as $related_post): setup_postdata($related_post);
						?>


						<div class="post">
							<a href="<?php echo get_permalink( $related_post->ID ); ?>">
								<?php echo get_the_post_thumbnail( $related_post->ID, 'featured_post'); ?>
							</a>
							<h4><a href="<?php echo get_permalink( $related_post->ID ); ?>"><?php echo $related_post->post_title; ?></a></h4>
							<?php echo wp_trim_words( $related_post->post_content, 10, '... »' ); ?>
						</div><!-- end .post -->
							<?php
							 endforeach;  wp_reset_query();
						?>

					
				</section><!-- end relacionados -->
				<section class="top_curados clearfix relacionados-nuevo">
					<h5>Recomendados</h5>
					<?php
					$positioned_obj = get_positioned_posts();
					$position_ids = array( $positioned_obj[0]->post_id, $positioned_obj[1]->post_id, $positioned_obj[2]->post_id);
					$position_ids = array_map('intval', $position_ids);
					$position_posts = get_posts(array(
								'post__in' => $position_ids,
								'orderby' => 'post__in'
							));

						

						foreach ($position_posts as $positioned ) :
						?>
								<div class="post">
									<a href="<?php echo get_permalink( $positioned->ID ); ?>">
										<?php echo get_the_post_thumbnail( $positioned->ID, 'featured_post'); ?>
									</a>
									<span class="date">
										<?php echo mysql2date('d.m.y', $positioned->post_date); ?>
										<?php print_post_terms($positioned->ID); ?>
									</span>
									<h4><a href="<?php echo get_permalink( $positioned->ID ); ?>"><?php echo $positioned->post_title; ?></a></h4>
									<?php echo wp_trim_words( $positioned->post_content, 20, '... »' ); ?>
								</div><!-- end .post -->
					<?php endforeach; ?>

				</section>

						<div class="facebook-comments">
							<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="640" data-num-posts="10"></div>
						</div>

					</div><!-- end .extra-resena -->
				</div><!-- end .single-resena-izq -->

			</div><!-- end .contenido-resena -->

		</div><!-- end .resenas-single -->


<?php get_footer(); ?>