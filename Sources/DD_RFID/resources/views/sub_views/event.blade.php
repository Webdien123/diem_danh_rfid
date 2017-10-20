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
        <form action="{{ route('FindSK') }}" method="get" class="form-inline pull-right hidden-xs" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm sự kiện:</b>
            <input type="text" class="form-control" name="tukhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>

        <form action="{{ route('FindSK') }}" method="get" class="form-inline hidden-sm hidden-md hidden-lg" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm sự kiện:</b>
            <input type="text" class="form-control" name="tukhoa" placeholder="Nhập nội dung tìm kiếm" required>
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
                    <th>Trạng thái điểm danh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>

                {{--  Modal đăng ký sự kiện trạng thái 1  --}}
                <div class="modal fade" id="modal-dangkids-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Đăng ký sự kiện</h4>
                            </div>
                            <div class="modal-body">                                         
                                <form action="" method="POST" role="form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="tenBang" id="tenBang" value="sukien">
                                    <input type="hidden" name="mask_dangki" class="form-control mask_dangki">
                                    <input type="hidden" name="tensk_dangki" class="form-control tensk_dangki">
                                
                                    <div class="form-group">
                                        <label>Mã sự kiện:</label>
                                        <input type="text" disabled class="form-control mask_dangki">
                                    </div>

                                    <div class="form-group">
                                        <label>Tên sự kiện:</label>
                                        <input type="text" disabled class="form-control tensk_dangki">
                                    </div>
                                
                                    <div class="form-group">
                                        <label>Chọn danh sách đăng ký:</label>
                                        <input type="file" class="form-control" name="im_file" id="im_file">
                                    </div>

                                    <a class="btn btn-success" href="./download/canbo.xls">
                                        <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                                        tải file đăng ký mẫu
                                    </a>
                                
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                        Thêm
                                    </button>
                                </form>                                            
                            </div>
                        </div>
                    </div>
                </div>

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

                        {{--  Phần hiển thị chức năng tùy vào trạng thái sự kiện  --}}
                        <td>

                        {{--  Nếu trạng thái là 1  --}}
                        @if ($sk->MATTHAI == '1')
                            <b class="text-danger">Chưa có danh sách đăng ký<b>                            
                            
                            <a class="btn btn-success" onclick="HienSuKien('{{ $sk->MASK }}', '{{ $sk->TENSK }}')" id="btn_dangkisk" data-toggle="modal" href='#modal-dangkids-1'>
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                thêm
                            </a>
                        @endif                           
                        </td>                    
                        <td>
                            <a href="/event_info/{{ $sk->MASK }}" class="btn btn-success">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                Sửa thông tin
                            </a>

                            <a class="btn btn-danger"
                                onclick="if(window.confirm('Xóa sinh viên này?')){
                                window.location.replace('<?php echo route("DeleteSK", 
                                ["mssk" => $sk->MASK]) ?>');}">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                Xóa
                            </a>
                        </td>
                    </tr>
                    @endforeach

                    <script>
                        function HienSuKien(mask, tensk) {
                            $(".mask_dangki").val(mask);
                            $(".tensk_dangki").val(tensk);
                        }
                    </script>
                    
                @endif
            </tbody>
        </table>
    </div>

    {{--  Hiển thị dãy nút phân trang.  --}}
    @if (count($sukiens) != 0)
    <center>
        {!! $sukiens->links() !!}
    </center>
    @endif
    
@endsection

