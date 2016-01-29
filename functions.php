<?php
/*
 *  Author: Brett Exnowski | @brettex1
 *  URL: pspark.com | @pspark
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/


/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
   /* add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
*/
    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('pspark', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// pspark Blank navigation
function pspark_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load pspark Blank scripts (header.php)
function pspark_header_scripts()
{
    if (!is_admin()) {
    
    	wp_deregister_script('jquery'); // Deregister WordPress jQuery
		
    	wp_register_script('jquery', 'http://assets.primitivespark.com/js/jquery.1-10-1.min.js', array(), '1.10.1', true); // Google CDN jQuery
    	wp_enqueue_script('jquery'); // Enqueue it!
        
		#Do we even need this
        //wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); // Modernizr
        //wp_enqueue_script('modernizr'); // Enqueue it!
        
       # wp_register_script('psparkscripts', get_template_directory_uri() . '/js/scripts.min.js', array(), '1.0.0', true); // Custom scripts
       # wp_enqueue_script('psparkscripts'); // Enqueue it!
    }
}

/** Remove Contact Form 7 From ALL Pages **/
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

/** Remove Emoji Stuff **/
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 

/**
 * Checks if a particular user has a role. 
 * Returns true if a match was found.
 *
 * @param string $role Role name.
 * @param int $user_id (Optional) The ID of a user. Defaults to the current user.
 * @return bool
 */
function check_user_role( $role, $user_id = null ) {
 
    if ( is_numeric( $user_id ) )
	$user = get_userdata( $user_id );
    else
        $user = wp_get_current_user();
 
    if ( empty( $user ) )
	return false;
 
    return in_array( $role, (array) $user->roles );
}

/*** 
	Extranet Password Form Override 
	
**/

function ex_password_form() {
		global $post;
	if (!check_user_role('administrator')){
		$msg = '';
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
		//$o .=  __( "Enter the password below:" );
		//$o .= '<div class="form-item">';
		$o .= '<label for="'.$label.'">Password</label>';
		if (isset($_COOKIE['wp-postpass_' . COOKIEHASH])){
			$o .= '<input name="post_password" class="error" id="' . $label . '" type="password" size="20" maxlength="20" placeholder="Password"/>';
			$o .= '<p class="error">Please re-enter your password</p>';
			//$o .= '<p class="error">Ah, ah, ah... You didn\'t say the magic word!</p>';
		} else {
			
			$o .= '<input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" placeholder="Password"/>';
		}
		$o .= '<input type="submit" name="Submit" class="button" value="' . esc_attr__( "Enter" ) . '" /></form>';
		return $o;
	} else {
		return $post->post_content;	
	}
}
add_filter( 'the_password_form', 'ex_password_form' );

/** Protected Post Title **/

function ex_title_protected( $title ) {
    if ( post_password_required() ){
        $title = str_replace('Protected:', '', $title);
	}
    return $title;
}
add_filter( 'protected_title_format', 'ex_title_protected' );


// Load pspark Blank conditional scripts
function pspark_conditional_scripts()
{
    if (is_page('contact')) {
		if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
        wpcf7_enqueue_scripts();
    }
 
    if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
        wpcf7_enqueue_styles();
    }

    }
}

//Load jQuery UI to front end
function add_wordpress_scripts() {
	
	if( is_page() ) { //Check if we are viewing a page
		global $wp_query;

		//Check which template is assigned to current page we are looking at
		$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

	}
}

add_action( 'wp_enqueue_scripts', 'add_wordpress_scripts' ); // wp_enqueue_scripts action hook to link only on the front-end

function cleanUp_init(){
	//Remove some stuff
	if (!is_admin() && !is_user_logged_in() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) )){
	
		wp_deregister_style('dashicons');
		wp_deregister_style('thickbox');
		wp_deregister_script('thickbox'); // Deregister WordPress Thickbox
		wp_deregister_script('wp-emoji-release'); // Deregister WordPress Emoji
	}
}
add_action('init', 'cleanUp_init');


// Load pspark Blank styles
function pspark_styles()
{
	//Register Stuff
	//Added to styles.css
   # wp_register_style('normalize', get_template_directory_uri() . '/normalize.min.css', array(), '1.0', 'all');
   # wp_enqueue_style('normalize'); // Enqueue it!
    
    //wp_register_style('pspark', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    //wp_enqueue_style('pspark'); // Enqueue it!
}

// Register pspark Blank Navigation
function register_pspark_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'pspark'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'pspark'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'pspark') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

