<?php if(isset($data) && $data){?>
<div class="header_top_right">
	<ul>
        <?php foreach($data as $menu){?>
		    <li><a href="{{$menu->link}}">{{$menu->name}}</a></li>
        <?php }?>
	</ul>
</div>
<?php }?>