<style>
    .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
</style>

<div class="container">
    <div class="row">
        <div class="span12">
            <div class="thumbnail">
                <div class="hero-unit center">
                    <h1>You are not authorized to access <small><font face="Tahoma" color="red">Error 403</font></small></h1>
                    <br />
                    <p>The page you requested could not be found, either contact your webmaster or try again. Use your browsers <b>Back</b> button to navigate to the page you have prevously come from</p>
                    <p><b>Or you could just press this neat little button:</b></p>
                    <?php
                    $ins_user=Users::model()->findByPk(Yii::app()->session['id']);
                    $insbs64=base64_encode($ins_user->institution_id);
                    $facbs64=base64_encode($ins_user->fac_id);
                    $cubs64=base64_encode($ins_user->course_id);
                    if(Yii::app()->user->getState('role')==='Superuser')
                    {
                        $url=Yii::app()->createUrl('site/index');
                    }
                    else if(Yii::app()->user->getState('role')==='Staff')
                    {
                        $url=Yii::app()->createUrl('site/faculties',array('i'=>$insbs64,'f'=>$facbs64));
                    }?>
                    <a href="<?php echo $url; ?>" class="btn btn-large btn-info">
                        <i class="icon-home icon-white"></i> Take Me Home</a>
                </div>
            </div>

        </div>
    </div>
</div>
