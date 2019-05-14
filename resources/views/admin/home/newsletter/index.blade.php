<html>
<head>
    <title>Đăng ký nhận bản tin</title>
    @include('admin/layout/head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('admin/layout/header')

        @include('admin/layout/nav')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">


            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Đăng ký nhận bản tin</h3>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:50px;"> <input type="checkbox" id="select_all"  name="select_all" ></th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Thời gian gửi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i=0;
                                        foreach ($news as $key ){
                                            $i++;
                                            ?>
                                            <tr class="{{($i<=$count)?'viewed':''}}">
                                                <th style="width:50px;"> <input type="checkbox" data="$key->id" class="select_id" name="select_id"></th>
                                                <td>{{ $key->name }}</td>
                                                <td>{{ $key->email }}</td>
                                                <td>{{ $key->phone }}</td>
                                                <td>{{ date('d/m/Y', $key->date_create) }}</td>
                                                <td>
                                                    <a title="close" class="close_id" href="{{ url('admin/newsletter/delete') }}<?php echo('/'.$key['id']); ?>"> 
                                                        <i class="fa  fa-close "></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        
                                    </table>
                                    {!! $news->links() !!}
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
        @include('admin/layout/footer')
        <style type="text/css">
            .pagination {
                float: right;
            }
            .table-bordered tbody  .viewed td{
                background-color:#e4e2e2 !important;
                border: 1px solid #e4e2e2 !important;
            }
        </style>
        <script>
            $(".close_id").each(function(){
                $(this).click(function(){
                    var tb=confirm("Bạn có chắc xóa bạn ghi này không");
                    if(tb != true){
                        return false;
                    }
                    
                });
            });

        </script>
    </body>
    </html>