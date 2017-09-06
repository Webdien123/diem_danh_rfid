{{--  Trang thử nghiệm điều chính kích thước text theo độ phân giải  --}}

<!DOCTYPE html>
<html>
<head>
	<title>Trang chủ</title>
    @include('link_views.import')
</head>
<body>
    <script src="{{ asset('js/jquery.fittext.js') }}"></script>
    <div id="responsive_headline">LAKJLKJLADSKJFLSDKJFLSKDJLF</div>
    <script>
        jQuery("#responsive_headline").fitText(2);
    </script>
</body>
</html>