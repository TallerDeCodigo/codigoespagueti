				<?php if(!is_single()) { ?>
				<div class="content-bottom">
					<ul>
						<?php
						$categories = array();

						$categories[0] = get_cat_ID( 'Noticias' );
						$categories[1] = get_cat_ID( 'Reseñas' );
						$categories[2] = get_cat_ID( 'Opinión' );
						$categories[3] = get_cat_ID( 'Entrevistas' );
						$categories[4] = get_cat_ID( 'Estamos leyendo' );

						$args = array(
							'type'       => 'post',
							'oderby'     => 'slug',
							'exclude'    => $categories,
							'hide_empty' => 0
						);
						$cats_footer= get_categories($args);
						foreach ($cats_footer as $categoria) : 

							if($categoria->cat_ID != 6){
							?>
							

							<li>
								<h5><a rel="nofollow" href="<?php echo bloginfo('url').'/'.$categoria->slug; ?>"><?php echo $categoria->name; ?></a></h5>
								<?php $argsPosts = array(
									'type'           => 'post',
									'posts_per_page' => 2,
									'category'       => $categoria->cat_ID
								);
								$foot_posts = get_posts($argsPosts);
								foreach ($foot_posts as $post) : setup_postdata($post); ?>
									<div class="post-footer">
										<span class="date"><?php echo mysql2date('d.m.y', $post->post_date); ?></span>
										<h6><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h6>
									</div><!-- end .post-footer-->
								<?php endforeach; wp_reset_query(); //termina loop posts ?>
							</li><!-- end category container -->


						<?php } endforeach; wp_reset_query(); //termina loop categorías ?>
					</ul>
				</div><!-- end #content-bottom-->
				<?php } ?>
			</div><!-- end #container -->

			<div class="banner970x90">
				<!-- /9262827/codigoespagueti_970x90_inf -->
				<div id='div-gpt-ad-1470413266734-4' style='height:90px; width:970px;'>
					<script>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470413266734-4'); });
					</script>
				</div>
			</div>
		</div><!-- end #wrapper -->
		<footer>
			<div id="footer">
				<div id="fb-foot">
					<div style="float:left; width:320px">
						<!-- <a href="http://www.codigoespagueti.com"><img src="<?php echo bloginfo('template_url'); ?>/images/logo_ce.png" alt="Código Espagueti" title="Código Espagueti" /></a> -->
					</div>	
					<div style="float:left; width:320px">
						<!-- <a href="http://www.ohmundocruel.com.mx"><img src="<?php echo bloginfo('template_url'); ?>/images/logo_omc.png" alt="OhMundoCruel!" title="OhMundoCruel!" /></a> -->
					</div>
					<div style="float:left; width:320px">
						<!-- <a href="http://www.plumasatomicas.com"><img src="<?php echo bloginfo('template_url'); ?>/images/logo_pa.png" alt="Plumas Atomicas" title="Plumas Atomicas" /></a> -->
					</div>
					<span style="float: right; margin-top: 50px">Contacto &amp; Ventas: <a href="mailto:ad@lisa.mx" style="color:#fff">contacto@codigoespagueti.com</a></span>
				</div>
			</div>
		</footer>
		<!-- google plus -->
		<script type="text/javascript">
			window.___gcfg = { lang: 'es-419' };

			(function() {
				var po = document.createElement('script');
					po.type  = 'text/javascript';
					po.async = true;
					po.src   = 'https://apis.google.com/js/plusone.js';

				var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(po, s);
			})();
		</script>
		<!--- analytics -->
		<script>
  			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  			ga('create', 'UA-43094742-1', 'auto');
  			ga('send', 'pageview');

		</script>
		
		<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"eW06j1a4ZP00U7", domain:"codigoespagueti.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=eW06j1a4ZP00U7" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->  
<!-- Begin DAx cs.js import -->
<script type="text/javascript" src="https://b.scorecardresearch.com/c2/6035759/ct.js"></script>
<!-- End DAx cs.js import -->

<!-- Estadísticas-->
<SCRIPT LANGUAGE="JavaScript1.2" SRC="https://www.esmas.com/scripts/generales.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT LANGUAGE='JavaScript1.2' SRC='https://www.esmas.com/scripts/esmas_stats.js'TYPE='text/javascript'></SCRIPT> <script language="JavaScript">doStats('esmas');</script>
<!--Termina Estadísitcas-->	
<?php wp_footer(); ?>
		
	</body>
</html>