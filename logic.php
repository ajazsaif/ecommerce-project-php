<?php 
//perform check out order logic here
if(!defined('LOGICHEAD')){
    exit('No direct acess allowed');
}
if(isset($_POST['corder'])){

    $user_type = [];
    //fecth userid from database
    $get_uid        =   "SELECT id FROM `users` WHERE email = '".$_SESSION['vemail']."' ";
    $result         =   $db_handle->RunQuery($get_uid);
    $uid            =   $result[0]['id'];
    $bill_ship      =   $db_handle->escapeString(valid_input($_POST['bill_ship']));
   //user billing address action perform here
    $bfname          =   $db_handle->escapeString(valid_input($_POST['bfname']));  //required
    $blname          =   $db_handle->escapeString(valid_input($_POST['blname']));   //required
    $bstaddress      =   $db_handle->escapeString(valid_input($_POST['baddress']));
    $baddress_alt    =   $db_handle->escapeString(valid_input($_POST['baddress_opt']));
    $bcity           =   $db_handle->escapeString(valid_input($_POST['bcity']));
    $bstate          =   $db_handle->escapeString(valid_input($_POST['bstate']));
    $bcountry        =   $db_handle->escapeString(valid_input($_POST['bcountry']));
    $bemail          =   $db_handle->escapeString(valid_input($_POST['bemail'])); //required
    $bpincode        =   $db_handle->escapeString(valid_input($_POST['bzip_code'])); //required
    $bphone          =   $db_handle->escapeString(valid_input($_POST['bphone']));
    $message         =   $db_handle->escapeString(valid_input($_POST['message']));
    
    $sfname          =   $db_handle->escapeString(valid_input($_POST['sfname']));  //required
    $slname          =   $db_handle->escapeString(valid_input($_POST['slname']));
    $semail          =   $db_handle->escapeString(valid_input($_POST['semail']));
    $sphone          =   $db_handle->escapeString(valid_input($_POST['sphone']));
    $sstaddress      =   $db_handle->escapeString(valid_input($_POST['saddress']));
    $saddress_alt    =   $db_handle->escapeString(valid_input($_POST['saddress_opt']));
    $scity           =   $db_handle->escapeString(valid_input($_POST['scity']));
    $sstate          =   $db_handle->escapeString(valid_input($_POST['sstate']));
    $scountry        =   $db_handle->escapeString(valid_input($_POST['scountry']));
    $spincode        =   $db_handle->escapeString(valid_input($_POST['szip_code'])); //required
    $smessage        =   $db_handle->escapeString(valid_input($_POST['smessage'])); //required

    $payment_mode   =   $db_handle->escapeString(valid_input($_POST['payment_mmode']));

    $login_opt      =   $db_handle->escapeString(valid_input($_POST['login-radio']));
    $password       =   $db_handle->escapeString(valid_input($_POST['pws']));

    if(empty($bill_ship)){
     $sfname          =   $bfname;
     $slname          =   $blname;  
     $semail          =   $bemail; 
     $sphone          =   $bphone; 
     $sstaddress      =   $bstaddress;
     $saddress_alt    =   $baddress_alt;
     $scity           =   $bcity;
     $sstate          =   $bstate;
     $scountry        =   $bcountry;
     $spincode        =   $bpincode; //required
     $smessage        =   $smessage; //required
    }
    
    $order_id       =   'ORD-'.substr((microtime() * 1000000).mt_rand(1,1000000),0,8);

    $user_address_billing    =   array(
                                        'fname'=>$bfname,
                                        'lname'=>$blname,
                                        'address'=>$bstaddress,
                                        'address_alt'=>$baddress_alt,
                                        'city'=>$bcity,
                                        'state'=>$bstate,
                                        'country'=>$bcountry,
                                        'zip_code'=>$bpincode,
                                        'phone'=>$bphone,
                                        'email'=>$bemail,
                                        'message'=>$message
                                    );

     $user_address_shipping    =   array(
                                        'fname'=>$sfname,
                                        'lname'=>$slname,
                                        'address'=>$sstaddress,
                                        'address_alt'=>$saddress_alt,
                                        'city'=>$scity,
                                        'state'=>$sstate,
                                        'country'=>$scountry,
                                        'zip_code'=>$spincode,
                                        'phone'=>$sphone,
                                        'email'=>$semail,
                                        'message'=>$smessage
                                    );
    if(!empty($uid)){
      $db_handle->updateQuery('user_address',$user_address_billing,"uid = {$uid} and type='bill'");
      $db_handle->updateQuery('user_address',$user_address_shipping,"uid = {$uid} and type='ship'");
    }
    else{
            if(!empty($password))
            {
                $password      =   secure_password($password);
                $userEmail     =   $bemail;
                $user_type['user_type'] = 'Not Guest';
            }
            else
            {
                $password      =   secure_password('1234');
                $userEmail     =   mt_rand().'@guest.com';
                $user_type['user_type'] = 'Guest';
            }
           $user_id       =   'MU'.mt_rand(10,1000000); 

          $fields         =   array_merge(array('user_id'=>$user_id,'name'=>$bfname,'email'=>$userEmail,'pass'=>$password,'phone'=>$bphone), $user_type);
       $check_email       =   "SELECT * FROM `users` WHERE email = '$bemail'";

    if($db_handle->numRows($check_email) == 0){
       if($db_handle->insertQuery("users",$fields)){
        
        $last_id        =    $db_handle->last_insert_id();
        $uid            =    $last_id;

        $add_type       =    "bill";
        $other_fields   =   array('uid'=>$last_id,'user_id'=>$user_id,'fname'=>$bfname,
                                  'lname'=>$blname,'email'=>$bemail,'phone'=>$bphone,'city'=>$bcity,'state'=>$bstate,'country'=>$bcountry,'zip_code'=>$bpincode,'address'=>$bstaddress,'type'=>$add_type);
        $db_handle->insertQuery("user_address",$other_fields);

        $add_types = "ship";
        $other_fieldss   =   array('uid'=>$last_id,'user_id'=>$user_id,'fname'=>$bfname,
                                  'lname'=>$blname,'email'=>$bemail,'phone'=>$bphone,'city'=>$bcity,'state'=>$bstate,'country'=>$bcountry,'zip_code'=>$bpincode,'address'=>$bstaddress,'type'=>$add_types);
        
        if($db_handle->insertQuery("user_address",$other_fieldss)){
                    $_SESSION["vid"]            =   $last_id;
                    $_SESSION["vemail"]         =   $userEmail;
                    $_SESSION["vname"]          =   $bfname;
                    $_SESSION["vuid"]           =   $user_id;
                    $_SESSION["vrole"]          =   "user";
                    $_SESSION['plogin']         =   'true';
                }
                else{
                    $url =   __WEBROOT__.'/checkout.php?err=errabv';
                    redirect_page_url($url);
                    exit();
                }
                
            }
                else{
                    $url =   __WEBROOT__.'/checkout.php?err=erraka';
                    redirect_page_url($url);
                    exit();
                }
              }else{
                    $url =   __WEBROOT__.'/checkout.php?email=email';
                    redirect_page_url($url);
                    exit();
              }
    }
      
    //get order details data from jason
    $cart_details   =   $_POST['items'];
    $cart_detail_sep=   $_POST['items'];
    $data_cart      = json_decode($cart_details,true);
    $data_cart_sep  = json_decode($cart_detail_sep,true);
    $data_save      =  array();
    //check if not empty user billing address details
    if($cart_details!=null){
    
    //data insert into main table put order summary details
                $data_save['user_id']         = $uid;  
                $data_save['order_id']        = $order_id;  
                $data_save['payment_mode']    = $payment_mode; 
                $data_save['total_amount']    = $_SESSION['tamount'];
                $data_save['ship_method']     = $_SESSION['omethod'];
                $data_save['ship_charge']     = $_SESSION['ship_charge'];

                $k=0;
                    $name_array  = array();
                    foreach($data_cart as $value){
                            $prom_query      =   "select * from `products` where id='".$value['id']."'";
                            if($db_handle->numRows($prom_query)>0){
                                $prom_row    =   $db_handle->RunQuery($prom_query);
                                //get attributes
                                $varient_r = $db_handle->RunQuery("SELECT * FROM `ti_attributes` WHERE id = {$value['variant']}");
                                //$price      =   $varient_r[0]["price"];
                                $name_array[$k]   =  array
                                                      (
                                                        "pro_name"=>$value["pname"].' '.$varient_r[0]['size'],
                                                        "quantity"=>$value["quantity"],
                                                        "price"=>$varient_r[0]["price"],
                                                         "tprice"=>$varient_r[0]["price"]*$value["quantity"]
                                                      );
                            }
                        $k++;
                    }
                    
            //order_mail_send($name_array,$bemail,$bphone,$bfname,$blname,$payment_mode,$bstaddress,$holder_name,$exp_month,$exp_year,$cv_code,$card_number,$card_type,$bcity,$bstate,$bcountry,$bpincode,$_SESSION['tamount'],$_SESSION['omethod'],$message);
                
            if($db_handle->insertQuery('order_details',$data_save)){
            foreach($data_cart_sep as $values){
               $pros_query      =   "select * from `products` where id='".$values['id']."'";
                if($db_handle->numRows($pros_query)>0){
                    $pro_rows   =   $db_handle->RunQuery($pros_query);
                    $varient_r1 = $db_handle->RunQuery("SELECT * FROM `ti_attributes` WHERE id = {$values['variant']}");
                    $prices     =   $varient_r1[0]["price"];
                    $pro_id     =   $pro_rows[0]["id"];
                    $pro_name   =   $values['pname'];
                    $qty        =   $values['quantity'];
                    $total_price=   $qty * $prices;
                    $fields_pro =   array(
                                        'order_id'=>$order_id,
                                        'product_id'=>$pro_id,
                                        'pro_name'=>$pro_name,
                                        'price'=>$prices,
                                        'quantity'=>$qty,
                                        'variant'=>$varient_r1[0]['size'],
                                        'varient_id'=>$varient_r1[0]['id'],
                                        'total_price'=>$total_price
                                    );
                    
                    
                    if($db_handle->insertQuery('order_summary',$fields_pro)){
                        $sucess     =   true;
                        unset($_SESSION['tamount']);
                        unset($_SESSION['omethod']);
                        unset($_SESSION['ship_price']);
                        //unset($_SESSION['coupon_code_id']);
                        //unset($_SESSION['coupon_code_amnt']);
                    }
                    else{
                        $sucess   =   false;
                    }
                } 
            }
        }
        else{
            $sucess   =   false;
        }
    }
}

?>