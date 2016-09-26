<?php get_header(); the_post();

	$objeto = get_queried_object();

	$postcat = get_the_category($post->ID);
	$catID = $postcat->term_id;

		if ( get_post_meta($post->ID, 'post_destacado', true) ):
			get_template_part( 'templates/single', 'destacado' );
		else: ?>

			<div class="content-single">

				<h2><?php the_title(); ?></h2>

				<span class="date">
					<?php the_date('d.m.y', '', ' | '); the_author_posts_link(); ?> <?php print_post_terms($post->ID); ?>
				</span>
				
				<div class="socialmedia">
                <ul>
                    <li><a class="popupfb" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="new"><div class="social fb"></div></a></li>
                    <li><a class="popuptw" href="https://twitter.com/share?text=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>&amp;via=somosespagueti" target="new"><div class="social tw"></div></a></li>
                    <li><a class="popupgp" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="new"><div class="social gp"></div></a></li>
                    <li><a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?> <?php echo $thumbnail; ?>&amp;description=<?php the_title(); ?>" ><div class="social pin"></div></a></li>
                    <li><a onclick="ga('send', 'social', 'mail', 'Share', 'http://codigoespagueti.com/');" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><div class="social em" style="margin-right: 0px"></div></a></li>
                </ul>
            </div>
				<?php if(get_post_meta($post->ID,'slider',true)):  ?>

					<div id="single-slider" class="gallery-single">
						<img src="" alt="">
					</div><!-- end .slider -->

					<div id="nav-slider" class="gallery-thumbnails">
						<a href="#" class="buttons prev"><< Anterior</a>
						<div class="viewport cf">
							<ul class="cf overview">
							<?php
								$args = array(
								   'post_type' => 'attachment',
								   'numberposts' => -1,
								   'post_parent' => $post->ID
								);
								$attachments = get_posts($args);
								if($attachments) : foreach ($attachments as $key => $attachment) :
									$src = wp_get_attachment_image_src($attachment->ID, 'thumbnail');
									$src_big = wp_get_attachment_image_src($attachment->ID, 'featured'); ?>
									<li class="gallery-trigger" data-current="<?php echo isset($src_big[0]) ? $src_big[0] : ''; ?>"><img src="<?php echo isset($src[0]) ? $src[0] : ''; ?>"></li>
									<?php
								endforeach; endif; ?>
							</ul>
						</div>
						<a href="#" class="buttons next">Siguiente >></a>

					</div>



				<?php else: ?>

					<div class="images-single" style="float: left;margin: 20px 0;">
						<?php the_post_thumbnail('featured'); ?>
						<?php
					
							

							  $thumbnail_id    = get_post_thumbnail_id($post->ID);
							  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));
							 	
							// print_r($thumbnail_image);
							
							if( !$thumbnail_image[0]->post_excerpt == ''){ 
							?>

								<div class="wp-caption"><p class="wp-caption-text"><?php echo $thumbnail_image[0]->post_excerpt; ?></p></div>

							<?php } ?>
							
							
					
					</div><!-- end .images-single -->

				<?php endif;

				

				the_content();

				if(get_post_meta($post->ID, 'embed_generico', true)){
					echo '<div class="imagenes-single">'.get_post_meta($post->ID, 'embed_generico', true).'</div>';
				}
				
					if(get_post_meta($post->ID, 'id_vimeo', true)):

				?>

					<div class="imagenes-single">
						<iframe src="https://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'id_vimeo', true); ?>?color=00a6ce" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					</div><!-- end .imagenes-single -->
				<?php

					elseif (get_post_meta($post->ID, 'id_youtube', true)):

				?>

					<div class="imagenes-single">
						<iframe width="640" height="360" src="https://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'id_youtube', true); ?>" frameborder="0" allowfullscreen></iframe>
					</div><!-- end .imagenes-single -->
				<?php endif;

				echo "<p class = 'source' style = 'margin:0;'>";
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


				<div class="socialmedia">
                <ul>
                    <li><a class="popupfb" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="new"><div class="social fb"></div></a></li>
                    <li><a class="popuptw" href="https://twitter.com/share?text=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>&amp;via=somosespagueti" target="new"><div class="social tw"></div></a></li>
                    <li><a class="popupgp" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="new"><div class="social gp"></div></a></li>
                    <li><a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?> <?php echo $thumbnail; ?>&amp;description=<?php the_title(); ?>" ><div class="social pin"></div></a></li>
                    <li><a onclick="ga('send', 'social', 'mail', 'Share', 'https://codigoespagueti.com/');" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><div class="social em" style="margin-right: 0px"></div></a></li>
                </ul>
            </div>
				


				<div class="caja-autor">

					<div class="info-autor">
						<a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php echo get_avatar( get_the_author_meta('ID'), 150 ); ?></a>
						<h4><?php the_author_posts_link(); ?></h4>
						<span class="date"><a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php echo get_the_author_meta('nombre_columna'); ?></a></span>
						
						<p><?php echo get_the_author_meta('bio'); ?></p>
						
						<div id="redes" style="float:left">	
							<ul>
								<?php if(get_the_author_meta('facebook') != '') { ?>	
								<li><a href="https://www.facebook.com/<?php  echo get_the_author_meta('facebook'); ?>" target="_blank" id="facebook">Facebook</a></li>
								<?php } ?>
								<?php if(get_the_author_meta('twitter') != '') { ?>
								<li><a href="https://www.twitter.com/<?php  echo get_the_author_meta('twitter'); ?>" target="_blank" id="twitter">twitter</a></li>
								<?php } ?>
								<?php if(get_the_author_meta('instagram') != '') { ?>
								<li><a href="https://www.instagram.com/<?php  echo get_the_author_meta('instagram'); ?>" target="_blank" id="instagram">instagram</a></li>
								<?php } ?>

							</ul>
						</div>
						
					</div><!-- end .info-autor-->

					<h5>Artículos de este autor</h5>

					<div class="relacionados">
						<?php $relacionadosAutor = new WP_Query( array(
							'author'         => $post->post_author,
							'posts_per_page' => 2,
							'exclude'        => $post->ID
						));

						if ( $relacionadosAutor->have_posts() ) : while ( $relacionadosAutor->have_posts() ) : $relacionadosAutor->the_post(); ?>

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

				if(!empty($prev_post)) : $previous = get_post($prev_post->ID); ?>

					<div class="nav-post prev">
						<a href="<?php echo get_permalink( $previous->ID ); ?>"><?php echo get_the_post_thumbnail($previous->ID, 'thumbnail'); ?></a>
						<h4><a href="<?php echo get_permalink( $previous->ID ); ?>"><?php echo $previous->post_title; ?></a></h4>
						<span class="date"><?php print_post_terms_caja($previous->ID); ?></span>
					</div><!-- end .nav-post -->

				<?php endif;

				if(!empty($next_post)): $next = get_post($next_post->ID); ?>
					<div class="nav-post next">
						<a href="<?php echo get_permalink( $next->ID ); ?>"><?php echo get_the_post_thumbnail($next->ID, 'thumbnail'); ?></a>
						<h4><a href="<?php echo get_permalink( $next->ID ); ?>"><?php echo $next->post_title; ?></a></h4>
						<span class="date"><?php print_post_terms_caja($next->ID); ?></span>
					</div><!-- end .nav-post -->
				<?php endif; ?>

				<section class="top_curados clearfix relacionados-nuevo">
					
					

						<h5>Relacionados</h5>
						
						<?php 
						
						$tags = wp_get_post_tags($post->ID);
						if ($tags) {						
							

							$tag1 = $tags[0]->term_id;
							$tag2 = $tags[1]->term_id;
							//$tag3 = $tags[2]->term_id;
							


							$args=array(
								'tag__in' => array($tag1, $tag2),
								'post__not_in' => array($post->ID),
								'posts_per_page'=>6,
								'caller_get_posts'=>1,
								'orderby'=>'DESC'
						);
						} else {

							$args = array(
									'post_type' => 'post',
									'posts_per_page' => 3,
									'category' => $catID,
									'exclude'	=> $objeto->ID,
									'orderby'	=> 'rand'
								);
						}
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
				
				

			</div><!-- end .content-single -->	

			<?php include_once('side-general.php'); ?>

			<section class="top_curados clearfix masleidos">
					<h5>Lo m&aacute;s le&iacute;do</h5>
					 <?php
						if( function_exists( 'stats_get_csv' ) ) { $top_posts = stats_get_csv( 'postviews', 'days=3&limit=4'); } ?>
						<?php 
							foreach ($top_posts as $indice => $mostview ) {
									
								$imgAttr = array(
									'alt'		=> trim(strip_tags( $mostview['post_title'] )),
									'title'		=> trim(strip_tags( $mostview['post_title'] )),
								);
								$imgThumbnail = get_the_post_thumbnail( $mostview['post_id'], 'featured_post', $imgAttr );
								$imgThumbnail = str_replace('height="160"', 'width="192"', $imgThumbnail);
								
								if($mostview['post_title'] != 'Home page'){
						?>

								<div class="post">
									<a href="<?php echo get_permalink($mostview['post_id']) ?>">
										<?php echo $imgThumbnail; ?>
									</a>
									<span class="date">
										<?php echo mysql2date('d.m.y', $positioned->post_date); ?>
										<?php print_post_terms($mostview['post_id']); ?>
									</span>
									<h4><a href="<?php echo get_permalink($mostview['post_id']); ?>"><?php echo get_the_title( $mostview['post_id'] ); ?></a></h4>
									<?php // echo wp_trim_words( $positioned->post_content, 20, '... »' ); ?>
								</div><!-- end .post -->
					
				<?php							
						}
				} 
				wp_reset_postdata();	
				?>

				</section>

		<?php

	endif;


get_footer(); ?>