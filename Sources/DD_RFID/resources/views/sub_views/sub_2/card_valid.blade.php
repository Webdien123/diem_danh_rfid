{{--  Định nghĩa trang thẻ hợp lệ để đăng ký.  --}}

@extends('sub_views.card')

@section('title', 'Trang đăng ký thẻ')

@section('card_valid')

{{--  Script xử lý khi select danh sách bộ môn hoặc danh sách khoa.  --}}
<script src="{{ asset('js/select_khoa_bomon.js') }}"></script>

{{--  Script xử lý khi select danh sách chuyên ngành, danh sách khoa.
Và các danh sách nằm trên form thêm sinh viên  --}}
<script src="{{ asset('js/select_khoa_chnganh.js') }}"></script>

{{--  Script import jquery validate  --}}
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

{{--  Script xử lý validate dữ liệu cán bộ  --}}
<script src="{{ asset('js/validate_dangkythe.js') }}"></script>

<!-- Phần nội dung hiển thị sau khi quét thẻ chưa đăng ký -->
<div class="row text-center">
    <h3 class="text-success"><i>Mã thẻ hợp lệ. Chọn chế độ đăng ký:</i></h3>
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <button id="dkythemoi_btn" class="btn btn-lg btn-success" data-toggle="tooltip" data-placement="top" title="Dùng khi người đăng ký chưa có thông tin trong hệ thống">
            <i class="fa fa-plus-square fa-2x" aria-hidden="true"></i>
            Tạo đăng ký mới
        </button>

        <button id="capnhatthecu_btn" class="btn btn-lg btn-warning" data-toggle="tooltip" data-placement="top" title="Dùng thay thế mã thẻ cũ.">
            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
            Cập nhật thẻ cũ
        </button>
    </div>

    {{--  Phần đăng ký thông tin mới.  --}}
    <div class="col-xs-12 col-sm-4 col-sm-offset-4" id="themoi_div">

        {{--  Form nhập thông tin đăng ký  --}}
        <form action="{{ route('new_card') }}" id="f_new_card" method="POST" role="form">
            <legend>Thông tin đăng ký</legend>    
            {{ csrf_field() }}
            <input type="hidden" name="chon_cb_sv" id="chon_cb_sv">

            {{--  Phần chọn đối tượng đăng ký thẻ  --}}
            <div class="form-group">
                <label for="">Đăng ký cho:</label>
                <div class="radio-inline">
                    <label><input type="radio" name="rd_sv_cb" id="rd_sv" checked value="sinh viên">
                        <span class="text-danger">
                            <span class="fa fa-graduation-cap fa-2x"></span>
                            Sinh viên
                        </span>
                    </label>
                </div>
                <div class="radio-inline">
                    <label><input type="radio" name="rd_sv_cb" id="rd_cb" value="cán bộ">
                        <span class="text-primary">
                            <span class="fa fa-users fa-2x"></span>
                            Cán bộ
                        </span>
                    </label>
                </div>
            </div>

            {{--  script thay đổi giá trị giao diện theo chủ thẻ được chọn.  --}}
            <script src="{{ asset('js/chuyen_chu_the.js') }}"></script>

            <div class="form-group">
                <label for="">Mã thẻ</label>
                <input type="hidden" name="mathe" value="{{ $mathe }}">
                <input type="text" class="form-control" value="{{ $mathe }}" disabled>
            </div>

            <div class="form-group">
                <label for="">Mã số</label>
                <label id="ten_doi_tuong">sinh viên</label>
                <input type="text" class="form-control" name="maso" placeholder="Mã số chủ thẻ">
            </div>

            <div class="form-group">
                <label for="">Họ tên</label>
                <input type="text" class="form-control" name="hoten" placeholder="Họ tên chủ thẻ">
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

            {{--  Phần nội dung đăng ký riêng cho cán bộ  --}}
            <div id="dky_cb">
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
            </div>

            {{--  Phần nội dung đăng ký riêng cho sinh viên  --}}
            <div id="dky_sv">
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
            </div>
        
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
    </div>

    {{--  Phần cập nhật thẻ cũ  --}}
    <div class="col-xs-12 col-sm-4 col-sm-offset-4" id="thecu_div">
        
        <form action="{{ route('old_card') }}" method="POST" id="f_old_card" role="form">
            <legend>Cập nhật thẻ cũ</legend>
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Mã thẻ mới</label>
                <input type="hidden" name="mathe" value="{{ $mathe }}">
                <input type="hidden" name="trang" value="the">
                <input type="text" class="form-control" value="{{ $mathe }}" disabled>
            </div>
        
            <div class="form-group">
                <label for="">mã số chủ thẻ:</label>
                <input type="text" class="form-control" name="machuthe" placeholder="Mã số cán bộ hoặc sinh viên cần cập nhật thẻ">
            </div>
        
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
        
    </div>

    {{--  Script xử lý ẩn hiện phần đăng ký thẻ.  --}}
    <script src="{{ asset('js/toggle_dangkythe.js') }}"></script> 
</div>   

@endsection