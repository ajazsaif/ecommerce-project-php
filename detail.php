<?php
include("./includes/top.php");
if(isset($_GET['ref'])){
    $ref=$_REQUEST['ref'];
    $escape_token=$db_handle->escapeString($ref);
    $cat_query =   "select * from `products` where slug='".$escape_token."' AND parent !=0";
       if($db_handle->numRows($cat_query)>0){
           $cat_row            =   $db_handle->RunQuery($cat_query);
           $parent             =   $cat_row[0]["parent"];
           $ids                =   $cat_row[0]["id"];
           $price              =   $cat_row[0]["price"];
           $rating             =   $cat_row[0]["rating"];
           $min_qty            =   $cat_row[0]["min_qty"];
           $image              =   $cat_row[0]["image"];
           $heading            =   $cat_row[0]["heading"];
           $descriptionh       =   $cat_row[0]["description"];
           $img_alt            =   $cat_row[0]["img_alt"];
           $img_title          =   $cat_row[0]["img_title"];
           $seo_title          =   $cat_row[0]["seo_title"];
           $seo_description    =   $cat_row[0]["seo_description"];
           $seo_keywords       =   $cat_row[0]["seo_keywords"];   
           $additional_info    =   $cat_row[0]["additional_info"];
           $varientRws = $db_handle->RunQuery("SELECT MIN(price) AS min_price, MAX(price) AS max_price FROM `ti_attributes` WHERE parent = {$cat_row[0]['id']} ORDER BY id ASC");
           $varinetRows = $db_handle->RunQuery("SELECT id,size,price FROM `ti_attributes` WHERE parent = {$cat_row[0]['id']}");
       } 
   
       $products_query  =   "select * from `products` where id='".$parent."' and status='p'";
       if($db_handle->numRows($products_query)>0){
           $product     =   $db_handle->RunQuery($products_query);
           $cat_name    =   $product[0]["heading"];
           $cat_id      =   $product[0]["id"]; 
           $cat_slug    =   $product[0]["slug"]; 
       }
                                
   }
    //getting review query
    $rating_query = "SELECT * FROM `ti_pro_review` WHERE status = 1";
    $ratingRows = $db_handle->RunQuery($rating_query);
    if(isset($_POST['__name'])){
        $user_name      = $db_handle->escapeString(valid_input($_POST['__name']));
        $rating         = 5;
        $msg            = $db_handle->escapeString(valid_input($_POST['message']));
        $email          = $db_handle->escapeString(valid_input($_POST['__email']));
        $product_id     = $db_handle->escapeString(valid_input($_POST['product_id']));
        //$title          = $db_handle->escapeString(valid_input($_POST['phone']));
        //$return_url     = $db_handle->escapeString(valid_input($_POST['return_url']));
        //pre($_POST);
        $fields         =   array(
                        "name"=>$user_name,
                        //"phone"=>$title,
                        "message"=>$msg,
                        "email"=>$email,
                        "rating"=>$rating,
                        "product_id"=>$product_id
                        );
        if($db_handle->insertQuery("ti_pro_review",$fields))
        {
            $_SESSION['sucs_msg'] = 'Thanks for posting Your Reviews';
        }
        else{
            $_SESSION['sucs_ermsg'] = 'Failed try again later !';
        }
    }                   
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("./includes/head-meta.php"); ?>
    <title><?php echo $seo_title;?></title>
    <meta name="description" content="<?php echo $seo_description;?>" />
    <meta name="keywords" content="<?php echo $seo_keywords;?>" />
    <style type="text/css">.error{color: red;}</style>
