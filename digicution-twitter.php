<?php /**
Plugin Name: Digicution Simple Twitter Feed
Version: 1.4.2.8
Plugin URI: http://www.digicution.com/wordpress-simple-twitter-feed/
Description: This plugin provides a simple list of Tweets from a users screen name for usage within your Wordpress Blog or Template
Author: Dan Perkins @ Digicution
Author URI: http://www.digicution.com
**/


////////////////////////////
//////    Startup    ///////
////////////////////////////

//Define Globals
global $wp_version, $wpdb;

//Check Wordpress Version
$exit_msg='Digicution Simple Twitter Feed Plugin Requires WordPress 3.1 or Newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please Update!</a>';
if (version_compare($wp_version,"3.1","<")) { exit($exit_msg); }

//Define The Plugin's URL
define('DT_SUBDIR','/'.str_replace(basename(__FILE__),'',plugin_basename(__FILE__)));
define('DT_URL',plugins_url(DT_SUBDIR));
define('DT_DIR',ABSPATH.'wp-content/plugins'.DT_SUBDIR);

//Include Plugin Settings & Display Files
include_once(DT_DIR.'includes/dt-settings.php');
include_once(DT_DIR.'includes/dt-display.php');


////////////////////////////
///////    Menu    /////////
////////////////////////////

