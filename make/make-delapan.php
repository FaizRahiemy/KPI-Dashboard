<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">LEVEL 2 SCOR MAKE<br>sM3.8 WASTE DISPOSAL</span>
        </div>

        <?php
            $dir = 'sqlite:../dbMake.db';
            $dbh = new PDO($dir) or die("Cannot open the database");
            $query = "SELECT * FROM Make ORDER BY id DESC LIMIT 16";

            $getMake = $dbh->prepare($query);
            $getMake->execute();
            $makeArray = $getMake->fetchAll();
            $lastMake = $makeArray[0];
               
            $jumlahOntime = 0;
            $jumlahNotOntime = 0;
            $jumlahHazard = 0;
            $jumlahNonHazard = 0;
            $jumlahRecyclable = 0;
            $jumlahNonRecyclable = 0;
            for ($i = 0; $i < count($makeArray); $i++){
                $jumlahOntime += $makeArray[$i]['OnTimeWaste'];
                $jumlahNotOntime += $makeArray[$i]['NotOnTimeWaste'];
                $jumlahHazard += $makeArray[$i]['HazardousWaste'];
                $jumlahNonHazard += $makeArray[$i]['NonHazardousWaste'];
                $jumlahRecyclable += $makeArray[$i]['RecyclableWaste'];
                $jumlahNonRecyclable += $makeArray[$i]['NonRecylableWaste'];
            }
            $averageOntime = $jumlahOntime / count($makeArray);
            $averageNotOntime = $jumlahNotOntime / count($makeArray);
            $averageHazard = $jumlahHazard / count($makeArray);
            $averageNonHazard = $jumlahNonHazard / count($makeArray);
            $averageRecyclable = $jumlahRecyclable / count($makeArray);
            $averageNonRecyclable = $jumlahNonRecyclable / count($makeArray);
        ?>
        
<!--        SATU-->
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Responsiveness</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Waste Disposal Accumulation Cycle Time Accuracy</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="satu" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Cycle Time Accuracy</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">On Time<br><?php echo number_format(($lastMake['OnTimeWaste']/($lastMake['OnTimeWaste'] + $lastMake['NotOnTimeWaste']) *100), 1) ?>%</td>
                                <td style="color:#F3A447">Not On Time<br><?php echo number_format(($lastMake['NotOnTimeWaste']/($lastMake['OnTimeWaste'] + $lastMake['NotOnTimeWaste']) *100), 1) ?>%</td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total On Time for last 16 quarter<br><?php echo number_format($jumlahOntime, 0, ",", ".") ?></td>
                            <td style="padding: 5px;">Total Not On Time for last 16 quarter<br><?php echo number_format($jumlahNotOntime, 0, ",", ".") ?></td>
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
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Recylable Waste</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="tiga" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px; width:40%;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Recylable Waste</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Recyclable waste<br><?php echo number_format(($lastMake['RecyclableWaste']/($lastMake['RecyclableWaste'] + $lastMake['NonRecylableWaste']) *100), 1) ?>%</td>
                                <td style="color:#F3A447">Non-recyclable waste<br><?php echo number_format(($lastMake['NonRecylableWaste']/($lastMake['RecyclableWaste'] + $lastMake['NonRecylableWaste']) *100), 1) ?>%</td>
                            </tr>
                        </table>
                    </span>
                </div>
                
                <div id="attribute-left-bottom">
                    <span id="responsiveness-chart-left-bottom" class="tiga" style="float:left"></span>
                </div>
                
            </div>
            
            <div id="attribute-right">
                
                <div id="attribute-right-top">
                    <span id="responsiveness-chart-right-top" class="tiga" style="float:right"></span>
                </div>
            
                <div id="attribute-right-bottom" style="margin-right:2px">
                    <table style="">
                        <tr>
                            <td style="padding: 5px; border-right: solid 2px white;">Total recyclable for last 16 quarter<br><?php echo number_format($jumlahRecyclable, 3, ",", ".") ?></td>
                            <td style="padding: 5px;">Total non-recyclable for last 16 quarter<br><?php echo number_format($jumlahNonRecyclable, 3, ",", ".") ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>
        
<!--        TIGA-->
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Assets Management</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Hazardous Waste</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="dua" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Hazardous Waste</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Non-hazardous<br><?php echo number_format(($lastMake['NonHazardousWaste']/($lastMake['HazardousWaste'] + $lastMake['NonHazardousWaste']) *100), 1) ?>%</td>
                                <td style="color:#F3A447">Hazardous<br><?php echo number_format(($lastMake['HazardousWaste']/($lastMake['HazardousWaste'] + $lastMake['NonHazardousWaste']) *100), 1) ?>%</td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total non-hazardous for last 16 quarter<br><?php echo number_format($jumlahNonHazard, 3, ",", ".") ?></td>
                            <td style="padding: 5px;">Total hazardous for last 16 quarter<br><?php echo number_format($jumlahHazard, 3, ",", ".") ?></td>
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
            ['On Time',     <?php echo $lastMake['OnTimeWaste'] ?>],
            ['Not On Time',      <?php echo $lastMake['NotOnTimeWaste'] ?>]
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
            ['', 'Average cycle time on time for last 16 quarter', 'Average cycle time not on time for last 16 quarter'],
            ['', <?php echo $averageOntime ?>, <?php echo $averageNotOntime ?>]
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
            for ($i = count($makeArray)-1; $i >= 0; $i--){
                $order = $makeArray[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['OnTimeWaste'].", ".$order['NotOnTimeWaste']."],";
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

<!--DUA-->

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataResponsivenessLeftTop = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Recyclable',     <?php echo $lastMake['RecyclableWaste'] ?>],
            ['Non-recyclable',      <?php echo $lastMake['NonRecylableWaste'] ?>]
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
            ['', 'Average recyclable for last 16 quarter', 'Average non-recyclable for last 16 quarter'],
            ['', <?php echo $averageRecyclable ?>, <?php echo $averageNonRecyclable ?>]
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
        data.addColumn('number', 'Recylable');
        data.addColumn('number', 'Non-recylable');

        data.addRows([
            <?php
            for ($i = count($makeArray)-1; $i >= 0; $i--){
                $order = $makeArray[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['RecyclableWaste'].", ".$order['NonRecylableWaste']."],";
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

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('tiga')[2]);
        chart.draw(data, options);
    }
</script>

<!--TIGA-->

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataResponsivenessLeftTop = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Non-hazardous',     <?php echo $lastMake['NonHazardousWaste'] ?>],
            ['Hazardous',      <?php echo $lastMake['HazardousWaste'] ?>]
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
            ['', 'Average non-hazardous for last 16 quarter', 'Average hazardous for last 16 quarter'],
            ['', <?php echo $averageNonHazard ?>, <?php echo $averageHazard ?>]
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
        data.addColumn('number', 'Non-hazardous');
        data.addColumn('number', 'Hazardous');

        data.addRows([
            <?php
            for ($i = count($makeArray)-1; $i >= 0; $i--){
                $order = $makeArray[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['NonHazardousWaste'].", ".$order['HazardousWaste']."],";
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