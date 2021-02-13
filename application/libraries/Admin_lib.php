<?php
class Admin_lib {
  private $CI;
  private $image_file_type;
  public function __construct() {
     $this->CI = & get_instance();
     $this->image_file_type = array('image/gif', 'image/jpeg', 'image/png');
  }
  function single_imgage_create($config, $FILE, $FILE_id_name) {
     $name = $FILE[$FILE_id_name]["name"];
     $name = str_replace(' ', '_', $name);
     if(strlen($name)>200){
         $name = substr($name, -50);
     }
     while (true) {
         if (file_exists($config['upload_path'] . $name)) {
             $random_file = $this->generateRandomString(5);
             $name = $random_file . '_' . $name;
         } else {
             break;
         }
     }
     $config['file_name'] = $name;
     $check_upload = array();
     $this->CI->load->library('upload', $config);
     if (!$this->CI->upload->do_upload($FILE_id_name)) {
         $check_upload['error'] = $this->CI->upload->display_errors();
     } else {
         $check_upload['success'] = $this->CI->upload->data();
     }
     return $check_upload;
  }

  function multi_image_create($config,$FILE, $FILE_id_name){
    $check_upload = array();
     $image_file_type = array('image/gif', 'image/jpeg', 'image/png');
     if (!in_array($FILE[$FILE_id_name]["type"], $image_file_type)) {
         $check_upload['error'] = "File Extention Error!";
         return $check_upload;
     }
     $up_path = FCPATH . 'data' . DIRECTORY_SEPARATOR . 'city' . DIRECTORY_SEPARATOR;
     $name = $FILE[$FILE_id_name]["name"];
     $name = str_replace(' ', '_', $name);
     if(strlen($name)>200){
         $name = substr($name, -50);
     }
     $temp_url = $FILE[$FILE_id_name]["tmp_name"];
      while (true) {
        if (file_exists($up_path . $name)) {
             $random_file = $this->generateRandomString(5);
             $name = $random_file . '_' . $name;
         } else {
             break;
         }
     }
     move_uploaded_file($temp_url, $up_path . $name);
     $this->CI->load->library('image_moo');
     $file_uploaded = $up_path . $name;
     list($width, $height) = getimagesize($file_uploaded);
  }

