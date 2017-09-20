google.charts.setOnLoadCallback(drawChart3);

function drawChart3() {
    data = google.visualization.arrayToDataTable([
        ['Loai_diem_danh', 'So_luong'],
        ['Có mặt', 38],
        ['Vắng mặt', 12]
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

    function selectHandler() {
        var selectedItem = chart.getSelection()[0];
        if (selectedItem) {
        var topping = data.getValue(selectedItem.row, 0);
        alert('The user selected: cán bộ ' + topping);
        }
    }
    
    google.visualization.events.addListener(chart, 'select', selectHandler);      
}