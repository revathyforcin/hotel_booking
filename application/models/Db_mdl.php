<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Db_mdl extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}
/*
fetch all data from table
$this->db_mdl->fetch_all('menu');
*/
		public function fetch_all($table,$where='',$order='')
		{
			$result = $this->db->select('*')->from($table);
			if($where!='')
				$result=$this->db->where($where);
			if($order!='')
				$result=$this->db->order_by($order);
			else {
				$result=$this->db->order_by('id','desc');
			}
			$result=$this->db->get();

			return $result->result_array();
		}
		public function fetch_all_values($table,$where='')
		{
			$result = $this->db->select('*')->from($table);
			$result=$this->db->order_by('id','desc');
			if($where!='')
				$result=$this->db->where($where);

			$result=$this->db->get();

			return $result;
		}
/* $this->db_mdl->fetch_by_status('menu');*/
		public function fetch_by_status($table,$where='')
		{
			$result = $this->db->select('*')->from($table)->where('status !=','0');
			if($where!='')
				$result=$this->db->where($where);
			$result=$this->db->get();
			return $result->result();
		}
/* $this->db_mdl->fetch_where('menu',array('id !='=>'0');*/
		public function fetch_where($table,$where)
		{
			$result = $this->db->select('*')->from($table)->where($where)->get();
			return $result->result();
		}

		public function fetch_row($table,$where)
		{
			$result = $this->db->select('*')->from($table)->where($where)->get();
			return $result->row();
		}


/*
fetch all data from table
$this->db_mdl->fetch_limit('menu');
*/
		public function fetch_limit($table,$where='',$limit='')
		{
			$result = $this->db->select('*')->from($table);


			$result=$this->db->order_by('id','desc');
			if($where!='')
				$result=$this->db->where($where);
			if($limit!='')
				$result=$this->db->limit($limit);
			$result=$this->db->get();
			return $result->result();
		}

/* $this->db_mdl->select('menu');*/
		public function select_order($table,$data)
		{
			$result = $this->db->select('*')
							->from($table)
							->order_by($data,'asc')
							->get();
			return $result->result();
		}
		public function select($table)
		{
			$result = $this->db->select('*')
							->from($table)
							->get();
			return $result->result();
		}
		 public function select_user($table)
	{
		$result = $this->db->select('*')
						->from($table)
						->get();
		return $result->result();
	}
		public function select_id($table)
		{
			$result = $this->db->select('*')
							->from($table)
							->where('status',1)
							->get();
			return $result->result();
		}
/* $this->db_mdl->insert('menu',$save);*/
		public function get_last_inserted_id($table,$data)
		{
			$this->db->insert($table,$data);
			return $this->db->insert_id();
		}

		public function insert($table,$data)
		{
			$this->db->insert($table,$data);
			return true;
		}
/* $this->db_mdl->delete('menu',array('id' => $data));*/
		public function delete($table,$data)
		{
			$this->db->delete($table,$data);
		}
