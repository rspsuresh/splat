<?php
/* @var $this UsersRegistrationController */
/* @var $model UsersRegistration */

$this->breadcrumbs=array(
	'Users Registrations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UsersRegistration', 'url'=>array('index')),
	array('label'=>'Create UsersRegistration', 'url'=>array('create')),
	array('label'=>'Update UsersRegistration', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UsersRegistration', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsersRegistration', 'url'=>array('admin')),
);
?>

<h1>View UsersRegistration #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'first_name',
		'last_name',
		'profile',
		'status',
		'created_date',
		'updated_date',
	),
)); ?>
