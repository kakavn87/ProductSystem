$(function() {
	$('.add-role-requirement').live('click', function(e) {
		if (e.target == this) {
			alert("add-role-requirement");
			//var role_requirement_id = $(this).data('id');
				$.ajax({
					url : BASE_URL + 'service/edit_role_requirement',
					type : 'post',
					data : {
						role_requirement_id : $(this).data('id'),
						service_id : $('.service_id').val(),
						role_id : $('.role_id').val()
					},
				}).done(function(data) {
					$('.contain-role-requirement').html(data);
				});
			
		}
	});

	$('.edit-role-requirement').live('click', function(e) {
		if (e.target == this) {
			
			//var role_requirement_id = $(this).data('id');
				$.ajax({
					url : BASE_URL + 'service/edit_role_requirement',
					type : 'post',
					data : {
						role_requirement_id : $(this).data('id'),
						service_id : $('.service_id').val(),
						role_id : $('.role_id').val()
					},
				}).done(function(data) {
					$('.contain-role-requirement').html(data);
				});
			
		}
	});
	

	$('.update-role-requirement').live('click', function(e) {
		if (e.target == this) {
			// alert($('.name-role_requirement').val());
			// alert($('.id_role_requirement').val());
			// alert($('.operator').val());
			// alert($('.type').val());
			alert("update_role_requirement");
				$.ajax({
					url : BASE_URL + 'service/update_role_requirement',
					type : 'post',
					data : {
						role_requirement_id : $('.id_role_requirement').val(),
						name:  $('.name-role_requirement').val(),
						operator : $('.operator').val(),
						type : $('.type').val(),
						value:  $('.value').val(),
						service_id : $('.service_id').val(),
						role_id : $('.role_id').val()
					},
				}).done(function(data) {
					$('.contain-role-requirement').html(data);
				});
				
		}
	});
	

	$('.delete-role-requirement').live('click', function(e){
		if(confirm('Do you want to delete?')) {
			$.ajax({
					url : BASE_URL + 'service/delete_role_requirement',
					type : 'post',
					data : {
						role_requirement_id : $(this).data('id'),
						
						service_id : $('.service_id').val(),
						role_id : $('.role_id').val()
					},
				}).done(function(data) {
					$('.contain-role-requirement').html(data);
				});
		}
	});
	
	$('.type').live('change', function(e) {
		if($(this).val() == 'modul') {
			$('.operator, .value').show();
		} else {
			$('.operator, .value').hide();
		}
	});
	
	$( ".name-role-requirement" ).autocomplete({
		 source: function( request, response ) {
			 $.ajax({
				 url : BASE_URL + 'profiles/get_prole-requirement',
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
