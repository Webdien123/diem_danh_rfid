@extends('admin')

@section('student')
    <div class="col-xs-12">
            
        <div class="pull-right">
			<form action="" method="get" class="form-inline" role="search">
				<input type="hidden" name="_token" value="HdmoKcKa4GbZY5A1e2NUvlH4Jtab0z0bitquS7OQ">
				<b>Tìm kiếm:</b>
				<input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
				<button type="submit" class="btn btn-danger">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					Tìm
				</button>
			</form>
		</div>
        
    </div>
    </div>
    <div class="row">
    </div>

    <center><h1>Danh sách sinh viên</h1></center>

        <div class="pull-left">
                <button type="button" class="btn btn-danger"  data-toggle="modal" href='#modal-themsv' id="btn_them_sv">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    Thêm sinh viên
                </button>
        </div>

        <table class="table table-hover table-bordered" style="background-color: white">
            <thead>
                <tr>
                    <th>Tên sự kiện</th>
                    <th>Ngày thực hiện</th>
                    <th>Điểm danh vào</th>
                    <th>Điểm danh ra</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ngày hội việc làm</td>
                    <td>24/08/2017</td>
                    <td>14:00</td>
                    <td>17:00</td>
                    <td>
                        <a href="http://lyvan:8080/SuaSV/B1300001" class="btn btn-success">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            Sửa thông tin
                        </a>

                        <button type="button" class="btn btn-danger" 
                            onclick="
                                if(window.confirm('Xóa này?')){
                                    if(window.confirm('Xóa cả thông tin của sinh viên này trong bộ nhớ?')){
                                        window.location.replace('http://lyvan:8080/XuLyXoaThe/333/true');

                                    }
                                    else{
                                        window.location.replace('http://lyvan:8080/XuLyXoaThe/333/false');
                                    }
                                }
                            ">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            Xóa
                        </button>
                    </td>
                </tr>	

                <tr>
                    <td>Ngày hội việc làm</td>
                    <td>24/08/2017</td>
                    <td>14:00</td>
                    <td>17:00</td>
                    <td>
                        <a href="http://lyvan:8080/SuaSV/B1300001" class="btn btn-success">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            Sửa thông tin
                        </a>

                        <button type="button" class="btn btn-danger" 
                            onclick="
                                if(window.confirm('Xóa này?')){
                                    if(window.confirm('Xóa cả thông tin của sinh viên này trong bộ nhớ?')){
                                        window.location.replace('http://lyvan:8080/XuLyXoaThe/333/true');

                                    }
                                    else{
                                        window.location.replace('http://lyvan:8080/XuLyXoaThe/333/false');
                                    }
                                }
                            ">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            Xóa
                        </button>
                    </td>
                </tr>	

                <tr>
                    <td>Ngày hội việc làm</td>
                    <td>24/08/2017</td>
                    <td>14:00</td>
                    <td>17:00</td>
                    <td>
                        <a href="http://lyvan:8080/SuaSV/B1300001" class="btn btn-success">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            Sửa thông tin
                        </a>

                        <button type="button" class="btn btn-danger" 
                            onclick="
                                if(window.confirm('Xóa này?')){
                                    if(window.confirm('Xóa cả thông tin của sinh viên này trong bộ nhớ?')){
                                        window.location.replace('http://lyvan:8080/XuLyXoaThe/333/true');

                                    }
                                    else{
                                        window.location.replace('http://lyvan:8080/XuLyXoaThe/333/false');
                                    }
                                }
                            ">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            Xóa
                        </button>
                    </td>
                </tr>	

                <tr>
                    <td>Ngày hội việc làm</td>
                    <td>24/08/2017</td>
                    <td>14:00</td>
                    <td>17:00</td>
                    <td>
                        <a href="http://lyvan:8080/SuaSV/B1300001" class="btn btn-success">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            Sửa thông tin
                        </a>

                        <button type="button" class="btn btn-danger" 
                            onclick="
                                if(window.confirm('Xóa này?')){
                                    if(window.confirm('Xóa cả thông tin của sinh viên này trong bộ nhớ?')){
                                        window.location.replace('http://lyvan:8080/XuLyXoaThe/333/true');

                                    }
                                    else{
                                        window.location.replace('http://lyvan:8080/XuLyXoaThe/333/false');
                                    }
                                }
                            ">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            Xóa
                        </button>
                    </td>
                </tr>	

                <tr>
                    <td>Ngày hội việc làm</td>
                    <td>24/08/2017</td>
                    <td>14:00</td>
                    <td>17:00</td>
                    <td>
                        <a href="http://lyvan:8080/SuaSV/B1300001" class="btn btn-success">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            Sửa thông tin
                        </a>

                        <button type="button" class="btn btn-danger" 
                            onclick="
                                if(window.confirm('Xóa này?')){
                                    if(window.confirm('Xóa cả thông tin của sinh viên này trong bộ nhớ?')){
                                        window.location.replace('http://lyvan:8080/XuLyXoaThe/333/true');

                                    }
                                    else{
                                        window.location.replace('http://lyvan:8080/XuLyXoaThe/333/false');
                                    }
                                }
                            ">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            Xóa
                        </button>
                    </td>
                </tr>	
            </tbody>
        </table>
@endsection

