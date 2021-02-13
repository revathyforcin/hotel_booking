<?php
function date_reverse_year_first($date) {
    //YYY-MM-DD
    return implode('-', array_reverse(explode('-', $date)));
}
function date_reverse_day_first($date) {
    //DD-MM-YYYY
    return implode('-', array_reverse(explode('-', $date)));
}
function slug($text) {
    return url_title($text, '-', TRUE);
}
function randomCaptcha($length = 6) {
    $CI = &get_instance();
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
//    $CI->session->set_userdata("captchakey", $randomString);
    return $randomString;
}
function secretKey($length = 10, $keyOPen = 4, $keyClose = 4) {
    $CI = &get_instance();
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $keyHint = array("key" => $randomString, "open" => $keyOPen, "close" => $keyClose);
    $CI->session->set_userdata("secretkey", $keyHint);
    return randomCaptcha($keyOPen) . $randomString . randomCaptcha($keyClose);
}
function getProfilePic($id)
{
    $CI = &get_instance();
    $image = $CI->db->select('ud_image')->from('user_details')->where(array('ud_user_id'=>$id))->get()->row()->ud_image; 
    return $image;
}

function getAttendanceStatus($user_id)
{
    $CI = &get_instance();
    $date = date('Y-m-d');
    $time = $CI->db->select('*')->from('attendance')->where(array('user_id'=>$user_id,'attendance_date'=>$date))->get(); 
    // $time = strtotime('2010-04-28 17:25:43');
    if($time->num_rows() > 0)
    {
        return $time->row()->attendance;
    }
    else
    {
        return 0;
    }
}

//helper function to upload images.
if ( ! function_exists('upload_image_file'))
{
    function upload_image_file($file_path, $file_name, $config = array()){
        $ci_instance = & get_instance();

        if(!is_dir($file_path)){
            mkdir($file_path, 0777, true);
        }
        if (empty($config)) {
            $config['upload_path'] = $file_path;
            $config['allowed_types'] = '*';
            $config['file_name'] = time();
        }

        $ci_instance->load->library('upload', $config);
        $ci_instance->upload->initialize($config);

        if($ci_instance->upload->do_upload($file_name)){ 
            $uploaded_file_details = $ci_instance->upload->data();
            $config['image_library'] = 'gd2';  
            $config['source_image'] = $file_path.$uploaded_file_details['file_name'];  
            $config['maintain_ratio'] = TRUE;  
            $config['quality'] = '60%';  
            $config['width'] = 400;  
            $config['height'] = 400;  
            $config['new_image'] = $file_path.$uploaded_file_details['file_name'];  
            $ci_instance->load->library('image_lib', $config);  
            $ci_instance->image_lib->resize(); 
            $result['status'] = true;
            $result['message'] = 'Uploaded_successfully';
            $result['file_name'] = $uploaded_file_details['file_name'];
            $result['file_path'] = $uploaded_file_details['file_path'];
            $result['full_path'] = $uploaded_file_details['full_path'];
        }
        else{ 
            $result['message'] = $ci_instance->upload->display_errors();
            $result['status'] = false;
        }

        return $result;
    }
}