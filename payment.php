<?php 
include("./includes/top.php");
$about_row          =   $db_handle->RunQuery("SELECT * FROM `privacy` WHERE id = 1");
    $description        =   $about_row[0]["content"];
    $heading              =   $about_row[0]["heading"];
    $seo_description    =   $about_row[0]["seo_description"];
    $seo_keywords       =   $about_row[0]["seo_keywords"];
    $seo_title          =   $about_row[0]["seo_title"];
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("./includes/head-meta.php"); ?>
    <title><?php echo $seo_title;?></title>
    <meta name="description" content="<?php echo $seo_description;?>" />
    <meta name="keywords" content="<?php echo $seo_keywords;?>" />
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
                        <li><?php echo $heading; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><?php echo $heading; ?></h1>
                    <p><?php echo html_entity_decode($description);?></p>
                </div>
            </div>
        </div>
    </section>
    
    <?php include("./includes/footer.php"); ?>
    </body>
    <?php include("./includes/js-meta.php"); ?>
</html>