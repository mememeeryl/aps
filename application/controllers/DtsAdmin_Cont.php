<?php 

Class DtsAdmin_Cont extends CI_Controller{
     function __construct(){

        parent::__construct();
        $this->load->model('SchoolYear_Model');
    }

    public function index()
    {
        if($this->input->post('searchby') == "" || ($this->input->post('x') == NULL && $this->input->post('search_param') == "filterby"))
            $this->home();
        else{
            $filterby =    $this->input->post('search_param');
            $org = $this->input->post('org');
            if($filterby == "filterby"){
                $text = $this->input->post('x');
                $org = "dummy";
            }
            else {
                
                $text = $this->input->post('x');
                if($text == ""){
                    $text = $this->input->post('searchby');
                }
                
            }
            $this->filter($filterby, $text, $org);
        }
    }
    public function home(){
        $this->load->model('DtsAdmin_Model', 'model');
         $this->load->library('pagination');
         $this->load->helper('url');
         $this->load->model('SchoolYear_Model');

        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');

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

        $data['text'] = NULL;

        $data['dtssample'] = $this->model->getActivities(0,0, $term);
        $data['listorgs'] = $this->model->getOrgs();
        $this->setpagination($data);
        
        
        }
        else{
            redirect('Login', 'refresh');
        }
    }

    public function setpagination($data)
    {
        //pagination settings

        $count = sizeof($data['dtssample']);

        $config['base_url'] = site_url('DtsAdmin_Cont/home');
        $config['total_rows'] = $count;
        $config['per_page'] = "6";
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
                    $data['Deadline'] = date('F d, Y', strtotime($row->gosmDeadline));  
                }
            }

        //call the model function to get the department data
        $data['dts'] = $this->model->getActivities($config["per_page"], $data['page'], $term);           

        $data['pagination'] = $this->pagination->create_links();

        $data['org'] = "";
        //load the department_view
        $this->load->view('include/DtsHead');
        $this->load->view('include/Nav_Admin',$data);
        $this->load->view('DtsAdmin', $data);    
    }

    public function setpagination2($data, $text, $filterby, $org)
    {

        $count = sizeof($data['dtssample']);

        //pagination settings
        $config['base_url'] = site_url('DtsAdmin_Cont/filter/'.$filterby.'/'.$text.'/'.$org);
        $config['total_rows'] = $count ;
        $config['per_page'] = "6";
        $config["uri_segment"] = 6;
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
        $data['page'] = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;

         $query = $this->SchoolYear_Model->getSchoolYear();
            if($query){
                foreach($query as $row){
                    $term = $row->termID;
                    $data['Deadline'] = date('F d, Y', strtotime($row->gosmDeadline));
                }
            }

            
        //call the model function to get the department data
        if($filterby == "SubmissionType"){
             $data['dts'] = $this->model->getActivitiesSTfilter($org,$text, $config["per_page"], $data['page'], $term ); 

            if($org == 'dummy'){
               $data['dts'] = $this->model->getActivitiesSTfilter("",$text, $config["per_page"], $data['page'], $term ); 
            }
        }
        else if($filterby == "status"){  
             $data['dts'] = $this->model->getActivitiesStatfilter($org,$text, $config["per_page"], $data['page'], $term );
              if($org == 'dummy'){
               $data['dts'] = $this->model->getActivitiesStatfilter("",$text, $config["per_page"], $data['page'], $term );
           }
        }
        else if($filterby == "title"){
             $data['dts'] = $this->model->getActivitiesTitlefilter($org,$text, $config["per_page"], $data['page'], $term );
            if($org == 'dummy'){
               $data['dts'] = $this->model->getActivitiesTitlefilter("",$text, $config["per_page"], $data['page'], $term );
            }
       }
        else{
                $data['dts'] = $this->model->getActivities2($org,$config["per_page"], $data['page'], $term );
                 if($org == 'dummy'){
                     $data['dts'] = $this->model->getActivities2("", $config["per_page"], $data['page'], $term );
                 }

            }
        

        $data['pagination'] = $this->pagination->create_links();

         if($this->input->post('search') == "yes" || $this->input->post('search') == "")
            $data['text'] = $text;
        else
             $data['text'] = "";


        
        $data['org'] = $org;
        if($org == 'dummy'){
            $data['org'] = "";
        }

        $this->load->view('include/DtsHead');
        $this->load->view('include/Nav_Admin',$data);
        $this->load->view('DtsAdmin', $data);  
        
    }


    public function filter($filterby , $text, $org){
        $this->load->model('DtsAdmin_Model', 'model');
        $this->load->library('pagination');
         $this->load->helper('url');
         $this->load->model('SchoolYear_Model');

        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
             
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

             $text = str_replace("%20"," ",$text);

            if($filterby == "SubmissionType" && $org != 'dummy'){
            $data['dtssample'] = $this->model->getActivitiesSTfilter($org,$text, 0,0, $term );
            
            if($data['dtssample'] == NULL && $org != 'dummy'){
                $data['dtssample'] = $this->model->getActivities2($org,0,0, $term );
                $filterby = "filterby";
            }
            }
            else if($filterby == "status" && $org != 'dummy'){
                $data['dtssample'] = $this->model->getActivitiesStatfilter($org,$text, 0,0, $term );

                if($data['dtssample'] == NULL){
                    $data['dtssample'] = $this->model->getActivities2($org,0,0, $term );
                    $filterby = "filterby";
                }
            }
            else {
            $data['dtssample'] = $this->model->getActivitiesStatfilter($org,$text, 0,0, $term );
            $filterby = "status";

            if($data['dtssample'] == NULL && $org == 'dummy'){
                $data['dtssample'] = $this->model->getActivitiesStatfilter("",$text, 0,0, $term );
                $filterby = "status";
            }
            if($data['dtssample'] == NULL){
                $data['dtssample'] = $this->model->getActivitiesSTfilter($org,$text, 0,0, $term );
                $filterby = "SubmissionType";
            }
            if($data['dtssample'] == NULL && $org == 'dummy'){
                $data['dtssample'] = $this->model->getActivitiesSTfilter("",$text, 0,0, $term );
                $filterby = "SubmissionType";  
            }
            if($data['dtssample'] == NULL){
                $data['dtssample'] = $this->model->getActivitiesTitlefilter($org,$text, 0,0, $term );
                $filterby = "title";
            }

            if($data['dtssample'] == NULL && $org == 'dummy'){
                $data['dtssample'] = $this->model->getActivitiesTitlefilter("",$text, 0,0, $term );
                $filterby = "title";
            }
             if($data['dtssample'] == NULL && $this->input->post('search') == "no"){
                $data['dtssample'] = $this->model->getActivities2($org,0,0, $term);
                $filterby = "filterby";
                
            }
            if($data['dtssample'] == NULL ){
                
                $data['dtssample'] = $this->model->getActivities2($org,0,0, $term );
                $filterby = "filterby";
            }
            if($data['dtssample'] == NULL && $org == 'dummy'){
                $data['dtssample'] = $this->model->getActivities2("",0,0, $term );
                $filterby = "filterby";
            }

        
            }


         $data["listorgs"] = $this->model->getOrgs();
        $this->setpagination2($data, $text, $filterby, $org);

        }
        else{
            redirect('Login', 'refresh');
        }
        

    }

    public function edit(){
        $this->_validate(); 
        $this->load->model('DtsAdmin_Model', 'model');

        
        $data['status'] = $this->input->post('status');
        $data['remarks']= $this->input->post('remarks');
        $data['checker'] = $this->input->post('checker');
        $id = $this->input->post('subid');

        $orgID = $this->model->getOrgID($id);
        $notif = "<b>Your Activity Submission has been checked.</b> <br> New activity status: " .$data['status']. "<br>".date('Y/m/d'). "<br>".$this->input->post('notif');


        $this->model->addnotif($notif, $orgID);

        $this->model->updateSubmission($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('status') == '')
        {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('checker') == '')
        {
            $data['inputerror'][] = 'checker';
            $data['error_string'][] = 'Checked by is required';
            $data['status'] = FALSE;
        }
        
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }


    function getActivity($id){
        $this->load->model('DtsAdmin_Model','model');

        $data = $this->model->get_by_id($id);



        echo json_encode($data);

    }


}
?>