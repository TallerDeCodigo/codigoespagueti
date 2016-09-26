	<div id="videos-home">

		<h5>Video del día</h5>

		<?php $videos = get_posts(array(
			'post_type'      => 'videos',
			'posts_per_page' => 1,
		));

		foreach($videos as $post): setup_postdata($post); ?>

			<div class="video-main-home">
				
				<!--
				<?php if(get_post_meta($post->ID, 'id_vimeo', true)){ ?>
					<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'id_vimeo', true); ?>?color=00a6ce" width="640" height="410" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php } elseif (get_post_meta($post->ID, 'id_youtube', true)) { ?>
					<iframe width="630" height="410" src="https://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'id_youtube', true); ?>" frameborder="0" allowfullscreen></iframe>
				<?php } ?>
				-->
				<div class="video-wrapper">
				<a href="<?php the_permalink(); ?>">
				<div class="btn_play_1">
				 <img src="<?php echo get_template_directory_uri() ?>/images/play-video1.png"/>
				</div>	
				</a>
				<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $post->ID, 'featured' ); ?></a>
				<div style="margin: 15px;"></div>
				<span class="date" style="margin-top:10px;">
					<?php echo mysql2date('d.m.y', $post->post_date); ?>
					<?php print_post_terms($post->ID); ?>
				</span>
				<h4><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h4>
			</div>
			</div>
		<?php endforeach; wp_reset_query(); ?>

		<div class="lista-videos">
			<ul>
				<?php $videos = get_posts(array(
					'post_type'      => 'videos',
					'posts_per_page' => 4,
					'offset'         => 1
				));

				foreach($videos as $post): setup_postdata($post); ?>

					<li>
						
						<div class="btn_play_1" style="position: absolute; z-index: 100; height: 0px; top: -95px; left: 45px;">
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo get_template_directory_uri() ?>/images/play-video2.png" style="width: 40px; height: 40px;">
							</a>
						</div>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('fetured'); ?></a>
						
						<span class="date">
							<?php echo mysql2date('d.m.y', $post->post_date); ?>
							<?php // print_post_terms($post->ID); ?>
						</span>
						<div class="col_right" style="width:165px";>
							<h6><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h6>
						</div>
					</li>

				<?php endforeach; wp_reset_query(); ?>
			</ul>

		</div><!-- end .lista-videos -->

	</div><!-- end #videos-home -->