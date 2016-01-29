<?php get_header();?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
        <?php 
		//Get post thumbnail URL
		$img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'original');
		// Set up Magic Fields
		$subContent = get_group('sub_content'); //Sub Content -  3x
		$statistic = get_group('statistic'); //Statistic
		$statValue = $statistic[1]['statistic_value'][1]; 
		$statLabel = $statistic[1]['statistic_label'][1]; 
		$quote = get_group('quote'); // Quote
		$quoteCopy = $quote[1]['quote_copy'][1];
		$quoteAuthor = $quote[1]['quote_author'][1];
		$rightSidebar = get_group('right_sidebar');
		$rightSidebarTitle = $rightSidebar[1]['right_sidebar_title'][1];
		$rightSidebarCopy = $rightSidebar[1]['right_sidebar_copy'][1];
		$tagline = get_field('tagline');
		
		?>
        	<div class="case-study-top clear">
            	<img src="<?php echo $img[0];?>" width="100%" />
            	<div class="blur" style="background-image:url(<?php echo $img[0];?>);"></div>
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('left'); ?>>
                    <span class="tagline"><?php echo $tagline[1]; ?></span><!-- end tagline -->
                    <h1><?php the_title(); ?></h1> 
                    <?php
                        $sub_title = get_field('sub_title');
                        if($sub_title): echo "<h2 class='subtitle'>".$sub_title[1]."</h2>"; endif; 
						echo "<div class='copy'>";
                        the_content();
						echo "</div>"; 
                    ?>
                </article>
                <aside class="left">
                    <h4><?php echo $rightSidebarTitle; ?></h4>
                    <p><?php echo $rightSidebarCopy; ?></p>
                </aside>
            </div><!-- end .case-study-top -->
            <?php if($quoteCopy){ ?>
            <div class="quote full-width">
            	<blockquote><?php echo trim(strip_tags($quoteCopy, '<br>'));?></blockquote>
                <?php if($quoteAuthor){ ?>
                <div class="author"><?php echo $quoteAuthor;?></div><!-- end author -->
                <?php } ?>
            </div>
            <?php } ?>
            <div class="sub-content">
                <div class="clear">
                	<div class="sub-title left <?php echo strtolower($subContent[1]['sub_content_align'][1]);?>">
                    	<?php echo $subContent[1]['sub_content_title'][1]; ?>
                    </div><!-- end sub title -->
                	<div class="sub-copy left">
                    	<?php echo $subContent[1]['sub_content_copy'][1]; ?>
                    </div><!-- end sub-copy -->
                </div><!-- end clear --> 
                <img src="<?php echo $subContent[1]['sub_content_image'][1]['original']; ?>" />             
            </div><!-- end sub-content -->
            
            <?php if($statistic){ ?>
            <div class="stat full-width">
            	<strong><?php echo $statValue;?></strong>
                <span><?php echo $statLabel;?></span>
            </div><!-- end stat -->
            <?php } ?>

            <?php foreach($subContent as $key => $sub){ 
				//Skip the first 1 
				if($key > 1){
			?>	
                <div class="sub-content">
                    <div class="clear">
                        <div class="sub-title <?php echo strtolower($sub['sub_content_align'][1]);?>">
                            <?php echo $sub['sub_content_title'][1]; ?>
                        </div><!-- end sub title -->
                        <div class="sub-copy left">
                            <?php echo $sub['sub_content_copy'][1]; ?>
                        </div><!-- end sub-copy -->
                    </div><!-- end clear -->
                    <img src="<?php echo $sub['sub_content_image'][1]['original']; ?>" />              
                </div><!-- end sub-content --> 
                      
            <?php 
				}//End if 
			}//End foreach loop
			?>
			<?php endwhile; endif; ?>
           <?php $links = getPrevNextLinks('case_study', $post->ID); ?>
           <nav class="prev-next clear">
                <a class="left" href="<?php echo $links['prev']; ?>">< Previous Case Study</a>
                <a class="right" href="<?php echo $links['next']; ?>">Next Case Study ></a>
           </nav>
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