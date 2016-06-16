<?php
    $url = trim($product->parent->findUrlForItem('name', false, $this->root_id), '/');

    $sale_type = '';

    $cs = Yii::app()->getClientScript();

    $sale = CatalogProducts::model()->getSalePrice($product->price, $product->sale_info, 0);

    $image = $product->getOneFile('small');

    if (!$image or !file_exists($image))
    {
        $image = Yii::app()->params['noimage'];
    }

    $sale_cart = ($sale != $product->price && $sale != 0) ? $product->price - $sale : 0;

    $stock = unserialize($product->stock);
    $count = $stock[0] == 1 ? '<span>Под заказ</span>' : '<span class="color_green">В наличии</span>';

    $price = ($sale != $product->price && $sale != 0) ? $sale : number_format($product->price, 0, '.', ' ');

    $parameters = $product->parameters;

    $address =
        '<div class="product_contacts">
            <div class="address">
                <span>Адрес</span>
                '.$this->address[0]->text.'
            </div>
            <div class="phones">
                <span>Телефоны для связи</span>';

                foreach($this->phones as $value)
                {
    $address .=     '<div>'. $value->number .' '. $value->operator .'</div>';
                }
    $address .=
            '</div>
        </div>';

    echo
    '<div class="two_columns">
        <div class="container">
            <div class="row">
                <div class="col-xs-3 no-left">
                    <div class="left_side">
                        <div class="caption cat-categories">Категории</div>';

                        $this->widget('bootstrap.widgets.BsNav',
                            array(
                                'items' => $menu_items,
                            )
                        );
    echo
                    '</div>
                    <div class="left_contacts">
                        <div class="caption cat-categories">Наши контакты</div>
                        <div class="phone">
                            <i>Телефон для связи</i>
                            <span>'.$this->phones[0]->number.'</span>
                        </div>
                        <div class="address">
                            <i>Адрес</i>
                            <span>'.$this->address[0]->text.'</span>
                        </div>
                    </div>
                </div>
                <div class="catalog">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-9 product no-right">
                                <h1 class="page_title">'.$this->getPageTitle().' <span id="count">'.$count.'</span> </h1>
                                <div class="row">
                                    <div class="images col-xs-5">';
                                        $this->renderPartial('slider_product', array('product' => $product));
                                        if ($product->sale)
                                        {
                                            echo '<div class="sale">Акция</div>';
                                        }
                                        if ($product->new)
                                        {
                                            echo '<div class="new">Новинка</div>';
                                        }
    echo
                                    '</div>
                                    <div class="col-xs-7 price-descr">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="price text-shadow">
                                                    <b>'.$price.'</b>
                                                    <span class="currency">руб.</span>
                                                </div>';
                                                if ($sale)
                                                {
                                                    echo
                                                    '<div class="price-old text-shadow">
                                                        <b>' . number_format($product->price, 0, '.', ' ') . '</b>
                                                        <span class="currency">руб.</span>
                                                    </div>';
                                                }
?>
                                            </div>
                                            <div class="col-xs-12">
<?php
                                                $this->widget('BsNavs',
                                                    array(
                                                        'id' => 'product_tabs',
                                                        'items' => array(
                                                            array(
                                                                'label' => 'Где купить?',
                                                                'active' => true,
                                                                'content' => $address
                                                            ),
                                                            array(
                                                                'label' => 'Оставить заявку',
                                                                'active' => false,
                                                                'content' => $this->renderPartial('_application_form', '', true)
                                                            ),
                                                        ),
                                                    )
                                                );
?>
                                            </div>
                                            <div class="parameters col-xs-12">
<?php
                                                foreach($parameters as $value)
                                                {
                                                    echo
                                                    '<div class="item">
                                                        <span class="title">'. $value->params->title .': </span>
                                                        <span class="value">'. $value->value->value .'</span>
                                                    </div>';
                                                }
?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text">
                                    <?php echo $product->text ;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


