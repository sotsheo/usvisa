<html>
<head>
	@include('admin/layout/head')
	<title>Giỏ hàng</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="container">
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Giỏ hàng</h3>

						</div>
						<!-- /.box-header -->
						<div class="box-body">
						@if(count($cart)>0)
							<div class="giohang">
								<div class="title">
									<div class="name">
										<h3>Tên sản phẩm</h3>
									</div>
									<div class="price">
										<h3>Giá</h3>
									</div>
									<div class="number_p">
										<h3>Số lượng</h3>
									</div>
									<div class="prices">
										<h3>Tổng tiền</h3>
									</div>
								</div>
								<div class="contents">
									<?php
									foreach($cart as $c){
										?>
										<div class="item">
											<div class="name">
												<img src="<?= url($c->img)?>">
												<h2><a href="<?= url($c->link)?>">{{$c->name}} </a></h2>
											</div>
											<div class="group">
												<div class="price">
													<p>15000</p>
												</div>
												<div class="number_p">
													<div class="div_count">
														<a href="javascript:void(0);" class="amount-down" id_data='<?php echo($c->id); ?>'>
															<button >
																<i class="fa fa-minus" aria-hidden="true"></i>
															</button>
														</a>
														<input type="text" name="" value="{{$c->qty}}" class="number">
														<a href="javascript:void(0);" class="amount-up" id_data='<?php echo($c->id); ?>'>
															<button >
																<i class="fa fa-plus" aria-hidden="true"></i>
															</button>
														</a>
													</div>
												</div>
											</div>
											<div class="prices">
												<p>{{$c->qty.$c->price}}</p>
											</div>
											<a href="{{ url('cart/delete/') }}<?php echo('/'.$c->id); ?>" title="Edit" class='close_item'><i class="fa  fa-close "></i></a> 
										</div>
										<?php }?>
										
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							@else
								<p>Hiện tại không có sản phẩm trong giỏ hàng</p>
							@endif
						</div>
						<div class="continew">
							<a type="button" class="btn btn-block btn-primary" href="/">Tiếp tục mua hàng</a>
							@if(count($cart)>0)
								<a type="button" class="btn btn-block btn-success" href="{{ url('cart/order') }}">Thanh toán</a>
							@endif
						</div>
						<!-- /.box -->
					</div>
				</div>
			</section>

		</div>

		@include('admin/layout/footer')
		<style type="text/css">
			.continew .btn{
				width: 150px;
				float: left;
			}
			.continew .btn:last-child{
				float: right;
			}
			h2,h3{
				font-size: 16px;
				margin: 0px;
			}
			.giohang .title{
				float: left;
				width: 100%;
				background: #e2e2e2;
				border-bottom: 1px solid #dcd5d5;
			}
			.giohang .contents .item{
				float: left;
				width: 100%;
				border-bottom: 1px solid #dcd5d5;
				position: relative;
				
			}
			.giohang .contents .item .name img{
				width: 50px;
				height: 50px;
				float: left;
			}
			.giohang .contents .item .close_item{
				position: absolute;
				right: 10px;
				top: 10px;
				padding: 10px;
			}
			.giohang .contents .item .name h2{
				float: left;
				width: calc(100% - 60px);
				padding-left: 5px;
				line-clamp: 2;
			    -webkit-line-clamp: 2;
			    -webkit-box-orient: vertical;
			    overflow: hidden;
			    display: -webkit-box;
			}
			.giohang .contents .item .group{
				padding: 0px;
			}
			.giohang .contents .item .group >div{
				padding: 10px;
			}
			.giohang .title >div,.giohang .contents .item>div{
				padding: 10px;
			}
			.giohang .name{
				width: 50%;
				float: left;
			}
			.giohang .price,.giohang .prices{
				width: 15%;
				float: left;
			}
			.giohang .number_p{
				width: 20%;
				float: left;
			}
			.div_count{
				width: 130px;
				max-width: 130px;
				position: relative;
				display: table;
				border-collapse: separate;
				margin: 0 auto;
			}
			.div_count a{
				border-top-right-radius: 0;
				border-bottom-right-radius: 0;
				background: #f7f7f7;
				padding: 0;
				font-size: 14px;
				font-weight: 400;
				line-height: 1;
				color: #555;
				text-align: center;
				background-color: #eee;
				border: 1px solid #ccc;
				border-radius: 0px;
				display: table-cell;
				width: 1%;
				white-space: nowrap;
				vertical-align: middle;
			}
			.div_count button {
				border: none;
				background: transparent;
				padding: 0;
				height: 29px;
				width: 32px;
				line-height: 29px;
				color: #666666;
				outline: none;
			}
			.div_count input{
				background: #f7f7f7;
				padding: 0;
				padding: 6px 12px;
				font-size: 14px;
				font-weight: 400;
				line-height: 1;
				color: #555;
				text-align: center;
				background-color: #eee;
				border: 1px solid #ccc;
				border-radius: 0px;
				display: table-cell;
				width: 100%;
				display: block;
				height: 33px;
				padding: 6px 12px;
				background-color: #fff;
				background-image: none;
				-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
				box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
				-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
				-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
				transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			}
			.update{
				text-align: center;
				margin-top: 10px;
			}
			@media (max-width: 768px){
				.giohang .prices{
					display: none;
				}
				.giohang .title .price:last-child{
					display:none;
				}
				.giohang .group{
					float: left;
					width: 50%;
				}
				.giohang .title .number_p{
					display: none;
				}
				.giohang .item .price,.giohang  .number_p{
					width: 100%;
					text-align: center;
				}
				.div_count button {
					height: 20px;
					width: 20px;
					line-height: 20px;
				}
				.div_count input {
					padding: 0px;
				}
				.div_count {
					width: 100px;
				}
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.number').bind("cut copy paste drag drop", function(e) {
					e.preventDefault();
				});     
				$(".div_count .amount-down").each(function(){
					$(this).click(function(){
						var giatri=parseInt($(this).siblings('.number').val())-1;
						var id=$(this).attr("id_data");
						if( giatri>=0){
							$(this).siblings('.number').val(giatri);
							increaseQty(id,giatri);
						}

					})
				});
				$(".div_count .amount-up").each(function(){
					$(this).click(function(){
						var giatri=parseInt($(this).siblings('.number').val())+1;
						var id=$(this).attr("id_data");
						if( giatri>=0){
							$(this).siblings('.number').val(giatri);
							increaseQty(id,giatri);
						}

					})
				});
			});
			function isNumberKey(evt) {
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;
				return true;
			}
			function increaseQty(id, qty) {
				document.location="<?=url('/cart/update')?>" +  "/"+id + "/" + qty;
			}
		</script>
	</body>
	</html>