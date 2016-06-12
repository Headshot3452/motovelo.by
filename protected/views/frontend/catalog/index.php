<div class="catalog_index">
    <div class="container no-all">
        <div class="row">
<?php
            if (isset($categories))
            {
                foreach($categories as $key => $value)
                {
                    $image = $value->getOneFile('small');
                    $children = $value->children()->active()->findAll();

                    echo
                        '<div class="col-xs-3">
                            <a href="'.$this->createUrl('catalog/tree', array('url' => $value->name)).'">
                                <img src="/' . $image . '" alt="' . $value->title . '" />
                                <div class="title"><span>' . $value->title . '</span></div>
                            </a>';

                            if($children)
                            {
                                echo CHtml::openTag('ul');
                                foreach($children as $k => $v)
                                {
                                    echo '<li><a href="">' . $v->title . '</a></li>';

                                    $sub_children = $v->children()->active()->findAll();

                                    if($sub_children)
                                    {
                                        echo
                                        '<div class="row">';

                                        foreach($sub_children as $_k => $_v)
                                        {
                                            if($_k == 0 || $_k == 5)
                                            {
                                                echo CHtml::openTag('ul', array('class' => 'col-xs-6'));
                                            }

                                            echo '<li><a href="">' . $_v->title . '</a></li>';

                                            if($_k == 4)
                                            {
                                                echo CHtml::closeTag('ul');
                                            }
                                        }

                                        echo
                                        '</div>';
                                    }
                                }
                                echo CHtml::closeTag('ul');
                            }
                    echo
                    '</div>';
                }
            }
?>
            <div class="text">
                <div class="col-xs-10">
                    <?php echo $this->text ;?>
                </div>
            </div>

<!--//                            foreach ($categories as $key => $item)-->
<!--//                            {-->
<!--//                                $link = $this->createUrl('catalog/tree', array('url' => $url . $item->name));-->
<!--//                                echo-->
<!--//                                    '<div class="row col-md-12">-->
<!--//                                        <div class="item col-md-12">-->
<!--//                                            '. CHtml::link('<b>'.$item->title.'</b>', $item->name).'-->
<!--//                                        </div>';-->
<!--//-->
<!--//                                        foreach ($item->children()->active()->findAll() as $subitem)-->
<!--//                                        {-->
<!--//                                            echo '<div class="subitem col-md-4">'.CHtml::link($subitem->title, array('catalog/tree', 'url' => $item->name.'/'.$subitem->name)) . '</div>';-->
<!--//                                        }-->
<!--//                                    echo-->
<!--//                                        '<div class="clearfix"></div>-->
<!--//                                    </div>';-->
<!--//                            }-->
<!--//                    echo-->
<!--//                        '</div>';-->
<!--            }-->

        </div>
    </div>
</div>