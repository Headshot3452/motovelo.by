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
                            foreach($children as $k => $v)
                            {
                                if($k == 0 || $k % 4 == 0)
                                {
                                    $left = ($k == 0) ? "no-left" : "";
                                    $right = ($k == 8) ? "no-right long" : "";

                                    echo CHtml::openTag('ul', array('class' => 'children col-xs-2 '.$left.$right));
                                    $close = 0;
                                }

                                if($k == 11)
                                {
                                    echo '<a href="'.$this->createUrl('catalog/tree', array('url' => $url_lv1)).'" class="more">Показать больше</a>';
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
                            }
                            if(!$close)
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