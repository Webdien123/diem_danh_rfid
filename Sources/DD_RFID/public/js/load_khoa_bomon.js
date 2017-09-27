// Script xử lý việc chọn khoa và bộ môn.
$( document ).ready(function() {
    console.log('bien thong tin = ' + thongtin_bm);
    console.log('bien lan dau = ' + lan_dau);

    // Xử lý lấy danh sách bộ môn khi chọn khoa.
    $("#chonkhoa").change(function () {        
        var khoa = "";

        // Khi select chọn khoa được click
        // thì lấy nội dung option đã chọn gán vào trường input 'khoa'
        // để gửi request đi.
        $("#chonkhoa option:selected").each(function() {
            khoa = $(this).text();
            $("#khoa").val(khoa);
            console.log('Tên khoa đã chọn: ' + $('#khoa').val());
        });

        // ==================================================================
        // AJAX==============================================================
        // ==================================================================

        // Phần ajax xử lý lấy danh sác chuyên ngành.
        $.ajax({
            /* Đường dẫn kèm tham số cần truy vấn */
            url: '/getBoMon/' + khoa,

            // Dang method
            type: 'GET',

            /* Nhận dữ liệu kết quả theo dạng json */
            dataType: 'JSON',

            /* Xử lý biến data chưa dữ liệu khi xử lý thành công */
            success: function (data) {

                // Xóa danh sách lựa chọn cũ.
                $("#chonbomon option").remove();

                // Lấy select cần thêm dữ liệu.
                var mySelect = $('#chonbomon');

                // Xét qua từng dòng dữ liệu, thêm vào danh sách theo thẻ option.
                $.each(data, function(key, value) {
                    $('#chonbomon')
                        .append($("<option></option>")
                        .attr("value",value.TENBOMON)
                        .text(value.TENBOMON)
                    );
                });                

                $('[name=chonbomon] option').filter(function() { 
                    if (lan_dau == true) {
                        lan_dau = false;
                    }
                    else{
                        thongtin_bm = data[0].TENBOMON;
                    }
                    return ($(this).text() == thongtin_bm);
                }).prop('selected', true);

                $('#bomon').val(thongtin_bm);

                console.log( 'Tên bộ môn đã chọn: ' + $('#bomon').val());
            },
            error: function(xhr, textStatus, errorThrown){
                console.log(xhr.responseText);
            }
        }); 
    }).change();
        
    // Xử lý khi bấm chọn bộ môn.
    $("#chonbomon").change(function () {
        var bomon = "";

        // Khi select chọn bộ môn được click
        // thì lấy nội dung option đã chọn gán vào trường input 'bomon'
        // để gửi request đi.
        $("#chonbomon option:selected").each(function() {
            bomon = $(this).text();           
            $("#bomon").val(bomon);
        });
        console.log( 'Tên bộ môn đã chọn: ' + $('#bomon').val());
    }).change();
});