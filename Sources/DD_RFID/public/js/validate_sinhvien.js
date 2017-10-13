$(document).ready(function () {
    
    // Hàm xử lý thông báo và ràng buột khi nhập dữ liệu
    $("#form_sinhvien").validate({
        rules: {
            hoten: {
                required: true,
                maxlength: 50
            },
            mssv:{
                required: true,
                maxlength: 8,
                minlength: 8
            }
        },

        messages: {
            hoten: {
                required: "Chưa nhập họ tên",
                maxlength: "Họ tên tối đa là 50 kí tự"
            },
            mssv: {
                required: "Chưa nhập mã số sinh viên",
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

    $( "#f_import_sv" ).validate({
        rules: {
            im_file: {
                required: true,
                extension: "xls|xlsx|csv"
            }
        },

        messages: {
            im_file: {
                required: "Chưa chọn file cần import",
                extension: "file phải có định dạng xls, xlsx hoặc csv"
            }
        },

        errorPlacement: function (error, element) {
            error.attr("color", "red");
            error.addClass("help-block");
            error.insertBefore(element);
        }
    });
});