<?php

header("Content-type: text/css; charset: UTF-8");
	
require_once('../../../../../wp-load.php');
global $theme_google_fonts;


/////////////////
////Styling/////
////////////////

/*
Ganeral 
*/
/*Main color*/
if(get_option('theme_option_color_theme_main')){ ?>
.entry p a,.text_block a,.post_meta > li a:hover, #sidebar a:hover, #comments .comment-author a:hover,#comments .reply a:hover,.fourofour-wrap a,.blog_meta a:hover,.breadcrumbs a:hover,.link-wrap a:hover,.item_title a:hover,.item_des a:hover,.archive-wrap h3 a:hover,.carousel-wrap a:hover,.iocnbox:hover i,.blog-item-main h2 a:hover,div.bbp-template-notice,a:hover,.icon_text a,
#megaMenu ul li.menu-item.ss-nav-menu-mega ul ul.sub-menu li.menu-item a:hover,
#megaMenu ul ul.sub-menu > li.menu-item:hover > a { color:<?php echo get_option('theme_option_color_theme_main'); ?>; }
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-highlight > a,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-highlight > span.um-anchoremulator {
  color: <?php echo get_option('theme_option_color_theme_main'); ?> !important;
}
#respondwrap input#submit,.entry .contactform input.idi_send,.nav-tabs > li > a:hover,.process-bar,
.pagenums a:hover,.sidebar_widget .widget_search input[type="submit"]:hover,#foot_widget .tagcloud a:hover,.sidebar_widget .tagcloud a:hover,
#foot_widget .widget_uxconatactform input#idi_send:hover,#foot_widget .widget_search input[type="submit"]:hover,input.idi_send:hover,
.team-item-con-back,.testimenials:hover,.testimenials:hover .arrow-bg,
#navi>div>ul li.current-menu-item>a,
#navi>div>ul li.current-menu-parent>a,
#navi>div>ul>li.current-menu-ancestor>a,
#navi>div>ul>li:hover>a,
.fixed-menu-class li.current-menu-item,
.fixed-menu-class li.current-menu-parent,
.fixed-menu-class>li.current-menu-ancestor,
.fixed-menu-class>li:hover,
.sidebar_widget .widget_uxconatactform input#idi_send:hover,.filters li:hover a,.page-numbers:hover,button:hover,
.sidebar_widget .widget_display_search input[type="submit"]:hover,#bbp-user-navigation li a:hover,input.wpcf7-form-control.wpcf7-submit:hover,
#megaMenu ul.megaMenu > li.menu-item:hover > a,
#megaMenu ul.megaMenu > li.menu-item > a:hover,
#megaMenu ul.megaMenu > li.menu-item.megaHover > a,
#megaMenu ul.megaMenu > li.menu-item:hover > span.um-anchoremulator,
#megaMenu ul.megaMenu > li.menu-item > span.um-anchoremulator:hover,
#megaMenu ul.megaMenu > li.menu-item.megaHover > span.um-anchoremulator,
.single-feild input#idi_send,
.fullwrap-with-tab-nav>a:hover,
.fullwrap-with-tab-nav>a.full-nav-actived,
#backtop:hover{ background-color:<?php echo get_option('theme_option_color_theme_main'); ?>; }
.nav-tabs > li > a:hover,
#foot_widget .widget_uxconatactform input:focus,
#foot_widget .widget_uxconatactform textarea:focus,
#foot_widget .widget_search input[type="text"]:focus,
textarea:focus,input[type="text"]:focus,input[type="password"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="time"]:focus,input[type="week"]:focus,input[type="number"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="search"]:focus,input[type="tel"]:focus,input[type="color"]:focus,.uneditable-input:focus,
.sidebar_widget .widget_uxconatactform textarea:focus, 
.sidebar_widget .widget_uxconatactform input[type="text"]:focus,
#navi>div>ul ul.sub-menu li.current-menu-item>a,
#navi>div>ul .sub-menu li:hover>a,
#navi ul li ul.sub-menu li.current-menu-ancestor>a,
.fixed-menu-class .sub-menu li:hover,
.fixed-menu-class .sub-menu li.current-menu-item,
.fixed-menu-class .sub-menu li.current-menu-ancestor,
.accordion-heading:hover,
#respondwrap textarea:focus,
#respondwrap input:focus,
.fullwrap-with-tab-nav>a.full-nav-actived,
.fullwrap-with-tab-nav>a:hover,
.single-feild:hover{ border-color:<?php echo get_option('theme_option_color_theme_main'); ?>; }

<?php
}else{
	if(get_option('theme_option_select_color_scheme')){ 
	
		if(get_option('theme_option_select_color_scheme') =='theme-color-1' ){ 
			$theme_color = '#ee7164'; 
		}elseif(get_option('theme_option_select_color_scheme') =='theme-color-2' ){
			$theme_color = '#be9ecd';
		}elseif(get_option('theme_option_select_color_scheme') =='theme-color-3' ){
			$theme_color = '#f67bb5';
		}elseif(get_option('theme_option_select_color_scheme') =='theme-color-4' ){
			$theme_color = '#77c9e1';
		}elseif(get_option('theme_option_select_color_scheme') =='theme-color-5' ){
			$theme_color = '#5a6b7f';
		}elseif(get_option('theme_option_select_color_scheme') =='theme-color-6' ){
			$theme_color = '#b8b69d';
		}elseif(get_option('theme_option_select_color_scheme') =='theme-color-7' ){
			$theme_color = '#34bc99';
		}elseif(get_option('theme_option_select_color_scheme') =='theme-color-8' ){
			$theme_color = '#e8b900';
		}elseif(get_option('theme_option_select_color_scheme') =='theme-color-9' ){
			$theme_color = '#ce671e';
		}elseif(get_option('theme_option_select_color_scheme') =='theme-color-10' ){	 
			$theme_color = '#454545';
		}
		
	
	?>
	
	
a:hover,.entry p a,.post_meta > li a:hover, #sidebar a:hover, #comments .comment-author a:hover,#comments .reply a:hover,.fourofour-wrap a,.blog_meta a:hover,.breadcrumbs a:hover,.link-wrap a:hover,.item_title a:hover,.item_des a:hover,.archive-wrap h3 a:hover,.carousel-wrap a:hover,.iocnbox:hover i,.blog-item-main h2 a:hover,div.bbp-template-notice,h1.main_title .bbp-breadcrumb a:hover,.icon_text a,
#megaMenu ul li.menu-item.ss-nav-menu-mega ul ul.sub-menu li.menu-item a:hover,
#megaMenu ul ul.sub-menu > li.menu-item:hover > a { color:<?php echo $theme_color; ?>; }
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-highlight > a,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-highlight > span.um-anchoremulator {
  color: <?php echo $theme_color; ?> !important;
}
#respondwrap input#submit,.entry .contactform input.idi_send,.nav-tabs > li > a:hover,.process-bar,
.pagenums a:hover,.sidebar_widget .widget_search input[type="submit"]:hover,#foot_widget .tagcloud a:hover,.sidebar_widget .tagcloud a:hover,
#foot_widget .widget_uxconatactform input#idi_send:hover,#foot_widget .widget_search input[type="submit"]:hover,input.idi_send:hover,
.team-item-con-back,.testimenials:hover,.testimenials:hover .arrow-bg,
#navi>div>ul li.current-menu-item>a,
#navi>div>ul li.current-menu-parent>a,
#navi>div>ul>li.current-menu-ancestor>a,
#navi>div>ul>li:hover>a,
.fixed-menu-class li.current-menu-item,
.fixed-menu-class li.current-menu-parent,
.fixed-menu-class>li.current-menu-ancestor,
.fixed-menu-class>li:hover,
.sidebar_widget .widget_uxconatactform input#idi_send:hover,.filters li:hover a,.page-numbers:hover,button:hover,
.sidebar_widget .widget_display_search input[type="submit"]:hover,#bbp-user-navigation li a:hover,input.wpcf7-form-control.wpcf7-submit:hover,
#megaMenu ul.megaMenu > li.menu-item:hover > a,
#megaMenu ul.megaMenu > li.menu-item > a:hover,
#megaMenu ul.megaMenu > li.menu-item.megaHover > a,
#megaMenu ul.megaMenu > li.menu-item:hover > span.um-anchoremulator,
#megaMenu ul.megaMenu > li.menu-item > span.um-anchoremulator:hover,
#megaMenu ul.megaMenu > li.menu-item.megaHover > span.um-anchoremulator,.single-feild input#idi_send,
.fullwrap-with-tab-nav>a:hover,
.fullwrap-with-tab-nav>a.full-nav-actived,
#backtop:hover{ background-color:<?php echo $theme_color; ?>; }
.nav-tabs > li > a:hover,
#foot_widget .widget_uxconatactform input:focus,
#foot_widget .widget_uxconatactform textarea:focus,
#foot_widget .widget_search input[type="text"]:focus,
textarea:focus,input[type="text"]:focus,input[type="password"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="time"]:focus,input[type="week"]:focus,input[type="number"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="search"]:focus,input[type="tel"]:focus,input[type="color"]:focus,.uneditable-input:focus,
.sidebar_widget .widget_uxconatactform textarea:focus, 
.sidebar_widget .widget_uxconatactform input[type="text"]:focus,
#navi>div>ul ul.sub-menu li.current-menu-item>a,
#navi>div>ul .sub-menu li:hover>a,
#navi ul li ul.sub-menu li.current-menu-ancestor>a,
.fixed-menu-class .sub-menu li:hover,
.fixed-menu-class .sub-menu li.current-menu-item,
.fixed-menu-class .sub-menu li.current-menu-ancestor,
.accordion-heading:hover,
#respondwrap textarea:focus,
#respondwrap input:focus,
.fullwrap-with-tab-nav>a.full-nav-actived,
.fullwrap-with-tab-nav>a:hover,
.single-feild:hover{ border-color:<?php echo $theme_color; ?>; }

	<?php	
	}
}

