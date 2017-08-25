@extends('admin')

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

    <div class="col-xs-12">
        
        <!-- Phần nội dung khi không có kết quả thống kê -->
        <!-- <div class="container-fluid">
            <div class="panel panel-info">
                    <div class="panel-body">
                        <h2>Hiện chưa có kết quả điểm đanh cho các sự kiện</h2>
                    </div>
            </div>
        </div> -->

        <!-- Phần nội dung khi có kết quả thống kế -->
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
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
                                            <td>Ngày hội việc làm 1</td>
                                        </tr>
                                        <tr>
                                            <th>Ngày thực hiện</th>
                                            <td>24/08/2017</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a href="#" class="btn btn-primary btn-block">
                                                    <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                                                    Đổi sự kiện
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            
            <h1>Sinh viên</h1>

            <div class="row">
                <div class="col-xs-12 col-md-6" id="piechart1" style="border: blue 1px solid"></div>
                <div class="col-xs-12 col-md-6" id="piechart2" style="border: blue 1px solid"></div>
            </div>

            <h1>Cán bộ</h1>

            <div class="row">
                <div class="col-xs-12 col-md-6" id="piechart3" style="border: blue 1px solid"></div>
                <div class="col-xs-12 col-md-6" id="piechart4" style="border: blue 1px solid"></div>
            </div>
            
            </div>

            <center style="margin-top: 5%;"><h2>Danh sách sinh viên vắng mặt (7 sinh viên [15.4%])</h2></center>

            <div class="row">

                <div class="col-xs-12 col-md-4 col-md-offset-4">
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

                <div class="col-xs-12 col-md-4">
                    <form action="" method="get" class="form-inline" role="search">
                        {{ csrf_field() }}
                        <b>Tìm kiếm:</b>
                        <input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
                        <button type="submit" class="btn btn-info">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            Tìm
                        </button>
                    </form>  
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
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
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
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
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
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
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
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
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
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    Xóa
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection