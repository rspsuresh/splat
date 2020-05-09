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
class Users extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public $usertype;
    public $newpassword,$confirmpassword;
    private $fullname;
    public $grp;
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
            array('first_name, last_name,email,course_id, institution_id, fac_id, role', 'required','on'=>'normal'),
            array('first_name,last_name, course_id,fac_id,email', 'required','on'=>'update'),
            array('first_name,last_name,fac_id,email', 'required','on'=>'autoreg'),
            array('institution_id', 'numerical', 'integerOnly'=>true),
            array('first_name,last_name','required','on'=>'edit'),
            array('email','ownvalidation'),
            array('email', 'email','message'=>"The email isn't correct"),
            array('username, password, first_name, last_name,role', 'required','on'=>'negelect'),
            array('username, password, first_name, last_name, profile', 'length', 'max'=>255),
            array('status', 'length', 'max'=>8),
            array('newpassword,confirmpassword', 'required', 'on' => 'changepwd'),
            array('confirmpassword','compare','compareAttribute'=>'newpassword','message'=>'Passwords doesn’t match'),

            // array('username','unique'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, first_name, last_name, profile,send_email, status, created_date, 
            updated_date,email,course_id, institution_id, fac_id, role,grp', 'safe', 'on'=>'search'),
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
            'courses' => array(self::BELONGS_TO, 'Courses', 'course_id'),
            'faculties' => array(self::BELONGS_TO, 'Faculties', 'fac_id'),
            'institution' => array(self::BELONGS_TO, 'Institutions', 'institution_id'),
            'roles' => array(self::BELONGS_TO, 'Userrole', 'role'),
            'course0' => array(self::BELONGS_TO, 'Courses', 'course_id'),
            'faculty0' => array(self::BELONGS_TO, 'Faculties', 'fac_id'),
            'institution0' => array(self::BELONGS_TO, 'Institutions', 'institution_id'),

        );
    }
    public function ownvalidation($attribute_name,$params)
    {
        if(empty($this->email) && empty($this->email))
        {
            $this->addError('email',
                'Email Cannot be blank');
        }else if(!empty($this->email))
        {
            $courseid=base64_decode($_GET['c']);
            $email=trim($this->email);
            $UserCour=UserCourses::model()->with('user')->find("user.email='{$email}' and t.course_id={$courseid}");
            if($UserCour && Yii::app()->controller->action->id =="staffusers")
            {
                $this->addError('email','this staff is already present in this course');
            }
        }
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
            'fac_id' => 'Faculty',
            'role'=> 'Role',
            'newpassword'=>'New password',
            'confirmpassword'=>'Confirm password'
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


        if(isset($_GET['c']) && !empty($_GET['c']))
        {
            $sql="SELECT user_id as user_id FROM `user_courses` 
                  join users on user_courses.user_id=users.id and users.role=5
                  WHERE user_courses.`course_id` = ".base64_decode($_GET["c"]);
            $result=Yii::app()->db->createCommand($sql)->queryAll();
            $uniquesdata=array_unique(array_column($result,'user_id'));
			if(empty($uniquesdata))
			{
				$uniquesdata=0;
			}
			else{
			  $uniquesdata=implode(',',$uniquesdata);	
			}
           
            $users=($result[0]['user_id'])?$result[0]['user_id']:0;
            $criteria->addcondition(' id in(' . $uniquesdata .') and role =5');          // for exact match
			 if(isset($_REQUEST['Users']['course_id']))
        {
            //$criteria->addCondition('course_id LIKE "%'.$this->course_id.'" or "%'.$this->course_id.'%"');
            $criteria->addCondition("`course_id` LIKE '%$this->course_id%'" );

        }
        }
		else
		{
		 $criteria->addCondition('role in(3,1)');
		}
       
        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('email',$this->email,true);
        //$criteria->compare('course_id',$this->course_id);
        $criteria->compare('role',$this->role);
        $criteria->order="FIELD(role,1,3,5)";
        $criteria->addCondition('status="active"');

        if (isset($_GET['pagesize'])) {
            $pagination = $_REQUEST['pagesize'];
            Yii::app()->session['pagination'] = $_GET['pagesize'];
        } else {
            $pagination = yii::app()->session['pagination'];
        }

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => $pagination,
            ),
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
   /*ublic  function fullname()
    {
        $fullname=$this->first_name." ".$this.last_name;
        return $fullname;
    }*/
    public static function courses($id) {
        $return = '';
        $explode = explode(',', $id);
        $query = Courses::model()->findAllByPk($explode);
        $cat = array();
        if ($query) {
            foreach ($query as $value) {
                $level=!empty($value->course_level)? "- Level:".$value->course_level:"";
                $cat[] = $value->course_type."-".$value->name." ".$level;
            }
            $return = implode(',', $cat);
        }
        return $return;
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
