<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">LEVEL 2 SCOR MAKE<br>sM3.2 SCHEDULE PRODUCTION ACTIVITIES</span>
        </div>

        <?php
            $dir = 'sqlite:../dbMake.db';
            $dbh = new PDO($dir) or die("Cannot open the database");
            $query = "SELECT * FROM Make ORDER BY id DESC LIMIT 16";

            $getMake = $dbh->prepare($query);
            $getMake->execute();
            $makeArray = $getMake->fetchAll();
            $lastMake = $makeArray[0];
               
            $jumlahActual = 0;
            $jumlahBudget = 0;
            $jumlahUsed = 0;
            $jumlahUnused = 0;
            for ($i = 0; $i < count($makeArray); $i++){
                $jumlahActual += $makeArray[$i]['ProductionActualCost'];
                $jumlahBudget += $makeArray[$i]['ProductionBudget'];
                $jumlahUsed += $makeArray[$i]['UsedCapacity'];
                $jumlahUnused += $makeArray[$i]['UnusedCapacity'];
            }
            $averageActual = $jumlahActual / count($makeArray);
            $averageBudget = $jumlahBudget / count($makeArray);
            $averageUsed = $jumlahUsed / count($makeArray);
            $averageUnused = $jumlahUnused / count($makeArray);
        ?>
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Cost</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Direct Production Cost</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="satu" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Cost Condition</td>
                            </tr>
                            <?php 
                                if ($lastMake['ProductionActualCost'] == $lastMake['ProductionBudget']){
                                    echo '
                                    <tr style="font-weight:bold">
                                        <td style="color:#E6BC28">On Budget</td>
                                    </tr>';
                                }else if ($lastMake['ProductionBudget'] > $lastMake['ProductionActualCost']){
                                    echo '
                                    <tr style="font-weight:bold">
                                        <td style="color:#A5B592">Under The Budget</td>
                                    </tr>';
                                }else{
                                    echo '
                                    <tr style="font-weight:bold">
                                        <td style="color:#F3A447">Over The Budget</td>
                                    </tr>';
                                }
                            ?>
                        </table>
                    </span>
                </div>
                
                <div id="attribute-left-bottom">
                    <span id="responsiveness-chart-left-bottom" class="satu" style="float:left"></span>
                </div>
                
            </div>
            
            <div id="attribute-right">
                
                <div id="attribute-right-top">
                    <span id="responsiveness-chart-right-top" class="satu" style="float:right"></span>
                </div>
            
                <div id="attribute-right-bottom" style="margin-right:2px">
                    <table style="">
                        <tr>
                            <td style="padding: 5px; border-right: solid 2px white;">Total budget for last 16 quarter<br>Rp <?php echo number_format($jumlahBudget, 0, ",", ".") ?>,00</td>
                            <td style="padding: 5px;">Total actual cost for last 16 quarter<br>Rp <?php echo number_format($jumlahActual, 0, ",", ".") ?>,00</td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>
        
<!--        DUA-->
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Assets Management</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Production Capacity Utilization</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="dua" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Capacity Utilization</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Used Capacity<br><?php echo number_format($lastMake['UsedCapacity']/($lastMake['UsedCapacity'] + $lastMake['UnusedCapacity']) *100, 2); ?>%</td>
                                <td style="color:#F3A447">Unused Capacity<br><?php echo number_format($lastMake['UnusedCapacity']/($lastMake['UsedCapacity'] + $lastMake['UnusedCapacity']) *100, 2); ?>%</td>
                            </tr>
                        </table>
                    </span>
                </div>
                
                <div id="attribute-left-bottom">
                    <span id="responsiveness-chart-left-bottom" class="dua" style="float:left"></span>
                </div>
                
            </div>
            
            <div id="attribute-right">
                
                <div id="attribute-right-top">
                    <span id="responsiveness-chart-right-top" class="dua" style="float:right"></span>
                </div>
            
                <div id="attribute-right-bottom" style="margin-right:2px">
                    <table style="">
                        <tr>
                            <td style="padding: 5px; border-right: solid 2px white;">Total used capacity for last 16 quarter<br><?php echo number_format($jumlahUsed, 0, ",", ".") ?></td>
                            <td style="padding: 5px;">Total unused capacity for last 16 quarter<br><?php echo number_format($jumlahUnused, 0, ",", ".") ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
</body>

