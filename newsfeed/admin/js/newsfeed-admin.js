(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	/*
	* Map code for display and search for locations
	*/ 
	 document.addEventListener('DOMContentLoaded', init);

	 function init() {
		 if (jQuery('#lat').length > 0 && jQuery('#long').length > 0) {
			 var lat = jQuery('#lat').val();
			 var long = jQuery('#long').val();
		 } else {
			 var lat = 0;
			 var long = 0;
		 }
            
            var maxBounds = [
    [5.499550, -167.276413], //Southwest
    [83.162102, -52.233040]  //Northeast
];
		debugger;
		 var map = L.map('locationid').setView([lat, long], 5);

		 var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		     'maxBounds': maxBounds,
			 maxZoom: 18,
			 attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
				 'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			 id: 'mapbox/streets-v11',
			 tileSize: 512,
			 zoomOffset: -1
		 }).addTo(map);
		 map.setMaxBounds(maxBounds);
		 var marker = L.marker([lat, long]).addTo(map)
		 //click om map add marker
		 function onMapClick(e) {
			 marker.setLatLng(e.latlng);
			 var lat = marker.getLatLng().lat;
			 var long = marker.getLatLng().lng;
			 document.getElementById('lat').value = lat;
			 document.getElementById('long').value = long;
		 }
		 map.on('click', onMapClick);

		 var searchControl = new L.esri.Controls.Geosearch().addTo(map);
		 var results = new L.LayerGroup().addTo(map);
		 L.control.scale().addTo(map);
		 // 
		 var searchLayer = L.layerGroup().addTo(map);

		 //... adding data in searchLayer ...


		 searchControl.on('results', function(data) {
			 results.clearLayers();
			 for (var i = data.results.length - 1; i >= 0; i--) {
				 marker.setLatLng(data.results[i].latlng);
				 //set lat and long
				 document.getElementById('lat').value = data.results[i].latlng.lat;
				 document.getElementById('long').value = data.results[i].latlng.lng;
			 }
		 });
	 }
	 /* *
	 * End of map code
	 */
	 /*======================================Image Gallery=============================================*/
	 /*
	 * start of Image Gallery code
	 */
	 jQuery(document).ready(function($) {
		var file_frame;
		var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
		var set_to_post_id; // Set to this post_id
		jQuery('.add_gallery_images').on('click', function(event) {
			event.preventDefault();
			var $this = $(this);
			// If the media frame already exists, reopen it.
			if (file_frame) {
				// Set the post ID to what we want
				file_frame.uploader.uploader.param('post_id', set_to_post_id);
				// Open frame
				file_frame.open();
				return;
			} else {
				// Set the wp.media post id so the uploader grabs the ID we want when initialised
				wp.media.model.settings.post.id = set_to_post_id;
			}
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: $this.data('uploader_title'),
				button: {
					text: $this.data('uploader_button_text')
				},
				multiple: true
			});
			// When an image is selected, run a callback.
			file_frame.on('select', function() {
				// We set multiple to false so only get one image from the uploader
				//attachment = file_frame.state().get('selection').first().toJSON();
				let images = file_frame.state().get('selection').toJSON();
				let ids = "";
				//foreach attachment
				let ul = "<ul>";
				let length = document.querySelectorAll("[data-value]").length;
				images.forEach(function(image, index) {
					//check if image is already in gallery
					if (ids.indexOf(image.id) == -1) {
						ids += image.id + ",";
					}

					var attachment_url = image.url;
					var attachment_id = image.id;
					let image2 = '<li class="image" data-attachment_id="' + attachment_id + '"> ';
					image2 += '<img src="' + attachment_url + '"  width="200px" height="200px" />';
					image2 += '<ul class="actions">';
					image2 += '<li><a href="#" class="delete" title="Delete image" data-value="' + ((index + 1) + length) + '" >Delete</a></li>';
					image2 += '</ul>';
					image2 += '</li>';
					ul += image2;
				});
				//check if id image is already in gallery
				//image_gallery add new ids
				if (length > 0) {
					ids = "," + ids;

				}
				document.getElementById('image_gallery').value += ids;
				ul += "</ul>";
				$('#img').append(ul);
				wp.media.model.settings.post.id = wp_media_post_id;
			});
			// Finally, open the modal
			file_frame.open();
		});
		// Restore the main ID when the add media button is pressed
		jQuery('a.add_media').on('click', function() {
			wp.media.model.settings.post.id = wp_media_post_id;
		});
		// Delete image
		$('.gallery_image').on('click', 'a.delete', function() {
			//remove prev li 
			//$(this).prev('li').remove();
			//get image_gallery value to array
			let image_gallery = $('#image_gallery').val().split(',');
			//get index of image
			let index = $(this).data('value');
			//remove image from array
			image_gallery.splice(index - 1, 1);
			//set image_gallery value to string
			$('#image_gallery').val(image_gallery.join(','));
			$(this).closest('li.image').remove();
			return false;
		});
	});
	/*==========================================End of Image Gallery==========================================*/

	 

})( jQuery );
