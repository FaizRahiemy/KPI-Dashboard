<?php
require 'layout.php';
?>

<body>
    <div id="container">
        <?php
            $dir = 'sqlite:db.db';
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
        
//        MAKE
        
            $dir = 'sqlite:dbMake.db';
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
            $totalperformanceReliabilityMake = $performanceValueReliability1;
               
//TotalperformanceResponsiveness
            $totalperformanceResponsivenessMake =  + $performanceValueReliability2 + $performanceValueReliability3; 
                
//TotalperformanceCost
            $totalperformanceCostMake = $performanceValueReliability4;
                
//Totalperformance Asset
            $totalperformanceAssetMake =  $performanceValueReliability5 + $performanceValueReliability6 + $performanceValueReliability7 + $performanceValueReliability8;
               
//TotalperformanceSource
            $totalperformanceMake = $totalperformanceReliabilityMake + $totalperformanceResponsivenessMake + $totalperformanceCostMake + $totalperformanceAssetMake;
        
//        DELIVER
        
            $dirDeliver = 'sqlite:deliver2.db';
            $dbhDeliver = new PDO($dirDeliver) or die("Cannot open the database");
            $querySnormDeliver = "SELECT * FROM snorm";

            $getSnormDeliver = $dbhDeliver->prepare($querySnormDeliver);
            $getSnormDeliver->execute();
            $snormDeliver = $getSnormDeliver->fetchAll();
               
            $totalReliabilityDeliver = $snormDeliver[0]['Performance']*100 + $snormDeliver[1]['Performance']*100;
               
            $totalResponsivenessDeliver = $snormDeliver[2]['Performance']*100 + $snormDeliver[3]['Performance']*100 + $snormDeliver[4]['Performance']*100 + $snormDeliver[5]['Performance']*100 + $snormDeliver[6]['Performance']*100;
            
            $totalPerformanceDeliver = $totalReliabilityDeliver + $totalResponsivenessDeliver + $snormDeliver[7]['Performance']*100;
        
