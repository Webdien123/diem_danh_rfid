
// Script thực hiện việc lấy các bộ môn thuộc tên khoa biết trước.
$( document ).ready(function() {
    $("#chonkhoa").change(function () {
        var khoa = "";
        $( "select option:selected" ).each(function() {
            khoa += $( this ).text() + " ";
            console.log('Tên khoa đã chọn: ' + khoa);
            $("#khoa").val(khoa);
        });

        $.ajax({
            /* Đường dẫn kèm tham số cần truy vấn */
            url: '/getBoMon/' + khoa,

            // Dang method
            type: 'GET',

            /* Nhận dữ liệu kết quả theo dạng json */
            dataType: 'JSON',

            /* Xử lý biến data chưa dữ liệu khi xử lý thành công */
            success: function (data) { 
                data.forEach(function(element) {
                    console.log('Data lấy được: ' + element.TENBOMON);
                }, this);
                // $("#tenkhoa").val(data);
                // $("#khoa").val(data);
            },
            error: function(xhr, textStatus, errorThrown){
                console.log(xhr.responseText);
                // $("#tenkhoa").val("");
                // $("#khoa").val("");
            }
        }); 
    }).change();
});