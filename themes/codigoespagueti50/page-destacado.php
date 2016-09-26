<?php
	get_header();

	$objeto = get_queried_object();
	?>

		<div class="resenas-single">
			<div class="splash">
				<?php echo get_the_post_thumbnail( '8747', 'full'); ?>
			</div><!-- end .splash -->
			<div class="contenido-resena destacados">

				<div class="info-resena">

					<div class="info-resena-izq">
						<h2>Lorem ipsum dolor sit amet, consectetur
adipiscing elit. Aenean nec sapien eu erat
cursus vestibulum nec eu nulla.</h2>
						<span class="date"><?php the_date('d.m.y'); ?><?php the_author_posts_link(); ?> | <?php print_post_terms($post->ID); ?></span>
					</div><!-- end .info-resena-izq-->

				</div><!-- end .info-resena -->

				<div class="single-resena-izq">
					<div class="texto-resena">
						<p><strong>Nulla varius ligula nec neque accumsan imperdiet. Phasellus augue massa, pellentesque sodales elementum ac, pellentesque sit amet tel-
						lus.</strong></p>
						￼<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nec sapien eu erat cursus vestibulum nec eu nulla. Pellentesque eleifend suscipit libero eget pulvinar. Fusce eleifend rhoncus nunc, vitae tincidunt enim laoreet at. Sed nec augue at metus consectetur volutpat. Aliquam sagittis imperdiet aliquet. Duis imperdiet pretium ante quis dignissim. In eget eros ac purus molestie condimentum nec id felis. Vestibulum tempus vulputate dignissim. Nam non erat velit, eu feugiat lacus. Cum sociis natoque penatibus et magnis dis parturient mon- tes, nascetur ridiculus mus. Mauris venenatis ornare nisl, lobortis tincidunt leo auctor non. Phasellus in tincidunt nisl.</p>
						<p>Phasellus vitae dictum metus. Praesent blandit, quam eu commodo feugiat, elit leo rutrum dolor, eget sollicitudin mi turpis quis ante. Duis semper purus quis sapien hendrerit rutrum. Quisque dictum vehicula leo, a congue tellus blandit in. Proin et aliquam purus. Cum so- ciis natoque penatibus et mag-
						nis dis parturient montes, na-
						scetur ridiculus mus. Aliquam
						ante massa, lacinia et tincidunt
						et, pharetra consequat purus.
						Aenean tellus diam, venenatis
						vitae auctor at, auctor eu lor-
						em. Mauris commodo pulvinar
						nibh, eget tristique metus lobortis suscipit. Mauris risus justo, consequat mollis sagittis nec, imperdiet in lectus. Nunc nibh eros, tincidunt nec fringilla et, congue eget urna. Nam adipi- scing tortor at mi volutpat sit amet tempus mi porta.</p>
						<p>Ut et quam vitae urna ornare tincidunt. Maecenas rutrum blandit feugiat. Vivamus placerat iaculis orci, quis elementum lacus ornare vitae. Curabitur sit amet varius lorem. Mauris scelerisque posuere dui at consequat. Vestibulum egestas magna vel tellus posuere sagittis varius metus ultrices. Pellentesque eleifend, elit quis dapibus sagittis, erat tortor scelerisque augue, vitae dapibus dolor justo tempor ligula. Duis vestibulum, velit at commodo congue, velit nibh pulvinar orci, ullamcorper mattis nisl purus nec enim. Morbi laoreet sapien sit amet lectus facilisis nec convallis magna egestas. Nunc eget mauris orci, sed lobortis lec- tus. Etiam dignissim placerat tellus, vel suscipit orci porta quis. Nulla ornare mattis phare- tra. Sed congue placerat enim. Praesent commodo leo id velit porta porta imperdiet augue euismod. Phasellus volutpat mi ac tortor portti tor elementum. Nulla tincidunt eros in nisl aliquet non pharetra ligula faucibus. Proin odio magna, accumsan sit amet viverra sed, fer- mentum a arcu. Nunc sagittis erat non lectus posuere id egestas massa imperdiet. Nulla dapibus ante elit.</p>
					</div><!-- end .texto-resena -->

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
						<div class="info-autor">
							<a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php echo get_avatar( get_the_author_meta('ID'), 150 ); ?></a>
							<h4><?php the_author_posts_link(); ?></h4>
							<span class="date"><a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php echo get_the_author_meta('nombre_columna'); ?></a></span>
							<p><?php echo get_the_author_meta('bio'); ?></p>
						</div><!-- end .info-autor-->

						<?php echo get_the_tag_list('<p> ',', ','</p>'); ?>

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

						<h5>Relacionadas</h5>
						<div class="relacionados">
							<?php $relacionadosAutor = new WP_Query( array(
									'author'         => $post->post_author,
									'posts_per_page' => 5,
									'exclude'        => $post->ID
							));

							if ( $relacionadosAutor->have_posts() ) : while ( $relacionadosAutor->have_posts() ) : $relacionadosAutor->the_post(); ?>

								<div class="post-relacionado">
									<span class="date"><?php echo get_the_date('d.m.y'); ?><?php print_post_terms($post->ID); ?></span>
									<h6><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h6>
								</div><!-- end .post-relacionado -->

							<?php endwhile; endif; wp_reset_postdata(); ?>
						</div><!-- .relacionados -->

						<div class="facebook-comments">
							<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="640" data-num-posts="10"></div>
						</div>

					</div><!-- end .extra-resena -->
				</div><!-- end .single-resena-izq -->



			</div><!-- end .contenido-resena -->

		</div><!-- end .resenas-single -->


<?php get_footer(); ?>