{{--  Định nghĩa trang kết quả tìm kiếm sự kiện   --}}
@extends('admin')

@section('title', 'Tìm sự kiện')

@section('timcanbo')

    {{--  Import script thư viện tô màu từ khóa  --}}
    <script type="text/javascript" src="{{ asset('js/jquery.mark.min.js') }}"></script>

    {{--  Style tô màu phần từ khóa tìm kiếm  --}}
    <link rel="stylesheet" href="{{ asset('css/to_mau_tu_khoa.css') }}">

    {{--  Script tô màu từ khóa  --}}
    <script>
        $(document).ready(function () {
            tk = "{{ $tukhoa }}";
            $(".table-responsive td").mark(tk);
        });
    </script>

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

    {{--  Modal đang ký sự kiện. Hiển thị cho các sự kiện có trạng thái 1  --}}
    <div class="modal fade" id="modal-dangky-sk">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Đăng ký sự kiện</h4>
                </div>
                <div class="modal-body">
                    
                    {{--  Form đăng ký sự kiện  --}}
                    <form enctype="multipart/form-data" action="{{ route('import_file') }}" id="f-dangky-sk" method="POST" role="form">
                        {{ csrf_field() }}

                        <input type="hidden" name="mask_dangki" class="mask_dangki">
                        <input type="hidden" name="tenBang" id="tenBang" value="sukien">

                        <div class="form-group">
                            <label for="">Mã sự kiện:</label>
                            <input type="text" disabled class="form-control mask_dangki">
                        </div>

                        <div class="form-group">
                            <label for="">Tên sự kiện:</label>
                            <input type="text" disabled class="form-control tensk_dangki">
                        </div>

                        <div class="form-group">
                            <label for="">File danh sách:</label>
                            <input type="file" class="form-control" name="im_file" id="im_file">
                        </div>

                        <a class="btn btn-success" href="./download/Mẫu đăng ký sự kiện.xls">
                            <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                            tải file đăng ký mẫu
                        </a>
                    
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                            Thêm danh sách
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

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
                                
                                <a class="btn btn-success" onclick="HienSuKien('{{ $sk->MASK }}', '{{ $sk->TENSK }}')" data-toggle="modal" href='#modal-dangky-sk'>
                                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                                    thêm
                                </a>
                            @endif

                            {{--  Nếu trạng thái là 2  --}}
                            @if ($sk->MATTHAI == '2')
                                <b class="text-success">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    Đã đăng ký
                                <b>
                            @endif

                            {{--  Nếu trạng thái là 3  --}}
                            @if ($sk->MATTHAI == '3')

                                {{--  Gọi code thực hiện xoay icon Đang điểm danh  --}}
                                @include('link_views.rotation_icon')

                                <b class="text-warning">
                                    <span class="glyphicon glyphicon-refresh gly-spin"></span>
                                    Đang điểm danh
                                <b>
                            @endif

                        </td>

                        <th>
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
                        </th>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <script>
        function HienSuKien(mask, tensk) {
            $(".mask_dangki").val(mask);
            $(".tensk_dangki").val(tensk);
        }
    </script>

    {{--  Hiển thị dãy nút phân trang.  --}}
    @if (count($sukiens) != 0)
    <center>
        {!! $sukiens->links() !!}
    </center>
    @endif

@endsection