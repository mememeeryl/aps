
<style>
    a#termbtn, a#logout {
        color: black;
    }
    .navbar-right .dropdown-menu {
        background: white;
    }
    .dropdown-menu>li>a {
        color: black;
    }
</style>
<!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url("/Admin_Cont");?>">Council of Student Organizations - APS</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li>Admin</li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="" id="termbtn" data-toggle="modal" data-target="#setting"><i class="fa fa-gear fa-fw" style="color:green"></i>Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url("/Login");?>" id="logout"><i class="fa fa-sign-out fa-fw" style="color:green"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url("/Admin_Cont");?>"><i class="fa fa-table fa-fw"></i> Calendar</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url("/DtsAdmin_Cont");?>"><i class="fa fa-table fa-fw"></i> DTS</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url("/GosmAdmin_Cont");?>"><i class="fa fa-paperclip fa-fw"></i> GOSM</a>
                        </li>
                     
                     
                    </ul>
                </div>
            </div>
        </nav>
    <div class="modal fade" id="setting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id= "close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title"> Settings </h3>
                
                    </div>
                    <div class="modal-body">
                          <center><div>
                                <label>School Year:</label>
                                <span ><?php echo $SchoolYear;?></span>
                                &nbsp; &nbsp;
                                <label>Term:</label>
                                <span ><?php echo $SchoolTerm;?></span>
                            </div>

                            <div>
                                <label>Duration:</label>
                                <span ><?php echo $Start;?></span>
                                <label>—</label>
                                <span ><?php echo $End;?></span>
                            </div>
                            <div>
                                <label>GOSM Deadline:</label>
                                <span ><?php echo $Deadline;?></span>
                            </div>
                          </center>

                        <div class="modal-footer">
                            <span id = "NewTerm">
                            <style>
                                #NewTerm{
                                     position:relative;
                                     float:left;
                                     padding-left:0px;
                                }
                            </style>
                            <input type ="submit" value="New Term" id="newTerm" onclick= "addTermModal()" class="btn btn-success" data-toggle="modal" data-target ="#new"></span>
                            <span id = "NewTerm">
                            <style>
                                #NewTerm{
                                     position:relative;
                                     float:left;
                                     padding-left:10px;
                                }
                            </style>
                            <input type ="submit" value="Update" id="updateTerm" onclick="getTerm()" class="btn btn-success"  data-target ="#new"></span>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class= "container">
        <div class="modal fade" id="new" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id= "close"><span aria-hidden="true">&times;</span></button>
                          <h3 class="modal-title" id = "idtitle">Add Term</h3>
                        </div>
                        <div class="modal-body form" style= "text-align :left">
                        <form id="newForm" class="jsform">
                                     <div>
                                         <label class="control-label">School Year</label> &nbsp;
                                          <span style="display: block"></span>
                                             <input name="year1" id="year1" class="form-control" type="text">
                                              <label>—</label>
                                             <input name="year2" id="year2" class="form-control" type="text">
                                             <span class="help-block"></span>

                                             <style>
                                                #year1, #year2{
                                                    display: inline;
                                                    width: 30%;
                                                }
                                             </style>
                                          
                                     </div>
                                     <div>
                                        <label class="control-label">Term</label>
                                            <select id="term" name="term" class="form-control" style= "width: 26%">
                                                <option value="">--Select Term--</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                            <span class="help-block"></span>
                                     </div>
                                     <div>
                                        <label class="control-label">Term Duration</label>
                                        <div class="input-group">
                                            <input class="form-control datepicker" id="datePicker1" name="datePicker1" placeholder="yyyy-mm-dd" type="text">
                                                <span class="input-group-addon" name="dash" id="dash">-</span>
                                            <input class="form-control datepicker" id="datePicker2" name="datePicker2" placeholder="yyyy-mm-dd" type="text">

                                        </div>
                                            <span class="help-block"></span>
                                     </div>
                                     <div>
                                        <label class="control-label">GOSM Deadline</label>
                                        <div class="input-group">
                                            <input class="form-control datepicker" id="datePicker3" name="deadline" placeholder="yyyy-mm-dd" type="text">
                                        </div>
                                            <span class="help-block"></span>
                                     </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="add" onclick="addTerm()" class="btn btn-success">Confirm</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Cancel</button>
                        </div>
                            </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            </div>

    <script>
    var method;

    
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

            date_input=$('input[name="deadline"]');
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
        });

       
    
    $("#new").on('hidden.bs.modal',function() {
         
        
         
         
         $("#year1").parent().removeClass('has-error');
         $("#year1").next().empty();
         $("#year1").attr('disabled',false);
         $("#year1").val("");

         $("#year2").parent().removeClass('has-error');
         $("#year2").next().empty();
         $("#year2").attr('disabled',false);
         $("#year2").val("");

         $("#term").parent().removeClass('has-error');
         $("#term").next().empty();
         $("#term").attr('disabled',false);
         $("#term").val("");

         $("#datePicker1").attr('disabled',false);
         $("#datePicker1").parent().removeClass('has-error');
         $("#datePicker1").next().empty();
         $("#datePicker1").val("");

         $("#datePicker2").parent().removeClass('has-error');
         $("#datePicker2").next().empty();
         $("#datePicker2").val("");
        
        
       
    
    });

    $('#updateTerm').click(function(){
         $("#year1").attr('disabled',true);
         $("#year2").attr('disabled',true);
         $("#term").attr('disabled',true);
         $("#datePicker1").attr('disabled',true);
    });

   


     $(document).ready(function() {
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

   base_url = '<?=base_url()?>';

     function addTerm(){

        if(method == 'edit')
            editTerm();
        else{

    $('#add').text('preparing term...'); //change button text
    $('#add').attr('disabled',true); //set button disable 
    var url;
        url = "Term_Cont/newTerm"; 

    data =  $("#newForm").serialize();
    console.log(data);
    $.ajax({
        url : base_url + url,
        type: "POST",
        data: $("#newForm").serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $("#new").modal('hide');
                window.location.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if(data.inputerror[i] == 'year1'){
                    $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().next().next().text(data.error_string[i]); //select span help-block class set text error string
                    }else if(data.inputerror[i] == 'term'){
                         $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }else if(data.inputerror[i] == 'datePicker1'){
                         $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().next().next().text(data.error_string[i]); //select span help-block class set text error string
                    }else if(data.inputerror[i] == 'deadline'){
                       $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
            }
            $('#add').text('Confirm'); //change button text
            $('#add').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            $("#new").modal('hide');
            window.location.reload();
            //alert('Error in performing the task  (' + errorThrown+ ')');
            $('#add').text('Confirm'); //change button text
            $('#add').attr('disabled',false); //set button enable 
 
        }
    });
}
    }


        function getTerm(){
        method = 'edit';
        $('#newForm')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        
        var url;
            url = "Term_Cont/getTerm"; 

        var id = "<?php echo $termID;?>";
        console.log(base_url + url + "/" + id);
        //Ajax Load data from ajax
        $.ajax({
            url : base_url + url + "/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                console.log(data.start);
                var year = data.schoolyear;
                var res = year.split("-");
                $('[name="year1"]').val(res[0]);
                $('[name="year2"]').val(res[1]);
                $('[name="term"]').val(data.schoolterm);
                $('[name="datePicker1"]').val(data.start);
                $('#new').modal('show'); // show bootstrap modal when complete loaded
                $('#idtitle').text('Edit Term'); // Set title to Bootstrap modal title
     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
        }


    function editTerm(){
    $('#add').text('saving...'); //change button text
    $('#add').attr('disabled',true); //set button disable 
    var url;
        url = "Term_Cont/editTerm"; 

    var id = "<?php echo $termID;?>";
    data =  $("#newForm").serialize();
    console.log(id);
    console.log(data);
    $.ajax({
        url :  base_url + url + "/" + id,
        type: "POST",
        data: $("#newForm").serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $("#new").modal('hide');
                window.location.reload();
            }
            else
            {
                 for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if(data.inputerror[i] == 'datePicker2'){
                         $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
            }
            $('#add').text('Confirm'); //change button text
            $('#add').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            
            alert('Error in updating data (' + errorThrown+ ')');
            $('#add').text('Confirm'); //change button text
            $('#add').attr('disabled',false); //set button enable 
 
        }
    });
    }

    function addTermModal(){
        $('#idtitle').text('Add Term');
        method = 'add';
    }

    </script>

 