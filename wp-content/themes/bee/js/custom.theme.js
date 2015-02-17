jQuery(document).ready(function() {
	
	var 
	_win      = jQuery(window),
	_nav      = jQuery('#header_wrap').find('nav'),
	_megaUber = jQuery('#megaUber');
	
	//Footer contact form widget verify box Show and hide	
	if( jQuery('#footer_wrap').find('.verify-wrap').length ) {
	
		jQuery('#footer_wrap').find('.contact_form').hover(function (){
			
			jQuery(this).find('.verify-wrap').slideDown(300);
																	 
		},function(){
			
			jQuery(this).find('.verify-wrap').slideUp(300);
		
		});
	
	}
	
	//Cal topbar-transparent right space
	if(jQuery("#backtop").length > 0) {
		
		jQuery(function () {
			   _win.scroll(function(){
					if (_win.scrollTop()>100){
						 jQuery("#backtop").fadeIn(300);
					}else{
						 jQuery("#backtop").fadeOut(100);
					}
			   });
			   jQuery("#backtop").click(function(){
					jQuery('body,html').animate({scrollTop:0},500);
					return false;
			   });
		});
	}

	//layout a: position header socialicons
	if(jQuery('.header-layout-a').length){

		if(_win.width() < 1200){
			jQuery('#headerinn_s').appendTo(jQuery('#top_bar>div'));
		}else{
			jQuery('#headerinn_s').appendTo(jQuery('#headerinn_main'));
		}
	
		_win.resize(function(){
			if(_win.width() < 1200){
				jQuery('#headerinn_s').appendTo(jQuery('#top_bar>div'));
			}else{
				jQuery('#headerinn_s').appendTo(jQuery('#headerinn_main'));
			}
		})
	}

	//megabber wp plugin
	if(_megaUber.length){
		
		_nav.attr({id:'mega-uber', 'class':''});

	}else{
		
		//submenu();
	}
	
	_nav.fadeIn(400);
	
	//Theme: Sub Menu	
	function submenu(){
		var $menuunit = jQuery(".no-touch").find("#navi ul li");
		
		var wait6 = false;	
		
		$menuunit.click(function () {
								  
			jQuery(this).children('ul.sub-menu').toggleClass('hover');
			
		}).hover(function () {	
		
			var $this1thang = jQuery(this);
			wait6 = setTimeout(function () {	
				$this1thang.children('ul.sub-menu').slideDown(300);	
				
			}, 100);		
			
		},function(){
			
			jQuery(this).children('ul.sub-menu').fadeOut(100).slideUp(0);
			if (wait6) clearTimeout(wait6);
			
		});
	}
	//Theme: Share icons
	function popitup_theme(url) {
		
		var height = 400;
		var width = 500;
		var left = (screen.width/2)-(width/2);
		var top = (screen.height/2)-(height/2);
		var options = "height="+height+",width="+width+",top="+top+", left="+left;
		newwindow=window.open(url,'title',options);
		if (window.focus) {newwindow.focus()}
		return false;
	}
	
	function ajax_count_theme(url, page_title, featured_image_url){
		jQuery.ajax({
			dataType: "json",
			url: "http://graph.facebook.com/?id=" + url
			}).done(function(data) {
			jQuery('.post-meta-social a.postshareicon-facebook-wrap .count').html(data.shares);
		});
		
		jQuery.ajax({
			dataType: "json",
			url: "http://cdn.api.twitter.com/1/urls/count.json?url=" + url +'&&callback=?'
			}).done(function(data) {
			jQuery('.post-meta-social a.postshareicon-twitter-wrap .count').html(data.count);
		});
	
		jQuery.ajax({
			crossDomain: true,
			dataType: "jsonp",
			url: "http://api.pinterest.com/v1/urls/count.json?&url="+url
			}).done(function(data) {
			jQuery('.post-meta-social a.postshareicon-pinterest-wrap .count').html(data.count);
		});
	}
	
	function ux_post_social_theme(){
		if( jQuery('.post-meta-social').length > 0 ) {
			jQuery('.post-meta-social').each(function(index, element) {
				var url = jQuery(this).find('input[name="url"]').val();
				var page_title = jQuery(this).find('input[name="title"]').val();
				var featured_image_url = jQuery(this).find('input[name="media"]').val();
				
				var facebook_share = jQuery(this).find('a.postshareicon-facebook-wrap');
				var twitter_share = jQuery(this).find('a.postshareicon-twitter-wrap');
				var pinterest_share = jQuery(this).find('a.postshareicon-pinterest-wrap');
				
				facebook_share.click(function(){
					popitup_theme('http://www.facebook.com/sharer.php?u='+url);													   
				});
				
				twitter_share.click(function(){
					popitup_theme('http://twitter.com/share?text='+page_title+'&url='+url);													   
				});
				
				pinterest_share.click(function(){
					popitup_theme('http://pinterest.com/pin/create/button/?url='+url+'&media='+featured_image_url+'&description='+page_title);													   
				});
				
				ajax_count_theme(url, page_title, featured_image_url);
			});
		}
	}
	ux_post_social_theme();
	
	//Theme: Comment login info postion
	if(jQuery('#respond').length>0){
		
		jQuery('#respond').find('.logged').appendTo('#reply-title').animate({ opacity: 1 }, 200 );
		
	}
	
	//Theme: H1 title Margin-right 
	function title_mRight(){
		
		var 
		main_title        = jQuery('#main_title'),
		main_title_mRight = main_title.siblings('.breadcrumbs').width();
		
			main_title.css('margin-right',main_title_mRight+'px');
			
	}
	
	if( jQuery('#main_title').length > 0 ){
		
		title_mRight();
		_win.on("debouncedresize", title_mRight);
	}

	
	// Theme: Responsive Mobile Menu 
	 function ux_responsive_menu(){
		 
        var header = jQuery('#header_wrap');

        if(!header.length) return;

        if(_megaUber.length){
		 	var menu = header.find('ul#megaUber');
		}else{
			var menu = header.find('#navi ul.menu');
		}
		
        var first_level_items     = menu.find('>li').length;
			 
			 if( first_level_items > 7 ){
			 
			 	var switchWidth = 979;
			 }else{
             	var switchWidth = 767;
			 }
         
              var container          = jQuery('#wrap'),
                   show_menu          = jQuery('<a id="advanced_menu_toggle" href="#"><i class="m-menu"></i></a>'),
                   hide_menu          = jQuery('<a id="advanced_menu_hide" href="#"><i class="m-close-circle"></i></a>'),
				   show_meta		 = jQuery('<a id="advanced_menu_toggle2" href="#"><i class="m-grid"></i></a>'),
                   mobile_advanced = menu.clone().attr({id:"mobile-advanced", "class":""}),
				   mobile_meta_advanced = jQuery('#mobile-header-meta'),
                   menu_added           = false,
				   meta_added			= false;

                   show_menu.click(function(){
											
                        if(container.is('.show_mobile_menu')){
							
                             container.removeClass('show_mobile_menu');
                             container.css({'height':"auto"});
							 
                       
					   }else{
                             container.addClass('show_mobile_menu');
							 //mobile_advanced.css({'display':"block"});
                             set_height();
							 
                        }
                        return false;
                   });

					show_meta.click(function(){
											
                        if(container.is('.show_mobile_meta')){
							
                             container.removeClass('show_mobile_meta');
                             container.css({'height':"auto"});
                       
					   }else{
                             container.addClass('show_mobile_meta');
                             set_height2();
                        }
                        return false;
                   });

                   hide_menu.click(function(){
											
                        container.removeClass('show_mobile_menu');
						container.removeClass('show_mobile_meta');
						//mobile_advanced.css({'display':"none"});
                        container.css({'height':"auto"});
                        return false;
                   });


                   var set_visibility = function(){
					   
                        if(_win.width() > switchWidth){
							
                             header.removeClass('mobile_active');
                             container.removeClass('show_mobile_menu');
                             container.css({'height':"auto"});
							 
                        }else{
                             header.addClass('mobile_active');
                             if(!menu_added){

                                  var after_menu = jQuery('#logo');
                                  show_menu.insertAfter(after_menu);
								 
                                  mobile_advanced.prependTo(container);
                                  hide_menu.prependTo(container);
                                  menu_added = true;
                             }
							 
							 if(!meta_added){
								   var after_menu = jQuery('#logo');
								    show_meta.insertAfter(after_menu);
									hide_menu.prependTo(container);
									meta_added = true;
							 }
							 
							 
                             if(container.is('.show_mobile_menu')){
                                  set_height();
                             }
							 
							  if(container.is('.show_mobile_meta')){
                                  set_height2();
                             }
                        }
                   },

                   set_height = function() {
					   mobile_advanced.find('ul').show().css('left','0');
					   mobile_advanced.find('li').css('left','0');
					   mobile_advanced.find('.uber-close').hide();
					   
                        var height = mobile_advanced.css({position:'relative'}).outerHeight(true),
                             win_h  = _win.height();

                        if(height < win_h) height = win_h;
                        mobile_advanced.css({position:'absolute'});
                        container.css({'height':height});
                   };
				   
				   set_height2 = function() {
                        var height = mobile_meta_advanced.css({position:'relative'}).outerHeight(true),
                             win_h  = _win.height();

                        if(height < win_h) height = win_h;
                        mobile_meta_advanced.css({position:'absolute'});
                        container.css({'height':height});
                   };

                   _win.on("debouncedresize", set_visibility);
                   set_visibility();
         
    }
	
	ux_responsive_menu();
	
	
	//Theme: Fixed Menu
	function ux_fixed_menu(){
	
			var 
			header         = jQuery('#header_wrap'),
			container      = jQuery('#wrap'),
			fixed_menu_wrap= jQuery('#topbarfixed'),
			menu           = header.find('#navi ul.menu'),
			menu_fixed     = menu.clone().attr({id:"fixed-menu", "class":"fixed-menu-class"}),
			menu_item      = menu_fixed.find('li');
			
			
			menu_fixed.prependTo(fixed_menu_wrap);
			
			_win.scroll(function(){
				if (_win.scrollTop()>200){
					fixed_menu_wrap.addClass('shown');
				}else{
					fixed_menu_wrap.removeClass('shown');
				}
			});
			/*
			menu_item.hover(function () {
				
				jQuery(this).children('ul').addClass('shown');
				
			},function(){
				
				jQuery(this).children('ul').removeClass('shown');
				
				})
			 */
	
	}
	if( jQuery('.no-touch').length > 0 && jQuery('#topbarfixed').hasClass("topbarfixed-yes")) {
		ux_fixed_menu();
	}
	
	//Theme & Build:  Contact Form Verification and Ajax Send
	
	if(jQuery('.contact_form').length>0) {
		
		jQuery('.contact_form').each(function(){
											  
											  
			function randomgen(){
				
    			
				var rannumber='';
				
				for(ranNum=1; ranNum<=6; ranNum++){
					rannumber+=Math.floor(Math.random()*10).toString();
				}
				
				jQuery('.verifyNum').html(rannumber);
				jQuery('.verifyNumHidden').val(rannumber);
			}
			
			randomgen();
			
			
			var 
			_this    = jQuery(this),
			message  = _this.find('input[type="hidden"].info-tip').data('message'),
			sending  = _this.find('input[type="hidden"].info-tip').data('sending'),
			errortip = _this.find('input[type="hidden"].info-tip').data('error');								  
			
			_this.submit(function() {
			
				var hasError = false;
				
				_this.find('.requiredField').each(function() {
				
					if(jQuery.trim(jQuery(this).val()) == '' || jQuery.trim(jQuery(this).val()) == 'Name*' || jQuery.trim(jQuery(this).val()) == 'Email*' || jQuery.trim(jQuery(this).val()) == 'Required' || jQuery.trim(jQuery(this).val()) == 'Invalid email') {
					
						jQuery(this).attr("value","Required");
						
						hasError = true;
						
					}else if(jQuery(this).hasClass('email')) {
	
					
						var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
						
						if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
						
							jQuery(this).attr("value","Invalid email");
							
							hasError = true;
							
						}
							
					}else if(jQuery(this).hasClass('Verify')) {	
					
						if( _this.find('.Verify').val() != _this.find('.verifyNumHidden').val() ) {
							
							hasError = true;
							alert(errortip);
							randomgen();
							_this.find('.Verify').select();
							_this.find('.Verify').focus();
							return false;
						}
						
					}else{
					
					}
				});
				//After verification, print some infos. 
				if(!hasError) {
										
					if(_this.hasClass('single-feild')){
						
						_this.find('#idi_send').val(sending).attr('disabled','disabled');
					
					}else{	
					
						jQuery(this).find('#idi_send').fadeOut('normal', function() {
							
							jQuery(this).parent().append('<p class="sending">'+sending+'</p>');
							
						});
					}
					var formInput = _this.serialize();
					
					jQuery.post(_this.attr('action'),formInput, function(data){
																				
						_this.slideUp("fast", function() {
							
							if(_this.hasClass('single-feild')){
								
								_this.before('<p class="success" style=" text-align:center">'+message+'</p>');
							
							}else{
								_this.before('<p class="success">'+message+'</p>');
								
								_this.find('.sending').fadeOut();
							
							}
						});
					});
				}
				
				return false;
		
			});
			
		});//End each
		
	}//endif

	//Theme: Call Header Social Iocns HoverDir
	jQuery('#header_wrap').find('.social_active').hoverdir({});	
		
	
	
	//Theme: Remove inline-block margin space in Fixed menu
	if( jQuery('#fixed-menu').length > 0 ) {
		jQuery('#fixed-menu').contents().filter(function() {
			return this.nodeType === 3;
		}).remove();
	}
	if( jQuery('#navi').length > 0 ) {
		jQuery('#navi').find('ul').contents().filter(function() {
			return this.nodeType === 3;
		}).remove();
		
		if( (jQuery.browser.msie == true && parseInt(jQuery.browser.version) < 9) ) {}else{
			jQuery('#navi>div>ul>li').css('margin-left','0')
		}
		
	}
	
	if( Modernizr.touch ) {
		
		//Theme: Touch device Sub-Menu click friendly 
		jQuery( '#navi li:has(ul)' ).doubleTapToGo();
		
	}
	
	//BBpress: Remove first bbp-pagination
	if (jQuery('.bbp-pagination').length) {
    	jQuery('.bbp-pagination').eq(1).fadeIn(200);
	}
	
	//BBpress: breadcrumb position
	if (jQuery('.bbp-breadcrumb').length) {
		jQuery('.bbp-breadcrumb').appendTo('.main_title').css('display','block').addClass('pull-right').addClass('visible-desktop');
	}

	//Fadein load page
	jQuery('#header_wrap').animate({opacity: 1}, 800, function(){
	
		jQuery('#main').imagesLoaded(function(){
			jQuery('#main').animate({opacity: 1}, 800);
		});
		
		if(jQuery('#sidebar').length){
			jQuery('#sidebar').imagesLoaded(function(){
				jQuery('#sidebar').animate({opacity: 1}, 800);
			});
		}
	
		jQuery('#footer_wrap').animate({opacity: 1}, 800);
		
	});
});