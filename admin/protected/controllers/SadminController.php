<?php

class SadminController extends Controller
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
                'actions'=>array('create','update','unauthorized'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    protected function beforeAction($action)
    {
        $action=$action->id;
        if(Yii::app()->user->getState('role') != "Superuser")
        {
            $resaction=array('index','view','create','update','admin','delete');
            if (in_array($action, $resaction))
            {
                $this->redirect('unauthorized');
            }
        }

        return parent::beforeAction($action);
    }
    public function actionUnauthorized()
    {
        if(isset(Yii::app()->user->id))
        {
            $this->render('unauthorized');
        }
        else
        {
            $this->redirect('login');
        }
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
        $model=new Sadmin;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Sadmin']))
        {
            $model->attributes=$_POST['Sadmin'];
            /*$model->ins_id=$_POST['Sadmin']['ins_id'];
            $model->fac_id=$_POST['Sadmin']['fac_id'];
            $model->course_id=$_POST['Sadmin']['course_id'];*/
            $model->created_date= date('Y-m-d H:i:s');
            $model->updated_date= date('Y-m-d H:i:s');
            if($model->save())
            {
                Yii::app()->user->setFlash('success','Admin has been added successfully.');
                $this->redirect(array('admin'));
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

        if(isset($_POST['Sadmin']))
        {
            $model->attributes=$_POST['Sadmin'];
            $model->created_date= date('Y-m-d H:i:s');
            $model->updated_date= date('Y-m-d H:i:s');
            if($model->save())
            {
                Yii::app()->user->setFlash('success','Admin has been updated successfully.');
                $this->redirect(array('admin'));
            }

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
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Admin has been deleted successfully.');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Sadmin');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Sadmin('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Sadmin']))
            $model->attributes=$_GET['Sadmin'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Sadmin the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Sadmin::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Sadmin $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='sadmin-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
