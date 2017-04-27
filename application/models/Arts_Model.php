<?php
	class Arts_Model extends CI_model{


	function __construct() {
        parent::__construct();
        $this->load->database();
    }


	   function getOrgID($org)
	   {
	     $this -> db -> select('orgID');
	     $this -> db -> from('org');
	     $this -> db -> where('orgName', $org );
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

	   	function checkNotGosm($orgname, $schoolyear){

			$code = 'SELECT 			(Select COUNT(*)
					 FROM (SELECT * 
                     FROM gendetails G, submission S, astatus A, org O, yearterm Y
								Where O.OrgName = '.'"'.$orgname.'"'.'
								and O.OrgID = G.proj_OrgID 
                                and G.ProjectID = S.Sub_ProjectID
								and subid = Stat_SubID
								and subtype = "Not in GOSM"
								and stat like "%approved"
								and	Y.termID = G.gendetails_termID
                                and Y.schoolterm = 1
                                and Y.schoolyear = '.'"'.$schoolyear.'"'.') as term1) +
                                 
					(Select COUNT(*)
					 FROM (SELECT * 
                     FROM gendetails G, submission S, astatus A, org O, yearterm Y
								Where O.OrgName = '.'"'.$orgname.'"'.'
								and O.OrgID = G.proj_OrgID 
                                and G.ProjectID = S.Sub_ProjectID
								and subid = Stat_SubID
								and subtype = "Not in GOSM"
								and stat like "%approved"
								and	Y.termID = G.gendetails_termID
                                and Y.schoolterm = 2
                                and Y.schoolyear = '.'"'.$schoolyear.'"'.') as term1) + 
					(Select COUNT(*)
					 FROM (SELECT * 
                     FROM gendetails G, submission S, astatus A, org O, yearterm Y
								Where O.OrgName = '.'"'.$orgname.'"'.'
								and O.OrgID = G.proj_OrgID 
                                and G.ProjectID = S.Sub_ProjectID
								and subid = Stat_SubID
								and subtype = "Not in GOSM"
								and stat like "%approved"
								and	Y.termID = G.gendetails_termID
                                and Y.schoolterm = 3
                                and Y.schoolyear = '.'"'.$schoolyear.'"'.') as term1) as count';

			$query = $this->db->query($code);
			if($query->num_rows()>0){

				return $query->result();
			}else {
				return NULL;
			}

		}

		function checkNumNotGosm($orgname, $termID){

			$code = 'Select COUNT(*) as count
					 FROM (SELECT * 
                     FROM gendetails G, submission S, astatus A, org O, yearterm Y
								Where O.OrgName = '.'"'.$orgname.'"'.'
								and O.OrgID = G.proj_OrgID 
                                and G.ProjectID = S.Sub_ProjectID
								and subid = Stat_SubID
								and subtype = "Not in GOSM"
								and stat = "No Status"
								and	Y.termID = G.gendetails_termID
                                and Y.termid = '.'"'.$termID.'"'.') as Term';

			$query = $this->db->query($code);
			if($query->num_rows()>0){

				return $query->result();
			}else {
				return NULL;
			}

		}

	      function getProjID($Title, $orgName, $termID)
	   {
	   	$code ='Select G.ProjectID as ProjectID, G.ActPart as SubType
	   			From gendetails G, org O, yearterm Y
	   			Where o.orgName ='.'"'.$orgName.'"'.'
	   			and G.ActTitle ='.'"'.$Title.'"'.'
	   			and	Y.termID = '.'"'.$termID.'"'.' 
	   			and	Y.termID = G.gendetails_termID
	   			and projectID = (Select Max(ProjectID)
								FROM gendetails G1
								Where G1.ActTitle = G.ActTitle)
	   			and o.orgID = G.Proj_OrgID
	   			Limit 1';
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

	  	function getSubID($ProjectID, $OrgName, $termID)
	   {
	   		$code = 'Select S.SubID as SubID 
	   				FROM Submission S, gendetails G, org O, yearterm Y
	   				Where S.Sub_ProjectID = '.'"'.$ProjectID.'"'.'and
	   				O.orgID = G.Proj_OrgID and 
	   				o.OrgName ='.'"'.$OrgName.'"'.'
	   				and Y.termID = '.'"'.$termID.'"'.' 
	   				and Y.termID = G.gendetails_termID
	   				and S.SubID= (SELECT MAX(SubID) 
						from submission S1 
						where S.Sub_ProjectID = S1.Sub_ProjectID)
	   				limit 1';
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

	   function checkSub($Title, $OrgName, $termID){
	   		$code = 'Select G.ActTitle as ActTitle
	   				FROM gendetails G, org O, yearterm Y, submission s, astatus
	   				Where ActTitle = '.'"'.$Title.'"'.'
	   				and O.orgID = G.Proj_OrgID 
	   				and o.OrgName ='.'"'.$OrgName.'"'.' 
	   				and Y.termID = '.'"'.$termID.'"'.' 
	   				and Y.termID = G.gendetails_termID
	   				and Sub_ProjectID = ProjectID
	   				and SubID = stat_subID
	  				and SubID = (select MAX(subID)
	  							from Submission s1
	  							where s1.Sub_ProjectID = s.Sub_ProjectID
	  							and stat = "Pending")
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

   	   function checkChange($Title, $OrgName, $termID){
	   		$code = 'Select G.ActTitle as ActTitle
	   				FROM gendetails G, org O, yearterm Y, submission s, astatus
	   				Where ActTitle = '.'"'.$Title.'"'.'
	   				and O.orgID = G.Proj_OrgID 
	   				and o.OrgName ='.'"'.$OrgName.'"'.' 
	   				and Y.termID = '.'"'.$termID.'"'.' 
	   				and Y.termID = G.gendetails_termID
	   				and Sub_ProjectID = ProjectID
	   				and SubID = stat_subID
	  				and SubID = (select MAX(subID)
	  							from Submission s1
	  							where s1.Sub_ProjectID = s.Sub_ProjectID
	  							and stat like "%Approved")
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

	   function checkTitle($Title, $OrgName, $termID)
	   {
	   		$code = 'Select G.ActTitle as ActTitle
	   				FROM gendetails G, org O, yearterm Y
	   				Where G.ActTitle regexp '.'"'.$Title.'"'.'
	   				and O.orgID = G.Proj_OrgID 
	   				and o.OrgName ='.'"'.$OrgName.'"'.' 
	   				and Y.termID = '.'"'.$termID.'"'.' 
	   				and Y.termID = G.gendetails_termID
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

	   function checkIfGosm($Title, $OrgName, $termID)
	   {
	   		$code = 'SELECT Title
							From  Org O, gosm M, yearterm Y
							Where O.OrgName = '.'"'.$OrgName.'"'.' 
                            and M.Gosm_OrgID = O.OrgID 
							and M.Title regexp '.'"'.$Title.'"'.'
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

	   function getGosmTitle($keyword)
	   {
	   		$code = 'Select Title
	   				FROM gosm
	   				Where Title like '.'"%'.$keyword.'%"'.'';
	   		$query = $this->db->query($code);

	   	if($query -> num_rows() > 0)
	   	{
	   		 return $query->result();
	   	}
	   	else{
	   		return false;
	   	}
	    
	   }
	



}
?>