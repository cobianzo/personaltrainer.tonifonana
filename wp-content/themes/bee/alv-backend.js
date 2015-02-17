
jQuery(document).ready(function() {

	jQuery("#adminmenuback, #adminmenuwrap, .form-table:first").hide();
	jQuery("h3:first").html("<a href='"+jQuery("#wp-admin-bar-site-name a:first").attr('href')+"' class='button button-primary'>Volver a inicio Deltabinol.com</a>");

});