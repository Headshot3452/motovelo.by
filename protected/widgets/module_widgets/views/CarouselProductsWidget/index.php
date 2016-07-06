<div class="" style="padding: 0 15px; margin: 0 -10px">
	<div class="type_slider">
<?php
	foreach ($this->_data as $item)
	{
		$image = $item->getOneFile('medium');

		$url = $item->getUrlForItem($item->parent->root);

		$sale = CatalogProducts::model()->getSalePrice($item->price, $item->sale_info, 0);
		$price = ($sale != $item->price && $sale != 0) ? $sale : number_format($item->price, 0, '.', ' ');

		echo
		'<div class="item">
			<a href="'.$this->controller->createUrl('catalog/tree', array('url' => $url)).'">
				<div class="inner">
					<img src="'.$image.'" alt="'.$item->title.'">
					<div class="title">'.$item->title.'</div>
					<span class="price">'.$price.'</span>
					<a href="" class="hidden_link how_to_order">Где купить?</a>
					<a href="" class="hidden_link submit_your_application"
		                data-price="'.$price.'"
		                data-title="'.$item->title.'"
		                data-id="'.$item->id.'">
		                Оставить заявку
		            </a>
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