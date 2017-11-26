{{-- Định nghĩa trang chủ --}}

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
    @include('link_views.import')

    {{--  Gọi css căn chỉnh ảnh nền và giao diện home  --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    {{--  Gọi script autosize của text tên sự kiện trên trang home  --}}
    <script src="{{ asset('js/jquery.fittext.js') }}"></script>

    {{--  Jquery điều khiển phần quét thẻ  --}}
    <script src="{{ asset('js/card.js') }}"></script>
</head>
<body>
    <?php
        \Session::forget('trangthai_sukien');
        \Session::forget('xac_thuc_sk');    
        \Session::forget('ma_so_xac_thuc'); 
    ?>

    {{--  Thẻ hiển thị ảnh nền  --}}
    <div id="home_bg"></div>

    {{--  Thẻ chứa nội dung trang chọn sự kiện  --}}
    <div class="container">

        <div class="text-center">
        {{--  Tên sự kiện  --}}
        <h2><strong id="event_name" class="text-info">Vui lòng chọn sự kiện cần điểm danh</strong></h2>        

        {{--  <a class="btn btn-primary" href="/login" role="button">
            <i class="fa fa-lock" aria-hidden="true"></i>
            TRANG QUẢN TRỊ
        </a>  --}}
        <hr>
        </div>   

        {{--  script xử lý bật trang quản trị khi bấm ctrl + click  --}}
        <script>
            $(document).ready(function() {

                $(document).bind('click', function(e) {
                    e.preventDefault(); 
                    if (e.ctrlKey){
                        window.open('/login','_blank')
                    }
                });
            });
        </script>

        {{--  Nếu không có sự kiện nào sẳn sàng  --}}
        @if (count($sukiens) == 0)
            <center><h1>Không còn sự kiện nào hôm nay.</h1></center>
        {{--  Nếu có sự kiện sẳn sàng  --}}
        @else
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    @foreach ($sukiens as $sk)
                    {{--  Danh sách sự kiện  --}}
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ $sk->TENSK }}</h3>
                        </div>
                        <div class="panel-body">
                            
                            {{--  Thông tin sự kiện có thể điểm danh  --}}
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Tên sự kiện</th>
                                        <td>{{ $sk->TENSK }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa điểm</th>
                                        <td>{{ $sk->DIADIEM }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày thực hiện</th>
                                        <td>{{ date("d-m-Y", strtotime($sk->NGTHUCHIEN)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Giờ bắt đầu điểm danh</th>
                                        <td>{{ $sk->DDVAO }}</td>
                                    </tr>
                                    <tr>
                                        <th>Giờ kết thúc điểm danh</th>
                                        <td>{{ $sk->DDRA }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            {{--  nút chọn sự kiện để điểm danh  --}}
                            <center>
                                <a class="btn btn-success" href="/taoCKSuKien/{{ $sk->MASK }}">
                                    <i class="fa fa-hand-o-up" aria-hidden="true"></i>
                                    Chọn
                                </a>
                            </center>                        
                        </div>
                    </div>

                    {{--  dòng ngăn cách sự kiện  --}}
                    <hr>
                    @endforeach
                </div>
            </div>
        @endif
        

        
    </div>
</body>

</html>