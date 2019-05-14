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
                           <h3 class="box-title">Edit menu</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                            <form role="form" action="{{route('edit_menu_p')}}"   method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                 <input type="text" class="form-control" placeholder="Enter ..." name="id_category" value="{{ $menu->id_category }}" style="display:none;">
                                <input type="text" class="form-control" placeholder="Enter ..." name="id" value="{{ $menu->id }}" style="display:none;">
                                <div class="form-group required">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="name" value="{{$menu->name}}">
                                    <span class="text-red"></span>
                                </div>

                                <div class="form-group">
                                    <label>Chọn menu cha</label>
                                    <select class="form-control" name="id_parent">
                                        <option value="0">Chọn menu cha</option>
                                        <?php foreach ($category as $key ){
                                            if($key['id']!=$menu->id && $key['id_parent']!=$menu->id ){
                                            ?>
                                            <option value="{{ $key['id']}}" <?= ($key['id']==$menu->id_parent)?'selected':''?>>{{ $key["name"]}}</option>
                                            <?php }?>
                                        <?php }?>
                                    </select>
                                </div>

                                <div class="form-group required_a">
                                    <label>Mô tả ngắn</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_description">{{$menu->short_description}}</textarea>
                                    <span class="text-red"></span>
                                </div>
                                {{--  Đường dẫn --}}
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Tin tức</a></li>
                                      <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Sản phẩm</a></li>
                                      <li><a href="#tab_3" data-toggle="tab">Link thường</a></li>
                                    </ul>
                                    <div class="tab-content">
                                      <div class="tab-pane active" id="tab_1">
                                            <div class="row">
                                                    <div class="col-md-3">
                                                            <?php
                                                                foreach ($category_news as $key) {
                                                            ?>
                                                            <div class="form-group">
                                                                <div class="radio">
                                                                    <label style="font-weight: 700;"><input type="radio" name="link" id="optionsRadios3" value="{{$key->link}}" >{{$key->name}}</label>
                                                                </div>
                                                                    <?php
                                                                        foreach ($news as $item) {
                                                                            if($item->id_category==$key->id){
                                                                        ?>
                                                                        <div class="radio">
                                                                            <label>
                                                                                ---<input type="radio" name="link" id="optionsRadios3" value="{{$item->link}}">{{$item->name}}</label>
                                                                        </div>
                                                                    <?php 
                                                                            }
                                                                        }
                                                                    ?>
                                                            </div>
                                                            <?php } ?>  
                                                    </div>
                                            </div>

                                      </div>
                                      <!-- /.tab-pane -->
                                      <div class="tab-pane" id="tab_2">
                                         <?php
                                                                foreach ($category_product as $key) {
                                                            ?>
                                                            <div class="form-group">
                                                                <div class="radio">
                                                                    <label style="font-weight: 700;"><input type="radio" name="link" id="optionsRadios3" value="{{$key->link}}" >{{$key->name}}</label>
                                                                </div>
                                                                    <?php
                                                                        foreach ($product as $item) {
                                                                            if($item->id_category==$key->id){
                                                                        ?>
                                                                        <div class="radio">
                                                                            <label>
                                                                                ---<input type="radio" name="link" id="optionsRadios3" value="{{$item->link}}">{{$item->name}}</label>
                                                                        </div>
                                                                    <?php 
                                                                            }
                                                                        }
                                                                    ?>
                                                            </div>
                                                            <?php } ?>  
                                      </div>
                                      <!-- /.tab-pane -->
                                      <div class="tab-pane" id="tab_3">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label style="font-weight: 700;"><input type="radio" name="link"  value="<?=url('/lien-he.html')?>" >Liên hệ</label>
                                                    <label style="font-weight: 700;"><input type="radio" name="link"  value="<?=url('/gioi-thieu.html')?>" >Giới thiệu</label>
                                                </div>
                                            </div>
                                      </div>
                                      <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                
                                        
                                
                                <div class="form-group">
                                    <label for="exampleInputFile">Hình ảnh</label>
                                    <input type="file" id="exampleInputFile" name="img">
                                    <?php
                                        if($menu->img){
                                    ?>
                                        <img src="<?= url($menu->img)?>" style="max-height: 150px;">
                                    <?php }?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Icon</label>
                                    <input type="file" id="exampleInputFile" name="icon">
                                     <?php
                                        if($menu->icon){
                                    ?>
                                        <img src="<?= url($menu->icon)?>" style="max-height: 150px;">
                                    <?php }?>

                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select class="form-control" name="state">
                                        <option value="0" <?= ($menu->state==0) ? 'selected' : '' ?>>Hiện thị</option>
                                            <option value="1" <?= ($menu->state==1) ? 'selected' : '' ?>>Ẩn</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Thứ tự</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="location" value="{{ $menu->location }}">
                                </div>
                                <button type="submit" class="btn btn-success pull-right"><i class="fa  fa-plus-circle"></i> Chỉnh sửa
                                </button>
                            </form>
                        </div>
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
<style type="text/css">
.select2-container .select2-selection--single {
    height: auto !important;
}
</style>
</body>
</html>