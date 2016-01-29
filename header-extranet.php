<!doctype html>
<html <?php language_attributes(); ?> class="no-js" data-environment="<?php echo getEnvironment(); ?>">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		
		<!-- dns prefetch -->
		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="//netdna.bootstrapcdn.com" rel="dns-prefetch">
        <link href="use.typekit.net" rel="dns-prefetch">
		
		<!-- meta -->
		<meta name="description" content="<?php bloginfo('description'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta content="width=device-width, maximum-scale=1, user-scalable=1" name="viewport">
        <meta name="p:domain_verify" content=""/>
        <meta name="google-site-verification" content="WpE21cHLsifLMfC55zTcBzcei7LlVsDYBf8cKIrskPo" />
        <meta property="og:url" content="http://primitivespark.com/" />
    	<meta property="og:title" content="" />
    	<meta property="og:description" content="<?php bloginfo('description'); ?>" />
    	<meta property="og:type" content="company" />
    	<meta property="og:site_name" content="Primitive Spark" />
		<meta name="author" content="Primitive Spark">
        <meta property="og:image" content="http://assets.primitivespark.com/img/primitive-spark.jpg" />
		<meta name="dcterms.rightsHolder" content="Copyright Primitive Spark 2015. All Rights Reserved.">
        <meta content="noindex,follow" name="robots">
		
		<!-- icons -->
		<link href="http://assets.primitivespark.com/img/icons/favicon.ico" rel="shortcut icon">
		<link href="http://assets.primitivespark.com/img/icons/touch.png" rel="apple-touch-icon-precomposed">
        <link rel="stylesheet" href="http://assets.primitivespark.com/style.css">
			
		<!-- css + javascript -->
		<?php wp_head(); ?>
		<script>
		!function(e,t,n,a,r,s,l,p){n&&(s=n[a],s&&(l=e.createElement("style"),l.innerHTML=s,e.getElementsByTagName("head")[0].appendChild(l)),p=t.setAttribute,t.setAttribute=function(e,l,u,i){"string"==typeof l&&l.indexOf(r)>-1&&(u=new XMLHttpRequest,u.open("GET",l,!0),u.onreadystatechange=function(){4===u.readyState&&(i=u.responseText.replace(/url\(\//g,"url("+r+"/"),i!==s&&(n[a]=i))},u.send(null),t.setAttribute=p,s)||p.apply(this,arguments)})}(document,Element.prototype,localStorage,"tk","https://use.typekit.net");
		</script>
        <script>
		  (function(d) {
			var config = {
			  kitId: 'neb5zrg',
			  scriptTimeout: 3000,
			  async: true
			},
			h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
		  })(document);
		</script>
	</head>
	<body <?php body_class(); ?>>
		<!-- wrapper -->
		<div class="wrapper">