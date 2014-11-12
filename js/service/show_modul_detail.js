var formDataModulDetail = {};
formDataModulDetail.files = [];
formDataModulDetail.links = [];
$(function() {
	$('.fileupload').fileupload({
        url: BASE_URL + 'documents/upload',
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
            	formDataModulDetail.files.push(file.url);
            });
        },
        
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	
	$('.mr_type2').live('change', function(e) {
		if($(this).val() == 'modul') {
			$('.operator2').show();
		} else {
			$('.operator2').hide();
		}
	});
	
	$('.td-remove-detail').live('click', function(e) {
		var id = $(this).data('id');
		var $this = $(this);
		$.ajax({
			url : BASE_URL + 'service/remove_requirement',
			type : 'post',
			data : {mrid: id},
		}).done(function(data) {
			$this.parent().remove();
		});
	});
	
	$('#cbOutsourcing').live('click', function() {
		if ($(this).is(':checked')) {
			$('.documents-content').hide();
			$('.outsourcing-content').show();
        } else {
        	$('.documents-content').show();
        	$('.outsourcing-content').hide();
        }
	});
	
	$('.update-outsource').live('click', function(e) {
		var $this = $(this);
		e.preventDefault();
		if (e.handled !== true) {
			$.ajax({
				url : BASE_URL + 'service/update_outsource/' + $('#serviceid').val(),
				type : 'post',
				data : $('#outsourceForm').serialize(),
			}).done(function(data) {
				
				var obj = $.parseJSON(data);
				if(!obj.status) {
					var name = $this.parent().parent().find('.mr_name2').val();
					var type = $this.parent().parent().find('.mr_type2').val();
					var desc = $this.parent().parent().find('.mr_desc2').val();
					var value = $this.parent().parent().find('.mr_value2').val();
					var operator = $this.parent().parent().find('.mr_operator2').val();
					
					var html = '<tr class="tr-second">';
					if(type != 'modul') {
						html += '<td>' + name + '</td><td>' + type + '</td><td>' + desc + '</td>';
					} else {
						html += '<td>' + name + ' ' + operator + ' ' + value + '</td><td>' + type + '</td><td>' + desc + '</td>';
					}
					
					html += '<td class="td-remove" data-index="' + name + '">Delete</td>';
					html += '</tr>';
					$('table.tbl-requirement-detail').append(html);
					
					$this.parent().parent().find('input').val('');
				} else {
					alert(obj.message);
				}
			});
			e.handled = true;
		}
	});
	
	$('#addDocumentModul').live('click', function(e) {
		e.preventDefault();
		if (e.handled !== true) {
			var html = $('.documents-modul-detail').html();
			$('.list-document-modul-detail').append(html);
			e.handled = true;
		}
	});
	
	$('.update-modul-detail').live('click', function(e) {
		e.preventDefault();
		if (e.handled !== true) {
			var formData = $('#documentForm').serialize();
			var modul_id = $(this).data('id');
			var modul_type = $(this).data('modultype');
			$.ajax({
				url : BASE_URL + 'documents/update',
				type : 'post',
				data : formData + "&data[Modul][id]=" + modul_id,
			}).done(function(data) {
				var obj = $.parseJSON(data);
				if(!obj.status) {
					$.each(obj.documents, function(i, e){ 
						var html = '<div>- <a target="_blank" href="' + e.link + '">' + e.link + '</a></div>';
						$('.documents-content').append(html);
					});
					
					$('.list-document-modul-detail').html('');
				}
			});
			e.handled = true;
		}
	});
	
	$('.type-modul-detail').live('change', function() {
		console.log($(this).val());
		if($(this).val() == 'PDF') {
			$(this).parent().find('.link').show();
			$(this).parent().find('.fileupload').hide();
		} else {
			$(this).parent().find('.link').hide();
			$(this).parent().find('.fileupload').show();
		}
	});
	
});