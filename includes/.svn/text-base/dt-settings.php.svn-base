<?php
////////////////////////////////////////////////////////
///// Digicution Simple Twitter Feed Settings Page /////
////////////////////////////////////////////////////////

function dt_admin() {

	///////////////////////////////////
	////// Define Main Variables //////
	///////////////////////////////////

	//Define Wordpress Conn As Global
	global $wpdb;
	
	//Define Tables
	$table_dt_twitter=$wpdb->prefix."dt_twitter";
		
	////////////////////////////////////////
	/////  Application Settings Code  //////
	////////////////////////////////////////
		
	//If General Settings Form Submitted
	if ($_POST['option']=='applicationupdate') {
	
		//Set Tab So We Load Correct Page
		$tab="application";
				
		//Grab Form Values
		$dt_twitter_oauth_access_token=dtCrypt('e',$_POST['dt_twitter_oauth_access_token']);
		$dt_twitter_oauth_access_token_secret=dtCrypt('e',$_POST['dt_twitter_oauth_access_token_secret']);
		$dt_twitter_consumer_key=dtCrypt('e',$_POST['dt_twitter_consumer_key']);
		$dt_twitter_consumer_secret=dtCrypt('e',$_POST['dt_twitter_consumer_secret']);
			
		//Clear General Message Session
		$_SESSION['application_message']='';
		
		//Set Update Flag Variable
		$dt_twitter_update=0;
		
		//Update Consumer Key Or Add Error Message
		if (!$dt_twitter_consumer_key) { $_SESSION['application_message'].="Please Enter The Twitter Application API Key<br/>"; } else { if(dtCrypt('d',get_option('dt_twitter_consumer_key'))!=$dt_twitter_consumer_key) { $dt_twitter_update=1; } update_option('dt_twitter_consumer_key',$dt_twitter_consumer_key); }

		//Update Consumer Secret Or Add Error Message
		if (!$dt_twitter_consumer_secret) { $_SESSION['application_message'].="Please Enter The Twitter Application API Secret<br/>"; } else {	if(dtCrypt('d',get_option('dt_twitter_consumer_secret'))!=$dt_twitter_consumer_secret) { $dt_twitter_update=1; } update_option('dt_twitter_consumer_secret',$dt_twitter_consumer_secret); }
		
		//Update Access Token Or Add Error Message
		if (!$dt_twitter_oauth_access_token) { $_SESSION['application_message'].="Please Enter The Twitter Application Access Token<br/>"; } else {	if(dtCrypt('d',get_option('dt_twitter_oauth_access_token'))!=$dt_twitter_oauth_access_token) { $dt_twitter_update=1; } update_option('dt_twitter_oauth_access_token',$dt_twitter_oauth_access_token); }
		
		//Update Access Token Secret Or Add Error Message
		if (!$dt_twitter_oauth_access_token_secret) { $_SESSION['application_message'].="Please Enter The Twitter Application Access Token Secret<br/>"; } else { if(dtCrypt('d',get_option('dt_twitter_oauth_access_token_secret'))!=$dt_twitter_oauth_access_token_secret) { $dt_twitter_update=1; } update_option('dt_twitter_oauth_access_token_secret',$dt_twitter_oauth_access_token_secret); }

		//If No Errors
		if(!$_SESSION['application_message']) { $_SESSION['application_success']="The Options Were Successfully Updated"; }
		
		//If Update Flag Set - Update Database
		if ($dt_twitter_update==1) { dt_twitter_update(); }
	
	//End General Settings Function	
	}

	///////////////////////////////////
	///// General Settings Code  //////
	///////////////////////////////////
		
	//If General Settings Form Submitted
	if ($_POST['option']=='generalupdate') {
	
		//Set Tab So We Load Correct Page
		$tab="general";
				
		//Grab Form Values
		$dt_twitter_screenname=$_POST['dt_twitter_screenname'];
		$dt_twitter_tweetsize=$_POST['dt_twitter_tweetsize'];
		$dt_twitter_twitterupdate=$_POST['dt_twitter_twitterupdate'];
		$dt_twitter_images=$_POST['dt_twitter_images'];
		$dt_twitter_retweet=$_POST['dt_twitter_retweet'];
		$dt_twitter_follow=$_POST['dt_twitter_follow'];
		$dt_twitter_hashtag_convert=$_POST['dt_twitter_hashtag_convert'];
		$dt_twitter_username_convert=$_POST['dt_twitter_username_convert'];
		$dt_twitter_post_expand=$_POST['dt_twitter_post_expand'];	
		$dt_twitter_post_reply=$_POST['dt_twitter_post_reply'];
		$dt_twitter_post_retweet=$_POST['dt_twitter_post_retweet'];
		$dt_twitter_post_favourite=$_POST['dt_twitter_post_favourite'];
		$dt_twitter_screenname_display=$_POST['dt_twitter_screenname_display'];
		$dt_twitter_fullname_display=$_POST['dt_twitter_fullname_display'];
		$dt_twitter_readdate_display=$_POST['dt_twitter_readdate_display'];
		$dt_twitter_header_display=$_POST['dt_twitter_header_display'];
		$dt_twitter_header_title=$_POST['dt_twitter_header_title'];
		$dt_twitter_header_follow=$_POST['dt_twitter_header_follow'];
		
		//Clear General Message Session
		$_SESSION['general_message']='';
		
		//Set Update Flag Variable
		$dt_twitter_update=0;
		
		//Update Screen Name Or Add Error Message
		if (!$dt_twitter_screenname) { $_SESSION['general_message'].="Please Enter The Twitter Username<br/>"; } else {	if(get_option('dt_twitter_screenname')!=$dt_twitter_screenname) { $dt_twitter_update=1; } update_option('dt_twitter_screenname',$dt_twitter_screenname); }
		
		//Update Tweet Size Or Add Error Message
		if (!$dt_twitter_tweetsize) { $_SESSION['general_message'].="Please Enter The Number Of Tweets To Display<br/>"; } elseif (!is_numeric($dt_twitter_tweetsize)) { $_SESSION['general_message'].="Please Enter A Numeric Value For Number Of Tweets To Display<br/>"; } else { if(get_option('dt_twitter_tweetsize')!=$dt_twitter_tweetsize) { $dt_twitter_update=1; } update_option('dt_twitter_tweetsize',$dt_twitter_tweetsize); }
				
		//Update Retweet Option
		if(get_option('dt_twitter_retweet')!=$dt_twitter_retweet) { $dt_twitter_update=1; } update_option('dt_twitter_retweet',$dt_twitter_retweet);
		 		
		//Update Select Options
		update_option('dt_twitter_twitterupdate',$dt_twitter_twitterupdate);
		update_option('dt_twitter_images',$dt_twitter_images);
		update_option('dt_twitter_follow',$dt_twitter_follow);
		update_option('dt_twitter_post_expand',$dt_twitter_post_expand);	
		update_option('dt_twitter_post_reply',$dt_twitter_post_reply);	
		update_option('dt_twitter_post_retweet',$dt_twitter_post_retweet);	
		update_option('dt_twitter_post_favourite',$dt_twitter_post_favourite);	
		update_option('dt_twitter_screenname_display',$dt_twitter_screenname_display);	
		update_option('dt_twitter_fullname_display',$dt_twitter_fullname_display);	
		update_option('dt_twitter_readdate_display',$dt_twitter_readdate_display);	
		update_option('dt_twitter_header_display',$dt_twitter_header_display);	
		update_option('dt_twitter_header_title',$dt_twitter_header_title);	
		update_option('dt_twitter_header_follow',$dt_twitter_header_follow);
		update_option('dt_twitter_hashtag_convert',$dt_twitter_hashtag_convert);
		update_option('dt_twitter_username_convert',$dt_twitter_username_convert);	
		
		//If No Errors
		if(!$_SESSION['general_message']) { $_SESSION['general_success']="The Options Were Successfully Updated"; }
		
		//If Update Flag Set - Update Database
		if ($dt_twitter_update==1) { dt_twitter_update(); }
	
	//End General Settings Function	
	}
	
	///////////////////////////////////
	///// Display Settings Code  //////
	///////////////////////////////////
		
	//If Display Settings Form Submitted
	if ($_POST['option']=='displayupdate') {
	
		//Set Tab So We Load Correct Page
		$tab="display";
				
		//Grab Form Values
		$dt_twitter_display_auto=$_POST['dt_twitter_display_auto'];
		$dt_twitter_display_mcwidth=$_POST['dt_twitter_display_mcwidth'];
		$dt_twitter_display_mcwidth_unit=$_POST['dt_twitter_display_mcwidth_unit'];
		$dt_twitter_display_mcbg=$_POST['dt_twitter_display_mcbg'];
		$dt_twitter_display_mcbg_enabled=$_POST['dt_twitter_display_mcbg_enabled'];
		$dt_twitter_display_mcpaddingtop=$_POST['dt_twitter_display_mcpaddingtop'];
		$dt_twitter_display_mcpaddingtop_unit=$_POST['dt_twitter_display_mcpaddingtop_unit'];
		$dt_twitter_display_mcpaddingbottom=$_POST['dt_twitter_display_mcpaddingbottom'];
		$dt_twitter_display_mcpaddingbottom_unit=$_POST['dt_twitter_display_mcpaddingbottom_unit'];
		$dt_twitter_display_mcpaddingleft=$_POST['dt_twitter_display_mcpaddingleft'];
		$dt_twitter_display_mcpaddingleft_unit=$_POST['dt_twitter_display_mcpaddingleft_unit'];
		$dt_twitter_display_mcpaddingright=$_POST['dt_twitter_display_mcpaddingright'];
		$dt_twitter_display_mcpaddingright_unit=$_POST['dt_twitter_display_mcpaddingright_unit'];
		$dt_twitter_display_mcmargintop=$_POST['dt_twitter_display_mcmargintop'];
		$dt_twitter_display_mcmargintop_unit=$_POST['dt_twitter_display_mcmargintop_unit'];
		$dt_twitter_display_mcmarginbottom=$_POST['dt_twitter_display_mcmarginbottom'];
		$dt_twitter_display_mcmarginbottom_unit=$_POST['dt_twitter_display_mcmarginbottom_unit'];
		$dt_twitter_display_mcmarginleft=$_POST['dt_twitter_display_mcmarginleft'];
		$dt_twitter_display_mcmarginleft_unit=$_POST['dt_twitter_display_mcmarginleft_unit'];
		$dt_twitter_display_mcmarginright=$_POST['dt_twitter_display_mcmarginright'];
		$dt_twitter_display_mcmarginright_unit=$_POST['dt_twitter_display_mcmarginright_unit'];
		$dt_twitter_display_mcbradius=$_POST['dt_twitter_display_mcbradius'];
		$dt_twitter_display_mcbradius_unit=$_POST['dt_twitter_display_mcbradius_unit'];
		$dt_twitter_display_fontsize=$_POST['dt_twitter_display_fontsize'];
		$dt_twitter_display_fontsize_unit=$_POST['dt_twitter_display_fontsize_unit'];
		$dt_twitter_display_fontcolor=$_POST['dt_twitter_display_fontcolor'];
		$dt_twitter_display_linkcolor=$_POST['dt_twitter_display_linkcolor'];
		$dt_twitter_display_tweetbg=$_POST['dt_twitter_display_tweetbg'];
		$dt_twitter_display_tweetbg_enabled=$_POST['dt_twitter_display_tweetbg_enabled'];
		$dt_twitter_display_tweetbgalt=$_POST['dt_twitter_display_tweetbgalt'];
		$dt_twitter_display_tweetbgalt_enabled=$_POST['dt_twitter_display_tweetbgalt_enabled'];
		$dt_twitter_display_tweetmargintop=$_POST['dt_twitter_display_tweetmargintop'];
		$dt_twitter_display_tweetmargintop_unit=$_POST['dt_twitter_display_tweetmargintop_unit'];
		$dt_twitter_display_tweetmarginbottom=$_POST['dt_twitter_display_tweetmarginbottom'];
		$dt_twitter_display_tweetmarginbottom_unit=$_POST['dt_twitter_display_tweetmarginbottom_unit'];
		$dt_twitter_display_tweetmarginleft=$_POST['dt_twitter_display_tweetmarginleft'];
		$dt_twitter_display_tweetmarginleft_unit=$_POST['dt_twitter_display_tweetmarginleft_unit'];
		$dt_twitter_display_tweetmarginright=$_POST['dt_twitter_display_tweetmarginright'];
		$dt_twitter_display_tweetmarginright_unit=$_POST['dt_twitter_display_tweetmarginright_unit'];
		$dt_twitter_display_tweetpaddingtop=$_POST['dt_twitter_display_tweetpaddingtop'];
		$dt_twitter_display_tweetpaddingtop_unit=$_POST['dt_twitter_display_tweetpaddingtop_unit'];
		$dt_twitter_display_tweetpaddingbottom=$_POST['dt_twitter_display_tweetpaddingbottom'];
		$dt_twitter_display_tweetpaddingbottom_unit=$_POST['dt_twitter_display_tweetpaddingbottom_unit'];
		$dt_twitter_display_tweetpaddingleft=$_POST['dt_twitter_display_tweetpaddingleft'];
		$dt_twitter_display_tweetpaddingleft_unit=$_POST['dt_twitter_display_tweetpaddingleft_unit'];
		$dt_twitter_display_tweetpaddingright=$_POST['dt_twitter_display_tweetpaddingright'];
		$dt_twitter_display_tweetpaddingright_unit=$_POST['dt_twitter_display_tweetpaddingright_unit'];
		$dt_twitter_display_tweetbradius=$_POST['dt_twitter_display_tweetbradius'];
		$dt_twitter_display_tweetbradius_unit=$_POST['dt_twitter_display_tweetbradius_unit'];
		$dt_twitter_image_size=$_POST['dt_twitter_image_size'];
		$dt_twitter_image_bradius=$_POST['dt_twitter_image_bradius'];
		$dt_twitter_image_bradius_unit=$_POST['dt_twitter_image_bradius_unit'];
		$dt_twitter_image_marginright=$_POST['dt_twitter_image_marginright'];
		$dt_twitter_image_marginright_unit=$_POST['dt_twitter_image_marginright_unit'];
		$dt_twitter_image_marginbottom=$_POST['dt_twitter_image_marginbottom'];
		$dt_twitter_image_marginbottom_unit=$_POST['dt_twitter_image_marginbottom_unit'];
		$dt_twitter_icon_fontsize=$_POST['dt_twitter_icon_fontsize'];
		$dt_twitter_icon_fontsize_unit=$_POST['dt_twitter_icon_fontsize_unit'];
		$dt_twitter_icon_fontcolor=$_POST['dt_twitter_icon_fontcolor'];
		$dt_twitter_icon_fontcolor_hover=$_POST['dt_twitter_icon_fontcolor_hover'];
		$dt_twitter_icon_margintop=$_POST['dt_twitter_icon_margintop'];		
		$dt_twitter_icon_margintop_unit=$_POST['dt_twitter_icon_margintop_unit'];	
		$dt_twitter_icon_spacing=$_POST['dt_twitter_icon_spacing'];	
		$dt_twitter_icon_spacing_unit=$_POST['dt_twitter_icon_spacing_unit'];	
				
		//Clear General Message Session
		$_SESSION['display_message']='';
		
		//Update Main Container Width Or Add Error Message
		if(!$dt_twitter_display_mcwidth) { $_SESSION['display_message'].="Please Enter The Width Of The Main Container<br/>"; } elseif (!is_numeric($dt_twitter_display_mcwidth)) { $_SESSION['display_message'].="Please Enter A Numeric Value For Main Container Width<br/>"; } else { update_option('dt_twitter_display_mcwidth',$dt_twitter_display_mcwidth); }
		
		//Update Main Container Width Or Add Error Message
		if(!$dt_twitter_display_fontsize) { $_SESSION['display_message'].="Please Enter The Tweet Font Size<br/>"; } elseif (!is_numeric($dt_twitter_display_fontsize)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Tweet Font Size<br/>"; } else { update_option('dt_twitter_display_fontsize',$dt_twitter_display_fontsize); }
		
		//If Margin & Padding Values Are Empty - Set Them To Zero
		if(!$dt_twitter_display_mcpaddingtop) { $dt_twitter_display_mcpaddingtop=0; }
		if(!$dt_twitter_display_mcpaddingbottom) { $dt_twitter_display_mcpaddingbottom=0; }
		if(!$dt_twitter_display_mcpaddingleft) { $dt_twitter_display_mcpaddingleft=0; }
		if(!$dt_twitter_display_mcpaddingright) { $dt_twitter_display_mcpaddingright=0; }
		if(!$dt_twitter_display_mcmargintop) { $dt_twitter_display_mcmargintop=0; }
		if(!$dt_twitter_display_mcmarginbottom) { $dt_twitter_display_mcmarginbottom=0; }
		if(!$dt_twitter_display_mcmarginleft) { $dt_twitter_display_mcmarginleft=0; }
		if(!$dt_twitter_display_mcmarginright) { $dt_twitter_display_mcmarginright=0; }
		if(!$dt_twitter_display_tweetmargintop) { $dt_twitter_display_tweetmargintop=0; }
		if(!$dt_twitter_display_tweetmarginbottom) { $dt_twitter_display_tweetmarginbottom=0; }
		if(!$dt_twitter_display_tweetmarginleft) { $dt_twitter_display_tweetmarginleft=0; }
		if(!$dt_twitter_display_tweetmarginright) { $dt_twitter_display_tweetmarginright=0; }
		if(!$dt_twitter_display_tweetpaddingtop) { $dt_twitter_display_tweetpaddingtop=0; }
		if(!$dt_twitter_display_tweetpaddingbottom) { $dt_twitter_display_tweetpaddingbottom=0; }
		if(!$dt_twitter_display_tweetpaddingleft) { $dt_twitter_display_tweetpaddingleft=0; }
		if(!$dt_twitter_display_tweetpaddingright) { $dt_twitter_display_tweetpaddingright=0; }
		if(!$dt_twitter_image_marginright) { $dt_twitter_image_marginright=0; }
		if(!$dt_twitter_image_marginbottom) { $dt_twitter_image_marginbottom=0; }
		if(!$dt_twitter_image_bradius) { $dt_twitter_image_bradius=0; }
		if(!$dt_twitter_display_mcbradius) { $dt_twitter_display_mcbradius=0; }
		if(!$dt_twitter_display_tweetbradius) { $dt_twitter_display_tweetbradius=0; }
		if(!$dt_twitter_icon_margintop) { $dt_twitter_icon_margintop=0; }
		if(!$dt_twitter_icon_spacing) { $dt_twitter_icon_spacing=0; }

		//Check Padding / Margin Values Are Numeric - If So, Update Option Or Add Error Message
		if (!is_numeric($dt_twitter_display_mcpaddingtop)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Main Container Top Padding<br/>"; } else { update_option('dt_twitter_display_mcpaddingtop',$dt_twitter_display_mcpaddingtop); }
		if (!is_numeric($dt_twitter_display_mcpaddingbottom)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Main Container Bottom Padding<br/>"; } else { update_option('dt_twitter_display_mcpaddingbottom',$dt_twitter_display_mcpaddingbottom); }
		if (!is_numeric($dt_twitter_display_mcpaddingleft)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Main Container Left Padding<br/>"; } else { update_option('dt_twitter_display_mcpaddingleft',$dt_twitter_display_mcpaddingleft); }
		if (!is_numeric($dt_twitter_display_mcpaddingright)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Main Container Right Padding<br/>"; } else { update_option('dt_twitter_display_mcpaddingright',$dt_twitter_display_mcpaddingright); }
		if (!is_numeric($dt_twitter_display_mcmargintop)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Top Main Container Margin<br/>"; } else { update_option('dt_twitter_display_mcmargintop',$dt_twitter_display_mcmargintop); }
		if (!is_numeric($dt_twitter_display_mcmarginbottom)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Bottom Main Container Margin<br/>"; } else { update_option('dt_twitter_display_mcmarginbottom',$dt_twitter_display_mcmarginbottom); }
		if (!is_numeric($dt_twitter_display_mcmarginleft)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Left Main Container Margin<br/>"; } else { update_option('dt_twitter_display_mcmarginleft',$dt_twitter_display_mcmarginleft); }
		if (!is_numeric($dt_twitter_display_mcmarginright)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Right Main Container Margin<br/>"; } else { update_option('dt_twitter_display_mcmarginright',$dt_twitter_display_mcmarginright); }
		if (!is_numeric($dt_twitter_display_mcbradius)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Main Container Corner Radius<br/>"; } else { update_option('dt_twitter_display_mcbradius',$dt_twitter_display_mcbradius); }
		if (!is_numeric($dt_twitter_display_tweetmargintop)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Top Tweet Margin<br/>"; } else { update_option('dt_twitter_display_tweetmargintop',$dt_twitter_display_tweetmargintop); }
		if (!is_numeric($dt_twitter_display_tweetmarginbottom)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Bottom Tweet Margin<br/>"; } else { update_option('dt_twitter_display_tweetmarginbottom',$dt_twitter_display_tweetmarginbottom); }
		if (!is_numeric($dt_twitter_display_tweetmarginleft)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Left Tweet Margin<br/>"; } else { update_option('dt_twitter_display_tweetmarginleft',$dt_twitter_display_tweetmarginleft); }
		if (!is_numeric($dt_twitter_display_tweetmarginright)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Right Tweet Margin<br/>"; } else { update_option('dt_twitter_display_tweetmarginright',$dt_twitter_display_tweetmarginright); }
		if (!is_numeric($dt_twitter_display_tweetpaddingtop)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Top Tweet Padding<br/>"; } else { update_option('dt_twitter_display_tweetpaddingtop',$dt_twitter_display_tweetpaddingtop); }
		if (!is_numeric($dt_twitter_display_tweetpaddingbottom)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Bottom Tweet Padding<br/>"; } else { update_option('dt_twitter_display_tweetpaddingbottom',$dt_twitter_display_tweetpaddingbottom); }
		if (!is_numeric($dt_twitter_display_tweetpaddingleft)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Left Tweet Padding<br/>"; } else { update_option('dt_twitter_display_tweetpaddingleft',$dt_twitter_display_tweetpaddingleft); }
		if (!is_numeric($dt_twitter_display_tweetpaddingright)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Right Tweet Padding<br/>"; } else { update_option('dt_twitter_display_tweetpaddingright',$dt_twitter_display_tweetpaddingright); }
		if (!is_numeric($dt_twitter_display_tweetbradius)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Tweet Corner Radius<br/>"; } else { update_option('dt_twitter_display_tweetbradius',$dt_twitter_display_tweetbradius); }
		if (!is_numeric($dt_twitter_image_bradius)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Twitter Image Corner Radius<br/>"; } else { update_option('dt_twitter_image_bradius',$dt_twitter_image_bradius); }
		if (!is_numeric($dt_twitter_image_marginright)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Right Image Margin<br/>"; } else { update_option('dt_twitter_image_marginright',$dt_twitter_image_marginright); }
		if (!is_numeric($dt_twitter_image_marginbottom)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Bottom Image Margin<br/>"; } else { update_option('dt_twitter_image_marginbottom',$dt_twitter_image_marginbottom); }
		if (!is_numeric($dt_twitter_icon_margintop)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Tweet Icon Top Margin<br/>"; } else { update_option('dt_twitter_icon_margintop',$dt_twitter_icon_margintop); }
		if (!is_numeric($dt_twitter_icon_spacing)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Tweet Icon Spacing<br/>"; } else { update_option('dt_twitter_icon_spacing',$dt_twitter_icon_spacing); }

		//Update tweet Icon Fontsize Or Display Error
		if(!$dt_twitter_icon_fontsize) { $_SESSION['display_message'].="Please Enter The Tweet Icon Font Size<br/>"; } elseif (!is_numeric($dt_twitter_icon_fontsize)) { $_SESSION['display_message'].="Please Enter A Numeric Value For The Tweet Icon Font Size<br/>"; } else { update_option('dt_twitter_icon_fontsize',$dt_twitter_icon_fontsize); }

		//Update Other Select Options
		update_option('dt_twitter_display_auto',$dt_twitter_display_auto);
		update_option('dt_twitter_display_mcwidth_unit',$dt_twitter_display_mcwidth_unit);
		update_option('dt_twitter_display_mcbg',$dt_twitter_display_mcbg);
		update_option('dt_twitter_display_mcbg_enabled',$dt_twitter_display_mcbg_enabled);
		update_option('dt_twitter_display_mcpaddingtop_unit',$dt_twitter_display_mcpaddingtop_unit);
		update_option('dt_twitter_display_mcpaddingbottom_unit',$dt_twitter_display_mcpaddingbottom_unit);
		update_option('dt_twitter_display_mcpaddingleft_unit',$dt_twitter_display_mcpaddingleft_unit);
		update_option('dt_twitter_display_mcpaddingright_unit',$dt_twitter_display_mcpaddingright_unit);
		update_option('dt_twitter_display_mcmargintop_unit',$dt_twitter_display_mcmargintop_unit);
		update_option('dt_twitter_display_mcmarginbottom_unit',$dt_twitter_display_mcmarginbottom_unit);
		update_option('dt_twitter_display_mcmarginleft_unit',$dt_twitter_display_mcmarginleft_unit);
		update_option('dt_twitter_display_mcmarginright_unit',$dt_twitter_display_mcmarginright_unit);
		update_option('dt_twitter_display_mcbradius_unit',$dt_twitter_display_mcbradius_unit);
		update_option('dt_twitter_display_fontsize_unit',$dt_twitter_display_fontsize_unit);
		update_option('dt_twitter_display_fontcolor',$dt_twitter_display_fontcolor);
		update_option('dt_twitter_display_linkcolor',$dt_twitter_display_linkcolor);
		update_option('dt_twitter_display_tweetbg',$dt_twitter_display_tweetbg);
		update_option('dt_twitter_display_tweetbg_enabled',$dt_twitter_display_tweetbg_enabled);
		update_option('dt_twitter_display_tweetbgalt',$dt_twitter_display_tweetbgalt);
		update_option('dt_twitter_display_tweetbgalt_enabled',$dt_twitter_display_tweetbgalt_enabled);
		update_option('dt_twitter_image_size',$dt_twitter_image_size);
		update_option('dt_twitter_image_bradius_unit',$dt_twitter_image_bradius_unit);
		update_option('dt_twitter_image_marginright_unit',$dt_twitter_image_marginright_unit);
		update_option('dt_twitter_image_marginbottom_unit',$dt_twitter_image_marginbottom_unit);
		update_option('dt_twitter_display_tweetmargintop_unit',$dt_twitter_display_tweetmargintop_unit);
		update_option('dt_twitter_display_tweetmarginbottom_unit',$dt_twitter_display_tweetmarginbottom_unit);
		update_option('dt_twitter_display_tweetmarginleft_unit',$dt_twitter_display_tweetmarginleft_unit);
		update_option('dt_twitter_display_tweetmarginright_unit',$dt_twitter_display_tweetmarginright_unit);
		update_option('dt_twitter_display_tweetpaddingtop_unit',$dt_twitter_display_tweetpaddingtop_unit);
		update_option('dt_twitter_display_tweetpaddingbottom_unit',$dt_twitter_display_tweetpaddingbottom_unit);
		update_option('dt_twitter_display_tweetpaddingleft_unit',$dt_twitter_display_tweetpaddingleft_unit);
		update_option('dt_twitter_display_tweetpaddingright_unit',$dt_twitter_display_tweetpaddingright_unit);
		update_option('dt_twitter_display_tweetbradius_unit',$dt_twitter_display_tweetbradius_unit);
		update_option('dt_twitter_icon_fontsize_unit',$dt_twitter_icon_fontsize_unit);
		update_option('dt_twitter_icon_fontcolor',$dt_twitter_icon_fontcolor);
		update_option('dt_twitter_icon_fontcolor_hover',$dt_twitter_icon_fontcolor_hover);
		update_option('dt_twitter_icon_margintop_unit',$dt_twitter_icon_margintop_unit);
		update_option('dt_twitter_icon_spacing_unit',$dt_twitter_icon_spacing_unit);
		
		//If No Errors
		if(!$_SESSION['display_message']) { $_SESSION['display_success']="The Display Options Were Successfully Updated"; }
		
	//End Display Settings Function		
	}
	?>
		
	<div class="wrap dt">
	
		<div id="dt_main_header">
			<h2 class="dt_header"><?php _e('Digicution Simple Twitter Feed','digicution-simple-twitter-feed'); ?></h2>
			<div class="request"><?php _e('Found a bug or have a feature request?','digicution-simple-twitter-feed'); ?>&nbsp;&nbsp;<a class="button-primary dtbutton" href="http://www.digicution.com/contact/" target="_blank" name="featurebug"/><?php _e('Click Here','digicution-simple-twitter-feed'); ?></a></div>
			<div class="clear"></div>
		</div>
		
		<div id="dt" class="main">
				
			<div id="dt-admin-form-container">		
						
				<div id="dt-tabbed-area" class="rounded">
							
					<div class="pane-content">
		
		
						<div class="left-area">
						
							<legend id="mobilemenuhead">Main Menu</legend>
							
							<ul>
								<?php
								//Only Run Update If CURL Exists
								if (function_exists('curl_init')) { 
								
									//Get OAuth Authentication Details (Twitter API V1.1)
									if(get_option('dt_twitter_oauth_access_token') && dtCrypt('d',get_option('dt_twitter_oauth_access_token'))) { $dt_twitter_oauth_access_token=dtCrypt('d',get_option('dt_twitter_oauth_access_token')); } else { $dt_twitter_oauth_access_token=''; }
									if(get_option('dt_twitter_oauth_access_token_secret') && dtCrypt('d',get_option('dt_twitter_oauth_access_token_secret'))) { $dt_twitter_oauth_access_token_secret=dtCrypt('d',get_option('dt_twitter_oauth_access_token_secret')); } else { $dt_twitter_oauth_access_token_secret=''; }
									if(get_option('dt_twitter_consumer_key') && dtCrypt('d',get_option('dt_twitter_consumer_key'))) { $dt_twitter_consumer_key=dtCrypt('d',get_option('dt_twitter_consumer_key')); } else { $dt_twitter_consumer_key=''; }
									if(get_option('dt_twitter_consumer_secret') && dtCrypt('d',get_option('dt_twitter_consumer_secret'))) { $dt_twitter_consumer_secret=dtCrypt('d',get_option('dt_twitter_consumer_secret')); } else { $dt_twitter_consumer_secret=''; }
									
									//Set Flag For Body
									$oauthdetails=0;
									?>
									<li><a id="tab-section-application" rel="application" href="#" <?php if (!$tab || $tab=="application") {?>class="active"<?php } ?>><?php _e('Twitter App Settings','digicution-simple-twitter-feed'); ?></a></li>
									<?php
									//If We Have All Required Tokens & Keys
									if($dt_twitter_oauth_access_token && $dt_twitter_oauth_access_token_secret && $dt_twitter_consumer_key && $dt_twitter_consumer_secret) {
									
										//Set Flag For Body
										$oauthdetails=1;
										?>
										<li><a id="tab-section-general" rel="general" href="#" <?php if ($tab=="general") {?>class="active"<?php } ?>><?php _e('General Settings','digicution-simple-twitter-feed'); ?></a></li>
										<li><a id="tab-section-display" rel="display" href="#" <?php if ($tab=="display") {?>class="active"<?php } ?>><?php _e('Automatic Styling','digicution-simple-twitter-feed'); ?></a></li>
										<li><a id="tab-section-manual" rel="manual" href="#" <?php if ($tab=="manual") {?>class="active"<?php } ?>><?php _e('Manual Styling','digicution-simple-twitter-feed'); ?></a></li>
										<li><a id="tab-section-integrate" rel="integrate" href="#" <?php if ($tab=="integrate") {?>class="active"<?php } ?>><?php _e('How To Integrate','digicution-simple-twitter-feed'); ?></a></li>
									<?php
									//Otherwise - Disable These Until Details Completed
									} else {
									?>
										<li><span class="inactive"><?php _e('General Settings','digicution-simple-twitter-feed'); ?></span></li>
										<li><span class="inactive"><?php _e('Automatic Styling','digicution-simple-twitter-feed'); ?></span></li>
										<li><span class="inactive"><?php _e('Manual Styling','digicution-simple-twitter-feed'); ?></span></li>
										<li><span class="inactive"><?php _e('How To Integrate','digicution-simple-twitter-feed'); ?></span></li>
									<?php
									//End If We Have OAuth Access Details
									}
										
								//Otherwise - CURL Not Available
								} else {
									?>
									<li><a id="tab-section-application" rel="application" href="#" <?php if (!$tab || $tab=="application") {?>class="active"<?php } ?>><?php _e('Error: cURL Not Available','digicution-simple-twitter-feed'); ?></a></li>
								<?php
								//End CURL Check
								}
								?>
								<div class="clear"></div>
							</ul>
						</div>
				
						<div class="right-area">									
									
									
							<?php
							//Only Run Update If CURL Exists
							if (function_exists('curl_init')) { 
							?>
		
							<div <?php if (!$tab || $tab=="application") {?>style="display: block;"<?php } else { ?>style="display: none;"<?php } ?> class="setting-right-section" id="setting-application">
														
								<div class="dt-setting">
								
									<?php if (($_SESSION['application_message']!="") || ($_SESSION['application_success']!="")) {?>
									
									<div class="dt-setting">
										<div>
										<fieldset class="rounded">
										<?php if ($_SESSION['application_message']!="") { ?><legend class="validation"><?php _e('Validation Error','digicution-simple-twitter-feed'); ?></legend><?php } else {?><legend class="validation"><?php _e('Success','digicution-simple-twitter-feed'); ?></legend><?php } ?>
										<div class="dt-ad-section-settings"></div>
										<div class="dt-setting type-text validation" id="setting_site_title">
										<?php _e($_SESSION['application_message'],'dt_twitter'); ?>
										<?php _e($_SESSION['application_success'],'dt_twitter'); ?>
										</div>
										<div class="dt-setting type-section-end"></div>
										</fieldset>
										</div>
									</div>								
									
									<?php $_SESSION['application_message']=""; $_SESSION['application_success']=""; } ?>
										
									<form action="?page=dt_setting" method="post" id="dt_twitter-plugin_options_form_application" name="dt_twitter-plugin_options_form_application">
										
									<div class="dt-setting">	
										<fieldset class="rounded">
										<legend><?php _e('Twitter App Settings','digicution-simple-twitter-feed'); ?></legend>
	
											<?php
											//If We Have All Required Tokens & Keys
											if($oauthdetails==0) {
											?>
											
											<div class="description-instruct"><?php _e('In order to use this plugin, you must first create a Twitter application so that you can use the OAuth authentication techniques required for the plugin to function.','digicution-simple-twitter-feed'); ?><br/><br/><?php _e('Head to ','digicution-simple-twitter-feed'); ?><a href="https://dev.twitter.com/" target="_blank" />https://dev.twitter.com/</a><?php _e(' to create a Twitter Application and then simply enter the Application details in the fields below.','digicution-simple-twitter-feed'); ?><br/><br/><?php _e('Once you\'ve done this, the plugin will become fully active.','digicution-simple-twitter-feed'); ?></div><div class="clear"></div>
											
											<?php 
											//End If We Don't Have Details
											} else {
											?>
												
											<div class="description-instruct"><?php _e('In order to use this plugin, you must first create a Twitter application so that you can use the OAuth authentication techniques required for the plugin to function.','digicution-simple-twitter-feed'); ?><br/><br/><?php _e('Head to ','digicution-simple-twitter-feed'); ?><a href="https://dev.twitter.com/" target="_blank" />https://dev.twitter.com/</a><?php _e(' to create a Twitter Application and then simply enter the Application details in the fields below.','digicution-simple-twitter-feed'); ?><br/><br/><?php _e('If you\'re having problems with this plugin, please double check that you have the correct details from your Twitter App entered in the correct boxes below.','digicution-simple-twitter-feed'); ?></div><div class="clear"></div>
											
											<?php	
											}
											?>
	
											<div class="dt-setting type-text" id="setting_site_title">
													
												<div class="inputholder bottomgap">
												<label for="dt_twitter_consumer_key"><?php _e('API Key:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Enter Your Twitter Application API Key','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_consumer_key" class="full" type="text" size="36" name="dt_twitter_consumer_key" value="<?php if($dt_twitter_consumer_key) { echo $dt_twitter_consumer_key; } ?>" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_consumer_secret"><?php _e('API Secret:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Enter Your Twitter Application API Secret','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_consumer_secret" class="full" type="text" size="36" name="dt_twitter_consumer_secret" value="<?php if($dt_twitter_consumer_secret) { echo $dt_twitter_consumer_secret; } ?>" />
												</div>
														
												<div class="inputholder bottomgap">
												<label for="dt_twitter_oauth_access_token"><?php _e('Access Token:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Enter Your Twitter Application Access Token','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_oauth_access_token" class="full" type="text" size="36" name="dt_twitter_oauth_access_token" value="<?php if($dt_twitter_oauth_access_token) { echo $dt_twitter_oauth_access_token; } ?>" />
												</div>
												
												<div class="inputholder">
												<label for="dt_twitter_oauth_access_token_secret"><?php _e('Access Token Secret:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Enter Your Twitter Application Access Token Secret','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_oauth_access_token_secret" class="full" type="text" size="36" name="dt_twitter_oauth_access_token_secret" value="<?php if($dt_twitter_oauth_access_token_secret) { echo $dt_twitter_oauth_access_token_secret; } ?>" />
												</div>
																								
											</div>
											
										</fieldset>
									</div>
									
									<div class="dt-setting"></div>
									<input type="hidden" name="option" value="applicationupdate" />
									<input class="button-primary dtbutton" type="submit" name="submit" tabindex="1" value="<?php _e('Update Application Options','digicution-simple-twitter-feed'); ?>" />
										
									</form>
																			
								</div>	
								
							</div>	
									
							<?php
							//Otherwise - CURL Not Available
							} else {
							?>
									
							<div <?php if (!$tab || $tab=="application") {?>style="display: block;"<?php } else { ?>style="display: none;"<?php } ?> class="setting-right-section" id="setting-application">
														
								<div class="dt-setting">
										
									<div class="dt-setting">	
										<fieldset class="rounded">
										<legend><?php _e('Error: cURL Is Not Available','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="dt-setting type-text" id="setting_site_title">
												
												<div class="bottomgap">
												<p><?php _e('Unfortunately, due to the changes made to the Twitter API on June 11th 2013 when it was upgraded to Version 1.1, all Twitter requests require OAuth authorisation.','digicution-simple-twitter-feed'); ?><br/><br/><?php _e('This application requires PHP\'s built in cURL functions in order to retrieve your Tweets from Twitter and unfortunately, the server that your Wordpress blog is hosted on does not seem to have this functionality enabled.','digicution-simple-twitter-feed'); ?><br/><br/><?php _e('Please speak to your server administrator and get them to enable cURL on your installation in order to use this plugin.','digicution-simple-twitter-feed'); ?></p>
												</div>
												
											</div>
											
										</fieldset>
									</div>
																			
								</div>	
								
							</div>	
									
							<?php
							//End CURL Check
							}
							?>
										
							<div <?php if ($tab=="general") {?>style="display: block;"<?php } else { ?>style="display: none;"<?php } ?> class="setting-right-section" id="setting-general">
														
								<div class="dt-setting">
								
									<?php if (($_SESSION['general_message']!="") || ($_SESSION['general_success']!="")) {?>
									
									<div class="dt-setting">
										<div>
										<fieldset class="rounded">
										<?php if ($_SESSION['general_message']!="") { ?><legend class="validation"><?php _e('Validation Error','digicution-simple-twitter-feed'); ?></legend><?php } else {?><legend class="validation"><?php _e('Success','digicution-simple-twitter-feed'); ?></legend><?php } ?>
										<div class="dt-ad-section-settings"></div>
										<div class="dt-setting type-text validation" id="setting_site_title">
										<?php _e($_SESSION['general_message'],'dt_twitter'); ?>
										<?php _e($_SESSION['general_success'],'dt_twitter'); ?>
										</div>
										<div class="dt-setting type-section-end"></div>
										</fieldset>
										</div>
									</div>								
									
									<?php $_SESSION['general_message']=""; $_SESSION['general_success']=""; } ?>
										
									<form action="?page=dt_setting" method="post" id="dt_twitter-plugin_options_form_general" name="dt_twitter-plugin_options_form_general">
										
									<div class="dt-setting">	
										<fieldset class="rounded">
										<legend><?php _e('General Settings','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="description-instruct"><?php _e('These settings control what features are outputted by the plugin.','digicution-simple-twitter-feed'); ?><br/><br/><?php _e('Please use the options below to choose which features you want in your Twitter Feed :)','digicution-simple-twitter-feed'); ?></div><div class="clear"></div>

											<div class="dt-setting type-text" id="setting_site_title">
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_screenname"><?php _e('Twitter Username:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Enter Your Twitter Username / Screen Name','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_screenname" class="full" type="text" size="36" name="dt_twitter_screenname" value="<?php echo get_option('dt_twitter_screenname'); ?>" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_tweetsize"><?php _e('Number Of Tweets To Display:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate How Many Tweets You Would Like To Display In Your Twitter Feed','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_tweetsize" class="small" type="text" size="36" name="dt_twitter_tweetsize" class="numberinput" value="<?php echo get_option('dt_twitter_tweetsize'); ?>" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_twitterupdate"><?php _e('Twitter Update Frequency:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Select How Often You Would Like Your Twitter Feed To Update (Please Check The ','digicution-simple-twitter-feed'); ?><a href="https://dev.twitter.com/docs/rate-limiting/1.1" target="_blank"><?php _e('Rate Limiting Documentation','digicution-simple-twitter-feed'); ?></a><?php _e(' Before Changing This Value)','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_twitterupdate" class="small">
							                    <option value="3600"<?php if((get_option('dt_twitter_twitterupdate')==3600) || (!get_option('dt_twitter_twitterupdate'))) { echo ' selected="selected"'; } ?>><?php _e('1 Hour','digicution-simple-twitter-feed'); ?></option>
							                    <option value="2700"<?php if(get_option('dt_twitter_twitterupdate')==2700) { echo ' selected="selected"'; } ?>><?php _e('45 Minutes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="1800"<?php if(get_option('dt_twitter_twitterupdate')==1800) { echo ' selected="selected"'; } ?>><?php _e('30 Minutes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="1500"<?php if(get_option('dt_twitter_twitterupdate')==1500) { echo ' selected="selected"'; } ?>><?php _e('25 Minutes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="1200"<?php if(get_option('dt_twitter_twitterupdate')==1200) { echo ' selected="selected"'; } ?>><?php _e('20 Minutes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="900"<?php if(get_option('dt_twitter_twitterupdate')==900) { echo ' selected="selected"'; } ?>><?php _e('15 Minutes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="600"<?php if(get_option('dt_twitter_twitterupdate')==600) { echo ' selected="selected"'; } ?>><?php _e('10 Minutes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="300"<?php if(get_option('dt_twitter_twitterupdate')==300) { echo ' selected="selected"'; } ?>><?php _e('5 Minutes','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_images"><?php _e('Display Profile Images:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like To Display Profile Images Next To Each Tweet','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_images" class="small">
							                    <option value="1"<?php if((get_option('dt_twitter_images')==1) || (!get_option('dt_twitter_images'))) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_images')==0) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_retweet"><?php _e('Display Re-Tweets:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like To Display Native Re-Tweets From Your Twitter Feed','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_retweet" class="small">
							                    <option value="1"<?php if((get_option('dt_twitter_retweet')==1) || (!get_option('dt_twitter_retweet'))) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_retweet')==0) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_follow"><?php _e('Display Follow Link After Tweets:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like A Link To Your Twitter Profile At The Bottom Of The Feed','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_follow" class="medium">
							                    <option value="3"<?php if(get_option('dt_twitter_follow')==3) { echo ' selected="selected"'; } ?>><?php _e('Follow Button (With &#64;Screenname)','digicution-simple-twitter-feed'); ?></option>
							                    <option value="2"<?php if(get_option('dt_twitter_follow')==2) { echo ' selected="selected"'; } ?>><?php _e('Follow Button (No &#64;Screenname)','digicution-simple-twitter-feed'); ?></option>
							                    <option value="1"<?php if(get_option('dt_twitter_follow')==1) { echo ' selected="selected"'; } ?>><?php _e('Text Link','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if((get_option('dt_twitter_follow')==0) || (!get_option('dt_twitter_follow'))) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_hashtag_convert"><?php _e('Link Hashtags:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like To Convert Twitter Hash Tags To Links','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_hashtag_convert" class="small">
							                    <option value="1"<?php if((get_option('dt_twitter_hashtag_convert')==1) || (!get_option('dt_twitter_hashtag_convert'))) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_hashtag_convert')==0) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
												<div class="inputholder">
												<label for="dt_twitter_username_convert"><?php _e('Link @usernames:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like To Convert Twitter Usernames To Links','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_username_convert" class="small">
							                    <option value="1"<?php if((get_option('dt_twitter_username_convert')==1) || (!get_option('dt_twitter_username_convert'))) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_username_convert')==0) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
											</div>
											
										</fieldset>
									</div>
									
									<div class="dt-setting">	
										<fieldset class="rounded">
										<legend><?php _e('Header Settings','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="dt-setting type-text" id="setting_site_title">
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_header_display"><?php _e('Display Header:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like To Display A Title Header For Your Tweets','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_header_display" class="small">
							                    <option value="1"<?php if(get_option('dt_twitter_header_display')==1) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if((get_option('dt_twitter_header_display')==0) || (!get_option('dt_twitter_header_display'))) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_header_title"><?php _e('Header Title:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Enter A Title For Your Header','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_header_title" class="full" type="text" size="36" name="dt_twitter_header_title" value="<?php echo get_option('dt_twitter_header_title'); ?>" />
												</div>
												
												<div class="inputholder">
												<label for="dt_twitter_header_follow"><?php _e('Display Follow Link In Header:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like A Link To Your Twitter Profile In Your Header','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_header_follow" class="medium">
							                    <option value="3"<?php if(get_option('dt_twitter_header_follow')==3) { echo ' selected="selected"'; } ?>><?php _e('Follow Button (With &#64;Screenname)','digicution-simple-twitter-feed'); ?></option>
							                    <option value="2"<?php if(get_option('dt_twitter_header_follow')==2) { echo ' selected="selected"'; } ?>><?php _e('Follow Button (No &#64;Screenname)','digicution-simple-twitter-feed'); ?></option>
							                    <option value="1"<?php if(get_option('dt_twitter_header_follow')==1) { echo ' selected="selected"'; } ?>><?php _e('Text Link','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if((get_option('dt_twitter_header_follow')==0) || (!get_option('dt_twitter_header_follow'))) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
											</div>
											
										</fieldset>
									</div>
									
									<div class="dt-setting">
										<fieldset class="rounded">
										<legend><?php _e('Single Tweet Settings (What To Display For Each Tweet)','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="dt-setting type-text" id="setting_site_title">
											
												<div class="inputholder bottomgap">
												<label for="dt_twitter_fullname_display"><?php _e('Display Full Name:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like To Display Full Name At The Top Of Each Tweet','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_fullname_display" class="small">
							                    <option value="1"<?php if(get_option('dt_twitter_fullname_display')==1) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if((get_option('dt_twitter_fullname_display')==0) || (!get_option('dt_twitter_fullname_display'))) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_screenname_display"><?php _e('Display Screen Name:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like To Display Screen Name At The Top Of Each Tweet','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_screenname_display" class="small">
							                    <option value="1"<?php if(get_option('dt_twitter_screenname_display')==1) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if((get_option('dt_twitter_screenname_display')==0) || (!get_option('dt_twitter_screenname_display'))) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
											
												<div class="inputholder bottomgap">
												<label for="dt_twitter_readdate_display"><?php _e('Display Tweet Date:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like To Display The Approximate Time / Date Of Tweet','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_readdate_display" class="small">
							                    <option value="2"<?php if(get_option('dt_twitter_readdate_display')==2) { echo ' selected="selected"'; } ?>><?php _e('After Tweet','digicution-simple-twitter-feed'); ?></option>
							                    <option value="1"<?php if(get_option('dt_twitter_readdate_display')==1) { echo ' selected="selected"'; } ?>><?php _e('Before Tweet','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if((get_option('dt_twitter_readdate_display')==0) || (!get_option('dt_twitter_readdate_display'))) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>

												<div class="inputholder bottomgap">
												<label for="dt_twitter_post_expand"><?php _e('Display Expand Tweet Option:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like An Expand Tweet Option Link After Each Tweet','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_post_expand" class="small">
							                    <option value="2"<?php if(get_option('dt_twitter_post_expand')==2) { echo ' selected="selected"'; } ?>><?php _e('Icon','digicution-simple-twitter-feed'); ?></option>
							                    <option value="1"<?php if(get_option('dt_twitter_post_expand')==1) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if((get_option('dt_twitter_post_expand')==0) || (!get_option('dt_twitter_post_expand'))) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_post_reply"><?php _e('Display Reply To Tweet Option:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like A Reply To Tweet Option Link After Each Tweet','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_post_reply" class="small">
							                    <option value="2"<?php if(get_option('dt_twitter_post_reply')==2) { echo ' selected="selected"'; } ?>><?php _e('Icon','digicution-simple-twitter-feed'); ?></option>
							                    <option value="1"<?php if(get_option('dt_twitter_post_reply')==1) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if((get_option('dt_twitter_post_reply')==0) || (!get_option('dt_twitter_post_reply'))) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_post_retweet"><?php _e('Display Re-Tweet Option:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like A Re-Tweet Option Link After Each Tweet','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_post_retweet" class="small">
							                    <option value="2"<?php if(get_option('dt_twitter_post_retweet')==2) { echo ' selected="selected"'; } ?>><?php _e('Icon','digicution-simple-twitter-feed'); ?></option>
							                    <option value="1"<?php if(get_option('dt_twitter_post_retweet')==1) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if((get_option('dt_twitter_post_retweet')==0) || (!get_option('dt_twitter_post_retweet'))) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
												<div class="inputholder">
												<label for="dt_twitter_post_favourite"><?php _e('Display Favourite Option:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Please Indicate Whether You Would Like An Add To Favourites Option Link After Each Tweet','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_post_favourite" class="small">
							                    <option value="2"<?php if(get_option('dt_twitter_post_favourite')==2) { echo ' selected="selected"'; } ?>><?php _e('Icon','digicution-simple-twitter-feed'); ?></option>
							                    <option value="1"<?php if(get_option('dt_twitter_post_favourite')==1) { echo ' selected="selected"'; } ?>><?php _e('Yes','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if((get_option('dt_twitter_post_favourite')==0) || (!get_option('dt_twitter_post_favourite'))) { echo ' selected="selected"'; } ?>><?php _e('No','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
											</div>
											
										</fieldset>
									</div>
									
									<div class="dt-setting"></div>
									<input type="hidden" name="option" value="generalupdate" />
									<input class="button-primary dtbutton" type="submit" name="submit" tabindex="1" value="<?php _e('Update General Options','digicution-simple-twitter-feed'); ?>" />
										
									</form>
																			
								</div>	
								
							</div>	
										
										
										
										
																							
							<div <?php if ($tab=="display") {?>style="display: block;"<?php } else { ?>style="display: none;"<?php } ?> class="setting-right-section" id="setting-display">
										
								<div class="dt-setting">
								
									<?php if (($_SESSION['display_message']!="") || ($_SESSION['display_success']!="")) {?>
									
									<div class="dt-setting">
										<div>
										<fieldset class="rounded">
										<?php if ($_SESSION['display_message']!="") { ?><legend class="validation"><?php _e('Validation Error','digicution-simple-twitter-feed'); ?></legend><?php } else {?><legend class="validation"><?php _e('Success','digicution-simple-twitter-feed'); ?></legend><?php } ?>
										<div class="dt-ad-section-settings"></div>
										<div class="dt-setting type-text validation" id="setting_site_title">
										<?php _e($_SESSION['display_message'],'dt_twitter'); ?>
										<?php _e($_SESSION['display_success'],'dt_twitter'); ?>
										</div>
										<div class="dt-setting type-section-end"></div>
										</fieldset>
										</div>
									</div>								
									
									<?php $_SESSION['display_message']=""; $_SESSION['display_success']=""; } ?>
										
									<form action="?page=dt_setting" method="post" id="dt_twitter-plugin_options_form_display" name="dt_twitter-plugin_options_form_display">
										
									<div class="dt-setting">	
										<fieldset class="rounded">
										<legend><?php _e('Automatic Styling Settings','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="description-instruct"><?php _e('These settings control how your Twitter features are displayed.','digicution-simple-twitter-feed'); ?><br/><br/><?php _e('If you want to style your Twitter feed using the options below, choose "Yes - Use Automatic Styling".','digicution-simple-twitter-feed'); ?><br/><br/><?php _e('However, if you want to style your Twitter feed manually using CSS, please select "No - Use Manual Styling" and download the CSS template from the Manual Styling section.','digicution-simple-twitter-feed'); ?></div><div class="clear"></div>

											<div class="dt-setting type-text">
												
												<div class="inputholder">
												<label for="dt_twitter_display_auto"><?php _e('Use Automatic Styling:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Select Yes To Use The Settings On This Page For Your Twitter Feed','digicution-simple-twitter-feed'); ?></p>
												<p class="labeldesc"><?php _e('Select No To Disable All Styling So You Can Manually Style Your Twitter Feed Using CSS','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_display_auto" class="full">
							                    <option value="1"<?php if((get_option('dt_twitter_display_auto')==1) || (!get_option('dt_twitter_display_auto'))) { echo ' selected="selected"'; } ?>><?php _e('Yes - Use Automatic Styling','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_auto')==0) { echo ' selected="selected"'; } ?>><?php _e('No - Use Manual Styling','digicution-simple-twitter-feed'); ?></option>
							                    </select>
												</div>
												
											</div>
											
										</fieldset>
									</div>
									
									<div class="dt-setting">
										<fieldset class="rounded">
										<legend><?php _e('Main Container Settings','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="dt-setting type-text">
											
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcwidth"><?php _e('Main Container Width:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Main Container Width For The Twitter Feed In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcwidth" type="text" size="36" name="dt_twitter_display_mcwidth" class="numberinput left" value="<?php echo get_option('dt_twitter_display_mcwidth'); ?>" />
							                    <select name="dt_twitter_display_mcwidth_unit" class="left numberinput">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcwidth_unit')==1) || (!get_option('dt_twitter_display_mcwidth_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcwidth_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcbg"><?php _e('Main Container BG Colour:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Main Container Background Colour Or Select Disabled To Make It Transparent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcbg" type="minicolors" size="36" name="dt_twitter_display_mcbg" class="colourinput left" <?php if (get_option('dt_twitter_display_mcbg_enabled')==0) { ?>disabled="disabled" value="<?php _e('No Background Colour','digicution-simple-twitter-feed'); ?>"<?php } else { ?>value="<?php echo get_option('dt_twitter_display_mcbg'); ?>"<?php } ?> />
							                    <select name="dt_twitter_display_mcbg_enabled" rel="dt_twitter_display_mcbg" class="colorselector left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcbg_enabled')==1) || (!get_option('dt_twitter_display_mcbg_enabled'))) { echo ' selected="selected"'; } ?>><?php _e('Enabled','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcbg_enabled')==0) { echo ' selected="selected"'; } ?>><?php _e('Disabled','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcpaddingtop"><?php _e('Main Container Top Padding:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Top Padding For The Main Container (Spacing Between Main Container &amp; Tweets) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcpaddingtop" type="text" size="36" name="dt_twitter_display_mcpaddingtop" class="numberinput left" value="<?php echo get_option('dt_twitter_display_mcpaddingtop'); ?>" />
							                    <select name="dt_twitter_display_mcpaddingtop_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcpaddingtop_unit')==1) || (!get_option('dt_twitter_display_mcpaddingtop_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcpaddingtop_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcpaddingbottom"><?php _e('Main Container Bottom Padding:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Bottom Padding For The Main Container (Spacing Between Main Container &amp; Tweets) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcpaddingbottom" type="text" size="36" name="dt_twitter_display_mcpaddingbottom" class="numberinput left" value="<?php echo get_option('dt_twitter_display_mcpaddingbottom'); ?>" />
							                    <select name="dt_twitter_display_mcpaddingbottom_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcpaddingbottom_unit')==1) || (!get_option('dt_twitter_display_mcpaddingbottom_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcpaddingbottom_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>

												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcpaddingleft"><?php _e('Main Container Left Padding:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Left Padding For The Main Container (Spacing Between Main Container &amp; Tweets) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcpaddingleft" type="text" size="36" name="dt_twitter_display_mcpaddingleft" class="numberinput left" value="<?php echo get_option('dt_twitter_display_mcpaddingleft'); ?>" />
							                    <select name="dt_twitter_display_mcpaddingleft_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcpaddingleft_unit')==1) || (!get_option('dt_twitter_display_mcpaddingleft_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcpaddingleft_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>

												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcpaddingright"><?php _e('Main Container Right Padding:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Right Padding For The Main Container (Spacing Between Main Container &amp; Tweets) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcpaddingright" type="text" size="36" name="dt_twitter_display_mcpaddingright" class="numberinput left" value="<?php echo get_option('dt_twitter_display_mcpaddingright'); ?>" />
							                    <select name="dt_twitter_display_mcpaddingright_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcpaddingright_unit')==1) || (!get_option('dt_twitter_display_mcpaddingright_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcpaddingright_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcmargintop"><?php _e('Main Container Top Margin:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Top Margin For The Main Container (Spacing Around The Top Of The Main Container) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcmargintop" type="text" size="36" name="dt_twitter_display_mcmargintop" class="numberinput left" value="<?php echo get_option('dt_twitter_display_mcmargintop'); ?>" />
							                    <select name="dt_twitter_display_mcmargintop_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcmargintop_unit')==1) || (!get_option('dt_twitter_display_mcmargintop_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcmargintop_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcmarginbottom"><?php _e('Main Container Bottom Margin:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Bottom Margin For The Main Container (Spacing Around The Bottom Of The Main Container) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcmarginbottom" type="text" size="36" name="dt_twitter_display_mcmarginbottom" class="numberinput left" value="<?php echo get_option('dt_twitter_display_mcmarginbottom'); ?>" />
							                    <select name="dt_twitter_display_mcmarginbottom_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcmarginbottom_unit')==1) || (!get_option('dt_twitter_display_mcmarginbottom_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcmarginbottom_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcmarginleft"><?php _e('Main Container Left Margin:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Left Margin For The Main Container (Spacing Around The Left Of The Main Container) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcmarginleft" type="text" size="36" name="dt_twitter_display_mcmarginleft" class="numberinput left" value="<?php echo get_option('dt_twitter_display_mcmarginleft'); ?>" />
							                    <select name="dt_twitter_display_mcmarginleft_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcmarginleft_unit')==1) || (!get_option('dt_twitter_display_mcmarginleft_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcmarginleft_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcmarginright"><?php _e('Main Container Right Margin:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Right Margin For The Main Container (Spacing Around The Right Of The Main Container) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcmarginright" type="text" size="36" name="dt_twitter_display_mcmarginright" class="numberinput left" value="<?php echo get_option('dt_twitter_display_mcmarginright'); ?>" />
							                    <select name="dt_twitter_display_mcmarginright_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcmarginright_unit')==1) || (!get_option('dt_twitter_display_mcmarginright_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcmarginright_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder">
												<label for="dt_twitter_display_mcbradius"><?php _e('Main Container Corner Radius:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Rounded Corner Radius Of The Main Container (0 For Square Edges)','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_mcbradius" type="text" size="36" name="dt_twitter_display_mcbradius" class="numberinput left" value="<?php echo get_option('dt_twitter_display_mcbradius'); ?>" />
							                    <select name="dt_twitter_display_mcbradius_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_mcbradius_unit')==1) || (!get_option('dt_twitter_display_mcbradius_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_mcbradius_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
											</div>
											
										</fieldset>
									</div>
									
									<div class="dt-setting">
										<fieldset class="rounded">
										<legend><?php _e('Tweet Settings','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="dt-setting type-text">
														
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_fontsize"><?php _e('Tweet Font Size:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Size Of Your Tweet Text In Pixels / Ems','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_fontsize" type="text" size="36" name="dt_twitter_display_fontsize" class="numberinput left" value="<?php echo get_option('dt_twitter_display_fontsize'); ?>" />
							                    <select name="dt_twitter_display_fontsize_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_fontsize_unit')==1) || (!get_option('dt_twitter_display_fontsize_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_fontsize_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Ems','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
														
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_fontcolor"><?php _e('Tweet Text Colour:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Colour For Your Tweets Text','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_fontcolor" type="minicolors" size="36" name="dt_twitter_display_fontcolor" class="colourinput color left" value="<?php echo get_option('dt_twitter_display_fontcolor'); ?>" />
							                    <br class="clearer" />
												</div>

												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_linkcolor"><?php _e('Tweet Link Colour:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Colour For Your Tweets Links','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_linkcolor" type="minicolors" size="36" name="dt_twitter_display_linkcolor" class="colourinput color left" value="<?php echo get_option('dt_twitter_display_linkcolor'); ?>" />
							                    <br class="clearer" />
												</div>
																							
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_tweetbg"><?php _e('Tweet Main BG Colour:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Background Colour For Your Tweets Or Select Disabled To Make Them Transparent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetbg" type="minicolors" size="36" name="dt_twitter_display_tweetbg" class="colourinput left" <?php if (get_option('dt_twitter_display_tweetbg_enabled')==0) { ?>disabled="disabled" value="<?php _e('No Background Colour','digicution-simple-twitter-feed'); ?>"<?php } else { ?>value="<?php echo get_option('dt_twitter_display_tweetbg'); ?>"<?php } ?> />
							                    <select name="dt_twitter_display_tweetbg_enabled" rel="dt_twitter_display_tweetbg" class="colorselector left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetbg_enabled')==1) || (!get_option('dt_twitter_display_tweetbg_enabled'))) { echo ' selected="selected"'; } ?>><?php _e('Enabled','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetbg_enabled')==0) { echo ' selected="selected"'; } ?>><?php _e('Disabled','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_tweetbgalt"><?php _e('Tweet Alternate BG Colour:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Background Colour For Each Alternate Tweet Or Select Disabled To Use The Same Value As The Main Tweet BG Colour','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetbgalt" type="minicolors" size="36" name="dt_twitter_display_tweetbgalt" class="colourinput left" <?php if (get_option('dt_twitter_display_tweetbgalt_enabled')==0) { ?>disabled="disabled" value="<?php _e('No Background Colour','digicution-simple-twitter-feed'); ?>"<?php } else { ?>value="<?php echo get_option('dt_twitter_display_tweetbgalt'); ?>"<?php } ?> />
							                    <select name="dt_twitter_display_tweetbgalt_enabled" rel="dt_twitter_display_tweetbgalt" class="colorselector left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetbgalt_enabled')==1) || (!get_option('dt_twitter_display_tweetbgalt_enabled'))) { echo ' selected="selected"'; } ?>><?php _e('Enabled','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetbgalt_enabled')==0) { echo ' selected="selected"'; } ?>><?php _e('Disabled','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcmargintop"><?php _e('Tweet Top Margin:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Top Margin For The Tweet (Spacing Around The Top Of The Tweet After Padding &amp; Borders) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetmargintop" type="text" size="36" name="dt_twitter_display_tweetmargintop" class="numberinput left" value="<?php echo get_option('dt_twitter_display_tweetmargintop'); ?>" />
							                    <select name="dt_twitter_display_tweetmargintop_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetmargintop_unit')==1) || (!get_option('dt_twitter_display_tweetmargintop_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetmargintop_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_tweetmarginbottom"><?php _e('Tweet Bottom Margin:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Bottom Margin For The Tweet (Spacing Around The Bottom Of The Tweet After Padding &amp; Borders) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetmarginbottom" type="text" size="36" name="dt_twitter_display_tweetmarginbottom" class="numberinput left" value="<?php echo get_option('dt_twitter_display_tweetmarginbottom'); ?>" />
							                    <select name="dt_twitter_display_tweetmarginbottom_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetmarginbottom_unit')==1) || (!get_option('dt_twitter_display_tweetmarginbottom_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetmarginbottom_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_tweetmarginleft"><?php _e('Tweet Left Margin:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Left Margin For The Tweet (Spacing Around The Left Of The Tweet After Padding &amp; Borders) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetmarginleft" type="text" size="36" name="dt_twitter_display_tweetmarginleft" class="numberinput left" value="<?php echo get_option('dt_twitter_display_tweetmarginleft'); ?>" />
							                    <select name="dt_twitter_display_tweetmarginleft_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetmarginleft_unit')==1) || (!get_option('dt_twitter_display_mcmarginleft_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetmarginleft_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_tweetmarginright"><?php _e('Tweet Right Margin:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Right Margin For The Tweet (Spacing Around The Right Of The Tweet After Padding &amp; Borders) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetmarginright" type="text" size="36" name="dt_twitter_display_tweetmarginright" class="numberinput left" value="<?php echo get_option('dt_twitter_display_tweetmarginright'); ?>" />
							                    <select name="dt_twitter_display_tweetmarginright_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetmarginright_unit')==1) || (!get_option('dt_twitter_display_tweetmarginright_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetmarginright_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>

												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_mcmargintop"><?php _e('Tweet Top Padding:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Top Padding For The Tweet (Spacing Around The Top Of The Tweet Before Margin &amp; Borders) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetpaddingtop" type="text" size="36" name="dt_twitter_display_tweetpaddingtop" class="numberinput left" value="<?php echo get_option('dt_twitter_display_tweetpaddingtop'); ?>" />
							                    <select name="dt_twitter_display_tweetpaddingtop_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetpaddingtop_unit')==1) || (!get_option('dt_twitter_display_tweetpaddingtop_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetpaddingtop_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_tweetpaddingbottom"><?php _e('Tweet Bottom Padding:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Bottom Padding For The Tweet (Spacing Around The Bottom Of The Tweet Before Margin &amp; Borders) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetpaddingbottom" type="text" size="36" name="dt_twitter_display_tweetpaddingbottom" class="numberinput left" value="<?php echo get_option('dt_twitter_display_tweetpaddingbottom'); ?>" />
							                    <select name="dt_twitter_display_tweetpaddingbottom_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetpaddingbottom_unit')==1) || (!get_option('dt_twitter_display_tweetpaddingbottom_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetpaddingbottom_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_tweetpaddingleft"><?php _e('Tweet Left Padding:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Left Padding For The Tweet (Spacing Around The Left Of The Tweet Before Margin &amp; Borders) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetpaddingleft" type="text" size="36" name="dt_twitter_display_tweetpaddingleft" class="numberinput left" value="<?php echo get_option('dt_twitter_display_tweetpaddingleft'); ?>" />
							                    <select name="dt_twitter_display_tweetpaddingleft_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetpaddingleft_unit')==1) || (!get_option('dt_twitter_display_tweetpaddingleft_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetpaddingleft_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_display_tweetpaddingright"><?php _e('Tweet Right Padding:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Right Padding For The Tweet (Spacing Around The Right Of The Tweet Before Margin &amp; Borders) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetpaddingright" type="text" size="36" name="dt_twitter_display_tweetpaddingright" class="numberinput left" value="<?php echo get_option('dt_twitter_display_tweetpaddingright'); ?>" />
							                    <select name="dt_twitter_display_tweetpaddingright_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetpaddingright_unit')==1) || (!get_option('dt_twitter_display_tweetpaddingright_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetpaddingright_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder">
												<label for="dt_twitter_display_tweetbradius"><?php _e('Tweet Corner Radius:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Rounded Corner Radius Of The Tweet (0 For Square Edges)','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_display_tweetbradius" type="text" size="36" name="dt_twitter_display_tweetbradius" class="numberinput left" value="<?php echo get_option('dt_twitter_display_tweetbradius'); ?>" />
							                    <select name="dt_twitter_display_tweetbradius_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_display_tweetbradius_unit')==1) || (!get_option('dt_twitter_display_tweetbradius_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_display_tweetbradius_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
																								
											</div>
											
										</fieldset>
									</div>
									
									<div class="dt-setting"<?php if(get_option('dt_twitter_images')==0) { echo ' style="display:none;"'; } ?>>
										<fieldset class="rounded">
										<legend><?php _e('Image Settings','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="dt-setting type-text">

												<div class="inputholder">
												<label for="dt_twitter_image_size"><?php _e('Tweet Image Size:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Size Of Your Tweet Image In Pixels','digicution-simple-twitter-feed'); ?></p>
							                    <select name="dt_twitter_image_size" class="full">
							                    <option value="10"<?php if(get_option('dt_twitter_image_size')==10) { echo ' selected="selected"'; } ?>><?php _e('10px Width x 10px Height','digicution-simple-twitter-feed'); ?></option>
							                    <option value="15"<?php if(get_option('dt_twitter_image_size')==15) { echo ' selected="selected"'; } ?>><?php _e('15px Width x 15px Height','digicution-simple-twitter-feed'); ?></option>
							                    <option value="20"<?php if(get_option('dt_twitter_image_size')==20) { echo ' selected="selected"'; } ?>><?php _e('20px Width x 20px Height','digicution-simple-twitter-feed'); ?></option>
							                    <option value="25"<?php if(get_option('dt_twitter_image_size')==25) { echo ' selected="selected"'; } ?>><?php _e('25px Width x 25px Height','digicution-simple-twitter-feed'); ?></option>
							                    <option value="30"<?php if(get_option('dt_twitter_image_size')==30) { echo ' selected="selected"'; } ?>><?php _e('30px Width x 30px Height','digicution-simple-twitter-feed'); ?></option>
							                    <option value="35"<?php if(get_option('dt_twitter_image_size')==35) { echo ' selected="selected"'; } ?>><?php _e('35px Width x 35px Height','digicution-simple-twitter-feed'); ?></option>
							                    <option value="40"<?php if(get_option('dt_twitter_image_size')==40) { echo ' selected="selected"'; } ?>><?php _e('40px Width x 40px Height','digicution-simple-twitter-feed'); ?></option>
							                    <option value="45"<?php if(get_option('dt_twitter_image_size')==45) { echo ' selected="selected"'; } ?>><?php _e('45px Width x 45px Height','digicution-simple-twitter-feed'); ?></option>
							                    <option value="50"<?php if((get_option('dt_twitter_image_size')==50) || (!get_option('dt_twitter_image_size'))) { echo ' selected="selected"'; } ?>><?php _e('50px Width x 50px Height','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_image_bradius"><?php _e('Tweet Image Corner Radius:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Rounded Corner Radius Of The Twitter Profile Image (0 For Square Images / 50% For Circles)','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_image_bradius" type="text" size="36" name="dt_twitter_image_bradius" class="numberinput left" value="<?php echo get_option('dt_twitter_image_bradius'); ?>" />
							                    <select name="dt_twitter_image_bradius_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_image_bradius_unit')==1) || (!get_option('dt_twitter_image_bradius_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_image_bradius_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
														
												<div class="inputholder bottomgap">
												<label for="dt_twitter_image_marginright"><?php _e('Tweet Image Margin Right:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Margin To The Right Of The Image (To Space Out The Text) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_image_marginright" type="text" size="36" name="dt_twitter_image_marginright" class="numberinput left" value="<?php echo get_option('dt_twitter_image_marginright'); ?>" />
							                    <select name="dt_twitter_image_marginright_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_image_marginright_unit')==1) || (!get_option('dt_twitter_image_marginright_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_image_marginright_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>

												<div class="inputholder">
												<label for="dt_twitter_image_marginbottom"><?php _e('Tweet Image Margin Bottom:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Margin At The Bottom Of The Image (To Space Out Overflow Text) In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_image_marginbottom" type="text" size="36" name="dt_twitter_image_marginbottom" class="numberinput left" value="<?php echo get_option('dt_twitter_image_marginbottom'); ?>" />
							                    <select name="dt_twitter_image_marginbottom_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_image_marginbottom_unit')==1) || (!get_option('dt_twitter_image_marginbottom_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_image_marginbottom_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>												
																								
											</div>
											
										</fieldset>
									</div>	
									
									<div class="dt-setting">
										<fieldset class="rounded">
										<legend><?php _e('Tweet Icon Settings','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="dt-setting type-text">
														
												<div class="inputholder bottomgap">
												<label for="dt_twitter_icon_fontsize"><?php _e('Tweet Icon Font Size:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Size Of Your Tweet Icon In Pixels / Ems','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_icon_fontsize" type="text" size="36" name="dt_twitter_icon_fontsize" class="numberinput left" value="<?php echo get_option('dt_twitter_icon_fontsize'); ?>" />
							                    <select name="dt_twitter_icon_fontsize_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_icon_fontsize_unit')==1) || (!get_option('dt_twitter_icon_fontsize_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_icon_fontsize_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Ems','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
														
												<div class="inputholder bottomgap">
												<label for="dt_twitter_icon_fontcolor"><?php _e('Tweet Icon Colour:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Colour For Your Tweet Icons (Leave Blank To Use Your Theme\'s Default Settings)','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_icon_fontcolor" type="minicolors" size="36" name="dt_twitter_icon_fontcolor" class="colourinput color left" value="<?php echo get_option('dt_twitter_icon_fontcolor'); ?>" />
							                    <br class="clearer" />
												</div>

												<div class="inputholder bottomgap">
												<label for="dt_twitter_icon_fontcolor_hover"><?php _e('Tweet Icon Hover Colour:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Hover Colour For Your Tweet Icons (Leave Blank To Use Your Theme\'s Default Settings)','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_icon_fontcolor_hover" type="minicolors" size="36" name="dt_twitter_icon_fontcolor_hover" class="colourinput color left" value="<?php echo get_option('dt_twitter_icon_fontcolor_hover'); ?>" />
							                    <br class="clearer" />
												</div>
																																			
												<div class="inputholder bottomgap">
												<label for="dt_twitter_icon_margintop"><?php _e('Tweet Icons Top Margin:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Top Margin For The Tweet Icons In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_icon_margintop" type="text" size="36" name="dt_twitter_icon_margintop" class="numberinput left" value="<?php echo get_option('dt_twitter_icon_margintop'); ?>" />
							                    <select name="dt_twitter_icon_margintop_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_icon_margintop_unit')==1) || (!get_option('dt_twitter_icon_margintop_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_icon_margintop_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
												
												<div class="inputholder bottomgap">
												<label for="dt_twitter_icon_spacing"><?php _e('Tweet Icon Spacing:','digicution-simple-twitter-feed'); ?></label>
												<p class="labeldesc"><?php _e('Choose The Spacing Between Icons In Pixels / Percent','digicution-simple-twitter-feed'); ?></p>
												<input id="dt_twitter_icon_spacing" type="text" size="36" name="dt_twitter_icon_spacing" class="numberinput left" value="<?php echo get_option('dt_twitter_icon_spacing'); ?>" />
							                    <select name="dt_twitter_icon_spacing_unit" class="numberinput left">
							                    <option value="1"<?php if((get_option('dt_twitter_icon_spacing_unit')==1) || (!get_option('dt_twitter_icon_spacing_unit'))) { echo ' selected="selected"'; } ?>><?php _e('Pixels','digicution-simple-twitter-feed'); ?></option>
							                    <option value="0"<?php if(get_option('dt_twitter_icon_spacing_unit')==0) { echo ' selected="selected"'; } ?>><?php _e('Percent','digicution-simple-twitter-feed'); ?></option>
							                    </select>
							                    <br class="clearer" />
												</div>
																								
											</div>
											
										</fieldset>
									</div>
									
									<div class="dt-setting"></div>
									<input type="hidden" name="option" value="displayupdate" />
									<input class="button-primary dtbutton" type="submit" name="submit" tabindex="1" value="<?php _e('Update Styling Options','digicution-simple-twitter-feed'); ?>" />
										
									</form>
																			
								</div>	
									
							</div>	
							
							
							
							<div <?php if ($tab=="manual") {?>style="display: block;"<?php } else { ?>style="display: none;"<?php } ?> class="setting-right-section" id="setting-manual">
														
								<div class="dt-setting">
																		
									<div class="dt-setting">	
										<fieldset class="rounded">
										<legend><?php _e('Manual Styling','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="dt-setting type-text" id="setting_site_title">
												
												<div class="bottomgap">
												<?php _e('OK, so the automatic styling not good enough for ya eh?  Fair play, I generally style up the tweets manually anyway so I\'ve included a CSS Template for you to copy and paste into your theme\'s stylesheet (usually style.css in the main theme directory) and you can then amend the Twitter Feed to your liking with Custom CSS... Enjoy :)','digicution-simple-twitter-feed'); ?><br/><br/>
												<?php _e('Simply click the button below to download.','digicution-simple-twitter-feed'); ?><br/><br/><br/>
												<a class="button-primary dtbutton" href="<?php echo plugins_url('digicution-simple-twitter-feed/css/dt-twitter-template.css'); ?>" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Download CSS Template','digicution-simple-twitter-feed'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</a><br/><br/>
												</div>
												
												<?php /*
												<br/><hr/><br/>
												
												<pre>												
												/* ------------------------------------------------------------ */
												/*            Digicution Simple Twitter CSS Template            */
												/* ------------------------------------------------------------ */
												
												/* Twitter Header Container 
												div.dt-twitter-header										{   }
												
												/* Twitter Follow Button 
												a.twitter-follow-button										{   }
												
												/* Header Follow Link (Not Button) 
												a.dt-twitter-header-follow									{   }
												
												/* Twitter UL Container 
												ul.dt-twitter												{   }
												
												/* Twitter LI Items (Single Tweets) 
												ul.dt-twitter li											{   }
												ul.dt-twitter li.first										{   }
												ul.dt-twitter li.post_even									{   }
												ul.dt-twitter li.last										{   }
												ul.dt-twitter li.last_even									{   }
												
												/* Tweet Avatar Link & Img Styling 
												a.dt-twitter-avatar-link 									{   }
												img.dt-twitter-avatar										{   }
												
												/* Tweet Wrapper 
												span.dt-twitter-tweet										{   }
												
												/* Tweet Styling 
												div.dt-twitter-fullname a									{   }
												div.dt-twitter-screenname a									{   }
												div.dt-twitter-readdate a									{   }
												div.dt-twitter-tweetbody									{   }
												div.dt-twitter-tweetbody a									{   }
												
												/* Tweet End Container & Action Buttons 
												div.dt-twitter-end-container								{   }
												div.dt-twitter-end-container a.dt-twitter-button-expand		{   }
												div.dt-twitter-end-container a.dt-twitter-button-favourite	{   }
												div.dt-twitter-end-container a.dt-twitter-button-retweet	{   }
												div.dt-twitter-end-container a.dt-twitter-button-reply		{   }
												
												/* Ending Text Container (After Tweet List & Only 4 Txt) 
												div.dt-twitter-p-container									{   }
												
												/* Bottom Text Follow Link 
												a.dt-twitter-button											{   }	
												</pre>
												
												*/
												?>
												
											</div>
											
										</fieldset>
									</div>
																																						
								</div>	
								
							</div>	
							
							
							<div <?php if ($tab=="integrate") {?>style="display: block;"<?php } else { ?>style="display: none;"<?php } ?> class="setting-right-section" id="setting-integrate">
														
								<div class="dt-setting">
																		
									<div class="dt-setting">	
										<fieldset class="rounded">
										<legend><?php _e('How To Integrate','digicution-simple-twitter-feed'); ?></legend>
	
											<div class="dt-setting type-text" id="setting_site_title">
												
												<div class="bottomgap">
												<?php _e('So, you\'ve configured your Twitter App, sorted your settings and styled up your tweets...  So, how do you actually go about displaying them?  Well, there are three options :','digicution-simple-twitter-feed'); ?>
												<br/><br/><br/><h3><?php _e('1. Drag & Drop Widget','digicution-simple-twitter-feed'); ?></h3><br/>
												<?php _e('If your current theme has widget areas available, you can head to ','digicution-simple-twitter-feed'); ?><a href="<?php echo get_admin_url(); ?>widgets.php"><strong><?php _e('Appearance -> Widgets','digicution-simple-twitter-feed'); ?></strong></a><?php _e(' and simply Drag the ','digicution-simple-twitter-feed'); ?><strong><?php _e('"Digicution Twitter"','digicution-simple-twitter-feed'); ?></strong><?php _e(' widget into the widget area where you want your tweets to appear.','digicution-simple-twitter-feed'); ?>
												<br/><br/><br/><h3><?php _e('2. Use The Shortcode','digicution-simple-twitter-feed'); ?></h3><br/>
												<?php _e('You can drop the Twitter Widget into any standard Wordpress Post or Page simply by pasting the shortcode below into the content section of the post/page:','digicution-simple-twitter-feed'); ?><br/><br/><strong>[dt_twitter]</strong>
												<br/><br/><br/><h3><?php _e('3. Drop The Function In Manually','digicution-simple-twitter-feed'); ?></h3><br/>
												<?php _e('Or, for the more versed in theme customisation, you can simply drop the PHP function directly into your theme files where you want the Twitter Feed to appear.  To do this, simply copy and paste the code below into your theme where you want the Feed to appear:','digicution-simple-twitter-feed'); ?><br/><br/><strong>&lt;?php dt_twitter(); ?&gt;</strong>												
												</div>
												
											</div>
											
										</fieldset>
									</div>
																																						
								</div>	
								
							</div>	
							
							<?php //End Tabbed Content ?>
														
									
							<br class="clearer" />	
								
						</div>
							
					<br class="clearer" />
					
				</div>
			
			</div>
						
			<br class="clearer" />
						
		</div>
								
		<p id="dt-trademark"><em><?php _e('Created By Dan Perkins @ Digicution','digicution-simple-twitter-feed'); ?></em></p>
					
	</div><!-- End Admin Area -->

</div><!-- End Wrapper -->

<div class="clearer"></div>

<?php 
//End Digicution Twitter Admin Function
} 
?>