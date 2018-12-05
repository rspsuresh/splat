
<?php

/* @var $this GroupsdumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groupsdums',
);


$this->menu=array(
	array('label'=>'Create Groupsdum', 'url'=>array('create')),
	array('label'=>'Manage Groupsdum', 'url'=>array('admin')),
);
?>

<h1>Groupsdums</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
