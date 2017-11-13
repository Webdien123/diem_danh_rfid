{{--  Định nghĩa trang thống kê điểm danh  --}}

@extends('admin')

@section('title', 'Trang thống kê')

@section('chart')

    <script type="text/javascript">
        function highlight_words(keywords, element) {
            if(keywords) {
                var textNodes;
                keywords = keywords.replace(/\W/g, '');
                var str = keywords.split(" ");
                $(str).each(function() {
                    var term = this;
                    var textNodes = $(element).contents().filter(function() { return this.nodeType === 3 });
                    textNodes.each(function() {
                    var content = $(this).text();
                    var regex = new RegExp(term, "gi");
                    content = content.replace(regex, '<span class="bg-success">' + term + '</span>');
                    $(this).replaceWith(content);
                    });
                });

                $(window).scrollTop(element.offset().top);
            }
        }
    </script>

    {{--  Nội dung trang thống kê  --}}
    <div class="col-xs-12">            

        <!-- Phần nội dung khi không có kết quả thống kê -->
        @if ($sukien == null)
            
            <div class="container-fluid">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <h2 class="text-center">Hiện chưa có kết quả điểm đanh cho các sự kiện</h2>
                    </div>
                </div>
            </div>
        @else
            {{--  Nhận giá trị các số liệu thống kê  --}}
            <?php
                $ma_so_su_kien = $sukien->MASK;

                $sv_co_mat;
                $sv_vang_mat;
                $sv_co_vao_k_ra;
                $sv_co_ra_k_vao;
                $sv_k_co_ttin;

                $cb_co_mat;
                $cb_vang_mat;
                $cb_co_vao_k_ra;
                $cb_co_ra_k_vao;
                $cb_k_co_ttin;

                foreach ($kq_thke as $key => $value) {
                    if($value->MALOAIDS == 1){
                        $sv_co_mat = $value->SOLUONGSV;
                        $cb_co_mat = $value->SOLUONGCB;
                    }
                    if($value->MALOAIDS == 2){
                        $sv_vang_mat = $value->SOLUONGSV;
                        $cb_vang_mat = $value->SOLUONGCB;
                    }
                    if($value->MALOAIDS == 3){
                        $sv_co_vao_k_ra = $value->SOLUONGSV;
                        $cb_co_vao_k_ra = $value->SOLUONGCB;
                    }
                    if($value->MALOAIDS == 4){
                        $sv_co_ra_k_vao = $value->SOLUONGSV;
                        $cb_co_ra_k_vao = $value->SOLUONGCB;
                    }
                    if($value->MALOAIDS == 7){
                        $sv_k_co_ttin = $value->SOLUONGSV;
                        $cb_k_co_ttin = $value->SOLUONGCB;
                    }
                }
            ?>

            {{--  Chuuyển các giá trị sang js  --}}
            <script type="text/javascript">
                var ma_so_su_kien = "{{ $ma_so_su_kien }}";
                console.log(ma_so_su_kien);
                var sv_co_mat = "{{ $sv_co_mat }}";
                var sv_vang_mat = "{{ $sv_vang_mat }}";
                var sv_co_vao_k_ra = "{{ $sv_co_vao_k_ra }}";
                var sv_co_ra_k_vao = "{{ $sv_co_ra_k_vao }}";
                var sv_k_co_ttin = "{{ $sv_k_co_ttin }}";
                var cb_co_mat = "{{ $cb_co_mat }}";
                var cb_vang_mat = "{{ $cb_vang_mat }}";
                var cb_co_vao_k_ra = "{{ $cb_co_vao_k_ra }}";
                var cb_co_ra_k_vao = "{{ $cb_co_ra_k_vao }}";
                var cb_k_co_ttin = "{{ $cb_k_co_ttin }}";
            </script>

            {{--  Script lấy phần danh sách cần hiển thị theo danh sách đã click hoặc đã chọn  --}}
            <script src="{{ asset('js/hien_danh_sach_ddanh.js') }}"></script>

            <!--Load the GOOGLE CHART API-->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <!-- Tạo biểu đồ điểm danh sinh viên lên id piechart1-->
            <script type="text/javascript" src="{{ asset('js/student_chart.js') }}"></script>

            <!-- Tạo biểu đồ số liệu bất thường sinh viên lên id piechart2-->
            <script type="text/javascript" src="{{ asset('js/exc_student_chart.js') }}"></script>

            <!-- Tạo biểu đồ điểm danh cán bộ lên id piechart3-->
            <script type="text/javascript" src="{{ asset('js/teacher_chart.js') }}"></script>

            <!-- Tạo biểu đồ số liệu bất thường cán bộ lên id piechart4-->
            <script type="text/javascript" src="{{ asset('js/exc_teacher_chart.js') }}"></script>

            <!-- Auto resize các biểu độ -->
            <script>
                $(window).resize(function(){
                    drawChart1();
                    drawChart2();
                    drawChart3();
                    drawChart4();            
                });
            </script>

            <!-- Phần nội dung khi có kết quả thống kế -->
            <div class="container-fluid">
                
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
                                        <tr>
                                            {{--  Nút chuyển sự kiện hiển thị  --}}
                                            <td colspan="2">
                                                <a class="btn btn-primary btn-block" data-toggle="modal" href='#modal-id-sk'>
                                                    <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                                                    Đổi sự kiện
                                                </a>
                                                <?php
                                                    // Chọn time zone.
                                                    date_default_timezone_set("Asia/Ho_Chi_Minh");

                                                    // Khởi tạo ngày hiện tại.
                                                    $date = date("d-m-Y");

                                                    $file_path = "./logs/";

                                                    $file_name = "suKien[".$sukien->MASK."]_".$date.".log";
                                                    
                                                ?>     
                                                <a href="{{ $file_path.$file_name }}" target="_blank" class="btn btn-primary btn-block">
                                                    <i class="fa fa-history" aria-hidden="true"></i>
                                                    Xem nhật kí điểm danh
                                                </a>
                                                <div class="modal fade" id="modal-id-sk">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title">Đổi sự kiện</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                {{--  Form đổi sự kiện hiển thị  --}}
                                                                <form action="{{ route('chart_old') }}" method="POST" id="form_id_sk">
                                                                    {{ csrf_field() }}
                                                                    @foreach ($sukien_old as $key=>$value)                                                                            
                                                                        @if ($key == 0)
                                                                            <div class="radio">
                                                                                <label><input type="radio" name="op_sk" checked value="{{ $value->MASK }}">
                                                                                    {{ $value->MASK }}, {{ $value->TENSK }}, Ngày {{ $value->NGTHUCHIEN }}, Tại {{ $value->DIADIEM }}
                                                                                </label>
                                                                            </div>
                                                                        @else
                                                                            <div class="radio">
                                                                                <label><input type="radio" name="op_sk" value="{{ $value->MASK }}">
                                                                                    {{ $value->MASK }}, {{ $value->TENSK }}, Ngày {{ $value->NGTHUCHIEN }}, Tại {{ $value->DIADIEM }}
                                                                                </label>
                                                                            </div>
                                                                        @endif                                                                            
                                                                    @endforeach

                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                                                        Chuyển sự kiện
                                                                    </button>

                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                        <i class="fa fa-window-close" aria-hidden="true"></i>
                                                                        Đóng
                                                                    </button>                                                                  
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{--  Phần biểu đồ thống kê của sinh viên  --}}
                <h1>Sinh viên</h1>
                <div class="row">
                    <div class="col-xs-12 col-md-6" id="piechart1" style="border: blue 1px solid"></div>
                    <div class="col-xs-12 col-md-6" id="piechart2" style="border: blue 1px solid"></div>
                </div>

                {{--  Phần biểu đồ thống kê của cán bộ  --}}
                <h1>Cán bộ</h1>
                <div class="row">
                    <div class="col-xs-12 col-md-6" id="piechart3" style="border: blue 1px solid"></div>
                    <div class="col-xs-12 col-md-6" id="piechart4" style="border: blue 1px solid"></div>
                </div>
                

                {{--  Phần hiển thị thông cán bộ hoặc sinh viên thuộc danh sách đang chọn  --}}
                <center style="margin-top: 5%;"><h2>
                    Danh sách 
                    <span id="ten_ds">sinh viên vắng mặt</span>(
                    <span id="so_luong_ds">7</span>
                    <span class="loai_ds">sinh viên</span> )
                </h2></center>

                {{--  Phần xuất danh sách, chọn danh sách thống kê khác và tìm kiếm thông tin  --}}
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <a href="/export_dsach/1/comat/xls" id="btn_export_ds" class="btn btn-success">
                            <span class="fa fa-file-excel-o" aria-hidden="true"></span>
                            Xuất danh sách ra excel
                        </a>
                    </div>

                    <div class="col-xs-12 col-sm-4 form-inline">
                            <label for="sel1">Danh sách:</label>
                            <select class="form-control" id="sel1">
                                @if (count($ds_sv_vang_mat) != 0)
                                <option value="sv_vang_mat" selected>sinh viên vắng mặt</option>
                                @endif

                                @if (count($ds_sv_co_mat) != 0)
                                <option value="sv_co_mat" >sinh viên có mặt</option>
                                @endif

                                @if (count($ds_sv_co_vao_k_ra) != 0)
                                <option value="sv_co_v_k_ra" >sinh viên có vào không ra</option>
                                @endif

                                @if (count($ds_sv_co_ra_k_vao) != 0)
                                <option value="sv_co_ra_k_v" >sinh viên có ra không vào</option>
                                @endif

                                @if (count($ds_sv_chua_co_ttin) != 0)
                                <option value="sv_chua_co_ttin" >sinh viên chưa có thông tin</option>
                                @endif

                                @if (count($ds_cb_vang_mat) != 0)
                                <option value="cb_vang_mat" >cán bộ vắng mặt</option>
                                @endif

                                @if (count($ds_cb_co_mat) != 0)
                                <option value="cb_co_mat" >cán bộ có mặt</option>
                                @endif

                                @if (count($ds_cb_co_vao_k_ra) != 0)
                                <option value="cb_co_v_k_ra" >cán bộ có vào không ra</option>
                                @endif

                                @if (count($ds_cb_co_ra_k_vao) != 0)
                                <option value="cb_co_ra_k_v" >cán bộ có ra không vào</option>
                                @endif

                                @if (count($ds_cb_chua_co_ttin) != 0)
                                <option value="cb_chua_co_ttin" >cán bộ chưa có thông tin</option>
                                @endif
                            </select>
                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <form action="#" id="f_tim_ds" class="form-inline" role="search">                            
                            <b>Tìm kiếm:</b>
                            <input type="text" class="form-control" name="TuKhoa" id="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required
                            oninvalid="this.setCustomValidity('Vui lòng nhập từ khóa trước khi tìm')"
                            oninput="setCustomValidity('')">
                            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"tabindex="-1" />
                            <button type="button" id="btn_timkiem" class="btn btn-info">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                Tìm
                            </button>
                        </form> 
                    </div>
                            
                </div>

                {{--  Phần hiển thị các danh sách thống kê --}}
                <div class="row">

                    {{--  Modal chuyển danh sách  --}}
                    <div class="modal fade" id="modal-id-ds">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">
                                        Sửa kết quả
                                        <span class="loai_ds">sinh viên</span>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    {{--  Form chuyển danh sách  --}}
                                    <form action="{{ route('chuyenDS') }}" method="POST" id="form_id_ds">
                                        {{ csrf_field() }}

                                        {{--  Phần radio chọn loại danh sách cần chuyển  --}}
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" value="co_mat" checked>Có mặt</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" value="vang_mat">Vắng mặt</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" value="co_v_k_r">Có vào không ra</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" value="co_r_k_v">Có ra không vào</label>
                                        </div>
                                        
                                        {{--  Phần input ẩn chứa mã sự kiện và mã người cần chuyển danh sách  --}}   
                                        <input type="hidden" name="mask" value="{{ $sukien->MASK }}">
                                        <input type="hidden" name="ma_ng_chuyen" id="ma_ng_chuyen">
                                        <input type="hidden" name="ds_hien_tai" id="ds_hien_tai">
                                        <input type="hidden" name="loai_ng_chuyen" id="loai_ng_chuyen">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        <i class="fa fa-window-close" aria-hidden="true"></i>
                                        Đóng
                                    </button>
                                    <button type="submit" class="btn btn-primary" form="form_id_ds">
                                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                        Sửa kết quả
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Danh sách sinh viên văng mặt -->
                    @if (count($ds_sv_vang_mat) != 0)
                    <div class="table-responsive danhsach" id="sv_vang_mat">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>MSSV</th>
                                    <th>Họ tên</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Lớp</th>
                                    <th>Niên khóa</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>              
                                    @foreach ($ds_sv_vang_mat as $sv)
                                        <tr>
                                            <td>{{ $sv->MSSV }}</td>
                                            <td>{{ $sv->HOTEN }}</td>
                                            <td>{{ $sv->TENKHOA }}</td>
                                            <td>{{ $sv->TENCHNGANH }}</td>
                                            <td>{{ $sv->KYHIEULOP }}</td>
                                            <td>{{ $sv->KHOAHOC }}</td>                        
                                            {{--  Phần thao tác thông tin sinh viên  --}}
                                            <td>      
                                                <a class="btn btn-info" onclick="HienTTinNguoiChuyen('{{ $sv->MSSV }}', '{{ $sv->MALOAIDS }}')" data-toggle="modal" href='#modal-id-ds'>
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                    Sửa kết quả
                                                </a>                                            
                                                
                                                <a href="/student_info/{{ $sv->MSSV }}" target="_blank" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    Sửa thông tin
                                                </a>
                                            </td> 
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Danh sách sinh viên có mặt -->
                    @if (count($ds_sv_co_mat) != 0)
                    <div class="table-responsive danhsach" id="sv_co_mat">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>MSSV</th>
                                    <th>Họ tên</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Lớp</th>
                                    <th>Niên khóa</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>              
                                @foreach ($ds_sv_co_mat as $sv)
                                    <tr>
                                        <td>{{ $sv->MSSV }}</td>
                                        <td>{{ $sv->HOTEN }}</td>
                                        <td>{{ $sv->TENKHOA }}</td>
                                        <td>{{ $sv->TENCHNGANH }}</td>
                                        <td>{{ $sv->KYHIEULOP }}</td>
                                        <td>{{ $sv->KHOAHOC }}</td>                        
                                        {{--  Phần thao tác thông tin sinh viên  --}}
                                        <td>      
                                            <a class="btn btn-info" onclick="HienTTinNguoiChuyen('{{ $sv->MSSV }}', '{{ $sv->MALOAIDS }}')" data-toggle="modal" href='#modal-id-ds'>
                                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                Sửa kết quả
                                            </a>                                            
                                            
                                            <a href="/student_info/{{ $sv->MSSV }}" target="_blank" class="btn btn-success">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                Sửa thông tin
                                            </a>
                                        </td> 
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Danh sách sinh viên có vào không ra -->
                    @if (count($ds_sv_co_vao_k_ra) != 0)
                    <div class="table-responsive danhsach" id="sv_co_v_k_ra">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>MSSV</th>
                                    <th>Họ tên</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Lớp</th>
                                    <th>Niên khóa</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>              
                                    @foreach ($ds_sv_co_vao_k_ra as $sv)
                                        <tr>
                                            <td>{{ $sv->MSSV }}</td>
                                            <td>{{ $sv->HOTEN }}</td>
                                            <td>{{ $sv->TENKHOA }}</td>
                                            <td>{{ $sv->TENCHNGANH }}</td>
                                            <td>{{ $sv->KYHIEULOP }}</td>
                                            <td>{{ $sv->KHOAHOC }}</td>                        
                                            {{--  Phần thao tác thông tin sinh viên  --}}
                                            <td>      
                                                <a class="btn btn-info" onclick="HienTTinNguoiChuyen('{{ $sv->MSSV }}', '{{ $sv->MALOAIDS }}')" data-toggle="modal" href='#modal-id-ds'>
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                    Sửa kết quả
                                                </a>                                            
                                                
                                                <a href="/student_info/{{ $sv->MSSV }}" target="_blank" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    Sửa thông tin
                                                </a>
                                            </td> 
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Danh sách sinh viên có ra không vào -->
                    @if (count($ds_sv_co_ra_k_vao) != 0)
                    <div class="table-responsive danhsach" id="sv_co_ra_k_v">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>MSSV</th>
                                    <th>Họ tên</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Lớp</th>
                                    <th>Niên khóa</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>              
                                    @foreach ($ds_sv_co_ra_k_vao as $sv)
                                        <tr>
                                            <td>{{ $sv->MSSV }}</td>
                                            <td>{{ $sv->HOTEN }}</td>
                                            <td>{{ $sv->TENKHOA }}</td>
                                            <td>{{ $sv->TENCHNGANH }}</td>
                                            <td>{{ $sv->KYHIEULOP }}</td>
                                            <td>{{ $sv->KHOAHOC }}</td>                        
                                            {{--  Phần thao tác thông tin sinh viên  --}}
                                            <td>      
                                                <a class="btn btn-info" onclick="HienTTinNguoiChuyen('{{ $sv->MSSV }}', '{{ $sv->MALOAIDS }}')" data-toggle="modal" href='#modal-id-ds'>
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                    Sửa kết quả
                                                </a>                                            
                                                
                                                <a href="/student_info/{{ $sv->MSSV }}" target="_blank" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    Sửa thông tin
                                                </a>
                                            </td> 
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Danh sách sinh viên chưa bổ sung thông tin -->
                    @if (count($ds_sv_chua_co_ttin) != 0)
                    <div class="table-responsive danhsach" id="sv_chua_co_ttin">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>MSSV</th>
                                    <th>Họ tên</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Lớp</th>
                                    <th>Niên khóa</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>              
                                    @foreach ($ds_sv_chua_co_ttin as $sv)
                                        <tr>
                                            <td>{{ $sv->MSSV }}</td>
                                            <td>{{ $sv->HOTEN }}</td>
                                            <td>{{ $sv->TENKHOA }}</td>
                                            <td>{{ $sv->TENCHNGANH }}</td>
                                            <td>{{ $sv->KYHIEULOP }}</td>
                                            <td>{{ $sv->KHOAHOC }}</td>                        
                                            {{--  Phần thao tác thông tin sinh viên  --}}
                                            <td>                                                
                                                <a href="/student_info/{{ $sv->MSSV }}" target="_blank" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    Sửa thông tin
                                                </a>
                                            </td> 
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Danh sách cán bộ vắng mặt -->
                    @if (count($ds_cb_vang_mat) != 0)
                    <div class="table-responsive danhsach" id="cb_vang_mat">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>MSCB</th>
                                    <th>Họ tên</th>
                                    <th>Khoa</th>
                                    <th>Bộ môn</th>
                                    <th>Email</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>              
                                    @foreach ($ds_cb_vang_mat as $canbo)
                                        <tr>
                                            <td>{{ $canbo->MSCB }}</td>
                                            <td>{{ $canbo->HOTEN }}</td>
                                            <td>{{ $canbo->TENKHOA }}</td>
                                            <td>{{ $canbo->TENBOMON }}</td>
                                            <td>{{ $canbo->EMAIL }}</td>
                                                            
                                            {{--  Phần thao tác thông tin cán bộ  --}}
                                            <td>      
                                                <a class="btn btn-info" onclick="HienTTinNguoiChuyen('{{ $canbo->MSCB}}' , '{{ $canbo->MALOAIDS }}')" data-toggle="modal" href='#modal-id-ds'>
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                    Sửa kết quả
                                                </a>

                                                <a href="/staff_info/{{ $canbo->MSCB }}" target="_blank" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    Sửa thông tin
                                                </a>
                                            </td> 
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Danh sách cán bộ có mặt -->
                    @if (count($ds_cb_co_mat) != 0)
                    <div class="table-responsive danhsach" id="cb_co_mat">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>MSCB</th>
                                    <th>Họ tên</th>
                                    <th>Khoa</th>
                                    <th>Bộ môn</th>
                                    <th>Email</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>              
                                    @foreach ($ds_cb_co_mat as $canbo)
                                        <tr>
                                            <td>{{ $canbo->MSCB }}</td>
                                            <td>{{ $canbo->HOTEN }}</td>
                                            <td>{{ $canbo->TENKHOA }}</td>
                                            <td>{{ $canbo->TENBOMON }}</td>
                                            <td>{{ $canbo->EMAIL }}</td>

                                            {{--  Phần thao tác thông tin cán bộ  --}}
                                            <td>      
                                                <a class="btn btn-info" onclick="HienTTinNguoiChuyen('{{ $canbo->MSCB}}' , '{{ $canbo->MALOAIDS }}')" data-toggle="modal" href='#modal-id-ds'>
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                    Sửa kết quả
                                                </a>

                                                <a href="/staff_info/{{ $canbo->MSCB }}" target="_blank" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    Sửa thông tin
                                                </a>
                                            </td> 
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Danh sách cán bộ có vào không ra -->
                    @if (count($ds_cb_co_vao_k_ra) != 0)
                    <div class="table-responsive danhsach" id="cb_co_v_k_ra">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>MSCB</th>
                                    <th>Họ tên</th>
                                    <th>Khoa</th>
                                    <th>Bộ môn</th>
                                    <th>Email</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>              
                                    @foreach ($ds_cb_co_vao_k_ra as $canbo)
                                        <tr>
                                            <td>{{ $canbo->MSCB }}</td>
                                            <td>{{ $canbo->HOTEN }}</td>
                                            <td>{{ $canbo->TENKHOA }}</td>
                                            <td>{{ $canbo->TENBOMON }}</td>
                                            <td>{{ $canbo->EMAIL }}</td>

                                            {{--  Phần thao tác thông tin cán bộ  --}}
                                            <td>      
                                                <a class="btn btn-info" onclick="HienTTinNguoiChuyen('{{ $canbo->MSCB}}' , '{{ $canbo->MALOAIDS }}')" data-toggle="modal" href='#modal-id-ds'>
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                    Sửa kết quả
                                                </a>

                                                <a href="/staff_info/{{ $canbo->MSCB }}" target="_blank" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    Sửa thông tin
                                                </a>
                                            </td> 
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Danh sách cán bộ có ra không vào -->
                    @if (count($ds_cb_co_ra_k_vao) != 0)
                    <div class="table-responsive danhsach" id="cb_co_ra_k_v">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>MSCB</th>
                                    <th>Họ tên</th>
                                    <th>Khoa</th>
                                    <th>Bộ môn</th>
                                    <th>Email</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>              
                                    @foreach ($ds_cb_co_ra_k_vao as $canbo)
                                        <tr>
                                            <td>{{ $canbo->MSCB }}</td>
                                            <td>{{ $canbo->HOTEN }}</td>
                                            <td>{{ $canbo->TENKHOA }}</td>
                                            <td>{{ $canbo->TENBOMON }}</td>
                                            <td>{{ $canbo->EMAIL }}</td>

                                            {{--  Phần thao tác thông tin cán bộ  --}}
                                            <td>      
                                                <a class="btn btn-info" onclick="HienTTinNguoiChuyen('{{ $canbo->MSCB}}' , '{{ $canbo->MALOAIDS }}')" data-toggle="modal" href='#modal-id-ds'>
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                    Sửa kết quả
                                                </a>

                                                <a href="/staff_info/{{ $canbo->MSCB }}" target="_blank" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    Sửa thông tin
                                                </a>
                                            </td> 
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Danh sách cán bộ chưa bổ sung thông tin -->
                    @if (count($ds_cb_chua_co_ttin) != 0)
                    <div class="table-responsive danhsach" id="cb_chua_co_ttin">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>MSCB</th>
                                    <th>Họ tên</th>
                                    <th>Khoa</th>
                                    <th>Bộ môn</th>
                                    <th>Email</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>              
                                    @foreach ($ds_cb_chua_co_ttin as $canbo)
                                        <tr>
                                            <td>{{ $canbo->MSCB }}</td>
                                            <td>{{ $canbo->HOTEN }}</td>
                                            <td>{{ $canbo->TENKHOA }}</td>
                                            <td>{{ $canbo->TENBOMON }}</td>
                                            <td>{{ $canbo->EMAIL }}</td>

                                            {{--  Phần thao tác thông tin cán bộ  --}}
                                            <td>
                                                <a href="/staff_info/{{ $canbo->MSCB }}" target="_blank" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    Sửa thông tin
                                                </a>
                                            </td> 
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    {{--  Dánh sách rỗng  --}}
                    <div class="table-responsive danhsach" id="ds_rong">
                        <table class="table table-hover table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>Danh sách </th>
                                </tr>
                            </thead>

                            <tbody>
                                    <tr>
                                        <td>Những người trong danh sách này đã bị xóa</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <script>
                    function HienTTinNguoiChuyen(ma_so, ds) {
                        $("#ma_ng_chuyen").val(ma_so);
                        $("#ds_hien_tai").val(ds);
                    }
                </script>
            </div>
        @endif
    </div>
@endsection