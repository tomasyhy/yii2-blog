<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;

$this->title = Yii::t('app', 'Contact' . ' - ' .(Yii::$app->params['appName'] ?? Yii::$app->name));

?>
    <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
    <?= Alert::widget() ?>
    <p>
        If you have business inquiries or other questions, please fill out the following form to contact me. Thank you.
    </p>
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'placeholder' => 'Name'])->label(false) ?>

                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>

                    <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject'])->label(false) ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => 'Message'])->label(false) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>', 'options' => ['placeholder' => 'Verification Code', 'class' => 'form-control']
                    ])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>