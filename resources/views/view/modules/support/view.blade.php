
<ul>
	<?php
	
	foreach ($support as $sp) {
		?>
	<li>
		<?php if($sp->name_type=='fb'){?>
		<a class="fb" href="{{$sp->link}}"><i class="fa fa-facebook"></i></a>
		<?php }?>
		<?php if($sp->name_type=='google +'){?>
		<a class="gg" href="{{$sp->link}}"><i class="fa fa-google-plus"></i></a>
		<?php }?>
		<?php if($sp->name_type=='youtube'){?>
		<a class="yt" href="{{$sp->link}}"><i class="fa fa-youtube"></i></a>
		<?php }?>
	</li>
	<?php }?>
</ul>

