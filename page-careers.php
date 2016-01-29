<?php get_header();

// Set up the query
$query =  array( 
	'post_type' => array('job_listing'), 
	'posts_per_page' => -1,  
	'orderby' => 'rand'
	);
	$custom_query = new WP_Query($query);
	
?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
        <?php 
		//Get post thumbnail URL
		$img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'original');
		// Set up Magic Fields
		$sub_title = get_field('sub_title');
		$sub_content = get_field('sub_content');
		
		?>
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        	<img src="<?php echo $img[0];?>" alt="Contact Us" width="100%" />
			<article id="post-<?php the_ID(); ?>" <?php post_class('clear basic-page'); ?>>
            	<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
			<?php endwhile; endif; ?>
            <?php if($sub_title): echo "<h2 class='subtitle'>".$sub_title[1]."</h2>"; endif; ?>
            <div class="grid clear grid-sparks">
            	<div class="grid-sizer"></div>
            <?php 
				//Loop through the Live Sparks
		   		if($custom_query->have_posts()): while($custom_query->have_posts()): $custom_query->the_post();
                //Set Up Field Values
				?>
                	<div class="tile left animate<?php if(!has_post_thumbnail()) echo ' noImage';?>" data-type="job_listing">
                    <div class="inner">
                    <?php if(has_post_thumbnail()) echo "<div class='img-wrap'>". get_the_post_thumbnail($post->ID, 'original') . "<h3><span class='tagline'>".get_the_title()."</span></h3></div>"; ?>
                    	<div class="tile-copy animate">
                        	<h3><?php the_title();?></h3>
                            <p><?php the_excerpt(); ?></p>
                            <a href="<?php echo get_permalink(); ?>" title="<?php the_title();?>" class="button reverse">Get In Touch</a>
                    	</div><!-- end tile-copy -->
                        </div><!-- end inner -->
                	</div><!-- end tiles -->
					<?php endwhile; endif; ?><?php wp_reset_query(); ?>

            </div><!-- end grid -->
		</section>
	</div><!-- end content_wrapper -->

<?php get_footer(); ?>