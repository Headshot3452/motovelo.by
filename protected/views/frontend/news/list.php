<div class="container two_columns">
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
        <div class="col-xs-9 no-right news">
            <h1 class="page_title"><?php echo $this->getPageTitle() ;?></h1>
<?php
            $this->widget('bootstrap.widgets.BsListView',
                array(
                    'dataProvider' => $dataProvider,
                    'itemView' => '_item',
                    'ajaxUpdate' => false,
                    'itemsCssClass' => 'row',
                    'emptyText' => '',
                    'template' => '{items}<div class="col-xs-12 row pull-left">{pager}</div>',
                )
            );
?>
        </div>
    </div>
</div>