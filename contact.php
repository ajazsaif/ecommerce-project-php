<?php
$page = 'Contact';
include("./includes/top.php");
$contactUs = $db_handle->RunQuery("SELECT * FROM `ti_contact_us` WHERE id = 1");
if(isset($_POST['__submit']))
{
    $f_name     = $db_handle->escapeString(valid_input($_POST['f_name']));
    $email      = $db_handle->escapeString(valid_input($_POST['__email']));
    $phone      = $db_handle->escapeString(valid_input($_POST['phone']));
    $country    = $db_handle->escapeString(valid_input($_POST['country']));
    //$city       = $db_handle->escapeString(valid_input($_POST['city']));
    //$state      = $db_handle->escapeString(valid_input($_POST['state']));
    $address    = $db_handle->escapeString(valid_input($_POST['address']));
    $type       = 'Contact Enquiry';
    $msg        = $db_handle->escapeString(valid_input($_POST['message']));
    $full_name  = $f_name;
    if(empty($f_name) || empty($email) || empty($phone)){
        $error_msg_c    =   "Please fill all the fields !";  
      }
      else{
          $fields      =   array(
                                  "name"=>$full_name,
                                  "msg"=>$msg,
                                  "email"=>$email,
                                  "phone"=>$phone,
                                  "country"=>$country,
                                  //"state"=>$state,
                                  //"city"=>$city,
                                  "type"=>$type,
                                  "address"=>$address
                        );
          if($db_handle->insertQuery("enquiry",$fields)){
              $info_c  =   true; 
          }
          else{
              $error_msg_c =  false;
          }
      }
}
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("./includes/head-meta.php"); ?>
    <title>Home</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
</head>
<body>
    <?php include("./includes/header.php"); ?>
    
    <section class="breadcrum">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="<?php echo __WEBROOT__; ?>">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="address-single">
                        <a href="tel:<?= $contactUs[0]['phone'] ?>" class="all-adress-info">
                            <div class="icon">
                                <span><i class="fa fa-user-plus"></i></span>
                            </div>
                            <div class="info">
                                <h3>PHONE</h3>
                                <p><?= $contactUs[0]['phone'] ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="address-single">
                        <a href="tel:<?= $contactUs[0]['phone1'] ?>" class="all-adress-info">
                            <div class="icon">
                                <span><i class="fa fa-user-plus"></i></span>
                            </div>
                            <div class="info">
                                <h3>PHONE</h3>
                                <p><?= $contactUs[0]['phone1'] ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="address-single">
                        <a href="javascript:void(0);" class="all-adress-info">
                            <div class="icon">
                                <span><i class="fa fa-whatsapp"></i></span>
                            </div>
                            <div class="info">
                                <h3>WhatsApp</h3>
                                <p><?= $contactUs[0]['skype'] ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="address-single">
                        <a href="mailto:<?= $contactUs[0]['email'] ?>" class="all-adress-info">
                            <div class="icon">
                                <span><i class="fa fa-user-plus"></i></span>
                            </div>
                            <div class="info">
                                <h3>Email</h3>
                                <p><?= $contactUs[0]['email'] ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="address-single">
                        <a href="mailto:abc@gmail.com" class="all-adress-info">
                            <div class="icon">
                                <span><i class="fa fa-user-plus"></i></span>
                            </div>
                            <div class="info">
                                <h3>Email</h3>
                                <p><?= $contactUs[0]['email_one'] ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="address-single">
                        <div class="all-adress-info">
                            
                            <div class="info">
                                <h3>Address</h3>
                                <p><?= $contactUs[0]['main_office'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 map">
                    <form method="post" class="create-account-form" action="" id="contact_form">
                        <span class="heading-title">Quick Inquire</span>
                        <?php if($info_c === true){ ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong> Thanks for enquiry
                        </div>
                        <?php } ?>
                        <?php if($error_msg_c === false){ ?>
                        <div class="alert alert-warning">
                            <strong>Warning!</strong> Oops something wnt wrong
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input class="form-control" name="f_name" type="text">
                            </div>	
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <input class="form-control" name="l_name" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input class="form-control" type="email" name="__email">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone No.</label>
                                <input class="form-control" type="text" name="phone">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Country</label>
                                <input class="form-control" type="text" name="country">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address</label>
                                <input class="form-control" type="text" name="address">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Message</label>
                                <textarea class="form-control" rows="6" name="message"> </textarea>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <button name="__submit" id="btn-submit" type="submit" class="main-btn">Send Enquire</button>
                            </div>
                        </div>
                    </form>
                    
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22127087.920635235!2d-113.34045052867761!3d36.38207905191365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sin!4v1600778532602!5m2!1sen!2sin" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </section>
    <?php include("./includes/footer.php"); ?>
    </body>
    <?php include("./includes/js-meta.php"); ?>
    <script src="<?= __WEBROOT__.'/js/jquery.validate.js'?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        var addCategoryForm = $("#contact_form");
        var validator = addCategoryForm.validate({
            errorClass:'errForm',
            rules:{
                f_name:{ required : true },
                __email : { required : true,email:true},
                phone : { required : true},
                l_name : { required : true},
                message:{required: true},
                country:{required: true},
                address:{required: true},
            },
            messages:{
                f_name :{ required : "First Name is required" },        
                __email : { required : "Email is required"},
                phone : { required : "Phone no is required"},
                l_name : { required : "Last name is required"},
                message : { required : "Message is required"},
                country : { required : "Country is required"},
                address : { required : "Address is required"},
            },
            submitHandler:function(form){
                $('#btn-submit').prop('disabled', 'disabled');
                $('#btn-submit').val('Waiting....');
                // //$('#loader').css("display","flex");
                form.submit();
            }
        });
        //load state
    });
    </script>
</html>