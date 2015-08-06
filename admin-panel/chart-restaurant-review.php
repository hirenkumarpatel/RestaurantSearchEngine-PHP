
<?php
require "./class/db-connection.php";
connection();
?>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>charts</title>
        <link rel="stylesheet" href="assets/amchart/style.css" type="text/css">
        <script src="assets/amchart/amcharts.js" type="text/javascript"></script>
        <script src="assets/amchart/pie.js" type="text/javascript"></script>
        <?php
        echo "<center><h2>Restaurant wise review posted..</h2></center>";
        ?>
        <script type="text/javascript">
            var chart;
            var legend;
            
            var chartData = [<?php
                $query="select r.rest_name,count(rw.review_id)as total_review
                from restaurant_detail r, review rw
                where rw.rest_id=r.rest_id
                group by r.rest_id";
                $result=  mysql_query($query)or die(mysql_error());
                while ($row = mysql_fetch_array($result)) {
                    echo "{ rest: '{$row['rest_name']}',review: {$row['total_review']}},";
            }
            ?>];

            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "rest";
                chart.valueField = "review";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;

                // WRITE
                chart.write("chartdiv");
            });
        </script>
    </head>
    
    <body>
        <div id="chartdiv" style="width: 100%; height: 400px;"></div>
    </body>

</html>