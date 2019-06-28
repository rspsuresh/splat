
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
    .user-info-block .user-body {float: left; padding: 5%; width: 100%;}
    .user-body .tab-content > div {float: left; width: 100%;}
    .user-body .tab-content h4 {width: 100%; margin: 10px 0; color: #333;}
    #content{min-height: 700px !important;}
    .panel-body{padding:10px; }
    .errorMessage{color:red !important;}
    #content{min-height:850px !important;}
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 user-details">
            <div class="user-image" >
                <?php   $modeluser=Users::model()->findByPk(Yii::app()->session['id']);
                $path=$modeluser->profile?"images/profile/".$modeluser->profile:"images/user.jpg";?>
                <img id="showpic" class="img-circle" style="width:100px;height:100px;"
                     src="<?php echo  Yii::app()->request->baseUrl."/".$path?>"  onclick="Imagebrowse(this);" onerror="this.src='<?php echo Yii::app()->request->baseUrl; ?>/images/user.jpg';" /> <img id="blah" src="#" alt="your image" style="display: none;width:100px;height:100px;border-radius:50px;" onclick="Imagebrowse(this);"   />
                <input type="hidden" name="imageurl" id="imageurl" value="">
            </div>
            <form method="post"  id="yourFormID" method="post" enctype="multipart/form-data" >
                <input type="file" class="imageupload" id="file" name="file"  style="display: none;" />
            </form>
            <div class="user-info-block">
                <div class="user-heading">
                    <h3><?php echo ucfirst($modeluser->first_name.' '.$modeluser->last_name); ?></h3>
                </div>
                <ul class="navigation">
                    <li class=" col-lg-6 col-md-6 col-xs-6  active">
                        <a data-toggle="tab" class="col-lg-12" href="#information">
                            <span class="glyphicon glyphicon-user" style="font-size:15px;word-spacing:-7px;"> Profile Information</span>
                        </a>
                    </li>
                    <li class="col-lg-6 col-md-6 col-xs-6">
                        <a data-toggle="tab" class="col-lg-12" href="#changepassword">
                            <span class="glyphicon glyphicon-wrench" style="font-size:15px;word-spacing:-7px;"> Change Password</span>
                        </a>
                    </li>
                </ul>
                <div class="user-body">
                    <div class="tab-content">
                        <div id="information" class="tab-pane active">
                            <div id="editform" style="display:none;">
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading" style="padding-bottom:35px;">
                                            <h3 class="panel-title" style="color:white;padding-left:15px;width:70%;float:left;">Edit Profile</h3>
                                            <div class="fa fa-user viewprofile" style="font-size:15px;float:right;color:#ffffff;"> View Profile&nbsp;&nbsp;</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form">
                                                <?php $form=$this->beginWidget('CActiveForm', array(
                                                    'id'=>'users-form','enableClientValidation'=>true,
                                                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                                                    'clientOptions'=>array('validateOnSubmit'=>true),
                                                )); ?>
                                               <!-- <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                    <div class="col-lg-4 padzero">
                                                        <?php /*echo $form->labelEx($usermodel,'username'); */?>
                                                    </div>
                                                    <div class="col-lg-4 padzero">
                                                        <?php /*echo $form->textField($usermodel,'username',array('size'=>60,'maxlength'=>255,
                                                            'placeholder'=>'User Name','readonly'=>true)); */?>
                                                        <?php /*echo $form->error($usermodel,'username'); */?>
                                                    </div>
                                                </div>-->
                                                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                    <div class="col-lg-4 padzero">
                                                        <?php echo $form->labelEx($usermodel,'first_name'); ?>
                                                    </div>
                                                    <div class="col-lg-4 padzero">
                                                        <?php echo $form->textField($usermodel,'first_name',array('size'=>60,'maxlength'=>255,
                                                            'placeholder'=>'First Name')); ?>
                                                        <?php echo $form->error($usermodel,'first_name'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                    <div class="col-lg-4 padzero"><?php echo $form->labelEx($usermodel,'last_name'); ?>
                                                    </div><div class="col-lg-4 padzero">
                                                        <?php echo $form->textField($usermodel,'last_name',
                                                            array('size'=>60,'maxlength'=>255,'placeholder'=>'First Name')); ?>														<?php echo $form->error($usermodel,'last_name'); ?>													</div>												</div>												<div class="col-xs-8 col-lg-8 col-sm-8 course-field padzero">													<div class="col-lg-6 padzero">														<?php echo $form->labelEx($usermodel,'profile'); ?>
                                                    </div>
                                                    <div class="col-lg-6 padzero">
                                                        <?php echo $form->fileField($usermodel, 'profile');?>
                                                        <?php echo $form->error($usermodel,'profile'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="col-lg-8 padzero">

                                                        <?php
                                                        $modeluser=Users::model()->findByPk(Yii::app()->session['id']);
                                                        $path=$modeluser->profile?"images/profile/".$modeluser->profile:"images/user.jpg";?>
                                                        <img style="width:100px" src="<?php echo  Yii::app()->request->baseUrl."/".$path?>">
                                                    </div>
                                                </div>
                                                <?php echo CHtml::submitButton($usermodel->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
                                                <?php $this->endWidget(); ?>
                                            </div><!-- form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="viewform">
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12 col-xs-offset-0 col-sm-offset-0
                           col-md-offset-1 col-lg-offset-1" style="margin-left: 0px;">
                                    <div class="panel panel-primary" style="width: 500px;">
                                        <div class="panel-heading" style="padding-bottom:35px;">
                                            <h3 class="panel-title" style="color:white;padding-left:15px;width:70%;float:left">User information</h3>
                                            <div class="fa fa-pencil editprofile" style="font-size:15px;float:right;color:#ffffff;"> Edit Profile&nbsp;&nbsp;</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-10 col-sm-10 ">
                                                </div>
                                                <div class=" col-md-9 col-lg-12 ">

                                                    <table class="table table-user-information">
                                                        <tbody>
                                                        <tr>
                                                            <td>Email:</td>
                                                            <?php
                                                            //echo "<pre>";print_r($makemodel);die;
                                                            //$users=Users::model()->findAll();echo "<pre>";print_r($users);die;?>
                                                            <td><input type="text" id="fn1" style="border:none;" size="30"
                                                                       readonly value="<?php echo (!empty($makemodel->email))?$makemodel->email:$makemodel->username; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>First Name:</td>
                                                            <td><input type="text" id="fn" style="border:none;" size="30"
                                                                       readonly value="<?php echo $makemodel->first_name; ?>">
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Last Name:</td>
                                                            <td><input type="text" id="ln" style="border:none;"size="30" readonly
                                                                       value="<?php echo $makemodel->last_name; ?>">
                                                                <span style="float:right;">
                                                                    <i class="fa fa-check" aria-hidden="true"
                                                                       id="lncheck" onclick="check('ln')" style="display:none;"></i>

                                                        </tr>
                                                        <tr>
                                                            <td>Status</td>

                                                            <td><?php echo $makemodel->status; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Role</td>
                                                            <td><?php echo ($makemodel->role==1)?"Admin":"Staff"; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>University</td>
                                                            <td><?php echo $makemodel->institution0->name; ?></td>
                                                        </tr>
                                                        <?php if(Yii::app()->user->getState('role') !='Superuser') { ?>
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
                                                        <?php } ?>
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
                                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                                        <?php echo $form->passwordField($model,'newpassword', array('placeholder'=>'Newpassword','class'=>'form-control'));?>
                                                        <?php echo $form->error($model,'newpassword'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-cog"></span></div>
                                                        <?php echo $form->passwordField($model,'confirmpassword', array('placeholder'=>'Confirm Password','class'=>'form-control'));?>
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
<script>

    function pencil(id)
    {
        if(id=='fn')
        {
            $('.fnpencil').hide();
            $("#fn").attr("readonly", false).css("border","1px solid gray");
            $("#fntimes,#fncheck").show();
        }
        else if(id=='ln')
        {
            $('.lnpencil').hide();
            $("#ln").attr("readonly", false).css("border","1px solid gray");
            $("#lntimes,#lncheck").show();
        }
    }
    function check(id)
    {
        var url='<?php echo Yii::app()->createUrl('site/namechange') ?>';
        if(!$("#"+id).val())
        {
            $.ajax({
                url:url,
                type: 'post',
                data: {name: $("#"+id).val(),type:id},
                dataType:'json',
                success: function (data) {
                    if(id=='fn')
                    {
                        $('#fn').val(data).css("border","none");
                        $("#fncheck,#fntimes").hide();
                        $(".fnpencil").show();
                        $.notify("Firstname changed succesfully", "success");
                    }
                    else if(id=='ln')
                    {
                        $('#ln').val(data).css("border","none");
                        $("#lncheck,#lntimes").hide();
                        $(".lnpencil").show();
                        $.notify("Lastname changed succesfully", "success");

                    }
                }
            });
        }

    }
    function times(id)
    {       $('#'+id).css("border","none");
        if(id=='fn')
        {

            $("#fncheck,#fntimes").hide();
            $(".fnpencil").show();
        }
        else if(id=='ln')
        {
            $("#lncheck,#lntimes").hide();
            $(".lnpencil").show();
        }

    }
    function Imagebrowse(id) {
        var id = $(id)[0].id;
        $("#file" ).click();
        $('#file').change(function() {
            readURL(this);

        });
    }

    function readURL(input, value) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();
            var id = value;
            reader.onload = function(e) {
                $("#showpic").hide();
                $("#blah").show();
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);

        }
    }
    function procheck()
    {

        var formData = new FormData($('#yourFormID')[0]);
        //formData.append('file', $('input[type=file]')[0].files[0]);
        var url='<?php echo Yii::app()->createUrl('site/profileimage') ?>';
        $.ajax({
            url:url,
            type: 'post',
            data:new FormData(),
            dataType:'json',
            processData:false,
            success: function (data) {

            }
        });
    }
    $(document).ready(function(){
        $('.editprofile').click(function(){
            $('#viewform').hide();
            $('#editform').show();
        });
        $('.viewprofile').click(function(){
            $('#editform').hide();
            $('#viewform').show();
        });
    });
</script>