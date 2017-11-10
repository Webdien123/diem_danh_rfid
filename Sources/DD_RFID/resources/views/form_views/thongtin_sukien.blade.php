@extends('admin')

{{--  Tiêu đề trang  --}}
@section('title', 'Thông tin sự kiện')

{{--  Định nghĩa phần import vào layout cha  --}}
@section('staff_info')

    {{--  Khai báo biến thời gian toàn cục dùng cho validate form  --}}
    <script src="{{ asset('js/get_current_datetime.js') }}"></script>

    {{--  Script xử lý 2 thông báo thành công hoặc thất bại khi cập nhật  --}}
    <script src="{{ asset('js/thong_bao.js') }}"></script>

    {{--  Script import jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script xử lý validate dữ liệu sự kiện  --}}
    <script src="{{ asset('js/validate_sukien.js') }}"></script>

    <center>
        <h1>Trang cập nhật sự kiện</h1>
        <div class="container">
            @if (Session::get('ketqua_up_sk') == 0)
                {{--  Thông báo thành công  --}}
                <div class="alert alert-success alert-dismissable" id="success-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Cập nhật thành công! sự kiện: {{ $sukien[0]->TENSK }}</strong>
                </div>

            @elseif (Session::get('ketqua_up_sk') == 1)
                {{--  Thông báo thất bại  --}}
                <div class="alert alert-danger alert-dismissable" id="error-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Cập nhật thất bại!</strong>, có thể do đường truyền hoặc dữ liệu mới không hợp lệ.
                </div>                
            @endif
        </div>

        <?php
            \Session::put('ketqua_up_sk', 2);
        ?>

    </center>

    {{--  Panel chứa thông tin sự kiện cũ  --}}
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><b>Thông tin sự kiện {{ $sukien[0]->MASK }}</b></h3>
            </div>
            <div class="panel-body">
                {{--  Form cập nhật sự kiện  --}}
                <form action="{{ route('UpdateSK') }}" method="POST" id="form_sukien">
                    {{--  Phần mã xác thực form của laravel  --}}
                    {{ csrf_field() }}

                    <input type="hidden" name="mask" value="{{ $sukien[0]->MASK }}" id="mask">

                    <div class="form-group">
                        <label>Tên sự kiện:</label>
                        <input type="text" name="tensk" value="{{ $sukien[0]->TENSK }}" id="tensk" class="form-control" placeholder="mã số sự kiện">
                    </div>

                    <div class="form-group">
                        <label>Ngày thực hiện:</label>
                        <input type="date" name="ngthuchien" value="{{ $sukien[0]->NGTHUCHIEN }}" id="ngthuchien" class="form-control" required="required" title="Ngày diễn ra sự kiện">
                    </div>

                    <div class="form-group">
                        <label>Địa điểm:</label>
                        <input type="text" name="diadiem" id="diadiem" value="{{ $sukien[0]->DIADIEM }}" class="form-control" placeholder="Nơi diễn ra sự kiện">
                    </div>
                    
                    <div class="form-group">
                        <label>Giờ điểm danh vào:</label>
                        <input type="time" name="ddvao" id="ddvao" value="{{ $sukien[0]->DDVAO }}" class="form-control" required="required" title="Ngày diễn ra sự kiện">
                    </div>

                    <div class="form-group">
                        <label>Giờ điểm danh ra:</label>
                        <input type="time" name="ddra" id="ddra" value="{{ $sukien[0]->DDRA }}" class="form-control" required="required" title="Ngày diễn ra sự kiện">
                    </div>

                    <div class="form-group">
                        <label>Thời gian điểm danh ra:</label>                                    
                        <input type="number" name="tgian_ddra" class="form-control" value="{{ $sukien[0]->TGIANDDRA }}" min="1" step="1">
                    </div>

                    <a href="{{ route('event') }}" class="btn btn-default">
                        <span class="fa fa-arrow-left" aria-hidden="true"></span>
                        Về trang sự kiện
                    </a>

                    <button id="btn_sukien_submit" type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                        Lưu
                    </button>

                    <a class="btn btn-danger"
                        onclick="if(window.confirm('Xóa sự kiện này?')){
                        window.location.replace('<?php echo route("DeleteSK", 
                        ["mssk" => $sukien[0]->MASK]) ?>');}">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        Xóa
                    </a>
                </form>
            </div>
        </div>
    </div>

    {{--  Script cập nhật các giá trị tối thiểu cho các trường thời gian khi thay đổi các giá trị  --}}
    <script src="{{ asset('js/update_time.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#btn_sukien_submit").click(function (e) {
                KhoiTaoModelSK();
            });
        });
    </script>
@endsection