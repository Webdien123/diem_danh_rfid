{{--  Định nghĩa trang cán bộ   --}}
@extends('admin')

@section('title', 'Trang cán bộ')

@section('student') 

    {{--  Script lưu trữ mà lấy giá trị cần thiết khi 
    chọn danh sách bộ môn hoặc danh sách khoa.  --}}
    <script src="{{ asset('js/select_khoa_bomon.js') }}"></script>

    {{--  Script inport jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script xử lý validate dữ liệu cán bộ  --}}
    <script src="{{ asset('js/validate_canbo.js') }}"></script>

    {{--  Tìm kiếm cán bộ  --}}
    <div class="col-xs-12 col-sm-4 col-sm-offset-8">
        <form action="" method="get" class="form-inline pull-right hidden-xs" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm cán bộ:</b>
            <input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>

        <form action="" method="get" class="form-inline hidden-sm hidden-md hidden-lg" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm cán bộ:</b>
            <input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>
    </div>
        
    </div> {{--  kết thúc container của trang master  --}}

    {{--  Hiển thị tiêu đề và nút thêm cán bộ  --}}
    <center><h1>Danh sách cán bộ</h1></center>
    <div class="row">
        <div class="col-xs-12 col-md-6">  

            {{--  Nút thêm cán bộ  --}}
            <a class="btn btn-primary" data-toggle="modal" href='#modal-themcb'>
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                Thêm cán bộ
            </a>

            {{--  Modal thêm các bộ  --}}
            <div class="modal fade" id="modal-themcb">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Thêm cán bộ</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('AddCB') }}" method="POST" id="form_canbo">
                                {{--  Phần mã xác thực form của laravel  --}}
								{{ csrf_field() }}

                                <div class="form-group">
									<label for="">Mã số cán bộ:</label>
									<input type="text" name="mscb" id="mscb" class="form-control" placeholder="mã số cán bộ">
								</div>

								<div class="form-group">
									<label for="">Họ tên:</label>
									<input type="text" name="hoten" id="hoten" class="form-control" placeholder="họ tên">
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

								<button type="button" class="btn btn-default" data-dismiss="modal">
									<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
									Hủy
								</button>

								<button type="submit" class="btn btn-primary">
									<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
									Thêm cán bộ
								</button>
							</form>
                        </div>
                    </div>
                </div>
            </div>
            
            <a class="btn btn-default" style="background-color: #001a66; color: white">
                <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                Thêm cán bộ từ excel
            </a>
        </div>
    </div>

    {{--  Hiển thị danh sách cán bộ  --}}
    <div class="table-responsive">
        <table class="table table-hover table-bordered" style="background-color: white">
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

                {{--  Nếu danh sách cán bộ rỗng  --}}
                @if (count($canbos) == 0)

                {{--  Phần nội dung không có cán bộ  --}}
                <tr>
                    <th colspan="8" class="text-center"><i>Danh sách rỗng.</i></th>
                </tr>
                @else
                <!-- Phần nội dung khi có cán bộ -->                   
                    @foreach ($canbos as $canbo)
                        <tr>
                            <td>{{ $canbo->MSCB }}</td>
                            <td>{{ $canbo->HOTEN }}</td>
                            <td>{{ $canbo->TENKHOA }}</td>
                            <td>{{ $canbo->TENBOMON }}</td>
                            <td>{{ $canbo->EMAIL }}</td>
                            <td>
                                234123412431234
                                <button type="button" class="btn btn-warning">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                            </td>
                            <td>
                                <a href="/staff_info/{{ $canbo->MSCB }}" class="btn btn-success">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    Sửa thông tin
                                </a>
                                
                                <button type="button" class="btn btn-danger"
                                    onclick="if(window.confirm('Xóa cán bộ này?')){
                                    window.location.replace('<?php echo route("DeleteCB", 
                                    ["mscb" => $canbo->MSCB]) ?>');}">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    Xóa
                                </button>
                            </td>
                            
                        </tr>

                        {{--  <tr>
                            <td>001220</td>
                            <td>Lê Văn B</td>
                            <td>CNTT</td>
                            <td>CNTT</td>
                            <td>lvbe@ctu.edu</td>
                            <td>chưa đăng ký</td>
                            <td>
                                <a href="" class="btn btn-success">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    Sửa thông tin
                                </a>
                                
                                <button type="button" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    Xóa
                                </button>
                            </td>
                        </tr>  --}}
                    @endforeach           
                @endif
            </tbody>
        </table>
    </div>
    <center>
        {!! $canbos->links() !!}
    </center>
@endsection

