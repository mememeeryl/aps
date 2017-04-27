<!DOCTYPE html>
<html lang="en">
<body>
    <div id="wrapper">
      
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Dashboard <small>Statistics Overview</small>
                    </h1>
                </div>
                <div class="col-lg-12">
                    <!-- Status Counts -->
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">Pre-Acts Status Counts</h3>
                        </div>
                        <div class="panel-body bg-2">
                            <table class="table table-condensed table-summary table-borderless">
                                <thead>
                                    <th>Status</th>
                                    <th>Count</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: left">Approved</td>
                                        <td style="text-align: left"><?php 
                                                forEach($approved as $object){
                                                echo $object->count;    
                                                } ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">Late Approved</td>
                                        <td style="text-align: left"><?php 
                                                forEach($late_approved as $object){
                                                echo $object->count;
                                                } ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">Pending</td>
                                        <td style="text-align: left"><?php 
                                                forEach($pending as $object){
                                                echo $object->count;
                                                } ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">Denied</td>
                                        <td style="text-align: left"><?php 
                                                forEach($denied as $object){
                                                echo $object->count;
                                                } ?></td>
                                    </tr>
                                     <tr>
                                        <td style="text-align: left">Not in GOSM</td>
                                        <td style="text-align: left"><?php 
                                                forEach($notgosm as $object){
                                                echo $object->count;    
                                                } ?> /10</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                <div class="col-lg-4">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">Pushed Through Activity Ratio</h3>
                        </div>
                        <canvas id="ptrChart" width="350" height="350"></canvas>
                        <script>
                            var config = {
                                type: 'pie',
                                data: {
                                    labels: ["Pushed", "Not Pushed"],
                                    datasets: [{
                                        label: '%',
                                        data: [<?php 
                                                forEach($pushed as $object){
                                                echo $object->pushedthrough;    
                                                } ?>, <?php 
                                                forEach($notpushed as $object){
                                                echo $object->pushedthrough;    
                                                } ?>],
                                        backgroundColor: [
                                            "#2ecc71",
                                            "#3498db",
                                        ],
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: true,
                                    },
                                    tooltips: {
                                        enabled: true,
                                    },
                                    showPercentage: true,
                                }
                            };
                            var ctx = document.getElementById("ptrChart").getContext("2d");
                            var myChart = new Chart(ctx, config);
                        </script>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">60:40 Activity Ratio</h3>
                        </div>
                        <canvas id="6040Chart" width="350" height="350"></canvas>
                        <script>
                            var config = {
                                type: 'pie',
                                data: {
                                    labels: ["Related", "Not Related"],
                                    datasets: [{
                                        label: '%',
                                        data: [<?php 
                                                forEach($Related as $object){
                                                echo $object->count;    
                                                } ?>, <?php 
                                                forEach($notRelated as $object){
                                                echo $object->count;    
                                                } ?>],
                                        backgroundColor: [
                                            "#2ecc71",
                                            "#3498db",
                                        ],
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: true,
                                    },
                                    tooltips: {
                                        enabled: true,
                                    },
                                    showPercentage: true,
                                }
                            };
                            var ctx = document.getElementById("6040Chart").getContext("2d");
                            var myChart = new Chart(ctx, config);
                        </script>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">Activity Timing Ratio</h3>
                        </div>
                        <canvas id="timingChart" width="350" height="350"></canvas>
                        <script>
                            var config = {
                                type: 'pie',
                                data: {
                                    labels: ["Within Timing", "Not Within Timing"],
                                    datasets: [{
                                        label: '%',
                                        data: [<?php 
                                                forEach($Within as $object){
                                                echo $object->within;    
                                                } ?>, <?php 
                                                forEach($notWithin as $object){
                                                echo $object->within;    
                                                } ?>],
                                        backgroundColor: [
                                            "#2ecc71",
                                            "#3498db",
                                        ],
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: true,
                                    },
                                    tooltips: {
                                        enabled: true,
                                    },
                                    showPercentage: true,
                                }
                            };
                            var ctx = document.getElementById("timingChart").getContext("2d");
                            var myChart = new Chart(ctx, config);


                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
    <!-- Pie Chart Percentage Script -->
    <script>
        Chart.pluginService.register({
            afterDraw: function (chart, easing) {
                if (chart.config.options.showPercentage || chart.config.options.showLabel) {
                    var self = chart.config;
                    var ctx = chart.chart.ctx;
                    ctx.font = '18px Arial';
                    ctx.textAlign = "center";
                    ctx.fillStyle = "#fff";
                    self.data.datasets.forEach(function (dataset, datasetIndex) {               
                        var total = 0, //total values to compute fraction
                            labelxy = [],
                            offset = Math.PI / 2, //start sector from top
                            radius,
                            centerx,
                            centery, 
                            lastend = 0; //prev arc's end line: starting with 0
                        for (var val of dataset.data) { total += val; } 
                        var i = 0;
                        var meta = dataset._meta[i];
                        while(!meta) {
                            i++;
                            meta = dataset._meta[i];
                        }
                        var element;
                        for(index = 0; index < meta.data.length; index++) {
                            element = meta.data[index];
                            radius = 0.9 * element._view.outerRadius - element._view.innerRadius;
                            centerx = element._model.x;
                            centery = element._model.y;
                            var thispart = dataset.data[index],
                                arcsector = Math.PI * (2 * thispart / total);
                            if (element.hasValue() && dataset.data[index] > 0) {
                                labelxy.push(lastend + arcsector / 2 + Math.PI + offset);
                            }
                            else {
                                labelxy.push(-1);
                            }
                            lastend += arcsector;
                        }
                        var lradius = radius * 3 / 4;
                        for (var idx in labelxy) {
                            if (labelxy[idx] === -1) continue;
                            var langle = labelxy[idx],
                                dx = centerx + lradius * Math.cos(langle),
                                dy = centery + lradius * Math.sin(langle),
                                val = Math.round(dataset.data[idx] / total * 100);
                            if (chart.config.options.showPercentage)
                                ctx.fillText(val + '%', dx, dy);
                            else 
                                ctx.fillText(chart.config.data.labels[idx], dx, dy);
                        }
                        ctx.restore();
                    });
                }
            }
        });
    </script>
</html> 