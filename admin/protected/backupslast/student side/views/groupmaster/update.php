<section id="wrapper" >
     <br>
    <div class="container-fluid user-assessment">
        <p>Update Group #<?php echo $model->id; ?></p>
    </div>
    <div class="container">
        <br/><?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>