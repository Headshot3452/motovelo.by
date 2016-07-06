<?php
	$this->renderPartial('//layouts/_header', array());
	$this->renderFile(Yii::getPathOfAlias('application.views') . '/_all_alerts.php', array());

	$currency = SettingsCurrencyList::getCurrencyBasic();

	if (!empty($this->breadcrumbs))
	{
		$lv_1 = next($this->breadcrumbs);
		$lv_2 = next($this->breadcrumbs);
		$lv_3 = next($this->breadcrumbs);
		$lv_4 = next($this->breadcrumbs);

		$url = '';
		$link = '';

		if($lv_4)
		{
			$link = CHtml::link('Назад', $lv_3);
		}
		else
		{
			if($lv_3 && !is_array($lv_3))
			{
				$link = CHtml::link('Назад', $lv_2);
			}
			elseif($lv_3 && is_array($lv_3))
			{
				$link = CHtml::link($this->pageTitle, $this->createUrl('catalog/tree', array('url' => $lv_3['url'])));
			}
			else
			{
				if($lv_2 && !is_array($lv_2))
				{
					$link = CHtml::link($this->pageTitle, $lv_1);
				}
				else
				{
					if($lv_1 && !is_array($lv_1) && !$lv_2)
					{
						$link = CHtml::link($this->pageTitle, $this->createUrl('catalog/index'));
					}
					else
					{
						$link = CHtml::link($this->pageTitle, $this->createUrl('catalog/tree', array('url' => $lv_2['url'])));
					}
				}
			}
		}

		echo
		'<div id="breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 no-all">
                        <h1>'.$link.'</h1>';

						$this->widget('bootstrap.widgets.BsBreadcrumb',
							array(
								'links' => $this->breadcrumbs,
							)
						);
		echo
					'</div>
                </div>
            </div>
        </div>';
	}

	echo
	'<div class="content">
        '.$content.'
    </div>';

	$this->renderPartial('//layouts/_footer', array());
