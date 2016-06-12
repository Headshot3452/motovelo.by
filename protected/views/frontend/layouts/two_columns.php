<?php
	$this->renderPartial('//layouts/_header', array());
	$this->renderFile(Yii::getPathOfAlias('application.views') . '/_all_alerts.php', array());

	$currency = SettingsCurrencyList::getCurrencyBasic();

	if (!empty($this->breadcrumbs))
	{
		echo
		'<div id="breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 no-all">
                        <h1>'.CHtml::link($this->pageTitle, array('catalog/index')).'</h1>';

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

    echo $content;

	$this->renderPartial('//layouts/_footer', array());
