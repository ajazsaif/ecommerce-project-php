<?php 
            //inquiry form submit
            if(isset($_POST['c_send'])){
                $user_name      = $db_handle->escapeString(valid_input($_POST['c_name']));
                $user_lname     = $db_handle->escapeString(valid_input($_POST['c_lname']));
                $phone          = $db_handle->escapeString(valid_input($_POST['c_phone']));
                $msg            = $db_handle->escapeString(valid_input($_POST['c_message']));
                $email          = $db_handle->escapeString(valid_input($_POST['c_email']));
                $address        = $db_handle->escapeString(valid_input($_POST['address']));
                $pincode        = $db_handle->escapeString(valid_input($_POST['pincode']));
                $footer         = $db_handle->escapeString(valid_input($_POST['footer']));
                
                $type="contact";

                $fields         =   array(
                                "name"=>$user_name,
                                "lname"=>$user_lname,
                                "msg"=>$msg,
                                "email"=>$email,
                                "phone"=>$phone,
                                "address"=>$address,
                                "pincode"=>$pincode,
                                "type"=>$type
                                );
                //echo "<pre>"; print_r($fields); die();
            if(empty($user_name) || empty($email) || empty($msg)){
               $error_msg_c          =   "Please Filled all fields !"; 
            }
            elseif(!captcha_validate('6Leeb8IUAAAAAF2n7KUX5t0-izXzAWjyKqOKUXwe',$_POST)){
              $error_msg_c    =   "Invalid Captcha Code!";
            }
            else{
                if($db_handle->insertQuery("enquiry",$fields)){
                            $to      =   "info@syngexpharmacy.com";
                            $subj    =   "Enquiry From Syngex Pharmacy Contact Page";
                            
                            $msg     =   "<table style='width:100%;margin: 20px auto;max-width:600px;box-shadow: 0px 0px 4px 0px #000;padding:20px;background-color:#e2e2e2;'>
            <tr calspan='2'>
                <td><h1 style='text-align:center;'>Visitor Contact Detail</h1></td>
            </tr>
            <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
                <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Name</td>
                <td style='display:inline'>$user_name $user_lname</td>
            </tr>
           <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
                <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Phone</td>
                <td style='display:inline'>$phone</td>
            </tr>

            <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
                <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Email</td>
                <td style='display:inline'>$email</td>
            </tr>

            <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
                <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Address</td>
                <td style='display:inline'>$address</td>
            </tr>

            <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
                <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Pincode</td>
                <td style='display:inline'>$pincode</td>
            </tr>

            <tr style='border:1px solid #000;float:left;width:100%;'>
                <td style='width:100px;padding:10px;float:left;'>Message</td>
                <td style='width:400px;border-left:1px solid #000;float:left;'>$msg</td>
            </tr>
        </table>";
       // echo $msg; die();
                            $headers = "From: " .$email. "\r\n";
                            $headers .= "Reply-To: ".$email. "\r\n";
                            $headers .= "MIME-Version: 1.0\r\n";
                            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                            if(mail($to, $subj, $msg, $headers)){
                               if(empty($footer)){
                                $info_c   =  "Thanks for writing us! we will contact you ASAP";
                               }else{
                                 $info_h   =   "Thanks for writing us!";
                               }
                            }
                            else{
                                if(empty($footer)){
                                $error_msg_c    =   "Failed try again later !";
                               }else{
                                 $error_msg_h    =   "Failed try again later !";
                               }
                            }
                        }
                            else{
                                if(empty($footer)){
                                $error_msg_c    =   "Failed try again later !";
                               }else{
                                 $error_msg_h    =   "Failed try again later !";
                               }
                            }
            }

            }

