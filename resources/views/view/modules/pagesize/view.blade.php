<?php
	$pages=(isset($_GET['pagesize']))?$_GET['pagesize']:'';
	$url=url()->current();
	$urls=url()->full();
	$page='';
	if(Request::get('sort')){
		$page='?sort='.Request::get('sort');
	}
	if(Request::get('sortmanufacturer')){
		if($page==''){
			$page='?sortmanufacturer='.Request::get('sortmanufacturer');
		}
		else{
			$page.='&sortmanufacturer='.Request::get('sortmanufacturer');
		}	
	}
	if(Request::get('price_min')!=null){
		if($page==''){
			$page='?price_min='.Request::get('price_min').'&price_max='.Request::get('price_max');
		}
		else{
			$page.='&price_min='.Request::get('price_min').'&price_max='.Request::get('price_max');
		}	
	}	
	
?>
<select id="pagesize">
	<option  hrefs="<?php echo($url.$page)?>">Số sản phẩm hiển thị</option>
	<?php
		if($page==''){
		$page='?pagesize=';
	}
	else{
		$page.='&pagesize=';
	}
	?>
	<option  value="16" {{ $pages=='16'?'selected':'' }} hrefs="<?php echo($url.$page.'16')?>">Hiển thị 16 sản phẩm</option>
	<option value="8" {{ $pages=='8'?'selected':'' }} hrefs="<?php echo($url.$page.'8')?>">Hiển thị 8 sản phẩm</option>
</select>
<script type="text/javascript">
	$(document).ready(function(){
		$("#pagesize").change(function(){
			window.location.href=$(this).children("option:selected").attr('hrefs');

		});
	});
</script>