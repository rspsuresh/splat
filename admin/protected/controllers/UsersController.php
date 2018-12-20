<?php
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
                    'unauthorized','dynamiccourses','cadmin','download','deletemultiple'),
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
            $resaction=array('index','view','admin');
            if (in_array($action, $resaction))
            {
                $this->redirect('unauthorized');
            }
        }
        //return true;
        return parent::beforeAction($action);
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
        $this->performAjaxValidation($model);
        if(isset($_POST['Users']))
        {
            //print_r($_POST);die;
            $checkuser=Users::model()->findByAttributes(array('username'=>trim($_POST['Users']['username'])));
            if(empty($checkuser)) {
                $model->attributes = $_POST['Users'];
                $model->first_name=ucfirst($_POST['Users']['first_name']);
                $model->last_name=ucfirst($_POST['Users']['last_name']);
                $model->email=$_POST['Users']['email'];
                $model->password=$this->randompassword();
                //$model->password=trim($_POST['Users']['password']);
                $model->created_date = date('Y-m-d H:i:s');
                $model->updated_date = date('Y-m-d H:i:s');
                $model->role=$_POST['Users']['role'];
                if($_POST['Users']['role'] ==3 || $_POST['Users']['role'] ==5 )
                {
                    if(!empty($_POST['Users']['fac_id']))
                    {
                        $model->fac_id=implode(",",$_POST['Users']['fac_id']);
                    }
                    if(!empty($_POST['Users']['course_id']))
                    {
                        $model->course_id=implode(",",$_POST['Users']['course_id']);
                    }
                }
                $course = array();
                $faculties = array();
                if ($model->save(false)) {
                    foreach ($_POST['Users']['fac_id'] as $fac_id) {
                        $UserFaculties = new UserFaculties();
                        $UserFaculties->user_id = $model->id;
                        $UserFaculties->faculty_id = $fac_id;
                        $UserFaculties->save();
                        $fac = Faculties::model()->findByPk($UserFaculties->faculty_id);
                        $faculties[] = "- " . $fac->name."\n";
                    }
                    foreach ($_POST['Users']['course_id'] as $course_id) {
                        $UserCourses = new UserCourses();
                        $UserCourses->user_id = $model->id;
                        $UserCourses->course_id = $course_id;
                        $UserCourses->save();
                        $courses = Courses::model()->findByPk($UserCourses->course_id);
                        $course[] = "- " . $courses->name;
                    }
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: SPLAT – Bournemouth University <lsivakumar@bournemouth.ac.uk>' . "\r\n";
                    $url = Yii::app()->createAbsoluteUrl("site/login");
                    $to = trim($model->username);
                    if ($model->role == 3) {
                        $subject = "SPLAT Staff Registration";
                        $crs = implode('\n', $course);
                        $fac = implode('\n', $faculties);
                        $message = "<p>Dear $model->first_name $model->last_name
                              </p><p>You have been granted <b>Staff</b> rights to the Bournemouth University SPLAT website</p>
                              <p><b>Allocated Faculties</b></p>
                              <p>$fac</p>
                              <p><b>Allocated Course</b></p>
                              <p>$crs</p>
                              <p>Your Credentials are</p>
                              <p>Username :$model->username</p>
                              <p>Paswword :$model->password</p>
                              <p>Link to the site:<a href='$url'> $url</a></p>";
                    } else if ($model->role == 1) {
                        $subject = "SPLAT Admin Registration";
                        $message = "<p>Dear $model->first_name $model->last_name
                              </p><p>You have been granted admin rights for the Bournemouth University SPLAT website.</p>
                              <p>Your Credentials are as follows</p>
                              <p>Username :$model->username</p>
                              <p>Paswword :$model->password</p>
                              <p>Link to the site:<a href='$url'>$url</a></p>";
                    } else if ($model->role == 5) {
                        $studenturl = $_SERVER['SERVER_NAME']."/site/login";
                        $subject = "SPLAT Student Registration";
                        $crs = implode(',', $course);
                        $fac = implode(',', $faculties);
                        $coursereplace=str_replace("-","",$crs);
                        $message = "<p>Dear $model->first_name $model->last_name
                              </p><p>You have been granted student rights for the Bournemouth University
                                SPLAT website for the course $coursereplace . You can now login to assess your peers..</p>
                              <!--<p><b>Allocated Course</b></p>
                              <p>$crs</p>-->
                              <p>Your Credentials are</p>
                              <p>Username :$model->username</p>
                              <p>Paswword :$model->password</p>
                              <p>Link to the site:<a href='$studenturl'>$studenturl</a></p>";
                    }
                    mail($to, $subject, $message, $headers);
                    Yii::app()->user->setFlash('success', 'A new user has been created.');
                }
                else
                {
                    print_r($model->getErrors());die;
                }

            }
            else {
                Yii::app()->user->setFlash('error', 'User already exists');
            }
            $this->redirect(array('admin'));
        }


        $this->render('create',array(
            'model'=>$model,
        ));
    }

    public function actionCCreate()
    {
        /*$fmodel=Users::model()->findAll();
        echo "<pre>";print_r($fmodel);die;*/
        /*$dmodel=Users::model()->findByPk(139);
        $dmodel->delete();*/
        $model=new Users;
        $this->pageTitle="Splat - User create";
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if(isset($_POST['Users']))
        {
            $checkmodel=Users::model()->findByAttributes(array('username'=>$_POST['Users']['username'],'email'=>$_POST['Users']['email']));
            //print_r($checkmodel);die;
            if(count($checkmodel)==0)
            {
                $model->created_date = date('Y-m-d H:i:s');
                $model->updated_date = date('Y-m-d H:i:s');
                $model->username=trim($_POST['Users']['username']);
                $model->email=$_POST['Users']['email'];
                $model->password=$this->randompassword();
                //$model->password=trim($_POST['Users']['password']);
                $model->first_name=$_POST['Users']['first_name'];
                $model->last_name=$_POST['Users']['last_name'];
                $model->course_id=base64_decode($_GET['c']);
                $model->institution_id=base64_decode($_GET['i']);
                $model->fac_id=base64_decode($_GET['f']);
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
                    $fMsg="A new student has been created";
                    $fstatus="success";
                }

                $to =trim($_POST['Users']['username']);
                $firstname=$_POST['Users']['first_name'];
                $lastname=$_POST['Users']['lastname'];
                $password=$model->password;
                $course_name = $UserCourses->course->name;
                $url = $_SERVER['SERVER_NAME']."/site/login";
                $subject = "SPLAT User Registration";

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: SPLAT – Bournemouth University <lsivakumar@bournemouth.ac.uk>' . "\r\n";

                $message = 'Dear '.$firstname.'<br/><br/>You have been added to the Bournemouth University SPLAT website . Now you can login to assess your peers for the Course: '.$course_name.'<br/><br/>Your credentials are:<br/>
				Link to the site:'.$url.'<br/>
				Username: '.$to.'<br/>
				Password: '.$password;
                mail($to,$subject,$message,$headers);

            }
            else
            {
                $checkfacultiymodel=UserFaculties::model()->find("user_id=".$checkmodel->id." and faculty_id=".base64_decode($_GET['f']));
                if(count($checkfacultiymodel)==0) {
                    $UserFaculties = new UserFaculties();
                    $UserFaculties->user_id = $checkmodel->id;
                    $UserFaculties->faculty_id = base64_decode($_GET['f']);
                    $UserFaculties->save(false);
                }
                $checkcoursemodel=UserCourses::model()->find("user_id=".$checkmodel->id." and course_id=".base64_decode($_GET['c']));
                if(count($checkcoursemodel)==0)
                {
                    $UserCourses = new UserCourses();
                    $UserCourses->user_id = $checkmodel->id;
                    $UserCourses->course_id = base64_decode($_GET['c']);
                    $UserCourses->save(false);
                }
                else{
                    $fMsg="A student already exists with the email";
                    $fstatus="error";
                    Yii::app()->user->setFlash($fstatus,$fMsg);
                    $this->redirect(Yii::app()->createUrl('users/cadmin',array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'])));

                }
            }
            Yii::app()->user->setFlash($fstatus,$fMsg);
            $this->redirect(Yii::app()->createUrl('users/cadmin',array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'])));

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
        $model->scenario="update";
        $this->performAjaxValidation($model);
        if(isset($_POST['Users']))
        {
            $model->attributes=$_POST['Users'];
            $model->email=$_POST['Users']['email'];
            $model->updated_date = date('Y-m-d H:i:s');
            if($_POST['Users']['role'] ==5 ||  $_POST['Users']['role'] ==3)
            {
                $facexpl=implode(",",$_POST['Users']['fac_id']);
                $couexpl=implode(",",$_POST['Users']['course_id'])    ;
                $model->course_id=$couexpl;
                $model->fac_id=$facexpl;
            }

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
                Yii::app()->user->setFlash('success','A user has been updated.');
                //$this->redirect(array('users/cadmin',"c"=>$_GET['c'],"i"=>$_GET['i'],"f"=>$_GET['f']));
                if(Yii::app()->user->getState('role') == "Superuser")
                {
                    $this->redirect(array('users/admin'));
                }
                else{
                    $this->redirect(array('users/cadmin',"c"=>$_GET['c'],"i"=>$_GET['i'],"f"=>$_GET['f']));
                }

            }
        }

        $this->render('update',array(
            'model'=>$model
        ));
    }
    public function randompassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $delete=$this->loadModel($id);
        $delete->status="inactive";
        $delete->update('status');

        $usersmodel=Users::model()->deleteByPk($id);
        $userfaculty=UserFaculties::model()->findAllByAttributes(['user_id' => $id]);
        if($userfaculty)
            UserFaculties::model()->deleteAllByAttributes(['user_id' => $id]);

        $usercourse=UserCourses::model()->findAllByAttributes(['user_id' => $id]);
        if($usercourse)
            UserCourses::model()->deleteAllByAttributes(['user_id' => $id]);

        $insusemodel=InstitutionUser::model()->findAllByAttributes(['user_id'=>$id]);
        if($insusemodel)
            InstitutionUser::model()->deleteAllByAttributes(['user_id'=>$id]);

        $grpusers=GroupUsers::model()->findAllByAttributes(['user_id'=>$id]);
        if($grpusers)
            GroupUsers::model()->deleteAllByAttributes(['user_id'=>$id]);

        $asscomment=AssessComments::model()->findAllByAttributes('from_user=:from or to_user=:touser',[':from'=>$id,':touser'=>$id]);
        if($asscomment)
            AssessComments::model()->deleteAllByAttributes('from_user=:from or to_user=:touser',[':from'=>$id,':touser'=>$id]);

        $ass=Assess::model()->findAllByAttributes('from_user=:from or to_user=:touser',[':from'=>$id,':touser'=>$id]);
        if($ass)
            Assess::model()->deleteAllByAttributes('from_user=:from or to_user=:touser',[':from'=>$id,':touser'=>$id]);

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
        $model=new Users('search');
        $model->unsetAttributes();  // clear any default values
        //$model->course_id = base64_decode($c);
        $savecount=0;
        $unsavecount=0;
        if(isset($_FILES['csv_file'])){
            if(is_uploaded_file($_FILES['csv_file']['tmp_name'])) {
                // echo $_FILES['csv_file']['tmp_name'];die;
                $csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');

                //skip first line
                $header = fgetcsv($csvFile);
                while (($line = fgetcsv($csvFile)) !== FALSE) {
                    $all_rows[] = array_combine($header, $line);
                }
                // echo "<pre>";print_r($all_rows);die;
                if (!empty($all_rows)) {
                    if(isset($all_rows[0]['Username']) && isset($all_rows[0]['Email']) && isset($all_rows[0]['First Name']) && isset($all_rows[0]['Last Name']))
                    {
                        foreach ($all_rows as $key => $val) {
                            //while(($line = fgetcsv($csvFile)) !== FALSE){
                            $users = Users::model()->find("(username='" . $val['Username'] . "' or email='" . $val["Email"] . "') and status='active'");
                            if (count($users) == 0) {
                                $users = new Users();
                                $users->username = str_replace('#', '', $val['Username']);
                                $users->first_name = $val['First Name'];
                                $users->last_name = $val['Last Name'];
                                $users->email = $val['Email'];
                                $users->course_id = base64_decode($_GET['c']);
                                $users->fac_id = base64_decode($_GET['f']);
                                $users->institution_id = base64_decode($_GET['i']);
                                $password = bin2hex(openssl_random_pseudo_bytes(4));
                                $users->password = $password;
                                $users->role = '5';
                                $users->created_date = date('Y-m-d h:i:s');
                                $users->updated_date = date('Y-m-d h:i:s');

                                if ($users->save(false)) {
                                    //echo "ffsdfdsf";die;
                                    $savecount = $savecount + 1;
                                    $UserFaculties = new UserFaculties();
                                    $UserFaculties->user_id = $users->id;
                                    $UserFaculties->faculty_id = base64_decode($_GET['f']);
                                    $UserFaculties->save(false);

                                    $UserCourses = new UserCourses();
                                    $UserCourses->user_id = $users->id;
                                    $UserCourses->course_id = base64_decode($_GET['c']);
                                    $UserCourses->save(false);

                                    //$to = $users->username;
                                    $course_name = $users->courses->name;

                                    $headers = "MIME-Version: 1.0" . "\r\n";
                                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                    $headers .= 'From: SPLAT – Bournemouth University <lsivakumar@bournemouth.ac.uk>' . "\r\n";
                                    $subject = "Splat User registration";
                                    $url = $_SERVER['SERVER_NAME'] . "/site/login";
                                    $to = $users->email;
                                    $message = 'Dear ' . $users->first_name . '<br/><br/>You have been added to the 
                                 Bournemouth University SPLAT website for the course ' . $course_name . '. 
                                 You can now login to assess your peers.<br/><br/>Your credentials are:<br/>
                                 Website: ' . $url . '<br/>
                                 Username: ' . $to . '<br/>
                                 Password: ' . $users->password;
                                    mail($to, $subject, $message, $headers);
                                }
                                else
                                {
                                    echo "<pre>";print_r($users->getErrors());die;
                                }
                            } else {
                                $unsavecount = $unsavecount+1;
                            }
                        }
                        fclose($csvFile);
                        if($savecount >0)
                        {
                            Yii::app()->user->setFlash('success',$savecount."- new users has been created.");
                        }
                        if($unsavecount >0)
                        {
                            Yii::app()->user->setFlash('error',$unsavecount." - Existing users have been assigned to this course.");
                        }

                        $this->refresh();
                    }
                    else
                    {
                        Yii::app()->user->setFlash('error','Fields are not matched.please try after some time');
                    }

                }

            }
        }
        if(isset($_GET['Users']))
            $model->attributes=$_GET['Users'];
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
            //print_r($model);die;
            if($_POST['Users']['role']==1)
            {
                $model->scenario='neglect';
            }
            else
            {
                $model->scenario='normal';
            }

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

    public function actionDownload()
    {
        // Fetch the file info.
        $filePath = Yii::app()->basePath."/../../bulkimport/SPLAT-Bulk import template.csv";
        $name="Splat_Bulk_import.csv";
        if(file_exists($filePath)) {
            Yii::app()->getRequest()->sendFile($name,file_get_contents( $filePath));
        }
        else {
            die('The provided file path is not valid.');
        }

    }
    public function actionDeletemultiple()
    {
        if($_POST && !empty($_POST['id']))
        {
            $sql="update users set status='inactive' where id in (".$_POST['id'].")";
            $result=Yii::app()->db->CreateCommand($sql)->execute();
            if($result)
            {
                $rslt['flag']="S";
            }
            else
            {
                $rslt['flag']="E";
            }
        }
        echo json_encode($rslt,true);
    }
}