/** Change the admin theme based on Environment**/
add_filter('get_user_option_admin_color', 'change_admin_color');
function change_admin_color($result) {
	$sub = array_shift((explode(".",$_SERVER['HTTP_HOST'])));
	if(strpos($sub, 'dev') === 0){
    	return 'sunrise';
	} elseif(strpos($sub, 'test') === 0){
		return 'ocean';
	} else{
		return 'default';
	}
}

/** Add in Company Logo for coolness effect on Admin Bar! **/
// hook the administrative header output
add_action('admin_head', 'custom_logo');

function custom_logo() {
echo '
<style type="text/css">
#wpadminbar .ab-top-menu > li#wp-admin-bar-wp-logo > a.ab-item, 
#wpadminbar .ab-top-menu > li#wp-admin-bar-wp-logo:hover > a.ab-item { background: url('.get_bloginfo('template_directory').'/img/icons/favicon.png) center center no-repeat transparent;padding:0 4px;}
#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before{display:none;}
</style>
';
}

/** Add enviroment Attribute to <html> for enviroment specific styling **/
function getEnvironment(){
	return array_shift((explode(".",$_SERVER['HTTP_HOST'])));
}


/** Function to get data for a Success Story and return structured data 

	@parameter -  integer - Post ID
	@return - string -HTML Markup
	
**/

function getSuccess($postID){
	
	global $wpdb;
	global $post;
	$args = array('p' => $postID, 'post_type' => 'success');
  	$query  = get_posts( $args );  
	foreach ( $query as $post ) :
  		setup_postdata( $post );
		$success = '';
		$qoute = get('meta_information_quotation',1,1,$post->ID);
		$author = get('meta_information_quote_author',1,1,$post->ID);
		$biline = get('meta_information_quote_author_title',1,1,$post->ID);
			//$img = wp_get_attachment(get_post_thumbnail_id( $post->ID ));
			if($qoute != ''){
				$success .= '<div class="qoute">'.$qoute.'<div class="biline"><span>'.$author.'</span>, '.$biline.'</div></div>';
			}
			$success .= "<span class='meta'>Success Story</span>";
			$success .= "<h4><a href='".get_permalink($post->ID)."' class='title dark' title='".get_the_title($post->ID)."'>".get_the_title($post->ID)."</a></h4>";
			$success .= "<a href='".get_permalink($post->ID)."' title='Read Success Story' class='button'>Read Success Story</a>";
	endforeach; 
	wp_reset_postdata();

	return $success;	
}

/** Function to get data for a post and return structured data 

	@parameter -  string - Post Tyoe
	@return - string -HTML Markup
	
**/

function getHomeItem($postType){
	
	global $wpdb;
	global $post;
	$args = array('post_type' => $postType, 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 1);
  	$query  = get_posts( $args );
	$postTypeCopy = $postType;
	if($postType != 'news') $postTypeCopy = $postType.'s'; 
	foreach ( $query as $post ) :
  		setup_postdata( $post );
		$item = '';
		$author = get('meta_information_quote_author',1,1,$post->ID);
		$biline = get('meta_information_quote_author_title',1,1,$post->ID);
		$item .= "<h4><a href='".get_permalink($post->ID)."' class='title dark' title='".get_the_title($post->ID)."'>".get_the_title($post->ID)."</a></h4>";
		if($postType == 'event'){
			if(get('event_link') != ''){
				$link = get_field('event_link');
				$link = $link[1];
				$text = '» Reserve Now';
			} else {
				$link = get_permalink();
				$text = '» More Info';	
			}
			$item .= "<div class='biline'>".get('event_date')." ".get('event_time')." - <a href='".$link."'>".$text."</a></div>";
		} else {
			$item .= "<div class='biline'>".get_the_date('M d, Y', $post->ID)." - ".types_render_field('source')."</div>";
		}
			$item .= "<a href='". get_post_type_archive_link( $postType )."' title='More' class='button right'>More ".ucfirst($postTypeCopy)."</a>";
	endforeach; 
	wp_reset_postdata();

	return $item;	
}
/** Function to get Latest Post for use in Sidebar block

	@parameter - $number - integer, how many posts to return
	@return - string -HTML Markup
	
**/

