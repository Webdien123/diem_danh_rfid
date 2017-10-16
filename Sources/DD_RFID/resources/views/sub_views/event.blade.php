{{--  Định nghĩa trang sự kiện  --}}

@extends('admin')

@section('title', 'Trang sự kiện')

@section('event')
    
    {{--  Khai báo biến thời gian toàn cục dùng cho validate form vào 2 biến time và today  --}}
    <script src="{{ asset('js/get_current_datetime.js') }}"></script>

    {{--  Script tạo giá trị ban đầu cho các trường thời gian và ngày tháng  --}}
    <script src="{{ asset('js/set_formAddEvent.js') }}"></script>

    {{--  Script import jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script xử lý validate dữ liệu sự kiện  --}}
    <script src="{{ asset('js/validate_sukien.js') }}"></script>

    {{--  Gọi code thực hiện xoay icon Đang điểm danh  --}}
    @include('link_views.rotation_icon')

    {{--  Tìm kiếm sự kiện  --}}
    <div class="col-xs-12 col-sm-4 col-sm-offset-8">
        <form action="" method="get" class="form-inline pull-right hidden-xs" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm sự kiện:</b>
            <input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>

        <form action="" method="get" class="form-inline hidden-sm hidden-md hidden-lg" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm sự kiện:</b>
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
            <a class="btn btn-success"  data-toggle="modal" href='#modal-themsk'>
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                Thêm sự kiện
            </a>

            {{--  modal thêm sự kiện  --}}
            <div class="modal fade" id="modal-themsk">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Thêm sự kiện</h4>
                        </div>
                        <div class="modal-body">
                            {{--  Form thêm sự kiện  --}}
                            <form action="{{ route('AddSK') }}" method="POST" id="form_sukien">
                                {{--  Phần mã xác thực form của laravel  --}}
								{{ csrf_field() }}

                                <div class="form-group">
									<label>Tên sự kiện:</label>
									<input type="text" name="tensk" id="tensk" class="form-control" placeholder="mã số sinh viên">
								</div>

								<div class="form-group">
									<label>Ngày thực hiện:</label>
                                    <input type="date" name="ngthuchien" id="ngthuchien" class="form-control" required="required" title="Ngày diễn ra sự kiện">
                                </div>

                                <div class="form-group">
									<label>Địa điểm:</label>
									<input type="text" name="diadiem" id="diadiem" class="form-control" placeholder="Nơi diễn ra sự kiện">
                                </div>
                                
                                <div class="form-group">
									<label>Giờ điểm danh vào:</label>
                                    <input type="time" name="ddvao" id="ddvao" class="form-control">
                                </div>

                                <div class="form-group">
									<label>Giờ điểm danh ra:</label>
                                    <input type="time" name="ddra" min="document.getElementById('ddvao').value" id="ddra" class="form-control">
                                </div>

								<button type="button" class="btn btn-success" data-dismiss="modal">
									<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
									Hủy
								</button>

								<button type="submit" class="btn btn-success">
									<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
									Thêm sự kiện
								</button>
							</form>
                        </div>
                    </div>
                </div>
            </div>
            

            <a class="btn btn-default" style="background-color: #001a66; color: white">
                <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                Thêm sự kiện từ excel
            </a>

            {{--  Script cập nhật lại miền giá trị hợp lệ cho sự kiện  --}}
            <script src="{{ asset('js/update_time.js') }}"></script>  

        </div>
    </div>

    {{--  Hiển thị danh sách sự kiện  --}}
    <div class="table-responsive">
        <table class="table table-hover table-bordered" style="background-color: white">
            <thead>
                <tr>
                    <th>Mã số</th>             
                    <th>Tên sự kiện</th>
                    <th>Ngày thực hiện</th>
                    <th>Địa điểm</th>
                    <th>Điểm danh vào</th>
                    <th>Điểm danh ra</th>
                    <th>Kết quả điểm danh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>

                {{--  Nếu danh sách sự kiện rỗng  --}}
                @if (count($sukiens) == 0)
                    {{--  Phần nội dung không có sự kiện  --}}
                    <tr>
                        <th colspan="8" class="text-center"><i>Danh sách rỗng.</i></th>
                    </tr>
                @else
                    {{-- Phần nội dung khi có sự kiện   --}}
                    @foreach ($sukiens as $sk)
                    <tr>
                        <td>{{ $sk->MASK }}</td>            
                        <td>{{ $sk->TENSK }}</td>
                        <td>{{ $sk->NGTHUCHIEN }}</td>
                        <td>{{ $sk->DIADIEM }}</td>
                        <td>{{ $sk->DDVAO }}</td>
                        <td>{{ $sk->DDRA }}</td>
                        <td><center>
                            <i>Chưa Thực hiện.</i>
                        </center></td>                    
                        <td>
                            <a href="/event_info/{{ $sk->MASK }}" class="btn btn-success">
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
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    
@endsection

