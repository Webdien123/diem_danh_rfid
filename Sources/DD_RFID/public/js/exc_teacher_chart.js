google.charts.setOnLoadCallback(drawChart4);

function drawChart4() {
    var data = google.visualization.arrayToDataTable([
        ['So_bat_thuong', 'So_luong'],
        ['Có vào không ra', parseInt(cb_co_vao_k_ra)],
        ['Có ra không vào', parseInt(cb_co_ra_k_vao)],
        ['Chưa bổ sung thông tin', parseInt(cb_k_co_ttin)]
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
        pieSliceText : 'value-and-percentage'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart4'));

    chart.draw(data, options);
    
    function selectHandler4() {
        var selectedItem = chart.getSelection()[0];
        if (selectedItem) {
            var topping = data.getValue(selectedItem.row, 0);

            if(topping == "Có vào không ra"){
                $("#sel1").val("cb_co_v_k_ra");
                var ten_ds = $('#sel1').find(":selected").text();
                HienDanhSach("cb_co_v_k_ra", ten_ds);
            }
            if(topping == "Có ra không vào"){
                $("#sel1").val("cb_co_ra_k_v");
                var ten_ds = $('#sel1').find(":selected").text();
                HienDanhSach("cb_co_ra_k_v", ten_ds);
            }
            if(topping == "Chưa bổ sung thông tin"){
                $("#sel1").val("cb_chua_co_ttin");
                var ten_ds = $('#sel1').find(":selected").text();
                HienDanhSach("cb_chua_co_ttin", ten_ds);
            }
        }
    }
    
    google.visualization.events.addListener(chart, 'select', selectHandler4);      
}

  