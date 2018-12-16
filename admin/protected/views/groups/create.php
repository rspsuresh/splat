<?php
$institution = Institutions::model()->find('id='.base64_decode($_GET['i']));
$faculty = Faculties::model()->find('id='.base64_decode($_GET['f']));
$course = Courses::model()->find('id='.base64_decode($_GET['c']));
$project=Projects::model()->findByPk($_GET['p']);
?>
<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <?php  if(Yii::app()->user->getState('role')=='Superuser')
            { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($institution->id)));?>">Faculties</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>base64_encode($institution->id),'f'=>base64_encode($faculty->id)));?>">
                        <?php echo ucfirst($faculty->name);?></a> /
                    <a href="<?= Yii::app()->createUrl('site/courseitems',
                        array('c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i']))?>"><?php echo ucfirst($course->name); ?></a>
                    / <a onclick="window.history.back()"
                         href="#"><?=$project->name?></a> / <b>Group</b></p>
            <?php }
            else { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($institution->id)));?>">Faculties</a>
                    / <a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>base64_encode($institution->id),'f'=>base64_encode($faculty->id)));?>">
                        <?php echo ucfirst($faculty->name);?></a> /<a href="<?= Yii::app()->createUrl('users/cadmin',
                        array('c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i']))?>"><?php echo ucfirst($course->name); ?></a> / <b>Add Users to Course</b></p>
            <?php } ?>
            <!--<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Add Users to course</b></p>-->
        </div>
    </div>
    <div class="container">

        <div class="user-institute">

            <!--<p>You are here: <a href="<?=Yii::app()->session['homeurl']?>">Home</a> /
                <a href="#">Create Group</a></p>-->

        </div>

    </div>

    <div class="container-fluid user-assessment row">

        <p>Create Groups</p>

    </div>

    <div class="container">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</section>
