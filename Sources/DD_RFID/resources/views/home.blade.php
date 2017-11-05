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

    {{--  Script tạo đồng hồ đếm ngược  --}}
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>

    {{--  Jquery điều khiển phần quét thẻ  --}}
    <script src="{{ asset('js/card.js') }}"></script>

    
</head>
<body>
    <?php
        $sukien = \Session::get('sukien_diemdanh');
        $sukien = $sukien[0];
    ?>

    {{--  Thẻ hiển thị ảnh nền  --}}
    <div id="home_bg"></div>

    {{--  Thẻ chứa nội dung trang home  --}}
    <div class="container text-center" id="home_content">

        {{--  Hiển thị điểm danh theo trạng thái sự kiện  --}}
        @if (Session::get('trangthai_sukien') == 2)
            <h1>Điểm danh vào</h1>
        @endif

        @if (Session::get('trangthai_sukien') == 3)
            <h1>Điểm danh ra</h1>
        @endif

        {{--  Tên sự kiện  --}}
        <h1><strong id="event_name" class="text-danger">
            {{ mb_strtoupper($sukien->TENSK, 'UTF-8') }}
        </strong></h1>

        {{--  Thời gian, địa điểm  --}}
        <div class="row">
            <div class="col-xs-12">
                <h2>Thời gian: <b>{{ $sukien->DDVAO }}</b> - Địa điểm: <b>{{ $sukien->DIADIEM }}</b></h2>
            </div>
        </div>
        @if (Session::get('trangthai_sukien') != 4)
            <h4 class="text-danger"><b>Vui lòng đừng đóng tab này cho đến khi sự kiện kết thúc.<b></h4>
        @endif

        {{--  Đồng hồ đếm thời gian còn lại  --}}
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                {{--  Hiển thị điểm danh theo trạng thái sự kiện  --}}
                @if (Session::get('trangthai_sukien') == 1)
                    <h3>sẽ điểm danh sau:</h3>
                @endif
        
                @if (Session::get('trangthai_sukien') == 2 || Session::get('trangthai_sukien') == 3)
                    <h3>Thời gian còn lại: </h3>
                @endif
                <h1 id="getting-started" style="background-color: while; color: red;"></h1>
                {{--  Script kiểm tra và cập nhật thời gian.  --}}
                <script type="text/javascript">
                    var tg = "{{ $thoigian }}";
                    var v_mask = "{{ $sukien->MASK }}";
                    $('#getting-started').countdown(tg, function(event) {
                        $(this).html(event.strftime('%H:%M:%S'));
                    }).on('finish.countdown', function() {
                        var trangthai = "{{ Session::get('trangthai_sukien') }}";
                        if (trangthai == 3) {
                            $.ajax({
                                type: "GET",
                                url: "/thongkesolieu/" + v_mask,
                                success: function (response) {
                                    console.log(response);
                                },
                                error: function(xhr,err){
                                    console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
                                }
                            });
                        }
                        window.location.replace("/updateTrangThaiSK/");
                    });
                </script>
            </div>
        </div>

        <a class="btn btn-primary" href="/login" role="button">
            <i class="fa fa-lock" aria-hidden="true"></i>
            TRANG QUẢN TRỊ
        </a>
        <hr>

        @if (Session::get('trangthai_sukien') == 2 || Session::get('trangthai_sukien') == 3)

        {{--  Api text to speech  --}}
        <script src="{{ asset('js/responsivevoice.js') }}"></script>

        {{--  Phần quét thẻ điểm danh  --}}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">KHUNG ĐIỂM DANH</h3>
            </div>
            <div class="panel-body">

                {{--  Phần hiển thị thông báo xử lý đăng ký thẻ  --}}
                <div class="row">
                    @if (Session::get('ketqua_dangkythe_dd') == 0)
                        {{--  Thông báo thành công  --}}
                        <div class="alert alert-success alert-dismissable" id="success-alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Đăng ký thẻ thành công, thẻ đã có thể điểm danh</strong>
                        </div>

                    @elseif (Session::get('ketqua_dangkythe_dd') == 1)
                        {{--  Thông báo thất bại  --}}
                        <div class="alert alert-danger alert-dismissable" id="error-alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Cập nhật thẻ thất bại, kiểm tra lại mã số chủ thẻ hoặc email và thử lại</strong>
                        </div>
                    @endif
                </div>

                {{--  Reset giá trị session để ẩn thông báo đi sau khi đã hiển thi  --}}
                <?php
                    \Session::put('ketqua_dangkythe_dd', 2);
                ?>

                <!-- Phần quét thẻ -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <h1 class="text-center">Quét thẻ để điểm danh</h1>

                        @if (Session::get('trangthai_sukien') == 2)
                            <form id="f_quet_the_vao">
                                {{ csrf_field() }}
                                <input type="hidden" name="mask" id="mask" value="{{ $sukien->MASK }}">
                                <input type="text" class="form-control" name="id_the" id="id_the" placeholder="Quét thẻ của bạn" required>
                                <input type="submit" id="sm_ddvao" style="position: absolute; left: -9999px; width: 1px; height: 1px;"tabindex="-1" />
                            </form>

                            {{--  Jquery xử lý quá trình điểm danh vào  --}}
                            <script src="{{ asset('js/diemDanhVao.js') }}"></script>

                        @endif

                        @if (Session::get('trangthai_sukien') == 3)
                            <form id="f_quet_the_ra">
                                {{ csrf_field() }}
                                <input type="hidden" name="mask" id="mask" value="{{ $sukien->MASK }}">
                                <input type="text" class="form-control" name="id_the" id="id_the" placeholder="Quét thẻ của bạn" required>
                                <input type="submit" id="sm_ddra" style="position: absolute; left: -9999px; width: 1px; height: 1px;"tabindex="-1" />
                            </form>

                            {{--  Jquery xử lý quá trình điểm danh ra  --}}
                            <script src="{{ asset('js/diemDanhRa.js') }}"></script>
                        @endif
                        <hr>
                    </div>
                </div>

                <!-- Phần thông báo loại 1: Điểm danh thành công -->
                <div class="row thongbao" id="tb_1">
                    <strong class="text-success">
                        <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
                        <span>Điểm danh thành công</span>
                        <span class="loaichuthe"></span>
                        <span class="hoten"></span>
                    </strong>
                </div>

                <!-- Phần thông báo loại 2: Có lỗi trong xử lý -->
                <div class="row thongbao" id="tb_2">
                    <strong class="text-danger">
                        <i class="fa fa-times-circle fa-2x" aria-hidden="true"></i>
                        <span>Có lỗi khi xử lý. Vui lòng thử lại</span>
                    </strong>
                </div>

                <!-- Phần thông báo loại 3: Trùng kết quả điểm danh trước đó -->
                <div class="row thongbao" id="tb_3">
                    <strong class="text-info">
                        <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
                        <span>Trùng kết quả</span>
                        <span class="loaichuthe"></span>
                        <span class="hoten"></span>
                    </strong>
                </div>
                
                <!-- Phần thông báo loại 4: Chưa đăng ký tham gia sự kiện -->
                <div class="row thongbao" id="tb_4">
                    <strong class="text-warning">
                        <i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i>
                        <span class="loaichuthe"></span>
                        <span class="hoten"></span>
                        <span>chưa đăng ký sự kiện này</span>
                    </strong>
                </div>

                <!-- Phần thông báo loại 5: Thẻ chưa có thông tin trong hệ thống -->
                <div class="row thongbao" id="tb_5">

                    {{--  Script xử lý khi select danh sách bộ môn hoặc danh sách khoa.  --}}
                    <script src="{{ asset('js/select_khoa_bomon.js') }}"></script>

                    {{--  Script xử lý khi select danh sách chuyên ngành, danh sách khoa.
                    Và các danh sách nằm trên form thêm sinh viên  --}}
                    <script src="{{ asset('js/select_khoa_chnganh.js') }}"></script>

                    {{--  Script import jquery validate  --}}
                    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

                    {{--  Script xử lý validate dữ liệu cán bộ  --}}
                    <script src="{{ asset('js/validate_dangkythe.js') }}"></script>

                    {{--  Script xử lý 2 thông báo thành công hoặc thất bại khi cập nhật  --}}
                    <script src="{{ asset('js/thong_bao.js') }}"></script>

                    {{--  Hai modal điểm danh và đăng ký thẻ  --}}
                    <div>
                        <strong><i class="text-danger fa fa-times-circle fa-2x" aria-hidden="true"></i></strong>
                        <strong><span class="text-danger">Thẻ chưa được đăng ký, click vào</span></strong>
                        
                        <strong><a data-toggle="modal" href='#modal-ddanh'>đây</a></strong>

                        {{-- Modal điểm danh khi chưa đăng ký --}}
                        <div class="modal fade text-left" id="modal-ddanh">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Điểm danh chưa đăng ký</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="f_dd_kgdgki">
                                            {{ csrf_field() }}

                                            {{--  Mã sự kiện  --}}
                                            <input type="hidden" name="mask" id="mask" value="{{ $sukien->MASK }}">

                                            {{--  Phần chọn đối tượng đăng ký thẻ  --}}
                                            <input type="hidden" name="chon_cb_sv" class="chon_cb_sv">

                                            {{--  Trạng thái điểm danh hiện tại (đang điểm vào hay điểm ra)  --}}
                                            <input type="hidden" name="tthai_dd" value="{{ Session::get('trangthai_sukien') }}">

                                            <div class="form-group">
                                                <label for="">Người điểm danh là:</label><br>
                                                <div class="radio-inline">
                                                    <label><input type="radio" name="rd_sv_cb" id="rd_sv" checked value="sinh viên">
                                                        <span class="text-danger">
                                                            <span class="fa fa-graduation-cap fa-2x"></span>
                                                            Sinh viên
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="radio-inline">
                                                    <label><input type="radio" name="rd_sv_cb" id="rd_cb" value="cán bộ">
                                                        <span class="text-primary">
                                                            <span class="fa fa-users fa-2x"></span>
                                                            Cán bộ
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Mã thẻ</label>
                                                <input type="hidden" class="the" name="mathe">
                                                <input type="text" class="form-control the" disabled>
                                            </div>

                                            {{--  Phần mã số chủ thẻ cần điểm danh  --}}                                            
                                            <div class="form-group">
                                                <label for="">Nhập mã số chủ thẻ rồi chọn "Điểm danh"</label>
                                                <input type="text" class="form-control" name="machuthe" 
                                                    id="machuthe" placeholder="Chưa nhập mã số chủ thẻ"
                                                    oninvalid="this.setCustomValidity('Vui lòng nhập từ khóa trước khi tìm')"
                                                    oninput="setCustomValidity('')">
                                            </div>

                                            <strong class="text-warning thongbao_kdgki_loi">
                                                <i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i>
                                                <span id="trung_chu_the"></span>
                                                <br>
                                            </strong>

                                            <strong class="text-success thongbao_kdgki_thcong">
                                                <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
                                                <span id="bao_thcong"></span>
                                                <br>
                                            </strong>
                                            
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-address-book" aria-hidden="true"></i>
                                                Điểm danh
                                            </button>

                                            <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                        </form>
                                        
                                        {{--  script thay đổi giá trị giao diện theo chủ thẻ được chọn.  --}}
                                        <script src="{{ asset('js/chuyen_chu_the.js') }}"></script>

                                        {{--  Script xử lý 2 thông báo thành công hoặc thất bại khi cập nhật  --}}
                                        <script src="{{ asset('js/diemdanh_khongdangki.js') }}"></script>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal đăng ký thẻ ngay khi điểm danh --}}
                        <div class="modal fade text-left" id="modal-dkithemoi">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Đăng ký thông tin thẻ</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{--  Form nhập thông tin đăng ký  --}}
                                        <form action="{{ route('new_card_dd') }}" id="f_new_card" method="POST" role="form">  
                                            {{ csrf_field() }}

                                            {{--  Mã sự kiện  --}}
                                            <input type="hidden" name="mask" id="mask" value="{{ $sukien->MASK }}">

                                            {{--  Phần chọn đối tượng đăng ký thẻ  --}}
                                            <input type="hidden" name="chon_cb_sv" class="chon_cb_sv">
                                            <div class="form-group">
                                                <label for="">Đăng ký cho:</label>
                                                <div class="radio-inline">
                                                    <label><input type="radio" name="rd_sv_cb" id="rd_sv" checked value="sinh viên">
                                                        <span class="text-danger">
                                                            <span class="fa fa-graduation-cap fa-2x"></span>
                                                            Sinh viên
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="radio-inline">
                                                    <label><input type="radio" name="rd_sv_cb" id="rd_cb" value="cán bộ">
                                                        <span class="text-primary">
                                                            <span class="fa fa-users fa-2x"></span>
                                                            Cán bộ
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            {{--  script thay đổi giá trị giao diện theo chủ thẻ được chọn.  --}}
                                            <script src="{{ asset('js/chuyen_chu_the.js') }}"></script>

                                            <div class="form-group">
                                                <label for="">Mã thẻ</label>
                                                <input type="hidden" class="the" name="mathe">
                                                <input type="text" class="form-control the" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Mã số</label>
                                                <label id="ten_doi_tuong">sinh viên</label>
                                                <input type="text" class="form-control" name="maso" placeholder="Mã số chủ thẻ">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Họ tên</label>
                                                <input type="text" class="form-control" name="hoten" placeholder="Họ tên chủ thẻ">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Khoa:</label>
                                                <input type="hidden" name="khoa" id="khoa">
                                                <select class="form-control" id="chonkhoa" name="chonkhoa">
                                                    @foreach ($khoas as $khoa)
                                                        <?php
                                                            echo "<option value='". $khoa->TENKHOA ."'>". $khoa->TENKHOA ."</option>";
                                                        ?>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{--  Phần nội dung đăng ký riêng cho cán bộ  --}}
                                            <div id="dky_cb">
                                                <div class="form-group">
                                                    <label for="">Bộ môn:</label>
                                                    <input type="hidden" name="bomon" id="bomon">
                                                    <select class="form-control" id="chonbomon" name="chonbomon">
                                                    </select>
                                                </div>
                                    
                                                <div class="form-group">
                                                    <label for="">Email:</label>
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email cán bộ">                                   
                                                </div>
                                            </div>

                                            {{--  Phần nội dung đăng ký riêng cho sinh viên  --}}
                                            <div id="dky_sv">
                                                <div class="form-group">
                                                    <label for="">Chuyên ngành:</label>
                                                    <input type="hidden" name="chnganh" id="chnganh">
                                                    <select class="form-control" id="chonchnganh" name="chonchnganh">
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Lớp:</label>
                                                    <input type="hidden" name="lop" id="lop">
                                                    <select class="form-control" id="chonlop" name="chonlop">
                                                        @foreach ($lops as $lop)
                                                            <?php
                                                                echo "<option value='". $lop->KYHIEULOP ."'>". $lop->KYHIEULOP ."</option>";
                                                            ?>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Khóa học:</label>
                                                    <input type="hidden" name="khoahoc" id="khoahoc">
                                                    <select class="form-control" id="chonkhoahoc" name="chonkhoahoc">
                                                        @foreach ($khoahocs as $khoahoc)
                                                            <?php
                                                                echo "<option value='". $khoahoc->KHOAHOC ."'>". $khoahoc->KHOAHOC ."</option>";
                                                            ?>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <button type="submit" class="btn btn-primary">
                                                Đăng ký
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <strong><span class="text-danger">nếu vẩn muốn điểm danh, hoặc chọn nút đăng ký thẻ để đăng ký ngay</span></strong>
                    </div>

                    <a data-toggle="modal" class="btn btn-primary" href='#modal-dkithemoi'>
                        <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                        Đăng ký thẻ
                    </a>
                </div>
                
            </div>
        </div>
        @endif

        @if (Session::get('trangthai_sukien') == 4)
            <h1>Hết giờ điểm danh</h1>
            <?php
                \Session::forget('sukien_diemdanh');
                \Session::forget('trangthai_sukien');
            ?>
        @endif
    </div>
</body>

</html>