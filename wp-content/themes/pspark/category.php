<?php get_header();?>
<?php
 // Uncomment these to Turn on Errors for this page
	#ini_set('display_errors','on');
	#error_reporting(E_ALL);
	?>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">	
		<?php $cat = get_the_category();?>
		<h1>Stories about <?php echo $cat[0]->name; ?></h1>
	
		<?php get_template_part('archive-loop'); ?>
		
		<?php get_template_part('pagination'); ?>
	
		</section>
        <script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
		<script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script charset="utf-8" type="text/javascript">stLight.options({"publisher":"1df3adfa-5ff8-4297-b044-bd97f9882729"});var st_type="wordpress4.2.2";</script>
		<?php get_sidebar('right'); ?>
	</div><!-- end content_wrapper -->
    
<?php get_footer(); ?>