@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))
<style>
    #inner{
        width:200px;
        height:200px;
        /*border-radius:50% ;*/
        margin:20px auto;
        cursor: pointer;
    }
</style>
@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($messages[0],['url' => ['admin/editpost/'.$messages[0]['id']], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.create') }}</h3>

        </div><!-- /.box-header -->

        <div class="box-body">

            {{--导航栏标题--}}
            <div class="form-group">
                {{ Form::label('navigation', '导航栏', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-4">
                    <select class="form-control" name="navigation_id">
                            <option value="{{  $messages[0]['nid'] }}">{{  $messages[0]['navigation'] }}</option>
                    </select>
                </div><!--col-lg-10-->
            </div><!--form control-->


            {{--标题--}}
            <div class="form-group">
                {{ Form::label('title', trans('validation.attributes.backend.access.users.first_name'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-4">
                    {{ Form::text('title', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.users.first_name')]) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <!--上传图片-->
            <div class="form-group">
                {!! Form::label('logo', '上传图片', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-2">
                    <div class="avatar-upload" style="height: 300px;width: 300px">
                        <div id="containers">

                            <a href="javascript:void(0)" id="pickfiles" onclick="inter()">

                                @if(isset($messages[0]['picture']))
                                    <img id='inner' src="{{ $messages[0]['picture'] }}" alt="">
                                    <input id='innerss' type="hidden" name="filename" value="">
                                @else
                                <img id='inner' src="/img/pszhaopian.png" alt="">
                               @endif
                            </a>
                        </div>
                        <input id='inners' type="hidden" name="filename" value="">

                    </div>
                </div><!--col-lg-10-->
            </div><!--form control-->


            {{--编辑--}}
            <div class="form-group">
                {!! Form::label('names', '内容', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-2">
                    <!-- 加载编辑器的容器 -->
                    <script id="container" name="names" type="text/plain">
                        {!! $messages[0]['content'] !!}
                    </script>
                </div><!--col-lg-10-->
            </div><!--form control-->

        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left" style="float: left;margin-left: 45%;">
                <input type="hidden" id="create" name="status" value="0"/>
                {{ Form::submit(trans('buttons.general.save'), ['class' => 'btn btn-danger btn-xs']) }}
            </div><!--pull-left-->

            <div class="pull-right"  style="float: right;margin-right: 45%;">
                <input type="hidden" id="createpost" name="status" value="1"/>
                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
    {{ Form::close() }}
@endsection

@section('after-scripts')
    {{ Html::script('js/backend/access/users/script.js') }}
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('/utf8-php/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('/utf8-php/ueditor.all.min.js')}}"> </script>
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('/utf8-php/lang/zh-cn/zh-cn.js')}}"></script>
    <script>
        $(function(){
            $.ajax({
                type : 'get',
                url:'{{route('admin.test')}}',
                success : function(data) {
                    console.log(data);
                    var uploader = Qiniu.uploader({
                        runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                        browse_button: 'pickfiles',         // 上传选择的点选按钮，必需
                        // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
                        // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
                        // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
                        uptoken : data, // uptoken是上传凭证，由其他程序生成
                        // uptoken_url: '/uptoken',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
                        // uptoken_func: function(){    // 在需要获取uptoken时，该方法会被调用
                        //    // do something
                        //    return uptoken;
                        // },
                        get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
                        // downtoken_url: '/downtoken',
                        // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
                        // unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
                        // save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
                        domain: 'http://oyzi33ch6.bkt.clouddn.com',     // bucket域名，下载资源时用到，必需
                        container: 'containers',             // 上传区域DOM ID，默认是browser_button的父元素
                        max_file_size: '100mb',             // 最大文件体积限制
                        flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
                        max_retries: 3,                     // 上传失败最大重试次数
                        dragdrop: true,                     // 开启可拖曳上传
                        drop_element: 'container',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                        chunk_size: '4mb',                  // 分块上传时，每块的体积
                        auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
                        //x_vars : {
                        //    查看自定义变量
                        //    'time' : function(up,file) {
                        //        var time = (new Date()).getTime();
                        // do something with 'time'
                        //        return time;
                        //    },
                        //    'size' : function(up,file) {
                        //        var size = file.size;
                        // do something with 'size'
                        //        return size;
                        //    }
                        //},
                        init: {
                            'FilesAdded': function(up, files) {
                                plupload.each(files, function(file) {
                                    // 文件添加进队列后，处理相关的事情
                                });
                            },
                            'BeforeUpload': function(up, file) {
                                // 每个文件上传前，处理相关的事情
                            },
                            'UploadProgress': function(up, file) {
                                // 每个文件上传时，处理相关的事情
                            },
                            'FileUploaded': function(up, file, info) {
                                // 每个文件上传成功后，处理相关的事情
                                // 其中info.response是文件上传成功后，服务端返回的json，形式如：
                                // {
                                //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                                //    "key": "gogopher.jpg"
                                //  }
                                // 查看简单反馈
                                var domain = up.getOption('domain');
                                var res = eval('(' + info.response + ')');
                                var sourceLink = domain + '/' + res.key; //获取上传成功后的文件的Url
                                console.log(sourceLink);
                                $("#inner").attr("src", sourceLink)
                                $("#inners").attr("value", sourceLink)
                                $("#innerss").attr("value", sourceLink)


                            },
                            'Error': function(up, err, errTip) {
                                //上传出错时，处理相关的事情
                            },
                            'UploadComplete': function() {
                                //队列文件处理完毕后，处理相关的事情
                            },
                            'Key': function(up, file) {
                                // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                                // 该配置必须要在unique_names: false，save_key: false时才生效
                                var key = '<?php echo time().'.png' ?>';
                                // do something with key here
                                return key
                            }
                        }
                    });
                }
            })
        })    </script>
    <script>
        $(function(){

            $(".btn-danger").click(function(){
                $("#createpost").remove();
            })

            $(".btn-success").click(function(){
                $("#create").remove();
            })

        })

    </script>

    <script type="text/javascript">
        var ue = UE.getEditor('container',{
            initialFrameWidth: 600,
            initialFrameHeight:400,
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
    </script>

    <script>
        $("#operation_form").validator({
            fields: {
                'content' : 'required'
            }
        })
    </script>
    {{--<script type="text/javascript" src="jeDate/jedate.js"></script>--}}
    {{--<script src-="{{ asset('js-sdk/dist/qiniu.js') }}"></script>--}}
    <script src="/js-sdk/dist/qiniu.js"></script>
    <script src="{{ asset('js-sdk/src/plupload/moxie.js') }}"></script>
    <script src="{{ asset('js-sdk/src/plupload/plupload.dev.js') }}"></script>
    {{--<script src="http://code.jquery.com/jquery-latest.js"></script>--}}
@endsection

