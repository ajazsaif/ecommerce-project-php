<?php 
    //all php validation function 
function valid_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//email validate function
function validate_email($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "error";
        return $error;
    } 
}
//name validate function removes numbers 
function validate_name($name){
    if(!preg_match("/^[a-zA-Z ]*$/",$name)){
        $error = "error";
        return $error;
    }
}
//validate website url
 function validate_url($url){
     if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
      $error = "error";
        return $error;
 }
 }
//password encryption function
function secure_password($password,$salt='$2a$09$jklsmdDftru59yt900cbRf$'){
    $password = crypt($password,$salt);
    return $password;   
}
//phone number validation 
function PhoneValidation($PhoneNumber){
    $length = strlen($PhoneNumber);
    if(!is_numeric($PhoneNumber) or ($length!=10)){
        $error = "error";
        return $error;
    }
}
//token generate function 
function TokenGenerate($mail){
    $token = md5($mail.microtime().mt_rand());
    return $token;
}
//image upload check funtion
function FileUpload($img_name,$dir){
    $ImageName      = $img_name["name"];
    $Img_temp       = $img_name["tmp_name"]; 
    $ImageSize      = $img_name["size"];
    $ImageExt       = explode(".",$ImageName);
    $ImageExt       = strtolower(end($ImageExt));
    $Image_new_name = uniqid().'.'.$ImageExt;
    $store_path     = $dir.$Image_new_name;
    if(empty($ImageName)){
        $msg = "Please upload image";
        $result = false;
    }
    elseif($ImageExt == "jpg" || $ImageExt == "png" || $ImageExt == "jpeg"){
            if($ImageSize>500000){
                $msg = "Image should be in 500KB";
                $result = false;
            }
            else{
                move_uploaded_file($Img_temp,$store_path);
                $msg = $Image_new_name;
                $result = true;
            } 
    }
    else{
            $msg = " invalid image extension image should be in jpg or png format";
            $result = false;
    }
    return array("result"=>$result,"msg"=>$msg);
}
//load function this function only for when query run sucessfully it will display updation... msg
function LoadFunction($url){
    $load_url = "<script type='text/javascript'>window.setTimeout(function(){ window.location.href = '$url'; }, 1000) </script>";
    echo $load_url;
}
//function random password generate
function randomString(){
    $alphabet           = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $alphabet_length    = strlen($alphabet)-1;
    $pass = array(); //remember to declare $pass as an array
    for($i=0;$i<8;$i++){
        $n      = rand(0,$alphabet_length);
        $pass[]  =   $alphabet[$n];
    }
    return implode($pass);
}
//picture generate unique name function 
function ImageNameGenerate($img){
    $img_ext = explode(".",$img);
    $img_ext = strtolower(end($img_ext));
    $img_name = uniqid().".".$img_ext;
    return array($img_ext,$img_name);
}
//file upload with out validation 
function EmptyFileUpload($img_name,$dir){
    $ImageName      = $img_name["name"];
    $Img_temp       = $img_name["tmp_name"]; 
    $ImageSize      = $img_name["size"];
    $ImageExt       = explode(".",$ImageName);
    $ImageExt       = strtolower(end($ImageExt));
    $Image_new_name = uniqid().'.'.$ImageExt;
    $store_path     = $dir.$Image_new_name;
    if($ImageExt == "jpg" || $ImageExt == "png" || $ImageExt == "jpeg"){
            if($ImageSize>500000){
                $msg = "Image should be in 500KB";
                $result = false;
            }
            else{
                move_uploaded_file($Img_temp,$store_path);
                $msg = $Image_new_name;
                $result = true;
            } 
    }
    else{
            $msg = " invalid image extension image should be in jpg or png format";
            $result = false;
    }
    return array("result"=>$result,"msg"=>$msg);
    
}
//make slug function here
function make_slug($str)
	{ 
		if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
			$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
		$str = strtolower( trim($str, '-') );
		$str = substr($str, 0, 100);
		return $str;
	}
