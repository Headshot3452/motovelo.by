<?php
	if($this->_items)
	{
		echo '<div id="main_slider">';
		foreach($this->_items as $item)
		{
			$image = $item->getOneFile('origin');
			$link = ($item->name) ? '<a href="'.$item->name.'" class="link opacity">'.$item->text.'</a>' : '';

			echo
			'<div class="item">
				<img src="'.$image.'" alt="'.$item->title.'" class="">
				<a href="" class="stock opacity">Акции</a>
				'. $link .'
			</div>';
		}
		echo '</div>';
	}

	$cs = Yii::app()->getClientScript();
	$main_slider =
		'$("#main_slider").slick(
		{
			slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            dots: true,
            arrows: true,
            infinite: true,
		});
	';
	$cs->registerScript("main_slider", $main_slider);