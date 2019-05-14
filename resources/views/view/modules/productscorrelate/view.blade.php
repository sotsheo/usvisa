

@if(count($product) && isset($product))
<div class="title-box">
    <h2>
        Sản phẩm liên quan
    </h2>
</div>
<div class="row">
   <div class="slider-related-product">

    <?php
    foreach($product as $p){
        ?>
        <div class="item-product">
            <div class="img">
                <a href="<?=url($p->link)?>">
                    <img class="hover-img" src="<?=url($p->img)?>" alt="{{$p->name}}">
                </a>
            </div>
            <div class="title">
                <h3>
                    <a href="<?=url($p->link)?>">{{ str_limit($p->name,30,'...') }}</a>
                </h3>
                <p class="price"><?=number_format($p->price ,0 ,'.' ,'.').' Đ'?> 
                    @if($p->price_market)
                    <span><?=number_format($p->price_market ,0 ,'.' ,'.').' Đ'?></span>
                    @endif
                </p>
                
            </div>
        </div>
        <?php }?>

    </div>
</div>
@endif