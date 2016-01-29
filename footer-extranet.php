<?php // Footer File  ?>
        <!--<footer class="footer clear" role="contentinfo"></footer><!-- /footer -->
    </div><!-- /wrapper -->
         <!-- font awesome css -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php bloginfo('template_directory'); ?>/css/lightgallery.min.css" rel="stylesheet" />
        <!-- black tie font -->
		<!--<link rel="stylesheet" href="http://assets.primitivespark.com/css/black-tie.min.css">-->
		<?php wp_footer(); ?>
           <!-- <script src="http://assets.primitivespark.com/js/scripts.min.js"></script>
            <script src="http://assets.primitivespark.com/js/masonry.pkgd.min.js"></script>
            <script src="http://assets.primitivespark.com/js/imagesLoaded.pkgd.min.js"></script> -->
            <script src="http://assets.primitivespark.com/js/combo.js"></script>
            <script src="<?php bloginfo('template_directory'); ?>/js/lightgallery-all.min.js"></script>
        <script>
		jQuery(document).ready( function($){
			
			// Bind the filter buttons
			$('a.filter-btn').on('click', function(){
				$('a.active').removeClass('active');
				$(this).addClass('active');
				var type = $(this).data('filter');
				
				$('article').attr('data-type', type);
			});
			
			//Initiate the lighbox
			var $lg = $(".gallery");
			$lg.lightGallery({
				thumbnail: true,
				fullScreen: true,
				zoom: false,
				closable: false,
				enableDrag: false,
				startClass: 'lg-start-zoom lg-zoomed'	
			});
			
			var data = $lg.data('lightGallery');
			$lg.on('onAferAppendSlide.lg', function (event, index) {
			
				
                //  data.$items => $('#lightgallery li');
				var classToAdd = data.$items.eq(index).attr('data-class');
                //Add class to body tag 
                $('body').attr('data-type', classToAdd);
			
				// data.$slide => slides in the lightbox;
				data.$slide.eq(index).addClass(classToAdd).find('.lg-img-wrap').prepend('<div class="iphone"></div>');

				data.$slide.eq(index).on('click', function(){
					data.goToNextSlide()
				});

			}); 
		});
	</script>
		<!-- analytics -->
		<script>
			var _gaq=[['_setAccount','UA-12719728-1'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)})(document,'script')
		</script>
	
	</body>
</html>