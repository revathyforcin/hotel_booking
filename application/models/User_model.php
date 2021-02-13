<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table_name = 'user';
	}
  
	/**
	* Get all users.
	* 
	* @return type 
	*/
	public function fetch_all()
	{
		$this->db->select('cmt_register.re_id, cmt_register.re_email, cmt_register.is_admin, cmt_register.is_active, cmt_register.created_at, cmt_register.last_logged_in, cmt_register.last_ip, IFNULL(COUNT(`album`.`re_id`), 0) as `total_albums`', FALSE)
            ->from($this->table_name)
            ->join('album', 'album.created_by = cmt_register.re_id', 'left')
            ->group_by('cmt_register.re_id');
		$q = $this->db->get();
    
		return $q->result();
	}
  
	/**
	* Authenticate user.
	* 
	* @param array $data
	* @return type 
	*/
	public function authenticate(array $data)
	{ 
		$query = $this->db->get_where('user', array('email_address' => $data['email_address'], 'password' => md5($data['password'])));
		// if($query->num_rows() == '0')
		// {
    	
  //   	$query = $this->db->get_where('user', array('uacc_name' => $data['email_address'], 'password' => md5($data['password'])));

		// }

		$user_id = 0;
		$is_valid = ($query->num_rows() > 0);
		if ($is_valid == TRUE)
		{
			$user_id = $query->row()->id;
			$this->update_last_logged_in($user_id);
			$this->update_last_ip($user_id);
		} 
    
		return $user_id;
	}
  
 public function  find_by_id($user_id){

 	$query = $this->db->where('id',$user_id)->get('user')->row();
 	return $query;
 }
	/**
	* Find user by email address.
	* 
	* @param type $email_address
	* @return type 
	*/
	public function get_by_email_address($email_address)
	{
		$q = $this->db->get_where($this->table_name, array('email_address' => $email_address));
    
		return $q->row();
	}
  
	/**
	* Update last_ip column for user.
	* 
	* @param type $user_id
	* @return type 
	*/
	public function update_last_ip($user_id)
	{
		$this->db->update($this->table_name, array('last_ip' => $this->input->ip_address()), array('id' => $user_id));
    
		return $user_id;
	}
  
	/**
	* Update last_logged_in column for user.
	* 
	* @param type $user_id
	* @return type 
	*/
	public function update_last_logged_in($user_id)
	{
		$now = date('Y-m-d H:i:s');
		$this->db->update($this->table_name, array('last_logged_in' => $now), array('id' => $user_id));
    
		return $user_id;
	}
  
	/**
	* Update user's password.
	* 
	* @param type $password
	* @param type $user_id
	* @return type 
	*/
	public function update_password($password, $user_id)
	{
		$this->db->update($this->table_name, array('password' => $password), array('id' => $user_id));
    
		return $user_id;
	}

}
?>