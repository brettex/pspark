<!doctype html>
<html <?php language_attributes(); ?> class="no-js" data-environment="<?php echo getEnvironment(); ?>">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		
		<!-- dns prefetch -->
		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="//netdna.bootstrapcdn.com" rel="dns-prefetch">
		
		<!-- meta -->
		<meta name="description" content="<?php bloginfo('description'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta content="width=device-width, maximum-scale=1, user-scalable=1" name="viewport">
        <meta name="p:domain_verify" content=""/>
        <meta name="google-site-verification" content="" />
        <meta property="og:url" content="https://primitivespark.com/" />
    	<meta property="og:title" content="" />
    	<meta property="og:description" content="" />
    	<meta property="og:type" content="company" />
    	<meta property="og:site_name" content="" />
		
		<!-- icons -->
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
			
		<!-- css + javascript -->
		<?php wp_head(); ?>
        <!-- font awesome css -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet" >
        <!-- black tie font -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/black-tie.min.css">
	</head>
	<body <?php body_class(); ?>>
		<!-- wrapper -->
		<div class="wrapper">	
			<!-- header -->
			<header class="header clear" role="banner">
                <nav class="nav left" role="navigation">
                    <?php pspark_nav(); ?>
                    <?php //get_search_form(); Hiding Global Search for now. Dont need it?>
                    <ul class="social clear showMobile">
                        <li class="icon"><a href="<?php echo get_option('fburl'); ?>"><i class="fab fab-facebook-alt"></i></a></li>
                        <li class="icon"><a href="<?php echo get_option('twitter'); ?>"><i class="fab fab-twitter"></i></a></li>
                        <li class="icon"><a href="<?php echo get_option('linkedin'); ?>"><i class="fab fab-linkedin-alt"></i></a></li>
                    </ul>
                </nav><!-- /nav -->
               <a href="javascript:void(0);" class="showMobile right nav-control" onClick="jQuery('body').toggleClass('nav-open');"></a>
               <div class="logo right">
                    <a href="<?php echo home_url(); ?>">
                        <!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo" class="logo-img hideMobile">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo-mobile.png" alt="Logo" class="logo-img showMobile">
                    </a>
                </div><!-- /logo -->
			</header>
			<!-- /header -->