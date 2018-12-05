<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sadmin-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<section id="wrapper12" >
    <div class="container">
        <div class="user-institute">
            <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Manage Admins</b></p>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Manage Admins</p>
    </div>
    <div class="container">
        <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn btn-success admin-btn')); ?>
        <?php echo CHtml::link('Add a Admin', Yii::app()->createUrl('sadmin/create'),array('class'=>'admin-btn btn btn-info')); ?>
        <?php echo CHtml::link('Bulk Import Admin',Yii::app()->createUrl('sadmin/create'),array('class'=>'admin-btn btn btn-warning')); ?>
        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'sadmin-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                'id',
                'username',
                array(
                    'header' => 'role',
                    'filter' => CHtml::dropDownlist('Sadmin[role]', $model->role, CHtml::listData(Userrole::model()->findAll(), "id", "name"), array('empty' => 'Select User Role')),
                    'value'=>'$data->getrole()',
                ),
                array(
                    'header' => 'course_id',
                    'filter' => CHtml::dropDownlist('Sadmin[course_id]', $model->role, CHtml::listData(Courses::model()->findAll(), "id", "name"), array('empty' => 'Select')),
                    'value'=>'$data->courses->name',
                ),
                array(
                    'header' => 'ins_id',
                    'filter' => CHtml::dropDownlist('Sadmin[ins_id]', $model->role, CHtml::listData(Institutions::model()->findAll(), "id", "name"), array('empty' => 'Select')),
                    'value'=>'$data->institution->name',
                ),
                array(
                    'header' => 'fac_id',
                    'filter' => CHtml::dropDownlist('Sadmin[fac_id]', $model->role, CHtml::listData(Faculties::model()->findAll(), "id", "name"), array('empty' => 'Select ')),
                    'value'=>'$data->faculties->name',
                ),
                'name',
                'status',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </div>
</section>