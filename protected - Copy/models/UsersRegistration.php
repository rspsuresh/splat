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
 * @property string $profile
 * @property string $status
 * @property string $created_date
 * @property string $updated_date
 * @property integer $course_id
 * @property integer $institution_id
 * @property integer $fac_id
 *
 * The followings are the available model relations:
 * @property Assess[] $assesses
 * @property Assess[] $assesses1
 * @property AssessComments[] $assessComments
 * @property AssessComments[] $assessComments1
 * @property InstitutionUser[] $institutionUsers
 */
class UsersRegistration extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, first_name, last_name,course_id, institution_id', 'required'),
			array('course_id, institution_id, fac_id', 'numerical', 'integerOnly'=>true),
			array('username, password, first_name, last_name, profile', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, first_name, last_name, profile, status, created_date, updated_date, course_id, institution_id, fac_id', 'safe', 'on'=>'search'),
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
			'assesses' => array(self::HAS_MANY, 'Assess', 'from_user'),
			'assesses1' => array(self::HAS_MANY, 'Assess', 'to_user'),
			'assessComments' => array(self::HAS_MANY, 'AssessComments', 'from_user'),
			'assessComments1' => array(self::HAS_MANY, 'AssessComments', 'to_user'),
			'institutionUsers' => array(self::HAS_MANY, 'InstitutionUser', 'user_id'),
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
			'profile' => 'Profile',
			'status' => 'Status',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'course_id' => 'Course',
			'institution_id' => 'Institution',
			'fac_id' => 'Fac',
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
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('institution_id',$this->institution_id);
		$criteria->compare('fac_id',$this->fac_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersRegistration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
