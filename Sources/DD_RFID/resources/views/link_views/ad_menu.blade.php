{{--  Trang này định nghĩa thanh menu của người quản trị  --}}

<div class="col-xs-12">

    {{--  Chuyển đổi màu thanh menu theo trang con.  --}}
    {{--  @if (strpos ($_SERVER['REQUEST_URI'], 'chart'))
        {!! '<div class="panel panel-info">' !!}
    @elseif (strpos ($_SERVER['REQUEST_URI'], 'event'))
        {!! '<div class="panel panel-success">' !!}
    @elseif (strpos ($_SERVER['REQUEST_URI'], 'student'))
        {!! '<div class="panel panel-danger">' !!}
    @elseif (strpos ($_SERVER['REQUEST_URI'], 'staff'))
        {!! '<div class="panel panel-primary">' !!}
    @else
        {!! '<div class="panel panel-default">' !!}
    @endif  --}}
    <div class="panel panel-default">
        {{--  Phần chào mừng người quản trị theo tên tài khoản  --}}
        <div class="panel-heading" style="padding: 0px 15px 0px 15px">
                
                <!-- Menu thông báo -->
                <div class="row">

                    {{--  Phần di chuyển về trang chủ  --}}
                    <div class="pull-left">
                        <a href="{{ route('home') }}" class="btn btn-default">
                            <i class="fa fa-home fa-2x" aria-hidden="true"></i>
                        </a>
                    </div>

                    {{--  Phần tên quản trị và nút thông báo  --}}
                    <div class="pull-right">
                        <span>{!! 'Xin chào: <b>'.Session::get('uname').'</b>' !!}</span>
                        <?php
                            // Chọn time zone.
                            date_default_timezone_set("Asia/Ho_Chi_Minh");

                            // Khởi tạo ngày hiện tại.
                            $date = date("d-m-Y");

                            $file_path = "./logs/";

                            $file_name = "Admin_".$date.".log";
                            
                        ?>     
                        <a href="{{ $file_path.$file_name }}" target="_blank" class="btn btn-default">
                            <i class="fa fa-history fa-2x" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>  
        </div>

        {{--  Phần trình bày các nút liên kết qua các trang con  --}}
        <div class="panel-body">
            <div class="row">

                {{--  Trang thông kê  --}}
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('chart') }}" class="btn btn-info btn-lg btn-block dash-widget" role="button" style="padding:2px;">
                        <div id="box_1"><span class="fa fa-bar-chart fa-3x"></span></div>
                        <div id="box_2" class="icon-label">Thống kê điểm danh</div>
                    </a>
                </div>
                
                {{--  Trang sự kiện  --}}
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('event') }}" class="btn btn-success btn-lg btn-block dash-widget" role="button" style="padding:2px;">
                        <div id="box_1"><span class="fa fa-bell-o fa-3x"></span></div>
                        <div id="box_2" class="icon-label">Sự kiện</div>
                    </a>
                </div>
                
                {{--  Trang sinh viên  --}}
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('student') }}" class="btn btn-danger btn-lg btn-block dash-widget" role="button" style="padding:2px;">
                        <div id="box_1"><span class="fa fa-graduation-cap fa-3x"></span></div>
                        <div id="box_2" class="icon-label">Sinh viên</div>
                    </a>
                </div>
                
                {{--  Trang cán bộ  --}}
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('staff') }}" class="btn btn-primary btn-lg btn-block dash-widget" role="button" style="padding:2px;">
                        <div id="box_1"><span class="fa fa-users fa-3x"></span></div>
                        <div id="box_2" class="icon-label">Cán bộ</div>
                    </a>
                </div>
                
                {{--  Trang chủ  --}}
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('card') }}" class="btn btn-default btn-lg btn-block dash-widget" role="button" style="padding:2px;">
                        <div id="box_1"><span class="fa fa-id-card-o fa-3x"></span></div>
                        <div id="box_2" class="icon-label">Đăng ký thẻ</div>
                    </a>
                </div>

                {{--  Thao tác đăng xuất  --}}
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('logout') }}" class="btn btn-warning btn-lg btn-block dash-widget" role="button" style="padding:2px;">
                        <div id="box_1"><span class="fa fa-sign-out fa-3x"></span></div>
                        <div id="box_2" class="icon-label">Đăng xuất</div>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</div>