<?php

/**
 * This is the model class for table "assess".
 *
 * The followings are the available columns in table 'assess':
 * @property integer $id
 * @property integer $question
 * @property integer $from_user
 * @property integer $to_user
 * @property integer $project
 * @property integer $value
 *
 * The followings are the available model relations:
 * @property Users $fromUser
 * @property Projects $project0
 * @property Questions $question0
 * @property Users $toUser
 */
class Assess extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'assess';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question, from_user, to_user, project', 'required'),
			array('question, from_user, to_user, project', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, question, from_user, to_user,project,grp_id, value', 'safe', 'on'=>'search'),
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
			'fromUser' => array(self::BELONGS_TO, 'Users', 'from_user'),
			'project0' => array(self::BELONGS_TO, 'Projects', 'project'),
			'question0' => array(self::BELONGS_TO, 'Questions', 'question'),
			'toUser' => array(self::BELONGS_TO, 'Users', 'to_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question' => 'Question',
			'from_user' => 'From User',
			'to_user' => 'To User',
			'project' => 'Project',
			'value' => 'Value',
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
		$criteria->compare('question',$this->question);
		$criteria->compare('from_user',$this->from_user);
		$criteria->compare('to_user',$this->to_user);
		$criteria->compare('project',$this->project);
		$criteria->compare('value',$this->value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Assess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
