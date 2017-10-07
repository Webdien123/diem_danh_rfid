
// Script xử lý ẩn hiện phần chức năng import.
$(document).ready(function () {

    // Ẩn chức năng khi vừa load trang.
    $("#import_div").fadeOut(0);

    // Khi click nút import thì hiển thị chức năng lên.
    $("#import_toggle").click(function(){
        $("#import_div").fadeToggle(500);
    });
});