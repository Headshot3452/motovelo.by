<?php
    $this->renderPartial('//layouts/_header', array());
    $this->renderFile(Yii::getPathOfAlias('application.views') . '/_all_alerts.php', array());

    if (!empty($this->breadcrumbs))
    {
        echo
        '<div id="breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 no-all">
                        <h1>'.$this->pageTitle.'</h1>';

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
?>
    [[b:Слайдер|]]
<?php
    echo
    '<div class="content">
        '.$content.'
    </div>';

    $this->renderPartial('//layouts/_footer', array());
?>