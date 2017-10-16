{{--  Định nghĩa trang kết quả tìm kiếm sự kiện   --}}
@extends('admin')

@section('title', 'Tìm sự kiện')

@section('timcanbo')

    {{--  Import code tô màu từ khóa sau khi hiển thị kết quả  --}}
    @include('link_views.to_mau_tu_khoa')

    {{--  Tìm kiếm sự kiện  --}}
    <div class="col-xs-12 col-sm-4 col-sm-offset-8">
        <form action="" method="get" class="form-inline pull-right hidden-xs" role="search">
            {{ csrf_field() }}
            <b>Tìm kiếm sự kiện:</b>
            <input type="text" class="form-control" name="tukhoa" placeholder="Nhập nội dung tìm kiếm" required>
            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                Tìm
            </button>
        </form>

        <form action="" method="get" class="form-inline hidden-sm hidden-md hidden-lg" role="search">
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

    <center><h1>Kết quả tìm kiếm sự kiện theo "{{ $tukhoa }}"</h1></center>

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
                        <th colspan="8" class="text-center"><i>Không tìm thấy kết quả.</i></th>
                    </tr>
                @else
                    {{-- Phần nội dung khi có sự kiện   --}}
                    @foreach ($sukiens as $sk)
                    <tr>
                        <td>{!! ToMau($sk->MASK, $tukhoa) !!}</td>            
                        <td>{!! ToMau($sk->TENSK, $tukhoa) !!}</td>
                        <td>{!! ToMau($sk->NGTHUCHIEN, $tukhoa) !!}</td>
                        <td>{!! ToMau($sk->DIADIEM, $tukhoa) !!}</td>
                        <td>{!! ToMau($sk->DDVAO, $tukhoa) !!}</td>
                        <td>{!! ToMau($sk->DDRA, $tukhoa) !!}</td>
                        <td><center>
                            <i>Chưa Thực hiện.</i>
                        </center></td>                    
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