</head>
<body>
    <?php include("./includes/header.php"); ?>
    
    <section class="breadcrum">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="<?php echo __WEBROOT__; ?>">Home</a></li>
                        <li><a href="<?php echo __WEBROOT__; ?>category/<?php echo $cat_slug;?>">
                            <?php echo $cat_name;?></a>
                        </li>
                        <li><?php echo $heading;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section class="product-simple-area">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-product-image">  
                                <img src="<?php echo __WEBROOT__; ?>/images/product/<?php echo $image;?>" alt="" title="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-product-info">
                                <h1 class="product_title"><?php echo $heading;?></h1>
                                <div class="price-box"><span class="new-price">$<?php echo $varientRws[0]['min_price'];?> - $<?php echo $varientRws[0]['max_price'];?></span></div>
                                <div class="stock-status"><label>Availability</label>: <strong>In stock</strong></div>
                                <div class="stock-status">
                                    <label><b>Select Verient</b></label>
                                    <select class="form-control" name="varient" id="varient-detail" onchange="get_varient(this.value);">
                                        <?php 
                                                if(!empty($varinetRows)):

                                                    foreach($varinetRows as $varient_val):
                                            ?>
                                            <option value="<?php echo $varient_val['id']; ?>"><?php echo $varient_val['size']; ?> ($<?php echo $varient_val['price']; ?>)</option>
                                            <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div class="stock-status"><label>Price</label>: <strong id="price_show">$<?php echo $varinetRows[0]['price']; ?></strong></div>
                                <div class="quantity" style="width:100%;">
                                    <label>Quantity</label><br/>
                                    <input type="number" value="1" min="1" name="quantity" id="quantity" />
                                </div>
                                <?php if(!empty($varinetRows)): ?>
                                <a class="main-btn" href="javascript:void(0);" onclick="addToCart(<?= $ids ?>,'<?= $image ?>','<?= $heading ?>','<?=  __WEBROOT__ ?>/cart.php')" title="Shopping Cart"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                <?php else: ?>
                                    <a class="main-btn" href="javascript:void(0);" onclick="alert('You can not add this product in cart');" title="Shopping Cart"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                    <?php endif; ?>
                                <?php if(!empty($varinetRows)): ?>
                                <a class="main-btn" href="javascript:void(0);" onclick="addToCart(<?= $ids ?>,'<?= $image ?>','<?= $heading ?>','<?=  __WEBROOT__ ?>/cart.php')" title="Add to Compare"><i class="fa fa-heart"></i> Wishlist</a>
                                <?php else: ?>
                                    <a class="main-btn" href="javascript:void(0);" onclick="alert('You can not add this product in wish list');" title="Add to Compare"><i class="fa fa-heart"></i> Wishlist</a>
                                    <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(isset($_SESSION['sucs_msg'])){ ?>
                        <span style="background: #008000;padding:6px;color:white;"><?php echo $_SESSION['sucs_msg']; unset($_SESSION['sucs_msg']); ?></span>
                        <?php } ?>
                        <?php 
                            if(isset($_SESSION['sucs_ermsg'])){
                        ?>
                        <span style="background:#f00;padding:6px;color:white;"><?php echo $_SESSION['sucs_ermsg']; unset($_SESSION['sucs_ermsg']); ?></span>
                        <?php } ?>
                        <div class="product-tab-area">
                            <div class="product-tabs">
                                <div>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab-desc" aria-controls="tab-desc" role="tab" data-toggle="tab">Description</a></li>
                                        <li role="presentation"><a href="#page-comments" aria-controls="page-comments" role="tab" data-toggle="tab">Reviews (<?= count($ratingRows) ?>)</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="tab-desc">
                                            <div class="product-tab-desc">
                                                <p><?= html_entity_decode($descriptionh) ?></p>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="page-comments">
                                            <div class="product-tab-desc">
                                                <div class="product-page-comments">
                                                    <h2><?= count($ratingRows) ?> review for Integer consequat ante lectus</h2>
                                                    <ul>
                                        <?php 
                                            if($ratingRows):
                                                foreach($ratingRows as $ratinItem):
                                        ?>
                                                        <li>
                                                            <div class="product-comments">
                                                                <div class="product-comments-content">
                                                                    <p><strong><?= $ratinItem['name'] ?></strong> - <span><?= date('d/m/Y', strtotime($ratinItem['create_date']))?></span></p>
                                                                    <div class="desc">
                                                                         <?php echo html_entity_decode($ratinItem['message']); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; endif; ?>
                                                </ul>
                                                    <div class="review-form-wrapper">
                                                        <h3>Add a review</h3>
                                                        <form action="" id="products_review" method="post">
                                                            <input type="hidden" name="product_id" value="<?= $ids ?>">
                                                            <input type="text" placeholder="your name" name="__name" />
                                                            <input type="email" name="__email" placeholder="your email"/>
                                                            <textarea id="product-message" rows="4" placeholder="Your Comment" name="message"></textarea>
                                                            <input type="submit" value="submit" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>						
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="row mt40">
                        <div class="col-md-12">
                            <h2 class="heading">Related Products</h2>
                            <div class="RelatedProduct owl-carousel">
                                <?php 
                            $relatedPro = $db_handle->RunQuery("SELECT  id,slug,heading,image FROM `products` WHERE parent != 0 AND id != {$ids} AND status = 'p' ORDER BY id DESC ");
                            if($relatedPro):
                                foreach($relatedPro as $proItem):

                                    $varientRws = $db_handle->RunQuery("SELECT MIN(price) AS min_price, MAX(price) AS max_price FROM `ti_attributes` WHERE parent = {$proItem['id']} ORDER BY id ASC");
                                    //get first varient
                        ?>
                                <div class="popular-left">
                                    <a href="<?php echo __WEBROOT__; ?>/products/<?= $proItem['slug'] ?>"><img src="<?php echo __WEBROOT__; ?>/images/product/<?= $proItem['image'] ?>" alt="" /></a>
                                    <div class="pro-action">
                                        <!-- <ul>
                                            <li><a href="javascript:void(0);" title="Shopping Cart"><i class="fa fa-cart-plus"></i></a></li>
                                            <li><a href="javascript:void(0);" title="Add to Wishlist"><i class="fa fa-heart"></i></a></li>
                                        </ul> -->
                                    </div>
                                    <div class="content">
                                        <div class="product-titel">
                                            <a href="<?php echo __WEBROOT__; ?>/products/<?= $proItem['slug'] ?>"><?= $proItem['heading'] ?></a>
                                        </div>
                                        <div class="product-price">
                                            <span>$<?php echo $varientRws[0]['min_price']; ?> - $<?php echo $varientRws[0]['max_price']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 single-view">
                    <div class="category">
                        <h4>MORE CATEGORY</h4>
                        <div class="category-list">
                            <ul>
                    <?php 
                        $catsQry = $db_handle->RunQuery("SELECT  id,slug,heading FROM `products` WHERE parent = 0 AND id != {$parent} AND status = 'p' LIMIT 0, 10");
                        if($catsQry):
                            foreach($catsQry as $catItem):
                                //get total products
                        $totalPro = $db_handle->numRows("SELECT COUNT(id) FROM `products` WHERE parent = {$catItem['id']} AND status = 'p'");
                    ?>
                            <li><a href="<?php echo __WEBROOT__; ?>/category/<?= $catItem['slug'] ?>"><i class="fa fa-angle-double-right"></i><?= $catItem['slug'] ?> <span>(<?= $totalPro ?>)</span></a></li>
                            <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                    
                    <aside class="widget top-product-widget mt40">
                        <h3 class="sidebar-title">Recent</h3>
							<ul>
                        <?php 
                            $recentPro = $db_handle->RunQuery("SELECT  id,slug,heading,image FROM `products` WHERE parent != 0 AND id != {$ids} AND status = 'p' ORDER BY RAND() ");
                            if($recentPro):
                                foreach($recentPro as $proItem1):

                                    $varientRws1 = $db_handle->RunQuery("SELECT MIN(price) AS min_price, MAX(price) AS max_price FROM `ti_attributes` WHERE parent = {$proItem1['id']} ORDER BY id ASC");
                                    //get first varient
                        ?>
								<li>
									<div class="single-product">
										<div class="product-img">
											<a href="<?php echo __WEBROOT__; ?>/products/<?= $proItem1['slug'] ?>">
												<img src="<?php echo __WEBROOT__; ?>/images/product/<?= $proItem1['image'] ?>" alt="">
											</a>						
										</div>
										<div class="productsngl-content">
											<div class="pro-info">
												<h2 class="product-name"><a href="<?php echo __WEBROOT__; ?>/products/<?= $proItem1['slug'] ?>"><?= $proItem1['slug'] ?></a></h2>
												<div class="price-box">
													<span class="new-price">$<?php echo $varientRws1[0]['min_price']; ?> - $<?php echo $varientRws1[0]['max_price']; ?></span>
												</div>								
											</div>									
										</div>
									</div>
								</li>
                                <?php endforeach; endif; ?>
							</ul>
						</aside>
                </div>
            </div>
        </div>
    </section>
    
    <?php include("./includes/footer.php"); ?>
    </body>
    <?php include("./includes/js-meta.php"); ?>
    <script type="text/javascript">
    function get_varient(varient_id){
        $.ajax({
            url: "<?php echo __WEBROOT__; ?>/ajax/varient.php?id="+varient_id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $('#price_show').html("$"+res.price);
            }
        });
   }
