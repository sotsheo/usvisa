<?php
foreach($banner as $b){
    ?>
    <div class="banner-page-list" style="background-image:url(<?= url($b->img)?>); margin-bottom: 0">
        <div class="title-page">
            <div class="vertical">
                <div class="middle">
                    @include ('view/modules/breadcrumbs/view')
               </div>
           </div>
       </div>
   </div>
<?php }?>