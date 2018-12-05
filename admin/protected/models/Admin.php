<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $status
 * @property string $created_date
 * @property string $updated_date
 */
class Admin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin1';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public $newpassword;public $confirmpassword;
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, name, created_date, updated_date', 'required'),
			array('username, password, name', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			array('newpassword,confirmpassword','required','on'=>'changepwd'),
			array('newpassword', 'compare', 'compareAttribute'=>'confirmpassword' ,'message'=>"Passwords don't match",'on'=>'changepwd'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username,password, name, status, created_date, updated_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'status' => 'Status',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',			'newpassword' => 'New Password',			'confirmpassword' => 'Confirm Password'
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
