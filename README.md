=== Digicution Simple Twitter Feed ===
Contributors: digicution
Donate link: http://www.digicution.com/
Tags: twitter,feed,tweet,simple,list,display,digicution
Requires at least: 3.1
Tested up to: 3.9
Stable tag: 1.4.2.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin provides a simple list of Tweets from a users screen name for usage within your Wordpress Blog or Template.


== Description ==

* Brand New Wordpress 3.8 Responsive Interface Design - Fully Backwards Compatible With Earlier Wordpress Releases.

This plugin provides a simple list of Tweets from a users screen name for usage within your Wordpress Blog or Template.  

Since Twitter implemented it’s new API (v1.1) in June 2013, a lot of old Wordpress Twitter feed plugins stopped working.  I received quite a few requests to from various devs and designers to create new Twitter feeds and the majority of these that I built used the same or a similar framework.

I still get quite a few requests for updates on these feeds and rather than emailing the new version over to them to install, I figured I’d compile all the options and get it up on the Wordpress repo so I could push updates directly to the Wordpress installations and standardize the installs :)

It’s a pretty simple plugin but hopefully, it should help anyone out there who simply wants a decent Twitter feed on their Wordpress site.

The ‘Digicution Simple Twitter Feed’ plugin includes a linking system to hook up your Twitter App with your Wordpress Blog or Template, 3 methods of integration: Widget, Shortcode & Direct PHP Function and a large number of customisable options for tweet display including:

* Correct parsing of @username, #hashtag & URLs into links
* Number of tweets to display at a time
* Twitter update frequency (how often to check Twitter, to comply with API Rate Limiting)
* Show / hide re-tweets
* Show follow links / buttons
* Display full name option
* Display screen name option
* Display Tweet date option
* Display Expand Tweet option
* Display Reply to Tweet option
* Display Re-Tweet option
* Display Favourite option
* Profile image display
* Profile image size & margins
* Tweet text padding & margins
* Tweet background colours / customisable for odd and even alternate colours
* Tweet text colour
* Tweet link colour
* Tweet font size
* Container width, background colour, padding & margins

I’ve used it on around 20 sites so far and it seems to be working very well. However, if anyone finds any issues or bugs with the plugin, please let me know and I will endeavor to get them fixed as soon as I possibly can.  There are thousands of unique Wordpress installs out there and it is impossible for me to be able to test them all so, if you do find an issue, please report it at http://www.digicution.com/contact/ 

The plugin *REQUIRES* PHP's cURL function to be installed and available.  If you're unsure, please install the plugin and the diagnostics will let you know if you are able to use it or not.

PHP's mcrypt library is also recommended but not essential.

Serbian Translation courtesy of Borisa Djuraskovic from http://www.webhostinghub.com


== Installation ==

1. Upload the folder 'digicution-simple-twitter-feed' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create your Twitter Application at https://dev.twitter.com/ and create a set of API Keys for your application.
4. Add the Access Token, Access Token Secret, Consumer Key & Consumer Secret to Main Page of 'Simple Twitter' Options Page
5. Ensure you change the Twitter Username value from 'digicution' to your Twitter Username to display your Tweets!
6. Configure display options in 'Simple Twitter' Options Page
7. Implement the plugin using either Widget, Shortcode or PHP Function method :
8. Drag & Drop Widget - If your current theme has widget areas available, you can head to Appearance -> Widgets and simply Drag the "Digicution Twitter" widget into the widget area where you want your tweets to appear.
9. Use The Shortcode - You can drop the Twitter Widget into any standard Wordpress Post or Page simply by pasting the shortcode below into the content section of the post/page: [dt_twitter]
10. Drop The Function In Manually - Or, for the more versed in theme customisation, you can simply drop the PHP function directly into your theme files where you want the Twitter Feed to appear. To do this, simply copy and paste the code below into your theme where you want the Feed to appear: `<?php dt_twitter(); ?>`
11. Congrats, You've just added the Twitter Feed to your website :)


== Frequently Asked Questions ==

= What’s this Twitter App shenanigans?  How do I create a Twitter App? =

1.  Head to https://dev.twitter.com/
2.  Login
3.  In the top right, click on your avatar and click on "My Applications"
4.  Click "Create A New Application"
5.  Fill in the application details on this page and click "Create your Twitter application"
6.  Now, it'll take a minute or two but you should then be able to access your app from the avatar in the top right -> "My Applications"
7.  When you click on your app on this page, it will give you all sorts of info on the page.  The bits you need are: Access Token, Access Token Secret, Consumer Key, Consumer Secret

= I have the correct access tokens and consumer keys but my feed displays Tweets from a completely different user plus they seem to be static Tweets and don't update. Is there something I need to do to make this work? =

You've probably still got the default user setup (should be tweets from me :).

1.  Go into your Wordpress admin
2.  Click on the "Simple Twitter" option in the admin menu
3.  Click on General Settings at the top
4.  Change Twitter Username to the twitter user's tweets you want to display
5.  Change Twitter Update Frequency for quicker updates (default is update once an hour)
6.  Scroll down to the bottom & click "Update Options"

Once you've done this, you should be golden :)

= My Tweets aren't showing?  What's going on? =

