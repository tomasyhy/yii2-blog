<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Post',
    ]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<h2><?= Html::encode($this->title) ?></h2>
<hr>
<div class="panel-body">
    <?= $this->render('_form', [
        'model' => $model,
        'postTagModel' => $postTagModel,
    ]) ?>
</div>
