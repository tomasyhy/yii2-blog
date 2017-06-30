<?php

use yii\helpers\{
    Url, Html
};
use yii\widgets\ActiveForm;

?>

    <div class="panel">
        <div class="panel-body">
            <div class="col-lg-6">
            <?php $form = ActiveForm::begin(
                [
                    'action' => Url::to(['add-comment']),
                    'enableClientValidation' => false,
                    'enableAjaxValidation' => true,
                    'validateOnBlur' => false,
                    'validationUrl' => Url::to(['validate-comment']),
                    'options' => [
                        'role' => 'form',
                        'class' => 'comment-form'
                    ]
                ]
            ); ?>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($comment, 'author', [
                        'options' => ['class' => 'form-group'],
                        'template' => '{input}{error}{hint}'])->textInput(['maxlength' => true, 'placeholder' => "Name"])
                        ->label(false)
                    ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($comment, 'email', ['template' => '{input}{error}{hint}'])->textInput(['maxlength' => true, 'placeholder' => "Email"])->label(false) ?>
                </div>
            </div>
            <?= $form->field($comment, 'content', ['template' => '{input}{error}'])->textarea(['maxlength' => true, 'placeholder' => "Comment"])->label(false) ?>

            <?= $form->field($comment, 'post_id')->hiddenInput(['value' => $postId])->label(false) ?>

            <?= $form->field($commentTree, 'ancestor')->hiddenInput(['value' => $ancestorId])->label(false) ?>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-2">
                        <?= Html::submitButton(Yii::t('app', 'Add Comment'), ['class' => 'btn btn-sm btn-success']) ?>
                    </div>

                    <?php if ($ancestorId): ?>
                        <div class="col-md-2">
                            <?= Html::button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-sm btn-warning hide-form']) ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

<?php $this->registerJsFile(
    '@web/js/comment/add-comment.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
); ?>