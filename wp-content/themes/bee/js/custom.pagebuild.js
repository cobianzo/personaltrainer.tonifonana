jQuery(document).ready(function() {
	
	
	var _win = jQuery(window);
	

	
	//Pagebuild:  Separator 
	jQuery('.separator').each(function(){
	
		var title_width = jQuery(this).find('h4').outerWidth();
	
		if(jQuery(this).hasClass('title_on_left')){
			
			jQuery(this).find('.separator_inn').css({'margin-left':title_width+'px'});
		
		}else if(jQuery(this).hasClass('title_on_right')){
			
			jQuery(this).find('.separator_inn').css({'margin-right':title_width+'px'});
		}
		
		jQuery(this).animate({ opacity:'1'},200);
	})
	
	//Pagebuild: Remove the Margin-bottom in Blank-divider Moudle 
	jQuery('.moudle:has(.blank-divider)').css('margin-bottom','0');
	
	
	//Pagebuild: Standard Blog Moulde responsive
	function ux_standard_blog_responsive() {
		
		jQuery('.blog-wrap').each(function(){
										   
			var blog_width = jQuery(this).width();
			
			if ( blog_width < 759) {
				
				if( jQuery(window).width() > 767 ){
					jQuery(this).find('.blog-item-main').removeClass('blog-item-main-clear-mobile');
				}else {
					jQuery(this).find('.blog-item-main').addClass('blog-item-main-clear-mobile');
				}
			}else{
				
				jQuery(this).find('.blog-item-main').removeClass('blog-item-main-clear-mobile');
			}
		
		});	

								   
	}
	
	if( jQuery('.blog-wrap').length > 0 ) {
		ux_standard_blog_responsive();
		_win.on("debouncedresize", ux_standard_blog_responsive);
	}
	
	//Pagebuild: Message Box Moudle	Close						
	jQuery('.message-box').each(function(){
		jQuery(this).find('.box-close').click(function(){
			jQuery(this).parent('.message-box').slideUp(400);
		
		});
	});	
	
	//Pagebuild: Call Carousel Slider, Content slider responsive
	function ux_content_slider_responsive(){
		
		jQuery('.listitem_slider').each(function(){
			
			var slider_width = jQuery(this).width();
			var slider_img_height = slider_width*0.57;
			var slider_title = jQuery(this).find('.slider-title').height();
			var slider_des = jQuery(this).find('.slider-des').height();
			var slider_panel_height =  slider_title + slider_des;
			
			
			if (slider_width < 561) {
				
				//jQuery(this).css({'height':slider_height});
				jQuery(this).find('.item').css({'height':'auto'});
				jQuery(this).find('.carousel-img-wrap').css({'height':slider_img_height,'width':'100%','float':'none'});
				jQuery(this).find('.slider-panel').css({'width':'100%','float':'none','height':'400px'});
				jQuery(this).find('img').css({'width':'100%','height':'auto'});
				jQuery(this).find('.carousel-indicators').css({'width':'100%'});
				jQuery(this).find('h2.slider-title').css({'font-size':'18px','line-height':'20px'});
				
			
				
			} else if ( slider_width > 562 &&  slider_width < 725) {
				
				jQuery(this).find('.item').css({'height':'400px'});
				jQuery(this).find('.carousel-img-wrap').css({'height':'400px','width':'60%','float':'left'});
				jQuery(this).find('.slider-panel').css({'width':'40%','float':'left','height':'400px'});
				jQuery(this).find('img').css({'width':'auto','height':'100%'});
				jQuery(this).find('.carousel-indicators').css({'width':'40%'});
				jQuery(this).find('h2.slider-title').css({'font-size':'18px','line-height':'20px'});
				/*
				jQuery(this).find('.item').css({'height':'400px'});
				jQuery(this).find('.carousel-img-wrap').css({'height':'400px','width':'60%','float':'left'});
				jQuery(this).find('.slider-panel').css({'width':'40%','float':'left','height':'400px'});
				jQuery(this).find('img').css({'width':'auto','height':'400px'});
				jQuery(this).find('.carousel-indicators').css({'width':'40%'});
				jQuery(this).find('h2.slider-title').css({'font-size':'18px','line-height':'20px'});*/
				
			} else {
				jQuery(this).find('.item').css({'height':'400px'});
				jQuery(this).find('.carousel-img-wrap').css({'height':'400px','width':'60%','float':'left'});
				jQuery(this).find('.slider-panel').css({'width':'40%','float':'left','height':'400px'});
				jQuery(this).find('img').css({'width':'100%','height':'auto'});
				jQuery(this).find('.carousel-indicators').css({'width':'40%'});
				jQuery(this).find('h2.slider-title').css({'font-size':'30px','line-height':'40px'});
			
			}
		});	
	}
	
	if( jQuery('.listitem_slider').length > 0 ) {
		
		//jQuery('.listitem_slider').carousel();
		ux_content_slider_responsive();							   
		_win.on("debouncedresize", ux_content_slider_responsive);
	}
	
	/*jQuery('.carousel').carousel({
		  interval: 12000
		});*/
	
	//Pagebuild: AccordionToggle Moudle	Call
	
	jQuery('.accordion_toggle .collapse').collapse({
		toggle: false
	});
	
	jQuery('.accordion_toggle, .accordion').on('show', function (e) {
         jQuery(e.target).prev('.accordion-heading').find('.accordion-toggle').addClass('active');
    });

    jQuery('.accordion_toggle, .accordion').on('hide', function (e) {
        jQuery(this).find('.accordion-toggle').not(e.target).removeClass('active');
    });
	
	//Pagebuild: Tabs Moudle Call
	jQuery('.nav-tabs a').click(function (e) {
		e.preventDefault();
		jQuery(this).tab('show');
	});
	
	jQuery('.nav-tabs a').click(function (e) {
		e.preventDefault();
		jQuery(this).tab('show');
	});
	
	//Pagebuild: Tab-v responsive
	function ux_tabv_responsive(){
		
		jQuery('.tabs-v').each(function(){
			var tab_width = jQuery(this).width();	
			if(tab_width < 561){
				jQuery(this).find('.nav-tabs-v').css('width','45%');
				jQuery(this).find('.tab-content-v').css({width:'55%'});
			}else{
				jQuery(this).find('.nav-tabs-v').css('width','25%');
				jQuery(this).find('.tab-content-v').css({width:'75%'});
			}
		})
	}
	if( jQuery('.tabs-v').length > 0 ) {
		ux_tabv_responsive();
		_win.on("debouncedresize", ux_tabv_responsive);
	}
	
	
	//Pagebuild: Call Lightbox 
	if( jQuery('.lightbox').length > 0 ){
		jQuery('.lightbox').lightbox();
	}
	
	//Pagebuild:  isotope list responsive
	
	function getUnitWidth(size,container) {
		var width;
		switch(size){
			case 'medium':
				if (container.width() <= 320) {
					width = Math.floor(container.width() / 1);
				} else if (container.width() >= 321 && container.width() <= 480) {
					width = Math.floor(container.width() / 2);
				} else if (container.width() >= 481 && container.width() <= 768) {
					width = Math.floor(container.width() / 4);
				} else if (container.width() >= 769 && container.width() <= 979) {
					width = Math.floor(container.width() / 6);
				} else if (container.width() >= 980 && container.width() <= 1200) {
					width = Math.floor(container.width() / 8);
				} else if (container.width() >= 1201 && container.width() <= 1600) {
					width = Math.floor(container.width() / 8);
				} else if (container.width() >= 1601 && container.width() <= 1824) {
					width = Math.floor(container.width() / 10);
				} else if (container.width() >= 1825) {
					width = Math.floor(container.width() / 12);
				}
			break;
			
			case 'large':
				if (container.width() <= 320) {
					width = Math.floor(container.width() / 1);
				} else if (container.width() >= 321 && container.width() <= 480) {
					width = Math.floor(container.width() / 2);
				} else if (container.width() >= 481 && container.width() <= 768) {
					width = Math.floor(container.width() / 4);
				} else if (container.width() >= 769 && container.width() <= 979) {
					width = Math.floor(container.width() / 4);
				} else if (container.width() >= 980 && container.width() <= 1200) {
					width = Math.floor(container.width() / 6);
				} else if (container.width() >= 1201 && container.width() <= 1600) {
					width = Math.floor(container.width() / 8);
				} else if (container.width() >= 1601 && container.width() <= 1824) {
					width = Math.floor(container.width() / 10);
				} else if (container.width() >= 1825) {
					width = Math.floor(container.width() / 12);
				}
			break;
			
			case 'small':
				if (container.width() <= 320) {
					width = Math.floor(container.width() / 1);
				} else if (container.width() >= 321 && container.width() <= 480) {
					width = Math.floor(container.width() / 2);
				} else if (container.width() >= 481 && container.width() <= 768) {
					width = Math.floor(container.width() / 6);
				} else if (container.width() >= 769 && container.width() <= 979) {
					width = Math.floor(container.width() / 8);
				} else if (container.width() >= 980 && container.width() <= 1200) {
					width = Math.floor(container.width() / 10);
				} else if (container.width() >= 1201 && container.width() <= 1600) {
					width = Math.floor(container.width() / 10);
				} else if (container.width() >= 1601 && container.width() <= 1824) {
					width = Math.floor(container.width() / 10);
				} else if (container.width() >= 1825) {
					width = Math.floor(container.width() / 12);
				}
			break;
		}
		return width;
	}
	
	function setWidths(size,container){
		var unitWidth = getUnitWidth(size,container) - 0;
		container.children(":not(.width2)").css({
			width: unitWidth
		});
		if (container.width() >= 321 && container.width() <= 480) {
			container.children(".width2").css({
				width: unitWidth * 1
			});
			container.children(".width4").css({
				width: unitWidth * 2
			});
			container.children(".width6").css({
				width: unitWidth * 2
			});
			container.children(".width8").css({
				width: unitWidth * 3
			});
		}
		if (container.width() >= 481) {
			container.children(".width8").css({
				width: unitWidth * 8
			});
			container.children(".width6").css({
				width: unitWidth * 6
			});
			container.children(".width4").css({
				width: unitWidth * 4
			});
			container.children(".width2").css({
				width: unitWidth * 2
			});
		} else {
			container.children(".width2").css({
				width: unitWidth
			});
		}
	}
	
	//Run isotope
	
	$allcontainer = jQuery('.container-fluid.main');
	//$container = jQuery('.isotope');
	//setWidths($container.data('size'));
	
	function Call_isotope(){
		
		if(jQuery('.isotope').length > 0){
			jQuery('.isotope').each(function(index, element) {
                var _this = jQuery(this),
				    image_size = jQuery(this).data('size');
					setWidths(image_size, _this);
					
				if(_this.is('.masonry')){
					jQuery(this).isotope({
						animationEngine : 'css',
						//resizable: false,
						masonry: {
							columnWidth: getUnitWidth(image_size, _this)
						}
						
					});
				}else if(_this.is('.grid_list')){
					jQuery(this).isotope({
						layoutMode : 'fitRows',
						animationEngine : 'css',
						//resizable: false,
						masonry: {
							columnWidth: getUnitWidth(image_size, _this)
						}
					});
				}
				jQuery(this).addClass('isotope_fade');
				jQuery(this).siblings('#isotope-load').fadeOut(300);
            });
		}
	}
	
	//if(jQuery.browser.msie){
	//	Call_isotope();
	//}else{
		if(jQuery('.isotope').length > 0){
			jQuery('.isotope').each(function(index, element){
				//if( jQuery.browser.msie == true && (parseInt(jQuery.browser.version) == 10 || parseInt(jQuery.browser.version) == 11 ) ) { 	
				//	jQuery(document).load(function(){
				//		Call_isotope();
				//	});
				//} else {
					jQuery(this).imagesLoaded(function() {
						Call_isotope();
					});
				//}
			})
		}
	//}//End if 
	
	//isotope filter
	function theme_isotope_filters(){
		jQuery('.filters a').click(function() {
			$container = jQuery(this).parent().parent().next().find('.isotope');
			jQuery(this).parent().parent().find('li').removeClass('active');
			jQuery(this).parent().addClass('active');
			var selector = jQuery(this).attr('data-filter');
			$container.isotope({
				filter: selector
			});
			return false;
		});
		
		//When filter right, fix its position 
		if(jQuery('ul.onright').length > 0){
			
			jQuery('ul.onright').siblings('.pagenums').addClass('span12').css('margin','0');
			
		}
	}
	
	theme_isotope_filters();
	
	_win.smartresize(function() {
		if(jQuery('.isotope').length > 0){
			jQuery('.isotope').each(function(index, element) {
				var _this = jQuery(this),
				    image_size = jQuery(this).data('size');
				
				setWidths(image_size, _this);
				_this.isotope({
					masonry: {
						columnWidth: getUnitWidth(image_size, _this)
					}
				});
			})
		}
	}).resize();

	
	//Pagebuild: Audio player
	function toolTip_call(){
		if(jQuery(".songtitle").length>0 ){
			jQuery('.songtitle').tooltip({
				track: true
			});
		}
	}
	
	toolTip_call();
	
	var player_wrap = jQuery("#jquery_jplayer");
	
	function jPlayer_call(){
		if(player_wrap.length>0 ){
			player_wrap.jPlayer({
				ready: function () {
					jQuery(this).jPlayer("setMedia", {
						mp3:"http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3"
					});
				},
				swfPath: JS_PATH,
				supplied: "mp3",
				wmode: "window"
			});
		}
	}
	if(jQuery('.audio-unit').length>0 ){
		jPlayer_call();	
	}
	function audio_play_click(){
		jQuery('.pause').click(function(){
			var _id = jQuery(this).attr("id");
			jQuery('.audiobutton').removeClass('play');
			jQuery('.audiobutton').addClass('pause');
			jQuery(this).removeClass('pause')
			jQuery(this).addClass('play');
			player_wrap.jPlayer("setMedia", {
				mp3: jQuery(this).attr("rel")
			});
			player_wrap.jPlayer("play");
			player_wrap.bind(jQuery.jPlayer.event.ended, function(event) {
				jQuery('#'+_id).removeClass('play');
				jQuery('#'+_id).addClass('pause');
			});
			audio_pause_click();
			audio_play_click();
		})
		
	}
	
	function audio_pause_click(){
		jQuery('.play').click(function(){
			jQuery(this).removeClass('play')
			jQuery(this).addClass('pause');
			player_wrap.jPlayer("stop");
			audio_play_click();
		})
		
	}
	
	audio_play_click();
	

	
	//Pagebuild: isotope list double width
	function theme_isotope_width4(){
		jQuery('.isotope .width4').each(function(index, element) {
			var width = jQuery(this).find('.fade_wrap').width();
			jQuery(this).find('img').width(width);
		});
	}
	
	if(jQuery('.isotope .width4').length > 0){
		theme_isotope_width4();
	}
	
	//Pagebuild: Process Bar
	jQuery('.process-bar').each(function() {
		 var _this = jQuery(this),	
		 	 width = _this.data('width');
			 _this.delay(800).animate({width: width,opacity:'1' }, 1200 );
	})
	
	
	//Pagebuild: Client Moudle
	if(jQuery('.clients_wrap').length > 0){
		jQuery('.clients_wrap').each(function() {
            var _this = jQuery(this),
				column = _this.data('column'),
				carousel_btn = _this.find('.carousel-btn'),
				item_count = _this.find('ul li').length;
			
			if(column >= item_count){
				carousel_btn.hide();
			}else{
				carousel_btn.show();
			}
			
        });
		
		
	}
	
	function clients_wrap_each(){
		
		jQuery(".clients_wrap").each(function() {
											  
			var 
			_this              = jQuery(this),
			clients_wrap_width = _this.width(),
			clients_item_width = _this.find("li:first-child img").height();
			
			
			
			if( clients_wrap_width > 481 ){
				
				var column = _this.data('column');	
				
			}else if( clients_wrap_width > 300 && clients_wrap_width < 480 ){
				
				var column = 2;
			
			}else if( clients_wrap_width < 299 ){
				
				var column = 1; 
			
			}
			
			_win.load(function() {

				_this.find('ul').carouFredSel({
	
					responsive : true,
					width      : '100%',
					items      : column,
					scroll     : column,
					prev       : function() { return _this.find('.prev');},
					next       : function() { return _this.find('.next');},
					auto       : false
				
				});
				
				var liHeight = _this.find('img').height();
				_this.find('li').css('height',liHeight);
				_this.find('ul').css('height',liHeight);
				_this.find('.caroufredsel_wrapper').css('height',liHeight);
				_this.css('height',liHeight);
			 
			}); 

		});
		
	}
	_win.on("debouncedresize", clients_wrap_each);
	clients_wrap_each();
	
	//Pagebuild: Call jCarouselLite
	function testimonials_wrap_each(){
		
		jQuery(".testimonials-wrap").each(function() {
											   
			var carousele_li = jQuery(this).find('li');
			
			carousele_li.css({"margin-right": carousele_li.css("margin-left"), "margin-left" : 0});
			
			
			jQuery(this).jCarouselLite({
				speed: 500,					   
				btnPrev: function() { return jQuery(this).find('.prev');},
				btnNext: function() { return jQuery(this).find('.next');}
				
			}).width('100%').find('li').css({'min-height':'100%','height':'auto'});//carousel_width
		});
		
	}
	
	testimonials_wrap_each();
	
	//Pagebuild: Reload page for some special moduel when window resize e.g. Testimenials
	var screen_size = getSizeName();
	
	function getSizeName() {
		var screen_size = '',
			screen_w = jQuery(window).width();
		
		if ( screen_w > 1170 ) {
			screen_size = "desktop_wide";
		}
		else if ( screen_w > 960 && screen_w < 1169 ) {
			screen_size = "desktop";
		}
		else if ( screen_w > 768 && screen_w < 959 ) {
			screen_size = "tablet";
		}
		else if ( screen_w > 480 && screen_w < 767 ) {
			screen_size = "mobile";
		}
		else if ( screen_w < 479 ) {
			screen_size = "mobile_portrait";
		}
		return screen_size;
	}
	if(jQuery('.testimenials').length || jQuery('.custom_fullwidth_wrap').length){
		jQuery(window).resize(function() {
			var before_resize = screen_size;
			screen_size = getSizeName();
			if ( before_resize != screen_size ) {
				window.setTimeout('location.reload()', 10);
			}
		});
	}
	
	//Pagebuild: Pagnition/twitter style
	function theme_pagenums_twitter(i){
		jQuery('.pagenums.page_twitter a').unbind('click');
		jQuery('.pagenums.page_twitter a').bind('click',function(){
			var _this       = jQuery(this),
			    module_post = _this.data('post'),
			    post_id     = _this.data('postid'),
				paged       = _this.data('paged'),
				module_id   = _this.data('module');
			
			_this.html('Loading...');
			
			var ajax_data = {
				'module_id'   : module_id,
				'module_post' : module_post,
				'paged'       : paged,
				'post_id'     : post_id,
				'mode'        : 'twitter'
			}
			
			custom_module_load_ajax(ajax_data,jQuery('[data-post='+module_post+']').not('.not_pagination'));
			return false;
		
		});
		
	}
	
	function custom_module_load_ajax(data,container){
		jQuery.post(AJAX_M, {
			'mode': 'module',
			'data': data
		}).done(function(content){
			if(container.is('.container-isotope')){
				var newElems = jQuery(content).css({ opacity: 0 }),
				    oldElems = container.find('.isotope-item');
					
				switch(data['mode']){
					case 'pagenums': 
						var this_pagenums = jQuery('.pagination a[data-post='+data["module_post"]+'][data-paged='+data["paged"]+']');
						this_pagenums.text(data["paged"]);
						container.find('.isotope').isotope( 'remove', oldElems );
						jQuery('html,body').animate({
							scrollTop: container.offset().top - 40
						},
						1000); 
					break;
					case 'twitter': 
						var this_twitter = jQuery('.page_twitter a[data-post='+data["module_post"]+']');
						this_twitter.data('paged',data['paged'] + 1).text('Load More');
						if(data['paged'] == this_twitter.data('count')){
							this_twitter.fadeOut(300);
						}
					break;
				}
				newElems.imagesLoaded(function(){
					container.find('.isotope').isotope('insert', newElems);
					var image_size = container.find('.isotope').data('size');
					setWidths(image_size, container.find('.isotope'));

					//3Dflip hover center IE8 hack
					if( jQuery('.container3d').length > 0 ) {
		
						if( (jQuery.browser.msie == true && parseInt(jQuery.browser.version) < 9)){
							
							flip_center_ie();

							flip_ie();
						}
					}
					
					container.find('.isotope').isotope({
						masonry: {
							columnWidth: getUnitWidth(image_size, container.find('.isotope'))
						}
					});
					ux_liquid_list();
					ux_liquid_click();
				});
				player_wrap.jPlayer("stop");
				
				
				function _audio_play_click(){
				newElems.find('.pause').click(function(){
					var _id = jQuery(this).attr("id");
					newElems.find('.audiobutton').removeClass('play');
					newElems.find('.audiobutton').addClass('pause');
					jQuery(this).removeClass('pause')
					jQuery(this).addClass('play');
					player_wrap.jPlayer("setMedia", {
						mp3: jQuery(this).attr("rel")
					});
					player_wrap.jPlayer("play");
					player_wrap.bind(jQuery.jPlayer.event.ended, function(event) {
						jQuery('#'+_id).removeClass('play');
						jQuery('#'+_id).addClass('pause');
					});
					_audio_pause_click();
					_audio_play_click();
				})
				
			}
			
			function _audio_pause_click(){
				newElems.find('.play').click(function(){
					jQuery(this).removeClass('play')
					jQuery(this).addClass('pause');
					player_wrap.jPlayer("stop");
					_audio_play_click();
				})
				
			}
			
			_audio_play_click();
			
			function _toolTip_call(){
				if(newElems.find('.songtitle').length>0 ){
					newElems.find('.songtitle').tooltip({
						track: true
					});
				}
			}
			
			_toolTip_call();
			
			}else{
				var newElems = jQuery(content).css({opacity: 0 });
				switch(data['mode']){
					case 'pagenums': 
						var this_pagenums = jQuery('.pagination a[data-post='+data["module_post"]+'][data-paged='+data["paged"]+']');
						this_pagenums.text(data["paged"]);
						//container.find('.isotope').isotope( 'remove', oldElems );
						jQuery('html,body').animate({
							scrollTop: container.offset().top - 40
						},
						1000); 
						container.html(content);
					break;
					case 'twitter': 
						var this_twitter = jQuery('.page_twitter a[data-post='+data["module_post"]+']');
						this_twitter.data('paged',data['paged'] + 1).text('Load More');
						if(data['paged'] == this_twitter.data('count')){
							this_twitter.fadeOut(300);
						}
						container.append(newElems);
					break;
				}
			}
			newElems.animate({opacity:1}, 1000);
		});
		
	}
	
	if(jQuery('.pagenums').length > 0){
		jQuery('.pagenums .select_pagination').click(function(){
			var _this       = jQuery(this),
			    module_post = _this.data('post'),
			    post_id     = _this.data('postid'),
				paged       = _this.data('paged'),

				module_id   = _this.data('module');
			
			_this.parent().find('.select_pagination').removeClass('current');
			_this.addClass('current');
			_this.text('Loading');
			
			var ajax_data = {
				'module_id'   : module_id,
				'module_post' : module_post,
				'paged'       : paged,
				'post_id'     : post_id,
				'mode'        : 'pagenums'
			}
			
			custom_module_load_ajax(ajax_data,jQuery('[data-post='+module_post+']').not('.not_pagination'));
			return false;
		});
		
	}
	
	if(jQuery('.pagenums.infiniti_scroll').length > 0){
		jQuery('.infiniti_scroll').each(function(index, element) {
			var _this     = jQuery(this),
				post_id   = _this.find('a').data('post'),
				paged     = _this.find('a').data('paged'),
				module_id = _this.find('a').data('module');
			
			jQuery(window).scroll(function(){
				if(jQuery(window).scrollTop() > _this.offset().top - 100){
					_this.find('a').html('Loading...');
					
					var ajax_data = {
						'module_id' : module_id,
						'paged'     : paged,
						'post_id'   : post_id
					}
					
					//custom_module_load_ajax(ajax_data);
				}
			});
		});
	}
	
	
	if(jQuery('.pagenums.page_twitter').length > 0){
		theme_pagenums_twitter(2);
		
	}
	
	//Pagebuild: Fullwidth Wrap	Margin left
	function fullwrap_mleft(){	
	
		jQuery('.custom_fullwidth_wrap').each(function(index, element) {
			var  
			screen_w          = _win.width(),
			fullwidth_this_w  = jQuery(this).width(),
			this_w            = screen_w - fullwidth_this_w,
			all_warp          = jQuery('#wrap'),
			all_warp_width    = all_warp.width(),
			all_warpinn       = jQuery('#content'),
			all_warpinn_width = all_warpinn.width();
			
			if(all_warp.hasClass('fullwidth_ux')){
				
				var this_left  = jQuery(this).offset().left;
				jQuery(this).width(screen_w);	
				jQuery(this).css({'margin-left':'-'+this_left+'px'});
				
			}else{
				
				var this_left = (all_warp_width - all_warpinn_width)/2;
				jQuery(this).width(all_warp_width);
				jQuery(this).css({'margin-left':'-'+this_left+'px'});
			}
			
			jQuery(this).animate({'opacity':1},500);
		});
	}
	
	if(jQuery('.custom_fullwidth_wrap').length > 0){
		
		fullwrap_mleft();

	}
	
	
	//Pagebuild/theme: Sidebar for fullwrap
	function custom_setting_sidebar(top){
		jQuery('#sidebar').animate({
			'margin-top': top+'px'
		},
		1000);
	}
	
	if(jQuery('#sidebar').length > 0){
		jQuery('#content_wrap > .row-fluid > .moudle').each(function(index, element){
			jQuery(this).attr('data-sort',index);
		});
		
		jQuery('#content_wrap > .row-fluid > .moudle:not(.fullwrap_moudle)').each(function(index, element){
			var data_sort, height_count = 0, this_height = 0 , this_height = 0;
			if(index == 0){
				data_sort = jQuery(this).attr('data-sort');
				jQuery('#content_wrap > .row-fluid > .moudle').each(function(i){
					if(i < data_sort){
						this_height = jQuery(this).height();
						if(jQuery(this).find('.ls-wp-fullwidth-container').length > 0){
							this_height = jQuery(this).find('> .ls-wp-fullwidth-container > .ls-wp-fullwidth-helper').height();
						}
						height_count += this_height + 40;
						custom_setting_sidebar(height_count)
					}
				});
			}
		});

	}
	
	
	//Pagebuild: Promote centered
	function promote_center(){
		
		jQuery('.promote-wrap-2c').each(function(){		
				
				var 
				btn_W  = jQuery(this).find('.promote-button-wrap').width(),
				wrap_W = jQuery(this).width();
				
				if( wrap_W < 300 ){
					jQuery(this).removeClass('promote-wrap-2c');
					jQuery(this).find('.promote-text').css('margin-right','0');
				}else{
					jQuery(this).addClass('promote-wrap-2c');
					jQuery(this).find('.promote-text').css('margin-right',btn_W);
				}
			
		});
		
	}
	
	if(jQuery('.promote-wrap-2c').length>0 && jQuery('.promote-button-wrap').length>0){ 
		promote_center(); 
		_win.on("debouncedresize", promote_center);
	}
	
	
	//Pagebuild: Portfolio #3D Flip Mouseover IE HACK
	
	if( jQuery('.container3d').length > 0 ) {
			
		if( (jQuery.browser.msie == true )){
			if(parseInt(jQuery.browser.version) < 10) {	
				flip_ie();
			}
			if(parseInt(jQuery.browser.version) < 9) {	
				flip_center_ie();
			}
		}
		
	}
	
	function flip_ie(){
		
		jQuery('.card').live("mouseenter", function(e){

			e.preventDefault();
			
				jQuery(this).find('.front').stop().animate({"opacity": 0}, 300);
				jQuery(this).find('.back').stop().animate({"opacity": 1}, 300).css( { 'z-index' : 100,'display':'block'});
			
		});  
	
		jQuery('.container3d').live("mouseleave", function(e){
		   
			e.preventDefault();
			var $this = jQuery(this);
			
				$this.find('.back').stop().css( { 'opacity' : 0, 'z-index' : 0});
				$this.find('.front').stop().animate({"opacity": 1}, 300);
			
		});
	
		jQuery('div.container3d .card .face.back').css( { 'display' : 'none'});
		
		
	}	
	//Flip centered IE8 hack
	function flip_center_ie(){
		
		jQuery('.flip_wrap_back_con').each(function(){
			
			var 
			flipTitHeight     = jQuery(this).find('h2').height(),
			flipMarginTop  = -((flipTitHeight + 60 )/2);
			
			jQuery(this).css({'margin-top':+flipMarginTop,'left':'0' });
			
			
		});
	}
	
	if( Modernizr.touch ) {
		
		if(jQuery('.fullwidth-wrap').length>0){
		
			jQuery('.fullwidth-wrap').each(function(){
													
				jQuery(this).css('background-attachment','scroll');
			
			})
		
		}

		// Pagebuild: portfolio caption hover -  For Touch Devices 
	

		function classReg( className ) {
			return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
		}

		var hasClass, addClass, removeClass;

		if ( 'classList' in document.documentElement ) {
			hasClass = function( elem, c ) {
				return elem.classList.contains( c );
			};
			addClass = function( elem, c ) {
				elem.classList.add( c );
			};
			removeClass = function( elem, c ) {
				elem.classList.remove( c );
			};
		}else {
			hasClass = function( elem, c ) {
				return classReg( c ).test( elem.className );
			};
			addClass = function( elem, c ) {
				if ( !hasClass( elem, c ) ) {
						elem.className = elem.className + ' ' + c;
				}
			};
			removeClass = function( elem, c ) {
				elem.className = elem.className.replace( classReg( c ), ' ' );
			};
		}

		function toggleClass( elem, c ) {
			var fn = hasClass( elem, c ) ? removeClass : addClass;
			fn( elem, c );
		}

		var classie = {
			// full names
			hasClass: hasClass,
			addClass: addClass,
			removeClass: removeClass,
			toggleClass: toggleClass,
			// short names
			has: hasClass,
			add: addClass,
			remove: removeClass,
			toggle: toggleClass
		};

		// transport
		if ( typeof define === 'function' && define.amd ) {
			// AMD
			define( classie );
		} else {
			// browser global
			window.classie = classie;
		}
		
		//Pagebuild: Portfolio Module Hover - Folding
		[].slice.call( document.querySelectorAll( '.inside > figure' ) ).forEach( function( el, i ) {
			el.querySelector( 'figcaption a' ).addEventListener( 'touchstart', function(e) {
				e.stopPropagation();
			}, false );
			el.querySelector( '.btn_wrap a.lightbox' ).addEventListener( 'touchstart', function(e) {
				e.stopPropagation();
			}, false );
			el.querySelector( '.btn_wrap a.more' ).addEventListener( 'touchstart', function(e) {
				e.stopPropagation();
			}, false );
			el.addEventListener( 'touchstart', function(e) {
				classie.toggle( this, 'cs-hover' );
			}, false );
		} );
		
		//Pagebuild: Portfolio Module Hover - Flip
		[].slice.call( document.querySelectorAll( 'div.container3d' ) ).forEach( function( el, i ) {
			el.querySelector( '.back a' ).addEventListener( 'touchstart', function(e) {
				e.stopPropagation();
			}, false );
			[].slice.call( el.querySelectorAll( '.hover_thumb_unit' ) ).forEach( function( t, i ) {
				t.querySelector( 'a' ).addEventListener( 'touchstart', function(e) {
					e.stopPropagation();
				}, false );
			} );
			el.addEventListener( 'touchstart', function(e) {
				classie.toggle( this, 'hover3d' );
			}, false );
		} );
		
		//Pagebuild: Team Module Hover 
		[].slice.call( document.querySelectorAll( '.team-item' ) ).forEach( function( el, i ) {
			el.querySelector( '.team-item-con-back a' ).addEventListener( 'touchstart', function(e) {
				e.stopPropagation();
			}, false );
			el.addEventListener( 'touchstart', function(e) {
				classie.toggle( this, 'team-hover3d' );
			}, false );
		} );
		

	} // End if Modernizr.touch
	
	//Pagebuild: image module shadow
	jQuery('.shadow').each(function(){
	
		jQuery(this).imagesLoaded(function() {
		
			jQuery(this).css('opacity','1');
		
		});
	
	});
	
	jQuery('.image-box-svg-wrap').each(function(){
		if( Modernizr.touch ) {
			jQuery(this).addClass('shown');
		}else{
			jQuery(this).waypoint(function() { jQuery(this).addClass('shown'); }, { offset: '100%'});
		}
	});
	
	jQuery('.iconbox-plus').each(function(){
			
	var animation = jQuery(this).data('animation');
	
		if( Modernizr.touch ) {
			jQuery(this).find('.iconbox-plus-svg-wrap').addClass('breath').addClass(animation);
		}else{
			jQuery(this).waypoint(function() { 
				
				if(animation=="rorate"){
					
					jQuery(this).find('.iconbox-plus-svg-wrap').addClass('breath'); 
					jQuery(this).find('.iconbox-plus-svg-wrap').addClass(animation);
				}else{
				
					jQuery(this).find('.iconbox-plus-svg-wrap').addClass('breath').addClass(animation); 
				}
				
			}, { offset: '100%'});
		}

	}); 
	
	jQuery('.countdown').each(function(){
			
		var 
		dateUntil   = jQuery(this).data('until'),
		dateFormat  = jQuery(this).data('dateformat'),
		
		dateYears   = Number(jQuery(this).data('years')),
		dateMonths  = Number(jQuery(this).data('months')),
		dateDays    = Number(jQuery(this).data('days')),
		dateHours   = Number(jQuery(this).data('hours')),
		dateMinutes = Number(jQuery(this).data('minutes')),
		dateSeconds = Number(jQuery(this).data('seconds'));
		
		austDay = new Date(dateYears, dateMonths - 1, dateDays, dateHours, dateMinutes, dateSeconds);
		jQuery(this).countdown({until: austDay, format:dateFormat});
	
	});
	
	function ux_liquid_column(_this_isotope_item){
		var _target = false;
		var _this_parents = _this_isotope_item.parents('.isotope-liquid-list');
		var _isotope_item = _this_parents.find('isotope-item');
		var _this_isotope_num = _this_isotope_item.data('num');
		var _this_size = _this_parents.data('size');
		var _this_width = _this_parents.data('width');
		var _column = _this_parents.width() / getUnitWidth(_this_size, _this_parents) / 2,
			_column = parseInt(_column);
		var _base_num = _this_isotope_num%_column;
		
		switch(_column){
			case 5:
				if(_this_size == 'small' && _this_width == 'width8'){
					if(_base_num%3 == 0){
						_target = _this_isotope_num + 2;
					}
					if(_base_num%4 == 0){
						_target = _this_isotope_num + 1;
					}
				}
			break;
			
			case 4:
				if((_this_size == 'small' && _this_width == 'width8') || (_this_size == 'medium' && _this_width == 'width8')){
					if(_base_num%2 == 0){
						_target = _this_isotope_num + 3;
					}
					if(_base_num%3 == 0){
						_target = _this_isotope_num + 2;
					}
					if(_base_num%4 == 0){
						_target = _this_isotope_num + 1;
					}
				}
				if((_this_size == 'small' && _this_width == 'width6') || (_this_size == 'medium' && _this_width == 'width6')){
					if(_base_num%3 == 0){
						_target = _this_isotope_num + 2;
					}
				}
			break;
			
			case 3:
				if((_this_size == 'small' && _this_width == 'width8') || (_this_size == 'small' && _this_width == 'width6') || (_this_size == 'medium' && _this_width == 'width8') || (_this_size == 'medium' && _this_width == 'width6') || (_this_size == 'large' && _this_width == 'width6')){
					if(_base_num%2 == 0){
						_target = _this_isotope_num + 2;
					}
					if(_base_num%3 == 0){
						_target = _this_isotope_num + 1;
					}
				}
				if((_this_size == 'small' && _this_width == 'width8') || _this_size == 'medium' && _this_width == 'width8'){
					_this_isotope_item.removeClass('width8');
					_this_isotope_item.addClass('width6');
				}
			break;
			
			case 2:
				if((_this_size == 'medium' && _this_width == 'width8') || (_this_size == 'medium' && _this_width == 'width6') || (_this_size == 'medium' && _this_width == 'width4') || (_this_size == 'large' && _this_width == 'width6') || (_this_size == 'large' && _this_width == 'width4')){
					if(_base_num%2 == 0){
						_target = _this_isotope_num + 1;
					}
				}
				if(_this_size == 'medium' && _this_width == 'width8'){
					_this_isotope_item.removeClass('width8');
					_this_isotope_item.addClass('width4');
				}
				if((_this_size == 'large' && _this_width == 'width6') || (_this_size == 'medium' && _this_width == 'width6')){
					_this_isotope_item.removeClass('width6');
					_this_isotope_item.addClass('width4');
				}
			break;
		}
		
		return _target;
		
	}
	
	function ux_liquid_remove(_this_isotope_item, _mode){
		var _this_parents = _this_isotope_item.parents('.isotope-liquid-list');
		var _this_width = _this_parents.data('width');
		var _this_size = _this_parents.data('size');
		var _this_space = _this_parents.data('space');
		var _this_isotope_num = _this_isotope_item.data('num');
		var _isotope_item = _this_parents.find('.isotope-item');
		var _target;
		
		_isotope_item.each(function(index, element) {
            var _this = jQuery(this);
			var _this_num = _this.data('num');
			var _this_liquid_inside = _this.find('.liquid_inside');
			var _this_liquid_expand = _this.find('.liquid-expand-wrap');
			
			switch(_mode){
				case 'this' :
					if(_this_isotope_num == _this_num){
						jQuery(this).removeClass(_this_width).addClass('width2');
						
						_this_liquid_expand.fadeOut(100, function(){
							_this_liquid_inside.fadeIn(300);
							_this_liquid_inside.css('overflow','visible');
							_this_liquid_expand.remove();
							setWidths(_this_size, _this_parents);
							if(_this_isotope_num > 1){
								_target = _this_isotope_num - 1;
								_this_parents.find('.isotope-item[data-num='+_target+']').after(_this_isotope_item);
							}else if(_this_isotope_num == 1){
								_target = _this_isotope_num + 1;
								_this_parents.find('.isotope-item[data-num='+_target+']').before(_this_isotope_item);
							}
							_this_parents.isotope('appended', _this_isotope_item);
							_this_parents.isotope('reLayout');
							
							if(jQuery.browser.msie == true && parseInt(jQuery.browser.version) < 9){}else{
								setTimeout(function(){
									var _html_top = jQuery('html').css('margin-top');
									_this_space = _this_space.replace('px','');
									_html_top = _html_top.replace('px','');
									if(jQuery.browser.msie == true && parseInt(jQuery.browser.version) < 9){
										if(_html_top == 'auto'){
											_html_top = 0;
										}
									}
									_offset_top = _this.offset().top
									jQuery('html,body').animate({
										scrollTop: _offset_top - _this_space - _html_top
									}, 500);
								}, 1000);
							}
						});
					}
				break;
				
				case 'other':
					if(_this_isotope_num != _this_num){
						if(_this_liquid_expand.length > 0){
							_this.removeClass(_this_width).addClass('width2');
							_this_liquid_expand.fadeOut(100, function(){
								_this_liquid_inside.fadeIn(300);
								_this_liquid_inside.css('overflow','visible');
								_this_liquid_expand.remove();
								if(_this_num > 1){
									_target = _this_num - 1;
									_this_parents.find('.isotope-item[data-num='+_target+']').after(_this);
								}else if(_this_num == 1){
									_target = _this_num + 1;
									_this_parents.find('.isotope-item[data-num='+_target+']').before(_this);
								}
								_this_parents.isotope('appended', _this);
								_this_parents.isotope('reLayout');
							});
						}
					}
				break;
			}
        });
	}
	
	function ux_liquid_click(){
		if(jQuery('.liquid_list_image').length > 0){
			jQuery('.liquid_list_image').css('cursor','pointer');
			jQuery('.liquid_list_image').click(function(){
				var _this = jQuery(this);
				player_wrap.jPlayer("stop");
				
				var _this_liquid_handler = jQuery('.liquid_handler');
				if(_this_liquid_handler.length == 0){
					_this.addClass('liquid_handler');
					if(_this.is('.flip_wrap_back')){
						ux_liquid_ajax(_this.find('a.liquid_list_image'));
					}else{
						ux_liquid_ajax(_this);
					}
				}
				return false;
			});
		}
	}
	ux_liquid_click();
	
	function ux_liquid_ajax(_this){
		var _this_parents = _this.parents('.isotope-liquid-list');
		var _isotope_item = _this_parents.find('.isotope-item');
		var _isotope_length = _this_parents.find('.isotope-item').length;
		var _this_isotope_item = _this.parents('.isotope-item');
		var _this_liquid_inside = _this.parents('.liquid_inside');
		var _this_liquid_item = _this_liquid_inside.find('.liquid-item');
		var _this_liquid_loading = _this_liquid_inside.next('.liquid-loading-wrap');
		var _this_liquid_hide = _this_liquid_loading.find('.liquid-hide');
		var _this_post_id = _this.data('postid');
		var _this_type = _this.data('type');
		var _this_block_words = _this_parents.data('words');
		var _this_show_social = _this_parents.data('social');
		var _this_image_ratio = _this_parents.data('ratio');
		var _this_width = _this_parents.data('width');
		var _this_space = _this_parents.data('space');
		var _this_size = _this_parents.data('size');
		
		var _this_liquid_expand, _this_post_social, _this_liquid_close;
		var _target = ux_liquid_column(_this_isotope_item);
				
		if(_this_type == 'magazine'){
			_this_liquid_hide.html(_this_liquid_item.clone());
		}
	
		_this_liquid_inside.hide(0,function(){
			_this_liquid_loading.fadeIn(500);
		});
		
		jQuery.post(AJAX_M, {
			'mode': 'liquid',
			'data': {
				'post_id'     : _this_post_id,
				'block_words' : _this_block_words,
				'show_social' : _this_show_social,
				'image_ratio' : _this_image_ratio
			}
		}).done(function(content){
			_this_isotope_item.append(content);
			_this_liquid_expand = _this_isotope_item.find('.liquid-expand-wrap');
			_this_liquid_close = _this_liquid_expand.find('.m-close');
			_this_post_social = _this_liquid_expand.find('.post_social');
			_this_post_social.addClass('post_social_inzoomed');
			_this_isotope_item.removeClass('width2').addClass(_this_width);
			
			_this_liquid_expand.css({'padding': _this_space + ' 0 0 ' + _this_space});
			
			_this_isotope_item.imagesLoaded(function(){
				if(_target){
					var _isotope_item = _this_parents.find('.isotope-item[data-num='+_target+']');
					if(_isotope_item.length == 0){
						_this_parents.find('.isotope-item[data-num='+_isotope_length+']').after(_this_isotope_item);
					}else{
						_this_parents.find('.isotope-item[data-num='+_target+']').after(_this_isotope_item);
					}
					_this_parents.isotope('appended', _this_isotope_item);
				}
				_this_liquid_loading.hide(0,function(){
					ux_liquid_remove(_this_isotope_item, 'other');
					setWidths(_this_size, _this_parents);
					_this_liquid_expand.fadeIn(300);
					_this_parents.isotope('reLayout');
					jQuery('.liquid_handler').removeClass('liquid_handler');
					
					if(jQuery.browser.msie == true && parseInt(jQuery.browser.version) < 9){}else{
						setTimeout(function(){
							var _html_top = jQuery('html').css('margin-top');
							_this_space = _this_space.replace('px','');
							_html_top = _html_top.replace('px','');
							if(jQuery.browser.msie == true && parseInt(jQuery.browser.version) < 9){
								if(_html_top == 'auto'){
									_html_top = 0;
								}
							}
							_offset_top = _this_isotope_item.offset().top
							jQuery('html,body').animate({
								scrollTop: _offset_top - _this_space - _html_top
							}, 500);
						}, 1000);
					}
				});
			});
			jQuery('.lightbox').lightbox();
			
			ux_post_social();
			jPlayer_call();
			audio_play_click();
			
			_this_liquid_close.click(function(){
				ux_liquid_remove(_this_isotope_item, 'this');
			});
			
		});
		
	}
	
	function ux_liquid_list(){
		if(jQuery('.isotope-liquid-list').length > 0){
			jQuery('.isotope-liquid-list').each(function(i, element) {
				var _this = jQuery(this);
				var _isotope_item = _this.find('.isotope-item');
				
				_isotope_item.each(function(index, element) {
                    jQuery(this).attr('data-num', index + 1);
                });
				
			});
		}
	}
	ux_liquid_list();
	
	function ux_liquid_list_responsive(){
		if(jQuery('.isotope-liquid-list').length > 0){
			
			var liquid_width = jQuery(this).width();
			
			jQuery('.isotope-liquid-list').each(function(){
				if( liquid_width < 480 ){
					jQuery('head').append('<style>.liquid-more-icon i{ display:none; }</style>');				   
				}									 
			});
		}
	}
	
	if(jQuery('.isotope-liquid-list').length > 0){
		ux_liquid_list_responsive();
		_win.on("debouncedresize", ux_liquid_list_responsive);
	}
	
	//Pagebuild: Post Carousel Moudle
	if(jQuery('.post-carousel-wrap').length > 0){

		function post_carousel_wrap_each(){
			
			jQuery(".post-carousel-wrap").each(function() {
												  
				var 
				_this        = jQuery(this),
				wrap_width   = _this.width(),
				carousel_btn = _this.find('.post-carousel-pagination'),
				item_count   = _this.find('section').length,
				item_width   = _this.find("li:first-child").height();
				
				if(column >= item_count){
					
					carousel_btn.hide();
					
				}else{
					
					carousel_btn.show();
				}
				
				if( wrap_width > 1500 ){
					
					var column = 6;
				
				}else if( wrap_width > 1100 && wrap_width < 1499 ){
					
					var column = 5;	
				
				}else if( wrap_width > 768 && wrap_width < 1099 ){
					
					var column = 4;	
					
				}else if( wrap_width > 300 && wrap_width < 767 ){
					
					var column = 2;
				
				}else if( wrap_width < 299 ){
					
					var column = 1; 
				
				}
				
				_win.load(function() {
	
					_this.find('.post-carousel').carouFredSel({
		
						responsive : true,
						width      : '100%',
						items      : column,
						scroll     : column,
						swipe      : {
								onTouch : true, 
								onMouse : true 
						},
						pagination : function() { return _this.find('.post-carousel-pagination');},
						//prev       : function() { return _this.find('.prev');},
						//next       : function() { return _this.find('.next');},
						auto       : false
					
					});
					
					var _getmax = new Array();
					_this.find('section').each(function(index, element){
						_getmax.push(jQuery(this).height());
					});
					
					ulHeight = eval("Math.max("+_getmax.toString()+")") + 40;
					_this.find('section').css('height',ulHeight);
					//_this.find('ul').css('height',ulHeight);
					_this.find('.caroufredsel_wrapper').css('height',ulHeight);
					_this.css('height',ulHeight);
					_this.find('.post-carousel').animate({'opacity':1 },300);
				 
				}); 
	
			});
			
		}
		
		_win.on("debouncedresize", post_carousel_wrap_each);
		post_carousel_wrap_each();
	
	}
	
	
	jQuery('.flex-slider-wrap').each(function(){
		var _this = jQuery(this);
		var _this_direction = _this.data('direction');
		var _this_control = _this.data('control');
		var _this_speed = _this.data('speed');
		var _this_animation = _this.data('animation');
		
		_this.find('.flexslider').flexslider({
			animation: ''+_this_animation+'', //String: Select your animation type, "fade" or "slide"
			animationLoop: true,
			slideshow: true, 
			smoothHeight: true,  
			controlNav: _this_control, //Dot Nav
			directionNav: _this_direction,  // Next\Prev Nav
			touch: true, 
			slideshowSpeed: _this_speed * 1000 
			//itemWidth: 210,
			//itemMargin: 5
		});
	});
	
	//Pagebuild: Fullwrap Tab
	
	if(jQuery('.fullwrap-with-tab-nav').length){
	
	function fullwrap_tab(){
		
		jQuery('.fullwrap-with-tab-nav>a').first().addClass('full-nav-actived');
		
		//Remove inline-block space
		jQuery('.fullwrap-with-tab-nav').contents().filter(function() {
			return this.nodeType === 3;
		}).remove();
		
		jQuery('.fullwrap-with-tab-nav').find('a').click(function(){
			
			var target = jQuery(this).data('target');
			
			jQuery(this).parent().siblings(".fullwrap-with-tab-inn").removeClass('enble').addClass('disble');
			jQuery(this).parent().siblings('#'+target).removeClass('disble').addClass('enble');
			
			if(jQuery(this).hasClass('full-nav-actived')){
			}else{
				jQuery(this).addClass('full-nav-actived');
			}
			
			jQuery(this).siblings('a').removeClass('full-nav-actived');
		}); 
	}
	
	fullwrap_tab();
	
	}
	
	//Share icon module
	function popitup(url) {
		
		var height = 400;
		var width = 500;
		var left = (screen.width/2)-(width/2);
		var top = (screen.height/2)-(height/2);
		var options = "height="+height+",width="+width+",top="+top+", left="+left;
		newwindow=window.open(url,'title',options);
		if (window.focus) {newwindow.focus()}
		return false;
	}
	
	function ajax_count(url, page_title, featured_image_url){
		jQuery.ajax({
			dataType: "json",
			url: "http://graph.facebook.com/?id=" + url
			}).done(function(data) {
			jQuery('.share-icon-wrap a.postshareicon-facebook-wrap .count').html(data.shares);
		});
		
		jQuery.ajax({
			dataType: "json",
			url: "http://cdn.api.twitter.com/1/urls/count.json?url=" + url +'&&callback=?'
			}).done(function(data) {
			jQuery('.share-icon-wrap a.postshareicon-twitter-wrap .count').html(data.count);
		});
	
		jQuery.ajax({
			crossDomain: true,
			dataType: "jsonp",
			url: "http://api.pinterest.com/v1/urls/count.json?&url="+url
			}).done(function(data) {
			jQuery('.share-icon-wrap a.postshareicon-pinterest-wrap .count').html(data.count);
		});
	}
	
	function ux_post_social(){
		
		if( jQuery('.share-icon-wrap').length > 0 ) {
			
			jQuery('.share-icon-wrap').each(function(index, element) {
													 
				var url = jQuery(this).find('input[name="url"]').val();
				var page_title = jQuery(this).find('input[name="title"]').val();
				var featured_image_url = jQuery(this).find('input[name="media"]').val();
				
				var facebook_share = jQuery(this).find('a.postshareicon-facebook-wrap');
				var twitter_share = jQuery(this).find('a.postshareicon-twitter-wrap');
				var pinterest_share = jQuery(this).find('a.postshareicon-pinterest-wrap');
				
				facebook_share.click(function(){
					popitup('http://www.facebook.com/sharer.php?u='+url);													   
				});
				
				twitter_share.click(function(){
					popitup('http://twitter.com/share?text='+page_title+'&url='+url);													   
				});
				
				pinterest_share.click(function(){
					popitup('http://pinterest.com/pin/create/button/?url='+url+'&media='+featured_image_url+'&description='+page_title);													   
				});
				
				ajax_count(url, page_title, featured_image_url);
			});
		}
	}
	ux_post_social();
	//End Share icon module
	
});