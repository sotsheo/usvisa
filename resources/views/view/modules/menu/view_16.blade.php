<div class="menu-footer">
	<h2>
		Sản phẩm và dịch vụ
	</h2>
	<div class="news-footer">

		<ul>
			<?php
			foreach ($menu as $m) {
				?>
				<li>
					<a href="<?= url($m->link)?>">
						<i class="fa fa-caret-right"></i> {{$m->name}}
					</a>
				</li>
				<?php }?>
			</ul>
		</div>
	</div>