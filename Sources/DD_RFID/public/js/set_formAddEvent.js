$(document).ready(function () {
    // Tính ngày hiện tại gán vào id 'ngthuchien'
    $('#ngthuchien').val(today);

    // Tính giờ hiện tại gán vào id 'ddvao'
    $('#ddvao').val(time);
    $('#ddra').val(time);
    $("#ddra").attr("min", $('#ddvao').val());

    $('#modal-themsk').on('shown.bs.modal', function() {
        KhoiTaoModelSK();
    });
});