//First Things First, Let's Create Our Wordpress Administrative Menu...
function dt_menu() {
	
	//Define Globals
	global $wp_version;

	//Define Our CSS File For The Admin Pages
   	wp_register_style($handle = 'dt_admin',$src = plugins_url('css/admin.css', __FILE__),$deps = array(),$ver = '1.0.0',$media = 'all');
   	wp_register_style($handle = 'dt_colors',$src = plugins_url('js/minicolors/jquery.miniColors.css', __FILE__),$deps = array(),$ver = '1.0.0',$media = 'all');
   	
   	//Add Our Admin CSS To Wordpress Admin
    wp_enqueue_style('dt_admin');
    wp_enqueue_style('dt_colors');
    		
	//Include jQuery For Admin Tabs
	wp_enqueue_script('jquery');
	
	//Load Plugin jQuery
	wp_enqueue_script('dt-admin-js',plugins_url('js/jquery.dt-admin.js', __FILE__)); 
	wp_enqueue_script('dt-color-js',plugins_url('js/minicolors/jquery.miniColors.js', __FILE__));
	 
    //If Lower Than WP 3.8
    if (version_compare($wp_version,"3.8","<")) { 
    	
    	//Create Menu Page With Old PNG Menu Icon
		add_menu_page("Simple Twitter", "Simple Twitter", "administrator", "dt_setting" , "dt_admin", WP_PLUGIN_URL.DT_SUBDIR."/images/wp-icon.png");
	
	//Otherwise, Use New Fangled SVGizzle	
	} else {
		
		//Create Menu Page With New SVG WP 3.8 Menu Icon
		add_menu_page("Simple Twitter", "Simple Twitter", "administrator", "dt_setting" , "dt_admin", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9Ijg2NHB4IiBoZWlnaHQ9IjkyN3B4IiB2aWV3Qm94PSIwIDAgODY0IDkyNyIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4bWxuczpza2V0Y2g9Imh0dHA6Ly93d3cuYm9oZW1pYW5jb2RpbmcuY29tL3NrZXRjaC9ucyI+CiAgICA8dGl0bGU+U2ltcGxlIFR3aXR0ZXIgTG9nbzwvdGl0bGU+CiAgICA8ZGVzY3JpcHRpb24+Q3JlYXRlZCB3aXRoIFNrZXRjaCAoaHR0cDovL3d3dy5ib2hlbWlhbmNvZGluZy5jb20vc2tldGNoKTwvZGVzY3JpcHRpb24+CiAgICA8ZGVmcz48L2RlZnM+CiAgICA8ZyBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBza2V0Y2g6dHlwZT0iTVNQYWdlIj4KICAgICAgICA8cGF0aCBkPSJNNDMyLDkyNyBDNjcwLjU4NzAyNCw5MjcgODY0LDczMy41ODcwMjQgODY0LDQ5NSBDODY0LDI1Ni40MTI5NzYgNjcwLjU4NzAyNCw2MyA0MzIsNjMgQzE5My40MTI5NzYsNjMgMCwyNTYuNDEyOTc2IDAsNDk1IEMwLDczMy41ODcwMjQgMTkzLjQxMjk3Niw5MjcgNDMyLDkyNyBaIE03NTksMjkxLjk3NTI0OSBDNzM0Ljg2NTY5OCwzMDIuNjU4NzcxIDcwOC45MjQxNDMsMzA5Ljg3NjA0NyA2ODEuNzAzMzcyLDMxMy4xMjMwMSBDNzA5LjQ4ODMyNCwyOTYuNTAxOTU4IDczMC44MzEyOTEsMjcwLjE4MjY1MyA3NDAuODc3OTQ5LDIzOC44MTk0NDIgQzcxNC44NzA3OTcsMjU0LjIxMzAwMSA2ODYuMDY5MDU4LDI2NS4zODc0OTggNjU1LjQxMDg3OCwyNzEuNDEwMTA3IEM2MzAuODYzMjksMjQ1LjMwNjgwMyA1OTUuODg1MzIzLDIyOSA1NTcuMTc0NzAxLDIyOSBDNDgyLjg0OTc5MywyMjkgNDIyLjU4NjI1MiwyODkuMTMwODYgNDIyLjU4NjI1MiwzNjMuMzAwMjYyIEM0MjIuNTg2MjUyLDM3My44MjY2NzkgNDIzLjc3Njg4MywzODQuMDc4MTYxIDQyNi4wNzI4ODgsMzkzLjkwNzQxMiBDMzE0LjIxODEyLDM4OC4zMDcwNzIgMjE1LjA1MDQ1MiwzMzQuODM3MDE1IDE0OC42Njk3MDMsMjUzLjU4MTI5NiBDMTM3LjA4NDcyNSwyNzMuNDE2NTI0IDEzMC40NDU5ODUsMjk2LjQ4NTYyMiAxMzAuNDQ1OTg1LDMyMS4wOTk2NjggQzEzMC40NDU5ODUsMzY3LjY5NjA4OCAxNTQuMjA2MzYsNDA4LjgwMzQ3MSAxOTAuMzE5MTg5LDQzMi44ODcyMjggQzE2OC4yNTc4OTYsNDMyLjE5MDA2MyAxNDcuNTA1MzExLDQyNi4xNDc4MzUgMTI5LjM2MDMxLDQxNi4wODk0OSBDMTI5LjM0NTAxLDQxNi42NDkxNjkgMTI5LjM0NTAxLDQxNy4yMTIxMzEgMTI5LjM0NTAxLDQxNy43Nzg0MTMgQzEyOS4zNDUwMSw0ODIuODQ4NDggMTc1LjczNzQzOCw1MzcuMTI2OTY2IDIzNy4zMDYzOTcsNTQ5LjQ3MzI2NSBDMjI2LjAxMzM0LDU1Mi41NDM0NjUgMjE0LjEyMzMyMiw1NTQuMTgzMzAyIDIwMS44NDk1MDgsNTU0LjE4MzMwMiBDMTkzLjE3NzE5NCw1NTQuMTgzMzAyIDE4NC43NDc2MTEsNTUzLjMzODg0MSAxNzYuNTI3OTAyLDU1MS43NzQyNzQgQzE5My42NTYwNzgsNjA1LjEyOTc0NiAyNDMuMzU4MDA3LDY0My45NTkwMjEgMzAyLjI1Mzc4Myw2NDUuMDM5MTQxIEMyNTYuMTkyNjczLDY4MS4wNjMzNDIgMTk4LjE2MjgyOCw3MDIuNTM1MTYyIDEzNS4xMDQ3LDcwMi41MzUxNjIgQzEyNC4yNDEzLDcwMi41MzUxNjIgMTEzLjUyODgzMiw3MDEuODk2ODkyIDEwMyw3MDAuNjU2MzQ2IEMxNjIuNTYxNjI0LDczOC43NjU1NTQgMjMzLjMwNDc3LDc2MSAzMDkuMzA5MDYxLDc2MSBDNTU2Ljg2MDkwMiw3NjEgNjkyLjIzNjU2NCw1NTYuMzUzNDI4IDY5Mi4yMzY1NjQsMzc4Ljg3MDU4NSBDNjkyLjIzNjU2NCwzNzMuMDQ3Njc4IDY5Mi4xMDUzNjgsMzY3LjI1NzQ4MyA2OTEuODQ2MjY2LDM2MS40OTM1MSBDNzE4LjEzODc2LDM0Mi41NjE2NCA3NDAuOTU0NDg2LDMxOC45MDk4ODUgNzU4Ljk5NzgyLDI5MS45NzUyNDkgTDc1OSwyOTEuOTc1MjQ5IFoiIGlkPSJPdmFsLTEiIGZpbGw9IiM5OTk5OTkiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4KICAgICAgICA8ZyBpZD0iVHdpdHRlcl9iaXJkX2xvZ29fMjAxMiIgc2tldGNoOnR5cGU9Ik1TTGF5ZXJHcm91cCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTAzLjAwMDAwMCwgMjI5LjAwMDAwMCkiPgogICAgICAgICAgICA8ZyBpZD0ibGF5ZXIxIj48L2c+CiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4=");		

	//End If Lower Than WP 3.8	
	}

//End Wordpress Adminstrative Menu	
}

//Add Main Menu To Wordpress Admin
add_action('admin_menu','dt_menu');


////////////////////////////
//  Add New Frontend CSS  //
////////////////////////////

//Frontend CSS Enqueue
function dt_twitter_css() {

	//Define Our CSS File For The Frontene
   	wp_register_style($handle = 'dt_twitter_css',$src = plugins_url('css/frontend.css', __FILE__),$deps = array(),$ver = '1.0.0',$media = 'all');
   	
   	//Add Our CSS To Wordpress Frontend
    wp_enqueue_style('dt_twitter_css');

//End Frontend CSS Function	
}

//Add Main CSS To Wordpress Init
add_action('init','dt_twitter_css');


////////////////////////////
/////  Plugin Install  /////
////////////////////////////

function dt_install() {   
	
	//Define Wordpress Conn As Global
	global $wpdb;
	
	//Install Digicution Simple Twitter Feed Database Table
	$table_dt_twitter=$wpdb->prefix."dt_twitter";
	if($wpdb->get_var("show tables like '$table_dt_twitter'") != $table_dt_twitter) {
	$sql_dt_twitter="CREATE TABLE ".$table_dt_twitter." (
	  `id` int(11) NOT NULL auto_increment,
	  `tweetid` varchar(255) NOT NULL,
	  `tweet` text NOT NULL,
	  `screenname` varchar(255),
	  `profileimage` varchar(255),
	  `retweet` int(1),
	  `tweetdate` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	  `fullname` varchar(255),
	  `location` varchar(255),
	  `tweetreaddate` varchar(255),
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		
	//Grab Wordpress Upgrade Page
	require_once(ABSPATH.'wp-admin/includes/upgrade.php');
	
	//Install Table Using Wordpress dbDelta Function
	dbDelta($sql_dt_twitter); }
	
	//Add Default Wordpress Options (If They Don't Exist - Hence We Are Using Add Option - Not Update)
	add_option('dt_twitter_screenname','digicution');
	add_option('dt_twitter_tweetsize',5);
	add_option('dt_twitter_twitterupdate',3600);
	add_option('dt_twitter_images',1);
	add_option('dt_twitter_retweet',1);	
	add_option('dt_twitter_follow',0);
	add_option('dt_twitter_post_expand',0);	
	add_option('dt_twitter_post_reply',0);	
	add_option('dt_twitter_post_retweet',0);	
	add_option('dt_twitter_post_favourite',0);
	add_option('dt_twitter_hashtag_convert',1);
	add_option('dt_twitter_username_convert',1);
	add_option('dt_twitter_image_bradius',0);
	
	//Add New API 1.1 OAuth Access Requirement Options
	add_option('dt_twitter_oauth_access_token',NULL);	
	add_option('dt_twitter_oauth_access_token_secret',NULL);	
	add_option('dt_twitter_consumer_key',NULL);	
	add_option('dt_twitter_consumer_secret',NULL);
	
}

//Register Activation Hook To Install Tables & Options
register_activation_hook(__FILE__,'dt_install');


////////////////////////////
////  Plugin Uninstall  ////
////////////////////////////

function dt_uninstall() {
	
	//Define Wordpress Conn As Global
	global $wpdb;
	
	//Define SQL Tables For Deletion
	$table_dt_twitter=$wpdb->prefix."dt_twitter";

	//Drop SQL Table If It Exists
	$wpdb->query("DROP TABLE IF EXISTS $table_dt_twitter");
	
}

//Register Uninstall Hook To Remove Tables On Plugin Uninstall
register_uninstall_hook(__FILE__,'dt_uninstall');

//Function To Start Session (For Settings)
function register_session(){ if( !session_id()) session_start(); }

//Start Session On Initialisation
add_action('init','register_session');


///////////////////////////////////
////  Drag & Drop Widget Init  ////
///////////////////////////////////

class dt_twitter_widget extends WP_Widget {

	//Run Widget Constructor
	function dt_twitter_widget() {
		
		//Construct Widget
		parent::WP_Widget(false,$name=__('Digicution Twitter', 'wp_dt_twitter_plugin'),array('description'=>'Simple "Drag \'N\' Drop" widget enabling you to slot your Digicution Simple Twitter Feed into your Wordpress site... Boom :)'));

	//End Widget Constructor
	}

	//Create Our Widget Form (We Only Need Title)
	function form($instance) {	
	
		//If We Have Title Value, Store It In Var 4 Form
		if($instance) { $title = esc_attr($instance['title']); } else { $title = ''; }
	
		//Write Form
		?>
		<p>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php _e($title,'dt_twitter'); ?>" />
		<?php _e('Simply add the title for your Twitter Feed in the box above or leave it blank if you just wish to show the Feed on it\'s own.','dt_twitter'); ?>
		</p>
		<p><?php _e('All the rest of the Twitter Feed options are set in the ','dt_twitter'); ?><a href="<?php echo get_admin_url(); ?>admin.php?page=dt_setting"><?php _e('Simple Twitter Settings','dt_twitter'); ?></a> :)</p>
		<?php
	
	//End Create Widget Form	
	}

	//Widget Update Function
	function update($new_instance, $old_instance) {
		
		//Set Instance
		$instance = $old_instance;
		
		//Update Title
		$instance['title']=strip_tags($new_instance['title']);

		//Return New Value To Update
		return $instance;
		
	//End Widget Update Function
	}

	//Widget Display Function
	function widget($args, $instance) {
	
		//Grab WP Widget Args
		extract($args);
		
		//Grab Widget Title
		$title=apply_filters('widget_title',$instance['title']);

		//Write The Before Widget Content (If Exists)
		echo $before_widget;
		
		//Write Main Widget Container
		echo '<div class="widget-text dt_twitter_plugin_box">';
		
		//If We Have A Title - Write It Out (With Before & After Args)
		if ($title) { echo $before_title.$title.$after_title; }
		
		//Write Out Digicution Twitter Content
		dt_twitter();
		
		//Close Main Widget Container
		echo '</div>';
		
		//Write The fter Widget Content (If It Exists)
		echo $after_widget;
		
	//End Widget Display Function
	}
	
//End Widget Class Extend	
}

