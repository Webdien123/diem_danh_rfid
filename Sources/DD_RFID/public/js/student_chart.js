google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart1);

function drawChart1() {
    var data = google.visualization.arrayToDataTable([
        ['Loai_diem_danh', 'So_luong'],
        ['Có mặt', parseInt(sv_co_mat)],
        ['Vắng mặt', parseInt(sv_vang_mat)],
        ['Có vào không ra', parseInt(sv_co_vao_k_ra)],
        ['Có ra không vào', parseInt(sv_co_ra_k_vao)]
    ]);

    var options = {
        title: 'Điểm danh sinh viên',
        is3D: true,
        chartArea: {
            left: 40,
            top: 40,
            width:"100%",
            height:"100%"
        },
        titleTextStyle: {
            fontSize: 18, // 12, 18 whatever you want (don't specify px)
        },
        tooltip: {
            textStyle: {
                fontSize: 14,
            }
        },
        legend: {
            textStyle: {
                fontSize: 14,
            }
        },
        pieSliceText : 'value-and-percentage'
    };

    var chart= new google.visualization.PieChart(document.getElementById('piechart1'));

    chart.draw(data, options);

    function selectHandler1() {
        var selectedItem = chart.getSelection()[0];
        if (selectedItem) {
            var topping = data.getValue(selectedItem.row, 0);
            if(topping == "Có mặt"){
                $("#sel1").val("sv_co_mat");
                var ten_ds = $('#sel1').find(":selected").text();
                HienDanhSach("sv_co_mat", ten_ds, sv_co_mat);
            }
            if(topping == "Vắng mặt"){
                $("#sel1").val("sv_vang_mat");
                var ten_ds = $('#sel1').find(":selected").text();
                HienDanhSach("sv_vang_mat", ten_ds, sv_vang_mat);
            }
            if(topping == "Có vào không ra"){
                $("#sel1").val("sv_co_v_k_ra");
                var ten_ds = $('#sel1').find(":selected").text();
                HienDanhSach("sv_co_v_k_ra", ten_ds);
            }
            if(topping == "Có ra không vào"){
                $("#sel1").val("sv_co_ra_k_v");
                var ten_ds = $('#sel1').find(":selected").text();
                HienDanhSach("sv_co_ra_k_v", ten_ds);
            }
        }
    }
    
    google.visualization.events.addListener(chart, 'select', selectHandler1);      
}