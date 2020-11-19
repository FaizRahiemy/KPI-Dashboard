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
            $dir = 'sqlite:../db.db';
            $dbh = new PDO($dir) or die("Cannot open the database");
            $querySnorm = "SELECT * FROM SNORMSource";

            $getSnorm = $dbh->prepare($querySnorm);
            $getSnorm->execute();
            $snorm = $getSnorm->fetchAll();
               
            $queryPurchaseOrder = "SELECT * FROM Source ORDER BY id DESC LIMIT 16";

            $getPurchaseOrder = $dbh->prepare($queryPurchaseOrder);
            $getPurchaseOrder->execute();
            $purchaseOrder = $getPurchaseOrder->fetchAll();
            $lastPurchaseOrder = $purchaseOrder[0];
               
            $jumlahOrderCorrectContent = 0;
            $jumlahOrderNotCorrectContent = 0;
            $jumlahSupplierMeeting = 0;
            $jumlahSupplierNotMeeting = 0;
            $jumlahSupplierCertified = 0;
            $jumlahSupplierUncertified = 0;
            $jumlahOrderOnTime = 0;
            $jumlahOrderNotOnTime = 0;
            $jumlahMaterialRecycledorReused = 0;
            $jumlahMaterialNotRecycledorReused = 0;
            $jumlahMaterialHazardous = 0;
            $jumlahMaterialNotHazardous = 0;
            $jumlahMaterialBiodegradable = 0;
            $jumlahMaterialNotBiodegradable = 0;
                
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
           
            for ($i = 0; $i < count($purchaseOrder); $i++){
                $jumlahOrderCorrectContent += $purchaseOrder[$i]['OrderCorrectContent'];
                $jumlahOrderNotCorrectContent += $purchaseOrder[$i]['OrderNotCorrectContent'];
                $jumlahSupplierCertified += $purchaseOrder[$i]['SupplierCertifiedISO'];
                $jumlahSupplierUncertified += $purchaseOrder[$i]['SupplierUncertifiedISO'];
                $jumlahSupplierMeeting += $purchaseOrder[$i]['SupplierEnvironmentalCriteria'];
                $jumlahSupplierNotMeeting += $purchaseOrder[$i]['SupplierNotEnvironmentalCriteria'];
                $jumlahOrderOnTime += $purchaseOrder[$i]['DemandRequirementOnTime'];
                $jumlahOrderNotOnTime += $purchaseOrder[$i]['DemandRequirementNotOnTime'];
                $jumlahMaterialRecycledorReused += $purchaseOrder[$i]['MaterialRecycledorReused'];
                $jumlahMaterialNotRecycledorReused += $purchaseOrder[$i]['MaterialNotRecycledorReused'];
                $jumlahMaterialHazardous += $purchaseOrder[$i]['MaterialHazardous'];
                $jumlahMaterialNotHazardous += $purchaseOrder[$i]['MaterialNotHazardous'];
                $jumlahMaterialBiodegradable += $purchaseOrder[$i]['MaterialBiodegradable'];
                $jumlahMaterialNotBiodegradable += $purchaseOrder[$i]['MaterialNotBiodegradable'];
            }
//ordercorrectcontent
            $actualValueReliability1 = $lastPurchaseOrder['OrderCorrectContent']/($lastPurchaseOrder['OrderCorrectContent'] + $lastPurchaseOrder['OrderNotCorrectContent']) *100;
            $snormReliability1 = (($actualValueReliability1-$snorm[0]['MinValue'])/($snorm[0]['MaxValue']-$snorm[0]['MinValue']))*100;
            $performanceValueReliability1 = $snormReliability1 * $snorm[0]['Weight'];
