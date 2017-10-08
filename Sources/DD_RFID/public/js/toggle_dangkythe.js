
// Script xử lý ẩn hiện phần đăng ký thẻ mới hoặc
// cập nhật thẻ cũ cho giao diện đăng ký thẻ.
$(document).ready(function () {

    // Ẩn hai phần nội dung cho thẻ cũ và thẻ mới.
    $("#themoi_div").fadeOut(0);
    $("#thecu_div").fadeOut(0);

    // Khi click nút thẻ mới thì ẩn phần thẻ cũ
    // hiển thị nội dung phần thẻ mới.
    $("#dkythemoi_btn").click(function(){
        $("#themoi_div").fadeToggle(0);
        $("#thecu_div").fadeOut(0);
    });

    // Khi click nút thẻ cũ thì ẩn phần thẻ mới
    // hiển thị nội dung phần thẻ cũ.
    $("#capnhatthecu_btn").click(function(){
        $("#thecu_div").fadeToggle(0);
        $("#themoi_div").fadeOut(0);
    });
});