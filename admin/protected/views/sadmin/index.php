<?php
/* @var $this SadminController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sadmins',
);

$this->menu=array(
	array('label'=>'Create Sadmin', 'url'=>array('create')),
	array('label'=>'Manage Sadmin', 'url'=>array('admin')),
);
?>

<h1>Sadmins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