function getLatest($number = 1){
	
	global $wpdb;
	global $post;
	$args = array('post_type' => array('event', 'post', 'press_release', 'article', 'news'), 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 1);
  	$query  = get_posts( $args );
	// Save post published date
	$queryTime = date(strtotime($query[0]->post_date));
	// Get most recent event by date of event, not published date
	$eventArgs = array('post_type' => 'event', 'orderby' => 'meta_value', 'meta_key' => 'event_date', 'order' => 'DESC', 'posts_per_page' => 1);
  	$eventQuery  = get_posts( $eventArgs );
	$eventTime = date(strtotime(get_post_meta($eventQuery[0]->ID, 'event_date', true)));
	//If Event time is more recent, then use that as Latest post
	if($eventTime > $queryTime){
		$query = $eventQuery;
	}
	foreach ( $query as $post ) :
  		setup_postdata( $post );
		$item = '';
		$postType = get_post_type($post->ID);
		$author = get('meta_information_quote_author',1,1,$post->ID);
		$biline = get('meta_information_quote_author_title',1,1,$post->ID);
		$item .= "<div class='latest'><h6><a href='".get_permalink($post->ID)."' class='title dark' title='".get_the_title($post->ID)."'>".get_the_title($post->ID)."</a></h6>";
		if($postType == 'event'){
			if(get('event_link') != ''){
				$link = get_field('event_link');
				$link = $link[1];
				$text = 'Reserve Now';
			} else {
				$link = get_permalink();
				$text = 'More Info';	
			}
			$item .= "<div class='biline'>".get('event_date')." ".get('event_time')." <br /><a href='".$link."' class='dark'><strong>".$text."</strong></a></div></div>";
		} elseif($postType == 'post'){
			$item .= "<div class='biline'>".get_the_date('M d, Y', $post->ID)." - ".get_the_author($post->ID)."</div></div>";
		} else{
			$item .= "<div class='biline'>".get_the_date('M d, Y', $post->ID)." - ".types_render_field('source')."</div></div>";
		}
	endforeach; 
	wp_reset_postdata();

	return $item;	
}

/** Function to get a random quote 
	Store ALL quotes in an array and use PHP to 
	randomize. Doing RANDOM SQL Queries are too expensive $$$!

	@return - string -HTML Markup
	
**/

function getRandoQuote(){
	
	global $wpdb;
	global $post;
	$args = array('post_type' => 'quotes', 'posts_per_page' => 1);
  	$query  = get_posts( $args );
	$quoteArray = array();
	foreach ( $query as $post ) :
  		setup_postdata( $post );
		$quotes = get_group('quote',$post->ID);
		$count = count($quotes);
		foreach($quotes as $key => $quote){
			$quoteArray[$key]['copy'] = $quote['quote_copy'][1];
			$quoteArray[$key]['author'] = $quote['quote_author'][1];
			$quoteArray[$key]['title'] = $quote['quote_author_title'][1];
		}

	endforeach; 
	wp_reset_postdata();
	$rando = rand(1, $count);
	$item = '<div class="quote">'.$quoteArray[$rando]['copy'].'<div class="biline"><span>'.$quoteArray[$rando]['author'].'</span>'.$quoteArray[$rando]['title'].'</div></div>';
	
	return $item;	
}
/** 
	Function to generate Taglines for grid tiles base
	on Post Type 
	
	#parameter -  string, post type

**/

function getTagline($postType){
	switch($postType){
		case 'post':
			$label = 'Articles';
		break;
		case 'job_listing':
			$label = "Careers";
		break;
		case 'creative':
			$label = 'Spark Creativity';
		break;
		case 'staff':
			$label = 'Staff';
		break;
		case 'case_study':
			$label = "Case Study";
		break;
	}
	
	return "<h3><span class='tagline'>".$label."</span></h3>";
}

/*************** Get Previous/Next Links for Individual Garden Pages *****/
/**
	@variable $taxonomy the taxonomy term
	@variable $currentPostID the post ID of the current page
	@return an Array containing the URLs for next and prev
	The Wordpress get_adjacent_posts() doesent allow ordering
	by menu order nor does it allow infinite links (If at last post,
	next link would go back to the first post)
	Created own function to achieve this
	
**/

