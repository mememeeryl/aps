<?php 

Class Pended extends CI_Controller{

	function __construct(){

        parent::__construct();
		$this->load->model('dash_model', 'model');
		$this->load->model('SchoolYear_Model');
		$this->load->model('Arts_Model');
      
    }

	public function index()
	{
		$this->home();
	}

	public function home(){

		if ($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$org = $session_data['username'];


			$query = $this->SchoolYear_Model->getSchoolYear();
					if($query){
						foreach($query as $row){
						$data = array('termID' => $row->termID,
									  'SchoolYear' => $row->schoolyear,
									  'SchoolTerm' => $row->schoolterm,
									  'Start' => date('F d, Y', strtotime($row->start)),
									  'End' =>date('F d, Y', strtotime($row->end)),
									  'Deadline' =>date('F d, Y', strtotime($row->gosmDeadline)));
						}
					}
				$data['orgName'] = $org;
				$data['subType'] = "Pended";
				$orgID = $this->SchoolYear_Model->getOrgID($org);
				$data['notifs'] = $this->SchoolYear_Model->getNotifs($orgID);

				$datestring = '%Y-%m-%d %H:%i:%s';
                $time = time();
                $data['timestamp'] = mdate($datestring, $time);	
                $data['url_subType'] = current_url() ;
				$this->load->view('include/ArtsHead');
				$this->load->view('include/Nav_Org', $data);
				$this->load->view('Arts1', $data);
		}

	}

	public function validateSub()
	{
		$this->form_validation->set_rules('ActTitle', 'Activity Title', 'required');
		$this->form_validation->set_rules('TieUp', 'Tie Up', 'required');
		$this->form_validation->set_rules('SubBy', 'Name of Officer', 'required');
		$this->form_validation->set_rules('Email', 'Email Address', 'required|callback_dlsuEmail');
		$this->form_validation->set_rules('ContactNum', 'Contact Number', 'required|max_length[11]|callback_mobile');


		$query = $this->SchoolYear_Model->getSchoolYear();
			if($query){
				foreach($query as $row){
				$date = $row->end;		  
				}
			}

	if($this->form_validation->run() == TRUE) 
	{
		if(strtotime(date('F d, Y')) <= strtotime($date)){
			$result = $this->Arts_Model->getOrgID( $this->input->post('OrgName'));
		   if($result) {
			    foreach($result as $row)
			    {
			    $Proj_OrgID = $row->orgID;
			    $check = $this->Arts_Model->checkSub($this->input->post('ActTitle'),$this->input->post('OrgName'), $this->input->post('TermID'));
				if($check){
						$result1 = $this->Arts_Model->getProjID($this->input->post('ActTitle'), $this->input->post('OrgName'), $this->input->post('TermID'));
						 if($result1){
						 		foreach ($result1 as $row)
						 		{
						 			$ProjID = $row ->ProjectID;

						 			$sub = array(
						 			'Sub_ProjectID' => $ProjID,
						 			'SubType' => $this->input->post('SubType'),
						 			'DateSubmitted' => $this->input->post('Timestamp'));

						 			$this->db->insert('Submission', $sub);

								$result2 = $this->Arts_Model->getSubID($ProjID, $this->input->post('OrgName'), $this->input->post('TermID'));
									 if($result2){
									 		foreach ($result2 as $row)
									 		{
									 			$SubID = $row ->SubID;
									 			$data2 = array(
									 				'Off_SubID' => $SubID,
									 				'OfficerName' => $this->input->post('SubBy'),
									 				'ContNum' => $this->input->post('ContactNum'),
									 				'EmailAdd' => $this->input->post('Email'));
									 			$this->db->insert('officerdetails', $data2);


									 			$stat = array(
									 				'Stat_SubID' => $SubID,
									 				'Stat' => 'No Status');
									 			$this->db->insert('astatus', $stat);

									 			echo '<label style="font-size :20px">Submission</label>
	         										   <a href="Org_Cont" class="btn btn-default" style="float:right">Home</a>
	           											 <hr>
	           											 <div class="success" style="text-align: center;">
	  		  											Submission has been successfully created!<br>
									  		  			</div>
	  										 			<div class="modal-footer">
	  		 											<a href="DtsOrg_Cont" class="btn btn-default">Proceed to DTS</a>
	  		 											<a href="Pended" class="btn btn-default">Submit Again</a>
	  		 											</div>';
							}
									 }
								 	else //else getSubID
									   {
									  	 	echo '<label style="font-size :20px">Submission</label>
												<button  align = "right"type="button" class="btn btn-default" data-dismiss="modal" style="float: right;">Close</button><br>
												<hr>
									  	 		<div class="success" style="text-align: center;">
		  		  								Submission Failed<br>
		  		  								Errror in Accessing your submission
					  		  					</div>
		  					 					<div class="modal-footer">
		  		 								<a href="Pended" class="btn btn-default">Submit Again</a>
		  		 								</div>';
									   }


					 		}
					 }
					 		else // else getProjectID
							   {
							  	echo '<label style="font-size :20px">Submission</label>
									  <button  align = "right"type="button" class="btn btn-default" data-dismiss="modal" style="float: right;">Close</button><br>
										<hr>
							  			<div class="success" style="text-align: center;">
		  		  						Submission Failed<br>
		  		  						Error accessing your activity 
					  		  			</div>
		  					 			<div class="modal-footer">
		  		 						<a href="Pended" class="btn btn-default">Submit Again</a>
		  		 						</div>';

							   }
					}
			 	else // else checkTitle
				   {
				  	echo '<label style="font-size :20px">Submission</label>
							<button  align = "right"type="button" class="btn btn-default" data-dismiss="modal" style="float: right;">Close</button><br>
							<hr>
				  			<div class="success" style="text-align: center;">
		  		  			Submission Failed<br>
		  		  			No ' .$this->input->post('ActTitle'). ' Found!
		  		  			<br>
		  		  			Your Activity may not have an initial submission yet or <br>
		  		  			The Activity has been approved already!
		  		  			</div>
		  		 			<div class="modal-footer">
		  		 			<a href="Pended" class="btn btn-default">Submit Again</a>
		  		 			</div>';
				   }
			   }


			}
				
		   else{ //Else getOrgID
		  	echo '<label style="font-size :20px">Submission</label>
					<button  align = "right"type="button" class="btn btn-default" data-dismiss="modal" style="float: right;">Close</button><br>
					<hr>
		  			<div class="success" style="text-align: center;">
	  		 		 Submission Failed<br>
	  		 		 Error accessing your Organization
	  		  		</div>
	  		  		<div class="modal-footer">
	  		  		<a href="Pended" class="btn btn-default">Submit Again</a>
	  		  		</div>';
		    }	
		}
		else{
			echo '<label style="font-size :20px">Submission</label>
                  <button  align = "right"type="button" class="btn btn-default" data-dismiss="modal" style="float: right;">Close</button><br>
                   <hr>
		  		<div class="success" style="text-align: center;">
  		 		 Submission Failed<br>
  		 		 You have exceeded the last day of Activity Submission.
  		  		</div>
  		  		<div class="modal-footer">
  		  		<a href="Org_Cont" class="btn btn-default" style="float:left">Home</a>';
		}	
		
	} 	
	else { 	//Else Form Validation
		//Form Validation FAILED
		echo '<label style="font-size :20px">Submission</label>
			<button  align = "right"type="button" class="btn btn-default" data-dismiss="modal" style="float: right;">Close</button><br>
			<hr>
			<div class="error">'.validation_errors().'</div>';
		}	
	}
		function dlsuEmail($str){
		
		$match = '/^[a-zA-Z0-9._]+@dlsu.edu.ph/';
		if(preg_match($match, $str)){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('dlsuEmail', 'Enter a Valid DLSU Email Address');
			return FALSE;
		}
	}

	function mobile($str){
		$match = '/09+[0-9]/';
		if(preg_match($match,$str)){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('mobile', 'Enter a Valid Mobile Number');
			return FALSE;
		}
	}
}
?>