$(function() {
	$('.add-profile').live('click', function(e) {
		location.href = $(this).data('href');
	});
	
	$('.profile-delete').live('click', function(e){
		if(confirm('Do you want to delete?')) {
			location.href = $(this).data('href');
		}
	});
	
	$('.type').live('change', function(e) {
		if($(this).val() == 'modul') {
			$('.operator, .value').show();
		} else {
			$('.operator, .value').hide();
		}
	});
	
	$( ".name-profile" ).autocomplete({
		 source: function( request, response ) {
			 $.ajax({
				 url : BASE_URL + 'profiles/get_profiles',
				 data: {
					 q: request.term, 
					 type: $('.type').val()
				 },
				 success: function( data ) {
					 var autoCompleteData = $.parseJSON(data);
					 response($.map(autoCompleteData, function(c) {
			             return {
			                 label: c.name,
			                 value: c.name
			             }
					 }));
				 }
			 });
		 },
		 minLength: 2
	});
});
