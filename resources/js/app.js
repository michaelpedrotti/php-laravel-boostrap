if(!APP) var APP = {};

APP.menu = function(){
	
	var selector = $('[data-widget=treeview]').find('li[data-nav=' + APP.controller + ']');
	
	selector.find('a').addClass('active');
	selector.parents('li[data-nav]').addClass('menu-is-opening menu-open')
};

APP.search = function(){};

APP.selected = function(button){
	
	var table = $(button.attr('data-table') || 'table.dataTable');
	var selector = table.find('tbody').find('input[type=radio]:checked');

	return (selector.length === 0) ? null : selector.val();
};

APP.spinner = function(selector){
	
	var button = selector;
	var classes = '';
	
	this.show = function(){
		
		button.attr('disabled', 'disabled');
		
		var icon = button.find('i');
		
		if(icon.length > 0){
			
			classes = icon.attr('class');
			icon.attr('class', 'fa fa-spinner fa-spin');
		}
		else {
			
			button.prepend('<i class="fa fa-spinner fa-spin"></i>');
		}
	}
	
	this.hide = function(){
		
		// https://api.jquery.com/removeattr/
		button.removeAttr('disabled');
		
		var icon = button.find('i');
		if(classes){
			
			icon.attr('class', classes);
		}
		else {
			
			icon.remove();
		}
	}
};

APP.flash = function(message, level) {

	Swal.fire({
		icon: level || 'error',
		text: message,
	});
};

APP.confirm = function(title, fn){

	Swal.fire({
		title: title,
		icon: "question",
		iconHtml: '',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		showCancelButton: true,
		
	}).then(function(result){
		
		if(result.isConfirmed){
			
			fn();
		}
	});

};

APP.load = function(e){
	
	var modal = $(e.currentTarget);
    
    $.ajax({

        method:'GET',
        url: modal.attr('url'),
        dataType:'html',
        error:function(jqXHR, textStatus, errorThrown){
            
            modal.find('a[data-action=save], button[data-action=save]').hide();
            modal.find('.modal-title').html(errorThrown); 
            modal.find('.modal-body').html('<pre>' + jqXHR.responseText + '</pre>');            
        }, 
        success:function(content){
            
            var selector = $(content).find('title:first');
            
            if(selector.length > 0) {
                modal.find('.modal-title').html(selector.html()); 
            }

            var body = modal.find('.modal-body').html(content);
            
            modal.find('a[data-action=save], button[data-action=save]').show();
            
            //APP.Crud.Bootstrap(body);
        }  
    });
	
};

APP.submit = function(e, method){

	var button = $(e.currentTarget);
    var modal = $(button.attr('data-modal') || '#modal-default');
	var form = modal.find('form:first');
    var formData = new FormData(form.get(0));
	var spinner = new APP.spinner(button);
	var url = APP.url;

	if(method === 'PUT'){
		
		url += '/' + form.find('input[name=id]').val();
		formData.append('_method', 'PUT');
		
	}
	
	formData.append('_token', APP.token);
	
	spinner.show();
	
	$.ajax({

        method: 'POST',
        type: 'POST',
        url: url,
        dataType:'html',
        data: formData,
        processData: false,
//        contentType: 'multipart/form-data',
        contentType: false,
        complete:function() {
             
            spinner.hide();
        },
        error:function(jqXHR, textStatus, errorThrown){

            $('a[data-action=save], button[data-action=save]').hide();
            modal.find('.modal-title').html(errorThrown); 
            modal.find('.modal-body').html('<pre>' + jqXHR.responseText + '</pre>');
         }, 
        success:function(content, textStatus, jqXHR){
            
            var alert = $(content).find('.alert-success');
			
            if(alert.length > 0) {
                
				APP.flash(alert.text(), 'success');
                
                modal.modal('hide');
				
				$(button.attr('data-table') || 'table.dataTable').DataTable().ajax.reload();
            }
            // Senão houve um erro e o formulário atualizado pois tera os alertas
            // de erro
            else {

                var target = modal.find('.modal-body').empty().html(content);
                // Execuda mascarás e demais eventos que não foram atachados 
                // no formulário carregado por ajax
                //APP.Crud.Bootstrap(target);
            }
        }  
    });
};

