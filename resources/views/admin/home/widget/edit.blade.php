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
                        <form role="form" action="{{route('edit_widget')}}"   method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" placeholder="Enter ..." name="id" style="display: none" value="{{$wedget->id}}">
                            <div class="form-group required">
                                <label>Tên</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="name" value="{{$wedget->name}}">
                                <span class="text-red"></span>
                            </div>
                            <div class="form-group">
                                <label>Text</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="text_head" value="{{$wedget->text_head}}">
                                <span class="text-red"></span>
                            </div>
                            <div class="form-group select_a ">
                               <label>Type</label>
                               <input type="text" name="type" id="type" class="form-control" placeholder="{{$wedget->type}}" >
                               <span class="text-red"></span>
                           </div>
                           <div class="form-group select_a">
                            <label>Number Type</label>
                            <select class="form-control" name="number_type">
                                <option value="0">Chọn type</option>
                                <?php
                                for($i=1;$i<30;$i++){
                                    ?>
                                    <option value="{{$i}}" {{($i==$wedget->number_type)?'selected':''}}>{{$i}}</option>
                                <?php }?>
                            </select>
                            <span class="text-red"></span>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"  name="show_name" value="1" {{($wedget->show_name!=0)?'checked':''}}>
                                    Show name
                                </label>
                            </div>
                        </div>

                        <div class="form-group limit {{($wedget->limit)?'active':''}}">
                            <label>Limit</label>
                            <input type="text" class="form-control" placeholder="Enter ..." name="limit" value="{{($wedget->limit)}}">
                            <span class="text-red"></span>
                        </div>
                        <div class="form-group result">
                            <label>Number id</label>
                            <select class="form-control" name="id_category" id="item_result"> 

                                <span class="text-red"></span>
                            </select>
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
<style type="text/css">
    .result {
        display:none;
    }
    .result.active{
        display:block;
    }
    .limit{
        display: none;
    }
    .limit.active{
        display: block;
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
        function remove(){
            $("#item_result option").each(function(){
                $(this).remove();
            });
        }
        var datas;
        $("#type").change(function(){

            var type=$(this).val();
            console.log(type)
            var url='';
            switch(type){
                case 'menu':
                url="<?= route('menu_get')?>";
                $(".limit").removeClass("active");
                $(".limit input").val("");
                break;
                case 'productIncategory':
                url="<?= route('get_product_category')?>";
                $(".limit").removeClass("active");
                $(".limit input").val("");
                break;
                case 'newsIncategory':
                url="<?= route('get_news_category')?>";
                $(".limit").addClass("active");
                $(".limit input").val("");
                break;
                case 'newsIncategoryhot':
                url="<?= route('get_news_category')?>";
                $(".limit").addClass("active");
                $(".limit input").val("");
                break;
                case 'newscorrelate':
                $(".limit").addClass("active");
                $(".limit input").val("");
                break;
                case 'productscorrelate':
                $(".limit").addClass("active");
                $(".limit input").val("");
                break;
                case 'pagecontent':
                url="<?= route('get_page_content')?>";
                $(".limit").removeClass("active");
                $(".limit input").val("");
                remove();
                break;
                case 'banner':
                url="<?= route('get_category_banner')?>";
                $(".limit").addClass("active");
                $(".limit input").val("");
                remove();
                break;
                case 'category':
                $(".limit").removeClass("active");
                $(".limit input").val("");
                $(".result").addClass("active");
                html="<option value='1'>Danh mục tin tức</option>";
                html+="<option value='2'>Danh mục sản phẩm</option>";
                $("#item_result").append(html);
                break;
                case 'productCategoryInhome':
                break;
                case 'html':
                url="<?= route('get_html')?>";
                $(".limit").removeClass("active");
                $(".limit input").val("");
                remove();
                break;
                case 'newnews':
                $(".limit").addClass("active");
                $(".result").removeClass("active");
                remove();
                case 'newshot':
                $(".limit").addClass("active");
                $(".result").removeClass("active");
                remove();
                break;
                case 'productselling':
                $(".limit").addClass("active");
                $(".limit input").val("");
                break;
                case 'productnew':
                $(".limit").addClass("active");
                $(".result").removeClass("active");
                remove();
                break;
                case 'producthot':
                $(".limit").addClass("active");
                $(".result").removeClass("active");
                remove();
                break;
                case 'manufacturer':
                $(".limit").addClass("active");
                $(".result").removeClass("active");
                remove();
                break;
            }
            if(url){
              getMessage(url);
          }
      });

        function getMessage(urls) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:urls,
                success:function(data) {
                    if(data){
                        $(".result").addClass("active");
                        remove();
                        data.forEach(function(element){
                            html="<option value='"+element['id']+"'>"+element['name']+"</option>";
                            $("#item_result").append(html);
                        });
                    }                
                    else{
                        $(".result").removeClass("active");
                    }
                }
            });
        }
    });

</script>

</body>
</html>