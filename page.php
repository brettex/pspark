<?php
/*
	Template Name: Would You?
*/
?>
<?php get_header();?>
	
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
            	<?php if($sub_title): echo "<h2 class='subtitle'>".$sub_title[1]."</h2>"; endif; ?>
				<?php the_content(); ?>
			</article>
			<!-- /article -->
            <?php if($sub_content){ ?>
                <div class="sub-content">
                	<?php echo $sub_content[1]; ?>
                </div><!-- end sub-content -->
            <?php } ?>
			<?php endwhile; endif; ?>

		</section>
	</div><!-- end content_wrapper -->
    
<?php get_footer(); ?>