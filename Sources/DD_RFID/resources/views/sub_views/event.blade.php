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

    {{--  script validate giá trị input file  --}}
    <script src="{{ asset('js/additional-methods.min.js') }}"></script>

    {{--  Script xử lý validate dữ liệu sự kiện  --}}
    <script src="{{ asset('js/validate_sukien.js') }}"></script>

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
									<input type="text" name="tensk" id="tensk" class="form-control" placeholder="Tên sự kiện">
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

                                <div class="form-group">
									<label>Thời gian điểm danh ra:</label>                                    
                                    <input type="number" name="tgian_ddra" class="form-control" value="10" min="1" step="1">
                                </div>

								<button type="button" class="btn btn-success" data-dismiss="modal">
									<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
									Hủy
								</button>

								<button id="btn_add_sk" type="submit" class="btn btn-success">
									<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
									Thêm sự kiện
								</button>
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                            Thêm danh sách
                        </button>

                        <a class="btn btn-success" href="./download/Mẫu đăng ký sự kiện.xls">
                            <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                            tải file đăng ký mẫu
                        </a>                        
                    </form>

                    <style>
                        .gi-2x{font-size: 2em;}
                        .gi-3x{font-size: 3em;}
                        .gi-4x{font-size: 4em;}
                        .gi-5x{font-size: 5em;}
                    </style>

                    <div id="slow_warning" style="display:none" class="text-center">
                        {{--  Gọi code thực hiện xoay icon Đang điểm danh  --}}
                        @include('link_views.rotation_icon')

                        <h3 class="text-info">
                            <span class="glyphicon glyphicon-refresh gly-spin gi-2x"></span>
                            Đang import, vui lòng chờ.
                        </h3>
                    </div>

                    <script>
                        $("#f-dangky-sk").submit(function (e) {
                            if ($("#f-dangky-sk").valid()) {
                                $("#slow_warning").show(); 
                            } else {
                                $("#slow_warning").hide();
                            }
                        });
                    </script>
                    
                </div>
            </div>
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
                        <td>{{ date("d-m-Y", strtotime($sk->NGTHUCHIEN)) }}</td>
                        <td>{{ $sk->DIADIEM }}</td>
                        <td>{{ $sk->DDVAO }}</td>
                        <td>{{ $sk->DDRA }} - {{ $sk->TGIANDDRA }} phút</td>

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
                                <a class="btn btn-success" href="/xemDSDangKy/{{ $sk->MASK }}" role="button">
                                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                                    Xem danh sách đăng ký
                                </a>
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

                            {{--  Nếu trạng thái là 4  --}}
                            @if ($sk->MATTHAI == '4')
                                <p class="text-success"><b>Hoàn thành điểm danh</b></p>
                                <a class="btn btn-success" href="/chart_old/{{ $sk->MASK }}" role="button">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                    Xem kết quả
                                </a>
                            @endif


                        </td>
                                           
                        <td>
                            @if ($sk->MATTHAI < '3')
                                <a href="/event_info/{{ $sk->MASK }}" class="btn btn-success">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    Sửa thông tin
                                </a>
                            @endif

                            @if ($sk->MATTHAI != '3')
                            <a class="btn btn-danger"
                                onclick="if(window.confirm('Xóa sự kiện này?')){
                                window.location.replace('<?php echo route("DeleteSK", 
                                ["mssk" => $sk->MASK]) ?>');}">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                Xóa
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{--  Script cập nhật các giá trị tối thiểu cho các trường thời gian khi thay đổi các giá trị  --}}
    <script src="{{ asset('js/update_time.js') }}"></script>

    <script>
        function HienSuKien(mask, tensk) {
            $(".mask_dangki").val(mask);
            $(".tensk_dangki").val(tensk);
        }
    </script>
    
    <script>
        $(document).ready(function () {
            $("#btn_add_sk").click(function (e) { 
                KhoiTaoModelSK();
            });
        });
    </script>

    {{--  Hiển thị dãy nút phân trang.  --}}
    @if (count($sukiens) != 0)
    <center>
        {!! $sukiens->links() !!}
    </center>
    @endif
    
@endsection

