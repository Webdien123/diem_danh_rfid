{{--  Định nghĩa trang đăng ký thẻ  --}}

@extends('admin')

@section('title', 'Trang đăng ký thẻ')

@section('chart')

    {{--  Jquery điều khiển phần quét thẻ  --}}
    <script src="{{ asset('js/card.js') }}"></script>

    {{--  Script xử lý 2 thông báo thành công hoặc thất bại khi cập nhật  --}}
    <script src="{{ asset('js/thong_bao.js') }}"></script>

    {{--  Phần hiển thị thông báo  --}}
    <center>

        {{--  Thông báo đăng ký thẻ  --}}
        <div class="container-fluid">
            @if (Session::get('ketqua_dangkythe') == 0)
                {{--  Thông báo thành công  --}}
                <div class="alert alert-success alert-dismissable" id="success-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Đăng ký thẻ thành công</strong>
                </div>

            @elseif (Session::get('ketqua_dangkythe') == 1)
                {{--  Thông báo thất bại  --}}
                <div class="alert alert-danger alert-dismissable" id="error-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Đăng ký thất bại vui lòng kiểm tra mã chủ thẻ đã tồn tại chưa</strong>
                </div>
            @endif
        </div>

        {{--  Thông báo cập nhật thẻ  --}}
        <div class="container-fluid">
            @if (Session::get('ketqua_capnhatthe') == 0)
                {{--  Thông báo thành công  --}}
                <div class="alert alert-success alert-dismissable" id="success-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Cập nhật thẻ thành công</strong>
                </div>

            @elseif (Session::get('ketqua_capnhatthe') == 1)
                {{--  Thông báo thất bại  --}}
                <div class="alert alert-danger alert-dismissable" id="error-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Cập nhật thẻ thất bại, kiểm tra lại mã số chủ thẻ hoặc email và thử lại.</strong>
                </div>
            @endif
        </div>

        {{--  Reset giá trị session để ẩn thông báo đi sau khi đã hiển thi  --}}
        <?php
            \Session::put('ketqua_dangkythe', 2);
            \Session::put('ketqua_capnhatthe', 2);
        ?>

    </center>

    <div class="col-xs-12" >
        <!-- Nội dung trang card. 
        // Dùng container-fluid để đảm bảo kích thước chiều ngang -->
        <div class="container-fluid" style="background-color: white; border-radius: 9px">

            <!-- Phần quét thẻ -->
            <div class="row">
                <div class="col-xs-12 col-md-4 col-md-offset-4">
                    <h1 class="text-center">Quét thẻ cần đăng ký</h1>
                    <form action="{{ route('test_card') }}" method="post" id="f_quet_the">
                        {{ csrf_field() }}
                        <label for="">Mã thẻ</label>
                        <input type="text" class="form-control" name="id_the" placeholder="Quét thẻ cần đăng ký" required id="id_the">
                        <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"tabindex="-1" />
                    </form>
                    <hr>
                </div>
            </div>
    
            @yield('card_valid')
             
            @yield('card_invalid')

        </div>        
    </div>
@endsection
