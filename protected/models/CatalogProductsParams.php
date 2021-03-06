<?php

/**
 * This is the model class for table "catalog_products_params".
 *
 * The followings are the available columns in table 'catalog_products_params':
 * @property integer $id
 * @property integer $product_id
 * @property integer $params_id
 * @property integer $value_id
 *
 * The followings are the available model relations:
 * @property CatalogParamsVal $value
 * @property CatalogProducts $product
 * @property CatalogParams $params
 */
class CatalogProductsParams extends Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'catalog_products_params';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, params_id, value_id', 'required'),
			array('product_id, params_id, value_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, params_id, value_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'value' => array(self::BELONGS_TO, 'CatalogParamsVal', 'value_id'),
			'product' => array(self::BELONGS_TO, 'CatalogProducts', 'product_id'),
			'params' => array(self::BELONGS_TO, 'CatalogParams', 'params_id', 'order' => 'sort'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => Yii::t('app','Product'),
			'params_id' => Yii::t('app','Params'),
			'value_id' => Yii::t('app','Value'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('params_id',$this->params_id);
		$criteria->compare('value_id',$this->value_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatalogProductsParams the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Получения всех значений параметра для текущего продукта
     * @return CActiveRecord[]
     */
    function getParamsValues()
    {
        return self::model()->findAllByAttributes(array('product_id'=>$this->product_id,'params_id'=>$this->params_id));
    }


	/**
	 * Удалят параметры  с ид $params_ids товаров в категориях принадлежащи $category_ids
	 * @param $params_ids - ид параметров которые нужно удалить
	 * @param $category_ids - ид категорий , в которых у товаров нужно удлаить параметры
	 * @return bool
	 * @throws CDbException
	 * @throws CException
	 */

	public static function deleteProductParams($params_ids,$category_ids)
	{
		$model = self::model();
		$table=$model->tableName();
		$table_product = $model->getInstanceRelation('product')->tableName();

		$model->getDbConnection()->createCommand('
            DELETE cpp.* FROM `'.$table.'` as `cpp`
		    INNER JOIN `'.$table_product.'` as `cp` ON cpp.product_id = cp.id
			WHERE cpp.params_id IN ('.implode(', ',$params_ids).') AND cp.parent_id IN ('.implode(', ',$category_ids).') ')->execute();

		return true;
	}

}