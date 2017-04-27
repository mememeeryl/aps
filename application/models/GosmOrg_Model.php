<?php 
Class GosmOrg_Model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    
   function getGosm($orgname, $limit, $start, $termID)
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



    function addToGosm($data, $orgname){
      $termID = $data['termID'];
      $title = $data['title'];
      $goals = $data['goals'];
      $Objective= $data['objective'];
      $Desc = $data['desc'];
      $Measures= $data['measure'];
      $OC= $data['oc'];
      $tieUp = $data['tieUp'];
      $ActNature= $data['ActNature'];
      $ActType= $data['ActType'];
      $related = $data['related'];
      $budget = $data['budget'];
      $venue = $data['venue'];
      $code = 'SET foreign_key_checks = 0';
      $this->db->query($code);

        $code = 'INSERT INTO `cso`.`gosm`
                (`gosm_termID`,
                `Gosm_OrgID`,
                `Title`,
                `Goals`,
                `Objectives`,
                `BriefDesc`,
                `Measures`,
                `inCharge`,
                `gosm_tieUp`,
                `GNature`,
                `GType`,
                `Related`,
                `Budget`,
                `Venue`)
                VALUES
                ('.'"'.$termID.'"'.',
                '.'"'.$orgname.'"'.',
                '.'"'.$title.'"'.',
                '.'"'.$goals.'"'.',
                '.'"'.$Objective.'"'.',
                '.'"'.$Desc.'"'.',
                '.'"'.$Measures.'"'.',
                '.'"'.$OC.'"'.',
                '.'"'.$tieUp.'"'.',
                '.'"'.$ActNature.'"'.',
                '.'"'.$ActType.'"'.',
                '.'"'.$related.'"'.',
                '.'"'.$budget.'"'.',
                '.'"'.$venue.'"'.');';
      $this->db->query($code);

      $code = 'SET foreign_key_checks = 1';
      $this->db->query($code);

    }

    function addToTargetDate($data){
      $gosmID = $data['gosmID'];
      $oneDate = $data['oneDate'];
      $endDate = $data['endDate'];
      $particulars = $data['particulars'];

      $code = 'SET foreign_key_checks = 0';
      $this->db->query($code);

      if($oneDate != NULL && $endDate !=NULL){
      $code = 'INSERT INTO `cso`.`targetdate`
              (`date_gosmID`,
              `G_OneDate`,
              `G_EndDate`,
              `Particulars`)
              VALUES
              ('.'"'.$gosmID.'"'.',
              '.'"'.$oneDate.'"'.',
              '.'"'.$endDate.'"'.',
              '.'"'.$particulars.'"'.');';
            }
      if($endDate == NULL ){
        $code = 'INSERT INTO `cso`.`targetdate`
              (`date_gosmID`,
              `G_OneDate`,
              `Particulars`)
              VALUES
              ('.'"'.$gosmID.'"'.',
              '.'"'.$oneDate.'"'.',
              '.'"'.$particulars.'"'.');';
      }
      if($endDate == NULL && $oneDate== NULL){
         $code = 'INSERT INTO `cso`.`targetdate`
              (`date_gosmID`,
              `Particulars`)
              VALUES
              ('.'"'.$gosmID.'"'.',
              '.'"'.$particulars.'"'.');';
      }

      $this->db->query($code);

      $code = 'SET foreign_key_checks = 1';
      $this->db->query($code);

    }

    function getGosmID($data){

      $termID = $data['termID'];
      $title = $data['title'];
      $goals = $data['goals'];
      $Objective= $data['objective'];
      $Desc = $data['desc'];
      $Measures= $data['measure'];
      $OC= $data['oc'];
      $ActNature= $data['ActNature'];
      $ActType= $data['ActType'];
      $related = $data['related'];
      $budget = $data['budget'];
      $venue = $data['venue'];
      $tieUp = $data['tieUp'];
      $code = 'SELECT `gosm`.`gosmID`
          FROM `cso`.`gosm`
          WHERE gosm_termID = '.'"'.$termID.'"'.'
          AND   Title  = '.'"'.$title.'"'.'
          AND   Goals  = '.'"'.$goals.'"'.'
          AND   Objectives = '.'"'.$Objective.'"'.'
          AND   BriefDesc  = '.'"'.$Desc.'"'.'
          AND   Measures   = '.'"'.$Measures.'"'.'
          AND   gosm_tieUp   = '.'"'.$tieUp.'"'.'
          AND   inCharge   = '.'"'.$OC.'"'.'
          AND   GNature    = '.'"'.$ActNature.'"'.'
          AND   GType      = '.'"'.$ActType.'"'.'
          And   Related    = '.'"'.$related.'"'.'
          AND   Budget     = '.'"'.$budget.'"'.'
          AND   Venue      = '.'"'.$venue.'"'.';';
      $query = $this->db->query($code);

      if($query->num_rows()>0){
         $table = $query->row();
        return $table->gosmID;
      }else {
        return NULL;
      }

    }

     function checkIfExisting($Title, $OrgID, $termID)
     {
        $code = 'SELECT Title
              From  Org O, gosm M, yearterm Y
              Where O.OrgID = '.'"'.$OrgID.'"'.' 
                            and M.Gosm_OrgID = O.OrgID 
              and M.Title = '.'"'.$Title.'"'.'
              and Y.termID = '.'"'.$termID.'"'.' 
                            and Y.termID = M.gosm_termID
              limit 1';
        $query = $this->db->query($code);
     
    
       if($query -> num_rows() == 1)
       {
         return true;
       }
       else
       {
         return false;
       }
     }

     function getExisting($Title, $orgID, $termID)
     {
      $code ='Select G.GosmID as GosmID
          From gosm G, org O, yearterm Y
          Where o.orgID ='.'"'.$orgID.'"'.'
          and G.Title = '.'"'.$Title.'"'.'
          and Y.termID = '.'"'.$termID.'"'.' 
          and Y.termID = G.gosm_termID
          and o.orgID = G.gosm_OrgID
          Limit 1';
          $query = $this->db->query($code);

       if($query->num_rows()>0){
         $table = $query->row();
        return $table->GosmID;
      }else {
        return NULL;
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