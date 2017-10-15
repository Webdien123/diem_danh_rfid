$(document).ready(function () {
    // Hàm xử lý thông báo và ràng buột khi nhập dữ liệu
    $("#form_sukien").validate({
        rules: {
            tensk: {
                required: true,
                maxlength: 50
            },
            diadiem:{
                required: true,
                maxlength: 150
            },
            ngthuchien:{
                min: today
            },
            ddvao:{
                min: time
            },
            ddra:{
                min: time
            }
        },

        messages: {
            tensk: {
                required: "Chưa nhập tên sự kiện",
                maxlength: "Tên sự kiện tối đa là 50 kí tự"
            },
            diadiem: {
                required: "Chưa nhập địa điểm",
                maxlength: "Địa điểm tối đa 150 ký tự"
            },
            ngthuchien:{
                min: "Ngày tạo sự kiện phải từ ngày hiện tại trở đi"
            },
            ddvao:{
                min: "Giờ bắt đầu phải từ giờ hiện tại trở đi"
            },
            ddra:{
                min: "Giờ kết thúc phải từ giờ hiện tại trở đi"
            }
        },

        errorPlacement: function (error, element) {
            error.attr("color", "red");
            error.addClass("help-block");
            error.insertAfter(element);
        },

        errorClass: "has-error",
        validClass: "has-success",
        highlight: function(element,errorClass,validClass){
            $(element).parent(".form-group").addClass(errorClass).removeClass(validClass);   
        },
                    
        unhighlight: function(element, errorClass, validClass) {
            $(element).parent(".form-group").removeClass(errorClass).addClass(validClass); 
        }

    });

    // $( "#f_import_sv" ).validate({
    //     rules: {
    //         im_file: {
    //             required: true,
    //             extension: "xls|xlsx|csv"
    //         }
    //     },

    //     messages: {
    //         im_file: {
    //             required: "Chưa chọn file cần import",
    //             extension: "file phải có định dạng xls, xlsx hoặc csv"
    //         }
    //     },

    //     errorPlacement: function (error, element) {
    //         error.attr("color", "red");
    //         error.addClass("help-block");
    //         error.insertBefore(element);
    //     }
    // });
});