$(function() {
	$( "#loginForm" ).submit(function( event ) {
		login($(this));
		event.preventDefault();
	});
	
	$('.new-service-standard').live('click', function(e) {
		location.href = BASE_URL + 'service/show/Standard';
	});
	
	$('.show-service').live('click', function(e) {
		var orderId = $('#order_id').val();
		if(!orderId.trim().length) {
			alert('Please input valid order');
			return false;
		}
		
		$.ajax({
			url : BASE_URL + 'orders/check_valid',
			type : 'post',
			data : {orderId: orderId},
		}).done(function(data) {
			var obj = $.parseJSON(data);
			if(!obj.status) {
				location.href = BASE_URL + 'service/show/Normal/0/' + obj.orderId;  
			} else {
				alert(obj.message);
			}
		});
	});
});

function login(form) {
	console.log('Login');
	
	$.ajax({
		url : form.attr('action'),
		type : 'post',
		data : form.serialize(),
		beforeSend : function(xhr) {

		}
	}).done(function(data) {
		console.log(data);
		var obj = $.parseJSON(data);
		if(!obj.status) {
			if(obj.show_popup) {
				$.fancybox({
					content : obj.viewHtmlPopup
				});
			} else {
				location.href = obj.url;
			}
		} else {
			showDialog('Error', obj.message);
		}
	});
}

