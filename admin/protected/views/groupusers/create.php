<section id="wrapper" >
	<div class="container">
		<div class="user-institute">
			<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <a href="<?php echo Yii::app()->createUrl('groupUsers/admin'); ?>">Manage Group Users</a></p>
		</div>
	</div>

	<div class="container-fluid user-assessment row">
		<p>Update Group Users <?php echo $model->id; ?></p>
	</div>

	<div class="container">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</section>