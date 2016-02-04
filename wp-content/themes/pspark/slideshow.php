<?php get_header();
/*
	Template Name: Slideshow Template

*/
 // Uncomment these to Turn on Errors for this page
	#ini_set('display_errors','on');
	#error_reporting(E_ALL);
?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
			<h1><?php the_title(); ?></h1>
			<?php if (have_posts()): while (have_posts()) : the_post();
            	$sub_title = get_field('sub_title');
            	if($sub_title): echo "<h2 class='subtitle'>".$sub_title[1]."</h2>"; endif; ?>
			<!-- article -->
            <?php
				// Get Slides
				$slides = get_group('slide');
				if($slides): 
			?>
                <div class="cycle-slideshow"
    					data-cycle-fx="scrollHorz"
    					data-cycle-pause-on-hover="true"
    					data-cycle-speed="750"
                        data-cycle-manual-speed="250"
                        data-cycle-timeout="0"
                		data-cycle-swipe=true
                		data-cycle-pager=".cycle-pager"
                        data-cycle-slides="img"
    					data-cycle-pager-template="<span></span>"
    				>
					<?php foreach($slides as $slide){ ?>
                        <img src="<?php echo $slide['slide_image'][1]['original'];?>" class="item" />
                    <?php } // end foreach ?> 
                    <div class="cycle-prev"><i class="btr bt-circle-arrow-left"></i></div> 
                    <div class="cycle-pager"></div>
                    <div class="cycle-next"><i class="btr bt-circle-arrow-right"></i></div>  
                </div><!-- end slide wrap -->
            <?php endif; ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			<!-- /article -->
			<?php endwhile; endif; ?>
            <?php 
				echo '<h3 class="border-bottom">'.get_menu_parent(5, $post->ID).'</h3>';
				wp_nav_menu( array(
					  'theme_location' => 'header-menu',
					  'sub_menu' => true,
					  'show_parent' => true,
					  'menu_class' => 'menu bottom-sub-nav clear',
					) );
			?>

		</section>
		<?php get_sidebar('right'); ?>
	</div><!-- end content_wrapper -->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jcycle2.min.js"></script>
    
<?php get_footer(); ?>