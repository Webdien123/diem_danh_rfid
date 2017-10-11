{{--  Định nghĩa trang cán bộ   --}}
@extends('admin')

@section('title', 'Tìm cán bộ')

@section('timcanbo')

    
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
                    <th colspan="8" class="text-center"><i>Không tìm thấy kết quả.</i></th>
                </tr>
                @else
                <!-- Phần nội dung khi có cán bộ -->                   
                    @foreach ($canbos as $canbo)
                        <tr>
                            <td>
                                {!! ToMau($canbo->MSCB, $tukhoa) !!}
                            </td>
                            <td>
                                {!! ToMau($canbo->HOTEN, $tukhoa) !!}
                            </td>
                            <td>
                                {!! ToMau($canbo->TENKHOA, $tukhoa) !!}
                            </td>
                            <td>
                                {!! ToMau($canbo->TENBOMON, $tukhoa) !!}
                            </td>
                            <td>
                                {!! ToMau($canbo->EMAIL, $tukhoa) !!}
                            </td>
                            <td>
                                {!! ToMau($canbo->MATHE, $tukhoa) !!}
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
                    @endforeach           
                @endif
            </tbody>
        </table>
    </div>
    <center>
        {!! $canbos->links() !!}
    </center>
    
@endsection