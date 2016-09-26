<div class="side_masgustado">

	<h2>Más gustados</h2>

	<?php $facebook = new Favoritos\Facebook();
	$masGustados = $facebook->getGustados();

	if( $masGustados ) : foreach ( array_slice($masGustados, 0, 6) as $post ) : setup_postdata($post); ?>

		<div class="cont_post">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			<h3><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h3>
			<h4><?php print_post_terms_caja($post->ID); ?></h4>
			<p><?php echo wp_trim_words( get_the_excerpt(), 10, ' ...' ); ?></p>
		</div>

	<?php endforeach; endif; wp_reset_postdata(); ?>

</div><!-- end mas gustados-->
