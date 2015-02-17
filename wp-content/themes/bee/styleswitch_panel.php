<!--Demo styleswith-->
<style>
#styleswitcher{ 
    top:160px; 
    left:0; 
    position: fixed;
    z-index:9999;
	box-shadow:0 0 1px rgba(0,0,0,0.1);
}

#openclose{ 
    position: absolute;
    z-index:999; 
    cursor: pointer;
    display:block; 
	height:71px; 
	right: -30px;
	left:auto; 
	width: 30px; 
    background: transparent url(<?php echo get_template_directory_uri(); ?>/img/demo/panel_head.png) no-repeat top left;
    box-shadow:2px 0 2px rgba(0,0,0,0.1);
    border-bottom-right-radius: 5px 5px; 
    border-top-right-radius: 5px 5px;
}
.colorpanel_main{ 
    position:relative; 
    width:190px; 
    padding:0 10px 10px 10px;
    background-color:#fff; 
    border-bottom-right-radius: 5px 5px; 
}
.colorpanel_main input{ 
    width:110px; 
	height:20px; 
	border:1px solid #CCC;}
.cptitle{ 
    padding:17px 0 15px 0; 
	color:#999;}
#linkcolor li{ 
    cursor:pointer; 
    display:block; 
    float:left; 
    margin-left:10px; 
    margin-bottom:10px; 
    height:50px; 
    width:50px;
   border-radius:8px;
}
#fullbox li{ 
    cursor:pointer; 
	display:block; 
	float:left; 
	margin-left:10px;
	width:80px; 
	height:60px;  }
