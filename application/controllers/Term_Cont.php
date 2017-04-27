<?php
class Term_Cont extends CI_Controller {
 
  public function __construct()
    {
        parent::__construct();
        $this->load->model('Term_Model','model');
    }

    public function getTerm($id)
    {

        $data = $this->model->get_by_id($id);

        echo json_encode($data);
    }
 
  
   public function newTerm()
   {
        //$this->_validate(); 
        $this->load->model('Term_Model', 'model');
        echo 'fasfds';

        $this->model->moveDataToHistory();
        $this->model->moveGosmToHistory();
        $this->model->deleteNotif();


        $data['schoolyear'] = $this->input->post('year1'). "-" . $this->input->post('year2');
        $data['schoolterm'] = $this->input->post('term');
        $data['start'] = $this->input->post('datePicker1');
        $data['end'] = $this->input->post('datePicker2');
        $data['deadline'] = $this->input->post('deadline');

        $this->model->addTerm($data);
        echo json_encode(array("status" => TRUE));
    

   }

   public function editTerm($id){
        $this->_validateEdit(); 
        $this->load->model('Term_Model', 'model');

        $data['end'] = $this->input->post('datePicker2');
        $data['deadline'] = $this->input->post('deadline');


        $this->model->updateTerm($id, $data['end'],$data['deadline']);
        echo json_encode(array("status" => TRUE));
   }

   private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('year1') == '' || $this->input->post('year2') == '')
        {
            $data['inputerror'][] = 'year1';
            $data['error_string'][] = 'School year is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('term') == '')
        {
            $data['inputerror'][] = 'term';
            $data['error_string'][] = 'Please select term';
            $data['status'] = FALSE;
        }

        if($this->input->post('deadline') == '')
        {
            $data['inputerror'][] = 'deadline';
            $data['error_string'][] = 'Please select deadline';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('datePicker1') == '' || $this->input->post('datePicker2') == '')
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
    private function _validateEdit()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if( $this->input->post('datePicker2') == '')
        {
            $data['inputerror'][] = 'datePicker2';
            $data['error_string'][] = 'Term duration is required';
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
