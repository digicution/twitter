<?php
///////////////////////////////////////////////////////////
///// Digicution Simple Twitter Feed Update Function  /////
///////////////////////////////////////////////////////////

function dt_twitter_update($tweetNoOverride=NULL) {

	////////////////////////////////////////////////////////////////////////////////
	//////  New CURL Only Method As We Need To Send OAuth Headers For 1.1 API //////
	////////////////////////////////////////////////////////////////////////////////

	//Only Run Update If CURL Exists
	if (function_exists('curl_init')) { 

		///////////////////////////////////
		////// Define Main Variables //////
		///////////////////////////////////
	
		//Define Wordpress Conn As Global
		global $wpdb;
		
		//Define Tables
		$table_dt_twitter=$wpdb->prefix."dt_twitter";
		
		///////////////////////////////////
		////// Construct Twitter URL //////
		///////////////////////////////////
		
		//Get OAuth Authentication Details (Twitter API V1.1)
		$dt_twitter_oauth_access_token=dtCrypt('d',get_option('dt_twitter_oauth_access_token'));
		$dt_twitter_oauth_access_token_secret=dtCrypt('d',get_option('dt_twitter_oauth_access_token_secret'));
		$dt_twitter_consumer_key=dtCrypt('d',get_option('dt_twitter_consumer_key'));
		$dt_twitter_consumer_secret=dtCrypt('d',get_option('dt_twitter_consumer_secret'));
	
		//Get General Options
		$screenname=get_option('dt_twitter_screenname');
		$size=get_option('dt_twitter_tweetsize');
		//If Override Size Is Bigger Than Option Size - Increase Limit So We Get Enough Tweets
		if($tweetNoOverride && ($tweetNoOverride>$size)) { $size=$tweetNoOverride; }
		$getretweets=get_option('dt_twitter_retweet');
				
		//Check Our Retweets Option
		if($getretweets==1) {
			
			//Get All Tweets URL
			$url="https://api.twitter.com/1.1/statuses/user_timeline.json?count=$size&include_entities=true&include_rts=true&screen_name=$screenname";
	
		//Otherwise
		} else {
			
			//Multiple Size By 20 To Do Our Best To Ensure We Get Enough Native Tweets To Fill Our Size Value
			$size=$size*20;
			
			//No ReTweets URL
			$url="https://api.twitter.com/1.1/statuses/user_timeline.json?count=$size&exclude_replies=true&include_entities=true&include_rts=false&screen_name=$screenname";
		
		//End Retweet Option Check	
		}	
	
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		////// Lookup Twitter Details - New CURL Only Method As We Need To Send OAuth Headers For 1.1 API //////
		////////////////////////////////////////////////////////////////////////////////////////////////////////
	
		//If We Have All Required Tokens & Keys
		if($dt_twitter_oauth_access_token && $dt_twitter_oauth_access_token_secret && $dt_twitter_consumer_key && $dt_twitter_consumer_secret) {
	
			///////////////////////////////////////
			////// Construct Twitter Details //////
			///////////////////////////////////////
			
			//Construct oAuth Hash
			$oauth_hash = '';
			$oauth_hash .= 'count='.$size.'&';
			if($getretweets!=1) { $oauth_hash .= 'exclude_replies=true&'; }
			$oauth_hash .= 'include_entities=true&';
			if($getretweets==1) { $oauth_hash .= 'include_rts=true&'; } else { $oauth_hash .= 'include_rts=false&'; }
			$oauth_hash .= 'oauth_consumer_key='.$dt_twitter_consumer_key.'&';
			$oauth_hash .= 'oauth_nonce=' . time() . '&';
			$oauth_hash .= 'oauth_signature_method=HMAC-SHA1&';
			$oauth_hash .= 'oauth_timestamp=' . time() . '&';
			$oauth_hash .= 'oauth_token='.$dt_twitter_oauth_access_token.'&';
			$oauth_hash .= 'oauth_version=1.0&';	
			$oauth_hash .= 'screen_name='.$screenname;
	
			//Construct Base
			$base = '';
			$base .= 'GET';
			$base .= '&';
			$base .= rawurlencode('https://api.twitter.com/1.1/statuses/user_timeline.json');
			$base .= '&';
			$base .= rawurlencode($oauth_hash);	
			
			//Construct Key
			$key = '';
			$key .= rawurlencode($dt_twitter_consumer_secret);
			$key .= '&';
			$key .= rawurlencode($dt_twitter_oauth_access_token_secret);
			
			//Construct Signature
			$signature = base64_encode(hash_hmac('sha1', $base, $key, true));
			$signature = rawurlencode($signature);	
	
			//Construct oAuth Header
			$oauth_header = '';
			$oauth_header .= 'count="'.$size.'", ';
			if($getretweets!=1) { $oauth_header .= 'exclude_replies="true", '; }
			$oauth_header .= 'include_entities="true", ';
			if($getretweets==1) { $oauth_header .= 'include_rts="true", '; } else { $oauth_header .= 'include_rts="false", '; }
			$oauth_header .= 'oauth_consumer_key="'.$dt_twitter_consumer_key.'", ';
			$oauth_header .= 'oauth_nonce="' . time() . '", ';
			$oauth_header .= 'oauth_signature="' . $signature . '", ';
			$oauth_header .= 'oauth_signature_method="HMAC-SHA1", ';
			$oauth_header .= 'oauth_timestamp="' . time() . '", ';
			$oauth_header .= 'oauth_token="'.$dt_twitter_oauth_access_token.'", ';
			$oauth_header .= 'oauth_version="1.0", ';
			$oauth_header .= 'screen_name="'.$screenname.'"';
			
			//Construct cURL Header
			$curl_header = array("Authorization: Oauth {$oauth_header}", 'Expect:');	
	
			////////////////////////////////////
			////// Lookup Twitter Details //////
			////////////////////////////////////
	
			$curl_request = curl_init();
			curl_setopt($curl_request, CURLOPT_HTTPHEADER, $curl_header);
			curl_setopt($curl_request, CURLOPT_HEADER, false);
			curl_setopt($curl_request, CURLOPT_URL, $url);
			curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);
			$json = curl_exec($curl_request);
			curl_close($curl_request);	
	
			//Decode Data Ready For Processing
			$data=json_decode($json);
				
			//For Debugging Purposes - Display All Info Returned By Twitter API
			//print_r($json);
			//echo '<br/><br/>';
			//print_r($data);
			//echo '<br/><br/>';
		
			////////////////////////////////////
			//////  Decode Twitter JSON  ///////
			////////////////////////////////////
			
			//If We Have Data
			if ($data) {
			
				//Clear Database Table
				$wpdb->query("DELETE FROM $table_dt_twitter"); 
			
				//Set Counter
				$tweetcount=0;
						
				//Loop Through Tweets
				foreach($data as $t) {
			
					//Add 1 To Tweetcounter
					$tweetcount++;
					
					//If Tweetcounter Is Not More Than Our Tweetsize
					if ($tweetcount<=$size) {
			
						//Set Standard Variables
						$tweet="";
						$retweet=1;
								
						//Get Tweet ID For Date Link - Added Str Val (And id_str Rather Than id To Remove Any Possible +E Numbers In Certain PHP Installs)
						$tweetid=strval($t->id_str);
												
						//Grab User Vars
						$user=$t->user;
						
						//Grab User Full Name
						$userfullname=$t->user->name;
						
						//Grab Tweeter Location
						$userlocation=$t->user->location;
						
						//Grab Tweet Profile Image (In Case It Is ReTweet)
						$image=$t->retweeted_status->user->profile_image_url;
						
						//Grab Tweeter Screen Name (In Case It Is ReTweet)
						$user_screen_name=$t->retweeted_status->user->screen_name;
						
						//Grab Tweeter Full Name
						$user_full_name=$t->retweeted_status->user->name;
						
						//Grab Tweeter Location
						$user_location=$t->retweeted_status->user->location;
						
						//If No Image Use Our Profile Image
						if (!$image) { $image = $user->profile_image_url; }
						
						//If Not Re-Tweet - Must Be Ours So Use Our Tweet Vars & Set Re-Tweet Variable
						if (!$user_screen_name) { $user_screen_name = $screenname; $user_full_name=$userfullname; $user_location=$userlocation; $retweet=0; }
						
						//Add The Tweet Text
						$tweet = $t->text;
									
						//Grab Tweet Entities
						$entities = $t->entities;
									
						//Set Counter To 0
						$i = 0;
						
						//Convert URL Strings To Actual URLs
						$tweet=dt_convert_urls($tweet);
												
						//Loop Through Our Replacement Array & Make The Changes For URL's & Mention Links
						for($i = 0; $i < count($string); $i++) {
							$pattern = $replace[$i];
							$tweet = str_replace($pattern, $string[$i], $tweet);
						}
						
						//Grab Tweet Date (UTC)
						$date=strtotime($t->created_at);

						//Date From Twitter Is UTC - As Is PHP's, Thus Date Comparison Of 2 Gives Us Correct Time Difference.  Thanks To Maciek Nowakiewic​z For Pointing This Out (And Saving Me Time Doing Ridonculous UTC Calcs :)
						$date=human_time_diff($date,time());
									
						//Clean Twitter ID
						$tweetid=mysql_real_escape_string($tweetid);
						
						//Check If Tweet Exists In DB
						$tweetCheck=$wpdb->prepare("SELECT id FROM $table_dt_twitter WHERE tweetid=%d",$tweetid);
						$tweetChecker=$wpdb->get_row($tweetCheck,OBJECT);
											
						//If We Have A Tweet With This ID - Delete The Record So We Can Insert New One, Updating Is So Last Year :)
						if (!empty($tweetChecker)) { $wpdb->query("DELETE FROM $table_dt_twitter WHERE tweetid=".$tweetid); }
						
						//Set Tweet Refresh Date (UTC Global)
						$tweetrefreshdate=date('Y-m-d H:i:s',time());
						
						//Insert Tweet Into DB
						$wpdb->insert($table_dt_twitter, array('tweetid' => $tweetid, 'tweet' => $tweet, 'screenname' => $user_screen_name, 'profileimage' => $image, 'tweetdate' => $tweetrefreshdate, 'retweet' => $retweet, 'fullname' => $user_full_name, 'location' => $user_location, 'tweetreaddate' => $date));	
				
					//End If Tweetcount Is Not More Than Size
					}
				
				//End For Each Tweet Loop		
				}
				
				//Optimize Wordpress Twitter Table
				$wpdb->query("OPTIMIZE TABLE $table_dt_twitter"); 
			
			//End If We Have Data Statement
			}
		
		//End If We Have All Required Keys & Tokens	
		}

	//End Only Run If CURL Exists
	}

