<?php
    $cs = Yii::app()->getClientScript();

    if (!isset($url))
    {
        $url = '';
    }
    if (isset($tree))
    {
        $url = trim($tree->findUrlForItem('name', false, $this->root_id), '/');
    }

    $count = $dataProducts ? $dataProducts->getTotalItemCount() : '';

    echo
    '<div class="two_columns">
        <div class="container">
            <div class="row">
                <div class="col-xs-3 no-left">
                    <div class="left_side">
                        <div class="caption cat-categories">Категории</div>';

                        $this->widget('bootstrap.widgets.BsNav',
                            array(
                                'items' => $menu_items,
                            )
                        );
    echo
                    '</div>
                    <div class="left_contacts">
                        <div class="caption cat-categories">Наши контакты</div>
                        <div class="phone">
                            Телефон для связи
                            <span>'.$this->phones[0]->number.'</span>
                        </div>
                        <div class="address">
                            Адрес
                            <span>'.$this->address[0]->text.'</span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-9 right_side no-right">
                    <h1 class="page_title">'.$this->pageTitle.' <span class="count">'.$count.'</span></h1>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>';

//    if (isset($trees) and !empty($trees))
//    {
//        echo
//            '<div class="slider">
//            </div>
//            <div class="trees row">';
//
//            if (isset($tree))
//            {
//                $url = $tree->findUrlForItem('name', false, $this->root_id) . $tree->name . '/';
//            }
//
//            foreach ($trees as $key => $item)
//            {
//                $image = $item->getOneFile('small');
//
//                if (empty($image) or !file_exists($image))
//                {
//                    $image = Yii::app()->params['noimage'];
//                }
//
//                $link = $this->createUrl('catalog/tree', array('url' => $url . $item->name));
//                echo '<div class="subitem col-md-4 col-xs-12"><div class="sub-block border">';
//                echo '<div class="image"><a href="' . $link . '" style="background: #fff url(/' . $image . ') center center no-repeat; background-size: contain;"></a></div>';
//                echo '<div class="title text-left">' . CHtml::link('<b>' . $item->title . '</b>', $link) . '</div>';
//                echo '</div></div>';
//            }
//        echo '</div>';
//        if (isset($tree))
//        {
//            echo '[[w:CarouselProductsWidget|type=popular;count_items=3;category_id=' . $tree->id . ';title=<h2>Популярные товары</h2>]]';
//        }
//    }

//                //товары
//
//                if (empty($trees) and isset($dataProducts))
//                {
//                    $itemView = '';
//                    $typeCatalog = isset(Yii::app()->request->cookies['type_catalog']) ? Yii::app()->request->cookies['type_catalog']->value : '';
//                    $pressRow = '';
//                    $pressTable = '';
//                    $class = '';
//                    $counts = array('10' => '10', '20' => '20', '40' => '40', '50' => '50');
//
//
//
//                    $item_count = $dataProducts->getTotalItemCount();
//                    $page_count = ceil($item_count / $count);
//
//                    $this->widget('application.widgets.ProductListView',
//                        array(
//                            'id' => 'products-list',
//                            'htmlOptions' => array(
//                                'class' => $typeCatalog,
//                            ),
//                            'emptyText' => 'В данной категории нет товаров :(',
//                            'typeCatalog' => $typeCatalog,
//                            'itemView' => $itemView,
//                            'dataProvider' => $dataProducts,
//                            'ajaxUpdate' => false,
//                            'counts' => $counts,
//                            'counterCssClass' => 'pull-right counter',
//                            'itemsCssClass' => $typeCatalog.' '.$class.' items',
//                            'template' => "<div class='col-md-12 f-row head-line border text-right'>{mainsorter}<button id='view-table' class='btn btn-default $pressTable'><i class='fa fa-th-large'></i></button><button id='view-row' class='btn btn-default $pressRow'><i class='fa fa-th-list'></i></button></div>{items}\n<div class='col-xs-12 f-row footer-line border'><div class='pull-left'>{pager}</div>{counter}</div>",
//                            'viewData' => array(
//                                'url' => $url,
//                            ),
//                            'pager' => array(
//                                'class' => 'application.widgets.PagerWidget',
//                                'firstPageLabel' => '1',
//                                'prevPageLabel' => '<',
//                                'nextPageLabel' => '>',
//                                'lastPageLabel' => $page_count,
//                            ),
//                        )
//                    );
//                }
//
//                if(!empty($this->seo['title']) and !empty($this->seo['description']))
//                {
//?>
<!--                    <div class="row">-->
<!--                        <div class="col-md-12 seo-block">-->
<!--                            <h2>--><?php //echo $this->seo['title']?><!--</h2>-->
<!--                            --><?php //echo $this->seo['description']?>
<!--                        </div>-->
<!--                    </div>-->
<?php
//                }
//?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="modal fade" id="showall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Настройки фильтрации</h4>
            </div>
            <div class="modal-body">
