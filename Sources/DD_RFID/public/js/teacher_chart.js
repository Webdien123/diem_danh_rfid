google.charts.setOnLoadCallback(drawChart3);

function drawChart3() {
    var data = google.visualization.arrayToDataTable([
        ['Loai_diem_danh', 'So_luong'],
        ['Có mặt', parseInt(cb_co_mat)],
        ['Vắng mặt', parseInt(cb_vang_mat)]
    ]);

    var options = {
        title: 'Điểm danh cán bộ',
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

    var chart = new google.visualization.PieChart(document.getElementById('piechart3'));

    chart.draw(data, options);

    function selectHandler3() {
        var selectedItem = chart.getSelection()[0];
        if (selectedItem) {
            var topping = data.getValue(selectedItem.row, 0);
            if(topping == "Có mặt"){
                HienDanhSach("cb_co_mat");
            }
            if(topping == "Vắng mặt"){
                HienDanhSach("cb_vang_mat");
            }
        }
    }
    
    google.visualization.events.addListener(chart, 'select', selectHandler3);
}