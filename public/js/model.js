(function ($) {
    $("#bind-shop").on('click',function () {
        $('#Modal_shop').modal('toggle');//手动打开模态框。
    })

    $("#model_card").on('click',function () {
        $('#Modal_card').modal('toggle');//手动打开模态框。
    })

    $("#model_online").on('click',function () {
        $('#Modal_online').modal('toggle');//手动打开模态框。
    })

    $('#myModal').on('show.bs.modal', function () {
            // alert('aaaa在调用 show 方法后触发。');
        });
    $('#myModal').on('hide.bs.modal', function () {
            // alert('当调用 hide 实例方法时触发。');
        })
    $('#myModal').on('shown.bs.modal', function () {
            // alert('当模态框对用户可见时触发（将等待 CSS 过渡效果完成）。。');
        });
    $('#myModal').on('hidden.bs.modal', function () {
            // alert('当模态框完全对用户隐藏时触发。');
        })


    function jsOpenModal2() {
        $('#myModal2').modal('toggle');//手动切换模态框。   还有一个modal('hide')	手动隐藏模态框。
    }

    CKEDITOR.replace('editor');

})(jQuery);