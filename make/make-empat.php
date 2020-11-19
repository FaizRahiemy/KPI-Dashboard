<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">LEVEL 2 SCOR MAKE<br>sM3.4 PRODUCE AND TEST</span>
        </div>

        <?php
            $dir = 'sqlite:../dbMake.db';
            $dbh = new PDO($dir) or die("Cannot open the database");
            $query = "SELECT * FROM Make ORDER BY id DESC LIMIT 16";

            $getMake = $dbh->prepare($query);
            $getMake->execute();
            $makeArray = $getMake->fetchAll();
            $lastMake = $makeArray[0];
            
            $jumlahOutput = 0;
            $jumlahWaste = 0;
            $jumlahOntime = 0;
            $jumlahNotOntime = 0;
            $jumlahHazardous = 0;
            $jumlahNonHazardous = 0;
            for ($i = 0; $i < count($makeArray); $i++){
                $jumlahOutput += $makeArray[$i]['ProductionOutput'];
                $jumlahWaste += $makeArray[$i]['ProductionWaste'];
                $jumlahOntime += $makeArray[$i]['MakeCycleTimeAccuracyOntime'];
                $jumlahNotOntime += $makeArray[$i]['MakeCycleTimeAccuracyNotOntime'];
                $jumlahHazardous += $makeArray[$i]['HazardousMateriaTypeUsed'];
                $jumlahNonHazardous += $makeArray[$i]['NonHazardousMaterialTypeUsed'];
            }
            $averageOutput = $jumlahOutput / count($makeArray);
            $averageWaste = $jumlahWaste / count($makeArray);
            $averageOntime = $jumlahOntime / count($makeArray);
            $averageNotOntime = $jumlahNotOntime / count($makeArray);
            $averageHazardous = $jumlahHazardous / count($makeArray);
            $averageNonHazardous = $jumlahNonHazardous / count($makeArray);
        ?>
        
<!--        SATU-->
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Reliability</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Production Yield</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="satu" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Production Yield</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Output<br><?php echo number_format($lastMake['ProductionOutput']/($lastMake['ProductionOutput'] + $lastMake['ProductionWaste']) *100, 2); ?>%</td>
                                <td style="color:#F3A447">Waste<br><?php echo number_format($lastMake['ProductionWaste']/($lastMake['ProductionOutput'] + $lastMake['ProductionWaste']) *100, 2); ?>%</td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total production output for last 16 quarter<br><?php echo number_format($jumlahOutput, 0, ",", ".") ?></td>
                            <td style="padding: 5px;">Total production waste for last 16 quarter<br><?php echo number_format($jumlahWaste, 0, ",", ".") ?></td>
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
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Responsiveness</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Make Cycle Time Accuracy</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="dua" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Cycle Time Accuracy</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">On Time<br><?php echo number_format($lastMake['MakeCycleTimeAccuracyOntime']/($lastMake['MakeCycleTimeAccuracyOntime']+$lastMake['MakeCycleTimeAccuracyNotOntime'])*100, 2) ?>%</td>
                                <td style="color:#F3A447">Not On Time<br><?php echo number_format($lastMake['MakeCycleTimeAccuracyNotOntime']/($lastMake['MakeCycleTimeAccuracyOntime']+$lastMake['MakeCycleTimeAccuracyNotOntime'])*100, 2) ?>%</td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total on time for last 16 quarter<br><?php echo number_format($jumlahOntime, 0, ",", ".") ?></td>
                            <td style="padding: 5px;">Total not on time for last 16 quarter<br><?php echo number_format($jumlahNotOntime, 0, ",", ".") ?></td>
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
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Hazardous Materials Used During Production Process</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="tiga" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px width:80%;">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Hazardous Materials Used</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Non-Hazardous<br><?php echo number_format($lastMake['NonHazardousMaterialTypeUsed']/($lastMake['HazardousMateriaTypeUsed']+$lastMake['NonHazardousMaterialTypeUsed'])*100, 2) ?>%</td>
                                <td style="color:#F3A447">Hazardous<br><?php echo number_format($lastMake['HazardousMateriaTypeUsed']/($lastMake['HazardousMateriaTypeUsed']+$lastMake['NonHazardousMaterialTypeUsed'])*100, 2) ?>%</td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total non-hazardous materials for last 16 quarter<br><?php echo number_format($jumlahNonHazardous, 0, ",", ".") ?></td>
                            <td style="padding: 5px;">Total hazardous materials for last 16 quarter<br><?php echo number_format($jumlahHazardous, 0, ",", ".") ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>
        
