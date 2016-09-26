	<div class="side_sopitas">

		<h2>sopitas.com</h2>

		<?php $rss_sopitas = fetch_feed('http://www.sopitas.com/site/cat/editors-choice/feed/?repeat=w3tc');


		if( ! is_wp_error($rss_sopitas)) :

			$feed_elements = $rss_sopitas->get_items( 0, 5 );

		 	foreach ( $feed_elements as $element ) :

	
		 		$imagen = $element->get_item_tags('http://search.yahoo.com/mrss/', 'content');

				$imagen = isset($imagen[0]['attribs']['']['url']) ? $imagen[0]['attribs']['']['url'] : ''; ?>

				<div class="cont_post">
					<a href="<?php echo $element->get_permalink() ?>">
						 <img style="width: 80px; height: 80px;" src="<?php echo $imagen ?>">
					</a>
					<h3>
						<a href="<?php echo $element->get_permalink(); ?>" target="_blank">
							<?php echo $element->get_title() ?>
						</a>
					</h3>
					<a href="<?php echo $element->get_permalink() ?>" target="_blank"><h4><?php  echo mysql2date('d.m.y', $element->get_date()); ?></h4></a>
				</div><?php

			endforeach;

		endif; ?>

	</div><!-- end sopitas.com-->