//End Update Function	
}


///////////////////////////////////////////////////////////
/////  Digicution Simple Twitter Feed Main Function   /////
///////////////////////////////////////////////////////////	
	
function dt_twitter($tweetNoOverride=NULL,$shortcodeOutput=NULL) {

	////////////////////////////////////////////////////////////////////////////////
	//////  New CURL Only Method As We Need To Send OAuth Headers For 1.1 API //////
	////////////////////////////////////////////////////////////////////////////////

	//Only Run Update If CURL Exists
	if (function_exists('curl_init')) { 
	
		//Initiate Wordpress DB As Global Please...
		global $wpdb;
		
		//Define Tables
		$table_dt_twitter=$wpdb->prefix."dt_twitter";
	
		//Get Our Options
		$twitterupdate=get_option('dt_twitter_twitterupdate');
		
		//Pull Last Tweet From DB 
		$queryTweet="SELECT tweetid, tweetdate FROM $table_dt_twitter ORDER BY tweetid DESC LIMIT 0,1";
		$lastTweet=$wpdb->get_row($queryTweet, OBJECT);
	
	    //If We Have A Last Tweet...
	    if (!empty($lastTweet)) {
		 	 
			//Grab Variables We Need
			$tweetID=$lastTweet->tweetid;
			$tweetDate=$lastTweet->tweetdate;
			
			//Add An Hour To The Timestamp For Checking
			$tweetDateCheck=strtotime($tweetDate)+$twitterupdate;
					
			//If Twitter Was Updated Less Than Our Update Frequency Timeout		
			if ($tweetDateCheck >= time()) {
				
				//Grab The Tweets
				$dtoutput=dt_twitter_display($tweetNoOverride);
			
			//Otherwise - We Need To Update	
			} else {
			
				//Update The Tweets
				dt_twitter_update($tweetNoOverride);
				
				//Grab The Tweets
				$dtoutput=dt_twitter_display($tweetNoOverride);
				
			//End Timeout Check	
			}
		
		//Otherwise - We Have No Tweets In The DB So...	
		} else {
		
			//Attempt To Update The Tweets
			dt_twitter_update($tweetNoOverride);
			
			//Attempt To Grab The Tweets
			$dtoutput=dt_twitter_display($tweetNoOverride);
		
		//End If We Have A Last Tweet
		}
	
		//If This Is A Shortcode Request, Return The Data
		if($shortcodeOutput==1) {
		
			//Return The Data
			return $dtoutput;
		
		//Otherwise,
		} else {
			
			//Display Those Bad Boys
			echo $dtoutput;
		
		//End If Shortcode Request	
		}
	
	//End If No CURL Function Exists
	}

//End Function	
}


