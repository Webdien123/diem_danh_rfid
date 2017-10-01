{{--  Định nghĩa trang thông tin cán bộ  --}}
@extends('admin')

{{--  Tiêu đề trang  --}}
@section('title', 'Báo lỗi')

{{--  Định nghĩa phần import vào layout cha  --}}
@section('staff_info')

	<h1 class="text-center text-danger">{{ $mes }}</h1>

	<center><img src="<?php echo asset('imgs/sad.png')?>" class="img-responsive" alt="Image"></center>

	<h3 class="text-center"><b>{!! $re !!}</b></h3>
	
	<h3 class="text-center">Bấm vào 
		<a onclick="window.history.back();">đây</a>
		để thử lại. Hoặc  
		<a href="{{ route('admin') }}">về trang quản trị</a>
		để thực hiện chức năng khác.
	</h3>
@endsection