#linkcolor,#fullbox{
    margin-left:-10px;
}
</style>
<script>
jQuery(document).ready(function() {

	var target = jQuery('#styleswitcher');
	var 
	all_warp  = jQuery('#wrap'),
	_win      = jQuery(window);
	
	_win.resize(function(){
	
		if( _win.width()<1220 ){
		
			target.remove();
			
		}else{
		
			target.animate({ left:'-190px'}).addClass('switcher-hide');
			
		}
		
	});
	 
	
	if( _win.width()<1220 ){
		
		target.remove();
		
	}else{
	
		target.animate({ left:'-190px'}).addClass('switcher-hide');
		
	}
	
	// Panel hide/show	   
	jQuery('#openclose').click(function(){
	
		if(target.is('.switcher-hide')){
		
			 target.stop().animate({ left:'0'},300, function(){
				target.removeClass('switcher-hide');
			});
			
		}else{	
			
			 target.stop().animate({ left:'-190px'},300, function(){
				target.addClass('switcher-hide');
			});
		}
	});
	
	//choose  Full / box
	/**/
	function fullwrap(){	
	
		jQuery('.custom_fullwidth_wrap').each(function(index, element) {
		
			var  
			screen_w          = _win.width(),
			fullwidth_this_w  = jQuery(this).width(),
			this_w            = screen_w - fullwidth_this_w,
			
			all_warp_width    = all_warp.width(),
			all_warpinn       = jQuery('#content'),
			all_warpinn_width = all_warpinn.width();
				
			var this_left = (all_warp_width - all_warpinn_width)/2;
			jQuery(this).width(all_warp_width);
			jQuery(this).css({'margin-left':'-'+this_left+'px'});
			
		});
	}
	
	 	
	jQuery("#fullbox li").click(function() {
	
		switchSkin(jQuery(this).attr("class"));
		
	});	
	
	function switchSkin(sk) {
	
		
		if(sk == 'box'){
		
			if(all_warp.hasClass('fullwidth_ux')){
				all_warp.removeClass('fullwidth_ux');
			}
			//jQuery('head').append('<style>#wrap,#wrap.fullwidth_ux,.fullwidth-wrap{max-width:1220px;}</style>');
			if(jQuery('.custom_fullwidth_wrap').length){ 
				
				jQuery('.custom_fullwidth_wrap').each(function(index, element) {
						
					//var this_left = (all_warp_width - all_warpinn_width)/2;
					jQuery(this).width(1220);
					jQuery(this).css({'margin-left':'-30px'});
					

				});
			}
			
		} else {
			//jQuery('head').append('<style>#wrap,#wrap.fullwidth_ux{max-width:100%;}.ls-wp-fullwidth-container{ margin-top:-40px;}</style>');
			if(!all_warp.hasClass('fullwidth_ux')){
				all_warp.addClass('fullwidth_ux');
			}
			
			if(jQuery('.custom_fullwidth_wrap').length){ 
				
				fullwrap();
				
			}
			
		}
	}
	
	//font  Feature color
	jQuery("#linkcolor li").click(function() {
		switchl(jQuery(this).data("color"));
	});	
	function switchl(lcolor) {
		if(lcolor == ''){} else {
			
			jQuery('head').append('<style>#respondwrap input#submit,.entry .contactform input.idi_send,.nav-tabs > li > a:hover,.process-bar,.pagenums a:hover,.sidebar_widget .widget_search input[type="submit"]:hover,#foot_widget .tagcloud a:hover,.sidebar_widget .tagcloud a:hover,#foot_widget .widget_uxconatactform input#idi_send:hover,#foot_widget .widget_search input[type="submit"]:hover,input.idi_send:hover,.team-item-con-back,.testimenials:hover,.testimenials:hover .arrow-bg,#navi>div>ul li.current-menu-item>a,#navi>div>ul li.current-menu-parent>a,#navi>div>ul>li.current-menu-ancestor>a,#navi>div>ul>li:hover>a,.fixed-menu-class li.current-menu-item,.fixed-menu-class li.current-menu-parent,.fixed-menu-class>li.current-menu-ancestor,.fixed-menu-class>li:hover,.sidebar_widget .widget_uxconatactform input#idi_send:hover,.filters li:hover a,.page-numbers:hover,button:hover,.sidebar_widget .widget_display_search input[type="submit"]:hover,#bbp-user-navigation li a:hover,input.wpcf7-form-control.wpcf7-submit:hover,.single-feild input#idi_send,.fullwrap-with-tab-nav>a:hover,.fullwrap-with-tab-nav>a.full-nav-actived{background-color:'+lcolor+'}a:hover,.entry p a,.text_block a,.post_meta > li a:hover, #sidebar a:hover, #comments .comment-author a:hover,#comments .reply a:hover,.fourofour-wrap a,.blog_meta a:hover,.breadcrumbs a:hover,.link-wrap a:hover,.item_title a:hover,.item_des a:hover,.archive-wrap h3 a:hover,.carousel-wrap a:hover,.iocnbox:hover i,.blog-item-main h2 a:hover,div.bbp-template-notice,h1.main_title .bbp-breadcrumb a:hover{color:'+lcolor+'}.nav-tabs > li > a:hover,#foot_widget .widget_uxconatactform input:focus,#foot_widget .widget_uxconatactform textarea:focus,#foot_widget .widget_search input[type="text"]:focus,textarea:focus,input[type="text"]:focus,input[type="password"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="time"]:focus,input[type="week"]:focus,input[type="number"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="search"]:focus,input[type="tel"]:focus,input[type="color"]:focus,.uneditable-input:focus,.sidebar_widget .widget_uxconatactform textarea:focus, .sidebar_widget .widget_uxconatactform input[type="text"]:focus,#navi>div>ul ul.sub-menu li.current-menu-item>a,#navi>div>ul .sub-menu li:hover>a,#navi ul li ul.sub-menu li.current-menu-ancestor>a,.fixed-menu-class .sub-menu li:hover,.fixed-menu-class .sub-menu li.current-menu-item,.fixed-menu-class .sub-menu li.current-menu-ancestor,.accordion-heading:hover,#respondwrap textarea:focus,#respondwrap input:focus,.fullwrap-with-tab-nav>a.full-nav-actived,.fullwrap-with-tab-nav>a:hover{border-color:'+lcolor+'}</style>');
			
		}
	}
	
});
</script>


<div id="styleswitcher">
	<div id="openclose"></div>
	<div class="colorpanel_main">
	
		<!----><p class="cptitle">Fullwidth / Boxed</p>
		
		<ul id="fullbox">
			<li class="box"><img src="<?php echo get_template_directory_uri(); ?>/functions/theme/images/boxed.png" /></li>
			<li class="full"><img src="<?php echo get_template_directory_uri(); ?>/functions/theme/images/fullwidth.png" /></li>
			<div class="clear"></div>
		</ul>
		
		<p class="cptitle">Featured Color</p>
		
		<ul id="linkcolor">
			<li data-color="#ee7164" style=" background-color:#ee7164"></li>
			<li data-color="#be9ecd" style=" background-color:#be9ecd"></li>
			<li data-color="#f67bb5" style=" background-color:#f67bb5"></li>
			<li data-color="#77c9e1" style=" background-color:#77c9e1"></li>
			<li data-color="#5a6b7f" style=" background-color:#5a6b7f"></li>
			<li data-color="#b8b69d" style=" background-color:#b8b69d"></li>
			<li data-color="#34bc99" style=" background-color:#34bc99"></li>
			<li data-color="#e8b900" style=" background-color:#e8b900"></li>
			<li data-color="#ce671e" style=" background-color:#ce671e"></li>
			<div class="clear"></div>
		</ul>
		<div class="clear"></div>
		
	</div>
</div>
<!--Demo styleswitch end-->