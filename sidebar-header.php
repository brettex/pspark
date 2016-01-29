<header id="header" class="sidebar">

	<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
	<div class="description"><?php bloginfo('description'); ?></div>
		
    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Header')) : else : ?>
    
	<?php endif; ?>

</header>