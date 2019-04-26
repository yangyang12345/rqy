@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">本金账户明细</h3>
                    <button class="btn btn-info btn-xs pull-right">佣金转本金</button>
                </div>
                <div class="box-body">
                    <div id="capital" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                {{--<div class="dataTables_length" id="example1_length">--}}
                                    {{--<label>Show--}}
                                        {{--<select name="example1_length" aria-controls="example1" class="form-control input-sm">--}}
                                            {{--<option value="10">10</option>--}}
                                            {{--<option value="25">25</option>--}}
                                            {{--<option value="50">50</option>--}}
                                            {{--<option value="100">100</option>--}}
                                        {{--</select> entries</label></div>--}}
                                <h4>本金账户：￥0.00元 　<a href="{{ url('/user/funds/capital') }}">明细</a>　　佣金账户：￥5.00元 　<a href="{{ url('/user/funds/brokerage') }}">明细</a></h4>
                            </div>
                            <div class="col-sm-12"><hr></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="example1_filter" class="dataTables_filter">
                                    <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="capital" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending"
                                            style="width: 208px;">时间
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending"
                                            style="width: 255px;">收/支
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                            style="width: 227px;">内容
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending"
                                            style="width: 179px;">金额
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                            style="width: 131px;">余额
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($capital as $c)
                                        <tr role="row" class="odd">
                                            <td>{{ $c->time }}</td>
                                            <td>{{ $c->time }}</td>
                                            <td>{{ $c->content }}</td>
                                            <td>{{ $c->quota }}</td>
                                            <td>{{ $c->banlance }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing
                                    1 to 10 of 57 entries
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button previous disabled" id="example1_previous"><a href="#"
                                                                                                                aria-controls="example1"
                                                                                                                data-dt-idx="0"
                                                                                                                tabindex="0">Previous</a>
                                        </li>
                                        <li class="paginate_button active"><a href="#" aria-controls="example1"
                                                                              data-dt-idx="1" tabindex="0">1</a></li>
                                        <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                        data-dt-idx="2" tabindex="0">2</a></li>
                                        <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                        data-dt-idx="3" tabindex="0">3</a></li>
                                        <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                        data-dt-idx="4" tabindex="0">4</a></li>
                                        <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                        data-dt-idx="5" tabindex="0">5</a></li>
                                        <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                        data-dt-idx="6" tabindex="0">6</a></li>
                                        <li class="paginate_button next" id="example1_next"><a href="#"
                                                                                               aria-controls="example1"
                                                                                               data-dt-idx="7"
                                                                                               tabindex="0">Next</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