/* Auxiliary First_color e.g. header topbar, pagination button ... default #333 */
if(get_option('theme_option_auxiliary_first_color')){
	?>
#top_bar,.header_line,#header-meun-bar,.team-item-con,.archive-wrap li:before,.slider-panel,.comm-reply-title,
.sidebar_widget .widget_uxconatactform input#idi_send,.pagenums .current,.filters li.active a,.promote-button:hover,
.page-numbers.current,.ux-btn:hover,#bbp-user-navigation li.current a,#navi a,#socialicons a,.header-layout-a #search_top,
.fixed-menu-class,#footer_wrap,button, input[type="submit"],#respondwrap input#submit:hover,
.entry .contactform input.idi_send:hover,#megaMenu ul.megaMenu > li.menu-item,.single-feild input#idi_send:hover,
.post-carousel-pagination a.selected,#backtop { background-color: <?php echo get_option('theme_option_auxiliary_first_color'); ?>;} 
.accordion-heading{ border-color:<?php echo get_option('theme_option_auxiliary_first_color'); ?>;}
.team-item-con-back a,.team-item-con-back i,.team-item-con-h p,#sidebar .social_active i:hover{ color:<?php echo get_option('theme_option_auxiliary_first_color'); ?>;}
	<?php
}

/* Auxiliary Second_color e.g. sidbar,filter button ... default #f7f7f7 */
if(get_option('theme_option_auxiliary_second_color')){
	?>
ul.sidebar_widget,.quote-wrap,#main_title_wrap,.filters li a,.item_des,.audio_player_list,.promote-wrap,.process-bar-wrap,.post_meta,#advanced_menu_toggle, #advanced_menu_toggle2,.pagenumber a,.pagenumber span,.testimenials,.testimenials .arrow-bg,.pagenums a,.pagenums span,.accordion-heading,.page-numbers,div #bbpress-forums li.bbp-header,#bbp-user-navigation li a,.single-feild,.liquid-body,.fullwrap-with-tab-nav>a{ background-color: <?php echo get_option('theme_option_auxiliary_second_color'); ?>;} 
.border-style2,.border-style3{ border-color:<?php echo get_option('theme_option_auxiliary_second_color'); ?>;}
	<?php
}

