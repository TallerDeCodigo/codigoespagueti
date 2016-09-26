<div class="side-general">

	<?php if ( is_single() ): ?>

		<div class="caja_side">

			<ul class="favoritos">
				<li id="noticias" class="select"></li>
				<li id="masgustado" class=""></li>
				<li id="comentado" class=""></li>
			</ul>

			<?php get_template_part( 'templates/side', 'ultimas-noticias' ); ?>

			<?php get_template_part( 'templates/side', 'mas-leidos' ); ?>

			<?php get_template_part( 'templates/side', 'mas-comentado' ); ?>

		</div><!-- end caja_side-->

	<?php endif;?>

	<?php if(is_single()){ ?>
	<!-- /9262827/codigoespagueti_300x600_lat -->
	<div id='div-gpt-ad-1470413266734-2' style='height:600px; width:300px;'>
		<script>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470413266734-2'); });
		</script>
	</div>
	<div style="margin:20px; float: left;"></div>
	<img src="https://www.codigoespagueti.com/wp-content/uploads/sites/17/2014/12/comentarios_fb.jpg"/>
	<div class="facebook-comments">
		<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="300" data-num-posts="20"></div>
	</div>
	<div id="sidebar" style="margin-top:40px;">


	<?php


		$categoria = get_cat_ID( 'Noticias' );
		$noticias = get_posts( array(
			'post_type'      => 'post',
			'category'       => $categoria,
			'posts_per_page' => 16,
			'offset'		 => -7
			
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
	<!-- /9262827/CODIGOESPAGUETI300X250 -->
	<div id='div-gpt-ad-1470413266734-0'>
		<script>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470413266734-0'); });
		</script>
	</div>

	
</div>

<?php } else { ?>

	<!-- /9262827/codigoespagueti_300x600_lat -->
	<div id='div-gpt-ad-1470413266734-2' style='height:600px; width:300px;'>
		<script>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470413266734-2'); });
		</script>
	</div>
<?php } ?>

</div><!-- end .side-single -->