@extends('view/view/main')
@section('title','Home')
@section('content')


<div class="wapper hidden-main" id="main">
	{{-- Slider --}}
	 <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',3);?>

	<div class="main">
		<div class="layout">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 main_left">
						<div class="group_left ">
							<!-- Cắm trang nội dung -->
                            <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',4);?>
                            <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_5',5);?>
							<div class="news_important wow fadeInLeft" style="animation-delay: 0.5s; visibility: visible; animation-name: fadeInLeft;">
                                <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',6);?>
							</div>
							{{--Danh mục ngoài trang chủ--}}
							 <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',7);?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop