$(document).ready(function() {
    $('#f_new_card input[type=radio]').change(function(){
        $( "#chon_cb_sv" ).val( $( this ).val() );
        $( "#ten_doi_tuong" ).text( $( this ).val() );
    });
});