//CSS style sheet load function
function LoadCss($url,$file){
    $css_file    =   array_values($file);
    $output = "";
    foreach($css_file as $value){
    $output .= "<link rel='stylesheet' type='text/css' media='all' href='$url/css/$value' />".PHP_EOL;
    }
    return $output;
}
//Jss file load function defination here
function LoadJss($url,$file){
    $js_file    =   array_values($file);
    $output = "";
    foreach($js_file as $value){
    $output .="<script type='text/javascript' src='$url/js/$value'></script>".PHP_EOL;
    }
    return $output;
}
//immidiatly redirect url function
function redirect_url($file){
    $load_url = "<script type='text/javascript'>window.location.href = '$file';</script>";
    echo $load_url;
}
/**
*
* Author: Ajaz Alam
* Function Name: cwUpload()
* $field_name => Input file field name.
* $target_folder => Folder path where the image will be uploaded.
* $file_name => Custom thumbnail image name. Leave blank for default image name.
* $thumb => TRUE for create thumbnail. FALSE for only upload image.
* $thumb_folder => Folder path where the thumbnail will be stored.
* $thumb_width => Thumbnail width.
* $thumb_height => Thumbnail height.
*
**/
function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){

    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
    
    //file name setup
    $filename_err = explode(".",$_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    if($file_name != ''){
        $fileName = $file_name.'.'.$file_ext;
    }else{
        $fileName = uniqid().$_FILES[$field_name]['name'];
         //echo $fileName;
    }
    
    //upload image path
    $upload_image = $target_path.basename($fileName);
    
    //upload image
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
    {
        //thumbnail creation
        if($thumb == TRUE)
        {
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;

                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }

            //imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            ImageCopyResampled($thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,90);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,90);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail,90);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,90);
            }

        }
         unlink($upload_image);
        return $fileName;
    }
    else
    {
        return false;
    }
}
//get current date function 
function CurrentDate(){
    date_default_timezone_set("Asia/Kolkata");
    $date           =   date("Y-m-d H:i:s");
    return $date;
}
function redirect_page_url($file){
   header("location:$file"); 
}

function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function create_slug($string, $ext='.html'){     
        $replace = '-';         
        $string = strtolower($string);     
		
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);     
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);     
		
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);     
		
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);     
		
        //limit the slug size     
        $string = substr($string, 0, 100);     
		
        //slug is generated     
       // return ($ext) ? $string.$ext : $string; 
       return $string;
    } 
    function placeholder($text){
     echo "placeholder='$text'"; 
    }

function span($style = null,$text = null,$id=null){
    if($style == null && $text == null){
      echo "<span id='$id'></span>";  
    }
    elseif($style == null && $text!= null){
        echo "<span id='$id'>$text</span>";
    }
    elseif($style != null && $text == null){
        echo "<span style='$style' id='$id'></span>";
    }
    else{
        echo "<span style='$style' id='$id'>$text</span>";
    }
   
}

function get_ip_address(){
   $client  = @$_SERVER['HTTP_CLIENT_IP'];
   $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
   $remote  = $_SERVER['REMOTE_ADDR'];

   if(filter_var($client, FILTER_VALIDATE_IP))
   {
       $ip = $client;
   }
   elseif(filter_var($forward, FILTER_VALIDATE_IP))
   {
       $ip = $forward;
   }
   else
   {
       $ip = $remote;
   }

   return $ip;
}

function captcha_validate($secret_key,$captcha_field){
  $handler  =   curl_init();
  curl_setopt($handler,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($handler,CURLOPT_URL,'https://www.google.com/recaptcha/api/siteverify');
  curl_setopt($handler,CURLOPT_POSTFIELDS,array('secret'=>$secret_key,'response'=>$captcha_field['g-recaptcha-response']));
  $response =   curl_exec($handler);
  $response =   json_decode($response);
  curl_close($handler);
  if($response->success){
      return true;
  }
else{
    return false;
}
}

function pre($data)
{
    echo "<pre>";
    print_r($data);
    die();
}
?>