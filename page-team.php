<?php get_header();

// Set up the query
$query =  array( 
	'post_type' => array('staff'), 
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
        	<!--<img src="<?php echo $img[0];?>" alt="Team" width="100%" /> -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('clear sparks'); ?>>
            	<h1><?php the_title(); ?></h1>
            	<?php if($sub_title): echo "<h2 class='subtitle'>".$sub_title[1]."</h2>"; endif; ?>
				<?php the_content(); ?>
			</article>
			<?php endwhile; endif; ?>
            <div class="grid clear grid-sparks">
            	<div class="grid-sizer"></div>
            <?php 
				//Loop through the Live Sparks
		   		if($custom_query->have_posts()): while($custom_query->have_posts()): $custom_query->the_post();
                //Set Up Field Values
				$title = get_field('title');
				$manifesto = get_field('manifesto');
				$obsession = get_group('obsessions');
				$img = get_field('grid_image');
				$count = count($obsession);
				$rand = rand(1, $count);
				?>
                	<div class="tile left animate" data-type="<?php echo get_post_type($post->ID); ?>">
                    <div class="inner">
                    	<div class='img-wrap'><img src="<?php echo $img[1]['original'];?>" alt="<?php echo get_the_title();?>" /><h3><span class='tagline'><?php echo get_the_title();?></span></h3></div>
                    	<div class="tile-copy animate">
                        	<h3><?php echo $title[1];?></h3>
                            <p><?php echo $manifesto[1]; ?></p>
                            <a href="<?php echo get_permalink(); ?>" title="<?php the_title();?>" class="button reverse">Read More</a>
                    	</div><!-- end tile-copy -->
                        </div><!-- end inner -->
                	</div><!-- end tiles -->
                    <div class="tile left animate" data-type="obsession">
                        <div class="inner">
                            <div class='img-wrap'>
                                <img src="<?php echo $obsession[$rand]['obsessions_image'][1]['original'];?>" />
                                <h3><span class="tagline">Obsession</span></h3>
                            </div>
                            <div class="tile-copy animate">
                                <h3><?php echo $obsession[$rand]['obsessions_title'][1]?></h3>
                                <?php echo $obsession[$rand]['obsessions_copy'][1]; ?>
                                <div class="font-pnova"><?php echo get_the_title();?></div>
                            </div><!-- end tile-copy -->
                        </div><!-- end inner -->
                    </div><!-- end tiles -->
				<?php endwhile; endif; ?><?php wp_reset_query(); ?>

            </div><!-- end grid -->

		</section>
	</div><!-- end content_wrapper -->
    
<?php get_footer(); ?>