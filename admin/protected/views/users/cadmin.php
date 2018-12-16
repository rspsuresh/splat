<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>
    .view
    {
        display:none;
    }
    .btn-bs-file{
        position:relative;
    }
    .btn-bs-file input[type="file"]{
        position: absolute;
        filter: alpha(opacity=0);
        opacity: 0;
        width:0;
        height:0;
        outline: none;
        cursor: inherit;
    }
</style>
<?php
$institution = Institutions::model()->find('id='.base64_decode($_GET['i']));
$faculty = Faculties::model()->find('id='.base64_decode($_GET['f']));
$course = Courses::model()->find('id='.base64_decode($_GET['c']));
?>
<section id="wrapper" >
    <div class="container text-center">

    </div>
    <div class="container">
        <div class="user-institute">
            <?php  if(Yii::app()->user->getState('role')=='Superuser')
            {?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/faculties',
                        array('i'=>base64_encode($institution->id)));?>">Faculties</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>base64_encode($institution->id),
                        'f'=>base64_encode($faculty->id)));?>"><?php echo ucfirst($faculty->name);?></a> /
                    <a href="<?=Yii::app()->createUrl('site/courseitems',array('c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i']))?>"><?php echo ucfirst($course->name); ?></a> / <b>Users</b></p>
            <?php }
            else { ?>
                <a>You are here: <a href="<?php echo Yii::app()->createUrl('site/faculties',
                        array('i'=>base64_encode($institution->id)));?>">Faculties</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/courses',
                        array('i'=>base64_encode($institution->id),
                            'f'=>base64_encode($faculty->id)));?>">
                        <?php echo ucfirst($faculty->name);?></a> /
                    <a href="<?=Yii::app()->createUrl('site/courseitems',array('c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i']))?>"><?php echo ucfirst($course->name); ?></a> / <b>Users</b>
            <?php } ?>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Manage Course Users</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12" style="margin-top:30px;">
                <?php echo CHtml::link('Add a student to the course', Yii::app()->createUrl('users/ccreate',
                    array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'])),
                    array('class'=>'admin-btn btn btn-info')); ?>
                <label class="admin-btn btn-bs-file btn btn-info" title="Browse user">
                    Bulk import students
                    <?php
                    $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'bulk-import',
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    ?>
                    <input type="file" value="Bulk Import"  id="bulk_import" name="csv_file" accept=".csv" />
                    <?php  $this->endWidget();?>
                </label>
                <a href="<?= Yii::app()->CreateUrl('site/courseItems',array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f']))?>">
                    <button class="admin-btn btn-bs-file btn btn-info" title="Back">
                    Back
                </button></a>
            </div>
            <div class="col-lg-12" style="padding-top: 10px">
               <p><span style="color:red;"><a href="#">
          <span class="glyphicon glyphicon-info-sign"></span>
        </a>   The file should only be in .csv format.
                        Please download and refer to the attached file
                        <a  onclick='download1()'>Splat_Bulk_import.csv</a></span></p>
            </div>
        </div>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'users-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                'username',
                'first_name',
                'last_name',
                /*array(
                    'name' => 'username',
                    'filter' => CHtml::activeTextField($model,'username',''),
                ),
                array(
                    'name' => 'first_name',
                    'filter' => CHtml::activeTextField($model,'first_name',''),
                ),
                array(
                    'name' => 'user.last_name',
                    'filter' => CHtml::activeTextField($model,'last_name',''),
                ),*/
                /*array(
                    'class'=>'CButtonColumn',
                ),*/
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>'$this->grid->controller->createUrl("/users/update", array("id"=>$data->id,"c"=>$_GET["c"],"i"=>$_GET["i"],"f"=>$_GET["f"]))',
                        ),
                    ),
                ),
            ),
        )); ?>
    </div>
</section>
<script type="text/javascript">
    $(function () {
        $('input').addClass('form-control');
        $('#bulk_import').change(function(){
            $('#bulk-import').submit();
        });
        function download()
        {
            window.location.href='<?php echo Yii::app()->CreateUrl('users/download')?>';
        }
    });

</script>
<script>
    function download1()
    {
        window.location.href='<?php echo Yii::app()->CreateUrl('users/download')?>';
    }
    $('#Users_username').on('focus', function() {
    });
</script>