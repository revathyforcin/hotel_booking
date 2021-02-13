<?php 


class Auth extends MY_Controller
{
	
	public $_data;
  public function __construct()
  {
    parent::__construct();
    $this->_table = 'user';
  }
  
  public function index()
  { 
    $data = array();
    $data['email'] = '';
    // $data['page'] = 'login';
    $this->load->view('auth/login',$data);
  }



  public function dashboard()
  { 
    $data = array();
    $role = $this->session->userdata('role');
    if($role == 1)
    {
      $data['page'] = 'admin/superAdminDashboard';
    }
    else
    {
      redirect('employee-attendance');
      //$data['page'] = 'admin/memberList';
    }
    $this->load->view('home_theme',$data);
  }

  public function authenticate()
  {
    // Authenticate user.
      
    if($this->input->post())
    { 
      $userData = array('email_address' => $this->input->post('email'), 'password' => $this->input->post('password'));  
      $user_id = $this->user_model->authenticate($userData); //print_r($user_id);exit;
      if ($user_id > 0)
      { 
      // Create session var
        $user = $this->user_model->find_by_id($user_id);
        $this->create_login_session($user);
        
        redirect('profile');
        
        $this->load->view('home_theme',$data);
    }
    else
    { 
       $this->session->set_flashdata('flash_message', 'Incorrect Username/Password');
     redirect('');
    }
  }

}

public function logout()
{

 $this->session->sess_destroy();
 redirect('', 'refresh');

}


public function view_forgotpassword()
{
  $this->load->view('admin/auth/password');
}

public function recover_password()
{
        // $this->load->model('db_mdl');
  $this->load->library('form_validation');
  $this->form_validation->set_rules('email_address',  'required|trim|xss_clean|callback_validate_credentials');

        //check if email is in the database
  $email = $this->input->post('email_address');  
  if($this->db_mdl->admin_email_exists($email))
  { 
        //$them_pass is the varible to be sent to the user's email 
    $temp_pass = md5(uniqid());
        //print_r($temp_pass);
        //send email with #temp_pass as a link
    $this->load->library('email', array('mailtype'=>'html'));
    $this->email->from('example@gmail.com', "Site");
    $this->email->to($this->input->post('email_address'));
    $this->email->subject("Reset your Password");

    $message = "<p>This email has been sent as a request to reset our password</p>";
    $message .= "<p><a href='".base_url()."auth/reset_password/$temp_pass'>Click here </a>if you want to reset your password,
    if not, then ignore</p>";
    echo $message;  
    $this->email->message($message);
    if($this->email->send())
    {
      if($this->db_mdl->admin_temp_reset_password($temp_pass,$email))
      {
        $this->load->view('admin/auth/forgot_password_success');
                    //echo "check your email for instructions, thank you";
      }
    }
    else
    {
      $this->load->view('admin/auth/forgot_psw_failed');
    }

  }
  else
  {
            //echo "your email is not in our database";
    $this->load->view('admin/auth/error');
  } 
        //$this->load->view('_admin/auth/forgot_password',$this->_data);
}


    /**
    * Displays reset password view. Processes password reset.
    *
    * @param type $uuid 
    */

    public function reset_password($temp_pass)
    {
        //$this->load->model('model_users');
      if($this->db_mdl->admin_is_temp_pass_valid($temp_pass))
      {
        $this->_data['email_address'] = $this->db_mdl->select_where('user',$temp_pass);
        $this->_data['temp_pass'] = $temp_pass; 
        $this->load->view('admin/auth/reset_password',$this->_data);
            //once the user clicks submit $temp_pass is gone so therefore I can't catch the new password and   //associated with the user...
      }
      else
      {
        echo "the key is not valid";    
      }
    }
    
    public function update_password()
    {
      $this->load->library('form_validation');
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red">', '</div>');
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[15]');
      $this->form_validation->set_rules('password_conf', 'Confirm Password', 'required|matches[password]');

      if($this->form_validation->run() == FALSE)
      { 
        $temp_pass = $this->input->post('temp_pass');
        $result['temp_pass']  = $temp_pass;
        $result['email_address'] = $this->db_mdl->select_where('user',$temp_pass);
        $this->load->view('forgot_password/reset_password',$result);
      }
      else
      { 
        $email = $this->input->post('email_address');
        $data = array('password'=>sha1($this->input->post('password_conf')));
        $this->_data= $this->db_mdl->update_admin_psw_where('user',$email,$data);
        $this->session->set_flashdata("flash_message", PASSWORD_CHANGE);
        redirect('auth/index');
      }
        //echo "passwords do not match";  
    }

    protected function create_login_session($user)
    {
      $session_data = array(
       'uacc_name'          => $user->uacc_name,
       'uacc_group_fk'      => $user->uacc_group_fk,
       'email_address'      => $user->email_address,
       'password'           => $user->password,
       'role'               => $user->role,
       'id'                 => $user->id,
       'branch_id'          => $user->branch_id,
       'logged_in'          => TRUE,
       'is_admin'           => 1,
       'uacc_status'        => 1);
      $this->session->set_userdata($session_data);
    }

    private function _is_logged_in()
    {
      $session_data = $this->session->all_userdata();
      return (isset($session_data['re_id']) && $session_data['re_id'] > 0 && $session_data['logged_in'] == TRUE);
    }

    public function signup()
    {
      if($this->input->post())
      {
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');

        $department = array(
          'de_name'           => 'Admin',
          'de_created_date'   => $date,
          'de_status'         => 1 );
        $insert_id = $this->db_mdl->get_last_inserted_id('cmt_department',$department);

        if($insert_id!="" && $insert_id>0)
        {
          $data = array(
            'desig_name'           => $this->input->post('type'),
            'desig_department'     => $insert_id,
            'desig_created_date'   => $date,
            'desig_status'         => 1 );
          $this->db->insert('cmt_designation',$data);

          if($data==true)
          {
            $this->_output = array(
             're_name'          => $this->input->post('name'),
             're_email'         => $this->input->post('username'),
             're_mail_address'  => $this->input->post('email'),
             're_password'      => sha1($this->input->post('password')),
             're_designation'   => 1,
             're_department'    => $insert_id,
             'uuid'             =>$this->create_uuid(),
             're_status'        => 1,
             're_created_date'  => $date);

            $insert = $this->db->insert($this->_table , $this->_output);
          }
        }
        $this->session->set_flashdata('flash_message', " Signup Successfully. Please Login...");
        redirect('auth');
      }

      $this->load->view('signup/signup');
    }




  }