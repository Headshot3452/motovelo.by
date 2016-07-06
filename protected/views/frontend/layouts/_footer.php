    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-5 no-left">
                    <?php echo date("Y") ;?> г  ООО «Мотовело» <br/>
                    Все права защищены. <br/>
                    При использовании материалов сайта ссылка на сайт обязательна.
                </div>
                <div class="col-xs-2 no-right pull-right">
                    Добавляйтесь <br/>
                    в друзья
                    <span class="vk"><a href = "<?php echo $this->settings['vk'] ;?>" target="_blank"></a></span>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>

<?php
    $cs = Yii::app()->getClientScript();
    $scrollTo = '
        $(window).scroll(function()
        {
            if($(this).scrollTop() != 0)
            {
                $("#toTop").fadeIn();
            }
            else
            {
                $("#toTop").fadeOut();
            }
        });

        $("#toTop").click(function()
        {
            $("body, html").animate({scrollTop:0}, 800);
        });
    ';
    $cs->registerScript('scrollTo', $scrollTo);
?>