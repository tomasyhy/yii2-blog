<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tag */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Tag',
    ]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<h2><?= Html::encode($this->title) ?></h2>
<hr>
<div class="panel-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


