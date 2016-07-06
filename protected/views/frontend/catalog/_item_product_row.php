<?php
    $link = $this->createUrl('catalog/tree', array('url' => $data->getUrlForItem($data->parent->root)));

    $image = $data->getOneFile('medium');
    $sale_type = '';
    if (!$image or !file_exists($image))
    {
        $image = Yii::app()->params['noimage'];
    }

    $sale = CatalogProducts::model()->getSalePrice($data->price, $data->sale_info, 0);
    $price = ($sale != $data->price && $sale != 0) ? $sale : number_format($data->price, 0, '.', ' ');
?>
<div class="one-product col-xs-4 view-row border-bottom">
    <div class="inner">
        <a href="<?php echo $link ?>">
            <img align="top" src="/<?php echo $image; ?>" class="border">
            <div class="title">
                <?php echo $data->title ;?>
            </div>
            <div class="price-group">
                <div class="price text-shadow">
                    <b>
                        <?php echo $price ;?>
                    </b>
                    <span class="currency">руб</span>
                </div>
<?php
                if ($sale)
                {
                    echo
                    '<div class="price-old text-shadow">
                        <b>
                            ' . number_format($data->price, 0, '.', ' ') . '
                        </b>
                        <span class="currency">руб</span>
                    </div>';
                }
?>
            </div>
<?php
            echo
            '<div class="action col-xs-4 no-all">';
                if ($data->sale)
                {
                    echo '<div class="sale"> Акция</div>';
                }
                if ($data->new)
                {
                    echo '<div class="new"> Новинка</div>';
                }
            echo
            '</div>

            <a href="" class="how_to_order hidden_link">Где купить?</a>
            <a href="" class="hidden_link">Оставить заявку</a>';
?>
        </a>
        <div class="clearfix"></div>
    </div>
</div>
