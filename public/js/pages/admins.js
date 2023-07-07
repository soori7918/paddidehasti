
    $(function () {


        var admins_table = $('#admins_table').DataTable({
            "processing": true,
            "serverSide": true,
            "bFilter": false,
            "pageLength": 25 ,
            "lengthMenu": [[10 , 25 , 50 , 100], [10 , 25 , 50 , 100]] ,
            "aaSorting": [] ,
            "ajax": {
                'url' : get_admins_table,
                "type": "post",
                "data": function ( d ) {
                    return $.extend( {}, d, handleDatatableParameters() );
                }
            }, 
            "columns": [
                {"data": 'id'},
                {"data": 'name'},
                {"data": 'family'},
                {"data": 'email'},
                {"data": 'mobile'},
                {"data": 'access_status'},
                {"data": 'created_at'},
                {"data": 'operators'},
            ],
        
            "columnDefs": [
                {
                "render":
                    function(data , type , row) {
                        return row.id;

                    } ,
                    "className": 'farsi-font',
                    "orderable": false ,
                    "searchable": false ,
                    "targets": 0 ,
                } ,
                {
                "render":
                    function(data , type , row) {
                        return row.name;
                    } ,
                    "className": 'text-nowrap',
                    "orderable": false ,
                    "searchable": false ,
                    "targets": 1 ,
                } ,
                {
                "render":
                    function(data , type , row) {
                        return row.family;
                    } ,
                    "className": 'text-nowrap',
                    "orderable": false ,
                    "searchable": false ,
                    "targets": 2 ,
                } ,
                {
                "render":
                    function(data , type , row) {
                        return row.mobile;
                    } ,
                    "className": 'text-nowrap',
                    "orderable": false ,
                    "searchable": false ,
                    "targets": 3 ,
                } ,
                {
                "render":
                    function(data , type , row) {
                        return row.email;
                    } ,                
                    "className": 'text-nowrap farsi-font',
                    "orderable": false ,
                    "searchable": false ,
                    "targets": 4 ,
                } ,
                {
                "render":
                    function(data , type , row) {
                        if(row.access_status = 1) {
                            return '<span class="badge badge-default p-10" style="background-color:#59B300;">فعال</span>';
                        } else if(row.access_status = 0) {
                            return '<span class="badge badge-default p-10" style="background-color:#E60026;" >غیرفعال</span>';
                        } 
                        return '-';
                    } ,
            
                    "className": 'text-nowrap',
                    "orderable": false ,
                    "searchable": false ,
                    "targets": 5 ,
                } ,
                {
                "render":
                    function(data , type , row) {
                        return '<span dir="ltr" class="farsi-font">' +  row.created_at + '</span>';                    
                    } ,
                    "className": 'text-nowrap',
                    "orderable": false ,
                    "searchable": false ,
                    "targets": 6 ,
                } ,
                {
                    "render":
                      function(data , type , row) {
                        buttons = '<a href=" '+editAdminRoute+'/'+row.id+'/'+'edit'+' " class=" td-n c-red-500 cH-blue-500 fsz-md p-5" style="font-size:22px !important" title="ویرایش" ><i class="dripicons-document-edit"></i></a>';
                        buttons += '<a href="" class="delete-class td-n c-red-500 cH-blue-500 fsz-md p-5" style="font-size:22px !important" delete-name="' + (row.name + ' ' + row.family) + '" delete-id="' + row.id + '" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف"><i class="dripicons-trash"></i></a>';

                        return buttons;
                        
                      } ,
                      "className": 'text-nowrap',
                      "orderable": false ,
                      "searchable": false ,
                      "targets": 7 ,
                  } ,
                
            ] ,
            "oLanguage": {
                "bProcessing":   "درحال پردازش...",
                "sProcessing":   "درحال پردازش...",
                "sLengthMenu":   "نمایش محتویات _MENU_",
                "sZeroRecords":  "موردی یافت نشد",
                "sInfo":         "نمایش _START_ تا _END_ از مجموع _TOTAL_ مورد",
                "sInfoEmpty":    "خالی",
                "sInfoFiltered": "(فیلتر شده از مجموع _MAX_ مورد)",
                "sInfoPostFix":  "",
                "sSearch":       "جستجو:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "ابتدا",
                    "sPrevious": "قبلی",
                    "sNext":     "بعدی",
                    "sLast":     "انتها"
                }
            } ,

        });


        $('#search_form').validate({
            rules: {
                status: {
                    required: false ,
                } ,
            },
            submitHandler : function(form) {
                admins_table.ajax.reload();
            },
        });
     

    });



     
    var handleDatatableParameters = function() 
    {
        var parameters = {
            "_token": $('input[name="_token"]').val()
        };
    
        /**
         * Check the search filters and add the selected elements
         */        
        if ($('#search_form').find('input[name="search_like"]').val()) {
            parameters['search_like'] = $('#search_form').find('input[name="search_like"]').val();        
        }
      
        return parameters;
    };

   
