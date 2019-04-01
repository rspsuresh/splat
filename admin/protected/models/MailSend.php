
<?php



/**

 * This is the model class for table "mail_send".

 *

 * The followings are the available columns in table 'mail_send':


 * @property integer $id


 * @property integer $i_id


 * @property integer $c_id


 * @property integer $as_id


 * @property integer $f_id



 */

class MailSend extends CActiveRecord

{

	/**

	 * @return string the associated database table name

	 */

	public function tableName()

	{

		return 'mail_send';

	}



	/**

	 * @return array validation rules for model attributes.

	 */

	public function rules()

	{

		// NOTE: you should only define rules for those attributes that

		// will receive user inputs.

		return array(


			array('i_id, c_id, as_id, f_id,u_id', 'required'),


			array('i_id, c_id, as_id, f_id,u_id', 'numerical', 'integerOnly'=>true),


			// The following rule is used by search().

			// @todo Please remove those attributes that should not be searched.

			array('id, i_id, c_id, as_id, f_id,u_id', 'safe', 'on'=>'search'),

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


			'i_id' => 'I',


			'c_id' => 'C',


			'as_id' => 'As',


			'f_id' => 'F',


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
		$criteria->compare('i_id',$this->i_id);
		$criteria->compare('c_id',$this->c_id);
		$criteria->compare('as_id',$this->as_id);
		$criteria->compare('f_id',$this->f_id);



		return new CActiveDataProvider($this, array(

			'criteria'=>$criteria,

		));

	}




	/**

	 * Returns the static model of the specified AR class.

	 * Please note that you should have this exact method in all your CActiveRecord descendants!

	 * @param string $className active record class name.

	 * @return MailSend the static model class

	 */

	public static function model($className=__CLASS__)

	{

		return parent::model($className);

	}

}

