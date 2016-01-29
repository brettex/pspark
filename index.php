<?php get_header();
 //Uncomment these to Turn on Errors for this page
	#ini_set('display_errors','on');
	#error_reporting(E_ALL);
	
	$query =  array( 'post_type' => 'homepage', 'posts_per_page' => 1);
	$custom_query = new WP_Query($query);

	if($custom_query->have_posts()): while($custom_query->have_posts()): $custom_query->the_post();
	//Get Magic Fields 
	$promo = get_group('home_promo');
	$img = $promo[1]['home_promo_image'][1]['original'];
	$meta = $promo[1]['home_promo_meta'][1];
	$title = $promo[1]['home_promo_title'][1];
	$copy = $promo[1]['home_promo_copy'][1];
	$cta = $promo[1]['home_promo_cta'][1];
	$url = $promo[1]['home_promo_url'][1];
 ?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
            <div class="home-promo clear" style="background-image:url(<?php echo $img;?>);">
            	<div class="blur" style="background-image:url(<?php echo $img;?>);"></div>
            	<div class="box clear">
                		<span class="title"><?php echo $meta;?></span>
                        <h2><?php echo $title; ?></h2>
                        <p><?php echo $copy;?></p>
                        <a href="<?php echo $url;?>" class="button left pink"><?php echo $cta; ?></a>
                </div><!-- end box -->
            </div><!-- end home promo -->
            <div class="taglines">	
            	<h1 class="font-caslon"><em><?php bloginfo('description'); ?></em></h1>
                <h2><?php echo get_option('taglineheader'); ?></h2>
            </div><!-- end tag lines -->
			
			<?php endwhile; endif; ?><?php wp_reset_query(); ?>
            <div class="grid clear home-grid">
            <?php
			// Set up the Grid query
			$gridQuery =  array( 
				'post_type' => array('post','job_listing','creative','case_study'), 
				'posts_per_page' => 12,  
				'orderby' => 'rand'
				);
				$grid = new WP_Query($gridQuery);
				
			if($grid->have_posts()): while($grid->have_posts()): $grid->the_post(); ?>
            	<div class="tile left animate<?php if(!has_post_thumbnail()) echo ' noImage';?>" data-type="<?php echo get_post_type($post->ID); ?>">
                    <div class="inner">
                    <?php 
					$hasImage = false;
					// If its a case study, grab the square image
					if(get_post_type($post->ID) == 'case_study'){
						$image = get_field('grid_image');
						$hasImage = true;
						echo "<div class='img-wrap'><img src='".$image[1]['original']."' />".getTagline(get_post_type($post->ID)) . "</div>";
						
					//Else just user the post thumbnail image
					}elseif(has_post_thumbnail()){ 
						echo "<div class='img-wrap'>". get_the_post_thumbnail($post->ID, 'original') . getTagline(get_post_type($post->ID)) . "</div>";
						$hasImage = true; 
					}
					?>
                    	<div class="tile-copy animate">
                        	<h3><?php the_title();?></h3>
                            <?php echo getTileCopy($post->ID, $hasImage);?>
                    	</div><!-- end tile-copy -->
                    </div><!-- end inner -->
                </div><!-- end tiles -->            
            <?php endwhile; endif; ?><?php wp_reset_query(); ?>
        	</div><!-- end hp-grid -->
		</section>
	</div><!-- end content_wrapper -->
    
<?php get_footer(); ?>