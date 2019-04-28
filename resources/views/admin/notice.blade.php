@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">CK Editor
                        <small>Advanced and full of features</small>
                    </h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                                title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                title="" data-original-title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="box-body pad">
                    <form>
                        <textarea id="editor" name="editor" rows="10" cols="160"
                                  style="visibility: hidden; display: none;">This is my textarea to be replaced with CKEditor.</textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('notice-js')
        <!-- ckeditor -->
        <script src="{{ asset("/bower_components/ckeditor/ckeditor.js") }}"></script>
        <script src="{{ asset("/bower_components/ckeditor/config.js") }}"></script>
        <script src="{{ asset("/bower_components/ckeditor/styles.js") }}"></script>
        <script src="{{ asset("/bower_components/ckeditor/lang/zh-cn.js") }}"></script>
        <script>
            $(document).ready(function(){
                CKEDITOR.replace('editor');
            });
        </script>
    @endpush
@endsection
