/**
 * WordPress jQuery-Ajax-Comments v1.3 by Willin Kan.
 * URI: http://kan.willin.org/?p=1271
 */
var i = 0, got = -1, len = document.getElementsByTagName('script').length;
while ( i <= len && got == -1){
	var js_url = document.getElementsByTagName('script')[i].src,
			got = js_url.indexOf('comments-ajax.js'); i++ ;
}
var edit_mode = '1', // Allows re-edit or not ( '1'=yes; '0'=no )
		ajax_php_url = js_url.replace('-ajax.js','-ajax.php'),
		wp_url = js_url.substr(0, js_url.indexOf('wp-content')),
		pic_sb = wp_url + 'wp-admin/images/wpspin_dark.gif', // load icon
		pic_no = wp_url + 'wp-admin/images/no.png',      // error icon
		pic_ys = wp_url + 'wp-admin/images/yes.png',     // succes icon
		txt1 = '<div id="comment-sending" class="">Sending...</div>',
		txt2 = '<div id="error">#</div>',
		txt3 = '"><p class="sucess-tip clearfix">Congratulate',
		edt1 = '! You could <a rel="nofollow" class="comment-reply-link" href="#edit" onclick=\'return addComment.moveForm("',
		edt2 = ')\'>edit</a> this comment before refresh the page</p>',
		cancel_edit = 'Cancel editing',
		edit, num = 1, comm_array=[]; comm_array.push('');

jQuery(document).ready(function($) {
		$comments = jQuery('#comments-title'); // comments number ID
	$cancel = jQuery('#cancel-comment-reply-link'); cancel_text = $cancel.text();
	$submit = jQuery('#commentform #submit'); $submit.attr('disabled', false);
	jQuery('#comment').after( txt1 + txt2 ); jQuery('#comment-sending').hide(); jQuery('#error').hide();
	$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? jQuery('html') : jQuery('body')) : jQuery('html,body');

/** submit */
jQuery('#commentform').submit(function() {
	jQuery('#comment-sending').slideDown();
	$submit.attr('disabled', true).fadeTo('slow', 0.5);
	if ( edit ) jQuery('#comment').after('<input type="text" name="edit_id" id="edit_id" value="' + edit + '" style="display:none;" />');

/** Ajax */
jQuery.ajax( {
	url: ajax_php_url,
	data: jQuery(this).serialize(),
	type: jQuery(this).attr('method'),

	error: function(request) {
		jQuery('#comment-sending').slideUp();
		jQuery('#error').slideDown().html(request.responseText);
		setTimeout(function() {$submit.attr('disabled', false).fadeTo('slow', 1); jQuery('#error').slideUp();}, 3000);
		},

	success: function(data) {
		jQuery('#comment-sending').hide();
		comm_array.push(jQuery('#comment').val());
		jQuery('textarea').each(function() {this.value = ''});
		var t = addComment, cancel = t.I('cancel-comment-reply-link'), temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId), post = t.I('comment_post_ID').value, parent = t.I('comment_parent').value;

//comments
	if ( ! edit && $comments.length ) {
		n = parseInt($comments.text().match(/\d+/));
		$comments.text($comments.text().replace( n, n + 1 ));
	}

//show comment
	new_htm = '" id="new_comm_' + num + '"></';
	new_htm = ( parent == '0' ) ? ('\n<ol style="clear:both;display:inline-block" class="commentlist' + new_htm + 'ol>') : ('\n<ul class="children' + new_htm + 'ul>');

	ok_htm = '\n<span id="success_' + num + txt3;
	if ( edit_mode == '1' ) {
		div_ = (document.body.innerHTML.indexOf('div-comment-') == -1) ? '' : ((document.body.innerHTML.indexOf('li-comment-') == -1) ? 'div-' : '');
		ok_htm = ok_htm.concat(edt1, div_, 'comment-', parent, '", "', parent, '", "respond", "', post, '", ', num, edt2);
	}
	ok_htm += '</span><span></span>\n';

	jQuery('#respond').before(new_htm);
	jQuery('#new_comm_' + num).hide().append(data);
	jQuery('#new_comm_' + num + ' li').append(ok_htm);
	jQuery('#new_comm_' + num).fadeIn(4000);
	jQuery('.comm-u-wrap').css('display','block');////////////////
	$body.animate( { scrollTop: jQuery('#new_comm_' + num).offset().top - 200}, 900);
	countdown(); num++ ; edit = ''; jQuery('*').remove('#edit_id');
	cancel.style.display = 'none';
	cancel.onclick = null;
	t.I('comment_parent').value = '0';
	if ( temp && respond ) {
		temp.parentNode.insertBefore(respond, temp);
		temp.parentNode.removeChild(temp)
	}
	}
}); // end Ajax
return false;
}); // end submit

/** comment-reply.dev.js */
addComment = {
moveForm : function(commId, parentId, respondId, postId, num) {
	var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');
	if ( edit ) exit_prev_edit();
	num ? (
		t.I('comment').value = comm_array[num],
		edit = t.I('new_comm_' + num).innerHTML.match(/(comment-)(\d+)/)[2],
		$new_sucs = jQuery('#success_' + num ), $new_sucs.hide(),
		$new_comm = jQuery('#new_comm_' + num ), $new_comm.hide(),
		$cancel.text(cancel_edit)
	) : $cancel.text(cancel_text);

	t.respondId = respondId;
	postId = postId || false;

	if ( !t.I('wp-temp-form-div') ) {
		div = document.createElement('div');
		div.id = 'wp-temp-form-div';
		div.style.display = 'none';
		respond.parentNode.insertBefore(div, respond)
	}

	!comm ? ( 
		temp = t.I('wp-temp-form-div'),
		t.I('comment_parent').value = '0',
		temp.parentNode.insertBefore(respond, temp),
		temp.parentNode.removeChild(temp)
	) : comm.parentNode.insertBefore(respond, comm.nextSibling);

	$body.animate( { scrollTop: jQuery('#respond').offset().top - 180 }, 400);

	if ( post && postId ) post.value = postId;
	parent.value = parentId;
	cancel.style.display = '';

	cancel.onclick = function() {
		if ( edit ) exit_prev_edit();
		var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

		t.I('comment_parent').value = '0';
		if ( temp && respond ) {
			temp.parentNode.insertBefore(respond, temp);
			temp.parentNode.removeChild(temp);
		}
		this.style.display = 'none';
		this.onclick = null;
		return false;
	};

	try { t.I('comment').focus(); }
	catch(e) {}

	return false;
},

I : function(e) {
	return document.getElementById(e);
}
}; // end addComment

function exit_prev_edit() {
	$new_comm.show(); $new_sucs.show();
	jQuery('textarea').each(function() {this.value = ''});
	edit = '';
}

var wait = 15, submit_val = $submit.val();
function countdown() {
	if ( wait > 0 ) {
		$submit.val(wait); wait--; setTimeout(countdown, 1000);
	} else {
		$submit.val(submit_val).attr('disabled', false).fadeTo('slow', 1);
		wait = 15;
	}
}

});// end jQ