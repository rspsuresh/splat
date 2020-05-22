<?php

class SiteController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('login', 'logout', 'forgot'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('index','projects','Assessment','editprofile','namechange','profileimage','edit','leavegroup','assesmentresponse'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $institutionUsers = InstitutionUser::model()->findAll('user_id='.Yii::app()->user->id);
        $this->render('index',
            array(
                'institutionUsers' => $institutionUsers
            )
        );
    }

    public function actionProjects($id)
    {
        $projects = Projects::model()->find('id='.$id);
      //  $institutionUsers = InstitutionUser::model()->findAll('course='.$projects->course);
        $gmodel = new GroupUsers;

        if(isset($_POST['GroupUsers']))
        {
            $GroupUsers = GroupUsers::model()->findAll('group_id='.$_POST['GroupUsers']['group_id'].' and user_id='.$_POST['GroupUsers']['user_id']);
            if(count($GroupUsers)<=0){
                $GroupUsersgroup = GroupUsers::model()->findAll('user_id='.$_POST['GroupUsers']['user_id']);
                if(count($GroupUsersgroup)<=0) {
                    $gmodel->attributes=$_POST['GroupUsers'];
                    $gmodel->created_date = date('Y-m-d H:i:s');
                    $gmodel->updated_date = date('Y-m-d H:i:s');
                    if($gmodel->save())
                        $this->refresh();
                } else {
                    Yii::app()->user->setFlash('error','User already exists in another group.');
                    $this->refresh();
                }
            } else {
                Yii::app()->user->setFlash('error','User already exists.');
                $this->refresh();
            }
        }

        $this->render('project',
            array(
                'projects' => $projects,
               /// 'institutionUsers' => $institutionUsers,
                'gmodel' => $gmodel
            )
        );
    }

    public function actionAssessment($id)
    {


        $projects = Projects::model()->find('id='.$id);
        $institutionUsers = InstitutionUser::model()->findAll('course='.$projects->course);



        $sqldcque="SELECT GROUP_CONCAT(question_id) as question FROM `delete_custom_question` WHERE `course_id` =$projects->course";
        $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
        $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';

        $questions=Questions::model()->findAll('course='.$projects->course.' and status="active" and id NOT IN ('.$ids.')');
        if(isset($_POST['assess'])){
            foreach($_POST['assess'] as $key=>$users){
                foreach($users as $ukey=>$value){
                    $assess = Assess::model()->find('question=:q and project=:p and from_user=:f and to_user=:t and grp_id=:grp',
                        array(':q'=>$key,':p'=>$id,':f'=>Yii::app()->user->id,':t'=>$ukey,':grp'=>$_GET['g']));
                    if(count($assess)>0){
                        $assess->grp_id=$_GET['g'];
                        $assess->value = $value;
                        $assess->save();

                    } else{
                        $assess = new Assess();
                        $assess->grp_id=$_GET['g'];
                        $assess->question = $key;
                        $assess->project = $id;
                        $assess->from_user = Yii::app()->user->id;
                        $assess->to_user = $ukey;
                        $assess->value = $value;
                        $assess->submitted_at=date('Y-m-d H:i:s');
                        $assess->save();
                    }
                }

            }
            $this->assessmentmail($_POST,$projects);
          Yii::app()->user->setFlash('success','Thank you. Your response is submitted.');
            $this->redirect(Yii::app()->createUrl('site/index'));
        }


        $this->render('assessment',
            array(
                'projects' => $projects,
                'institutionUsers' => $institutionUsers,
                'questions' => $questions
            )
        );
    }
    public function assessmentmail($data,$projects){
        if(!empty($data)){
            $user=Users::model()->findByPk(Yii::app()->user->id);
            $grp=$_GET['g'];
            $course=Courses::model()->findByPk($projects->course);
            $grpModel=Groups::model()->findByPk($grp);
            $AsModel=Projects::model()->findByPk($projects->id);

            if(!empty($course) && !empty($grpModel) && !empty($AsModel)){
                $sub_or_update=$data['type']=='update'?'updated':'submitted';
                $to = $user->email;
                $url = 'http://splat.bournemouth.ac.uk/site/login';
                $subject = "SPLAT Feedback";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: SPLAT – Bournemouth University <lsivakumar@bournemouth.ac.uk>' . "\r\n";

                $message = 'Dear '.$user->first_name.',<br/>
					Thank you.Your response has been '.$sub_or_update.'<br/>
					Course name: '.$projects->course0->name.'<br/>
					Assessment name: '.$projects->name.'<br/>
					Group name: '.$grpModel->name.'<br/>
					Date subnitted/edited: '.date('Y-m-d H:i:s');
                mail($to,$subject,$message,$headers);
            }
        }
    }
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                    "Reply-To: {$model->email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $this->layout = false;
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        //echo "<pre>";print_r(Users::model()->findAll());die;
        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
    public function actionEdit()
    {
        $model=Users::model()->findByPk(Yii::app()->session['id']);
        $model->scenario = 'edit';
        if(isset($_POST['Users']) && !empty($_POST['Users']))

        {   $model->attributes=$_POST['Users'];
            $uploadedFile=CUploadedFile::getInstance($model,'profile');
            //print_r($uploadedFile);die;
            if($uploadedFile)
            {
                $fileName = $uploadedFile;
                $model->profile = $fileName;
                $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/images/profile/'.$fileName);
            }
            else
            {
                $model->profile=$model->profile;
            }
            if($model->save(false))
            {

                Yii::app()->user->setFlash('success','Your Profile Updated successfully .');
                $this->redirect(array('site/index'));
            }
        }


        $this->render('edit',array('model'=>$model));
    }
    public function actionEditprofile()
    {
        $model=new Users;
        $model->scenario = 'changepwd';
        $makemodel=Users::model()->findByPk(Yii::app()->session['id']);
        if(isset($_POST['Users']['newpassword']))
        {
            $model=Users::model()->findByPk(Yii::app()->session['id']);
            $model->password=$_POST['Users']['newpassword'];
            if($model->save(false))
            {
                Yii::app()->user->setFlash('success','Your password has been changed successfully.');
                $this->redirect(array('site/editprofile'));
            }
        }
        $usermodel=Users::model()->findByPk(Yii::app()->session['id']);
        $usermodel->scenario = 'edit';
        if(isset($_POST['Users']['first_name']) && !empty($_POST['Users']['first_name']))
        {
            $usermodel->attributes=$_POST['Users'];
           //$usermodel->username='admin@splat.com';
            $uploadedFile=CUploadedFile::getInstance($model,'profile');
            if($uploadedFile)
            {
                $fileName = $uploadedFile;
                $usermodel->profile = $fileName;
                $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/images/profile/'.$fileName);
            }
            else
            {
                $usermodel->profile=$usermodel->profile;
            }
            if($usermodel->save(false))
            {
                Yii::app()->user->setFlash('success','Your Profile Updated successfully .');
                $this->redirect(array('site/editprofile'));
            }
        }
        $this->render('editprofile',array('model'=>$model,'makemodel'=>$makemodel,'usermodel'=>$usermodel));
    }
    public function actionNamechange()
    {

        $makemodel=Users::model()->findByPk(Yii::app()->session['id']);
        //print_r($makemodel);die;
        if(isset($_POST['name'],$_POST['type']))
        {
            if($_POST['type']=='fn')
            {
                $makemodel->first_name=$_POST['name'];
                $makemodel->save('false');
                $data=$makemodel->first_name;
            }
            else if($_POST['type'] =='ln')
            {
                $makemodel->last_name=$_POST['name'];
                $makemodel->save('false');
                $data=$makemodel->last_name;
            }
            echo json_encode($data, true);
            die();
        }


    }
    public function actionProfileimage()

    {
        //print_r($_POST);die;
        if(isset($_FILES))
        {
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["tax_file"]["name"]);
            //print_r($_FILES["tax_file"]["name"]);die;
            if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["my_file"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

        }

    }

    public function actionLeavegroup()
    {
        $message='';
        if(isset($_POST['id']) && $_POST['id']!=''){
            $user_id = $_POST['id'];
            $group_id = $_POST['group'];
            GroupUsers::model()->find('user_id='.$user_id.' and group_id='.$group_id)->delete();
            $message = "You have left from group successfully";
            $msg['status'] = 'S';
            echo json_encode($msg, true);
            die();
        }
    }

    public function actionForgot()
    {
        $this->layout = false;
        $model=new ForgotForm;

        // collect user input data
        if(isset($_POST['ForgotForm']))
        {
            $model->attributes=$_POST['ForgotForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate()){
                $user = Users::model()->find('username=:username or email=:username',array(':username'=>$model->username));
                if(count($user)>0){
                    $password = bin2hex(openssl_random_pseudo_bytes(4));
                    $user->password = $password;
                    $user->save();

                    $to = $user->email;
                    //$to = 'rsprampaul14321@gmail.com';
                    $url = 'http://splat.bournemouth.ac.uk/site/login';

                    $subject = "SPLAT Password Reset";

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: SPLAT – Bournemouth University <lsivakumar@bournemouth.ac.uk>' . "\r\n";

                    $message = 'Dear '.$user->first_name.',<br/><br/>Your password has been reset. Now you can login with your new password.<br/><br/>
					Your credentials are:<br/>
					Website: '.$url.'<br/>
					Username: '.$user->first_name." ".$user->last_name.'<br/>
					Password: '.$user->password;

                    mail($to,$subject,$message,$headers);
                    Yii::app()->user->setFlash('success','We have sent your password to your email.');
                    $this->redirect(Yii::app()->user->returnUrl);
                } else {
                    $model->addError('username','Incorrect username');
                }
            }
        }
        // display the login form
        $this->render('forgot',array('model'=>$model));
    }
    public function actionAssesmentresponse($id)
    {
        $projects = Projects::model()->find('id='.$id);
        $questions	= Questions::model()->findAll('course='.base64_decode($_GET['c']));
        $groupUsers = GroupUsers::model()->findAll('group_id='.$_GET['g']);
        $this->render('assesmentpage',
            array(
                'projects' => $projects,
                'groupUsers' => $groupUsers,
                'questions'=> $questions
            )
        );
        // $this->renderPartial('assesmentpage', '', false, true);
    }
}