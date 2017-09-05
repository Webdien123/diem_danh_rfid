{{--  Định nghĩa trang thống kê điểm danh  --}}

@extends('admin')

@section('title', 'Trang thống kê')

@section('chart')

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

    {{--  Tìm kiếm thông tin --}}
    <div class="col-xs-12 col-sm-4 col-sm-offset-8">
        <form action="" method="get" class="form-inline pull-right hidden-xs" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm:</b>
            <input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-danger">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>

        <form action="" method="get" class="form-inline hidden-sm hidden-md hidden-lg" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm:</b>
            <input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-danger">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>
    </div>

    <div class="col-xs-12">
        {{--  Tìm kiếm thông tin tổng hợp  --}}
        {{--  <div class="row">  --}}
            
        {{--  </div>  --}}

        <!-- Phần nội dung khi không có kết quả thống kê -->
        <div class="container-fluid">
            <div class="panel panel-info">
                    <div class="panel-body">
                        <h2 class="text-center">Hiện chưa có kết quả điểm đanh cho các sự kiện</h2>
                    </div>
            </div>
        </div>

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
                                            <td class="lead">Ngày hội việc làm 1</td>
                                        </tr>
                                        <tr>
                                            <th>Ngày thực hiện</th>
                                            <td>24/08/2017</td>
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
            
        </div>

        {{--  Phần hiển thị thông tin danh sách đang hiển thị  --}}
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
                        <option>Sinh viên vắng mặt</option>
                        <option>Sinh viên có mặt</option>
                        <option>Sinh viên có vào không ra</option>
                        <option>Sinh viên có ra không vào</option>
                        <option>Sinh viên chưa có thông tin</option>
                        <option>Cán bộ vắng mặt</option>
                        <option>Cán bộ có mặt</option>
                        <option>Cán bộ có vào không ra</option>
                        <option>Cán bộ có ra không vào</option>
                        <option>Cán bộ chưa có thông tin</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Danh sách sinh viên -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered" style="background-color: white">
                <thead>
                    <tr>
                        <th>MSSV</th>
                        <th>Họ tên</th>
                        <th>Khoa</th>
                        <th>Ngành</th>
                        <th>Lớp</th>
                        <th>Niên khóa</th>
                        <th>Mã RFID</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Phần nội dung không có sinh viên -->
                    <tr>
                        <th colspan="8" class="text-center"><i>Danh sách rỗng.</i></th>
                    </tr>

                    <!-- Phần nội dung khi có sinh viên -->
                    <tr>
                        <td>B1305056</td>
                        <td>Nguyễn Thị A</td>
                        <td>CNTT</td>
                        <td>CNTT</td>
                        <td>A2</td>
                        <td>K39</td>
                        <td>234123412431234</td>
                        {{--  Nút chuyển danh sách  --}}
                        <td>      
                            <a class="btn btn-info" data-toggle="modal" href='#modal-id-ds'>
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                Chuyển danh sách
                            </a>
                            <div class="modal fade" id="modal-id-ds">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">
                                                Chuyển danh sách
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
                                                Chuyển danh sách
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <a href="" class="btn btn-success">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                Sửa thông tin
                            </a>

                            <button type="button" class="btn btn-danger">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Xóa
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>B1305056</td>
                        <td>Nguyễn Thị A</td>
                        <td>CNTT</td>
                        <td>CNTT</td>
                        <td>A2</td>
                        <td>K39</td>
                        <td>234123412431234</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                Chuyển danh sách
                            </a>
                            
                            <a href="" class="btn btn-success">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                Sửa thông tin
                            </a>

                            <button type="button" class="btn btn-danger">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Xóa
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>B1305056</td>
                        <td>Nguyễn Thị A</td>
                        <td>CNTT</td>
                        <td>CNTT</td>
                        <td>A2</td>
                        <td>K39</td>
                        <td>234123412431234</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                Chuyển danh sách
                            </a>
                            
                            <a href="" class="btn btn-success">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                Sửa thông tin
                            </a>

                            <button type="button" class="btn btn-danger">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Xóa
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>B1305056</td>
                        <td>Nguyễn Thị A</td>
                        <td>CNTT</td>
                        <td>CNTT</td>
                        <td>A2</td>
                        <td>K39</td>
                        <td>234123412431234</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                Chuyển danh sách
                            </a>
                            
                            <a href="" class="btn btn-success">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                Sửa thông tin
                            </a>

                            <button type="button" class="btn btn-danger">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Xóa
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>B1305056</td>
                        <td>Nguyễn Thị A</td>
                        <td>CNTT</td>
                        <td>CNTT</td>
                        <td>A2</td>
                        <td>K39</td>
                        <td>234123412431234</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                Chuyển danh sách
                            </a>
                            
                            <a href="" class="btn btn-success">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                Sửa thông tin
                            </a>

                            <button type="button" class="btn btn-danger">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Xóa
                            </button>
                        </td>
                    </tr>
                    {{--  ./ Phần nội dung khi có sinh viên  --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection