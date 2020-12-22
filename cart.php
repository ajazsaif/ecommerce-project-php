<?php
include("./includes/top.php");
if(isset($_POST['chk'])){
  //pre($_POST);
    if($_SESSION['plogin']=='true')
    {
     $_SESSION['tamount'] = $_POST['total_amount'];
     $_SESSION['omethod'] = $_POST['method'];   
     $_SESSION['ship_charge'] = $_POST['ship_charge']; 
     header('Location: checkout.php');
    }
else {
     $_SESSION['tamount'] = $_POST['total_amount'];
     $_SESSION['omethod'] = $_POST['method'];
     $_SESSION['ship_charge'] = $_POST['ship_charge'];
     //$_SESSION['chkoutenc'] = "loggeed";
     header('Location: checkout.php'); 
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
                        <li>Cart Summary</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container" id="main-blocks-cart">
            
        </div>
    </section>
    
    <?php include("./includes/footer.php"); ?>
    </body>
    <?php include("./includes/js-meta.php"); ?>
<script>
       function checkout(){
       document.chkout.submit();
       }
    </script>
    <script>
    function myfunction(ele,sum){
        var value = $(ele).val();
        var price = value.split("@");
        var data_price = parseFloat(price[0]);
        var total_sub  = parseFloat(sum);
        //console.log(total_sub);
         var total = (total_sub+data_price);
         $("#total_div").text(total);
         $("#shipping_price").text(data_price);
         $("#ship_charge").val(data_price);
         $("#total_amount").val(total);
         $("#method").val(price[1]);
    }
</script>
    <script>
    jQuery(document).ready(function($) {
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
            $("#id-cart-value").html(0);
        }else{
            $("#id-cart-value").html(parsedArray.length);
        }

        $.ajax({
            type: "POST",
            url: '<?php echo __WEBROOT__; ?>/ajax/cart_items_list.php',          
            data: {
                myData:localStorage.getItem('__dillionecom')
            },
            cache: false,
            //dataType: "JSON",
            success: function (data) {
                //console.log(data);
                $("#main-blocks-cart").html(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                  //alert('error');
              } 
        });
        
    });
function updateCart(elem,id,pro_name){
  var varientId = $('#varientId'+id).val();
  if(varientId == id)
    {
        alert('varient already added please select other varient');
        return false;
    }
    var parsedArray = JSON.parse(localStorage["__dillionecom"]);
    for (var i=0;i<parsedArray.length;i++){
            if (parsedArray[i].variant == varientId){
                    //parsedArray[i].quantity=cartObject.quantity; 
                    found = false;
                    break;
                  //return false;
            }else{
                found = true;
                //parsedArray[i].variant = varientId;
                if(parsedArray[i].variant == id){
                  parsedArray[i].variant = varientId;
              }
            }  
      }
      //console.log(found);
      if(found == false){
        toastr.error(pro_name+"varient already added in cart",'info',{progressBar:true,timeOut:5000,positionClass:'toast-top-right',showEasing:'swing'});
        return false;
      }
        // for (i=0;i<parsedArray.length;i++){
        //     if(parsedArray[i].variant == id){
        //         parsedArray[i].variant = varientId;
        //     }
        // }
        localStorage["__dillionecom"] = JSON.stringify(parsedArray);
        $.ajax({
            type: "POST",
            url: '<?php echo __WEBROOT__; ?>/ajax/cart_items_list.php',          
            data: {
                myData:localStorage.getItem('__dillionecom')
            },
            cache: false,
            //dataType: "JSON",
            success: function (data) {
                //alert("success");
                $("#main-blocks-cart").html(data);
                toastr.success('varient updated successfully','success',{progressBar:true,timeOut:5000,positionClass:'toast-top-right',showEasing:'swing'});
            },
            error: function(jqXHR, textStatus, errorThrown){
                 // alert('error');
              } 
        });
}

function delFunction(elem,id,pro_name){
var pid=id;
var pname=pro_name;
jQuery(document).ready(function($) {
var parsedArray = JSON.parse(localStorage["__dillionecom"]);
for (i=0;i<parsedArray.length;i++)
if (parsedArray[i].variant == pid) parsedArray.splice(i,1);
        localStorage["__dillionecom"] = JSON.stringify(parsedArray);
if(parsedArray == null){
        $("#id-cart-value").html(0);
}else{
        var cart = parsedArray .length;
        $("#id-cart-value").html(cart);
}
    $.ajax({
            type: "POST",
            url: '<?php echo __WEBROOT__; ?>/ajax/cart_items_list.php',          
            data: {
                myData:localStorage.getItem('__dillionecom')
            },
            cache: false,
            //dataType: "JSON",
            success: function (data) {
                //alert("success");
                $("#main-blocks-cart").html(data);
                toastr.success(pname+" remove from cart.",'success',{progressBar:true,timeOut:5000,positionClass:'toast-top-right',showEasing:'swing'});
            },
            error: function(jqXHR, textStatus, errorThrown){
                  //alert('error');
              } 
        });       
 
});
}
//minus qty
function minusFunction(elem, id, qty) {
        var pid = id;
        var min_qty = parseInt(qty);
        jQuery(document).ready(function ($) {

            var parsedArray = JSON.parse(localStorage["__dillionecom"]);
            for (i = 0; i < parsedArray.length; i++) {
                if (parsedArray[i].variant == pid && parsedArray[i].quantity != min_qty) {
                    parsedArray[i].quantity -= 1;
                }
                if (parsedArray[i].variant == pid && parsedArray[i].quantity == min_qty) {
                    alert('Sorry, the minimum quantity has been reached');
                }
            }
            localStorage["__dillionecom"] = JSON.stringify(parsedArray);



            $.ajax({
                type: "POST",
                url: '<?php echo __WEBROOT__; ?>/ajax/cart_items_list.php',
                data: {
                    myData: localStorage.getItem('__dillionecom')
                },
                cache: false,
                //dataType: "JSON",
                success: function (data) {
                    //alert("success");
                    $("#main-blocks-cart").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('error');
                }
            });

        });
    }
    //increase the quantity
    function plusFunction(elem, id) {
        var pid = id;
        jQuery(document).ready(function ($) {

            var parsedArray = JSON.parse(localStorage["__dillionecom"]);
            for (i = 0; i < parsedArray.length; i++) {
                if (parsedArray[i].variant == pid) {
                    parsedArray[i].quantity += 1;
                }
            }
            localStorage["__dillionecom"] = JSON.stringify(parsedArray);
            $.ajax({
                type: "POST",
                url: '<?php echo __WEBROOT__; ?>/ajax/cart_items_list.php',
                data: {
                    myData: localStorage.getItem('__dillionecom')
                },
                cache: false,
                //dataType: "JSON",
                success: function (data) {
                    //alert("success");
                    $("#main-blocks-cart").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('error');
                }
            });

        });
    }
</script>
</html>