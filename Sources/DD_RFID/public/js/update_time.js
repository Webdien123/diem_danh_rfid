$(document).ready(function () {
    // Xử lý mỗi khi model thêm sự kiện hiển thị.
    $("#ngthuchien").change(function (e) { 
        var ngth = $("#ngthuchien").val();
        if (ngth > today){
            time = "07:00";
            $('#ddvao').val(time);
            $('#ddra').val(time);
        }
        else{
            // Tính giờ hiện tại gán vào id 'ddvao'
            var d = new Date(),        
            h = d.getHours(),
            m = d.getMinutes();
            if(h < 10) h = '0' + h; 
            if(m < 10) m = '0' + m; 
            time = h + ':' + m;
            $('#ddvao').val(time);
            $('#ddra').val(time);
        }
    });                     
});