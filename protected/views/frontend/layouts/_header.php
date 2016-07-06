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
    <title><?php echo $this->seo['title'] ;?></title>
    <meta name="keywords" content="<?php echo $this->seo['keywords']; ?>"/>
    <meta name="description" content="<?php echo $this->seo['description']; ?>"/>
</head>
<body>
<div class="wrapper">
    <header>

        <ul class="dropdown-menu" role="menu" aria-labelledby="catalog_link" id="drop_catalog">
            <div class="container no-all">
                <div class="row">
<?php
                    $root = CatalogTree::model()->language($this->getCurrentLanguage()->id)->roots()->active()->find();
                    $category = $root ? $root->children()->active()->findAll() : array();
                    foreach($category as $key => $value)
                    {
                        $children = $value->children()->active()->findAll();

                        echo
                        '<div class="col-xs-3">
                            <h2>
                                <a href="'.$this->createUrl('catalog/tree', array('url' => $value->name)).'">
                                    '.$value->title.'
                                </a>
                                <span></span>
                            </h2>';

                            foreach($children as $k => $v)
                            {
                                echo
                                '<li>
                                    <a href="'.$this->createUrl('catalog/tree', array('url' => $value->name.'/'.$v->name)).'">'.$v->title.'</a>
                                </li>';

                                $sub_children = $v->children()->active()->findAll();

                                if($sub_children)
                                {
                                    echo
                                    '<div class="row">';

                                    foreach($sub_children as $_k => $_v)
                                    {
                                        if($_k == 0 || $_k == 5)
                                        {
                                            echo CHtml::openTag('ul', array('class' => 'col-xs-6'));
                                        }

                                        echo
                                            '<li>
                                                <a href="'.$this->createUrl('catalog/tree', array('url' => $value->name.'/'.$v->name.'/'.$_v->name)).'">' . $_v->title . '</a>
                                            </li>';

                                        if($_k == 4)
                                        {
                                            echo CHtml::closeTag('ul');
                                        }
                                    }

                                    echo
                                    '</div>';
                                }
                            }

                        echo
                        '</div>';
                    }
?>
                </div>
            </div>
        </ul>

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

                <a href = "" id="catalog_link" role="button" data-toggle="dropdown" data-target="#">Каталог</a>

                <div class="top_menu">
                    [[w:MenuWidget|id=1;menu_type=navbar;]]
                </div>

                <div class="search">
<?php
                    $search = Yii::app()->request->getQuery('term');

                    echo CHtml::beginForm(array('/search'), 'get', array('id' => 'form-search'));
                    echo CHtml::textField('term', $search, array('class' => 'hid', 'placeholder' => 'Я ищу...'));
                    echo CHtml::linkButton('Поиск', array('class' => 'search-link'));
                    echo CHtml::endForm();
?>
                </div>

            </div>
        </div>
    </header>
<?php
    $this->renderFile(Yii::getPathOfAlias('application.views.frontend.layouts') . DIRECTORY_SEPARATOR . '_modal.php', array());

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

        $("#catalog_link").on("click", function()
        {
            $(this).toggleClass("open");
            $("#drop_catalog").slideToggle("slow");
        });

        $(".how_to_order").on("click", function()
        {
            $("#how_to_order").modal();
            return false;
        });
    ';

    $cs->registerScript('header_script', $header_script);
