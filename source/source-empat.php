<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">LEVEL 2 SCOR SOURCE<br>sS3.4 RECEIVE PRODUCT</span>
        </div>
        
        <?php
            $dir = 'sqlite:../db.db';
            $dbh = new PDO($dir) or die("Cannot open the database");
            $query = "SELECT * FROM Source ORDER BY id DESC LIMIT 16";

            $getPurchaseOrder = $dbh->prepare($query);
            $getPurchaseOrder->execute();
            $purchaseOrder = $getPurchaseOrder->fetchAll();
            $lastPurchaseOrder = $purchaseOrder[0];
               
            $jumlahDemandRequirementOnTime = 0;
            $jumlahDemandRequirementNotOnTime = 0;
            for ($i = 0; $i < count($purchaseOrder); $i++){
                $jumlahDemandRequirementOnTime += $purchaseOrder[$i]['DemandRequirementOnTime'];
                $jumlahDemandRequirementNotOnTime += $purchaseOrder[$i]['DemandRequirementNotOnTime'];
            }
            $averageDemandRequirementOnTime = $jumlahDemandRequirementOnTime / count($purchaseOrder);
            $averageDemandRequirementNotOnTime = $jumlahDemandRequirementNotOnTime / count($purchaseOrder);
        ?>
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Reliability</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Percentage Orders / Lines Received On-Time Demand Requirement</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="satu" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px; width:50%">
                        <table style="text-align:center; font-size:16px;">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter On Time Demand Requirement</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">On Time Demand Requirement<br> <?php echo number_format($lastPurchaseOrder['DemandRequirementOnTime']/($lastPurchaseOrder['DemandRequirementOnTime'] + $lastPurchaseOrder['DemandRequirementNotOnTime']) *100, 1); ?>%</td>
                                <td style="color:#F3A447">Not On Time Demand requirement<br> <?php echo number_format($lastPurchaseOrder['DemandRequirementNotOnTime']/($lastPurchaseOrder['DemandRequirementOnTime'] + $lastPurchaseOrder['DemandRequirementNotOnTime']) *100, 1); ?>%</td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total On Time for last 16 quarter<br> <?php echo  $jumlahDemandRequirementOnTime ?></td>
                            <td style="padding: 5px;">Total Not On Time for last 16 quarter<br><?php echo $jumlahDemandRequirementNotOnTime ?></td>
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
            ['On Time',     <?php echo $lastPurchaseOrder['DemandRequirementOnTime']; ?>],
            ['Not On Time',      <?php echo $lastPurchaseOrder['DemandRequirementNotOnTime']; ?>]
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
            ['', 'Average On Time for last 16 quarter', 'Average Not On Time for last 16 quarter'],
            ['', <?php echo $averageDemandRequirementOnTime ?>, <?php echo $averageDemandRequirementNotOnTime ?>]
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
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['DemandRequirementOnTime'].", ".$order['DemandRequirementNotOnTime']."],";
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
            ['Received Correct Content',     11],
            ['Received Incorrect Content',      2]
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
            ['', 'Average Order with Correct Content for last 16 quarter', 'Average Order with Incorrect Content for last 16 quarter'],
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
        data.addColumn('number', 'Order Correct Content');
        data.addColumn('number', 'Order Incorrect Content');

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

<!--EMPAT-->

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataResponsivenessLeftTop = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Hazardous Material',     11],
            ['Non Hazardous Material',      2]
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

        var chartResponsivenessLeftTop = new google.visualization.PieChart(document.getElementsByClassName('empat')[0]);
        chartResponsivenessLeftTop.draw(dataResponsivenessLeftTop, optionsResponsivenessLeftTop);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked);
    
    function drawStacked() {
        var dataResponsivenessLeftBottom = google.visualization.arrayToDataTable([
            ['', 'Average Hazardous Material for last 16 quarter', 'Average Non Hazardous Material for last 16 quarter'],
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
        var chartResponsivenessLeftBottom = new google.visualization.BarChart(document.getElementsByClassName('empat')[1]);
        chartResponsivenessLeftBottom.draw(dataResponsivenessLeftBottom, optionsResponsivenessLeftBottom);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawColColors);

    function drawColColors() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', '');
        data.addColumn('number', 'Hazardous Material');
        data.addColumn('number', 'Non Hazardous Material');

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

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('empat')[2]);
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