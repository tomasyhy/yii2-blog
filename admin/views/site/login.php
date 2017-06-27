<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');

?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableClientValidation' => true,
        ]);
        ?>

        <?= $form->field($model, 'login')->textInput(['class' => 'form-control', 'placeholder' => Yii::t('app', 'Username')])->label(false); ?>

        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => Yii::t('app', 'Password')])->label(false); ?>

        <div class="form-actions">
            <?php echo Html::submitButton(Yii::t('app', 'Log in'), ['class' => 'btn btn-success']); ?>
        </div>


        <?php ActiveForm::end(); ?>

    </div>
</div>

