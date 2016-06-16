<?php
	$model = new ApplicationForm();

    $form = $this->beginWidget('BsActiveForm',
	    array(
		    'id' => 'form-application',
		    'htmlOptions' => array(
			    'role' => 'form',
			    'class' => 'form-horizontal',
		    ),
		    'enableAjaxValidation' => false,
		    'action' => $this->createUrl('/application'),
		    'enableClientValidation' => true,
		    'clientOptions' =>array(
				'validateOnSubmit' => true,
		    )
	    )
    );
?>
	<div class="form-group">
		<?php echo $form->textField($model, 'name', array('placeholder' => 'Ваше имя*')) ;?>
		<?php echo $form->error($model, 'name') ;?>
	</div>

	<div class="form-group">
		<?php echo $form->textField($model, 'phone', array('placeholder' => 'Ваш телефон*')) ;?>
		<?php echo $form->error($model, 'phone') ;?>
	</div>

	<div class="form-group">
		<?php echo $form->textField($model, 'email', array('placeholder' => 'E-mail')) ;?>
		<?php echo $form->error($model, 'email') ;?>
	</div>

	<div class="form-group buttons">
		<?php echo BsHtml::submitButton('Оставить заявку', array('/application')) ;?>
	</div>
<?php
	$this->endWidget();