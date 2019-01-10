<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $status
 * @property string $created_date
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property InstitutionUser[] $institutionUsers
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}
    public $newpassword;public $confirmpassword;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, first_name, last_name, created_date, updated_date', 'required'),
			array('password, first_name, last_name', 'length', 'max'=>255),
			array('first_name,last_name','required','on'=>'edit'),
            array('email', 'unique'),
			//array('username', 'email'),
			array('newpassword,confirmpassword','required','on'=>'changepwd'),
			array('newpassword', 'compare', 'compareAttribute'=>'confirmpassword' ,'message'=>"Passwords don't match",'on'=>'changepwd'),
			array('status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, first_name, last_name, status, created_date, updated_date', 'safe', 'on'=>'search'),
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
			'institutionUsers' => array(self::HAS_MANY, 'InstitutionUser', 'user_id'),
			'course0' => array(self::BELONGS_TO, 'Courses', 'course_id'),
			'faculty0' => array(self::BELONGS_TO, 'Faculties', 'fac_id'),
			'institution0' => array(self::BELONGS_TO, 'Institutions', 'institution_id'),
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
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'status' => 'Status',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
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
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function profilepic()
	{
		$users=Users::model()->findByPk(Yii::app()->session['id']);
		if($users->profile=='')
		{
			$path= Yii::$app->basePath . '/image/user.jpg';
		}
		else
		{
			$path= Yii::$app->basePath . '/image/profile/'.$users->profile;
		}
		 echo $path;
		
	}
}
