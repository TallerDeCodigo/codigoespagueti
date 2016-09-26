<?php get_header(); ?>

	<div id="slider">

		<?php
		global $featured_posts;
		$slides = new WP_Query(array(
			'post_type'      => 'post',
			'posts_per_page' => 1,
			'meta_key'       => 'top_home',
			'meta_value'     => 'true'
		));

		$positioned_obj = get_positioned_posts();
		$position_ids = array( $positioned_obj[0]->post_id, $positioned_obj[1]->post_id, $positioned_obj[2]->post_id);
		$position_ids = array_map('intval', $position_ids);

		if ( $slides->have_posts() ) : while ( $slides->have_posts() ) : $slides->the_post();

			$featured_posts[] = get_the_ID();

		?>
		<?php
			$thumbID = get_post_thumbnail_id( $post->ID );
			$imgDestacada = wp_get_attachment_url( $thumbID, 'slide' );
			
		?>
		
		<div class="slide" style="background: url('<?php echo $imgDestacada; ?>') no-repeat center center  #000; width:100%; height:100%;">
			<div class="slide-info">
				<div class="slide-content-post">	
					<h2><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h2>
					<a rel="nofollow" href="<?php the_permalink(); ?>" style="width:100%; height:100%; display: block; position: absolute; top: 0; bottom: 0; left: 0; right: 0; z-index: 2;"></a>
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
		
		<?php endwhile; endif; wp_reset_postdata(); ?>

	</div><!-- end #slider -->

	<section class="top_curados clearfix">
		<h5>Recomendados</h5>
		<?php
		$position_posts = get_posts(array(
					'post__in' => $position_ids,
					'orderby' => 'post__in'
				));

			$featured_posts = array_merge( $featured_posts, $position_ids);

			foreach ($position_posts as $positioned ) :
			?>
					<div class="post">
						<a href="<?php echo get_permalink( $positioned->ID ); ?>">
							<?php echo get_the_post_thumbnail( $positioned->ID, 'featured_post'); ?>
						</a>
						<span class="date">
							<?php echo mysql2date('d.m.y', $positioned->post_date); ?>
							<?php print_post_terms($positioned->ID); ?>
						</span>
						<h4><a href="<?php echo get_permalink( $positioned->ID ); ?>"><?php echo $positioned->post_title; ?></a></h4>
						<p class="post-extracto">
							<?php // echo wp_trim_words( $positioned->post_content, 20, '... »' ); ?>
						</p>
					</div><!-- end .post -->
			<?php endforeach; ?>
					<div class="banner970x250">
						<!-- /9262827/codigoespagueti_970x250_sup -->
						<div id='div-gpt-ad-1470413266734-3'>
							<script>
								googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470413266734-3'); });
							</script>
						</div>
					</div>

		<h5>Noticias</h5>
	</section>



	<div id="content">

		<div id="content-destacados">

		<?php

			$destacados = new WP_Query(array(
				'post_type'      => 'post',
				'posts_per_page' => 10,
				'meta_key'       => 'grid_home',
				'meta_value'     => 'true',
				'post__not_in'	 => $featured_posts
			));

			if ( $destacados->have_posts() ) : while ( $destacados->have_posts() ) : $destacados->the_post();

				$featured_posts[] = $post->ID;
			?>
					<div class="post">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured_post');?></a>
						<span class="date">
							<?php echo mysql2date('d.m.y', $post->post_date); ?>
							<?php print_post_terms($post->ID); ?>
						</span>
						<h4><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h4>
						<p class="post-extracto"><?php the_excerpt();?></p>
					</div><!-- end .post -->

		<?php endwhile; endif; ?>


		</div><!-- end #content-destacados -->

	</div><!-- end #content -->
	<?php get_sidebar(); ?>

	<?php get_template_part( 'templates/main', 'videos' ); ?>

	<div id="noticias-startup" style="margin-top:20px;  float: left;">
		<section id="noticiero-head">
			<ul id="lista-noticiero-head">
				<li class="noticia-noticiero-head logotipo">
					<div class="logo"> 
						<h1>StartUps</h1>
					</div>
				</li>
				<?php
					$noticias = new WP_Query(array(
						'posts_per_page' => 3,
						'category_name' => 'startups',

						));
				if ( $noticias->have_posts() ) : while ( $noticias->have_posts() ) : $noticias->the_post();?>
					<li class="noticia-noticiero-head">
					<!--	<span class="date"><?php echo mysql2date('d.M.y', $post->post_date); ?><?php print_post_terms($post->ID); ?></span>-->
						<a class="img_header" href="<?php echo $url ?>" target="_blank"><?php the_post_thumbnail('featured_post');?></a>	
						<h4><a href="<?php the_permalink(); ?>"><?php echo short_title('...', 8); ?></a></h4>
						<span class="date" style="color:#F9BE00;"><?php echo mysql2date('d.M.y', $post->post_date); ?></span>
					</li>
				<?php endwhile; endif; wp_reset_postdata(); ?>
			</ul>
		</section><!-- end #noticiero-head -->
	</div>
	<?php  get_template_part( 'templates/main', 'resenas' );?>
	<div style="float:left; margin-top: 30px;">
	<?php  get_template_part( 'templates/main', 'colaboradores' );?>
	</div>

	<?php get_template_part( 'templates/main', 'entrevistas' ); ?>
	<?php // get_template_part( 'templates/main', 'leyendo' ); ?>
	

	<?php get_footer(); ?>