//        OVERALL PERFORMANCE
        
            $dirov = 'sqlite:dball.db';
            $dbhov = new PDO($dirov) or die("Cannot open the database");
            $queryov = "SELECT * FROM performance";

            $getov = $dbhov->prepare($queryov);
            $getov->execute();
            $performance = $getov->fetchAll();
            $performance = $performance[0];
        
            $overallPerformance = $totalperformancesource * $performance['source'] + $totalperformanceMake * $performance['make'] + $totalPerformanceDeliver * $performance['deliver'];
        ?>
        
        <div id="header">
            
            <div id="logo">
                <span>KPI DASHBOARD</span>
            </div>
            
            <div id="title">
                <span>Sustainability Monitoring System, Based on Supply Chain Operational References Model for Leather Tanning Industry</span>
            </div>
            
        </div>
        
        <div id="content">
            
            <div id="home-left">
                
                <div id="button-home-left" onmouseover="document.getElementsByClassName('make-burger')[0].style.display = 'none';
                                                        document.getElementsByClassName('delivery-burger')[0].style.display = 'none';
                                                        document.getElementsByClassName('source-burger')[0].style.display = 'block';">
                    <span>LEVEL SCOR <br>
                        <b>SOURCE</b><br>
                        ENGINEER TO ORDER
                    </span>
                    <img src="<?php echo $baseUrl ?>img/source.png">
                </div>
                
                <div id="button-home-left" onmouseover="document.getElementsByClassName('source-burger')[0].style.display = 'none';
                                                        document.getElementsByClassName('delivery-burger')[0].style.display = 'none';
                                                        document.getElementsByClassName('make-burger')[0].style.display = 'block';">
                    <span>LEVEL SCOR <br>
                        <b>MAKE</b><br>
                        ENGINEER TO ORDER
                    </span>
                    <img src="<?php echo $baseUrl ?>img/make.png">
                </div>
                
                <div id="button-home-left" onmouseover="document.getElementsByClassName('source-burger')[0].style.display = 'none';
                                                        document.getElementsByClassName('make-burger')[0].style.display = 'none';
                                                        document.getElementsByClassName('delivery-burger')[0].style.display = 'block';">
                    <span>LEVEL SCOR <br>
                        <b>DELIVER</b><br>
                        ENGINEER TO ORDER
                    </span>
                    <img src="<?php echo $baseUrl ?>img/delivery.png">
                </div>
                
            </div>
            
            <div id="home-right">
                
                <div id="home-performance">
                    <span id="overallperf" style="width: 130px; height: 130px;" ></span>
                    <span>Overall Performance<br>
                    <?php echo number_format($overallPerformance, 2) ?>%</span>
                    <div style="float:right; margin-right:68px; line-height:0px; margin-top: 15px; text-align: left">
                        <span style="font-size:12px;"><div style="float: left; margin-top: 2px; margin-right: 5px; background:#008000; width:20px; height:10px;"></div> Excellent</span><br>
                        <span style="font-size:12px;"><div style="float: left; margin-top: 2px; margin-right: 5px; background:#00cd00; width:20px; height:10px;"></div> Good</span><br>
                        <span style="font-size:12px;"><div style="float: left; margin-top: 2px; margin-right: 5px; background:#ffff00; width:20px; height:10px;"></div> Average</span><br>
                        <span style="font-size:12px;"><div style="float: left; margin-top: 2px; margin-right: 5px; background:#ff9933; width:20px; height:10px;"></div> Marginal</span><br>
                        <span style="font-size:12px;"><div style="float: left; margin-top: 2px; margin-right: 5px; background:#ff4c4c; width:20px; height:10px;"></div> Poor</span>
                    </div>
                </div>
                
                <div id="performance-home-right">
                    <div id="perf-home-graph">
                        <div id="sourcegraph" style="float:left; width: 130px; height: 130px;" ></div>
                        <div style="position:relative; right:0px; margin-right:5px; font-size:20; text-align:right">Source Performance<br><?php echo number_format($totalperformancesource, 2) ?>%</div>
                    </div>
                    <div id="perf-home-attribute">
                        <a href="<?php echo $baseUrl ?>source/attribute-source.php"><span class="source-bar"></span></a>
                    </div>
                </div>
                
                <div id="performance-home-right">
                    <div id="perf-home-graph">
                        <div id="makegraph" style="float:left; width: 130px; height: 130px;" ></div>
                        <div style="position:relative; right:0px; margin-right:5px; font-size:20; text-align:right">Make Performance<br><?php echo number_format($totalperformanceMake, 2) ?>%</div>
                    </div>
                    <div id="perf-home-attribute">
                        <a href="<?php echo $baseUrl ?>make/attribute-make.php"><span class="make-bar"></span></a>
                    </div>
                </div>
                
                <div id="performance-home-right">
                    <div id="perf-home-graph">
                        <div id="delivergraph" style="float:left; width: 130px; height: 130px;" ></div>
                        <div style="position:relative; right:0px; margin-right:5px; font-size:20; text-align:right">Deliver Performance<br><?php echo number_format($totalPerformanceDeliver, 2) ?>%</div>
                    </div>
                    <div id="perf-home-attribute">
                        <a href="<?php echo $baseUrl ?>deliver/attribute-deliver.php"><span class="delivery-bar"></span></a>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
    <div id="burger" class="source-burger">
        <div id="burger-close" onclick="document.getElementsByClassName('source-burger')[0].style.display = 'none';">X</div><br>
        
        <div id="burger-title">LEVEL 1 SCOR SOURCE - ENGINEER TO ORDER</div>
        
        <a href="<?php echo $baseUrl ?>source/source-satu.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sS.3. 1. Identification Source of Supply</div></a>
        
        <a href="<?php echo $baseUrl ?>source/source-dua.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sS.3. 2. Select Final Supplier and Negotiate</div></a>
        
        <a href="<?php echo $baseUrl ?>source/source-tiga.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sS.3. 3. Schedule Product Deliveries</div></a>
        
        <a href="<?php echo $baseUrl ?>source/source-empat.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sS.3. 4. Receive Product</div></a>
        
        <a href="<?php echo $baseUrl ?>source/source-lima.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sS.3. 5. Verify Product</div></a>
        
        <a href="<?php echo $baseUrl ?>source/source-enam.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sS.3. 6. Transferred Product</div></a>
        
        <a href="<?php echo $baseUrl ?>source/source-tujuh.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sS.3. 7. Authorize Supplier Payment</div></a>
        
        <a href="<?php echo $baseUrl ?>source/input.php"><div id="burger-button" style="height: 30px; width: 100px; line-height: 30px; position: fixed; bottom: 10px; font-size:16px">Input Data</div></a>
    </div>
    
    <div id="burger" class="make-burger">
        <div id="burger-close" onclick="document.getElementsByClassName('make-burger')[0].style.display = 'none';">X</div><br>
        
        <div id="burger-title">LEVEL 1 SCOR MAKE - ENGINEER TO ORDER</div>
        
        <a href="<?php echo $baseUrl ?>make/make-satu.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sM.3. 1. Finalize Production Engineering</div></a>
        
        <a href="<?php echo $baseUrl ?>make/make-dua.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sM.3. 2. Schedule Production Activities</div></a>
        
        <a href="<?php echo $baseUrl ?>make/make-tiga.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sM.3. 3. Issue sourced / in-process Product</div></a>
        
        <a href="<?php echo $baseUrl ?>make/make-empat.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sM.3. 4. Produce and Test</div></a>
        
        <a href="<?php echo $baseUrl ?>make/make-lima.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sM.3. 5. Package</div></a>
        
        <a href="<?php echo $baseUrl ?>make/make-enam.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sM.3. 6. Stage Finished Product</div></a>
        
        <a href="<?php echo $baseUrl ?>make/make-tujuh.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sM.3. 7. Release Product to Deliver</div></a>
        
        <a href="<?php echo $baseUrl ?>make/make-delapan.php"><div id="burger-button" style="height: 50px; line-height: 50px;">sM.3. 8. Waste Disposal</div></a>
        
        <a href="<?php echo $baseUrl ?>make/input.php"><div id="burger-button" style="height: 30px; width: 100px; line-height: 30px; position: fixed; bottom: 10px; font-size:16px">Input Data</div></a>
    </div>
    
    <div id="burger" class="delivery-burger">
        <div id="burger-close" onclick="document.getElementsByClassName('delivery-burger')[0].style.display = 'none';">X</div><br>
        
        <div id="burger-title">LEVEL 1 SCOR DELIVERY - ENGINEER TO ORDER</div>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-satu.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 1. Obtain and Respond to RFP/RFQ</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-dua.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 2. Negotiate and Receive Contract</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-tiga.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 3. Enter Order, Commit Resources & Launch Program</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-empat.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 4. Schedule Intallation</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-lima.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 5. Build Loads</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-enam.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 6. Route Shipments</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-tujuh.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 7. Select Carriers & Rate Shipments</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-delapan.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 8. Receive Product from Source or Make</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-sembilan.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 9. Pick Product</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-sepuluh.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 10. Pack Product</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-sebelas.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 11. Load Product & Generate Shipping Docs</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-duabelas.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 12. Ship Product</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-tigabelas.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 13. Receive and Verify Product by Customer</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-empatbelas.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 14. Install Product</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/deliver-limabelas.php"><div id="burger-button" style="height: 25px; line-height: 25px;">sM.3. 15. Invoice</div></a>
        
        <a href="<?php echo $baseUrl ?>deliver/input.php"><div id="burger-button" style="height: 20px; width: 100px; line-height: 20px; position: fixed; bottom: 5px; font-size:16px">Input Data</div></a>
    </div>
    
