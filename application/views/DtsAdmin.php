<html>
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
                        <form  role="search" action="<?php echo base_url("/DtsAdmin_Cont")?>" method = "post" id = "Search-Form">
                        <div class="input-group">
                            <div class="input-group-btn search-panel">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span id="search_concept"><font id="filter">Filter by</font></span> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu scrollable-menu" role="menu" style=" height: auto;
                                                                                                max-height: 200px;
                                                                                                overflow-x: hidden;">
                                    <li><a id="Filterby" href="#sample">All</a></li>
                                    <li><hr style="margin-top: 1px; margin-bottom: 1px;"></li>
                                   <li><label id= "ST" href="#sample">&nbsp;&nbsp;&nbsp; Organizations</label></li>
                                     <?php displayOrgs($listorgs)?>
                                </ul>
                            </div>
                            <input type="hidden" name="search_param" value="filterby" id="search_param">   
                              <input type="hidden" name="search" value="yes" id="search">  
                            <input type="hidden" name="searchby" value="yes" id="searchby">       
                            <input type="hidden" name="org" value=" " id="org">     
                            <input id="inputText" type="text" class="form-control" name="x" placeholder="...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div><h3 class="panel-title"></h3>
                        </form>
                    </div>
                    <div class="panel-body bg-2">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dts">
                            <thead>
                                <th>Date Submitted</th>
                                <th>Organization</th>
                                <th>Activity Title</th>
                                <th>Submission Type</th>
                                <th>Activity Date Particulars</th>
                                <th>Status</th>
                                <th>More Info</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php displayAsTable( $dts) ?>
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
                    
                    echo '<td>' . $row->DateSubmitted . '</td>';
                    echo '<td id = "title" class = "$count">' . $row->OrgName . '</td>';
                    echo '<td>' . $row->ActTitle . '</td>';
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
                    echo '<td>' . '<button type="button" class= "btn btn-primary" $disabled aria-label ="center" data-toggle="modal" data-target = "#modal-'.$count.'">
                        <span class ="glyphicon glyphicon-info-sign" aria-hidden = "true"></span>
                         </button>' . '</td>';

                    $ActTitle = addslashes($row->ActTitle); 
                    
                    $actTitle = $ActTitle;


                    $SubID = $row->SubID;
                    
                    if( $row->Stat == "Approved" || $row->Stat == "Late Approved" || $row->Stat == "Denied"|| $row->Stat == "Pending"){
                        $text = "Change";
                        
                    }
                    else {
                        $text = "Update";

                    }
                    

                    echo '<td>' . '<button type="button" class= "btn btn-sm btn-primary"  aria-label ="center" onclick= "openModal(\''.$actTitle.'\', \''.$SubID.'\',\''.$text.'\')">
                             <i class="glyphicon glyphicon-pencil" ></i> <font id ="text">'.$text.'</font>
                         </button>' . '</td>';      
                  echo '<tr>';
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
             echo        '<h3> Officer Details </h3>';
            echo          '<div>';
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
                                if(($data->DateApproved) != NULL)
            echo                '<label>Date Checked:</label> ' . date('M/d/Y g:i:sA',strtotime($data->DateApproved)) . '<br>';
                                else
            echo                '<label>Date Checked:</label> <br>';                        
            echo           '</div>';
            echo        '</div>';
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



    <div class ="container">
            <div class="modal fade" id="alert" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id= "close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id = "title-modal2"></h3>
                        </div>
                        <div class="modal-body form" style= "text-align :left">
                         <form action="#" id="get" class="form-horizontal">
                        <input id="subid2" type="hidden" value="" name="subid"/> 
                             <center>You have updated the status of this activity, <br> should you wish to change?</center>
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="ok" onclick="getActivity()" class="btn btn-primary" style =" border-radius: 4px; ">Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">NO</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            </div>


     <div class ="container">
            <div class="modal fade" id="modal-edit" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id= "close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id = "title-modal"></h3>
                        </div>
                        <div class="modal-body form" style= "text-align :left">
                            <form action="#" id="edit" class="form-horizontal">
                             <input id="notif" type="hidden" value="" name="notif"/> 
                                <input id="subid" type="hidden" value="" name="subid"/> 
                                     <div>
                                         <label class="control-label">Checked by</label>
                                          
                                             <input id ="checker" name="checker" placeholder="Checker" class="form-control" type="text">
                                             <span class="help-block"></span>
                                          
                                     </div>
                                     <div>
                                        <label class="control-label">Status</label>
                                            <select name="status" class="form-control" style= "width: 26%">
                                                <option value="">--Select Status--</option>
                                                <option value="Approved">Approved</option>
                                               
                                         <option value="Late Approved">Late Approved</option>
                                                <option value="Pending">Pending</option>

                                               <option value="Denied">Denied</option>
                                            </select>
                                            <span class="help-block"></span>
                                     </div>
                                     <div>
                                            <label class="control-label">Remarks</label>
                                            <textarea name="remarks" placeholder="Remarks" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                     </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->';
            </div>
