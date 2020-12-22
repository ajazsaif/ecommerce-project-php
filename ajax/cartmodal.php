<?php 
require_once('../includes/top.php');
//get get request and show the products cart modal
if(isset($_GET['product_id']))
{
    $product_id = $db_handle->escapeString($_GET['product_id']);
    //get products details
    $qry = "SELECT 
                products.`heading`, 
                products.`id`, 
                products.image, 
                products.`parent`, 
                category.heading AS cat_name, 
                products.products_tag 
            FROM 
                `products` 
                LEFT JOIN products category ON products.parent = category.id 
            WHERE 
            products.id = {$product_id}";
    $pro_rows = $db_handle->RunQuery($qry);
    if(!empty($pro_rows))
    {
        //get all varient list from the database
        $min_qty = 1;
        $image = $pro_rows[0]['image'];
        $pro_name = $pro_rows[0]['heading'];
        $varinetRows = $db_handle->RunQuery("SELECT id,size,price FROM `ti_attributes` WHERE parent = {$pro_rows[0]['id']}");
        $product_tags = !empty($pro_rows[0]['products_tag']) ? explode(PHP_EOL, $pro_rows[0]['products_tag']) : [];
?>
<div class="row">
    <div class="col-md-6">
        <img src="<?php echo __WEBROOT__; ?>/images/product/<?php echo $pro_rows[0]['image']; ?>" alt="<?php echo $pro_rows[0]['heading']; ?>" title="<?php echo $pro_rows[0]['heading']; ?>" />
    </div>
    <div class="col-md-6">
        <span class="quickname"><?php echo $pro_rows[0]['heading']; ?></span>
        <select name="varient" id="varient">
            <?php 
                if(!empty($varinetRows)):

                    foreach($varinetRows as $varient_val):
            ?>
            <option value="<?php echo $varient_val['id']; ?>"><?php echo $varient_val['size']; ?> ($<?php echo $varient_val['price']; ?>)</option>
        <?php endforeach; endif; ?>
        </select>
        <ul class="quick-info">
            <li><b>Category : </b> <?php echo $pro_rows[0]['cat_name']; ?></li>
            <li><b>Tag : </b><?php echo implode(',', $product_tags); ?></li>
        </ul>
        <?php if(!empty($varinetRows)){ ?>
        <a href="javascript:void(0)" class="theme_button color4" onclick="mylocationStorageDatacart(<?php  echo $product_id; ?>,<?php  echo $min_qty; ?>,'<?php echo $image; ?>','<?php echo $pro_name; ?>','<?php echo __WEBROOT__;?>/cart.php')" >Add To Cart</a>
        <?php } else{ ?>
            <a href="javascript:void(0)" class="theme_button color4" onclick="alert('You can not add this product in cart');" style="text-decoration:none;cursor:not-allowed;">Add To Cart</a>
        <?php } ?>
        <span style="color:red;" id="duplicate_err"></span>
    </div>
</div>
<?php } } ?>