APP.create = function(e){
   
    var button = $(this);
    var modal = $(button.attr('data-modal') || '#modal-default');
	
	modal.attr('url', APP.url + '/create');
    modal.find('a[data-submit], button[data-submit]').attr('data-submit', 'store').show();
    modal.find('.modal-body').empty().html('Loading...');
    modal.modal({
        show:true, 
        //callback:button.attr('data-callback'),
        button:button
    }); 
};

APP.edit = function(e){
	
	var button = $(this);
    var modal = $(button.attr('data-modal') || '#modal-default');
	var id = APP.selected(button); 

	if(!id){
		
		APP.flash('Select a record', 'warning');
		return;
	}

	modal.attr('url', APP.url + '/' + id + '/edit');
    modal.find('a[data-submit], button[data-submit]').attr('data-submit', 'update').show();
    modal.find('.modal-body').empty().html('Loading...');
    modal.modal({
        show:true, 
        //callback:button.attr('data-callback'),
        button:button
    });
};

APP.store = function(e){
	
	APP.submit(e, 'POST');
};

APP.update = function(e){
	
	APP.submit(e, 'PUT');
	
};

APP.show = function(e){
	
	var button = $(this);   
	var modal = $(button.attr('data-modal') || '#modal-default');
	var id = APP.selected(button); 
	
	if(!id){
		
		APP.flash('Select a record', 'warning');
		return;
	}
	
	modal.attr('url', APP.url + '/' + id);
    modal.find('a[data-submit], button[data-submit]').hide();
    modal.find('.modal-body').empty().html('Loading...');
    modal.modal({
        show:true, 
        callback:button.attr('data-callback'),
        button:button
    });
};

APP.remove = function(e){
	
	var button = $(this);
	var id = APP.selected(button);
	
	if(!id){
		
		APP.flash('Select a record', 'warning');
		return;
	}
	
	APP.confirm('Are you sure to remove it?', function(){
		
		var modal = $(button.attr('data-modal') || '#modal-default');
		var spinner = new APP.spinner(button);
		
		spinner.show();
		
		$.ajax({

			method:'POST',
			type:'POST',
			url: APP.url + '/' + id,
			dataType:'json',
			data: {
				'_method': 'DELETE',
				'_token': APP.token
			},
			complete:function() {

				spinner.hide();
			 },
			error:function(jqXHR, textStatus, errorThrown){

				$('a[data-action=save], button[data-action=save]').hide();
				modal.find('.modal-title').html(errorThrown); 
				modal.find('.modal-body').html('<pre>' + jqXHR.responseText + '</pre>');
			}, 
			success:function(json){
				
				if(json.success){
					
					APP.flash(json.msg || 'Saved', 'success');
					
					$(button.attr('data-table') || 'table.dataTable').DataTable().ajax.reload();
				}
				else {
					
					APP.flash(json.msg || 'Error', 'danger');
				}
			}  
		});

	});
};

$(document).ready(function() {
		
	$('.modal').on('shown.bs.modal', APP.load);
	
	$(document).on('click', 'a[data-action=create], button[data-action=create]', APP.create);
	$(document).on('click', 'a[data-submit=update], button[data-submit=update]', APP.update);
	$(document).on('click', 'a[data-action=remove], button[data-action=remove]', APP.remove);
	$(document).on('click', 'a[data-submit=store], button[data-submit=store]', APP.store);
	$(document).on('click', 'a[data-action=show], button[data-action=show]', APP.show);
	$(document).on('click', 'a[data-action=edit], button[data-action=edit]', APP.edit);


	APP.menu();
});