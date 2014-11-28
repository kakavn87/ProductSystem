$(function() {
	$('.add-product').live('click', function(e) {
		var $this = $(this);
		var formData = {};
		formData.name = $('.name-product').val();
		formData.description = $('.desc-product').val();
		formData.id = $('.id-product').val();
		
		$.ajax({
			url : BASE_URL + 'products/add',
			type : 'post',
			data : formData,
		}).done(function(data) {
			var obj = $.parseJSON(data);
			if(obj.status) {
				showDialog("Error", obj.message);
			} else {
				showDialog("Success", 'Create new product successful');
				
				if(obj.type == 'add') {
					var html = '<tr>';
					html += '<td class="edit edit-product edited" data-desc="' + formData.description + '" data-id="' + obj.product_id + '">' + formData.name + '</td>';
					html += '<td class="delete delete-product" data-id="' + obj.product_id + '">Delete</td>';
					html += '<td class="select select-product" data-id="' + obj.product_id + '">Select</td>';
					html += '</tr>';
					
					$('#tabs-4 table').append(html);
				} else {
					$('.edited').data('desc', formData.description);
					$('.edited').text(formData.name);
				}
				
				$('.name-product').val('');
				$('.desc-product').val('');
				$('.id-product').val('');
			}
		});
	});
	
	$('.edit-product').live('click', function(e) {
		$('.name-product').val($(this).text());
		$('.desc-product').val($(this).data('desc'));
		$('.id-product').val($(this).data('id'));
		
		$('.edit').removeClass('edited');
		$(this).addClass('edited');
	});
	
	$('.delete-product').live('click', function(e) {
		if(confirm('Do tou want to delete this product?')) {
			var id = $(this).data('id');
			var $this = $(this);
			$.ajax({
				url : BASE_URL + 'products/delete/' + id,
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
	
	$('.select-product').live('click', function(e) {
		$('#tabs-4 table tr td.select').removeClass('selected').html('<img src="http://localhost/ProducSystemCI/css/images/plus.png"/>');
		$(this).addClass('selected').text('');
		
		$('#products').val($(this).data('id'));
	});
	
	
});