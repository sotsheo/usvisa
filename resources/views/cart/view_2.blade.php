<html>
<head>
	@include('admin/layout/head')
	<title>Thanh toán</title>
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
						<div class="row">
							<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 if_user">
							<div class='infomation_user'>
								<h2>Thông tin cá nhân</h2>
								<form role="form" action="{{route('order_v2')}}"   method="post" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group required">
											<label>Tên</label>
												<input type="text" class="form-control" placeholder="Họ tên ..." name="name_user">
												<span class="text-red"></span>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group">
											<label>Số điện thoại</label>
												<input type="text" class="form-control" placeholder="Phone ..." name="phone_user">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group required_a">
											<label>Địa chỉ</label>
											<textarea class="form-control" rows="3" placeholder="Địa chỉ" 
											name="address_user"></textarea>
											<span class="text-red"></span>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group ">
											<label>Ghi chú</label>
											<textarea class="form-control" rows="3" placeholder="Nội dung" 
											name="note_user"></textarea>
											<span class="text-red"></span>
										</div>
									</div>
									<div class="col-sm-12 ">
										<button type="submit" class="btn btn-success pull-right">Thanh toán
										</button>
									</div>
								</form>
							</div>
							
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 if_product">
								<div class='item'>
									<table>
										<tr>
											<th>Tên sản phẩm</th>
											<th>Số lượng</th>
											<th>Giá</th>
										</tr>
										@foreach($cart as $p)
										<tr>
											<td>{{$p->name}}</td>
											<td>{{$p->qty}}</td>
											<td>{{ number_format($p->qty * $p->price ,0 ,'.' ,'.').' Đ'}}</td>
										</tr>
										@endforeach
									</table>
									<div>
										<form>
											<input type='text' name='code_product' placeholder="Mã giảm giá">
											<button type="submit"><i class="fa fa-send"></i></button>
										</form>
									</div>

								</div>
							</div>
						</div>
							
						</div>
						
						<!-- /.box -->
					</div>
				</div>
			</section>

		</div>
		<style>
			.if_product{
				padding: 15px;
				border: 1px solid #d0cfcf;
				box-shadow: 0px 0px 6px #a79f9f;
			}
			.infomation_user{
				box-shadow: 0px 0px 6px #a79f9f;
				float:left;
				width:100%;
			}
			.infomation_user h2{
				padding: 15px;
				border: 1px solid #d0cfcf;
				margin: 0px;
				font-size: 16px;
				text-transform: uppercase;
				background: #52bff5;
				color: #fff;
			}
			.infomation_user form{
				float:left;
				width:100%;
				padding:15px 0px;
				
				border-top:0px;
			}
			.item table{
				width: 100%;
    			border: 1px solid #d0cfcf;
				margin-bottom: 15px;
			}
			.item table th,.item table td{
				padding:10px 5px;
    			font-size: 14px;
    			border: 1px solid #d0cfcf;
			}
			.item form{
				position: relative;
			}
			.item form input{
				width:100%;
				height: 35px;
				padding-left: 15px;
			}
			.item form button{
				position: absolute;
				border: 0px;
				height: 35px;
				right: 0px;
				top: 0px;
				width: 60px;
				background: #0f3be4;
				color: #fff;
			}
		</style>
		@include('admin/layout/footer')
		<script type="text/javascript">
			$(document).ready(function() {
				$('.number').bind("cut copy paste drag drop", function(e) {
					e.preventdefault();
				});     
				$(".div_count .amount-down").each(function(){
					$(this).click(function(){
						var giatri=parseint($(this).siblings('.number').val())-1;
						var id=$(this).attr("id_data");
						if( giatri>=0){
							$(this).siblings('.number').val(giatri);
							increaseqty(id,giatri);
						}

					})
				});
				$(".div_count .amount-up").each(function(){
					$(this).click(function(){
						var giatri=parseint($(this).siblings('.number').val())+1;
						var id=$(this).attr("id_data");
						if( giatri>=0){
							$(this).siblings('.number').val(giatri);
							increaseqty(id,giatri);
						}

					})
				});
			});
			function isnumberkey(evt) {
				var charcode = (evt.which) ? evt.which : evt.keycode;
				if (charcode > 31 && (charcode < 48 || charcode > 57))
					return false;
				return true;
			}
			function increaseqty(id, qty) {
				document.location="<?=url('/cart/update')?>" +  "/"+id + "/" + qty;
			}
		</script>
	</body>
	</html>