<?php include('header-extranet.php'); ?>
<style>
    .wf-loading h1, .wf-loading h2, .wf-loading h3, .wf-loading h4, .wf-loading h5{
        visibility:visible;
    }
	.single-extranet{background:#f1f1f1;}
	.single-extranet .content_wrapper{
		background:#f1f1f1;
		padding:40px;
	 }
	.ex-login {
		max-width:795px;
		margin:130px auto 100px auto;
	}
	
	a.ex-logo img{width:100%;}
	
	.single-extranet footer{
		background:none;
		padding:0;
	}
	.single-extranet h4{
		font-size:18px;
		color:#4b10bd;
		line-height:24px;
		font-weight:500;
	}
	
	.single-extranet h2{
		font-size:38px;
		line-height:44px;
		margin:10px 0 25px 0;
		font-family:"adobe-caslon-pro";
		color:#7f7694;
		font-weight:500;
	}
	.post-password-form p{
		position:relative;
	}
	form a.button:hover{
		background:#e50354;
		opacity:0.7;
	}
	.single-extranet .ex-login form{}
	.single-extranet .ex-login form label{
		font-size:18px;
		color:#4b10bd;
		position:static;
		left:0;
		top:0;
	}
	.single-extranet .ex-login form input[type="password"]{
		color:#918b9d;
		font-size:18px;
		text-transform:none;
		border:1px solid #918b9d;
		line-height:43px;
		height:43px;
		background:#fff;
		text-indent:20px;
		max-width:368px;
		display:block;
	}
	.single-extranet .ex-login form input[placeholder]{opacity:1;}
	
	.single-extranet .ex-login form input[type="password"].error{border-color:#fe563a;}
	.single-extranet .ex-login form p.error{
		font-size:23px;
		color:#fe563a;
		line-height:26px;
		font-weight:500;
		margin:10px 0;
	}
	.single-extranet .ex-login form input.button{
		font-size:30px;
		color:#f3f3f4;
		height:58px;
		line-height:58px;
		padding:0 30px;
		margin:19px 0;	
	}
	.single-extranet .ex-login form input.button:hover{opacity:0.8;background:#e50354;}
	
	.single-extranet .section{
		margin-bottom:20px;
		overflow:hidden;
		max-height:1000px;
	}
	.single-extranet .section h6{
		border-top:1px solid #ccc;
		padding-top:25px;
		font-size:24px;
		font-weight:600;
		margin-bottom:5px;
	}
	.single-extranet .section p a{
		padding:5px 0;
		display:inline-block;
	}
	
	/* Logged in Version */
	.client-wrap{
		padding:0 80px;
	}
	
	#ex-logo{
		max-width:331px;
		display:block;
		margin-bottom:50px;
		width:100%;
	}
	
	.headshot{
		margin:0 0 20px;
		display:block;
	}
	
	.client-wrap .project-info{
		margin-top:40px;
		width:65%;
	}
	.client-wrap .client-contact {
	  margin-left: 20px;
	  width: calc(35% - 20px);
	}
	.client-wrap .project-info h5{
		margin:50px 0 10px 0;
		font-weight:bold;
	}
	
	/* Hide Types of Assets based on filter */
	article[data-type="Design Comps"] .section[data-type="Assets"],
	article[data-type="Design Comps"] .section[data-type="Wire Frames"],
	article[data-type="Design Comps"] .section[data-type="Demo Path"],
	article[data-type="Assets"] .section[data-type="Design Comps"],
	article[data-type="Assets"] .section[data-type="Wire Frames"],
	article[data-type="Assets"] .section[data-type="Demo Path"],
	article[data-type="Wire Frames"] .section[data-type="Design Comps"],
	article[data-type="Wire Frames"] .section[data-type="Assets"],
	article[data-type="Wire Frames"] .section[data-type="Demo Path"],
	article[data-type="Demo"] .section[data-type="Assets"],
	article[data-type="Demo"] .section[data-type="Wire Frames"],
	article[data-type="Demo"] .section[data-type="Design Comps"]{
		max-height:0;
	}
	
	/* Filter Buttons */
	ul.filters{margin:0 0 20px 0;}
	ul.filters li{
		list-style:none;
		float:left;
		padding:0;
		margin-bottom:10px;
	}
	ul.filters li:before{display:none;}
	
	a.button.filter-btn{
		height:45px;
		line-height:45px;
		font-size:20px;
		border:2px solid #e50354;
		margin-right:15px;
	}
	
	a.button.filter-btn.active,
	a.button.filter-btn:hover{
		background:transparent;
		color:#e50354;
	}
	
	h6.label{
		color:#4b10bd;
		text-transform:uppercase;
		font-size:20px;
		margin:5px 0;
	}
	
	/** Thumbnails **/
	.left.thumbs {
	  margin: 20px 20px 0 0;
	  text-align: center;
	  width: 150px;
	  font-size: 16px;
	  line-height: 20px;
	  min-height:200px;
	}
	
	/** Lightbox Plugin Overrides **/
	body.lg-on{overflow:hidden;} /* Remove scroll bar from body */
	.lg-actions .lg-next, 
	.lg-actions .lg-prev, 
	.lg-sub-html, 
	.lg-toolbar{
		background:rgba(0,0,0,0) !important; /* Remove Background from toolbar */
	}
	
	.lg-outer .lg-image{
		max-height:none !important;
		margin-bottom:100px !important;
		cursor:default !important;
	} /* Allow image to be full size on start */
	.lg-outer .lg-img-wrap, .lg-outer .lg-item{overflow:auto;} /* Allow Scroll bar on Image Container */
	.lg-outer .lg-thumb-outer{ width:calc(100% - 17px) !important; } /* Prevent overlap with scroll bar */
	
	.lg-item.mobile .lg-img-wrap img{
		width:320px !important;
		margin-top:83px;
		z-index:1;
		margin-left:19px;
	}
	.lg-item.mobile .lg-img-wrap{height:715px;}
	.lg-item.mobile.lg-loaded.lg-current.lg-complete {
	  max-height: 730px;
	}
	.lg-item .iphone{display:none;}
	.lg-item.mobile .iphone {
	  background: rgba(0, 0, 0, 0) url("http://primitivespark.com/site/wp-content/themes/pspark/img/iphone.png") no-repeat fixed center 0;
	  content: "";
	  display: block;
	  height: 729px;
	  left: calc((100% - 350px) / 2);
	  margin: 0 auto;
	  overflow: hidden;
	  position: fixed;
	  top: 0;
	  width: 368px;
	  z-index: 2147483647;
	}
	
	@media only screen and (max-width:980px){
		.client-wrap{padding:0 20px;}
	}
	@media only screen and (max-width:640px){
	 .single-extranet .content_wrapper{padding:20px;}
	 .single-extranet h2{
		 font-size:30px;
		 line-height:36px;
		 margin:0 0 10px;	
	}
	
	.client-wrap .client-contact,
	.client-wrap .project-info{
		float:none;
		width:100%;
		margin-bottom:20px;
	}
	.client-wrap .project-info h5{font-size:28px;}
	}
	@media only screen and (max-width:480px){
	.lg-item.mobile .iphone {display:none;}
	/* Hide the toolbar */
	.lg-toolbar.group{display:none;}
	}
	
	/* Hide arrows, gallery page window, and toolbar, respectively, in demo mode */
	body[data-type="demo"] .lg-actions, body[data-type="demo"] .lg-grab, body[data-type="demo"] .lg-toolbar{
		display: none;
	}

	/* Add top margin to image when user is logged to fit to screen.*/
	.admin-bar .lg-image{
		margin-top: 32px;
	}
	
</style>
	
    <div class="content_wrapper clear">
		<section role="main" class="main">
			<?php if (have_posts()): while (have_posts()) : the_post();
			?>
            <?php 
			if(post_password_required() && !check_user_role('administrator')){ ?>
            <div class="clear">
                <a href="<?php echo home_url(); ?>" class="right ex-logo">
                    <!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
                    <!--<img src="http://assets.primitivespark.com/img/logo.svg" alt="Logo" class="logo-img hideMobile">-->
                    <img src="http://assets.primitivespark.com/img/logo.png" alt="Logo" class="logo-img">
                </a>
            </div>
            <div class="ex-login">
                <h4>CLIENT EXTRANET</h4> 
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </div><!-- end ex-login -->
			<!-- /article -->
            <?php } else { 
			
			//Set up Magic Fields
			$sections = get_group('section');
			$contactID = get_field('primary_contact');
			$query =  array( 'post_type' => 'staff', 'p' => $contactID[1]);
			$custom_query = new WP_Query($query);

			if($custom_query->have_posts()): while($custom_query->have_posts()): $custom_query->the_post();
				//Set up Client Contact Fields
				$img = get_the_post_thumbnail($contactID[1], 'thumbnail');
				$email = get_field('email');
				$phone = get_field('phone');
				$name = get_the_title();
				$staffLink = get_permalink();
			endwhile; endif; ?><?php wp_reset_query(); ?>
            <div class="client-wrap">
            	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-filter="all">
                    <div class="client-header clear">
                    	 <div class="client-contact right mar-b">
                        	<a href="<?php echo home_url(); ?>" title="Primitive Spark" id="ex-logo">
                                <!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
                                <!--<img src="http://assets.primitivespark.com/img/logo.svg" alt="Logo" class="logo-img hideMobile">-->
                                <img src="http://assets.primitivespark.com/img/logo.png" alt="Logo" class="logo-img">
                            </a>
                            <a href="<?php echo $staffLink;?>" title="<?php echo $name; ?>" class="headshot">
                            	<?php echo $img; ?>
                            </a>
                            <h6 class="label">Project Lead:</h6>
                            <h5><?php echo $name; ?></h5>
                            <a href="mailto:<?php echo $email[1]; ?>" title="<?php echo $name; ?>"><i class="fa fa-envelope"></i> <?php echo $email[1]; ?></a><br />
                            <a href="tel:<?php echo $phone[1]; ?>" title="<?php echo $phone[1]; ?>"><i class="fa fa-phone"></i> <?php echo $phone[1]; ?></a>
                        </div><!-- end client contact -->
                    	<div class="project-info left">
							<?php if(has_post_thumbnail()) the_post_thumbnail('original'); ?>
                            <h5><?php echo str_replace('Protected:', '', get_the_title()); ?></h5>
                            <?php echo get_the_content(); ?>
                            <h6 class="label">Filter By:</h6>
                            <ul class="filters clear">
                                <li><a href="javascript:void(0);" data-filter="all" class="button filter-btn active">All</a></li>
                                <li><a href="javascript:void(0);" data-filter="Design Comps" class="button filter-btn">Design Comps</a></li>
                                <li><a href="javascript:void(0);" data-filter="Wire Frames" class="button filter-btn">Wire Frames</a></li>
                                <li><a href="javascript:void(0);" data-filter="Assets" class="button filter-btn">Assets</a></li>
                                <li><a href="javascript:void(0);" data-filter="Demo" class="button filter-btn">Demo</a></li>
                            </ul><!-- end filters -->
                        </div><!-- end project info -->
                    </div><!-- end client header -->			
                    <?php
					if($sections[1]['section_title'][1]){
                        foreach($sections as $section){ ?> 
                        <div class="section clear animate" data-type="<?php echo $section['section_type'][1];?>">
                        <h6><? echo $section['section_title'][1]; ?></h6>
                        <?php if($section['section_type'][1] == 'Design Comps' || $section['section_type'][1] == 'Demo Path'){ ?>
                        	<div class="gallery">
                            <?php foreach($section['section_media_file'] as $media){ 
                                //Grab the image assets
                                $image_id = get_attachment_id_from_src($media['original']);
                                $img_array = wp_get_attachment($image_id);
								$thumb = wp_get_attachment_image($image_id, 'thumbnail');
                                $dataClass = $img_array['description'];
                                if($section['section_type'][1] == 'Demo Path') $dataClass = "demo";
								echo '<a href="'.$img_array['src'].'" class="left thumbs" data-class="'.$dataClass.'">'.$thumb.'<br />'.$img_array['title'].'</a>';
								
                            } ?>
                            </div><!-- end gallery -->
                        <?php } else {
                            echo $section['section_asset_list'][1];	
                         } ?>
                        </div><!-- end section -->
                    <?php 	}
					} else { ?>
						<div class="section">
                        	<p>Whoops, looks like you havent added anything yet!</p>
                        </div>
					<?php }?>
                </article>
            </div><!-- end client wrap -->
            <?php } ?>
			<?php endwhile; endif; ?>
		</section>
	</div><!-- end content_wrapper -- >
<?php include('footer-extranet.php'); ?>