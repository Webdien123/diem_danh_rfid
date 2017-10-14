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
    <script src="{{ asset('js/additional-methods.min.js') }}"></script>

    {{--  Script xử lý validate dữ liệu cán bộ  --}}
    <script src="{{ asset('js/validate_sinhvien.js') }}"></script>

    {{--  Script xử lý 2 thông báo thành công hoặc thất bại khi cập nhật  --}}
    <script src="{{ asset('js/thong_bao.js') }}"></script>

    {{--  Tìm kiếm sinh viên  --}}
    <div class="col-xs-12 col-sm-5 col-sm-offset-7">
        <form action="{{ route('FindSV') }}" method="get" class="form-inline pull-right hidden-xs" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm sinh viên:</b>
            <input type="text" class="form-control" name="tukhoa" placeholder="Nhập nội dung tìm kiếm" required
            oninvalid="this.setCustomValidity('Vui lòng nhập từ khóa trước khi tìm')"
            oninput="setCustomValidity('')">
            <button type="submit" class="btn btn-danger">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>

        <form action="{{ route('FindSV') }}" method="get" class="form-inline hidden-sm hidden-md hidden-lg" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm sinh viên:</b>
            <input type="text" class="form-control" name="tukhoa" placeholder="Nhập nội dung tìm kiếm" required
            oninvalid="this.setCustomValidity('Vui lòng nhập từ khóa trước khi tìm')"
            oninput="setCustomValidity('')">
            <button type="submit" class="btn btn-danger">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>
    </div>

    </div> {{--  kết thúc container của trang master  --}}

    {{--  Thông báo cập nhật thẻ  --}}
    <div class="container">
        @if (Session::get('ketqua_capnhatthe') == 0)
            {{--  Thông báo thành công  --}}
            <div class="alert alert-success alert-dismissable" id="success-alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Cập nhật thẻ thành công</strong>
            </div>

        @elseif (Session::get('ketqua_capnhatthe') == 1)
            {{--  Thông báo thất bại  --}}
            <div class="alert alert-danger alert-dismissable" id="error-alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Cập nhật thẻ thất bại vui lòng thử lại</strong>
            </div>
        @endif
    </div>

    {{--  Reset giá trị session để ẩn thông báo đi sau khi đã hiển thi  --}}
    <?php
        \Session::put('ketqua_capnhatthe', 2);
    ?>

    {{--  Hiển thị tiêu đề và các nút thêm sinh viên  --}}
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

            {{--  Nút ấn hiện chức năng import sinh viên từ excel.  --}}
            <button id="import_toggle" class="btn btn-default">
                Thêm sinh viên từ excel
            </button>

            {{--  Phần kích hoạt chức năng import sinh viên.  --}}
            <div id="import_div">
                <form enctype="multipart/form-data" id="f_import_sv" action="{{ route('import_file') }}" method="POST" class="pull-left form-inline" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="tenBang" id="tenBang" value="sinhvien">
                    <input type="file" class="form-control" name="im_file" id="im_file">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        Thêm
                    </button>
                </form>

                <form action="{{ route('download_file') }}" method="POST" class="pull-left form-inline" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="sr-only" for="">label</label>
                        <input type="hidden" class="form-control" name="down_file" value="./download/sinhvien.xlsx">
                    </div>
                    <button type="submit" class="btn btn-danger">
                        <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                        Tải file import mẫu
                    </button>
                </form>
            </div>

            {{--  Script xử lý ẩn hiện phần import sinh viên.  --}}
            <script src="{{ asset('js/toggle_import.js') }}"></script>  
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

                    {{--  Model cập nhật thẻ cũ  --}}
                    <div class="modal fade" id="modal-updatethe">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Cập nhật mã thẻ</h4>
                                </div>
                                <div class="modal-body">

                                    {{--  Form cập nhật thẻ cũ  --}}
                                    <form action="{{ route('old_card') }}" method="POST" id="f_old_card" role="form">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="">mã số chủ thẻ:</label>
                                            <input type="hidden" class="machuthe" name="machuthe">
                                            <input type="text" class="form-control machuthe" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Mã thẻ mới:</label>
                                            <input type="hidden" name="trang" value="sinhvien">
                                            <input type="text" autofocus required name="mathe" id="mathemoi" class="form-control" placeholder="Mã thẻ mới">
                                        </div>
                                    
                                        <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"tabindex="-1" />
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                    
                                </div>
                            </div>
                        </div>
                    </div>

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
                                @if ($sv->MATHE)
                                    {{ $sv->MATHE }}
                                    {{--  Nút cập nhật mã thẻ cũ  --}}
                                    <button onclick="HienMaSo('{{ $sv->MSSV }}')" class="btn btn-success" data-toggle="modal" href='#modal-updatethe' data-toggle="tooltip" data-placement="top" title="Cập nhật thẻ mới">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                @else
                                    {!! "<b><i>Chưa đăng ký<i><b>" !!}
                                    {{--  Nút cập nhật mã thẻ mới  --}}
                                    <button onclick="HienMaSo('{{ $sv->MSSV }}')" class="btn btn-primary" data-toggle="modal" href='#modal-updatethe' data-toggle="tooltip" data-placement="top" title="Đăng ký thẻ">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                @endif
                            </td>
                            <td>
                                <a href="/student_info/{{ $sv->MSSV }}" class="btn btn-success">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    Sửa thông tin
                                </a>
                                
                                <a class="btn btn-danger"
                                    onclick="if(window.confirm('Xóa sinh viên này?')){
                                    window.location.replace('<?php echo route("DeleteSV", 
                                    ["mssv" => $sv->MSSV]) ?>');}">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    {{--  Script điền mã cán bộ vào form cập nhật thẻ cũ  --}}
                    <script>
                        function HienMaSo(maso) {
                            $('.machuthe').val(maso);
                            
                            // forcus lại thẻ input khi click nút cập nhật thẻ
                            $('#modal-updatethe').on('shown.bs.modal', function() {
                                $("#mathemoi").focus();
                            });
                        }
                    </script>

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

