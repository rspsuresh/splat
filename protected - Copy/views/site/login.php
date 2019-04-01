<!DOCTYPE html>
<html >
	<head>
		<title>Splat - Login</title>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-icon-72x72.png" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-icon-72x72.png" type="image/x-icon">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/css/style.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/css/form.css">  
	</head>

	<body style="background-color:#27282B">
		<div class="container-admin">
			<div class="login form">
				<div class="thumbnails" style="background:none !important;margin-bottom:0;">
					<a class="navbar-brand" href="#"><img  style="width:140px;height:40px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/SPLAT logo new.png"></a>
				</div>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>
					<div class="row">
						<?php echo $form->textField($model,'username',array('placeholder'=>'Username')); ?>
						<?php echo $form->error($model,'username'); ?>
					</div>
					<div class="row">
						<?php echo $form->passwordField($model,'password', array('placeholder'=>'Password')); ?>
						<?php echo $form->error($model,'password'); ?>
					</div>
					<?php echo CHtml::submitButton('Login',array('class'=>'login-button')); ?>
					<?php //echo CHtml::submitButton('Signup',array('class'=>'login-button','id'=>'register')); ?>
				<?php $this->endWidget(); ?>
				<form method="post" id="signup-form" >
					<div class="row">
						<input placeholder="Email" name="regemail" id="regemail" type="text" required>
						<div class="errorMessage" id="LoginForm_email_em_" style="display:none;"></div>
					</div>
					<!--<input class="login-button" id="registersubmit" type="submit"  name="submit" value="Signup" style="display: inline-block;">-->
				</form>				<a href="<?php echo Yii::app()->createUrl('site/forgot'); ?>" style="float:right;color:#00B9D1;">Forgot Password?</a>
			</div>
		</div>
		<script src="<?php echo Yii::app()->request->baseUrl;?>/js/bootstrap.min.js"></script>
	</body>
</html>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/notify.js"></script>
<?php
if(Yii::app()->user->hasFlash('success')):
    echo '<script>
				$.notify("'.Yii::app()->user->getFlash('success').'", "success");
				</script>';
endif;
if(Yii::app()->user->hasFlash('error')):
    echo '<script>
				$.notify("'.Yii::app()->user->getFlash('error').'", "error");
				</script>';
endif;
?>
<script>
 $(document).ready(function(){
	$("#regemail").hide(); 
	$("#registersubmit").hide();
 });
$("#register").click(function(){
   $("#regemail").show();
   $("#registersubmit").show();
   $("#login-form").hide();
    return false; 
});
 $('#signup-form').on('submit', function (e) {
          e.preventDefault();
		  	$.ajax({
                                    url: '<?php echo Yii::app()->createUrl('usersRegistration/registration') ?>',
                                    type: "post",
									data:{email:$("#regemail").val()},
                                    success: function (data) {
                                        var obj = JSON.parse(data);
                                        console.log(obj);
                                        if(obj.status=='S')
                                        {
                                            $.notify(obj.msg, "success");
                                        }
                                        else if(obj.status=='A')
                                        {
                                            $.notify(obj.msg, "error");
                                        }
                                    }
                                });
 });
</script>