OK, Double check... No, triple check that you have the correct Access Token, Access Token Secret, Consumer Key & Consumer Secret from your Twitter App entered correctly in the main app setup screen.  If you're sure you've done this and you're still hvaing issues, please drop me an email via http://www.digicution.com/contact and I'll get back to you asap.

= My Tweets are showing but they aren't mine?  Eh? =

Please make sure that you have added YOUR Twitter Username into the Twitter Username option on the General Settings page.

= My Tweet Follow Buttons are not showing, only the link text is being displayed? =

This means that the app cannot reach Twitter's API server from your client machine.  Double check you haven't got any apps that are blocking access.  One that has been found to do so is the Avast Anti Virus Browser Plugin.  There is a setting within the Avast plugin titled "Block social networks by default".  Disable this and you should be golden.  Unfortunately, this is a client side restriction so there's nothing that can be done about it at present - this would be the same if you were to use Twitter's native Follow button :(

= I have a question, bug or feature request...  Where can I submit it? =

No problemo, just head to http://www.digicution.com/contact/ and submit the contact form with your question/bug/request - I'll get back to you as soon as I possibly can :)


== Screenshots ==

1. Tweet Appearance Menu (New Layout)
2. General Settings Menu (Mobile Layout Example)
3. Widget Appearance
4. Example 1
5. Example 2
6. Example 3


== Changelog ==

= 1.4.2.8 =
* Fixed 'line-height' bug if Tweet Font Size set to 'ems'.  Thanks to Ian Clarke for highlighting the issue.
* Added @Screenname option to Follow Buttons (Header & Footer).  Extra request from Ian Clarke.

= 1.4.2.7 =
* Changed Tweet ID to use ‘id_str’ instead as original number could cause erronous input on some PHP installations.

= 1.4.2.6 =
* Changed Tweet UTC datetime difference calculation to work outside of Wordpress date functions to create correct difference across timezones.  Thanks to Maciek Nowakiewicz for highlighting the issue.

= 1.4.2.5 =
* Changed Tweet refresh UTC date storage in DB to that of Wordpress Installation rather than the MySQL Server as the 2 server setups could be in different timezones.  Thanks to Maciek Nowakiewicz for highlighting the issue.

= 1.4.2.4 =
* Amended order of Twitter Key Entries to match those on dev.twitter.com and renamed Consumer to API for easier entry (and less confusing for user).  Thanks to Jesse Everett for pointing out the issue.

= 1.4.2.3 =
* Fixed minor bug so plugin now outputs the correct CSS if using Twitter Icons (& Automatic Styling) within the plugin.  Thanks to Rajat Soni for pointing out the issue.  
* Also removed some extra redundant code and renamed the CSS output function to something more unique to help avoid duplication errors.

= 1.4.2.2 =
* Fixed Minor Display Bug When "Display Follow Link In Header" was set to "Text Link".

= 1.4.2.1 =
* Removed 2 redundant header functions that may have caused duplication error messages in some setups.

= 1.4.2 =
* Fixed bug with shortcode where it would display above content if placed within a page or post.  This was due to the content being printed rather than returned.  Thanks to Michael Entwistle for pointing out the issue.
* Serbian Translation added to the plugin.  Thanks to Borisa Djuraskovic from http://www.webhostinghub.com for providing the Serbian translation.

= 1.4.1 =
* Added language files (.mo & .po) for easier translation purposes.  If you fancy translating this plugin, there is a template file now in the languages folder which should enable you to use POEdit to translate.  Please feel free to translate and submit your .po files for inclusion in the plugin :)
* Update Menu Logo SVG Colour 

= 1.4 =
* Added SVG Icons For Tweet Reply, Retweet, Favourite & Expand (Request From Rajat Soni)
* Added Customisation Options For Above Icons
* Standardised Output For Text Versions Of Tweet Reply, Retweet, Favourite & Expand
* Fixed Bug With Tweet Font Size In Ems
* Added Support For Twitter's UTC Offset - Now Displays Correct Tweet Dates Worldwide (Request From Rajat Soni)

= 1.3 =
* Added SVG Menu & Header Icons For Wordpress 3.8 Support
* Added Responsive Design For Easy Use On Mobile / Tablet
* Changed Interface Design For Backend To Work Smoother With Responsive & Wordpress 3.8 Design
* Fixed Random Character Bug on Main Page
* Added Version Checking For Menu Icons (Backwards Compatibility)
* Added Extra Description's On Option Page Headers To Assist Users As To What Each Page Does (Request)

= 1.2 =
* Fixed JS Bug In admin.js

= 1.1 =
* Added Universal Language Support
* Added Support For Twitter Profile Image Border Radius
* Added Support For Main Container Border Radius
* Added Support For Tweet Container Border Radius
* Fixed Manual CSS Template URL
* Fixed Non Updating Margin & Padding Measurement Units For Single Tweet
* Fixed Styling Multi-Unit Bug
* Changed Container Padding Settings To Make Styling Easier (& Universal)

= 1.0 =
* First version of the plugin.


== Upgrade Notice ==

= 1.4 =
Upgrade For SVG Tweet Icon Support & Native Twitter UTC Date Support

= 1.3 =
Upgrade For Wordpress 3.8 & Mobile Device Support With A Shiny New Interface :)

= 1.2 =
Upgrade For JS Fix

= 1.1 =
Upgrade For Bugfixes, Added Border Radius Support On Twitter Profile Images & Universal Language Support