</script>
<script type="text/javascript">
function addToCart(id,image,name,url){

var id    = id;
var pname = name;
var image = image;
var variant = $('#varient-detail').val();
var quantity = parseInt($('#quantity').val());    
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
        window.location.replace(url);
}else{
    toastr.error(pname+" and selected varient is already added in your cart.",'info',{progressBar:true,timeOut:5000,positionClass:'toast-top-right',showEasing:'swing'});
}
$("#id-cart-value").html(cartArrayCount);
var localData=localStorage.setItem('__dillionecom', JSON.stringify(parsedArray));
                                        
}
</script>
<script type="text/javascript">
function addToWish(id,image,name,url){

var pid     = id;
var pname   = name;
var pimage  = image;
var urll    = url+'/wishlist.php'  

var cartObject     = new Object();  
cartObject.pid     = pid;
cartObject.varient = $('#varient-detail').val();
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
<script type="text/javascript" src="<?php echo __WEBROOT__; ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
        var addCategoryForm = $("#products_review");
        var validator = addCategoryForm.validate({
            ignore: [],
            rules:{
                __name:{ required : true },
                __email:{ required : true },
                message:{required: true}
                //phone:{required: true},
            },
            messages:{
                __name :{ required : "First Name is required" },
                __email : { required : "Email is required"},
                message : { required : "Message is required"}
                //phone : { required : "PHone is required"},
            },
            submitHandler:function(form){
                //$('#button-review').prop('disabled', 'disabled');
                //$('#button-review').text('Waiting....');
                //$('#loader').css("display","flex");
                form.submit();
            }
        });
        //load state
    });
    </script>
</html>