$( document ).ready(function() {
    
    $("#success-alert").fadeTo(1500, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });

    $("#error-alert").fadeTo(3000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });
});