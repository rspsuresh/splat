<!DOCTYPE html>
<html >
	<head>
		<title>Splat - Forgot</title>
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
				<div class="thumbnails" style="background:none !important;">
					<a class="navbar-brand" href="#"><img  style="width:140px;height:40px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/SPLAT logo new.png"></a>
				</div>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'forgot-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>
					<div class="row">
						<?php echo $form->textField($model,'username',array('placeholder'=>'Username')); ?>
						<?php echo $form->error($model,'username'); ?>
					</div>
					<?php echo CHtml::submitButton('Forgot',array('class'=>'login-button')); ?>
				<?php $this->endWidget(); ?>
                <a href="<?php echo Yii::app()->createUrl('site/login'); ?>" style="float:right;color:#00B9D1;">Login Page</a>
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