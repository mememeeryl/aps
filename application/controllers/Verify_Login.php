<?php
class Verify_Login extends CI_Controller {
 

 
 function index()
 {
   //This method will have the credentials validation

   $this->form_validation->set_rules('username', 'Username', 'callback_check_database');
   #$this->form_validation->set_rules('userPassword', 'Password', 'trim|required|xss_clean|callback_check_database');
 
   if($this->form_validation->run() == TRUE)
   {
     //Field validation failed.  User redirected to login page
      redirect('Org_Cont', 'refresh');
   }
   else if ($this->input->post('username') == 'Admin' || $this->input->post('username') == 'admin')
   { 
      $admin = 'Admin';
       $sess_array = array(
         'username' => $admin
       );
      $this->session->set_userdata('logged_in', $sess_array);
      redirect('Admin_Cont', 'refresh');
   }
   else
   {
     //Go to private area
    $this->load->view('include/logHeader');
      $this->load->view('login');
   }
 
 }
 
 function check_database($username)
 {
    $this->load->model('login_model');
   //query the database
   $result = $this->login_model->login($username);
 
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'username' => $row->orgName
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
       return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
}
?>
?>