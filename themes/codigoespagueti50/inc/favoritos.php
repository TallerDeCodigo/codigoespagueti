<?php


	namespace Favoritos;


	class Posts {

		protected $wpdb;

		public function __construct()
		{
			global $wpdb;
			$this->wpdb = &$wpdb;
		}


		public function getFechaLimite()
		{
			return date('Y-m-d H:i:s', strtotime('-10 days'));
		}


		public function get_from_last_week()
		{
			$fecha_limite = $this->getFechaLimite();
			$url_site = site_url();

			return $this->wpdb->get_results(
				"SELECT p.*, CONCAT('$url_site/',IF(p.post_type='post','noticias',p.post_type),'/',p.post_name,'/') AS permalink
					FROM wp_posts AS p
						WHERE p.post_date > '$fecha_limite'
							AND p.post_status = 'publish';", OBJECT
			);
		}



		public function sort_objects_by_comments($a, $b)
		{
			if($a->comments == $b->comments){ return 0 ; }
			return ($a->comments > $b->comments) ? -1 : 1;
		}


		public function sort_objects_by_shares($a, $b)
		{
			if($a->shares == $b->shares){ return 0 ; }
			return ($a->shares > $b->shares) ? -1 : 1;
		}



		public function get_permalinks($list = array())
		{
			$permalinks = wp_list_pluck($list, 'permalink');
			return $permalinks ? $permalinks : array();
		}

	}





	class Facebook extends Posts {


		public $entradas;


		public $gustados, $comentados;


		public function __construct()
		{
			parent::__construct();
		}


		public function get_facebook_data($permalinks)
		{
			if ( empty($permalinks)) return array();

			$permalinks = (array)$permalinks;
			$permalinks = implode(',', $permalinks);
			$results    = file_get_contents("http://graph.facebook.com/?ids=$permalinks");

			return json_decode($results);
		}


		public function getComentados()
		{
			if ( $this->comentados = get_transient('posts_mas_comentados') )
				return $this->comentados;

			$this->comentados = $this->get_from_last_week();
			$permalinks       = $this->get_permalinks( $this->comentados );
			$results          = $this->get_facebook_data( $permalinks );
			$results          = (array)$results;

			foreach ($this->comentados as $index => &$entrada) {

				if ( isset($results[ $entrada->permalink ]->comments) )
					$entrada->comments = $results[ $entrada->permalink ]->comments;
			}

			@usort( $this->comentados, array('Favoritos\Facebook', 'sort_objects_by_comments') );

			set_transient( 'posts_mas_comentados', $this->comentados, 3600 );

			return $this->comentados;
		}



		public function getGustados()
		{
			if ( $this->gustados = get_transient('posts_mas_gustados') )
				return $this->gustados;

			$this->gustados = $this->get_from_last_week();
			$permalinks     = $this->get_permalinks( $this->gustados );
			$results        = $this->get_facebook_data( $permalinks );
			$results        = (array)$results;

			foreach ($this->gustados as $index => &$entrada) {
				if ( isset($results[ $entrada->permalink ]->shares) )
					$entrada->shares = $results[ $entrada->permalink ]->shares;
			}

			@usort( $this->gustados, array('Favoritos\Facebook', 'sort_objects_by_shares') );

			set_transient( 'posts_mas_gustados', $this->gustados, 3600 );

			return $this->gustados;
		}
	}
