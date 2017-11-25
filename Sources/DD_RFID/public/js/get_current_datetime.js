// Biển toàn cục lưu trữ ngày hiện tại.
var today;

// Biến toàn cục lưu trữ thời gian tối thiếu để điểm danh vào.
var time1;

// Biến toàn cục lưu trữ thời gian tối thiếu để điểm danh ra.
var time2;

// Hàm cập nhật ngày hiện tại cho today.
function LayNgay() {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    today = now.getFullYear()+"-"+(month)+"-"+(day);

    // console.log("today: " + today);
}

// Hàm cập nhật giờ tối thiếu cho time1 và time2.
function LayGio() {
    var date = new Date();
    var currentDate = date.toISOString().slice(0,10);
    time1 = date.getHours() + ':' + (date.getMinutes() + 1);
    time2 = date.getHours() + ':' + (date.getMinutes() + 1);

    // var d = new Date();
    // h = d.getHours();
    // m1 = d.getMinutes() + 1;
    // m2 = d.getMinutes() + 2;
    // if(h < 10) h = '0' + h;
    // if(m1 < 10) m1 = '0' + m1;
    // if(m2 < 10) m2 = '0' + m2;
    // time1 = h + ':' + m1;
    // time2 = h + ':' + m2;

    console.log("time1: " + time1);
    console.log("time2: " + time2);
}

// Gọi hàm lấy ngày hiện tại một lần.
LayNgay();

// Gọi hàm lấy giờ hiện tại một lần.
LayGio();

// Hàm khởi tạo lại giá trị cho các trường thông tin của form sự kiện
function KhoiTaoModelSK() {
    
    // Lấy ngày tự trường 'ngthuchien'.
    var ngth = $("#ngthuchien").val();
    
    // Nếu 'ngthhien' trùng ngày hiện hành.
    if (ngth == today){

        // Tính giờ hiện tại.
        LayGio();

        // Đặt giá trị cho 'ddvao' nhỏ nhất là giờ hiện tại.
        $("#ddvao").attr("min", time1);
    }
    // Ngược lại không cần giới hạn giá trị cho 'ddvao'.
    else{
        $('#ddvao').removeAttr("min");
    }
}