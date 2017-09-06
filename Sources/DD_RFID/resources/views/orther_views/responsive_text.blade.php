{{--  Trang thử nghiệm điều chính kích thước text theo độ phân giải  --}}

<!DOCTYPE html>
<html>
<head>
	<title>Trang chủ</title>
    @include('link_views.import')
	<script src="{{ asset('public/js/jquery.fittext.js') }}"></script>
</head>
<body>
	<h1 id="abc">Trang chủ</h1>
	<script>
        //call fitText() function for the element you want to be fluid
        $("#abc").fitText();
        //Font-size = 1/10th of the element's width
    </script>
</body>
</html>