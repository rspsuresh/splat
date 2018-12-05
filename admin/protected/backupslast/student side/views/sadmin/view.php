
<h1>View Sadmin #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'name',
		'status',
		'created_date',
		'updated_date',
	),
)); ?>
