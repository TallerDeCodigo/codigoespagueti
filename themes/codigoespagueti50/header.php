<!doctype html>
<?php
	$objeto = get_queried_object();
	$na     = isset( $objeto->name) ? $objeto->name : false;
	$res    = isset( $objeto->post_type) ? $objeto->post_type : false;
?>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="google-site-verification" content="MFJj2E0fcRLDRzZ6aVHO5wKRWQtHJj6uk7w32DONuvQ" />
		<meta property="fb:pages" content="597468376939248" />
		<link rel="icon" href="<?php echo bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon" />
		<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'/>
		<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('stylesheet_url'); ?>?20151002">
		<?php

		if(is_single() || is_page()) {
			$twitter_url    = get_permalink();
			$twitter_title  = get_the_title();
			$twitter_desc   = get_the_excerpt();
		  	$twitter_thumbs = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), slide );
			$twitter_thumb  = $twitter_thumbs[0];
		    if(!$twitter_thumb) {
		      	$twitter_thumb = 'https://codigoespagueti.com/wp-content/themes/codigoespagueti50/images/logo.png';
    			}
		  	$twitter_name   = str_replace('@', '', get_the_author_meta('twitter'));
		?>
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:url" content="<?php echo $twitter_url; ?>" />
		<meta name="twitter:title" content="<?php echo $twitter_title; ?>" />
		<meta name="twitter:description" content="<?php echo $twitter_desc; ?>" />
		<meta name="twitter:image" content="<?php echo $twitter_thumb; ?>" />
		<meta name="twitter:site" content="@somosespagueti" />
		<?php
		}
		?>
		<?php /* BANNERS */ ?>

		<script type='text/javascript'>
		  var googletag = googletag || {};
		  googletag.cmd = googletag.cmd || [];
		  (function() {
		    var gads = document.createElement('script');
		    gads.async = true;
		    gads.type = 'text/javascript';
		    var useSSL = 'https:' == document.location.protocol;
		    gads.src = (useSSL ? 'https:' : 'http:') +
		      '//www.googletagservices.com/tag/js/gpt.js';
		    var node = document.getElementsByTagName('script')[0];
		    node.parentNode.insertBefore(gads, node);
		  })();
		</script>
		
		
		<script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
		<script>
		  var googletag = googletag || {};
		  googletag.cmd = googletag.cmd || [];
		</script>

		<script>
		  googletag.cmd.push(function() {
		    googletag.defineSlot('/9262827/CODIGOESPAGUETI300X250', [[300, 600], [300, 250]], 'div-gpt-ad-1470413266734-0').addService(googletag.pubads());
		    googletag.defineSlot('/9262827/CODIGOESPAGUETI_300x250_SUP', [300, 250], 'div-gpt-ad-1470413266734-1').addService(googletag.pubads());
		    googletag.defineSlot('/9262827/codigoespagueti_300x600_lat', [300, 600], 'div-gpt-ad-1470413266734-2').addService(googletag.pubads());
		    googletag.defineSlot('/9262827/codigoespagueti_970x250_sup', [[970, 90], [970, 250]], 'div-gpt-ad-1470413266734-3').addService(googletag.pubads());
		    googletag.defineSlot('/9262827/codigoespagueti_970x90_inf', [970, 90], 'div-gpt-ad-1470413266734-4').addService(googletag.pubads());
		    googletag.defineSlot('/9262827/CODIGOESPAGUETI_978x90_SUP', [[970, 250], [978, 90]], 'div-gpt-ad-1470413266734-5').addService(googletag.pubads());
		    googletag.pubads().enableSingleRequest();
		    googletag.enableServices();
		  });
		</script>
	

		<?php /* END  BANNERS */ ?>

		<script type="text/javascript">
		(function() {
		  var ARTICLE_URL = window.location.href;
		  var CONTENT_ID = 'everything';
		  document.write(
		    '<scr'+'ipt '+
		    'src="//survey.g.doubleclick.net/survey?site=_qsiwq3egem42rdhditnp3y6gqi'+
		    '&amp;url='+encodeURIComponent(ARTICLE_URL)+
		    (CONTENT_ID ? '&amp;cid='+encodeURIComponent(CONTENT_ID) : '')+
		    '&amp;random='+(new Date).getTime()+
		    '" type="text/javascript">'+'\x3C/scr'+'ipt>');
		})();
		</script>
		
		<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

	<script>
		
		jQuery(document).ready(function($) {
	
          jQuery('a.popuptw').on('click', function(){
              newwindow=window.open($(this).attr('href'),'','height=300,width=550');
              if (window.focus) {newwindow.focus()}
              return false;
          });
          
          
          jQuery('a.popupfb').on('click', function(){
              newwindow=window.open($(this).attr('href'),'','height=300,width=550');
              if (window.focus) {newwindow.focus()}
              return false;
          });
          
          jQuery('a.popupgp').on('click', function(){
              newwindow=window.open($(this).attr('href'),'','height=300,width=550');
              if (window.focus) {newwindow.focus()}
              return false;
          });
          
           jQuery('a.pinterest').on('click', function(){
              newwindow=window.open($(this).attr('href'),'','height=300,width=550');
              if (window.focus) {newwindow.focus()}
              return false;
          });
    	});
	</script>

		
	<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>
		
		<div id="fb-root"></div>
			<div id="wrapper">
				<header>
					<div id="startups-head" style="display:none;">
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
									<a class="img_header" href="<?php echo $url ?>" target="_blank"><?php the_post_thumbnail('featured_post');?></a>	
									<h4><a href="<?php the_permalink(); ?>"><?php echo short_title('...', 10); ?></a></h4>
									<!--<span class="date" style="color:#F9BE00;"><?php echo mysql2date('d.M.y', $post->post_date); ?></span>-->
								</li>
							<?php endwhile; endif; wp_reset_postdata(); ?>
						</ul>
					</section><!-- end #noticiero-head -->
					</div>

					<!-- /9262827/CODIGOESPAGUETI_978x90_SUP -->
					<div id='div-gpt-ad-1470413266734-5' style="margin-top:10px;">
						<script>
							googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470413266734-5'); });
						</script>
					</div>
					
					<div id="header" class="<?php if($objeto) echo $objeto->slug; ?>">

						<div id="header-top">

							<div id="logo">
								<a href="<?php echo bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="Código Espagueti"/></a>
							</div><!-- end #logo -->

							<div id="redes">
								<ul>
									<li><a href="https://facebook.com/SomosEspagueti" target="_blank" id="facebook">Facebook</a></li>
									<li><a href="https://twitter.com/SomosEspagueti" target="_blank" id="twitter">twitter</a></li>
									<li><a href="https://instagram.com/somosespagueti" target="_blank" id="instagram">instagram</a></li>
									<li><a href="https://www.youtube.com/channel/UCf5R9hcjXwgCMAVmhbf6aUA" target="_blank" id="youtube">youtube</a></li>
									<li><a href="https://codigoespagueti.com/rss" target="_blank" id="rss">rss</a></li>
								</ul>
							</div><!-- end #redes -->

							<div id="busqueda">

								<span id="search">search</span>

								<span id="searcho">searcho</span>
								<div id="bus">
									<form id="form_busqueda"  method="GET" action="<?php echo home_url('/'); ?>">
										<input type="text" id="search-input" name="s" value="Buscar" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';" placeholder="<?php esc_attr_e( '' ); ?>">
										<input type="submit">
								    </form><!-- form_busqueda -->
							    </div><!-- end busqueda-->
						    </div>

						</div><!-- end #header-top -->

						<nav>
							<div id="nav">
								<ul>
									<li><a href="<?php echo bloginfo('url'); ?>/startups" class="<?php if ($na == 'Startups'): echo 'select'; endif;  ?>">Startups</a></li>	
									<li><a href="<?php echo bloginfo('url'); ?>/tecnologia" class="<?php if ($na == 'Tecnología'): echo 'select'; endif;  ?>">Tecnología</a></li>
									<li><a href="<?php echo bloginfo('url'); ?>/internet" class="<?php if ($na == 'Internet'): echo 'select'; endif;  ?>">Internet</a></li>
									<li><a href="<?php echo bloginfo('url'); ?>/videojuegos" class="<?php if ($na == 'Videojuegos'): echo 'select'; endif;  ?>">Videojuegos</a></li>
									<li><a href="<?php echo bloginfo('url'); ?>/ciencia" class="<?php if ($na == 'Ciencia'): echo 'select'; endif;  ?>">Ciencia</a></li>
									<li><a href="<?php echo bloginfo('url'); ?>/cultura" class="<?php if ($na == 'Cultura'): echo 'select'; endif;  ?>">Cultura</a></li>
									<li><a href="<?php echo bloginfo('url'); ?>/opinion" class="<?php if ($na == 'Opinión'): echo 'select'; endif;  ?>">Opinión</a></li>
									<li><a href="<?php echo bloginfo('url'); ?>/resenas" class="<?php if (($na == 'resenas') or ($res == 'resenas')): echo 'select'; endif;  ?>">Reseñas</a></li>
								</ul>
							</div><!-- end #nav -->
						</nav>
						
						<div id="header-movil">
							<div id="logo-m">
            						<a href="<?php echo bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/movil_logo.png"/></a>
        					</div>

						</div>

					</div><!-- end #header -->

				</header>

			<div id="container" class="cf">