</body>

<script type="text/javascript">
    AmCharts.makeChart("overallperf",
        {
            "type": "gauge",
            "marginBottom": 0,
            "marginTop": 0,
            "startDuration": 0,
            "backgroundAlpha": 0,
            "borderAlpha": 0,
            "fontSize": 0,
            "processTimeout": -1,
            "arrows": [
                {
                    "id": "GaugeArrow-1",
                    "value": <?php echo number_format($overallPerformance, 2) ?>
                }
            ],
            "axes": [
                {
                    "bottomText": "0",
                    "bottomTextYOffset": -20,
                    "endValue": 100,
                    "id": "GaugeAxis-1",
                    "valueInterval": 10,
                    "bands": [
                        {
                            "alpha": 1,
                            "color": "#008000",
                            "endValue": 100,
                            "id": "GaugeBand-1",
                            "startValue": 90
                        },
                        {
                            "alpha": 1,
                            "color": "#00cd00",
                            "endValue": 90,
                            "id": "GaugeBand-2",
                            "startValue": 70
                        },
                        {
                            "alpha": 1,
                            "color": "#ffff00",
                            "endValue": 70,
                            "id": "GaugeBand-3",
                            "startValue": 50
                        },
                        {
                            "alpha": 1,
                            "color": "#ff9933",
                            "endValue": 50,
                            "id": "GaugeBand-4",
                            "innerRadius": "95%",
                            "startValue": 40
                        },
                        {
                            "alpha": 1,
                            "color": "#ff4c4c",
                            "endValue": 40,
                            "id": "GaugeBand-4",
                            "innerRadius": "95%",
                            "startValue": 0
                        }
                    ]
                }
            ],
            "allLabels": [],
            "balloon": {},
            "titles": []
        }
    );
