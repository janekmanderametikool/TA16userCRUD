<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 10.05.2016
 * Time: 9:04
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>User CRUD</title>

    <!-- Bootstrap -->
    <link href="<?php echo TEMPLATE_URL_CSS; ?>bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL_PLUGINS; ?>sweetalert-master/dist/sweetalert.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL_CSS; ?>font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background: url('<?php echo TEMPLATE_URL ?>/images/bg3.jpg')">
<div style="position: absolute; top: 20px; right: 20px">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo t('head_translation_dropdown'); ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item change_language" href="#" data-language="en"><?php echo t('head_dropdown_english'); ?></a>
            <a class="dropdown-item change_language" href="#" data-language="et"><?php echo t('head_dropdown_estonia'); ?></a>
        </div>
    </div>
</div>