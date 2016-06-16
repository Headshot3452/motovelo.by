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

        public function actionApplication()
        {
            if (isset($_POST['ApplicationForm']))
            {
                $model = new ApplicationForm();
                $model->attributes = $_POST['ApplicationForm'];
                if ($model->validate())
                {
//                    $bodyEmail = $this->renderEmail('contacts', array('model' => $model));
//                    $mail = Yii::app()->mailer->isHtml(true)->setFrom($model->email);
//                    $mail->send($this->settings->email, 'Subject', $bodyEmail);
                }
            }
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