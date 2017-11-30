$(document).ready(function () {

    // Tính ngày hiện tại gán vào id 'ngthuchien'.
    LayNgay();
    $('#ngthuchien').val(today);

    // Tính giờ hiện tại gán vào id 'ddvao'.
    // LayGio();

    console.log("ddvao = " + $("#ddvao").val());

    while (!$('#ddvao').val()) {
        LayGio();
        $('#ddvao').val(time1);
        $('#ddra').val(time2);
        $("#ddra").attr("min", time2);
        console.log("ddvao = " + $("#ddvao").val());
    }
    console.log("ddvao = " + $("#ddvao").val());
});