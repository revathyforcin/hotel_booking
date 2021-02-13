<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller 
{
	public $_output;
	public function __construct()
	{
		parent::__construct();
		$this->_table_hotel_details = 'hotel_details';
	}

	//view home page
	public function index()
	{ 	
		$this->_output['page'] = '';
		$this->load->view('home',$this->_output);
	}

	public function extract_json()
	{
		$path = "./data/json/";
		$temp_files = scandir($path);
		$string = file_get_contents("./data/json/hotelAvailability_Response.json");
		$data = json_decode($string, true);
		// echo '<pre>';print_r($data['result'][0]['stars']);

		date_default_timezone_set('Asia/Kolkata');
    	$date = date('Y-m-d H:i:s');

		foreach($data['result'] as $da)
		{  
			$data1 = array(
				'hotel_id'				=>	$da['hotel_id'],
				'hotel_name'			=>	$da['hotel_name'],
				'address'				=>	$da['address'],
				'stars'					=>	isset($da['stars'])?$da['stars']:NULL,
				'price'					=>	$da['price'],
				'photo'					=>	$da['photo'],
				'hotel_currency_code'	=>	$da['hotel_currency_code'],
				'amenities'				=>	implode(',',str_replace('_',' ', $da['hotel_amenities'])),
				'created_at'			=>	$date,
				'status'				=>	1); //echo '<pre>';print_r($data1);
			$insert = $this->db_mdl->insert($this->_table_hotel_details, $data1);
		}
	}

	
}
