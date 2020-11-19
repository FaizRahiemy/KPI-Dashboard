<?php
require '../layout.php';
?>

<body>
    <div id="container">
        
        <div id="header-detail">
            <a href="<?php echo $baseUrl ?>" style="color=black; text-decoration:none"><span style="float:left; margin-left:50px; margin-top: 25px">KPI DASHBOARD</span></a>
            <span style="margin-left:-100px">DELIVER - ATTRIBUTE KPIS PERFORMANCE VALUES</span>
        </div>

        <?php
            $dir = 'sqlite:../deliver2.db';
            $dbh = new PDO($dir) or die("Cannot open the database");
            $querySnorm = "SELECT * FROM snorm";

            $getSnorm = $dbh->prepare($querySnorm);
            $getSnorm->execute();
            $snorm = $getSnorm->fetchAll();
               
            $totalReliability = $snorm[0]['Performance']*100 + $snorm[1]['Performance']*100;
               
            $totalResponsiveness = $snorm[2]['Performance']*100 + $snorm[3]['Performance']*100 + $snorm[4]['Performance']*100 + $snorm[5]['Performance']*100 + $snorm[6]['Performance']*100;
            
            $totalPerformance = $totalReliability + $totalResponsiveness + $snorm[7]['Performance']*100;
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
                    <td align="center" rowspan="2">RELIABILITY</td>
                    <td align="center"><?php echo $snorm[0]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[0]['Quarter']."-".trim($snorm[0]['Year'],'20') ?></td>
                    <td align="center"><?php echo number_format($snorm[0]['Actual'], 0, ",", ".") ?></td>
                    <td align="center"><?php echo number_format($snorm[0]['MinValue'], 0, ",", ".") ?></td>
                    <td align="center"><?php echo number_format($snorm[0]['MaxValue'], 0, ",", ".") ?></td>
                    <td align="center"><?php echo $snorm[0]['SNORM'] ?></td>
                    <td align="center"><?php echo $snorm[0]['Weight'] ?></td>
                    <td align="center"><?php echo $snorm[0]['Performance']*100 ?></td>
                </tr>
                <tr style="background: #A5B591; height: 30px; ">
                    <td align="center"><?php echo $snorm[1]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[1]['Quarter']."-".trim($snorm[1]['Year'],'20') ?></td>
                    <td align="center"><?php echo number_format($snorm[1]['Actual'], 0, ",", ".") ?></td>
                    <td align="center"><?php echo number_format($snorm[1]['MinValue'], 0, ",", ".") ?></td>
                    <td align="center"><?php echo number_format($snorm[1]['MaxValue'], 0, ",", ".") ?></td>
                    <td align="center"><?php echo $snorm[1]['SNORM'] ?></td>
                    <td align="center"><?php echo $snorm[1]['Weight'] ?></td>
                    <td align="center"><?php echo $snorm[1]['Performance']*100 ?></td>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #F3A447; height: 30px; ">
                    <td align="center" rowspan="5">RESPONSIVENESS</td>
                    <td align="center"><?php echo $snorm[2]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[2]['Quarter']."-".trim($snorm[2]['Year'],'20') ?></td>
                    <td align="center"><?php echo $snorm[2]['Actual'] ?></td>
                    <td align="center"><?php echo $snorm[2]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[2]['MaxValue'] ?></td>
                    <td align="center"><?php echo $snorm[2]['SNORM'] ?></td>
                    <td align="center"><?php echo $snorm[2]['Weight'] ?></td>
                    <td align="center"><?php echo $snorm[2]['Performance']*100 ?></td>
                </tr>
                <tr style="background: #F3A447; height: 30px; ">
                    <td align="center"><?php echo $snorm[3]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[3]['Quarter']."-".trim($snorm[3]['Year'],'20') ?></td>
                    <td align="center"><?php echo $snorm[3]['Actual'] ?></td>
                    <td align="center"><?php echo $snorm[3]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[3]['MaxValue'] ?></td>
                    <td align="center"><?php echo $snorm[3]['SNORM'] ?></td>
                    <td align="center"><?php echo $snorm[3]['Weight'] ?></td>
                    <td align="center"><?php echo $snorm[3]['Performance']*100 ?></td>
                </tr>
                <tr style="background: #F3A447; height: 30px; ">
                    <td align="center"><?php echo $snorm[4]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[4]['Quarter']."-".trim($snorm[4]['Year'],'20') ?></td>
                    <td align="center"><?php echo $snorm[4]['Actual'] ?></td>
                    <td align="center"><?php echo $snorm[4]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[4]['MaxValue'] ?></td>
                    <td align="center"><?php echo $snorm[4]['SNORM'] ?></td>
                    <td align="center"><?php echo $snorm[4]['Weight'] ?></td>
                    <td align="center"><?php echo $snorm[4]['Performance']*100 ?></td>
                </tr>
                <tr style="background: #F3A447; height: 30px; ">
                    <td align="center"><?php echo $snorm[5]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[5]['Quarter']."-".trim($snorm[5]['Year'],'20') ?></td>
                    <td align="center"><?php echo $snorm[5]['Actual'] ?></td>
                    <td align="center"><?php echo $snorm[5]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[5]['MaxValue'] ?></td>
                    <td align="center"><?php echo $snorm[5]['SNORM'] ?></td>
                    <td align="center"><?php echo $snorm[5]['Weight'] ?></td>
                    <td align="center"><?php echo $snorm[5]['Performance']*100 ?></td>
                </tr>
                <tr style="background: #F3A447; height: 30px; ">
                    <td align="center"><?php echo $snorm[6]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[6]['Quarter']."-".trim($snorm[6]['Year'],'20') ?></td>
                    <td align="center"><?php echo $snorm[6]['Actual'] ?></td>
                    <td align="center"><?php echo $snorm[6]['MinValue'] ?></td>
                    <td align="center"><?php echo $snorm[6]['MaxValue'] ?></td>
                    <td align="center"><?php echo $snorm[6]['SNORM'] ?></td>
                    <td align="center"><?php echo $snorm[6]['Weight'] ?></td>
                    <td align="center"><?php echo $snorm[6]['Performance']*100 ?></td>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #E6BC28; height: 30px; ">
                    <td align="center" rowspan="1">Cost</td>
                    <td align="center"><?php echo $snorm[7]['KPI'] ?></td>
                    <td align="center"><?php echo 'Q'.$snorm[7]['Quarter']."-".trim($snorm[7]['Year'],'20') ?></td>
                    <td align="center"><?php echo number_format($snorm[7]['Actual'], 0, ",", ".") ?></td>
                    <td align="center"><?php echo number_format($snorm[7]['MinValue'], 0, ",", ".") ?></td>
                    <td align="center"><?php echo number_format($snorm[7]['MaxValue'], 0, ",", ".") ?></td>
                    <td align="center"><?php echo $snorm[7]['SNORM'] ?></td>
                    <td align="center"><?php echo $snorm[7]['Weight'] ?></td>
                    <td align="center"><?php echo $snorm[7]['Performance']*100 ?></td>
                </tr>
                <tr style="height:7px;"></tr>
                <tr style="background: #C3BFC0; height: 30px; ">
                    <td align="center" colspan="8">TOTAL PERFORMANCE VALUE</td>
                    <td align="center"><?php echo number_format($totalPerformance,2)?></td>
                </tr>
            </table>
            
            <a href="<?php echo $baseUrl ?>deliver/edit-snorm.php"><div style="background:#c0c0c0; width:100px; height: 30px; text-align:center; margin-top:20px; line-height:30px">Edit Value</div></a>
                        
        </div>

    </div>
    
</body>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked);

    function drawStacked() {
        var data = google.visualization.arrayToDataTable([
            ['', 'Reliability', 'Responsiveness', 'Costs', 'Assets Management Efficiency'],
            ['Performance', <?php echo $totalReliability;?>, <?php echo $totalResponsiveness;?>, <?php echo $snorm[7]['Performance']*100;?>, 0]
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