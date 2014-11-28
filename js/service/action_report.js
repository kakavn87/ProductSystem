$(function() {
	$('.add-report').live('click', function(e) {
		var formData = {};
		formData.name = $('.name-report').val();
		formData.description = $('.desc-report').val();
		formData.id = $('.id-report').val();
		
		$.ajax({
			url : BASE_URL + 'reports/add',
			type : 'post',
			data : formData,
		}).done(function(data) {
			var obj = $.parseJSON(data);
			if(obj.status) {
				showDialog("Error", obj.message);
			} else {
				showDialog("Success", 'Create new report successful');
				
				if(obj.type == 'add') {
					var html = '<tr>';
					html += '<td class="edit edit-report edited" data-desc="' + formData.description + '" data-id="' + obj.report_id + '">' + formData.name + '</td>';
					html += '<td class="delete delete-report" data-id="' + obj.report_id + '">Delete</td>';
					html += '<td class="select select-report" data-id="' + obj.report_id + '">Select</td>';
					html += '</tr>';
					
					$('#tabs-3 table').append(html);
				} else {
					$('.edited').data('desc', formData.description);
					$('.edited').text(formData.name);
				}
				
				
				$('.name-report').val('');
				$('.desc-report').val('');
				$('.id-report').val('');
			}
		});
	});
	
	$('.edit-report').live('click', function(e) {
		$('.name-report').val($(this).text());
		$('.desc-report').val($(this).data('desc'));
		$('.id-report').val($(this).data('id'));
		
		$('.edit').removeClass('edited');
		$(this).addClass('edited');
	});
	
	$('.delete-report').live('click', function(e) {
		if(confirm('Do tou want to delete this report?')) {
			var id = $(this).data('id');
			var $this = $(this);
			$.ajax({
				url : BASE_URL + 'reports/delete/' + id,
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
	
	$('.select-report').live('click', function(e) {
		var $this = $(this);
		var $rid = $('#report_id').val();
		if($this.hasClass('selected')) {
			$this.removeClass('selected').html('<img src="http://localhost/ProducSystemCI/css/images/plus.png"/>');
			var list = $rid.split(',');
			var report_id = '';
			$.each(list, function(i, e) {
				if(e && e != $this.data('id')) {
					report_id = report_id + ',' + e;
				}
			});
			$('#report_id').val(report_id);
		} else {
			$this.addClass('selected').text('');
			$('#report_id').val($rid + ',' + $this.data('id'));
		}
	});
	
	
});