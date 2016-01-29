<?php get_header();

	$query =  array( 
	'post_type' => 'case_study', 
	'posts_per_page' => -1,  
	'meta_key' => 'type',
	'ignore_sticky_posts' => true,
	'orderby' => array(
		'meta_value' => 'ASC',
		'menu_order' => 'ASC',
	), 
	'post_status' => 'any');
	$custom_query = new WP_Query($query);
	
 ?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
           <?php 
		   		$i=0;
				$p=0;
		   		//Loop through the Case Studies/Projects
		   		if($custom_query->have_posts()): while($custom_query->have_posts()): $custom_query->the_post();
                //Set up the Magic Fields 
				$img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'original');
				$type = get_field('type');
				$tagline = get_field('tagline');
				$sub_title = get_field('sub_title');
				$link = get_permalink();
				$cta = "See how we did it"; //Default CTA
				if($type[1] == 'Case Study'){$cta = "See Case Study";}
				
           		if($type[1] != 'Project'){ ?>
           		<div class="row case-study clear" data-row="<?php echo $i;?>" style="background-image:url(<?php echo $img[0];?>);">
                	<img src="<?php echo $img[0];?>" width="100%" style="display:none;" />
                	<div class="copy-block clear">
                    	<span class="tagline"><?php echo $tagline[1]; ?></span><!-- end tagline -->
                       <h2><?php the_title(); ?></h2>
                       <h3><?php echo $sub_title[1];?></h3>
                       <a href="<?php echo $link;?>" title="<?php echo $cta;?>" class="button reverse left"><?php echo $cta;?></a>
                    </div><!-- end copy block -->
                </div><!-- end row -->
           <?php } else {
			   	//If first Project Were printing out
           		if($p == 0){ ?>
           		<div class="grid clear grid-projects">
                <?php } ?>
                <div class="tile left animate" data-type="<?php echo get_post_type($post->ID); ?>">
                	<div class="inner">
					<?php 
						// Get Fields
						$image = get_field('grid_image');
						$hasImage = true;
						echo "<div class='img-wrap'><img src='".$image[1]['original']."' /><h3><span class='tagline'>".$tagline[1]."</span></div>";
					?>
                        <div class="tile-copy animate">
                            <h3><?php echo get_the_title();?></h3>
                            <p><?php echo $sub_title[1];?></p>
                            <a href="<?php echo get_permalink(); ?>" title="<?php the_title();?>" class="button reverse">See Case Study</a>
                        </div><!-- end tile-copy -->
                    </div><!-- end inner -->
                </div><!-- end tiles -->
           
           
           <?php 
		   $p++;
		   } ?>

          <?php
		   
		  $i++;
		  endwhile; endif; ?><?php wp_reset_query(); ?>
          </div><!-- end grid projects -->
          <div class="clients clear">
            <div class="client" data-client="behr"></div>
            <div class="client" data-client="edmunds"></div>
            <div class="client" data-client="thetech"></div>
            <div class="client" data-client="cnb"></div>
            <div class="client" data-client="deloitte"></div>
            <div class="client" data-client="dreamworks"></div>
            <div class="client" data-client="vmware"></div>
            <div class="client" data-client="toyota"></div>
            <div class="client" data-client="sony"></div>
            <div class="client" data-client="corelogic"></div>
            <div class="client" data-client="themusiccenter"></div>
            <div class="client" data-client="nhm"></div>
          </div><!-- end clients -->
          <nav class="prev-next">
          	<a href="<?php echo get_permalink(815);?>" title="See full client list">See full client list ></a>
          </nav>
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<?php 
            //Get post thumbnail URL
            $img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'original');
            ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('clear basic-page'); ?> style="background-image:url('<?php echo $img[0];?>');">
				<?php the_content(); ?>
			</article>

			<?php endwhile; endif; ?>
		</section>
	</div><!-- end content_wrapper -->
    
<?php get_footer(); ?>