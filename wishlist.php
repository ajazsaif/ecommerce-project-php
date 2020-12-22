<?php 
$page = 'Cat';
include("./includes/top.php");
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
                        <li>Wish List</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Wish List</h1>
                    
                    <div class="table-responsive" id="main-blocks-wish">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include("./includes/footer.php"); ?>
    </body>
    <?php include("./includes/js-meta.php"); ?>
    <script>
    jQuery(document).ready(function($) {
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
            $("#id-wish-value").html(0);
        }else{
            $("#id-wish-value").html(parsedArray.length);
        }

        $.ajax({
            type: "POST",
            url: '<?php echo __WEBROOT__; ?>/ajax/wish_list.php',          
            data: {
                myData:localStorage.getItem('__dillionecomwish')
            },
            cache: false,
            //dataType: "JSON",
            success: function (data) {
                //console.log(data);
                $("#main-blocks-wish").html(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                  //alert('error');
              } 
        });
        
    });
</script>
<script>
function WishdelFunction(elem,id,varient,pro_name){
var pid=varient;
var pname=pro_name;
jQuery(document).ready(function($) {
var parsedArray = JSON.parse(localStorage["__dillionecomwish"]);
for (i=0;i<parsedArray.length;i++)
if (parsedArray[i].varient == pid) parsedArray.splice(i,1);
        localStorage["__dillionecomwish"] = JSON.stringify(parsedArray);
if(parsedArray == null){
        $("#id-wish-value").html(0);
}else{
        var cart = parsedArray .length;
        $("#id-wish-value").html(cart);
}

    
    $.ajax({
            type: "POST",
            url: '<?php echo __WEBROOT__; ?>/ajax/wish_list.php',          
            data: {
                myData:localStorage.getItem('__dillionecomwish')
            },
            cache: false,
            //dataType: "JSON",
            success: function (data) {
                //alert("success");
                $("#main-blocks-wish").html(data);
                toastr.info(pname+" remove from wishlist.",'info',{progressBar:true,timeOut:5000,positionClass:'toast-top-right',showEasing:'swing'});
            },
            error: function(jqXHR, textStatus, errorThrown){
                  //alert('error');
              } 
        });     
 
});
}

function wishToCartAdd(elem,id,varientId,name,image,url){
        var id    = id;
        var pname = name;
        var image = image;
        var variant = varientId;
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
                var parsedArraywish = JSON.parse(localStorage["__dillionecomwish"]);
            for (i=0;i<parsedArraywish.length;i++)
            if (parsedArraywish[i].varient == varientId) parsedArraywish.splice(i,1);
                localStorage["__dillionecomwish"] = JSON.stringify(parsedArraywish);
                //window.location.replace(url);
                window.location.href='cart.php';
        }else{
            toastr.error(pname+" is already added in your cart.",'info',{progressBar:true,timeOut:5000,positionClass:'toast-top-right',showEasing:'swing'});
        }
        $("#id-cart-value").html(cartArrayCount);
        var localData=localStorage.setItem('__dillionecom', JSON.stringify(parsedArray));
}
 </script>
</html>