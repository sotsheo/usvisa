<div class="linhvuc-index">
			<div class="title-standard center wow fadeIn">
				<h2>Lĩnh vực hoạt động</h2>
				<p>
					CÔNG TY CỔ PHẦN VAC VIỆT NAM hiện tại đẩy mạnh và phát triển 3 lĩnh vực mũi nhọn là cung cấp, tư vấn và hỗ trợ bán các sản phẩm phụ tùng, kinh doanh các loại phụ tùng ô tô, các loại dầu nhớt, phụ gia động cơ
				</p>
			</div>
			<div class="container">
				<div class="row">
					@foreach($banner as $b)
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow fadeInUp">
							<div class="item-linhvuc">
								<div class="img">
									<img src="<?= url($b->img)?>" alt="">
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
						</div>
					@endforeach
				</div>
			</div>
		</div>