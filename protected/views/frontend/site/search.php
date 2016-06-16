<div class="search_page">
	<div class="container">
		<div class="row">
<?php
			$search = Yii::app()->request->getQuery('term');

			echo CHtml::beginForm(array('search'), 'get', array('id' => 'form-search-page'));
			echo CHtml::textField('term', $search, array('class' => 'hid', 'placeholder' => 'Я ищу...'));
			echo CHtml::linkButton('Поиск', array('class' => 'search-link'));
			echo CHtml::endForm();

			$result = $dataProducts->getTotalItemCount();
?>
			<h2>Найдено <?php echo $result .' '. Yii::t('app', 'result', $result) ;?>: </h2>
<?php
			$this->widget('application.widgets.ProductListView',
				array(
					'id' => 'search-list',
					'emptyText' => '',
					'itemView' => '_search_item',
					'dataProvider' => $dataProducts,
					'ajaxUpdate' => false,
					'template' => "<div class='row'>{items}\n</div>",
				)
			);
?>
		</div>
	</div>
</div>
