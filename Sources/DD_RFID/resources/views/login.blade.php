{{--  Định nghĩa trang đăng nhập  --}}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang đăng nhập</title>
    @include('link_views.import')
</head>
<body>
    {{--  Script import jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script validate dữ liệu from đăng nhập  --}}
    <script src="{{ asset('js/validate_login_form.js') }}"></script>


    <div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
                
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng nhập</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('login') }}" method="POST" id="f_dgnhap">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="">Email</label>
						        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{old('email')}}">
							</div>

							<div class="form-group">
								<label for="">Mật khẩu:</label>
								<input type="password" class="form-control" name="pass" id="pass" placeholder="Mật khẩu">
							</div>

							<?php 
								if (Session::get('err') == "1") {
									echo "
										<h4><i class='text-danger'>Tên đăng nhập hoặc mật khẩu không đúng</i></h4>
									";
									Session::forget('err');
								}
							?>
							
							<button type="submit" class="btn btn-success">
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								Đăng nhập
							</button>

							<a href="{{ route('home') }}" class="btn btn-primary">
								<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
								Về trang chủ</a>
						</form>
                    </div>
                </div>
                
				
			</div>
		</div>
	</div>
</body>
</html>