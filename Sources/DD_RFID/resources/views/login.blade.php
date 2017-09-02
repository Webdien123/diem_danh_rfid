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
    <div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
                
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng nhập</h3>
                    </div>
                    <div class="panel-body">
                        <form action="#" method="POST" role="form">
                            @if($errors->has('errorlogin'))
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{$errors->first('errorlogin')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{old('email')}}">
                                @if($errors->has('email'))
                                    <p style="color:red">{{$errors->first('email')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                @if($errors->has('password'))
                                    <p style="color:red">{{$errors->first('password')}}</p>
                                @endif
                            </div>
                        
                            
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                Đăng nhập
                            </button>
    
                            <a href="{{ route('home') }}" class="btn btn-primary">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                Về trang chủ
                            </a>
                        </form>
                    </div>
                </div>
                
				
			</div>
		</div>
	</div>
</body>
</html>