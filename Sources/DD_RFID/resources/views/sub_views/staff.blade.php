@extends('admin')

@section('student')
    <div class="col-xs-12 col-md-4 col-md-offset-8">
			<form action="" method="get" class="form-inline" role="search">
				<input type="hidden" name="_token" value="HdmoKcKa4GbZY5A1e2NUvlH4Jtab0z0bitquS7OQ">
				<b>Tìm kiếm:</b>
				<input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
				<button type="submit" class="btn btn-primary">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					Tìm
				</button>
			</form>
    </div>
        
    </div>
    </div>

    <center><h1>Danh sách cán bộ</h1></center>

    <div class="row">
        <div class="col-xs-12">
        <div class="pull-left">
                <button type="button" class="btn btn-primary"  data-toggle="modal" href='#modal-themsv' id="btn_them_sv">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    Thêm cán bộ
                </button>
        </div>
        </div>
    </div>

        <div class="table-responsive">
                <table class="table table-bordered" style="background-color: white">
                    <thead>
                        <tr>
                            <th>MSCB</th>
                            <th>Họ tên</th>
                            <th>Khoa</th>
                            <th>Bộ môn</th>
                            <th>Email</th>
                            <th>Mã RFID</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001220</td>
                            <td>Lê Văn B</td>
                            <td>CNTT</td>
                            <td>Kỹ thuật phần mềm</td>
                            <td>lvbe@ctu.edu</td>
                            <td>234123412431234</td>
                            <td>
                                <a href="http://lyvan:8080/SuaSV/B1300001" class="btn btn-success">
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
                            <td>001220</td>
                            <td>Lê Văn B</td>
                            <td>CNTT</td>
                            <td>CNTT</td>
                            <td>lvbe@ctu.edu</td>
                            <td>234123412431234</td>
                            <td>
                                <a href="http://lyvan:8080/SuaSV/B1300001" class="btn btn-success">
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
                            <td>001220</td>
                            <td>Lê Văn B</td>
                            <td>CNTT</td>
                            <td>CNTT</td>
                            <td>lvbe@ctu.edu</td>
                            <td>234123412431234</td>
                            <td>
                                <a href="http://lyvan:8080/SuaSV/B1300001" class="btn btn-success">
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
                            <td>001220</td>
                            <td>Lê Văn B</td>
                            <td>CNTT</td>
                            <td>CNTT</td>
                            <td>lvbe@ctu.edu</td>
                            <td>234123412431234</td>
                            <td>
                                <a href="http://lyvan:8080/SuaSV/B1300001" class="btn btn-success">
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
                            <td>001220</td>
                            <td>Lê Văn B</td>
                            <td>CNTT</td>
                            <td>CNTT</td>
                            <td>lvbe@ctu.edu</td>
                            <td>234123412431234</td>
                            <td>
                                <a href="http://lyvan:8080/SuaSV/B1300001" class="btn btn-success">
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
@endsection

