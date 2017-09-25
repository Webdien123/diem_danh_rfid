
// File thực hiện việc lấy tên khoa tự động khi đã chọn tên bộ môn.
$( document ).ready(function() {
    $("#chonbomon").change(function () {
        var bomon = "";
        $( "select option:selected" ).each(function() {
            bomon += $( this ).text() + " ";
            console.log(bomon);
            $("#bomon").val(bomon);
        });

        $.ajax({
            /* Đường dẫn kèm tham số cần truy vấn */
            url: '/getKhoa/' + bomon,

            // Dang method
            type: 'GET',

            /* Nhận dữ liệu kết quả theo dạng json */
            dataType: 'JSON',

            /* Xử lý biến data chưa dữ liệu khi xử lý thành công */
            success: function (data) { 
                $("#khoa").val(data);
            },
            error: function(xhr, textStatus, errorThrown){
                console.log(xhr.responseText);
                $("#khoa").val("");
             }
        }); 
    }).change();
});