function getPrevNextLinks($postType, $currentPostID){
	// Get posts in same custom post
	$args = array(
   		'posts_per_page'  => -1,
   		'orderby'         => 'menu_order',
   		'order'           => 'ASC',
   		'post_type'       => $postType,
	); 
	$posts = get_posts( $args );

	// Store ids of posts in an array
	$ids = array();
	foreach ($posts as $thepost) {
   		$ids[] = $thepost->ID;
	}

	// Get the permalink and store it in an array       
	$postIndex = array_search($currentPostID, $ids);
	
	//If its the first Post, Set the Previous
	//Link to the last post
	if($postIndex == 0){
		$previd = end($ids);
	} else {
		$previd = $ids[$postIndex-1];
	}
	//If its the Last post, set the Next Link
	// to the first post
	if($postIndex == (count($ids)-1)){
		$nextid = $ids[0];
	} else {
		$nextid = $ids[$postIndex+1];
	}
	//Set the link URLs
   	$links['prev'] = get_permalink($previd);
	$links['next'] = get_permalink($nextid);
	
	return $links;
}

/*** Function to get Post type Name and Link

	Used at the top above Page Title on some templates
	
	@parameter - integer - post id
	@parameter - boolean  - is  'see more' 
	@return html markup for a link
	
**/

function getTileCopy($postID, $image){

    $postType = get_post_type($postID);
	switch($postType){
		case 'post':
			$authorID = get('staff_author',1,1,$postID);
			$copy = "<p>by ".get_the_title($authorID)."</p>";
			$link = '<a href="'.get_permalink($postID).'" class="button reverse">Read More</a>';
		break;
		case 'job_listing':
			$copy = "<p>".get_the_excerpt()."</p>";
			$link = '<a href="'.get_permalink($postID).'" class="button reverse">Find Out</a>';
			//$link .= getTagline($postType);
		break;
		case 'creative':
			$copy = "<p>".get_the_content()."</p>";
			$href = get_field('url');
			$cta = get_field('cta');
			$link = '<a href="'.$href[1].'" class="button reverse" target="_blank">'.$cta[1].'</a>';
		break;
		case 'staff':
			$manifesto = get('manifesto',1,1,$postID);
			$copy = "<p>".$manifesto."</p>";
			$link = '<a href="'.get_permalink($postID).'" class="button reverse">Read Bio</a>';
			//$link .= getTagline($postType);
		break;
		case 'case_study':
			$subTitle = get_field('sub_title');
			$copy = "<p>".$subTitle[1]."</p>";
			$link = '<a href="'.get_permalink($postID).'" class="button reverse">See Case Study</a>';
			//$link .= getTagline($postType);
		break;

	}
	//If theres no image, add in tagline
	if(!$image){
		$link .= getTagline($postType);
	}
	
	return $copy.$link;
}

/** 
	Get Attachment ID from image URL
	@paramater - $image_src, string
	@return - attachment ID
**/

function get_attachment_id_from_src($image_src) {

		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
		return $id;

}
/** Grab Image Attachment Meta Data 
	
	@parameter - $attachment_id  -  integer
	@return - array of meta data
	
**/
function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title,
		'all' => $attachment,
	);
}

// Change the length of time a Post Password is good for, 90 days enough??	
apply_filters ( 'post_password_expires', 90 );

/**
	Function to grab the meta_id from the copy inside a meta field - no better way to do this really :(
	
	@variable $question, string, the text string of the meta field
	@return integer, the meta id

**/

function getQuestionID($question){
	global $wpdb;
	global $wp_query;
	$postID = $wp_query->post->ID;
	$q = trim(strip_tags($question));
	$id = $wpdb->get_results( "SELECT meta_id FROM wp_postmeta WHERE post_id = '$postID' AND meta_value = '$q'" );
	return $id[0]->meta_id;
}

/** 
	Function to save a user selection/vote for a Would You Rather answer
	
	@variable $questionID, integer, the Meta id of the question
	@variabloe $pairID, the Meta ID of the unselected option
	
	@return $results, array, contains some useful data about the question
**/


