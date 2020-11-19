<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">MAKE - INPUT DATA</span>
        </div>

        <?php
            if(@$_POST['submit']){
                $db = new PDO('sqlite:../dbMake.db');
                
                $Year = htmlspecialchars($_POST['Year']);
                $Quarter = htmlspecialchars($_POST['Quarter']);
                $UsedCapacity = htmlspecialchars($_POST['UsedCapacity']);
                $UnusedCapacity = htmlspecialchars($_POST['UnusedCapacity']);
                $ProductionOutput = htmlspecialchars($_POST['ProductionOutput']);
                $ProductionWaste = htmlspecialchars($_POST['ProductionWaste']);
                $RecyclableWaste = htmlspecialchars($_POST['RecyclableWaste']);
                $NonRecylableWaste = htmlspecialchars($_POST['NonRecylableWaste']);
                $HazardousWaste = htmlspecialchars($_POST['HazardousWaste']);
                $NonHazardousWaste = htmlspecialchars($_POST['NonHazardousWaste']);
                $HazardousMateriaTypeUsed = htmlspecialchars($_POST['HazardousMateriaTypeUsed']);
                $NonHazardousMaterialTypeUsed = htmlspecialchars($_POST['NonHazardousMaterialTypeUsed']);
                $MakeCycleTimeAccuracyOntime = htmlspecialchars($_POST['MakeCycleTimeAccuracyOntime']);
                $MakeCycleTimeAccuracyNotOntime = htmlspecialchars($_POST['MakeCycleTimeAccuracyNotOntime']);
                $OnTimeWaste = htmlspecialchars($_POST['OnTimeWaste']);
                $NotOnTimeWaste = htmlspecialchars($_POST['NotOnTimeWaste']);
                $ProductionActualCost = htmlspecialchars($_POST['ProductionActualCost']);
                $ProductionBudget = htmlspecialchars($_POST['ProductionBudget']);
                                
                $db->exec("INSERT INTO MAKE values(null, '".$Year."', '".$Quarter."', '".$UsedCapacity."', '".$UnusedCapacity."', '".$ProductionOutput."', '".$ProductionWaste."', '".$RecyclableWaste."', '".$NonRecylableWaste."', '".$HazardousWaste."', '".$NonHazardousWaste."', '".$HazardousMateriaTypeUsed."', '".$NonHazardousMaterialTypeUsed."', '".$MakeCycleTimeAccuracyOntime."', '".$MakeCycleTimeAccuracyNotOntime."', '".$OnTimeWaste."', '".$NotOnTimeWaste."', '".$ProductionActualCost."', '".$ProductionBudget."')");
                
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
                        <td></td>
                        <td>Used Capacity</td>
                        <td>Unused Capacity</td>
                        <td></td>
                        <td></td>
                        <td>Production Output</td>
                        <td>Production Waste</td>
                    </tr>
                    <tr>
                        <td>Used Capacity</td>
                        <td><input type="text" name="UsedCapacity" style="width:100%"/></td>
                        <td><input type="text" name="UnusedCapacity" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Production Output</td>
                        <td><input type="text" name="ProductionOutput" style="width:100%"/></td>
                        <td><input type="text" name="ProductionWaste" style="width:100%"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Recyclable Waste</td>
                        <td>Non Recyclable Waste</td>
                        <td></td>
                        <td></td>
                        <td>Hazardous Waste</td>
                        <td>Non Hazardous Waste</td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td>Recyclable Waste</td>
                        <td><input type="text" name="RecyclableWaste" style="width:100%"/></td>
                        <td><input type="text" name="NonRecylableWaste" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Hazardous Waste</td>
                        <td><input type="text" name="HazardousWaste" style="width:100%"/></td>
                        <td><input type="text" name="NonHazardousWaste" style="width:100%"/></td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td></td>
                        <td>Hazardous Material Type Used</td>
                        <td>Non Hazardous Material Type Used</td>
                        <td></td>
                        <td></td>
                        <td>On Time</td>
                        <td>Not On Time</td>
                    </tr>
                    <tr>
                        <td>Hazardous Material Type Used</td>
                        <td><input type="text" name="HazardousMateriaTypeUsed" style="width:100%"/></td>
                        <td><input type="text" name="NonHazardousMaterialTypeUsed" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Make Cycle Time Accuracy</td>
                        <td><input type="text" name="MakeCycleTimeAccuracyOntime" style="width:100%"/></td>
                        <td><input type="text" name="MakeCycleTimeAccuracyNotOntime" style="width:100%"/></td>
                    </tr>
                    <tr style="height:10px"></tr>
                    <tr>
                        <td></td>
                        <td>On Time</td>
                        <td>Not On Time</td>
                        <td></td>
                        <td></td>
                        <td>Actual Cost</td>
                        <td>Budget</td>
                    </tr>
                    <tr>
                        <td>Waste Disposal Accumulation Cycle Time Accuracy</td>
                        <td><input type="text" name="OnTimeWaste" style="width:100%"/></td>
                        <td><input type="text" name="NotOnTimeWaste" style="width:100%"/></td>
                        <td style="width:50px"></td>
                        <td>Production Cost</td>
                        <td><input type="text" name="ProductionActualCost" style="width:100%"/></td>
                        <td><input type="text" name="ProductionBudget" style="width:100%"/></td>
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