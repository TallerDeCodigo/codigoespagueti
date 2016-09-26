<?php
	global $featured_posts;

	$exclude_from_sidebar = array_unique($featured_posts);

?>

<div id="sidebar">


	<?php
		$categoria = get_cat_ID( 'Noticias' );
		$noticias = get_posts( array(
			'post_type'      => 'post',
			'category'       => $categoria,
			'posts_per_page' => 13,
			'post__not_in'   => $exclude_from_sidebar
		));

		foreach ($noticias as $post): setup_postdata($post); ?>

			<div class="post-side <?php print_the_terms($post->ID, 'category', ' '); ?>">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
				<?php if( has_category('opinion') ) { ?>
					<div class="opinion-img">
						<a href="<?php the_permalink(); ?>"><img src="<?php echo THEMEPATH; ?>images/opinion-flag.png"></a>
					</div>
				<?php } ?>
				<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
				
				<div class="col_right" style="width:210px">
					<span class="date"><?php echo mysql2date('d.m.y', $post->post_date); ?></span>
					<?php // the_excerpt(); ?>
				</div>
			</div>

		<?php endforeach; wp_reset_query(); ?>

	<a href="<?php echo bloginfo('url'); ?>/noticias" class="ver_noticias">Ver más ></a>
	<!-- /9262827/codigoespagueti_300x600_lat -->
	<div id='div-gpt-ad-1470413266734-2' style='height:600px; width:300px;'>
		<script>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470413266734-2'); });
		</script>
	</div>
</div>