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
        <style>
            .errorMessage { color:red !important;}
        </style>
	</head>

	<body style="background-color:#27282B">
		<div class="container-admin">
			<div class="login form">
				<div class="thumbnails" style="background:none;">
					<a class="navbar-brand" href="#"><img style="width:127px;height:40px;" src="<?php echo Yii::app()->request->baseUrl;?>/images/SPLAT logo new.png"></a>
				</div>
				<?php
                ini_set('display_error', 1);
                $form=$this->beginWidget('CActiveForm', array(
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
					 <!--<a href="#" class="pull-right">Forgot Password ?</a>-->
				<?php $this->endWidget(); ?>
			</div>
		</div>
		<script src="<?php echo Yii::app()->request->baseUrl;?>/js/bootstrap.min.js"></script>
	</body>
</html>