<?php get_header();?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
			<h1><?php the_title(); ?></h1>
			<?php if (have_posts()): while (have_posts()) : the_post();
            	$sub_title = get_field('sub_title');
            	if($sub_title): echo "<h2 class='subtitle'>".$sub_title[1]."</h2>"; endif; ?>
			<!-- article -->
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			<!-- /article -->
			<?php endwhile; endif; ?>
            <div id="lets-talk">
            	<div class="inner clear">
                    <span class="left onDark">Like what you see?</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/coffee-cup.png" class="left" alt="Lets Talk over Coffee" />
                    <a href="<?php echo get_permalink(11); ?>" title="Let's Talk" class="button left pink">Let's Talk <i class="fa fa-angle-double-right"></i></a>
                </div><!-- end inner -->        	
            </div><!-- ennd #lets-talk -->

		</section>
	</div><!-- end content_wrapper -->
    
<?php get_footer(); ?>