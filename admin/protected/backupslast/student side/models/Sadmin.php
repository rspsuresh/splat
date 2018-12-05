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
class Sadmin extends CActiveRecord
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
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password,ins_id,fac_id,course_id,name,role', 'required'),
			array('username, password, name', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, name,role,status,ins_id,fac_id,course_id,created_date, updated_date', 'safe', 'on'=>'search'),
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
            'role' => array(self::BELONGS_TO, 'Userrole', 'role'),
            'courses' => array(self::BELONGS_TO, 'Courses', 'course_id'),
            'faculties' => array(self::BELONGS_TO, 'Faculties', 'fac_id'),
            'institution' => array(self::BELONGS_TO, 'Institutions', 'ins_id'),
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
			'fac_id'=>'Faculty',
            'ins_id'=>'Institution',
			'course_id'=>'Course',
			'name' => 'Name',
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
        //$criteria->with = array('userrole');
		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
        $criteria->compare('role',$this->role,true);
        $criteria->compare('ins_id',$this->ins_id,true);
        $criteria->compare('fac_id',$this->fac_id,true);
        $criteria->compare('course_id',$this->course_id,true);
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
	 * @return Sadmin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function getStatusOptions() {
        return array(
            self::Superadmin => 'Superuser',
            self::Faculty => 'Faculty',
            self::staff => 'Staff',
            self::admin => 'Admin/Uniadmin',
        );
    }
	public function getrole()
    {
      if($this['role']==1)
      {
         return "Superadmin";
      }
      else if($this['role']==2)
      {
          return "Faculty";
      }
      else if($this['role']==3)
      {
          return "Staff";
      }
      else
      {
          return "Admin/Uniadmin";
      }
     }
}
