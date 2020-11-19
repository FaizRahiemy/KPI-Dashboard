<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">SOURCE - ATTRIBUTE KPIS PERFORMANCE VALUES</span>
        </div>

        <?php
            $dir = 'sqlite:../dbMake.db';
            $dbh = new PDO($dir) or die("Cannot open the database");
            $query = "SELECT * FROM SNORMMake";

            $getSnorm = $dbh->prepare($query);
            $getSnorm->execute();
            $snorm = $getSnorm->fetchAll();
            $queryPurchaseOrder = "SELECT * FROM Source ORDER BY id DESC LIMIT 16";

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
            $jumlahwasteOntime = 0;
            $jumlahwasteNotOntime = 0;
            $jumlahActual = 0;
            $jumlahBudget = 0;
            $jumlahUsed = 0;
            $jumlahUnused = 0;
            $jumlahHazard = 0;
            $jumlahNonHazard = 0;
            $jumlahRecyclable = 0;
            $jumlahNonRecyclable = 0;
            for ($i = 0; $i < count($makeArray); $i++){
                $jumlahOutput += $makeArray[$i]['ProductionOutput'];
                $jumlahWaste += $makeArray[$i]['ProductionWaste'];
                $jumlahOntime += $makeArray[$i]['MakeCycleTimeAccuracyOntime'];
                $jumlahNotOntime += $makeArray[$i]['MakeCycleTimeAccuracyNotOntime'];
                $jumlahHazardous += $makeArray[$i]['HazardousMateriaTypeUsed'];
                $jumlahNonHazardous += $makeArray[$i]['NonHazardousMaterialTypeUsed'];
                $jumlahwasteOntime += $makeArray[$i]['OnTimeWaste'];
                $jumlahwasteNotOntime += $makeArray[$i]['NotOnTimeWaste'];
                $jumlahActual += $makeArray[$i]['ProductionActualCost'];
                $jumlahBudget += $makeArray[$i]['ProductionBudget'];
                $jumlahUsed += $makeArray[$i]['UsedCapacity'];
                $jumlahUnused += $makeArray[$i]['UnusedCapacity'];
                $jumlahHazard += $makeArray[$i]['HazardousWaste'];
                $jumlahNonHazard += $makeArray[$i]['NonHazardousWaste'];
                $jumlahRecyclable += $makeArray[$i]['RecyclableWaste'];
                $jumlahNonRecyclable += $makeArray[$i]['NonRecylableWaste'];
            }
                
//Yield
            $actualValueReliability1 = $lastMake['ProductionOutput']/($lastMake['ProductionOutput'] + $lastMake['ProductionWaste']) *100;
            $snormReliability1 = (($actualValueReliability1-$snorm[0]['Minimal'])/($snorm[0]['Maximal']-$snorm[0]['Minimal']))*100;
            $performanceValueReliability1 = $snormReliability1 * $snorm[0]['Weight'];

//Make cycle time accuracy
            $actualValueReliability2 = $lastMake['MakeCycleTimeAccuracyOntime']/($lastMake['MakeCycleTimeAccuracyOntime'] + $lastMake['MakeCycleTimeAccuracyNotOntime']) *100;
            $snormReliability2 = (($actualValueReliability2-$snorm[1]['Minimal'])/($snorm[1]['Maximal']-$snorm[1]['Minimal']))*100;
            $performanceValueReliability2 = $snormReliability2 * $snorm[1]['Weight'];  
               
//Waste disposal cycle time accuracy
            $actualValueReliability3 = $lastMake['OnTimeWaste']/($lastMake['OnTimeWaste'] + $lastMake['NotOnTimeWaste']) *100;
            $snormReliability3 = (($actualValueReliability3-$snorm[2]['Minimal'])/($snorm[2]['Maximal']-$snorm[2]['Minimal']))*100;
            $performanceValueReliability3 = $snormReliability3 * $snorm[2]['Weight'];  
        
//Direct Production Cost
            $actualValueReliability4 = $lastMake['ProductionActualCost']/($lastMake['ProductionBudget']) *100;
            $snormReliability4 = (($actualValueReliability4-$snorm[3]['Minimal'])/($snorm[3]['Maximal']-$snorm[3]['Minimal']))*100;
            $performanceValueReliability4 = $snormReliability4 * $snorm[3]['Weight'];  
               
