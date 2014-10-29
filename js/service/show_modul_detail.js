$(function() {
	$('#cbOutsourcing').live('click', function() {
		if ($(this).is(':checked')) {
			$('.documents-content').hide();
			$('.outsourcing-content').show();
        } else {
        	$('.documents-content').show();
        	$('.outsourcing-content').hide();
        }
	});
	
	$('.add-more').live('click', function(e) {
		var html = '<div class="info-input">';
		html += $('.info-input').html();
		html += '<div class="remove">X</div>';
		html += '</div>';
		$('.info-container').append(html);
	});
	
	$('.remove').live('click', function(e) {
		e.preventDefault();
		if (e.handled !== true) {
			$(this).parent().remove();
			
			e.handled = true;
		}
	});
	
	$('.update-outsource').live('click', function(e) {
		e.preventDefault();
		if (e.handled !== true) {
			$.ajax({
				url : BASE_URL + 'service/update_outsource/' + $('#serviceid').val(),
				type : 'post',
				data : $('#outsourceForm').serialize(),
			}).done(function(data) {
				var obj = $.parseJSON(data);
				if(!obj.status) {
					$.fancybox.close();
				} else {
					alert(obj.message);
				}
			});
			e.handled = true;
		}
	});
});