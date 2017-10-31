$(document).ready(function () {
    $("#f_dd_kgdgki").submit(function (e) { 
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/diemdanh_kgdangki",
            data: $("#f_dd_kgdgki").serialize(),
            success: function (response) {
                console.log(response);
            },
            error: function(xhr,err){
                console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            }
        });
        
    });
});