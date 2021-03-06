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
				'actions'=>array('create','update', 'admin','delete','projectgroups'),
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
                    //$GroupUsersgroup = GroupUsers::model()->findAll('user_id='.$val);
                    //if(count($GroupUsersgroup)<=0) {
                        $model=new GroupUsers;
                        $model->user_id=$val;
                        $model->group_id=$_GET['id'];
                        $model->status = 'active';
                        $model->created_date = date('Y-m-d H:i:s');
                        $model->updated_date = date('Y-m-d H:i:s');
                        $model->save();
                   // }
                }
            }
            $this->redirect(Yii::app()->createUrl('groupusers/admin',array('id'=>$_GET['id'],'c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i'])));
			/*$GroupUsers = GroupUsers::model()->findAll('group_id='.$_GET['id'].' and user_id='.$_POST['GroupUsers']['user_id']);
			if(count($GroupUsers)<=0){
				$GroupUsersgroup = GroupUsers::model()->findAll('user_id='.$_POST['GroupUsers']['user_id']);
				if(count($GroupUsersgroup)<=0) {
                    $model=new GroupUsers;
					$model->attributes=$_POST['GroupUsers'];	
					$model->status = 'active';
					$model->created_date = date('Y-m-d H:i:s');
					$model->updated_date = date('Y-m-d H:i:s');
					if($model->save())
						$this->redirect(Yii::app()->createUrl('groupusers/admin',array('id'=>$_GET['id'],'c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i'])));
				} else {
					Yii::app()->user->setFlash('error','User already exists in another group.');
					$this->refresh();
				}
			} else {
				Yii::app()->user->setFlash('error','User already exists.');
				$this->refresh();
			}*/
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
		$model=new ProjectGroups('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProjectGroups']))
			$model->attributes=$_GET['ProjectGroups'];
		$model->project_id = $id;
		$this->render('projectadmin',array(
			'model'=>$model,
		));
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
}
