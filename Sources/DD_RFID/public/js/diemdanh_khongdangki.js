$(document).ready(function () {

    // Ẩn thông báo lỗi và thông báo thành công.
    $(".thongbao_kdgki_loi").hide();
    $(".thongbao_kdgki_thcong").hide();

    $("#f_dd_kgdgki").submit(function (e) { 
        e.preventDefault();

        // console.log($("#f_dd_kgdgki").serialize());
        $.ajax({
            type: "POST",
            url: "/diemdanh_kgdangki",
            data: $("#f_dd_kgdgki").serialize(),
            success: function (response) {

                $("#machuthe").val("");
                // console.log(response);

                if (response['ketqua'] == 1) {
                    // Ẩn thông báo lỗi.
                    $(".thongbao_kdgki_loi").hide();

                    // Hiện thông báo thành công.
                    $(".thongbao_kdgki_thcong").show();

                    // Đặt nội dung thông báo thành công
                    $('#bao_thcong').text(response['noidung']);

                    // Reload lại trang
                    location.reload();
                }
                else {
                    // Ẩn thông báo thành công.
                    $(".thongbao_kdgki_thcong").hide();

                    // Hiển thị thông báo lỗi.
                    $(".thongbao_kdgki_loi").show();
                
                    // Đặt nội dung thông báo lỗi
                    $('#trung_chu_the').text(response['noidung']);

                    $(".thongbao_kdgki_loi").fadeTo(3000, 500).slideUp(500, function(){
                        $(".thongbao_kdgki_loi").slideUp(500);
                    });
                }
            },
            error: function(xhr,err){
                console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            }
        });
        
    });
});