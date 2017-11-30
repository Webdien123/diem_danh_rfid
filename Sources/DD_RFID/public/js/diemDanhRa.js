
// Script xử lý điểm danh vào.
$(document).ready(function () {
    
        // Ẩn tất cả thông báo điểm danh.
        $(".thongbao").hide();
    
        // Lấy mã số chủ thẻ.
        var machuthe = "";
    
        // Khi quét thẻ cần điểm danh
        $("#sm_ddra").click(function (e) {
            e.preventDefault();

            // Ẩn thông báo lỗi và thông báo thành công của chức năng điểm danh không đăng ký.
            $(".thongbao_kdgki_loi").hide();
            $(".thongbao_kdgki_thcong").hide();
    
            // Lấy giá trị mã sự kiện.
            var mask = $("#mask").val();
    
            // Mã thẻ đã quét.
            var mathe = $("#id_the").val();

            noidung = "Nhận thẻ " + mathe + " điểm danh ra";
            log_type = "suKien[" + mask + "]";
    
            $.ajax({
                type: "GET",
                url: "/ghiLog/"+noidung+"/"+log_type,
                success: function (response) {                
                    console.log(response);
                },
                error: function(xhr,err){
                    console.log("Ghi log thất bại");
                    console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
                }
            });
    
            // Lấy giá trị token để xác thực.
            var token = $('input[name=_token]').val();
    
            // =================================
            // Phần ajax lấy thông tin chủ thẻ.
            // =================================
            $.ajax({
                type: "POST",
                url: "/kiemTraTheDD",
                data: $("#f_quet_the_ra").serialize(),
                success: function (response) {
                    var data = JSON.parse(response);                    
    
                    // Nếu thẻ chưa có thông tin trong hệ thống.
                    if (data == null) {
    
                        // Tạo thông báo số 5
                        TaoThongBao(5, "", "");
    
                        // Reset giá trị khung quét thẻ
                        $('#id_the').val("");
                        $('#id_the').focus();
    
                        $('.the').val(mathe);
                    }
                    else {
    
                        // Lấy giá trị chủ thẻ
                        chuthe = data[0];
    
                        // Khởi tạo các biến lưu trữ mã chủ thẻ, loại chủ thẻ và họ tên chủ thẻ.
                        var loaichuthe;
                        var hotenchuthe;
    
                        if (chuthe['MSCB']) {
                            machuthe = chuthe['MSCB'];
                            loaichuthe = "cán bộ";
                        } else {
                            machuthe = chuthe['MSSV'];
                            loaichuthe = "sinh viên";
                        }
                        hotenchuthe = chuthe['HOTEN'];
    
                        // console.log(machuthe+"\n"+loaichuthe+"\n"+mask+"\n"+hotenchuthe+"\n"+token);

                        // =================================
                        // Phần ajax cập nhật danh sách điểm
                        // danh cho chủ thẻ.
                        // =================================
                        $.ajax({
                            type: "POST",
                            url: "/diemdanhra",
                            data: {
                                mathe: mathe,
                                machuthe: machuthe,
                                loaichuthe: loaichuthe,
                                masukien: mask,
                                hotenchuthe: hotenchuthe,
                                _token: token
                            },
                            success: function (response) {
                                $('#id_the').val("");
                                $('#id_the').focus();
    
                                ms_ketqua = response['ms_ketqua'];
                                loaichuthe = response['loaichuthe'];
    
                                // Nếu họ tên chủ thẻ đã có thì giữ lại
                                // ngược lại tạo rỗng để bộ độc không đọc
                                // 2 dấu gạch nối làm tên.
                                if (response['hoten'] != "--") {
                                    hoten = response['hoten'];    
                                } else {
                                    hoten = "";
                                }
    
                                // Hiển thị thông báo tương ứng kết quả xử lý
                                TaoThongBao(ms_ketqua, loaichuthe, hoten);
    
                                if (hoten != "") {
                                    // Đọc tên chủ thẻ
                                    responsiveVoice.speak(hoten,"Vietnamese Male");
                                }
                            },
                            error: function(xhr,err){
                                $('#id_the').val("");
                                $('#id_the').focus();
                                console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
                            }
                        });
                    }
                },
                error: function(xhr,err){
                    $('#id_the').val("");
                    $('#id_the').focus();
                    console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
                }
            });
        });
    
        function TaoThongBao(ms_ketqua, loaichuthe, hoten) {
    
            // Ẩn tất cả thông báo điểm danh.
            $(".thongbao").hide();
    
            // Tạo lớp chứa thông báo kết quả tương ứng
            // và hiển thị lên.
            var tb = "#tb_" + ms_ketqua;
            $(tb).show();
    
            // hiển thị loại chủ thẻ và họ tên chủ thẻ.
            $(".loaichuthe").text(loaichuthe);
            
            if (hoten != "") {
                $(".hoten").text(hoten);
            } else {
                $(".hoten").html("<i><u>" + machuthe + "</u></i>");
            }
            
        }
    });