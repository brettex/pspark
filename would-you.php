<?php
/*
	Template Name: Would You?
*/
	
/** Some Comment **/
?>
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
		<meta name="description" content="What's your holiday outlook?">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta content="width=device-width, maximum-scale=1, user-scalable=1" name="viewport">
        <meta name="p:domain_verify" content=""/>
        <meta name="google-site-verification" content="WpE21cHLsifLMfC55zTcBzcei7LlVsDYBf8cKIrskPo" />
        <meta property="og:url" content="<?php echo the_permalink($post->ID);?>" />
    	<meta property="og:title" content="Would you rather..." />
    	<meta property="og:description" content="What's your holiday outlook?" />
    	<meta property="og:type" content="website" />
    	<meta property="og:site_name" content="Primitive Spark" />
		<meta name="author" content="Primitive Spark">
        <meta property="og:image" content="<?php bloginfo('template_directory'); ?>/img/fb_share12x12.png" />
        <meta property="fb:app_id" content="335299919578" /> 
		<meta name="dcterms.rightsHolder" content="Copyright Primitive Spark <?php echo date('Y');?>. All Rights Reserved.">

		<!-- icons -->
		<link href="http://assets.primitivespark.com/img/icons/favicon.ico" rel="shortcut icon">
		<link href="http://assets.primitivespark.com/img/icons/touch.png" rel="apple-touch-icon-precomposed">
        <link rel="stylesheet" href="http://assets.primitivespark.com/style.css">
        <link href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" rel="stylesheet" >
			
		<!-- css + javascript -->
		<?php wp_head(); ?>
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
        <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-custom.js"></script>
       <script src="<?php echo get_template_directory_uri(); ?>/js/snowstorm.js"></script>
        <script>
		snowStorm.autoStart = false;
		snowStorm.flakesMax = 88;
		snowStorm.flakeBottom = 400;
		snowStorm.excludeMobile = true; 
		snowStorm.vMaxX=4;
		snowStorm.vMaxY=3;
		snowStorm.snowCharacter = '&bull;';
		snowStorm.flakeWidth = 8;
  		snowStorm.flakeHeight = 8; 
		</script>
        <style> 
			html,.wrapper{min-height:100%;height:auto;}
			body{
				background:#e41956;
				color:#fff;
				min-height:100%;
				height:auto;
			}
			.content_wrapper{
				background:transparent;
				min-height:100%;
				height:auto;
			}
			header{
				border-bottom:1px solid #fff;
				padding:15px 35px 20px 80px;
				background:none;
				position:static;
				top:0;
				color:#fff;
				margin:0 !important;
				height:auto;
			}
			header.shrink{height:auto;}
			header a{
				z-index:1001;
				right:35px;
				top:15px;
				position:absolute;
				width:59px;
				height:47px;
			}
			h1{
				font-size:40px;
				line-height:40px;
				color:#fff;
				margin:0;
				padding-top:10px;
				font-weight:500;
			}
			p{margin:0;}
			
			/* Main Content Styles */
			article{
				max-width:1140px;
				margin:0 auto;
				padding:120px 0 0 0;
				position:relative;
			}
			ul.question{margin:0;}
			.question li{
				list-style-type:none;
				display:block;
				padding:0;
				width:395px;
			}
			.question li:before{display:none;}
			
			a.vote{
				display:block;
				border:1px solid rgba(151,146,160,0.2);
				padding:20px;
				font-size:29px;
				line-height:34px;
				color:#fff;
				background:rgba(58,50,75,0.2);
				width:395px;
			}
			/* Hover/Tap Style */
			a.vote:hover,
			a.vote.hover{
				background:rgba(58,50,75,0.5);
				border:1px solid rgba(151,146,160,0.5);
			}
			/* SVG Styles */
			.svg-wrap{
				position:absolute;
				z-index:1001;
				left:35%;
				top:110px;
				padding-left:3%;
			}
			.svg-wrap a.bubble {
			  background:url('<?php echo get_template_directory_uri(); ?>/img/next-bubble.png') left top no-repeat transparent;
			  color: #e50354;
			  display: block;
			  font-size: 36px;
			  height: 70px;
			  line-height: 62px;
			  position: absolute;
			  right: -55px;
			  text-align: center;
			  top: -30px;
			  width: 110px;
			  font-weight: 500;
			  opacity:0;
			  z-index:-1;
			}
			/* Use SVG if browser supports it */
			body.svg .svg-wrap a.bubble {
			  background:url('<?php echo get_template_directory_uri(); ?>/img/speech.svg') left top no-repeat transparent;
			}
			.svg-wrap a.bubble.active{
				opacity:1;
				z-index:10;
			}
			.svg-wrap a.active:hover,
			body.intro a#play.bubble:hover{opacity:0.8;}
			a#play.bubble{
				right: 10px;
			  	top: -118px;
			}
			body.intro a#play.bubble {
			  opacity: 1;
			  z-index: 1;
			}

			 a#next.white{color:#fff;}

			 a#next.active:after {
				  background: transparent url("<?php echo get_template_directory_uri(); ?>/img/texting.gif") left top no-repeat;
				  content: "";
				  opacity:0;
				  display: block;
				  height: 20px;
				  left: 10px;
				  position: absolute;
				  top: 20px;
				  width: 100px;
				  -webkit-transition: all 0.4s ease-out 0s;
				-moz-transition:  all 0.4s ease-out 0s;
				-ms-transition:  all 0.4s ease-out 0s;
				-o-transition:  all 0.4s ease-out 0s;
				transition:  all 0.4s ease-out 0s;
				}
				a#next.active.white:after{opacity:1;}
			
			.svg-wrap svg{
				width:235px;
				-webkit-transition: all 0.4s ease-out 0s;
				-moz-transition:  all 0.4s ease-out 0s;
				-ms-transition:  all 0.4s ease-out 0s;
				-o-transition:  all 0.4s ease-out 0s;
				transition:  all 0.4s ease-out 0s;
			}
			.intro .svg-wrap,
			.thanks .svg-wrap{
				left:520px;
				position:absolute;
				top:160px;
				z-index:1001;
			}
			
			.intro .svg-wrap svg,
			.thanks .svg-wrap svg {
			  margin-left: 20px;
			  margin-top: -116px;
			  width: 440px;
			  -webkit-transition: all 0.4s ease-out 0s;
				-moz-transition:  all 0.4s ease-out 0s;
				-ms-transition:  all 0.4s ease-out 0s;
				-o-transition:  all 0.4s ease-out 0s;
				transition:  all 0.4s ease-out 0s;
			}
			.thanks .svg-wrap svg {
				-webkit-transition: all 0.4s ease-in 0s;
				-moz-transition:  all 0.4s ease-in 0s;
				-ms-transition:  all 0.4s ease-in 0s;
				-o-transition:  all 0.4s ease-in 0s;
				transition:  all 0.4s ease-in 0s;
			}
			
			/* Share */
			a#share{
				font-size:50px;
				display:block;
				position:absolute;
				bottom:0;
				right:40px;
				color:#fff;
				opacity:0;
			}
			
			.thanks a#share,
			.intro a#share,
			.result a#share{
				opacity:1;
				z-index:1001;
			}
			.thanks a#share:hover,
			.intro a#share:hover,
			.result a#share:hover{
				opacity:0.8;
			}
			
			.st0{display:none;fill:#FFFFFF;}
			.st1{display:none;}
			.st2{display:inline;fill:#FFFFFF;}
			.st3{display:inline;fill:none;stroke:#FFFFFF;stroke-width:4;stroke-miterlimit:10;}
			.st4{fill:#FFFFFF;}
			.st5{fill:#736C80;}
			.st6{fill:none;stroke:#FFFFFF;stroke-width:2;stroke-miterlimit:10;}
			.st7{fill:#E18726;}
			
			/* HighCharts */
			.chart{
				display:none;
				width:395px;
				}
			.highcharts-title{
				font-family:"proxima-nova" !important;
			}
			.highcharts-subtitle{
				font-family:"proxima-nova" !important;
				font-weight:500;
			}
			
			
			/** Modals **/
			.modal{
				position:absolute;
				z-index:-1;
				top:0;
				left:0;
				width:100%;
				height:auto;
				background:#e41956;
				color:#fff;
				padding:120px 20px 0 70px; 
				opacity:0;
				overflow:hidden;
				max-height:0;
			}
			body.thanks #thank-you.modal,
			body.intro #intro.modal{
				opacity:1;
				z-index:1000;
				min-height:100%;
				max-height:1000em;
			}
			.modal-inner{
				max-width:1166px;
				width:100%;
				margin:0 auto;
			}
			.modal-copy {
			  max-width: 455px;
			  width:50%;
			}
			#thank-you .modal-copy{
				max-width:550px;
			}
			.modal h3 {
			  color: #fff;
			  font-size: 60px;
			  font-weight: 600;
			  line-height: 68px;
			  margin-bottom: 50px;
			}
			#thank-you h3{
				font-weight:600;
				max-width:310px;
				margin-bottom:30px;
				}
			.modal-copy > p {
			  font-family: "adobe-caslon-pro";
			  font-size: 44px;
			  line-height:46px;
			}
			#thank-you .modal-copy > p{
				font-size:36px;
				line-height:44px;
				max-width:455px;
			}
			#thank-you .modal-copy > p.mar-t{
				margin-top:70px;
				max-width:none;
			}
			.modal .svg-wrap svg {
			  width: 440px;
			}
			
			/* Animations */
			.animate.slow{
				-webkit-transition: all 0.8s ease-in-out 0s;
				-moz-transition:  all 0.8s ease-in-out 0s;
				-ms-transition:  all 0.8s ease-in-out 0s;
				-o-transition:  all 0.8s ease-in-out 0s;
				transition:  all 0.8s ease-in-out 0s;
			}
			@media only screen and (max-width:1166px){
				.question li {
				  margin: 0 auto;
				  max-width: 395px;
				  width: 80%;
				}
				a.vote{
					width:100%;
					font-size:22px;
				}
				.svg-wrap svg{margin-left:0;}
				
			}
			@media only screen and (max-width:970px){
				.intro .svg-wrap, .thanks .svg-wrap{
					left:40%;
				}
			}
			@media only screen and (max-width:769px){
			body{
				overflow-x:hidden;
				max-width:100%;
			}
			.left, .right{float:none;}
			header{
				padding:15px 35px 15px 20px;
			}
			h1{
				font-size:25px;
				line-height:27px;
				padding-top:20px;
			}
			header a {
			  display: block;
			  right: 20px;
			  top: 23px;
			  width: 50px;
			}
			
			article{padding:20px 0 0 0;}
			ul.question{
				min-height:154px;
				max-width:100%;
				overflow-x:hidden;
			}
			.question li {
			  margin: 0 auto;
			  max-width: 395px;
			  width: 90%;
			}
			a.vote{
				width:100%;
				font-size:22px;
			}
			.chart {
			  max-width: 395px;
			  width: 100%;
			}
			.svg-wrap {
			  left: 0;
			  margin:20px auto 15px auto;
			  max-width: 440px;
			  position: relative;
			  top: 0;
			  width:85%;
			}
			.svg-wrap svg {
			  margin-left: 0;
			  transition: all 0.4s ease-out 0s;
			  width: 100%;
			}
			.svg-wrap a.bubble{
			  right: auto;
			  top: -33px;
			  left:72%;
			}
			 a#play.bubble{
			  right: 0;
			  top: -3%;
			}
			/* Modals */
			.modal {
			  height: 100%;
			  left: 0;
			  overflow: hidden;
			  padding: 60px 20px 0;
			  position: absolute;
			  top: 0;
			  width: 100%;
			}
			.modal-copy {
			  margin: 20px 0;
			  max-width: none;
			  width: 100%;
			}
			.modal h3 {
			  font-size: 40px;
			  line-height: 48px;
			  margin-bottom: 30px;
			}
			.modal-copy > p {
			  font-size: 30px;
			  line-height: 36px;
			}			
			/* SVG Snowman */
			.intro .svg-wrap, 	
			.thanks .svg-wrap {
			  left: 0;
			  position: relative;
			  top: 0;
			  margin:40px auto 0 auto;
			  width:90%;
			  max-width:440px;
			}
			.thanks .svg-wrap{margin-top:90px;}
			.intro .svg-wrap svg, 
			.thanks .svg-wrap svg {
			  margin: 0 auto;
			  width: 100%;
			}
			#thank-you h3 {
			  font-weight: 600;
			  margin-bottom: 30px;
			  max-width: none;
			}
			#thank-you .modal-copy > p {
			  font-size: 28px;
			  line-height: 37px;
			  max-width: none;
			}
			#thank-you .modal-copy > p.mar-t {
			  margin-top: 20px;
			  max-width: none;
			}
			/* Share */
			a#share{bottom:23%;}
			.result a#share{bottom:0;}
			.thanks a#share{bottom:16%;}
			/* Charts */
			.chart {
			  max-width: 395px;
			  width: 100%;
			}
			.highcharts-title{
				font-size:22px !important;
			}
			.highcharts-subtitle{
				font-size:28px !important;
			}
			@media only screen and (max-width:420px){
			 .svg-wrap a.bubble,
			 a#play.bubble{
			  background-size: 90px auto;
			  font-size: 28px;
			  line-height: 49px;
			  right: 0;
			  top: 5%;
			  width: 90px;
			}
			.svg-wrap a.bubble{
			  right: auto;
			  top: -8%;
			  left:70%;
			}
			
			.thanks .svg-wrap {
			  margin-top: 180px;
			}
			}

		</style>
        <style>
        	.svg-wrap svg{height:240px;}
			.intro .svg-wrap svg,
			.thanks .svg-wrap svg{height:370px;}

        </style> 
	</head>
	<body <?php body_class('intro'); ?>>
		<div class="wrapper">	
            <div class="content_wrapper clear">
                <section role="main" class="main">
                    <header class="clear">
                        <h1 class="left font-caslon"><?php the_title(); ?></h1>
                        <a href="<?php echo home_url(); ?>" class="right">
                            <img src="<?php bloginfo('template_directory'); ?>/img/white-logo.svg" alt="Primitive Spark" />
                        </a>
                        
                    </header>
                    <article class="clear">
					<?php 
                    //Get post thumbnail URL
                    $img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'original');
                    // Set up Magic Fields
                    $questions = get_group('questions');
					//Add in an ID to the array
					foreach($questions as $key => $question){
						$questions[$key]['id'] = $key; 
					}
                    //Shuffle up that array!!
                    shuffle($questions);
					//print_r($questions);
                    
                    //Question A
                    echo "<ul class='left question question-a'>";
                    foreach($questions as $key => $question){
                        $style = 'display:none';
                        //$qid = getQuestionID($question['questions_question_a_title'][1]);
                        //$pid = getQuestionID($question['questions_question_b_title'][1]);
						$id = $question['id'];
                        $title = $question['questions_question_a_title'][1];
						$share = $question['questions_facebook_a'][1];
                        if($key == 0){ $style = '';}
                        echo "<li id='".$id."a' style='".$style."'>";
                        echo "<a href='javascript:void(0);' data-qid='".$id."a' class='vote animate' data-pid='".$id."b'>".$question['questions_question_a'][1]."</a>";
                        echo "<div class='chart' data-title='".$title."' data-share='".$share."'></div>";
                        echo "</li>";
                        //$data = saveVote($idB, $idA);
                        //print_r($data);
                    }
                    echo "</ul>";
					?>	
                    <div class="svg-wrap left animate">
                        <?php include('frosty.php'); ?>
                        <a href="javascript:void(0);" title="play" id="play" class="bubble animate" onClick="$('body').removeClass('intro');">play</a>
                        <a href="javascript:void(0);" title="next" id="next" class="bubble animate">next</a>
                    </div><!-- end svg-wrap -->
                    <?php
                    // Question B
                    echo "<ul class='right question question-b'>";
                    foreach($questions as $key => $question){
                        $style = 'display:none';
                        //$qid = getQuestionID($question['questions_question_b_title'][1]);
                        //$pid = getQuestionID($question['questions_question_a_title'][1]);
						$id = $question['id'];
                        $title = $question['questions_question_b_title'][1];
						$share = $question['questions_facebook_b'][1];
                        if($key == 0){ $style = '';}
                        echo "<li id='".$id."b' style='".$style."'>";
                        echo "<a href='javascript:void(0);' data-qid='".$id."b' class='vote animate' data-pid='".$id."a'>".$question['questions_question_b'][1]."</a>";
                        echo "<div class='chart' data-title='".$title."' data-share='".$share."'></div>";
                        echo "</li>";
                        //$data = saveVote($idB, $idA);
                        //print_r($data);
                    }
                    echo "</ul>";
                    ?>
            </article>
            <a href="javascript:void(0);" title="share" id="share" class="animate animated"><i class="fa fa-share-alt"></i></a>
		</section>
        <div id="intro" class="modal animate slow">
        	<div class="modal-inner clear">
                <div class="modal-copy left">
                    <h3>What's your holiday outlook?</h3>
                    <p>Tell it to the snowman.</p>
                </div><!-- end modal copy -->
            </div><!-- end modal-inner -->
        </div><!-- /#end thank-you -->
        
        <div id="thank-you" class="modal animate slow">
        	<div class="modal-inner clear">
                <div class="modal-copy left">
                    <h3>Thank you for playing!</h3>
                    <p>Whether you're jolly or Grinchy, we're sending you warmest wishes for the season.</p>
                    <p class="mar-t">From your friends at Primitive Spark.<p>
                </div><!-- end modal copy -->
            </div><!-- end modal-inner -->
        </div><!-- /#end thank-you -->
	</div><!-- end content_wrapper -->
    
    </div><!-- /wrapper -->
     <!-- font awesome css -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css">
    <?php wp_footer(); ?>

    <script src="http://assets.primitivespark.com/js/combo.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/highcharts.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/svg4everybody.js"></script>
    
	<script>
			var idleTime = 0;
		$(document).ready( function(){
			var idleInterval = setInterval(timerIncrement, 10000); // 1 minute

			//Zero the idle timer on mouse movement.
			$(this).on('mousemove keypress', function(e) {
				idleTime = 0;
			});

			
			/** Capture the Click action on the choice and record the vote **/
			$('a.vote').on('click', function(){
				var qid = $(this).data('qid');
				var pid = $(this).data('pid');
				var selectChart = $(this).siblings('.chart').addClass('chosen');
				var unselectedChart = $('li:visible .chart:not(.chosen)');
				//Ajax call to trigger the vote
				jQuery.post(ajaxurl, { action: 'saveVote', questionID: qid, pairID: pid }, function( data ) {
					data = jQuery.parseJSON(data);
					
					//On Success, initiate the charts
					chartInit(selectChart, data.percentage, data.votes, data.pairVotes );
					chartInit(unselectedChart, data.pairPercentage, data.pairVotes, data.votes );
					
					setTimeout( function(){
						if(!$('ul.question li').last().is(':visible')){
							$('body').addClass('result');
							$('#share').addClass('bounce');
							setTimeout( function(){
								$('#next').delay(1000).addClass('active');
							},1000);
						} else {
							//Run thank you screen
							$('body').delay(2000).addClass('thanks');
						}
					}, 2000);
		
				});
			});
			
			/** Go to the next question **/
			$('#next').on('click', function(){
				$('body').removeClass('result');
				$(this).removeClass('active').html('next');
				
				var currentLi = $('li:visible');
				var nextLi = currentLi.next();
				
				//Hide Current li's
				currentLi.fadeOut( 500, function(){
					nextLi.fadeIn();
				});
			});
			
			// Facebook Function for sharing
			$('#share').click( function (){
				
					var title = "Would you rather...";
					var caption = title;
					var summary = "What's your holiday outlook?";
					var appID = 335299919578;
					var width = $(window).width();
					// Is this a Result Page?
					if($('body').hasClass('result') || $('body').hasClass('thanks')){
						var chart = $('li:visible .chosen'); 
						var alt = $('li:visible .chart:not(.chosen)').data('title');
						var chartTitle = chart.data('title');
						var share = chart.data('share');
						var stat  = chart.find('.highcharts-subtitle').html();
						title = summary;
						summary =  stat+' '+share;
					}					
					var u = "<?php echo get_permalink($post->ID);?>";
					var image = "<?php bloginfo('template_directory'); ?>/img/fb_share12x12.png";
					
					var url = "https://www.facebook.com/dialog/feed?app_id="+ appID + "&link=" + encodeURIComponent(u)+ 
                    "&name=" + encodeURIComponent(title) + 
                    "&caption=" + encodeURIComponent(caption) + 
                    "&description=" + encodeURIComponent(summary) + 
                    "&picture=" + encodeURIComponent(image) +
                    "&redirect_uri=https://www.facebook.com";
			
					//If its not mobile, go to regular facebook
					if($('html').hasClass('no-touchevents') && width > 970){
						//console.log('Yes');
					//window.open('http://facebook.com/sharer.php?s=100&p[url]='+encodeURIComponent(u)+'&p[title]='+encodeURIComponent(title)+'&p[summary]='+encodeURIComponent(summary)+'&p[images][0]='+encodeURIComponent(image),'sharer','toolbar=0,status=0,width=626,height=436');

        			window.open(url, 'sharer', 'toolbar=0,status=0,width=1000,height=436');
					return false; 
						} else{
							window.open(url,'sharer','toolbar=0,status=0,width=626,height=436');
							return false; 
						}
				});
			
			/** SVG Event Handlers **/
			$('path, polygon').on('click', function(){
				var id	= $(this).attr('id');
				var that = $(this);
				if(id == 'torso'){
					$(this).attr('class', 'bounce animated');
				} else {
					$(this).attr('class', 'wobble animated');
				}
				if(id == 'heart' && !$('body').hasClass('intro') && !$('body').hasClass('result')){
					$('ul.question-b li:visible a.vote').trigger('click');
				} else {
					snowStorm.randomizeWind();
				}
				setTimeout( function(){
				that.attr('class', '');	
				},2000);
			});
			$('path, polygon').hover( 
				function(){
					var id	= $(this).attr('id');			
					if(id == 'heart' || id == 'like'){
						$('ul.question-b li:visible a.vote').addClass('hover');
					}
				},
				function(){
					$('ul.question-b li:visible a.vote').removeClass('hover');
				}
			);

		});
		
	function chartInit(chart, subTitle, stat, statTwo){
		//Hide Questions
		$('li:visible a').fadeOut( 500, function(){
			chart.fadeIn();
		});
		
		 var options = {
			 colors:['#ffffff', '#e74878'],
			 subtitle: {
			 	text:'75%',
				floating:true,
				useHTML: true,
				style :{ "color": "#ffffff", "fontSize": "40px", "lineHeight" : "38px" },
				x:0,
				y:147
			 },
			 title: {
				 text:"Hi-Cal with frozen brains",
				 useHTML: true,
				 style :{ "color": "#ffffff", "fontSize": "28px", "lineHeight" : "32px" },
			 },
			 tooltip: {
				 enabled:false
			 },
			 chart: {
                renderTo: 'container',
                type: 'pie',
				borderWidth: 0,
				spacing: [0,20,10,0],
				backgroundColor: "transparent",
				height:235,
				//width:330
            },
            plotOptions: {
                pie: {
                    shadow: false,
					borderWidth:0,
					states:{
						hover:{
							enabled:false
						}
					}
                }
            },
            series: [{
                data: [[8],[2]],
                size: '150px',
                innerSize: '85%',
                showInLegend:false,
                dataLabels: {
                    enabled: false,
                  
                }
            }],
			credits: {
				enabled: false,
			},
				
		 };
		 

		//Set up the specific Chart Data
		options.series[0].data = [];
		options.title.text = chart.data('title');
		options.subtitle.text = subTitle+'%';
		options.series[0].data = [[parseInt(stat)], [parseInt(statTwo)]];
		
		//Is Mobile?
		var width = $(window).width();
		if(width < 769){
			options.chart.height = 154;
			//options.chart.width = (width * .9);
			options.series[0].size = '100px';
			options.subtitle.y = 113;
		}
		chart.highcharts( options );

	}
	
	function timerIncrement() {
		idleTime = idleTime + 1;
		if (idleTime > 5) { // 20 minutes
			$('#next.active').addClass('white');
			idleTime = 0;
			setTimeout( function(){
				$('#next.active').html('hello?').removeClass('white');
				}, 3500);

		}
	}
	</script>	
		<!-- analytics -->
		<script>	
			var _gaq=[['_setAccount','UA-12719728-1'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)})(document,'script')
		</script>
	
	</body>
</html>
