<html>
    <head>
        <title>Wiget</title>
    @include('admin/layout/head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                 <h3 class="box-title">Wiget</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <form role="form" action="{{route('create_widget')}}"   method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group required">
                                    <label>Tên</label>
                                        <input type="text" class="form-control" placeholder="Enter ..." name="name" >
                                        <span class="text-red"></span>
                                </div>
                                 <div class="form-group">
                                    <label>Text</label>
                                        <input type="text" class="form-control" placeholder="Enter ..." name="text_head" >
                                        <span class="text-red"></span>
                                </div>
                                <div class="form-group select_a ">
                                    <label>Type</label>
                                    <input type="text" name="type" id="type" class="form-control" placeholder="Enter ...">
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group select_a">
                                    <label>Number Type</label>
                                        <select class="form-control" name="number_type">
                                            <option value="0">Chọn type</option>
                                           <?php
                                            for($i=1;$i<=30;$i++){
                                           ?>
                                                <option value="{{$i}}">{{$i}}</option>
                                            <?php }?>
                                        </select>
                                        <span class="text-red"></span>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="show_name" value="1">
                                             Show name
                                        </label>
                                    </div>
                                </div>
                                <div id="grid">
                                    
                                </div>
                               
                                <button type="submit" class="btn btn-success pull-right"><i class="fa  fa-plus-circle"></i> Thêm
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
        .result {
            display:none;
        }
        .result.active{
            display:block;
        }
    </style>
    <script>              
    
    $(".box-body form .btn-success").click(function(){
        var check=0;
        $(".form-group.required").each(function(){
           if($(this).children("input").val()==''){
                $(this).children(".text-red").text("Trường thông tin này không được để trống");
                check=1;
           }
        });
        $(".form-group.required_a").each(function(){
           if(!$(this).children("textarea").val()){
                $(this).children(".text-red").text("Trường thông tin này không được để trống");
                check=1;
           }
        });
       
        $(".form-group.select_a").each(function(){
           if($(this).children("select").val()==0){
                $(this).children(".text-red").text("Trường thông tin này không được để trống");
                check=1;
           }
        });
        if(check==1){
            return false;
        }
   
    });
    $(document).ready(function(){
        var datas;
        $("#type").change(function(){

            var type=$(this).val();

            var url='<?= route('getDataWidget')?>';
           
            if(type){
              getMessage(url);
            }
            
        });
       function getMessage(urls) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'type':$("#type").val()},
                type:'POST',
                url:urls,
                success:function(data) {
                if(data){
                    $(".result").addClass("active");
                    $("#grid").append(data);
                    remove();
                }                
                else{
                     $(".result").removeClass("active");
                }
               }
            });
         }
    });
    function remove(){
        $("#item_result option").each(function(){
            $(this).remove();
        });
    }
    </script>

    </body>
</html>