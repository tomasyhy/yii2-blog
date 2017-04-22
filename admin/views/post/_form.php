<?php

use common\models\Post;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">
    <?php $form = ActiveForm::begin(
        [
            'enableClientValidation' => true,
            'options' => ['class' => 'form-horizontal', 'role' => 'form']

        ]
    ); ?>

    <div class="form-body">
        <?= $form->field($model, 'title', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>', 'labelOptions' => ['class' => 'control-label col-md-2']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>', 'labelOptions' => ['class' => 'control-label col-md-2']])->dropDownList(Post::getStatusesDropDowwnList()) ?>

        <?= $form->field($model, 'content', ['template' => '{label}<div class="col-sm-10">{input}{error}{hint}</div>', 'labelOptions' => ['class' => 'control-label col-md-2']])->textarea(['class' => 'form-control', 'id' => 'summernote']) ?>
    </div>


    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
            <?= Html::a('Cancel', ['index'], ['class'=>'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJsFile('admin/js/post.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
