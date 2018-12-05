<?php
/* @var $this GroupmasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groupmasters',
);

$this->menu=array(
	array('label'=>'Create Groupmaster', 'url'=>array('create')),
	array('label'=>'Manage Groupmaster', 'url'=>array('admin')),
);
?>

<h1>Groupmasters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
