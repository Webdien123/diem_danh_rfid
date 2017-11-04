google.charts.setOnLoadCallback(drawChart2);

function drawChart2() {
    data = google.visualization.arrayToDataTable([
        ['So_bat_thuong', 'So_luong'],
        ['Có vào không ra', parseInt(sv_co_vao_k_ra)],
        ['Có ra không vào', parseInt(sv_co_ra_k_vao)],
        ['Chưa có thông tin hệ thống', parseInt(sv_k_co_ttin)]
    ]);

    var options = {
        title: 'Số liệu bất thường',
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

    var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

    chart.draw(data, options);

    function selectHandler() {
        var selectedItem = chart.getSelection()[0];
        if (selectedItem) {
        var topping = data.getValue(selectedItem.row, 0);
        alert('The user selected: sinh viên' + topping);
        }
    }
    
    google.visualization.events.addListener(chart, 'select', selectHandler);      
}

  