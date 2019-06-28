<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="en">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-icon-72x72.png" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-icon-72x72.png" type="image/x-icon">
		<!-- blueprint CSS framework -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
		<![endif]-->

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
		<?php $cs = Yii::app()->clientScript;
        $cs->coreScriptPosition = CClientScript::POS_HEAD;
        $cs->registerCoreScript('jquery');?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css">
		 <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/chosen.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/chosen.css">
	</head>

	<body>
		<header class="header">
			<div class="container">
				<div class="col-lg-12 col-xs-12 col-sm-12 padzero header-top">
					<div class="col-lg-3 col-xs-12 col-sm-3 float-left padzero">
						<a href="<?php echo Yii::app()->createUrl("site/index")?>">
                            <img  style="height:50px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/SPLAT-logo.gif"></a>
					</div>
					<div class="col-lg-6 col-xs-8 col-sm-6 padzero text-center">
						
					</div>
					<?php 
					  if(isset(Yii::app()->session['id']) && !empty(Yii::app()->session['id'])) { 
					  $modeluser=Users::model()->findByPk(Yii::app()->session['id']); 
					  $path=$modeluser->profile?"images/profile/".$modeluser->profile:"images/default.png";
					 ?>
					<div class="col-lg-3 col-xs-12 col-sm-3 text-right padzero user">
						<a href="javascript:void(0);" class='dropdown-toggle' id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><?php echo ucfirst($modeluser->first_name.' '.$modeluser->last_name); ?></span>
                            <img onerror="this.onerror=null;this.src='<?php echo Yii::app()->request->baseUrl; ?>/images/default.png';" style="width:45px;height:45px;" class="img-circle" src="<?php echo  Yii::app()->request->baseUrl."/".$path?>">
                            <i class="fa fa-caret-down" aria-hidden="true"style="color:#fff"></i></a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width:100%;padding:2px;">
                            <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('site/editprofile'); ?>" style="width:100%;background:#00B9D1;color:#ffffff;padding:10px;display:block;border-bottom:2px solid;">
                                Edit Profile</a>
							<a class="dropdown-item" href="<?php echo Yii::app()->createUrl('site/logout'); ?>" style="width:100%;background:#00B9D1;color:#ffffff;padding:10px;display:block;border-bottom:2px black;">Logout</a>

						</div>
					</div>
					  <?php } ?>
				</div> 
			</div>
		</header>

		<?php echo $content; ?>
		
		<div class="clear"></div>
		<footer class="footer-sec col-xs-12 col-lg-12 col-sm-12">
			<div class="container">
				<div class="col-lg-12 col-xs-12 col-sm-12 padzero">
                    <div class="col-lg-7 col-xs-12 col-sm-7">
                        <ul class="footer-menu" style="margin-right: 78px;">
                            <li><a target="_blank" href="https://www1.bournemouth.ac.uk/about/governance/digital-security/website-privacy-cookies-policy">Privacy policy</a></li>
                        </ul>
                        <p class="copyright">&copy; Copyright <?php echo date('Y');?> SPLAT</p>
                    </div>
					<div class="col-lg-5 col-xs-12 col-sm-5 text-right footer-logo">
						<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"></a>
					</div>
				</div>
			</div>
		</footer>
		<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>-->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/notify.js"></script>
		<script>
			$(document).ready(function(){
				// Toggle plus minus icon on show hide of collapse element
				$(".collapse").on('show.bs.collapse', function(){
					$(this).parent().find('i').removeClass("fa fa-angle-right").addClass("fa fa-angle-down");
				}).on('hide.bs.collapse', function(){
					$(this).parent().find('i').removeClass("fa fa-angle-down").addClass("fa fa-angle-right");
				});
			});
		</script>
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
	</body>   
</html>
