<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <a href="<?php echo Yii::app()->createUrl('users/admin'); ?>">Manage Users</a></p>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Update Admin #<?php echo $model->id; ?></p>
    </div>
    <div class="container">
        <br/><?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>