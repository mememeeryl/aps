<?php 
Class Login_Model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    
   function login($username)
   {
     $this -> db -> select('orgName');
     $this -> db -> from('org');
     $this -> db -> where('orgName', $username);
     $this -> db -> limit(1);
   
     $query = $this -> db -> get();
   
     if($query -> num_rows() == 1)
     {
       return $query->result();
     }
     else
     {
       return false;
     }
   }
   
   function __destruct() {
        $this->db->close();
    }

}