//Total Recyclable Waste
            $actualValueReliability5 = $lastMake['RecyclableWaste']/($lastMake['RecyclableWaste'] + $lastMake['NonRecylableWaste']) *100;
            $snormReliability5 = (($actualValueReliability5-$snorm[4]['Minimal'])/($snorm[4]['Maximal']-$snorm[4]['Minimal']))*100;
            $performanceValueReliability5 = $snormReliability5 * $snorm[4]['Weight'];
            
//Utlization of Production Capacity
            $actualValueReliability6 = $lastMake['UsedCapacity']/($lastMake['UsedCapacity'] + $lastMake['UnusedCapacity']) *100;
            $snormReliability6 = (($actualValueReliability6-$snorm[5]['Minimal'])/($snorm[5]['Maximal']-$snorm[5]['Minimal']))*100;
            $performanceValueReliability6 = $snormReliability6 * $snorm[5]['Weight'];  
               
//Total Hazardous Materials Used
            $actualValueReliability7 = $lastMake['HazardousMateriaTypeUsed']/($lastMake['HazardousMateriaTypeUsed'] + $lastMake['NonHazardousMaterialTypeUsed']) *100;
            $snormReliability7 = (($actualValueReliability7-$snorm[6]['Minimal'])/($snorm[6]['Maximal']-$snorm[6]['Minimal']))*100;
            $performanceValueReliability7 = $snormReliability7 * $snorm[6]['Weight'];  
               
//Total Hazardous Waste
            $actualValueReliability8 = $lastMake['HazardousWaste']/($lastMake['HazardousWaste'] + $lastMake['NonHazardousWaste']) *100;
            $snormReliability8 = (($actualValueReliability8-$snorm[7]['Minimal'])/($snorm[7]['Maximal']-$snorm[7]['Minimal']))*100;
            $performanceValueReliability8 = $snormReliability8 * $snorm[7]['Weight'];  
               
//Total Performance Value
            $totalperformance = $performanceValueReliability1 + $performanceValueReliability2 + $performanceValueReliability3 + $performanceValueReliability4 + $performanceValueReliability5 + $performanceValueReliability6 + $performanceValueReliability7 + $performanceValueReliability8;
            
//TotalperformanceReliability
            $totalperformanceReliability = $performanceValueReliability1;
               
//TotalperformanceResponsiveness
            $totalperformanceResponsiveness =  + $performanceValueReliability2 + $performanceValueReliability3; 
                
//TotalperformanceCost
            $totalperformanceCost = $performanceValueReliability4;
                
//Totalperformance Asset
            $totalperformanceAsset =  $performanceValueReliability5 + $performanceValueReliability6 + $performanceValueReliability7 + $performanceValueReliability8;
               