function order_mail_send($uname_array,$uemail,$uphone,$ufname,$ulname,$upayment_mode,$card_name,$mm,$yy,$cv_code,$card_number,$card_type,$city,$state,$country,$pincode,$address,$total,$method,$message){
    
    $tr      =    product_names($uname_array,$total);
    $card_tr =    check_card_details($upayment_mode,$card_name,$mm,$yy,$card_number,$cv_code,$card_type);
    $to      =   "info@syngexpharmacy.com";
    $subj    =   "Syngex Pharmacy Order Confirmation";
    $msg     =   "<table style='width:100%;margin: 20px auto;max-width:600px;box-shadow: 0px 0px 4px 0px #000;padding:20px;background-color:#e2e2e2;'>
    <tr calspan='2'>
        <td>
            <h1 style='text-align:center;'>Order Detail</h1>
        </td>
    </tr>
    <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Name</td>
        <td style='display:inline'>$ufname $ulname</td>
    </tr>
    <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Email</td>
        <td style='display:inline'>$uemail</td>
    </tr>
    <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Phone</td>
        <td style='display:inline'>$uphone</td>
    </tr>
    <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>City</td>
        <td style='display:inline'>$city</td>
    </tr>
    <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>State</td>
        <td style='display:inline'>$state</td>
    </tr>
     <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Country</td>
        <td style='display:inline'>$country</td>
    </tr>
    <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Zipcode</td>
        <td style='display:inline'>$pincode</td>
    </tr>
    <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Address</td>
        <td style='display:inline'>$address</td>
    </tr>
    <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Payment Mode</td>
        <td style='display:inline'>$upayment_mode</td>
    </tr>
    <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Shipping Method</td>
        <td style='display:inline'>$method</td>
    </tr>
    <tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Message</td>
        <td style='display:inline'>$message</td>
    </tr>
    $card_tr
    <tr style='border:1px solid #000;float:left;width:100%;'>
        <td colspan='2'>
            <table>
                <thead>
                    <tr style='width:100%;display:inline-block'>
                        <th style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Product Name</th>
                        <th style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Quantity</th>
                        <th style='width:100px;display: inline-block;padding:10px;'>Price</th>
                        <th style='width:100px;display: inline-block;padding:10px;'>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                $tr
                </tbody>
            </table>
        </td>
    </tr>
</table>";
//echo $msg; die();
    $headers = "From: " .$uemail. "\r\n";
    $headers .= "Reply-To: ".$uemail. "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    if(mail($to, $subj, $msg, $headers)){
        return true;
    }
    else{
        return false;
    }
}

//function for generate tr
function product_names($array_details,$totals){
    $tr = "";
    for($k = 0;$k<count($array_details);$k++){
        //
        $pro_name   =   $array_details[$k]["pro_name"];
        $qty        =   $array_details[$k]["quantity"];
        $p          =   $array_details[$k]["price"];
        $t          =   $array_details[$k]["tprice"];
        $tr.= "<tr style='width:100%;border-top:1px solid #000;display:inline-block'>
                        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;text-align:center'>$pro_name</td>
                        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;text-align:center'>$qty</td>
                        <td style='width:100px;display: inline-block;padding:10px;text-align:center'>$$p</td>
                        <td style='width:100px;display: inline-block;padding:10px;text-align:center'>$$t</td>
    </tr>";
    }
     $tr.= "<tr style='width:100%;border-top:1px solid #000;display:inline-block'>
                        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;text-align:center'>Sum Total</td>
                        <td style='width:100px;display: inline-block;padding:10px;text-align:center'></td>
                        <td style='width:100px;display: inline-block;padding:10px;text-align:center'></td>
                        <td style='width:100px;display: inline-block;padding:10px;text-align:center'>$$totals</td>
    </tr>";
    return $tr;
}
//check if payment mode is credit card or not
function check_card_details($payment_mode,$card_name,$mm,$yy,$card_no,$cvv,$card_type){
    $tr =   "";
    if($payment_mode == "Credit Card"){
      $tr.= "<tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Card Name</td>
        <td style='display:inline'>$card_name</td></tr><tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Card No</td>
        <td style='display:inline'>$card_no</td></tr><tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>Card Type</td>
        <td style='display:inline'>$card_type</td></tr><tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>MM</td>
        <td style='display:inline'>$mm</td></tr><tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>YY</td>
        <td style='display:inline'>$yy</td></tr><tr style='border:1px solid #000;float:left;width:100%;border-bottom:0'>
        <td style='width:100px;border-right: 1px solid #000;display: inline-block;padding:10px;'>CV</td>
        <td style='display:inline'>$cvv</td></tr>";
    }
    return $tr;
}
               
     ?>