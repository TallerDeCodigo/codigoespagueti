<div class="bottom-archive" style="float:left;">

	<h5>Reseñas</h5>

	<div class="archive-resenas">

		<?php  
			$resenas = new WP_Query( array(
			'post_type' => 'resenas',
			'posts_per_page' => 6,
			'category' => 3
		));

		if ( $resenas->have_posts() ) : while ( $resenas->have_posts() ) : $resenas->the_post(); ?>

		<div class="resena-archive">

			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured_post');?></a>
			<a href="<?php the_permalink(); ?>">
				<div class="score-archive">
					<p><?php echo get_post_meta($post->ID, 'score', true); ?></p>
				</div><!-- end .score-archive -->
			</a>
			<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
		</div><!-- end .resena-archive -->

		<?php endwhile; endif; wp_reset_postdata(); ?>

	</div><!-- end .archive-resenas -->

</div><!-- end .bottom-archive-->
