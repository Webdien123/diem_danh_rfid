{{--  Định nghĩa trang kết quả tìm kiếm cán bộ   --}}
@extends('admin')

@section('title', 'Danh sách tham dự')

@section('timcanbo')

    {{--  Import script thư viện tô màu từ khóa  --}}
    <script type="text/javascript" src="{{ asset('js/jquery.mark.min.js') }}"></script>

    {{--  Style tô màu phần từ khóa tìm kiếm  --}}
    <link rel="stylesheet" href="{{ asset('css/to_mau_tu_khoa.css') }}">

    <script>
        function to_mau_tu_khoa() {
            $(".danhsach td").unmark();
            tk = $("#TuKhoa").val();
            $(".danhsach td").mark(tk);
            $('html, body').animate({
                scrollTop: $("mark").offset().top
            }, 100);
            $("#TuKhoa").val("");
        }

        $(document).ready(function () {
            $("#btn_timkiem").click(function (e) {
                to_mau_tu_khoa();
            });
        });
    </script>

    </div> {{--  kết thúc container của trang master  --}}

    <!-- Phần nội dung khi có kết quả thống kế -->
    <div class="container-fluid">

    
    <div class="row">
        {{--  TÌM KIẾM NỘI DUNG TRONG DANH SÁCH  --}}
        <div class="pull-right">
            <span class="form-inline">                          
                <b>Tìm kiếm:</b>
                <input type="text" class="form-control" name="TuKhoa" id="TuKhoa" placeholder="Nhập nội dung tìm kiếm">
                <button type="button" id="btn_timkiem" class="btn btn-info">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    Tìm
                </button>
            </span> 
        </div>  
    </div>

    <center><h1>Danh sách đăng ký sự kiện</h1></center>

    {{--  Phần thông tin sự kiện đang hiển thị --}}
    <div class="row">    
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông tin sự kiện</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Mã sự kiện</th>
                                <td class="lead">{{ $sukien->MASK }}</td>
                            </tr>
                            <tr>
                                <th>Tên sự kiện</th>
                                <td class="lead">{{ $sukien->TENSK }}</td>
                            </tr>
                            <tr>
                                <th>Địa điểm</th>
                                <td class="lead">{{ $sukien->DIADIEM }}</td>
                            </tr>
                            <tr>
                                <th>Ngày thực hiện</th>
                                <td class="lead">{{ date("d-m-Y", strtotime($sukien->NGTHUCHIEN)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <center><h1>Sinh viên đăng ký</h1></center>

    {{--  Hiển thị danh sách sinh viên  --}}
    <div class="table-responsive danhsach">
        <table class="table table-hover table-bordered" style="background-color: white">
            <thead>
                <tr>
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>Khoa</th>
                    <th>Ngành</th>
                    <th>Lớp</th>
                    <th>Khóa học</th>
                </tr>
            </thead>
            <tbody>
                {{--  Nếu danh sách sinh viên rỗng  --}}
                @if (count($ds_dki_sv) == 0)
                    {{--  Phần nội dung không có sinh viên  --}}
                    <tr>
                        <th colspan="6" class="text-center"><i>Danh sách rỗng.</i></th>
                    </tr>
                @else
                    @foreach ($ds_dki_sv as $sv)
                        <tr>
                            <td>{{ $sv->MSSV }}</td>
                            <td>{{ $sv->HOTEN }}</td>
                            <td>{{ $sv->TENKHOA }}</td>
                            <td>{{ $sv->TENCHNGANH }}</td>
                            <td>{{ $sv->KYHIEULOP }}</td>
                            <td>{{ $sv->KHOAHOC }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <center><h1>Cán bộ đăng ký</h1></center>

    {{--  Hiển thị danh sách cán bộ  --}}
    <div class="table-responsive danhsach">
        <table class="table table-hover table-bordered" style="background-color: white">
            <thead>
                <tr>
                    <th>MSCB</th>
                    <th>Họ tên</th>
                    <th>Khoa</th>
                    <th>Bộ môn</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>

                {{--  Nếu danh sách cán bộ rỗng  --}}
                @if (count($ds_dki_cb) == 0)
                    {{--  Phần nội dung không có cán bộ  --}}
                    <tr>
                        <th colspan="5" class="text-center"><i>Danh sách rỗng.</i></th>
                    </tr>
                @else
                    @foreach ($ds_dki_cb as $canbo)
                    <tr>
                        <td>{{ $canbo->MSCB }}</td>
                        <td>{{ $canbo->HOTEN }}</td>
                        <td>{{ $canbo->TENKHOA }}</td>
                        <td>{{ $canbo->TENBOMON }}</td>
                        <td>{{ $canbo->EMAIL }}</td>                            
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    </div>

    
@endsection