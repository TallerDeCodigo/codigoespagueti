<?php 
$url=substr(substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '=')), 1);
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1, minimum-scale=1, height=device-height">
		<meta http-equiv="cleartype" content="on">
	</head>
<body style="box-sizing:border-box;margin:0;">
	<div id="fb-root"></div>
	  <script>
	  	   window.fbAsyncInit = function() {
	  	     FB.init({
	  	       appId      : '{1086508188112043}',
	  	       xfbml      : true,
	  	       version    : 'v2.5'
	  	     });

	  	    var my_video_player;
	  	    FB.Event.subscribe('xfbml.ready', function(msg) {
	  	        if (msg.type === 'video') {
	  	           my_video_player = msg.instance;
	  	        }
	  	    });
	  	   
	  	   };

	  	   (function(d, s, id){
	  	      var js, fjs = d.getElementsByTagName(s)[0];
	  	      if (d.getElementById(id)) {return;}
	  	      js = d.createElement(s); js.id = id;
	  	      js.src = "//connect.facebook.net/es_LA/sdk.js";
	  	      fjs.parentNode.insertBefore(js, fjs);
	  	    }(document, 'script', 'facebook-jssdk'));
	  </script>
	  <div class="fb-video"
	    data-href="https://www.facebook.com/facebook/videos/<?php echo $url; ?>/"
	    data-allowfullscreen="true"
	    style="box-sizing:border-box;width:100%;"></div>
</body>
</html>