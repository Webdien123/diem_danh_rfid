{{--  Định nghĩa trang đăng ký thẻ  --}}

@extends('admin')

@section('title', 'Trang đăng ký thẻ')

@section('chart')

    {{--  Jquery điều khiển phần quét thẻ  --}}
    <script src="{{ asset('js/card.js') }}"></script>

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
