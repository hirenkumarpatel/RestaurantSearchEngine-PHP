<?php
require "./class/db-connection.php";
connection();
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

                <script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'State wise registered restaurants,2014'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            
            data: [
                <?php
            $query="select s.state_name,count(r.rest_id)as total_rest
                    from restaurant_detail r,city c,state s
                    where r.city_id=c.city_id and c.state_id=s.state_id
                    group by s.state_id";
            $result=  mysql_query($query)or die(mysql_error());
            while ($row = mysql_fetch_array($result)) {
                echo "['{$row['state_name']}', {$row['total_rest']}],";
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

<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
