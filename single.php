<?php get_header(); ?>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=9315765730";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
	
    <div class="content_wrapper clear">
		<section role="main" class="main" itemscope itemtype="http://www.schema.org/CreativeWork">
			<?php if (have_posts()): while (have_posts()) : the_post();
			// Set up the Fields 
			$authorID = get_field('staff_author');
			$authorName =  get_the_title($authorID[1]);
			?>
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://www.schema.org/Blog">
            			
            <h1 itemprop="name"><?php the_title(); ?></h1>
            <div class="meta-info">
            	<time itemprop="datePublished"><?php the_date('F d, Y');?></time> - By: 
                <a href="<?php echo get_permalink($authorID[1]);?>" title="<?php echo $authorName;?>" itemprop='author' class='fn'><?php echo $authorName;?></a>
            </div>
            
				<?php the_content(); ?>
			</article>
			<!-- /article -->

			<?php #comments_template(); ?>
			<?php endwhile; endif; ?>
            <div class="share-wrap">
            	  <h4>Share this:</h4>
                 <a href="http://rest.sharethis.com/share/sharer.php?destination=facebook&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&pub_key=a3cce920-3a6b-47a8-a890-d27d55cbc9e8&access_key=512db7bf2cce2acb63fad31b31067e27" target="_blank" class="share facebook"><i class="fa fa-facebook"></i></a>
                 <a href="http://rest.sharethis.com/share/sharer.php?destination=twitter&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&pub_key=a3cce920-3a6b-47a8-a890-d27d55cbc9e8&access_key=512db7bf2cce2acb63fad31b31067e27" target="_blank" class="share twitter"><i class="fa fa-twitter"></i></a>
                 <a href="http://rest.sharethis.com/share/sharer.php?destination=linkedin&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&pub_key=a3cce920-3a6b-47a8-a890-d27d55cbc9e8&access_key=512db7bf2cce2acb63fad31b31067e27" target="_blank" class="share linkedin"><i class="fa fa-linkedin"></i></a>
           </div>
              
            <h4>Leave a Comment</h4>
			<div class="fb-comments" data-href="<?php the_permalink();?>" data-width="100%" data-numposts="5"></div>

		</section>
	</div><!-- end content_wrapper -->
<?php get_footer(); ?>