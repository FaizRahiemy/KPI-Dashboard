<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">DELIVER - INPUT DATA</span>
        </div>

        <?php
            if(@$_POST['submit']){
                $db = new PDO('sqlite:../deliver2.db');
                                
                $Year                               = htmlspecialchars($_POST['Year']);
                $Quarter                            = htmlspecialchars($_POST['Quarter']);
                $ObtainRFQOnTimeActual              = htmlspecialchars($_POST['ObtainRFQOnTimeActual']);
                $ObtainRFQOnTimeTarget             = htmlspecialchars($_POST['ObtainRFQOnTimeTarget']);
                $NegotiateTarget              = htmlspecialchars($_POST['NegotiateTarget']);
                $NegotiateActual              = htmlspecialchars($_POST['NegotiateActual']);
                $DeliveryOrders              = htmlspecialchars($_POST['DeliveryOrders']);
                $DeliveryReceived              = htmlspecialchars($_POST['DeliveryReceived']);
                $CostBudgeted              = htmlspecialchars($_POST['CostBudgeted']);
                $CostActual              = htmlspecialchars($_POST['CostActual']);
                $ScheduleActual              = htmlspecialchars($_POST['ScheduleActual']);
                $ScheduleTarget              = htmlspecialchars($_POST['ScheduleTarget']);
                $BuildActual              = htmlspecialchars($_POST['BuildActual']);
                $BuildTarget              = htmlspecialchars($_POST['BuildTarget']);
                $RouteActual              = htmlspecialchars($_POST['RouteActual']);
                $RouteTarget              = htmlspecialchars($_POST['RouteTarget']);
                $CarrierActual              = htmlspecialchars($_POST['CarrierActual']);
                $CarrierTarget              = htmlspecialchars($_POST['CarrierTarget']);
                $ReceiveActual              = htmlspecialchars($_POST['ReceiveActual']);
                $ReceiveTarget              = htmlspecialchars($_POST['ReceiveTarget']);
                $PickActual              = htmlspecialchars($_POST['PickActual']);
                $PickTarget              = htmlspecialchars($_POST['PickTarget']);
                $PackActual              = htmlspecialchars($_POST['PackActual']);
                $PackTarget              = htmlspecialchars($_POST['PackTarget']);
                $LoadActual              = htmlspecialchars($_POST['LoadActual']);
                $LoadTarget              = htmlspecialchars($_POST['LoadTarget']);
                $ShipActual              = htmlspecialchars($_POST['ShipActual']);
                $ShipTarget              = htmlspecialchars($_POST['ShipTarget']);
                $PerfectUndamaged              = htmlspecialchars($_POST['PerfectUndamaged']);
                $PerfectDamaged              = htmlspecialchars($_POST['PerfectDamaged']);
                $InstallActual              = htmlspecialchars($_POST['InstallActual']);
                $InstallTarget              = htmlspecialchars($_POST['InstallTarget']);
                $InvoicesFaultless              = htmlspecialchars($_POST['InvoicesFaultless']);
                $InvoicesFault              = htmlspecialchars($_POST['InvoicesFault']);
                
                $db->exec("INSERT INTO Delivery values (null, '".$Year."', '".$Quarter."', '".$ObtainRFQOnTimeActual."', '".$ObtainRFQOnTimeTarget."', '".$NegotiateTarget."', '".$NegotiateActual."', '".$DeliveryOrders."', '".$DeliveryReceived."', '".$CostBudgeted."', '".$CostActual."', '".$ScheduleActual."', '".$ScheduleTarget."', '".$BuildActual."', '".$BuildTarget."', '".$RouteActual."', '".$RouteTarget."', '".$CarrierActual."', '".$CarrierTarget."', '".$ReceiveActual."', '".$ReceiveTarget."', '".$PickActual."', '".$PickTarget."', '".$PackActual."', '".$PackTarget."', '".$LoadActual."', '".$LoadTarget."', '".$ShipActual."', '".$ShipTarget."', '".$PerfectUndamaged."', '".$PerfectDamaged."', '".$InstallActual."', '".$InstallTarget."', '".$InvoicesFaultless."', '".$InvoicesFault."')");
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
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                        <td></td>
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                    </tr>
                    <tr>
                        <td>Obtain & Respond to request for quote (RFQ) / request for proposal (RFP) cycle time</td>
                        <td><input type="text" name="ObtainRFQOnTimeActual" style="width:100%"/></td>
                        <td><input type="text" name="ObtainRFQOnTimeTarget" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Negotiate & receive contract cycle time</td>
                        <td><input type="text" name="NegotiateTarget" style="width:100%"/></td>
                        <td><input type="text" name="NegotiateActual" style="width:100%"/></td>
                    </tr>
                    <tr style="height:10px;"></tr>
                    <tr>
                        <td></td>
                        <td>Orders</td>
                        <td>Received</td>
                        <td></td>
                        <td></td>
                        <td>Budget</td>
                        <td>Actual</td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td>Delivery Quantity Accuracy</td>
                        <td><input type="text" name="DeliveryOrders" style="width:100%"/></td>
                        <td><input type="text" name="DeliveryReceived" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Transportation Cost</td>
                        <td><input type="text" name="CostBudgeted" style="width:100%"/></td>
                        <td><input type="text" name="CostActual" style="width:100%"/></td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td></td>
                        <td>On Time</td>
                        <td>Not On Time</td>
                        <td></td>
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                    </tr>
                    <tr>
                        <td>Build loads cycle time</td>
                        <td><input type="text" name="BuildActual" style="width:100%"/></td>
                        <td><input type="text" name="BuildTarget" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Route shipments cycle time</td>
                        <td><input type="text" name="RouteActual" style="width:100%"/></td>
                        <td><input type="text" name="RouteTarget" style="width:100%"/></td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                        <td></td>
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                    </tr>
                    <tr>
                        <td>Select carriers & rate shipments cycle time</td>
                        <td><input type="text" name="CarrierActual" style="width:100%"/></td>
                        <td><input type="text" name="CarrierTarget" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Receive product from make/source cycle time</td>
                        <td><input type="text" name="ReceiveActual" style="width:100%"/></td>
                        <td><input type="text" name="ReceiveTarget" style="width:100%"/></td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                        <td></td>
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                    </tr>
                    <tr>
                        <td>Pick product cycle time</td>
                        <td><input type="text" name="PickActual" style="width:100%"/></td>
                        <td><input type="text" name="PickTarget" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Pack product cycle time</td>
                        <td><input type="text" name="PackActual" style="width:100%"/></td>
                        <td><input type="text" name="PackTarget" style="width:100%"/></td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                        <td></td>
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                    </tr>
                    <tr>
                        <td>Load product & generate shipping documentation cycle time</td>
                        <td><input type="text" name="LoadActual" style="width:100%"/></td>
                        <td><input type="text" name="LoadTarget" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Ship product cycle time</td>
                        <td><input type="text" name="ShipActual" style="width:100%"/></td>
                        <td><input type="text" name="ShipTarget" style="width:100%"/></td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td></td>
                        <td>Undamaged</td>
                        <td>Damaged</td>
                        <td></td>
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                    </tr>
                    <tr>
                        <td>Perfect condition</td>
                        <td><input type="text" name="PerfectUndamaged" style="width:100%"/></td>
                        <td><input type="text" name="PerfectDamaged" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Install product cycle time</td>
                        <td><input type="text" name="InstallActual" style="width:100%"/></td>
                        <td><input type="text" name="InstallTarget" style="width:100%"/></td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td></td>
                        <td>Faultless</td>
                        <td>Fault</td>
                        <td></td>
                        <td></td>
                        <td>Actual</td>
                        <td>Target</td>
                    </tr>
                    <tr>
                        <td>% of faultless invoices</td>
                        <td><input type="text" name="InvoicesFaultless" style="width:100%"/></td>
                        <td><input type="text" name="InvoicesFault" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Schedule Installation cycle time</td>
                        <td><input type="text" name="ScheduleActual" style="width:100%"/></td>
                        <td><input type="text" name="ScheduleTarget" style="width:100%"/></td>
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