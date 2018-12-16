<?php

/**

 * This is the model class for table "multipleassesment".

 *

 * The followings are the available columns in table 'multipleassesment':


 * @property integer $id


 * @property integer $prj_id


 * @property string $due_date


 * @property string $created_date



 */

class Multipleassesment extends CActiveRecord

{

    /**

     * @return string the associated database table name

     */

    public function tableName()

    {

        return 'multipleassesment';

    }



    /**

     * @return array validation rules for model attributes.

     */

    public function rules()

    {

        // NOTE: you should only define rules for those attributes that

        // will receive user inputs.

        return array(


            //array('prj_id, due_date, created_date', 'required'),


            array('prj_id', 'numerical', 'integerOnly'=>true),


            // The following rule is used by search().

            // @todo Please remove those attributes that should not be searched.

            array('id, prj_id, due_date,status, created_date', 'safe', 'on'=>'search'),

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

            'projectasses'=>array(self::BELONGS_TO, 'Projects', 'prj_id'),
            'assmentdate'=>array(self::HAS_MANY, 'Assess', 'asses_id'),

        );

    }



    /**

     * @return array customized attribute labels (name=>label)

     */

    public function attributeLabels()

    {

        return array(


            'id' => 'ID',


            'prj_id' => 'Project',


            'due_date' => 'Due Date',


            'created_date' => 'Created Date',


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
        //$criteria->with('projectasses');
        $criteria->with = array('projectasses');
        $criteria->compare('id',$this->id);
        $criteria->compare('prj_id',$this->prj_id);
        $criteria->addCondition("projectasses.status='current'");
        if(!empty($_GET['p']))
        {
            $criteria->addCondition("prj_id=".$_GET['p']);
        }
        $criteria->compare('due_date',$this->due_date,true);
        $criteria->compare('created_date',$this->created_date,true);



        return new CActiveDataProvider($this, array(

            'criteria'=>$criteria,

        ));

    }
    public static function ActionButtons($id,$row) {

        $statusknw=Multipleassesment::model()->findByPk($id);
        $icon=($statusknw->status =="I")?'<i class="fa fa-times" aria-hidden="true"></i>':'<i class="fa fa-check" aria-hidden="true"></i>';
        $iconview='<i class="fa fa-eye" aria-hidden="true"></i>';
        $icontitle=($statusknw->status =="A")?'Active':'Inactive';
        $status=($statusknw->status =="A")?'btn-success':'btn-danger';
        $complete=($statusknw->status =="A")?'block':'none';
        $action=Yii::app()->createUrl('groupusers/groupasses',array('id'=>$_GET['p'],'c'=>$_GET['c'],
            'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>$_GET['p'],'as'=>$statusknw->id,'key'=>$row));
        $buttons="<td class='button-column'>";
        if($statusknw->status=="I")
        {
            $buttons.="<a href='#' data-status='A' onclick='alternate($id,this)'><button type=\"button\" class=\"btn btn-danger\">Inactive</button></a>
                       <a href='#' onclick='deleteasses($id)'><button type=\"button\" class=\"btn btn-warning\">Delete</button></a>";
        }
        else if($statusknw->status=="A")
        {   $html="<div class=\"dropdown\">
                          <button class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">Active
                          <span class=\"caret\"></span></button>
                          <ul class=\"dropdown-menu\">
                            <li><a href=\"#\">In-active</a></li>
                          </ul>
                  </div>";
            $buttons.="<a href='#' data-status='I' onclick='alternate($id,this)'><button type=\"button\" class=\"btn btn-success present\">Active</button></a>
                       <a href='#' onclick='complete($id)'><button type=\"button\" class=\"btn btn-primary\">Mark as Complete</button></a>
                       <a href='$action' ><button type=\"button\" class=\"btn btn - info\">View</button></a>";
        }
        else if($statusknw->status=="C")
        {
            $buttons.="<a href='$action' ><button type=\"button\" class=\"btn btn-info\">View</button></a>
                       <a href='#' onclick='alternate($id)'><button type=\"button\" class=\"btn btn-danger\">Re activate</button></a>";
        }
        $buttons .= "</td>";
        echo  $buttons;

    }

    /**

     * Returns the static model of the specified AR class.

     * Please note that you should have this exact method in all your CActiveRecord descendants!

     * @param string $className active record class name.

     * @return Multipleassesment the static model class

     */

    public static function model($className=__CLASS__)

    {

        return parent::model($className);

    }
    public function scopes() {
        return array(
            'bystatus' => array('order' => 'status DESC'),
        );
    }

}

