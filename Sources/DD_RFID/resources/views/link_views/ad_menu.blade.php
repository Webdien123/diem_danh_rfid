{{--  Trang này định nghĩa thanh menu của người quản trị  --}}

<div class="col-xs-12">

    {{--  Chuyển đổi màu thanh menu theo trang con.  --}}
    @if (strpos ($_SERVER['REQUEST_URI'], 'chart'))
        {!! '<div class="panel panel-info">' !!}
    @elseif (strpos ($_SERVER['REQUEST_URI'], 'event'))
        {!! '<div class="panel panel-success">' !!}
    @elseif (strpos ($_SERVER['REQUEST_URI'], 'student'))
        {!! '<div class="panel panel-danger">' !!}
    @else
        {!! '<div class="panel panel-primary">' !!}
    @endif

        {{--  Phần chào mừng người quản trị theo tên tài khoản  --}}
        <div class="panel-heading">
            <h3 class="panel-title">  
                
                <!-- Menu thông báo -->
                <!--  -->
                <!--  -->
                <!--  -->

                <!-- Chào người quản trị bằng tên -->
                <span class="glyphicon glyphicon-dash"></span> Xin chào: Nguyễn Văn A
            </h3>
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
                    <a href="{{ route('home') }}" class="btn btn-default btn-lg btn-block dash-widget" role="button" style="padding:2px;">
                        <div id="box_1"><span class="fa fa-home fa-3x"></span></div>
                        <div id="box_2" class="icon-label">Về trang chủ</div>
                    </a>
                </div>

                {{--  Thao tác đăng xuất  --}}
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                    <a href="#" class="btn btn-warning btn-lg btn-block dash-widget" role="button" style="padding:2px;">
                        <div id="box_1"><span class="fa fa-sign-out fa-3x"></span></div>
                        <div id="box_2" class="icon-label">Đăng xuất</div>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</div>