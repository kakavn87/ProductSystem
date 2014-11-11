$(function() {
	$('.add-requirement').live('click', function(e) {
		var formData = {};
		formData.description = $('.name-requirement').val();
		formData.id = $('.id-requirement').val();
		
		$.ajax({
			url : BASE_URL + 'requirements/add',
			type : 'post',
			data : formData,
		}).done(function(data) {
			var obj = $.parseJSON(data);
			if(obj.status) {
				showDialog("Error", obj.message);
			} else {
				showDialog("Success", 'Create new requirement successful');
				
				if(obj.type == 'add') {
					var html = '<tr>';
					html += '<td class="edit edit-requirement edited" data-id="' + obj.requirement_id + '">' + formData.description + '</td>';
					html += '<td class="delete delete-requirement" data-id="' + obj.requirement_id + '">Delete</td>';
					html += '<td class="select select-requirement" data-id="' + obj.requirement_id + '">Select</td>';
					html += '</tr>';
				} else {
					$('.edited').text(formData.description);
				}
				
				$('#tabs-1 table').append(html);
			}
		});
	});
	
	$('.edit-requirement').live('click', function(e) {
		$('.name-requirement').val($(this).text());
		$('.id-requirement').val($(this).data('id'));
		
		$('.edit').removeClass('edited');
		$(this).addClass('edited');
	});
	
	$('.delete-requirement').live('click', function(e) {
		if(confirm('Do tou want to delete this requirement?')) {
			var id = $(this).data('id');
			var $this = $(this);
			$.ajax({
				url : BASE_URL + 'requirements/delete/' + id,
			}).done(function(data) {
				var obj = $.parseJSON(data);
				if(obj.status) {
					showDialog("Error", obj.message);
				} else {
					$this.parent().remove();
				}
				
			});
		}
	});
	
	$('.select-requirement').live('click', function(e) {
		$('#tabs-1 table tr td.select').removeClass('selected').html('Select');
		$(this).addClass('selected').text('');
		
		$('#requirments').val($(this).data('id'));
	});
	
	
});