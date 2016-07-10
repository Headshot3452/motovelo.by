<div class="contacts">
    <div class="container">
        <div class="row">

            <div class="col-xs-6 no-left">
                <div class="inner">
                    <div class="caption cat-categories">
                        Наши контакты
                    </div>
                    <div class="left_contacts">
                        <div class="phone">
                            <i>Телефон для связи</i>
                            <span><?php echo $this->phones[0]->number ;?></span>
                        </div>
                        <div class="address">
                            <i>Адрес</i>
                            <span><?php echo $this->address[0]->text ;?></span>
                            <a href = "">Показать на карте</a>
                        </div>
                        <div class="email">
                            <i>E-mail</i>
                            <span><?php echo $this->settings->email_callback ;?></span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="col-xs-6 no-right">
                <div class="inner">
                    <div class="caption cat-categories">
                        Обратная связь
                    </div>
<?php
                    $model = new ApplicationForm('contacts');

                    $form = $this->beginWidget('BsActiveForm',
                        array(
                            'id' => 'form-contacts',
                            'htmlOptions' => array(
                                'role' => 'form',
                                'class' => 'form-horizontal',
                            ),
                            'enableAjaxValidation' => false,
                            'action' => $this->createUrl('/contacts'),
                            'enableClientValidation' => true,
                            'clientOptions' =>array(
                                'validateOnSubmit' => true,
                            )
                        )
                    );
?>
                    <div class="col-xs-6 no-left">
                        <div class="form-group">
                            <?php echo $form->textField($model, 'name', array('placeholder' => 'Ваше имя*')) ;?>
                            <?php echo $form->error($model, 'name') ;?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->textField($model, 'phone', array('placeholder' => 'Ваш телефон*')) ;?>
                            <?php echo $form->error($model, 'phone') ;?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->textField($model, 'email', array('placeholder' => 'E-mail*')) ;?>
                            <?php echo $form->error($model, 'email') ;?>
                        </div>

                        <div class="form-group buttons">
                            <?php echo BsHtml::submitButton('Оставить заявку') ;?>
                        </div>
                    </div>

                    <div class="col-xs-6 right">
                        <div class="form-group">
                            <?php echo $form->textArea($model, 'text', array('placeholder' => 'Текст сообщения')) ;?>
                            <?php echo $form->error($model, 'text') ;?>
                        </div>
                    </div>
<?php
                    $this->endWidget();
?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>