<html>
<body>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="col-lg-12">
                <h1 class="page-header">
                    GOSM <small> Goals|Objectives|Strategies|Measures </small>
                </h1>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default text-center">
                    <div class="panel-heading" style="height:60px">
                    <form  role="search" action="<?php echo base_url("/GosmAdmin_Cont")?>" method = "post" id = "Search-Form">
                        <div class="input-group">
                            <div class="input-group-btn search-panel">

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="width:300px; float: left;">
                                    <span id="search_concept"><font id="filter">Organization</font></span> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu scrollable-menu" role="menu" style=" height: auto;
                                                                                                max-height: 200px;
                                                                                                overflow-x: hidden; width: 300px">
                                    <li><a id="Filterby" href="#sample">All Organizations</a></li>
                                    <li><hr style="margin-top: 1px; margin-bottom: 1px;"></li>
                                   <li><label id= "ST" href="#sample">&nbsp;&nbsp;&nbsp; Organizations</label></li>
                                     <?php displayOrgs($listorgs)?>
                             <input type="hidden" name="search_param" value="filterby" id="search_param">   
                              <input type="hidden" name="search" value="yes" id="search">  
                            <input type="hidden" name="searchby" value="yes" id="searchby">       
                            <input type="hidden" name="org" value=" " id="org">     

                                </ul>

                            </div>
                            
                           
                        </div><h3 class="panel-title"></h3>
                        </form>
                    </div>
                    <div class="panel-body bg-2">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="gosm">
                            <thead>
                                <th>Organization</th>
                                <th>Activity Title</th>
                                <th>More Info</th>
                            </thead>
                            <tbody>
                                <?php displayAsTable($gosm) ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                  <div class="col-md-12 text-center">
                        <?php echo $pagination; ?>
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
                   
                  echo '<tr>';
                    

                    echo '<td id = "title" class = "$count">' . $row->OrgName . '</td>';
                    echo '<td>' . $row->Title . '</td>';
                    echo '<td>' . '<button type="button" class= "btn btn-primary" $disabled aria-label ="center" data-toggle="modal" data-target = "#modal-'.$count.'">
                        <span class ="glyphicon glyphicon-info-sign" aria-hidden = "true"></span>
                         </button>' . '</td>';

                  makeModal($row,$count);
                    $count++;              
                 }
            }
        }

             function makeModal($data, $count){
            echo '<div class ="container">';
            echo '<div class = "modal fade" id= "modal-'.$count.'">';
            echo    '<div class = "modal-dialog">';
            echo    '<div class = "modal-content">';
            echo        '<div class = "modal-header">';
            echo            '<button type ="button" class = "close"data-dismiss= "modal">&times;</button>';
            echo            '<h3 class="modal-title" align="left"><b>' . $data->Title .
                            '</b><small>&nbsp;Details</small></h3>';  
            echo        '</div>';
            echo        '<div class = "modal-body" style= "text-align :left">';
             echo                '<label>Target Date :</label> ';
                if($data->G_EndDate == NULL && $data->G_OneDate != NULL){
                    echo $data->MultipleOne.  '<br>';
                }
                else if($data->G_OneDate == NULL && $data->G_EndDate == NULL)
                    echo  $data->Particulars . '<br>';
                else{
                    echo  $data->MultipleNotOne . '<br>';
                }
            echo                '<label>Tie Up (if any): </label>' . $data->gosm_tieUp . '<br>';
            echo                '<label>Goals: </label> &nbsp; ' . $data->Goals . '<br>';
            echo                '<label>Objectives:</label>' . $data->Objectives . '<br>';
            echo                '<label>Brief Description:</label> ' . $data->BriefDesc . '<br>';
            echo                '<label>Measures:</label> ' . $data->Measures . '<br>';
            echo                '<label>Officer-in-Charge:</label> ' . $data->inCharge . '<br>';
            echo                '<label>Activity Nature:</label> ' . $data->GNature . '<br>';
            echo                '<label>Activity Type:</label> ' . $data->GType . '<br>';
            echo                '<label>Related to Nature Organization:</label> '
                                 . $data->Related . '<br>';
            echo                '<label>Budget:</label> ' . $data->Budget . '<br>';
            if ($data->Venue != NULL){
            echo                '<label>Venue:</label> ' . $data->Venue . '<br>';
            }
            echo        '<div class = "modal-footer">';
            echo            '<a href="" class="btn btn-default" data-dismiss="modal">Close</a>';                        
            echo        '</div>';
            echo    '</div>';
            echo   '</div>';
            echo    '</div>';
            echo '</div>';

        }
    function displayorgs($listorgs){

            foreach ($listorgs as $org) {

                ; echo   ' <li><a id = "'.$org->OrgName.'" href="#sample">&nbsp -'.$org->OrgName.'</a></li>';
            }
        }

        function orgclick($listorgs){
            foreach ($listorgs as $org) {
                echo '$("#'.$org->OrgName.'").click(function(){
                       $("#inputText").attr("value", "");
                         $("#search").attr("value", "no");
                       $("#filter").html(\''.$org->OrgName.'\');
                       $("#org").attr("value" , "'.$org->OrgName.'");
                       $("#search_param").attr("value" , "Org");
                       $("#Search-Form").submit();
                    });';

            }

        }
    ?>
    
<script type="text/javascript">


    $(document).ready(function(){ 

    $("#org").attr("value", "<?php echo $org; ?>");
    org = "<?php echo $org; ?>";
    console.log(org);
    if(org != ""){
         $("#filter").html(org);
         $("#org").attr("value", org);
         $("#search_param").attr("value" , "Org");
    }

    <?php orgclick($listorgs)?>

    
     $("#Filterby").click(function(){

        $("#filter").html('Filter by');
         $("#org").attr("value", " ");
         $("#search_param").attr("value" , "filterby");
          $("#Search-Form").submit();
    });
 });


    function openModal(title, SubID){
        $("#title-modal").html(title);
        $("#subid").attr("value",SubID);

        console.log( $("#subid").attr("value"));
        $("#modal-edit").modal("show");

    }

</script>

</body>
</html>