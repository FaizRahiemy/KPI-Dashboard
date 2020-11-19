<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">LEVEL 2 SCOR SOURCE<br>sS3.1 IDENTIFICATION SOURCE OF SUPPLY</span>
        </div>

        <?php
            $dir = 'sqlite:../db.db';
            $dbh = new PDO($dir) or die("Cannot open the database");
            $query = "SELECT * FROM Source ORDER BY id DESC LIMIT 16";

            $getPurchaseOrder = $dbh->prepare($query);
            $getPurchaseOrder->execute();
            $purchaseOrder = $getPurchaseOrder->fetchAll();
            $lastPurchaseOrder = $purchaseOrder[0];
               
            $jumlahIdentifySourceOnTime = 0;
            $jumlahNotOnTimeIdentifySource = 0;
            for ($i = 0; $i < count($purchaseOrder); $i++){
                $jumlahIdentifySourceOnTime += $purchaseOrder[$i]['IdentifySourceOnTime'];
                $jumlahNotOnTimeIdentifySource += $purchaseOrder[$i]['NotOnTimeIdentifySource'];
            }
            $averageIdentifySourceOnTime = $jumlahIdentifySourceOnTime / count($purchaseOrder);
            $averageNotOnTimeIdentifySource = $jumlahNotOnTimeIdentifySource / count($purchaseOrder);
        ?>
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Responsiveness</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Identify Source of Supply Cycle Time Accuracy</td>
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
                                <td style="color:#A5B592">On Time<br><?php echo number_format($lastPurchaseOrder['IdentifySourceOnTime']/($lastPurchaseOrder['IdentifySourceOnTime'] + $lastPurchaseOrder['NotOnTimeIdentifySource']) *100, 1); ?>%</td>
                                <td style="color:#F3A447">Not On Time<br><?php echo number_format($lastPurchaseOrder['NotOnTimeIdentifySource']/($lastPurchaseOrder['IdentifySourceOnTime'] + $lastPurchaseOrder['NotOnTimeIdentifySource']) *100, 1); ?>%</td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total On Time for last 16 quarter<br><?php echo $jumlahIdentifySourceOnTime ?></td>
                            <td style="padding: 5px;">Total Not On Time for last 16 quarter<br><?php echo $jumlahNotOnTimeIdentifySource ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>

        <?php
            $query = "SELECT * FROM Purchasedmaterial ORDER BY id DESC LIMIT 16";

            $getPurchaseMaterials = $dbh->prepare($query);
            $getPurchaseMaterials->execute();
            $purchaseMaterials = $getPurchaseMaterials->fetchAll();
            $lastPurchaseMaterials = $purchaseMaterials[0];
               
            $jumlahPurchasedMaterialAktual = 0;
            $jumlahPurchasedMaterialBudget = 0;
            for ($i = 0; $i < count($purchaseOrder); $i++){
                $jumlahPurchasedMaterialAktual += $purchaseMaterials[$i]['PurchasedMaterialAktual'];
                $jumlahPurchasedMaterialBudget += $purchaseMaterials[$i]['PurchasedMaterialBudget'];
            }
            $averagePurchasedMaterialAktual = $jumlahPurchasedMaterialAktual / count($purchaseOrder);
            $averagePurchasedMaterialBudget = $jumlahPurchasedMaterialBudget / count($purchaseOrder);
        ?>
        
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Cost</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Purchased Material Cost</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="dua" style="float:left; color:white"></span>
                    <span style="float:left; text-align:center; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Purchased Material Cost</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Budget<br>Rp. <?php echo number_format($lastPurchaseMaterials['PurchasedMaterialBudget'], 0, ",", ".") ?></td>
                                <td style="color:#F3A447">Actual Cost<br>Rp. <?php echo  number_format($lastPurchaseMaterials['PurchasedMaterialAktual'], 0, ",", ".") ?></td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total Actual Cost for last 16 quarter<br>Rp. <?php echo number_format($jumlahPurchasedMaterialAktual, 0, ",", ".") ?></td>
                            <td style="padding: 5px;">Total Budget for last 16 quarter<br>Rp. <?php echo number_format($jumlahPurchasedMaterialBudget, 0, ",", ".") ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>
        
        <?php
        $query = "SELECT * FROM Source ORDER BY id DESC LIMIT 16";

            $getPurchaseOrder = $dbh->prepare($query);
            $getPurchaseOrder->execute();
            $purchaseOrder = $getPurchaseOrder->fetchAll();
            $lastPurchaseOrder = $purchaseOrder[0];
               
            $jumlahMaterialBiodegradable = 0;
            $jumlahMaterialNotBiodegradable = 0;
            for ($i = 0; $i < count($purchaseOrder); $i++){
                $jumlahMaterialBiodegradable += $purchaseOrder[$i]['MaterialBiodegradable'];
                $jumlahMaterialNotBiodegradable += $purchaseOrder[$i]['MaterialNotBiodegradable'];
            }
            $averageMaterialBiodegradable = $jumlahMaterialBiodegradable / count($purchaseOrder);
            $averageMaterialNotBiodegradable = $jumlahMaterialNotBiodegradable / count($purchaseOrder);
        ?>
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Asset</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Biodegradable Materials Used</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="tiga" style="float:left"></span>
                    <span style="float:left; text-align:center; width: 200px; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Biodegradable Materials Used</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Biodegradable Materials<br><?php echo number_format($lastPurchaseOrder['MaterialBiodegradable']/($lastPurchaseOrder['MaterialBiodegradable'] + $lastPurchaseOrder['MaterialNotBiodegradable']) *100, 1); ?>%</td>
                                <td style="color:#F3A447">Non-Biodegradable Materials<br> <?php echo number_format($lastPurchaseOrder['MaterialNotBiodegradable']/($lastPurchaseOrder['MaterialBiodegradable'] + $lastPurchaseOrder['MaterialNotBiodegradable']) *100, 1); ?>%</td>
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
            
                <div id="attribute-right-bottom" style=" margin-right:2px">
                    <table style="">
                        <tr>
                            <td style="padding: 5px; border-right: solid 2px white;">Total biodegradable materials for last 16 quarter<br> <?php echo $jumlahMaterialBiodegradable ?> </td>
                            <td style="padding: 5px;">Total non biodegradable materials for last 16 quarter<br> <?php echo $jumlahMaterialNotBiodegradable ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>
        
        <?php
        $query = "SELECT * FROM Source ORDER BY id DESC LIMIT 16";

            $getPurchaseOrder = $dbh->prepare($query);
            $getPurchaseOrder->execute();
            $purchaseOrder = $getPurchaseOrder->fetchAll();
            $lastPurchaseOrder = $purchaseOrder[0];
               
            $jumlahMaterialHazardous = 0;
            $jumlahMaterialNotHazardous = 0;
            for ($i = 0; $i < count($purchaseOrder); $i++){
                $jumlahMaterialHazardous += $purchaseOrder[$i]['MaterialHazardous'];
                $jumlahMaterialNotHazardous += $purchaseOrder[$i]['MaterialNotHazardous'];
            }
            $averageMaterialHazardous = $jumlahMaterialHazardous / count($purchaseOrder);
            $averageMaterialNotHazardous = $jumlahMaterialNotHazardous / count($purchaseOrder);
        ?>
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Asset</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Hazardous Materials Used</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="empat" style="float:left"></span>
                    <span style="float:left; text-align:center; width: 200px; margin-left:15px;margin-top:90px;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Hazardous Materials Used</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Hazardous Materials<br> <?php echo number_format($lastPurchaseOrder['MaterialHazardous']/($lastPurchaseOrder['MaterialHazardous'] + $lastPurchaseOrder['MaterialNotHazardous']) *100, 1); ?>%</td>
                                <td style="color:#F3A447">Non-Hazardous Materials<br> <?php echo number_format($lastPurchaseOrder['MaterialNotHazardous']/($lastPurchaseOrder['MaterialHazardous'] + $lastPurchaseOrder['MaterialNotHazardous']) *100, 1); ?>%</td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total hazardous materials for last 16 quarter<br> <?php echo $jumlahMaterialHazardous ?></td>
                            <td style="padding: 5px;">Total non hazardous materials for last 16 quarter<br> <?php echo $jumlahMaterialNotHazardous ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>
        
        <?php
        $query = "SELECT * FROM Source ORDER BY id DESC LIMIT 16";

            $getPurchaseOrder = $dbh->prepare($query);
            $getPurchaseOrder->execute();
            $purchaseOrder = $getPurchaseOrder->fetchAll();
            $lastPurchaseOrder = $purchaseOrder[0];
               
            $jumlahMaterialRecycledorReused = 0;
            $jumlahMaterialNotRecycledorReused = 0;
            for ($i = 0; $i < count($purchaseOrder); $i++){
                $jumlahMaterialRecycledorReused += $purchaseOrder[$i]['MaterialRecycledorReused'];
                $jumlahMaterialNotRecycledorReused += $purchaseOrder[$i]['MaterialNotRecycledorReused'];
            }
            $averageMaterialRecycledorReused = $jumlahMaterialRecycledorReused / count($purchaseOrder);
            $averageMaterialNotRecycledorReused = $jumlahMaterialNotRecycledorReused / count($purchaseOrder);
        ?>
        <div id="attribute">
            
            <div id="attribute-left">
            
                <div id="attribute-title" style="margin-left:2px">
                    <table style="border:0px;border-collapse: collapse; width: 100%; height: 50px">
                        <tr>
                            <td style="background: #c0c0c0; padding: 5px;"><b>Attribute: </b> Asset</td>
                            <td style="background: #d9d9d9; padding: 5px;"><b>KPI: </b> Recycled or Reused Material</td>
                        </tr>
                    </table>
                </div>
                
                <div id="attribute-left-top">
                    <span id="responsiveness-chart-left-top" class="lima" style="float:left"></span>
                    <span style="float:left; text-align:center; width: 200px; margin-left:15px;margin-top:50px;">
                        <table style="text-align:center; font-size:18px">
                            <tr>
                                <td colspan="2" style="color:white">Last Quarter Recycled or Reused Materials Used</td>
                            </tr>
                            <tr style="font-weight:bold">
                                <td style="color:#A5B592">Recycled or Reused Material<br> <?php echo number_format($lastPurchaseOrder['MaterialRecycledorReused']/($lastPurchaseOrder['MaterialRecycledorReused'] + $lastPurchaseOrder['MaterialNotRecycledorReused']) *100, 1); ?>%</td>
                                <td style="color:#F3A447">Not Recycled or Reused Material<br> <?php echo number_format($lastPurchaseOrder['MaterialNotRecycledorReused']/($lastPurchaseOrder['MaterialRecycledorReused'] + $lastPurchaseOrder['MaterialNotRecycledorReused']) *100, 1); ?>%</td>
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
                            <td style="padding: 5px; border-right: solid 2px white;">Total Recycled or Reused materials for last 16 quarter<br> <?php echo $jumlahMaterialRecycledorReused ?></td>
                            <td style="padding: 5px;">Total non Recycled or Reused materials for last 16 quarter<br> <?php echo $jumlahMaterialNotRecycledorReused ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
