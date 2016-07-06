<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <?php
    $cs = Yii::app()->getClientScript();
    $css_path=Yii::getPathOfAlias('webroot.css');

    $cs->registerCoreScript('jquery', CClientScript::POS_END);

    $cs->registerPackage('bootstrap');

    $cs->registerCssFile(
        Yii::app()->assetManager->publish($css_path.'/style.css')
    );

    ?>
    <title><?php echo $this->seo['title']; ?></title>
    <meta name="keywords" content="<?php echo $this->seo['keywords']; ?>" />
    <meta name="description" content="<?php echo $this->seo['description']; ?>" />
</head>
<body>
<div class="wrapper user_login">

    <?php

    $this->renderFile(Yii::getPathOfAlias('application.views').'/_all_alerts.php',array());

    ?>
    <div class="container">

        <div class="col-xs-2"></div>

        <div class="col-xs-8" style="margin-top: 15px;">
            <?php
            echo $content;
            ?>
        </div>

        <div class="col-xs-2"></div>
    </div>

</div>
<footer>
</footer>
</body>
</html>
