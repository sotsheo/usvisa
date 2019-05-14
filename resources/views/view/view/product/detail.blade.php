
@extends('view.view.main')
@section('title',$product->name)
@section("content")
 
<div class="product-page">
    @include('view/modules/banner/view_18')
            <div class="detail-product-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <div class="img-detail-product">
                                <div class="app-figure" id="zoom-fig">
                                    <div class="big-img">
                                        <a id="Zoom-1" class="MagicZoom" data-options="selectorTrigger: hover; transitionEffect: false;zoomDistance: 20;zoomWidth:520px; zoomHeight:500px;variableZoom: true" title="Show your product in stunning detail with Magic Zoom Plus." href="{{ url($product->img)}}" >
                                            <img src="{{ url($product->img)}}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="thumb-img">
                                        <div id="owl-detail" class="selectors">
                                        <?php
                                            if($product->imgs){
                                            $mang=explode(',', $product->imgs);
                                            foreach($mang as $item){
                                        ?>
                                        <a data-zoom-id="Zoom-1" href="{{url(trim($item))}}"
                                                data-image="{{url(trim($item))}}" >
                                                <img src="{{url(trim($item))}}"/>
                                            </a>
                                        <?php }?>
                                     <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="title-detail-product">
                                <h1>
                                    {{ $product->name }}
                                </h1>
                                <div class="sku-product">
                                    <ul>
                                        <?php
                                            use App\Http\Controllers\Admin\Manufacturer_controller;
                                            $man =Manufacturer_controller::get_Manufacturer(); 
                                        ?>
                                        @foreach($man as $m)
                                            @if($m->id==$product->manufacturer)
                                                <li>
                                                    <p>Thương hiêu: <span><a href="">{{ $m->name }}</a></span></p>
                                                </li>
                                            @endif
                                        @endforeach

                                        @if($product->code)
                                        <li>
                                            <p>Mã:{{ $product->code }}</p>
                                        </li>
                                        @endif
                                     
                                    </ul>
                                </div>
                                <div class="status-product">
                                    {{ $product->short_description }}
                                </div>
                                <div class="price-product">
                                    <div class="item-price-product">
                                        <p><?=number_format($product->price ,0 ,'.' ,'.').' Đ'?></p>
                                        <span>(Đã bao gồm VAT) </span>
                                    </div>
                                </div>
                                <div class="option-product-detail">
                                    <div class="item-option-product-detail">
                                        <label>Số lượng:</label>
                                        <div class="quality-product-detail">
                                            <div class=" pull-left">
                                                <input onkeypress="isAlphaNum(event);" type="text" title="Số lượng" value="1" maxlength="12" id="qty" name="quantity" class="input-text" oninput="validity.valid||(value='');">
                                                <div class="btn_count">
                                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus"></i></button>
                                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="addcart-detail-product">
                                        <a class="btn-add-cart" href="">Thêm vào giỏ Hàng</a>
                                        <a href="<?=url('/cart/add')?>/{{ $product->id }}/1" class="buy-now" atl='<?=url('/cart/add')?>/{{ $product->id }}'>Mua ngay</a>
                                    </div>
                                    <div class="share">
                                        <img src="images/share.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="infor-detail-product">
                                <div class="ctn-detail-product">
                                    <div class="ctn-left-detail">
                                        <div class="option-detail">
                                            <h2>Thông tin sản phẩm</h2>
                                          <?=  $product->short_description?>
                                        </div>
                                        <div class="content-detail">
                                            <h2>
                                                MÔ TẢ SẢN PHẨM
                                            </h2>
                                            <div class="content-standard-ck tiny-content">
                                                <?=  $product->description?>
                                            </div>
                                            <div class="btn-more-detail">
                                                <button><span>Xem tất cả nội dung</span> <span>Thu gọn</span></button>
                                            </div>
                                        </div>
                                        <div class="fb-comment">
                                            <img src="images/fb.png" alt="">
                                        </div>
                                        <div class="related-product">
                                            @include('view/modules/productscorrelate/view')
                                        </div>
                                    </div>
                                    <div class="ctn-right-detail">
                                        {{-- @include ('model/widget/view',['id'=>29]) --}}
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
    $(".btn_count button").click(function(){
        $(".buy-now").attr("href", $(".buy-now").attr('atl')+'/'+$("#qty").val());
    });
</script>

@endsection
