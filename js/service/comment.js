$(function() {
	$('#addComment').live('click', addComment);
});

function addComment(e) {
	console.log('Add Comment');
	
	var comment = $('#comment-text').val();
	if(!comment.trim().length) {
		showDialog('Error', 'Please input a comment');
		return false;
	}
	
	
	$.ajax({
		url : BASE_URL + 'comments/save',
		type : 'post',
		data : {'comment': comment, 'service_id' : $('#serviceid').val()},
		beforeSend : function(xhr) {

		}
	}).done(function(data) {
		var obj = $.parseJSON(data);
		if(!obj.status) {
			loadCommentUser(obj);
			$('#comment-text').val('');
		} else {
			showDialog('Error', obj.message);
		}
	});
}

function loadCommentUser(obj) {
	var html = '';
	// load avatar
	
	html += '<div class="list">';
	html += '<div class="avatar"><img src="' + BASE_URL + 'css/images/avatar.png" /></div>';
	html += '<div class="comment-user"><div class="name-user">' + obj.user_name + '</div><div class="comment-content">' + obj.comment + '</div></div>';
	html += '</div><div class="clear"></div>';
	
	$('.comments-list').prepend(html);
}



