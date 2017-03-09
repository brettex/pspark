<?php get_header(); ?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
		<!-- The Title -->
		<h1><?php echo sprintf( __( '%s Search Results for ', 'pspark' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
		
		<?php get_template_part('loop'); ?>
		
		<?php get_template_part('pagination'); ?>
        </section>
        
		<?php get_sidebar('right'); ?>
	</div><!-- end content_wrapper -->
<?php get_footer(); ?>