//Suppliercerification
            
            $actualValueReliability2 = $lastPurchaseOrder['SupplierEnvironmentalCriteria']/($lastPurchaseOrder['SupplierEnvironmentalCriteria'] + $lastPurchaseOrder['SupplierNotEnvironmentalCriteria']) *100;
            $snormReliability2 = (($actualValueReliability2-$snorm[1]['MinValue'])/($snorm[1]['MaxValue']-$snorm[1]['MinValue']))*100;
            $performanceValueReliability2 = $snormReliability2 * $snorm[1]['Weight'];
//Suppliercerification
            
            $actualValueReliability3 = $lastPurchaseOrder['SupplierCertifiedISO']/($lastPurchaseOrder['SupplierCertifiedISO'] + $lastPurchaseOrder['SupplierUncertifiedISO']) *100;
            $snormReliability3 = (($actualValueReliability3-$snorm[2]['MinValue'])/($snorm[2]['MaxValue']-$snorm[2]['MinValue']))*100;
            $performanceValueReliability3 = $snormReliability3 * $snorm[2]['Weight'];
//OrderOntime
            
            $actualValueReliability4 = $lastPurchaseOrder['DemandRequirementOnTime']/($lastPurchaseOrder['DemandRequirementOnTime'] + $lastPurchaseOrder['DemandRequirementNotOnTime']) *100;
            $snormReliability4 = (($actualValueReliability4-$snorm[3]['MinValue'])/($snorm[3]['MaxValue']-$snorm[3]['MinValue']))*100;
            $performanceValueReliability4 = $snormReliability4 * $snorm[3]['Weight'];
//PurchasedOrder
            
            $actualValueReliability5 = ($lastPurchaseMaterials['PurchasedMaterialAktual']);
            $snormReliability5 = (($actualValueReliability5-$snorm[4]['MinValue'])/($snorm[4]['MaxValue']-$snorm[4]['MinValue']))*100;
            $performanceValueReliability5 = $snormReliability5 * $snorm[4]['Weight'];
//MaterialRecycledorReused
            
            $actualValueReliability6 = $lastPurchaseOrder['MaterialRecycledorReused']/($lastPurchaseOrder['MaterialRecycledorReused'] + $lastPurchaseOrder['MaterialNotRecycledorReused']) *100;
            $snormReliability6 = (($actualValueReliability6-$snorm[5]['MinValue'])/($snorm[5]['MaxValue']-$snorm[5]['MinValue']))*100;
            $performanceValueReliability6 = $snormReliability6 * $snorm[5]['Weight'];
//MaterialHazardous
            
            $actualValueReliability7 = $lastPurchaseOrder['MaterialHazardous']/($lastPurchaseOrder['MaterialHazardous'] + $lastPurchaseOrder['MaterialNotHazardous']) *100;
            $snormReliability7 = (($actualValueReliability7-$snorm[6]['MinValue'])/($snorm[6]['MaxValue']-$snorm[6]['MinValue']))*100;
            $performanceValueReliability7 = $snormReliability7 * $snorm[6]['Weight'];
//MaterialBiodegradable
            
            $actualValueReliability8 = $lastPurchaseOrder['MaterialBiodegradable']/($lastPurchaseOrder['MaterialBiodegradable'] + $lastPurchaseOrder['MaterialNotBiodegradable']) *100;
            $snormReliability8 = (($actualValueReliability8-$snorm[7]['MinValue'])/($snorm[7]['MaxValue']-$snorm[7]['MinValue']))*100;
            $performanceValueReliability8 = $snormReliability8 * $snorm[7]['Weight'];
//Totalperformancevalue
            $totalperformance = $performanceValueReliability1 + $performanceValueReliability2 + $performanceValueReliability3 + $performanceValueReliability4 + $performanceValueReliability5 + $performanceValueReliability6 + $performanceValueReliability7 + $performanceValueReliability8;
               
//TotalperformanceReliability
            $totalperformanceReliability = $performanceValueReliability1 + $performanceValueReliability2 + $performanceValueReliability3;
               
//TotalperformanceResponsiveness
            $totalperformanceResponsiveness = $performanceValueReliability4;
                
//TotalperformanceCost
            $totalperformanceCost = $performanceValueReliability5;
                
