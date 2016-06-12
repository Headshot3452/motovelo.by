<div class="" style="padding: 0 15px; margin: 0 -10px">
<div class="type_slider">

<?php
	foreach ($this->_data as $item)
	{
		$image = $item->getOneFile('medium');

		echo
		'<div class="item">
			<a href="">
				<div class="inner">
					<img src="'.$image.'" alt="'.$item->title.'">
					<div class="title">'.$item->title.'</div>
					<span class="price">'.Yii::app()->format->formatNumber($item->price).'</span>
					<a href="" class="hidden_link">Где купить?</a>
					<a href="" class="hidden_link">Оставить заявку</a>
				</div>
			</a>
		</div>';
	}

	$cs = Yii::app()->getClientScript();
	$type_slider =
		'$(".type_slider").slick(
		{
			slidesToShow: 6,
			slidesToScroll: 3,
			arrows: true
		});

		$(".type_slider .item.slick-slide.slick-active").mouseover(function()
        {
            $(this).closest(".slick-list.draggable").css({"z-index": "9999"});
        })
        .mouseout(function()
        {
            $(this).closest(".slick-list.draggable").css({"z-index": "0"});
        });
	';

	$cs->registerScript("type_slider", $type_slider);
?>
</div>
</div>