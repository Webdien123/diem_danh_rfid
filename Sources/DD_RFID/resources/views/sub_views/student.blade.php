{{--  Định nghĩa trang sinh viên  --}}
@extends('admin')

@section('title', 'Trang sinh viên')

@section('student')

    {{--  Script xử lý khi select danh sách chuyên ngành, danh sách khoa.
    Và các danh sách nằm trên form thêm sinh viên  --}}
    <script src="{{ asset('js/select_khoa_chnganh.js') }}"></script>

    {{--  Script import jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  script validate giá trị input file  --}}
    {{--  <script src="{{ asset('js/additional-methods.min.js') }}"></script>  --}}

    {{--  Script xử lý validate dữ liệu cán bộ  --}}
    <script src="{{ asset('js/validate_sinhvien.js') }}"></script>

    {{--  Tìm kiếm sinh viên  --}}
    <div class="col-xs-12 col-sm-5 col-sm-offset-7">
        <form action="" method="get" class="form-inline pull-right hidden-xs" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm sinh viên:</b>
            <input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-danger">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>

        <form action="" method="get" class="form-inline hidden-sm hidden-md hidden-lg" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm sinh viên:</b>
            <input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-danger">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>
    </div>

    </div> {{--  kết thúc container của trang master  --}}

    {{--  Hiển thị tiêu đề và nút thêm sinh viên  --}}
    <center><h1>Danh sách sinh viên</h1></center>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            {{--  Nút thêm sinh viên  --}}
            <a class="btn btn-danger" class="pull-left" data-toggle="modal" href='#modal-themsv'>
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                Thêm sinh viên
            </a>

            {{--  Modal thêm sinh viên  --}}
            <div class="modal fade" id="modal-themsv">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Thêm sinh viên</h4>
                        </div>
                        <div class="modal-body">
                            {{--  Form thêm sinh viên  --}}
                            <form action="{{ route('AddSV') }}" method="POST" id="form_sinhvien">
                                {{--  Phần mã xác thực form của laravel  --}}
								{{ csrf_field() }}

                                <div class="form-group">
									<label for="">Mã số sinh viên:</label>
									<input type="text" name="mssv" id="mssv" class="form-control" placeholder="mã số sinh viên">
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
									<label for="">Chuyên ngành:</label>
                                    <input type="hidden" name="chnganh" id="chnganh">
									<select class="form-control" id="chonchnganh" name="chonchnganh">
                                    </select>
								</div>

                                <div class="form-group">
									<label for="">Lớp:</label>
                                    <input type="hidden" name="lop" id="lop">
                                    <select class="form-control" id="chonlop" name="chonlop">
                                        @foreach ($lops as $lop)
                                            <?php
                                                echo "<option value='". $lop->KYHIEULOP ."'>". $lop->KYHIEULOP ."</option>";
                                            ?>
                                        @endforeach
                                    </select>
								</div>

                                <div class="form-group">
									<label for="">Khóa học:</label>
                                    <input type="hidden" name="khoahoc" id="khoahoc">
                                    <select class="form-control" id="chonkhoahoc" name="chonkhoahoc">
                                        @foreach ($khoahocs as $khoahoc)
                                            <?php
                                                echo "<option value='". $khoahoc->KHOAHOC ."'>". $khoahoc->KHOAHOC ."</option>";
                                            ?>
                                        @endforeach
                                    </select>
								</div>

								<button type="button" class="btn btn-primary" data-dismiss="modal">
									<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
									Hủy
								</button>

								<button type="submit" class="btn btn-primary">
									<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
									Thêm sinh viên
								</button>
							</form>
                        </div>
                    </div>
                </div>
            </div>

            <a class="btn btn-default" style="background-color: #001a66; color: white">
                <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                Thêm sinh viên từ excel
            </a>
        </div>
    </div>

    {{--  Hiển thị danh sách sinh viên  --}}
    <div class="table-responsive">
        <table class="table table-hover table-bordered" style="background-color: white">
            <thead>
                <tr>
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>Khoa</th>
                    <th>Ngành</th>
                    <th>Lớp</th>
                    <th>Khóa học</th>
                    <th>Mã RFID</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{--  Nếu danh sách sinh viên rỗng  --}}
                @if (count($sinhviens) == 0)
                    {{--  Phần nội dung không có sinh viên  --}}
                    <tr>
                        <th colspan="8" class="text-center"><i>Danh sách rỗng.</i></th>
                    </tr>
                @else
                    {{--  Phần nội dung khi có sinh viên  --}}
                    @foreach ($sinhviens as $sv)
                    <tr>
                        <td>{{ $sv->MSSV }}</td>
                        <td>{{ $sv->HOTEN }}</td>
                        <td>{{ $sv->TENKHOA }}</td>
                        <td>{{ $sv->TENCHNGANH }}</td>
                        <td>{{ $sv->KYHIEULOP }}</td>
                        <td>{{ $sv->KHOAHOC }}</td>
                        <td>
                            234123412431234
                            <button type="button" class="btn btn-warning">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                        <td>
                            <a href="/student_info/{{ $sv->MSSV }}" class="btn btn-success">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                Sửa thông tin
                            </a>
                            
                            <button class="btn btn-danger">
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

    {{--  Hiển thị dãy nút phân trang.  --}}
    @if (count($sinhviens) != 0)
    <center>
        {!! $sinhviens->links() !!}
    </center>
    @endif
@endsection

