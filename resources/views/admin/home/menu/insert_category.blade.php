<html>
    <head>
        <title>Menu</title>
    @include('admin/layout/head')
   <script src="{{ asset('layout_admin/ckeditor/ckeditor.js')}}"></script>
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
                                 <h3 class="box-title">Thêm bài viết</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <form role="form" action="{{route('create_category_menu')}}"   method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group required">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="name">
                                    <span class="text-red"></span>
                                </div>

                                
                                <div class="form-group required_a">
                                    <label>Mô tả ngắn</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_description"></textarea>
                                    <span class="text-red"></span>
                                </div>

                                <div class="form-group">
                                    <label>Thời gian đăng</label>
                                    <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="date_create">
                                    </div>
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

    <script>              
    CKEDITOR.replace( 'editor1' );
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
        if(check==1){
            return false;
        }
    });
    </script>
    
    </body>
</html>