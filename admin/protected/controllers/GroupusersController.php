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
                    'projectgroups','groupasses','viewusers','deleteasses','unlockusers','usercheck','download','pasteusers','sendremainder'),
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
        $model = new GroupUsers;
        $this->pageTitle = "SPLAT - Group users";
        $model->group_id = $_GET['id'];
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $grpmodel = new Groups('search');
        $grpmodel->unsetAttributes();  // clear any default values
        if (isset($_GET['Groups']))
            $grpmodel->attributes = $_GET['Groups'];
        $assesmodel = new Multipleassesment('search');
        $assesmodel->unsetAttributes();  // clear any default values
        if (isset($_GET['Multipleassesment']))
            $grpmodel->attributes = $_GET['Multipleassesment'];

        if (isset($_POST['GroupUsers'])) {
            foreach ($_POST['GroupUsers']['user_id'] as $val) {
                $GroupUsers = GroupUsers::model()->findAll('group_id=' . $_GET['id'] . ' and user_id=' . $val);
                if (count($GroupUsers) <= 0) {
                    $model = new GroupUsers;
                    $model->user_id = $val;
                    $model->group_id = $_POST['GroupUsers']['group_id'];
                    $model->status = 'active';
                    $model->created_date = date('Y-m-d H:i:s');
                    $model->updated_date = date('Y-m-d H:i:s');
                    $model->save();
                }
            }
            Yii::app()->user->setFlash('success','Student(s) has been assigned to the group.');
            $this->refresh();
        }
        if(isset($_FILES['csv_file'])){
            $savecount=0;
            $unsavecount=0;
            if(is_uploaded_file($_FILES['csv_file']['tmp_name'])) {
                // echo $_FILES['csv_file']['tmp_name'];die;
                $csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');

                //skip first line
                $header = fgetcsv($csvFile);
                echo "<pre>";print_r($header);die;
                while (($line = fgetcsv($csvFile)) !== FALSE) {
                    $all_rows[] = array_combine($header, $line);
                }
                fclose($csvFile);
                //echo "<pre>";print_r($all_rows);die;
                $uniquegrouparray=array_filter(array_unique(array_column($all_rows,$header[count($header) -2])));
                $courseid=base64_decode($_GET['c']);
                if(is_array($uniquegrouparray) && !empty($uniquegrouparray))
                {
                    foreach($uniquegrouparray as $key =>$val)
                    {
                        $groupmodel=Groups::model()->find("name='{$val}' and course_id='{$courseid}'");
                        if(count($groupmodel) == 0)
                        {
                            $grpmodels=new Groups();
                            $grpmodels->name=$val;
                            $grpmodels->course_id=base64_decode($_GET['c']);
                            $grpmodels->status='active';
                            $grpmodels->created_date=$grpmodels->updated_date=date('Y-m-d H:i:s');
                            if($grpmodels->save(false))
                            {
                                $projectgroupp=ProjectGroups::model()->find("group_id=".$grpmodels->id." and course_id=".$_GET['p']);
                                //echo "<pre>";print_r($projectgroupp);
                                if(count($projectgroupp) <=0)
                                {
                                    $prjmodelgrp=new ProjectGroups();
                                    $prjmodelgrp->course_id=$_GET['p'];
                                    $prjmodelgrp->group_id=$grpmodels->id;
                                    if($prjmodelgrp->save(false))
                                    {

                                    }
                                    else
                                    {
                                        echo "<pre>";print_r($prjmodelgrp->getErrors());
                                    }
                                }
                            }
                        }
                    }

                    foreach($all_rows as $key =>$values)
                    {

                        if(!empty($all_rows))
                        {
                            $explodeusrdata=explode('@',$values['Email']);
                            $usersmodel=Users::model()->find("username='{$explodeusrdata[0]}' and email='{$explodeusrdata[1]}'");
                            if(count($usersmodel) <=0)
                            {
                                $usermodalmain=new Users();
                                $usermodalmain->role=5;
                                $usermodalmain->course_id=base64_decode($_GET['c']);
                                $usermodalmain->institution_id=1;
                                $usermodalmain->fac_id=base64_decode($_GET['f']);
                                $usermodalmain->status='active';
                                $usermodalmain->created_date=$usermodalmain->updated_date=date('Y-m-d h:i:s');
                                $usermodalmain->first_name=(isset($values['First Name']))?$values['First Name']:$explodeusrdata[0];
                                $usermodalmain->last_name=$values['Last Name'];
                                $usermodalmain->password=bin2hex(openssl_random_pseudo_bytes(4));
                                $usermodalmain->profile=' ';
                                $usermodalmain->save();

                                if($savecount >0)
                                {
                                    Yii::app()->user->setFlash('success',$savecount."- new users has been created.");
                                }
                                if($unsavecount >0)
                                {
                                    Yii::app()->user->setFlash('error',$unsavecount." - Existing users have been assigned to this course.");
                                }
                                $this->mappingusers($usermodalmain->id,$values[$header[count($header) -2]],$courseid);
                            }
                            else{
                                $this->mappingusers($usersmodel->id,$values[$header[count($header) -2]],$courseid);
                            }
                        }


                    }

                }

//                if (!empty($all_rows)) {
//                    if(isset($all_rows[0]['Username']) && isset($all_rows[0]['Email']) && isset($all_rows[0]['First Name']) && isset($all_rows[0]['Last Name']))
//                    {
//                        foreach ($all_rows as $key => $val) {
//                            //while(($line = fgetcsv($csvFile)) !== FALSE){
//                            $users = Users::model()->find("(username='" . $val['Username'] . "' or email='" . $val["Email"] . "') and status='active'");
//                            if (count($users) == 0) {
//                                $users = new Users();
//                                $emailexplode=explode('@',$val['Email']);
//                                $users->username = $emailexplode[0];
//                                $users->first_name = $val['First Name'];
//                                $users->last_name = $val['Last Name'];
//                                $users->email = $val['Email'];
//                                $users->course_id = base64_decode($_GET['c']);
//                                $users->fac_id = base64_decode($_GET['f']);
//                                $users->institution_id = base64_decode($_GET['i']);
//                                $password = bin2hex(openssl_random_pseudo_bytes(4));
//                                $users->password = $password;
//                                $users->role = '5';
//                                $users->created_date = date('Y-m-d h:i:s');
//                                $users->updated_date = date('Y-m-d h:i:s');
//
//                                if ($users->save(false)) {
//                                    //echo "ffsdfdsf";die;
//                                    $savecount = $savecount + 1;
//                                    $UserFaculties = new UserFaculties();
//                                    $UserFaculties->user_id = $users->id;
//                                    $UserFaculties->faculty_id = base64_decode($_GET['f']);
//                                    $UserFaculties->save(false);
//
//                                    $UserCourses = new UserCourses();
//                                    $UserCourses->user_id = $users->id;
//                                    $UserCourses->course_id = base64_decode($_GET['c']);
//                                    $UserCourses->save(false);
//
//                                    //$to = $users->username;
//                                    $course_name = $users->courses->name;
//
//                                    $headers = "MIME-Version: 1.0" . "\r\n";
//                                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//                                    $headers .= 'From: SPLAT – Bournemouth University <lsivakumar@bournemouth.ac.uk>' . "\r\n";
//                                    $subject = "Splat User registration";
//                                    $url = $_SERVER['SERVER_NAME'] . "/site/login";
//                                    $to = $users->email;
//                                    $message = 'Dear ' . $users->first_name . '<br/><br/>You have been added to the
//                                 Bournemouth University SPLAT website for the course ' . $course_name . '.
//                                 You can now login to assess your peers.<br/><br/>Your credentials are:<br/>
//                                 Website: ' . $url . '<br/>
//                                 Username: ' . $to . '<br/>
//                                 Password: ' . $users->password;
//                                    mail($to, $subject, $message, $headers);
//                                }
//                                else
//                                {
//                                    echo "<pre>";print_r($users->getErrors());die;
//                                }
//                            }
//                            else {
//                                $facultymodel=UserFaculties::model()->findByAttributes(array('user_id'=>$users->id,'faculty_id'=>base64_decode($_GET['c'])));
//                                $coursemodel=UserCourses::model()->findByAttributes(array('user_id'=>$users->id,'course_id'=>base64_decode($_GET['c'])));
//                                if(empty($facultymodel) && empty($coursemodel))
//                                {
//                                    $UserFaculties = new UserFaculties();
//                                    $UserFaculties->user_id = $users->id;
//                                    $UserFaculties->faculty_id = base64_decode($_GET['f']);
//                                    $UserFaculties->save(false);
//
//                                    $UserCourses = new UserCourses();
//                                    $UserCourses->user_id = $users->id;
//                                    $UserCourses->course_id = base64_decode($_GET['c']);
//                                    $UserCourses->save(false);
//                                }
//                                else{
//                                    $unsavecount = $unsavecount+1;
//                                }
//
//                            }
//                        }
//                        fclose($csvFile);
//                        if($savecount >0)
//                        {
//                            Yii::app()->user->setFlash('success',$savecount."- new users has been created.");
//                        }
//                        if($unsavecount >0)
//                        {
//                            Yii::app()->user->setFlash('error',$unsavecount." - Existing users have been assigned to this course.");
//                        }
//
//                        $this->refresh();
//                    }
//                    else
//                    {
//                        Yii::app()->user->setFlash('error','Fields are not matched.please try after some time');
//                    }
//
//                }

            }
        }

        $this->render('projectadmin',array(
            'model'=>$model,'grpmodel'=>$grpmodel,'assesmodel'=>$assesmodel
        ));
    }

    public function mappingusers($userid,$header,$courseid)
    {
        if(!empty($userid))
        {
            $usercourses=UserCourses::model()->find("user_id=".$userid." and course_id=".base64_decode($_GET['c']));
            if(count($usercourses)<=0)
            {
                $ucmodal=new UserCourses();
                $ucmodal->course_id=base64_decode($_GET['c']);
                $ucmodal->user_id=$userid;
                $ucmodal->save(false);
            }

            $userfaculty=UserFaculties::model()->find("user_id=".$userid." and faculty_id=".base64_decode($_GET['f']));

            if(count($userfaculty)<=0)
            {
                $ucfacmodel=new UserFaculties();
                $ucfacmodel->user_id=$userid;
                $ucfacmodel->faculty_id=base64_decode($_GET['f']);
            }
            $groupmainmodel=Groups::model()->find("name='{$header}' and course_id='{$courseid}'");
            if(count($groupmainmodel) >0)
            {
                $groupusersmodel=new GroupUsers();
                $groupusersmodel->user_id=$userid;
                $groupusersmodel->group_id=$groupmainmodel->id;
                $groupusersmodel->status='active';
                $groupusersmodel->created_date=$groupusersmodel->updated_date=date('Y-m-d h:i:s');
                $groupusersmodel->save(false);

            }
        }

    }

    public function actionDownload()
    {

        $project=Projects::model()->find("id=".$_GET['p']);
        $test="";
        $html='<table id="resulttable" class="table" border = \'1\'>
<tr><th scope="col">Username</th><th>Email</th><th>First Name</th><th>Last Name</th>';
        $html.='<th>'.$project->name.'</th>';
        $html.='<th>Group Name</th>';
        $html.='<th>Team Mean</th>';
        $html.='<th>Late Submission</th>';
//        $html.='<th>Late Submission</th></tr>';
        $html.='<th>End-of-Line Indicator</th></tr>';
        $html.="<tbody>";

        $usermodelsql="SELECT user_id,users.first_name,users.last_name,users.username as username FROM `user_courses` 
                  join users on user_courses.user_id=users.id and users.role=5 and users.status='active'
                  WHERE user_courses.`course_id` = ".base64_decode($_GET["c"]);

        $usermodel=Userdetails::model()->with('user')->findAll( array(
            'condition'=>'course='.base64_decode($_GET["c"]).' and user.status="active" and user.role=5',
            'order'=>'t.grp_id asc'
        ));
        $courseid=base64_decode($_GET['c']);


        $sqldcque="SELECT GROUP_CONCAT(question_id) as question 
                                   FROM `delete_custom_question` WHERE `course_id` =$courseid";
        $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
        $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';
        $questions=Questions::model()->findAll('faculty='.base64_decode($_GET['f']).' and q_type="R"
                         and course='.base64_decode($_GET['c']).' and status="active" or type="default" and id NOT IN ('.$ids.') ');
        $dividedcount=count($questions);

        foreach($usermodel as $key =>$val)
        {

            $userdetails=Userdetails::model()->find("course=".$courseid." and user_id=".$val['user_id']);
           // echo "<pre>";print_r($userdetails[0]['grp_id']);

            if($userdetails)
            {
                $meansql="SELECT (sum(value)/$dividedcount) as mean FROM `assess` WHERE `project` ={$_GET['p']} AND `grp_id` ={$userdetails->grp_id}  ORDER BY `id`  DESC";
                //echo $userdetails->grp_id."<br>";
                $grpuserscount=count(Userdetails::model()->findAll("grp_id=".$userdetails->grp_id));
                $meansocre=Yii::app()->db->Createcommand($meansql)->QueryAll();
                $scoremean=(!empty($meansocre[0]['mean']))?$meansocre[0]['mean']/$grpuserscount:"#";
            }
            else{
                $scoremean="#";
            } 
            $test.="<td>".$val->user->username."</td><td>".$val->user->email."</td><td>".$val->user->first_name."</td><td>".$val->user->last_name."</td>";
            $resultsql="SELECT sum(value) as total,submitted_at FROM `assess`
                 left join questions on assess.question=questions.id
                  where to_user={$val->user->id} and (value !='' and value !=0) 
                   and questions.q_type='R' and  questions.status='active' 
                  and assess.project={$_GET["p"]} 
                 order by assess.question asc";
            $sumresult=Yii::app()->db->Createcommand($resultsql)->QueryAll();
         // echo "<pre>";print_r($sumresult);
            $rowfind="SELECT * FROM `assess` left join questions on assess.question=questions.id
                  where to_user={$val->user->id} and (value !='' and value !=0) 
                  and questions.q_type='R' and  questions.status='active' 
                  and assess.project={$_GET["p"]} 
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
               // $test.='<td>#</td>';
            }
            $test.='<td>'.$userdetails->groupname->name.'</td>';
            $test.='<td>'.$scoremean.'</td>';
            $date=!empty($sumresult[0]['submitted_at'])?$sumresult[0]['submitted_at']:date("Y-m-d H:i:s");
            $differncesql="select timediff('$project->assess_date','$date') as diff";
            $executequery=Yii::app()->db->Createcommand($differncesql)->queryRow();
            print_r($executequery);
            $sign=(stristr($executequery['diff'],'-')==$executequery['diff'])?"Yes":"No";
            $test.='<td>'.$sign.'</td>';
            $test.='<td>#</td>';
            $html.="<tr>".$test."</tr>";
            $test="";
        }

        $html.='</table>';
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

    public function actionPasteusers($id)
    {
        if(is_numeric($id))
        {
            $list= Yii::app()->db->createCommand('SELECT GROUP_CONCAT(user_id) as user FROM `group_users` where group_id='.$id)->queryAll();
            $data=$list[0]['user'];

            //echo $data;die;

            $cond=(isset($list[0]['user']))? "and A.user_id not in($data)":'';
            $sql='SELECT A.*,concat(first_name," ",last_name) as name FROM `user_courses` as A left join users as B on B.id=A.user_id
                             WHERE A.course_id='.$_POST['course'].' and B.role=5 and B.status="active" '. $cond;
            $result=Yii::app()->db->CreateCommand($sql)->QueryAll();
            $html='';
            //echo "<pre>";print_r($result);die;
            if(!empty($result))
            {
                foreach($result as $val)
                {
                    $html.='<option value="'.$val['user_id'].'">'.$val["name"].'</option>';
                }

            }

            echo  $html;die;
        }
    }

    public function actionSendremainder()
    {
        if(isset($_POST['course']))
        {
            $projectmodel=Projects::model()->findByPk($_POST['p']);

            $usermodel=Userdetails::model()->with('user')->findAll( array(
                'condition'=>'course='.$_REQUEST['c'].' and user.status="active" and user.role=5',
                'order'=>'t.grp_id asc'
            ));
            foreach($usermodel as $val)
            {
                //$to =trim($val->user->email);
                $to ='suresh@businessgateways.com';
                $firstname=$val->user->first_name;
                $lastname=$val->user->lastname;
                $password=$val->user->password;
                $url = $_SERVER['SERVER_NAME']."/site/login";
                $subject = "Reminder Email: 
";

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: SPLAT – Bournemouth University <lsivakumar@bournemouth.ac.uk>' . "\r\n";

                $message = 'Hi '.$firstname.'<br/><br/>You have been registered to take part in the Peer assessment review. Please login to submit your entry before the deadline: '. date('Y-m-d', strtotime($projectmodel->assess_date)).'<br/><br/>Your credentials are:<br/>
				Link to the site:'.$url.'<br/>
				Username: '.$to.'<br/>
				Password: '.$password;

                $message.='<br><p>Kind regards</p><br><b>Splat Team</b>';
               // mail($to,$subject,$message,$headers);
            }
        }

    }
}
