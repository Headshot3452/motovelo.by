<?php
	class ApplicationForm extends CFormModel
	{
		public $name;
		public $phone;
		public $email;
		public $text;

		public function rules()
		{
			return array(
				array('name, phone', 'filter', 'filter' => 'trim'),
				array('name, phone', 'required'),
				array('text', 'safe'),
				array('email', 'email', 'validateIDN' => true),
				array('email', 'required', 'on' => 'contacts'),
			);
		}

		public function attributeLabels()
		{
			return array(
				'name' => 'Ваше имя',
				'phone' => 'Ваше телефон',
				'email' => 'E-mail',
				'text' => 'Текст сообщения'
			);
		}
	}