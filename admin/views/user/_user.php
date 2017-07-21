<?php

use admin\assets\{SummernoteAsset};

SummernoteAsset::register($this);

?>

<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'password')->passwordInput() ?>

<?= $form->field($user, 'about_me')->textarea(['class' => 'form-control', 'id' => 'summernote']) ?>

<?php $this->registerJsFile('admin/js/about.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>


