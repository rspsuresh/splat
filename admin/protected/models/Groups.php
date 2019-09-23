<?php

/**
 * This is the model class for table "groups".
 *
 * The followings are the available columns in table 'groups':
 * @property integer $id
 * @property string $name
 * @property string $status
 * @property string $created_date
 * @property string $updated_date
 */
class Groups extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'groups';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, created_date, updated_date', 'required'),
            array('name', 'length', 'max'=>255),
            array('status', 'length', 'max'=>8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, status, created_date, updated_date', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'usersgrps'=>array(self::HAS_MANY, GroupUsers::class, 'group_id'),
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
        if(isset($_GET['p']) && !empty($_GET['p']))
        {
            $sql="SELECT GROUP_CONCAT(group_id) as grp FROM `project_groups` where project_id='".$_GET['p']."'";
            $result=Yii::app()->db->createCommand($sql)->queryAll();
            $grp=$result[0]['grp'];
            if($grp)
            {
                $criteria->addCondition("id in(".$grp.")");
            }
            else{
                $criteria->addCondition("id in(0)");
            }
        }
        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('updated_date',$this->updated_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            /*'pagination' => array(
                'pageSize' => 2,
            ),*/
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Groups the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public static function ActionButtons($data) {


        $buttons= "<td class='button-column'><a href=\"#\" id='$data->id' data-grp='$data->name' onclick='openmodel($data->id)' class=\"btn btn-info btn-sm\">
          <span class=\"glyphicon glyphicon-eye-open\"></span> View
        </a></td>";
        $buttons.="<td class='button-column'>";
        $buttons .= CHtml::link('<img src="/admin/assets/f0f2f69/gridview/update.png" alt="Update">',
            Yii::app()->createUrl("groups/update",array('id'=>$data->id,'c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'])));

        $buttons .= CHtml::link('<img src="/admin/assets/f0f2f69/gridview/delete.png" alt="Delete">',
            Yii::app()->createUrl("groups/delete",array('id'=>$data->id,'c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'])),array('class'=>'linkClass','onclick'=>'return deletegroup()'));
        $buttons.="</td>";
        echo $buttons;

    }

    public static function Viewusers($data)
    {
        return "<td class='button-column'><a href=\"#\" id='$data->id' data-grp='$data->name' onclick='openmodel($data->id)' class=\"btn btn-info btn-sm\">
          <span class=\"glyphicon glyphicon-eye-open\"></span> View
        </a></td>";
    }
    public static function Actionbuttonsgroups($data)
    {

       /* $buttons='<div class="btn-group">
                <a href=\"#\" id=\'$data->id\' data-grp=\'$data->name\' onclick=\'openmodel($data->id)\' class=\"btn btn-info btn-sm\">
                <button type="button" class="btn btn-primary fa fa-eye">View</button>
                </a>
                <a href="'.Yii::app()->CreateUrl("groups/update",array('id'=>$data->id,'c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>$_GET['p'])).'" >
                <button type="button" class="btn btn-warning fa fa-edit"> Edit</button></a> 
                <a onclick="deletegroup('.$data->id.')">
                <button type="button" class="btn btn-danger fa fa-trash"> Delete</button></a>
                </div>';*/

        $buttons= "<div class='btn-group'>
         <a href=\"#\" id='$data->id' data-grp='$data->name' onclick='openmodel($data->id)'>
          <button type=\"button\" class=\"btn btn-info fa fa-eye\"> View</button>
        </a>";
        $buttons .= '<a href="'.Yii::app()->CreateUrl("groups/update",array('id'=>$data->id,'c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>$_GET['p'])).'" >
                    <button type="button" class="btn btn-warning fa fa-edit"> Edit</button></a>  ';
        $buttons .= '<a onclick="deletegroup('.$data->id.')">
        <button type="button" class="btn btn-danger fa fa-trash"> Delete</button></a>';
        //$buttons .= '<a data-group="'.$data->id.'" class="download"><button type="button" class="btn btn-success fa fa-download"> Download</button></a>';
        $buttons.="</div>";
        echo $buttons;
    }


}
