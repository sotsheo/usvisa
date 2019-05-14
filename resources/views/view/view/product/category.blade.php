
@extends('view.view.main')
@section('title',$category->name)
@section("content")

<div class="wapper hidden-main" id="main">
  @include('view/modules/banner/view_18')
  <div class="product-page">
     <div class="shadow-open-filter"></div>
     <div class="container">
        <div class="row mar-10">
                    <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pad-10 awe-check hide-mobile-check">
                        <div class="filter-box-left">
                            <div class="cate-box">
                                <h2>
                                    Tất cả sản phẩm
                                </h2>
                                <div class="list-cate-box">
	                                <div class="menu-bar-lv-1">
	                                	<a class="a-lv-1" href="">Hệ thống lọc</a>
	                                	<div class="menu-bar-lv-2">
	                                		<a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Phụ tùng khác</a>
	                                		<div class="menu-bar-lv-3">
	                                			<a class="a-lv-3" href=""><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>Phụ tùng khác 1</a>
	                                		</div>
	                                		<div class="menu-bar-lv-3">
	                                			<a class="a-lv-3" href=""><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>Phụ tùng khác 2</a>
	                                		</div>
	                                		<div class="menu-bar-lv-3">
	                                			<a class="a-lv-3" href=""><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>Phụ tùng khác 3</a>
	                                		</div>
	                                		<span class="span-lv-2 fa fa-angle-right"></span>
	                                	</div>
	                                	<div class="menu-bar-lv-2"><a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Hệ thống phanh</a></div>
	                                	<div class="menu-bar-lv-2"><a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Dầu nhớt động cơ</a></div>
	                                	<div class="menu-bar-lv-2"><a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Phụ gia động cơ</a></div>
	                                	<span class="span-lv-1 fa fa-angle-right"></span>
	                                </div>
	                                <div class="menu-bar-lv-1">
	                                	<a class="a-lv-1" href="">Hệ thống phanh</a>
	                                </div>
	                                <div class="menu-bar-lv-1">
	                                	<a class="a-lv-1" href="">Dầu nhớt động cơ</a>
	                                </div>
	                                <div class="menu-bar-lv-1">
	                                	<a class="a-lv-1" href="">Phụ gia động cơ</a>
	                                </div>
	                                <div class="menu-bar-lv-1">
	                                	<a class="a-lv-1" href="">Phụ tùng khác</a>
	                                </div>
                                </div>
                            </div>
                            <div class="categories-menu">
                                <h2>
                                    Giá sản phẩm
                                </h2>
                                <div class="group-check-box">
                                	<div class="radio">
                                        <input type="radio" name="radiobox" value="Radio box 1">
                                        <label><span class="text-clip" title="500.000">Dưới 500.000 vnđ</span></label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="radiobox" value="Radio box 1">
                                        <label><span class="text-clip" title="500.000">500.000 - 2.000.000 vnđ</span></label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="radiobox" value="Radio box 1">
                                        <label><span class="text-clip" title="500.000">2.000.000 - 5.000.000 vnđ</span></label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="radiobox" value="Radio box 1">
                                        <label><span class="text-clip" title="500.000">5.000.000 - 10.000.000 vnđ</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="categories-menu">
                                <h2>
                                    Hãng xe <span class="fa fa-minus"></span>
                                </h2>
                                <div class="group-check-box">
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">Volkswagen</span></label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">BMW</span></label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">Mercedes-Benz</span></label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">Hyundai</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="categories-menu">
                                <h2>
                                    Model <span class="fa fa-minus"></span>
                                </h2>
                                <div class="group-check-box">
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">BMW 3 seri demo</span></label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">BMW 4 seri demo</span></label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">BMW 5 seri demo</span></label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">BMW 6 seri demo</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="categories-menu">
                                <h2>
                                    Model type <span class="fa fa-minus"></span>
                                </h2>
                                <div class="group-check-box">
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">320</span></label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">F30</span></label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">320</span></label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" class="ais-checkbox" value="500.000">
                                        <label><span class="text-clip" title="radio">F30</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="categories-menu">
                                <h2>
                                    Hỗ trợ bán hàng
                                </h2>
                                <p>
                                	Nếu gặp khó khăn trong quá trình mua hàng, quý khách vui lòng liên hệ theo:
                                </p>
                                <div class="btn-2">
									<a href="">Hotline: 19001138 - 024 3943 7284</a>
								</div>
								<div class="btn-2">
									<a href="">Email: info@vacvn.vn</a>
								</div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pad-10">
                        <div class="title-categories-page">
                            <h3>
                                {{ $category->name }}
                            </h3>
                        </div>
                        <div class="filter-review-detail">

                            <div class="filter-review filter-list-product">
                            	<div class="btn-show-filter">
                            		Bộ lọc sản phẩm
                            	</div>
                                @include('view/modules/pagesize/view')
                                
                               {{--  @include ('model/widget/view',['id'=>24])
                                @include ('model/widget/view',['id'=>23])
                                @include ('model/widget/view',['id'=>22]) --}}
                            </div>
                        </div>
                        <div class="list-product-categories">
                        	<div class="row multi-columns-row">
                        		@if(count($product)>0)
                             @foreach($product as $p)
                             <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif 
                </div>
                @include('view.modules.paginate.view',['paginator'=>$product])
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection