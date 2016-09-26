(function($){

	"use strict";

	$(function(){


	// UPLOADING FILES CALLBACK FUNCTIONS //////////////////////////////////


		var save_attachment = function (attachment) {

			var post_id = $('#current-post-id').val();

			var jqxhr = $.ajax({
				type: 'POST',
				url: ajax_url,
				data: {
					attachment: attachment,
					post_id: post_id,
					action: 'save_imagen_ficha_tecnica'
				}
			});

			jqxhr.done(function (data, textStatus, jqXHR) {
				display_image(data);
			});
		};


		function display_image (imagen) {
			$('#contenedor-imagen-ficha-tecnica').empty().append( $(imagen.replace(/\\/g, '')) );
			$('#borrar-imagen-ficha-tecnica').show();

		}


	// UPLOADING FILES  ////////////////////////////////////////////////////


		var file_frame, attachment;

		$('.upload_image_button').live('click', function (e) {

			e.preventDefault();

			if ( file_frame ) {
				file_frame.open(); return;
			}

			// Crear el media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: $(this).data('uploader_title'),
				button: {
					text: $(this).data('uploader_button_text'),
				},
				multiple: false
			});

			file_frame.on('select', function(){
				attachment = file_frame.state().get('selection').first().toJSON();
				save_attachment(attachment);

			});

			// open the modal
			file_frame.open();
		});


	// ELIMINAR UNA IMAGEN DE FICHA TECNICA ////////////////////////////////////

		$('#borrar-imagen-ficha-tecnica').on('click', function () {
			var post_id = $('#current-post-id').val();

			var jqxhr = $.ajax({
				type: 'POST',
				url: ajax_url,
				data: {
					post_id: post_id,
					action: 'delete_imagen_ficha_tecnica'
				}
			});

			jqxhr.done(function (data, textStatus, jqXHR) {
				$('#contenedor-imagen-ficha-tecnica').empty();
				$('#borrar-imagen-ficha-tecnica').hide();
			});

		});

		/**
		 * Guardar metadata de sopitas RSS feed
		 */
		$('.mandar_a_sopitas_checkbox').on('change', function () {

			var jqxhr = $.ajax({
				type: 'POST',
				url: ajax_url,
				data: {
					post_id: $(this).data('post_id'),
					checked: $(this).is(':checked'),
					action: 'ajax_update_post_meta'
				},
				dataType:'JSON'
			});
		});



	}); // end

})(jQuery);