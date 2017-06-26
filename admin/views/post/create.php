<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = Yii::t('app', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-square font-dark"></i>
                    <span class="caption-subject font-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="post-create">
                    <?= $this->render('_form', [
                        'model' => $model,
                        'postTagModel' => $postTagModel,
                    ]) ?>

                </div>
            </div>
        </div>

    </div>
</div>

