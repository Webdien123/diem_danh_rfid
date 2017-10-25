$(document).ready(function () {
    // Tính ngày hiện tại gán vào id 'ngthuchien'
    $('#ngthuchien').val(today);

    // Tính giờ hiện tại gán vào id 'ddvao'
    $('#ddvao').val(time);
    $('#ddra').val(time);
    $("#ddra").attr("min", $('#ddvao').val());

    function KhoiTaoModelSK() {
        
        // Lấy ngày tự trường 'ngthuchien'.
        var ngth = $("#ngthuchien").val();
        
        // Nếu 'ngthhien' trùng ngày hiện hành.
        if (ngth == today){
    
            // Tính giờ hiện tại gán vào id 'ddvao'
            var d = new Date(),        
            h = d.getHours(),
            m = d.getMinutes();
            if(h < 10) h = '0' + h; 
            if(m < 10) m = '0' + m;
            time = h + ':' + m;
    
            // Đặt giá trị cho 'ddvao' nhỏ nhất là giờ hiện tại.
            $("#ddvao").attr("min", time);
        }
        // Ngược lại không cần giới hạn giá trị cho 'ddvao'
        else{
            $('#ddvao').removeAttr("min");
        }
    }

    $('#modal-themsk').on('shown.bs.modal', function() {
        KhoiTaoModelSK();
    });
});