  function single_image_upload($FILE, $ID_name, $target_folder, $resize_type = 'width', $resize_size = 200, $pre='thumb__') {
     if (count($FILE) === 0) {
         return "reset";
     }
     $name = $FILE[$ID_name]["name"];
     $name = str_replace(' ', '_', $name);
     if(strlen($name)>200){
         $name = substr($name, -50);
     }
     if (!$name) {
         return "hold";
     }
     $image_file_type = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/JPEG', 'image/PNG', 'image/GIF');
     if (!in_array($FILE[$ID_name]["type"], $image_file_type)) {
         echo "File Extention Error!";
         die();
     }
     $up_path = FCPATH . 'data' . DIRECTORY_SEPARATOR . $target_folder . DIRECTORY_SEPARATOR;
     $temp_url = $FILE[$ID_name]["tmp_name"];
     while (true) {
         if (file_exists($up_path . $name)) {
             $random_file = $this->generateRandomString(5);
             $name = $random_file . '_' . $name;
         } else {
             break;
         }
     }
     move_uploaded_file($temp_url, $up_path . $name);
     $file_uploaded = $up_path . $name;
     if($resize_size!= 0){
         $this->resize($file_uploaded, $pre.$name, $up_path, $resize_type, $resize_size);
     }
     return $name;
  }
  function upload_image($file, $ID_name, $target, $thumb_pos = NULL, $thumb_size = 60, $medium_pos = NULL, $medium_size = 100) {
     if (count($file) === 0) {
         return "reset";
     }
     $name = $FILE[$ID_name]["name"];
     $name = str_replace(' ', '_', $name);
     if(strlen($name)>200){
         $name = substr($name, -50);
     }
     if (!$name) {
         return "hold";
     }
     $image_file_type = array('image/gif', 'image/jpeg', 'image/png');
     if (!in_array($file[$ID_name]["type"], $image_file_type)) {
         echo "File Extention Error!".$file[$ID_name]["tmp_name"];
         die();
     }
     $r_thumb_width;
     $r_thumb_height;
     $r_medium_width;
     $r_medium_height;
     $up_path = FCPATH . 'data' . DIRECTORY_SEPARATOR . $target . DIRECTORY_SEPARATOR;
     $temp_url = $file[$ID_name]["tmp_name"];
     while (true) {
         if (file_exists($up_path . $name)) {
             $random_file = $this->generateRandomString(5);
             $name = $random_file . '_' . $name;
        } else {
             break;
         }
     }
     $upload_data = move_uploaded_file($temp_url, $up_path . $name);
     $this->CI->load->library('image_moo');
     $file_uploaded = $up_path . $name;
     list($width, $height) = getimagesize($file_uploaded);
     if ($thumb_pos === "height") {
         $r_thumb_width = $width * ($thumb_size / $height);
         $r_thumb_height = $thumb_size;
     } else if ($thumb_pos === "width") {
         $r_thumb_height = $height * ($thumb_size / $width);
         $r_thumb_width = $thumb_size;
     }
     if ($medium_pos === "height") {
         $r_medium_width = $width * ($medium_size / $height);
         $r_medium_height = $medium_size;
     } else if ($medium_pos === "width") {
         $r_medium_height = $height * ($medium_size / $width);
         $r_medium_width = $medium_size;
     }
     $r_list_width = $width * (50 / $height);
     if ($thumb_pos != NULL || $medium_pos != NULL) {
         $this->CI->image_moo->set_jpeg_quality(100)->load($file_uploaded);
         $this->CI->image_moo->resize($r_list_width, 50)->save($up_path . '_list_' . $name);
         if ($thumb_pos != NULL) {
             $this->CI->image_moo->resize($r_thumb_width, $r_thumb_height)->save($up_path . '_thumb_' . $name);
         }
         if ($medium_pos != NULL) {
             $this->CI->image_moo->resize($r_medium_width, $r_medium_height)->save($up_path . '_medium_' . $name);
         }
     }
     return $name;
  }