<!--        EMPAT-->
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Assets Management</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Percentage of Production Materials Reused</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="empat" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px width:80%;">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Materials Reused</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Reused Materials<br>94,34%</td>
                                <td style="color:#F3A447">Disposable Materials<br>5,66%</td>
                            </tr>
                        </table>
                    </span>
                </div>
                
                <div id="attribute-left-bottom">
                    <span id="responsiveness-chart-left-bottom" class="empat" style="float:left"></span>
                </div>
                
            </div>
            
            <div id="attribute-right">
                
                <div id="attribute-right-top">
                    <span id="responsiveness-chart-right-top" class="empat" style="float:right"></span>
                </div>
            
                <div id="attribute-right-bottom" style="margin-right:2px">
                    <table style="">
                        <tr>
                            <td style="padding: 5px; border-right: solid 2px white;">Total reused materials for last 16 quarter<br>850</td>
                            <td style="padding: 5px;">Total disposable materials for last 16 quarter<br>104</td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>
        
<!--        LIMA-->
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Assets Management</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Percentage of Production Components Reused</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="lima" style="float:left"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px; width:40%;">
                        <table style="text-align:center; font-size:14px;">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Components Reused</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Reused Components<br>94,34%</td>
                                <td style="color:#F3A447">Disposable Components<br>5,66%</td>
                            </tr>
                        </table>
                    </span>
                </div>
                
                <div id="attribute-left-bottom">
                    <span id="responsiveness-chart-left-bottom" class="lima" style="float:left"></span>
                </div>
                
            </div>
            
            <div id="attribute-right">
                
                <div id="attribute-right-top">
                    <span id="responsiveness-chart-right-top" class="lima" style="float:right"></span>
                </div>
            
                <div id="attribute-right-bottom" style="margin-right:2px">
                    <table style="">
                        <tr>
                            <td style="padding: 5px; border-right: solid 2px white;">Total reused components for last 16 quarter<br>850</td>
                            <td style="padding: 5px;">Total disposable components for last 16 quarter<br>104</td>
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
            ['Production Output',     <?php echo $lastMake['ProductionOutput']; ?>],
            ['Production Waste',      <?php echo $lastMake['ProductionWaste']; ?>]
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
            ['', 'Average production output for last 16 quarter', 'Average production waste for last 16 quarter'],
            ['', <?php echo $averageOutput ?>, <?php echo $averageWaste ?>]
        ]);

        var optionsResponsivenessLeftBottom = {
            width: 630,
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
        data.addColumn('number', 'Production Output');
        data.addColumn('number', 'Production Waste');

        data.addRows([
            <?php
            for ($i = count($makeArray)-1; $i >= 0; $i--){
                $order = $makeArray[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['ProductionOutput'].", ".$order['ProductionWaste']."],";
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
            ['On time',     <?php echo $lastMake['MakeCycleTimeAccuracyOntime'] ?>],
            ['Not on time',      <?php echo $lastMake['MakeCycleTimeAccuracyNotOntime'] ?>]
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
            ['', 'Average cycle time on time for last 16 quarter', 'Average cycle time not on time for last 16 quarter'],
            ['', <?php echo $averageOntime ?>, <?php echo $averageNotOntime ?>]
        ]);

        var optionsResponsivenessLeftBottom = {
            width: 630,
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
        data.addColumn('number', 'On time');
        data.addColumn('number', 'Not on time');

        data.addRows([
            <?php
            for ($i = count($makeArray)-1; $i >= 0; $i--){
                $order = $makeArray[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['MakeCycleTimeAccuracyOntime'].", ".$order['MakeCycleTimeAccuracyNotOntime']."],";
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

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('dua')[2]);
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
            ['Non-hazardous',     <?php echo $lastMake['NonHazardousMaterialTypeUsed'] ?>],
            ['Hazardous',      <?php echo $lastMake['HazardousMateriaTypeUsed'] ?>]
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
            ['', 'Average non-hazardous materials used for last 16 quarter', 'Average hazardous materials used for last 16 quarter'],
            ['', <?php echo $averageNonHazardous ?>, <?php echo $averageHazardous ?>]
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
        data.addColumn('number', 'Non-hazardous materials');
        data.addColumn('number', 'Hazardous materials');

        data.addRows([
            <?php
            for ($i = count($makeArray)-1; $i >= 0; $i--){
                $order = $makeArray[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['NonHazardousMaterialTypeUsed'].", ".$order['HazardousMateriaTypeUsed']."],";
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

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('tiga')[2]);
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
            ['Reused materials',     11],
            ['Disposable materials',      2]
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
            ['', 'Average reused materials used for last 16 quarter', 'Average disposable materials used for last 16 quarter'],
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
        data.addColumn('number', 'Reused materials');
        data.addColumn('number', 'Disposable materials');

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

<!--LIMA-->

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataResponsivenessLeftTop = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Reused components',     11],
            ['Disposable components',      2]
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
            ['', 'Average reused components used for last 16 quarter', 'Average disposable components used for last 16 quarter'],
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
        data.addColumn('number', 'Reused components');
        data.addColumn('number', 'Disposable components');

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