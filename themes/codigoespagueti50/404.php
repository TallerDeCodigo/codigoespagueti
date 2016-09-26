<?php get_header(); ?>

	<div id="error404">
		<img class="fantasma" src="<?php echo THEMEPATH; ?>images/ghostani.gif">
		<img src="<?php echo THEMEPATH; ?>images/404.png">
	</div>

	<div id="content-destacados" class="cuatrocientos_cuatro">
		<?php global $featured_post;
		$destacados = get_posts(array(
			'post_type'      => 'post',
			'category'       => 1,
			'posts_per_page' => 3,
			'exclude'        => $featured_post
		));

		foreach ($destacados as $post): setup_postdata($post); ?>

			<div class="post">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured_post');?></a>
				<span class="date"><?php echo mysql2date('d.m.y', $post->post_date); ?>  <?php print_post_terms($post->ID); ?></span>
				<h4><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h4>
				<?php the_excerpt();?>
			</div><!-- end .post -->

		<?php endforeach; wp_reset_query(); ?>

	</div><!-- end #content-destacados -->

<?php get_footer(); ?>