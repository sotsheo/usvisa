<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
	@include ('model/widget/view',['id'=>20])
	@if(count($newshot)>0)
		<div class="news-hot">
			<h2 class="head-news-hot"><span>Bài viết nổi bật</span></h2>
			<div class="owl-news-hot-inmobile">
				<?php
					foreach($newshot as $n){
				?>
					<div class="item-news-hot">
						<div class="img-news-hot">
							<a href="<?= url($n->link).$n->id?>"><img class="hover-img" src="<?= url($n->img)?>" alt=""></a>
						</div>
						<div class="title-news-hot">
							<h3>
								<a href="<?= url($n->link).$n->id?>"><?= $n->name?></a>
							</h3>
							<span class="time-hot"><i class="fa fa-clock-o"></i>{{ date('d/m/Y',$n->date_public) }}</span>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	@endif
</div>