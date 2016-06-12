<?php
    class SliderWidget extends StructureWidget
    {
        public $size = 'origin';
        public $view = 'slider';
        public $height = '400px';
        public $id;
        public $count_items = 1;
        protected $_items = array();

        public function setData()
        {
            $model = Slider::model()->notDeleted()->parent($this->id);

            $this->_items=$model->language($this->controller->getCurrentLanguage()->id)->findAll();

            if (empty($this->_items))
            {
                return false;
            }
            return true;
        }

        public function renderContent()
        {
            $this->render(get_class().'/'.$this->view);
        }

        public static function getView()
        {
            return array('main_slider' => 'Слайдер');
        }
    }