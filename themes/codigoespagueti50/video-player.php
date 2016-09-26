<div id="videos-home">
					<h5>Video</h5>
					<?php $args = array(
							'post_type' => 'post',
							'posts_per_page' => 1,
							'orderby' => 'rand',
							'meta_query' => array(
									'relation' => 'OR',
										array(
		          							 'key' => 'id_vimeo',
											           'value' => '',
											           'compare' => '!=',
											       ),
										array(
		          							 'key' => 'id_youtube',
											           'value' => '',
											           'compare' => '!=',
											       )
											   )
						);
						query_posts($args);
						while(have_posts()): the_post();

						?>
					<div class="video-main-home">
						<?php if(get_post_meta($post->ID, 'id_vimeo', true)){ ?>
							<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'id_vimeo', true); ?>?color=00a6ce" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						<?php } elseif (get_post_meta($post->ID, 'id_youtube', true)) { ?>
							<iframe width="630" height="360" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'id_youtube', true); ?>" frameborder="0" allowfullscreen></iframe>
						<?php } ?>
						<span class="date"><?php print_post_terms($post->ID); ?><?php print_post_terms($post->ID); ?></span>
						<h4><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h4>
					</div>
				<?php endwhile; wp_reset_query(); ?>
					<div class="lista-videos">
						<ul>
							<?php $args = array(
							'post_type' => 'post',
							'posts_per_page' => 5,
							'orderby' => 'rand',
							'meta_query' => array(
									'relation' => 'OR',
										array(
		          							 'key' => 'id_vimeo',
											           'value' => '',
											           'compare' => '!=',
											       ),
										array(
		          							 'key' => 'id_youtube',
											           'value' => '',
											           'compare' => '!=',
											       )
											   )
						);
						query_posts($args);
						while(have_posts()): the_post();

						?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('fetured'); ?></a>
								<span class="date"><?php print_post_terms($post->ID); ?><?php print_post_terms($post->ID); ?></span>
								<h6><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h6>
							</li>
							<?php endwhile; wp_reset_query(); ?>
						</ul>
					</div>
				</div><!-- end #videos-home -->