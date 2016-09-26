<?php
	get_header(); global $wpdb;

	$objeto = get_queried_object();

	if ( $post = get_featured_post_resenas()  ) :

	setup_postdata($post); 
	
	$no_Post = $post->ID;
	
	?>

		<div id="slider">

			<?php
			$thumbID = get_post_thumbnail_id( $post->ID );
			$imgDestacada = wp_get_attachment_url( $thumbID, 'slide' );
			
		?>
		<div class="slide" style="background: url('<?php echo $imgDestacada; ?>') no-repeat center center #000; width:100%; height:100%;">
			<!--<div class="image-slider">
				<a rel="nofollow" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured'); ?></a>
			</div>-->
			
			<div class="slide-info">
				<div class="slide-content-post">	
					<!-- <span class="date"><?php echo mysql2date('d.m.y', $post->post_date); ?> <?php print_post_terms($post->ID); ?></span> -->
					<h2><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h2>
					<a rel="nofollow" href="<?php the_permalink(); ?>" style="width:100%; height:100%;display: block;     position: absolute;     top: 0;     bottom: 0;     left: 0;     right: 0;     z-index: 2;"></a>
					<b style="background-color: #00A6CE; padding: 5px; color: #fff; top: 100px; position: relative;"><?php get_category_block($post->ID); ?></b>
					<div class="socialmedia">
                		<ul>
		                    <li><a class="popupfb" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="new"><div class="social fb" style="width: 50px;"></div></a></li>
                	    	    <li><a class="popuptw" href="https://twitter.com/share?text=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>&amp;via=somosespagueti" target="new"><div class="social tw" style="width: 50px;"></div></a></li>
		                    <li><a class="popupgp" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="new"><div class="social gp" style="width: 50px;"></div></a></li>
		                    <li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?> <?php echo $thumbnail; ?>&amp;description=<?php the_title(); ?>" ><div class="social pin" style="width: 50px;"></div></a></li>
                		    <li><a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><div class="social em" style="margin-right: 0px; width: 50px;"></div></a></li>
		                </ul>
			        </div>
				</div>
			</div><!-- end .slide-info-->
		</div><!-- end .slide -->

		</div><!-- end #slider -->

	<?php endif; ?>


	<div class="top-archive">

		<div class="content-archive">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			if($no_Post != $post->ID ){
			?>

				<div class="post">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured_post'); ?></a>
					<a href="<?php the_permalink(); ?>">
						<div class="resena-score">
							<?php echo get_post_meta($post->ID, 'score', true); ?>
						</div><!-- end .resena-score -->
					</a>
					<span class="date">
						<?php echo mysql2date('d.m.y', $post->post_date); ?><?php print_post_terms($post->ID); ?>
					</span>
					<h4><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h4>
					<?php the_excerpt();?>
				</div><!-- end .post -->

			<?php } endwhile; endif; wp_reset_query(); ?>

			<div id="paginacion">
				<?php print_pagination(); ?>
			</div><!-- end #paginacion -->

		</div><!-- end .content-archive -->

		<?php include_once('side-general.php'); ?>

	</div><!-- end .top-archive -->



	<div class="bottom-archive">

		<?php if(!is_category('noticias')) : ?>

			<h5>Noticias</h5>

			<div class="bottom-archive-content">

				<?php $the_query = new WP_Query( array(
					'post_type'      => 'post',
					'category'       => 1,
					'posts_per_page' => 6
				));

				if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<div class="post-side">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
						<h6><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h6>
						<span class="date"><?php echo mysql2date('d.m.y', $post->post_date); ?> </span>
						<?php the_excerpt(); ?>
					</div><!-- end .post-side -->

				<?php endwhile; endif; wp_reset_postdata(); ?>

			</div><!-- end .bottom-archive-content -->

		<?php endif; ?>

		<?php $video = new WP_Query(array(
			'post_type'      => 'videos',
			'category_name'  => $objeto->name,
			'posts_per_page' => 1,
		));

		if ( $video->have_posts() ) : while ( $video->have_posts() ) : $video->the_post(); ?>

			<div class="video">

				<h5>Video</h5>
				<?php if(get_post_meta($post->ID, 'id_vimeo', true)){ ?>
					<iframe src="https://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'id_vimeo', true); ?>?color=00a6ce" width="980" height="551" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php } elseif (get_post_meta($post->ID, 'id_youtube', true)) { ?>
					<iframe width="980" height="551" src="https://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'id_youtube', true); ?>" frameborder="0" allowfullscreen></iframe>
				<?php } ?>
				<span class="date">
					<?php echo mysql2date('d.m.y', $post->post_date); ?><?php print_post_terms($post->ID); ?>
				</span>
				<h4><a rel="nofollow" href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h4>

			</div><!-- end .video -->

		<?php endwhile; endif; wp_reset_postdata(); ?>

	</div><!-- end .bottom-archive-->

<?php get_footer(); ?>