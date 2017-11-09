{{--  Định nghĩa trang xác thực  --}}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang xác thực</title>
	@include('link_views.import')
	
	<style>
		.gi-2x{font-size: 2em;}
		.gi-3x{font-size: 3em;}
		.gi-4x{font-size: 4em;}
		.gi-5x{font-size: 5em;}
	</style>
</head>
<body>
    {{--  Script import jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script validate dữ liệu from xác thực  --}}
    <script src="{{ asset('js/validate_login_form.js') }}"></script>


    <div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
                
                <h1 class="text-center">Xác thực máy trạm để điểm danh</h1>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin quản trị</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('check_admin_mail') }}" method="POST" id="f_dgnhap">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="mask" value="{{ $mask }}">
								
								@if ($ma_so_xac_thuc == null)
									<label for="">Nhập email người quản trị để yêu cầu xác thực</label>
						        	<input type="email" class="form-control" id="email" autofocus placeholder="Email" name="email" value="{{old('email')}}">
								@else
									<h4 class="text-success"><b>Mã xác thực đã được gửi đến mail người quản trị</b></h4>
									<label for="">Nhập mã số xác thực:</label>
									<input type="text" class="form-control" autofocus placeholder="mã số xác thực" name="ma_so_xac_thuc">
								@endif
								
								<br>
								@if ($ma_so_xac_thuc == null)
									<div id="check_email">
										{{--  Gọi code thực hiện xoay icon Đang điểm danh  --}}
										@include('link_views.rotation_icon')

										<b class="text-success">
											<span class="glyphicon glyphicon-refresh gly-spin gi-2x"></span>
											Đang kiểm tra email, vui lòng chờ trong giây lát
										<b>
									</div>
								@endif
								
							</div>

							@if (Session::get('err_xac_thuc') == "1")
								@if ($ma_so_xac_thuc == null)
									<h4><i class='text-danger'>Email quản trị không đúng</i></h4>
								@else
									<h4><i class='text-danger'>Mã xác thực không đúng</i></h4>
								@endif
								<?php
									\Session::forget('err_xac_thuc');
								?>
							@endif
							
							
							<button type="submit" id="btn_xac_thuc" class="btn btn-success">
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								xác thực
							</button>
						</form>

						<script>
							$(document).ready(function () {
								$("#check_email").hide(0);
							});
							$("#btn_xac_thuc").click(function (e) { 
								$("#check_email").show(0);
								
							});
						</script>

                    </div>
                </div>
                
				
			</div>
		</div>
	</div>
</body>
</html>