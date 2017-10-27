$(document).ready(function () {

    // Xử lý mỗi khi thay đổi ngày của sự kiện.
    // $("#ngthuchien").change(function (e) {

    //     // Lấy Giá trị ngày vừa thay đổi
    //     var ngth = $("#ngthuchien").val();
        
    //     // Cập nhật giá trị ngày hiện tại.
    //     LayNgay();

    //     // Nếu ngày vừa đổi trùng ngày hiện tại.
    //     if (ngth == today){

    //         // Cập nhật thời gian tối thiểu.
    //         LayGio();

    //         $("#ddvao").attr("min", time);
    //     }
    //     else{
    //         $('#ddvao').removeAttr("min");
    //     }
    // });

    $("#ddvao").change(function (e) {
        var T = $("#ddvao").val();
        T = T + ":00";
        T = new Date("1/1/1900 " + T);
        h = T.getHours();
        m2 = T.getMinutes() + 1;
        if(h < 10) h = '0' + h;
        if(m2 < 10) m2 = '0' + m2;
        time2 = h + ':' + m2;
        console.log("Time2 = " + time2);
        $("#ddra").attr("min", time2);
    });
});