<html>
    <head>
        <title>Tin tức</title>
    @include('admin/layout/head')
    <script src="{{ asset('public/layout_admin/ckeditor/ckeditor.js')}}"></script>
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
                            <form role="form" action="{{route('create_news')}}"   method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group required">
                                    <label>Tên</label>
                                        <input type="text" class="form-control" placeholder="Enter ..." name="name">
                                        <span class="text-red"></span>
                                </div>

                               
                            
                                <div class="form-group select_a">
                                    <label>Danh mục bài viết</label>
                                        <select class="form-control" name="id_category">
                                            <option value="0">Chọn danh mục</option>
                                            <?php
                                                foreach($category as $item){
                                            ?>
                                                <option value="{{$item->id}}" >{{$item->name}}</option>
                                            <?php }?>
                                        </select>
                                        <span class="text-red"></span>
                                </div>

                                <div class="form-group required_a">
                                    <label>Mô tả ngắn</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_description"></textarea>
                                    <span class="text-red"></span>
                                </div>

                                <div class="form-group">
                                    <label>Nội dung bài viết</label>
                                    <textarea name="editor1" id="editor1" rows="10" cols="80" >
                                           
                                    </textarea>
                                </div>
                              
                                <div class="form-group">
                                    <label for="exampleInputFile">Hình ảnh</label>
                                    <input type="file" id="exampleInputFile" name="img">

                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="ishot" value="1">
                                             Bài viết nổi bật
                                        </label>
                                    </div>
                                </div>

                               
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                        <select class="form-control" name="state">
                                            <option value="0">Hiện thị</option>
                                            <option value="1">Ẩn</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label>Thứ tự</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="location">
                                </div>

                                <div class="form-group">
                                    <label>Từ khóa</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="key_card"></textarea>
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

                                <div class="form-group">
                                    <label>Thời gian public</label>
                                    <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepickers" name="date_public">
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
    </script>
  
    </body>
</html>