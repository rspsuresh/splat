<?php

class UsersRegistrationController extends Controller
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
				'actions'=>array('index','view','registration','userregistration'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
		$model=new UsersRegistration;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UsersRegistration']))
		{
			$model->attributes=$_POST['UsersRegistration'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['UsersRegistration']))
		{
			$model->attributes=$_POST['UsersRegistration'];
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UsersRegistration');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UsersRegistration('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UsersRegistration']))
			$model->attributes=$_GET['UsersRegistration'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UsersRegistration the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UsersRegistration::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UsersRegistration $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-registration-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionRegistration()
	{
	    $makemodel=new UsersRegistration;
	    if(!empty($_POST['email']))
        {
            $email=$_POST['email'];
            $model=Users::model()->find('username=:username',array(':username'=> $email));
            if(count($model)==0)
            {
                $makemodel->username=$_POST['email'];
                $makemodel->status="inactive";
                $makemodel->save(false);
                Yii::app()->mailsent->sent($_POST['email'],$makemodel->id);
                $msg['msg'] = 'Registration link is sent to mail .please check mail';
                $msg['status'] = 'S';
                echo json_encode($msg, true);
            }
            else
            {
                $msg['msg'] = 'You have already Registered.';
                $msg['status'] = 'A';
                echo json_encode($msg, true);
            }
        }
	}
	public function ActionUserregistration()
    {
        $userid=base64_decode($_GET['user']);
        $model=UsersRegistration::model()->findByPk($userid);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['UsersRegistration']))
        {
            $model->attributes=$_POST['UsersRegistration'];
			$model->created_date = date('Y-m-d H:i:s');
			$model->updated_date = date('Y-m-d H:i:s');
            $uploadedFile=CUploadedFile::getInstance($model,'profile');
            $fileName = $uploadedFile;
            $model->profile = $fileName;
            if($model->save(false))
            {
                $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/images/profile/'.$fileName);
                Yii::app()->user->setFlash('success','Your Registration successfully .');
                $this->redirect(array('site/logout'));
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }
}
