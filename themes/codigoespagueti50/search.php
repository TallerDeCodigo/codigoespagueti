<?php

/*
Template Name: Search Page
*/

	get_header();

	$objeto = get_queried_object(); 
	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();
	$search_query = array('order' => 'DESC' ); 
	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} // foreach

	$search = new WP_Query($search_query);

?>

		<div class="content-archive">
			<h2><?php printf( __( 'Resultados de "%s"' ),  get_search_query()  ); ?></h2>

			<?php if($search->have_posts()): while($search->have_posts()): $search->the_post(); ?>

				<div class="wrapper-post-archive">
					<div class="post-archive">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
						<span class="date"><?php echo mysql2date('d.m.y', $post->post_date); ?><?php print_post_terms($post->ID); ?></span>
						<h4><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h4>
						<?php the_excerpt(); ?>

					</div><!-- end .post-archive -->
					<ul class="social-post">
						<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>">Tweet</a></li>
						<li><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div></li>
						<li><div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="125" data-show-faces="false"></div></li>
					</ul>
				</div><!-- end .wrapper-post-archive -->


			<?php endwhile; endif; wp_reset_query();
			if( $wp_query->max_num_pages > 1 ) :?>
			<div id="paginacion">
				<?php print_pagination(); ?>
			</div><!-- end #paginacion -->
			<?php endif; ?>

		</div><!-- end content-archive -->
		<?php get_template_part('side-general'); ?>


<?php get_footer(); ?>