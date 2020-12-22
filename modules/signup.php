<?php 
//signup validation form
 require_once('../includes/top.php');
if(isset($_POST['signup'])){
    $user_name     =   $db_handle->escapeString(valid_input($_POST['name']));
    $last_name     =   $db_handle->escapeString(valid_input($_POST['lname']));
    $user_email    =   $db_handle->escapeString(valid_input($_POST['email']));
    $user_phone    =   $db_handle->escapeString(valid_input($_POST['phone']));
    $user_pws      =   $db_handle->escapeString(valid_input($_POST['pws']));
    $secure_pass   =   secure_password($user_pws);
    $user_id       =   'MU'.mt_rand(10,1000000);
    
    $fields        =   array(
                                'user_id'=>$user_id,
                                'name'=>$user_name,
                                'email'=>$user_email,
                                'pass'=>$secure_pass,
                                'phone'=>$user_phone
                            );
    $check_email     =   "SELECT * FROM `users` WHERE email = '$user_email'";
        //check if user exists in already database
        if($db_handle->numRows($check_email) == 0){
    if($db_handle->insertQuery("users",$fields)){
        
        $last_id        =    $db_handle->last_insert_id();

        $other_fields   =    array(
            'uid'=>$last_id,
            'user_id'=>$user_id,
            'fname'=>$user_name,
            'lname'=>$last_name,
            'email'=>$user_email,
            'phone'=>$user_phone,
            'type'=>'bill'
        );
        $other_fields2   =    array(
            'uid'=>$last_id,
            'user_id'=>$user_id,
            'fname'=>$user_name,
            'lname'=>$last_name,
            'email'=>$user_email,
            'phone'=>$user_phone,
            'type'=>'ship'
        );
        
        if($db_handle->insertQuery("user_address",$other_fields)){
            $db_handle->insertQuery("user_address",$other_fields2);
                $_SESSION["vid"]            =   $last_id;
                $_SESSION["vemail"]         =   $user_email;
                $_SESSION["vname"]          =   $user_name;
                $_SESSION["vuid"]           =   $user_id;
                $_SESSION["vrole"]          =   "user";
                $_SESSION['plogin']         =   'true';
            if(isset($_SESSION['chkoutenc']) && $_SESSION['chkoutenc'] == 'loggeed'){
                    $url_path               = __WEBROOT__.'/checkout.php';
                    redirect_page_url($url_path);
                }else{
                    $url        =   __WEBROOT__.'/useradmin/index.php'; 
                    redirect_page_url($url);
                 }
        }
        else{
            $url =   __WEBROOT__.'/login.php?err=err';
            redirect_page_url($url);
        }
        
    }
    else{
        $url =   __WEBROOT__.'/login.php?err=err';
        redirect_page_url($url);
    }
  }else{
      $url =   __WEBROOT__.'/login.php?email=email';
        redirect_page_url($url);
  }
}
else{
    require_once('../includes/top.php');
    $url =   __WEBROOT__.'/login.php';
    redirect_page_url($url);
    
}
?>