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
               
            if(@$_POST['submit']){
                $year1 = htmlspecialchars($_POST['year1']);
                $quarter1 = htmlspecialchars($_POST['quarter1']);
                $min1 = htmlspecialchars($_POST['min1']);
                $max1 = htmlspecialchars($_POST['max1']);
                $weight1 = htmlspecialchars($_POST['weight1']);
                
                $year2 = htmlspecialchars($_POST['year2']);
                $quarter2 = htmlspecialchars($_POST['quarter2']);
                $min2 = htmlspecialchars($_POST['min2']);
                $max2 = htmlspecialchars($_POST['max2']);
                $weight2 = htmlspecialchars($_POST['weight2']);
                
                $year3 = htmlspecialchars($_POST['year3']);
                $quarter3 = htmlspecialchars($_POST['quarter3']);
                $min3 = htmlspecialchars($_POST['min3']);
                $max3 = htmlspecialchars($_POST['max3']);
                $weight3 = htmlspecialchars($_POST['weight3']);
                
                $year4 = htmlspecialchars($_POST['year4']);
                $quarter4 = htmlspecialchars($_POST['quarter4']);
                $min4 = htmlspecialchars($_POST['min4']);
                $max4 = htmlspecialchars($_POST['max4']);
                $weight4 = htmlspecialchars($_POST['weight4']);
                
                $year5 = htmlspecialchars($_POST['year5']);
                $quarter5 = htmlspecialchars($_POST['quarter5']);
                $min5 = htmlspecialchars($_POST['min5']);
                $max5 = htmlspecialchars($_POST['max5']);
                $weight5 = htmlspecialchars($_POST['weight5']);
                
                $year6 = htmlspecialchars($_POST['year6']);
                $quarter6 = htmlspecialchars($_POST['quarter6']);
                $min6 = htmlspecialchars($_POST['min6']);
                $max6 = htmlspecialchars($_POST['max6']);
                $weight6 = htmlspecialchars($_POST['weight6']);
                
                $year7 = htmlspecialchars($_POST['year7']);
                $quarter7 = htmlspecialchars($_POST['quarter7']);
                $min7 = htmlspecialchars($_POST['min7']);
                $max7 = htmlspecialchars($_POST['max7']);
                $weight7 = htmlspecialchars($_POST['weight7']);
                
                $year8 = htmlspecialchars($_POST['year8']);
                $quarter8 = htmlspecialchars($_POST['quarter8']);
                $min8 = htmlspecialchars($_POST['min8']);
                $max8 = htmlspecialchars($_POST['max8']);
                $weight8 = htmlspecialchars($_POST['weight8']);
                
                $dbh->exec("UPDATE SNORMSource set Tahun='".$year1."', Quarter='".$quarter1."', MinValue='".$min1."', MaxValue='".$max1."', Weight='".$weight1."' WHERE id=1");
                $dbh->exec("UPDATE SNORMSource set Tahun='".$year2."', Quarter='".$quarter2."', MinValue='".$min2."', MaxValue='".$max2."', Weight='".$weight2."' WHERE id=2");
                $dbh->exec("UPDATE SNORMSource set Tahun='".$year3."', Quarter='".$quarter3."', MinValue='".$min3."', MaxValue='".$max3."', Weight='".$weight3."' WHERE id=3");
                $dbh->exec("UPDATE SNORMSource set Tahun='".$year4."', Quarter='".$quarter4."', MinValue='".$min4."', MaxValue='".$max4."', Weight='".$weight4."' WHERE id=4");
                $dbh->exec("UPDATE SNORMSource set Tahun='".$year5."', Quarter='".$quarter5."', MinValue='".$min5."', MaxValue='".$max5."', Weight='".$weight5."' WHERE id=5");
                $dbh->exec("UPDATE SNORMSource set Tahun='".$year6."', Quarter='".$quarter6."', MinValue='".$min6."', MaxValue='".$max6."', Weight='".$weight6."' WHERE id=6");
                $dbh->exec("UPDATE SNORMSource set Tahun='".$year7."', Quarter='".$quarter7."', MinValue='".$min7."', MaxValue='".$max7."', Weight='".$weight7."' WHERE id=7");
                $dbh->exec("UPDATE SNORMSource set Tahun='".$year8."', Quarter='".$quarter8."', Minimal='".$min8."', Maximal='".$max8."', Weight='".$weight8."' WHERE id=8");
                
                header('Location: '.$baseUrl.'source/attribute-source.php');
            }
        ?>
        
        <div id="attributes">
            
            <form action="" method="post" name="submit">
            
                <table style="width:100%; margin-top: 20px; border:0px; border-collapse: collapse; ">
                    <tr style="background: #C0C0C0; height: 30px; ">
                        <th>ATTRIBUTE</th>
                        <th>KPI</th>
                        <th>Year</th>
                        <th>Quarter</th>
                        <th>Min Value</th>
                        <th>Max Value</th>
                        <th>Weight</th>
                    </tr>
                    <tr style="height:7px;"></tr>
                    <tr style="background: #A5B591; height: 30px; ">
                        <td align="center" rowspan="3">RELIABILITY</td>
                        <td align="center"><?php echo $snorm[0]['KPI'] ?></td>
                        <td align="center"><input type="text" name="year1" value="<?php echo $snorm[0]['Tahun'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="quarter1" value="<?php echo $snorm[0]['Quarter'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="min1" value="<?php echo $snorm[0]['MinValue'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="max1" value="<?php echo $snorm[0]['MaxValue'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="weight1" value="<?php echo $snorm[0]['Weight'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                    </tr>
                    <tr style="background: #A5B591; height: 30px; ">
                        <td align="center"><?php echo $snorm[1]['KPI'] ?></td>
                        <td align="center"><input type="text" name="year2" value="<?php echo $snorm[1]['Tahun'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="quarter2" value="<?php echo $snorm[1]['Quarter'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="min2" value="<?php echo $snorm[1]['MinValue'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="max2" value="<?php echo $snorm[1]['MaxValue'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="weight2" value="<?php echo $snorm[1]['Weight'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                    </tr>
                    <tr style="background: #A5B591; height: 30px; ">
                        <td align="center"><?php echo $snorm[2]['KPI'] ?></td>
                        <td align="center"><input type="text" name="year3" value="<?php echo $snorm[2]['Tahun'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="quarter3" value="<?php echo $snorm[2]['Quarter'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="min3" value="<?php echo $snorm[2]['MinValue'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="max3" value="<?php echo $snorm[2]['MaxValue'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="weight3" value="<?php echo $snorm[2]['Weight'] ?>" style="width:100%; height:100%; background: #A5B591; border: 0px; text-align:center"></td>
                    </tr>
                    <tr style="height:7px;"></tr>
                    <tr style="background: #F3A447; height: 30px; ">
                        <td align="center" rowspan="1">RESPONSIVENESS</td>
                        <td align="center"><?php echo $snorm[3]['KPI'] ?></td>
                        <td align="center"><input type="text" name="year4" value="<?php echo $snorm[3]['Tahun'] ?>" style="width:100%; height:100%; background: #F3A447; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="quarter4" value="<?php echo $snorm[3]['Quarter'] ?>" style="width:100%; height:100%; background: #F3A447; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="min4" value="<?php echo $snorm[3]['MinValue'] ?>" style="width:100%; height:100%; background: #F3A447; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="max4" value="<?php echo $snorm[3]['MaxValue'] ?>" style="width:100%; height:100%; background: #F3A447; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="weight4" value="<?php echo $snorm[3]['Weight'] ?>" style="width:100%; height:100%; background: #F3A447; border: 0px; text-align:center"></td>
                    </tr>
                    <tr style="height:7px;"></tr>
                    <tr style="background: #E6BC28; height: 30px; ">
                        <td align="center" rowspan="1">COST</td>
                        <td align="center"><?php echo $snorm[4]['KPI'] ?></td>
                        <td align="center"><input type="text" name="year5" value="<?php echo $snorm[4]['Tahun'] ?>" style="width:100%; height:100%; background: #E6BC28; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="quarter5" value="<?php echo $snorm[4]['Quarter'] ?>" style="width:100%; height:100%; background: #E6BC28; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="min5" value="<?php echo $snorm[4]['MinValue'] ?>" style="width:100%; height:100%; background: #E6BC28; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="max5" value="<?php echo $snorm[4]['MaxValue'] ?>" style="width:100%; height:100%; background: #E6BC28; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="weight5" value="<?php echo $snorm[4]['Weight'] ?>" style="width:100%; height:100%; background: #E6BC28; border: 0px; text-align:center"></td>
                    </tr>
                    <tr style="height:7px;"></tr>
                    <tr style="background: #D092A7; height: 30px; ">
                        <td align="center" rowspan="3">ASSTETS</td>
                        <td align="center"><?php echo $snorm[5]['KPI'] ?></td>
                        <td align="center"><input type="text" name="year6" value="<?php echo $snorm[5]['Tahun'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="quarter6" value="<?php echo $snorm[5]['Quarter'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="min6" value="<?php echo $snorm[5]['MinValue'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="max6" value="<?php echo $snorm[5]['MaxValue'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="weight6" value="<?php echo $snorm[5]['Weight'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                    </tr>
                    <tr style="background: #D092A7; height: 30px; ">
                        <td align="center"><?php echo $snorm[6]['KPI'] ?></td>
                        <td align="center"><input type="text" name="year7" value="<?php echo $snorm[6]['Tahun'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="quarter7" value="<?php echo $snorm[6]['Quarter'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="min7" value="<?php echo $snorm[6]['MinValue'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="max7" value="<?php echo $snorm[6]['MaxValue'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="weight7" value="<?php echo $snorm[6]['Weight'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                    </tr>
                    <tr style="background: #D092A7; height: 30px; ">
                        <td align="center"><?php echo $snorm[7]['KPI'] ?></td>
                        <td align="center"><input type="text" name="year8" value="<?php echo $snorm[7]['Tahun'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="quarter8" value="<?php echo $snorm[7]['Quarter'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="min8" value="<?php echo $snorm[7]['MinValue'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="max8" value="<?php echo $snorm[7]['MaxValue'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                        <td align="center"><input type="text" name="weight8" value="<?php echo $snorm[7]['Weight'] ?>" style="width:100%; height:100%; background: #D092A7; border: 0px; text-align:center"></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="submit" id="inputSubmit" value="Save Value" />   
            </form>
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