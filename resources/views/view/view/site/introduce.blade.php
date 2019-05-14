
@extends('view.view.main')
@section('title','Giới thiệu')
@section("content")

<div class="wapper hidden-main" id="main">
	 @include('view/modules/banner/view_18')
	<div class="container">
		<?=($data->description);?> 	
	</div>
   
   	
   @include('view/modules/banner/view_12')
</div>
@endsection