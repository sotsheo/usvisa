<html>
    <head>
        <title>Danh mục tin tức</title>
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
                                 <h3 class="box-title">{{$category->name}}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <form role="form" action="{{route('edit_catgory_product')}}"   method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" placeholder="Enter ..." name="id" value="{{ $category->id }}" style="display:none;">
                                <div class="form-group required">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="name" value="{{$category->name}}">
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group">
                                    <label>Danh mục sản phẩm</label>
                                        <select class="form-control" name="id_parent">
                                            <option value="0">Chọn danh mục cha</option>
                                            <?php foreach ($category_list as $key ){
                                                if($key->id!=$category->id && $key->id_parent!=$category->id){
                                            ?>
                                                <option value="{{ $key->id }}">{{ $category->$category }}</option>
                                            <?php }?>
                                            <?php }?>
                                        </select>
                                </div>
                               
                                <div class="form-group required_a">
                                    <label>Mô tả ngắn</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_description">{{$category->short_description}}</textarea>
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung bài viết</label>
                                    <textarea name="editor1" id="editor1" rows="10" cols="80" >
                                           {{$category->description}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hình ảnh</label>
                                    <input type="file" id="exampleInputFile" name="img">
                                    <?php
                                        if($category->img){
                                    ?>
                                     <img src="<?= url($category->img)?>" style="max-height: 150px;">
                                     <?php }?>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                        <select class="form-control" name="state">
                                            <option value="0" <?= ($category->state==0) ? 'selected' : '' ?>>Hiện thị</option>
                                            <option value="1" <?= ($category->state==1) ? 'selected' : '' ?>>Ẩn</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="showhome" value="1" <?= ($category->showhome==1) ? 'checked' : '' ?>>
                                             Hiển thị ở trang chủ
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group has-warning">
                                    <label>View detail</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="view_detail" value="{{$category->view_detail}}">
                                    <span class="help-block">Hãy lưu ý khi sửa dụng</span>
                                </div>

                                <div class="form-group has-warning">
                                    <label>View</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="view" value="{{$category->view}}">
                                    <span class="help-block">Hãy lưu ý khi sửa dụng</span>
                                </div>
                                
                                <div class="form-group ">
                                    <label>Thứ tự</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="location" value="{{$category->location}}">
                                </div>

                                <div class="form-group">
                                    <label>Từ khóa</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="key_card">{{$category->key_card}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Thời gian đăng</label>
                                    <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="date_create" value="{{ date('d-m-Y', $category->date_create) }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Thời gian public</label>
                                    <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepickers" name="date_public" value="{{ date('d-m-Y', $category->date_public) }}">
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
           else{
            $(this).children(".text-red").text("");
            }
        });
        $(".form-group.required_a").each(function(){
           if(!$(this).children("textarea").val()){
                $(this).children(".text-red").text("Trường thông tin này không được để trống");
                check=1;
           }
           else{
            $(this).children(".text-red").text("");
            }
        });
        
       
        if(check==1){
            return false;
        }
    });
    </script>
    
    </body>
</html>