


<h2>{{ $breadcrumb[count($breadcrumb)-1]['name'] }}</h2>
<div class="breadcrumb">
	<?php
		$i=0; 
	foreach($breadcrumb as $b){
		$i++;

	?>
	@if($i<count($breadcrumb))
		<a href="{{$b['link']}}">{{$b['name']}}</a>/
	@else
		<p>{{$b['name']}}</p>
	@endif
	<?php }?>
</div>
<style type="text/css">
	.breadcrumb a{
		text-transform: capitalize;
	}
</style>