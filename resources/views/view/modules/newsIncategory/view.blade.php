
<?php
	foreach ($news as $n) {

?>
<div class="video-intro-index">
	<div class="container">
		<div class="right-intro">
			<div class="video-intro">
				<div class="img">
					<img  class="hover-img" src="<?= url($n->img)?>" alt="">
				</div>
			</div>
		</div>
		<div class="left-intro">
			<div class="title">
				<h2><a href="<?= url($n->link)?>">{{$n->name}}</a></h2>
			</div>
			<div class="time">
				<span><i class="fa fa-clock-o"></i>{{ date('d/m/Y',$n->date_public) }}</span>
				<span>|</span>
				<span><i class="fa fa-user-circle"></i> {{ ($n->user==1)?'admin':$n->user }}</span>
			</div>
			<p>
				{{$n->short_description}}
			</p>
			<div class="button-style hascolor">
				<a href="{{$n->link}}">Xem chi tiết</a>
			</div>
		</div>
	</div>
</div>
<?php }?>