<html>
<head>
    
    <title>Website</title>
    @include('admin/layout/head')
    <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
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
                        <form role="form" action="{{route('edit_setting')}}"   method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group required">
                                <label>Tên</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="name" value="{{ $website['name'] }}">
                                <span class="text-red"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Icon</label>
                                <input type="file" id="exampleInputFile" name="icon" value="{{ $website['icon'] }}">
                                <?php
                                    if($website['icon']){
                                ?>
                                    <img src="<?= url($website['icon'])?>" style="max-height: 150px;">
                                <?php }?>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Logo</label>
                                <input type="file" id="exampleInputFile" name="logo" value="{{ $website['logo'] }}">
                                 <?php
                                    if($website['logo']){
                                ?>
                                    <img src="<?= url($website['logo'])?>" style="max-height: 150px;">
                                <?php }?>
                            </div>
                            <div class="form-group phone">
                                <label>Phone</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="phone" value="{{ $website['phone'] }}" >
                                <span class="text-red"></span>
                            </div>
                            <div class="form-group email">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="email" value="{{ $website['email'] }}">
                                <span class="text-red"></span>
                            </div>
                             <div class="form-group phone">
                                <label>Phone admin</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="phone_admin" value="{{ $website['phone_admin'] }}">
                                <span class="text-red"></span>
                            </div>
                            <div class="form-group email">
                                <label>Email admin</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="email_admin" value="{{ $website['email_admin'] }}">
                                <span class="text-red"></span>
                            </div>
                            <div class="form-group ">
                                <label>Page size</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="page_size" value="{{ $website['page_size'] }}">
                                <span class="text-red"></span>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"  name="default" <?= ($website['default']==1) ? 'checked' : '' ?> value='1'>
                                             Css default
                                    </label>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="address" value="{{ $website['address'] }}">
                                <span class="text-red"></span>
                            </div>
                            <div class="form-group ">
                                <label>Map</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="map" value="{{ $website['map'] }}">
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
            var check=0;
           $(".phone input").each(function(){
             $(this).keypress(function(key) {
                if(key.charCode < 48 || key.charCode > 57) return false;
            });
         });
           
        $(".box-body form .btn-success").click(function(){
            
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