///////////////////////////////////////////////////////////
/////    Digicution Simple Twitter Feed Shortcode     /////
///////////////////////////////////////////////////////////

function dt_twitter_shortcode() {

	//Run Shortcode Version Of Digicution Twitter
	$dtoutput=dt_twitter(NULL,1);
	
	//Return Output
	return $dtoutput;

//End Specific Shortcode Function
}


///////////////////////////////////////////////////////////
///// Digicution Simple Twitter Feed Display Function /////
///////////////////////////////////////////////////////////

function dt_twitter_display($tweetNoOverride=NULL) {
	
	//OK, Let's Define An Output Variable (So We Can Return For Shortcode)
	$twitteroutput='';
	
	//Initiate Wordpress DB As Global Please...
	global $wpdb;
	
	//Define Tables
	$table_dt_twitter=$wpdb->prefix."dt_twitter";

	//Get Our General Options
	$screenname=get_option('dt_twitter_screenname');
	$size=get_option('dt_twitter_tweetsize');	
	$twitterimages=get_option('dt_twitter_images');
	$twitterfollow=get_option('dt_twitter_follow');
	$twitterpexpand=get_option('dt_twitter_post_expand');	
	$twitterpreply=get_option('dt_twitter_post_reply');	
	$twitterpretweet=get_option('dt_twitter_post_retweet');	
	$twitterpfavourite=get_option('dt_twitter_post_favourite');
	$twitter_screenname_display=get_option('dt_twitter_screenname_display');
	$twitter_fullname_display=get_option('dt_twitter_fullname_display');
	$twitter_date_display=get_option('dt_twitter_readdate_display');
	$twitter_header_display=get_option('dt_twitter_header_display');
	$twitter_header_title=get_option('dt_twitter_header_title');
	$twitter_header_follow=get_option('dt_twitter_header_follow');
	$twitter_hashtag_convert=get_option('dt_twitter_hashtag_convert');
	$twitter_username_convert=get_option('dt_twitter_username_convert');
	
	//If Override Size Option Submitted - Override Size
	if($tweetNoOverride) { $size=$tweetNoOverride; }

	//Grab Tweets From DB
	$queryTweets="SELECT tweetid, tweet, screenname, profileimage, fullname, tweetreaddate FROM $table_dt_twitter ORDER BY tweetid DESC LIMIT 0,".$size;
	$tweety=$wpdb->get_results($queryTweets, OBJECT);
	
	//Get Automatic Styling Option
	$dtauto=get_option('dt_twitter_display_auto');
	
	//Define Style Variable
	$style='';
	
	//If Automatic Styling Is Set To Yes
	if($dtauto==1) {
	
		//Get Main Container Options
		$dt_twitter_display_mcwidth=get_option('dt_twitter_display_mcwidth');
		$dt_twitter_display_mcwidth_unit=get_option('dt_twitter_display_mcwidth_unit');
		$dt_twitter_display_mcpaddingtop=get_option('dt_twitter_display_mcpaddingtop');
		$dt_twitter_display_mcpaddingtop_unit=get_option('dt_twitter_display_mcpaddingtop_unit');
		$dt_twitter_display_mcpaddingbottom=get_option('dt_twitter_display_mcpaddingbottom');
		$dt_twitter_display_mcpaddingbottom_unit=get_option('dt_twitter_display_mcpaddingbottom_unit');
		$dt_twitter_display_mcpaddingleft=get_option('dt_twitter_display_mcpaddingleft');
		$dt_twitter_display_mcpaddingleft_unit=get_option('dt_twitter_display_mcpaddingleft_unit');
		$dt_twitter_display_mcpaddingright=get_option('dt_twitter_display_mcpaddingright');
		$dt_twitter_display_mcpaddingright_unit=get_option('dt_twitter_display_mcpaddingright_unit');
		$dt_twitter_display_mcmargintop=get_option('dt_twitter_display_mcmargintop');
		$dt_twitter_display_mcmargintop_unit=get_option('dt_twitter_display_mcmargintop_unit');
		$dt_twitter_display_mcmarginbottom=get_option('dt_twitter_display_mcmarginbottom');
		$dt_twitter_display_mcmarginbottom_unit=get_option('dt_twitter_display_mcmarginbottom_unit');
		$dt_twitter_display_mcmarginleft=get_option('dt_twitter_display_mcmarginleft');
		$dt_twitter_display_mcmarginleft_unit=get_option('dt_twitter_display_mcmarginleft_unit');
		$dt_twitter_display_mcmarginright=get_option('dt_twitter_display_mcmarginright');
		$dt_twitter_display_mcmarginright_unit=get_option('dt_twitter_display_mcmarginright_unit');
		$dt_twitter_display_mcbg=get_option('dt_twitter_display_mcbg');
		$dt_twitter_display_mcbg_enabled=get_option('dt_twitter_display_mcbg_enabled');
		$dt_twitter_display_mcbradius=get_option('dt_twitter_display_mcbradius');
		$dt_twitter_display_mcbradius_unit=get_option('dt_twitter_display_mcbradius_unit');

		//Create Our CSS Container Style
		$style=' style="width:'.$dt_twitter_display_mcwidth;
		if ($dt_twitter_display_mcwidth_unit==1) { $style.='px;'; } else { $style.='%;'; }
		if ($dt_twitter_display_mcpaddingtop) { $style.='padding-top:'.$dt_twitter_display_mcpaddingtop; if($dt_twitter_display_mcpaddingtop_unit==1) { $style.='px;'; } else { $style.='%;'; } }
		if ($dt_twitter_display_mcpaddingbottom) { $style.='padding-bottom:'.$dt_twitter_display_mcpaddingbottom; if($dt_twitter_display_mcpaddingbottom_unit==1) { $style.='px;'; } else { $style.='%;'; } }
		if ($dt_twitter_display_mcpaddingleft) { $style.='padding-left:'.$dt_twitter_display_mcpaddingleft; if($dt_twitter_display_mcpaddingleft_unit==1) { $style.='px;'; } else { $style.='%;'; } }
		if ($dt_twitter_display_mcpaddingright) { $style.='padding-right:'.$dt_twitter_display_mcpaddingright; if($dt_twitter_display_mcpaddingright_unit==1) { $style.='px;'; } else { $style.='%;'; } }
		if ($dt_twitter_display_mcmargintop) { $style.='margin-top:'.$dt_twitter_display_mcmargintop; if($dt_twitter_display_mcmargintop_unit==1) { $style.='px;'; } else { $style.='%;'; } }
		if ($dt_twitter_display_mcmarginbottom) { $style.='margin-bottom:'.$dt_twitter_display_mcmarginbottom; if($dt_twitter_display_mcmarginbottom_unit==1) { $style.='px;'; } else { $style.='%;'; } }
		if ($dt_twitter_display_mcmarginleft) { $style.='margin-left:'.$dt_twitter_display_mcmarginleft; if($dt_twitter_display_mcmarginleft_unit==1) { $style.='px;'; } else { $style.='%;'; } }
		if ($dt_twitter_display_mcmarginright) { $style.='margin-right:'.$dt_twitter_display_mcmarginright; if($dt_twitter_display_mcmarginright_unit==1) { $style.='px;'; } else { $style.='%;'; } }
		if ($dt_twitter_display_mcbg_enabled==1) { $style.='background-color:'.$dt_twitter_display_mcbg.';'; }
		if ($dt_twitter_display_mcbradius) { if($dt_twitter_display_mcbradius_unit==1) { $radunit='px'; } else { $radunit='%'; } $style.='-moz-border-radius:'.$dt_twitter_display_mcbradius.$radunit.';-webkit-border-radius:'.$dt_twitter_display_mcbradius.$radunit.';-khtml-border-radius:'.$dt_twitter_display_mcbradius.$radunit.';border-radius:'.$dt_twitter_display_mcbradius.$radunit.';'; }
		$style.='"';

	//End If Automatic Styling Set To Yes
	}
	
	//If Header Option Is Selected
	if($twitter_header_display==1) {
	
		//Start Header
		$twitteroutput.='<div class="dt-twitter-header">'.$twitter_header_title;
		
		//If We Have A Header Follow Text Option
		if ($twitter_header_follow==1) { $twitteroutput.='<a href="http://twitter.com/'.$screenname.'" class="dt-twitter-header-follow" rel="nofollow">Follow @'.$screenname.'</a>'; } 
		
		//If We Have A Header Follow Button Option
		if ($twitter_header_follow==2) { $twitteroutput.='<a href="https://twitter.com/'.$screenname.'" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false" data-dnt="true">Follow</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>'; }

		//If We Have A Header Follow Button Option With Screename
		if ($twitter_header_follow==3) { $twitteroutput.='<a href="https://twitter.com/'.$screenname.'" class="twitter-follow-button" data-show-count="false" data-show-screen-name="true" data-dnt="true">Follow &#64;'.$screenname.'</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>'; }

		//End Header
		$twitteroutput.='</div>';

	//End If Header Option Selected	
	}
	
	//Start The Unordered List
	$twitteroutput.='<ul class="dt-twitter"'.$style.'>';
	
	//Zero Odd Even Counter
	$oddity=0;
	
	//Main Count
	$count=0;
	
	//Define Tweet Style Variables
	$listyle='';
	$lialtstyle='';
	$astyle='';
	$imgstyle='';
	
	//If Automatic Styling Is Set To Yes
	if($dtauto==1) {
	
		//Get Tweet Styling Options
		$dt_twitter_display_fontsize=get_option('dt_twitter_display_fontsize');
		$dt_twitter_display_fontsize_unit=get_option('dt_twitter_display_fontsize_unit');
		$dt_twitter_display_fontcolor=get_option('dt_twitter_display_fontcolor');
		$dt_twitter_display_linkcolor=get_option('dt_twitter_display_linkcolor');
		$dt_twitter_display_tweetbg=get_option('dt_twitter_display_tweetbg');
		$dt_twitter_display_tweetbg_enabled=get_option('dt_twitter_display_tweetbg_enabled');
		$dt_twitter_display_tweetbgalt=get_option('dt_twitter_display_tweetbgalt');
		$dt_twitter_display_tweetbgalt_enabled=get_option('dt_twitter_display_tweetbgalt_enabled');
		$dt_twitter_display_tweetpadding=get_option('dt_twitter_display_tweetpadding');
		$dt_twitter_display_tweetpadding_unit=get_option('dt_twitter_display_tweetpadding_unit');
		$dt_twitter_display_tweetmargintop=get_option('dt_twitter_display_tweetmargintop');
		$dt_twitter_display_tweetmargintop_unit=get_option('dt_twitter_display_tweetmargintop_unit');
		$dt_twitter_display_tweetmarginbottom=get_option('dt_twitter_display_tweetmarginbottom');
		$dt_twitter_display_tweetmarginbottom_unit=get_option('dt_twitter_display_tweetmarginbottom_unit');
		$dt_twitter_display_tweetmarginleft=get_option('dt_twitter_display_tweetmarginleft');
		$dt_twitter_display_tweetmarginleft_unit=get_option('dt_twitter_display_tweetmarginleft_unit');
		$dt_twitter_display_tweetmarginright=get_option('dt_twitter_display_tweetmarginright');
		$dt_twitter_display_tweetmarginright_unit=get_option('dt_twitter_display_tweetmarginright_unit');
		$dt_twitter_display_tweetpaddingtop=get_option('dt_twitter_display_tweetpaddingtop');
		$dt_twitter_display_tweetpaddingtop_unit=get_option('dt_twitter_display_tweetpaddingtop_unit');
		$dt_twitter_display_tweetpaddingbottom=get_option('dt_twitter_display_tweetpaddingbottom');
		$dt_twitter_display_tweetpaddingbottom_unit=get_option('dt_twitter_display_tweetpaddingbottom_unit');
		$dt_twitter_display_tweetpaddingleft=get_option('dt_twitter_display_tweetpaddingleft');
		$dt_twitter_display_tweetpaddingleft_unit=get_option('dt_twitter_display_tweetpaddingleft_unit');
		$dt_twitter_display_tweetpaddingright=get_option('dt_twitter_display_tweetpaddingright');
		$dt_twitter_display_tweetpaddingright_unit=get_option('dt_twitter_display_tweetpaddingright_unit');
		$dt_twitter_display_tweetbradius=get_option('dt_twitter_display_tweetbradius');
		$dt_twitter_display_tweetbradius_unit=get_option('dt_twitter_display_tweetbradius_unit');
		
		//Create Our Tweet CSS Style
		if ($dt_twitter_display_tweetbg_enabled==1) { $listyle='background:'.$dt_twitter_display_tweetbg.';'; } 
		if ($dt_twitter_display_tweetbgalt_enabled==1) { $lialtstyle='background:'.$dt_twitter_display_tweetbgalt.';'; } else { $lialtstyle=$listyle; }
		if ($dt_twitter_display_tweetmargintop) { if ($dt_twitter_display_tweetmargintop_unit==1) { $dtpu='px'; } else { $dtpu='%'; } $listyle.='margin-top:'.$dt_twitter_display_tweetmargintop.$dtpu.';'; $lialtstyle.='margin-top:'.$dt_twitter_display_tweetmargintop.$dtpu.';'; } 
		if ($dt_twitter_display_tweetmarginbottom) { if ($dt_twitter_display_tweetmarginbottom_unit==1) { $dtpu='px'; } else { $dtpu='%'; } $listyle.='margin-bottom:'.$dt_twitter_display_tweetmarginbottom.$dtpu.';'; $lialtstyle.='margin-bottom:'.$dt_twitter_display_tweetmarginbottom.$dtpu.';'; } 
		if ($dt_twitter_display_tweetmarginleft) { if ($dt_twitter_display_tweetmarginleft_unit==1) { $dtpu='px'; } else { $dtpu='%'; } $listyle.='margin-left:'.$dt_twitter_display_tweetmarginleft.$dtpu.';'; $lialtstyle.='margin-left:'.$dt_twitter_display_tweetmarginleft.$dtpu.';'; } 
		if ($dt_twitter_display_tweetmarginright) { if ($dt_twitter_display_tweetmarginright_unit==1) { $dtpu='px'; } else { $dtpu='%'; } $listyle.='margin-right:'.$dt_twitter_display_tweetmarginright.$dtpu.';'; $lialtstyle.='margin-right:'.$dt_twitter_display_tweetmarginright.$dtpu.';'; } 		
		if ($dt_twitter_display_tweetpaddingtop) { if ($dt_twitter_display_tweetpaddingtop_unit==1) { $dtpu='px'; } else { $dtpu='%'; } $listyle.='padding-top:'.$dt_twitter_display_tweetpaddingtop.$dtpu.';'; $lialtstyle.='padding-top:'.$dt_twitter_display_tweetpaddingtop.$dtpu.';'; } 
		if ($dt_twitter_display_tweetpaddingbottom) { if ($dt_twitter_display_tweetpaddingbottom_unit==1) { $dtpu='px'; } else { $dtpu='%'; } $listyle.='padding-bottom:'.$dt_twitter_display_tweetpaddingbottom.$dtpu.';'; $lialtstyle.='padding-bottom:'.$dt_twitter_display_tweetpaddingbottom.$dtpu.';'; } 
		if ($dt_twitter_display_tweetpaddingleft) { if ($dt_twitter_display_tweetpaddingleft_unit==1) { $dtpu='px'; } else { $dtpu='%'; } $listyle.='padding-left:'.$dt_twitter_display_tweetpaddingleft.$dtpu.';'; $lialtstyle.='padding-left:'.$dt_twitter_display_tweetpaddingleft.$dtpu.';'; } 
		if ($dt_twitter_display_tweetpaddingright) { if ($dt_twitter_display_tweetpaddingright_unit==1) { $dtpu='px'; } else { $dtpu='%'; } $listyle.='padding-right:'.$dt_twitter_display_tweetpaddingright.$dtpu.';'; $lialtstyle.='padding-right:'.$dt_twitter_display_tweetpaddingright.$dtpu.';'; } 
		if ($dt_twitter_display_tweetbradius) { if ($dt_twitter_display_tweetbradius_unit==1) { $dtpu='px'; } else { $dtpu='%'; } $listyle.='-moz-border-radius:'.$dt_twitter_display_tweetbradius.$dtpu.';-webkit-border-radius:'.$dt_twitter_display_tweetbradius.$dtpu.';-khtml-border-radius:'.$dt_twitter_display_tweetbradius.$dtpu.';border-radius:'.$dt_twitter_display_tweetbradius.$dtpu.';'; $lialtstyle.='-moz-border-radius:'.$dt_twitter_display_tweetbradius.$dtpu.';-webkit-border-radius:'.$dt_twitter_display_tweetbradius.$dtpu.';-khtml-border-radius:'.$dt_twitter_display_tweetbradius.$dtpu.';border-radius:'.$dt_twitter_display_tweetbradius.$dtpu.';'; } 

	//End If Automatic Styling Set To Yes
	}

	//Loop Through Tweets If We Have Them
	foreach($tweety as $i => $item) {
	
		//Get Vars
		$req_tweetid=$item->tweetid;
		$req_tweet=$item->tweet;
		$req_screenname=$item->screenname;
		$req_profileimage=$item->profileimage;
		$req_fullname=$item->fullname;
		$req_readdate=$item->tweetreaddate;
				
		//Add 1 To Oddity Counter
		$oddity++;
		
		//Add 1 To Main Counter
		$count++;
		
		//Define List Styles
		$list_style='';
		$list_style_alt='';
		
		//Create List Styles If Necessary
		if($listyle) { $list_style=' style="'.$listyle.'"'; }
		if($lialtstyle) { $list_style_alt=' style="'.$lialtstyle.'"'; }
						
		//Echo List Starter
		if ($count==1) {
			$twitteroutput.='<li class="first"'.$list_style.'>';
		} elseif ($count==$size && $oddity==2) {
			$twitteroutput.='<li class="last_even"'.$list_style_alt.'>';
		} elseif ($count==$size) {
			$twitteroutput.='<li'.$list_style.'>';
		} elseif ($oddity==2) {
			$twitteroutput.='<li class="post_even"'.$list_style_alt.'>';
		} else {
			$twitteroutput.='<li'.$list_style.'>';
		}
		
		//If User Images Option Is Selected & We Have A User Image
		if (($twitterimages==1) && ($req_profileimage)) {
		
			//Grab Image Details
			$dt_twitter_image_size=get_option('dt_twitter_image_size');
			$dt_twitter_image_marginright=get_option('dt_twitter_image_marginright');
			$dt_twitter_image_marginright_unit=get_option('dt_twitter_image_marginright_unit');
			$dt_twitter_image_marginbottom=get_option('dt_twitter_image_marginbottom');
			$dt_twitter_image_marginbottom_unit=get_option('dt_twitter_image_marginbottom_unit');
			$dt_twitter_image_bradius=get_option('dt_twitter_image_bradius');
			$dt_twitter_image_bradius_unit=get_option('dt_twitter_image_bradius_unit');

			//If Automatic Styling Is Set To Yes
			if($dtauto==1) {
			
				//Get Our Image Margins
				$imgmarginright=$dt_twitter_image_marginright; if($dt_twitter_image_marginright_unit==1) { $imgmarginright.='px'; } else { $imgmarginright.='%'; }
				$imgmarginbottom=$dt_twitter_image_marginbottom; if($dt_twitter_image_marginbottom_unit==1) { $imgmarginbottom.='px'; } else { $imgmarginbottom.='%'; }
				
				//Get Our Image Size
				$imgsize=$dt_twitter_image_size.'px';
				
				//Get Our Image Border Radius
				$imgradius=$dt_twitter_image_bradius; if($dt_twitter_image_bradius_unit==1) { $imgradius.='px'; } else { $imgradius.='%'; }
				
				//Display User Image
				$twitteroutput.='<a target="_blank" class="dt-twitter-avatar-link" style="float:left;" href="http://twitter.com/'.$req_screenname.'"><img src="'.$req_profileimage.'" class="dt-twitter-avatar" alt="'.$req_profileimage.' avatar" title="'.$req_profileimage.' avatar" style="float:left;margin-right:'.$imgmarginright.';margin-bottom:'.$imgmarginbottom.';width:'.$imgsize.';height:'.$imgsize.';-moz-border-radius:'.$imgradius.';-webkit-border-radius:'.$imgradius.';-khtml-border-radius:'.$imgradius.';border-radius:'.$imgradius.';" /></a>';
				
			//Otherwise - Write Out Standard For Manual Styling
			} else {
			
				//Display User Image
				$twitteroutput.='<a target="_blank" class="dt-twitter-avatar-link" href="http://twitter.com/'.$req_screenname.'"><img src="'.$req_profileimage.'" class="dt-twitter-avatar" alt="'.$req_profileimage.' avatar" title="'.$req_profileimage.' avatar" /></a>';
				
			//End Automatic / Manual Styling (Images)
			}
			
		//End If We Have Image / Image Set	
		} 
		
		//Add Main Tweet Container For Manual Styling
		$req_tweet='<div class="dt-twitter-tweetbody">'.$req_tweet.'</div>';
			
		//Add Our Date If Turned On (Before)
		if($twitter_date_display==1) { $req_tweet='<div class="dt-twitter-readdate"><a target="_blank" href="http://twitter.com/'.$req_screenname.'/status/'.$req_tweetid.'">about '.$req_readdate.' ago</a></div>'.$req_tweet; }

		//Add Our Date If Turned On (After)
		if($twitter_date_display==2) { $req_tweet.='<div class="dt-twitter-readdate"><a target="_blank" href="http://twitter.com/'.$req_screenname.'/status/'.$req_tweetid.'">about '.$req_readdate.' ago</a></div>'; }
		
		//Add Our Screen Name If Turned On
		if($twitter_screenname_display==1) { $req_tweet='<div class="dt-twitter-screenname"><a target="_blank" href="http://twitter.com/'.$req_screenname.'">@'.$req_screenname.'</a></div>'.$req_tweet; }
		
		//Add Our Full Name If Turned On
		if($twitter_fullname_display==1) { $req_tweet='<div class="dt-twitter-fullname"><a target="_blank" href="http://twitter.com/'.$req_screenname.'">'.$req_fullname.'</a></div>'.$req_tweet; }

		//Convert Hashtags To Links If Turned On
		if($twitter_hashtag_convert==1) { $req_tweet=preg_replace('/\#([a-z0-9]+)/i','<a href="https://twitter.com/search?q=%23$1&src=hash" target="_blank">#$1</a>',$req_tweet); }

		//Convert Usernames To Links If Turned On
		if($twitter_username_convert==1) { $req_tweet=preg_replace('/\@([A-Za-z0-9_]+)/i','<a href="https://twitter.com/$1" target="_blank">@$1</a>',$req_tweet); }
		
		//If Automatic Styling Is Set To Yes
		if($dtauto==1) {
	
			//Get Our Font Styling
			$fontstyle=''; $fontsize=$dt_twitter_display_fontsize; if($dt_twitter_display_fontsize_unit==1) { $fontstyle=' style="font-size:'.$fontsize.'px;line-height:'.$fontsize.'px;'; if($dt_twitter_display_fontcolor) { $fontstyle.='color:'.$dt_twitter_display_fontcolor.';'; } $fontstyle.='"'; } else { $fontstyle=' style="font-size:'.$fontsize.'em;line-height:auto;'; if($dt_twitter_display_fontcolor) { $fontstyle.='color:'.$dt_twitter_display_fontcolor.';'; } $fontstyle.='"'; }
			
			//Get Our Link Styling
			$linkstyle=''; $fontsize=$dt_twitter_display_fontsize; if($dt_twitter_display_fontsize_unit==1) { $linkstyle='style="font-size:'.$fontsize.'px;line-height:'.$fontsize.'px;'; if($dt_twitter_display_linkcolor) { $linkstyle.='color:'.$dt_twitter_display_linkcolor.';'; } $linkstyle.='"'; } else { $linkstyle='style="font-size:'.$fontsize.'em;line-height:auto;'; if($dt_twitter_display_linkcolor) { $linkstyle.='color:'.$dt_twitter_display_linkcolor.';'; } $linkstyle.='"'; }
			
			//If We Have Tweet Link Color Set
			if ($dt_twitter_display_linkcolor) { $req_tweet=str_replace('<a','<a style="color:'.$dt_twitter_display_linkcolor.';"',$req_tweet); }

			//If We Have A Global Padding Value - Add It To Bottom Of Tweet
			if ($dt_twitter_display_mcpadding) { $globalpadding=$dt_twitter_display_mcpadding.'px'; } else { $globalpadding='0px'; }
			
			//Write Out Tweet
			$twitteroutput.='<span'.$fontstyle.'>'.$req_tweet.'</span><div style="clear:both;margin-bottom:'.$globalpadding.';"></div>';

			//If We Have Any Post Options
			if (($twitterpexpand==1) || ($twitterpreply==1) || ($twitterpretweet==1) || ($twitterpfavourite==1)) {
				
				//Start Container
				$twitteroutput.='<div class="dt-twitter-end-container">';
				
				if ($twitterpreply==1) { $twitteroutput.='<a '.$linkstyle.' href="http://twitter.com/intent/tweet?related='.$screenname.'&in_reply_to='.$req_tweetid.'" class="dt-twitter-button-reply" rel="external" target="_blank">Reply</a>&nbsp;'; }
				if ($twitterpretweet==1) { $twitteroutput.='<a '.$linkstyle.' href="http://twitter.com/intent/retweet?related='.$screenname.'&tweet_id='.$req_tweetid.'" class="dt-twitter-button-retweet" rel="external" target="_blank">Retweet</a>&nbsp;'; }
				if ($twitterpfavourite==1) { $twitteroutput.='<a '.$linkstyle.' href="http://twitter.com/intent/favorite?related='.$screenname.'&tweet_id='.$req_tweetid.'" class="dt-twitter-button-favourite" rel="external" target="_blank">Favourite</a>&nbsp;'; }
				if ($twitterpexpand==1) { $twitteroutput.='<a '.$linkstyle.' href="http://twitter.com/'.$screenname.'/status/'.$req_tweetid.'" class="dt-twitter-button-expand" rel="external" target="_blank">Expand</a>&nbsp;'; }

				//Close Container
				$twitteroutput.='</div>';
				
			//Otherwise, If We Have Icons To Be Displayed	
			} elseif (($twitterpexpand==2) || ($twitterpreply==2) || ($twitterpretweet==2) || ($twitterpfavourite==2)) {
								
				//Create Our Icon Style
				$iconstyle='style="float:left;"';		
								
				//Start Container
				$twitteroutput.='<div class="dt-twitter-end-container">';
				
				if ($twitterpreply==2) { $twitteroutput.='<a href="http://twitter.com/intent/tweet?related='.$screenname.'&in_reply_to='.$req_tweetid.'" class="dt-twitter-button-reply" rel="external" target="_blank"><div class="dt-twitter-icon-reply"></div></a>&nbsp;'; }
				if ($twitterpretweet==2) { $twitteroutput.='<a href="http://twitter.com/intent/retweet?related='.$screenname.'&tweet_id='.$req_tweetid.'" class="dt-twitter-button-retweet" rel="external" target="_blank"><div class="dt-twitter-icon-retweet"></div></a>&nbsp;'; }
				if ($twitterpfavourite==2) { $twitteroutput.='<a href="http://twitter.com/intent/favorite?related='.$screenname.'&tweet_id='.$req_tweetid.'" class="dt-twitter-button-favourite" rel="external" target="_blank"><div class="dt-twitter-icon-favourite"></div></a>&nbsp;'; }
				if ($twitterpexpand==2) { $twitteroutput.='<a href="http://twitter.com/'.$screenname.'/status/'.$req_tweetid.'" class="dt-twitter-button-expand" rel="external" target="_blank"><div class="dt-twitter-icon-expand"></div></a>&nbsp;'; }
	
				//Clear Floats
				$twitteroutput.='<div style="clear:both;"></div>';
	
				//Close Container
				$twitteroutput.='</div>';
				
			//End If We Have Any Post Options
			}


		//Otherwise - Write Standard Tweet For Manual Styling
		} else {
			
			//Write Out Tweet
			$twitteroutput.='<span class="dt-twitter-tweet">'.$req_tweet.'</span>';

			//If We Have Any Post Options
			if (($twitterpexpand==1) || ($twitterpreply==1) || ($twitterpretweet==1) || ($twitterpfavourite==1)) {
				
				//Start Container
				$twitteroutput.='<div class="dt-twitter-end-container">';
				
				if ($twitterpreply==1) { $twitteroutput.='<a href="http://twitter.com/intent/tweet?related='.$screenname.'&in_reply_to='.$req_tweetid.'" class="dt-twitter-button-reply" rel="external" target="_blank">Reply</a>'; }
				if ($twitterpretweet==1) { $twitteroutput.='<a href="http://twitter.com/intent/retweet?related='.$screenname.'&tweet_id='.$req_tweetid.'" class="dt-twitter-button-retweet" rel="external" target="_blank">Retweet</a>'; }
				if ($twitterpfavourite==1) { $twitteroutput.='<a href="http://twitter.com/intent/favorite?related='.$screenname.'&tweet_id='.$req_tweetid.'" class="dt-twitter-button-favourite" rel="external" target="_blank">Favourite</a>'; }
				if ($twitterpexpand==1) { $twitteroutput.='<a href="http://twitter.com/'.$screenname.'/status/'.$req_tweetid.'" class="dt-twitter-button-expand" rel="external" target="_blank">Expand</a>'; }
					
				//Close Container
				$twitteroutput.='</div>';
				
			//Otherwise, If We Have Icons To Be Displayed	
			} elseif (($twitterpexpand==2) || ($twitterpreply==2) || ($twitterpretweet==2) || ($twitterpfavourite==2)) {
														
				//Start Container
				$twitteroutput.='<div class="dt-twitter-end-container">';
				
				if ($twitterpreply==2) { $twitteroutput.='<a href="http://twitter.com/intent/tweet?related='.$screenname.'&in_reply_to='.$req_tweetid.'" class="dt-twitter-button-reply" rel="external" target="_blank"><div class="dt-twitter-icon-reply"></div></a>&nbsp;'; }
				if ($twitterpretweet==2) { $twitteroutput.='<a href="http://twitter.com/intent/retweet?related='.$screenname.'&tweet_id='.$req_tweetid.'" class="dt-twitter-button-retweet" rel="external" target="_blank"><div class="dt-twitter-icon-retweet"></div></a>&nbsp;'; }
				if ($twitterpfavourite==2) { $twitteroutput.='<a href="http://twitter.com/intent/favorite?related='.$screenname.'&tweet_id='.$req_tweetid.'" class="dt-twitter-button-favourite" rel="external" target="_blank"><div class="dt-twitter-icon-favourite"></div></a>&nbsp;'; }
				if ($twitterpexpand==2) { $twitteroutput.='<a href="http://twitter.com/'.$screenname.'/status/'.$req_tweetid.'" class="dt-twitter-button-expand" rel="external" target="_blank"><div class="dt-twitter-icon-expand"></div></a>&nbsp;'; }
	
				//Clear Floats
				$twitteroutput.='<div style="clear:both;"></div>';
	
				//Close Container
				$twitteroutput.='</div>';
				
			//End If We Have Any Post Options
			}

		//End If Automatic Styling Is Set To Yes
		}
		
		//Close List Element
		 $twitteroutput.="</li>";
		
		//Reset Oddity Counter If We Are On 1
		if ($oddity==2) { $oddity=0; }
		
	}
	
	//Close Unordered List
	$twitteroutput.="</ul>";
	
	//If We Have A Follow Text Option
	if ($twitterfollow==1) { $twitteroutput.='<div class="dt-twitter-p-container"><a href="http://twitter.com/'.$screenname.'" class="dt-twitter-button" rel="nofollow">Follow @'.$screenname.'</a></div>'; } 
	
	//If We Have A Follow Button Option
	if ($twitterfollow==2) { $twitteroutput.='<a href="https://twitter.com/'.$screenname.'" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false" data-dnt="true">Follow</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>'; }
	
	//If We Have A Follow Button Option With Screename
	if ($twitterfollow==3) { $twitteroutput.='<a href="https://twitter.com/'.$screenname.'" class="twitter-follow-button" data-show-count="false" data-show-screen-name="true" data-dnt="true">Follow &#64;'.$screenname.'</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>'; }
	
	//Return The Output
	return $twitteroutput;
	
	//Exit Function
	exit();
		
//End Display Function	
}


