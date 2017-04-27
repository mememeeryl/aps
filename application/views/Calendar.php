<html>
    <style>
        /* basic positioning */
        .legend { list-style: none; }
        .legend li { float: left; margin-right: 10px; }
        .legend span { border: 1px solid #ccc; float: left; width: 12px; height: 12px; margin: 2px; }
        /* your colors */
        .legend .label1 { background-color: #eace67; }
        .legend .label2 { background-color: #a385e2; }
        .legend .label3 { background-color: #db6464; }
        .legend .label4 { background-color: #68d1c8;}
        .legend .label5 { background-color: #f48042;}
    </style>
    <body>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Calendar <small></small>
                    </h1>
                </div>
                <div class="col-lg-8">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title"> One Day - Multiple Days </h3>
                        </div>
                        <div class="panel-body bg-2">
                            <div id='calendar'>
                                <script>
                                    $(document).ready(function() {
                                        // page is now ready, initialize the calendar...
                                        $('#calendar').fullCalendar({
                                            // put your options and callbacks here
                                            allDayText: '',
                                            hiddenDays: [0],
                                            header: {
                                                left: 'prev,next today',
                                                center: 'title',
                                                right: 'month,listMonth'
                                            }, 
                                            eventLimit: true,
                                            events:{
                                                url: "<?php echo base_url('Admin_Cont/getEvents');?>", 
                                                error: function(){        
                                                },
                                                success: function(){
                                                    console.log('success!');
                                                }
                                            },
                                            eventRender: function(event, element) {
                                                    $(element).tooltip({title: event.title, container: "body", tooltipClass: 'tooltipclass'});    

                                            },
                                            height: 520
                                        })
                                    });
                                </script>
                            </div>
                            <div class="panel-body bg-2">
                                <ul class="legend">
                                    <li><span class="label1"></span> Approved </li>
                                    <li><span class="label2"></span> Late Approved</li>
                                    <li><span class="label3"></span> Denied</li>
                                    <li><span class="label4"></span> Pending</li>
                                    <li><span class="label5"></span> No Status</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Year Long </h3>
                        </div>
                        <div class="panel-body bg-2">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dts">
                                <thead>
                                    <th style="text-align:center">Activity Title</th>
                                </thead>
                               <tbody style="display:block; height:200px; width:100%; overflow:auto; overflow-x:hidden; ">
                                     <?php displayAsYear($yearlong) ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Term Long </h3>
                        </div>
                        <div class="panel-body bg-2" >
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dts"  >
                                <thead style="display:block; text-align:left" >
                                    <th width="20%" style="text-align:center">Term</th>
                                    <th width="100%" style="text-align:center" >Activity Title</th>
                                    <th></th>
                                </thead>
                                <tbody style="display:block; height:200px; width:100%; overflow:auto; overflow-x:hidden; ">
                                  <?php displayAsTable($termlong) ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $activities =0;
        function displayAsTable( $activity){
            $count = 0;
            $activities = $activity;
            if($activities){
             foreach ($activities as $row){
              echo '<tr style="color:white; background:'. $row->color.'">';
                echo '<td width="20%" style="text-align: center;">' . $row->term . '</td>';
                echo '<td width="100%" >' . $row->title . '</td>';
              echo '<tr>';
                $count++;              
            }
            }
        }
         $activities =0;
        function displayAsYear( $activity){
            $count = 0;
            $activities = $activity;
            if($activities){
             foreach ($activities as $row){
               
              echo '<tr style="color:white; background:'. $row->color.' ">';
                echo '<td >' . $row->title . '</td>';
              echo '<tr>';
                $count++;              
            }
            }
        }
        ?>
    </body>
</html> 