</body>

<!--Satu-->
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataResponsivenessLeftTop = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['On Time',     <?php echo $lastPurchaseOrder['IdentifySourceOnTime']; ?>],
            ['Not On Time',      <?php echo $lastPurchaseOrder['NotOnTimeIdentifySource']; ?>]
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
            ['', 'Average Source Cycle Time on time for last 16 quarter', 'Average Source Cycle Time not on time for last 16 quarter'],
            ['', <?php echo $averageIdentifySourceOnTime ?>, <?php echo $averageNotOnTimeIdentifySource ?>]
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
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['IdentifySourceOnTime'].", ".$order['NotOnTimeIdentifySource']."],";
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

<!--dua-->

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawColColors);

    function drawColColors() {
        
        var data = new google.visualization.DataTable();
        data.addColumn('string', '');
        data.addColumn('number', 'Budget');
        data.addColumn('number', 'Actual Cost');

        data.addRows([
            ['', <?php echo $lastPurchaseMaterials['PurchasedMaterialBudget'] ?>, <?php echo $lastPurchaseMaterials['PurchasedMaterialAktual'] ?>]
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

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('dua')[0]);
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBarColors);

    function drawBarColors() {
        var data = google.visualization.arrayToDataTable([
            ['', 'Average budget for last 16 quarters', 'Average actual cost for last 16 quarter'],
            ['', <?php echo $averagePurchasedMaterialBudget ?>, <?php echo $averagePurchasedMaterialAktual ?>]
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

        var chart = new google.visualization.BarChart(document.getElementsByClassName('dua')[1]);
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
            for ($i = count($purchaseMaterials)-1; $i >= 0; $i--){
                $material = $purchaseMaterials[$i];
                echo "['Q".$material['Quarter']."-".trim($material['Year'],'20')."', ".$material['PurchasedMaterialBudget'].", ".$material['PurchasedMaterialAktual']."],";
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

        var chart = new google.visualization.ComboChart(document.getElementsByClassName('dua')[2]);
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
            ['Biodegradable Material',     <?php echo $lastPurchaseOrder['MaterialBiodegradable']; ?>],
            ['Non Biodegradable Material',      <?php echo $lastPurchaseOrder['MaterialNotBiodegradable']; ?>]
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
            ['', 'Average Biodegradable Material for last 16 quarter', 'Average Non Biodegradable Material for last 16 quarter'],
            ['', <?php echo $averageMaterialBiodegradable ?>, <?php echo $averageMaterialNotBiodegradable ?>]
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
        data.addColumn('number', 'Biodegradable Material');
        data.addColumn('number', 'Non Biodegradable Material');

        data.addRows([
            <?php
            for ($i = count($purchaseOrder)-1; $i >= 0; $i--){
                $order = $purchaseOrder[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['MaterialBiodegradable'].", ".$order['MaterialNotBiodegradable']."],";
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
            ['Hazardous Material',     <?php echo $lastPurchaseOrder['MaterialHazardous']; ?>],
            ['Non Hazardous Material',      <?php echo $lastPurchaseOrder['MaterialNotHazardous']; ?>]
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
            ['', <?php echo $averageMaterialHazardous ?>, <?php echo $averageMaterialNotHazardous ?>]
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
            <?php
            for ($i = count($purchaseOrder)-1; $i >= 0; $i--){
                $order = $purchaseOrder[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['MaterialHazardous'].", ".$order['MaterialNotHazardous']."],";
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
            ['Recycled or Reused Material',     <?php echo $lastPurchaseOrder['MaterialRecycledorReused']; ?>],
            ['Non Recycled or Reused Material',      <?php echo $lastPurchaseOrder['MaterialNotRecycledorReused']; ?>]
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
            ['', <?php echo $averageMaterialRecycledorReused ?>, <?php echo $averageMaterialRecycledorReused ?>]
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
            <?php
            for ($i = count($purchaseOrder)-1; $i >= 0; $i--){
                $order = $purchaseOrder[$i];
                echo "['Q".$order['Quarter']."-".trim($order['Year'],'20')."', ".$order['MaterialRecycledorReused'].", ".$order['MaterialNotRecycledorReused']."],";
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

        var chart = new google.visualization.ColumnChart(document.getElementsByClassName('lima')[2]);
        chart.draw(data, options);
    }
</script>