/* $this->db_mdl->update('menu',$data));*/
		public function update($table,$id,$data)
		{
			$this->db->where('id', $id);
			$this->db->update($table, $data);
		}
	/* $this->db_mdl->update_where('menu',$data));*/
		public function update_where($table,$id,$data)
		{
			$this->db->where($id);
			$this->db->update($table, $data);
			return true;
		}
		public function delete_unlink($table,$where,$field,$path)
		{

			$this->db->where($where);
			$a=$this->db->select($field)->from($table)->get();
			$img= $a->result();
			$img= $img['0']->file_name;
			unlink('data/'.$path.'/'.$img);
			unlink('data/'.$path.'/thumb/thumb_'.$img);
			$this->db->delete($table,$where);
		}
	/* $this->db_mdl->join('menu',$data));*/
		public function fetch_join($table1,$table2,$join,$where='',$order)
		{
			$result= $this->db->select('*');
			$result= $this->db->from($table1);
			$result= $this->db->join($table2, $join);
			if($where!='')
				$result=$this->db->where($where);
			$result= $this->db->order_by($order,'desc');
			$result = $this->db->get();
			return $result->result();
		}

		public function fetch_join_group_by($table1,$table2,$join,$where='',$order,$group)
		{
			$result= $this->db->select('*');
			$result= $this->db->from($table1);
			$result= $this->db->join($table2, $join);
			if($where!='')
				$result=$this->db->where($where);
			$result= $this->db->group_by($group);
			$result= $this->db->order_by($order,'desc');
			$result = $this->db->get();
			return $result->result();
		}

		public function fetch_join_row($table1,$table2,$join,$where='')
		{
			$result= $this->db->select('*');
			$result= $this->db->from($table1);
			$result= $this->db->join($table2, $join);
			if($where!='')
				$result=$this->db->where($where);
			//$result= $this->db->order_by($order,'desc');
			$result = $this->db->get(); 
			return $result->row();
		}

		public function fetch_join_details($table1,$table2,$join,$where='',$type='left')
	    {

	        $result= $this->db->from($table1);
	        $result= $this->db->join($table2, $join, $type);
	        if($where!='')
	            $result=$this->db->where($where);
	         $result = $this->db->get();
	        return $result->result();
	    }
		public function get($table)
		{
			$query = $this->db->get($table);
			$query_result = $query->result();
			return $query_result;
		}

		public function get_all($table,$data)
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('id', $data);
			$query = $this->db->get();
			$result = $query->result();
			return $result;
		}

		public function record_count($table,$where)
		{
		   $query = $this->db->where($where)->get($table);
	       return $query->num_rows();

		}

		public function record_count_where($table,$where)
		{
		   $query = $this->db->where($where)->get($table);
	       return $query->num_rows();

		}

		Public function get_my_data($table,$limit, $start,$where,$field)
		{
			$this->db->limit($limit, $start);
			$query = $this->db->where($where)->order_by($field,'desc')->get($table);
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$data[] = $row;
				}
            return $data;
			}
            return false;
        }
		function order_by($table)
		{
			$query = $this->db->where('status',1)->order_by('id','desc')->get($table);
			return $query->num_rows();
		}
		function order_by_id($table,$where)
		{
			$this->db->select("*")
					 ->from($table);
			$this->db->where($where);
			$this->db->where('status',1);
			$this->db->order_by('id','desc');
			$query = $this->db->get();
			$result = $query->result();
			return $result;
		}
	
	

	public function approve($id,$table)
		{
            $this->db->query("UPDATE $table SET re_status = 1
                  WHERE re_id =?", array($id));
        }
		
		public function disapprove($id,$table)
		{
            $this->db->query("UPDATE $table SET re_status = 0 
                  WHERE re_id =?", array($id));
       }
      
	public function group_by($table,$where,$group)
	{
		$result = $this->db->select('*')
						->from($table)
						->where('userid',$where)
						->group_by($group)
						->get();
		return $result->result();
	}
		
	public function admin_email_exists($key)
    {   
        $this->db->where('email_address',$key);
        $query = $this->db->get('user'); 
        if ($query->num_rows() > 0){ 
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function admin_is_temp_pass_valid($key)
    { 
        $this->db->where('password',$key);
        $query = $this->db->get('user'); 
        if ($query->num_rows() > 0){ 
            return true;
        }
        else{
            return false;
        }
    }
        
    public function admin_temp_reset_password($pass,$email)
    {
        $data = array('password' => $pass);
        $this->db->where('email_address', $email);
        $this->db->update('user', $data);
        return true;
    }
    
    public function select_where($table,$temp_pass)
    { 
        $data = array('password' => $temp_pass); 
        $result = $this->db->select('*')->from($table)->where($data)->get();
        $query =  $result->num_rows(); 
        return $result->result();
    }
    
    public function update_admin_psw_where($table,$email,$data)
    { 
        $this->db->where('email_address', $email);
        $query = $this->db->update($table, $data);
        return true;
    }

    public function check_name($name)
    {
    	// if($name=='Wedding_favors_gift')
    	// {
    	// 	$name = 'Wedding favors& gift';
    	// }
    	// else
    	// {
    		$name = str_replace('_', '-', $name); 
    	// }
    	
    	$exists = $this->db->where('se_slug',$name)->get('services'); 
    	$count = $exists->num_rows();
    	$data = $exists->row(); //echo $count;exit;
    	//echo $count;
    	if($count>0)
    	{
    		return $data->se_id;
    	}
    	else
    	{
    		$exists = $this->db->where('sb_slug',$name)->get('sub_services'); 
	    	$count = $exists->num_rows();
	    	$data = $exists->row();
	    	if($count>0)
	    	{
	    		return $data->sb_service;
	    	}
	    	else
	    	{ 
    			return false;
    		}
    	}
    }

    public function check_vendor($vendor)
    {    	
    	$exists = $this->db->where('ve_slug',$vendor)->get('vendors'); 
    	$count = $exists->num_rows();
    	$data = $exists->row();
    	//echo $count;
    	if($count>0)
    	{
    		return $data->ve_id;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function check_album($album)
    {    	
    	$exists = $this->db->where('ga_slug',$album)->get('gallery'); 
    	$count = $exists->num_rows();
    	$data = $exists->row();
    	//echo $count;
    	if($count>0)
    	{
    		return $data->ga_id;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function check_page($page)
    {    	
    	$exists = $this->db->where('me_slug',$page)->get('menu'); 
    	$count = $exists->num_rows();
    	$data = $exists->row();
    	//echo $count;
    	if($count>0)
    	{
    		return $data->me_id;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function fetch_data($query)
 	{
  		$this->db->select("*");
  		$this->db->from("services");
  		//$this->db->where('ve_service_id',$sid);
  		if($query != '')
  		{
		   	$this->db->like('se_title', $query);
		   	// $this->db->or_like('ve_name', $query);
		   	// $this->db->or_like('ve_phone', $query);
		   	// $this->db->or_like('ve_location', $query);
		   	// $this->db->or_like('ve_service_id', $query);
  		}
  		$this->db->order_by('se_id', 'DESC');
  		return $this->db->get();
 	} 

 	public function fetch_subservices($query)
 	{
  		$this->db->select("*");
  		$this->db->from("sub_services");
  		//$this->db->where('ve_service_id',$sid);
  		if($query != '')
  		{
		   	$this->db->like('sb_title', $query);
		   	// $this->db->or_like('ve_name', $query);
		   	// $this->db->or_like('ve_phone', $query);
		   	// $this->db->or_like('ve_location', $query);
		   	// $this->db->or_like('ve_service_id', $query);
  		}
  		$this->db->order_by('sb_id', 'DESC');
  		return $this->db->get();
 	} 
}
?>