<!--SATU-->

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawColColors);

    function drawColColors() {
        
        var data = new google.visualization.DataTable();
        data.addColumn('string', '');
        data.addColumn('number', 'Budget');
        data.addColumn('number', 'Actual Cost');

        data.addRows([
            ['', <?php echo $lastMake['ProductionBudget'] ?>, <?php echo $lastMake['ProductionActualCost'] ?>]
        ]);

        var options = {
            width: 300,
            height: 250,
            backgroundColor: { fill:'transparent' },
            colors: ['#A5B592', '#F3A447'],
            legend: {
                position: 'bottom', 
                maxLines: 2, 
                textStyle: {
                    fontSize: 12,
                    color: '#FFF'
                }
            },
            hAxis: {
                title: '',
                viewWindow: {
                    min: [7, 30, 0],
                    max: [17, 30, 0]
                }, 
                textStyle: {
                    fontSize: 12,
                    color: '#FFF'
                }
            },
            vAxis: {
                title: '', 
                textStyle: {
                    fontSize: 12,
                    color: '#FFF'
                }
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('satu')[0]);
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBarColors);

    function drawBarColors() {
        var data = google.visualization.arrayToDataTable([
            ['', 'Average budget for last 16 quarters', 'Average actual cost for last 16 quarter'],
            ['', <?php echo $averageBudget ?>, <?php echo $averageActual ?>]
        ]);

        var options = {
        width: 660,
        height: 200,
        backgroundColor: { fill:'transparent' },
        colors:['#A5B592','#F3A447'],
        isStacked: 'percent',
        legend: {
            position: 'bottom', 
            maxLines: 2,
            textStyle: {
                color: 'white', 
                fontSize: 10
            }
        },
        };

        var options = {
            width: 600,
            height: 200,
            backgroundColor: { fill:'transparent' },
            colors:['#A5B592','#F3A447'],
            hAxis: {
                title: '',
                minValue: 0,
                textStyle: {
                    color: 'white', 
                    fontSize: 10
                }
            },
            vAxis: {
                title: ''
            },
            legend: {
                position: 'bottom', 
                maxLines: 2,
                textStyle: {
                    color: 'white', 
                    fontSize: 10
                }
            },
        };

        var chart = new google.visualization.BarChart(document.getElementsByClassName('satu')[1]);
        chart.draw(data, options);
        
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
            ['Quarter', 'Budget', 'Actual Cost'],
            <?php
            for ($i = count($makeArray)-1; $i >= 0; $i--){
                $order = $makeArray[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['ProductionBudget'].", ".$order['ProductionActualCost']."],";
            }
            ?>
        ]);

        var options = {
            width: 600,
            height: 450,
            backgroundColor: { fill:'transparent' },
            title : '',
            colors:['#A5B592','#F3A447'],
            hAxis: {
                title: '',
                minValue: 0,
                textStyle: {
                    color: 'white', 
                    fontSize: 10
                }
            },
            vAxis: {
                title: '',
                textStyle: {
                    color: 'white', 
                    fontSize: 10
                }
            },
            legend: {
                position: 'bottom', 
                maxLines: 2,
                textStyle: {
                    color: 'white', 
                    fontSize: 10
                }
            },
            seriesType: 'bars',
            series: {
                1: {
                    type: 'line'
                }
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementsByClassName('satu')[2]);
        chart.draw(data, options);
    }
</script>

<!--DUA-->

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataResponsivenessLeftTop = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Used Capacity',     <?php echo $lastMake['UsedCapacity']; ?>],
            ['Unused Capacity',      <?php echo $lastMake['UnusedCapacity']; ?>]
        ]);

        var optionsResponsivenessLeftTop = {
            width: 300,
            height: 250,
            legend: {
                position: 'bottom', 
                textStyle: {
                    color: 'white', 
                    fontSize: 10
                }
            },
            backgroundColor: { fill:'transparent' },
            pieSliceBorderColor: {fill:'transparent'},
            pieHole: 0.7,
            slices: {
                0: { color: '#A5B592'},
                1: { color: '#F3A447'}
            }
        };

        var chartResponsivenessLeftTop = new google.visualization.PieChart(document.getElementsByClassName('dua')[0]);
        chartResponsivenessLeftTop.draw(dataResponsivenessLeftTop, optionsResponsivenessLeftTop);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked);
    
    function drawStacked() {
        var dataResponsivenessLeftBottom = google.visualization.arrayToDataTable([
            ['', 'Average used capacity for last 16 quarter', 'Average unused capacityfor last 16 quarter'],
            ['', <?php echo $averageUsed ?>, <?php echo $averageUnused ?>]
        ]);

        var optionsResponsivenessLeftBottom = {
            width: 660,
            height: 200,
            backgroundColor: { fill:'transparent' },
            colors:['#A5B592','#F3A447'],
            isStacked: 'percent',
            legend: {
                position: 'bottom', 
                maxLines: 2,
                textStyle: {
                    color: 'white', 
                    fontSize: 10
                }
            },
            hAxis: {
                minValue: 0,
                ticks: [0, .3, .6, .9, 1], 
                textStyle: {
                    color: '#FFF'
                }
            }
        };
        var chartResponsivenessLeftBottom = new google.visualization.BarChart(document.getElementsByClassName('dua')[1]);
        chartResponsivenessLeftBottom.draw(dataResponsivenessLeftBottom, optionsResponsivenessLeftBottom);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawColColors);

    function drawColColors() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', '');
        data.addColumn('number', 'Used capacity');
        data.addColumn('number', 'Unused capacity');

        data.addRows([
            <?php
            for ($i = count($makeArray)-1; $i >= 0; $i--){
                $order = $makeArray[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['UsedCapacity'].", ".$order['UnusedCapacity']."],";
            }
            ?>
        ]);

        var options = {
            isStacked: 'percent',
            width: 600,
            height: 450,
            backgroundColor: { fill:'transparent' },
            colors: ['#A5B592', '#F3A447'],
            legend: {
                position: 'bottom', 
                maxLines: 2, 
                textStyle: {
                    fontSize: 12,
                    color: '#FFF'
                }
            },
            hAxis: {
                title: '',
                viewWindow: {
                    min: [7, 30, 0],
                    max: [17, 30, 0]
                },
                textStyle: {
                    fontSize: 12,
                    color: '#FFF'
                }
            },
            vAxis: {
                title: '',
                textStyle: {
                    color: 'white', 
                    fontSize: 10
                }
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('dua')[2]);
        chart.draw(data, options);
    }
</script>