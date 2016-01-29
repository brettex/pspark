<?php get_header();?>
    <div class="content_wrapper clear">
		<section role="main" class="main">
            <?php 
				// Set up the Secondary Loop
				$query =  array( 'post_type' => 'page', 'p' => 576);
				$custom_query = new WP_Query($query);

				if($custom_query->have_posts()): while($custom_query->have_posts()): $custom_query->the_post(); 
                $img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'original');
				?>
                <img src="<?php echo $img[0];?>" alt="Ideas" width="100%" />
                <!-- article -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                	<h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </article>
                <!-- /article -->
			<?php endwhile; endif; ?>
		</section>
	</div><!-- end content_wrapper -->
    
<?php get_footer(); ?>