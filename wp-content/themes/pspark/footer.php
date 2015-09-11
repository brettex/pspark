<?php // Footer File  ?>
        <footer class="footer clear" role="contentinfo">
            <div class="left clear">
            	<a href="<?php echo home_url(); ?>" class="footer-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-light.png" alt="Logo" class="logo-img">
                </a>
                <p>
                	<?php echo get_option('address'); ?><br />
                    +<?php echo get_option('phone'); ?> main<br />
                    <a href="mailto:<?php echo get_option('phone2'); ?>"><?php echo get_option('phone2'); ?></a>
                </p>
            </div><!-- end left --> 
        	<div class="right clear">
                <ul class="social right clear">
                    <li class="icon"><a href="<?php echo get_option('fburl'); ?>" class="fb"><i class="fa fa-facebook"></i></a></li>
                    <li class="icon"><a href="<?php echo get_option('twitter'); ?>" class="tw"><i class="fa fa-twitter"></i></a></li>
                    <li class="icon"><a href="<?php echo get_option('linkedin'); ?>" class="li"><i class="fa fa-linkedin"></i></a></li>
                </ul>	
                <p class="copyright">&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?> All Rights Reserved.</p>		
        	</div><!-- end right -->
        </footer><!-- /footer -->
    </div><!-- /wrapper -->
		<?php wp_footer(); ?>
		
		<!-- analytics -->
		<script>
		/*
			var _gaq=[['_setAccount','UA-XXXXXXXX-XX'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)})(document,'script');
			*/
		</script>
	
	</body>
</html>