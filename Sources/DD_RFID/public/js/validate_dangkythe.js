$(document).ready(function () {
    
    // Hàm xử lý thông báo và ràng buột khi nhập dữ liệu cho thông tin mới.
    $("#f_new_card").validate({
        rules: {
            maso:{
                required: true,
                maxlength: 8,
                minlength: 8
            },
            hoten:{
                required: true,
                maxlength: 50
            },
            email:{
                required: true,
                email: true,
                maxlength: 50
            }
        },

        messages: {
            maso: {
                required: "Chưa nhập mã số cán bộ",
                maxlength: "Mã số tối đa là 8 kí tự",
                minlength: "Mã số phải đủ 8 kí tự"
            },
            hoten: {
                required: "Chưa nhập họ tên",
                maxlength: "Họ tên tối đa là 50 kí tự"
            },
            email:{
                required: "Chưa nhập email",
                email: "Địa chỉ email không đúng định dạng",
                maxlength: "Email tối đa 50 kí tự"
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

    // Hàm xử lý thông báo và ràng buột khi nhập dữ liệu cho thông tin cũ.
    $("#f_old_card").validate({
        rules: {
            machuthe:{
                required: true,
                maxlength: 8,
                minlength: 8
            }
        },

        messages: {
            machuthe: {
                required: "Chưa nhập mã số cán bộ",
                maxlength: "Mã số tối đa là 8 kí tự",
                minlength: "Mã số phải đủ 8 kí tự"
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
});