<?php

/**
 * This is the model class for table "courses".
 *
 * The followings are the available columns in table 'courses':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $institution
 * @property integer $faculty
 * @property integer $department
 * @property string $description
 * @property string $status
 * @property integer $created_by
 * @property string $created_date
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property Departments $department0
 * @property Faculties $faculty0
 * @property Institutions $institution0
 * @property CourseTypes $type0
 * @property Projects[] $projects
 */
class Courses extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'courses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, institution, faculty, department, description, created_by, created_date, updated_date', 'required'),
			array('type, institution, faculty, department, created_by', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, type, institution, faculty, department, description, status, created_by, created_date, updated_date', 'safe', 'on'=>'search'),
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
			'department0' => array(self::BELONGS_TO, 'Departments', 'department'),
			'faculty0' => array(self::BELONGS_TO, 'Faculties', 'faculty'),
			'institution0' => array(self::BELONGS_TO, 'Institutions', 'institution'),
			'type0' => array(self::BELONGS_TO, 'CourseTypes', 'type'),
			'projects' => array(self::HAS_MANY, 'Projects', 'course'),
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
			'type' => 'Type',
			'institution' => 'Institution',
			'faculty' => 'Faculty',
			'department' => 'Department',
			'description' => 'Description',
			'status' => 'Status',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('institution',$this->institution);
		$criteria->compare('faculty',$this->faculty);
		$criteria->compare('department',$this->department);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status,true);
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
	 * @return Courses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
