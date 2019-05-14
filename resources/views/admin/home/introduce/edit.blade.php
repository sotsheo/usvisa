<html>
<head>
    
    <title>Website</title>
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
                           <h3 class="box-title">Update site</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                        <form role="form" action="{{route('edit_introduce')}}"   method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" placeholder="Enter ..." name="id" value="{{ $introduce['id'] }}" style="display:none">
                            <div class="form-group required">
                                <label>Tên</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="name" value="{{ $introduce['name'] }}">
                                <span class="text-red"></span>
                            </div>
                           

                            <div class="form-group">
                                <label for="exampleInputFile">Hình ảnh</label>
                                <input type="file" id="exampleInputFile" name="img" >
                                 <?php
                                    if($introduce['img']){
                                ?>
                                    <img src="<?= url($introduce['img'])?>" style="max-height: 150px;">
                                <?php }?>
                            </div>
                           <div class="form-group required_a">
                                    <label>Mô tả ngắn</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_description">{{$introduce->short_description}}</textarea>
                                    <span class="text-red"></span>
                                </div>

                                <div class="form-group">
                                    <label>Nội dung bài viết</label>
                                    <textarea name="editor1" id="editor1" rows="10" cols="80" >
                                    {{$introduce->description}}
                                    </textarea>
                                    <span class="text-red"></span>
                                </div>
                             <div class="form-group ">
                                    <label>key</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="key">{{$introduce->key}}</textarea>
                                    <span class="text-red"></span>
                                </div>
                            <button type="submit" class="btn btn-success pull-right"><i class="fa  fa-plus-circle"></i> Sửa
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
<script type="text/javascript">
    CKEDITOR.replace( 'editor1' );
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script>              
    
     function IsEmail(email) {
          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!regex.test(email)) {
            return false;
          }else{
            return true;
          }
    }
    $(window).load(function()
        {
            
        $(".box-body form .btn-success").click(function(){
            check=0;
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
            $(".email input").each(function(){
                 var value=$(this).val();
                 if(value){
                    if(IsEmail(value)==false){
                        $(this).siblings(".text-red").text("Nhập đúng định dạng email");
                        check=1;
                    }else{
                        $(this).siblings(".text-red").text("");
                    }
                }
  
            });
                if(check==1){
                    return false;
                }
            });
    });
</script>

</body>
</html>