/*Title color*/
if(get_option('theme_option_color_title')){
	?>
h1.main_title,h1.main_title a,span#comments_inlist,#comments .comment-author a,h1,h2,h3,h4,h5,h6,
.blog-item-main h2 a,.item_title a,#search_mobile .search_top_form input[type="search"], #search_mobile .search_top_form input[type="text"],
.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus,.accordion-heading .accordion-toggle,.item_des .item_title a, 
.infrographic.bar .bar-percent,.jqbar.vertical span{ color: <?php echo get_option('theme_option_color_title'); ?>}
li.commlist-unit{ border-left-color:<?php echo get_option('theme_option_color_title'); ?>}<?php
}

/*Main font color*/
if(get_option('theme_option_color_content_text')){
	?>
body,a,.entry p a:hover,.text_block a:hover,#content_wrap,#comments .reply a,#comments,.blog-item-excerpt,
.item_des,.item_des a,.filters li a,.header-info-mobile,.carousel-wrap a.disabled:hover{ color: <?php echo get_option('theme_option_color_content_text'); ?>} <?php
}

/* Auxiliary\Meta font color*/
if(get_option('theme_option_color_auxiliary_content')){
	?>
.post_meta>li,.post_meta>li a,.blog_meta,.blog_meta a,.breadcrumbs,.breadcrumbs a,
#mobile-header-meta p,.bbp-meta,.bbp-meta a,.bbp-author-role,.bbp-pagination-count,span.bbp-author-ip,
.infrographic-subtit,.breadcrumbs a:hover:after{ color: <?php echo get_option('theme_option_color_auxiliary_content'); ?>} <?php
}

