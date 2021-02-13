<?php



class Privilage 
{
	
	public function __construct() 
	{
     	$this->CI = & get_instance();
    }

	// public function is_privilaged($title)
 //  	{	
	//     $designation = $this->session->userdata('re_designation'); 
	//     $privilage = $this->db->where('user_gr_name',$designation)->get('cmt_user_group');
	//     $count = $privilage->num_rows(); 
	//     if($count>0)
	//     { 
	//       	$privilage_data = $privilage->row();
	// 	    $privilage_user = $this->db->where('priv_user_designation',$privilage_data->user_gr_id)->get('cmt_privilage_user'); 
	// 	    if($privilage_user->num_rows()>0)
	// 	    { 
	// 	    	$privilage_user = $privilage_user->row();
	// 		    $privs = $privilage_user->priv_user_privilages;
	// 		    $privs = explode(',',$privs);

	// 		    foreach($privs as $priv=>$pri)
	// 		    {  
	// 		        $priv_desc = $this->db->where('user_priv_id',$pri)->get('cmt_user_privilages')->row();
	// 		        $privilage_name = $priv_desc->user_priv_description;
	// 		        if('Dashboard Graph' == $title)
	// 		        {  
	// 		          	return TRUE;
	// 		        }
	// 		     	else
	// 			    { 
	// 			      	return FALSE;
	// 			    }
	// 		    } 
	// 		}
 //    	}
	// }
	public function is_privilaged($title)
  	{	
	    $priv_name    = $this->CI->db->where('user_priv_name',$title)->get('cmt_user_privilages')->row();
	    $priv_name_id = $priv_name->user_priv_id; 

	    $designation  = $this->CI->session->userdata('re_designation'); 
	    $privilage    = $this->CI->db->where("FIND_IN_SET('$designation', user_gr_name) != ", 0)->get('cmt_user_group');
	    //$dids = $privilage->row();
	    $count = $privilage->num_rows(); 
	    if($count>0)
	    {  
	      	$privilage_data = $privilage->row(); 
		    $privilage_user = $this->CI->db->where('priv_user_designation',$privilage_data->user_gr_id)->get('cmt_privilage_user'); 

		    if($privilage_user->num_rows()>0)
		    {  
		    	$privilage_user = $privilage_user->row();
			    $privs = $privilage_user->priv_user_privilages;
			    $privs = explode(',',$privs);

			    if(in_array($priv_name_id, $privs))
			    { 
			    	return TRUE;
			    }
			    else
			    { 
			    	return FALSE;
			    } 
			}
    	}
	}
}