<?php
require './class/db-connection.php';
connection();
session_start();

?>
<head>
    <?php
    include './themepart/headerscripts.php';
    ?>
    <!-- START META SECTION -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Admin Panel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
    <!--/ END META SECTION -->

</head>
<body>

    <div id="wrapper" class="fixed-header">
        <!-- START Template Canvas -->
        <div id="canvas">

            <?php
            include './themepart/header.php';
            include './themepart/sidebar.php';
            ?>

            <!-- START Template Main Content -->
            <section id="main">
                <div class="navbar navbar-static-top">
                    <div class="navbar-inner">
                        <!-- Breadcrumb -->
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php">Dashboard</a></li>

                        </ul>
                        <!--/ Breadcrumb -->
                    </div>
                </div>


                <div class="row-fluid">
                    <!-- START Circular Summary -->
                    <div class="span12 widget">
                        <section class="body">
                            <div class="body-inner no-padding" style="text-align:center;">
                                <!-- START sparkline -->
                                <figure class="stats summary stacked">
                                    <div class="up"><span class="icon icone-caret-up"></span></div>
                                    <div class="icon magenta"><span class="icone-user"></span></div>
                                    <figcaption>
                                        <?php
                                        $query = "select count(*) as total_foodie from foodie_detail";
                                        $result = mysql_query($query);
                                        $row = mysql_fetch_array($result);
                                        $total_foodie = $row['total_foodie'];
                                        ?> 
                                        <h3><small>Foodie</small>+<?php echo $total_foodie; ?></h3>
                                    </figcaption>
                                </figure><!--/ END sparkline -->

                                <!-- START sparkline -->
                                <figure class="stats summary stacked">
                                    <div class="down"><span class="icon icone-caret-up"></span></div>
                                    <div class="icon yellow"><span class="icone-food"></span></div>
                                    <figcaption>
                                        <?php
                                        $query = "select count(*) as restaurants from restaurant_detail";
                                        $result = mysql_query($query);
                                        $row = mysql_fetch_array($result);
                                        $restaurants = $row['restaurants'];
                                        ?> 
                                        <h3><small>Restaurant</small><?php echo $restaurants; ?></h3>
                                    </figcaption>
                                </figure><!--/ END sparkline -->



                                <!-- START sparkline -->
                                <figure class="stats summary stacked">
                                    <div class="up"><span class="icon icone-caret-up"></span></div>
                                    <div class="icon blue"><span class="icone-eye-open"></span></div>
                                    <figcaption>
                                        <?php
                                        $query = "select count(*) as visit from visit";
                                        $result = mysql_query($query);
                                        $row = mysql_fetch_array($result);
                                        $visit = $row['visit'];
                                        ?> 
                                        <h3><small>Visitors</small><?php echo $visit; ?></h3>
                                    </figcaption>
                                </figure>

                                <!--/ END sparkline -->

                                <figure class="stats summary stacked">
                                    <div class="down"><span class="icon icone-caret-down"></span></div>
                                    <div class="icon  orange"><span class="icone-comments"></span></div>
                                    <figcaption>
                                        <?php
                                        $query = "select count(*) as review from review";
                                        $result = mysql_query($query);
                                        $row = mysql_fetch_array($result);
                                        $total_review = $row['review'];
                                        ?> 
                                        <h3>+<?php echo $total_review ?><small>Reviews</small></h3>
                                    </figcaption>
                                </figure>
                            </div>
                        </section>
                    </div>
                    <!--/ END Circular Summary -->
                </div>







                <!-- START Row -->
                <div class="row-fluid">


                    <div class="span12">
                        <div class="span6">
                            <div id="container_bar_chart1" style=" height: 300px; margin: 0 auto"></div>
                        </div>
                        <div class="span6">
                            <div id="container_chart" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
                        </div>
                        <!--/ END Circular Summary -->
                    </div>

                </div>
                <!--/ END Row -->
                <div

                    
                </div>
                <!--/ END Content -->

            </section>
            <!--/ END Template Main Content -->

<?php
include './themepart/footer.php';
?>
        </div>
        <!--/ END Template Canvas -->
    </div>
    <!--/ END Template Wrapper -->
<?php
include './themepart/footerscripts.php';
?>
    <script type="text/javascript" src="js/jquery.min.js"></script>
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

    $query = "select sum(visit)as visit from visit where visit_date between '2014-{$i}-1 00:00:01' and '2014-{$i}-31 23:59:59' ";
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

    $query = "select sum(hit)as total_hit from visit where visit_date between '2014-{$i}-1' and '2014-{$i}-31' ";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $month_hit = $row['total_hit'];
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
            $('#container_chart').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'City wise Restaurants'
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
$query = "select c.city_name,count(r.rest_id)as total_rest
                        from restaurant_detail r,city c
                        where r.city_id=c.city_id
                        group by c.city_id";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
    echo "['{$row['city_name']}', {$row['total_rest']}],";
}
?>
                        ]
                    }]
            });
        });


    </script>

    <script src="assets/highchart/highcharts.js"></script>
    <script src="assets/highchart/exporting.js"></script>

</body>

<!-- Mirrored from baldtheme.com/theme/cleanizr/html/ by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 05 Feb 2014 10:18:54 GMT -->
</html>