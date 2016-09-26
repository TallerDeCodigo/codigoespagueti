<div id="entrevistas" style="margin-top: 30px; float:left;">
	<h5>Entrevistas</h5>
	<div id="content-entrevistas">
		<?php $entrevistas = get_posts(array(
			'post_type'      => 'post',
			'posts_per_page' => 3,
			'category'       => 4
		));

		foreach ($entrevistas as $post): setup_postdata($post); ?>

			<div class="post">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured_post');?></a>
				<span class="date">
					<?php echo mysql2date('d.M.y', $post->post_date); ?>
					<?php print_post_terms($post->ID); ?>
				</span>
				<h4><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h4>
				<?php the_excerpt();?>
			</div><!-- end .post -->

		<?php endforeach; wp_reset_query(); ?>

	</div><!-- end #content-entrevistas -->	
</div>	<!-- end #entrevistas -->	