/////////////////////////////////////////////////////////////
///// Digicution Simple Twitter Feed Convert URLs (New) /////
/////////////////////////////////////////////////////////////

function dt_convert_urls($text) {
    $text= preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" target=\"_blank\">$3</a>", $text);  
    $text= preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" target=\"_blank\">$3</a>", $text);  
    $text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\" target=\"_blank\">$2@$3</a>", $text);  
    return($text);  
} 


/////////////////////////////////////////////////////////////
/////   Digicution Simple Twitter Feed Icon CSS (New)   /////
/////////////////////////////////////////////////////////////

function dt_twitter_icon_css() {
	 	 
	//Get Twitter Icon Options
	$dt_twitter_icon_fontsize=get_option('dt_twitter_icon_fontsize');
	if(get_option('dt_twitter_icon_fontsize_unit')==1) { $dt_twitter_icon_fontsize_unit='px'; } else { $dt_twitter_icon_fontsize_unit='em'; }
	$dt_twitter_icon_fontcolor=get_option('dt_twitter_icon_fontcolor');
	$dt_twitter_icon_fontcolor_hover=get_option('dt_twitter_icon_fontcolor_hover');
	$dt_twitter_icon_margintop=get_option('dt_twitter_icon_margintop');	
	if(get_option('dt_twitter_icon_margintop_unit')==1) { $dt_twitter_icon_margintop_unit='px'; } else { $dt_twitter_icon_margintop_unit='%'; }
	$dt_twitter_icon_spacing=get_option('dt_twitter_icon_spacing');	
	if(get_option('dt_twitter_icon_spacing_unit')==1) { $dt_twitter_icon_spacing_unit='px'; } else { $dt_twitter_icon_spacing_unit='%'; }
	
	//Compile Icon CSS
	$twitteroutput.='
	<style type="text/css" media="screen">
	
		a.dt-twitter-button-reply div.dt-twitter-icon-reply,
		a.dt-twitter-button-retweet div.dt-twitter-icon-retweet,
		a.dt-twitter-button-favourite div.dt-twitter-icon-favourite,
		a.dt-twitter-button-expand div.dt-twitter-icon-expand
		{ float:left; text-decoration:none; font-size:'.$dt_twitter_icon_fontsize.$dt_twitter_icon_fontsize_unit.'; color:'.$dt_twitter_icon_fontcolor.'; margin-top:'.$dt_twitter_icon_margintop.$dt_twitter_icon_margintop_unit.'; margin-right:'.$dt_twitter_icon_spacing.$dt_twitter_icon_spacing_unit.'; }
		
		a.dt-twitter-button-reply div.dt-twitter-icon-reply:hover,
		a.dt-twitter-button-retweet div.dt-twitter-icon-retweet:hover,
		a.dt-twitter-button-favourite div.dt-twitter-icon-favourite:hover,
		a.dt-twitter-button-expand div.dt-twitter-icon-expand:hover
		{ color:'.$dt_twitter_icon_fontcolor_hover.'; }
		
	</style>
	';
	
	//Write CSS Out
	echo $twitteroutput;
	
//End Icon CSS Function	
} 

//Grab After Tweet Setttings	
$twitterpexpand=get_option('dt_twitter_post_expand');	
$twitterpreply=get_option('dt_twitter_post_reply');	
$twitterpretweet=get_option('dt_twitter_post_retweet');	
$twitterpfavourite=get_option('dt_twitter_post_favourite');

//If We Have Any Icons Selected
if (($twitterpexpand==2) || ($twitterpreply==2) || ($twitterpretweet==2) || ($twitterpfavourite==2)) {

	//Add Our Twitter Icon CSS To Wordpress Header		
	add_action('wp_head','dt_twitter_icon_css');	

//End If We Have Any Icons Selected	
}						
?>