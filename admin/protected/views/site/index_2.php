<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<section id="wrapper" >
	<div class="hello-admin container-fluid ">
		<div class="text-center hello">
			<h1>Hello <?php echo Yii::app()->session['user']->name; ?></h1>
			<p>This is the area where you can manage the site contents.</p>
		</div>
	</div>
	<div class="container">
		<div class="admin-home">
			<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Admin Home</a></p>
		</div>
		<div class="col-lg-12 padzero">
			<div class="col-lg-5 padzero home-menu">
				<a href="<?php echo Yii::app()->createUrl('site/institutions'); ?>">Manage Institutions</a>
			</div>
			<div class="col-lg-5 padzero home-menu">
				<a href="<?php echo Yii::app()->createUrl('sadmin/admin'); ?>">Manage all Admins</a>
			</div>
			<div class="col-lg-5 padzero home-menu">
				<a href="<?php echo Yii::app()->createUrl('users/admin'); ?>">Manage all Users</a>
			</div>
		</div>
	</div>
</section>