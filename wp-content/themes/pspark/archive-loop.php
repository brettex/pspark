<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
<article id="post-<?php the_ID(); ?>" <?php post_class('excerpt-version'); ?>>
                        <h3><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                        <div class="meta-info">
                        	<span><?php echo get_post_type();?></span>: <time><?php the_date('F d, Y');?></time> - <span><?php the_author_posts_link(); ?></span>
                        </div>
                        <?php bn_excerpt(30, 'Read the full story'); ?>
                        <div class="share-wrap clear">
                            <span st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>' class='st_twitter_hcount'></span>
                            <span st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>' class='st_facebook_hcount'></span>
                            <span st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>' class='st_linkedin_hcount'></span>
                        </div><!-- end share-wrap -->
                    </article>
	
<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'pspark' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>