{{--  Định nghĩa trang thẻ hợp lệ để đăng ký.  --}}

@extends('sub_views.card')

@section('title', 'Trang đăng ký thẻ')

@section('card_invalid')

<!-- Phần nội dung hiển thị sau khi quét thẻ đã sử dụng -->
<div class="row text-center" style="margin-top: 2%">
    <h3 class="text-danger"><i>Thẻ đã đăng ký, vui lòng sử dụng thẻ khác:</i></h3>
    <div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                        <h3 class="panel-title"><b>Thông tin chủ thẻ</b></h3>
                </div>
                <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ $loaithe }}
                                        </th>
                                        <th>
                                            {{ $chuthe[0]->HOTEN }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Mã số</th>
                                        <th>
                                            {{ $chuthe[0]->MSCB }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Khoa</th>
                                        <th>
                                            {{ $chuthe[0]->TENKHOA }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Ngành</th>
                                        <th>
                                            {{ $chuthe[0]->TENBOMON }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                </div>
            </div>
    </div>                
</div>

@endsection