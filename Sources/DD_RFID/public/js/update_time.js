$(document).ready(function () {

    // Xử lý mỗi khi model thêm sự kiện hiển thị.
    $("#ngthuchien").change(function (e) { 
        var ngth = $("#ngthuchien").val();
        if (ngth == today){

            // Tính giờ hiện tại gán vào id 'ddvao'
            var d = new Date(),        
            h = d.getHours(),
            m = d.getMinutes();
            if(h < 10) h = '0' + h; 
            if(m < 10) m = '0' + m; 
            time = h + ':' + m;

            $("#ddvao").attr("min", time);
        }
        else{
            $('#ddvao').removeAttr("min");
        }
    });

    // Thay đổi giá trị ràng buột cho giờ điểm danh ra khi
    // cập nhật giờ điểm danh vào.
    $("#ddvao").change(function (e) { 
        $("#ddra").attr("min", $('#ddvao').val());
    });
});