<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $first_name
 * @property string $second_name
 * @property string $login
 * @property string $password
 */
class User extends CActiveRecord
{
	public $passwordValue = '';

	const ADMIN_LOGIN = 'admin';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, second_name, login, password', 'required'),
			array('first_name, second_name, login, password', 'length', 'max'=>255),
			['login', 'unique'],
			['passwordValue', 'required', 'on' => 'create'],
			// ['passwordValue', 'match', 'pattern' => '^(?=.*[a-zA-Z])(?=.*[0-9]).{5,}$'],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, second_name, login', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'Имя',
			'second_name' => 'Фамилия',
			'login' => 'Логин',
			'password' => 'Пароль',
			'passwordValue' => 'Пароль',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('second_name',$this->second_name,true);
		$criteria->compare('login',$this->login,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeValidate()
	{
		if (!empty($this->passwordValue)) {
			$this->password = CPasswordHelper::hashPassword($this->passwordValue);
		}
		return parent::beforeValidate();
	}
}
