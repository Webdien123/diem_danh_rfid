{{--  Định nghĩa trang đăng ký thẻ  --}}

@extends('admin')

@section('title', 'Trang đăng ký thẻ')

@section('chart')

    {{--  Jquery điều khiển phần quét thẻ  --}}
    <script src="{{ asset('js/card.js') }}"></script>

    <?php
        if ($loaithe && $chuthe) {
            var_dump($loaithe);
            echo "</br>";
            var_dump($chuthe);
        }
    ?>

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
    
            <!-- Phần nội dung hiển thị sau khi quét thẻ hợp lệ -->
            <div class="row text-center">
                <h3 class="text-success"><i>Mã thẻ hợp lệ. Chọn chế độ đăng ký:</i></h3>
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    <button type="button" class="btn btn-lg btn-success" data-toggle="tooltip" data-placement="top" title="Dùng khi người đăng ký chưa có thông tin trong hệ thống">
                        <i class="fa fa-plus-square fa-2x" aria-hidden="true"></i>
                        Tạo đăng ký mới
                    </button>
                    <button type="button" class="btn btn-lg btn-warning" data-toggle="tooltip" data-placement="top" title="Dùng thay thế mã thẻ cũ.">
                        <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                        Cập nhật thẻ cũ
                    </button>
                </div>
            </div>
    
            <!-- Phần nội dung hiển thị sau khi quét thẻ đã sử dụng -->
            <div class="row text-center" style="margin-top: 2%">
                <h3 class="text-danger"><i>Thẻ đã đăng ký, vui lòng sử dụng thẻ khác:</i></h3>
                <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                    <h3 class="panel-title"><b>Thông tin chủ thẻ</b></h3>
                            </div>
                            <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>Sinh viên</th>
                                                    <!-- <th>Cán bộ</th> -->
                                                    <th>Nguyễn Văn A</th>
                                                </tr>
                                                <tr>
                                                    <th>Mã số</th>
                                                    <th>B1306789</th>
                                                </tr>
                                                <tr>
                                                    <th>Khoa</th>
                                                    <th>CNTT</th>
                                                </tr>
                                                <tr>
                                                    <th>Ngành</th>
                                                    <th>Hệ thống thông tin</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                            </div>
                        </div>
                </div>                
            </div>
        </div>        
    </div>
@endsection
