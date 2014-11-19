var formData = {};
formData.files = [];
formData.listIds = [];
$(function() {
	$("#report_id").chosen();

	$('#saveService').live('click', saveService);
	
	$.each($('input[type=file]'), function (index, file) {
		formData.files[index] = '';
		formData.listIds[index] = 0;
	});
	
	$('.fileupload').fileupload({
        url: BASE_URL + 'service/upload',
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
            	var idx = $(e.target).data('index');
            	var id = $(e.target).data('id');

            	var html = '<a href="' + file.url + '">' + file.name + '</a>';
            	$(e.target).parent().parent().find('.files').html(html);
            	formData.files[idx - 1] = file.url;
            	formData.listIds[idx - 1] = id;
            });
        },
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	
	doService({
		allowEdit : true
	});
});

function saveService(e) {
	e.preventDefault();
	if (e.handled !== true) {
		formData.id = $('#serviceid').val();
		
		$.ajax({
			url : BASE_URL + 'service/update',
			type : 'post',
			data : formData,
		}).done(function(data) {
			var obj = $.parseJSON(data);
			if(!obj.status) {
				location.href = location.href;
			} else {
				alert('Please upload all files');
			}
		});

		// this next line *must* be within this if statement
		e.handled = true;
	}

}

function doService(params) {
	var modulList = $('.modulList');
	var modulListSecond = $('.second');

	$('ul#navLeft li').live('click', loadService);
	$('.containerBox').live('click', openModulDetail);
	
	draw();

	function draw() {
		modulList.html('');
		$.each(listModules, function(index, value) {
			var containerBox = createBox(value);
			modulList.append(containerBox);
		});
		
		modulListSecond.html('');
		$.each(listModuleForCustomers, function(index, value) {
			var containerBox = createBox(value);
			modulListSecond.append(containerBox);
		});
	}

	function openModulDetail(e) {
		if (e.target == this) {
			var modulId = $(this).data('modulid');
			var modulType = $(this).data('modultype');

			$.ajax({
				url : BASE_URL + 'service/show_modul_detail',
				type : 'post',
				data : {
					modul_id : modulId,
					modul_type: modulType
				},
			}).done(function(data) {
				$.fancybox({
					content : data
				});
			});
		}
	}

	function createBox(value) {
		var status = '';
		if(value.status == 'deny') {
			status = '<div class="status-box"><img src="' + BASE_URL + 'css/images/danger.png" /></div>';
		}
		var color = 'style="background-image: url(\'' + BASE_URL + 'css/images/' + value.color + '\') !important; background-color: none !important; "';
		var html = '<div ' + color + ' class="containerBox ui-state-default" id=\''
				+ JSON.stringify(value) + '\' data-modulid="' + value.id
				+ '" data-modultype="' +  value.type + '">' + status + value.modul
				+ '</div>';
		return html;
	}
	
	return false;
}