</script>

<script type="text/javascript">
    AmCharts.makeChart("sourcegraph",
        {
            "type": "gauge",
            "marginBottom": 0,
            "marginTop": 0,
            "startDuration": 0,
            "backgroundAlpha": 0,
            "borderAlpha": 0,
            "fontSize": 0,
            "processTimeout": -1,
            "arrows": [
                {
                    "id": "GaugeArrow-1",
                    "value": <?php echo number_format($totalperformancesource,2) ?>
                }
            ],
            "axes": [
                {
                    "bottomText": "0",
                    "bottomTextYOffset": -20,
                    "endValue": 100,
                    "id": "GaugeAxis-1",
                    "valueInterval": 10,
                    "bands": [
                        {
                            "alpha": 1,
                            "color": "#008000",
                            "endValue": 100,
                            "id": "GaugeBand-1",
                            "startValue": 90
                        },
                        {
                            "alpha": 1,
                            "color": "#00cd00",
                            "endValue": 90,
                            "id": "GaugeBand-2",
                            "startValue": 70
                        },
                        {
                            "alpha": 1,
                            "color": "#ffff00",
                            "endValue": 70,
                            "id": "GaugeBand-3",
                            "startValue": 50
                        },
                        {
                            "alpha": 1,
                            "color": "#ff9933",
                            "endValue": 50,
                            "id": "GaugeBand-4",
                            "innerRadius": "95%",
                            "startValue": 40
                        },
                        {
                            "alpha": 1,
                            "color": "#ff4c4c",
                            "endValue": 40,
                            "id": "GaugeBand-4",
                            "innerRadius": "95%",
                            "startValue": 0
                        }
                    ]
                }
            ],
            "allLabels": [],
            "balloon": {},
            "titles": []
        }
    );
</script>

