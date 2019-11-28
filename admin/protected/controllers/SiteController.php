<?php

class SiteController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /*public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('login', 'logout'),
                'users'=>array('*'),
            ),
            array('allow', // superuser
                'actions'=>(RoleHelper::GetRole()),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }*/
    public function accessRules()
    {
        //print_r(Yii::app()->user->getState('role'));die;
        //var_dump(Yii::app()->user->getState('role'));die;
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('adminpage','projectquestions','institutions','courses','courseitems','faculties','removeuser','deletecourseitems',
                    'deleteins','deletefacilites','deletecourse','deleteque','deleteuser','deletetemplate','editprofile','deletegroup'),
                'roles'=>array('Superuser'),
                'expression'=>'Yii::app->user->getState("role") == "Superuser"',

            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('projectquestions','courses','courseitems','faculties'),
                'roles'=>array('Faculty'),
                'expression'=>'Yii::app->user->getState("role") == "Faculty"',

            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('projectquestions','courses','deleteque','courseitems','faculties'),
                'roles'=>array('Staff'),
                'expression'=>'Yii::app->user->getState("role") == "Staff"',

            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('projectquestions','courses','courseitems','faculties'),
                'roles'=>array('Admin'),
                'expression'=>'Yii::app->user->getState("role") == "Admin"',

            ),
            /*/array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('login', 'logout'),
                'users'=>array('*'),
            ),*/
        );
    }

    /**
     * Declares class-based actions.
     */
    /*public function actions()
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
    }*/

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    protected function beforeAction($action)
    {
        $action=$action->id;
        if(!isset(Yii::app()->user->id) && $action!='login')
            $this->redirect(Yii::app()->createUrl('site/login'));

        if(Yii::app()->user->getState('role') != "Superuser")
        {
            /*$resaction=array('index','removeuser','deletecourseitems',
                'deleteins','deletefacilites','deletecourse','deleteuser');*/
            $resaction=array('index');
            if (in_array($action, $resaction))
            {
                $this->redirect('unauthorized');
            }
        }

        return parent::beforeAction($action);
    }
    public function actionIndex()
    {

        $this->pageTitle="Index";
        if(isset(Yii::app()->user->id))
        {
            $this->render('index');
        }
        else
        {
            $this->redirect(array('site/login'));
        }
    }
    public function actionUnauthorized()
    {
        if(isset(Yii::app()->user->id))
        {
            $this->render('site/unauthorized');
        }
        else
        {
            $this->redirect(array('site/login'));
        }
    }
    public function actionCourses($f)
    {
        $this->pageTitle="SPLAT - Course";
        if(Yii::app()->user->getState('role')=='Staff') {

            $result=Yii::app()->db->createCommand('select group_concat(course_id) as course  from user_courses where user_id="'.Yii::app()->session['id'].'"')->queryAll();
            $course=($result>0)?$result[0]['course']:"0";
            $model = Courses::model()->findAll('faculty=' . base64_decode($f) . ' and status="active"  and  id in('.$course.')');
            $imodel = Courses::model()->findAll('faculty=' . base64_decode($f) . ' and status="inactive" and id in ('.$course.')');
        }
        else{
            $model = Courses::model()->findAll('faculty=' . base64_decode($f) . ' and status="active"');
            $imodel = Courses::model()->findAll('faculty=' . base64_decode($f) . ' and status="inactive"');
        }
        $formModel = new Courses();
        $this->pageTitle="Course";
        $formModel->faculty = base64_decode($f);
        $formModel->institution = base64_decode($_GET['i']);
        $institution = Institutions::model()->find('id='.base64_decode($_GET['i']));
        $faculty = Faculties::model()->find('id='.base64_decode($f));
        if(isset($_POST['Courses']) && !empty($_POST['Courses'])){
            //echo "<pre>";print_r($_POST);die;
            if(isset($_POST['Courses']['id']) && $_POST['Courses']['id']!='')
                $formModel = Courses::model()->find('id='.$_POST['Courses']['id']);
            $formModel->attributes 	= $_POST['Courses'];
            $formModel->year=$_POST['Courses']['year'];
            $formModel->course_level=$_POST['Courses']['course_level'];
            $formModel->description=$_POST['Courses']['description'];
            $formModel->created_by	= Yii::app()->user->id;
            $formModel->created_date= date('Y-m-d H:i:s');
            $formModel->updated_date= date('Y-m-d H:i:s');
            $msg_str=$formModel->isNewRecord?"added":"updated";
            if($formModel->validate() && $formModel->save())
            {
                if(empty($_POST['Courses']['id']))
                {
                    $usr_Course=New UserCourses();
                    $usr_Course->course_id=$formModel->id;
                    $usr_Course->user_id=Yii::app()->session['id'];
                    $usr_Course->save(false);
                }

                Yii::app()->user->setFlash('success',"Course has been {$msg_str} successfully.");
                $this->refresh();
            }
        }
        $this->render('courses',
            array(
                'model' => $model,
                'imodel' => $imodel,
                'formModel' => $formModel,
                'institution' => $institution,
                'faculty'=> $faculty
            )
        );
    }

    public function actionCourseItems($c)
    {
        $grpmodel=new Groups('search');
        $this->pageTitle="SPLAT - Course items";
        $grpmodel->unsetAttributes();  // clear any default values
        if(isset($_GET['Groups']))
            $grpmodel->attributes=$_GET['Groups'];
        $assesmodel=new Multipleassesment('search');
        $assesmodel->unsetAttributes();  // clear any default values
        if(isset($_GET['Multipleassesment']))
            $grpmodel->attributes=$_GET['Multipleassesment'];
        $model = Projects::model()->findAll('faculty='.base64_decode($_GET['f']).' and course='.base64_decode($_GET['c']).' and institution='.base64_decode($_GET['i']).' and status !="inactive"');
        $formModel = new Projects();
        $formModel->faculty = base64_decode($_GET['f']);
        $formModel->institution = base64_decode($_GET['i']);
        $formModel->course = base64_decode($c);
        //print_r($formModel->course);die;
        $institution = Institutions::model()->find('id='.base64_decode($_GET['i']));
        $faculty = Faculties::model()->find('id='.base64_decode($_GET['f']));
        $course = Courses::model()->find('id='.base64_decode($c));
        $projectGroups = new ProjectGroups();
        $groups = new Groups();

        $institutionUser = new InstitutionUser();
        $institutionUser->faculty = base64_decode($_GET['f']);
        $institutionUser->institution = base64_decode($_GET['i']);
        $institutionUser->course = base64_decode($c);

        $questions = new Questions();
        $questions->faculty = base64_decode($_GET['f']);
        $questions->institution = base64_decode($_GET['i']);
        $questions->course = base64_decode($c);
        $sqldcque="SELECT GROUP_CONCAT(question_id) as question 
         FROM `delete_custom_question` WHERE `course_id` = $questions->course";
        $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
        $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';

        $question=Questions::model()->findAll('institution='.base64_decode($_GET['i']).'
            and faculty='.base64_decode($_GET['f']).'
             and course='.base64_decode($_GET['c']).' and status="active" and id NOT IN ('.$ids.')');



        $existing_users = array();
        $institutionUsers = InstitutionUser::model()->findAll('institution=:i and faculty=:f and course=:c', array(':i'=>base64_decode($_GET['i']),':f'=>base64_decode($_GET['f']),':c'=>base64_decode($c)));
        if(count($institutionUsers)>0){
            foreach($institutionUsers as $insUser){
                $existing_users[] = $insUser->user_id;
            }
        }
        if(isset($_POST['Projects']) && !empty($_POST['Projects'])){
            if(isset($_POST['Projects']['id']) && $_POST['Projects']['id']!='')
                $formModel = Projects::model()->find('id='.$_POST['Projects']['id']);
            $formModel->attributes 	= $_POST['Projects'];
            $formModel->course	= base64_decode($_GET['c']);
            $formModel->faculty=base64_decode($_GET['f']);
            $formModel->assess_date= date('Y-m-d H:i:s');
            $formModel->created_by	= Yii::app()->user->id;
            $formModel->created_date= date('Y-m-d H:i:s');
            $formModel->updated_date= date('Y-m-d H:i:s');
            if($formModel->validate() && $formModel->save())
            {
                $checkmulasses=Multipleassesment::model()->findAll("prj_id=".$formModel->id);
                if($checkmulasses)
                {
                    foreach($checkmulasses as $key =>$val)
                    {
                        $updatemultiple=Multipleassesment::model()->findByPk($val->id);
                        $updatemultiple->due_date=date('Y-m-d H:i',
                            strtotime($_POST["multipleassesment_$updatemultiple->id"]));
                        $updatemultiple->update('due_date');
                    }
                }
            }
            if(!empty($_POST['multipleassesment'])) {
                foreach ($_POST['multipleassesment'] as $val) {
                    if (!empty($val)) {
                        $multipleAsses = new Multipleassesment();
                        $multipleAsses->prj_id = $formModel->id;
                        $multipleAsses->due_date = date('Y-m-d H:i',strtotime($val));
                        $multipleAsses->created_date = date('Y-m-d H:i:s');
                        $multipleAsses->save();
                    }
                }
            }
            Yii::app()->user->setFlash('success','Project has been added successfully.');
            $this->refresh();
        }


        if(isset($_POST['Groups'])){
            if(isset($_POST['Groups']['id']) && $_POST['Groups']['id']!='')
                $formModel = Groups::model()->find('id='.$_POST['Groups']['id']);
            $formModel->attributes 	= $_POST['Groups'];
            $formModel->status = 'active';
            $formModel->created_date= date('Y-m-d H:i:s');
            $formModel->updated_date= date('Y-m-d H:i:s');
            if($formModel->validate() && $formModel->save())
            {
                Yii::app()->user->setFlash('success','Group has been added successfully.');
                $this->refresh();
            }
        }

        if(isset($_POST['InstitutionUser'])){
            $institutionUser->attributes 	= $_POST['InstitutionUser'];
            if($institutionUser->validate() && $institutionUser->save())
            {
                Yii::app()->user->setFlash('success','User has been added successfully.');
                $this->refresh();
            }
        }

        if(isset($_POST['Questions'])){
            if(isset($_POST['Questions']['id']) && $_POST['Questions']['id']!='')
                $questions = Questions::model()->find('id='.$_POST['Questions']['id']);
            $questions->attributes 	= $_POST['Questions'];
            $questions->q_type=$_POST['Questions']['q_type'];
            if($questions->validate() && $questions->save())
            {
                Yii::app()->user->setFlash('success','Question has been added successfully.');
                $this->refresh();
            }
        }

        if(isset($_POST['ProjectGroups'])){
            //'project_id='.$_POST['ProjectGroups']['project_id'].' and
            $projectGroup = ProjectGroups::model()->find('group_id='.$_POST['ProjectGroups']['group_id']);
            if(count($projectGroup)<=0){
                $projectGroups->attributes 	= $_POST['ProjectGroups'];
                if($projectGroups->validate() && $projectGroups->save())
                {
                    Yii::app()->user->setFlash('success','Group has been added successfully.');
                    $this->refresh();
                }
            }else {
                Yii::app()->user->setFlash('error','Sorry group already exists.');
                $this->refresh();
            }
        }


        if(isset($_POST['defaultQuestions'])){
            if(isset($_POST['defaultQuestions']) && count(['defaultQuestions'])>0){
                //print_r($_POST['defaultQuestions']);die;
                foreach($_POST['defaultQuestions'] as $dquestions){
                    $ownmdquestions = Questions::model()->findByPk($dquestions);
                    $mdquestions = Questions::model()->find("id=".$dquestions." and type='custom' and course=".base64_decode($_GET['c'])." and faculty=".base64_decode($_GET['f'])." and institution=".base64_decode($_GET['i']));
                    if(!$mdquestions)
                    {
                        $questions = new Questions();
                        $questions->faculty = base64_decode($_GET['f']);
                        $questions->institution = base64_decode($_GET['i']);
                        $questions->course = base64_decode($c);
                        $questions->question= $ownmdquestions->question;
                        $questions->type= 'custom';
                        $questions->q_type=$ownmdquestions->q_type;
                        $questions->status= 'active';
                        if($questions->validate())
                        {
                            $questions->save();
                        }
                        else
                        {
                            echo "<pre>";print_r($questions->getErrors());die;
                        }
                    }
                    else
                    {
                        $deletecustom=DeleteCustomQuestion::model()->find("question_id=".$dquestions." and course_id=".base64_decode($c));
                        if($deletecustom)
                        {
                            $deletecustom->delete();
                        }
                    }
                }
                Yii::app()->user->setFlash('success','Question has been added successfully.');
                $this->refresh();
            }
        }

        if(isset($_FILES['csv_file'])){
            if(is_uploaded_file($_FILES['csv_file']['tmp_name'])){
                $csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');
                //skip first line
                fgetcsv($csvFile);
                //parse data from csv file line by line
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    $users = Users::model()->find('username="'.$line[0].'"');
                    if(count($users)<=0) {
                        $users = new Users();
                        $users->username = $line[0];
                        $users->first_name = $line[1];
                        $users->last_name = $line[2];
                        $users->course_id = base64_decode($_GET['c']);
                        $users->fac_id = base64_decode($_GET['f']);
                        $users->institution_id = base64_decode($_GET['i']);
                        $password = bin2hex(openssl_random_pseudo_bytes(4));
                        $users->password = $password;
                        $users->role = '5';

                        if($users->save()){
                            $UserFaculties = new UserFaculties();
                            $UserFaculties->user_id = $users->id;
                            $UserFaculties->faculty_id = base64_decode($_GET['f']);
                            $UserFaculties->save();

                            $UserCourses = new UserCourses();
                            $UserCourses->user_id = $users->id;
                            $UserCourses->course_id = base64_decode($_GET['c']);
                            $UserCourses->save();

                            $to =trim($users->email);
                           // $to = 'suresh@businessgateways.com';
                            $course_name = $users->courses->name;
                            $url = 'http://splat.bournemouth.ac.uk/site/login';
                            $subject = "SPLAT User Registration";
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $message = 'Dear '.$users->first_name.'<br/><br/>You have been added to the SPLAT website. Now you can login to assess your peers for the Course: '.$course_name.'<br/><br/>Your credentials are:<br/>
							Website: '.$url.'<br/>
							Username: '.$to.'<br/>
							Password: '.$users->password;

                            mail($to,$subject,$message,$headers);
                        }
                    } else {
                        $UserFaculties = UserFaculties::model()->findAll('user_id='.$users->id.' and faculty_id='.base64_decode($_GET['f']));
                        if(count($UserFaculties)<=0) {
                            $UserFaculties = new UserFaculties();
                            $UserFaculties->user_id = $users->id;
                            $UserFaculties->faculty_id = base64_decode($_GET['f']);
                            $UserFaculties->save();
                        }
                        $UserCourses = UserCourses::model()->findAll('user_id='.$users->id.' and course_id='.base64_decode($_GET['c']));
                        if(count($UserCourses)<=0) {
                            $UserCourses = new UserCourses();
                            $UserCourses->user_id = $users->id;
                            $UserCourses->course_id = base64_decode($_GET['c']);
                            $UserCourses->save();

                            $to = $users->email;
                            //$to ='suresh@businessgateways.com';
                            $course_name = $users->courses->name;
                            $url = 'http://splat.bournemouth.ac.uk/site/login';
                            $subject = "SPLAT User Registration";
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $message = 'Dear '.$users->first_name.'<br/><br/>You have been added to the SPLAT website. Now you can login to assess your peers for the Course: '.$course_name.'<br/><br/>Your credentials are:<br/>
							Website: '.$url.'<br/>
							Username: '.$to.'<br/>
							Password: '.$users->password;

                            mail($to,$subject,$message,$headers);
                        }
                    }
                }
                fclose($csvFile);
                Yii::app()->user->setFlash('success','Users added successfully.');
            }
        }

        if(isset($_GET['u']) && $_GET['u']!=''){
            InstitutionUser::model()->findByPk(base64_decode($_GET['u']))->delete();
            Yii::app()->user->setFlash('success','User has been removed successfully.');
            $this->redirect(Yii::app()->createUrl('site/courseitems',array('i'=>$_GET['i'],'f'=>$_GET['f'],'c'=>$_GET['c'])));
        }

        $this->render('course_items',
            array(
                'model' => $model,
                'formModel' => $formModel,
                'institution' => $institution,
                'faculty' => $faculty,
                'course' => $course,
                'institutionUser' => $institutionUser,
                'institutionUsers' => $institutionUsers,
                'existing_users' => $existing_users,
                'questions' => $questions,
                'question' => $question,
                'pmodel' => $projectGroups,
                'groups' => $groups,
                'grpmodel'=>$grpmodel,'assesmodel'=>$assesmodel
            )
        );
    }

    public function actionProjectquestions($id)
    {
        $projects = Projects::model()->find('id='.$id.' and status !="inactive"');
        $questions	= Questions::model()->findAll('course='.base64_decode($_GET['c']));

        $groupUsers = GroupUsers::model()->findAll('group_id='.$_GET['g']);
        $this->render('assessment',
            array(
                'projects' => $projects,
                'groupUsers' => $groupUsers,
                'questions'=> $questions
            )
        );

    }
    public function actionDeletecourseitems()
    {
        $message='';
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $pmodel=Projects::model()->findByPk($_POST['id']);
            $pmodel->status="inactive";
            $pmodel->save(false);
            $message = "Assesment has been deleted successfully";
            $msg['status'] = 'S';
            echo json_encode($msg, true);
            die();

        }
    }
    public function actionDeleteins()
    {
        $message='';
        if(isset($_POST['id']) && $_POST['id']!=''){
            Institutions::model()->findByPk($_POST['id'])->delete();
            $message = "Institutions has been added successfully";
            $msg['status'] = 'S';
            echo json_encode($msg, true);
            die();

        }
    }
    public function actionDeletefacilites()
    {
        $message='';
        if(isset($_POST['id']) && $_POST['id']!=''){
            Faculties::model()->findByPk($_POST['id'])->delete();
            $message = "Faculties has been added successfully";
            $msg['status'] = 'S';
            echo json_encode($msg, true);
            die();

        }
    }
    public function actionDeletecourse()
    {
        $message='';
        if(isset($_POST['id']) && $_POST['id']!=''){
            Courses::model()->findByPk($_POST['id'])->delete();
            UserCourses::model()->deleteAll('course_id='.$_POST['id']);
            $message = "Course has been added successfully";
            $msg['status'] = 'S';
            echo json_encode($msg, true);
            die();

        }
    }
    public function actionDeleteque()
    {
        $message='';

        if(isset($_POST['id']) && $_POST['id']!=''){
            $dques=Questions::model()->findByPk($_POST['id']);
            if($dques->type=='default')
            {
                $dcmodel=new DeleteCustomQuestion();
                $dcmodel->question_id=$dques->id;
                $dcmodel->course_id=base64_decode($_GET['c']);
                $dcmodel->save();
            }
            else{
                $dques->status="inactive";
            }
            if(!$dques->save('false'))
            {
                print_r($dques->getErrors());die;
            }
            $message = "Question has been added successfully";
            $msg['status'] = 'S';
            echo json_encode($msg, true);
            die();

        }
    }
    public function actionDeleteuser()
    {
        $message='';
        if(isset($_POST['id']) && $_POST['id']!=''){
            $userid=$_POST['id'];
            $deleteuser=Users::model()->findByPk($userid);
            $deleteuser->status="inactive";
            $deleteuser->update('status');
            /*
             $grp=GroupUsers::model()->deleteAll("user_id=".$userid);
              $institute=InstitutionUser::model()->deleteAll("user_id=".$userid);
             $usercourse=UserCourses::model()->deleteAll("user_id=".$userid);
             $userfaculty=UserFaculties::model()->deleteAll("user_id=".$userid);
            $asses=Assess::model()->deleteAll("from_user=".$userid." or to_user=".$userid);
            */

            $message = "User has been deleted successfully";
            $msg['status'] = 'S';
            echo json_encode($msg, true);
            die();

        }
    }
    public function actionDeletegroup()
    {
        $message='';
        if(isset($_POST['id']) && $_POST['id']!=''){
            $ids = explode('##',$_POST['id']);
            ProjectGroups::model()->findByPk($_POST['id'])->delete();
            $message = "Group has been removed successfully";
            $msg['status'] = 'S';
            echo json_encode($msg, true);
            die();
        }
    }
    public function actionDeletetemplate()
    {
        $message='';
        if(isset($_POST['id']) && $_POST['id']!=''){
            EmailTemplate::model()->findByPk($_POST['id'])->delete();
            $message = "Template has been added successfully";
            $msg['status'] = 'S';
            echo json_encode($msg, true);
            die();

        }
    }
    public function actionFaculties($i)
    {
        if(Yii::app()->user->getState('role') =="Staff")
        {
            Yii::app()->db->createCommand('SET group_concat_max_len = 50000')->execute();
            $result=Yii::app()->db->createCommand('select group_concat(faculty_id) as fac  from user_faculties where user_id="'.Yii::app()->session['id'].'"')->queryAll();
            if($result[0]['fac'])
            {
                $model = Faculties::model()->findAll('id in ('.$result[0]['fac'].')');
            }
            else
            {
                $model = array();
            }
        }
        else
        {
            $model = Faculties::model()->findAll('institution='.base64_decode($i));
        }
        //print_r(count($model));die;
        $formModel = new Faculties();
        /* $emodels=new EmailTemplate;
         $makemodel=new EmailTemplate;*/
        $this->pageTitle="SPLAT - Faculty";
        $formModel->institution = base64_decode($i);
        $institution = Institutions::model()->find('id='.base64_decode($i));
        /*$emodels = EmailTemplate::model()->findAll('ins_id='.base64_decode($i));*/
        //print_r($emodels);die;
        if(isset($_POST['Faculties'])){
            if(isset($_POST['Faculties']['id']) && $_POST['Faculties']['id']!='')
                $formModel = Faculties::model()->find('id='.$_POST['Faculties']['id']);
            $formModel->attributes 	= $_POST['Faculties'];
            $formModel->created_by	= Yii::app()->user->id;
            $formModel->created_date= date('Y-m-d H:i:s');
            $formModel->updated_date= date('Y-m-d H:i:s');
            $formModel->description = $_POST['Faculties']['description'];
            if($formModel->validate() && $formModel->save())
            {
                Yii::app()->user->setFlash('success','Faculties has been added successfully.');
                $this->refresh();
            }
        }
        /*if(isset($_POST['EmailTemplate'])){
            //print_r($_POST['EmailTemplate']);die;
            if(isset($_POST['EmailTemplate']['id']) && $_POST['EmailTemplate']['id']!='')
            {
                $emodels = EmailTemplate::model()->find('id='.$_POST['EmailTemplate']['id']);
                $emodels->attributes=$_POST['EmailTemplate'];
                if($emodels->save(false))
                {
                    Yii::app()->user->setFlash('success','EmailTemplate has been updated successfully.');
                    $this->refresh();
                }
            }
            else{
                $makemodel->attributes 	= $_POST['EmailTemplate'];
                $makemodel->ins_id	= base64_decode($i);
                $makemodel->created_date= date('Y-m-d H:i:s');

                if($makemodel->validate() && $makemodel->save())
                {
                    Yii::app()->user->setFlash('success','EmailTemplate has been added successfully.');
                    $this->refresh();
                }
            }
        }*/
        $this->render('faculties',
            array(
                'model' => $model,
                'formModel' => $formModel,
                'institution' => $institution,
                /*'emodels'=>$emodels,
                'makemodel'=>$makemodel*/
            )
        );
    }

    public function actionInstitutions()
    {
        $model = Institutions::model()->findAll();
        $formModel = new Institutions();
        if(isset($_POST['Institutions'])){
            if(isset($_POST['Institutions']['id']) && $_POST['Institutions']['id']!='')
                $formModel = Institutions::model()->find('id='.$_POST['Institutions']['id']);
            $formModel->attributes 	= $_POST['Institutions'];
            $formModel->created_by	= Yii::app()->user->id;
            $formModel->created_date= date('Y-m-d H:i:s');
            $formModel->updated_date= date('Y-m-d H:i:s');
            if($formModel->validate() && $formModel->save())
            {
                Yii::app()->user->setFlash('success','Institution has been added successfully.');
                $this->refresh();
            }
        }
        $this->render('institutions',
            array(
                'model' => $model,
                'formModel' => $formModel
            )
        );
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

              //  mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
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
        $this->pageTitle="Login";
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
            {
                $ins_user=Users::model()->findByPk(Yii::app()->session['id']);
                $insbs64=base64_encode($ins_user->institution_id);
                $facbs64=base64_encode($ins_user->fac_id);
                $cubs64=base64_encode($ins_user->course_id);
                if(Yii::app()->user->getState('role')==='Superuser')
                {
                    Yii::app()->session['homeurl']=Yii::app()->createUrl("site/index");
                    $this->redirect(array("site/index"));
                    // Yii::app()->session['homeurl']=Yii::app()->createUrl("site/index");
                }
                else if(Yii::app()->user->getState('role')==='Staff')
                {
                    $findfac=UserFaculties::model()->find("user_id=".Yii::app()->session['id']);
                    $facbs64=base64_encode($findfac->faculty_id);
                    Yii::app()->session['homeurl']=Yii::app()->createUrl("site/faculties",array("i"=>$insbs64,"f"=>$facbs64));
                    $this->redirect(array("site/faculties?i=$insbs64&f=$facbs64"));
                }
            }
            //$this->redirect(Yii::app()->user->returnUrl);
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
        $this->redirect(array('site/login'));
    }
    public function actionEditprofile12()
    {
        $model=new Users;
        $model->scenario = 'changepwd';
        if(isset($_POST['Users']))
        {
            $model=Users::model()->findByPk(Yii::app()->session['id']);
            $model->password=$_POST['Users']['newpassword'];
            if($model->save(false))
            {
                Yii::app()->user->setFlash('success','Your password has been changed successfully.');
                $ins_user=Users::model()->findByPk(Yii::app()->session['id']);
                $insbs64=base64_encode($ins_user->institution_id);
                $facbs64=base64_encode($ins_user->fac_id);
                $cubs64=base64_encode($ins_user->course_id);

                if(Yii::app()->user->getState('role')==='Superuser')
                {
                    $this->redirect(array("site/index"));
                }
                else if(Yii::app()->user->getState('role')==='Staff')
                {
                    $this->redirect(array("site/faculties?i=$insbs64&f=$facbs64"));
                }
            }
        }
        if(Yii::app()->user->getState('role')==='Staff')
        {
            $this->render('staffeditprofile',array('model'=>$model));
        }
        else
        {
            $this->render('admineditprofile',array('model'=>$model));
        }


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
                $ins_user=Users::model()->findByPk(Yii::app()->session['id']);
                $insbs64=base64_encode($ins_user->institution_id);
                $facbs64=base64_encode($ins_user->fac_id);
                $cubs64=base64_encode($ins_user->course_id);

                if(Yii::app()->user->getState('role')==='Superuser')
                {
                    $this->redirect(array("site/index"));
                }
                else if(Yii::app()->user->getState('role')==='Staff')
                {
                    $this->redirect(array("site/faculties?i=$insbs64&f=$facbs64"));
                }
            }
        }

        $this->render('admineditprofile',array('model'=>$model,'makemodel'=>$makemodel,'usermodel'=>$usermodel));

    }
    public function actionAssespage()
    {
        if(isset($_POST['name'],$_POST['type']))
        {
            if($_POST['type'] =='staff')
            {
                $make=Faculties::model()->findByPk($_POST['hidden']);
                $make->name=$_POST['name'];
                $make->update('name');
                $data=$make->name;
                echo json_encode($data,true);
                die;
            }
            else if($_POST['type']=='due')
            {
                $pmodel=Projects::model()->findByPk($_POST['hidden']);
                $pmodel->assess_date=$_POST['name'];
                $pmodel->update('assess_date');
                $data=date('d-M-Y',strtotime($pmodel->assess_date));
                echo json_encode($data,true);
                die;
            }
        }

    }
    public function actionResponsepage($id)
    {
        $this->pageTitle="SPLAT - Response";
        $projects = Projects::model()->find('id='.$id);
        //$questions	= Questions::model()->findAll('course='.base64_decode($_GET['c']));
        $courseid=base64_decode($_GET['c']);
        $sqldcque="SELECT GROUP_CONCAT(question_id) as question 
         FROM `delete_custom_question` WHERE `course_id` =$courseid";
        $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
        $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';
        //$questions=Questions::model()->findAll('faculty='.base64_decode($_GET['f']).' and course='.base64_decode($_GET['c']).' and status="active" or type="default" and id NOT IN ('.$ids.')');
        $questions=Questions::model()->findAll('faculty='.base64_decode($_GET['f']).' and course='.base64_decode($_GET['c']).' and status="active"     and id NOT IN ('.$ids.')');
        //echo "<pre>";print_r($question);die;
        $groupUsers = GroupUsers::model()->findAll('group_id='.$_GET['g']);
        $this->render('responsepage',
            array(
                'projects' => $projects,
                'groupUsers' => $groupUsers,
                'questions'=> $questions
            )
        );
    }
    public function actionAssesmentchange()
    {
        if(!empty($_POST))
        {
            $result=array();
            $mulasses=Multipleassesment::model()->findByPk($_POST['asses']);
            $status=($mulasses->status =="A")?"I":"A";
            $mulasses->status=$status;
            $mulasses->update('status');
            $result['status']=$mulasses->status;
            echo json_encode($result);die;
        }

    }
    public function actionAssesmentcomplete()
    {
        if(!empty($_POST))
        {
            $result=array();
            $mulasses=Multipleassesment::model()->findByPk($_POST['asses']);
            $status='C';
            $mulasses->status=$status;
            $mulasses->update('status');
            $result['status']=$mulasses->status;
            echo json_encode($result);die;
        }

    }
    public function actionUnlockusers()
    {
        if($_POST)
        {
            $assesdelete="delete *  FROM `assess` WHERE (`from_user` = 1 or `to_user` = 1) and grp_id=0";
            $groupuser="delete *  FROM `group_users` WHERE `user_id` = 1";

        }
    }
    public function actionCourselevel()
    {
        if($_POST)
        {
            $level=new CourseTypes;
            $level->name=$_POST['level'];
            if($level->save())
            {
                $msg="S";
            }
            else{
                $msg="E";
            }
        }
        echo $msg;die;
    }
    public function actionExcel()
    {
        $i=10;
        $table="<table border = '1'> <tr><th>group name</th><th>firstname</th><th>lastname</th><th>spa</th><th>teamscore</th></tr>";
        for($i=1;$i<=10;$i++)
        {
            $table.="<tr>
<td>Group $i</td>
<td>
<p>suresh $i</p></td>
            <td><p style='border:1px solid black;'>dsfdsfsdfdsf</p>
             </td>
             <td>10</td>
             <td>20</td>
         </tr>";
        }
        $table.="</table>";
        $file="demo.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file");
        echo $table;die;
    }



}