$(function() {
	$('.add-profile').live('click', function(e) {
		location.href = $(this).data('href');
	});
	
	$('.profile-delete').live('click', function(e){
		if(confirm('Do you want to delete?')) {
			location.href = $(this).data('href');
		}
	});
});
