@extends("admin.header")

@section("style")
    <script src="{{URL::asset('admins/js/category/category.js')}}"></script>
    <script>
        // console.log(  .;$$                     
        //                 ....:;$$$$$$$   $                     
        //             ..;;;$$$            $:..                  
        //          .:$$$$$$               $$$$$:.               
        //        .;$$$$$$$3             $$$$$$$$$;.             
        //      .;$$$$$$$$$$      $$$$$$$;$$$$$$$$$$;.           
        //     ;$$$$$$$$$$$$$    $$;$$$$$$$$$$$$$$$$$$;          
        //    ;$$$$$$$$$$$$$$$$    $$$$$$$$$$$$$$$$$$$$$         
        //   $$$$$$$$$$$$$$$$$$$    $$$$$$$$$$$$$$$$$$$$$        
        //  :$$$$$$$$$$$$$$$$$$$$    $$$$$$$$$$$$$$$$$$$$;       
        // .$$$$$$$$$$$$$$$$$$$$$$$   $$$$$$$$$$$$$$$$$$$$.      
        // :$$$$$$$$$$$$$$$$$$$$$$$$   $$$$$$$$$$$$$$$$$$$:      
        // ;$$$$$$$$$$$$$$$$$$$$$$$$$$  $$$$$$$$$$$$$$$$$$;      
        // ;$$$$$$$$$$$$$$$$$$$$$$$$$$$   $$$$$$$$$$$$$$$$;      
        // :$$$$$$$$$$$$$$$$$$             $$$$$$$$$$$$$$$:      
        // .$$$$$$$$$$$$$$$                 $$$$$$$$$$$$$$.      
        //  ;$$$$$$$$$$$$$                   $$$$$$$$$$$$;       
        //   $$$$$$$$$$$$                     $$$$$$$$$$$        
        //    $$$$$$$$$$                      $$$$$$$$$$         
        //     ;$$$$$$$$                     $$$$$$$$$;          
        //      .$$$$$$$$                   $$$$$$$$$.           
        //        .$$$$$$$$               $$$$$$$$$:             
        //          .;$$$$$$$$          $$$$$$$$;.               
        //             .:$$$$$$$$$$$$$$$$$$$$:.                  
        //                 ...:;;;;;;;;:... );
    </script>
    <style>
        .layui-btn-small {
            padding: 0 15px;
        }

        .layui-form-checkbox {
            margin: 0;
        }

        tr td:not(:nth-child(0)),
        tr th:not(:nth-child(0)) {
            text-align: center;
        }

        #dataConsole {
            text-align: center;
        }
        /*分页页容量样式*/
        /*可选*/
        .layui-laypage {
            display: block;
        }

            /*可选*/
            .layui-laypage > * {
                float: left;
            }
            /*可选*/
            .layui-laypage .pagination {
                float: right;
            }
            /*可选*/
            .layui-laypage:after {
                content: ".";
                display: block;
                height: 0;
                clear: both;
                visibility: hidden;
            }

            /*必须*/
            .layui-laypage .pagination{
                height: 30px;
                line-height: 30px;
                margin: 0px;
                border: none;
                font-weight: 400;
            }

            li{
                float:left;
            }
        /*分页页容量样式END*/
    </style>
@endsection

@section("stitle")
    留言管理
@endsection

@section("content")

    <fieldset id="dataConsole" class="layui-elem-field layui-field-title">
        <legend>控制台</legend>
        <div class="layui-field-box">
            <div id="articleIndexTop">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item" style="margin:0;margin-top:15px;">
                        <div class="layui-inline">
                            <label class="layui-form-label">分类</label>
                            <div class="layui-input-inline">
                                <select name="city">
                                    <option value="0"></option>
                                    <option value="1">类别1</option>
                                    <option value="2">类别2</option>
                                    <option value="3">类别3</option>
                                </select>
                            </div>
                            <label class="layui-form-label">关键词</label>
                            <div class="layui-input-inline">
                                <input type="text" name="keywords" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-input-inline" style="width:auto">
                                <button class="layui-btn" lay-submit lay-filter="formSearch">搜索</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </fieldset>
    <fieldset id="dataList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;">
        <legend style="text-align:center;">留言列表</legend>
        <div class="layui-field-box">
            <div id="dataContent" class="">
                <!--内容区域 ajax获取-->
                <table style="" class="layui-table" lay-even="">
                   <!--  <colgroup>
                        <col>
                        <col width="200">
                        <col width="90">
                        <col width="180">
                        <col width="180">
                        <col width="90">
                    </colgroup> -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>父级ID</th>
                            <th>状态</th>
                            <th>用户</th>
                            <th>留言内容</th>
                            <th>添加时间</th>
                            <!-- <th colspan="2">选项</th> -->
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($message as $item)
                            <tr>
                                <td>{{$item->meid}}</td>
                                <td>{{$item->mepid}}</td>
                                <td>
                                    <form class="layui-form" action="">
                                        <div class="layui-form-item status" style="margin:0;">
                                            <input type="checkbox" class="check" name="status" title="启用" lay-filter="top" @if($item->mestatus == 1) checked @endif>
                                            <input type="hidden" name="id" value="{{$item->meid}}">
                                        </div>
                                    </form>
                                </td>
                                <td>{{$item->uid}}</td>
                                <td>{{$item->mecomment}}</td>
                                <td>{{date("Y-m-d H:i:s",$item->mecreatetime)}}</td>
                                <td>
				                    <a href="{{action('Admin\MessageController@destroy',['id'=>$item->meid])}}" class="delete">
                                        <button class="layui-btn layui-btn-small layui-btn-danger"><i class="layui-icon">&#xe640;</i></button>
				                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="pageNav">
                    <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">
                        {{$message->links()}}
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <!-- layui.js -->
    <script src="{{URL::asset('admins/plugin/layui/layui.js')}}"></script>
    <!-- layui规范化用法 -->
    <!-- <script type="text/javascript">
        layui.config({
            base: '../../../admins/js/'
        }).use('datalist');
    </script> -->
@endsection
