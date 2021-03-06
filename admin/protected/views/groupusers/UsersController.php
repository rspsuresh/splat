﻿<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view', 'create', 'ccreate','update', 'admin','delete',
                    'unauthorized','dynamiccourses','cadmin'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    protected function beforeAction($action)
    {
        //echo "efwer";die;
        $action=$action->id;
        if(Yii::app()->user->getState('role') != "Superuser")
        {
            $resaction=array('index','view','create','update','admin','delete','cadmin');
            if (in_array($action, $resaction))
            {
                $this->redirect('unauthorized');
            }
        }
         return true;
        //return parent::beforeAction($action);
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$model->created_date = date('Y-m-d H:i:s');
			$model->updated_date = date('Y-m-d H:i:s');
			
            if($model->save(false))
            {
				foreach($_POST['Users']['fac_id'] as $fac_id){
					$UserFaculties = new UserFaculties();
					$UserFaculties->user_id = $model->id;
					$UserFaculties->faculty_id = $fac_id;
					$UserFaculties->save();
				}
				
				foreach($_POST['Users']['course_id'] as $course_id){
					$UserCourses = new UserCourses();
					$UserCourses->user_id = $model->id;
					$UserCourses->course_id = $course_id;
					$UserCourses->save();
				}
				
				$to = $model->email;
				//$to ='suresh@businessgateways.com';
				$course_name = $model->courses->name;
				$url = 'http://splat.bournemouth.ac.uk/site/login';
				
				$subject = "SPLAT User Registration";

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: SPLAT – Bournemouth University <lsivakumar@bournemouth.ac.uk>' . "\r\n";
				
				$message = 'Dear '.$model->first_name.'<br/><br/>You have been added to the SPLAT website. Now you can login to assess your peers for the Course: '.$course_name.'<br/><br/>Your credentials are:<br/>
				Website: '.$url.'<br/>
				Username: '.$to.'<br/>
				Password: '.$model->password;

				mail($to,$subject,$message,$headers);
                Yii::app()->user->setFlash('success','A new user has been created.');
                $this->redirect(array('admin'));
            }		
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionCCreate()
	{
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$model->created_date = date('Y-m-d H:i:s');
			$model->updated_date = date('Y-m-d H:i:s');
			$model->role = '5';
			
            if($model->save(false))
            {
				$UserFaculties = new UserFaculties();
				$UserFaculties->user_id = $model->id;
				$UserFaculties->faculty_id = base64_decode($_GET['f']);
				
				$UserCourses = new UserCourses();
				$UserCourses->user_id = $model->id;
				$UserCourses->course_id = base64_decode($_GET['c']);
				$UserCourses->save();
				
				$to = $model->email;
				//$to ='suresh@businessgateways.com';
				$course_name = $UserCourses->course->name;
				$url = 'http://splat.bournemouth.ac.uk/site/login';
				
				$subject = "SPLAT User Registration";

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: SPLAT – Bournemouth University <lsivakumar@bournemouth.ac.uk>' . "\r\n";
				
				$message = 'Dear '.$model->first_name.'<br/><br/>You have been added to the SPLAT website. Now you can login to assess your peers for the Course: '.$course_name.'<br/><br/>Your credentials are:<br/>
				Website: '.$url.'<br/>
				Username: '.$to.'<br/>
				Password: '.$model->password;

				mail($to,$subject,$message,$headers);
                Yii::app()->user->setFlash('success','A new user has been created.');
                $this->redirect(Yii::app()->createUrl('users/cadmin',array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'])));
            }		
		}

		$this->render('ccreate',array(
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

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$model->updated_date = date('Y-m-d H:i:s');
			if($model->save()) {
				$UserFaculties = UserFaculties::model()->findAll('user_id='.$model->id);
				$UserCourses = UserCourses::model()->findAll('user_id='.$model->id);
				foreach($UserFaculties as $faculties){
					$faculties->delete();
				}
				foreach($UserCourses as $courses){
					$courses->delete();
				}
				foreach($_POST['Users']['fac_id'] as $fac_id){
					$UserFaculties = new UserFaculties();
					$UserFaculties->user_id = $model->id;
					$UserFaculties->faculty_id = $fac_id;
					$UserFaculties->save();
				}
				foreach($_POST['Users']['course_id'] as $course_id){
					$UserCourses = new UserCourses();
					$UserCourses->user_id = $model->id;
					$UserCourses->course_id = $course_id;
					$UserCourses->save();
				}
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
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionCAdmin($c)
	{
	    $this->pageTitle = "SPLAT-Course admin";
		$model=new UserCourses('search');
		$model->unsetAttributes();  // clear any default values
		$model->course_id = base64_decode($c);
		if(isset($_GET['UserCourses']))
			$model->attributes=$_GET['UserCourses'];

		$this->render('cadmin',array('model'=>$model));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionDynamiccourses()
	{
		if(isset($_POST['Users']['fac_id']) && count($_POST['Users']['fac_id'])>0) {
			$faculties = implode(',',$_POST['Users']['fac_id']);
			$data =	Courses::model()->findAll('faculty in ('.$faculties.')');
			$data = CHtml::listData($data,'id','name');
			foreach($data as $value=>$name)
			{
				echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
			}
		}
	}
}