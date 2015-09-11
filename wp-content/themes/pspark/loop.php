<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
<article id="post-<?php the_ID(); ?>" <?php post_class('excerpt-version'); ?>>
<?php 
	$link = "<a href='".get_permalink($post->ID)."' title='".get_the_title()."'>";
	$source = get_the_author($post->ID);
	// Some Press Releases might be an external article, so link them off to that site!
	#echo types_render_field('article-url');
	if(types_render_field('article-url', array('output' => 'raw')) != ''){
		$link = "<a href='".types_render_field('article-url', array('output' => 'raw'))."' title='".get_the_title()."' target='_blank'>";
	}
	if(types_render_field('source', array('output' => 'raw')) != ''){
		$source = types_render_field('source', array('output' => 'raw'));
	}
?>
	<?php if(has_post_thumbnail()) the_post_thumbnail('original'); ?>
	<div class="clear<?php if(has_post_thumbnail()) echo ' has-image';?>">
		<h3><?php echo $link.get_the_title();?></a></h3>
		<div class="meta-info">
			<span><?php echo str_replace('_', ' ', get_post_type());?></span>: <time><?php the_date('F d, Y');?></time> - <span><?php echo $source; ?></span>
		</div>
		<?php bn_excerpt(30, 'Read the full story'); ?>
	</div><!-- end clear --> 
	<!--<div class="share-wrap clear">
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