<?php
    class SiteController extends FrontendController
    {
        public function init()
        {
            parent::init();
        }

        public function actionIndex()
        {
            $this->getPage($this->getHomeId());

            $root = CatalogTree::model()->language($this->getCurrentLanguage()->id)->roots()->active()->find();

            if(!$root)
            {
                throw new CHttpException(404);
            }

            $category = $root->children()->active()->findAll();

            $this->render('index', array('category' => $category));
        }

        public function actionOrder()
        {
            if(isset($_POST['OrdersForm']))
            {
                $model = new OrdersForm('full');

                $model->attributes = $_POST['OrdersForm'];

                if($model->validate())
                {
                    $order = new Orders();

                    $price = str_replace(" ", "", CHtml::encode($_POST['OrdersForm']['price']));
                    $discount = CHtml::encode($_POST['OrdersForm']['discount']);

                    $product_id = CHtml::encode($_POST['OrdersForm']['id']);

                    $order->count = 1;
                    $order->sum = $order->count * $price;
                    $order->status = Orders::STATUS_OK;
                    $order->type_delivery = '1';
                    $order->type_payments ='1';

                    $info = array(
                        'name' => Chtml::encode($_POST["OrdersForm"]["name"]),
                        'email' => Chtml::encode($_POST["OrdersForm"]["email"]),
                        'phone' => Chtml::encode($_POST["OrdersForm"]["phone"]),
                    );
                    $order->user_info = serialize($info);

                    $order_info = $order->getInstanceRelation('orderItems');

                    $order_info->product_id = $product_id;
                    $order_info->title = Chtml::encode($_POST["OrdersForm"]["title"]);
                    $order_info->price = $price + $discount;
                    $order_info->discount = $price;
                    $order_info->count = 1;
                    $order_info->status = Orders::STATUS_OK;

                    if($order->validate())
                    {
                        $order->save();
                        $order_info->order_id = $order->id;

                        if($order_info->validate())
                        {
                            $order_info->save();
                            Yii::app()->user->setFlash('modalReview', array('header' => 'Заявка успешно отправлена', 'content' => 'В ближайшее время с вами свяжется наш менеджер.'));

                            $body = Yii::app()->controller->renderEmail('new_order', array('model' => $order));

                            if(!isset($order->email))
                            {
                                $info = unserialize($order->user_info);
                                $email = $info['email'];
                            }
                            else
                            {
                                $email = $order->email;
                            }

                            Core::sendAdminMessageOrder($email, $body, Yii::t('app', 'Issued a new order'));
                        }
                    }
                }
                else
                {
                    if (Yii::app()->request->isAjaxRequest)
                    {
                        $error = CActiveForm::validate($model);
                        if ($error != '[]')
                        {
                            echo $error;
                        }
                        Yii::app()->end();
                    }
                }
            }
            $this->redirect($_SERVER['HTTP_REFERER']);
        }

        public function actionSearch($term)
        {
            $this->setPageForUrl(Yii::app()->request->getPathInfo());

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

            $products = new CActiveDataProvider($model,
                array(
                    'criteria' => $criteria,
                    'pagination' => array(),
                )
            );

            $this->render('search', array('children' => array(), 'dataProducts' => $products));
        }

        public function actionContacts()
        {
            $this->setPageForUrl(Yii::app()->request->getPathInfo());

            $adresses = ContactsAddress::model()->active()->findAll();
            $phones = ContactsPhone::model()->active()->findAll();
            $settings = Settings::getSettings(1);

            $model=new ContactsForm('contacts');

            if (isset($_POST['type']))
            {
                switch($_POST['type'])
                {
                    case 'phone': $model->setScenario('phone'); break;
                }
            }

            if(isset($_POST['ajax']) && $_POST['ajax']==='contacts-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if (isset($_POST['ContactsForm']))
            {
                $model->attributes=$_POST['ContactsForm'];
                if ($model->validate())
                {
                    $bodyEmail=$this->renderEmail('contacts',array('model'=>$model));
                    $mail=Yii::app()->mailer->isHtml(true)->setFrom($model->email);
                    $mail->send($this->settings->email,'Subject',$bodyEmail);

                    echo CJSON::encode(array(
                        'status'=>'success'
                    ));
                    Yii::app()->end();
                }
                else
                {
                    $error = CActiveForm::validate($model);
                    if($error!='[]')
                        echo $error;
                    Yii::app()->end();
                }
            }

            $this->render('contacts',array('model'=>$model, 'adresses'=>$adresses, 'settings'=>$settings, 'phones' => $phones));
        }

        public function actionMap()
        {
            $this->renderPartial('map');
        }

        public function actionPage($url)
        {
            $this->setPageForUrl($url);

            $this->render('page',array());
        }

        public function actionError()
        {
            $this->render('error',array());
        }

        public function actionCartInfo()
        {
            $this->render('cart/cart_info');
        }

        public function actions()
        {
            return array_merge(
                parent::actions(),
                array(
                    'captcha'=>array(
                        'class'=>'CCaptchaAction',
                        'foreColor'=>0x119423,
                        'width' => 110,
                        'height' => 30,
                    ),
                    'cart'=>array(
                        'class'=>'application.actions.frontend.CartAction',
                    ),
                )
            );
        }
    }