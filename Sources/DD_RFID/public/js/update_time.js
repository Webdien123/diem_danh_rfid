$(document).ready(function () {
    
        $("#ddvao").change(function (e) {
            var T = $("#ddvao").val();
            T = T + ":00";
            T = new Date("1/1/1900 " + T);
            h = T.getHours();
            m2 = T.getMinutes() + 1;
            if(h < 10) h = '0' + h;
            if(m2 < 10) m2 = '0' + m2;
            time2 = h + ':' + m2;
            console.log("Time2 = " + time2);
            $("#ddra").attr("min", time2);
        });
    });