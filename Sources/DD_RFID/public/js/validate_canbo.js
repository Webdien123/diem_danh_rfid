$(document).ready(function () {

    // $("#success-alert").fadeTo(1100, 500).slideUp(500, function(){
    //     $("#success-alert").slideUp(500);
    // });

    // $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
    //     $("#success-alert").slideUp(500);
    // });

    // Hàm xử lý thông báo và ràng buột khi nhập dữ liệu
    $("#form_canbo").validate({
        rules: {
            hoten: {
                required: true,
                maxlength: 50
            },
            mscb:{
                required: true,
                maxlength: 8,
                minlength: 8
            },
            email:{
                required: true,
                email: 8
            }
        },

        messages: {
            hoten: {
                required: "Chưa nhập họ tên",
                maxlength: "Họ tên tối đa là 50 kí tự"
            },
            mscb: {
                required: "Chưa nhập mã số cán bộ",
                maxlength: "Mã số tối đa là 8 kí tự",
                minlength: "Mã số phải đủ 8 kí tự"
            },
            email:{
                required: "Chưa nhập email",
                email: "Địa chỉ email không đúng định dạng"
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