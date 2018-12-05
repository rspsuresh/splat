<?php
/* @var $this MappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mappings',
);

$this->menu=array(
	array('label'=>'Create Mapping', 'url'=>array('create')),
	array('label'=>'Manage Mapping', 'url'=>array('admin')),
);
?>

<h1>Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
