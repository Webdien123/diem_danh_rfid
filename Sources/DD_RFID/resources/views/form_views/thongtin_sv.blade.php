{{--  Định nghĩa trang thông tin sinh viên  --}}
@extends('admin')

{{--  Tiêu đề trang  --}}
@section('title', 'Thông tin sinh viên')

{{--  Định nghĩa phần import vào layout cha  --}}
@section('staff_info')

    <!-- Tạo biến để truy xuất cho file js -->
    <?php
        $chnganh = $sv[0]->TENCHNGANH;
    ?>
    <!-- Liên kết biến sang js -->
    <script type="text/javascript">
        var chnganh = "{{ $chnganh }}";
    </script>

    {{--  Script xử lý 2 thông báo thành công hoặc thất bại khi cập nhật  --}}
    <script src="{{ asset('js/thong_bao.js') }}"></script>

    {{--  Script xử lý lấy tên khoa khi có tên bộ môn  --}}
    <script src="{{ asset('js/load_khoa_chnganh.js') }}"></script>

    {{--  Script inport jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script xử lý validate dữ liệu sinh viên  --}}
    <script src="{{ asset('js/validate_sinhvien.js') }}"></script>

    <center>
        <h1>Trang cập nhật sinh viên</h1>
        
        <div class="container">
            @if (Session::get('ketqua_up_sv') == 0)
                {{--  Thông báo thành công  --}}
                <div class="alert alert-success alert-dismissable" id="success-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Cập nhật thành công! sinh viên: {{ $sv[0]->MSSV }} - {{ $sv[0]->HOTEN }}</strong>
                </div>

            @elseif (Session::get('ketqua_up_sv') == 1)
                {{--  Thông báo thất bại  --}}
                <div class="alert alert-danger alert-dismissable" id="error-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Cập nhật thất bại!</strong>, có thể do đường truyền hoặc dữ liệu mới không hợp lệ.
                </div>                
            @endif
        </div>

        <?php
            \Session::put('ketqua_up_sv', 2);
        ?>

    </center>

    {{--  Panel chứa thông tin sinh viên cũ  --}}
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><b>Thông tin sinh viên {{ $sv[0]->MSSV }}</b></h3>
            </div>
            <div class="panel-body">
                {{--  Form cập nhật sinh viên  --}}
                <form action="{{ route('UpdateSV') }}" method="POST" id="form_sinhvien">
                    {{--  Phần mã xác thực form của laravel  --}}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="">Mã số sinh viên:</label>
                        <input type="text" name="mssv" value="{{ $sv[0]->MSSV }}" id="mssv" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Họ tên:</label>
                        <input type="text" name="hoten" value="{{ $sv[0]->HOTEN }}" id="hoten" class="form-control">
                    </div>								

                    <div class="form-group">
                        <label for="">Khoa:</label>
                        <input type="hidden" value="{{ $sv[0]->TENKHOA }}" name="khoa" id="khoa">
                        <select class="form-control" id="chonkhoa" name="chonkhoa">
                            @foreach ($khoas as $khoa)
                                <?php
                                    echo "<option value='". $khoa->TENKHOA ."'>". $khoa->TENKHOA ."</option>";
                                ?>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Chuyên ngành:</label>
                        <input type="hidden" value="{{ $sv[0]->TENCHNGANH }}" name="chnganh" id="chnganh">
                        <select class="form-control" id="chonchnganh" name="chonchnganh">
                        </select>
                    </div>

                    {{--  Đặt giá trị tên khoa theo giá trị đã có của sinh viên.  --}}
                    <script>
                        $('[name=chonkhoa] option').filter(function() { 
                            return ($(this).text() == "{{ $sv[0]->TENKHOA }}");
                        }).prop('selected', true);
                    </script>

                    <div class="form-group">
                        <label for="">Lớp:</label>
                        <input type="hidden" value="{{ $sv[0]->KYHIEULOP }}" name="lop" id="lop">
                        <select class="form-control" id="chonlop" name="chonlop">
                            @foreach ($lops as $lop)
                                <?php
                                    echo "<option value='". $lop->KYHIEULOP ."'>". $lop->KYHIEULOP ."</option>";
                                ?>
                            @endforeach
                        </select>
                    </div>

                    {{--  Đặt giá trị ký hiệu lớp theo giá trị đã có của sinh viên.  --}}
                    <script>
                        $('[name=chonlop] option').filter(function() { 
                            return ($(this).text() == "{{ $sv[0]->KYHIEULOP }}");
                        }).prop('selected', true);
                    </script>

                    <div class="form-group">
                        <label for="">Khóa học:</label>
                        <input type="hidden" value="{{ $sv[0]->KHOAHOC }}" name="khoahoc" id="khoahoc">
                        <select class="form-control" id="chonkhoahoc" name="chonkhoahoc">
                            @foreach ($khoahocs as $khoahoc)
                                <?php
                                    echo "<option value='". $khoahoc->KHOAHOC ."'>". $khoahoc->KHOAHOC ."</option>";
                                ?>
                            @endforeach
                        </select>
                    </div>

                    {{--  Đặt giá trị khóa học theo giá trị đã có của sinh viên.  --}}
                    <script>
                        $('[name=chonkhoahoc] option').filter(function() { 
                            return ($(this).text() == "{{ $sv[0]->KHOAHOC }}");
                        }).prop('selected', true);
                    </script>

                    <a href="{{ route('student') }}" class="btn btn-default">
                        <span class="fa fa-arrow-left" aria-hidden="true"></span>
                        Về trang sinh viên
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                        Lưu
                    </button>

                    <button type="button" class="btn btn-danger"
                        onclick="if(window.confirm('Xóa sinh viên này?')){
                        window.location.replace('<?php echo route("DeleteCB", 
                        ["mssv" => $sv[0]->MSSV]) ?>');}">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        Xóa
                    </button>
                </form>                
            </div>
        </div>
    </div>

@endsection