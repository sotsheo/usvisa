<html>
<head>
   <title>Login</title>
    @include('admin/layout/head')
</head>
<body class="hold-transition login-page">
    <div class="login-box">
            <div class="login-logo">
                 <b>Admin</b>
            </div>
    <!-- /.login-logo -->
        <div class="login-box-body">
        
            <form role="form" action="{{route('login')}}"   method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Email" name="name">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                         <span class="text-red"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                         <span class="text-red"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                          
                        </div>
                        <!-- /.col -->
                      <div class="col-xs-4">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                      </div>
                        <!-- /.col -->
                    </div>
            </form>
            <div class="social-auth-links text-center">
              <p>- OR -</p>
              <a href="{{ url('admin/register') }}" class="btn btn-block btn-social btn-facebook btn-flat" style="text-align:center;padding:10px 0px;">Đăng ký</a>
             
            </div>
        </div>
    </div>
@include('admin/layout/footer')
<script type="text/javascript">
    
    $(".btn-flat").click(function(){
      var chek=0;
        $(".form-group").each(function(){
            if(!$(this).children("input").val()){
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