<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Cont extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->model('Cal_Model');
		$this->load->model('SchoolYear_Model');
	}
	
	public function index()
	{
		$this->home();
	}

	public function home(){
		
		$query = $this->SchoolYear_Model->getSchoolYear();
		if($query){
			foreach($query as $row){
			$data = array('termID' => $row->termID,
 						  'SchoolYear' => $row->schoolyear,
						  'SchoolTerm' => $row->schoolterm,
						  'Start' => date('F d, Y', strtotime($row->start)),
						  'End' =>date('F d, Y', strtotime($row->end)),
						  'Deadline' =>date('F d, Y', strtotime($row->gosmDeadline)));
				$term = $row->termID;
			}
		}

		$data['termlong'] = $this->Cal_Model->getTerm($term);
		$data['yearlong'] = $this->Cal_Model->getYear($term);
		$this->load->view('include/AdminHead');
		$this->load->view('include/Nav_Admin', $data);
		$this->load->view('Calendar');
	}

	public function getEvents(){
		$query = $this->SchoolYear_Model->getSchoolYear();
		if($query){
			foreach($query as $row)
				$term = $row->termID;
		}

		$result = $this->Cal_Model->getActDates($term);

		if ($result){
			echo json_encode($result);
			
		}
	}

  

}
?>