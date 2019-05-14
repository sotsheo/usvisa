	

	<div class="brand-index wow fadeInUp">
			<div class="container">
				<div class="slider-brand">
					<?php

						foreach ($banner as $b) {
					?>
						<div class="item-brand">
							<div class="vertical">
								<div class="middle">
									<a href="">
										<img src="<?= url($b->img)?>" alt="">
									</a>
								</div>
							</div>
						</div>
					<?php }?>
				</div>
			</div>
		</div>