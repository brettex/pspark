<?php get_header(); ?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			<?php endwhile; endif; ?>
		</section>
	</div><!-- end content_wrapper -->
<?php get_footer(); ?>