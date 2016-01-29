<?php get_header();

// Set up the query
$query =  array( 
	'post_type' => array('post','job_listing','creative'), 
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
        	<img src="<?php echo $img[0];?>" alt="Ideas" width="100%" />
			<article id="post-<?php the_ID(); ?>" <?php post_class('clear basic-page'); ?>>
            	<h1><?php the_title(); ?></h1>
            	<?php if($sub_title): echo "<h2 class='subtitle'>".$sub_title[1]."</h2>"; endif; ?>
				<?php the_content(); ?>
			</article>
			<?php endwhile; endif; ?>
            <div class="grid clear">
            	<div class="grid-sizer"></div>
            <?php 
				//Loop through the Job Listings,Posts,Creatives
		   		if($custom_query->have_posts()): while($custom_query->have_posts()): $custom_query->the_post(); ?>
                	<div class="tile left animate<?php if(!has_post_thumbnail()) echo ' noImage';?>" data-type="<?php echo get_post_type($post->ID); ?>">
                    <div class="inner">
                    <?php if(has_post_thumbnail()) echo "<div class='img-wrap'>". get_the_post_thumbnail($post->ID, 'original') . getTagline(get_post_type($post->ID)) . "</div>"; ?>
                    	<div class="tile-copy animate">
                        	<h3><?php the_title();?></h3>
                            <?php echo getTileCopy($post->ID, has_post_thumbnail());?>
                    	</div><!-- end tile-copy -->
                        </div><!-- end inner -->
                	</div><!-- end tiles -->
				<?php endwhile; endif; ?><?php wp_reset_query(); ?>

            </div><!-- end grid -->
		</section>
	</div><!-- end content_wrapper -->
  
<?php get_footer(); ?>