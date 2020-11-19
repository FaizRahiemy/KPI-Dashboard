<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">SOURCE - INPUT DATA</span>
        </div>

        <?php
            if(@$_POST['submit']){
                $db = new PDO('sqlite:../db.db');
                
                $Year                               = htmlspecialchars($_POST['Year']);
                $Quarter                            = htmlspecialchars($_POST['Quarter']);
                $KulitPO                            = htmlspecialchars($_POST['KulitPO']);
                $KimiaPO                            = htmlspecialchars($_POST['KimiaPO']);
                $TotalPO                            = htmlspecialchars($_POST['TotalPO']);
                $IdentifySourceOnTime               = htmlspecialchars($_POST['IdentifySourceOnTime']);
                $NotOnTimeIdentifySource            = htmlspecialchars($_POST['NotOnTimeIdentifySource']);
                $MaterialBiodegradable              = htmlspecialchars($_POST['MaterialBiodegradable']);
                $MaterialNotBiodegradable           = htmlspecialchars($_POST['MaterialNotBiodegradable']);
                $MaterialHazardous                  = htmlspecialchars($_POST['MaterialHazardous']);
                $MaterialNotHazardous               = htmlspecialchars($_POST['MaterialNotHazardous']);
                $MaterialRecycledorReused           = htmlspecialchars($_POST['MaterialRecycledorReused']);
                $MaterialNotRecycledorReused        = htmlspecialchars($_POST['MaterialNotRecycledorReused']);
                $SupplierCertifiedISO               = htmlspecialchars($_POST['SupplierCertifiedISO']);
                $SupplierUncertifiedISO             = htmlspecialchars($_POST['SupplierUncertifiedISO']);
                $SupplierEnvironmentalCriteria      = htmlspecialchars($_POST['SupplierEnvironmentalCriteria']);
                $SupplierNotEnvironmentalCriteria   = htmlspecialchars($_POST['SupplierNotEnvironmentalCriteria']);
                $SourceCycleOnTime                  = htmlspecialchars($_POST['SourceCycleOnTime']);
                $SourceCycleNotOnTime               = htmlspecialchars($_POST['SourceCycleNotOnTime']);
                $LeadTimeOnSchedule                 = htmlspecialchars($_POST['LeadTimeOnSchedule']);
                $LeadTimeChangedSchedule            = htmlspecialchars($_POST['LeadTimeChangedSchedule']);
                $DemandRequirementOnTime            = htmlspecialchars($_POST['DemandRequirementOnTime']);
                $DemandRequirementNotOnTime         = htmlspecialchars($_POST['DemandRequirementNotOnTime']);
                $OrderCorrectContent                = htmlspecialchars($_POST['OrderCorrectContent']);
                $OrderNotCorrectContent             = htmlspecialchars($_POST['OrderNotCorrectContent']);
                $OrderDefectFree                    = htmlspecialchars($_POST['OrderDefectFree']);
                $OrderDefect                        = htmlspecialchars($_POST['OrderDefect']);
                $OrderDamageFree                    = htmlspecialchars($_POST['OrderDamageFree']);
                $OrderDamage                        = htmlspecialchars($_POST['OrderDamage']);
                $TransferredOnTime                  = htmlspecialchars($_POST['TransferredOnTime']);
                $TransferredNotOnTime               = htmlspecialchars($_POST['TransferredNotOntime']);
                $SupplierPaymentOnTime              = htmlspecialchars($_POST['SupplierPaymentOnTime']);
                $SupplierPaymentNotOnTime           = htmlspecialchars($_POST['SupplierPaymentNotOnTime']);
                
                $db->exec("INSERT INTO Source values (null, '".$Year."', '".$Quarter."', '".$KulitPO."', '".$KimiaPO."', '".$TotalPO."', '".$IdentifySourceOnTime."', '".$NotOnTimeIdentifySource."', '".$MaterialBiodegradable."', '".$MaterialNotBiodegradable."', '".$MaterialHazardous."', '".$MaterialNotHazardous."', '".$MaterialRecycledorReused."', '".$MaterialNotRecycledorReused."', '".$SupplierCertifiedISO."', '".$SupplierUncertifiedISO."', '".$SupplierEnvironmentalCriteria."', '".$SupplierNotEnvironmentalCriteria."', '".$SourceCycleOnTime."', '".$SourceCycleNotOnTime."', '".$LeadTimeOnSchedule."', '".$LeadTimeChangedSchedule."', '".$DemandRequirementOnTime."', '".$DemandRequirementNotOnTime."', '".$OrderCorrectContent."', '".$OrderNotCorrectContent."', '".$OrderDefectFree."', '".$OrderDefect."', '".$OrderDamageFree."', '".$OrderDamage."', '".$TransferredOnTime."', '".$TransferredNotOnTime."', '".$SupplierPaymentOnTime."', '".$SupplierPaymentNotOnTime."')");
                
                $PurchasedMaterialAktual            = htmlspecialchars($_POST['PurchasedMaterialAktual']);
                $PurchasedMaterialBudget            = htmlspecialchars($_POST['PurchasedMaterialBudget']);
                
                $db->exec("INSERT INTO Purchasedmaterial values (null, '".$Year."', '".$Quarter."', '".$PurchasedMaterialAktual."', '".$PurchasedMaterialBudget."')");
                echo "Data Submitted";
            }
            if(@$_POST['login']){
                if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin'){
                    $_SESSION['login'] = 1;
                }
            }
        ?>
        
        <div id="attributes">
        
            <?php
                if(isset($_SESSION['login'])){
            ?>
                    
            <form action="" method="post" name="insert">
                Year:<br>
                <input type="text" name="Year"/><br><br>
                Quarter:<br>
                <input type="text" name="Quarter"/><br><br>
                
                <table>
                    <tr>
                        <td>Total Purchase Order</td>
                        <td>Total PO Kulit</td>
                        <td>Total PO Kimia</td>
                    </tr>
                    
                    <tr>
                        <td><input type="text" name="TotalPO" style="width:90%"/></td>
                        <td><input type="text" name="KulitPO" style="width:90%"/></td>
                        <td><input type="text" name="KimiaPO" style="width:90%"/></td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td></td>
                        <td>Material Biodegradable</td>
                        <td>Material Not Biodegradable</td>
                        <td></td>
                        <td></td>
                        <td>Material Hazardous</td>
                        <td>Material Not Hazardous</td>
                    </tr>
                    
                    <tr>
                        <td>Material Biodegradable</td>
                        <td><input type="text" name="MaterialBiodegradable" style="width:90%"/></td>
                        <td><input type="text" name="MaterialNotBiodegradable" style="width:90%"/></td>
                        <td style="width:50px"></td>
                        <td>Hazardous Material</td>
                        <td><input type="text" name="MaterialHazardous" style="width:80%"/></td>
                        <td><input type="text" name="MaterialNotHazardous" style="width:75%"/></td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td></td>
                        <td>Material Recycled or Reused</td>
                        <td>Material Not Recycled or Reused</td>
                        <td></td>
                        <td></td>
                        <td>Supplier with an EMS or Certified ISO 14001</td>
                        <td>Supplier Not with an EMS or Uncertified ISO 14001</td>
                    </tr>
                    <tr>
                        <td>Material Recycled or Reused</td>
                        <td><input type="text" name="MaterialRecycledorReused" style="width:90%"/></td>
                        <td><input type="text" name="MaterialNotRecycledorReused" style="width:90%"/></td>
                        <td style="width:100px"></td>
                        <td>Supplier with an EMS or Certified ISO 14001</td>
                        <td><input type="text" name="SupplierCertifiedISO" style="width:80%"/></td>
                        <td><input type="text" name="SupplierUncertifiedISO" style="width:75%"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Supplier Meeting Environmental Criteria</td>
                        <td>Supplier Not Meeting Environmental Criteria</td>
                        <td></td>
                        <td></td>
                        <td>Order received on time to demand requirement</td>
                        <td>Order received not on time to demand requirement</td>
                    </tr>
                    <tr>
                        <td>Supplier meeting environmental metrice criteria</td>
                        <td><input type="text" name="SupplierEnvironmentalCriteria" style="width:90%"/></td>
                        <td><input type="text" name="SupplierNotEnvironmentalCriteria" style="width:90%"/></td>
                        <td style="width:100px"></td>
                        <td>Order received on time demand requirement</td>
                        <td><input type="text" name="DemandRequirementOnTime" style="width:80%"/></td>
                        <td><input type="text" name="DemandRequirementNotOnTime" style="width:75%"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Order Received with correct content</td>
                        <td>Order Received with incorrect content</td>
                        <td></td>
                        <td></td>
                        <td>Purchased material actual cost</td>
                        <td>Purchased material budget</td>
                    </tr>
                    <tr>
                        <td>Order Received with correct content</td>
                        <td><input type="text" name="OrderCorrectContent" style="width:90%"/></td>
                        <td><input type="text" name="OrderNotCorrectContent" style="width:90%"/></td>
                        <td style="width:100px"></td>
                        <td>Purchased material cost</td>
                        <td><input type="text" name="PurchasedMaterialAktual" style="width:80%"/></td>
                        <td><input type="text" name="PurchasedMaterialBudget" style="width:75%"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>On Time</td>
                        <td>Not On Time</td>
                        <td></td>
                        <td></td>
                        <td>On Time</td>
                        <td>Not On Time</td>
                    </tr>
                    <tr>
                        <td>identify source of supply cycle time</td>
                        <td><input type="text" name="IdentifySourceOnTime" style="width:90%"/></td>
                        <td><input type="text" name="NotOnTimeIdentifySource" style="width:90%"/></td>
                        <td style="width:100px"></td>
                        <td>Source cycle time accuracy</td>
                        <td><input type="text" name="SourceCycleOnTime" style="width:80%"/></td>
                        <td><input type="text" name="SourceCycleNotOnTime" style="width:75%"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>On Time</td>
                        <td>Not On Time</td>
                        <td></td>
                        <td></td>
                        <td>Order Defect Free</td>
                        <td>Order With Defect </td>
                    </tr>
                    <tr>
                        <td>Schedules changed within supplier's lead time</td>
                        <td><input type="text" name="LeadTimeOnSchedule" style="width:90%"/></td>
                        <td><input type="text" name="LeadTimeChangedSchedule" style="width:90%"/></td>
                        <td style="width:100px"></td>
                        <td>Order Received Defect Free</td>
                        <td><input type="text" name="OrderDefectFree" style="width:80%"/></td>
                        <td><input type="text" name="OrderDefect" style="width:75%"/></td>
                    </tr>
                     <tr>
                        <td></td>
                        <td>Order Damage Free</td>
                        <td>Order With Damage </td>
                        <td></td>
                        <td></td>
                        <td>Product On Time</td>
                        <td>Product Not On Time </td>
                    </tr>
                    <tr>
                        <td>Order Received Damage Free</td>
                        <td><input type="text" name="OrderDamageFree" style="width:90%"/></td>
                        <td><input type="text" name="OrderDamage" style="width:90%"/></td>
                        <td style="width:100px"></td>
                        <td>Product Transfer On Time</td>
                        <td><input type="text" name="TransferredOnTime" style="width:80%"/></td>
                        <td><input type="text" name="TransferredNotOntime" style="width:75%"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>On Time</td>
                        <td>Not On Time </td>
                        <td></td>
                        <td></td>
                        <td>Actual Cost</td>
                        <td>Budget</td>
                    </tr>
                    <tr>
                        <td>Supplier Payment Cycle Time Accuracy</td>
                        <td><input type="text" name="SupplierPaymentOnTime" style="width:90%"/></td>
                        <td><input type="text" name="SupplierPaymentNotOnTime" style="width:90%"/></td>
                        <td style="width:100px"></td>
                        <td>Purchase Material Cost</td>
                        <td><input type="text" name="PurchasedMaterialAktual" style="width:80%"/></td>
                        <td><input type="text" name="PurchasedMaterialBudget" style="width:75%"/></td>
                    </tr>
                </table><br>
                
                <input type="submit" name="submit" id="inputSubmit" value="Insert Data" />
            </form>
        
            <?php
                }else{
            ?>
            <form action="" method="post" name="login">
                Username:<br>
                <input type="text" name="username"/><br><br>
                Password:<br>
                <input type="text" name="password"/><br><br>
                
                <input type="submit" name="login" id="inputSubmit" value="Login" />
            </form>
            <?php
                }
            ?>
            
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