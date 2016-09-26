<?php
	get_header();

	$objeto = get_queried_object();

	$postcat = get_the_category($post->ID);
	$catID = $postcat->term_id;
	?>
		<?php if( have_posts() ): while( have_posts() ): the_post(); ?>

		<div class="resenas-single">
			<div class="splash">
				<?php the_post_thumbnail('full'); ?>
			</div><!-- end .splash -->
			<div class="contenido-resena">

				<div class="info-resena">

					<div class="info-resena-izq">
					<h2><?php the_title(); ?></h2>
					<span class="date"><?php the_date('d.m.y'); ?> | <?php the_author_posts_link(); ?> <?php print_post_terms($post->ID); ?></span>
				</div><!-- end .info-resena-izq-->

					<div class="resena-score">
						<p><?php echo get_post_meta($post->ID, 'score', true); ?></p>
					</div><!-- end .resena-score -->

				</div><!-- end .info-resena -->
				<div class="socialmedia" style="margin: 20px auto; max-width: 640px; width: 100%; float: none;">
                <ul>
                    <li><a class="popupfb" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="new"><div class="social fb"></div></a></li>
                    <li><a class="popuptw" href="https://twitter.com/share?text=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>&amp;via=somosespagueti" target="new"><div class="social tw"></div></a></li>
                    <li><a class="popupgp" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="new"><div class="social gp"></div></a></li>
                    <li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?> <?php echo $thumbnail; ?>&amp;description=<?php the_title(); ?>" ><div class="social pin"></div></a></li>
                    <li><a onclick="ga('send', 'social', 'mail', 'Share', 'http://plumasatomicas.com/');" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><div class="social em" style="margin-right: 0px"></div></a></li>
                </ul>
            </div>
				<div class="single-resena-izq">
					
					<div class="texto-resena">
					<?php the_content(); ?>
					</div><!-- end .texto-resena -->
					
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

					<?php } ?>

					<?php if(get_post_meta($post->ID, 'ficha', true)) { ?>

						<div class="side ficha">
							<h6>Ficha técnica</h6>
							<?php echo get_post_meta($post->ID, 'imagen-resena', true);
							$ficha = apply_filters('the_content', get_post_meta($post->ID, 'ficha', true));
							echo $ficha; ?>

						</div><!-- end .side-->
						<?php } if(get_post_meta($post->ID, 'post_quote', true)) { ?>
						<!--
						<div class="side uno">
							<img src="<?php bloginfo('template_url'); ?>/images/quote.png">
							<blockquote><?php echo get_post_meta($post->ID, 'post_quote', true) ?></blockquote>
						</div> end .side-->


						<?php } ?>

					<div class="votacion-single">

						<div class="vote-left">
							<div class="resena-score">
								<p><?php echo get_post_meta($post->ID, 'score', true); ?></p>
							</div><!-- end .resena-score -->
							<img src="<?php bloginfo('template_url'); ?>/images/logo-foot.png">
						</div><!-- end .vote-left -->

						<div class="vote-right">
							<div class="vox-populi">
								<p><?php echo get_vote_data($post->ID); ?></p>
							</div><!-- end .vox-populi -->

							<?php if ( !isset($_COOKIE["valueFor_$post->ID"]) ) { ?>

								<div class="votar">
									<h6>vox populi</h6>
									<div id="slider-ui" data-post_id="<?php echo $post->ID; ?>"></div>
									<label id="cambiame_cova">0</label>
									<button id="save-vote">VOTA</button>
								</div><!-- end .votar -->

							<?php } else { ?>

								<div class="votar">
									<h6>Ya has votado.</h6>
								</div><!-- end .votar -->

							<?php } ?>

						</div><!-- end .vote-right -->
					</div><!-- end. votacion-single -->

					<div class="socialmedia" style="margin: 20px auto; max-width: 640px; width: 100%; float: none; height: 30px;">
                <ul>
                    <li><a class="popupfb" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="new"><div class="social fb"></div></a></li>
                    <li><a class="popuptw" href="https://twitter.com/share?text=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>&amp;via=somosespagueti" target="new"><div class="social tw"></div></a></li>
                    <li><a class="popupgp" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="new"><div class="social gp"></div></a></li>
                    <li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?> <?php echo $thumbnail; ?>&amp;description=<?php the_title(); ?>" ><div class="social pin"></div></a></li>
                    <li><a onclick="ga('send', 'social', 'mail', 'Share', 'http://plumasatomicas.com/');" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><div class="social em" style="margin-right: 0px"></div></a></li>
                </ul>
            </div>

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

						
						<div class="facebook-comments">
							<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="640" data-num-posts="10"></div>
						</div>
						
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

						

					</div><!-- end .extra-resena -->
				</div><!-- end .single-resena-izq -->

				<div class="sidebar-resena" style="display:none;">
					<?php if(get_post_meta($post->ID, 'ficha', true)) { ?>

						<div class="side ficha">
							<h6>Ficha técnica</h6>
							<?php echo get_post_meta($post->ID, 'imagen-resena', true);
							$ficha = apply_filters('the_content', get_post_meta($post->ID, 'ficha', true));
							echo $ficha; ?>

						</div><!-- end .side-->

					<?php } if(get_post_meta($post->ID, 'post_quote', true)) { ?>

						<div class="side uno">
							<img src="<?php bloginfo('template_url'); ?>/images/quote.png">
							<blockquote><?php echo get_post_meta($post->ID, 'post_quote', true) ?></blockquote>
						</div><!-- end .side-->

					<?php } ?>
				</div><!-- end .sidebar-resena-->

			</div><!-- end .contenido-resena -->

		</div><!-- end .resenas-single -->

	<?php endwhile; endif;

get_footer(); ?>