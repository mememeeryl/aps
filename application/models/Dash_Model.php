<?php
	class Dash_Model extends CI_Model{

		function __construct(){
			parent:: __construct();
			$this->load->database();
		}

		
		function getActivityCount($orgname, $status, $termID){

			$code = 'Select COUNT(*) as "count"
					 FROM (Select *
					 	  FROM submission S,  org O, gendetails G, astatus T, yearterm Y
						  WHERE O.orgname ='.'"'.$orgname.'"'.'
						  and o.OrgID = G.Proj_OrgID 
						  and S.Sub_ProjectID = G.ProjectID 
						  and S.SubID = T.Stat_SubID 
						  and Y.termID = '.'"'.$termID.'"'.' 
	   					  and Y.termID = G.gendetails_termID
						  and SubID= (SELECT MAX(SubID) 
										from submission S1 where S.Sub_ProjectID = S1.Sub_ProjectID
						  				and stat is not null) ) as ACTS
					Where stat = '.'"'.$status.'"'.' ';

			$query = $this->db->query($code);
			if($query->num_rows()>0){

				return $query->result();
			}else {
				return NULL;
			}

		}

		function getNotGosm($orgname, $schoolyear){

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


		function getAllOrgs(){
			$query = $this->db->query('Select OrgName from org');

			if($query->num_rows()>0){

				return $query->result();
			}else {
				return NULL;
			}

		}

		function get60_40Ratio($orgname, $status, $termID){
			if($status == 'Related'){
				$code = 'SELECT 
						(SELECT Count(*) as "count"
							FROM (SELECT *
								From Gendetails G, Org O, yearterm Y, gosm
								Where O.OrgName = '.'"'.$orgname.'"'.'
								and O.OrgID = G.proj_OrgID 
								and title regexp actTitle 
								and Y.termID = '.'"'.$termID.'"'.' 
								and	Y.termID = G.gendetails_termID 		
								and Related = "Related"
								and projectID = (select max(projectID) 
												FROM gendetails G1
												where G1.ActTitle = G.ActTitle)) as R) +
						(SELECT Count(*) as count
							From (SELECT *
								FROM gendetails G, submission S, astatus A, org O, yearterm Y
								Where O.OrgName = '.'"'.$orgname.'"'.'
								and O.OrgID = G.proj_OrgID 
                                and G.ProjectID = S.Sub_ProjectID
								and subid = Stat_SubID
								and subtype = "Not in GOSM"
								and stat like "%approved"
								and gendetails_Related = "Related"
								and Y.termID = '.'"'.$termID.'"'.'  
								and	Y.termID = G.gendetails_termID) as R) as "count"';
			}
			else if($status == 'Not Related'){
				$code = 'SELECT 
						(SELECT Count(*) as "count"
							FROM (SELECT *
								From Gendetails G, Org O, yearterm Y, gosm
								Where O.OrgName = '.'"'.$orgname.'"'.'
								and O.OrgID = G.proj_OrgID 
								and title regexp actTitle 
								and Y.termID = '.'"'.$termID.'"'.' 
								and	Y.termID = G.gendetails_termID 		
								and Related = "Not Related"
								and projectID = (select max(projectID) 
												FROM gendetails G1
												where G1.ActTitle = G.ActTitle)) as R) +
						(SELECT Count(*) as count
							From (SELECT *
								FROM gendetails G, submission S, astatus A, org O, yearterm Y
								Where O.OrgName = '.'"'.$orgname.'"'.'
								and O.OrgID = G.proj_OrgID 
                                and G.ProjectID = S.Sub_ProjectID
								and subid = Stat_SubID
								and subtype = "Not in GOSM"
								and stat = "approved"
								and gendetails_Related = "Not Related"
								and Y.termID = '.'"'.$termID.'"'.'  
								and	Y.termID = G.gendetails_termID) as R) as "count"';	
			}
			

			$query = $this->db->query($code);

			

			if($query->num_rows()>0){

				return $query->result();
			}else {
				return NULL;
			}

		}

		function getPushedThrough($orgname, $status, $termID){
			if($status == 'pushed'){
				$code = 'SELECT 
						(SELECT COUNT(*)
							FROM (Select *
								  FROM submission S,  org O, gendetails G, astatus T, gosm A, yearterm Y
							   	  WHERE O.orgname ='.'"'.$orgname.'"'.' 
							   	  		and o.OrgID = G.Proj_OrgID 
							   	  		and S.Sub_ProjectID = G.ProjectID 
							   	  		and S.SubID = T.Stat_SubID
							   	  		and o.OrgID = A.Gosm_OrgID 
							   	  		and A.Title regexp G.ActTitle 
							   	  		and Y.termID = '.'"'.$termID.'"'.' 
	   								    and	Y.termID = G.gendetails_termID 	
							   	  		and SubID= (SELECT MAX(SubID) 
													from submission S1 
													where S.Sub_ProjectID = S1.Sub_ProjectID
														  and stat is not null) 
										and stat like "%Approved") 
						as acts) as "pushedthrough";  ';	
			}
			else if($status == 'not-pushed'){
				$code = 'SELECT 
							(SELECT COUNT(G.Title)
					 	 	FROM gosm G, org O, yearterm Y
						  	where o.orgID = G.gosm_orgID 
						  		  and Y.termID = '.'"'.$termID.'"'.' 
	   						   	  and Y.termID = G.gosm_termID 	
						  		  and o.OrgName ='.'"'.$orgname.'"'.') -
							(SELECT COUNT(*)
							FROM (Select *
									FROM submission S,  org O, gendetails G, astatus T, gosm A, yearterm Y
									WHERE O.orgname ='.'"'.$orgname.'"'.'
									 	  and o.OrgID = G.Proj_OrgID
								  		  and S.Sub_ProjectID = G.ProjectID 
								  		  and S.SubID = T.Stat_SubID 
								  		  and o.OrgID = A.Gosm_OrgID 
								  		  and A.Title regexp G.ActTitle 
								  		  and Y.termID = '.'"'.$termID.'"'.' 
	   									  and	Y.termID = G.gendetails_termID 	
								  		  and SubID= (SELECT MAX(SubID) 
													  FROM submission S1 where S.Sub_ProjectID = S1.Sub_ProjectID
													  and stat is not null) and stat like "%Approved") as acts) as "pushedthrough";';	
				}

			$query = $this->db->query($code);

			

			if($query->num_rows()>0){

				return $query->result();
			}else {
				return NULL;
			}

		}

		function getTimeIn($orgname, $status, $termID){
			if($status == 'Within'){
				$code = 'SELECT 
						(SELECT COUNT(*)
							FROM (Select G.title, ((DATEDIFF(G_oneDate, OneDate)) -
										        ((WEEK(G_oneDate) - WEEK(OneDate))) -
										        (case when weekday(G_oneDate) = 6 then 1 else 0 end))
									FROM targetdate T, gosm G, actDates A,  org O, gendetails GE, astatus TA, submission S, yearterm Y
									Where GE.ProjectID = A.date_ProjectID 
										  and T.date_gosmID = G.gosmID 
										  and S.Sub_ProjectID = GE.ProjectID 
										  and S.SubID = TA.Stat_SubID 
										  and O.OrgID = G.Gosm_OrgID 
										  and G.Title regexp GE.ActTitle 
										  and Y.termID = '.'"'.$termID.'"'.' 
	   									  and Y.termID = G.gosm_termID 	
										  and SubID= (SELECT MAX(SubID) 
													  from submission S1 
													  where S.Sub_ProjectID = S1.Sub_ProjectID
						  	 						  and stat is not null) 
						  	 			  and stat like "%Approved" 
						  	 			  and O.orgID = GE.Proj_OrgID 
						  	 			  and O.orgname = '.'"'.$orgname.'"'.' 
						  	 			  and T.Particulars = GE.ActPart
			      				 		  and datediff(A.OneDate, T.G_OneDate) <= 7 
			      				 		  and datediff(A.OneDate, T.G_OneDate) >= -7) 
			      				 		  as Within) +
						(SELECT COUNT(*)
						 	 FROM (Select G.title, ((DATEDIFF(G_oneDate, OneDate)) -
										        ((WEEK(G_oneDate) - WEEK(OneDate))) -
										        (case when weekday(G_oneDate) = 6 then 1 else 0 end))
									FROM targetdate T, gosm G, actDates A,  org O, gendetails GE, astatus TA, submission S, yearterm Y
									Where GE.ProjectID = A.date_ProjectID 
										  and T.date_gosmID = G.gosmID 
										  and S.Sub_ProjectID = GE.ProjectID 
										  and S.SubID = TA.Stat_SubID 
										  and O.OrgID = G.Gosm_OrgID 
										  and G.Title regexp GE.ActTitle 
										  and Y.termID = '.'"'.$termID.'"'.' 
	   									  and Y.termID = G.gosm_termID 	
	   									  and SubID= (SELECT MAX(SubID) 
													from submission S1 
													where S.Sub_ProjectID = S1.Sub_ProjectID
													and stat is not null) 
										  and stat like "%Approved" 
										  and O.orgID = GE.Proj_OrgID 
										  and O.orgname = '.'"'.$orgname.'"'.' 
										  and T.Particulars = GE.ActPart
			      				 	      and datediff(A.OneDate, T.G_OneDate) is null) as Within) 
			      				 	      as "within";';	
			}
			else if($status == 'not-Within'){
				$code = 'SELECT 
						(SELECT COUNT(*)
							 FROM (Select G.title, ((DATEDIFF(G_oneDate, OneDate)) -
										        ((WEEK(G_oneDate) - WEEK(OneDate))) -
										        (case when weekday(G_oneDate) = 6 then 1 else 0 end))
								 	FROM targetdate T, gosm G, actDates A,  org O, gendetails GE, astatus TA, submission S, yearterm Y
									Where GE.ProjectID = A.date_ProjectID 
										  and T.date_gosmID = G.gosmID 
										  and S.Sub_ProjectID = GE.ProjectID 
										  and S.SubID = TA.Stat_SubID 
										  and O.OrgID = G.Gosm_OrgID 
										  and G.Title regexp GE.ActTitle 
										  and Y.termID = '.'"'.$termID.'"'.' 
	   									  and Y.termID = G.gosm_termID 	
										  and SubID= (SELECT MAX(SubID) 
													from submission S1 
													where S.Sub_ProjectID = S1.Sub_ProjectID
													and stat is not null) 
										  and stat like "%Approved" 
										  and O.orgID = GE.Proj_OrgID 
										  and O.orgname = '.'"'.$orgname.'"'.' 
										  and T.Particulars = GE.ActPart
			      				 		and datediff(A.OneDate, T.G_OneDate) > 7 ) as Within) +
						(SELECT COUNT(*)
						 	 FROM (Select G.title, ((DATEDIFF(G_oneDate, OneDate)) -
										        ((WEEK(G_oneDate) - WEEK(OneDate))) -
										        (case when weekday(G_oneDate) = 6 then 1 else 0 end))
									FROM targetdate T, gosm G, actDates A,  org O, gendetails GE, astatus TA, submission S, yearterm Y
									Where GE.ProjectID = A.date_ProjectID 
										  and T.date_gosmID = G.gosmID
				  						  and S.Sub_ProjectID = GE.ProjectID 
				  						  and S.SubID = TA.Stat_SubID 
				  						  and O.OrgID = G.Gosm_OrgID 
				  						  and G.Title regexp GE.ActTitle 
				  						  and Y.termID = '.'"'.$termID.'"'.' 
	   									  and Y.termID = G.gosm_termID 	
										  and SubID= (SELECT MAX(SubID) 
													from submission S1 
													where S.Sub_ProjectID = S1.Sub_ProjectID
													and stat is not null) 
										  and stat like "%Approved" 
										  and O.orgID = GE.Proj_OrgID 
										  and O.orgname = '.'"'.$orgname.'"'.' 
										  and T.Particulars = GE.ActPart
			      				 			and datediff(A.OneDate, T.G_OneDate) < -7) as Within) +
						(SELECT COUNT(*)
						  	 FROM (Select G.title, datediff(A.OneDate, T.G_OneDate)
									FROM targetdate T, gosm G, actDates A,  org O, gendetails GE, astatus TA, submission S, yearterm Y
									Where GE.ProjectID = A.date_ProjectID 
										  and T.date_gosmID = G.gosmID
										  and S.Sub_ProjectID = GE.ProjectID 
										  and S.SubID = TA.Stat_SubID 
										  and O.OrgID = G.Gosm_OrgID 
										  and G.Title regexp GE.ActTitle 
										  and Y.termID = '.'"'.$termID.'"'.' 
	   									  and Y.termID = G.gosm_termID 	
										  and SubID= (SELECT MAX(SubID) 
													from submission S1 
													where S.Sub_ProjectID = S1.Sub_ProjectID
													and stat is not null) 
										  and stat like "%Approved" 
										  and O.orgID = GE.Proj_OrgID 
										  and O.orgname = '.'"'.$orgname.'"'.' 
										  and T.Particulars <> GE.ActPart) as Within) as "within"';	
			}

			$query = $this->db->query($code);

			

			if($query->num_rows()>0){

				return $query->result();
			}else {
				return NULL;
			}

		}

	}




?>