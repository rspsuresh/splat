<?php
/* @var $this QuestionsadminController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Questionsadmins',
);

$this->menu=array(
	array('label'=>'Create Questionsadmin', 'url'=>array('create')),
	array('label'=>'Manage Questionsadmin', 'url'=>array('admin')),
);
?>

<h1>Questionsadmins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
