<div class="text-page two_columns">
    <div class="container">
        <div class="row">

            <div class="col-xs-3 no-left">
                <div class="left_side">
                    <div class="caption cat-categories">
<?php
                        echo MenuItem::model()->active()->findByPk(8)->title;
?>
                    </div>
                    [[w:MenuWidget|id=8;]]
                </div>
            </div>
            <div class="col-xs-9 no-right">
                <h1 class="page_title"><?php echo $this->getPageTitle() ;?></h1>
                <div class="text">
<?php
                    echo $this->text;
?>
                </div>
            </div>
        </div>
    </div>
</div>