<?php get_header();?>
    <div class="content_wrapper clear">
		<section role="main" class="main">
			<h1><?php the_title(); ?></h1>
            <?php 
				// Set up the Secondary Loop
				$query =  array( 'post_type' => 'page', 'p' => 153);
				$custom_query = new WP_Query($query);

				if($custom_query->have_posts()): while($custom_query->have_posts()): $custom_query->the_post(); 
            	$sub_title = get_field('sub_title');
				
            	if($sub_title): echo "<h2 class='subtitle'>".$sub_title[1]."</h2>"; endif; ?>
                <!-- article -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php the_content(); ?>
                </article>
                <!-- /article -->
			<?php endwhile; endif; ?>
		</section>
		<?php get_sidebar('right'); ?>
	</div><!-- end content_wrapper -->
    
<?php get_footer(); ?>