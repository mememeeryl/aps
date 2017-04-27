<?php 
Class GosmAdmin_Model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    
   function getGosm_org($orgname,$limit, $start, $termID)
   {
     $code = 'SELECT *, group_concat(date_format(g_onedate, "%M %d, %Y") separator ", ") as "MultipleOne", 
                    group_concat(date_format(g_onedate, "%M %d, %Y"), " — ", date_format(g_enddate, "%M %d, %Y") separator ",") as "MultipleNotOne"
              from gosm, targetdate, org, yearterm
              where OrgName = '.'"'.$orgname.'"'.' 
              and OrgID = Gosm_OrgID 
              and gosmID = date_gosmID
              and yearterm.termID = '.'"'.$termID.'"'.' 
              and yearterm.termID = gosm.gosm_termID
              group by gosmID';

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

    function getGosm($limit, $start, $termID)
   {
     $code = 'SELECT *, group_concat(date_format(g_onedate, "%M %d, %Y") separator ", ") as "MultipleOne", 
                    group_concat(date_format(g_onedate, "%M %d, %Y"), " — ", date_format(g_enddate, "%M %d, %Y") separator ",") as "MultipleNotOne"
              from gosm, targetdate, org, yearterm
              where OrgID = Gosm_OrgID 
              and gosmID = date_gosmID  
              and yearterm.termID = '.'"'.$termID.'"'.' 
              and yearterm.termID = gosm.gosm_termID
              group by gosmID';
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

    function getOrgs()
   {
     $code = 'SELECT * FROM cso.org;';

      $query = $this->db->query($code);
      if($query->num_rows()>0){

        return $query->result();
      }else {
        return NULL;
      }

    }

        function getGosmTitlefilter($orgname, $text, $limit, $start, $termID){
       $code = 'SELECT *, group_concat(date_format(g_onedate, "%M %d, %Y") separator ", ") as "MultipleOne", 
                    group_concat(date_format(g_onedate, "%M %d, %Y"), " — ", date_format(g_enddate, "%M %d, %Y") separator ",") as "MultipleNotOne"
              from gosm, targetdate, org, yearterm
              where OrgName = '.'"'.$orgname.'"'.'  
                    and OrgID = Gosm_OrgID and gosmID = date_gosmID 
                    and Title Like '.'"%'.$text.'%"'.'
                    and yearterm.termID = '.'"'.$termID.'"'.' 
                    and yearterm.termID = gosm.gosm_termID
                    group by gosmID';

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