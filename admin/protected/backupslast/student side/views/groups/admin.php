
<?php

/* @var $this GroupsdumController */
/* @var $model Groupsdum */

$this->breadcrumbs=array(
    'Groupsdums'=>array('index'),
    'Manage',
);


$this->menu=array(
    array('label'=>'List Groupsdum', 'url'=>array('index')),
    array('label'=>'Create Groupsdum', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#groupsdum-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Groups</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'groupsdum-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'name',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
