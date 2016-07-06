<div class="home-page">
    <div class="container no-all">
<?php
        $this->widget('BsNavs',
            array(
                'id' => 'index_tabs',
                'items' => array(
                    array(
                        'label' => 'Популярные товары',
                        'active' => true,
                        'content' => '[[w:CarouselProductsWidget|type=popular;view=index;]]'
                    ),
                    array(
                        'label' => 'Новинки',
                        'active' => false,
                        'content' => '[[w:CarouselProductsWidget|type=new;view=index;]]'
                    ),
                    array(
                        'label' => 'Скидки',
                        'active' => false,
                        'content' => '[[w:CarouselProductsWidget|type=sale;view=index;]]'
                    ),
                ),
            )
        );
?>
    </div>
</div>

<div class="category_index">
<?php
    if(isset($category))
    {
        foreach($category as $key => $value)
        {
            $title_array = explode(" ", $value->title);
            $title = isset($title_array[2]) ? 'Запчасти на <span>'.$title_array[2].'</span>' : '<span>'.$title_array[0].'</span>';
            $image = $value->getOneFile('original');

            $url_lv1 = $value->name;

            $close = 0;

            $children = $value->children()->active()->findAll();

            echo
            '<div class="category_container">
                <div class="container">
                    <div class="row" style="background-image: url('.$image.')">
                        <div class="title">
                            '.CHtml::link($title, array('catalog/tree', 'url' => $value->name)).'
                        </div>
                        <div class="fon"></div>
                        <div class="clearfix"></div>';

                        if($children)
                        {
                            $sub_close = 0;
                            foreach($children as $k => $v)
                            {
                                $sub_children = $v->children()->active()->findAll();
                                if($k == 0 || $k % 4 == 0 || $sub_close)
                                {
                                    $col = $sub_children ? 'col-xs-3 ' : 'col-xs-2 ';

                                    $left = ($k == 0) ? "no-left" : "";
                                    $right = ($k == 8) ? "no-right long" : "";

                                    echo CHtml::openTag('ul', array('class' => 'children '.$col . $left . $right));
                                    $close = 0;
                                }

                                if($k == 11)
                                {
                                    echo '<a href="'.$this->createUrl('catalog/tree', array('url' => $url_lv1)).'" class="more">Показать больше</a>';
                                    break;
                                }
                                else
                                {
                                    echo '<li><a href="'.$this->createUrl('catalog/tree', array('url' => $url_lv1.'/'.$v->name)).'">'.$v->title.'</a></li>';
                                }

                                if(($k + 1) % 4 == 0)
                                {
                                    echo CHtml::closeTag('ul');
                                    $close = 1;
                                }

                                if($sub_children)
                                {
                                    $sub_left = ($k == 0 || $sub_close) ? "no-all" : "";

                                    echo
                                    CHtml::openTag("ul", array("class" => "col-xs-12 ".$sub_left));

                                    foreach($sub_children as $_k => $_v)
                                    {
                                        $_sub_left = ($_k == 0) ? "no-left" : "no-all";

                                        if($_k == 0 || $_k == 5)
                                        {
                                            echo CHtml::openTag("ul", array("class" => "col-xs-6 ".$_sub_left));
                                            $close = 0;
                                        }

                                        if($_k == 9)
                                        {
                                            echo '<a href="'.$this->createUrl('catalog/tree', array('url' => $url_lv1)).'" class="more">Показать больше</a>';
                                            break;
                                        }
                                        else
                                        {
                                            echo
                                            '<li>
                                                <a href="' . $this->createUrl('catalog/tree', array('url' => $value->name . '/' . $v->name . '/' . $_v->name)) . '">' . $_v->title . '</a>
                                            </li>';
                                        }

                                        if($_k == 4)
                                        {
                                            echo CHtml::closeTag('ul');
                                            $close = 1;
                                        }
                                        $sub_close = 1;
                                    }

                                    echo
                                    CHtml::closeTag("ul").
                                    CHtml::closeTag("ul");

                                    if(!$close)
                                    {
                                        echo CHtml::closeTag('ul');
                                    }
                                }
                            }
                            if(!$close || !$sub_close)
                            {
                                echo CHtml::closeTag('ul');
                            }
                        }
            echo
                    '</div>
                </div>
            </div>';
        }
    }
?>
</div>

<div class="about_index">
    <div class="container">
        <div class="row">
            <div class="col-xs-10 no-left text">
                <?php echo $this->text ;?>
            </div>
        </div>
    </div>
</div>

<div class="aksinterier">
    <div class="container">
        <div class="row">
            <div class="col-xs-3 logo"></div>
            <div class="col-xs-5">
                <h1>Нужен <span>натяжной потолок?</span></h1>
                <span>
                    Заходите на сайт наших партнеров <br/>
                    и получите скидку 3%
                </span>
            </div>
            <div class="col-xs-4 text-right no-right">
                <a href = "" class="opacity">Перейти к сайту</a>
            </div>
        </div>
    </div>
</div>