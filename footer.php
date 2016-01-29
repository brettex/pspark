<?php // Footer File  ?>
        <footer class="footer clear" role="contentinfo">
            <div class="left clear">
            	<a href="<?php echo home_url(); ?>" class="footer-logo">
                    <img src="http://assets.primitivespark.com/img/logo-light.svg" alt="Logo" class="logo-img">
                </a>
                <p>
                	<?php echo get_option('address'); ?><br />
                    <a href="tel:<?php echo get_option('phone'); ?> ">+<?php echo get_option('phone'); ?></a> main<br />
                    <a href="mailto:<?php echo get_option('phone2'); ?>"><?php echo get_option('phone2'); ?></a>
                </p>
            </div><!-- end left --> 
        	<div class="right clear">
                <ul class="social right clear">
                    <li class="icon"><a href="<?php echo get_option('fburl'); ?>" class="fb"><i class="fa fa-facebook"></i></a></li>
                    <li class="icon"><a href="<?php echo get_option('twitter'); ?>" class="tw"><i class="fa fa-twitter"></i></a></li>
                    <li class="icon"><a href="<?php echo get_option('linkedin'); ?>" class="li"><i class="fa fa-linkedin"></i></a></li>
                </ul>	
                <p class="copyright">&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>		
        	</div><!-- end right -->
        </footer><!-- /footer -->
    </div><!-- /wrapper -->
         <!-- font awesome css -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" >
        <!-- black tie font -->
		<!--<link rel="stylesheet" href="http://assets.primitivespark.com/css/black-tie.min.css">-->
		<?php wp_footer(); ?>
           <!-- <script src="http://assets.primitivespark.com/js/scripts.min.js"></script>
            <script src="http://assets.primitivespark.com/js/masonry.pkgd.min.js"></script>
            <script src="http://assets.primitivespark.com/js/imagesLoaded.pkgd.min.js"></script> -->
            <script src="http://assets.primitivespark.com/js/combo.js"></script>
            <script>
            jQuery(document).ready( function(){
                
                //Wait till images are loaded before initializing masonry
                var $container = $('.grid');
                $container.imagesLoaded( function(){
                    $container.masonry({
                      // options
                      itemSelector: '.tile',
                      gutter:20,
                      percentPosition: true
                    });
                });
				
				$(window).resize(function () {
					$container.masonry('reloadItems');
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