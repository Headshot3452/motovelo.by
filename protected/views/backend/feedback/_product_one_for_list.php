<li class="one_item feedback" id="<?php echo $data->id;?>" style="border-color:<?php echo $data::getColorStatus($data->status); ?>">
    <div class="row">
        <div class="col-xs-1 text-center">
            <span class="number-answer"><?php echo $data->id; ?></span>
            <?php echo BsHtml::checkBox('checkbox['.$data->id.']',false,array('class'=>'checkbox group')); ?>
            <?php echo BsHtml::label('','checkbox_'.$data->id,false,array('class'=>'checkbox')); ?>
            <span class="date"><?php echo date("d.m.Y H:m", $data->time); ?></span>
        </div>
        <div class="col-xs-3 name">
            <?php
            foreach(SettingsFeedback::model()->findAll('system=1') as $key => $value) { ?>
                <div class="feedback_system">
                    <?php
                        if($key==0)
                            echo '<img src="/images/icon-admin/little_user_company.png">';
                        if($key==1)
                            echo '<img src="/images/icon-admin/little_phone.png">';
                        if($key==2)
                            echo '<img src="/images/icon-admin/little_message_company.png">';
                    ?>
                    <?php echo (FeedbackAnswers::getAnswersForFeedback($value->id, $data->id)) ? FeedbackAnswers::getAnswersForFeedback($value->id, $data->id)->value : '';?>
                </div>
            <?php } ?>

            <?php
            foreach(FeedbackAnswers::getFeedbackAnswers($data->parent_id) as $key => $value){?>
                <div class="feedback_system">
                    <?php echo $value->name; ?>:
                    <?php echo FeedbackAnswers::getAnswersForFeedback($value->id, $data->id)->value; ?>
                </div>
            <?php }?>
        </div>
        <div class="col-xs-2 tema">
            <?php echo BsHtml::link($data->tree->title,$this->createUrl('update').'?id='.$data->id); ?>
        </div>
        <div class="col-xs-5 name">
            <?php echo $data->ask; ?>
        </div>
    </div>
</li>