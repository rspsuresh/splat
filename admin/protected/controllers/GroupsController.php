<?php

class GroupsController extends Controller
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
            //'postOnly + delete', // we only allow deletion via POST request
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
                'actions'=>array('create','update', 'admin', 'delete','deletegroup'),
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
        $model=new Groups;
        $model->course_id = base64_decode($_GET['c']);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['Groups']))
        {
            //print_r($_POST);die;
            $model->attributes=$_POST['Groups'];
            $model->course_id=base64_decode($_GET['c']);
            $model->created_date = date('Y-m-d H:i:s');
            $model->updated_date = date('Y-m-d H:i:s');
            if($model->save()) {
                $projectGroups = new ProjectGroups();
                $projectGroups->project_id 	= $_GET['p'];
                $projectGroups->group_id 	= $model->id;
                if($projectGroups->save())
                {
                    Yii::app()->user->setFlash('success','Group has been added successfully.');
                    $this->redirect(array('groupusers/projectgroups',"id"=>$_GET['p'],'c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>$_GET['p']));
                }
                else
                {
                    print_r($projectGroups->getErrors());die;
                }
                $this->refresh();
            }
            else
            {
                print_r($model->getErrors());die;
            }
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

        if(isset($_POST['Groups']))
        {
            $model->attributes=$_POST['Groups'];
            $model->updated_date = date('Y-m-d H:i:s');
            if($model->save('false'))
                /*$this->redirect(Yii::app()->createUrl('site/courseItems',
                    array('c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i'])));*/
                Yii::app()->user->setFlash('success','Group has been updated successfully.');
            $this->redirect(array('groupusers/projectgroups',"id"=>$_GET['p'],'c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>$_GET['p']));
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
        $model=Groups::model()->findByPk($id)->delete();
        $asses=Assess::model()->deleteAll("grp_id=".$id);
        $grpusers=GroupUsers::model()->deleteAll("group_id=".$id);
        $prjgrp=ProjectGroups::model()->deleteAll("group_id=".$id);
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    public function actionDeletegroup($id)
    {
        $model=Groups::model()->findByPk($id)->delete();
        $asses=Assess::model()->deleteAll("grp_id=".$id);
        $grpusers=GroupUsers::model()->deleteAll("group_id=".$id);
        $prjgrp=ProjectGroups::model()->deleteAll("group_id=".$id);
        echo "S";die;
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Groups');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Groups('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Groups']))
            $model->attributes=$_GET['Groups'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Groups the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Groups::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Groups $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='groups-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
