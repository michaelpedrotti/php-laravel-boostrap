$.extend( true, $.fn.dataTable.defaults, {
    processing:true,
	serverSide: true,
	lengthChange:false,
    searching: false,
    ordering: true,
    paging: true,
    pageLength: 10,
    cache:false,
    drawCallback: function() {
       
	   var dt = this.api();
	   
		$('.dataTables_paginate')
			.find('.pagination')
				.append('<a href="javascript:void(0)" data-bind="datatable-refresh" title="Refresh" class="btn btn-primary" style="margin-left:5px"><i class="fa fa-sync-alt"></i></a>');

		$('a[data-bind=datatable-refresh]').click(function(){
			
			dt.ajax.reload();
		});
    },
    columnDefs: [
        {
            targets: 0,
            searchable: false,
            orderable: false,
            className: 'select-checkbox',
            width:'20px',
            render: function (value){	 
                return '<input type="radio" class="checkbox" name="id" value="' + value + '">';
            }
        }
    ],
    headerCallback: function(thead) {
        $(thead).find('th').eq(0).html('#');
    },
    order:[]
});