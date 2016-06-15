<?php
    $cs = Yii::app()->getClientScript();

    if (!isset($url))
    {
        $url = '';
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
                            <i>Телефон для связи</i>
                            <span>'.$this->phones[0]->number.'</span>
                        </div>
                        <div class="address">
                            <i>Адрес</i>
                            <span>'.$this->address[0]->text.'</span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-9 right_side no-right">
                    <h1 class="page_title">'.$this->pageTitle.' <span class="count">'.$count . " ". Yii::t('app', 'product', $count).'</span></h1>';

                    if (isset($dataProducts))
                    {
                        $itemView = '_item_product_row';
                        $page_count = ceil($count / 6);

                        $this->widget('application.widgets.ProductListView',
                            array(
                                'id' => 'products-list',
                                'emptyText' => 'В данной категории нет товаров :(',
                                'itemView' => $itemView,
                                'dataProvider' => $dataProducts,
                                'ajaxUpdate' => false,
                                'template' => "<div class='row'>{items}\n</div><div class='col-xs-12 no-left'><div class='pull-left'>{pager}</div></div>",
                                'pager' => array(
                                    'class' => 'application.widgets.PagerWidget',
                                    'prevPageLabel' => '<span class="prev_page"></span>',
                                    'firstPageLabel' => '<span class="first_page"></span>',
                                    'nextPageLabel' => '<span class="next_page"></span>',
                                    'lastPageLabel' => $page_count,
                                    'lastestPageLabel' => '<span class="last_page"></span>',
                                ),
                            )
                        );
                    }
    echo
                '</div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>';