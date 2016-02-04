<?php get_header();
 //Uncomment these to Turn on Errors for this page
	ini_set('display_errors','on');
	error_reporting(E_ALL);
	
	$query =  array( 'post_type' => 'homepage', 'posts_per_page' => 1);
	$custom_query = new WP_Query($query);

	if($custom_query->have_posts()): while($custom_query->have_posts()): $custom_query->the_post();
	
	$promo = get_group('home_promo');
	$img = $promo[1]['home_promo_image'][1]['original'];
 ?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
            <div class="home-promo clear" style="background-image:url(<?php echo $img;?>);">
            	<div class="blur" style="background-image:url(<?php echo $img;?>);"></div>
            	<div class="box clear">
                		<span class="title">Feature</span>
                        <h2>Complexity, Simplified</h2>
                        <p>Design makes complex data meaningful and actionable.</p>
                        <a href="#" class="button left pink">See Case Study</a>
                </div><!-- end box -->
            </div><!-- end home promo -->
            <div class="taglines">	
            	<h1><?php bloginfo('description'); ?></h1>
                <h2><?php echo get_option('taglineheader'); ?></h2>
            </div><!-- end tag lines -->
            <div class="hp-grid clear">
            </div><!-- end hp-grid -->
		</section>
	</div><!-- end content_wrapper -->
    <?php endwhile; endif; ?><?php wp_reset_query(); ?>
    <script>
		jQuery(document).ready( function(){
		});
		//Add Modernizr test
		Modernizr.addTest('isiphone', function(){
			return navigator.userAgent.match(/(iPhone)/g) ? true : false
		});

	</script>
    
<?php get_footer(); ?>