<?php

/**
 * This is the model class for table "projects".
 *
 * The followings are the available columns in table 'projects':
 * @property integer $id
 * @property string $name
 * @property integer $institution
 * @property integer $faculty
 * @property integer $course
 * @property string $description
 * @property string $status
 * @property string $assess_date
 * @property integer $created_by
 * @property string $created_date
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property Courses $course0
 * @property Faculties $faculty0
 * @property Institutions $institution0
 */
class Projects extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, institution, faculty, course, description, assess_date, created_by, created_date, updated_date', 'required'),
			array('institution, faculty, course, created_by', 'numerical', 'integerOnly'=>true),
			array('name, description', 'length', 'max'=>255),
			array('status', 'length', 'max'=>9),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, institution, faculty, course, description, status, assess_date, created_by, created_date, updated_date', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'institution' => 'Institution',
			'faculty' => 'Faculty',
			'course' => 'Course',
			'description' => 'Description',
			'status' => 'Status',
			'assess_date' => 'Assess Date',
			'created_by' => 'Created By',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('institution',$this->institution);
		$criteria->compare('faculty',$this->faculty);
		$criteria->compare('course',$this->course);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('assess_date',$this->assess_date,true);
		$criteria->compare('created_by',$this->created_by);
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
	 * @return Projects the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
