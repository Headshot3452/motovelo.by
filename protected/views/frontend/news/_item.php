<div class="akcii_item col-xs-12">
<?php
    $image = $data->getOneFile('big');
    if ($image)
    {
        $preview = ($data->preview != "") ? '<div class="anons">'. $data->preview .'</div>' : '';

        echo
        '<div class="image-block pull-left col-xs-7 no-left">
            <a href="'. Yii::app()->createUrl('news/item', array('name' => $data->name)) .'"> <img src="/'. $image .'"></a>
        </div>
        <div class="col-xs-5 no-right description">
            <h3 class="title">
                '. CHtml::link($data->title,array('news/item', 'name' => $data->name)) .'
            </h3>
            <div class="date">с '. Yii::app()->dateFormatter->format('d MMMM yyyy', $data->time) .' по '. Yii::app()->dateFormatter->format('d MMMM yyyy', $data->time_end) .'</div>
            '. $preview .'
        </div>';
    }
?>
</div>