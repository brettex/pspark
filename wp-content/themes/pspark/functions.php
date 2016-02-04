<?php
/*
 *  Author: Brett Exnowski | @brettex1
 *  URL: pspark.com | @pspark
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load Pardot File for API Connections
include_once('includes/pardot.php');

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
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

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
    	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', array(), '1.9.1'); // Google CDN jQuery
    	wp_enqueue_script('jquery'); // Enqueue it!
        
        wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!
        
        wp_register_script('psparkscripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0'); // Custom scripts
        wp_enqueue_script('psparkscripts'); // Enqueue it!
    }
}

// Load pspark Blank conditional scripts
function pspark_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

//Load jQuery UI to front end
function add_wordpress_scripts() {
	
    wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-accordion' );

	if( is_page() ) { //Check if we are viewing a page
		global $wp_query;

		//Check which template is assigned to current page we are looking at
		$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

		//If viewing a SpokePerson or Collection Type, add cycle and caursel
		if('landing-page.php' == $template_name){
			wp_register_script( 'infinite', get_stylesheet_directory_uri() .'/js/infinite.scroll.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'infinite' );
		}
		
		// Add scatter.js for the Bottle Nose demo on Advantage Page
		if($wp_query->post->ID == 20){
			wp_register_script( 'scatter', get_stylesheet_directory_uri() .'/js/scatter.js', array( 'jquery' ) );
			wp_enqueue_script( 'scatter' );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'add_wordpress_scripts' ); // wp_enqueue_scripts action hook to link only on the front-end

// Load pspark Blank styles
function pspark_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!
    
    wp_register_style('pspark', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('pspark'); // Enqueue it!
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

/*** Function to get Post type Name and Link

	Used at the top above Page Title on some templates
	
	@parameter - integer - post id
	@parameter - boolean  - is  'see more' 
	@return html markup for a link
	
**/

function getPostTypeLink($postID, $more){

    $postType = get_post_type($postID);
	$class = 'post-type';
	switch($postType){
		case 'post':
			$label = 'Blog:';
			$link = get_permalink(31);
			$moreLabel = 'See More Blog Posts';
		break;
		case 'success':
			$label = 'Success Stories:';
			$link = get_permalink(23);
			$moreLabel = 'More Success Stories';
		break;
		case 'event':
			$label = 'Events:';
			$link = get_permalink(29);
			$moreLabel = 'More Events';
		break;
		case 'press_release':
			$label = 'Press Release:';
			$link = get_permalink(28);
			$moreLabel = 'More Press Releases';
		break;
		case 'article':
			$label = 'Article:';
			$link = get_permalink(30);
			$moreLabel = 'More Articles';
		break;
	} 
	//Change the label, if applicable
	if($more){
		$label = $moreLabel;
		$class = 'see-more';
	}
	
	$a = "<a href='".$link."' title='".$label."' class='".$class."'>".$label."</a>";
	return $a;
}

//Ensure the $wp_rewrite global is loaded
global $wp_rewrite;
//Call flush_rules() as a method of the $wp_rewrite object
$wp_rewrite->flush_rules( true );

/*************************************************************/
#               EXTENDED RELEVANSSI SEARCH
/*************************************************************/

/* Group results by Content Type */
//add_filter('relevanssi_hits_filter', 'separate_result_types');
function separate_result_types($hits) {
    $types = array();
	$types['design_style'] = array();
	$types['plant_savvy_template'] = array(); 
	$types['spokesperson'] = array(); 
	$types['plant_collection'] = array(); 
	$types['collection'] = array(); 
	$types['youtube_video'] = array(); 
	$types['page'] = array();
	$types['press_release'] = array(); 
	$types['newsletter_archive'] = array(); 
	$types['post'] = array();
 
    // Split the post types in array $types
    if (!empty($hits)) {
        foreach ($hits[0] as $hit) {
            if (!is_array($types[$hit->post_type])) $types[$hit->post_type] = array();                        
            array_push($types[$hit->post_type], $hit);
        }
    }
 
    // Merge back to $hits in the desired order
    $hits[0] = array_merge($types['design_style'], $types['plant_savvy_template'], $types['newsletter_archive'], $types['spokesperson'], $types['plant_collection'], $types['collection'], $types['youtube_video'], $types['page'], $types['press_release'], $types['post']);
    return $hits;
}

