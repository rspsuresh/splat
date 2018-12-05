<?php
/* @var $this UsersRegistrationController */
/* @var $model UsersRegistration */

$this->breadcrumbs=array(
	'Users Registrations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsersRegistration', 'url'=>array('index')),
	array('label'=>'Create UsersRegistration', 'url'=>array('create')),
	array('label'=>'View UsersRegistration', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UsersRegistration', 'url'=>array('admin')),
);
?>

<h1>Update UsersRegistration <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>