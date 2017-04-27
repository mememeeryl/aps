<?php
	class SchoolYear_Model extends CI_model{


	function __construct() {
        parent::__construct();
        $this->load->database();
    }


	   function getSchoolYear()
	   {
	    	$code ='Select *
					FROM yearterm
					WHERE 
					TermID= (SELECT MAX(TermID) 
					from submission S1)';
	   		$query = $this->db->query($code);

	     if($query -> num_rows() == 1)
	     {
	       return $query->result();
	     }
	     else
	     {
	       return false;
	     }
	   }

	   
	   function getNotifs($id){
	   	 $code = 'SELECT notif
					FROM notification
					WHERE notif_OrgID = '.$id.'
					ORDER by notifID desc;';

		$query = $this->db->query($code);

	     if($query -> num_rows() > 0)
	     {
	       return $query->result();
	     }
	     else
	     {
	       return false;
	     }
	   }

	   function getOrgID($orgname)
   {
     $code = 'SELECT `org`.`OrgID`
              FROM `cso`.`org`
              WHERE OrgName = '.'"'.$orgname.'"'.';
              ';

      $query = $this->db->query($code);
      if($query->num_rows()>0){

       $table = $query->row();
        return $table->OrgID;
      }else {
        return NULL;
      }

    }



}
?>