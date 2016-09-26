	<div class="side_masgustado">

		<h2>Más Leídos</h2>

			 <?php
				if( function_exists( 'stats_get_csv' ) ) { $top_posts = stats_get_csv( 'postviews', 'days=7&limit=6'); } ?>
				<?php 
					foreach ($top_posts as $indice => $mostview ) {
							
						$imgAttr = array(
							'alt'		=> trim(strip_tags( $mostview['post_title'] )),
							'title'		=> trim(strip_tags( $mostview['post_title'] )),
						);
						$imgThumbnail = get_the_post_thumbnail( $mostview['post_id'], 'thumbnail', $imgAttr );
						
						$imgThumbnail = str_replace('width="80"', 'width="60"', $imgThumbnail);
						$imgThumbnail = str_replace('height="80"', 'height="60"', $imgThumbnail);
						
						if($mostview['post_title'] != 'Home page'){
				?>
				
				<div class="cont_post">
					<a href="<?php echo get_permalink($mostview['post_id']) ?>"><?php echo $imgThumbnail; ?></a>
					<h3><a href="<?php echo get_permalink($mostview['post_id']); ?>"><?php echo get_the_title( $mostview['post_id'] );  ?></a></h3>
					<h4><?php echo get_the_time( 'd.m.y', $mostview['post_id'] ); ?></h4>
					<!--<p><?php echo wp_trim_words(get_the_excerpt($mostview['post_id']), 10, '...'); ?></p>-->
				</div>
	
				<?php							
						}
				} 
				wp_reset_postdata();	
				?>
	</div><!-- end mas leidos-->