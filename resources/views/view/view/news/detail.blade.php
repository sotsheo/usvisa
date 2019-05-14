@extends('view.view.main')
@section('title',$news->name)
@section("content")
<div class="wapper hidden-main" id="main">

{{-- banner in --}}
@include('view/modules/banner/view_18')
<div class="page-news">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<div class="detail-news">
							<h1>
								{{$news->name}}
							</h1>
							<div class="time">
								<span><i class="fa fa-clock-o"></i> {{ date('d-m-Y', $news->date_public) }}</span>
								<span>|</span>
								<span><i class="fa fa-user-circle"></i> Nguyen huy</span>
							</div>
							<div class="sort-desc">
								<?=$news->short_description?>
							</div>
							<div class="content-detail content-standard-ck">
								<?=$news->description?>
							</div>
							<div class="tag-line">
								<div class="tag">
									<div class="hastag">
										<div class="tags"><i class="fa fa-tags" aria-hidden="true"></i>Tags</div>    
										<div class="tags_product">
											<a class="tag_title" title="" href="">thiết kế website</a>
											<a class="tag_title" title="" href="">chuyên nghiệp</a>
										</div>
									</div>
								</div>
								<div class="support-line">
									<p>
										Chia sẻ bài viết trên:
										<a href=""><i class="fa fa-facebook"></i></a>
										<a href=""><i class="fa fa-twitter"></i></a>
										<a href=""><i class="fa fa-instagram"></i></a>
									</p>
								</div>
							</div>
							@include('view/modules/newscorrelate/view')
						</div>
					</div>
					
				</div>
			</div>
		</div>
</div>

@endsection

