<div class="menu-footer">
	<h2>
		Nhận thông tin
	</h2>
	<p>
		Đăng ký nhận thông tin của chúng tôi để có thể trở thành người đầu tiên nhận được thông tin về các chương trình khuyến mãi mới nhất của chúng tôi
	</p>
	<div class="newsletter">
		  <form role="form" action="{{route('create_newsletter')}}"   method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
			<input type="email" placeholder="Email của bạn" name='email'>
			<button class="btn-footer">Đăng ký nhận tin</button>
		</form>
	</div>
</div>
@include('view.modules.flase.view')