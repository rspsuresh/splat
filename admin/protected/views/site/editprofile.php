<style>
    body {background: #EAEAEA;}
    .user-details {position: relative; padding: 0;margin-top:20px;}
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
    .panel-title{color:black !important;}
    /*.footer-sec{bottom:auto !important}*/
</style><div class="container">
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
    </div></div><div class="container-fluid user-assessment">	<p>Edit Profile</p></div>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 user-details">
            <div class="user-image">
                <img src="
               <?php echo Yii::app()->request->baseUrl; ?>/images/user.jpg" width="100px" height="100px" alt="
               <?php  echo ucwords(Yii::app()->session['user']->first_name) ?>" title="Karan Singh Sisodia" class="img-circle">
            </div>
            <div class="user-info-block">
                <div class="user-heading">
                    <h3>
                        <?php echo ucwords(Yii::app()->session['user']->first_name) ?>
                    </h3>
                </div>
                <div class="user-body">
                    <div class="col-xs-12 col-lg-12 col-sm-12">
                        <div class="col-lg-12">
                            <h4 class="modal-title text-center">Change Password</h4>
                        </div>
                        <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'changepassword',
                                'enableClientValidation'=>true,
                                'clientOptions'=>array(
                                    'validateOnSubmit'=>true,
                                ),
                            )); ?>
                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                <div class="col-lg-5 padzero">
                                    <?php echo $form->labelEx($model,'newpassword'); ?>
                                </div>
                                <div class="col-lg-7 padzero formradio">
                                    <?php echo $form->passwordField($model,'newpassword', array('placeholder'=>'New Password')); ?><?php echo $form->error($model,'newpassword'); ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                <div class="col-lg-5 padzero">
                                    <?php echo $form->labelEx($model,'confirmpassword'); ?>
                                </div>
                                <div class="col-lg-7 padzero formradio">
                                    <?php echo $form->passwordField($model,'confirmpassword', array('placeholder'=>'Confirm Password')); ?>
                                    <?php echo $form->error($model,'confirmpassword'); ?>
                                </div>
                            </div>
                            <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>