<script type="text/javascript">
    AmCharts.makeChart("makegraph",
        {
            "type": "gauge",
            "marginBottom": 0,
            "marginTop": 0,
            "startDuration": 0,
            "backgroundAlpha": 0,
            "borderAlpha": 0,
            "fontSize": 0,
            "processTimeout": -1,
            "arrows": [
                {
                    "id": "GaugeArrow-1",
                    "value": <?php echo number_format($totalperformanceMake,2) ?>
                }
            ],
            "axes": [
                {
                    "bottomText": "0",
                    "bottomTextYOffset": -20,
                    "endValue": 100,
                    "id": "GaugeAxis-1",
                    "valueInterval": 10,
                    "bands": [
                        {
                            "alpha": 1,
                            "color": "#008000",
                            "endValue": 100,
                            "id": "GaugeBand-1",
                            "startValue": 90
                        },
                        {
                            "alpha": 1,
                            "color": "#00cd00",
                            "endValue": 90,
                            "id": "GaugeBand-2",
                            "startValue": 70
                        },
                        {
                            "alpha": 1,
                            "color": "#ffff00",
                            "endValue": 70,
                            "id": "GaugeBand-3",
                            "startValue": 50
                        },
                        {
                            "alpha": 1,
                            "color": "#ff9933",
                            "endValue": 50,
                            "id": "GaugeBand-4",
                            "innerRadius": "95%",
                            "startValue": 40
                        },
                        {
                            "alpha": 1,
                            "color": "#ff4c4c",
                            "endValue": 40,
                            "id": "GaugeBand-4",
                            "innerRadius": "95%",
                            "startValue": 0
                        }
                    ]
                }
            ],
            "allLabels": [],
            "balloon": {},
            "titles": []
        }
    );
</script>

<script type="text/javascript">
    AmCharts.makeChart("delivergraph",
        {
            "type": "gauge",
            "marginBottom": 0,
            "marginTop": 0,
            "startDuration": 0,
            "backgroundAlpha": 0,
            "borderAlpha": 0,
            "fontSize": 0,
            "processTimeout": -1,
            "arrows": [
                {
                    "id": "GaugeArrow-1",
                    "value": <?php echo number_format($totalPerformanceDeliver,2) ?>
                }
            ],
            "axes": [
                {
                    "bottomText": "0",
                    "bottomTextYOffset": -20,
                    "endValue": 100,
                    "id": "GaugeAxis-1",
                    "valueInterval": 10,
                    "bands": [
                        {
                            "alpha": 1,
                            "color": "#008000",
                            "endValue": 100,
                            "id": "GaugeBand-1",
                            "startValue": 90
                        },
                        {
                            "alpha": 1,
                            "color": "#00cd00",
                            "endValue": 90,
                            "id": "GaugeBand-2",
                            "startValue": 70
                        },
                        {
                            "alpha": 1,
                            "color": "#ffff00",
                            "endValue": 70,
                            "id": "GaugeBand-3",
                            "startValue": 50
                        },
                        {
                            "alpha": 1,
                            "color": "#ff9933",
                            "endValue": 50,
                            "id": "GaugeBand-4",
                            "innerRadius": "95%",
                            "startValue": 40
                        },
                        {
                            "alpha": 1,
                            "color": "#ff4c4c",
                            "endValue": 40,
                            "id": "GaugeBand-4",
                            "innerRadius": "95%",
                            "startValue": 0
                        }
                    ]
                }
            ],
            "allLabels": [],
            "balloon": {},
            "titles": []
        }
    );
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var dataOverall = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Performance', 90]
        ]);

        var optionOverall = {
          width: 400, height: 90,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

//        var chartOverall = new google.visualization.Gauge(document.getElementsByClassName('overall-graph')[0]);

//        chartOverall.draw(dataOverall, optionOverall);
//
//        setInterval(function() {
//          dataOverall.setValue(0, 1, 40 + Math.round(60 * Math.random()));
//          chartOverall.draw(dataOverall, optionOverall);
//        }, 13000);

        var dataSource = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Performance', <?php echo number_format($totalperformancesource,2)?>]
        ]);

        var dataMake = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Performance', <?php echo number_format($totalperformanceMake,2)?>]
        ]);

        var dataDeliver = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Performance', <?php echo number_format($totalPerformanceDeliver,2)?>]
        ]);

        var optionSource = {
            title: 'Source Performance',
            width: 400, height: 90,
            redFrom: 90, redTo: 100,
            yellowFrom:75, yellowTo: 90,
            minorTicks: 5
        };

