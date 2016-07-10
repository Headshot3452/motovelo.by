<?php
	class OrdersForm extends CFormModel
	{
		public $name;
		public $phone;
		public $email;
		public $id;
		public $title;
		public $price;
		public $discount;

		public function rules()
		{
			return array(
				array('name, phone', 'filter', 'filter' => 'trim'),
				array('name, phone, id, title, price', 'required'),
				array('email', 'email', 'validateIDN' => true),
				array('discount', 'safe'),
			);
		}

		public function attributeLabels()
		{
			return array(
				'name' => 'Ваше имя*',
				'phone' => 'Ваше телефон*',
				'email' => 'E-mail',
				'id' => 'Идентификатор товара',
				'title' => 'Название товара',
				'price' => 'Цена товара',
				'discount' => 'Скидка',
			);
		}
	}