/*//////////////////////////////////////////////////////
//////  Digicution Simple Twitter Feed Admin JS  ///////
//////////////////////////////////////////////////////*/

//Define No Conflict dtjq Variable
dtjq = jQuery.noConflict();

//On Load - Fire The Digicution Twitter dtjq Functions
dtjq(document).ready(function() { 
		
		
	//Left Menu Tabs
	dtjq('#dt-admin-form-container .left-area li a').live('click',function(e) { var relAttr = dtjq(this).attr("rel"); dtjq(".setting-right-section").hide(); dtjq("#setting-"+relAttr).show(); dtjq('#dt-admin-form-container .left-area li a').removeClass('active'); dtjq(this).addClass('active'); e.preventDefault(); });
				
	//Initialise MiniColors Plugin
	dtjq.minicolors.init();
	
	//After Initialistation - Reloop Through The Inputs
	dtjq('INPUT[type=minicolors]').each( function() {
	
		//If Disabled - Add No BG Value
		if (dtjq(this).is(':disabled')) { dtjq(this).val('None'); }
		
	//End Disabled Input Values Function
	});
	
	
	//Color Disabler - When Color Disabler Select Option Is Changed
	dtjq('.colorselector').change(function() {
		
		//Get Our rel Variable (Which Corresponds With The ID Of The Input)
		var hitme='#'+dtjq(this).attr('rel');
		
		//Get Our Swatch Span
		var swatch=dtjq(this).prev('.minicolors').find('.minicolors-swatch');
		
		//If Selector Value Is 1 (Enabled)
		if (dtjq(this).val()==1) { 
		
			//Unset Input As Disabled
			dtjq(hitme).prop('disabled',false); 
						
			//Tell User To Choose A Colour
			dtjq(hitme).val('Choose Colour'); 
			
			//Re-Initialise MiniColors Plugin To Update
			dtjq.minicolors.init(); 
		
		//Otherwise Selector Value Is 0 (Disabled)	
		} else { 
		
			//Set Input As Disabled
			dtjq(hitme).prop('disabled',true);

			//Blank Swatch BG				
			swatch.find('SPAN').css({
				backgroundColor: 'none',
				background: 'url(jquery.minicolors.png) -80px 0'
			});

			//Tell User We Have No BG Color Selected
			dtjq(hitme).val('None');
			
			//Re-Initialise MiniColors Plugin To Update
			dtjq.minicolors.init(); 
		
		//End If Selector				
		}
	
	//End Color Disabler Function	
	});
	
	
	
		
	//REMOVED - Using CSS Media Queries To Handle
	//Resize Header Function
	/*function dt_header_resize() {
		
		//Get Viewport Width
		var viewportWidth=dtjq(window).width();
		
		//Define Resizable Header Divs
		var head=dtjq('h2.dt_header');
		var bug=dtjq('.request');
	
		//If Width Less Than 985px
		if (viewportWidth < 985) {
			
			//Change Header Size
			head.css('height','65px');
			
			//Refloat Feature Request Div
			bug.css('float','none');
		
		//Otherwise - Write Original CSS	
		} else {
			
			//Change Header Size
			head.css('height','35px');
			
			//Refloat Feature Request Div
			bug.css('float','right');
			bug.css('display','inline-block');
			
		//End Width If	
		}
	
	//End Resize Header Function
	}*/
	
	
	//Run Header Resize On Load
	//dt_header_resize();

	//On Window Resize (Reverted To Stock JS As jQuery Conflicts With WooCommerce)
	//window.onresize = function() { dt_header_resize(); }
	
	
	
	
	//Only Allow Numeric Input Function	
	dtjq('.numberinput').keydown(function(event) {
	
        //Allow: backspace, delete, tab, escape, and enter
        if (event.keyCode==46 || event.keyCode==8 || event.keyCode==9 || event.keyCode==27 || event.keyCode==13 || 
        
            //Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
             
            //Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            
            //Let it happen, don't do anything
            return;
            
        }
        
        //Otherwise
        else {
        
            //Ensure that it is a number otherwise stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) { event.preventDefault(); }   
            
        }
       
    //End Numbers Only Function
    });	
        
});