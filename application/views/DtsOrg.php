    <!DOCTYPE html>

<html lang="en">
<body>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="col-lg-12">
                <h1 class="page-header">
                    DTS <small> Document Tracking System</small>
                </h1>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                    <form  role="search" action="<?php echo base_url("/DtsOrg_Cont")?>" method = "post" id = "Search-Form">
                        <div class="input-group">
                            <div class="input-group-btn search-panel">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span id="search_concept"></span><font id="filter">Filter by</font><span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a id= "Filterby" href="#sample">All</a></li>
                                    <li><hr style="margin-top: 1px; margin-bottom: 1px;"></li>
                                    <li><label id= "ST" href="#sample">&nbsp;&nbsp;&nbsp; Submission Type</label></li>
                                    <li><a id= "ST-IS" href="#sample">&nbsp -Initial Submission</a></li>
                                    <li><a id= "ST-P" href="#sample">&nbsp -Pended</a></li>
                                    <li><a id= "ST-ICC" href="#sample">&nbsp -In Case of Change</a></li>
                                    <li><a id= "ST-NGO" href="#sample">&nbsp -Not in GOSM</a></li>
                                    <li><hr style="margin-top: 1px; margin-bottom: 1px;"></li>
                                    <li><label id= "Status" href="#sample"">&nbsp;&nbsp;&nbsp;Status</label></li>
                                    <li><a id= "Stat-A" href="#sample">&nbsp -Approved</a></li>
                                    <li><a id= "Stat-L" href="#sample">&nbsp -Late Approved</a></li>
                                    <li><a id= "Stat-P" href="#sample">&nbsp -Pending</a></li>
                                    <li><a id= "Stat-D" href="#sample">&nbsp -Denied</a></li>

                                </ul>
                            </div>
                            <input type="hidden" name="search_param" value="filterby" id="search_param">     
                            <input type="hidden" name="search" value="yes" id="search">
                            <input type="hidden" name="searchby" value="yes" id="searchby">       
                            <input id="inputText" type="text" class="form-control" name="x" placeholder="...">
                            <span class="input-group-btn">
                                <button id="Search" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                   
                        </div><h3 class="panel-title"></h3>
                  </form>
                    </div>
                    <div class="panel-body bg-2">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dts">
                            <thead>
                                <th>Date Submitted</th>
                                <th>Activity Title</th>
                                <th>Submission Type</th>
                                <th>Activity Date Particulars</th>
                                <th>Status</th>
                                <th>More Info</th>
                            </thead>
                            <tbody>
                                <?php displayAsTable( $dts) ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <div class="row">
                     <div class="col-md-12 text-center">
                        <?php echo $pagination; ?>
                     </div>
                    </div>
               </div>
        </div>
    </div>

   

    <font id="hidden"></font>

    <?php
        $activities =0;

        

        function displayAsTable( $activity){
            $count = 0;
            $activities = $activity;
            if($activities){
             foreach ($activities as $row){
               
              echo '<tr>';
                

                echo '<td>' . $row->DateSubmitted . '</td>';
                echo '<td id = "title" class = "$count">' . $row->ActTitle . '</td>';
                echo '<td>' . $row->SubType . '</td>';
               if($row->EndDate == NULL && $row->OneDate != NULL){
                    echo '<td>' .  $row->MultipleOne . '</td>';
                }
                else if($row->OneDate == NULL && $row->EndDate == NULL)
                    echo '<td>' . $row->ActPart . '</td>';
                else{
                    echo '<td>' . $row->MultipleNotOne. '</td>';
                }
               
                echo '<td>' . $row->Stat . '</td>';
                 echo '<td>' . '<button type="button" class= "btn btn-primary" aria-label ="center" data-toggle="modal" data-target = "#modal-'.$count.'">
                    <span class ="glyphicon glyphicon-info-sign" aria-hidden = "true"></span>
                     </button>' . '</td>';
              echo '<tr>';
              makeModal($row,$count);
                $count++;              
            }
            }
        }

        
        function makeModal($data, $count){
          $url =  base_url("/InitSub");
            echo '<div class ="container">';
            echo '<div class = "modal fade" id= "modal-'.$count.'">';
            echo    '<div class = "modal-dialog">';
            echo    '<div class = "modal-content">';
            echo        '<div class = "modal-header">';
            echo            '<button type ="button" class = "close"data-dismiss= "modal">&times;</button>';
            echo            '<h3 class="modal-title">' . $data->ActTitle . '</h3>';
            echo        '</div>';
            echo        '<div class = "modal-body" style= "text-align :left">';
            echo        '<h3> Activity Details </h3>';
            echo        '<div>';
            echo                '<label>Submission Type: </label> ' . $data->SubType . '<br>';
            if($data->ActPart != 'Year Long')
            echo                '<label>Term:</label> ' . $data->Term . '<br>';
            echo                '<label>Tie Up:</label> ' . $data->TieUp . '<br>';
            echo                '<label>Activity Duration: &nbsp;</label>';
            if($data->EndDate == NULL && $data->OneDate != NULL){
            echo   $data->MultipleOne;
            }
            else if($data->OneDate == NULL && $data->EndDate == NULL)
            echo   $data->ActPart ;
            else{
            echo   $data->MultipleNotOne;
            }
            echo                '<br><label>Activity Type:</label> ' . $data->ActType . '<br>';
            echo                '<label>Activity Nature:</label> ' . $data->ActNature . '<br>';
            echo                '<label>Activity Time:</label> ' . $data->ActTime . '<br>';
            echo                '<label>Activity Venue:</label> ' . $data->ActVenue . '<br>';
            echo                '</div>';
            echo                '<h3> Officer Details </h3>';
            echo                '<div>';
            echo                '<label>Date Submitted:</label> ' . date('M/d/Y g:i:sA',strtotime($data->DateSubmitted)) . '<br>';
            echo                '<label>Officer Name:</label> ' . $data->OfficerName . '<br>';
            echo                '<label>Contact Number:</label> ' . $data->ContNum . '<br>';
            echo                '<label>Email Address:</label> ' . $data->EmailAdd . '<br>';
            echo          '</div>';
            echo        '<h3> Status Details </h3>';
            echo          '<div>';
            echo                '<label>Status:</label> ' . $data->Stat . '<br>';
            echo                '<label>Checker:</label> ' . $data->Checker . '<br>';
            echo                '<label>Remarks:</label> ' . $data->Remarks . '<br>';
            echo                '<label>Date Checked:</label> ' . date('M/d/Y g:i:sA',strtotime($data->DateApproved)) . '<br>';
            echo           '</div>';
            echo        '</div>';
            if($data->SubType == 'Not in GOSM' && ($data->Stat =='Approved' || $data->Stat == 'Late Approved')){
            echo   '<button type ="button" value="Submit a Form"  id="initial" class="btn btn-success" >Proceed to Initial Submission</button>';
               echo'<script>
                  document.getElementById("initial").onclick = function () {
                location.href = "'.$url.'";
             };</script>';
            }
            echo        '<div class = "modal-footer">';
            echo            '<a href="" class="btn btn-default" data-dismiss="modal">Close</a>';                        
            echo        '</div>';
            echo    '</div>';
            echo   '</div>';
            echo    '</div>';
            echo '</div>';

        }
    ?>
