<div id="estamos-home" style="float:left; ">


	<h5>Estamos Leyendo</h5>

	<div id="content-estamos-leyendo">

		<?php 
			$i=0;	
			$leyendo = get_posts(array(
			'post_type'      => 'leyendo',
			'posts_per_page' => 6
		));

		foreach ($leyendo as $post): setup_postdata($post); ?>

				<div class="colaborador">

					<?php $url = get_post_meta($post->ID, 'link_externo', true); ?>

					<a class="img_estamos" href="<?php echo $url ?>" target="_blank"><?php the_post_thumbnail('featured_post');?></a>	

					<div class="estamos_info">
						<a href="<?php echo $url ?>" target="_blank"><h6><?php the_title(); ?></h6></a>
						<p><?php  the_excerpt();?></p>
						<a href="<?php echo $url ?>" target="_blank"><h6 style="color:#00A6CE;"><?php the_author(); ?></h6></a>
						<!-- <a href="<?php echo $url ?>">Link</a> -->
					</div><!-- estamos_info -->



				</div><!-- end .colaborador <?php echo $i; ?> -->
			<?php $i++; if($i == 3) echo "<div style='clear:both'></div>"; ?>	
			<?php endforeach; wp_reset_query(); ?>

		</div><!-- end #estamos-leyendo -->

	</div><!-- end #videos-home -->