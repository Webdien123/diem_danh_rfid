<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trang quản trị</title>
        @include('link_views.import')
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab1default" data-toggle="tab">
                                    <div class="btn btn-info btn-lg btn-block dash-widget">
                                        <div><span class="fa fa-bar-chart fa-3x"></span></div>
                                        <div class="icon-label">Thống kê điểm danh</div>
                                    </div>
                                    </a></li>

                                    <li><a href="#tab2default" data-toggle="tab">
                                    <div class="btn btn-success btn-lg btn-block dash-widget">
                                        <div><span class="fa fa-bell-o fa-3x"></span></div>
                                        <div class="icon-label">Sự kiện</div>
                                    </div>
                                    </a></li>

                                    <li><a href="#tab3default" data-toggle="tab">
                                    <div class="btn btn-danger btn-lg btn-block dash-widget">
                                        <div id="box_1"><span class="fa fa-graduation-cap fa-3x"></span></div>
                                        <div id="box_2" class="icon-label">Sinh viên</div>
                                    </div>
                                    </a></li>

                                    <li><a href="#tab4default" data-toggle="tab">
                                    <div class="btn btn-primary btn-lg btn-block dash-widget">
                                        <div id="box_1"><span class="fa fa-users fa-3x"></span></div>
                                        <div id="box_2" class="icon-label">Cán bộ</div>
                                    </div>
                                    </a></li>

                                    <li><a href="{{ route('home') }}" role="button">
                                    <div class="btn btn-default btn-lg btn-block dash-widget">
                                        <div id="box_1"><span class="fa fa-home fa-3x"></span></div>
                                        <div id="box_2" class="icon-label">Về trang chủ</div>
                                    </div>
                                    </a></li>

                                    <li><a href="#tab6default" data-toggle="tab">
                                    <div class="btn btn-warning btn-lg btn-block dash-widget">
                                        <div id="box_1"><span class="fa fa-sign-out fa-3x"></span></div>
                                        <div id="box_2" class="icon-label">Đăng xuất</div>
                                    </div>
                                    </a></li>
                                    
                                </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1default">
                                    @include('sub_views.chart')
                                </div>

                                <div class="tab-pane fade" id="tab2default">
                                    @include('sub_views.event')
                                </div>

                                <div class="tab-pane fade" id="tab3default">
                                    @include('sub_views.student')
                                </div>
                                
                                <div class="tab-pane fade" id="tab4default">
                                    @include('sub_views.staff')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>