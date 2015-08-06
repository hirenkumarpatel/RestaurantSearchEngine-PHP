<?php
require './class/db-connection.php';
connection();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <script src="js/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#container').highcharts({
                    chart: {
                        type: 'areaspline'
                    },
                    title: {
                        text: 'Average Visits and Hits during one Year'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'top',
                        x: 150,
                        y: 100,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: '#FFFFFF'
                    },
                    xAxis: {
                        categories: [
                            'Jan',
                            'Feb',
                            'Mar',
                            'Apr',
                            'May',
                            'Jun',
                            'Jul',
                            'Aug',
                            'Sep',
                            'Oct',
                            'Nov',
                            'Dec'
                        ],
                    },
                    yAxis: {
                        title: {
                            text: 'Visits & Hits'
                        }
                    },
                    tooltip: {
                        shared: true,
                        valueSuffix: ' units'
                    },
                    credits: {
                        enabled: false
                    },
                    plotOptions: {
                        areaspline: {
                            fillOpacity: 0.5
                        }
                    },
                    series: [{
                            name: 'Visits',
                            data: [
<?php
for ($i = 1; $i <= 12; $i++) {

    $query = "select sum(visit)as total_visit from visit where visit_date between '2014-{$i}-1' and '2014-{$i}-31' ";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $month_visit =$row['total_visit'];
    echo "$month_visit, ";
}
?>
                            ]
                        }, {
                            name: 'Hits',
                            data: [
                            <?php
for ($i = 1; $i <= 12; $i++) {

    $query = "select sum(hit)as total_hit from visit where visit_date between '2014-{$i}-1' and '2014-{$i}-31' ";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $month_hit =$row['total_hit'];
    echo "$month_hit, ";
}
?>
                            ]
                        }]
                });
            });


        </script>
        <script type="text/javascript">
    $(function() {
        $('#container_bar_chart1').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Visits'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    <?php


    $query = "select visit_date from visit group by visit_date ";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    echo "{$row['visit_date']},";

?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Site Visit'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} click</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Visit',
                    data: [
<?php
for ($i = 1; $i <= 12; $i++) {

    $query = "select count(visit_date)as visit from visit group by visit_date ";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $month_visit = number_format($row['visit'], 1);
    echo "$month_visit,";
}
?>]

                }, {
                            name: 'Hits',
                            data: [
                            <?php
for ($i = 1; $i <= 12; $i++) {

    $query = "select sum(hit)as total_hit from visit group by visit_date";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $month_hit =$row['total_hit'];
    echo "$month_hit, ";
}
?>
                            ]
                        }]
        });
    });


</script>
    </head>
    <body>
        <script src="assets/highchart/highcharts.js"></script>
        <script src="assets/highchart/exporting.js"></script>

        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <div id="container_bar_chart1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </body>
</html>