/*Selected Text Bg Color*/
if(get_option('theme_option_color_selected_text_bg')){
	?>::selection{background: <?php echo get_option('theme_option_color_selected_text_bg'); ?>;color:#fff;} <?php
	?>::-moz-selection{background: <?php echo get_option('theme_option_color_selected_text_bg'); ?>;color:#fff;} <?php
	?>::-webkit-selection{background: <?php echo get_option('theme_option_color_selected_text_bg'); ?>;color:#fff;} <?php
}

/*
Background (Bg)
*/

/*Page bg*/
if(get_option('theme_option_color_page_bg')){
	?>
#wrap,.separator h4,
.nav-tabs > .active > a, 
.nav-tabs > .active > a:hover, 
.nav-tabs > .active > a:focus,
.tab-content{background-color: <?php echo get_option('theme_option_color_page_bg'); ?>;} 
.testimenials span.arrow,.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus{ border-bottom-color: <?php echo get_option('theme_option_color_page_bg'); ?>;}
.tabs-v .nav-tabs > .active > a{ border-right-color:<?php echo get_option('theme_option_color_page_bg'); ?>;}
	<?php
}

/*Boxed Layout Bg Color*/
if(get_option('theme_option_color_boxed_layout_bg')){
	?>body{background-color: <?php echo get_option('theme_option_color_boxed_layout_bg'); ?>;} <?php
}
/*Boxed Layout Bg image*/
if(get_option('theme_option_upload_boxed_layout_bg')){
	?>body{background-image: url(<?php echo get_option('theme_option_upload_boxed_layout_bg'); ?>);} <?php
}
/*Boxed Layout Bg image repeat*/
if(get_option('theme_option_upload_boxed_layout_bg_repeat')){
	?>body{background-repeat: <?php echo get_option('theme_option_upload_boxed_layout_bg_repeat'); ?>;} <?php
}
/*Boxed Layout Bg image attachment*/
if(get_option('theme_option_upload_boxed_layout_bg_attachment')){
	?>body{background-attachment: <?php echo get_option('theme_option_upload_boxed_layout_bg_attachment'); ?>;} <?php
}
/*
Logo

Logo Text Color*/
if(get_option('theme_option_color_logo_text')){
	?>#logo h1{color: <?php echo get_option('theme_option_color_logo_text'); ?>;} <?php
}
/*
Menu
*/

/*Menu Item Text Color*/
if(get_option('theme_option_color_menu_item_text')){
	?>
#navi a,#socialicons i, .search_top_form input[type="search"], .search_top_form input[type="text"],
#megaMenu ul.megaMenu > li.menu-item > a span.wpmega-link-title, 
#megaMenu ul.megaMenu > li.menu-item > span.um-anchoremulator span.wpmega-link-title{ color: <?php echo get_option('theme_option_color_menu_item_text'); ?>;} 
#megaMenu ul.megaMenu li.menu-item.mega-with-sub > a:after,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-mega > a:after,
#megaMenu ul.megaMenu li.menu-item.mega-with-sub > span.um-anchoremulator:after,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-mega > span.um-anchoremulator:after{ border-top-color:<?php echo get_option('theme_option_color_menu_item_text'); ?>;}
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg li.menu-item.megaReg-with-sub > a:after,
#megaMenu ul li.menu-item.ss-nav-menu-reg li.menu-item.megaReg-with-sub > span.um-anchoremulator:after {border-left-color: <?php echo get_option('theme_option_color_menu_item_text'); ?>;}
	<?php
}

/*Activated Item Text Color*/
if(get_option('theme_option_color_activated_item_text')){
	?>#navi .current-menu-item>a,
#navi li:hover>a,
#navi>div>ul li.current-menu-parent>a,
#navi>div>ul>li.current-menu-ancestor>a,
#navi .sub-menu li:hover>a,
#navi .sub-menu li.current-menu-item>a,
.fixed-menu-class .current-menu-item>a,
.fixed-menu-class li:hover>a,
.fixed-menu-class li.current-menu-parent>a,
.fixed-menu-class li.current-menu-ancestor>a,
.fixed-menu-class .sub-menu li.current-menu-ancestor>a,
.fixed-menu-class .sub-menu li:hover>a,
.fixed-menu-class .sub-menu li.current-menu-item>a,
#megaMenu ul.megaMenu > li.menu-item:hover > a,
#megaMenu ul.megaMenu > li.menu-item > a:hover,
#megaMenu ul.megaMenu > li.menu-item.megaHover > a,
#megaMenu ul.megaMenu > li.menu-item:hover > span.um-anchoremulator,
#megaMenu ul.megaMenu > li.menu-item > span.um-anchoremulator:hover,
#megaMenu ul.megaMenu > li.menu-item.megaHover > span.um-anchoremulator{ color: <?php echo get_option('theme_option_color_activated_item_text'); ?>;} 
#megaMenu ul.megaMenu li.menu-item.mega-with-sub:hover > a:after,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-mega:hover > a:after,
#megaMenu ul.megaMenu li.menu-item.mega-with-sub:hover > span.um-anchoremulator:after,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-mega:hover > span.um-anchoremulator:after {
  border-top-color: <?php echo get_option('theme_option_color_activated_item_text'); ?>;
}
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg li.menu-item.megaReg-with-sub:hover > a:after,
#megaMenu ul li.menu-item.ss-nav-menu-reg li.menu-item.megaReg-with-sub:hover > span.um-anchoremulator:after {
  border-left-color: <?php echo get_option('theme_option_color_activated_item_text'); ?>;
}
<?php
}

/*Submenu Bg Color*/
if(get_option('theme_option_color_submenu_bg')){
	?>
#megaMenu ul.megaMenu > li.menu-item.ss-nav-menu-mega > ul.sub-menu-1, 
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg ul.sub-menu{background:none;}	
#navi ul li ul.sub-menu,
#navi ul li ul.sub-menu li a,
#navi>div>ul .sub-menu li:hover>a,
#navi>div>ul ul.sub-menu li.current-menu-item>a,
.fixed-menu-class .sub-menu,
.fixed-menu-class .sub-menu li,
.fixed-menu-class .sub-menu li:hover,
.fixed-menu-class .sub-menu li.current-menu-item,
#megaMenu ul.megaMenu > li.menu-item.ss-nav-menu-mega > ul.sub-menu-1, 
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg ul.sub-menu{ background-color: <?php echo get_option('theme_option_color_submenu_bg'); ?>; } 
#navi ul li ul.sub-menu li a,
.fixed-menu-class ul.sub-menu li{ border-right-color: <?php echo get_option('theme_option_color_submenu_bg'); ?>;}<?php
}
/*Submenu Text Color*/
if(get_option('theme_option_color_submenu_text')){
	?>#navi ul.sub-menu li a,
.fixed-menu-class .sub-menu li a,
#megaMenu ul li.menu-item.ss-nav-menu-mega ul.sub-menu-1 > li.menu-item > a,
#megaMenu ul li.menu-item.ss-nav-menu-mega ul.sub-menu-1 > li.menu-item:hover > a,
#megaMenu ul li.menu-item.ss-nav-menu-mega ul ul.sub-menu .ss-nav-menu-header > a,
#megaMenu ul li.menu-item.ss-nav-menu-mega ul.sub-menu-1 > li.menu-item > span.um-anchoremulator,
#megaMenu ul li.menu-item.ss-nav-menu-mega ul ul.sub-menu .ss-nav-menu-header > span.um-anchoremulator,
#megaMenu .wpmega-widgetarea h2.widgettitle,
#megaMenu ul li.menu-item.ss-nav-menu-mega ul ul.sub-menu li.menu-item > a,
#megaMenu ul li.menu-item.ss-nav-menu-mega ul ul.sub-menu li.menu-item > span.um-anchoremulator,
#megaMenu ul ul.sub-menu li.menu-item > a,
#megaMenu ul ul.sub-menu li.menu-item > span.um-anchoremulator{color: <?php echo get_option('theme_option_color_submenu_text'); ?>;} <?php
}

/* 
Sidebar
*/
/*Sidebar Widget Title Color*/
if(get_option('theme_option_color_sidebar_widget_title')){
	?>#sidebar h3.widget-title,#sidebar h3.widget-title a {color: <?php echo get_option('theme_option_color_sidebar_widget_title'); ?>;} <?php
}
/*Sidebar Widget Content Color*/
if(get_option('theme_option_color_sidebar_widge_content')){
	?>#sidebar, #sidebar a{color: <?php echo get_option('theme_option_color_sidebar_widge_content'); ?>;} <?php
}

/*
Footer
*/

/*Copyright Text Color*/
if(get_option('theme_option_color_copyright_text')){
	?>#footer-bar,#footer-bar a{color: <?php echo get_option('theme_option_color_copyright_text'); ?>;} <?php
}
/*Widget Title Color*/
if(get_option('theme_option_color_widget_title')){
	?>#foot_widget h3.widget-title,#foot_widget h3.widget-title a,#foot_widget a:hover{color: <?php echo get_option('theme_option_color_widget_title'); ?>;} <?php
}
/*Widget Content Color*/
if(get_option('theme_option_color_widget_content')){
	?>#foot_widget,#foot_widget a {color: <?php echo get_option('theme_option_color_widget_content'); ?>;} <?php
}


//////////////////////
////Font settings/////
//////////////////////

/* Main Font*/
if(get_option('theme_option_fonts_main-family')){
	?>body, input[type="text"], textarea,div.bbp-template-notice p,legend{<?php echo $theme_google_fonts[get_option('theme_option_fonts_main-family')]['css']; ?>} <?php
}

/* Heading Font*/
if(get_option('theme_option_fonts_heading-family')){
	?>h1,h2,h3,h4,h5,h6,span#comments_inlist{<?php echo $theme_google_fonts[get_option('theme_option_fonts_heading-family')]['css']; ?>} <?php
}

/* Logo Font */
if(get_option('theme_option_fonts_logo-family')){
	?>#logo h1{<?php echo $theme_google_fonts[get_option('theme_option_fonts_logo-family')]['css']; ?>} <?php
}

if(get_option('theme_option_fonts_logo-size')){
	?>#logo h1{font-size: <?php echo get_option('theme_option_fonts_logo-size'); ?>;} <?php
}

if(get_option('theme_option_fonts_logo-style')){
	?>#logo h1{<?php if(get_option('theme_option_fonts_logo-style') == 'normal'){ echo 'font-weight: normal; font-style: normal;'; }elseif(get_option('theme_option_fonts_logo-style') == 'bold'){ echo 'font-weight: bold; font-style: normal;'; }elseif(get_option('theme_option_fonts_logo-style') == 'italic'){ echo 'font-weight: normal; font-style: italic;'; } elseif(get_option('theme_option_fonts_logo-style') == 'light'){ echo 'font-weight: 300; font-style:normal;'; }?> } <?php
}

/*Menu font*/
if(get_option('theme_option_fonts_menu-family')){
	?>
#navi a,input.search_top_form_text[type="search"],
.header-layout-b input.search_top_form_text[type="text"],
.wpmega-link-title
{<?php echo $theme_google_fonts[get_option('theme_option_fonts_menu-family')]['css']; ?>} <?php
}

if(get_option('theme_option_fonts_menu-size')){
	?>
#navi a,input.search_top_form_text[type="search"],
.header-layout-b input.search_top_form_text[type="text"],
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-item-depth-0 > a span {font-size: <?php echo get_option('theme_option_fonts_menu-size'); ?>;} <?php
}

if(get_option('theme_option_fonts_menu-style')){
	?>
#navi a,input.search_top_form_text[type="search"],
.header-layout-b input.search_top_form_text[type="text"],
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-item-depth-0 > a span{<?php if(get_option('theme_option_fonts_menu-style') == 'normal'){ echo 'font-weight: normal; font-style: normal;'; }elseif(get_option('theme_option_fonts_menu-style') == 'bold'){ echo 'font-weight: bold; font-style: normal;'; }elseif(get_option('theme_option_fonts_menu-style') == 'italic'){ echo 'font-weight: normal; font-style: italic;'; }elseif(get_option('theme_option_fonts_menu-style') == 'italic'){ echo 'font-weight: normal; font-style: italic;'; } elseif(get_option('theme_option_fonts_menu-style') == 'light'){ echo 'font-weight: 300; font-style:normal;'; }?>} <?php
}

/* Post & page Title*/
if(get_option('theme_option_fonts_post_page_title-size')){
	?>.single .main_title, .page .main_title{ font-size: <?php echo get_option('theme_option_fonts_post_page_title-size'); ?>; } <?php
}

if(get_option('theme_option_fonts_post_page_title-style')){
	?>.single .main_title, .page .main_title{<?php if(get_option('theme_option_fonts_post_page_title-style') == 'normal'){ echo 'font-weight: normal; font-style: normal;'; }elseif(get_option('theme_option_fonts_post_page_title-style') == 'bold'){ echo 'font-weight: bold; font-style: normal;'; }elseif(get_option('theme_option_fonts_post_page_title-style') == 'italic'){ echo 'font-weight: normal; font-style: italic;'; }elseif(get_option('theme_option_fonts_post_page_title-style') == 'light'){ echo 'font-weight: 300; font-style: normal;'; }?>} <?php
}

/*Post & page Content*/
if(get_option('theme_option_fonts_post_page_content-size')){
	?>.single #content, .page #content{font-size: <?php echo get_option('theme_option_fonts_post_page_content-size'); ?>;} <?php
}

if(get_option('theme_option_fonts_post_page_content-style')){
	?>.single #content, .page #content{<?php if(get_option('theme_option_fonts_post_page_content-style') == 'normal'){ echo 'font-weight: normal; font-style: normal;'; }elseif(get_option('theme_option_fonts_post_page_content-style') == 'bold'){ echo 'font-weight: bold; font-style: normal;'; }elseif(get_option('theme_option_fonts_post_page_content-style') == 'italic'){ echo 'font-weight: normal; font-style: italic;'; }elseif(get_option('theme_option_fonts_post_page_title-style') == 'light'){ echo 'font-weight: 300; font-style: normal;'; }?>} <?php
}

/*Sidebar Widget Title Font*/
if(get_option('theme_option_fonts_sidebar_title-size')){
	?>#sidebar .widget-container .widget-title, #sidebar h3{font-size: <?php echo get_option('theme_option_fonts_sidebar_title-size'); ?>;} <?php
}

if(get_option('theme_option_fonts_sidebar_title-style')){
	?>#sidebar .widget-container .widget-title, #sidebar h3{<?php if(get_option('theme_option_fonts_sidebar_title-style') == 'normal'){ echo 'font-weight: normal; font-style: normal;'; }elseif(get_option('theme_option_fonts_sidebar_title-style') == 'bold'){ echo 'font-weight: bold; font-style: normal;'; }elseif(get_option('theme_option_fonts_sidebar_title-style') == 'italic'){ echo 'font-weight: normal; font-style: italic;'; }elseif(get_option('theme_option_fonts_sidebar_title-style') == 'light'){echo 'font-weight: 300; font-style: normal;'; }?>} <?php
}

/*Sidebar Widget Content Font*/
if(get_option('theme_option_fonts_sidebar_content-size')){
	?>#sidebar .widget-container{font-size: <?php echo get_option('theme_option_fonts_sidebar_content-size'); ?>;} <?php
}

if(get_option('theme_option_fonts_sidebar_content-style')){
	?>#sidebar .widget-container{<?php if(get_option('theme_option_fonts_sidebar_content-style') == 'normal'){ echo 'font-weight: normal; font-style: normal;'; }elseif(get_option('theme_option_fonts_sidebar_content-style') == 'bold'){ echo 'font-weight: bold; font-style: normal;'; }elseif(get_option('theme_option_fonts_sidebar_content-style') == 'italic'){ echo 'font-weight: normal; font-style: italic;'; }elseif(get_option('theme_option_fonts_sidebar_content-style') == 'light'){echo 'font-weight:300; font-style: normal;';}?>} <?php
}

/*Footer Copyright Text*/
if(get_option('theme_option_fonts_footer_copyright_text-size')){
	?>#footer-bar{font-size: <?php echo get_option('theme_option_fonts_footer_copyright_text-size'); ?>;} <?php
}

if(get_option('theme_option_fonts_footer_copyright_text-style')){
	?>#footer-bar{<?php if(get_option('theme_option_fonts_footer_copyright_text-style') == 'normal'){ echo 'font-weight: normal; font-style: normal;'; }elseif(get_option('theme_option_fonts_footer_copyright_text-style') == 'bold'){ echo 'font-weight: bold; font-style: normal;'; }elseif(get_option('theme_option_fonts_footer_copyright_text-style') == 'italic'){ echo 'font-weight: normal; font-style: italic;'; }elseif(get_option('theme_option_fonts_footer_copyright_text-style') == 'light'){ echo 'font-weight: 300; font-style: normal;'; }?>} <?php
}

/*Footer Widget Title*/
if(get_option('theme_option_fonts_footer_widget_title-size')){
	?>#foot_widget .widget-container .widget-title, #foot_widget h3{font-size: <?php echo get_option('theme_option_fonts_footer_widget_title-size'); ?>;} <?php
}

if(get_option('theme_option_fonts_footer_widget_title-style')){
	?>#foot_widget .widget-container .widget-title, #foot_widget h3{<?php if(get_option('theme_option_fonts_footer_widget_title-style') == 'normal'){ echo 'font-weight: normal; font-style: normal;'; }elseif(get_option('theme_option_fonts_footer_widget_title-style') == 'bold'){ echo 'font-weight: bold; font-style: normal;'; }elseif(get_option('theme_option_fonts_footer_widget_title-style') == 'italic'){ echo 'font-weight: normal; font-style: italic;'; }elseif(get_option('theme_option_fonts_footer_widget_title-style') == 'light'){ echo 'font-weight: 300; font-style: normal;';}?>} <?php
}

/*Footer Widget Content*/
if(get_option('theme_option_fonts_footer_widget_content-size')){
	?>#foot_widget .widget-container{font-size: <?php echo get_option('theme_option_fonts_footer_widget_content-size'); ?>;} <?php
}

if(get_option('theme_option_fonts_footer_widget_content-style')){
	?>#foot_widget .widget-container{<?php if(get_option('theme_option_fonts_footer_widget_content-style') == 'normal'){ echo 'font-weight: normal; font-style: normal;'; }elseif(get_option('theme_option_fonts_footer_widget_content-style') == 'bold'){ echo 'font-weight: bold; font-style: normal;'; }elseif(get_option('theme_option_fonts_footer_widget_content-style') == 'italic'){ echo 'font-weight: normal; font-style: italic;'; }elseif(get_option('theme_option_fonts_footer_widget_content-style') == 'light'){ echo 'font-weight: 300; font-style: normal;';}?>} <?php
}

/*Custom css form theme option*/
ux_theme_option_show('custom_css');

?>
@media (max-width: 767px) { #main_title_wrap{ background:none; }}