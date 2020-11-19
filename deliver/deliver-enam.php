<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">LEVEL 2 SCOR SOURCE<br>sD3.6 ROUTE SHIPMENTS</span>
        </div>

        <?php
            $dir = 'sqlite:../deliver2.db';
            $dbh = new PDO($dir) or die("Cannot open the database");
            $query = "SELECT * FROM Delivery ORDER BY id DESC LIMIT 16";

            $getMake = $dbh->prepare($query);
            $getMake->execute();
            $makeArray = $getMake->fetchAll();
            $lastMake = $makeArray[0];
               
            $jumlahAktual = 0;
            $jumlahTarget = 0;
            for ($i = 0; $i < count($makeArray); $i++){
                $jumlahAktual += $makeArray[$i]['RouteActual'];
                $jumlahTarget += $makeArray[$i]['RouteTarget'];
            }
            $averageAktual = $jumlahAktual / count($makeArray);
            $averageTarget = $jumlahTarget / count($makeArray);
        ?>
        
<!--        SATU-->
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Responsiveness</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Route shipments cycle time</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="satu" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px; width:40%;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter route shipments Cycle Time</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Actual<br><?php echo number_format(($jumlahAktual/($jumlahAktual + $jumlahTarget) *100), 1) ?>%</td>
                                <td style="color:#F3A447">Target<br><?php echo number_format(($jumlahTarget/($jumlahAktual + $jumlahTarget) *100), 1) ?>%</td>
                            </tr>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total actual for last 16 quarter<br><?php echo number_format($jumlahAktual, 0, ",", ".") ?></td>
                            <td style="padding: 5px;">Total target for last 16 quarter<br><?php echo number_format($jumlahTarget, 0, ",", ".") ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
</body>

<!--SATU-->

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataResponsivenessLeftTop = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Actual',     <?php echo $jumlahAktual ?>],
            ['Target',      <?php echo $jumlahTarget ?>]
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

        var chartResponsivenessLeftTop = new google.visualization.PieChart(document.getElementsByClassName('satu')[0]);
        chartResponsivenessLeftTop.draw(dataResponsivenessLeftTop, optionsResponsivenessLeftTop);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked);
    
    function drawStacked() {
        var dataResponsivenessLeftBottom = google.visualization.arrayToDataTable([
            ['', 'Average Actual Cycle Time for last 16 quarter', 'Average Target Cycle Time for last 16 quarter'],
            ['', <?php echo $averageAktual ?>, <?php echo $averageTarget ?>]
        ]);

        var optionsResponsivenessLeftBottom = {
            width: 600,
            height: 200,
            backgroundColor: { fill:'transparent' },
            colors:['#A5B592','#F3A447'],
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
                textStyle: {
                    color: '#FFF'
                }
            }
        };

        var chartResponsivenessLeftBottom = new google.visualization.BarChart(document.getElementsByClassName('satu')[1]);
        chartResponsivenessLeftBottom.draw(dataResponsivenessLeftBottom, optionsResponsivenessLeftBottom);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawColColors);

    function drawColColors() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', '');
        data.addColumn('number', 'Actual');
        data.addColumn('number', 'Target');

        data.addRows([
            <?php
            for ($i = count($makeArray)-1; $i >= 0; $i--){
                $order = $makeArray[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['RouteActual'].", ".$order['RouteTarget']."],";
            }
            ?>
        ]);

        var options = {
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

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('satu')[2]);
        chart.draw(data, options);
    }
</script>