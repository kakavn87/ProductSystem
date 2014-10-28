$(function() {
	$('.add-profile').live('click', function(e) {
		location.href = $(this).data('href');
	});
});
