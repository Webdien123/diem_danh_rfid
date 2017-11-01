{{--  Định nghĩa trang kết quả tìm kiếm cán bộ   --}}
@extends('admin')

@section('title', 'Tìm cán bộ')

@section('timcanbo')

    {{--  Import code tô màu từ khóa sau khi hiển thị kết quả  --}}
    @include('link_views.to_mau_tu_khoa')

    {{--  Tìm kiếm cán bộ  --}}
    <div class="col-xs-12 col-sm-4 col-sm-offset-8">
        <form action="{{ route('FindCB') }}" method="get" class="form-inline pull-right hidden-xs" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm cán bộ:</b>
            <input type="text" class="form-control" name="tukhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>

        <form action="{{ route('FindCB') }}" method="get" class="form-inline hidden-sm hidden-md hidden-lg" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm cán bộ:</b>
            <input type="text" class="form-control" name="tukhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>
    </div>

    </div> {{--  kết thúc container của trang master  --}}

    <center><h1>Kết quả tìm kiếm cán bộ theo "{{ $tukhoa }}"</h1></center>

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
                                            <input type="hidden" name="trang" value="canbo">
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

                    {{--  Phần nội dung khi có cán bộ  --}}
                    @foreach ($canbos as $canbo)
                        <tr>
                            <td>{!! ToMau($canbo->MSCB, $tukhoa) !!}</td>
                            <td>{!! ToMau($canbo->HOTEN, $tukhoa) !!}</td>
                            <td>{!! ToMau($canbo->TENKHOA, $tukhoa) !!}</td>
                            <td>{!! ToMau($canbo->TENBOMON, $tukhoa) !!}</td>
                            <td>{!! ToMau($canbo->EMAIL, $tukhoa) !!}</td>
                            <td>
                                @if ($canbo->MATHE)
                                    {!! ToMau($canbo->MATHE, $tukhoa) !!}
                                    {{--  Nút cập nhật mã thẻ cũ  --}}
                                    <button onclick="HienMaSo('{{ $canbo->MSCB }}')" class="btn btn-success" data-toggle="modal" href='#modal-updatethe' data-toggle="tooltip" data-placement="top" title="Cập nhật thẻ mới">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                @else
                                    {!! "<b><i>Chưa đăng ký<i><b>" !!}
                                    {{--  Nút cập nhật mã thẻ mới  --}}
                                    <button onclick="HienMaSo('{{ $canbo->MSCB }}')" class="btn btn-primary" data-toggle="modal" href='#modal-updatethe' data-toggle="tooltip" data-placement="top" title="Đăng ký thẻ">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                @endif

                                
                            </td>
                            <td>
                                <a href="/staff_info/{{ $canbo->MSCB }}" class="btn btn-success">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    Sửa thông tin
                                </a>
                                
                                <button class="btn btn-danger"
                                    onclick="if(window.confirm('Xóa cán bộ này?')){
                                    window.location.replace('<?php echo route("DeleteCB", 
                                    ["mscb" => $canbo->MSCB]) ?>');}">
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
    @if (count($canbos) != 0)
    <center>
        {!! $canbos->links() !!}
    </center>
    @endif

    
@endsection