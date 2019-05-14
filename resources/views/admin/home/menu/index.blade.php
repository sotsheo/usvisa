<html>
<head>
    <title>Menu</title>
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
                <div style="margin-bottom:15px;"> 
                    <a  class="btn btn-success pull-right" href="{{ url('/admin/menu/menu_create_category/') }}"><i class="fa  fa-plus-circle"></i> Thêm</a>
                    <div style="clear:both"> </div>
                </div>
                <div class="row">

                    <?php
                    $i=0;
                    foreach($category as $key){
                        $i++;

                        ?>
                        <div class="col-lg-6 connectedSortable ui-sortable">
                           <div class="box box-primary">
                            <div class="box-header ui-sortable-handle" style="cursor: move;">
                                <i class="ion ion-clipboard"></i>

                                <h3 class="box-title"><a href="{{ url('/admin/menu/edit_category/') }}<?php echo('/'.$key->id); ?>">{{$key->name}}</a></h3>
                                <a href="{{ url('/admin/menu/delete_category/') }}<?php echo('/'.$key->id); ?>"><i class="fa  fa-close " style="float: right"></i></a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                                <?php
                                    if(count($menu)){
                                ?>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            
                                            <th>Tên </th>
                                            <th>Vị trí</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       foreach($menu as $item){
                                        if($item->id_category==$key->id){
                                            ?>
                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->location}}</td>
                                                <td class="tools">
                                                    <a href="{{ url('/admin/menu/edit_menu/') }}<?php echo('/'.$item->id); ?>"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ url('/admin/menu/delete_menu/') }}<?php echo('/'.$item->id); ?>"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>    
                                            <?php
                                        }
                                    }
                                    ?>                 
                                </tbody>
                            </table>
                            <?php }?>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix no-border">
                            <a type="button" class="btn btn-default pull-right" href="{{ url('/admin/menu/create_id/') }}<?php echo('/'.$key->id); ?>"><i class="fa fa-plus"></i> Thêm menu</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>

    </section>
</div>
</div>
@include('admin/layout/footer')

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