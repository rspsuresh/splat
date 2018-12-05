<?php

/**
 * This is the model class for table "institution_user".
 *
 * The followings are the available columns in table 'institution_user':
 * @property integer $id
 * @property integer $user_id
 * @property integer $institution
 * @property integer $faculty
 * @property integer $course
 * @property integer $g_id
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Courses $course0
 * @property Faculties $faculty0
 * @property Institutions $institution0
 */
class Mapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'institution_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, institution, faculty, course, g_id', 'required'),
			array('institution, faculty, course, g_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, institution, faculty, course, g_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'course0' => array(self::BELONGS_TO, 'Courses', 'course'),
			'faculty0' => array(self::BELONGS_TO, 'Faculties', 'faculty'),
			'institution0' => array(self::BELONGS_TO, 'Institutions', 'institution'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'institution' => 'Institution',
			'faculty' => 'Faculty',
			'course' => 'Course',
			'g_id' => 'G',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('institution',$this->institution);
		$criteria->compare('faculty',$this->faculty);
		$criteria->compare('course',$this->course);
		$criteria->compare('g_id',$this->g_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