//        var chartSource = new google.visualization.Gauge(document.getElementsByClassName('source-graph')[0]);
        
//        var chartMake = new google.visualization.Gauge(document.getElementsByClassName('make-graph')[0]);
//        
//        var chartDelivery = new google.visualization.Gauge(document.getElementsByClassName('delivery-graph')[0]);
        

//        chartSource.draw(dataSource, optionSource);
//        chartMake.draw(dataMake, optionSource);
//        chartDelivery.draw(dataDeliver, optionSource);

        
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBarColors);

    function drawBarColors() {
        var dataSource = google.visualization.arrayToDataTable([
        ['', 'Reliabilities', 'Responsiveness', 'Costs', 'Assets'],
        ['Performance', <?php echo number_format($totalperformanceReliability,2)?>, <?php echo number_format($totalperformanceResponsiveness,2)?>, <?php echo number_format($totalperformanceCost,2)?>, <?php echo number_format($totalperformanceAsset,2)?>]
        ]);
        
        var dataMake = google.visualization.arrayToDataTable([
        ['', 'Reliabilities', 'Responsiveness', 'Costs', 'Assets'],
        ['Performance', <?php echo number_format($totalperformanceReliabilityMake,2)?>, <?php echo number_format($totalperformanceResponsivenessMake,2)?>, <?php echo number_format($totalperformanceCostMake)?>, <?php echo number_format($totalperformanceAssetMake,2) ?>]
        ]);
        
        var dataDeliver = google.visualization.arrayToDataTable([
        ['', 'Reliabilities', 'Responsiveness', 'Costs', 'Assets'],
        ['Performance', <?php echo number_format($totalReliabilityDeliver,2)?>, <?php echo number_format($totalResponsivenessDeliver,2)?>, <?php echo number_format($snormDeliver[7]['Performance']*100,2)?>, <?php echo number_format(0,2)?>]
        ]);

        var optionSource = {
            title: 'Source Attribute Value',
            width: 620, height: 123,
            chartArea: {width: '50%'},
            backgroundColor: '#c0c0c0',
            colors: ['#D092A7', '#E7BC29', '#F3A447', '#A5B592'],
            hAxis: {
                title: '',
                minValue: 0,
                maxValue: 8
            },
            vAxis: {
              title: ''
            }
        };

        var optionMake = {
            title: 'Make Attribute Value',
            width: 620, height: 123,
            chartArea: {width: '50%'},
            backgroundColor: '#c0c0c0',
            colors: ['#D092A7', '#E7BC29', '#F3A447', '#A5B592'],
            hAxis: {
                title: '',
                minValue: 0,
                maxValue: 8
            },
            vAxis: {
              title: ''
            }
        };

        var optionDeliver = {
            title: 'Deliver Attribute Value',
            width: 620, height: 123,
            chartArea: {width: '50%'},
            backgroundColor: '#c0c0c0',
            colors: ['#D092A7', '#E7BC29', '#F3A447', '#A5B592'],
            hAxis: {
                title: '',
                minValue: 0,
                maxValue: 8
            },
            vAxis: {
              title: ''
            }
        };
        
        var chartSource = new google.visualization.BarChart(document.getElementsByClassName('source-bar')[0]);
        
        var chartMake = new google.visualization.BarChart(document.getElementsByClassName('make-bar')[0]);
        
        var chartDelivery = new google.visualization.BarChart(document.getElementsByClassName('delivery-bar')[0]);
        
        chartSource.draw(dataSource, optionSource);
        chartMake.draw(dataMake, optionMake);
        chartDelivery.draw(dataDeliver, optionDeliver);
    }
</script>