<div class="modal fade in" id="how_to_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span></button>
				<h4 class="modal-title text-uppercase" id="myModalLabel">Где купить?</h4>
			</div>
			<div class="modal-body">
				<div class="product_contacts">
					<div class="address">
						<span>Адрес</span>
						<?php echo $this->address[0]->text ;?>
					</div>
					<div class="phones">
						<span>Телефоны для связи</span>
<?php
						foreach($this->phones as $value)
						{
							echo '<div>'. $value->number .' '. $value->operator .'</div>';
						}
?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade in" id="submit_your_application" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span></button>
				<h4 class="modal-title text-uppercase" id="myModalLabel">Оставить заявку</h4>
			</div>
			<div class="modal-body">
				<div class="title_product"></div>
<?php
				$form = $this->beginWidget('BsActiveForm',
					array(
						'id' => 'orders-form',
						'htmlOptions' => array(
							'role' => 'form',
						),
						'enableAjaxValidation' => false,
						'action' => $this->createUrl('site/contacts'),
						'enableClientValidation' => true,
					)
				);

				$model = new OrdersForm();
?>
				<?php echo $form->hiddenField($model, 'id', array('value' => '')) ;?>
				<?php echo $form->hiddenField($model, 'title', array('value' => '')) ;?>
				<?php echo $form->hiddenField($model, 'price', array('value' => '')) ;?>

				<div class="form-group">
					<?php echo $form->textField($model, 'name') ;?>
					<?php echo $form->error($model, 'name') ;?>
				</div>

				<div class="form-group">
					<?php echo $form->textField($model, 'phone') ;?>
					<?php echo $form->error($model, 'phone') ;?>
				</div>

				<div class="form-group">
					<?php echo $form->textField($model, 'email') ;?>
					<?php echo $form->error($model, 'email') ;?>
				</div>

				<div class="form-group button">
					<?php echo CHtml::submitButton('Оставить заявку', array('class' => 'opacity')) ;?>
				</div>

				<div class="clearfix"></div>

				<?php $this->endWidget() ;?>
			</div>
		</div>
	</div>
</div>