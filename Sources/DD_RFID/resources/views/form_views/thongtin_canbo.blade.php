{{--  Định nghĩa trang thông tin cán bộ  --}}
@extends('admin')

{{--  Tiêu đề trang  --}}
@section('title', 'Thông tin cán bộ')

{{--  Định nghĩa phần import vào layout cha  --}}
@section('staff_info')

    <!-- Tạo biến để truy xuất cho file js -->
    <?php
        $thongtin_bm = $canbo[0]->TENBOMON;
    ?>
    <!-- Liên kết biến sang js -->
    <script type="text/javascript">
        var thongtin_bm = "{{ $thongtin_bm }}";
    </script>

    {{--  Script xử lý 2 thông báo thành công hoặc thất bại khi cập nhật  --}}
    <script src="{{ asset('js/thong_bao.js') }}"></script>

    {{--  Script xử lý lấy tên khoa khi có tên bộ môn  --}}
    <script src="{{ asset('js/load_khoa_bomon.js') }}"></script>

    {{--  Script inport jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script xử lý validate dữ liệu cán bộ  --}}
    <script src="{{ asset('js/validate_canbo.js') }}"></script>

    <center>
        <h1>Trang cập nhật cán bộ</h1>
        
        <div class="container">
            @if (Session::get('ketqua') == 0)
                {{--  Thông báo thành công  --}}
                <div class="alert alert-success alert-dismissable" id="success-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Cập nhật thành công! cán bộ: {{ $canbo[0]->MSCB }} - {{ $canbo[0]->HOTEN }}</strong>
                </div>

            @elseif (Session::get('ketqua') == 1)
                {{--  Thông báo thất bại  --}}
                <div class="alert alert-danger alert-dismissable" id="error-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Cập nhật thất bại!</strong>, có thể do đường truyền hoặc dữ liệu mới không hợp lệ.
                </div>                
            @endif
        </div>

        <?php
            \Session::put('ketqua', 2);
        ?>

    </center>

    {{--  Panel chứa thông tin cán bộ cũ  --}}
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                    <h3 class="panel-title"><b>Thông tin cán bộ {{ $canbo[0]->MSCB }}</b></h3>
            </div>
            <div class="panel-body">

                {{--  Form nhận thông tin cán bộ.  --}}
                <form action="{{ route('UpdateCB') }}" method="POST" id="form_canbo">
                    {{--  Phần mã xác thực form của laravel  --}}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Mã số cán bộ:</label>
                        <input value="{{ $canbo[0]->MSCB }}" type="hidden" name="mscb" id="mscb">
                        <input value="{{ $canbo[0]->MSCB }}" type="text" class="form-control" placeholder="mã số cán bộ" disabled>
                    </div>

                    <div class="form-group">
                        <label>Họ tên:</label>
                        <input value="{{ $canbo[0]->HOTEN }}" type="text" name="hoten" id="hoten" class="form-control" placeholder="họ tên">
                    </div>								

                    <div class="form-group">
                        <label>Khoa:</label>
                        <input value="{{ $canbo[0]->TENKHOA }}" type="hidden" name="khoa" id="khoa">
                        <select class="form-control" id="chonkhoa" name="chonkhoa">
                            @foreach ($khoas as $khoa)
                                <?php
                                    echo "<option value='". $khoa->TENKHOA ."'>". $khoa->TENKHOA ."</option>";
                                ?>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Bộ môn:</label>
                        <input value="{{ $canbo[0]->TENBOMON }}" type="hidden" name="bomon" id="bomon">
                        <select class="form-control" id="chonbomon" name="chonbomon">
                        </select>
                    </div>

                    {{--  Đặt giá trị tên khoa theo giá trị đã có của cán bộ.  --}}
                    <script>
                        $('[name=chonkhoa] option').filter(function() { 
                            return ($(this).text() == "{{ $canbo[0]->TENKHOA }}");
                        }).prop('selected', true);
                    </script>

                    <div class="form-group">
                        <label>Email:</label>
                        <input value="{{ $canbo[0]->EMAIL }}" type="email" name="email" id="email" class="form-control" placeholder="Email cán bộ">                                   
                    </div>

                    <a href="{{ route('staff') }}" class="btn btn-default">
                        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                        Hủy
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                        Lưu
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection