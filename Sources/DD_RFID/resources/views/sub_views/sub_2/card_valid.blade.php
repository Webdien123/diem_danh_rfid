{{--  Định nghĩa trang thẻ hợp lệ để đăng ký.  --}}

@extends('sub_views.card')

@section('title', 'Trang đăng ký thẻ')

@section('card_valid')

<!-- Phần nội dung hiển thị sau khi quét thẻ chưa đăng ký -->
<div class="row text-center">
    <h3 class="text-success"><i>Mã thẻ hợp lệ. Chọn chế độ đăng ký:</i></h3>
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <a href="{{ route('new_card') }}" class="btn btn-lg btn-success" data-toggle="tooltip" data-placement="top" title="Dùng khi người đăng ký chưa có thông tin trong hệ thống">
            <i class="fa fa-plus-square fa-2x" aria-hidden="true"></i>
            Tạo đăng ký mới
        </a>

        <a class="btn btn-lg btn-warning" data-toggle="tooltip" data-placement="top" title="Dùng thay thế mã thẻ cũ.">
            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
            Cập nhật thẻ cũ
        </a>
    </div>
</div>   

@endsection