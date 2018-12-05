<?php

class GroupmasterController extends Controller
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
				'actions'=>array('create','update','mapping'),
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
		$model=new Groupmaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Groupmaster']))
		{
			$model->attributes=$_POST['Groupmaster'];
			$model->created_by=Yii::app()->user->id;
			if($model->save())
				Yii::app()->user->setFlash('success','Group has been added successfully.');
				$this->redirect(array('admin'));
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

		if(isset($_POST['Groupmaster']))
		{
			$model->attributes=$_POST['Groupmaster'];
			$model->created_by=Yii::app()->user->id;
			if($model->save())
				Yii::app()->user->setFlash('success','Group has been updated successfully.');
				$this->redirect(array('admin'));
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
		$dataProvider=new CActiveDataProvider('Groupmaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Groupmaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Groupmaster']))
			$model->attributes=$_GET['Groupmaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Groupmaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Groupmaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Groupmaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='groupmaster-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMapping()
	
	{
		$model=new InstitutionUser;
		
		if(isset($_POST['InstitutionUser']))
		{   
			$model->attributes=$_POST['InstitutionUser'];
			foreach($_POST['InstitutionUser']['user_id'] as $val)
			{
				$sql='SELECT *  FROM `institution_user` WHERE `user_id` ='.$val.' AND `institution` ='.$_POST['InstitutionUser']['institution'].' AND `faculty` ='.$_POST['InstitutionUser']['faculty'].' AND `course` = '.$_POST['InstitutionUser']['course'].' AND `g_id` ='.$_POST['InstitutionUser']['g_id'].'';
				$list= Yii::app()->db->createCommand($sql)->queryAll();
				if(count($list)==0)
				{
					$model=new InstitutionUser;
					$model->user_id=$val;
					$model->g_id=$_POST['InstitutionUser']['g_id'];
					$model->course=$_POST['InstitutionUser']['course'];
					$model->institution=$_POST['InstitutionUser']['institution'];
					$model->faculty=$_POST['InstitutionUser']['faculty'];
					$model->save();
					
				}
			}
				Yii::app()->user->setFlash('success','Mapping has been updated successfully.');
				$this->redirect(array('admin'));

		}
		
		$this->render('mapping',array(
			'model'=>$model,
		));
		
	}
}
