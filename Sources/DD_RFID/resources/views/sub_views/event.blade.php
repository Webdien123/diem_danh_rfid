{{--  Định nghĩa trang sự kiện  --}}

@extends('admin')

@section('title', 'Trang sự kiện')

@section('event')
    
    {{--  Gọi code thực hiện xoay icon đang cập nhật  --}}
    @include('link_views.rotation_icon')

    {{--  Tìm kiếm sự kiện  --}}
    <div class="col-xs-12 col-md-4 col-md-offset-8">
			<form action="" method="get" class="form-inline" role="search">
				<input type="hidden" name="_token" value="HdmoKcKa4GbZY5A1e2NUvlH4Jtab0z0bitquS7OQ">
				<b>Tìm kiếm:</b>
				<input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
				<button type="submit" class="btn btn-success">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					Tìm
				</button>
			</form>
    </div>
    
    </div> {{--  kết thúc container của trang master  --}}

    {{--  Hiển thị tiêu đề và nút thêm sự kiện  --}}
    <center><h1>Danh sách sự kiện</h1></center>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <a class="btn btn-success"  data-toggle="modal" href='#modal-themsv' id="btn_them_sv">
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                Thêm sự kiện
            </a>

            <a class="btn btn-default" style="background-color: #001a66; color: white">
                <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                Thêm sự kiện từ excel
            </a>
        </div>
    </div>

    {{--  Hiển thị danh sách sự kiện  --}}
    <div class="table-responsive">
        <table class="table table-hover table-bordered" style="background-color: white">
            <thead>
                <tr>
                    <th>Tên sự kiện</th>
                    <th>Ngày thực hiện</th>
                    <th>Điểm danh vào</th>
                    <th>Điểm danh ra</th>
                    <th>Kết quả điểm danh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>

                {{--  Phần nội dung không có sự kiện  --}}
                <tr>
                    <th colspan="6" class="text-center"><i>Danh sách rỗng.</i></th>
                </tr>

                {{-- Phần nội dung khi có sự kiện   --}}
                <tr>
                    <td>Ngày hội việc làm 0</td>
                    <td>24/08/2017</td>
                    <td>14:00</td>
                    <td>17:00</td>
                    <td><center>
                        <span class="glyphicon glyphicon-refresh gly-spin"></span>
                        Đang cập nhật
                    </center></td>                    
                    <td>
                        <a href="" class="btn btn-success">
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
                    <td>Ngày hội việc làm 1</td>
                    <td>24/08/2017</td>
                    <td>14:00</td>
                    <td>17:00</td>
                    <td>
                        <a href="" class="btn btn-default btn-block" style="background-color: #8064A2; color: white">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            Xem kết quả
                        </a>
                    </td>         
                    <td>
                        <a href="" class="btn btn-success">
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
                    <td>Ngày hội việc làm 2</td>
                    <td>24/08/2017</td>
                    <td>14:00</td>
                    <td>17:00</td>
                    <td><center>
                        <span class="glyphicon glyphicon-refresh gly-spin"></span>
                        Đang cập nhật
                    </center></td>         
                    <td>
                        <a href="" class="btn btn-success">
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
                    <td>Ngày hội việc làm 3</td>
                    <td>24/08/2017</td>
                    <td>14:00</td>
                    <td>17:00</td>
                    <td><center>
                        <span class="glyphicon glyphicon-refresh gly-spin"></span>
                        Đang cập nhật
                    </center></td>         
                    <td>
                        <a href="" class="btn btn-success">
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
                    <td>Ngày hội việc làm 4</td>
                    <td>24/08/2017</td>
                    <td>14:00</td>
                    <td>17:00</td>
                    <td><center>
                        <span class="glyphicon glyphicon-refresh gly-spin"></span>
                        Đang cập nhật
                    </center></td>         
                    <td>
                        <a href="" class="btn btn-success">
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
    </div>
    
@endsection

