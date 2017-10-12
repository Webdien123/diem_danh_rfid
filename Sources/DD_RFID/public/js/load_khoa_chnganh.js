// Script xử lý việc chọn khoa và bộ môn.
$( document ).ready(function() {

    // Xử lý lấy danh sách bộ môn khi chọn khoa.
    $("#chonkhoa").change(function () {        
        var khoa = "";

        // Khi select chọn khoa được click
        // thì lấy nội dung option đã chọn gán vào trường input 'khoa'
        // để gửi request đi.
        $("#chonkhoa option:selected").each(function() {
            khoa = $(this).text();
            $("#khoa").val(khoa);
        });

        // ==================================================================
        // AJAX==============================================================
        // ==================================================================

        // Phần ajax xử lý lấy danh sác chuyên ngành.
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
                
                // Lấy select cần thêm dữ liệu.
                var mySelect = $('#chonchnganh');

                console.log(data);

                // Xét qua từng dòng dữ liệu, thêm vào danh sách theo thẻ option.
                $.each(data, function(key, value) {
                    $('#chonchnganh')
                        .append($("<option></option>")
                        .attr("value",value.TENCHNGANH)
                        .text(value.TENCHNGANH)
                    );
                });             

                // Đặt giá trị tên bộ môn theo giá trị đã có của cán bộ.
                $('[name=chonchnganh] option').filter(function() { 
                    return ($(this).text() == chnganh);
                }).prop('selected', true);

                // Đặt giá trị cho input ẩn chứa bộ môn cần gửi đi để cập nhật.
                $('#chnganh').val(chnganh);

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