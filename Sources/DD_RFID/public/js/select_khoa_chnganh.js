// Script xử lý việc chọn khoa, chuyên ngành và các danh sách chọn ở trang sinh viên.
$( document ).ready(function() {
    
    // Nhận giá trị ban đầu cho danh sách ký hiệu lớp và khóa học.
    $("#lop").val($("#chonlop option:first").val());
    $("#khoahoc").val($("#chonkhoahoc option:first").val());

    // Xử lý lấy danh sách chuyên ngành khi chọn khoa.
    $("#chonkhoa").change(function () {        
        var khoa = "";

        // Khi select chọn khoa được click
        // thì lấy nội dung option đã chọn gán vào trường input 'khoa'
        // để gửi request đi.
        $("#chonkhoa option:selected").each(function() {
            khoa = $(this).text();
            $('#khoa').val(khoa);
        });

        // ==================================================================
        // AJAX==============================================================
        // ==================================================================

        // Phần ajax xử lý lấy danh sách chuyên ngành.
        $.ajax({
            /* Đường dẫn kèm tham số cần truy vấn */
            url: '/getChNganh/' + khoa,

            // Dang method
            type: 'GET',

            /* Nhận dữ liệu kết quả theo dạng json */
            dataType: 'JSON',

            /* Xử lý biến data chưa dữ liệu khi xử lý thành công */
            success: function (data) {

                // Xóa danh sách lựa chọn cũ.
                $("#chonchnganh option").remove();

                // Xét qua từng dòng dữ liệu, thêm vào danh sách theo thẻ option.
                $.each(data, function(key, value) {
                    $('#chonchnganh')
                        .append($("<option></option>")
                        .attr("value",value.TENCHNGANH)
                        .text(value.TENCHNGANH)
                    );
                });

                // Tính giá trị ban đầu cho các danh sách chuyên ngành,
                // ký hiệu lớp và khóa học.
                var first = data[0].TENCHNGANH;
                $('#chnganh').val(first);
            },
            error: function(xhr, textStatus, errorThrown){
                console.log(xhr.responseText);
            }
        }); 
    }).change();

    // Xử lý khi bấm chọn chuyên ngành.
    $("#chonchnganh").change(function () {
        var chnganh = "";

        // Khi select chọn chuyên ngành được click
        // thì lấy nội dung option đã chọn gán vào trường input 'chnganh'
        // để gửi request đi.
        $("#chonchnganh option:selected").each(function() {
            chnganh = $(this).text();
            $("#chnganh").val(chnganh);
        });
    }).change();

    // Xử lý khi bấm chọn ký hiệu lớp.
    $("#chonlop").change(function () {
        var lop = "";

        // Khi select chọn ký hiệu lớp được click
        // thì lấy nội dung option đã chọn gán vào trường input 'lop'
        // để gửi request đi.
        $("#chonlop option:selected").each(function() {
            lop = $(this).text();
            $("#lop").val(lop);
        });
    }).change();

    // Xử lý khi bấm chọn khóa học.
    $("#chonkhoahoc").change(function () {
        var khoahoc = "";

        // Khi select chọn khóa học được click
        // thì lấy nội dung option đã chọn gán vào trường input 'khoahoc'
        // để gửi request đi.
        $("#chonkhoahoc option:selected").each(function() {
            khoahoc = $(this).text();
            $("#khoahoc").val(khoahoc);
        });
    }).change();
});    