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
				
		@if (strpos ($mes, 'Import sinh viên') !== false)
			<a href="/student">đây</a>
		@elseif (strpos ($mes, 'Import cán bộ') !== false)
			<a href="/staff">đây</a>
		@elseif (strpos ($mes, 'Import sự kiện') !== false)
			<a href="/event">đây</a>
		@else
			<a onclick="window.history.back();">đây</a>
		@endif
		
		
		để thử lại. Hoặc  
		<a href="{{ route('admin') }}">về trang quản trị</a>
		để thực hiện chức năng khác.
	</h3>
@endsection