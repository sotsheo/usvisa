<?php

class dequy{
   function show($categories, $parent_id = 0, $char = ''){
        // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
            // Nếu là chuyên mục con thì hiển thị
        if ($item['id_parent'] == $parent_id)
        {
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
        // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($cate_child)
    {
        echo '<ul>';
        foreach ($cate_child as $key => $item)
        {
                // Hiển thị tiêu đề chuyên mục
            echo '<li><a href='.url($item['link']).'>'.$item['name'].'</a>';
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            $this->show($categories, $item['id'], $char.'|---');
            echo '</li>';
        }
        echo '</ul>';
    }
}
}
?>

    <?php
    $dequys=new dequy;
    if(isset($data) && $data){
        $dequys->show($data);
    }
    ?>