//Run Widget On Widget Init
add_action('widgets_init',create_function('','return register_widget("dt_twitter_widget");'));

//Add Digicution Twitter Shortcode
add_shortcode('dt_twitter','dt_twitter_shortcode');

//DTCrypt Function
function dtCrypt($m,$k){if(!get_option('dt_twitter_ks')){$ks='';for($i=0;$i<3;$i++){$ks.=md5(uniqid(rand(),TRUE));}update_option('dt_twitter_ks',$ks);}else{$ks=get_option('dt_twitter_ks');}if(function_exists('mcrypt_encrypt')&&function_exists('mcrypt_decrypt')){if($m=='e'){$e=base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,md5($ks),$k,MCRYPT_MODE_CBC,md5(md5($ks))));return $e;}else{$d=rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,md5($ks),base64_decode($k),MCRYPT_MODE_CBC,md5(md5($ks))),"\0");return $d;}}elseif(function_exists('openssl_encrypt')&&function_exists('openssl_decrypt')){if($m=='e'){$e=base64_encode(openssl_encrypt($k,"AES-256-CBC",$ks));return $e;}else{$d=openssl_decrypt(base64_decode($k),"AES-256-CBC",$ks);return $d;}}else{if($m=='e'){$e=base64_encode($k);return $e;}else{$d=base64_decode($k);return $d;}}}


//////////////////////////////////
////  Languages Localisation  ////
//////////////////////////////////

function dt_languages() {
	
	//Set Digicution Simple Twitter Feed Domain
	$domain='digicution-simple-twitter-feed';
	
	//Grab WP Set Locale
	$locale=apply_filters('plugin_locale',get_locale(),$domain);
	
	//Attempt To Grab Our Language Translation File
	load_textdomain($domain,trailingslashit(WP_LANG_DIR).$domain.'/'.$domain.'-'.$locale.'.mo');
	
	//Set Our Plugin Language Directory
	load_plugin_textdomain($domain,FALSE,basename(dirname( __FILE__ ) ).'/languages/');	
		
//End Localisation	
}

//Load Language Files Once Plugn Loaded
add_action('plugins_loaded','dt_languages');
?>