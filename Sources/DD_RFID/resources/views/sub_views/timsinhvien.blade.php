{{--  Định nghĩa trang kết quả tìm kiếm sinh viên   --}}
@extends('admin')

@section('title', 'Tìm sinh viên')

@section('timcanbo')

    {{--  Import code tô màu từ khóa sau khi hiển thị kết quả  --}}
    @include('link_views.to_mau_tu_khoa')

    {{--  Tìm kiếm sinh viên  --}}
    <div class="col-xs-12 col-sm-5 col-sm-offset-7">
        <form action="{{ route('FindSV') }}" method="get" class="form-inline pull-right hidden-xs" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm sinh viên:</b>
            <input type="text" class="form-control" name="tukhoa" placeholder="Nhập nội dung tìm kiếm" required
            oninvalid="this.setCustomValidity('Vui lòng nhập từ khóa trước khi tìm')"
            oninput="setCustomValidity('')">
            <button type="submit" class="btn btn-info">
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
            <button type="submit" class="btn btn-info">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>
    </div>

    </div> {{--  kết thúc container của trang master  --}}

    <center><h1>Kết quả tìm kiếm sinh viên theo "{{ $tukhoa }}"</h1></center>

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
                        <th colspan="8" class="text-center"><i>Không tìm thấy kết quả</i></th>
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
                            <td>{!! ToMau($sv->MSSV, $tukhoa) !!}</td>
                            <td>{!! ToMau($sv->HOTEN, $tukhoa) !!}</td>
                            <td>{!! ToMau($sv->TENKHOA, $tukhoa) !!}</td>
                            <td>{!! ToMau($sv->TENCHNGANH, $tukhoa) !!}</td>
                            <td>{!! ToMau($sv->KYHIEULOP, $tukhoa) !!}</td>
                            <td>{!! ToMau($sv->KHOAHOC, $tukhoa) !!}</td>
                            <td>
                                @if ($sv->MATHE)
                                    {!! ToMau($sv->MATHE, $tukhoa) !!}
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
                                
                                <button class="btn btn-danger"
                                    onclick="if(window.confirm('Xóa sinh viên này?')){
                                    window.location.replace('<?php echo route("DeleteSV", 
                                    ["mssv" => $sv->MSSV]) ?>');}">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    Xóa
                                </button>
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