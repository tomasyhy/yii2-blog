<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');

?>

<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'enableClientValidation' => true,
    'options' => ['class' => 'login-form']
]);
?>

<?= $form->field($model, 'login')->textInput(['class' => 'form-control form-control-solid placeholder-no-fix', 'placeholder' => Yii::t('app', 'Username')])->label(false); ?>

<?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-solid placeholder-no-fix', 'placeholder' => Yii::t('app', 'Password')])->label(false); ?>

<div class="form-actions">
    <?php echo Html::submitButton(Yii::t('app', 'Log in'), ['class' => 'btn green uppercase']); ?>
</div>


<?php ActiveForm::end(); ?>


