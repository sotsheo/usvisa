
<?php if(isset($banner) && $banner){?>
	<div class="slider wow fadeInUp">

		<div class="container">
			<div class="slider_main owl-carousel owl-theme">
				<?php foreach ($banner as $b) { ?>
					<div class="item">
						<a href="{{$b->link}}">
							<img src="<?= url($b->img)?>" alt="{{$b->name}}">
						</a>
					</div>
				<?php }?>

			</div>
		</div>
	</div>
<?php }?>