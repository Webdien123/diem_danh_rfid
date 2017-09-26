{{--  Định nghĩa trang thông tin cán bộ  --}}
@extends('admin')

{{--  Tiêu đề trang  --}}
@section('title', 'Thông tin cán bộ')

{{--  Định nghĩa phần import vào layout cha  --}}
@section('staff_info')

    {{--  Script xử lý lấy tên khoa khi có tên bộ môn  --}}
    <script src="{{ asset('js/laytenkhoa.js') }}"></script>

    {{--  Script inport jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script xử lý validate dữ liệu cán bộ  --}}
    <script src="{{ asset('js/validate_canbo.js') }}"></script>

    <center>
        <h1>Trang cập nhật cán bộ</h1>
    </center>
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                      <h3 class="panel-title"><b>Thông tin cán bộ {{ $canbo[0]->MSCB }}</b></h3>
                </div>
                <div class="panel-body">
                  <form action="{{ route('AddCB') }}" method="POST" id="form_canbo">
                      {{--  Phần mã xác thực form của laravel  --}}
                      {{ csrf_field() }}
          
                      <div class="form-group">
                          <label>Mã số cán bộ:</label>
                          <input value="{{ $canbo[0]->MSCB }}" type="text" name="mscb" id="mscb" class="form-control" placeholder="mã số cán bộ">
                      </div>
          
                      <div class="form-group">
                          <label>Họ tên:</label>
                          <input value="{{ $canbo[0]->HOTEN }}" type="text" name="hoten" id="hoten" class="form-control" placeholder="họ tên">
                      </div>								
          
                      <div class="form-group">
                          <label>Bộ môn:</label>
                          <input type="hidden" name="bomon" id="bomon">
                          <select class="form-control" id="chonbomon" name="chonbomon">
                              @foreach ($bomons as $bm)
                                  <?php
                                      echo "<option value='". $bm->TENBOMON ."'>". $bm->TENBOMON ."</option>";
                                  ?>
                              @endforeach
                          </select>
                      </div>

                      <script>                            
                            var bm = "{{ $canbo[0]->TENBOMON }}";
                            console.log(bm);
                            $('chonbomon').val(bm);
                      </script>
          
                      <div class="form-group">
                          <label>Khoa:</label>
                          <input value="{{ $canbo[0]->TENKHOA }}" type="hidden" name="khoa" id="khoa">
                          <input value="{{ $canbo[0]->TENKHOA }}" type="text" id="tenkhoa" class="form-control" placeholder="Tên khoa" disabled>
                      </div>
          
                      <div class="form-group">
                          <label>Email:</label>
                          <input value="{{ $canbo[0]->EMAIL }}" type="email" name="email" id="email" class="form-control" placeholder="Email cán bộ">                                   
                      </div>
          
                      <a href="/staff" class="btn btn-default pull-left">
                          <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                          Hủy
                      </a>
          
                      <button type="submit" class="btn btn-primary pull-left">
                          <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                          Lưu
                      </button>
                  </form>
                </div>
            </div>
        </div>

@endsection