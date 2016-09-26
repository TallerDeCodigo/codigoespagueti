<?php
/**
 * http://espagueti.dev/author/user_nicename/
 */

	get_header();
	$objeto = get_queried_object();
	$userID = $objeto->ID; ?>

		<div class="autores">

			<div class="splash">
				<img src="<?php the_author_meta('imagen', $userID); ?>">
			</div><!-- end .splash -->

			<div class="contenido-autor">

				<div class="nombre-columna">
					<h2><?php the_author_meta('nombre_columna', $userID); ?></h2>
				</div><!-- end .nombre-columna -->

				<div class="biografia">
					<?php $descripcion = apply_filters('the_content', get_the_author_meta('description', $userID)); echo $descripcion; ?>
				</div><!-- end .biografia -->

				<div class="sidebar-autor">
					<div id="avatarBox" class="side">
						<?php echo get_avatar( $userID, 120 ); ?>
					</div><!-- end .side-->

					<div class="side uno">
						<img src="<?php bloginfo('template_url'); ?>/images/quote.png">
						<blockquote><?php the_author_meta('quote', $userID);?></blockquote>
					</div><!-- end .side-->

					<div class="side">
						<?php $facebook =  the_author_meta('facebook', $userID);
						      $twitter =  the_author_meta('twitter', $userID);
						      $instagram =  the_author_meta('instagram', $userID);
						      $tumblr =  the_author_meta('tumblr', $userID);
						      $flickr =  the_author_meta('flickr', $userID);?>
						<ul>
							<?php if($facebook != ''): ?><li><a href="<?php echo $facebook; ?>">Facebook</a></li><?php endif; ?>
							<?php if($twitter != ''): ?><li><a href="http://twitter.com/<?php echo $twitter; ?>">Twitter</a></li><?php endif; ?>
							<?php if($instagram != ''): ?><li><a href="http://instagram.com/<?php echo $instagram;?>">Instagram</a></li><?php endif; ?>
							<?php if($tumblr != ''): ?><li><a href="<?php echo $tumblr;?>">Tumblr</a></li><?php endif; ?>
							<?php if($flickr != ''): ?><li><a href="<?php echo $flickr;?>">Flickr</a></li><?php endif; ?>
						</ul>
					</div><!-- end .side-->

					<!-- <div class="side">
						<h5>Tweets</h5>
					</div> --><!-- end .side-->

				</div><!-- end .sidebar-autor-->


				<h5>Últimos artículos</h5>

				<div class="ultimos">
					<?php $ultimos = new WP_Query(array('posts_per_page' => 4, 'author' => $objeto->ID ));

					if ( $ultimos->have_posts() ) : while ( $ultimos->have_posts() ) : $ultimos->the_post();?>

						<div class="post">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured_post'); ?></a>
							<span class="date"><?php echo mysql2date('d.m.y', $post->post_date); ?> <?php print_post_terms($post->ID); ?></span>
							<h4><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h4>
							<?php the_excerpt();?>
						</div><!-- end .post -->

					<?php endwhile; endif; wp_reset_query(); ?>

				</div><!-- end .ultimos -->

			</div><!-- end .contenido-autor -->

		</div><!-- end .autores -->

<?php get_footer(); ?>