<?php get_header(); ?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
			<?php echo getPostTypeLink($post->ID, false); ?> 
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <div class="meta-info">
            	<time><?php the_date('F d, Y');?></time> - By: <span><?php the_author_posts_link(); ?></span>
            </div>
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			<!-- /article -->
            <!-- post details -->
			<!--<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span class="author"><?php _e( 'Published by', 'pspark' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'pspark' ), __( '1 Comment', 'pspark' ), __( '% Comments', 'pspark' )); ?></span>
			<!-- /post details -->

			<?php #comments_template(); ?>
			<?php endwhile; endif; ?>
            <div class="share-wrap clear">
                <span st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>' class='st_twitter_hcount'></span>
                <span st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>' class='st_facebook_hcount'></span>
                <span st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>' class='st_linkedin_hcount'></span>
            </div><!-- end share-wrap -->
            
            <?php echo getPostTypeLink($post->ID, true); ?> 

		</section>
        <script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
		<script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script charset="utf-8" type="text/javascript">stLight.options({"publisher":"1df3adfa-5ff8-4297-b044-bd97f9882729"});var st_type="wordpress4.2.2";</script>
		<?php get_sidebar('right'); ?>
	</div><!-- end content_wrapper -->
<?php get_footer(); ?>