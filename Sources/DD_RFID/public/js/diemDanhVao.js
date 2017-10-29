$(document).ready(function () {
    $("#sm_ddvao").click(function (e) {
        e.preventDefault();

        // Lấy giá trị mã sự kiện.
        var mask = $("#mask").val();

        // =================================
        // Phần ajax lấy thông tin chủ thẻ.
        // =================================
        $.ajax({
            type: "POST",
            url: "/kiemTraTheDD",
            data: $("#f_quet_the_vao").serialize(),
            success: function (response) {
                var data = JSON.parse(response);

                // Nếu thẻ chưa có thông tin trong hệ thống.
                if (data == null) {
                    console.log("Thẻ chưa có thông tin trong hệ thống");
                } else {

                    // Lấy giá trị chủ thẻ
                    chuthe = data[0];

                    console.log(chuthe);

                    // Khởi tạo các biến lưu trữ mã chủ thẻ và loại chủ thẻ.
                    var machuthe;
                    var loaichuthe;

                    if (chuthe['MSCB']) {
                        machuthe = chuthe['MSCB'];
                        loaichuthe = "canbo";
                    } else {
                        machuthe = chuthe['MSSV'];
                        loaichuthe = "sv";
                    }

                    // =================================
                    // Phần ajax cập nhật danh sách điểm
                    // danh cho chủ thẻ.
                    // =================================
                    $.ajax({
                        type: "POST",
                        url: "/diemdanhvao",
                        data: {
                            machuthe: machuthe,
                            loaichuthe: loaichuthe,
                            masukien: mask,
                            _token: 'xxhzqqdWntUw4jlRsPZ3KrWTHYU4HABVRrVKvCZl'
                        },
                        success: function (response) {
                            console.log(response);
                        },
                        error: function(xhr,err){
                            console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
                        }
                    });
                }

            },
            error: function(xhr,err){
                console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            }
        });

        

        // // Phần ajax xử lý điểm danh vào.
        // $.ajax({
        //     type: 'post',
        //     url: '/diemdanhvao',
        //     data: $("#f_quet_the_vao").serialize(),
        //     success: function (data) {
        //         // var data = JSON.parse(data);
        //         console.log(data);

        //         // Nếu kết quả xử lý thành công.
        //         // if (data['kq'] == 'thanhcong') {
        //         //     console.log(data);
        //         //     hoten = data['hoten'];
        //         //     responsiveVoice.speak(hoten,"Vietnamese Male")
        //         // }
        //         // else {
        //         //     console.log(data);
        //         //     hoten = data['hoten'];
        //         //     responsiveVoice.speak(hoten,"Vietnamese Male");
        //         // }
        //     },
        //     // error: function( jqXhr, textStatus, errorThrown ){
        //     //     console.log( errorThrown );
        //     // },
        //     error: function(xhr,err){
        //         console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
        //     }
        // });
    });
});