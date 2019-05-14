
@extends($w->name.'.view.main')
@section('title',$category->name)
@section("content")

<div class="wapper hidden-main" id="main">
	@include('view/modules/banner/view_18')
	<div class="list-news">
		<div class="title-standard center wow fadeIn">
			<h2><?=$category->name?></h2>
		</div>
		<div class="container">
			<div class="row multi-columns-row">
				@if(count($news)>0)
				@foreach($news as $n)
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="item-news">
						<div class="img">
							<a href="<?= url($n->link)?>"><img  class="hover-img" src="<?= url($n->img)?>" alt=""></a>
							<span>{{ date('d/m/Y',$n->date_public) }}</span>
						</div>
						<div class="title">
							<h3>
								<a href="<?= url($n->link)?>">
									{{ str_limit($n->name,30,'...') }}
								</a>
							</h3>
							<div class="time">
								<span><i class="fa fa-clock-o"></i> {{ date('d/m/Y',$n->date_public) }}</span>
								<span>|</span>
								<span><i class="fa fa-user-circle"></i> {{ ($n->user==1)?'admin':$n->user }}</span>
							</div>
							{{ str_limit($n->short_description,150,'...') }}
							<div class="button-style hascolor">
								<a href="<?= url($n->link)?>">Xem chi tiết</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				@endif
				@include('view.modules.paginate.view',['paginator'=>$news])
			</div>
		</div>
	</div>
</div>
@endsection