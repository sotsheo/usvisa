<html>
    <head>
        <title>Nội dung tĩnh</title>
    @include('admin/layout/head')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('admin/layout/header')

            @include('admin/layout/nav')
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <?php
                        if($messages){
                    ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> <?= $messages?></h4>
                        </div>
                  <?php }?>
               
                </section>
                <section class="content">
                    <div class="row">
                            <div class="col-xs-12">
                            <div class="box">
                                    <div class="box-header with-border">
                                    <h3 class="box-title">Hãng sản xuất</h3>
                                        <a type="btn" class="btn btn-success pull-right"  href="{{ url('admin/html/create') }}"><i class="fa  fa-plus-circle"></i> Thêm</a>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:50px;"> <input type="checkbox" id="select_all"  name="select_all" ></th>
                                                <th>Tên</th>
                                                <th>Nội dung</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($html as $key ):?>
                                            <tr>
                                                <th style="width:50px;"> <input type="checkbox" data="$key->id" class="select_id" name="select_id"></th>
                                                <td>{{ $key->name }}</td>
                                                <td><?= $key->values ?></td>
                                                <td><a href="{{ url('admin/html/edit') }}<?php echo('/'.$key->id); ?>" title="Edit"> <i class="fa  fa-edit "></i></a> <a title="close" class="close_id" href="{{ url('admin/html/delete') }}<?php echo('/'.$key['id']); ?>"> <i class="fa  fa-close "></i></a></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                     {!! $html->links() !!}
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