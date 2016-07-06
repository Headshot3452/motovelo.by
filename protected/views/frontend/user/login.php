<?php
    /* @var $this UsersController */
    /* @var $model Users */
    /* @var $form BsActiveForm */
?>
    <div class="form">
<?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm',
        array(
            'id' => 'users-login-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal'),
        )
    );
?>
    <div class="form-group text-center title">
        <?php // добавить описание в app.php?>
        Введите учетные данные
    </div>

	<div class="form-group col-xs-6">
        <div class="col-xs-12">
            <?php echo $form->textField($model,'email'); ?>
            <?php echo $form->error($model,'email',array('class'=>'errorMessage', 'placeholder'=>'E-mail')); ?>
        </div>
	</div>

	<div class="form-group col-xs-6">
        <div class="col-xs-12">
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password',array('class'=>'errorMessage', 'placeholder'=>'Пароль')); ?>
        </div>

	</div>
	<div class="buttons form-group">
        <div class="col-xs-12">
            <?php
            if (Yii::app()->params['site']['allow_register_admin'])
            {
                echo BsHtml::link(Yii::t('app','Register'),array('user/register'));
            }
            ?>
            <?php echo BsHtml::submitButton(Yii::t('app', 'Login'), array('color' => BsHtml::BUTTON_COLOR_PRIMARY));?>

            <?php echo BsHtml::checkBox('checkbox',false,array('class'=>'checkbox group')); ?>
            <?php echo BsHtml::label(Yii::t('app','Remember Me'),'checkbox',false,array('class'=>'checkbox')); ?>

            <?php echo BsHtml::link(Yii::t('app','Get new password'), $this->createUrl('user/passwordreset') ); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->