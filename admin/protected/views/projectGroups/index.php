<?php
/* @var $this ProjectGroupsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Project Groups',
);

$this->menu=array(
	array('label'=>'Create ProjectGroups', 'url'=>array('create')),
	array('label'=>'Manage ProjectGroups', 'url'=>array('admin')),
);
?>

<h1>Project Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
