@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.active') }}</small>
    </h1>
@endsection

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.active') }}</h3>

            <div class="box-tools pull-right">
                {{--@include('backend.access.includes.partials.user-header-buttons')--}}
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->
        <div id="toolbar" class="btn-group">
            <div class="form-inline" role="form">
                <div class="form-group">

                    <select class="form-control" name="status" id="ssss">
                        <option>请选择状态</option>
                        <option value ="2">未发布</option>
                        <option value ="1">已发布</option>
                    </select>




                    消息标题：<input name="title" id="class-search" class="form-control" type="text"  placeholder="请输入标题关键词">
                    成立时间：<input class="form-control form_datetime" type="text" name="start_time" placeholder="起止时间" readonly >
                    <input class="form-control form_datetime" type="text" name="end_time" placeholder="截止时间" readonly >

                    <button id="search" type="submit" class="btn btn-default">搜索</button>

                    {{--批量操作--}}

                </div>
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="table" class="table table-condensed table-hover" data-toggle="table"
                       data-url="{{route('admin.datapost')}}"
                       data-toolbar="#toolbar"
                       data-click-to-select="true"
                       data-show-refresh="true"
                       data-show-toggle="true"
                       data-side-pagination="server"
                       data-pagination="true"
                       data-page-size="10"
                       data-page-list="[10, 25, 50]"
                       data-pagination-first-text="第一页"
                       data-pagination-pre-text="上一页"
                       data-pagination-next-text="下一页"
                       data-pagination-last-text="最后一页"
                       data-query-params="getQueryParams">
                    <thead>
                    <tr>
                        <th data-field="state" data-checkbox="true">全选</th>
                        <th data-field="navigation" >导航标题</th>
                        <th data-field="title" >消息标题</th>
                        <th data-field="statuss">状态</th>
                        <th data-field="content">内容</th>
                        <th data-field="created_at" >发布时间</th>
                        <th data-formatter="actionFormatter" data-events="actionEvents">操作</th>
                    </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->renderType('User') !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')

    {{--<script src="{{ asset('/jquery-3.2.1.min.js') }}"></script>--}}
    <script src="{{ asset('/bootstrap-table/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/bootstrap-table/src/bootstrap-table.js') }}"></script>
    <script src="{{ asset('/bootstrap-table/src/locale/bootstrap-table-zh-CN.js') }}"></script>
    <script src="{{ asset('/bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('/bower_components/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js')}}" charset="UTF-8"></script>
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}

    <script>

        $(function(){
            var $table = $('#table');
            var $search = $('#search');
            $search.click(function () {
                $table.bootstrapTable('refresh');
            });
            window.actionEvents = {
                'click .remove': function (e, value, row) {
                    swal({
                        title: "确定?",
                        text: "你将删除该数据吗!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确认删除",
                        cancelButtonText: "取消",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, function () {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'DELETE',
                            url: '{{url('admin/del')}}/' + row.id,
                            dataType: 'json',
                            success: function (data) {
                                if (data.code == 2000) {
                                    $('#table').bootstrapTable('remove', {field: 'id', values: [row.id]});
                                    swal("已删除!", "已成功删除.", "success");
                                }
                            },
                            error: function () {
                                alert('删除失败!')
                            }
                        });
                    });
                }
            };





            $(".form_datetime").datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                weekStart: 1,
                language: 'zh-CN'
            });



        })

        //搜索参数
        function getQueryParams(params) {
            $('#toolbar').find('input[name]').each(function () {
                params[$(this).attr('name')] = $(this).val();
            });
            $('#toolbar').find('select[name]').each(function () {
                params[$(this).attr('name')] = $(this).val();
            });
            return params; // body data
        }
        function actionFormatter(value, row, index) {
            var edit = '<a href="{{ url('admin/edit') }}'+'/'+row.id+'" class="btn btn-xs btn-primary">' +
                '<i class="fa fa-pencil auth" data-toggle="tooltip" data-placement="top" title="继续编辑">继续编辑</i></a>';


            var del = '<a href="javascript:void()" class="btn btn-xs btn-primary remove"> ' +
                '<i class="fa fa-pencil remove" data-toggle="tooltip" data-placement="top" ' +
                'data-toggle="tooltip" data-placement="top" title="删除">删除</i></a>';

            if(row.status == '1'){
                var freeze = ''
                return del+' '+freeze;

            }else if(row.status = '0'){
                var freeze = ''
                return edit+' '+freeze+' '+del;
            }

        }
    </script>
@endsection
