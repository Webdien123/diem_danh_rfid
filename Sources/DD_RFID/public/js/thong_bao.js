$( document ).ready(function() {
    
    $("#success-alert").fadeTo(1100, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });

    $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });
});