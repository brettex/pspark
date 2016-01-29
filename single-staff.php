<?php get_header();?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
        <?php 
		//Get post thumbnail URL
		$img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'original');
		// Set up Magic Fields
		$sub_title = get_field('title');
		$sub_content = get_field('sub_content');
		$obsessions = get_group('obsessions');
		$read = get_field('read');
		$linkedin = get_field('linked_in_url');
		$music = get_field('music'); 
		$email = get_field('email'); 
		$quote = get_field('quote');
		$manifesto = get_field('manifesto');
		
		//Extract First Name
		$name = get_the_title();
		$names = explode(' ', $name);
		?>
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        	<img src="<?php echo $img[0];?>" alt="<?php the_title(); ?>" class="right headshot" />
			<article id="post-<?php the_ID(); ?>" <?php post_class('clear staff-page left'); ?>>
            	<h1><?php the_title(); ?></h1>
            	<?php if($sub_title): echo "<h2 class='subtitle'>".$sub_title[1]."</h2>"; endif; ?>
                <h3>Manifesto: <?php echo $manifesto[1];?></h3>
				<?php the_content(); ?>
			</article>
            <aside class="left">
            	<div class="meta">
                	<strong>What I'm reading:</strong>
                    <?php echo $read[1]; ?>
                </div><!-- end meta -->
                <div class="meta">
                	<strong>I'm Listening to:</strong>
                    <?php echo $music[1]; ?>
                    <?php #if($names[1] == 'Exnowski') echo "&#9835; &#9836; &#9834;"; ?>
                </div><!-- end meta -->
                <div class="meta">
                	<strong>Contact Me:</strong>
                    <a href="<?php echo $linkedin[1]; ?>" title="Linked In"><i class="fa fa-linkedin-square"></i></a>
                    <a href="mailto:<?php echo encodeEmail($email[1]); ?>" title="Email"><i class="fa fa-envelope-o"></i></a>
                </div><!-- end meta -->
            </aside>
            <div class="clear"></div>
            <?php if($quote[1]){ ?>
            <div class="quote full-width">
            	<blockquote><?php echo trim($quote[1]);?></blockquote>
            </div>
            <?php } 
            //Obsessions Grid
            if($obsessions){ ?>
            <h4 class="font-caslon"><?php echo $names[0];?>'s Obsessions</h4>
            <div class="grid clear obsession-grid">
			<?php
            	foreach($obsessions as $obj){ ?>
                <div class="tile left animate" data-type="obsession">
                    <div class="inner">
                    	<div class='img-wrap'>
                        	<img src="<?php echo $obj['obsessions_image'][1]['original'];?>" />
                            <h3><span class="tagline">Obsessions</span></h3>
                        </div>
                    	<div class="tile-copy animate">
                        	<h3><?php echo $obj['obsessions_title'][1]?></h3>
                            <?php echo $obj['obsessions_copy'][1]; ?>
                    	</div><!-- end tile-copy -->
                	</div><!-- end inner -->
                </div><!-- end tiles -->
             
					
			<?php 	
				} // end foreach
			}?>
            </div><!-- end grid -->

			<?php endwhile; endif; ?>

		</section>
	</div><!-- end content_wrapper -->
    
<?php get_footer(); ?>