<section id="wrapper" >

	<div class="container">

		<div class="user-institute">

			<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <a href="<?php echo Yii::app()->createUrl('groups/admin'); ?>">Manage Groups</a></p>

		</div>

	</div>

	<div class="container-fluid user-assessment row">
<h1>View Groups #<?php echo $model->id; ?></h1></div><div class="container">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'status',
		'created_date',
		'updated_date',
	),
)); ?></div>
</section>