  function upload_file($file, $target, $input_name = 'myFile_upload', $type='audio') {
     if (!isset($file[$input_name])) {
         return "reset";
     }
     $name = $FILE[$ID_name]["name"];
     $name = str_replace(' ', '_', $name);
     if(strlen($name)>200){
         $name = substr($name, -50);
     }
     if (!$name) {
         return "hold";
     }
     $image_file_type = array(
         'text/plain', 'application/zip', 'application/x-rar-compressed'
         , 'audio/mpeg', 'application/pdf', 'application/msword', 'application/rtf'
         , 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint'
         , 'application/x-shockwave-flash', 'video/x-flv', 'image/jpeg', 'image/png'
     );
     if (!in_array($file[$input_name]["type"], $image_file_type)) {
         echo "File Extention Error!";
         die();
     }
     $up_path = FCPATH . 'data' . DIRECTORY_SEPARATOR . $target . DIRECTORY_SEPARATOR;
     $temp_url = $file[$input_name]["tmp_name"];
     while (true) {
         if (file_exists($up_path . $name)) {
             $random_file = $this->generateRandomString(5);
             $name = $random_file . '_' . $name;
         } else {
             break;
         }
     }
     move_uploaded_file($temp_url, $up_path . $name);
     return $name;
  }
  // upload file based on differet type
  function file_upload($FILE, $ID_name, $target_folder, $type = 'image') {
     if (count($FILE) === 0) {
         return "reset";
     }
     $name = $FILE[$ID_name]["name"];
     $name = str_replace(' ', '_', $name);
     if(strlen($name)>200){
         $name = substr($name, -50);
     }
     if (!$name) {
         return "hold";
     }
     $datatype = $FILE[$ID_name]["type"];
     if($type=='image')
         $file_type = array('image/gif', 'image/jpeg', 'image/png');
     else if($type=='audio')
         $file_type = array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3', 'audio/wav', 'audio/x-wav');
     else if($type=='doc')
         $file_type = array('application/msword','application/pdf','application/x-download', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/octet-stream');
     else
         $file_type = array('image/gif', 'image/jpeg', 'image/png');

     if (!in_array($datatype, $file_type)) {
         echo $ID_name."File Extention Error! ".$datatype;
         die();
     }
     $up_path = FCPATH . 'data' . DIRECTORY_SEPARATOR . $target_folder . DIRECTORY_SEPARATOR;
     $temp_url = $FILE[$ID_name]["tmp_name"];
     while (true) {
         if (file_exists($up_path . $name)) {
             $random_file = $this->generateRandomString(5);
             $name = $random_file . '_' . $name;
         } else {
             break;
         }
     }
     move_uploaded_file($temp_url, $up_path . $name);
     $reslt = array("name"=>$name, "type"=>$datatype);
     return $reslt;
  }
  // resize an image
  function resize($files, $name, $up_path, $resize_type, $resize_size){
     $this->CI->load->library('image_moo');
     list($width, $height) = getimagesize($files);
     if ($resize_type === "height") {
         $resize_width = $width * ($resize_size / $height);
         $resize_height = $resize_size;
     }
     else if ($resize_type === "width") {
         $resize_height = $height * ($resize_size / $width);
         $resize_width = $resize_size;
     }
     $this->CI->image_moo->set_jpeg_quality(100)->load($files);
     $this->CI->image_moo->resize($resize_width, $resize_height)->save($up_path . $name, TRUE);
  }
  // delete current image and its tumbnails
  function unlink_image($path, $filename) {
     $un_path = FCPATH . 'data' . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR;
     $file_types = array("_list_", "_thumb_", "_medium_", "", "thumb__", "medium__");
     foreach ($file_types as $fValues) {
         if ($filename) {
             if (file_exists($un_path . $fValues . $filename)) {
                 unlink($un_path . $fValues . $filename);
             }
         }
     }
  }
  // delete any type of file
  function unlink_file($path, $filename) {
     $un_path = FCPATH . 'data' . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR;
     if ($filename) {
         if (file_exists($un_path . $filename)) {
             unlink($un_path . $filename);
         }
     }
  }
  // generate random strings
  function generateRandomString($length = 10) {
     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
         $randomString .= $characters[rand(0, strlen($characters) - 1)];
     }
     return $randomString;
  }
   function file_upload_pdf($FILE, $ID_name, $target_folder, $type = 'image') {
     if (count($FILE) === 0) {
         return "reset";
     }
     $name = $FILE[$ID_name]["name"];
     $name = str_replace(' ', '_', $name);
     if(strlen($name)>200){
         $name = substr($name, -50);
     }
     if (!$name) {
         return "hold";
     }
     $datatype = $FILE[$ID_name]["type"];
     if($type=='image')
         $file_type = array('image/gif', 'image/jpeg', 'image/png');
     else if($type=='audio')
         $file_type = array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3', 'audio/wav', 'audio/x-wav');
     else if($type=='doc')
         $file_type = array('application/msword','application/pdf','application/ppt','application/pptx','application/x-download', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/octet-stream');
     else
         $file_type = array('image/gif', 'image/jpeg', 'image/png');

     if (!in_array($datatype, $file_type)) {
         echo $ID_name."File Extention Error! ".$datatype;
         die();
     }
     $up_path = FCPATH . 'data' . DIRECTORY_SEPARATOR . $target_folder . DIRECTORY_SEPARATOR;
     $temp_url = $FILE[$ID_name]["tmp_name"];
     while (true) {
         if (file_exists($up_path . $name)) {
             $random_file = $this->generateRandomString(5);
             $name = $random_file . '_' . $name;
         } else {
             break;
         }
     }
     move_uploaded_file($temp_url, $up_path . $name);
     //$reslt = array("name"=>$name, "type"=>$datatype);
     return $name;
  }
}
/* End of file upload_lib.php */
/* Location: ./application/libraries/upload_lib.php */
