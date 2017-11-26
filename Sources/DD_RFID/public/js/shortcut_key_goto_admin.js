// script xử lý bật trang quản trị khi bấm ctrl + click
$(document).ready(function() {

    $(document).bind('click', function(e) {
        if (e.ctrlKey){
            e.preventDefault(); 
            window.open('/login','_blank');
        }
    });
});