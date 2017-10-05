google.charts.setOnLoadCallback(drawChart4);

function drawChart4() {
    data = google.visualization.arrayToDataTable([
        ['So_bat_thuong', 'So_luong'],
        ['Có vào không ra', 38],
        ['Có ra không vào', 12],
        ['Chưa có thông tin hệ thống', 2]
    ]);

    var options = {
        title: 'Số liệu bất thường',
        is3D: true,
        chartArea: {
            left: 0,
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
        pieSliceText : 'percentage'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart4'));

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

  