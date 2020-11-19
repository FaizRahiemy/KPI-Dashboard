<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">LEVEL 2 SCOR SOURCE<br>sS3.6 TRANSFERRED PRODUCT</span>
        </div>
        <?php
            $dir = 'sqlite:../db.db';
            $dbh = new PDO($dir) or die("Cannot open the database");
            $query = "SELECT * FROM Source ORDER BY id DESC LIMIT 16";

            $getPurchaseOrder = $dbh->prepare($query);
            $getPurchaseOrder->execute();
            $purchaseOrder = $getPurchaseOrder->fetchAll();
            $lastPurchaseOrder = $purchaseOrder[0];
               
            $jumlahTransferredOnTime = 0;
            $jumlahTransferredNotOnTime = 0;
            for ($i = 0; $i < count($purchaseOrder); $i++){
                $jumlahTransferredOnTime += $purchaseOrder[$i]['TransferredOnTime'];
                $jumlahTransferredNotOnTime += $purchaseOrder[$i]['TransferredNotOnTime'];
            }
            $averageTransferredOnTime = $jumlahTransferredOnTime / count($purchaseOrder);
            $averageTransferredNotOnTime = $jumlahTransferredNotOnTime / count($purchaseOrder);
        ?>
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Reliability</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Percentage Product Transferred On Time To Demand Requirement</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="satu" style="float:left; color:white"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:70px;width:40%">
                        <table style="text-align:center; font-size:18px;">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Transferred On Time</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Transferred On Time<br><?php echo number_format($lastPurchaseOrder['TransferredOnTime']/($lastPurchaseOrder['TransferredOnTime'] + $lastPurchaseOrder['TransferredNotOnTime']) *100, 1); ?>%</td>
                                <td style="color:#F3A447">Transferred Not On Time<br><?php echo number_format($lastPurchaseOrder['TransferredNotOnTime']/($lastPurchaseOrder['TransferredOnTime'] + $lastPurchaseOrder['TransferredNotOnTime']) *100, 1); ?>%</td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total On Time for last 16 quarter<br><?php echo $jumlahTransferredOnTime ?></td>
                            <td style="padding: 5px;">Total Not On Time for last 16 quarter<br><?php echo $jumlahTransferredNotOnTime ?></td>
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
            ['On Time',     <?php echo $lastPurchaseOrder['TransferredOnTime']; ?>],
            ['Not On Time',      <?php echo $lastPurchaseOrder['TransferredNotOnTime']; ?>]
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
            ['', 'Average on time for last 16 quarter', 'Average not on time for last 16 quarter'],
            ['', <?php echo $averageTransferredOnTime ?>, <?php echo $averageTransferredNotOnTime ?>]
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
        data.addColumn('number', 'On Time');
        data.addColumn('number', 'Not On Time');

        data.addRows([
            <?php
            for ($i = count($purchaseOrder)-1; $i >= 0; $i--){
                $order = $purchaseOrder[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['TransferredOnTime'].", ".$order['TransferredNotOnTime']."],";
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

<!-DUA-->

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataResponsivenessLeftTop = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Order with Defect Free',     11],
            ['Order with Defect',      2]
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
            ['', 'Average order with defect for last 16 quarter', 'Average with defect for last 16 quarter'],
            ['', 8175000, 8008000]
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
        data.addColumn('number', 'Defect Free');
        data.addColumn('number', 'Defect');

        data.addRows([
            ['Q1-14', 1, .25],
            ['Q1-14', 1.5, .5],
            ['Q1-14', 2, .75],
            ['Q1-14', 2.5, 1],
            ['Q1-14', 3, 1.25],
            ['Q1-14', 3.5, 1.5],
            ['Q1-14', 4, 1.75],
            ['Q1-14', 5, 2]
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

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('dua')[2]);
        chart.draw(data, options);
    }
</script>

<!--Tiga-->

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataResponsivenessLeftTop = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Damage Free',     11],
            ['Damage',      2]
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

        var chartResponsivenessLeftTop = new google.visualization.PieChart(document.getElementsByClassName('tiga')[0]);
        chartResponsivenessLeftTop.draw(dataResponsivenessLeftTop, optionsResponsivenessLeftTop);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked);
    
    function drawStacked() {
        var dataResponsivenessLeftBottom = google.visualization.arrayToDataTable([
            ['', 'Average order with damage free for last 16 quarter', 'Average order with damage for last 16 quarter'],
            ['', 8175000, 8008000]
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
        var chartResponsivenessLeftBottom = new google.visualization.BarChart(document.getElementsByClassName('tiga')[1]);
        chartResponsivenessLeftBottom.draw(dataResponsivenessLeftBottom, optionsResponsivenessLeftBottom);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawColColors);

    function drawColColors() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', '');
        data.addColumn('number', 'Damage Free');
        data.addColumn('number', 'Damage');

        data.addRows([
            ['Q1-14', 1, .25],
            ['Q1-14', 1.5, .5],
            ['Q1-14', 2, .75],
            ['Q1-14', 2.5, 1],
            ['Q1-14', 3, 1.25],
            ['Q1-14', 3.5, 1.5],
            ['Q1-14', 4, 1.75],
            ['Q1-14', 5, 2]
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

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('tiga')[2]);
        chart.draw(data, options);
    }
</script>

<!--Lima-->

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataResponsivenessLeftTop = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Recycled or Reused Material',     11],
            ['Non Recycled or Reused Material',      2]
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

        var chartResponsivenessLeftTop = new google.visualization.PieChart(document.getElementsByClassName('lima')[0]);
        chartResponsivenessLeftTop.draw(dataResponsivenessLeftTop, optionsResponsivenessLeftTop);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked);
    
    function drawStacked() {
        var dataResponsivenessLeftBottom = google.visualization.arrayToDataTable([
            ['', 'Average Recycled or Reused Material for last 16 quarter', 'Average Non Recycled or Reused Material for last 16 quarter'],
            ['', 8175000, 8008000]
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
        var chartResponsivenessLeftBottom = new google.visualization.BarChart(document.getElementsByClassName('lima')[1]);
        chartResponsivenessLeftBottom.draw(dataResponsivenessLeftBottom, optionsResponsivenessLeftBottom);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawColColors);

    function drawColColors() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', '');
        data.addColumn('number', 'Recycled or Reused Material');
        data.addColumn('number', 'Non Recycled or Reused Material');

        data.addRows([
            ['Q1-14', 1, .25],
            ['Q1-14', 1.5, .5],
            ['Q1-14', 2, .75],
            ['Q1-14', 2.5, 1],
            ['Q1-14', 3, 1.25],
            ['Q1-14', 3.5, 1.5],
            ['Q1-14', 4, 1.75],
            ['Q1-14', 5, 2]
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

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('lima')[2]);
        chart.draw(data, options);
    }
</script>