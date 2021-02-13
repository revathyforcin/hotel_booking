<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller 
{
	public $_output;
	public function __construct()
	{
		parent::__construct();
		$this->_table_users = 'user';
		$this->_table_users_details = 'user_details';
		$this->_table_hotels = 'hotel_details';

		if (!$this->session->has_userdata('logged_in')) {
            redirect('login');
        }
	}

	//view home page
	public function index()
	{ 	
		if($this->input->post())
		{
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$designation = $this->input->post('designation');
			$dob = $this->input->post('dob');
			$email_address = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$password = md5($this->input->post('password'));

			date_default_timezone_set('Asia/Kolkata');
    		$date = date('Y-m-d H:i:s');
			$data = array(
                  	"user_name" 			=> $fname,
                  	"uacc_name" 		=> $fname,
                  	"email_address" 	=> $email_address,
                  	"mobile" 			=> $mobile,
                  	"password" 			=> $password,
                  	"role"				=> 'user',
                  	"is_active" 		=> 1,
                  	"is_admin" 			=> 0,
                  	"created_at"		=> $date);

			// $this->session->unset('otp');
			$last_inserted_id = $this->db_mdl->get_last_inserted_id($this->_table_users, $data);
			if($last_inserted_id)
			{
				$data2 = array(
                  	"ud_user_id" 			=> $last_inserted_id,
                  	"ud_fname" 				=> $fname,
                  	"ud_lname"				=> $lname,
                  	"ud_email" 				=> $email_address,
                  	"ud_phone" 				=> $mobile,
                  	"ud_dob" 				=> $dob,
                  	"ud_designation" 		=> $designation,
                  	"ud_created_date"		=> $date,
                  	"ud_status" 				=> 1);

				if($_FILES['profile']['tmp_name']!='')
                {
                    $data2['ud_image'] = $this->upload_image('profile');
                }
				$insert = $this->db_mdl->insert($this->_table_users_details, $data2);
			}
			$this->session->set_flashdata("success", "Successfully registered..!");
		    redirect('login', 'refresh');
		}
		$this->_output['page'] = '';
		$this->load->view('register',$this->_output);
	}

	public function profile()
	{
		$id = $this->session->userdata('id');
		if($this->input->post())
		{
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$designation = $this->input->post('designation');
			$dob = $this->input->post('dob');
			$email_address = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$password = md5($this->input->post('password'));

			date_default_timezone_set('Asia/Kolkata');
    		$date = date('Y-m-d H:i:s');
			$data = array(
                  	"user_name" 		=> $fname,
                  	"uacc_name" 		=> $fname,
                  	"email_address" 	=> $email_address,
                  	"mobile" 			=> $mobile,
                  	"role"				=> 'user',
                  	"is_active" 		=> 1,
                  	"is_admin" 			=> 0,
                  	"updated_at"		=> $date);

			// $this->session->unset('otp');
			$update = $this->db_mdl->update($this->_table_users, $id, $data);
			
				$data2 = array(
                  	"ud_fname" 				=> $fname,
                  	"ud_lname"				=> $lname,
                  	"ud_email" 				=> $email_address,
                  	"ud_phone" 				=> $mobile,
                  	"ud_dob" 				=> $dob,
                  	"ud_designation" 		=> $designation,
                  	"ud_updated_date"		=> $date,
                  	"ud_status" 			=> 1);

				if($_FILES['profile']['tmp_name']!='')
                {
                    $data2['ud_image'] = $this->upload_image('profile');
                }
                else
                {
                	$data2['ud_image'] = $this->input->post('oldphoto');
                }
				$insert = $this->db_mdl->update_where($this->_table_users_details, array('ud_user_id'=>$id) ,$data2);
			
			$this->session->set_flashdata("success", "Successfully updated profile..!");
		    redirect('profile', 'refresh');
		}
		$this->_output['details'] = $this->db_mdl->fetch_where($this->_table_users_details,array('ud_user_id'=>$id));
		$this->load->view('profile',$this->_output);
	}

	public function upload_image($name)
    {
        $uploaded_image_path = "data/profile/profile.jpg";

        if ($_FILES[$name]['name'] != "") {
            $featured_photo_upload_path = 'data/profile/';
            $featured_photo_upload_result = upload_image_file($featured_photo_upload_path, $name);

            if($featured_photo_upload_result['status'] == false){
                //upload failed.
                 $data['error'][$name] = $featured_photo_upload_result['message'];
                return setResponse(false, null, $featured_photo_upload_result['message']);
            }

            $uploaded_image_path = $featured_photo_upload_path.$featured_photo_upload_result['file_name'];

            
           
            return $uploaded_image_path;
        }
    }

	public function mobile_exists()
	{
		$mobile  = $this->input->post('mobile');
		$where['mobile'] = $mobile;
		if($this->session->userdata('id'))
		{
			$where['id !='] = $this->session->userdata('id');
		}
		$count = $this->db_mdl->record_count($this->_table_users,$where);

		if($count > 0)
		{
			echo 'false';
		}
		else
		{
			echo 'true';
		}
	}

	public function email_exists()
	{
		$email  = $this->input->post('email');
		$where['email_address'] = $email;
		if($this->session->userdata('id'))
		{
			$where['id !='] = $this->session->userdata('id');
		}
		$count = $this->db_mdl->record_count($this->_table_users,$where);

		if($count > 0)
		{
			echo 'false';
		}
		else
		{
			echo 'true';
		}
	}

	public function book_now()
	{
		$data['hotels'] = $this->db_mdl->fetch_all($this->_table_hotels,array('status'=>1),'id');
		$this->load->view('hotels',$data);
	}
		
	public function book_hotel($hotel_id)
	{
		$path = "./data/json/";
		$temp_files = scandir($path);
		$string = file_get_contents("./data/json/hotelAvailability_Response.json");
		$data = json_decode($string, true);
		// echo '<pre>';print_r($data['result'][0]['hotel_id']);
		foreach($data['result'] as $da)
		{
			if($da['hotel_id']==$hotel_id)
			{
				$data1 = array(
				'hotel_id'				=>	$da['hotel_id'],
				'hotel_name'			=>	$da['hotel_name'],
				'address'				=>	$da['address'],
				'stars'					=>	isset($da['stars'])?$da['stars']:NULL,
				'price'					=>	$da['price'],
				'photo'					=>	$da['photo'],
				'hotel_currency_code'	=>	$da['hotel_currency_code'],
				'amenities'				=>	implode(',',str_replace('_',' ', $da['hotel_amenities'])));
			}
		}
		$datas['hotel_details'] = $data1;
		//$this->db_mdl->fetch_all($this->_table_hotels,array('hotel_id'=>$hotel_id),'id');
		$this->load->view('hotels_details',$datas);
	}
}
