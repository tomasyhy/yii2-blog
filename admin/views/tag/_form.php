<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tag */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(
    [
        'enableClientValidation' => true,
        'options' => ['class' => 'form-horizontal', 'role' => 'form']

    ]
); ?>
<div class="form-body">
    <?= $form->field($model, 'name', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>', 'labelOptions' => ['class' => 'control-label col-md-1']])->textInput(['maxlength' => true]) ?>
</div>

<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-1 col-md-11">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

