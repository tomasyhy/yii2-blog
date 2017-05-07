<?php

use common\models\{
    Post, Tag
};
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">
    <?php $form = ActiveForm::begin(
        [
            'enableClientValidation' => true,
            'layout' => 'horizontal',
        ]
    ); ?>

    <div class="form-body">
        <?= $form->field($model, 'title', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>', 'labelOptions' => ['class' => 'control-label col-md-1']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($postTagModel, 'tags')->widget(Select2::classname(), [
            'data' => Tag::getAllTagsName(),
            'options' => ['placeholder' => 'Select a tag ...', 'multiple' => true],
            'pluginOptions' => [
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10,
                'width' => '65.4%'
            ],
        ])->label(Yii::t('app', 'Tags'), ['class' => 'control-label col-sm-1'])
        ?>

        <?= $form->field($model, 'status', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>', 'labelOptions' => ['class' => 'control-label col-md-1']])->dropDownList(Post::getStatusesDropDowwnList()) ?>

        <?= $form->field($model, 'content', ['template' => '{label}<div class="col-sm-10">{input}{error}{hint}</div>', 'labelOptions' => ['class' => 'control-label col-md-1']])->textarea(['class' => 'form-control', 'id' => 'summernote']) ?>
    </div>


    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
                <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJsFile('admin/js/post.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
