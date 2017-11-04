{{--  Định nghĩa trang thống kê điểm danh  --}}

@extends('admin')

@section('title', 'Trang thống kê')

@section('chart')

    {{--  Nhận giá trị các số liệu thống kê  --}}
    <?php    

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

    {{--  Tìm kiếm thông tin --}}
    <div class="col-xs-12 col-sm-4 col-sm-offset-8">
        <form action="" method="get" class="form-inline pull-right hidden-xs" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm:</b>
            <input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-info">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>

        <form action="" method="get" class="form-inline hidden-sm hidden-md hidden-lg" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm:</b>
            <input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-info">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>
    </div>

    {{--  Nội dung trang thống kê  --}}
    <div class="col-xs-12">
        {{--  Tìm kiếm thông tin tổng hợp  --}}
        {{--  <div class="row">  --}}
            
        {{--  </div>  --}}
        
        @if ($sukien == null)
            <!-- Phần nội dung khi không có kết quả thống kê -->
            <div class="container-fluid">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <h2 class="text-center">Hiện chưa có kết quả điểm đanh cho các sự kiện</h2>
                    </div>
                </div>
            </div>
        @else
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
                                                <th>Sự kiện</th>
                                                <td class="lead">{{ $sukien->TENSK }}</td>
                                            </tr>
                                            <tr>
                                                <th>Ngày thực hiện</th>
                                                <td>{{ $sukien->NGTHUCHIEN }}</td>
                                            </tr>
                                            <tr>
                                                {{--  Nút chuyển sự kiện hiển thị  --}}
                                                <td colspan="2">                                                
                                                    <a class="btn btn-primary btn-block" data-toggle="modal" href='#modal-id-sk'>
                                                        <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                                                        Đổi sự kiện
                                                    </a>
                                                    <div class="modal fade" id="modal-id-sk">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title">Đổi sự kiện (10 sự kiện gần nhất)</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    
                                                                    <form action="#" id="form_id_sk">
                                                                        <div class="radio">
                                                                            <label><input type="radio" name="optradio" checked>Ngày hội việc làm 1</label>
                                                                        </div>
                                                                        <div class="radio">
                                                                            <label><input type="radio" name="optradio">Ngày hội việc làm 2</label>
                                                                        </div>
                                                                        <div class="radio">
                                                                            <label><input type="radio" name="optradio">Ngày hội việc làm 3</label>
                                                                        </div>
                                                                        <div class="radio">
                                                                            <label><input type="radio" name="optradio">Ngày hội việc làm 4</label>
                                                                        </div>
                                                                        <div class="radio">
                                                                            <label><input type="radio" name="optradio">Ngày hội việc làm 5</label>
                                                                        </div>
                                                                        <div class="radio">
                                                                            <label><input type="radio" name="optradio">Ngày hội việc làm 6</label>
                                                                        </div>
                                                                        <div class="radio">
                                                                            <label><input type="radio" name="optradio">Ngày hội việc làm 7</label>
                                                                        </div>
                                                                        <div class="radio">
                                                                            <label><input type="radio" name="optradio">Ngày hội việc làm 8</label>
                                                                        </div>
                                                                        <div class="radio">
                                                                            <label><input type="radio" name="optradio">Ngày hội việc làm 9</label>
                                                                        </div>
                                                                        <div class="radio">
                                                                            <label><input type="radio" name="optradio">Ngày hội việc làm 10</label>
                                                                        </div>
                                                                        
                                                                    </form>
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                        <i class="fa fa-window-close" aria-hidden="true"></i>
                                                                        Đóng
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary" form="form_id_sk">
                                                                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                                                        Chuyển sự kiện
                                                                    </button>
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
                <center style="margin-top: 5%;"><h2>Danh sách sinh viên vắng mặt (7 sinh viên [15.4%])</h2></center>

                {{--  Phần xuất danh sách, chọn danh sách thống kê khác và tìm kiếm thông tin  --}}
                <div class="row">

                {{--  Phần xuất file excel  --}}
                <div class="col-xs-12 col-md-4">
                    <a href="#" class="btn btn-success">
                        <span class="fa fa-file-excel-o fa-2x" aria-hidden="true"></span>
                        Xuất danh sách ra excel
                    </a>
                </div>

                {{--  Phần chọn danh sách thống kê  --}}
                <div class="col-xs-12 col-md-4">
                        <div class="form-group has-warning form-inline">
                            <label for="sel1">Danh sách:</label>
                            <select class="form-control" id="sel1">
                                @if (count($ds_sv_vang_mat) != 0)
                                <option>Sinh viên vắng mặt</option>
                                @endif

                                @if (count($ds_sv_co_mat) != 0)
                                <option>Sinh viên có mặt</option>
                                @endif

                                @if (count($ds_sv_co_vao_k_ra) != 0)
                                <option>Sinh viên có vào không ra</option>
                                @endif

                                @if (count($ds_sv_co_ra_k_vao) != 0)
                                <option>Sinh viên có ra không vào</option>
                                @endif

                                @if (count($ds_sv_chua_co_ttin) != 0)
                                <option>Sinh viên chưa có thông tin</option>
                                @endif

                                @if (count($ds_cb_vang_mat) != 0)
                                <option>Cán bộ vắng mặt</option>
                                @endif

                                @if (count($ds_cb_co_mat) != 0)
                                <option>Cán bộ có mặt</option>
                                @endif

                                @if (count($ds_cb_co_vao_k_ra) != 0)
                                <option>Cán bộ có vào không ra</option>
                                @endif

                                @if (count($ds_cb_co_ra_k_vao) != 0)
                                <option>Cán bộ có ra không vào</option>
                                @endif

                                @if (count($ds_cb_chua_co_ttin) != 0)
                                <option>Cán bộ chưa có thông tin</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                
                {{--  Modal chuyển danh sách  --}}
                <div class="modal fade" id="modal-id-ds">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">
                                    Sửa kết quả
                                    <span>sinh viên</span>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form action="/" id="form_id_ds">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" checked>Có mặt</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Vắng mặt</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Có vào không ra</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Có ra không vào</label>
                                    </div>                                                        
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
                                            <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
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
                                        <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
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
                                            <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
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
                                            <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
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
                                            <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
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

                <!-- Danh sách cán bộ vắng mặt -->
                @if (count($ds_cb_vang_mat) != 0)
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
                                @foreach ($ds_cb_vang_mat as $canbo)
                                    <tr>
                                        <td>{{ $canbo->MSCB }}</td>
                                        <td>{{ $canbo->HOTEN }}</td>
                                        <td>{{ $canbo->TENKHOA }}</td>
                                        <td>{{ $canbo->TENBOMON }}</td>
                                        <td>{{ $canbo->EMAIL }}</td>
                                                          
                                        {{--  Phần thao tác thông tin cán bộ  --}}
                                        <td>      
                                            <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
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
                                            <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
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
                                @foreach ($ds_cb_co_vao_k_ra as $canbo)
                                    <tr>
                                        <td>{{ $canbo->MSCB }}</td>
                                        <td>{{ $canbo->HOTEN }}</td>
                                        <td>{{ $canbo->TENKHOA }}</td>
                                        <td>{{ $canbo->TENBOMON }}</td>
                                        <td>{{ $canbo->EMAIL }}</td>

                                        {{--  Phần thao tác thông tin cán bộ  --}}
                                        <td>      
                                            <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
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
                                @foreach ($ds_cb_co_ra_k_vao as $canbo)
                                    <tr>
                                        <td>{{ $canbo->MSCB }}</td>
                                        <td>{{ $canbo->HOTEN }}</td>
                                        <td>{{ $canbo->TENKHOA }}</td>
                                        <td>{{ $canbo->TENBOMON }}</td>
                                        <td>{{ $canbo->EMAIL }}</td>

                                        {{--  Phần thao tác thông tin cán bộ  --}}
                                        <td>      
                                            <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
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
                                @foreach ($ds_cb_chua_co_ttin as $canbo)
                                    <tr>
                                        <td>{{ $canbo->MSCB }}</td>
                                        <td>{{ $canbo->HOTEN }}</td>
                                        <td>{{ $canbo->TENKHOA }}</td>
                                        <td>{{ $canbo->TENBOMON }}</td>
                                        <td>{{ $canbo->EMAIL }}</td>

                                        {{--  Phần thao tác thông tin cán bộ  --}}
                                        <td>      
                                            <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
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
            </div>
        @endif
    </div>
@endsection