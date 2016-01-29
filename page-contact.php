<?php get_header();?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
        <?php 
		//Get post thumbnail URL
		$img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'original');
		// Set up Magic Fields
		$sub_title = get_field('sub_title')
		?>
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        	<img src="<?php echo $img[0];?>" alt="Contact Us" width="100%" />
			<article id="post-<?php the_ID(); ?>" <?php post_class('clear contact basic-page'); ?>>
            	<h1><?php the_title(); ?></h1>
            	<?php if($sub_title): echo "<h2 class='subtitle'>".$sub_title[1]."</h2>"; endif; ?>
				<?php the_content(); ?>
			</article>
			<!-- /article -->
			<?php endwhile; endif; ?>
            <div id="map" style="height:360px;"></div><!-- end #map -->

		</section>
	</div><!-- end content_wrapper -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
	var map = null;
      function initialize() {
        var mapCanvas = document.getElementById('map');
		var myLatLng = new google.maps.LatLng(33.916519, -118.40535);
        var mapOptions = {
          center: new google.maps.LatLng(33.916519, -118.413854),
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        map = new google.maps.Map(mapCanvas, mapOptions);
		var iconBase = 'http://dev-pspark-site.pantheon.io/wp-content/themes/pspark/img/';
		var marker = new google.maps.Marker({
		  position: myLatLng,
		  map: map,
		  icon: iconBase + 'map-icon.png'
		});
		map.set('styles', [
			{
				featureType: 'road.local',
				elementType: 'geometry',
				stylers: [
				  { color: '#f2f2f2' },
				  { weight: .1 }
				]
			  },
			  {
				featureType: 'road.local',
				elementType: 'labels.text',
				stylers: [
				  { color: 'transparent' },
				  { weight: 0 },
				  { visibility: 0}
				]
			  },
			  {
				featureType: 'road.arterial',
				elementType: 'all',
				stylers: [
				  { color: '#a47587' },
				  { weight: .3 },
				  { visibility: 0}
				]
			  },
			  {
				featureType: 'road.arterial',
				elementType: 'labels',
				stylers: [
				  { color: 'transparent' },
				  { weight: .01 },
				  { visibility: 'off'}
				]
			  },
			  {
				featureType: 'road.highway',
				elementType: 'all',
				stylers: [
				  { color: '#a47587' },
				  { weight: .4 }
				]
			  },
			  {
				featureType: 'water',
				elementType: 'all',
				stylers: [
				  { color:'#f5aec4' }
				]
			  },
			  {
				featureType: 'poi',
				elementType: 'all',
				stylers: [
				  { color:'#f2f2f2' }
				]
			  },
			 ]);
 

      }
      google.maps.event.addDomListener(window, 'load', initialize);
	  
	  google.maps.event.addDomListener(window, "resize", function() {
			var center = map.getCenter();
			google.maps.event.trigger(map, "resize");
			map.setCenter(center); 
		});
		
    </script>

<?php get_footer(); ?>