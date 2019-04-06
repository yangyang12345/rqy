(function($) {

    // 用于diolog ajax的请求数据
    $('[FR-ajax="dialog"]').on('click', function(){

        var id = $(this).attr("data_id")

        $.ajax({
            type: "get",
            url: "/admin/demand/check/"+id,
            data: {id:id},
            dataType: "json",
            success: function(result){
                var html = '';
                var data = result[0];

                if (data){
                    html += '<div class="modal-dialog"> '+
                        '<div class="modal-content"> '+
                        '<div class="modal-header"> '+
                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                        '<span aria-hidden="true">×</span>' +
                        '</button>'+
                        '<h4 class="modal-title">' +
                        data['title']+
                        '</h4>'+
                        '</div>'+
                        '<div class="modal-body">' +
                        '<p>One fine body…</p>' +
                        '</div>'+
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>' +
                        '<button type="button" class="btn btn-primary">Save changes</button>' +
                        '</div>'+
                        '</div>'+
                        '</div>'
                }
                $('#modal-default').html(html);
            }
        });
    });


})(jQuery);
