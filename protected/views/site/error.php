<?php
$this->pageTitle=Yii::app()->name . ' - Error';
?>
<h2>Error <?php echo $code; ?></h2>
<div class="error">
  <img src="<?=Yii::app()->request->baseUrl."images/$code"."png"?>">
</div>