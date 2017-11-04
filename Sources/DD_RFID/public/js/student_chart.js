google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart1);

var data;
function drawChart1() {
    data = google.visualization.arrayToDataTable([
        ['Loai_diem_danh', 'So_luong'],
        ['Có mặt', parseInt(sv_co_mat)],
        ['Vắng mặt', parseInt(sv_vang_mat)],
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

    function selectHandler() {
        var selectedItem = chart.getSelection()[0];
        if (selectedItem) {
        var topping = data.getValue(selectedItem.row, 0);
        alert('The user selected: sinh viên ' + topping);
        }
    }
    
    google.visualization.events.addListener(chart, 'select', selectHandler);      
}