<?php
                echo CHtml::form($this->createUrl('catalog/tree', array('url' => $url .'/'. $tree->name)), 'get');
                    $li = '';
                    $tab = '';
                    $selected = array();

                    if (empty($trees) and isset($dataProducts) and !empty($params))
                    {
                        foreach ($params as $p)
                        {
                            $par_array = array();
                            if ($p->type != CatalogParams::TYPE_TEXT)
                            {
                                $par_val = $p->getValues();
                                if(!empty($par_val))
                                {
                                    $par_array = array_combine(CHtml::listData($par_val, 'id', 'id'), $par_val);
                                }

                                $par_id = isset($par_val[0]) ? $par_val[0]['params_id'] : '';

                                $active = (isset($_GET['m'.$par_id]) || isset($_GET[$par_id])) ? '<i class="fa fa-check"></i>' : '';

                                $li .= '<li class="border-bottom"><a href="#param' . $p->id . '" data-toggle="tab">'.$active . $p->title . '</a></li>';
                                $data = array();

                                foreach ($par_val as $key => $v)
                                {
                                    $data[$v->id] = $v->value;

                                    if(isset($_GET['m'.$par_id]) && !isset($selected['m'.$par_id]))
                                    {
                                        foreach($_GET['m'.$par_id] as $get_key => $value)
                                        {
                                            if(isset($par_array[$value]->value) && $par_array[$value]->value != '')
                                            {
                                                $labels_footer[$par_id][$par_array[$value]->sort - 1] = $par_array[$value]->value;
                                            }

                                            $selected['m'.$par_id][] = $value;
                                        }
                                    }
                                    elseif(isset($_GET[$par_id]) && !isset($selected['m'.$par_id]))
                                    {
                                        foreach($_GET[$par_id] as $get_key => $value)
                                        {
                                            if(isset($par_array[$value]->value) && $par_array[$value]->value != '')
                                            {
                                                $labels_footer[$par_id][$par_array[$value]->sort - 1] = $par_array[$value]->value;
                                            }

                                            $selected['m'.$par_id][] = $value;
                                        }
                                    }
                                }

                                $tab .= '<div class="tab-pane" id="param' . $p->id . '"><div class="text-content">' . CHtml::checkBoxList('m' . $p->id, isset($selected['m'.$p->id]) ? $selected['m'.$p->id] : '', $data, array('separator' => '', 'container' => 'div')) . '</div></div>';
                            }
                        }
                    }
?>
                <div class="col-md-4">
                    <ul class="nav row">
                        <?php echo $li; ?>
                    </ul>
                </div>
                <div class="tab-content col-md-8">
                    <?php echo $tab; ?>
                </div>
                <div class="col-md-8 labels no-padding" role="tablist" id="label-tab">
                    <div class="total-count border-bottom text-right">
                        <a data-toggle="collapse" href="#labels" class="tab open" aria-expanded="true" aria-controls="collapseOne">Выбрано фильтров (<span id="counter">0</span>) <i class="fa fa-angle-up"></i></a>
                    </div>
                    <div id="labels" class="panel-collapse collapse b-toggle in" role="tabpanel" aria-labelledby="headingOne">
<?php
                        if(isset($labels_footer))
                        {
                            foreach($labels_footer as $key => $value)
                            {
                                foreach($value as $k => $v)
                                {
                                    echo '<label for="m'.$key.'_'.$k.'" class="border">'.$v.'<i class="fa fa-times" aria-hidden="true"></i></label>';
                                }
                            }
                        }
?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
                <button type="submit" class="btn btn-primary text-uppercase">Применить</button>
                <?php echo CHtml::endForm() ;?>
            </div>
        </div>
    </div>
</div>





