<?php
/* @var $this GroupUsersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Group Users',
);

$this->menu=array(
	array('label'=>'Create GroupUsers', 'url'=>array('create')),
	array('label'=>'Manage GroupUsers', 'url'=>array('admin')),
);
?>

<h1>Group Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
