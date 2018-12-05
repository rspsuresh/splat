<?php
/* @var $this UsersRegistrationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users Registrations',
);

$this->menu=array(
	array('label'=>'Create UsersRegistration', 'url'=>array('create')),
	array('label'=>'Manage UsersRegistration', 'url'=>array('admin')),
);
?>

<h1>Users Registrations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