//Totalperformance Asset
            $totalperformanceAsset = $performanceValueReliability6 + $performanceValueReliability7 + $performanceValueReliability8;
               
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
                    <td align="center" rowspan="3">RELIABILITY</td>
                    <td align="center"><?php echo $snorm[0]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[0]['Quarter']."-".trim($snorm[0]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability1, 1); ?></td>
                    <td align="center"><?php echo $snorm[0]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[0]['MaxValue'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability1,2) ?></td>
                    <td align="center"><?php echo $snorm[0]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability1,2) ?></td>
                </tr>
                <tr style="background: #A5B591; height: 30px; ">
                    <td align="center"><?php echo $snorm[1]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[1]['Quarter']."-".trim($snorm[1]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability2, 1); ?></td>
                    <td align="center"><?php echo $snorm[1]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[1]['MaxValue'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability2,2) ?></td>
                    <td align="center"><?php echo $snorm[1]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability2,2) ?></td>
                </tr>
                <tr style="background: #A5B591; height: 30px; ">
                    <td align="center"><?php echo $snorm[2]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[2]['Quarter']."-".trim($snorm[2]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability3, 1); ?></td>
                    <td align="center"><?php echo $snorm[2]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[2]['MaxValue'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability3,2) ?></td>
                    <td align="center"><?php echo $snorm[2]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability3,2) ?></td>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #F3A447; height: 30px; ">
                    <td align="center" rowspan="1">RESPONSIVENESS</td>
                    <td align="center"><?php echo $snorm[3]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[3]['Quarter']."-".trim($snorm[3]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability4, 1); ?></td>
                    <td align="center"><?php echo $snorm[3]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[3]['MaxValue'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability4,2) ?></td>
                    <td align="center"><?php echo $snorm[3]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability4,2) ?></td>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #E6BC28; height: 30px; ">
                    <td align="center" rowspan="1">COST</td>
                    <td align="center"><?php echo $snorm[4]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[4]['Quarter']."-".trim($snorm[4]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability5, 1); ?></td>
                    <td align="center"><?php echo $snorm[4]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[4]['MaxValue'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability5,2) ?></td>
                    <td align="center"><?php echo $snorm[4]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability5,2) ?></td>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #D092A7; height: 30px; ">
                    <td align="center" rowspan="3">ASSTETS</td>
                    <td align="center"><?php echo $snorm[5]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[5]['Quarter']."-".trim($snorm[5]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability6, 1); ?></td>
                    <td align="center"><?php echo $snorm[5]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[5]['MaxValue'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability6,2) ?></td>
                    <td align="center"><?php echo $snorm[5]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability6,2) ?></td>
                </tr>
                <tr style="background: #D092A7; height: 30px; ">
                    <td align="center"><?php echo $snorm[6]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[6]['Quarter']."-".trim($snorm[6]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability7, 1); ?></td>
                    <td align="center"><?php echo $snorm[6]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[6]['MaxValue'] ?></td>
                    <td align="center"><?php echo number_format($snormReliability7,2) ?></td>
                    <td align="center"><?php echo $snorm[6]['Weight'] ?></td>
                    <td align="center"><?php echo number_format($performanceValueReliability7,2) ?></td>
                </tr>
                <tr style="background: #D092A7; height: 30px; ">
                    <td align="center"><?php echo $snorm[7]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[7]['Quarter']."-".trim($snorm[7]['Tahun'],'20') ?></td>
                    <td align="center"><?php echo number_format($actualValueReliability8, 1); ?></td>
                    <td align="center"><?php echo $snorm[7]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[7]['MaxValue'] ?></td>
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
            
            <a href="<?php echo $baseUrl ?>source/edit-snorm.php"><div style="background:#c0c0c0; width:100px; height: 30px; text-align:center; margin-top:20px; line-height:30px">Edit Value</div></a>
                        
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