<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php
    $cs = Yii::app()->getClientScript();

    $css_path = Yii::getPathOfAlias('webroot.css');
    $js_path = Yii::getPathOfAlias('webroot.js');

    $cs->registerCoreScript('jquery', CClientScript::POS_END);

    $cs->registerPackage('bootstrap');
    $cs->registerPackage('slider-slick');

    $cs->registerCssFile(
        Yii::app()->assetManager->publish($css_path . '/common.css')
    );
?>
    <title><?php echo $this->seo['title']; ?></title>
    <meta name="keywords" content="<?php echo $this->seo['keywords']; ?>"/>
    <meta name="description" content="<?php echo $this->seo['description']; ?>"/>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-xs-2 logo no-all">
                    <a href = "/">
                        <h1>МОТОВЕЛО</h1>
                    </a>
                </div>
                <div class="col-xs-3 phone">
                    <?php echo '<h2>'.$this->phones[0]->number.'</h2>' ;?>
                </div>
                <a href = "" id="catalog_link">Каталог</a>
                <div class="top_menu">
                    [[w:MenuWidget|id=1;menu_type=navbar;]]
                </div>
                <div class="search">
<?php
                    echo CHtml::beginForm(array('/search'), 'get', array('id' => 'form-search'));
                    echo CHtml::textField('search', '', array('class' => 'hid', 'placeholder' => 'Я ищу...'));
                    echo CHtml::linkButton('Поиск', array('class' => 'search-link'));
                    echo CHtml::endForm();
?>
                </div>

            </div>
        </div>
    </header>
<?php
    $cs = Yii::app()->getClientScript();

    $header_script =
        'jQuery(".top_menu ul.nav li.dropdown").hover(function()
        {
            $(this).addClass("open");
            jQuery(this).find(".dropdown-menu").stop(true, true).delay(200).fadeIn();
        }, function()
        {
            $(this).removeClass("open");
            jQuery(this).find(".dropdown-menu").stop(true, true).delay(200).fadeOut();
        });

        $("#form-search").mouseover(function()
        {
            $(this).find(".hid").css({"width": "445px", "left": "-330px"});
        })
        .mouseout(function()
        {
            $(this).find(".hid").css({"width": "115px", "left": "0px"});
        });
    ';

    $cs->registerScript('header_script', $header_script);
