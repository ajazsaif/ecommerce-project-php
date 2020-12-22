<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/modernizr-2.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/jquery.meanmenu.js"></script>
<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/main.js?v=<?php echo rand(); ?>"></script>
<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/toastr.js"></script>
<?php include("./includes/localstoragescript.php"); ?>
<?php $chat  =  "select * from `chat_code`";
    if($db_handle->numRows($chat)>0){
        $chat_data         =   $db_handle->RunQuery($chat);
        echo htmlspecialchars_decode($chat_data[0]["content"]);
    }
?>
<script>            
    function mylocationStorageDatacart(id,varient,image,name,url){

        var id    = id;
        var pname = name;
        var image = image;
        var variant = varient;
        var quantity = parseInt(1);    
        var cartObject = new Object();
            cartObject.id = id;
            cartObject.variant = variant;
            cartObject.image = image;
            cartObject.pname = pname;
            cartObject.quantity = quantity;

        var retrievedObject = null;
        if (localStorage) {
                retrievedObject = localStorage.getItem('__dillionecom');
        } else {
          alert("Error: This browser is still not supported; Please use google chrome!");
        }
        var parsedArray = null;
        if (retrievedObject){
                parsedArray = JSON.parse(retrievedObject);      
        }
        if(parsedArray == null){
                parsedArray = [];
        }
        var found = false;
        if(parsedArray.length == 0){
                found = true;
        }else{
                for (var i=0;i<parsedArray.length;i++){
                        if (parsedArray[i].id == cartObject.id && parsedArray[i].variant == cartObject.variant){
                                parsedArray[i].quantity=cartObject.quantity; 
                                found = false;
                                break;
                        }else{
                            found = true;
                        }  
                }
                
        }

        if( found == true){
                var cartArrayCount = parsedArray.push(cartObject);
                window.location.replace(url+'/cart.php');
        }else{
            toastr.error(pname+" and selected varient is already added in your cart.",'info',{progressBar:true,timeOut:5000,positionClass:'toast-top-right',showEasing:'swing'});
        }
        $("#id-cart-value").html(cartArrayCount);
        var localData=localStorage.setItem('__dillionecom', JSON.stringify(parsedArray));
                                                
    }
 </script>
 <script>            
    function mylocationStorageWish(id,varient,image,name,url){

            var pid     = id;
            var pname   = name;
            var pimage  = image;
            var urll    = url+'/wishlist.php'  

            var cartObject     = new Object();  
            cartObject.pid     = pid;
            cartObject.varient = varient;
            cartObject.pimage  = pimage;
            cartObject.pname   = pname;
            var retrievedObject = null;
            if (localStorage) {
                    retrievedObject = localStorage.getItem('__dillionecomwish');
            } else {
            alert("Error: This browser is still not supported; Please use google chrome!");
            }
            var parsedArray = null;
            if (retrievedObject){
                    parsedArray = JSON.parse(retrievedObject);      
            }
            if(parsedArray == null){
                    parsedArray = [];
            }
            var found = false;
            if(parsedArray.length == 0){
                    found = true;
            }else{
                for (var i=0;i<parsedArray.length;i++){
                        if (parsedArray[i].pid == cartObject.pid && parsedArray[i].variant == cartObject.variant){ 
                                found = false;
                                break;
                        }else{
                            found = true;
                        }  
                }
                    
            }

            if( found == true){
                    var cartArrayCount = parsedArray.push(cartObject);
                    window.location.replace(urll);
            }if( found == false){
                toastr.error(pname+" is already added in your wishlist",'info',{progressBar:true,timeOut:5000,positionClass:'toast-top-right',showEasing:'swing'});
            }
            
            $("#id-wish-value").html(cartArrayCount);
            var localData=localStorage.setItem('__dillionecomwish', JSON.stringify(parsedArray));                                  
    }
 </script>