<html>
<head>

    <title>Website</title>
    @include('admin/layout/head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('admin/layout/header')

        @include('admin/layout/nav')
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <!-- left column -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Support</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" action="{{route('edit_support')}}"   method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row group_sp">
                                    <div class="col-xs-3">
                                        <select class="form-control " id='select_form'>
                                            <option value="0">Lựa chọn support</option>
                                            @foreach($type_support as $key)
                                            <option value="{{$key->id}}" name='name'>{{$key->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <?php $i=0?>
                                    @foreach($support as $sp)
                                    <?php $i++ ?>
                                            @foreach($type_support as $type)
                                                @if($type->id==$sp->id_type)
                                                    <div class='item_sp'>
                                                        <div class='col-xs-3'>
                                                            <input type='text' class='form-control'  name='item_type_{{ $i}}' value='{{ $type->name }}'></div>
                                                            <div class='col-xs-4'>
                                                                <input type='text' class='form-control'  name='item_name_{{ $i}}' value="{{ $sp->name }}">
                                                            </div>
                                                            <div class='col-xs-4'> <input type='text' class='form-control' name='item_link_{{ $i}}' value="{{ $sp->link }}"> 
                                                                <input type='text' class='form-control' name='item_type_id_{{ $i}}' style='display:none' value='{{ $sp->id_type }}'>
                                                            </div>
                                                            <div class='col-xs-1'><a href="{{ url('admin/support/delete') }}<?php echo('/'.$sp->id); ?>"><i class='fa fa-window-close' aria-hidden='true'></i></a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                    @endforeach
                             </div>
                        <input type="number" name="count" value="0" style="display: none;" id="count">
                        <button type="button" class="btn btn-block btn-info" id='add_item'>Thêm support</button>
                        <button type="submit" class="btn btn-success pull-right"><i class="fa  fa-plus-circle"></i> Lưu lại<i></i>
                        </button>

                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
</div>
</div>

@include('admin/layout/footer')
<style type="text/css">
    .col-xs-1 i{
        line-height: 30px;
    }
    .box-body .item_sp{
        float: left;
        width: 100%;
        margin-bottom: 10px;
    }
    .btn-info{
        width: 150px;
        float: left;
    }
    #select_form{
        margin-bottom: 10px;
    }
    .item_sp .col-xs-3{
        position: relative;
    }
     .item_sp .col-xs-3:after{
        content: '';
        position: absolute;
        top: 0;
        height: 100%;
        width: 100%;
        left: 0;
        background: transparent;
     }
</style>
<script type="text/javascript">
    $(document).ready(function(){

    });
    $('#add_item').click(function(){
        var name=$("#select_form :selected").text();
        if($('#select_form').val()!=0){
            var count=parseInt($("#count").val());
            count++;
            $("#count").val(count); 
            $(".group_sp").append("<div class='item_sp'><div class='col-xs-3'><input type='text' class='form-control'  name='item_type_"+count+"' value='"+name+"'></div><div class='col-xs-4'><input type='text' class='form-control'  name='item_name_"+count+"'></div><div class='col-xs-4'> <input type='text' class='form-control' name='item_link_"+count+"'> <input type='text' class='form-control' name='item_type_id_"+count+"' style='display:none' value='"+$("#select_form").val()+"'></div><div class='col-xs-1'><a><i class='fa fa-window-close' aria-hidden='true'></i></a></div>");
        }
    });
</script>
</body>
</html>