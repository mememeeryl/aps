    <!DOCTYPE html>

<html lang="en">
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
                   
                    <div class="panel-body bg-2">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="gosm">
                            <thead>
                                <th>Activity Title</th>
                                <th>More Info</th>
                            </thead>
                            <tbody>
                                <?php displayAsTable( $gosm) ?>
                            </tbody>
                        </table>
                        <?php displayButton($gosmDeadline)?>
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

    <div class= "container">
        <div class="modal fade" id="new" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id= "close"><span aria-hidden="true">&times;</span></button>
                          <h3 class="modal-title" id = "idtitle">GOSM FORM</h3>
                        </div>
                        <div class="modal-body form" style= "text-align :left">
                        <form id="newForm" class="jsform">
                                     <div>
                                         <label class="control-label">Activity Title</label> &nbsp;
                                          <span style="display: block"></span>
                                             <input name="title" id="title-Act" class="form-control" type="text" >
                                             <span class="help-block"></span>
                                          
                                     </div>
                                     <div>
                                        <label class="control-label">Activity Particulars</label>
                                            <select id="AP" name="particulars" class="form-control" style= "width: 26%">
                                                <option value="">--Select--</option>
                                                <option value="Year Long">Year Long</option>
                                                <option value="Term Long">Term Long</option>
                                                <option value="One Day">One Day</option>
                                                <option value="Not One Day">Multiple Dates</option>
                                            </select>
                                            <span class="help-block"></span>
                                     </div>
                                     
                                     <div class = "hidden" id = "yearlong">
                                        <label class="control-label">Activity Date</label>
                                        <div class="input-group">
                                            <input class="form-control datepicker hidden" id="datePicker1" name="datePicker1" placeholder="yyyy-mm-dd" type="text">
                                                <span class="input-group-addon hidden" name="dash" id="dash">-</span>
                                            <input class="form-control datepicker hidden" id="datePicker2" name="datePicker2" placeholder="yyyy-mm-dd" type="text">

                                        </div>
                                            <span class="help-block"></span>
                                     </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="firstForm()" id="add" class="btn btn-primary">Next</button>
                            <button type="button" class="fin btn btn-danger js-btn-step pull-left" data-dismiss="modal" id="close">Cancel</button>
                        </div>
                            </form>
                    </div><!-- /.modal-content -->
               </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

     <div class= "container">
        <div class="modal" id="new2" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id= "close"><span aria-hidden="true">&times;</span></button>
                          <h3 class="modal-title" id = "idtitle2">GOSM FORM</h3>
                        </div>
                        <div class="modal-body form" style= "text-align :left">
                        <form id="newForm2" class="jsform">
                                     <div>
                                            <label class="control-label">Goals</label>
                                            <textarea id="goal" name="goal" placeholder="" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                     </div>
                                     <div>
                                            <label class="control-label">Objectives</label>
                                            <textarea id= "objective" name="objective" placeholder="" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                     </div>
                                     <div>
                                            <label class="control-label">Brief Description</label>
                                            <textarea id = "desc" name="desc" placeholder="" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                     </div>
                                     <div>
                                         <label class="control-label">Measures</label> &nbsp;
                                          <span style="display: block"></span>
                                             <input name="measures" id="measures" class="form-control" type="text" style= "width: 50%">
                                             <span class="help-block"></span>
                                          
                                     </div>
                                      <div>
                                         <label class="control-label">Officer-in-Charge</label> &nbsp;
                                          <span style="display: block"></span>
                                             <input name="oc" id="oc" class="form-control" type="text" style= "width: 50%">
                                             <span class="help-block"></span>
                                          
                                     </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="add2" onclick="secondForm()" class="btn btn-primary">Next</button>
                            <button type="button" class="btn btn-primary js-btn-step pull-left" onclick="toForm1()" >Previous</button>
                        </div>
                            </form>
                    </div><!-- /.modal-content -->
               </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <div class= "container">
        <div class="modal" id="new3" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id= "close"><span aria-hidden="true">&times;</span></button>
                          <h3 class="modal-title" id = "idtitle2">GOSM FORM</h3>
                        </div>
                        <div class="modal-body form" style= "text-align :left">
                        <form id="newForm3" class="jsform">
                                      <div>
                                         <label class="control-label">If tie-up, please indicate other orgs:(Please indicate "N/A" if not applicable)</label> &nbsp;
                                          <span style="display: block"></span>
                                             <input name="tieUp" id="tieUp" class="form-control" type="text" style= "width: 50%">
                                             <span class="help-block"></span>
                                          
                                     </div>
                                      <div>
                                        <label for="actNature">Activity Nature</label>
                                        <select class="form-control" name="ActNature" id="ActNature_select">
                                            <option value ="">--Select--</option>
                                            <option value ="Academic">Academic</option>
                                            <option value ="Special Interest">Special Interest </option>
                                            <option value ="Departmental Initiative">Departmental Initiative</option>       
                                            <option value ="Fundraising">Fundraising</option>
                                            <option value ="Community Engagement">Community Engagement</option>
                                            <option value ="Organizational Development">Organizational Development</option>
                                            <option value ="Issue Advocacy">Issue Advocacy</option>
                                            <option value ="Lasallian Formation/Spiritual Growth">Lasallian Formation/Spiritual Growth</option>
                                            <option value ="Outreach">Outreach</option>                                                 
                                       </select>
                                            <span class="help-block"></span>
                                     </div>
                                      <div>
                                        <label for="actType">Activity Type</label>
                                        <select class="form-control" name="ActType" id="ActType_select" onchange="if(this.value=='Other'){
                                                                          this.form['Other'].style.visibility='visible';
                                                                          }else if(this.value!='Other'){
                                                                          this.form['Other'].style.visibility='hidden';
                                                                          };">
                                                <option value ="">--Select--</option>
                                                <option value = "Academic Contest">Academic Contest</option>                         
                                                <option value = "Non-Academic Contest">Non-Academic Contest</option>
                                                <option value = "Distribution">Distribution</option>
                                                <option value = "Seminar/ Workshops">Seminar/ Workshops</option>
                                                <option value = "Publicity/ Awareness Campaign">Publicity/ Awareness Campaign</option>
                                                <option value = "Meetings">Meetings</option>
                                                <option value = "Spiritual Activity">Spiritual Activity</option>
                                                <option value = "Recruitment/Audition">Recruitment/Audition</option>
                                                <option value = "Recreation">Recreation</option>
                                                <option value = "Other">Other</option>      
                                        </select>
                                    <label for="other"> </label>
                                    <input type="text" class="form-control" name="Other" id="Other_select" style="visibility:hidden;"/>
                                            <span class="help-block"></span>
                                     </div>
                                     <div>
                                        <label class="control-label">Related to Nature Organization</label>
                                            <select id="related" name="related" class="form-control" style= "width: 26%">
                                                <option value="">--Select--</option>
                                                <option value="Related">Related</option>
                                                <option value="Not Related">Not Related</option>
                                            </select>
                                            <span class="help-block"></span>
                                     </div>
                                     
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="add3" onclick="thirdForm()" class="btn btn-primary">Next</button>
                            <button type="button" class="btn btn-primary js-btn-step pull-left" onclick="toForm2()" >Previous</button>
                        </div>
                            </form>
                    </div><!-- /.modal-content -->
               </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

        <div class= "container">
        <div class="modal" id="new4" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id= "close"><span aria-hidden="true">&times;</span></button>
                          <h3 class="modal-title" id = "idtitle2">GOSM FORM</h3>
                        </div>
                        <div class="modal-body form" style= "text-align :left">
                        <form id="newForm4" class="jsform">

                                     <div>
                                         <label class="control-label">Budget</label> &nbsp;
                                          <span style="display: block"></span>
                                             <input name="budget" id="budget" class="form-control" type="text" style= "width: 50%">
                                             <span class="help-block"></span>
                                          
                                     </div>
                                      <div>
                                         <label class="control-label">Venue</label> &nbsp;
                                          <span style="display: block"></span>
                                             <input name="venue" id="venue" class="form-control" type="text" style= "width: 50%">
                                             <span class="help-block"></span>
                                          
                                     </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="add4" onclick="finalForm()" class="btn btn-success">Summary</button>
                            <button type="button" class="btn btn-primary js-btn-step pull-left" onclick="toForm3()" >Previous</button>
                        </div>
                            </form>
                    </div><!-- /.modal-content -->
               </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

   

    <div class="modal fade" id="new5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close fin" data-dismiss="modal" aria-label="Close" id= "close"><span aria-hidden="true">&times;</span></button>
                  <h3> Summary Page </h3>
                    </div>
                    <div class="modal-body">
                            
                            <div>
                                <label>Submission Type:</label>
                                <span id = res_SubType>GOSM</span>
                            </div>

                            <div>
                                <label>Activity Title:</label>
                                <span id = res_ActTitle></span>
                            </div>

                            <div >
                                <label>Activity Date Particulars:</label>
                                <span id = res_ActPart></span>
                            </div>
                            <div >
                                <label>Tie-up Orgs:</label>
                                <span id = res_TieUp></span>
                            </div>
                            <div>
                                <label>Activity Date:</label>
                                <span id = res_ActDate></span> — 
                                <span id = res_ActDate1></span>
                            </div>
                            <div >
                                <label>Activity Nature:</label>
                                <span id = res_ActNature></span>
                            </div>
                            <div>
                                <label>Activity Type:</label>
                                <span id = res_ActType></span>
                            </div>
                            <div>
                                <label>Related to Nature Organization:</label>
                                <span id = res_related></span>
                            </div>
                            <div>
                                <label>Activity Venue:</label>
                                <span id = res_ActVenue></span>
                            </div>
                            <div>
                                <label>Budget:</label>
                                <span id = res_Budget></span>
                            </div>
                            <div>
                                <label>Goals:</label><br>
                                <span id = res_Goals></span>
                            </div>
                            <div>
                                <label>Objectives:</label><br>
                                <span id = res_Objectives></span>
                            </div>
                            <div>
                                <label>Brief Description:</label>
                                <span id = res_Desc></span>
                             </div>
                             <div>
                                <label>Measures:</label>
                                <span id = res_Measures></span>
                             </div>
                             <div>
                                <label>Officer-in-Charge:</label>
                                <span id = res_OC></span>
                             </div>
                             <div class="modal-footer">
                            <button type="button" class="btn btn-default js-btn-step pull-left" onclick="toForm4()" style ="float:right">Back</button>
                            <input type ="submit" value="Submit" id="submit" class="btn btn-success fin" onclick="submit()" data-dismiss="modal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
         


         <div class="modal fade" id="new6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close fin" data-dismiss="modal" aria-label="Close" id= "close"><span aria-hidden="true">&times;</span></button>
                  <h3> Summary Page </h3>
                    </div>
                    <div class="modal-body">
                            
                            <div>
                                <label>Submission Type:</label>
                                <span id = sub_SubType>GOSM</span>
                            </div>

                            <div>
                                <label>Activity Title:</label>
                                <span id = sub_ActTitle></span>
                            </div>

                            <div >
                                <label>Activity Date Particulars:</label>
                                <span id = sub_ActPart></span>
                            </div>
                            
                            <div>
                                <label>Activity Date:</label>
                                <span id = sub_ActDate></span> — 
                                <span id = sub_ActDate1></span>
                            </div>
                           
                             <div class="modal-footer">
                            <button type="button" class="btn btn-default js-btn-step pull-left" onclick="toForm5()" style ="float:right">Back</button>
                            <input type ="submit" value="Submit" id="submit" class="btn btn-success fin" onclick="submit()" data-dismiss="modal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
    <?php
        $activities =0;

        

        function displayAsTable( $activity){
            $count = 1;
            $activities = $activity;
            if($activities){
             foreach ($activities as $row){
               
              echo '<tr>';
                

                echo '<td id = "title" class = "$count">' . $row->Title . '</td>';
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
            echo                 $data->MultipleOne.  '<br>';
            }
            else if($data->G_OneDate == NULL && $data->G_EndDate == NULL)
            echo                 $data->Particulars . '<br>';
            else{
            echo                 $data->MultipleNotOne . '<br>';
            }
            echo                '<div>';
            echo                '<label>Goals: </label> &nbsp;' . $data->Goals . '<br>';
            echo                '<label>Objectives:</label>&nbsp' . $data->Objectives . '<br>';
            echo                '<label>Brief Description:</label>&nbsp ' . $data->BriefDesc . '<br>';
            echo                '<label>Measures:</label> &nbsp' . $data->Measures . '<br>';
            echo                '<label>Officer-in-Charge:</label> ' . $data->inCharge . '<br>';
            echo                '</div>';
            echo                '<div>';
            echo                '<label>Tie Up (if any):</label> ' . $data->gosm_tieUp . '<br>';
            echo                '<label>Activity Nature:</label> ' . $data->GNature . '<br>';
            echo                '<label>Activity Type:</label> ' . $data->GType . '<br>';
            echo                '<label>Related to Nature Organization:</label>'     . $data->Related . '<br>';
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

        function displayButton($deadline){

            if($deadline == 'TRUE'){
            echo '<button type ="submit" value="Submit a Form" id="updateTerm" class="btn btn-success pull-right" data-toggle="modal" data-target ="#new">Submit GOSM</button>';
            }
            else{
                echo '<button type ="submit" disabled value="Submit a Form" id="updateTerm" class="btn btn-success pull-right" data-toggle="modal" data-target ="#new">Submit GOSM</button>';
            }
        }

    ?>

<script>

base_url = '<?=base_url()?>';
     $(document).ready(function(){
            var date_input=$('input[name="datePicker1"]');
            var date = new Date();
            date.setDate(date.getDate()-1);
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                 autoclose: true,
                 format: "yyyy-mm-dd",
                 todayHighlight: true,
                 orientation: "top auto",
                 todayBtn: true,
            });


            date_input=$('input[name="datePicker2"]');
            date = new Date();
            date.setDate($('#datePicker1').datepicker("getDate"));
            container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                 autoclose: true,
                 format: "yyyy-mm-dd",
                 todayHighlight: true,
                 orientation: "top auto",
                 todayBtn: true,
            });


            $("#AP").change(function(){
                if($("#AP").val() == 'Year Long' || $("#AP").val() == 'Term Long'  ){
                    $("#yearlong").addClass('hidden');
                    $("#datePicker1").addClass('hidden');
                    $("#dash").addClass('hidden');
                    $("#datePicker2").addClass('hidden');

                }
                if($("#AP").val() == "One Day"){
                     $("#dash").addClass('hidden');
                    $("#datePicker2").addClass('hidden');
                    $("#yearlong").removeClass('hidden');
                    $("#datePicker1").removeClass('hidden');
                }
                if($("#AP").val() == "Not One Day"){
                     

                    $("#yearlong").removeClass('hidden');
                    $("#datePicker1").removeClass('hidden');
                     $("#dash").removeClass('hidden');
                    $("#datePicker2").removeClass('hidden');
                }
                
             });

            $("input").change(function(){
                $(this).parent().removeClass('has-error');
                $(this).next().next().next().empty();
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

        $(".fin").click(function(){

                $("input").parent().removeClass('has-error');
                $("input").val("");
                $("input").next().empty();

                $("textarea").parent().removeClass('has-error');
                $("textarea").val("");
                $("textarea").next().empty();

                $("select").parent().removeClass('has-error');
                $("select").val("");
                $("select").next().empty();
            
        });


    function toForm1(){
        $("#new").modal('show');
        $("#new2").modal('hide');
    }

    function toForm2(){
        $("#new2").modal('show');
        $("#new3").modal('hide');
    }

    function toForm3(){
        $("#new3").modal('show');
        $("#new4").modal('hide');
    }

    function toForm4(){
        $("#new4").modal('show');
        $("#new5").modal('hide');
    }

     function toForm5(){
        $("#new").modal('show');
        $("#new6").modal('hide');
    }
    
    function firstForm(){

    var url;
        url = "GosmOrg_Cont/firstForm"; 

    data =  $("#newForm").serialize();
    
    $.ajax({
        url : base_url + url,
        type: "POST",
        data: $("#newForm").serialize(),
        dataType: "JSON",
        success: function(data)
        {
    
            if(data.status) //if success close modal and reload ajax table
            {
               
                checkGosm();
                
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    
                    if(data.inputerror[i] == 'datePicker1'){
                         $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().next().next().text(data.error_string[i]); //select span help-block class set text error string
                    }else {
                         $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                     }
                }
            }
            
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error in performing the task  (' + errorThrown+ ')');
 
        }
    });
    }


     function checkGosm(){

    var url;
        url = "GosmOrg_Cont/check"; 

    data =  $("#newForm").serialize();
    
    $.ajax({
        url : base_url + url,
        type: "POST",
        data: $("#newForm").serialize(),
        dataType: "JSON",
        success: function(data)
        {
    
            if(data.status) //if success close modal and reload ajax table
            {
                console.log(data);
                $('#title-Act').val(data.title);
                $('#AP').val(data.particulars);
                $('#datePicker1').val(data.start);
                $('#datePicker2').val(data.end);
                $("#new").modal('hide');
                $("#new6").modal('show');
                                        

                                $('#sub_ActDate1').text($('#datePicker2').val());
                                $('#sub_ActDate').text($('#datePicker1').val());
                                $('#sub_ActTitle').text($('#title-Act').val());
                                $('#sub_ActPart').text($('#AP').val());
            }
            else{
                $("#new").modal('hide');
                $("#new2").modal('show');
            }
            
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error in performing the task  (' + errorThrown+ ')');
 
        }
    });
    }

     function secondForm(){

    
    var url;
        url = "GosmOrg_Cont/secondForm"; 

    data =  $("#newForm2").serialize();
    
    $.ajax({
        url : base_url + url,
        type: "POST",
        data: $("#newForm2").serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                console.log(data);
                $('#goal').val(data.goal);
                $('#objective').val(data.objective);
                $('#desc').val(data.desc);
                $('#measures').val(data.measure);
                $('#oc').val(data.oc);
                $("#new2").modal('hide');
                $("#new3").modal('show');

                
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    
                         $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                     
                }
            }
            
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error in performing the task  (' + errorThrown+ ')');
 
        }
    });
    }


    function thirdForm(){

    
    var url;
        url = "GosmOrg_Cont/thirdForm"; 

    data =  $("#newForm3").serialize();
    
    $.ajax({
        url : base_url + url,
        type: "POST",
        data: $("#newForm3").serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                console.log(data);
                $('#tieUp').val(data.tieUp);
                $('#ActNature_select').val(data.ActNature);
                $('#ActType_select').val(data.ActType);
                $('#Other_select').val(data.Other);
                $('#related').val(data.related);
                $("#new3").modal('hide');
                $("#new4").modal('show');

            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    
                         $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                     
                }
            }
            
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error in performing the task  (' + errorThrown+ ')');
 
        }
    });
    }


   
    function finalForm(){

    
    var url;
        url = "GosmOrg_Cont/finalForm"; 

    data =  $("#newForm4").serialize();
    
    $.ajax({
        url : base_url + url,
        type: "POST",
        data: $("#newForm4").serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                console.log(data);
      
                $('#budget').val(data.budget);
                $('#venue').val(data.venue);
                $("#new4").modal('hide');
                $("#new5").modal('show');

                         $('#res_ActVenue').text($('#venue').val());
                         $('#res_related').text($('#related').val());
                         $('#res_ActDate1').text($('#datePicker2').val());
                         $('#res_ActDate').text($('#datePicker1').val());
                         $('#res_ActNature').text($('#ActNature_select').val());
                         $('#res_ActTitle').text($('#title-Act').val());
                         $('#res_Goals').text($('#goal').val());
                         $('#res_TieUp').text($('#tieUp').val());
                         $('#res_Term').text($('#Term_select').val());
                         $('#res_ActPart').text($('#AP').val());
                         $('#res_Objectives').text($('#objective').val());
                         $('#res_ActType').text($('#ActType_select').val());
                         $('#res_Desc').text($('#desc').val());
                         $('#res_Measures').text($('#measures').val());
                         $('#res_OC').text($('#oc').val());
                         $('#res_Budget').text($('#budget').val());
                
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    
                         $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                     
                }
            }
            
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error in performing the task  (' + errorThrown+ ')');
 
        }
    });
    }


     function submit(){

    
    var url;
        url = "GosmOrg_Cont/submit"; 
    data =  $("#newForm").serialize()+"&"+ $("#newForm2").serialize()+"&"+ $("#newForm3").serialize()+"&"+ $("#newForm4").serialize();

    console.log(data);
    $.ajax({
        url : base_url + url,
        type: "POST",
        data: data,
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                console.log(data);
                $("#new5").modal('hide');

                $("input").parent().removeClass('has-error');
                $("input").val("");
                $("input").next().empty();

                $("textarea").parent().removeClass('has-error');
                $("textarea").val("");
                $("textarea").next().empty();

                $("select").parent().removeClass('has-error');
                $("select").val("");
                $("select").next().empty();

                $("#new4").hide();
                window.location.reload();
                alert("You have submitted a GOSM Activity!");
                         
                
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    
                         $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                     
                }
            }
            
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error in performing the task  (' + errorThrown+ ')');
 
        }
    });
    }

      




</script>
</body>

</html>
