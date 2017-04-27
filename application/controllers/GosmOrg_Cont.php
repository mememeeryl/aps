<?php 

Class GosmOrg_Cont extends CI_Controller{
    function __construct(){

        parent::__construct();
        $this->load->model('SchoolYear_Model');
        $this->load->model('GosmOrg_Model', 'model');
         $this->load->library('pagination');
         $this->load->helper('url');
    }

    public function index()
    {

            $this->home();

    }

    public function home(){
        

        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $org = $session_data['username'];
           
            $this->load->model('SchoolYear_Model');

            $query = $this->SchoolYear_Model->getSchoolYear();
                    if($query){
                        foreach($query as $row){
                        $data = array('id' => $row->termID,
                                      'SchoolYear' => $row->schoolyear,
                                      'SchoolTerm' => $row->schoolterm,
                                      'Start' => date('F d, Y', strtotime($row->start)),
                                      'End' =>date('F d, Y', strtotime($row->end)),
                                      'Deadline' =>date('F d, Y', strtotime($row->gosmDeadline))) ;
                        $term = $row->termID;
                        }
                    }
                    $orgID = $this->SchoolYear_Model->getOrgID($org);
                    $data['notifs'] = $this->SchoolYear_Model->getNotifs($orgID);
          
            $data['gosmDeadline'] = "";
            if(strtotime(date('F d, Y')) <= strtotime($data['Deadline'])){
                echo date('F d, Y');
                 echo $data['Deadline'];
                $data['gosmDeadline'] = 'TRUE';
            }

            $data['gosmsamp'] = $this->model->getGosm($org, 0, 0, $term);
            $data['orgName'] = $org;
            $this->setpagination($data);

            
            }
            else{
                redirect('Login', 'refresh');
            }
    }


     public function setpagination($data)
    {

        $count = sizeof($data['gosmsamp']);

        //pagination settings
        $config['base_url'] = site_url('GosmOrg_Cont/home');
        $config['total_rows'] = $count ;
        $config['per_page'] = "5";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = "&lt;&lt; First";
        $config['last_link'] = "Last &gt;&gt;";
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config["num_links"] = 3;

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

         $query = $this->SchoolYear_Model->getSchoolYear();
        if($query){
            foreach($query as $row){
                $term = $row->termID;
            }
        }
        //call the model function to get the department data
        $data['gosm'] = $this->model->getGosm($data['orgName'], $config["per_page"], $data['page'], $term);           

        $data['pagination'] = $this->pagination->create_links();
        $data['text'] = NULL;


        $this->load->view('include/GosmHead');
            $this->load->view('include/Nav_Org',$data);
            $this->load->view('GosmOrg', $data);
        
    }



    public function submit(){   
        $this->load->model('GosmOrg_Model', 'model');

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
                                      'Deadline' =>date('F d, Y', strtotime($row->gosmDeadline))) ;
                        $term = $row->termID;
                        }

                    }
        $orgID = $this->model->getOrgID($org);
 
      $data['title'] = $this->input->post('title');
      $data['goals'] = $this->input->post('goal');
      $data['objective']= $this->input->post('objective');
      $data['desc'] = $this->input->post('desc');
      $data['measure']= $this->input->post('measures');
      $data['oc']= $this->input->post('oc');
      $data['ActNature']= $this->input->post('ActNature');
      $data['ActType']= $this->input->post('ActType');
      $data['related'] = $this->input->post('related');
      $data['budget']= $this->input->post('budget');
      $data['venue'] = $this->input->post('venue');
      $data['tieUp'] = $this->input->post('tieUp');

      $data['particulars'] = $this->input->post('particulars');
      if($data['particulars'] == 'One Day' || $data['particulars'] == ' Not One Day'){
          $data['oneDate'] = $this->input->post('datePicker1');
          if($data['particulars'] == 'Not One Day')
            $data['endDate'] = $this->input->post('datePicker2');
          else{
            $data['endDate'] = NULL;
          }
        }
        else{
             $data['oneDate'] = NULL;
            $data['endDate'] = NULL;
        }
      
       $check = $this->model->checkIfExisting($this->input->post('title'), $orgID, $term);

      if($check){
            $data['gosmID'] = $this->model->getExisting($this->input->post('title'), $orgID, $term);
            $this->model->addToTargetDate($data);
      }
      else{
          $this->model->addToGosm($data, $orgID);
          $data['gosmID'] = $this->model->getGosmID($data);
          $this->model->addToTargetDate($data);
      }




      echo json_encode(array("status" => TRUE, "tieup" => $this->input->post('tieUp')));

    }



     public function check(){
         
        
        $query = $this->SchoolYear_Model->getSchoolYear();
                    if($query){
                        foreach($query as $row)
                            $term = $row->termID;
                    }
            
           
            $data['title'] = $this->input->post('title');
            $data['particulars'] = $this->input->post('particulars');
       
            $data['start'] = "";
            $data['end'] ="";
                if( $data['particulars'] == 'One Day'){
                    $data['start'] = $this->input->post('datePicker1');
                }else if($data['particulars'] == 'Not One Day'){
                    $data['start'] = $this->input->post('datePicker1');
                    $data['end'] = $this->input->post('datePicker2');
                }
            $session_data = $this->session->userdata('logged_in');
             $org = $session_data['username'];
            $orgID = $this->model->getOrgID( $org);
            
            $check = $this->model->checkIfExisting($this->input->post('title'), $orgID, $term);

            if($check){
                $data['status'] = TRUE;
            }
            else{
                $data['status'] = FALSE;
            }

            echo json_encode($data);

    }
    public function firstForm(){
            $this->_validatefirst();
                
                $data['title'] = $this->input->post('title');
                $data['particulars'] = $this->input->post('particulars');
       
                 $data['start'] = "";
                    $data['end'] ="";
                if( $data['particulars'] == 'One Day'){
                    $data['start'] = $this->input->post('datePicker1');
                }else if($data['particulars'] == 'Not One Day'){
                    $data['start'] = $this->input->post('datePicker1');
                    $data['end'] = $this->input->post('datePicker2');
                }

       
                 echo json_encode(array("status" => TRUE, "title" => $data['title'], "particulars" => $data['particulars'], "start" => $data['start'], "end" => $data['end']));
    }


    public function secondForm(){
            $this->_validatesecond();

            $data['goal'] = $this->input->post('goal');
            $data['objective'] = $this->input->post('objective');
            $data['desc'] = $this->input->post('desc');
            $data['measure'] =  $this->input->post('measures');
            $data['oc'] =  $this->input->post('oc');
            

            echo json_encode(array("status" => TRUE, "goal" => $data['goal'], "objective" => $data['objective'], "desc" => $data['desc'], "measure" => $data['measure'], "oc" => $data['oc']));
    }

     public function thirdForm(){
            $this->_validatethird();

            $data['tieUp'] = $this->input->post('tieUp');
            $data['ActNature'] = $this->input->post('ActNature');
            $data['ActType'] = $this->input->post('ActType');
            $data['related'] = $this->input->post('related');
             $data['other'] =  $this->input->post('Other');
            if( $data['ActType'] == 'Other'){
                 $data['other'] =  $this->input->post('Other');
            }


            echo json_encode(array("status" => TRUE, "tieUp" => $data['tieUp'], "ActNature" => $data['ActNature'], "ActType" => $data['ActType'], "related" => $data['related'],  "Other" =>$data['other']));
    }

     public function finalForm(){
            $this->_validatefinal();

            $data['budget'] = $this->input->post('budget');
            $data['venue'] = $this->input->post('venue');

            echo json_encode(array("status" => TRUE, "budget" => $data['budget'], "venue" => $data['venue']));
    }

    private function _validatefirst()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('title') == '' )
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('particulars') == '')
        {
            $data['inputerror'][] = 'particulars';
            $data['error_string'][] = 'Please select an activity particular';
            $data['status'] = FALSE;
        }
        
 
        if($this->input->post('datePicker1') == '' && $this->input->post('particulars') == 'One Day')
        {
            $data['inputerror'][] = 'datePicker1';
            $data['error_string'][] = 'Term duration is required';
            $data['status'] = FALSE;
        }

        if(($this->input->post('datePicker1') == '' || $this->input->post('datePicker2') == '') && $this->input->post('particulars') == 'Not One Day')
        {
            $data['inputerror'][] = 'datePicker1';
            $data['error_string'][] = 'Term duration is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
    private function _validatesecond()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('goal') == '' )
        {
            $data['inputerror'][] = 'goal';
            $data['error_string'][] = 'Goal is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('objective') == '')
        {
            $data['inputerror'][] = 'objective';
            $data['error_string'][] = 'Objectives is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('desc') == '' && $this->input->post('Other') == '')
        {
            $data['inputerror'][] = 'desc';
            $data['error_string'][] = 'Brief Description is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('measures') == '')
        {
            $data['inputerror'][] = 'measures';
            $data['error_string'][] = 'Measure is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('oc') == '' )
        {
            $data['inputerror'][] = 'oc';
            $data['error_string'][] = 'Officer is required';
            $data['status'] = FALSE;
        }

 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

     private function _validatethird()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('tieUp') == '')
        {
            $data['inputerror'][] = 'tieUp';
            $data['error_string'][] = 'Tie up is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('ActNature') == '' )
        {
            $data['inputerror'][] = 'ActNature';
            $data['error_string'][] = 'Please select an activity nature';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('ActType') == '')
        {
            $data['inputerror'][] = 'ActType';
            $data['error_string'][] = 'Please select an activity type';
            $data['status'] = FALSE;
        }

         if($this->input->post('ActType') == 'Other' && $this->input->post('Other') == '')
        {
            $data['inputerror'][] = 'ActType';
            $data['error_string'][] = 'Please select an activity type';
            $data['status'] = FALSE;
        }
        if($this->input->post('related') == '')
        {
            $data['inputerror'][] = 'related';
            $data['error_string'][] = 'please select from the list';
            $data['status'] = FALSE;
        }
 

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

     private function _validatefinal()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

 
        if($this->input->post('budget') == '' )
        {
            $data['inputerror'][] = 'budget';
            $data['error_string'][] = 'Budget is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('venue') == '' )
        {
            $data['inputerror'][] = 'venue';
            $data['error_string'][] = 'Type N/A if  there is no venue is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
   

    
    
    
}
?>