function saveVote(){
	// Define the Globals
	global $wpdb;
	global $wp_query;
	$results = array();
	$result = false;
	
	//Set the variables
	$questionID = $_POST['questionID'];
	$pairID = $_POST['pairID'];
	
	//Set up the WP Query Parameters
	$table =  'wp_rather_stats';
	$where = array('Qid' => $questionID);
	//Grab the row for the question in the Vote Table
	$votes = $wpdb->get_results( "SELECT votes FROM $table WHERE Qid = '$questionID'" );
	//Row exists so, grab the vote count and increment by 1 and update the table row
	if($wpdb->num_rows > 0){
		$votes = $votes[0]->votes + 1;
		$result = $wpdb->update( $table, array('votes' => $votes), $where, $format = null, $where_format = null ); 
	} else {
		$votes = 1;
		$result = $wpdb->insert( $table, array('votes' => $votes, 'Qid' => $questionID), $format = null );
	}
	
	//Grab the other question of the pair to see how many votes it has
	$pairVotes = $wpdb->get_results( "SELECT votes FROM wp_rather_stats WHERE Qid = '$pairID'" );
	if(!$wpdb->num_rows > 0){
		$pairVotes = 0;
	} else {
		$pairVotes = $pairVotes[0]->votes;
	}
	
	$results['success'] = $result; //Was the save query successful?
	$results['votes'] = $votes; //Number of Votes for the question picked
	$results['pairVotes'] = $pairVotes; //Number of votes for the non-picked question
	$results['totalVotes'] = $totalVotes = $votes+$pairVotes; //The total number of votes
	$results['percentage'] = $percentage = round($votes/$totalVotes,2)*100;
	$results['pairPercentage'] = 100 - $percentage;
	
	echo json_encode($results);
	exit();

}
// Allow function to be used via ajax
add_action('wp_ajax_saveVote', 'saveVote');
add_action('wp_ajax_nopriv_saveVote', 'saveVote');

add_action('wp_head','ajaxurl');
function ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}

/** Encode Email Addresses Server Side **/
function encodeEmail($e) {
	for ($i = 0; $i < strlen($e); $i++) { $output .= '&#'.ord($e[$i]).';'; }
	return $output;
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}


add_action('admin_head', 'admin_css');
function admin_css() { 

		global $post_type; ?>
		
		<?php if ($post_type == 'page') { ?>
		
		<style>
			/* Hide the Team Member Tabs except on certain template types */
			#mf_12,
			#mf_11,
			#mf_14, /* Slide show */
			#mf_group_field_10_1_28, /* These 2 are for Archive Templates */
			#mf_group_field_10_1_29{display:none;}
		</style>
		
		<script type="text/javascript">
		
			jQuery(document).ready( function($){
			
				 // This first part is to hide / show fields on page load.
				if ($("#page_template").val() == "products.php" || $("#page_template").val() == "team-members.php" ) {
					$('#mf_11, #mf_12').show();		
				}
				if ($("#page_template").val() == "slideshow.php") {
					$('#mf_14').show();		
				}
				 if ($("#page_template").val() == "landing-page.php"){
					$('#mf_group_field_10_1_28, #mf_group_field_10_1_29').show(); 
				 }

				// This second part is to hide / show fields on template select. 
				
				$("#page_template").change(function(){
					if ($("#page_template").val() == "products.php" || $("#page_template").val() == "team-members.php") {
						$('#mf_11, #mf_12').show();		
					} else if ($("#page_template").val() == "slideshow.php") {
						$('#mf_14').show();
						$('#mf_11, #mf_12').hide();			
					} else if ($("#page_template").val() == "landing-page.php") {
						$('#mf_group_field_10_1_28, #mf_group_field_10_1_29').show();
						$('#mf_11, #mf_12, #mf_14').hide();	
					} else {
						$('#mf_11, #mf_12, #mf_14, #mf_group_field_10_1_28, #mf_group_field_10_1_29').hide();	
					}
				});
					
			});
		
		</script>

		<?php } //if page ?>
	
	<?php } 

// Add sidebar Classes to Body if sidebars are present */
add_action('wp_head', create_function("",'ob_start();') );
add_action('get_sidebar', 'my_sidebar_class');
add_action('wp_footer', 'my_sidebar_class_replace');
 
function my_sidebar_class($name=''){
  static $class="sidebar";
  if(!empty($name))$class.=" sidebar-{$name}";
  my_sidebar_class_replace($class);
}
 
function my_sidebar_class_replace($c=''){
  static $class='';
  if(!empty($c)) $class=$c;
  else {
    echo str_replace('<body class="','<body class="'.$class.' ',ob_get_clean());
    ob_start();
  }
}

	// Register Regions
	if (!function_exists('pspark_register_sidebars')) {
	function pspark_register_sidebars() {
		foreach (array(
					__('Header', 'pspark'),
					__('Main Nav', 'pspark'),
					__('Second Nav', 'pspark'),
					__('Left Sidebar', 'pspark'),
					__('Right Sidebar', 'pspark'),
					__('Footer', 'pspark')
					) as $sidebartitle) {
			register_sidebar(array(
						'name'=> $sidebartitle,
						'id' => 'sidebar-'.sanitize_title($sidebartitle),
    					'before_widget' => '<div id="%1$s" class="widget %2$s">',
    					'after_widget'  => '</div>',
    					'before_title'  => '<h2>',
    					'after_title'   => '</h2>'
						));
		}
	}
}
add_action('widgets_init', 'pspark_register_sidebars');


// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function pspark_pagination($wp_query)
{
    #global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function psparkwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using psparkwp_excerpt('psparkwp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using psparkwp_excerpt('psparkwp_custom_post');
function psparkwp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function bn_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function pspark_view_article($more)
{
    global $post;
	return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('Read the full story', 'pspark') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function pspark_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function psparkgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function psparkcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'pspark_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'pspark_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'pspark_styles'); // Add Theme Stylesheet
add_action('init', 'register_pspark_menu'); // Add pspark Blank Menu
//add_action('init', 'create_post_type_pspark'); // Add our pspark Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'pspark_pagination'); // Add our pspark Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'psparkgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'pspark_view_article'); // Add 'View Article' button instead of [...] for Excerpts
//add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'pspark_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('pspark_shortcode_demo', 'pspark_shortcode_demo'); // You can place [pspark_shortcode_demo] in Pages, Posts now.
add_shortcode('pspark_shortcode_demo_2', 'pspark_shortcode_demo_2'); // Place [pspark_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [pspark_shortcode_demo] [pspark_shortcode_demo_2] Here's the page title! [/pspark_shortcode_demo_2] [/pspark_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called pspark-Blank
/*function create_post_type_pspark()
{
    register_taxonomy_for_object_type('category', 'pspark-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'pspark-blank');
    register_post_type('pspark-blank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('pspark Blank Custom Post', 'pspark'), // Rename these to suit
            'singular_name' => __('pspark Blank Custom Post', 'pspark'),
            'add_new' => __('Add New', 'pspark'),
            'add_new_item' => __('Add New pspark Blank Custom Post', 'pspark'),
            'edit' => __('Edit', 'pspark'),
            'edit_item' => __('Edit pspark Blank Custom Post', 'pspark'),
            'new_item' => __('New pspark Blank Custom Post', 'pspark'),
            'view' => __('View pspark Blank Custom Post', 'pspark'),
            'view_item' => __('View pspark Blank Custom Post', 'pspark'),
            'search_items' => __('Search pspark Blank Custom Post', 'pspark'),
            'not_found' => __('No pspark Blank Custom Posts found', 'pspark'),
            'not_found_in_trash' => __('No pspark Blank Custom Posts found in Trash', 'pspark')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom pspark Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}
*/

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function pspark_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function pspark_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

//Custom Theme Settings
add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface() {
	add_options_page('Global Site Settings', 'Global Site Settings', '0', 'functions', 'editglobalcustomfields');
}

function editglobalcustomfields() {
?>
	<div class='wrap'>
	<h2>Global Custom Fields</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

	<p><strong>Secondary Tagline:</strong><br />
	<input type="text" name="taglineheader" size="90" value="<?php echo get_option('taglineheader'); ?>" /></p>
	
	<p><strong>Facebook URL:</strong><br />
	<input type="text" name="fburl" size="90" value="<?php echo get_option('fburl'); ?>" /></p>
    
    <p><strong>LinkedIn URL:</strong><br />
	<input type="text" name="linkedin" size="90" value="<?php echo get_option('linkedin'); ?>" /></p>
    
    <p><strong>Twitter URL:</strong><br />
	<input type="text" name="twitter" size="90" value="<?php echo get_option('twitter'); ?>" /></p>

	<p><strong>Phone Number:</strong><br />
	<input type="text" name="phone" size="45" value="<?php echo get_option('phone'); ?>" /></p>
    
    <p><strong>Phone Number Alt:</strong><br />
	<input type="text" name="phone2" size="45" value="<?php echo get_option('phone2'); ?>" /></p>
    
    <p><strong>Address:</strong><br />
	<input type="text" name="address" size="90" value="<?php echo get_option('address'); ?>" /></p>

	<p><strong>Global Action Message:</strong><br />
	<textarea name="message" cols="100%" rows="7"><?php echo get_option('message'); ?></textarea></p>
    
    <p><strong>Relative URL for Action Message:</strong><br />
	<input type="text" name="url" size="90" value="<?php echo get_option('url'); ?>" placeholder="/demo" /></p>

	<p><input type="submit" name="Submit" value="Update Options" /></p>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="taglineheader,fburl,phone,phone2,address,linkedin,twitter,message,url" />

	</form>
	</div>
	<?php
}
