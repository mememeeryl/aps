<?php
	class Cal_Model extends CI_model{


	function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getActDates($termID){  

	   	$code ='Select CONCAT("[",O.orgName, "] — ", actTitle) as title, OneDate as start, EndDate as end, color
				 FROM submission S,  org O, gendetails G, astatus T, yearterm Y, cal, actdates D
				  WHERE o.OrgID = G.Proj_OrgID 
				  and D.date_projectID = G.projectID
				  and S.Sub_ProjectID = G.ProjectID 
				  and S.SubID = T.Stat_SubID 
				  and Y.termID = '.'"'.$termID.'"'.' 
				  and Y.termID = G.gendetails_termID
				  and OneDate is not Null 
				  and SubID= (SELECT MAX(SubID) 
								from submission S1 where S.Sub_ProjectID = S1.Sub_ProjectID
				  				and stat is not null)
				  and stat = cal.part';
	   			$query = $this->db->query($code);

	     if($query)
	     {
	       return $query->result();
	     }
	     else
	     {
	       return false;
	     }
	   
    }


    function getTerm($termID){  

	   	$code ='Select CONCAT("[",O.orgName, "] — ", actTitle) as title, term, color
				 FROM submission S,  org O, gendetails G, astatus T, yearterm Y, cal, activity A
				  WHERE o.OrgID = G.Proj_OrgID 
				  and S.Sub_ProjectID = G.ProjectID 
				  and S.SubID = T.Stat_SubID 
				  and Y.termID = '.'"'.$termID.'"'.' 
				  and Y.termID = G.gendetails_termID
	              and G.ProjectID = A.Act_ProjectID
				  and ActPart = "Term Long"
				  and SubID= (SELECT MAX(SubID) 
								from submission S1 where S.Sub_ProjectID = S1.Sub_ProjectID
				  				and stat is not null)
				  and stat = cal.part';
	   			$query = $this->db->query($code);

	     if($query)
	     {
	       return $query->result();
	     }
	     else
	     {
	       return false;
	     }
	   
    }


    function getYear($termID){  

	   	$code ='Select CONCAT("[",O.orgName, "] — ", actTitle) as title, term, color
				 FROM submission S,  org O, gendetails G, astatus T, yearterm Y, cal, activity A
				  WHERE o.OrgID = G.Proj_OrgID 
				  and S.Sub_ProjectID = G.ProjectID 
				  and S.SubID = T.Stat_SubID 
				  and Y.termID = '.'"'.$termID.'"'.' 
				  and Y.termID = G.gendetails_termID
	              and G.ProjectID = A.Act_ProjectID
				  and ActPart = "Year Long"
				  and SubID= (SELECT MAX(SubID) 
								from submission S1 where S.Sub_ProjectID = S1.Sub_ProjectID
				  				and stat is not null)
				  and stat = cal.part';
	   			$query = $this->db->query($code);

	     if($query)
	     {
	       return $query->result();
	     }
	     else
	     {
	       return false;
	     }
	   
    }

	

}
?>