<?php 
require_once('../includes/top.php');
//login action perform here
if(isset($_POST['login_check'])){
   $email           =   $db_handle->escapeString(valid_input($_POST['log_email'])); 
   $password        =   $db_handle->escapeString(valid_input($_POST['log_pass'])); 
    //echeck if email is empty
    if(empty($email)){
        $err_msg    = base64_encode('err');
        $url_path   = __WEBROOT__.'/login.php?resperr=err'.$err_msg;
        redirect_page_url($url_path);
    }
    elseif(empty($password)){
        $err_msg    = base64_encode('errp');
        $url_path   = __WEBROOT__.'/login.php?resperr=errp'.$err_msg;
        redirect_page_url($url_path);
    }
    elseif(validate_email($email) == 'error'){
        $err_msg    = base64_encode('errm'); 
        $url_path   = __WEBROOT__.'/login.php?resperr='.$err_msg;
        redirect_page_url($url_path);
    }
    else{
        $secure_password =  secure_password($password);
        $check_login     =   "SELECT id,email,pass,user_id,role,name FROM `users` WHERE email = '$email' AND pass = '$secure_password' AND status = 'p'";
        //check if user exists in already database
        if($db_handle->numRows($check_login) == 1){
            $Row        =   $db_handle->RunQuery($check_login);
            $db_handle->Close();
            unset($db_handle);
            $db_id   =   $Row[0]['id'];
            $db_email   =   $Row[0]['email'];
            $db_pass    =   $Row[0]['pass'];
            $db_role    =   $Row[0]['role'];
            $db_name    =   $Row[0]['name'];
            $db_userid  =   $Row[0]['user_id'];
            if(($db_email == $email)&&($db_pass == $db_pass)&&($db_role == 'user')){
                $_SESSION["vid"]            =   $db_id;
                $_SESSION["vemail"]         =   $email;
                $_SESSION["vname"]          =   $db_name;
                $_SESSION["vuid"]           =   $db_userid;
                $_SESSION["vrole"]          =   $db_role;
                $_SESSION['plogin']         =   'true';
                //session_regenerate_id();
                if(isset($_SESSION['chkoutenc']) && $_SESSION['chkoutenc'] == 'loggeed'){
                    $url_path               = __WEBROOT__.'/checkout.php';
                    if(!empty($_POST["remember"])) {
                        setcookie ("username",$_POST["log_email"],time()+ (10 * 365 * 24 * 60 * 60),'/');
                        setcookie ("password",$_POST["log_pass"],time()+ (10 * 365 * 24 * 60 * 60),'/');
                    } else {
                        setcookie("username","");
                        setcookie("password","");
                    }

                    redirect_page_url($url_path);
                }
                else{
                    $url_path               = __WEBROOT__.'/useradmin/index.php';
                    if(!empty($_POST["remember"])) {
                        setcookie ("username",$_POST["log_email"],time()+ (10 * 365 * 24 * 60 * 60),'/');
                        setcookie ("password",$_POST["log_pass"],time()+ (10 * 365 * 24 * 60 * 60),'/');
                        //echo $_COOKIE["username"]; die();
                    } else {
                        setcookie("username","");
                        setcookie("password","");
                    }

                    redirect_page_url($url_path);
                }
            }
            else{
                $err_msg     = base64_encode('errplog');   
                 $url_path   = __WEBROOT__.'/login.php?resperr='.$err_msg;
                redirect_page_url($url_path);
                
            }
        }
        else{
                $err_msg     = base64_encode('errplog');   
                 $url_path   = __WEBROOT__.'/login.php?resperr='.$err_msg;
                 redirect_page_url($url_path);
            //echo 'c';
            }
        
    }
}

?>