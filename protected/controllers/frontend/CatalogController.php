<?php
    class CatalogController extends FrontendController
    {
        public $root_id;

        public function init()
        {
            parent::init();

            $this->getPageModule();
            $struct = Structure::model()->findByPk($this->page_id);
            $this->root_id = $struct->module->tree_id;
        }

        public function actionIndex()
        {
            $this->getPageModule();
            $root = CatalogTree::model()->language($this->getCurrentLanguage()->id)->roots()->active()->findByPk($this->root_id);

            $categories = $root->children()->active()->findAll();
            $tree = CatalogTree::getAllTree();

            $this->render('index', array('categories' => $categories, 'tree' => $tree));
        }

        public function actionList()
        {

        }

        public function actionSearch($term)
        {
            $this->setPageTitle("Поиск");

            $words = explode(' ', $term);

            $criteria = new CDbCriteria;

            if (!empty($words))
            {
                $count = count($words);
                for ($i = 0; $i < $count; $i++)
                {
                    $criteria->addSearchCondition('title', $words[$i]);
                }
            }

            $criteria->scopes = array(
                'language' => array($this->getCurrentLanguage()->id),
                'active',
            );

            $model = new CatalogProducts();

            if (Yii::app()->request->isAjaxRequest)
            {
                $criteria->limit = 5;

                $links = $model::model()->findAll($criteria);

                $result = array();
                foreach ($links as $link)
                {
                    $image = $link->getOneFile('small');

                    $result[] = array(
                        'url' => $this->createUrl('catalog/tree', array('url' => $link->getUrlForItem($this->root_id))),
                        'src' => ($image) ? $image : Yii::app()->params['noimage'],
                        'label' => $link->title,  // label for dropdown list
                        'value' => $term,  // value for input field
                        'id' => $link->id,        // return value from autocomplete
                    );
                }

                echo CJSON::encode($result);
                Yii::app()->end();
            }

            $products = new CActiveDataProvider($model,
                array(
                    'criteria' => $criteria,
                    'pagination' => array(),
                )
            );

            $this->render('tree', array('children' => array(), 'dataProducts' => $products, 'category' => array()));
        }

        public function actionTree($url)
        {
            $pages = explode('/', $url);
            $menu_items = array();
            $root = CatalogTree::model()->language($this->getCurrentLanguage()->id)->roots()->active()->findByPk($this->root_id);

            if (!$root)
            {
                throw new CHttpException(404);
            }

            $id = $root->id;
            $count_page = count($pages);

            if ($count_page > 0)
            {
                $path = $root->findPath('name', $pages);

                if (!empty($path['item']))
                {
                    if (!empty($path['active_ids']))
                    {
                        $this->setActiveIds($path['active_ids'], 'catalogTree');
                        $this->addActiveId($id, 'catalogTree');
                    }

                    $id = $path['item']['id'];
                }

                $tree = $this->getPageTree($id);

                $count_breadcrumbs = count($path['breadcrumbs']);

                if ($count_page > $count_breadcrumbs && ($count_page - 1) == $count_breadcrumbs)
                {
                    $product = CatalogProducts::model()->active()->find('name = :name and parent_id = :parent_id', array(':parent_id' => $id, ':name' => $pages[$count_page - 1]));
                    if (!$product)
                    {
                        throw new CHttpException(404);
                    }

                    $this->getPageModule('product');

                    if (!empty($path['breadcrumbs'])) //добавить последний уровень крошек
                    {
                        $this->setBreadcrumbs($path['breadcrumbs'], 'catalog/tree');
                        $temp = array_pop($path['breadcrumbs']);
                    }
                    $this->breadcrumbs[$temp['title']] = $this->createUrl('catalog/tree', array('url' => $temp['url']));
                    $this->breadcrumbs[] = $product->title;
                    $this->setPageTitle($product->title);
                    $this->setSeoTags($product);
                    $this->setText($product);

                    $this->layout = 'two_columns';

                    $parent = CatalogTree::model()->active()->findByPk($id)->parent()->find();
                    $menu = $parent->children()->active()->findAll();

                    foreach ($menu as $item)
                    {
                        $active = '';
                        if($item->findUrlForItem('name', false, $this->root_id).$item->name == $url)
                        {
                            $active = 'active';
                        }
                        elseif($item->id == $id)
                        {
                            $active = 'active';
                        }

                        $menu_items[] = array('label' => $item->title, 'active' => $active, 'url' => $this->createUrl('catalog/tree', array('url' => $tree->findUrlForItem('name', false, $this->root_id).$item->name)));
                    }

                    $this->render('product', array('product' => $product, 'menu_items' => $menu_items));
                    Yii::app()->end();
                }
                elseif ($count_page != $count_breadcrumbs)
                {
                    throw new CHttpException(404);
                }
            }
            else
            {
                $this->addActiveId($id, 'catalogTree');
            }

            $this->getPageModule('tree');

            $tree = $this->getPageTree($id);

            if (!empty($path['breadcrumbs']))
            {
                $this->setBreadcrumbs($path['breadcrumbs'], 'catalog/tree');
            }

            if (isset($tree))
            {
                $order = null;
                $sort = Yii::app()->request->cookies['sort_products'];
                if (!$sort)
                {
                    $sort = 'default';
                }
                else
                {
                    $sort = $sort->value;
                }

                if (!empty($sort))
                {
                    switch ($sort)
                    {
                        case 'price_asc':
                            $order = 't.`price` ASC';
                            break;
                        case 'price_desc':
                            $order = 't.`price` DESC';
                            break;
                        case 'title_asc':
                            $order = 't.`title` ASC';
                            break;
                        case 'title_desc':
                            $order = 't.`title` DESC';
                            break;
                    }
                }

                $trees = $tree->children()->active()->findAll();
                $des = $tree->descendants()->active()->findAll();

                if($trees)
                {
                    $id = CHtml::listData($des, 'id', 'id');
                }

                $products = CatalogProducts::model()->getDataProviderForCategory($id, $order, 6);
            }

            $menu = $trees;

            if (empty($trees))
            {
                $parent = $tree->parent()->active()->find();
                $menu = $parent->children()->active()->findAll();

                foreach ($menu as $item)
                {
                    $active = '';
                    if($item->findUrlForItem('name', false, $this->root_id).$item->name == $url)
                    {
                        $active = 'active';
                    }

                    $menu_items[] = array('label' => $item->title, 'active' => $active, 'url' => $this->createUrl('catalog/tree', array('url' => $tree->findUrlForItem('name', false, $this->root_id).$item->name)));
                }
            }
            else
            {
                foreach ($menu as $item)
                {
                    $menu_items[] = array('label' => $item->title, 'url' => $item->name);
                }
            }

            $this->layout = 'two_columns';
            $this->render('tree', array('menu_items' => $menu_items, 'trees' => $trees, 'dataProducts' => $products, 'tree' => $tree, 'count' => 6));
        }

        protected function getPageTree($id)
        {
            $this->active_id = $id;
            $page = CatalogTree::model()->findByPk($id);

            $this->breadcrumbs[] = $page->title;

            $this->setPageTitle($page->title);
            $this->setSeoTags($page);
            $this->setText($page);

            return $page;
        }

        public function hasActive($id, $type = 'catalogTree')
        {
            return parent::hasActive($id, $type);
        }
    }