//TotalperformanceSource
            $totalperformancesource = $totalperformanceReliability + $totalperformanceResponsiveness + $totalperformanceCost + $totalperformanceAsset;
        ?>
        <div id="attributes">
            
            <div id="attributes-full-atas"></div>
            
            <table style="width:100%; margin-top: 20px; border:0px; border-collapse: collapse; ">
                <tr style="background: #C0C0C0; height: 30px; ">
                    <th>ATTRIBUTE</th>
                    <th>KPI</th>
                    <th>Period</th>
                    <th>Actual Value</th>
                    <th>Min Value</th>
                    <th>Max Value</th>
                    <th>SNORM Value</th>
                    <th>Weight</th>
                    <th>Performance Value</th>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #A5B591; height: 30px; ">
                    <td align="center" rowspan="1">RELIABILITY</td>
                    <td align="center"><?php echo $snorm[0]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[0]['Quarter']."-".trim($snorm[0]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability1, 2); ?></td>
                    <td align="center"><?php echo $snorm[0]['Minimal'] ?></td>
                    <td align="center"><?php echo $snorm[0]['Maximal'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability1,2) ?></td>
                    <td align="center"><?php echo $snorm[0]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability1,2) ?></td>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #F3A447; height: 30px; ">
                    <td align="center" rowspan="2">RESPONSIVENESS</td>
                     <td align="center"><?php echo $snorm[1]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[1]['Quarter']."-".trim($snorm[1]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability2, 2); ?></td>
                    <td align="center"><?php echo $snorm[1]['Minimal'] ?></td>
                    <td align="center"><?php echo $snorm[1]['Maximal'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability2,2) ?></td>
                    <td align="center"><?php echo $snorm[1]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability2,2) ?></td>
                </tr>
                <tr style="background: #F3A447; height: 30px; ">
                    <td align="center"><?php echo $snorm[2]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[2]['Quarter']."-".trim($snorm[2]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability3, 2); ?></td>
                    <td align="center"><?php echo $snorm[2]['Minimal'] ?></td>
                    <td align="center"><?php echo $snorm[2]['Maximal'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability3,2) ?></td>
                    <td align="center"><?php echo $snorm[2]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability3,2) ?></td>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #E6BC28; height: 30px; ">
                    <td align="center">COSTS</td>
                    <td align="center"><?php echo $snorm[3]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[3]['Quarter']."-".trim($snorm[3]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability4, 2); ?></td>
                    <td align="center"><?php echo $snorm[3]['Minimal'] ?></td>
                    <td align="center"><?php echo $snorm[3]['Maximal'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability4,2) ?></td>
                    <td align="center"><?php echo $snorm[3]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability4,2) ?></td>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #D092A7; height: 30px; ">
                    <td align="center" rowspan="4">ASSETS MANAGEMENT EFFICIENCY</td>
                    <td align="center"><?php echo $snorm[4]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[4]['Quarter']."-".trim($snorm[4]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability5, 2); ?></td>
                    <td align="center"><?php echo $snorm[4]['Minimal'] ?></td>
                    <td align="center"><?php echo $snorm[4]['Maximal'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability5,2) ?></td>
                    <td align="center"><?php echo $snorm[4]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability5,2) ?></td>
                </tr>
                <tr style="background: #D092A7; height: 30px; ">
                    <td align="center"><?php echo $snorm[5]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[5]['Quarter']."-".trim($snorm[5]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability6, 2); ?></td>
                    <td align="center"><?php echo $snorm[5]['Minimal'] ?></td>
                    <td align="center"><?php echo $snorm[5]['Maximal'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability6,2) ?></td>
                    <td align="center"><?php echo $snorm[5]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability6,2) ?></td>
                </tr>
                <tr style="background: #D092A7; height: 30px; ">
                    <td align="center"><?php echo $snorm[6]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[6]['Quarter']."-".trim($snorm[6]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability7, 2); ?></td>
                    <td align="center"><?php echo $snorm[6]['Minimal'] ?></td>
                    <td align="center"><?php echo $snorm[6]['Maximal'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability7,2) ?></td>
                    <td align="center"><?php echo $snorm[6]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability7,2) ?></td>
                </tr>
                <tr style="background: #D092A7; height: 30px; ">
                    <td align="center"><?php echo $snorm[7]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[7]['Quarter']."-".trim($snorm[7]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability8, 2); ?></td>
                    <td align="center"><?php echo $snorm[7]['Minimal'] ?></td>
                    <td align="center"><?php echo $snorm[7]['Maximal'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability8,2) ?></td>
                    <td align="center"><?php echo $snorm[7]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability8,2) ?></td>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #C3BFC0; height: 30px; ">
                    <td align="center" colspan="8">TOTAL PERFORMANCE VALUE</td>
                    <td align="center"><?php echo number_format($totalperformance,2)?></td>
                </tr>
            </table>
            
            <a href="<?php echo $baseUrl ?>make/edit-snorm.php"><div style="background:#c0c0c0; width:100px; height: 30px; text-align:center; margin-top:20px; line-height:30px">Edit Value</div></a>
                        
        </div>

    </div>
    
</body>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked);

    function drawStacked() {
        var data = google.visualization.arrayToDataTable([
            ['', 'Reliability', 'Responsiveness', 'Costs', 'Assets Management Efficiency'],
            ['Performance', <?php echo $totalperformanceReliability;?>, <?php echo $totalperformanceResponsiveness;?>, <?php echo $totalperformanceCost;?>, <?php echo $totalperformanceAsset;?>]
        ]);

        var options = {
            height: '170',
            title: 'Last Quarter Performance Value',
            colors:['#A5B592','#F3A447', '#E5BC2C', '#D092A7'],
            chartArea: {
                width: '85%'
            },
            isStacked: true,
            backgroundColor: { fill:'transparent' },
            titleTextStyle: {
                color: '#FFF'
            },
            legend: {
                position: 'bottom', 
                textStyle: {
                    color: 'white', 
                    fontSize: 10
                }
            },
            hAxis: {
                ticks: [0, 25, 50, 75, 100],
                titleTextStyle: {
                    color: '#FFF'
                },
                minValue: 0,
                maxValue: 100,
                textStyle: {
                    color: '#FFF'
                },
            },
            vAxis: {
                textStyle: {
                    color: '#FFF'
                },
            }
        };
        var chart = new google.visualization.BarChart(document.getElementById('attributes-full-atas'));
        chart.draw(data, options);
    }
</script>