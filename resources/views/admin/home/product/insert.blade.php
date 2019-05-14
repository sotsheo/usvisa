<html>
<head>
    <title>Sản phẩm</title>
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
                           <h3 class="box-title">Sản phẩm</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Sản phẩm</a></li>
                          <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Hình ảnh liên quan</a></li>
                      </ul>
                      <form role="form" action="{{route('create_product')}}"   method="POST" enctype="multipart/form-data">
                        <div class="tab-content">
                            {{ csrf_field() }}
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group required">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="name">
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group ">
                                    <label>Code</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="code">
                                    <span class="text-red"></span>
                                </div>
                                 <div class="form-group ">
                                    <label>Url</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="url_seo">
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group select_a">
                                    <label>Danh mục sản phẩm</label>
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
                                <div class="form-group select_a">
                                    <label>Hãng sản xuất</label>
                                    <select class="form-control" name="id_manufacturer">
                                        <option value="0">Chọn hãng sản xuất</option>
                                        <?php
                                        foreach($manufacturer as $item){
                                        ?>
                                        <option value="{{$item->id}}" >{{$item->name}}</option>
                                        <?php }?>
                                    </select>
                                    <span class="text-red"></span>
                                </div>
                                
                                <div class="form-group ">
                                    <label>Giá bán</label>
                                    <input type="text" class="form-control validate_price" placeholder="Enter ..." name="price" >
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group ">
                                    <label>Giá thị trường</label>
                                    <input type="text" class="form-control validate_price" placeholder="Enter ..." name="price_maket" >
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
                                            Sản phẩm nổi bật
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="isselling" value="1">
                                            Sản phẩm bán chạy
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
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="form-group">
                                    <label for="exampleInputFile">Hình ảnh </label>
                                    <input type="file"  name="attachment[]"  multiple>
                                </div>
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
    $(document).ready(function(){
        $(".validate_price").each(function(){
            $(this).on("keypress keyup blur",function (event) {    
               $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
        }) 
    })
</script>

</body>
</html>