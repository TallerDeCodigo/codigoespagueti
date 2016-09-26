	<div class="side_noticias">

		<h2>Últimas noticias</h2>

		<?php

			$noticias = new WP_Query(array(
				'post_type'      => 'post',
				'category'       => 1,
				'post__not_in'	 => array($post->ID),
				'posts_per_page' => 5
			)); ?>


			<?php if ( $noticias->have_posts() ) : while( $noticias->have_posts() ) : $noticias->the_post(); ?>

				<div class="cont_post">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h4><?php echo mysql2date('d.m.y', $post->post_date); ?></h4>
					<!--<p><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?></p>-->
				</div>

			<?php endwhile; endif; wp_reset_postdata(); ?>

	</div><!-- end .side_noticias -->