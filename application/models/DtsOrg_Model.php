<?php 
Class DtsOrg_Model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    
   function getActivities($orgname, $limit, $start, $termID)
   {
     $code = 'SELECT *, 
                    group_concat(date_format(onedate, "%M %d, %Y") separator ", ") as "MultipleOne", 
                    group_concat(date_format(onedate, "%M %d, %Y"), " — ", date_format(enddate, "%M %d, %Y") separator ",") as "MultipleNotOne"
              FROM gendetails , submission , astatus , activity ,org, officerdetails, yearterm, actDates
              WHERE OrgName = '.'"'.$orgname.'"'.' 
                    and ProjectID = Date_ProjectID
                    and ProjectID = Act_ProjectID 
                    and ProjectID = Sub_ProjectID 
                    and SubID = Stat_SubID
                    and Proj_OrgID = OrgID 
                    and Off_SubID = SubID
                    and termID = '.'"'.$termID.'"'.' 
                    and termID = gendetails_termID
                    and ProjectID = Date_ProjectID
              group by subID
              order by DateSubmitted desc ';

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

    function getActivitiesSTfilter($orgname, $text, $limit, $start, $termID){
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
                    and SubType = '.'"'.$text.'"'.'
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
              where OrgName = '.'"'.$orgname.'"'.' 
                    and ProjectID = Act_ProjectID 
                    and ProjectID = Sub_ProjectID 
                    and SubID = Stat_SubID
                    and Proj_OrgID = OrgID 
                    and Off_SubID = SubID 
                    and Stat = '.'"'.$text.'"'.'
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

    function getActivitiesTitlefilter($orgname, $text, $limit, $start, $termID ){
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

   
   function __destruct() {
        $this->db->close();
    }

}

?>