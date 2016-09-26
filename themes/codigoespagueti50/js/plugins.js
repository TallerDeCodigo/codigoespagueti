// Avoid `console` errors in browsers that lack a console.
	(function() {
		var method;
		var noop = function () {};
		var methods = [
			'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
			'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
			'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
			'timeStamp', 'trace', 'warn'
		];
		var length = methods.length;
		var console = (window.console = window.console || {});

		while (length--) {
			method = methods[length];

			// Only stub undefined methods.
			if (!console[method]) {
				console[method] = noop;
			}
		}
	}());





/**************************************************
	  __                _                 _
	 / _| __ _  ___ ___| |__   ___   ___ | | __
	| |_ / _` |/ __/ _ \ '_ \ / _ \ / _ \| |/ /
	|  _| (_| | (_|  __/ |_) | (_) | (_) |   <
	|_|  \__,_|\___\___|_.__/ \___/ \___/|_|\_\

 **************************************************/

	(function(d, s, id) {
		  var js,
		      fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
			js     = d.createElement(s);
			js.id  = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=562472433795086";
		  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));



/**************************************************
		 _            _ _   _
		| |___      _(_) |_| |_ ___ _ __
		| __\ \ /\ / / | __| __/ _ \ '__|
		| |_ \ V  V /| | |_| ||  __/ |
		 \__| \_/\_/ |_|\__|\__\___|_|

 **************************************************/


(function(d,s,id){
	var js,
		fjs = d.getElementsByTagName(s)[0],
		p   = /^http:/.test(d.location) ? 'http' : 'https';

	if ( ! d.getElementById(id) ) {
		js     = d.createElement(s);
		js.id  = id;
		js.src = p+'://platform.twitter.com/widgets.js';
		fjs.parentNode.insertBefore(js,fjs);
	}
})(document, 'script', 'twitter-wjs');



/**************************************************
	            _             _
	__   _____ | |_ __ _  ___(_) ___  _ __
	\ \ / / _ \| __/ _` |/ __| |/ _ \| '_ \
	 \ V / (_) | || (_| | (__| | (_) | | | |
	  \_/ \___/ \__\__,_|\___|_|\___/|_| |_|

 **************************************************/


	(function($){

		"use strict";

		$(function(){

			window.VoteSlider = {
				Slider: {}
			};

			/**
			 * Crea el slider con jquery-ui
			 * Elementos necesarios: div#slider-ui, button#save-vote
			 */
			VoteSlider.init = function (id) {
				this.Slider = $('div#slider-ui').slider({
					range: 'min',
					min: 1,
					max: 10,
					change: function( event, ui ) {
						$(id).text(ui.value);
					}

				});
			};

			/**
			 * Regresa el valor seleccionado en el slider
			 */
			VoteSlider.getValue = function () {
				return this.Slider.slider( 'option', 'value' );
			};

			/**
			 * Valida que el numero sea un entero del 0 al 10
			 */
			VoteSlider.validate = function () {
				var vote_value = parseInt(this.getValue(), 10);
				return ( vote_value <= 10 && vote_value >= 0 );
			};

			/**
			 * Ajax guarda el valor del voto en la base de datos
			 */
			VoteSlider.save = function () {
				var vote_value = this.getValue(),
					post_id    = $('#slider-ui').data('post_id');

				if( this.validate() ){
					return $.post( ajax_url, {
						post_id : post_id,
						value   : vote_value,
						action  : 'mq_save_vote_data'
					}, 'json' );
				}else{
					console.log('valor debe ser un numero entre 0 y 10');
				}
			};

		});

	})(jQuery);

/*! tinycarousel - v2.1.6 - 2014-07-07
 * http://www.baijs.com/tinycarousel
 *
 * Copyright (c) 2014 Maarten Baijs <wieringen@gmail.com>;
 * Licensed under the MIT license */

!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?a(require("jquery")):a(jQuery)}(function(a){function b(b,e){function f(){return i.update(),i.move(i.slideCurrent),g(),i}function g(){i.options.buttons&&(n.click(function(){return i.move(--t),!1}),m.click(function(){return i.move(++t),!1})),a(window).resize(i.update),i.options.bullets&&b.on("click",".bullet",function(){return i.move(t=+a(this).attr("data-slide")),!1})}function h(){i.options.buttons&&!i.options.infinite&&(n.toggleClass("disable",i.slideCurrent<=0),m.toggleClass("disable",i.slideCurrent>=i.slidesTotal-r)),i.options.bullets&&(o.removeClass("active"),a(o[i.slideCurrent]).addClass("active"))}this.options=a.extend({},d,e),this._defaults=d,this._name=c;var i=this,j=b.find(".viewport:first"),k=b.find(".overview:first"),l=0,m=b.find(".next:first"),n=b.find(".prev:first"),o=b.find(".bullet"),p=0,q={},r=0,s=0,t=0,u="x"===this.options.axis,v=u?"Width":"Height",w=u?"left":"top",x=null;return this.slideCurrent=0,this.slidesTotal=0,this.update=function(){return k.find(".mirrored").remove(),l=k.children(),p=j[0]["offset"+v],s=l.first()["outer"+v](!0),i.slidesTotal=l.length,i.slideCurrent=i.options.start||0,r=Math.ceil(p/s),k.append(l.slice(0,r).clone().addClass("mirrored")),k.css(v.toLowerCase(),s*(i.slidesTotal+r)),i},this.start=function(){return i.options.interval&&(clearTimeout(x),x=setTimeout(function(){i.move(++t)},i.options.intervalTime)),i},this.stop=function(){return clearTimeout(x),i},this.move=function(a){return t=a,i.slideCurrent=t%i.slidesTotal,0>t&&(i.slideCurrent=t=i.slidesTotal-1,k.css(w,-i.slidesTotal*s)),t>i.slidesTotal&&(i.slideCurrent=t=1,k.css(w,0)),q[w]=-t*s,k.animate(q,{queue:!1,duration:i.options.animation?i.options.animationTime:0,always:function(){b.trigger("move",[l[i.slideCurrent],i.slideCurrent])}}),h(),i.start(),i},f()}var c="tinycarousel",d={start:0,axis:"x",buttons:!0,bullets:!1,interval:!1,intervalTime:3e3,animation:!0,animationTime:1e3,infinite:!0};a.fn[c]=function(d){return this.each(function(){a.data(this,"plugin_"+c)||a.data(this,"plugin_"+c,new b(a(this),d))})}});