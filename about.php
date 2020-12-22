<?php
$page = 'about';
include("./includes/top.php");
$about_us   =   "SELECT * FROM `ti_about_us` WHERE id = 1";
        if($db_handle->numRows($about_us)>0){
            $about_row         =   $db_handle->RunQuery($about_us);
            $seo_title         =   $about_row[0]["seo_title"];
            $seo_keywords      =   $about_row[0]["seo_keywords"];
            $seo_description   =   $about_row[0]["seo_description"];
     }
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("./includes/head-meta.php"); ?>
    <title><?= $seo_title ?></title>
    <meta name="description" content="<?= $seo_description ?>" />
    <meta name="keywords" content="<?= $seo_keywords ?>" />
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
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>About Our Company</h1>
                    <p><?= html_entity_decode($about_row[0]['description']) ?></p>
                </div>
            </div>
        </div>
    </section>
    
    <?php include("./includes/footer.php"); ?>
    </body>
    <?php include("./includes/js-meta.php"); ?>
</html>