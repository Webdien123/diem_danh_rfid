// Script thay đổi form thông tin đăng ký thẻ khi chọn loại chủ thẻ là SV hoặc cán bộ.
$(document).ready(function() {
    $("#dky_sv").fadeIn(0);
    $("#dky_cb").fadeOut(0);
    $( "#chon_cb_sv" ).val("sinh viên");
    $( ".chon_cb_sv" ).val("sinh viên");
    $('#f_new_card input[type=radio]').change(function(){
        
        $( "#chon_cb_sv" ).val( $( this ).val() );
        $( ".chon_cb_sv" ).val( $( this ).val() );
        $( "#ten_doi_tuong" ).text( $( this ).val() );
        if ($("#ten_doi_tuong").text() == "cán bộ") {
            $("#dky_cb").fadeIn(0);
            $("#dky_sv").fadeOut(0);
        } else {
            $("#dky_sv").fadeIn(0);
            $("#dky_cb").fadeOut(0);
        }
    });
});