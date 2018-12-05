<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <p>You are here: <a href="<?=Yii::app()->session['homeurl']?>
">Home</a> / <a  href="#" onclick="return window.history.back()">Manage Users</a></p>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Update Users #<?php echo $model->id; ?></p>
    </div>
    <div class="container">
        <br/><?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>