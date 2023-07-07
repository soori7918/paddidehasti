$(document).ready(function($){

    $(document).on('click', '.delete-class', function(e){
        e.preventDefault();
        var name = $(this).attr("delete-name");
        var id = $(this).attr("delete-id");
        var tr = $(this).closest('tr');
        var section_id = $(this).attr('delete-section-id');
        swal({
                title: 'آیا میخواهید  '+ name +' را حذف نمایید؟',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'حذف شود',
                cancelButtonText: 'بازگشت',
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    swal({
                        title: '... '+  name +' در حال حذف ',
                        type: 'info',
                        showConfirmButton: false,

                    });
                    $.ajax({
                        url: ajax_delete_url +"/" + id,
                        type: "POST",
                        data: "_method=DELETE&_token=" + ajax_token + "&id=" + id,
                        success: function(result) {
                            swal({
                                title: ' '+  name +' با موفقیت حذف شد',
                                type: 'success',
                                showCancelButton: true,
                                cancelButtonText: 'بستن',
                                showConfirmButton: false,
                                closeOnCancel: true
                            });
                            if(typeof ajax_delete_redirect !="undefined"){
                                window.location= ajax_delete_redirect;
                            }
                            if(typeof section_id !="undefined"){
                                $('#' + section_id).remove();
                            }
                            if(typeof tr !="undefined") tr.remove();
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            //xhr.status thrownError
                            alert(xhr.responseText);
                            swal({
                                title: 'خطا!!! دوباره تلاش کنید.',
                                type: 'error',
                                showConfirmButton: true,
                                confirmButtonText: 'بستن',
                                closeOnCancel: true
                            });
                        }
                    });
                }
        });

    });


});


