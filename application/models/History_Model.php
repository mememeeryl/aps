<?php 
Class DtsAdmin_Model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    
   function getActivities2($orgname,$limit, $start, $termID)
   {
     $code = 'SELECT *, 
                    group_concat(date_format(onedate, "%M %d, %Y") separator ", ") as "MultipleOne", 
                    group_concat(date_format(onedate, "%M %d, %Y"), " — ", date_format(enddate, "%M %d, %Y") separator ",") as "MultipleNotOne"
              FROM gendetails , submission , astatus , activity ,org, officerdetails, yearterm, actDates
              where OrgName = '.'"'.$orgname.'"'.' 
                    and ProjectID = Act_ProjectID 
                    and ProjectID = Sub_ProjectID 
                    and SubID = Stat_SubID
                    and Proj_OrgID = OrgID 
                    and Off_SubID = SubID
                    and termID = '.'"'.$termID.'"'.' 
                    and termID = gendetails_termID
                    and ProjectID = Date_ProjectID 
              group by subID
              order by DateSubmitted desc';
      if($limit != 0 ){
         $code =  $code . ' limit ' . $start . ', ' . $limit;
     }


      $query = $this->db->query($code);
      if($query->num_rows()>0){

        return $query->result();
      }else {
        return NULL;
      }

    }

    function getHistory( $termID)
   {
     $code = 'SELECT * FROM History';
     
      $query = $this->db->query($code);
      if($query->num_rows()>0){

        return $query->result();
      }else {
        return NULL;
      }

    }

    function getSY($id){
      $code ='SELECT *, concat(schoolyear, " -- Term ", schoolterm) as school 
              FROM cso.yearterm Y 
              where termID != (SELECT max(termID) from yearterm Y1)';

      $query = $this->db->query($code);
      if($query->num_rows()>0){

        return $query->row()->Proj_OrgID;
      }else {
        return NULL;
      }


    }


    function getActivitiesSTfilter($orgname, $text, $limit, $start, $termID){
       $code = 'SELECT *, 
                    group_concat(date_format(onedate, "%M %d, %Y") separator ", ") as "MultipleOne", 
                    group_concat(date_format(onedate, "%M %d, %Y"), " — ", date_format(enddate, "%M %d, %Y") separator ",") as "MultipleNotOne"
              FROM gendetails , submission , astatus , activity ,org, officerdetails, yearterm, actDates
              where OrgName Like '.'"%'.$orgname.'%"'.'  
                    and ProjectID = Act_ProjectID 
                    and ProjectID = Sub_ProjectID 
                    and SubID = Stat_SubID
                    and Proj_OrgID = OrgID 
                    and Off_SubID = SubID 
                    and SubType Like '.'"%'.$text.'%"'.'
                    and termID = '.'"'.$termID.'"'.' 
                    and termID = gendetails_termID
                    and ProjectID = Date_ProjectID 
              group by subID
              order by DateSubmitted desc';

        if($limit != 0 ){
         $code =  $code . ' limit ' . $start . ', ' . $limit;
     }

              
      $query = $this->db->query($code);
      if($query->num_rows()>0){

        return $query->result();
      }else {
        return NULL;
      }
    }

    function getActivitiesStatfilter($orgname, $text, $limit, $start, $termID){
       $code = 'SELECT *, 
                    group_concat(date_format(onedate, "%M %d, %Y") separator ", ") as "MultipleOne", 
                    group_concat(date_format(onedate, "%M %d, %Y"), " — ", date_format(enddate, "%M %d, %Y") separator ",") as "MultipleNotOne"
              FROM gendetails , submission , astatus , activity ,org, officerdetails, yearterm, actDates
              where OrgName Like'.'"%'.$orgname.'%"'.'  
                    and ProjectID = Act_ProjectID 
                    and ProjectID = Sub_ProjectID 
                    and SubID = Stat_SubID
                    and Proj_OrgID = OrgID 
                    and Off_SubID = SubID 
                    and Stat Like '.'"%'.$text.'%"'.'
                    and termID = '.'"'.$termID.'"'.' 
                    and termID = gendetails_termID
                    and ProjectID = Date_ProjectID 
              group by subID
              order by DateSubmitted desc';

      if($limit != 0 ){
         $code =  $code . ' limit ' . $start . ', ' . $limit;
     }
             
      $query = $this->db->query($code);
      if($query->num_rows()>0){

        return $query->result();
      }else {
        return NULL;
      }
    }

    function getActivitiesTitlefilter($orgname, $text, $limit, $start, $termID){
       $code = 'SELECT *, 
                    group_concat(date_format(onedate, "%M %d, %Y") separator ", ") as "MultipleOne", 
                    group_concat(date_format(onedate, "%M %d, %Y"), " — ", date_format(enddate, "%M %d, %Y") separator ",") as "MultipleNotOne"
              FROM gendetails , submission , astatus , activity ,org, officerdetails, yearterm, actDates
              where OrgName Like '.'"%'.$orgname.'%"'.'  
                    and ProjectID = Act_ProjectID 
                    and ProjectID = Sub_ProjectID 
                    and SubID = Stat_SubID
                    and Proj_OrgID = OrgID 
                    and Off_SubID = SubID 
                    and ActTitle Like '.'"%'.$text.'%"'.'
                    and termID = '.'"'.$termID.'"'.' 
                    and termID = gendetails_termID
                    and ProjectID = Date_ProjectID 
              group by subID
              order by DateSubmitted desc';

        if($limit != 0 ){
         $code =  $code . ' limit ' . $start . ', ' . $limit;
     }
             
      $query = $this->db->query($code);
      if($query->num_rows()>0){

        return $query->result();
      }else {
        return NULL;
      }
    }

    function updateSubmission($where, $data){
        $date = date( "Y-m-d H:i:s");
        $status = $data['status'];
        $remarks = $data['remarks'];
        $checker = $data['checker'];

        $code =' UPDATE astatus 
        SET Stat = '.'"'.$status.'"'.' , Remarks = '.'"'.$remarks.'"'.', DateApproved = '.'"'.$date.'"'.', Checker = '.'"'.$checker.'"'.'
        Where Stat_SubID ='.'"'.$where.'"'.'' ;
        $query = $this->db->query($code);

             
    }

    function get_by_id($id)
     {

        $this->db->from('astatus');
          $this->db->where('Stat_SubID',$id);
        $query = $this->db->get(); 
          
        if($query->num_rows()>0){

            return $query->row();
        }else {
            return NULL;
          }

     }

   
   function __destruct() {
        $this->db->close();
    }

}

?>