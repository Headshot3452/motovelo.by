<div class="container home-menu-block">
    <div class="col-xs-3 logo no-left">

    </div>
    <div class="col-xs-9 menu">
        <menu>
<?php
            $this->widget('zii.widgets.CMenu',
                array(
                    'id' => 'home-menu',
                    'items' => $this->getTopMenuItems(),
                )
            );
?>
        </menu>
    </div>
</div>
<div class="main-title-block module-title">
    <div class="container">
        <?php echo $this->pageTitleBlock; ?>
    </div>
</div>