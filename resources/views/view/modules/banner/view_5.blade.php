
<div class="camket">
	<div class="container">
		@foreach($banner as $b)
		<div class="item-camket">
			<div class="img">
				<img src="{{ url($b->img)}}" alt="">
			</div>
			<div class="title">
				<h2>
					{{ $b->name}}
				</h2>
				<p>
					{{ $b->short_description}}
				</p>
			</div>
		</div>
		@endforeach
	</div>
</div>