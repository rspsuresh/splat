
<style>
    body {background: #EAEAEA;}
    .user-details {position: relative; padding: 0;}
    .user-details .user-image {position: relative;  z-index: 1; width: 100%; text-align: center;}
    .user-image img { clear: both; margin: auto; position: relative;}

    .user-details .user-info-block {width: 100%; position: absolute; top: 55px; background: rgb(255, 255, 255); z-index: 0; padding-top: 35px;}
    .user-info-block .user-heading {width: 100%; text-align: center; margin: 10px 0 0;}
    .user-info-block .navigation {float: left; width: 100%; margin: 0; padding: 0; list-style: none; border-bottom: 1px solid #428BCA; border-top: 1px solid #428BCA;}
    .navigation li {float: left; margin: 0; padding: 0;}
    .navigation li a {padding: 20px 30px; float: left;}
    .navigation li.active a {background: #428BCA; color: #fff;}
    .user-info-block .user-body {float: left; padding: 5%; width: 90%;}
    .user-body .tab-content > div {float: left; width: 100%;}
    .user-body .tab-content h4 {width: 100%; margin: 10px 0; color: #333;}
    #content{min-height: 700px !important;}
    .panel-body{padding:10px; }
    .errorMessage{color:red !important;}
    #content
    {
        height:900px !important;
    }
</style>
<div class="container">
    <div class="user-institute">
        <?php
        if(Yii::app()->user->getState('role')==='Staff') {
            $ins_user=Users::model()->findByPk(Yii::app()->session['id']);
            $insbs64=base64_encode($ins_user->institution_id);
            $facbs64=base64_encode($ins_user->fac_id);
            $cubs64=base64_encode($ins_user->course_id);
            $action=Yii::app()->createUrl('site/faculties',array("i"=>$insbs64,"f"=>$facbs64));
        }  else {
            $action=Yii::app()->createUrl('site/index');
        }  ?>
        <p>You are here: <a  class="udline" href="<?php echo $action ?>">Home</a> / <b>Edit Profile</b></p>
    </div>
</div>
<div class="container-fluid user-assessment">	<p>Edit Profile</p></div>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 user-details">
            <div class="user-image" >
                <?php   $modeluser=Users::model()->findByPk(Yii::app()->session['id']);
                $path=$modeluser->profile?"images/profile/".$modeluser->profile:"images/user.jpg";?>
                <img id="showpic" class="img-circle" style="width:100px;height:100px;" src="<?php echo  Yii::app()->request->baseUrl."/".$path?>"  onclick="Imagebrowse(this);" onerror="this.src='<?php echo Yii::app()->request->baseUrl; ?>/images/user.jpg';" /> <img id="blah" src="#" alt="your image" style="display: none;width:100px;height:100px;border-radius:50px;" onclick="Imagebrowse(this);"   />
                <input type="hidden" name="imageurl" id="imageurl" value="">
            </div>
            <form method="post"  id="yourFormID" method="post" enctype="multipart/form-data" >
                <input type="file" class="imageupload" id="file" name="file"  style="display: none;" />
            </form>
            <div class="user-info-block">
                <div class="user-heading">
                    <h3><?php echo ucfirst($modeluser->first_name.' '.$modeluser->last_name); ?><span>
                             (Staff) </span></h3>
                </div>
                <ul class="navigation">
                    <li class=" col-lg-6 active">
                        <a data-toggle="tab" class="col-lg-12" href="#information">
                            <span class="glyphicon glyphicon-user" style="font-size:15px;word-spacing:-7px;"> Profile Information</span>
                        </a>
                    </li>
                    <li class="col-lg-6">
                        <a data-toggle="tab" class="col-lg-12" href="#changepassword">
                            <span class="glyphicon glyphicon-wrench" style="font-size:15px;word-spacing:-7px;"> Change Password</span>
                        </a>
                    </li>
                </ul>
                <div class="user-body">
                    <div class="tab-content">
                        <div id="information" class="tab-pane active">
                            <div id="viewform">
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12 col-xs-offset-0 col-sm-offset-0
                           col-md-offset-1 col-lg-offset-1">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading" style="padding-bottom:35px;">
                                            <h3 class="panel-title" style="color:white;padding-left:15px;width:70%;float:left">User information</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-10 col-sm-10 hidden-md hidden-lg">
                                                </div>

                                                <div class=" col-md-9 col-lg-12 hidden-xs hidden-sm">
                                                    <table class="table table-user-information">
                                                        <tbody>
                                                        <tr>
                                                            <td>First Name:</td>
                                                            <td><p><?php echo rtrim($modeluser->first_name)?></p></td>
                                                        </tr>
                                                        <tr>
                                                            <?php $lastnmae=$modeluser->last_name?$modeluser->last_name:"-";?>
                                                            <td>Last Name:</td>
                                                            <td> <?php echo trim($lastnmae)?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>User Email:</td>
                                                            <td> <?php echo trim($modeluser->email)?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status</td>
                                                            <td><?php echo $modeluser->status; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>University</td>
                                                            <td><?php echo $modeluser->institution0->name; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            $sql="SELECT GROUP_CONCAT(f.name separator '<br>') as faculty FROM `user_faculties` as uf
                                                                  join faculties as f on  uf.faculty_id=f.id 
                                                                  where uf.user_id='".Yii::app()->session['id']."'";
                                                            $result = Yii::app()->db->createCommand($sql)->queryAll(); ?>
                                                            <td>Faculty</td>
                                                            <td><?php echo ($result[0]['faculty'])?$result[0]['faculty']:"-"; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            $sqlcourse="SELECT GROUP_CONCAT(c.name separator '<br>') as course FROM `user_courses` as uc 
                                                                   join courses as c on uc.course_id=c.id
                                                                  WHERE uc.`user_id` ='".Yii::app()->session['id']."'";
                                                            $resultcourse = Yii::app()->db->createCommand($sqlcourse)->queryAll();
                                                            ?>
                                                            <td>Course</td>
                                                            <td><?php echo ($resultcourse[0]['course'])?$resultcourse[0]['course']:"-"; ?></td>
                                                        </tr>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>			</div>
                        </div>
                        <div id="settings" class="tab-pane">
                            <h4>Settings</h4>
                        </div>
                        <div id="changepassword" class="tab-pane">
                            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-2">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title" style="color:white;padding-left:15px"> Change password</h3></div>
                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'changepassword',
                                    'enableClientValidation'=>true,
                                    'clientOptions'=>array(
                                    'validateOnSubmit'=>true,
                                    ),
                                    )); ?>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-10 login-box">
                                                <div class=" form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-lock"></span>
                                                        </div>
                                                        <?php echo $form->passwordField($model,'newpassword',
                                                        array('placeholder'=>'Newpassword','class'=>'form-control'));?>
                                                        <?php echo $form->error($model,'newpassword'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-cog"></span>
                                                        </div>
                                                        <?php echo $form->passwordField($model,'confirmpassword',
                                                        array('placeholder'=>'Newpassword','class'=>'form-control'));?>
                                                        <?php echo $form->error($model,'confirmpassword'); ?>                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6"></div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                                                <?php $this->endWidget(); ?>
                                                <!--<button class="btn icon-btn-save btn-success" type="submit"> <span class="btn-save-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>save</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