<script type="text/javascript">

  

     base_url = '<?=base_url()?>';

     

     

     $(document).ready(function(){   
      text = "<?php echo $text; ?>";
      filterby = "<?php echo $filterby;?>";
      console.log(filterby);
      
      $("#inputText").attr("value",text);
      $("#filter").html("<?php echo $filterby;?>");

    $("#ST-IS").click(function(){

      $("#search").attr("value", "no");
       $("#filter").html('Initial Submission');
       $("#searchby").attr("value" , "Initial Submission");
       $("#search_param").attr("value" , "SubmissionType");
        $("#inputText").attr("value","");
       $("#Search-Form").submit();
    });
    $("#ST-P").click(function(){
      $("#search").attr("value", "no");
       $("#filter").html('Pended');
       $("#searchby").attr("value" , "Pended");
       $("#search_param").attr("value" , "SubmissionType");
        $("#inputText").attr("value","");
       $("#Search-Form").submit();
    });
    $("#ST-ICC").click(function(){
      $("#search").attr("value", "no");
       $("#filter").html('In Case of Change');
       $("#searchby").attr("value" , "In Case of Change");
       $("#search_param").attr("value" , "SubmissionType");
        $("#inputText").attr("value","");
       $("#Search-Form").submit();
    });
    $("#ST-NGO").click(function(){
      $("#search").attr("value", "no");
       $("#filter").html('Not in GOSM');
       $("#searchby").attr("value" , "Not in GOSM");
       $("#search_param").attr("value" , "SubmissionType");
        $("#inputText").attr("value","");
       $("#Search-Form").submit();
    });
     $("#Stat-A").click(function(){
      $("#search").attr("value", "no");
        $("#filter").html('Approved');
       $("#searchby").attr("value" , "Approved");
       $("#search_param").attr("value" , "status");
        $("#inputText").attr("value","");
       $("#Search-Form").submit();
    });
     $("#Stat-L").click(function(){
      $("#search").attr("value", "no");
        $("#filter").html('Late Approved');
       $("#searchby").attr("value" , "Late Approved");
       $("#search_param").attr("value" , "status");
        $("#inputText").attr("value","");
       $("#Search-Form").submit();
    });
     $("#Stat-P").click(function(){
      $("#search").attr("value", "no");
        $("#filter").html('Pending');
       $("#searchby").attr("value" , "Pending");
       $("#search_param").attr("value" , "status");
        $("#inputText").attr("value","");
       $("#Search-Form").submit();
    });
     $("#Stat-D").click(function(){
      $("#search").attr("value", "no");
        $("#filter").html('Denied');
       $("#searchby").attr("value" , "Denied");
       $("#search_param").attr("value" , "status");
        $("#inputText").attr("value","");
       $("#Search-Form").submit();
    });
     $("#Stat-NS").click(function(){
      $("#search").attr("value", "no");
        $("#filter").html('No Status');
       $("#searchby").attr("value" , "No Status");
       $("#search_param").attr("value" , "status");
        $("#inputText").attr("value","");
       $("#Search-Form").submit();
    });
     $("#Filterby").click(function(){
      $("#search").attr("value", "no");
        $("#filter").html('Filter by');
        $("#search_param").attr("value" , "filterby");
         $("#searchby").attr("value" , "");
         $("#inputText").attr("value", "");
        $("#Search-Form").submit();
    });
 });


</script>


</body>

</html>
