<?php get_header();  ?>

		<div class="content-archive">
			<h2>Colaboradores</h2>

			<?php

					$args = array(
							'meta_key'     => 'colaborador',
							'meta_compare' => '=',
							'meta_value'   => '1',
							'orderby'      => 'name',
							'order'        => 'ASC'
						 );

						$users = get_users( $args );

						foreach ( $users as $colaborador ) :
						$data    = get_user_meta($colaborador->ID);

						$first   = isset($data['first_name'][0])     ? $data['first_name'][0]     : '';
						$last    = isset($data['last_name'][0])      ? $data['last_name'][0]      : '';
						$columna = isset($data['nombre_columna'][0]) ? $data['nombre_columna'][0] : '';
						$content = isset($data['bio'][0])            ? $data['bio'][0]            : '';
						$imagen  = get_avatar( $colaborador->ID, 150 );
						$url     = site_url("colaborador/{$colaborador->user_nicename}");


						// echo '<pre>';
						// print_r($users);
						// echo '</pre>';

			echo <<< colaborador

				<div class="wrapper-post-archive">
					<div class="post-archive">
						<a href="$url">$imagen</a>
						<span class="date">
							<?php echo mysql2date('d.m.y', $post->post_date); ?><?php print_post_terms($post->ID); ?>
						</span>
						<h4><a href="$url">$first  $last</a></h4>
						<span class="columna"><a href="$url">$columna</a></span>
						$content


					</div><!-- end .post-archive -->
					<ul class="social-post">
						<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="$url">Tweet</a></li>
						<li><div class="g-plusone" data-size="medium" data-href="$url"></div></li>
						<li><div class="fb-like" data-href="$url" data-send="true" data-layout="button_count" data-width="125" data-show-faces="false"></div></li>
					</ul>
				</div><!-- end .wrapper-post-archive -->
colaborador;

		endforeach; wp_reset_query();

?>






		</div><!-- end content-archive -->
		<?php get_template_part('side-general'); ?>


<?php get_footer(); ?>