<script type="text/javascript">


    $(document).ready(function(){ 

    $("#org").attr("value", "<?php echo $org; ?>");
    org = "<?php echo $org; ?>";
    text = "<?php echo $text; ?>";
    console.log(org);

    if(org != ""){
         $("#filter").html(org);
         $("#org").attr("value", org);
         $("#search_param").attr("value" , "Org");
    }
    $("#inputText").attr("value", text);

    if($("#inputText").attr("value") == "yes")
        $("#inputText").attr("value", "");

    
    <?php orgclick($listorgs)?>

    
     $("#Filterby").click(function(){
         $("#inputText").attr("value", "");
        $("#filter").html('Filter by');
         $("#org").attr("value", " ");
         $("#search_param").attr("value" , "filterby");
          $("#Search-Form").submit();
    });
 });



    function openModal(title, SubID, text){
        
        if(text == 'Change'){
            $("#subid2").attr("value",SubID);
            $("#subid").attr("value",SubID);
             $("#title-modal").html(title);
             $("#title-modal2").html(title);
             console.log($("#title-modal").html());
            $("#alert").modal("show");
            
        }
        else{

        $("#title-modal").html(title);
        $("#title-modal2").html(title);
        $("#subid2").attr("value",SubID);
        $("#subid").attr("value",SubID);

        console.log( $("#subid").attr("value"));
        $("#modal-edit").modal("show");
    }

    }


    $(document).ready(function() {
    $("input").change(function(){
        $(this).parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().removeClass('has-error');
        $(this).next().empty();
    });
    });

    $("#modal-edit").on('hidden.bs.modal',function() {
    
        $("textarea").parent().removeClass('has-error');
        $("textarea").val("");
        $("textarea").next().empty();


        $("#checker").parent().removeClass('has-error');
        $("#checker").val("");
        $("#checker").next().empty();
    
        $("select").parent().removeClass('has-error');
        $("select").val("");
        $("select").next().empty();
    
    });
 



    base_url = '<?=base_url()?>';
    function save()
    {
        $("#notif").attr("value",$("#title-modal").html() );
     $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
        url = "DtsAdmin_Cont/edit"; 

    data =  $("#edit").serialize();
    console.log(data);
    $.ajax({
        url : base_url + url,
        type: "POST",
        data: $("#edit").serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $("#modal-edit").modal('hide');
                window.location.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error in updating data (' + errorThrown+ ')');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
    }


    function getActivity(){
    method = 'edit';
    $('#edit')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    
    var url;
        url = "DtsAdmin_Cont/getActivity"; 

    var id =  $("#subid2").attr("value");

    console.log( base_url + url + "/" + id);
    //Ajax Load data from ajax
    $.ajax({
        url : base_url + url + "/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="checker"]').val(data.Checker);
            $('[name="status"]').val(data.Stat);
            $('[name="remarks"]').val(data.Remarks);
            $('#alert').modal('hide');
            $('#modal-edit').modal('show'); // show bootstrap modal when complete loaded
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax'+ errorThrown);
        }
    });
    }



</script>

</body>
</html>