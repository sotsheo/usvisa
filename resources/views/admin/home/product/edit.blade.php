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
                      <form role="form" action="{{route('edit_product')}}"   method="POST" enctype="multipart/form-data">
                        <div class="tab-content">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" placeholder="Enter ..." name="id" style="display: none;" value="{{$product->id}}">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group required">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="name" value="{{$product->name}}">
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group ">
                                    <label>Code</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="code" value="{{$product->code}}">
                                    <span class="text-red"></span>
                                </div>
                                 <div class="form-group ">
                                    <label>Url</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="url_seo" value="{{$product->url_seo}}">
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group select_a">
                                    <label>Danh mục sản phẩm</label>
                                    <select class="form-control" name="id_category">
                                        <option value="0">Chọn danh mục</option>
                                        <?php
                                        foreach($category as $item){

                                        ?>
                                        <option value="{{$item->id}}" {{($item->id==$product->id_category)?'selected':''}}>{{$item->name}}</option>
                                        <?php }?>
                                    </select>
                                    <span class="text-red"></span>
                                </div>
                                
                                <div class="form-group ">
                                    <label>Giá bán</label>
                                    <input type="text" class="form-control validate_price" placeholder="Enter ..." name="price" value="{{$product->price}}" >
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group ">
                                    <label>Giá thị trường</label>
                                    <input type="text" class="form-control " placeholder="Enter ..." name="price_maket" value="{{$product->price_maket}}" >
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group required_a">
                                    <label>Mô tả ngắn</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_description">{{$product->short_description}}</textarea>
                                    <span class="text-red"></span>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung bài viết</label>
                                    <textarea name="editor1" id="editor1" rows="10" cols="80" >
                                       {{$product->description}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hình ảnh</label>
                                    <input type="file" id="exampleInputFile" name="img">
                                    <?php
                                        if($product->img){
                                    ?>
                                    <img src="<?= url($product->img)?>" style="max-height: 150px;">
                                    <?php }?>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="ishot" value="1" {{($product->ishot==1)? 'checked':'' }}>
                                            Sản phẩm nổi bật
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="isselling" value="1" {{($product->isselling==1)? 'checked' :'' }}>
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
                                    <input type="text" class="form-control" placeholder="Enter ..." name="location" value="{{$product->location}}">
                                </div>

                                <div class="form-group">
                                    <label>Từ khóa</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="key_card">{{$product->key_card}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Thời gian đăng</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" name="date_create" value="{{ date('d-m-Y',$product->date_create) }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Thời gian public</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepickers" name="date_public" value="{{ date('d-m-Y',$product->date_create) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="form-group">
                                    <label for="exampleInputFile">Hình ảnh </label>
                                    <input type="file"  name="attachment[]"  multiple >
                                    <?php
                                        if($product->imgs){
                                        $mang=explode(',', $product->imgs);
                                        foreach($mang as $item){
                                    ?>
                                        <div style="float: left;margin-right: 10px;margin-top: 10px;" class="img_list">
                                            <img src="<?= url(trim($item))?>" alt="..." class="img-thumbnail" style='height: 150px;width: 150px;'>
                                            <button type="button" class="btn btn-block btn-danger" data="{{trim($item)}}"><i class="fa fa-fw fa-close" ></i></button>
                                        </div>
                                        <?php }?>
                                        <input type="text"  name="file_now"  value="{{$product->imgs}}" style="display: none;" id="text_f">
                                     <?php }?>
                                </div>
                            </div>
                           
                        </div>
                    <button type="submit" class="btn btn-success pull-right"><i class="fa  fa-plus-circle"></i> Chỉnh sửa
                    </button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</section>
</div>
</div>

<style type="text/css">
    .img_list{
        position: relative;
    }
    .img_list button{
        position: absolute;
        top: 10px;
        width: 43px;
        right: 10px;
        opacity: .4;
        transition: all .5s;
    }
    .img_list:hover button{
         opacity: 1;
    }
    .tab-content{
       padding: 25px 10px;
    }
</style>
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
    $(".img_list button").each(function(){
        
        $(this).click(function(){
            var str=$("#text_f").val();
            str=str.replace($(this).attr("data"), "");
            $("#text_f").val(str);
            $(this).parent().remove();
        });
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