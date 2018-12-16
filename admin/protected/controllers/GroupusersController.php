<?php

class GroupusersController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update', 'admin','delete',
                    'projectgroups','groupasses','viewusers','deleteasses','unlockusers','usercheck','download'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new GroupUsers;
        $model->group_id = $_GET['id'];
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['GroupUsers']))
        {
            foreach($_POST['GroupUsers']['user_id'] as $val)
            {
                $GroupUsers = GroupUsers::model()->findAll('group_id='.$_GET['id'].' and user_id='.$val);
                if(count($GroupUsers)<=0){
                    $model=new GroupUsers;
                    $model->user_id=$val;
                    $model->group_id=$_GET['id'];
                    $model->status = 'active';
                    $model->created_date = date('Y-m-d H:i:s');
                    $model->updated_date = date('Y-m-d H:i:s');
                    $model->save();

                }
            }
            $this->redirect(Yii::app()->createUrl('groupusers/admin',array('id'=>$_GET['id'],'c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i'])));

        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['GroupUsers']))
        {
            $model->attributes=$_POST['GroupUsers'];			$model->updated_date = date('Y-m-d H:i:s');
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        //$this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('GroupUsers');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin($id)
    {
        $model=new GroupUsers('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['GroupUsers']))
            $model->attributes=$_GET['GroupUsers'];
        $model->group_id = $id;
        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function actionProjectgroups($id)
    {
        //$asses=Assess::model()->deleteAll("(from_user=2 or to_user=2) and project=1 and grp_id=".$grp);
        $model=new GroupUsers;
        $this->pageTitle="SPLAT - Group users";
        $model->group_id = $_GET['id'];
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $grpmodel=new Groups('search');
        $grpmodel->unsetAttributes();  // clear any default values
        if(isset($_GET['Groups']))
            $grpmodel->attributes=$_GET['Groups'];
        $assesmodel=new Multipleassesment('search');
        $assesmodel->unsetAttributes();  // clear any default values
        if(isset($_GET['Multipleassesment']))
            $grpmodel->attributes=$_GET['Multipleassesment'];

        if(isset($_POST['GroupUsers']))
        {
            foreach($_POST['GroupUsers']['user_id'] as $val)
            {
                $GroupUsers = GroupUsers::model()->findAll('group_id='.$_GET['id'].' and user_id='.$val);
                if(count($GroupUsers)<=0){
                    $model=new GroupUsers;
                    $model->user_id=$val;
                    $model->group_id=$_POST['GroupUsers']['group_id'];
                    $model->status = 'active';
                    $model->created_date = date('Y-m-d H:i:s');
                    $model->updated_date = date('Y-m-d H:i:s');
                    $model->save();

                }
            }
            Yii::app()->user->setFlash('success','Student(s) has been assigned to the group.');
            $this->refresh();
            //$this->redirect(Yii::app()->createUrl('groupusers/admin',array('id'=>$_GET['id'],'c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i'])));

        }

        $this->render('projectadmin',array(
            'model'=>$model,'grpmodel'=>$grpmodel,'assesmodel'=>$assesmodel
        ));
    }

    public function actionDownload()
    {
        //$val['Username']="dhamuace@gmail.com";
        //$users = Users::model()->find('(username="'.$val['Username'].'" or email="'.$val['Username'].'") and status="active"');
        $projectassesment=Multipleassesment::model()->findAll(array('condition'=>'prj_id='.$_GET['p'],'order'=>'due_date asc'));
        //echo "<pre>";print_r($projectassesment);die;
        $test="";
        $html='<table id="resulttable" class="table" border = \'1\'>
<tr><th scope="col">Username</th>';
        for($i=1;$i<=count($projectassesment);$i++)
        {
            $html.='<th>Assessment '.$i .' Points Grade</th>';
        }
        $html.='<th>End-of-Line Indicator</th></tr>';
        $html.="<tbody>";
        $projectgrp=ProjectGroups::model()->findAll(array('condition'=>'project_id='.$_GET['p'],'order'=>'id asc'));
        if(!empty($projectgrp))
        {
            foreach($projectgrp as $key =>$prval)
            {
                $sql="SELECT A.*,B.first_name,B.last_name,B.username,B.id as userid, C.project_id  FROM `group_users` 
                  as A left join users as B on B.id=A.user_id
                   left join project_groups as C on A.group_id=C.group_id WHERE A.`group_id` ={$prval['group_id']} and B.status='active'";
                $usermodel=Yii::app()->db->Createcommand($sql)->QueryAll();



                $courseid=base64_decode($_GET['c']);
                $sqldcque="SELECT GROUP_CONCAT(question_id) as question 
         FROM `delete_custom_question` WHERE `course_id` =$courseid";
                $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
                $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';
                $questions=Questions::model()->findAll('institution='.base64_decode($_GET['i']).'
            and faculty='.base64_decode($_GET['f']).'
             and course='.base64_decode($_GET['c']).' and status="active" and id NOT IN ('.$ids.') 
             or ( type="default" and id NOT IN ('.$ids.')) and q_type="R"');


                $dividedcount=count($questions);

                foreach($usermodel as $key =>$val)
                {
                    $test.="<td>".$val['username']."</td>";
                    for($i=0;$i<count($projectassesment);$i++)
                    {
                        $resultsql="SELECT sum(value) as total FROM `assess` 
                 left join questions on assess.question=questions.id
                  where to_user={$val['user_id']} and (value !='' and value !=0) 
                  and questions.q_type='R' and  questions.status='active' 
                  and assess.project={$_GET["p"]} and assess.grp_id={$prval['group_id']}
                  and  assess.asses_id={$projectassesment[$i]["id"]}  order by assess.question asc";
                        $sumresult=Yii::app()->db->Createcommand($resultsql)->QueryAll();
                        // echo $resultsql."<pre>";
                        $rowfind="SELECT * FROM `assess` left join questions on assess.question=questions.id
                  where to_user={$val['user_id']} and (value !='' and value !=0) 
                  and questions.q_type='R' and  questions.status='active' 
                  and  assess.asses_id={$projectassesment[$i]["id"]}  
                  and assess.project={$_GET["p"]} and assess.grp_id={$prval['group_id']}
                  group by assess.from_user order by assess.question asc";

                        $rowfindresult=Yii::app()->db->Createcommand($rowfind)->QueryAll();


                        if(count($rowfindresult) >0)
                        {

                            $assesvaluebyquestion=($sumresult[0]['total'])/($dividedcount);
                            $asses=($assesvaluebyquestion)/count($rowfindresult);
                            $valuecheck=(!empty($asses))?$asses:'#';
                            $test.='<td aligh="left">'.round($valuecheck, 2).'</td>';

                        }
                        else
                        {
                            $test.='<td>#</td>';
                        }

                    }
                    $test.='<td>#</td>';
                    $html.="<tr>".$test."</tr>";
                    $test="";

                }
            }

        }

        $html.='</table>';

        /*   $file="Export scores template.csv";
           header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
           header("Content-type: text/csv");
           header("Content-Disposition: attachment; filename=\"$file\"");
           header("Expires: 0");*/
        echo $html;die;
    }
    public function actiongroupasses($id)
    {
        $this->pageTitle="SPLAT - Assessment";
        $this->render('assesment_groups');
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return GroupUsers the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=GroupUsers::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param GroupUsers $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='group-users-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public  function actionViewusers($id)
    {
        if($id)
        {
            $sql="SELECT A.*,B.first_name,B.last_name,B.id as userid, C.project_id  FROM `group_users` 
                  as A left join users as B on B.id=A.user_id
                   left join project_groups as C on A.group_id=C.group_id WHERE A.`group_id` ='".$id."' and B.status='active'";
            $model=Yii::app()->db->Createcommand($sql)->QueryAll();
            $this->renderPartial('viewusers',array('model'=>$model),false,true);
        }
    }

    public function  actionEditasses($id)
    {
        $model=Multipleassesment::model()->findByPk($id);
        $this->renderPartial('/multipleassesment/editasses',array('model'=>$model),false,true);
    }
    public function actionunlockusers()
    {
        if($_POST)
        {
            $userid=$_POST['userid'];
            $pid=$_POST['project'];
            $grp=$_POST['grpid'];


            $grp=GroupUsers::model()->deleteAll("user_id=".$userid." and group_id=".$grp);
            $asses=Assess::model()->deleteAll("(from_user=".$userid." or to_user=".$userid.") and project=".$pid." and grp_id=".$grp);
            if($asses || $grp)
            {
                echo "Y";
            }
            else{
                echo "N";
            }
            die;
        }
    }
    public function actionDeleteasses($id)
    {
        if($_POST)
        {
            $masses=Multipleassesment::model()->findByPk($id);
            if($masses->delete())
            {
                $result['status']='Y';
            }
            else
            {
                $result['status']='N';
            }
        }
        echo json_encode($result);die;
    }
    public function actionUsercheck()
    {
        if($_POST)
        {
            $usercheck=Users::model()->findByAttributes(array("username"=>$_POST['emailid']));
            if($usercheck)
            {
                $result['firstname']=$usercheck->first_name;
                $result['lastname']=$usercheck->last_name;
                $result['password']=$usercheck->password;
                $result['status']="Y";
            }
            else{
                $result['status']="N";
            }
        }
        echo json_encode($result);die;
    }
}