/* Add meta data to the excerpts */
#add_filter('relevanssi_excerpt_content', 'add_meta_data_search', 8, 3);
function add_meta_data_search($content, $post, $query) {
	//The date
	//$date = 'Date: '.get_the_date('m j Y', $post->ID);
	//$content = $date.$content;
	
	return $content;
}

/* Add meta data to the excerpts */
#add_filter('relevanssi_pre_excerpt_content', 'pre_meta_data_search', 7, 3);
function pre_meta_data_search($content, $post, $query){
	//The date
	//$date = 'Test me';
	//$content = $date.$content;
	
	return $content;
}

// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
  if ( isset( $args->sub_menu ) ) {
    $root_id = 0;
    
    // find the current menu item
    foreach ( $sorted_menu_items as $menu_item ) {
      if ( $menu_item->current ) {
        // set the root id based on whether the current menu item has a parent or not
        $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
        break;
      }
    }
    
    // find the top level parent
    if ( ! isset( $args->direct_parent ) ) {
      $prev_root_id = $root_id;
      while ( $prev_root_id != 0 ) {
        foreach ( $sorted_menu_items as $menu_item ) {
          if ( $menu_item->ID == $prev_root_id ) {
            $prev_root_id = $menu_item->menu_item_parent;
            // don't set the root_id to 0 if we've reached the top of the menu
            if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
            break;
          } 
        }
      }
    }

    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
      // init menu_item_parents
      if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;

      if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
        // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
        // not part of sub-tree: away with it!
        unset( $sorted_menu_items[$key] );
      }
    }
	
	/* Overide Parent Object to adjust title and position in array! */
	$parent = array_slice($sorted_menu_items, 0, 1); // Grab the parent object
	$menuOrder = $parent[0]->menu_order; //Get th Menu Order
	$pID = $parent[0]->ID; //Get the Parent ID
	unset($sorted_menu_items[$menuOrder]); // Remove from Array
	$parent[0]->title = 'Overview';
	$parent[0]->menu_item_parent =  $pID;
	array_unshift($sorted_menu_items, $parent[0]); //Add back to array
	
    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}

/**
 * @param mixed $menu
 * @param int   $post_id
 *
 * @return WP_Post|bool
 */
function get_menu_parent( $menu, $post_id ) {

    $menu_items     = wp_get_nav_menu_items( $menu );
    $parent_item_id = wp_filter_object_list( $menu_items, array( 'object_id' => $post_id ), 'and', 'menu_item_parent' );

    if ( ! empty( $parent_item_id ) ) {
        $parent_item_id = array_shift( $parent_item_id );
        $parent_post_id = wp_filter_object_list( $menu_items, array( 'ID' => $parent_item_id ), 'and', 'object_id' );

        if ( ! empty( $parent_post_id ) ) {
            $parent_post_id = array_shift( $parent_post_id );
			
			$title = get_the_title($parent_post_id);
            return $title;
        }
    }
	$title = get_the_title($post_id);
    return $title;
}

/*
	Add to Pardot via the Sidebar Widget
	 
*/
function addSubscription(){
	 // Error string for aleady exist, may use in the future
	 #A prospect with the specified email address already exists
	 
	// If not registration
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		
		// This will log in and print your API Key (good for 1 hour) to the console
		$api = callPardotApi('https://pi.pardot.com/api/login/version/3',
			array(
				'email' => 'bexnowski@primitivespark.com',
				'password' => 'Wurlitzer77!',
				'user_key' => '716f7eaef2cf741e472ab651c479fd4d' //available from https://pi.pardot.com/account
			)
		);
		$result = addUserPardot($email, $api);
	}
	
	$status = $result['@attributes']['stat'];
	if($status == 'fail'){
		$message['copy'] = 	$result['err'];
	}else if($status == 'ok'){
		$message['copy'] = 	'You have been successfully added.';
	}
	$message['result'] = $status;
	echo json_encode($message);
	exit();
}
// Allow function to be used via ajax
add_action('wp_ajax_addSubscription', 'addSubscription');
add_action('wp_ajax_nopriv_addSubscription', 'addSubscription');

add_action('wp_head','ajaxurl');
function ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
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
	if(types_render_field('article-url', array('output' => 'raw')) != ''){
		
		return "...<a class='view-article' href='".types_render_field('article-url', array('output' => 'raw'))."' title='".get_the_title()."' target='_blank'>Read the full Story</a>";
	} else {
    	return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('Read the full story', 'pspark') . '</a>';
	}
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
