<?php 

Class gosmAdmin_Cont extends CI_Controller{
    function __construct(){

        parent::__construct();
        $this->load->model('SchoolYear_Model');
    }

    public function index()
    {
        if($this->input->post('search') == NULL || ($this->input->post('x') == NULL && $this->input->post('search_param') == "filterby"))
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

        $this->load->model('gosmAdmin_Model', 'model');
         $this->load->library('pagination');
         $this->load->helper('url');

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

        
        $data['gosmsamp'] = $this->model->getGosm(0,0, $term);
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


        $count = sizeof($data['gosmsamp']);

        $config['base_url'] = site_url('GosmAdmin_Cont/home');
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
            }
        }
        //call the model function to get the department data
        $data['gosm'] = $this->model->getGosm($config["per_page"], $data['page'], $term);           

        $data['pagination'] = $this->pagination->create_links();

        $data['org'] = "";
        //load the department_view
        $this->load->view('include/GosmHead');
        $this->load->view('include/Nav_Admin',$data);
        $this->load->view('GosmAdmin', $data);    
    }

    public function setpagination2($data, $text, $filterby, $org)
    {

        $count = sizeof($data['gosmsamp']);

        //pagination settings
        $config['base_url'] = site_url('GosmAdmin_Cont/filter/'.$filterby.'/'.$text.'/'.$org);
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

        //call the model function to get the department data
   
         $query = $this->SchoolYear_Model->getSchoolYear();
        if($query){
            foreach($query as $row){
           
            $term = $row->termID;
            }
        }
       if($filterby == "title"){
             $data['gosm'] = $this->model->getGosmTitlefilter($org,$text, $config["per_page"], $data['page'], $term);
            if($org == 'dummy'){
               $data['gosm'] = $this->model->getGosmTitlefilter("",$text, $config["per_page"], $data['page'], $term);
            }
       }
        else{
                $data['gosm'] = $this->model->getGosm_org($org,$config["per_page"], $data['page'], $term);
                 if($org == 'dummy'){
                     $data['gosm'] = $this->model->getGosm_org("", $config["per_page"], $data['page'], $term);
                 }

            }
    
        

        $data['pagination'] = $this->pagination->create_links();
        
        $data['org'] = $org;
        if($org == 'dummy'){
            $data['org'] = "";
        }

        $this->load->view('include/GosmHead');
        $this->load->view('include/Nav_Admin',$data);
        $this->load->view('GosmAdmin', $data);  
        
    }


    public function filter($filterby , $text, $org){
        $this->load->model('GosmAdmin_Model', 'model');
        $this->load->library('pagination');
         $this->load->helper('url');

        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
             $query = $this->SchoolYear_Model->getSchoolYear();
                if($query){
                    foreach($query as $row){
                   
                    $term = $row->termID;
                    }
                }
             $data['gosmsamp'] = $this->model->getGosm_org($org,0,0, $term);

             if($data['gosmsamp'] == NULL){
                $data['gosmsamp'] = $this->model->getGosmTitlefilter($org,$text, 0,0, $term);
                $filterby = "title";
            }

            if($data['gosmsamp'] == NULL && $org == 'dummy'){
                $data['gosmsamp'] = $this->model->getGosmTitlefilter("",$text, 0,0, $term);
                $filterby = "title";
            }
        
            if($data['gosmsamp'] == NULL){
                
                $data['gosmsamp'] = $this->model->getGosm_org($org,0,0, $term);
                $filterby = "filterby";
            }
            if($data['gosmsamp'] == NULL && $org == 'dummy'){
                
                $data['gosmsamp'] = $this->model->getGosm_org("",0,0, $term);
                $filterby = "filterby";
            }

        
        


         $data["listorgs"] = $this->model->getOrgs();
        $this->setpagination2($data, $text, $filterby, $org);

        }
        else{
            redirect('Login', 'refresh');
        }
        

    }


}
?>